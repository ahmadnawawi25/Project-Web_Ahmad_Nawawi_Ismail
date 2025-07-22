<?php
include '../koneksi/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> formulir Pendaftaran siswa baru</title>
</head>
<body>
    <header>
        <h3>Formulir Pendaftaran Siswa Baru</h3>
    </header>

    <form action="proses-pendaftaran.php" method="POST">
        <fieldset>
        <p>
            <label for="Nama">Nama: </label>
            <input type="text" name="Nama" placeholder="nama lengkap"/>
        </p>
        <p>
            <label for="Alamat">Alamat: </label>
            <textarea name="Alamat"></textarea>
        </p>                            
        <p>
            <label for="Jenis_Kelamin">Jenis Kelamin: </label>
            <label><input type="radio" name="Jenis_Kelamin" value="laki-laki"> laki-laki</label>
            <label><input type="radio" name="Jenis_Kelamin" value="perempuan"> perempuan</label>
        </p>
        <p>
            <label for="Agama">Agama: </label>                                                                                                          
            <select name="Agama">   
                <option>Islam</option>
                <option>Kristen</option>
                <option>Hindu</option>
                <option>Budha</option>
                <option>Konghucu</option>
            </select>
        </p>
        <p>
            <label for="Sekolah_Asal">sekolah asal: </label>
            <input type="text" name="Sekolah_Asal" placeholder="nama sekolah" />
        </p>
        <p>
            <input type="submit" value="Daftar" name="daftar" />
        </p>

        </fieldset>
    </form>
</body>
</html>