<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'dokter') {
    echo "Akses ditolak.";
    exit;
}

echo "<h2>Selamat datang, dr. " . htmlspecialchars($_SESSION['username']) . "</h2>";
echo "<ul>
    <li><a href='jadwal_saya.php'>Lihat Jadwal Saya</a></li>
    <a href='daftar_pasien.php'>Lihat Semua Pasien Saya</a>
    <li><a href='form_rekam_medis.php'>Input Rekam Medis</a></li>
    <li><a href='../login/logout_dokter.php'>Logout</a></li>
</ul>";
?>
