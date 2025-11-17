<?php 
session_start();
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login Admin</h2>

    <?php
    if(isset($_POST['login'])){
        $input = $_POST['username'];
        $password = $_POST['password'];

        // cek username atau email
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM users WHERE email='$input'";
        }
        else{
            $query = "SELECT *FROM users WHERE username='$input'";
        }
        $result = mysqli_query($conn, $query);

        // proses validasi
        if(mysqli_num_rows($result) >0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])) {
                // Simpan Session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];

                // arahkan ke dashboard admin
                header("Location: dashboard.php");
                exit();
            } else{
                echo "<p style='color:red'>Password Salah</p>";
            }
        }
        else{
            echo "<p style='color:red'>Username Tidak ditemukan</p>";
        }
    }
     ?>
    <form method="post" action="">
        <label>Username / Email</label> <br>
        <input type="text" name="username" placeholder="Masukkan Username/Password" required>

        <br> <br>

        <label>Password</label> <br>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>