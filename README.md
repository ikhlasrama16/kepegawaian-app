📌 README.md

# 🧑‍💼 Aplikasi Manajemen Kepegawaian

Aplikasi sederhana berbasis **PHP Native + MySQL** untuk mengelola:

- Jabatan
- Kontrak
- Pegawai

Aplikasi ini juga mendukung **generate draft kontrak dengan AI** (menggunakan [OpenRouter](https://openrouter.ai)).

---

## ⚙️ Persiapan

### 1. Clone / Download Project

Pastikan project diletakkan di folder `htdocs` (jika menggunakan XAMPP):


C:\xampp\htdocs\pegawai-app


Akses aplikasi di browser:

http://localhost/pegawai-app/

2. Setup Database

Jalankan SQL berikut di phpMyAdmin / MySQL client:

```sql
CREATE DATABASE kepegawaian CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kepegawaian;

CREATE TABLE jabatan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE kontrak (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipe VARCHAR(100) NOT NULL,
  durasi VARCHAR(100) DEFAULT NULL,
  deskripsi TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE pegawai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(255) NOT NULL,
  email VARCHAR(255) DEFAULT NULL,
  telepon VARCHAR(50) DEFAULT NULL,
  tanggal_lahir DATE DEFAULT NULL,
  jabatan_id INT DEFAULT NULL,
  kontrak_id INT DEFAULT NULL,
  tanggal_mulai DATE DEFAULT NULL,
  alamat TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (jabatan_id) REFERENCES jabatan(id) ON DELETE SET NULL,
  FOREIGN KEY (kontrak_id) REFERENCES kontrak(id) ON DELETE SET NULL
) ENGINE=InnoDB;
```

3. Konfigurasi Database

Edit file config.php sesuai database lokal kamu:
```php
<?php
$host = 'localhost';
$db   = 'kepegawaian';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// 🔑 Tambahkan API Key OpenRouter di sini jika ingin generate AI
$OPENROUTER_KEY = "ISI_API_KEY_KAMU_DI_SINI";
```

4. Generate Kontrak dengan AI (Opsional)

Jika tombol Generate Draft AI tidak berfungsi:

Daftar di OpenRouter

Ambil API Key

Paste ke dalam config.php:
define('OPENROUTER_API_KEY', 'xxxxxxxxx');
```
