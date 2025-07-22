<?php 
include '../koneksi/config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru</title>
</head>
<body>
    <header>
        <h3> Siswa yang sudah mendaftar</h3>
    </header>

    <nav>
        <a href="form-daftar.php">[+] Tambah Baru</a>
    </nav>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Sekolah Asal</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            $sql = "select*from calon_siswa";
            $query = mysqli_query($koneksi, $sql);

            while($siswa = mysqli_fetch_array($query)) {
                 echo "<tr>";

                 echo "<td>" .$siswa['id']. "</td>";
                 echo "<td>" .$siswa['Nama']. "</td>";
                 echo "<td>" .$siswa['Alamat']. "</td>";
                 echo "<td>" .$siswa['Jenis_Kelamin']. "</td>";
                 echo "<td>" .$siswa['Agama']. "</td>";
                 echo "<td>" .$siswa['Sekolah_Asal']. "</td>";

                 echo "<td>";
                 echo "<a href='edit_siswa.php?id=".$siswa['id']."'>edit</a> |";
                 echo "<a href='hapus.php?id=".$siswa['id']."'>hapus</a>";
                 echo "</td>";

                 echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <p>total: <?php echo mysqli_num_rows($query) ?></p>
</body>
</html>