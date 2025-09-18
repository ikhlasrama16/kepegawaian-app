// assets/js/alerts.js

// Konfirmasi sebelum submit form
function confirmFormSubmit(formId, message = "Apakah Anda yakin ingin menyimpan data ini?") {
  const form = document.getElementById(formId);
  if (!form) return;

  form.addEventListener('submit', function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Konfirmasi',
      text: message,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, lanjut!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
}

// Notifikasi status (dipanggil dari PHP via query string)
function showStatusAlert(status, successMsg = "Data berhasil disimpan!", errorMsg = "Terjadi kesalahan!") {
  if (status === "success") {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: successMsg,
      timer: 2000,
      showConfirmButton: false
    });
  } else if (status === "error") {
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: errorMsg
    });
  }
}

// Konfirmasi hapus dengan AJAX
function confirmDelete(url, id, rowPrefix = "row", successMsg = "Data berhasil dihapus!") {
  Swal.fire({
    title: 'Yakin hapus?',
    text: "Data ini akan dihapus permanen!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(url, {
        method: 'POST',
        headers: { 'Content-Type':'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id)
      })
      .then(r => r.json())
      .then(res => {
        if (res.success) {
          const row = document.getElementById(`${rowPrefix}-${id}`);
          if (row) row.remove();
          Swal.fire('Dihapus!', successMsg, 'success');
        } else {
          Swal.fire('Gagal!', 'Data tidak bisa dihapus.', 'error');
        }
      })
      .catch(err => Swal.fire('Error!', err, 'error'));
    }
  });
}
