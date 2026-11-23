<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/mailer.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'method_not_allowed']);
    exit;
}

$firstName = trim($_POST['first_name'] ?? '');
$lastName  = trim($_POST['last_name'] ?? '');
$company   = trim($_POST['company'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$message   = trim($_POST['message'] ?? '');
$source    = trim($_POST['source_page'] ?? '') ?: 'Unbekannt';
$formName  = trim($_POST['form_name'] ?? '') ?: 'Unbekanntes Formular';
$sourceUrl = trim($_POST['source_url'] ?? '');
$lang      = strtoupper(trim($_POST['lang'] ?? ''));
// Header-Injection verhindern (Zeilenumbrueche in Betreff/Kopfzeilen)
$oneLine = fn($v) => trim(preg_replace('/[\r\n]+/', ' ', $v));

if ($firstName === '' || $lastName === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'invalid_input']);
    exit;
}

// Speichern ist optional: faellt die Datenbank aus, geht die Mail trotzdem raus
$saved = false;
try {
    $stmt = db()->prepare('INSERT INTO contact_submissions (first_name, last_name, company, email, phone, message, source_page) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$firstName, $lastName, $company ?: null, $email, $phone ?: null, $message ?: null, mb_substr($source . ' | ' . $formName, 0, 100)]);
    $saved = true;
} catch (Throwable $e) {
    error_log('Kontaktanfrage nicht gespeichert: ' . $e->getMessage());
}

$subject = 'Neue Anfrage über scrambl.org: ' . $oneLine($formName) . ' – ' . $oneLine($firstName . ' ' . $lastName);
$body    = "Neue Anfrage über scrambl.org\n\n"
         . "Formular: {$formName}\n"
         . "Seite: {$source}\n"
         . "URL: {$sourceUrl}\n"
         . "Sprache: {$lang}\n\n"
         . "Name: {$firstName} {$lastName}\n"
         . "Unternehmen: {$company}\n"
         . "E-Mail: {$email}\n"
         . "Telefon: {$phone}\n"
         . "Nachricht: {$message}\n";
$sent = send_mail(NOTIFY_EMAIL, $subject, $body, ['email' => $oneLine($email), 'name' => $oneLine($firstName . ' ' . $lastName)]);

// Erfolg, wenn die Anfrage mindestens gespeichert oder verschickt wurde
if (!$sent && !$saved) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'delivery_failed']);
    exit;
}
echo json_encode(['success' => true]);
