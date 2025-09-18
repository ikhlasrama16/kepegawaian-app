<?php
require '../config.php';
header('Content-Type: application/json');
$id = intval($_POST['id'] ?? 0);
if(!$id){ echo json_encode(['success'=>false]); exit;}
$stmt = $pdo->prepare("DELETE FROM pegawai WHERE id = ?");
$ok = $stmt->execute([$id]);
echo json_encode(['success'=>$ok]);
