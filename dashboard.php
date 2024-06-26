<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
include "config.php";

// require_once("config.php");

if (isset($_POST['pesan'])) {
   $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
   $hp = filter_input(INPUT_POST, 'hp', FILTER_SANITIZE_STRING);
   $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
   $jam = filter_input(INPUT_POST, 'jam', FILTER_SANITIZE_STRING);
   $tanggal = filter_input(INPUT_POST, 'tanggal', FILTER_SANITIZE_STRING);
   $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING);
   $mysqli ="INSERT INTO pesanan (nama,no_hp,alamat,jam,tanggal,service) VALUES (?,?,?,jam,,)";


   $query    = "INSERT INTO pesanan (nama,  no_hp, alamat , jam, tanggal, service) VALUES ('$nama', '$hp', '$alamat', '$jam', '$tanggal', '$service')";
   $result   = mysqli_query($connect, $query);
   if ($result) {
    header('location:dashboard.php');
    } else {
        echo ("<script>console.log('gagal');</script>");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | Diha Barbershop</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" /> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <style>
    html {scroll-behavior: smooth;}
    body {
  font-family: Montserrat, sans-serif;
  margin:0;
  padding:0;
  background: #120403;
}
  body:before {
    content: "";
    background-color: black;
    background-size: cover;
    position: absolute;
    height:100%;
    width:100%;
    z-index: -1;
    filter: grayscale(100%);
    -webkit-filter: grayscale(90%);
  }
    .main-footer {
      background: black;
      border-top: 0;
    }

    .main-header{
      background: black;
      border-bottom: 0;
    }
    .brand-text{
      color:white;
    }
    .navbar-light .navbar-nav .nav-link {
    color: white;
    }
    .navbar-light .navbar-nav .nav-link:hover {
    color: #ce9c6b;
    }
    .card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
    }
    .potongan {
      margin-top : 100px;
    }
    .foto {
      position: relative;
    }
    .judul-model{
      text-align: center;
      margin-bottom: 50px;
      color: #ce9c6b;
    }
    .tentang-kami{
      margin : 30px;
      color: #ce9c6b;
    }
    .judul-kami{
      text-align: center;
      margin-bottom: 50px;
      margin-top : 100px;
      color: #ce9c6b;
    }
    .pesan{
      margin: 100px;
      color: white;
    }
    .grid-container {
      display: grid;
      grid-template-columns: auto auto;
      padding: 10px;
      gap: 10px;
      grid-auto-rows: minmax(100px, auto);
    }
    .grid-item {
      border: 1px solid rgba(0, 0, 0, 0.8);
      margin: 0 0 0 90px;
      text-align: left;
    }
    .contact{
      color: white;
    }
    .info{
      color: #ce9c6b;
    }
    .btn-primary {
      background: #ce9c6b;
      border-color: #ce9c6b;
      border-radius: 5px;
    }
    .btn-primary:hover{
      background: transparent;
      color: #ce9c6b;
      border-color: #ce9c6b;
    }
    div {
      text-align: justify;
      text-justify: inter-word;
    }
    .detail_pemesanan{
      /* padding-left: 7px; */
    }
    .gambar-bulat{
    width: 200px;
    height: 200px;
    border-radius: 50%;
    overflow: hidden;
    }
    .ser{
      text-align: center;
      color: #ce9c6b;
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">

<?php
    $dataRaw = mysqli_query($connect, "SELECT * FROM users WHERE username='$_SESSION[username]'");
    $data = mysqli_fetch_array($dataRaw);
?>
<div class="container-nav" id="nav">
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-light navbar-white fixed-top" >
    <div class="container navv">
      <a href="#" class="navbar-brand">
        <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Diha Barbershop</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#nav" class="nav-link">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="#tentang-kami" class="nav-link">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="nav-link">Contact Us</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Menu</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#pesan" class="dropdown-item" class="nav-link">Pesan</a></li>
              <li><a href="#potongan" class="dropdown-item" class="nav-link">Tren Rambut</a></li>
              <li><a href="product.php" class="dropdown-item" class="nav-link">Produk</a></li>

            </ul>
          </li>
          <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Order</a></li>
            <li><a class="dropdown-item" href="#">Price List</a></li>
            <li><a class="dropdown-item" href="#">Cut Trend</a></li>
          </ul>
        </li> -->
        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        
        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  </div>
  
  <!-- Content Wrapper. Contains page content -->


</div>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 h-50" src="assets/img/foto-awal-diha-1.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>My Caption Title (1st Image)</h5>
                <p>The whole caption will only show up if the screen is at least medium size.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 h-50" src="assets/img/foto-awal-diha- 2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 h-50" src="assets/img/foto-awal-diha-3.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
  </div>
<div class="container potongan" id="potongan">
  <h1 class="judul-model">TREN RAMBUT</h1>
<div class="container foto">
  <div class="row">
    <div class="col-sm">
      <div class="card" style="width: 18rem;">
      <img class="card-img-top img-fluid" src="assets/img/potongan crew cut barbershop.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><h5><b>Crew cut</b></h5> <br>
        <p class="card-text">Gaya crew cut akan cocok bagi kamu yang memiliki rambut tebal karena akan membuat rambut lebih tegak.</p>
      </div>
      </div>
        </div>
        <div class="col-sm">
        <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="assets/img/potongan side part diha barbeshop.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><h5><b>Side part</b></h5> <br>
        <p class="card-text">Side part merupakan gaya rambut dengan memiliki ciri khas menyisir bagian atas kemudian diarahkan ke samping.</p>
      </div>
      </div>
        </div>
        <div class="col-sm">
        <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="assets/img/potongan Undercut diha barbershop.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><h5><b>Undercut</b></h5> <br>
        <p class="card-text">undercut menjadi gaya rambut laki-laki Indonesia yang bisa divariasikan dengan berbagai macam model.</p>
      </div>
      </div>
      
  </div>
</div>
</div>

<div class="container foto">
  <div class="row">
    <div class="col-sm">
      <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="assets/img/potongan two block diha barbershop.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><h5><b>Two blocks</b></h5> <br>
        <p class="card-text">two blocks haircut adalah gaya rambut tipis di samping dengan gradasi yang lebih dramatis dan menebal pada bagian atasnya dibiarkan panjang.</p>
      </div>
      </div>
      </div>
     
      <div class="col-sm">
      <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="assets/img/potongan Taper-Fade diha barbershop.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><h5><b>Taper fade</b></h5> <br>
        <p class="card-text">Taper fade merupakan teknik cukur bergradasi dibuat semakin tipis mulai dari bagian tengah ke bawah mengikuti garis alami rambut.</p>
      </div>
      </div>
      </div>
      <div class="col-sm">
      <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="assets/img/potogan French-Crop.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><h5><b>French-Crop</b></h5> <br>
        <p class="card-text">French crop adalah gaya potong rambut model sekarang yang memiliki ciri khas guntingan pendek di bagian belakang dan kedua sisi.</p>
      </div>
    </div>

      </div>
    </div>
  </div>
  </div>

  <div class="container potongan" id="potongan">
  <h1 class="judul-model"> SERVICE</h1>
  <div class="container foto">
  <div class="row">
    <div class="col-sm">
      <img class="card-img-top img-fluid" src="assets/img/rambut haircut.png" alt="Card image cap">
      <div class="card-body ser">
     
      </div>
    </div>
    <div class="col-sm">
      <img class="card-img-top" src="assets/img/rambut perm.png" alt="Card image cap">
      <div class="card-body ser">
      
      </div>
    </div>
    <div class="col-sm">
      <img class="card-img-top" src="assets/img/rambut smoothing.png" alt="Card image cap">
      <div class="card-body ser">
      
      </div>
    </div>
    <div class="col-sm">
      <img class="card-img-top" src="assets/img/rambut coloring.png" alt="Card image cap">
      <div class="card-body ser">
    
      </div>
    </div>
  </div>
</div>

  </div>
  </div>
  </div>
</div>  

<div class="container-boutus tentang-kami" id="tentang-kami">
  <h1 class="judul-kami">TENTANG KAMI</h1> <br>
  <section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">
        <div class="col-md-6 contact-info ftco-animate fadeInUp ftco-animated">
          <div class="row">
          <p class="tentang"> 
          Selamat datang di Barbershop Online! Kami adalah tujuan terbaik Anda untuk mendapatkan pengalaman potong rambut yang nyaman dan stylish dari kenyamanan rumah Anda.
           Dengan kombinasi antara keahlian tangan yang terampil dan teknologi modern, kami menghadirkan barbershop langsung ke pintu rumah Anda. Ketika Anda memilih Barbershop Online, Anda tidak hanya mendapatkan hasil yang memuaskan tetapi juga kenyamanan dan fleksibilitas. Kami mengerti bahwa waktu adalah aset berharga, dan dengan platform online kami, Anda dapat mengatur jadwal potong rambut sesuai dengan kebutuhan Anda. Tanpa perlu menghabiskan waktu berjam-jam di barbershop tradisional,
          Anda dapat menikmati layanan kami dengan mudah melalui ponsel atau komputer Anda.Kebersihan dan keamanan adalah prioritas utama kami.
            Hubungi kami hari ini dan buat janji untuk mendapatkan potongan rambut terbaik yang pernah Anda dapatkan!
          </p>
          </div>
        </div>
        <div class="col-md-6 ftco-animate fadeInUp ftco-animated">
          <div class="row">
          <img src="assets/img/koko.jpeg" style="width:350px; height:350px; margin-left:50px;" alt="">

          </div>
        </div>
      </div>
    </div>
  </section>

</div>


<div class="container-pesan pesan" id="pesan">
  <h1 class="judul-kami">PESAN RIDERS</h1>
<form action="" method="post">
  <div class="row">
<div class="form-group col-md-6">
  <label for="nama_pemesan">Nama Pemesan</label>
  <input type="text" class="form-control" id="nama_pemesan" name="nama" placeholder="Nama Pemesanan ...">
</div>
<div class="form-group col-md-6">
  <label for="service">Service</label>
  <select id="service" name="service" class="form-control">
    <option value="haircut">Haircut</option>
    <option value="perm">Perm</option>
    <option value="smoothing">Smoothing</option>
    <option value="coloring">Coloring</option>
  </select>
</div>
</div>
  <div class="row detail_pemesanan">
  <div class="form-group col-8">
    <label for="no_hp">No. Handphone</label>
    <input type="number" maxlength="12" class="form-control" id="no_hp" name="hp" placeholder="No. Handphone ...">
  </div>
  <div class="form-group col-2">
    <label for="jam_booking">Jam Booking</label>
    <input type="time" class="form-control" id="jam_booking" name="jam">
  </div>
  <div class="form-group col-2">
    <label for="tanggal_booking">Tanggal Booking</label>
    <input type="date" class="form-control" id="tanggal_booking" name="tanggal">
  </div>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea class="form-control" id="alamat" rows="5" name="alamat" aria-describedby="emailHelp" placeholder="Alamat ..."></textarea>
    <small id="emailHelp" class="form-text text-muted">Mohon masukkan alamat lengkap anda.</small>
  </div>
  <!-- <div class="form-group">
    <label for="nama_pemesan">Keterangan</label>
    <input type="text" class="form-control" id="nama_pemesan" placeholder="Nama ..">
  </div> -->
  <button type="submit" name="pesan" class="btn btn-primary">Pesan</button>
</form>
</div>

<div class="container-contact contact" id="contact">
  <h1 class="judul-kami">CONTACT US</h1>
  <!-- <div class="grid-container">
    <div class="grid-item">1</div>
    <div class="grid-item">2</div>
  </div> -->
  <section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">
        <div class="col-md-6 contact-info ftco-animate fadeInUp ftco-animated">
          <div class="row">
            <div class="col-md-12 mb-4">
              <h1 class="h4">Lokasi</h1>
            </div>
            <div class="mapouter">
              <div class="gmap_canvas">
                <iframe class="gmap_iframe" height="100"  width="50%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=530&amp;height=400&amp;hl=en&amp;q=sarijadi&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                </iframe>
                <a href="https://gachanox.io/">Gacha Nox</a>
              </div>
              <style>.mapouter{position:relative;text-align:right;width:530px;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:530px;height:400px;}.gmap_iframe {width:530px!important;height:400px!important;}</style>
            </div>
          </div>
                  </div>
        <div class="col-md-6 ftco-animate fadeInUp ftco-animated">
          <div class="row">
            <div class="col-md-12 mb-4">
              <h1 class="h4">Hubungi Kami</h1>
            </div>
            <div class="col-md-12 mb-3">
              <p><img src="assets/img/lokasi.png" style="width: 40px; height: 40px; margin: left 50px;"  alt=""> <span>Alamat:</span> <a href="#" class="info"> Jl Sari Asih No 17-18. Sarijadi. Sukasari. Kota Bandung</a></p>
            </div>
            <div class="col-md-12 mb-3">
              <p><img src="assets/img/buka.png" style="width: 40px; height: 40px; margin: left 50px;"  alt=""> <span>Buka senin-sabtu:</span> <a href="buka" class="info">09:00-17:00</a></p>
            </div>
            <div class="col-md-12 mb-3">
              <p><img src="assets/img/whatsapp.png" style="width: 40px; height: 40px; margin: left 50px;"  alt=""> <span>Telepon/Whatsapp:</span> <a href="https://wa.me/6282175352899?text=Halo%20Captain%20Barbershop,%0ASaya%20mau%20bertanya" class="info">082175352899</a></p>
            </div>
            <a href="https://wa.me/6282175352899?text=Halo Diha Barbershop saya mau bertanya . ." style="margin-bottom: 30px;" class="info">
              <botton class="btn btn-primary hubungi" style="margin-left: 10px; padding-right: 30px; padding-left: 30px;">Hubungi Kami</botton>
              
            </a>
          </div>
        </div>
        <div class="col-md-12">

        <div class="container-pembayaran pembayaran" id="pembayaran">
        <h1 class="judul-kami">METODE PEMBAYARAN</h1> <br>
        <div class="col-md-12  ftco-animate fadeInUp ftco-animated">
          <div class="row">
            <div class="col-md-12 mb-4">

            <div style="text-align:center;">
          <p> 
         Jika anda sudah selesai cutting hair oleh riders kami,Maka Kami senang dapat memberikan kemudahan pembayaran melalui berbagai metode yang praktis dan aman.
          Anda dapat memilih untuk membayar melalui:
          </p><br>
          </div>
              <div class="col-md-12 mb-3">
                          

              <p><img src="assets/img/bayar di tempat.png" style="width: 40px; height: 40px; margin: left 50px;"  alt="">      <span>PAY ON PLACE</span> <a href="buka" class="info">(Bayar Di tempat)</a></p>
                </div>
              <div class="col-md-12 mb-3">
              <p><img src="assets/img/bank bca.png" style="width: 40px; height: 40px; margin: left 50px;"  alt=""> <span>BANK BCA:</span> <a href="buka" class="info">2175654483</a></p>
                </div>
         
        </div>
      </div>
    </div>
  </section>
</div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div style="text-align:center;">
    <strong>Copyright &copy; 2023 <a href="#" class="info">Diha Barbershop</a>.</strong> All rights reserved.
  </footer>
    </div>
    <!-- Default to the left -->
    
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/bootstrap.min.js"></script>
<script>
  $('.carousel').carousel({
  interval: 100
})

var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("nav").style.top = "0";
  } else {
    document.getElementById("nav").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}

</script>
</body>
</html>
