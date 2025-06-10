<?php 
include("config.php");

if( isset($_GET['id'])){

    // ambil id dari query string
    $id = $_GET['id'];

    // buat query hapus
    $sql = "delete from calon_siswa where id=$id";
    $query = mysqli_query($koneksi, $sql);

    //apakah query hapus berhasil?
    if($query){
        header('Location: List_calon_siswa.php');
    } else {
        die("gagal menghapus.....");
    }
}else {
    die("akses dilarang...");
}
?>