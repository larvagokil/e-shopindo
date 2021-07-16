<?php
    session_start();
    if ($_SESSION["role"] !== "admin") {
        echo "
                <script>
                    alert('anda ngapain... -_-');
                    document.location.href = '../index.php';
                </script>
            ";
            exit;
    }
    header('Location:home.php?m=barang');
?>