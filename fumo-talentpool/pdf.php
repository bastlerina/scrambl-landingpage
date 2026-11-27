<?php
/**
 * Fumo Talentpool – PDF mit allen Angaben einer Anmeldung.
 * Eigenständiger, kleiner PDF-Erzeuger ohne Bibliotheken (A4, Helvetica). Nur die Angaben, ohne Logo und Titel.
 * Wird nur von senden.php verwendet.
 */

const FUMO_PDF_W_REG  = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,278,278,355,556,556,889,667,191,333,333,389,584,278,333,278,278,556,556,556,556,556,556,556,556,556,556,278,278,584,584,584,556,1015,667,667,722,722,667,611,778,722,278,500,667,556,833,722,778,667,778,722,667,611,722,667,944,667,667,611,278,278,278,469,556,333,556,556,500,556,556,278,556,556,222,222,500,222,833,556,556,556,556,333,500,278,556,500,722,500,500,500,334,260,334,584,350,556,350,222,556,333,1000,556,556,333,1000,667,333,1000,350,611,350,350,222,222,333,333,350,556,1000,333,1000,500,333,944,350,500,667,278,333,556,556,556,556,260,556,333,737,370,556,584,333,737,333,400,584,333,333,333,556,537,278,333,333,365,556,834,834,834,611,667,667,667,667,667,667,1000,722,667,667,667,667,278,278,278,278,722,722,778,778,778,778,778,584,778,722,722,722,722,667,667,611,556,556,556,556,556,556,889,500,556,556,556,556,278,278,278,278,556,556,556,556,556,556,556,584,611,556,556,556,556,500,556,500];
const FUMO_PDF_W_BOLD = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,278,333,474,556,556,889,722,238,333,333,389,584,278,333,278,278,556,556,556,556,556,556,556,556,556,556,333,333,584,584,584,611,975,722,722,722,722,667,611,778,722,278,556,722,611,833,722,778,667,778,722,667,611,722,667,944,667,667,611,333,278,333,584,556,333,556,611,556,611,556,333,611,611,278,278,556,278,889,611,611,611,611,389,556,333,611,556,778,556,556,500,389,280,389,584,350,556,350,278,556,500,1000,556,556,333,1000,667,333,1000,350,611,350,350,278,278,500,500,350,556,1000,333,1000,556,333,944,350,500,667,278,333,556,556,556,556,280,556,333,737,370,556,584,333,737,333,400,584,333,333,333,611,556,278,333,333,365,556,834,834,834,611,722,722,722,722,722,722,1000,722,667,667,667,667,278,278,278,278,722,722,778,778,778,778,778,584,778,722,722,722,722,667,667,611,556,556,556,556,556,556,889,556,556,556,556,556,278,278,278,278,611,611,611,611,611,611,611,584,611,611,611,611,611,556,611,556];

/** UTF-8 in Windows-1252 umwandeln (Schriftkodierung der PDF-Standardschrift). */
function fumo_pdf_enc(string $s): string {
    $s = str_replace(["\u{2013}", "\u{2014}", "\u{2019}", "\u{201C}", "\u{201D}", "\u{00AB}", "\u{00BB}"], ['-', '-', "'", '"', '"', '"', '"'], $s);
    $s = str_replace(['-', "'", '"'], ['-', "'", '"'], $s);
    if (function_exists('mb_convert_encoding')) {
        $r = @mb_convert_encoding($s, 'Windows-1252', 'UTF-8');
        if (is_string($r)) return $r;
    }
    if (function_exists('iconv')) {
        $r = @iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', $s);
        if (is_string($r)) return $r;
    }
    return preg_replace('/[^\x20-\x7E]/', '?', $s);
}

function fumo_pdf_width(string $enc, float $size, bool $bold = false): float {
    $w = $bold ? FUMO_PDF_W_BOLD : FUMO_PDF_W_REG;
    $sum = 0;
    for ($i = 0, $n = strlen($enc); $i < $n; $i++) $sum += $w[ord($enc[$i])] ?? 556;
    return $sum * $size / 1000;
}

/** Text (bereits kodiert) auf eine Breite umbrechen. */
function fumo_pdf_wrap(string $enc, float $size, float $max, bool $bold = false): array {
    $lines = [];
    foreach (explode("\n", $enc) as $para) {
        $line = '';
        foreach (preg_split('/ +/', $para) as $word) {
            $try = $line === '' ? $word : $line . ' ' . $word;
            if (fumo_pdf_width($try, $size, $bold) <= $max) { $line = $try; continue; }
            if ($line !== '') $lines[] = $line;
            // sehr langes Wort hart trennen
            while (fumo_pdf_width($word, $size, $bold) > $max && strlen($word) > 1) {
                $cut = strlen($word);
                while ($cut > 1 && fumo_pdf_width(substr($word, 0, $cut), $size, $bold) > $max) $cut--;
                $lines[] = substr($word, 0, $cut);
                $word = substr($word, $cut);
            }
            $line = $word;
        }
        $lines[] = $line;
    }
    return $lines;
}

function fumo_pdf_str(string $enc): string {
    return '(' . strtr($enc, ['\\' => '\\\\', '(' => '\\(', ')' => '\\)', "\r" => '', "\n" => ' ']) . ')';
}

/**
 * Erstellt das PDF und gibt die rohen Bytes zurück. $titel wird nur als Dokumenttitel in den Eigenschaften verwendet.
 * $abschnitte: [ 'TITEL' => [ ['Label', 'Wert'], ... ], ... ]
 */
function fumo_pdf(string $titel, array $abschnitte, string $untertitel = '', string $fusszeile = ''): string {
    $W = 595.28; $H = 841.89; $L = 56; $R = $W - 56; $labelW = 130;
    $c = [];
    $text = function (float $x, float $y, string $s, float $size, bool $bold = false, string $rgb = '0.2 0.2 0.2') use (&$c) {
        $c[] = "BT {$rgb} rg /" . ($bold ? 'F2' : 'F1') . " {$size} Tf {$x} {$y} Td " . fumo_pdf_str($s) . ' Tj ET';
    };
    $rule = function (float $y, string $rgb = '0.80 0.80 0.80', float $w = 0.6) use (&$c, $L, $R) {
        $c[] = "{$rgb} RG {$w} w {$L} {$y} m {$R} {$y} l S";
    };

    // Kein Kopf, kein Titel: direkt mit den Angaben beginnen
    $y = $H - 70;

    // Abschnitte
    foreach ($abschnitte as $name => $zeilen) {
        $text($L, $y, fumo_pdf_enc($name), 9, true, '0.33 0.33 0.33');
        $y -= 8; $rule($y, '0.2 0.2 0.2', 0.8); $y -= 18;
        foreach ($zeilen as [$label, $wert]) {
            $lab = fumo_pdf_enc($label);
            $val = fumo_pdf_wrap(fumo_pdf_enc($wert), 11, $R - $L - $labelW);
            if ($label !== '') $text($L, $y, $lab, 10, false, '0.4 0.4 0.4');
            $x = $label !== '' ? $L + $labelW : $L;
            foreach ($val as $i => $zeile) {
                if ($label === '') {
                    $zeile = fumo_pdf_wrap($zeile, 11, $R - $L);
                    foreach ($zeile as $z) { $text($L, $y, $z, 11); $y -= 16; }
                    continue;
                }
                $text($x, $y, $zeile, 11);
                $y -= 16;
            }
            $y -= 4;
        }
        $y -= 16;
    }

    // Fusszeile (optional)
    if ($fusszeile !== '') $text($L, 48, fumo_pdf_enc($fusszeile), 8, false, '0.45 0.45 0.45');

    $stream = implode("\n", $c);
    $filter = '';
    if (function_exists('gzcompress')) { $stream = gzcompress($stream, 9); $filter = ' /Filter /FlateDecode'; }

    $obj = [];
    $obj[1] = '<< /Type /Catalog /Pages 2 0 R >>';
    $obj[2] = '<< /Type /Pages /Kids [3 0 R] /Count 1 >>';
    $obj[3] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 {$W} {$H}] /Resources << /Font << /F1 4 0 R /F2 5 0 R >> >> /Contents 6 0 R >>";
    $obj[4] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>';
    $obj[5] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>';
    $obj[6] = '<< /Length ' . strlen($stream) . $filter . " >>\nstream\n" . $stream . "\nendstream";
    $obj[7] = '<< /Title ' . fumo_pdf_str(fumo_pdf_enc(trim($titel . ' ' . $untertitel))) . ' /Producer (Scrambl.) /CreationDate (D:' . date('YmdHis') . ') >>';

    $pdf = "%PDF-1.4\n%\xE2\xE3\xCF\xD3\n";
    $off = [];
    foreach ($obj as $n => $o) { $off[$n] = strlen($pdf); $pdf .= "{$n} 0 obj\n{$o}\nendobj\n"; }
    $xref = strlen($pdf);
    $pdf .= "xref\n0 " . (count($obj) + 1) . "\n0000000000 65535 f \n";
    foreach ($off as $o) $pdf .= sprintf("%010d 00000 n \n", $o);
    $pdf .= "trailer\n<< /Size " . (count($obj) + 1) . " /Root 1 0 R /Info 7 0 R >>\nstartxref\n{$xref}\n%%EOF";
    return $pdf;
}
