<?php
header('Content-Type: application/json');

// Ambil tipe kontrak dari request
$tipe = $_POST['tipe'] ?? 'Kontrak Kerja';

// Draft dummy (simulasi hasil AI)
$dummyDraft = "
===========================
DRAFT {$tipe}
===========================

Pasal 1 - Durasi
Kontrak ini berlaku selama 1 tahun sejak tanggal ditetapkan.

Pasal 2 - Tugas Pokok
Pekerja berkewajiban melaksanakan pekerjaan sesuai jabatan yang ditetapkan.

Pasal 3 - Hak & Kewajiban
- Pekerja berhak menerima gaji sesuai kesepakatan.
- Pekerja wajib menjaga kerahasiaan perusahaan.

Pasal 4 - Penutup
Kontrak ini dibuat untuk dipatuhi kedua belah pihak.

Tanda Tangan:
Pihak Perusahaan __________
Pihak Pekerja     __________
";

// Balikin JSON seolah-olah dari AI
echo json_encode([
    'success' => true,
    'draft' => $dummyDraft
]);
