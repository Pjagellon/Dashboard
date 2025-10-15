<?php
// api/add_faq.php
include_once(__DIR__ . '/../database/db_connect.php');
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['admin'])) { http_response_code(401); echo json_encode(['error'=>'unauthorized']); exit; }

$data = json_decode(file_get_contents('php://input'), true);
$q = trim($data['question'] ?? '');
$a = trim($data['answer'] ?? '');
$lang = ($data['language'] ?? 'en');

if(!$q || !$a){ http_response_code(400); echo json_encode(['error'=>'missing']); exit; }

$stmt = $conn->prepare("INSERT INTO tbl_faq (question,answer,language) VALUES (?, ?, ?)");
$stmt->bind_param("sss",$q,$a,$lang);
$stmt->execute();
echo json_encode(['success'=>true,'id'=>$stmt->insert_id]);
