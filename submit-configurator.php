<?php
require_once __DIR__ . '/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'method_not_allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?: [];

$stmt = db()->prepare('INSERT INTO configurator_results (groesse, hauptproblem, ats, ausschreibungen, themen, result_key) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->execute([
    substr((string)($data['groesse'] ?? ''), 0, 10),
    substr((string)($data['hauptproblem'] ?? ''), 0, 30),
    substr((string)($data['ats'] ?? ''), 0, 20),
    substr((string)($data['ausschreibungen'] ?? ''), 0, 10),
    json_encode($data['themen'] ?? [], JSON_UNESCAPED_UNICODE),
    substr((string)($data['result_key'] ?? ''), 0, 30),
]);

echo json_encode(['success' => true]);
