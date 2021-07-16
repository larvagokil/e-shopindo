<?php
    $datas = query("SELECT * FROM barang");

    if (isset($_POST['cari'])) {
        $datas = cari($_POST['kata']);
    }
?>
<div class="container pt-5">
    
    <h3>Menampilkan Semua Produk : </h3>
    <form action="" method="post" >
        <div class="row justify-content-end">
            <div class="col">
                <input type="search" class="form-control" name="kata" autofocus placeholder="Ketik untuk mencari.."  autocomplete="off">
            </div>
            <div class="col">
                <button  type="submit" class="btn btn-outline-secondary" name="cari">Cari</button>
            </div>
        </div>
    </form>
    <hr>
    <br>
    <?php
        foreach ($datas as $data) :
    ?>

    <a href="?m=detail&id=<?= $data['id_barang']; ?>" data-bs-toggle="tooltip" title="<?= $data['nm_barang']?>">
        <div class="kotak-produk shadow border border-5 rounded-3 text-dark">
            <div style="height:170px">
            <img src="<?= "gambar/".$data['gbr_barang'];?>" alt="gambar" width="100%">
            </div>
            <div class="ms-2" style="overflow:hidden;line-height:1em;height:2em;"><?= $data['nm_barang']?></div>
            <strong><p class="ms-2">Rp. <?= number_format($data['hrg_barang'],2,",",".");?></p></strong>
            <div class="badge rounded-pill bg-dark">Stok : <?= $data['jml_barang'];?></div>
        </div> 
    </a>

    <?php endforeach; ?>
    <div class="clear"></div>
</div>