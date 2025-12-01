<?php include 'includes/visitor/meta.php'; ?>
<?php include 'includes/visitor/header.php'; ?>
<?php
include 'config/koneksi.php';
    if (!isset($_GET['id'])){
        echo "<script>
        alert('Berita tidak ditemukan');
        window.location.href='index.php';
        </script>";
    }

    $id = $_GET['id'];
    $query = "SELECT berita.*, kategori_berita.nama_kategori 
                FROM berita
                LEFT JOIN kategori_berita ON berita.id_kategori = kategori_berita.id_kategori
                WHERE berita.id_berita = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
?>

<section class="detail-berita">
    <h1><?= $row['judul_berita'] ?></h1>
    <small><i><?= date("d M Y", strtotime($row['tanggal_berita'])) ?> - <?= $row['nama_kategori'] ?></i></small>
    <img src="uploads/<?= $row['gambar_berita'] ?>" class="gambar-detail" alt="">
    <p>
        <?= nl2br($row['isi_berita']); ?>
    </p>
</section>

<?php include 'includes/visitor/footer.php'; ?>
