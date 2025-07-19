<?php
session_start();
include '../config/db.php';

// Pastikan user sudah login sebagai dokter
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'dokter') {
    echo "Akses ditolak. Silakan login sebagai dokter.";
    exit;
}

$dokter_id = $_SESSION['id'];

$sql = "SELECT * FROM jadwal WHERE id_dokter = $dokter_id";
$result = $conn->query($sql);

// Cek jika query gagal
if (!$result) {
    echo "Gagal mengambil data jadwal: " . $conn->error;
    exit;
}

echo "<h3>Jadwal Praktik Anda</h3><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>" . $row['hari'] . " - " . $row['jam_mulai'] . " s/d " . $row['jam_selesai'] . "</li>";
}
echo "</ul>";
?>
