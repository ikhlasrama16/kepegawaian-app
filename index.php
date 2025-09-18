<?php
require './config.php';
include './views/layouts/header.php';
?>

<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Selamat Datang 👋</h1>
    <p class="col-md-8 fs-5">
      Ini adalah aplikasi manajemen kepegawaian sederhana.  
      Gunakan menu di atas untuk mengelola <b>Jabatan</b>, <b>Kontrak</b>, dan <b>Pegawai</b>.
    </p>
    <a href="/pegawai-app/views/pegawai/index.php" class="btn btn-primary btn-lg">Kelola Pegawai</a>
  </div>
</div>

<?php include './views/layouts/footer.php'; ?>
