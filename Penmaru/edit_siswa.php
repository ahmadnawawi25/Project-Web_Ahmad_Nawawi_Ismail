<?php 
include("config.php");

// kalau tidak ada id di query string
if( !isset($_GET['id'])) {
    header('Location: List_calon_siswa.php');
}

//ambil id dari query string
$id = $_GET['id'];

//buat query untukambil data dari database
$sql = "select *from calon_siswa where id=$id";
$query = mysqli_query($koneksi, $sql);
$siswa = mysqli_fetch_assoc($query);

//jika data yang diedit tidak ditemukan
if(mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan...");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulir edit siswa</title>
</head>
<body>
    <header>
        <h3>formulir edit data calon siswa baru</h3>
    </header>

    <form action="proses_edit.php" method="POST">
        <fieldset>
            <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>"/>
        <p>
            <label for="Nama">Nama:</label>
            <input type="text" name="Nama" placeholder="nama lengkap" 
            value="<?php echo $siswa['Nama'] ?>" />
        </p>
        <p>
            <label for="Alamat">alamat:</label>
            <textarea name="Alamat" ><?php echo $siswa['Alamat'] ?></textarea>
        </p>
        <p>
            <label for="Jenis_Kelamin">jenis kelamin:</label>
            <?php $jk = $siswa['Jenis_Kelamin']; ?>
            <label><input type="radio" name="Jenis_Kelamin" value="laki-laki" <?php echo ($jk == 'laki-laki' )? "checked": "" ?>>laki-laki</label>

            <label><input type="radio" name="Jenis_Kelamin" value="perempuan" <?php echo ($jk == 'perempuan' )? "checked": "" ?>>perempuan</label>
        </p>
        <p>
            <label for="Agama">Agama:</label>
            <?php $agama = $siswa['Agama']; ?>
            <select name="Agama">
                <option <?php echo ($agama == 'islam') ? 'selected': "" ?>>islam</option>
                <option <?php echo ($agama == 'kristen') ? 'selected': "" ?>>kristen</option>
                <option <?php echo ($agama == 'hindu') ? 'selected': "" ?>>hindu</option>
                <option <?php echo ($agama == 'budha') ? 'selected': "" ?>>budha</option>
                <option <?php echo ($agama == 'konghucu') ? 'selected': "" ?>>konghucu</option>
            </select>
        </p>
        <p>
            <label for="Sekolah_Asal">sekolah asal:</label>
            <input type="text" name="Sekolah_Asal" placeholder="nama_sekolah"
            value="<?php echo $siswa['Sekolah_Asal'] ?>"/>
        </p>
        <p>
            <input type="submit" value="simpan" name="simpan"/>
        </p>
        </fieldset>
    </form>
</body>
</html>