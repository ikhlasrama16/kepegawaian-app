<?php
require '../../config.php';
include '../layouts/header.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// Ambil data jabatan
$stmt = $pdo->prepare("SELECT * FROM jabatan WHERE id = ?");
$stmt->execute([$id]);
$jabatan = $stmt->fetch();

if (!$jabatan) {
    echo "<div class='alert alert-danger'>Data jabatan tidak ditemukan.</div>";
    include '../layouts/footer.php';
    exit;
}

// Handle update
// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama']);
  if ($nama !== '') {
      $update = $pdo->prepare("UPDATE jabatan SET nama=? WHERE id=?");
      $ok = $update->execute([$nama, $id]);
      if ($ok) {
          header("Location: index.php?status=updated"); // ✅ redirect dengan status
          exit;
      } else {
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
    <h5 class="mb-0">Edit Jabatan</h5>
  </div>
  <div class="card-body">
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Jabatan</label>
        <input type="text" class="form-control" id="nama" name="nama"
               value="<?= htmlspecialchars($jabatan['nama']) ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

<?php include '../layouts/footer.php'; ?>
