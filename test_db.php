<?php
require 'config.php'; // pastikan config.php sudah ada sesuai instruksi sebelumnya

try {
    $stmt = $pdo->query("SELECT NOW() as waktu");
    $row = $stmt->fetch();
    echo "✅ Koneksi berhasil! Waktu server DB: " . $row['waktu'];
} catch (PDOException $e) {
    echo "❌ Koneksi gagal: " . $e->getMessage();
}
