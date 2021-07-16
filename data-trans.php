<?php
    if (!isset($_SESSION['user'])) {
        echo "
            <script>
                alert('Anda harus login untuk melihat halaman ini');
                document.location.href = '?m=barang';
            </script>
        ";
        exit;
    }
    $user = $_SESSION['user'];
    $trx = query("SELECT * FROM transaksi WHERE nm_user = '$user'");
    if (mysqli_num_rows(mysqli_query($konek,"SELECT * FROM transaksi WHERE nm_user = '$user'")) < 1) {
        echo "
            <script>
                alert('Daftar Riwayat Transaksi anda kosong, Silahkan Membeli barang dahulu ....');
                document.location.href = '?m=barang';
            </script>
        ";
        exit;
    }
?>
<div class="container pt-2">
    <h3>Daftar Riwayat Transaksi</h3>
    <div class="row">
        <?php
           foreach ($trx as $tr) {
        ?>
        <div class="col-md-4 mb-4 pt-3">
            <div class="card">
                <div class="card-body">
                    <h5>No. Trx : <?= $tr['id_transaksi']; ?></h5>
                    <p class="pt-0">Nama Penerima : <?= $tr['nm_lengkap'] ?></p>
                    <?php
                        $idb = $tr['id_barang'];
                       $q = query("SELECT nm_barang FROM barang WHERE id_barang = $idb")[0]['nm_barang'];
                    ?>
                    <p><?= $q ?></p>
                    <p>Jumlah : <?= $tr['jml_barang']; ?> pcs</p>
                    <p>Total Harga : <strong> Rp <?= number_format($tr['total_harga'],0,",",".") ?></strong></p>
                    <hr>
                    <p>Status : <span class="badge <?= pstatus($tr['status']); ?>"><?= $tr['status'] ?></span></p>
                </div>
            </div>    
        </div>
        <?php
           }
        ?>
    </div>
    <p><small>
        Note : 
        <ul>
            <li>
                <span class="badge bg-info">Menunggu Konfirmasi</span> : Menunggu Admin untuk memproses Transaksi.
            </li>
            <li>
                <span class="badge bg-primary">Diproses</span> : Transaksi telah di Konfirmasi & Barang akan dikirim ke alamat yang telah ditentukan sebelumnya.
            </li>
            <li>
                <span class="badge bg-success">Selesai</span> : Transaksi Telah selesai.
            </li>
            <li>
                <span class="badge bg-danger">Gagal</span> : Transaksi telah di Tolak, Karena (Alamat tidak benar / No telepon tidak bisa dihubungi / lainnya)
            </li>
        </ul>
    </small></p>
</div>