<?php
// api/update_faq.php
include_once(__DIR__ . '/../database/db_connect.php');
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['admin'])) { http_response_code(401); echo json_encode(['error'=>'unauthorized']); exit; }

$data = json_decode(file_get_contents('php://input'), true);
$id = intval($data['id'] ?? 0);
$q = trim($data['question'] ?? '');
$a = trim($data['answer'] ?? '');
$lang = ($data['language'] ?? 'en');

if(!$id || !$q || !$a){ http_response_code(400); echo json_encode(['error'=>'missing']); exit; }

$stmt = $conn->prepare("UPDATE tbl_faq SET question=?, answer=?, language=? WHERE id=?");
$stmt->bind_param("sssi",$q,$a,$lang,$id);
$stmt->execute();
echo json_encode(['success'=>true]);
