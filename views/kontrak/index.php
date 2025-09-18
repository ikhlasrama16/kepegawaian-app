<?php
require '../../config.php';
include '../layouts/header.php';

$kontrak = $pdo->query("SELECT * FROM kontrak ORDER BY id ASC")->fetchAll();
?>
<?php if (isset($_GET['status'])): ?>
<script>
<?php if ($_GET['status'] === 'success'): ?>
  showStatusAlert("success", "Kontrak berhasil ditambahkan!", "Gagal menambahkan kontrak!");
<?php elseif ($_GET['status'] === 'updated'): ?>
  showStatusAlert("success", "Kontrak berhasil diupdate!", "Gagal mengupdate kontrak!");
<?php elseif ($_GET['status'] === 'error'): ?>
  showStatusAlert("error", "Terjadi kesalahan!", "Gagal memproses data kontrak!");
<?php endif; ?>
</script>
<?php endif; ?>


<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Daftar Kontrak</h3>
  <a href="create.php" class="btn btn-primary">Tambah Kontrak</a>
</div>

<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th>Tipe</th>
      <th>Durasi</th>
      <th>Deskripsi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($kontrak as $k): ?>
    <tr id="row-<?= $k['id'] ?>">
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($k['tipe']) ?></td>
      <td><?= htmlspecialchars($k['durasi']) ?></td>
      <td><?= nl2br(htmlspecialchars($k['deskripsi'])) ?></td>
      <td>
        <a href="edit.php?id=<?= $k['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <!-- ✅ Pakai helper confirmDelete -->
        <button 
          onclick="confirmDelete('/pegawai-app/api/delete_kontrak.php', <?= $k['id'] ?>, 'row', 'Kontrak berhasil dihapus!')" 
          class="btn btn-danger btn-sm">Hapus</button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script>
function hapusKontrak(id) {
  if (!confirm('Yakin hapus kontrak ini?')) return;

  fetch('/pegawai-app/api/delete_kontrak.php', {
    method: 'POST',
    headers: { 'Content-Type':'application/x-www-form-urlencoded' },
    body: 'id=' + encodeURIComponent(id)
  })
  .then(r => r.json())
  .then(res => {
    if (res.success) {
      document.getElementById('row-' + id).remove();
    } else {
      alert('❌ Gagal hapus kontrak!');
    }
  })
  .catch(err => alert('Error: ' + err));
}
</script>

<?php include '../layouts/footer.php'; ?>
