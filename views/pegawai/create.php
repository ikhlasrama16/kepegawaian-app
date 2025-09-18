<?php
require '../../config.php';
include '../layouts/header.php';

// Ambil data jabatan & kontrak untuk dropdown
$jabatanList = $pdo->query("SELECT * FROM jabatan ORDER BY nama ASC")->fetchAll();
$kontrakList = $pdo->query("SELECT * FROM kontrak ORDER BY tipe ASC")->fetchAll();

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO pegawai (nama,email,jabatan_id,kontrak_id,tanggal_mulai,alamat) 
                           VALUES (?,?,?,?,?,?)");
    $ok = $stmt->execute([
        $_POST['nama'],
        $_POST['email'],
        $_POST['jabatan_id'] ?: null,
        $_POST['kontrak_id'] ?: null,
        $_POST['tanggal_mulai'] ?: null,
        $_POST['alamat'] ?: null
    ]);

    if ($ok) {
        header("Location: index.php?status=success");
        exit;
    } else {
        header("Location: index.php?status=error");
        exit;
    }
}
?>

<div class="card shadow-sm">
  <div class="card-header bg-dark text-white">
    <h5 class="mb-0">Tambah Pegawai</h5>
  </div>
  <div class="card-body">
    <form method="post" id="formPegawai">
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Jabatan</label>
        <select name="jabatan_id" class="form-select">
          <option value="">-- Pilih Jabatan --</option>
          <?php foreach($jabatanList as $j): ?>
            <option value="<?= $j['id'] ?>"><?= htmlspecialchars($j['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Kontrak</label>
        <select name="kontrak_id" class="form-select">
          <option value="">-- Pilih Kontrak --</option>
          <?php foreach($kontrakList as $k): ?>
            <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['tipe']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<script>
  confirmFormSubmit("formPegawai", "Apakah Anda yakin ingin menyimpan data pegawai ini?");
</script>

<?php include '../layouts/footer.php'; ?>
