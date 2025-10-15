<?php
// api/delete_faq.php
include_once(__DIR__ . '/../database/db_connect.php');
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['admin'])) { http_response_code(401); echo json_encode(['error'=>'unauthorized']); exit; }

$data = json_decode(file_get_contents('php://input'), true);
$id = intval($data['id'] ?? 0);
if(!$id){ http_response_code(400); echo json_encode(['error'=>'missing']); exit; }

$stmt = $conn->prepare("DELETE FROM tbl_faq WHERE id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
echo json_encode(['success'=>true]);
