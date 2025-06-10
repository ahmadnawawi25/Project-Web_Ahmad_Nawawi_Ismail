<?php
 
 include("config.php");

 // cek apakah tombol daftar sudah diklik atau belum?
 if(isset($_POST['daftar'])){

    //ambil data dari formulir
    $nama = $_POST['Nama'];
    $alamat = $_POST['Alamat'];
    $jk = $_POST['Jenis_Kelamin'];
    $agama = $_POST['Agama'];
    $sekolah = $_POST['Sekolah_Asal'];

    //buat query untuk simpan data ke tabel
    $sql = "INSERT INTO Calon_Siswa (Nama, Alamat, Jenis_Kelamin, Agama, Sekolah_Asal)
    VALUE ('$nama', '$alamat', '$jk', '$agama', '$sekolah')";
    $query = mysqli_query($koneksi, $sql);

    //apakah query simpan berhasil?
    if($query) {
        //kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: index.php?status=sukses');
    } else {
        //kalau gagal alihkan ke halaman index.php dengan status=gagal
        header('Location: index.php?status=gagal');
    }
 } else {
    die("Akses dilarang...");
}

?>