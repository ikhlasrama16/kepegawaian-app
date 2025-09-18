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
