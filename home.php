<?php 
    session_start();
    require "config/fungsi.php";
    $menu = $_GET['m'];  
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

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

    <title>E-Shopindo</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#686de0;">
    <div class="container">
        <a class="navbar-brand fs-3" href="?m=start">E-Shopindo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <a class="nav-link <?php if($menu == 'start')echo 'active';?>" href="?m=start">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if($menu == 'barang' || $menu =='detail')echo 'active';?>" href="?m=barang">Produk</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if($menu == 'datatrans')echo 'active';?>" href="?m=datatrans">Daftar Transaksi</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if($menu == 'about')echo 'active';?>" href="?m=about">About Us</a>
            </li>
            
            <?php
                if (!isset($_SESSION["login"])) {?>
            <li class="nav-item">
            <a class="nav-link" href="login.php">Masuk / Daftar</a>
            </li>
            <?php }?>
            <?php
                if (isset($_SESSION["login"])) {?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hai <?= $_SESSION["user"]; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if($_SESSION["role"] === "admin") {?>
                    <li><a class="dropdown-item" href="admin/index.php">Admin page</a></li>
                    <?php }?>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
            <?php }?>
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

            case 'about':
                include 'about.php';
                break;

            case 'detail':
                include 'detail-barang.php';
                break;
            
            case 'trans':
                include 'trans.php';
                break;                
                
            case 'datatrans':
                include 'data-trans.php';
                break;

            default:
                ?>
                <div class="alert alert-danger container mt-4" role="alert">
                    <h4 class="alert-heading">Akses Dilarang</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div>
                <?php
                break;
        }
    
    
    ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <div class="container-fluid pt-4">
        <p class="text-center small">© 2021 E-Shopindo Technologies | Kelompok 1[17.4B.11]</p>
    </div>
  </body>
</html>