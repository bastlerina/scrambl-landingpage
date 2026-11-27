<?php
/**
 * Talentpool Fuchs-Movesa – Versand per E-Mail
 * Seite: scrambl.org/fumo (fumo/index.php), dieses Skript: scrambl.org/fumo/senden.php
 * Nutzt den bestehenden Mailversand der Website (mailer.php, Brevo-Einstellungen aus config.php).
 * Ändert keine bestehenden Dateien und schreibt nichts in die Datenbank.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../mailer.php';

// ---- Einstellungen ---------------------------------------------------------
const EMPFAENGER = 'app@scrambl.org';                 // wer die Anmeldungen bekommt (eine Adresse)
const BETREFF    = 'Neue Anmeldung Talentpool Fuchs-Movesa';
const QUELLE     = 'QR-Code Fuchs-Movesa (scrambl.org/fumo)';
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
if ($fehler) {
    antwort(422, ['ok' => false, 'fehler' => 'Bitte prüfe deine Angaben.', 'felder' => $fehler]);
}

// E-Mail zusammenstellen
$text = "Neue Anmeldung für den Talentpool Fuchs-Movesa\n\n";
foreach ($d as $k => $v) {
    $text .= str_pad($k . ':', 14) . $v . "\n";
}
$text .= "\nEingegangen:  " . date('d.m.Y, H:i') . " Uhr\n";
$text .= 'Quelle:       ' . QUELLE . "\n";

$gesendet = send_mail(
    EMPFAENGER,
    BETREFF . ': ' . $d['Vorname'] . ' ' . $d['Nachname'],
    $text,
    ['email' => $d['E-Mail'], 'name' => $d['Vorname'] . ' ' . $d['Nachname']]
);

if (!$gesendet) {
    error_log('Talentpool Fuchs-Movesa: E-Mail konnte nicht gesendet werden.');
    antwort(500, ['ok' => false, 'fehler' => 'Das Senden hat nicht geklappt. Bitte versuche es später nochmals.']);
}

$zeiten[] = $jetzt;
@file_put_contents($datei, implode(',', $zeiten), LOCK_EX);

antwort(200, ['ok' => true]);
