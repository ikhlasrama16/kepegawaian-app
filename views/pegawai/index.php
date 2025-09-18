<?php
require '../../config.php';
include '../layouts/header.php';

$sql = "SELECT p.*, j.nama AS jabatan, k.tipe AS kontrak
        FROM pegawai p
        LEFT JOIN jabatan j ON p.jabatan_id = j.id
        LEFT JOIN kontrak k ON p.kontrak_id = k.id
        ORDER BY p.id ASC";
$pegawai = $pdo->query($sql)->fetchAll();
?>

<?php if (isset($_GET['status'])): ?>
<script>
<?php if ($_GET['status'] === 'success'): ?>
  showStatusAlert("success", "Pegawai berhasil ditambahkan!", "Gagal menambahkan pegawai!");
<?php elseif ($_GET['status'] === 'updated'): ?>
  showStatusAlert("success", "Pegawai berhasil diupdate!", "Gagal mengupdate pegawai!");
<?php elseif ($_GET['status'] === 'error'): ?>
  showStatusAlert("error", "Terjadi kesalahan!", "Gagal memproses data pegawai!");
<?php endif; ?>
</script>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Daftar Pegawai</h3>
  <a href="create.php" class="btn btn-primary">Tambah Pegawai</a>
</div>

<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Jabatan</th>
      <th>Kontrak</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($pegawai as $p): ?>
    <tr id="row-<?= $p['id'] ?>">
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($p['nama']) ?></td>
      <td><?= htmlspecialchars($p['email']) ?></td>
      <td><?= htmlspecialchars($p['jabatan'] ?? '-') ?></td>
      <td><?= htmlspecialchars($p['kontrak'] ?? '-') ?></td>
      <td>
        <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <button 
          onclick="confirmDelete('/pegawai-app/api/delete_pegawai.php', <?= $p['id'] ?>, 'row', 'Pegawai berhasil dihapus!')" 
          class="btn btn-danger btn-sm">Hapus</button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include '../layouts/footer.php'; ?>
