<?php
require '../config.php';
header('Content-Type: application/json');

$id = intval($_POST['id'] ?? 0);
if (!$id) {
    echo json_encode(['success'=>false, 'error'=>'ID tidak valid']);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM kontrak WHERE id=?");
$ok = $stmt->execute([$id]);

echo json_encode(['success'=>$ok]);
