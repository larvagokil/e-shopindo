<?php
   $trans = query("SELECT * FROM transaksi");
   $i = 1
?>
<div class="overflow-auto pt-4 mx-4">
    <table class="table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Trx ID</th>
            <th>Nama Lengkap</th>
            <th>Nama User</th>
            <th>No telp.</th>
            <th>Alamat</th>
            <th>Ekspedisi</th>
            <th>Pembayaran</th>
            <th>Jumlah Barang</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <?php
           foreach ($trans as $tr) {
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $tr['id_transaksi'] ?></td>
            <td><?= $tr['nm_lengkap']; ?></td>
            <td><?= $tr['nm_user']; ?></td>
            <td><?= $tr['no_telp']; ?></td>
            <td><?= $tr['alamat']; ?></td>
            <td><?= $tr['jeniskirim']; ?></td>
            <td><?= $tr['jenisbayar']; ?></td>
            <td><?= $tr['jml_barang'] ?></td>
            <td>Rp.<?= number_format($tr['total_harga'],0,".",","); ?></td>
            <td><?= $tr['status'] ?></td>
            <td style="width:100px"><?= $tr['waktu_transaksi'] ?></td>
            <td>
                <?php
                   if ($tr['status'] == "Menunggu Konfirmasi") {
                ?>
                <a href="proses.php?x=tolak&id=<?= $tr['id_transaksi'] ?>" onclick="return confirm('Apakah anda yakin ingin menolak transaksi ini . ?');"><span class="badge bg-danger">Tolak</span></a>

                <a href="proses.php?x=proses&id=<?= $tr['id_transaksi'] ?>" onclick="return confirm('Apakah anda ingin memproses transaksi ?');"><span class="badge bg-info">Proses</span></a>
                <?php
                   } elseif ($tr['status'] == "Diproses") {
                ?>
                <a href="proses.php?x=selesai&id=<?= $tr['id_transaksi'] ?>" onclick="return confirm('Apakah anda ingin menyelesaikan transaksi ini ?, Pastikan Pelanggan telah menerima barang');"><span class="badge bg-success">Selesaikan</span></a>
                <?php
                   }
                ?>
            </td>
        </tr>
        <?php
           }
        ?>
    </table>
</div>