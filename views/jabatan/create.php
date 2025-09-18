<?php
require '../../config.php';
include '../layouts/header.php';

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    if ($nama !== '') {
        $stmt = $pdo->prepare("INSERT INTO jabatan (nama) VALUES (?)");
        $ok = $stmt->execute([$nama]);

        if ($ok) {
            // redirect balik ke index dengan status sukses
            header("Location: index.php?status=success");
            exit;
        } else {
            // kalau gagal insert (misal error DB)
            header("Location: index.php?status=error");
            exit;
        }
    } else {
        $error = "Nama jabatan tidak boleh kosong!";
    }
}
?>

<div class="card shadow-sm">
  <div class="card-header bg-dark text-white">
    <h5 class="mb-0">Tambah Jabatan</h5>
  </div>
  <div class="card-body">
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" id="formJabatan">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Jabatan</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<script>
  // SweetAlert konfirmasi sebelum submit
  confirmFormSubmit("formJabatan", "Apakah Anda yakin ingin menyimpan jabatan ini?");
</script>

<?php include '../layouts/footer.php'; ?>
