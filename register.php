<?php
    session_start();

    if (isset($_SESSION["login"])) {
        // if ($_SESSION['role'] === 'admin') {
        //     header('Location:admin/index.php');
        //     exit;
        // }
        header('Location:index.php');
        exit;
    }
    require 'config/fungsi.php';

    if (isset($_POST['register'])) {
        
        if (daftar($_POST) > 0 ) {
            echo "
                <script>
                    alert('User berhasil Didaftarkan');
                    document.location.href = 'login.php';
                </script>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Pendaftaran</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body    {
            background-image: url("gambar/gambar.png");
        }
    </style>
</head>
<body>
    <div class="border border-3 rounded-3 bg-dark" style="width:700px;margin:40px auto;padding:3rem;">
    <h3 class="text-start text-light">Daftar</h3>
    <hr>
    <form action="" method="post" class="text-light">
        <div class="mb-3 bg-dark">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control bg-dark text-light" placeholder="Masukkan Username anda" autofocus required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control bg-dark text-light" placeholder="Masukkan Password anda" required>
        </div>
        <div class="mb-3">
            <label for="password2" class="form-label">Konfirmasi Password</label>
            <input type="password" id="password2" name="password2" class="form-control bg-dark text-light" placeholder="Masukkan Password anda" required>
        </div>
        <br>
        <button type="submit" class="btn btn-success float-end" name="register">Buat Akun</button>
        <a href="login.php"><button class="btn btn-outline-primary" type="button" >Login saja</button></a>
    </form>
    </div>
</body>
</html>