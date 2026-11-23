<?php
// Mailversand ueber Brevo (Transactional E-Mail API v3).
// Konfiguration in config.php: BREVO_API_KEY, MAIL_FROM, MAIL_FROM_NAME.
// Ohne API-Key wird auf die einfache PHP-Mailfunktion zurueckgegriffen.

/**
 * Sendet eine Text-Mail. Gibt true bei Erfolg zurueck.
 * $replyTo:     ['email' => ..., 'name' => ...] oder null
 * $attachments: [['name' => 'lebenslauf.pdf', 'content' => <rohe Bytes>], ...]
 */
function send_mail(string $to, string $subject, string $text, ?array $replyTo = null, array $attachments = []): bool {
    $from     = defined('MAIL_FROM') ? MAIL_FROM : 'no-reply@scrambl.org';
    $fromName = defined('MAIL_FROM_NAME') ? MAIL_FROM_NAME : 'Scrambl. Website';
    $apiKey   = defined('BREVO_API_KEY') ? trim(BREVO_API_KEY) : '';

    if ($apiKey === '') {
        $headers = "From: {$fromName} <{$from}>\r\nContent-Type: text/plain; charset=UTF-8";
        if ($replyTo && !empty($replyTo['email'])) $headers .= "\r\nReply-To: " . str_replace(["\r", "\n"], '', $replyTo['email']);
        return @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $text, $headers);
    }

    $payload = [
        'sender'      => ['email' => $from, 'name' => $fromName],
        'to'          => [['email' => $to]],
        'subject'     => $subject,
        'textContent' => $text,
    ];
    if ($replyTo && !empty($replyTo['email'])) {
        $payload['replyTo'] = array_filter(['email' => $replyTo['email'], 'name' => $replyTo['name'] ?? null]);
    }
    foreach ($attachments as $a) {
        $payload['attachment'][] = ['name' => $a['name'], 'content' => base64_encode($a['content'])];
    }

    $ch = curl_init(defined('BREVO_API_URL') ? BREVO_API_URL : 'https://api.brevo.com/v3/smtp/email');
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_HTTPHEADER     => ['accept: application/json', 'content-type: application/json', 'api-key: ' . $apiKey],
        CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
    ]);
    $response = curl_exec($ch);
    $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status < 200 || $status >= 300) {
        error_log('Brevo-Mailversand fehlgeschlagen (HTTP ' . $status . '): ' . substr((string)$response, 0, 300));
        return false;
    }
    return true;
}
