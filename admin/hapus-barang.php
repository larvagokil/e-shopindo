<?php
    require "../config/fungsi.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (hapus($id) > 0 ) {
            echo "
                <script>
                    alert('Data Berhasil Dihapus !');
                    document.location.href = 'home.php?m=barang';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Tidak Berhasil Dihapus !');
                    document.location.href = 'home.php?m=barang';
                </script>
            ";
        }
    } else {
        echo "
                <script>
                    alert('Anda ngapain....!');
                    document.location.href = 'home.php?m=barang';
                </script>
        ";
    }
?>