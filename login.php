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

    if (isset($_POST['login'])) {
        
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $result = mysqli_query($konek, "SELECT * FROM user WHERE username = '$user'");
        // cek username
        if (mysqli_num_rows($result) === 1) {
            
            // cek passnya
            $rows = mysqli_fetch_assoc($result);
            if (password_verify($pass, $rows['password'])) {
                $_SESSION["login"] = true;
                $_SESSION["user"] = $user;
                $_SESSION["role"] = $rows['role'];
                $_SESSION["id"] = $rows['id_user'];
                header('Location:home.php?m=start');
                exit;
            }
        }

        $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Login</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body    {
            background-image: url("gambar/gambar.png");
        }
    </style>
</head>
<body>
    <div class="border border-3 rounded-3 bg-dark" style="width:450px;margin:40px auto;padding:3rem;color:#fff;">
    <a href="index.php"><img src="gambar/logo.png" class="border border-5 border-danger mx-auto d-block" alt="" width="100px" ></a>
    <h3 class="text-center">Login</h3>
    <br>
    <?php
        if ( isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Username / Password salah !
            </div>
    <?php } ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control bg-dark text-light" placeholder="Masukkan Username anda" autofocus required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control bg-dark text-light" placeholder="Masukkan Password anda" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary float-end" name="login">Login</button>
        <a href="register.php"><button class="btn btn-outline-success" type="button" >Buat Akun</button></a>
    </form>
    </div>
</body>
</html>