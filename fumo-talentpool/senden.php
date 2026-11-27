<?php
/**
 * Fumo Talentpool – Versand per E-Mail
 * Seite: scrambl.org/fumo-talentpool (fumo-talentpool/index.php), dieses Skript: scrambl.org/fumo-talentpool/senden.php
 * Nutzt den bestehenden Mailversand der Website (mailer.php, Brevo-Einstellungen aus config.php).
 * Ändert keine bestehenden Dateien und schreibt nichts in die Datenbank.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../mailer.php';
require_once __DIR__ . '/pdf.php';

// ---- Einstellungen ---------------------------------------------------------
const EMPFAENGER = 'app@scrambl.org';                 // wer die Anmeldungen bekommt (eine Adresse)
const SEITE      = 'https://www.scrambl.org/fumo-talentpool/';
const MAX_PRO_STUNDE = 10;                           // Schutz vor Missbrauch pro IP-Adresse
// ---------------------------------------------------------------------------

date_default_timezone_set('Europe/Zurich');
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

function antwort(int $code, array $daten): void {
    http_response_code($code);
    echo json_encode($daten, JSON_UNESCAPED_UNICODE);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    antwort(405, ['ok' => false, 'fehler' => 'Nur POST erlaubt.']);
}

// Honeypot: dieses Feld ist für Menschen unsichtbar. Ist es ausgefüllt, war es ein Bot.
if (!empty($_POST['firma'])) {
    antwort(200, ['ok' => true]); // so tun, als ob alles geklappt hätte
}

// Einfache Begrenzung pro IP-Adresse
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unbekannt';
$datei = sys_get_temp_dir() . '/fumo_' . hash('sha256', $ip);
$jetzt = time();
$zeiten = [];
if (is_file($datei)) {
    $zeiten = array_filter(
        array_map('intval', explode(',', (string) file_get_contents($datei))),
        fn($t) => $t > $jetzt - 3600
    );
}
if (count($zeiten) >= MAX_PRO_STUNDE) {
    antwort(429, ['ok' => false, 'fehler' => 'Zu viele Anmeldungen. Bitte versuche es später nochmals.']);
}

// Felder einlesen und bereinigen
function feld(string $name, int $max = 120): string {
    $wert = trim((string) ($_POST[$name] ?? ''));
    $wert = preg_replace('/[\r\n\t]+/', ' ', $wert); // keine Zeilenumbrüche (Schutz vor Header-Injection)
    return mb_substr($wert, 0, $max);
}

$d = [
    'Vorname'     => feld('vorname'),
    'Nachname'    => feld('nachname'),
    'Telefon'     => feld('telefon', 40),
    'E-Mail'      => feld('email', 160),
    'Wunschberuf' => feld('wunschberuf', 160),
];

// Prüfen
$fehler = [];
if ($d['Vorname'] === '')     $fehler[] = 'vorname';
if ($d['Nachname'] === '')    $fehler[] = 'nachname';
if (!preg_match('/^[+\d][\d\s()\/-]{6,}$/', $d['Telefon'])) $fehler[] = 'telefon';
if (!filter_var($d['E-Mail'], FILTER_VALIDATE_EMAIL))      $fehler[] = 'email';
if ($d['Wunschberuf'] === '') $fehler[] = 'wunschberuf';
if (empty($_POST['privacy'])) $fehler[] = 'privacy';
if ($fehler) {
    antwort(422, ['ok' => false, 'fehler' => 'Bitte prüfe deine Angaben.', 'felder' => $fehler]);
}

// E-Mail zusammenstellen
$name = $d['Vorname'] . ' ' . $d['Nachname'];
$tage = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
$zeit = $tage[(int) date('w')] . ', ' . date('d.m.Y') . ', ' . date('H:i') . ' Uhr';
$zeile = fn(string $label, string $wert) => str_pad($label, 16) . $wert . "\n";

$text  = "Neue Anmeldung im Fumo Talentpool (Fuchs-Movesa)\n\n";
$text .= $name . " hat sich über die Landingpage " . SEITE . " für den Talentpool von Fuchs-Movesa angemeldet.\n\n";

$text .= "KONTAKT\n";
$text .= $zeile('Vorname:', $d['Vorname']);
$text .= $zeile('Nachname:', $d['Nachname']);
$text .= $zeile('Telefon:', $d['Telefon']);
$text .= $zeile('E-Mail:', $d['E-Mail']);

$text .= "\nWUNSCHBERUF\n" . $d['Wunschberuf'] . "\n";

$text .= "\nEINWILLIGUNG\n";
$text .= "Die Person hat per Checkbox bestätigt, dass sie die Datenschutzerklärung zur Kenntnis genommen hat.\n";
$text .= "Datenschutzerklärung: https://www.scrambl.org/datenschutz.php\n";

$text .= "\nHERKUNFT\n";
$text .= $zeile('Eingegangen:', $zeit);
$text .= $zeile('Formular:', 'Fumo Talentpool');
$text .= $zeile('Unternehmen:', 'Fuchs-Movesa');
$text .= $zeile('Kanal:', 'QR-Code-Kampagne');
$text .= $zeile('Seite:', SEITE);

$text .= "\nDie Angaben sind auch als PDF angehängt.\nMit «Antworten» schreibst du direkt an " . $d['E-Mail'] . ".\n";

// PDF mit den Angaben als Anhang
$pdf = fumo_pdf('Fumo Talentpool', [
    'KONTAKT' => [
        ['Vorname:', $d['Vorname']],
        ['Nachname:', $d['Nachname']],
        ['Telefon:', $d['Telefon']],
        ['E-Mail:', $d['E-Mail']],
    ],
    'WUNSCHBERUF' => [
        ['', $d['Wunschberuf']],
    ],
]);
$ascii = fn($v) => trim(preg_replace('/[^A-Za-z0-9]+/', '-', strtr($v, ['ä'=>'ae','ö'=>'oe','ü'=>'ue','Ä'=>'Ae','Ö'=>'Oe','Ü'=>'Ue','é'=>'e','è'=>'e','à'=>'a','ç'=>'c'])), '-');
$pdfName = 'Fumo-Talentpool_' . $ascii($d['Nachname']) . '_' . $ascii($d['Vorname']) . '_' . date('Y-m-d') . '.pdf';

$gesendet = send_mail(
    EMPFAENGER,
    'Fumo Talentpool – neue Anmeldung: ' . $name . ' (' . $d['Wunschberuf'] . ')',
    $text,
    ['email' => $d['E-Mail'], 'name' => $name],
    [['name' => $pdfName, 'content' => $pdf]]
);

if (!$gesendet) {
    error_log('Fumo Talentpool: E-Mail konnte nicht gesendet werden.');
    antwort(500, ['ok' => false, 'fehler' => 'Das Senden hat nicht geklappt. Bitte versuche es später nochmals.']);
}

$zeiten[] = $jetzt;
@file_put_contents($datei, implode(',', $zeiten), LOCK_EX);

antwort(200, ['ok' => true]);
