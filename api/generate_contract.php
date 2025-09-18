<?php
require '../config.php';
header('Content-Type: application/json');

$tipe = $_POST['tipe'] ?? 'Kontrak Kerja';

$prompt = "Buatkan draft kontrak kerja sederhana (bahasa Indonesia) untuk tipe: {$tipe}. 
Sertakan: judul, pasal durasi, tugas pokok, hak & kewajiban, tanda tangan pihak.";

$body = [
  'model' => 'openai/gpt-4o-mini', // bisa ganti sesuai ketersediaan di OpenRouter
  'messages' => [
    ['role' => 'user', 'content' => $prompt]
  ]
];

$ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Authorization: Bearer ' . OPENROUTER_API_KEY,
  'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

$res = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo json_encode(['success'=>false, 'error'=>$err]);
    exit;
}

$data = json_decode($res, true);
$draft = $data['choices'][0]['message']['content'] ?? ($data['choices'][0]['text'] ?? null);

echo json_encode(['success'=>true, 'draft'=>$draft]);
