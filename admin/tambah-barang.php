<?php
    if (isset($_POST['simpan'])) {

        $result = tambah_barang($_POST);

        if ($result > 0) {
            header('Location:home.php?m=barang&p=berhasil');
        } else {
            echo "
                <script>
                    alert('Data Gagal Ditambahkan');
                    document.location.href = 'home.php?m=tambah-barang&p=gagal';
                </script>
            "; 
            // header('Location:home.php?m=tambah-barang&p=gagal'); nggak bisa pake ini, langsung mencalat soale
        }
    }

?>
<form action="" method="post" style="width:700px;" enctype="multipart/form-data" class="mx-auto pt-3">
    <h2 class="text-start">Menambah Produk</h2>
    <hr>
    <?php if (isset($_GET['p'])) {
        pesan($_GET['p']);
    } ?>
    <label for="nama" class="form-label">Nama Produk</label>
    <input type="text" name="nama-barang" id="nama" class="form-control" required>
    <br>
    <label for="gambar" class="form-label">Upload File Gambar Produk</label>
    <input class="form-control" name="gambar" type="file" id="gambar" required>
    <br>
    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required></textarea>
    <br>
    <label for="harga" class="form-label">Harga</label>
    <div class="input-group mb-3">
        <span class="input-group-text">Rp.</span>
        <input type="number" name="harga" id="harga" class="form-control" required>
    </div>
    <label for="stok" class="form-label">Stok</label>
    <input type="number" name="stok" id="stok" class="form-control" required>
    <br>    
    <button class="btn btn-primary me-md-2" type="submit" name="simpan">Tambah</button>
    <a href="home.php?m=barang"><button class="btn btn-outline-dark" type="button" >Batal </button></a>
    <br>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'deskripsi' );
    </script>
</form>