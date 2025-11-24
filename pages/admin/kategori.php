<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
$kategori = "SELECT * FROM kategori_berita";
$tampilkategori = mysqli_query($conn, $kategori);
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../../assets/css/adminStyles.css">
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
        <a href="tambahkategori.php">tambah Kategori</a>
    </header>

    <section>
       <div class="card">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
                <?php 
                $no = 1; 
                while ($row = mysqli_fetch_assoc($tampilkategori)){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama_kategori']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="editkategori.php?id=<?php echo $row['id_kategori']; ?>">EDIT</a> |
                        <a href="hapuskategori.php?id=<?php echo $row['id_kategori']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">HAPUS</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
       </div>
    </section>
  </div>

</body>
</html>
