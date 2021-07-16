<?php
    if (isset($_POST['simpan'])) {

        $result = ubah_barang($_POST);

        if ($result > 0) {
            header('Location:home.php?m=barang&p=berhasil-edit');
        } else {
            echo "
                <script>
                    alert('Data Gagal Diubah');
                    // document.location.href = 'home.php?m=barang&p=gagal';
                </script>
            "; 
            // header('Location:home.php?m=tambah-barang&p=gagal'); nggak bisa pake ini, langsung mencalat soale
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $datas = query("SELECT * FROM barang WHERE id_barang = $id")[0];
        // var_dump($datas); die;
    }
?>
<form action="" method="post" enctype="multipart/form-data" class="container mx-auto pt-3 overflow-auto">
    <h2 class="text-start">Mengubah Produk</h2>
    <hr>
    <?php if (isset($_GET['p'])) {
        pesan($_GET['p']);
    } ?>
    <input type="hidden" name="id" value="<?=$datas['id_barang'] ?>">
    <input type="hidden" name="gambarlama" value="<?=$datas['gbr_barang'] ?>">
    <label for="nama" class="form-label">Nama Produk</label>
    <input type="text" name="nama-barang" id="nama" class="form-control" value="<?=$datas['nm_barang'] ?>" required>
    <br>
    <img src="../gambar/<?=$datas['gbr_barang'];?>" alt="gambar produk" width="170px">
    <br><br>
    <label for="gambar" class="form-label">Masukan File Gambar Produk</label>
    <input class="form-control" name="gambar" type="file" id="gambar" >
    <br>
    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required><?=$datas['dkr_barang'] ?></textarea>
    <br>
    <label for="harga" class="form-label">Harga</label>
    <div class="input-group mb-3">
        <span class="input-group-text">Rp.</span>
        <input type="number" name="harga" id="harga" class="form-control" value="<?=$datas['hrg_barang'] ?>" required>
    </div>
    <label for="stok" class="form-label">Stok</label>
    <input type="number" name="stok" id="stok" class="form-control" value="<?=$datas['jml_barang'] ?>" required>
    <br>    
    <button class="btn btn-primary me-md-2" type="submit" name="simpan">Simpan</button>
    <a href="home.php?m=barang"><button class="btn btn-outline-dark" type="button" >Batal </button></a>
    <br>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'deskripsi' );
    </script>
</form>