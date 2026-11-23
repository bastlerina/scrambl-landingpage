<?php
// Lebenslauf-Upload (z. B. /cv-upload-szkb): Lebenslauf geht als Anhang per Brevo-Mail raus,
// auf dem Webspace wird nichts gespeichert.
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mailer.php';
date_default_timezone_set('Europe/Zurich');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'method_not_allowed']);
    exit;
}

$email     = trim($_POST['email'] ?? '');
$talent    = !empty($_POST['talentpool']);
$partner   = !empty($_POST['partner_access']);
$privacy   = !empty($_POST['privacy']);
$source    = trim($_POST['source'] ?? '') ?: 'Lebenslauf-Upload';
$partnerNm = trim($_POST['partner_name'] ?? '');
$oneLine   = fn($v) => trim(preg_replace('/[\r\n]+/', ' ', (string) $v));

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$privacy) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'invalid_input']);
    exit;
}

$file = $_FILES['cv'] ?? null;
$allowed = ['pdf', 'doc', 'docx', 'rtf', 'odt', 'txt', 'jpg', 'jpeg', 'png'];
$maxBytes = 8 * 1024 * 1024;
if (!$file || $file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'no_file']);
    exit;
}
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $allowed, true) || $file['size'] > $maxBytes) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'bad_file']);
    exit;
}

// Dateiname vereinheitlichen (keine Sonderzeichen/Pfade aus dem Upload uebernehmen)
$safeName = 'Lebenslauf_' . preg_replace('/[^A-Za-z0-9._-]+/', '_', strstr($email, '@', true) ?: 'bewerbung') . '.' . $ext;
$content  = file_get_contents($file['tmp_name']);

$yesNo = fn($b) => $b ? 'Ja' : 'Nein';
$subject = 'Neuer Lebenslauf über scrambl.org: ' . $oneLine($source) . ' – ' . $oneLine($email);
$body = "Neuer Lebenslauf über scrambl.org\n\n"
      . "Formular: {$source}\n"
      . "E-Mail: {$email}\n"
      . "Datei: {$safeName} (" . round($file['size'] / 1024) . " KB)\n\n"
      . "Möchte Teil des Scrambl. Talentpools werden: " . $yesNo($talent) . "\n"
      . ($partnerNm !== '' ? "Zugang für {$partnerNm} zum Talentpool-Profil: " . $yesNo($partner) . "\n" : '')
      . "Datenschutzerklärung zur Kenntnis genommen: Ja\n"
      . "Zeitpunkt: " . date('d.m.Y H:i') . "\n";

$sent = send_mail(NOTIFY_EMAIL, $subject, $body, ['email' => $oneLine($email)], [['name' => $safeName, 'content' => $content]]);
if (!$sent) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'delivery_failed']);
    exit;
}
echo json_encode(['success' => true]);
