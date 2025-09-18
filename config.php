<?php
// config.php — simpan di root, jangan commit
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'kepegawaian');
define('DB_USER', 'root');
define('DB_PASS', '');
define('OPENROUTER_API_KEY', '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');

try {
  $pdo = new PDO(
    "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",
    DB_USER, DB_PASS,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
  );
} catch (PDOException $e) {
  die("DB Connection failed: " . $e->getMessage());
}
