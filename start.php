<div class="jumbotron text-center">
    <img src="gambar/logo.png" class="border border-5 border-dark mb-3" alt="" width="150px">
  <h1 class="display-4">E-Shopindo</h1>
  <p class="lead">Temukan Produk Elektronik, Gadget, Peralatan Olahraga, Peralatan Rumah Tangga, Otomotif dan lainnya disini ..</p>
  <hr class="my-4">
  <?php if (!isset($_SESSION["login"])) { ?>
  <p>Belum punya Akun..?, Daftar Sekarang..!</p>
  <a class="btn btn-primary btn-lg" href="register.php" role="button" data-bs-toggle="tooltip" title="Daftar Disini">Daftar</a>
  <?php } ?>
  
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9ecef" fill-opacity="1" d="M0,96L34.3,90.7C68.6,85,137,75,206,69.3C274.3,64,343,64,411,90.7C480,117,549,171,617,186.7C685.7,203,754,181,823,154.7C891.4,128,960,96,1029,112C1097.1,128,1166,192,1234,229.3C1302.9,267,1371,277,1406,282.7L1440,288L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path></svg>
