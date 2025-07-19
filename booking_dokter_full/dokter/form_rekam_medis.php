<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dokter') {
    header("Location: ../login_dokter.php");
    exit;
}

$id_dokter = $_SESSION['id'];
$id_pasien = $_GET['id_pasien'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $diagnosa = $_POST['diagnosa'];
    $resep = $_POST['resep'];
    $tanggal = date('Y-m-d');

    $sql = "INSERT INTO rekam_medis (id_pasien, id_dokter, diagnosa, resep, tanggal)
            VALUES ('$id_pasien', '$id_dokter', '$diagnosa', '$resep', '$tanggal')";
    if ($conn->query($sql)) {
        echo "<script>alert('Rekam medis berhasil disimpan'); window.location='daftar_pasien.php';</script>";
    } else {
        echo "Gagal menyimpan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Isi Rekam Medis</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Form Rekam Medis</h2>
    <form method="post">
        <label>Diagnosa:</label><br>
        <textarea name="diagnosa" rows="4" cols="50" required></textarea><br><br>

        <label>Resep Obat:</label><br>
        <textarea name="resep" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Simpan</button>
        <a href="daftar_pasien.php">Kembali</a>
    </form>
</body>
</html>
