<?php 
    session_start();
    if ($_SESSION["role"] !== "admin") {
        header('Location:../index.php');
    }
    require "../config/fungsi.php";
    if (isset ($_GET['m'])) {
        $menu = $_GET['m'];
    } else {
        header('Location:../index.php');
    }    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

     <!-- Make sure the path to CKEditor is correct. -->
     <script src="../ckeditor/ckeditor.js"></script>

    <style>
        a {
            text-decoration:none;
        }

        .jumbotron {
            background-color: #e9ecef;
            padding : 2rem 1rem;
        }

        .kotak-produk {
            background-color: #FFF;
            margin: 0.5rem 0.5rem;
            width: 170px;
            height: 300px;
            float:left;
        }

        .clear {
            clear: left;
        }
    </style>

    <title>E-Shopindo | Admin</title>
  </head>
  <body style="background-color:#e9ecef;">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#58151c;">
    <div class="container">
        <a class="navbar-brand fs-3" href="?m=start">Admin Mode</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <a class="nav-link <?php if($menu == barang)echo 'active';?>" href="?m=barang">Data Produk</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if($menu == user)echo 'active';?>" href="?m=user">Data User</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if($menu == trans)echo 'active';?>" href="?m=trans">Riwayat Transaksi</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hai <?= $_SESSION["user"]; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Profil</a></li>
                    <?php if($_SESSION["role"] === "admin") {?>
                    <li><a class="dropdown-item" href="../index.php">User page</a></li>
                    <?php }?>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <?php 
        switch ($menu) {
            case 'start':
                include 'start.php';
                break;

            case 'barang':
                include 'barang.php';
                break;     

            case 'tambah-barang':
                include 'tambah-barang.php';
                break;

            case 'edit-barang':
                include 'edit-barang.php';
                break;

            case 'trans':
                include 'trans.php';
                break;

            case 'user':
                include 'user.php';
                break;

            default:
                ?>
                <div class="alert alert-danger container" role="alert">
                    <h4 class="alert-heading">Akses Dilarang</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div>
                <?php
                break;
        }
    
    
    ?>
    <script src="../js/bootstrap.bundle.min.js"></script>

  </body>
</html>