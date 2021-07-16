<?php
    if (!isset($_GET['id'])) {
        echo "
            <script>
                alert('id barang tidak ada');
            </script>
        ";
    }
    $idbar = $_GET['id'];
    if (cekdata($idbar) !== 1) {      
        echo "
            <script>
                alert('Barang Tidak ada di database');
                document.location.href = '?m=barang';
            </script>
        "; exit;
    }
    $datas = query("SELECT * FROM barang WHERE id_barang = '$idbar'")[0];
    
    if ($datas['jml_barang'] < 1) {
        $stokabis = true;
    }
?>
<div class="container border border-4 border-dark" style="margin-top:10px;padding:1rem;" >
    <div class="row" style="height:auto">
        <div class="col-auto overflow-auto">
            <img src="<?= "gambar/".$datas['gbr_barang'];?>" alt="gambar" width="500px" >       
        </div>  
        <div class="col pt-2" >
            <?php
               if (isset($stokabis)) {
            ?>
                <div class="alert alert-warning  fade show" role="alert">
                    <strong>Stok Habis</strong><br> Barang sedang kosong, Silahkan pilih barang yang lain
                </div>
            <?php }?>
            <h4><?= $datas['nm_barang']; ?></h4>
            <p>Terjual : 5 | Ulasan : 5.0 (3 Ulasan)</p>
            <h3><p class="ms-2">Rp<?= number_format($datas['hrg_barang'],0,",",".");?></p></h3>
            Stok : <b><?= $datas['jml_barang']; ?></b>
            <form action="?m=trans" method="post">
            <div class="row g-2 mt-1">
                <div class="col-sm-2">
                    <input type="hidden" name="id" value="<?= $datas['id_barang']; ?>">
                    <input type="number" name="jumlah" class="form-control" min="1" max="<?= $datas['jml_barang']; ?>" value="1">    
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-outline-dark " type="submit" name="beli" <?php
                       if(isset($stokabis)) {echo "disabled";}
                    ?>>Beli </button>
                </div>
            </div>
            </form>
                <hr> 
            <div class="col overflow-auto" style="height:300px">
                <p class="ms-2" > Deskripsi</p>     
                <hr>
                <?= $datas['dkr_barang']; ?>
            </div>
        </div>
    </div>
</div>