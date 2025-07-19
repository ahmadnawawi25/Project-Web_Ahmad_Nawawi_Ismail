<?php
session_start();
include '../config/db.php';

// Cek apakah sudah login dan role-nya dokter
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dokter') {
    header("Location: ../login.php");
    exit;
}

// Ambil ID dokter dari session
$id_dokter = $_SESSION['id'];

// Query: Ambil data pasien unik yang pernah booking ke dokter ini
$sql = "SELECT DISTINCT p.id, p.nama, p.nik, p.alamat
        FROM booking b
        INNER JOIN pasien p ON b.pasien_id = p.id
        WHERE b.dokter_id = ?
        ORDER BY p.nama ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_dokter);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pasien Saya</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        a.back-link { margin-top: 20px; display: inline-block; }
    </style>
</head>
<body>
    <h2>Daftar Pasien Saya</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Alamat</th>
            </tr>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['nik']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada pasien yang ditemukan.</p>
    <?php endif; ?>

    <a class="back-link" href="dashboard_dokter.php">← Kembali ke Dashboard</a>
</body>
</html>
