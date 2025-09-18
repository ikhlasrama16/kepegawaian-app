<?php
require '../../config.php';
include '../layouts/header.php';

$jabatan = $pdo->query("SELECT * FROM jabatan ORDER BY id ASC")->fetchAll();
?>

<?php if (isset($_GET['status'])): ?>
<script>
<?php if ($_GET['status'] === 'success'): ?>
  showStatusAlert("success", "Jabatan berhasil ditambahkan!", "Gagal menambahkan jabatan!");
<?php elseif ($_GET['status'] === 'updated'): ?>
  showStatusAlert("success", "Jabatan berhasil diupdate!", "Gagal mengupdate jabatan!");
<?php elseif ($_GET['status'] === 'error'): ?>
  showStatusAlert("error", "Terjadi kesalahan!", "Gagal memproses data jabatan!");
<?php endif; ?>
</script>
<?php endif; ?>


<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Daftar Jabatan</h3>
  <a href="create.php" class="btn btn-primary">Tambah Jabatan</a>
</div>

<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th>Nama Jabatan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($jabatan as $j): ?>
    <tr id="row-<?= $j['id'] ?>">
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($j['nama']) ?></td>
      <td>
        <a href="edit.php?id=<?= $j['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <button 
          onclick="confirmDelete('/pegawai-app/api/delete_jabatan.php', <?= $j['id'] ?>, 'row', 'Jabatan berhasil dihapus!')" 
          class="btn btn-danger btn-sm">Hapus</button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include '../layouts/footer.php'; ?>
