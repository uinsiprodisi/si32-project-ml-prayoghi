<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data berita berdasarkan id
$berita = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita = '$id'");
$data = mysqli_fetch_assoc($berita);

// Ambil kategori untuk dropdown
$kategori = mysqli_query($conn, "SELECT * FROM kategori_berita");

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $id_kategori = $_POST['id_kategori'];
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];
    $tanggal_update = date("Y-m-d H:i:s"); // Bisa ditambahkan jika ingin

    // Cek apakah ada foto baru
    if ($_FILES['foto_berita']['name'] != "") {
        $foto = $_FILES['foto_berita']['name'];
        $tmp = $_FILES['foto_berita']['tmp_name'];
        $folder = "../../uploads/";
        $foto_baru = uniqid() . "_" . $foto;

        // Hapus foto lama jika ada
        if (file_exists($folder . $data['foto_berita'])) {
            unlink($folder . $data['foto_berita']);
        }

        move_uploaded_file($tmp, $folder . $foto_baru);
    } else {
        $foto_baru = $data['foto_berita']; // tetap gunakan foto lama
    }

    // Update database
    $query = "UPDATE berita SET 
              id_kategori = '$id_kategori',
              judul_berita = '$judul_berita',
              isi_berita = '$isi_berita',
              foto_berita = '$foto_baru'
              WHERE id_berita = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Berita berhasil diperbarui!');
                window.location.href='berita.php';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui berita!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="../../assets/adminStyles.css">
</head>
<body>
    <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">User</a></li>
      <li><a href="berita.php">Berita</a></li>
      <li><a href="#">Galeri</a></li>
      <li><a href="logout.php" class="logout">Logout</a></li>
    </ul>
  </div>


<div class="main-content">
    <header>
      <h1>Edit Berita</h1>
    </header>

    <h2><?= $data['judul_berita']; ?></h2>
    <form action="" method="POST" enctype="multipart/form-data">
        
        <label>Kategori</label><br>
        <select name="id_kategori" required>
            <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                <option value="<?= $row['id_kategori']; ?>" 
                    <?= ($row['id_kategori'] == $data['id_kategori']) ? 'selected' : '' ?>>
                    <?= $row['nama_kategori']; ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Judul Berita</label><br>
        <input type="text" name="judul_berita" value="<?= $data['judul_berita']; ?>" required><br><br>

        <label>Isi Berita</label><br>
        <textarea name="isi_berita" rows="5" required><?= $data['isi_berita']; ?></textarea><br><br>

        <label>Foto Lama</label><br>
        <?php if ($data['foto_berita']) { ?>
            <img src="../../uploads/<?= $data['foto_berita']; ?>" width="120"><br><br>
        <?php } else { ?>
            <p>Tidak ada foto</p>
        <?php } ?>

        <label>Ganti Foto (opsional)</label><br>
        <input type="file" name="foto_berita" accept="image/*"><br><br>

        <button type="submit" name="update">Update Berita</button>
        <a href="berita.php">Kembali</a>
    </form>
</div>

</body>
</html>
