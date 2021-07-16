<?php
    ini_set('date.timezone', 'Asia/Jakarta');
    $konek = mysqli_connect("localhost", "root", "", "toko1");

    // fungsi ambil data dari database
    function query($query) {
        global $konek;

        $result = mysqli_query($konek, $query);
        $rows = []; // penampung 
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function cekdata($id) {
        global $konek;

        $kue = mysqli_query($konek, "SELECT id_barang FROM barang WHERE id_barang = $id");

        return mysqli_num_rows($kue);
    }

    function tambah_barang ($data) {
        global $konek;
       
        $nama   = $data['nama-barang'];
        $des    = $data['deskripsi'];
        $hrg    = $data['harga'];
        $jml    = $data['stok'];

        $gbr = upload();

        // jika nggak ngupload gambar batalkan
        if (!$gbr) {
            return false;
        }

        $query  = "INSERT INTO barang 
                    VALUES
                    ('','$nama','$gbr','$des','$hrg','$jml')";

        mysqli_query($konek, $query);

        return mysqli_affected_rows($konek);

    }

    function upload() {

        $namafile = $_FILES['gambar']['name'];
        $ukuranfile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpname = $_FILES['gambar']['tmp_name'];

        // pengecekan apa sudah upload gambar
        if ($error === 4) {
            echo "
                <script>
                    alert('Silahkan pilih gambar terlebih dahulu');
                </script>
            ";
            return false;
        }

        // cek apakah ekstensinya bener gambar .. ?
        $ekstensivalid = ['jpg', 'jpeg', 'png'];
        $ekstensi = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

        if ( !in_array($ekstensi, $ekstensivalid)) {
            echo "
                <script>
                    alert('Silahkan Upload dengan format file gambar yang sesuai ( jpg / jpeg / png )');
                </script>
            ";
            return false;
        }

        // cek ukuran filenya tidak lebih dari 2 MB

        if ($ukuranfile > 2000000) {
            echo "
                <script>
                    alert('Ukuran file terlalu besar !, Maksimal ukuran 2MB !');
                </script>
            ";
            return false;
        }

        // jika aman 
        // generate nama baru untuk file
        $namafilebr = uniqid();
        $namafilebr .= '.';
        $namafilebr .= $ekstensi;

        move_uploaded_file($tmpname, '../gambar/'. $namafilebr);

        return $namafilebr;

    }

    function hapus($id) {
        global $konek;
        mysqli_query($konek, "DELETE FROM barang WHERE id_barang = $id");
        return mysqli_affected_rows($konek);
    }

    function ubah_barang($data) {
        global $konek;

        $id     = $data['id'];
        $nama   = $data['nama-barang'];
        $des    = $data['deskripsi'];
        $hrg    = $data['harga'];
        $jml    = $data['stok'];
        $gbrlama = $data['gambarlama'];

        if ($_FILES['gambar']['error'] === 4) {
            $gbr = $gbrlama;
        } else {
            $gbr = upload();
        }
        
        if (!$gbr) {
            return false;
        }

        $query  = "UPDATE barang SET
                    id_barang = '$id',
                    nm_barang = '$nama',
                    gbr_barang = '$gbr',
                    dkr_barang = '$des',
                    hrg_barang = '$hrg',
                    jml_barang = '$jml' 
                    WHERE id_barang = '$id'
                    ";

        mysqli_query($konek, $query);

        return mysqli_affected_rows($konek);

    }


    function cari($kata) {
        $query = "SELECT * FROM barang
                    WHERE
                nm_barang LIKE '%$kata%' OR
                dkr_barang LIKE '%$kata%'
                ";
        return query($query);
    }

    function daftar($akun) {
        global $konek;

        $user = strtolower($akun['username']);
        $pass = mysqli_real_escape_string($konek, $akun['password']);
        $pass2 = mysqli_real_escape_string($konek, $akun['password2']);

        // ngecek kesamaan password
        if ($pass !== $pass2) {
            echo "
                <script>
                    alert('Konfirmasi Password tidak sesuai');
                </script>
            ";
            return false;
        }

        // cek user ada / belum
        $result = mysqli_query($konek, "SELECT username FROM user WHERE username = '$user'");
        if (mysqli_num_rows($result) !== 0) {
            echo "
                <script>
                    alert('Username yang di pilih sudah terdaftar');
                </script>
            ";
            return false;
        }

        // enkrip pass
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        // proses tambah user ke db
        mysqli_query($konek, "INSERT INTO user VALUES ('','$user','$pass','user')");

        return mysqli_affected_rows($konek);
        
    }

    function bayar($bayar) {
        global $konek;

        $nmleng     = htmlspecialchars($_POST['namalengkap']);
        $nmuser     = $_POST['user'];
        $notelp     = $_POST['nomortelp'];
        $alamat     = htmlspecialchars($_POST['alamat']);
        $jk         = htmlspecialchars($_POST['jeniskirim']);
        $jb         = htmlspecialchars($_POST['jenisbayar']);
        $idbarang   = $_POST['id'];
        $jml        = $_POST['jumlah'];
        $total      = $_POST['total'];

        // ngambil nama barang
        $waktu      = date('Y-m-d H:i:s');
        $id_trans   = "ESI-";
        $id_trans   .= date('YmdHis');

        // insert data ketrans
        $kue = "INSERT INTO transaksi VALUES ('$id_trans','$nmleng','$nmuser','$notelp','$alamat','$jk','$jb','$idbarang','$jml','$total','Menunggu Konfirmasi','$waktu')";
        $insert = mysqli_query($konek, $kue);
        // cek apakah berhasil insert 
        if (mysqli_affected_rows($konek) < 1 ) {
            echo "
                <script>
                    alert('Gagal memproses data ke server');
                </script>
            ";
            return false;
        }
        // mengubah stok barang
        $ubah = query("SELECT * FROM barang WHERE id_barang = $idbarang")[0];
        $diubah = $ubah['jml_barang'];
        $diubah -= $jml;
        mysqli_query($konek, "UPDATE barang SET jml_barang = '$diubah' WHERE id_barang = $idbarang");

        return mysqli_affected_rows($konek);
    }

    function pstatus($p) {
        switch ($p) {
            case 'Menunggu Konfirmasi':
                echo "bg-info";

                break;

            case 'Diproses':
                echo "bg-primary";

                break;

            case 'Selesai':
                echo "bg-success";

                break;
        
            case 'Gagal':
                echo "bg-danger";

                break;
        }
    }

    //awal fungsi pesan
    function pesan ($pesan) {
        switch ($pesan) {
            case 'berhasil':
?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> | Proses penambahan data berhasil
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php
                break;
            
            case 'gagal':
?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal</strong> | Proses penambahan data tidak berhasil
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php
                break;

            case 'berhasil-edit':
?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> | Proses Pengubahan data berhasil
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php
                break;
            
            default:
                //code
                break;
        }
    }
    // akhir fungsi pesan

?>