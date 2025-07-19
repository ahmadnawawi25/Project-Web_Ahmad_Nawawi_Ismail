<?php
session_start();
include '../config/db.php';

// Pastikan hanya pasien yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pasien') {
    header("Location: ../login/login.php");
    exit;
}

$pasien_id = $_SESSION['user_id'];

// Ambil data riwayat booking pasien
$query = "
    SELECT b.*, d.nama AS nama_dokter
    FROM booking b
    JOIN dokter d ON b.dokter_id = d.id
    WHERE b.pasien_id = $pasien_id
    ORDER BY b.tanggal DESC
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f2f2f2;
        }

        h2 {
            color: #333;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #00b894;
            color: #fff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .Menunggu {
            background-color: #fdcb6e;
            color: #000;
        }

        .Diterima {
            background-color: #55efc4;
            color: #000;
        }

        .Ditolak {
            background-color: #ff7675;
            color: #fff;
        }

        a {
            color: #0984e3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<h2>Riwayat Booking Dokter</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Nama Dokter</th>
            <th>Tanggal</th>
            <th>Keluhan</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
            <td><?= htmlspecialchars($row['keluhan']) ?></td>
            <td>
                <span class="status <?= $row['status'] ?>">
                    <?= htmlspecialchars($row['status']) ?>
                </span>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Belum ada riwayat booking.</p>
<?php endif; ?>

<br>
<p><a href="dashboard.php">← Kembali ke Dashboard</a></p>

</body>
</html>