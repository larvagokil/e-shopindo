<?php
session_start();
require '../config/fungsi.php';

if (!isset($_SESSION['login'])) {
    header('Location:../index.php');
    exit;
}elseif ($_SESSION['role'] !== 'admin') {
    header('Location:../index.php');
    exit;
}

   if (isset($_GET['x'])) {
       $x = $_GET['x'];
       if (isset($_GET['id'])) {
           $id = $_GET['id'];
        //    ambil id barang, buat jaga jaga mengembalikan stok semula
           $idb = query("SELECT id_barang FROM transaksi WHERE id_transaksi = '$id'")[0]['id_barang'];
           $jml = query("SELECT jml_barang FROM transaksi WHERE id_transaksi = '$id'")[0]['jml_barang'];

           switch ($x) {
               case 'tolak':
                $ubah = query("SELECT * FROM barang WHERE id_barang = $idb")[0]['jml_barang'];
                // ubah stok menjadi semula
                $ubah += $jml;
                mysqli_query($konek, "UPDATE barang SET jml_barang = '$ubah' WHERE id_barang = $idb");

                // baru update status jadi gagal
                   mysqli_query($konek, "UPDATE transaksi SET `status` = 'Gagal' WHERE id_transaksi = '$id'");
                   header('Location:home.php?m=trans');
                   break;

               case 'proses':
                   mysqli_query($konek, "UPDATE transaksi SET `status` = 'Diproses' WHERE id_transaksi = '$id'");
                   header('Location:home.php?m=trans');
                   break;

               case 'selesai':
                   mysqli_query($konek, "UPDATE transaksi SET `status` = 'Selesai' WHERE id_transaksi = '$id'");
                   header('Location:home.php?m=trans');
                   break;

               default:
                   echo "
                        <script>
                            alert('Tidak ada Perintah !');
                            document.location.href = 'home.php?m=trans';
                        </script>
                   ";
                   break;
           }
       }
       echo "
            <script>
                alert('Tidak ada id !');
                document.location.href = 'home.php?m=trans';
            </script>
        ";
   }
        echo "
            <script>
                alert('Tidak ada Perintah !');
                document.location.href = 'home.php?m=trans';
            </script>
        ";
?>