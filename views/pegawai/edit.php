<?php
require '../../config.php';
include '../layouts/header.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM pegawai WHERE id = ?");
$stmt->execute([$id]);
$pegawai = $stmt->fetch();

if (!$pegawai) {
    echo "<div class='alert alert-danger'>Pegawai tidak ditemukan!</div>";
    include '../layouts/footer.php';
    exit;
}

// Ambil data dropdown
$jabatanList = $pdo->query("SELECT * FROM jabatan ORDER BY nama ASC")->fetchAll();
$kontrakList = $pdo->query("SELECT * FROM kontrak ORDER BY tipe ASC")->fetchAll();

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE pegawai 
                           SET nama=?, email=?, jabatan_id=?, kontrak_id=?, tanggal_mulai=?, alamat=? 
                           WHERE id=?");
    $ok = $stmt->execute([
        $_POST['nama'],
        $_POST['email'],
        $_POST['jabatan_id'] ?: null,
        $_POST['kontrak_id'] ?: null,
        $_POST['tanggal_mulai'] ?: null,
        $_POST['alamat'] ?: null,
        $id
    ]);

    if ($ok) {
        header("Location: index.php?status=updated");
        exit;
    } else {
        header("Location: index.php?status=error");
        exit;
    }
}
?>

<div class="card shadow-sm">
  <div class="card-header bg-dark text-white">
    <h5 class="mb-0">Edit Pegawai</h5>
  </div>
  <div class="card-body">
    <form method="post" id="formPegawaiEdit">
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($pegawai['nama']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($pegawai['email']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Jabatan</label>
        <select name="jabatan_id" class="form-select">
          <option value="">-- Pilih Jabatan --</option>
          <?php foreach($jabatanList as $j): ?>
            <option value="<?= $j['id'] ?>" <?= $pegawai['jabatan_id']==$j['id']?'selected':'' ?>>
              <?= htmlspecialchars($j['nama']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Kontrak</label>
        <select name="kontrak_id" class="form-select">
          <option value="">-- Pilih Kontrak --</option>
          <?php foreach($kontrakList as $k): ?>
            <option value="<?= $k['id'] ?>" <?= $pegawai['kontrak_id']==$k['id']?'selected':'' ?>>
              <?= htmlspecialchars($k['tipe']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control" value="<?= $pegawai['tanggal_mulai'] ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control"><?= htmlspecialchars($pegawai['alamat']) ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<script>
  confirmFormSubmit("formPegawaiEdit", "Apakah Anda yakin ingin mengupdate data pegawai ini?");
</script>

<?php include '../layouts/footer.php'; ?>
