<?php include 'includes/visitor/meta.php'; ?>
<?php include 'includes/visitor/header.php'; ?>
 
<section>
  
<h2>Selamat Datang!</h2>
<?php
$nama = "Mahasiswa SI";
$jurusan = "Sistem Informasi";
$hobi = ["Membaca", "Desain", "Coding"];

echo "Nama: $nama <br>";
echo "Jurusan: $jurusan <br>";
echo "Hobi:<br>";
echo "<ul>";
foreach ($hobi as $item) {
    echo "<li>$item</li>";
}
echo "</ul>";
?>

<?php 
$namas = "Mahasiwa S1";
$jurusans = "Sistem Informasi";
$hobis = ["Membaca", "Desain", "Coding"];
?>

Nama: <?php echo $namas ?> <br>
Jurusan: <?php echo $jurusans ?> <br>
Hobi:
<ul>
    
<?php foreach ($hobis as $key => $value): ?>
    <li><?php echo $value; ?></li>
<?php endforeach ?>   
</ul>

<?php 
$json = file_get_contents('https://gist.githubusercontent.com/ihgoyarp/2fe9a3f88a9812fedea05139865a12bf/raw/0ce5b5235e49c26b64c780c8fcf6c4adcea9ce38/SI32_PWD_2025');
$data = json_decode($json, true);
?>
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
    </tr>
<?php foreach ($data as $key => $value): ?>
    <tr>
        <td><?php echo $value['no'] ?></td>
        <td><?php echo $value['nama'] ?></td>
        <td><?php echo $value['nim'] ?></td>
    </tr>
<?php endforeach ?>

</table>

<!-- time_sleep_until -->

 </section>

<?php include 'includes/visitor/footer.php'; ?>
