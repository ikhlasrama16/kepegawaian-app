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
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'kepegawaian');
define('DB_USER', 'root');
define('DB_PASS', '');
define('OPENROUTER_API_KEY', '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');
```

4. Generate Kontrak dengan AI (Opsional)

Jika tombol Generate Draft AI tidak berfungsi:

Daftar di OpenRouter

Ambil API Key

Paste ke dalam config.php:
define('OPENROUTER_API_KEY', 'xxxxxxxxx');
```
