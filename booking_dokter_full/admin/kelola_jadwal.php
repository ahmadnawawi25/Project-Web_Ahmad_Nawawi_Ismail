<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Proses validasi booking
if (isset($_GET['status']) && isset($_GET['id'])) {
    $status = $conn->real_escape_string($_GET['status']);
    $id = intval($_GET['id']);
    $conn->query("UPDATE booking SET status='$status' WHERE id='$id'");
}

// Ambil semua booking
$query = "
    SELECT b.*, u.username, d.nama AS nama_dokter 
    FROM booking b
    JOIN users u ON b.pasien_id = u.id
    JOIN dokter d ON b.dokter_id = d.id
    ORDER BY b.tanggal DESC
";
$bookings = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Booking Pasien</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2d3436;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #dcdde1;
            text-align: center;
        }

        th {
            background-color: #f1f2f6;
            color: #2d3436;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status {
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-block;
        }

        .Diterima { color: #2ecc71; }
        .Ditolak { color: #e74c3c; }
        .Menunggu { color: #f1c40f; }

        .action-btn {
            text-decoration: none;
            padding: 8px 12px;
            margin: 2px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-accept {
            background-color: #00b894;
            color: white;
        }

        .btn-decline {
            background-color: #d63031;
            color: white;
        }

        .btn-accept:hover { background-color: #019875; }
        .btn-decline:hover { background-color: #e17055; }

        .back {
            margin-top: 30px;
            text-align: center;
        }

        .back a {
            color: #636e72;
            text-decoration: none;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Validasi Booking Pasien</h2>

    <table>
        <thead>
            <tr>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $bookings->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                    <td><?= htmlspecialchars($row['keluhan']) ?></td>
                    <td><span class="status <?= htmlspecialchars($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                    <td>
                        <a href="?id=<?= $row['id'] ?>&status=Diterima" class="action-btn btn-accept">✔ Terima</a>
                        <a href="?id=<?= $row['id'] ?>&status=Ditolak" class="action-btn btn-decline">✘ Tolak</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="back">
        <p><a href="dashboard.php">← Kembali ke Dashboard</a></p>
    </div>
</div>

</body>
</html>
