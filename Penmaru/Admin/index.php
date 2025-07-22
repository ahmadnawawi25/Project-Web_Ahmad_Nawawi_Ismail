<?php 
session_start();
if (!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
}

include '../koneksi/config.php';

$total = $koneksi ->query("SELECT COUNT(*) AS total from calon_siswa")->fetch_assoc()['total'];
$laki = $koneksi ->query("SELECT COUNT(*)AS total from calon_siswa where Jenis_Kelamin='laki-laki'")->fetch_assoc()['total'];
$perempuan = $koneksi ->query("SELECT COUNT(*)AS total from calon_siswa where Jenis_Kelamin='perempuan'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css?=<?= time(); ?>">
</head>
<body>
    <header>
        <h3>Dashboard Admin</h3>
        <h2>SMK PUTERA BATAM</h2>
    </header>

    <!-- sidebar -->
     <div class="sidebar">
        <ul>
            <li><a href="from-daftar.php">Daftar Baru</a></li>
            <li><a href="List_Calon_Siswa.php">Pendaftaran</a></li>
            <br><br>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
     </div>

     <!-- konten utama-->
      <div class="main-content">
        <header>
            <div class="stats-container">
                <div class="stat-card bg-blue">
                    <div class="stat-icon">
                        <img src="../img/statistik.png" alt="Chart Icon" width="40"
                        height="40">
                    </div>
                    <div class="stat-content">
                        <h3>pendaftar laki-laki</h3>
                        <p><?= $laki ?></p>
                    </div>
                    <div class="stat-card bg-pink">
                        <div class="stat-icon">
                            <img src="../img/wanita.png" alt="Female Icon" width="40" height="40">
                        </div>
                        <div class="stat-content">
                            <h3>pendaftar perempuan</h3>
                            <p><?= $perempuan ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php if(isset($_GET['status'])): ?>
            <p class="<?= $_GET['status'] == 'sukses' ? 'success' : 'error' ?>">
                <?= $_GET['status'] == 'sukses' ? 'pendaftaran siswa baru berhasil'
                : 'pendaftarn gagal' ?>
            </p>
        <?php endif; ?>
      </div>
</body>
</html>