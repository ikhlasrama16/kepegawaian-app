<?php
require '../../config.php';
include '../layouts/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO kontrak (tipe, durasi, deskripsi) VALUES (?,?,?)");
    $ok = $stmt->execute([$_POST['tipe'], $_POST['durasi'], $_POST['deskripsi']]);

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
    <h5 class="mb-0">Tambah Kontrak</h5>
  </div>
  <div class="card-body">
    <form method="post" id="formKontrak">
      <div class="mb-3">
        <label class="form-label">Tipe Kontrak</label>
        <input type="text" name="tipe" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Durasi</label>
        <input type="text" name="durasi" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
      </div>
      <div class="mb-3">
        <button type="button" id="genBtn" class="btn btn-success">Generate Draft AI</button>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<script>
document.getElementById('genBtn').addEventListener('click', function(){
  const tipe = document.querySelector('input[name="tipe"]').value || 'Kontrak Kerja';

  // SweetAlert loading
  Swal.fire({
    title: 'Sedang generate...',
    text: 'Mohon tunggu sebentar.',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  fetch('/pegawai-app/api/generate_contract.php', {
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body: 'tipe=' + encodeURIComponent(tipe)
  })
  .then(r => r.json())
  .then(res => {
    Swal.close(); // tutup loading

    if (res.success) {
      document.getElementById('deskripsi').value = res.draft;
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Draft kontrak berhasil digenerate.'
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: res.error || 'Tidak bisa generate draft.'
      });
    }
  })
  .catch(err => {
    Swal.close();
    Swal.fire('Error!', err.toString(), 'error');
  });
});
</script>

<?php include '../layouts/footer.php'; ?>
