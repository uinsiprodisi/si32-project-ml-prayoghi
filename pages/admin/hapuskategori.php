<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location. login.php");
    exit();
}

include '../../config/koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Query Hapus
    $query = "DELETE FROM kategori_berita WHERE id_kategori = '$id'";
    if(mysqli_query($conn, $query)){
        echo "<script>alert('Kategori berhasil dihapus!'); window.location.href='kategori.php';</script>";
    }
    else {
        echo "<script>alert('Kategori Gagal dihapus!'); window.location.href='kategori.php';</script>" ;
    }
}
else
{
    echo "<script>
        alert('ID tidak ditemukan'); 
        window.location.href='kategori.php';
    </script>";
}
?>