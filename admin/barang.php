<?php
    // menampilkan semua data dari tabel barang
    $datas = query("SELECT * FROM barang ");

    // jika tombol cari ditekan
    if (isset($_POST['cari'])) {
        $datas = cari($_POST['kata']);
    }
?>
<div class="container pt-2 overflow-auto">
    <h2>Data Produk</h2><br>
    <?php if (isset($_GET['p'])) {
        pesan($_GET['p']);
    } ?>    
    <br>
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <a href="home.php?m=tambah-barang" class><button  type="button" class="btn btn-outline-primary">[+] Tambah Barang</button></a>
            </div>
            <div class="col-auto">
                <input type="search" class="form-control" name="kata" autofocus placeholder="Ketik lalu enter untuk mencari.." size="40" autocomplete="off">
            </div>
            <div class="col-auto">
                <button  type="submit" class="btn btn-secondary" name="cari">Cari</button>
            </div>
        </div>
    </form>
    <br>
    <table border=1 class="table table-sm table-bordered">
        <tr class="table-dark">
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Harga Produk</th>
            <th>Stok</th> 
            <th>Opsi</th>           
        </tr>
        <?php
            $k = 1;
            foreach ($datas as $data) :            
        ?>
        <tr>
            <td class="text-center"><?=$k++?></td>
            <td style="width:150px;"><?= $data['nm_barang']; ?></td>
            <td> 
                <img src="../gambar/<?=$data['gbr_barang'];?>" alt="gambar produk" width="170px">
            </td>
            <td>
                <div style="overflow:auto;line-height:1em;height:10em">
                    <?= $data['dkr_barang']; ?>
                </div>
            </td>
            <td>
                <div style="display:inline-block;">
                    Rp. <?= number_format($data['hrg_barang'],2,",","."); ?>
                </div>
            </td>
            <td><?= $data['jml_barang']; ?></td>
            <td>
                <a href="home.php?m=edit-barang&id=<?= $data['id_barang'];?>"><span class="badge bg-primary">Edit</span></a> 
                <a href="hapus-barang.php?id=<?= $data['id_barang'];?>" onclick=" return confirm('Apakah Anda Yakin ?') "><span class="badge bg-danger">Hapus</span></a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>