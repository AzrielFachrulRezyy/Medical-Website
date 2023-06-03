<?php 
  require_once 'koneksi.php';

  $id_obat = $_GET['id_obat'];

  $data_obat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM obat WHERE id_obat = '$id_obat'"));
?>

<!DOCTYPE html>
<html>

<head>
  
  <title><?= $data_obat['nama_obat']; ?></title>
  <?php include_once 'include/head.php'; ?>

</head>

<body class="sub_page">

  <div class="hero_area">

    <div class="hero_bg_box">
      <img src="images/hero-bg.png" alt="">
    </div>

    <!-- header section strats -->
    <?php include_once 'include/header.php'; ?>
    <!-- end header section -->
  </div>

  <!-- department section -->

  <section class="department_section layout_padding">
    <div class="department_container">
      <div class="container">
        <div class="card shadow mb-5" style="border-radius: 8px;">
            <div class="card-body">
                <img src="assets/images/obat/<?= $data_obat['foto_obat']; ?>" alt="<?= $data_obat['foto_obat']; ?>" width="400px" style="display: block; margin: auto;">
                <h1 class="text-center"><?= $data_obat['nama_obat']; ?></h1>
                <?= htmlspecialchars_decode($data_obat['deskripsi_obat']); ?>
            </div>
        </div>
    </div>
    </div>
  </section>

  <!-- end department section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_contact">
            <h4>
              Reach at..
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="footer_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_detail">
            <h4>
              About
            </h4>
            <p>
              Beatae provident nobis mollitia magnam voluptatum, unde dicta facilis minima veniam corporis laudantium alias tenetur eveniet illum reprehenderit fugit a delectus officiis blanditiis ea.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-2 mx-auto footer_col">
          <div class="footer_link_box">
            <h4>
              Links
            </h4>
            <div class="footer_links">
              <a class="active" href="index.php">
                Home
              </a>
              <a class="" href="about.php">
                About
              </a>
              <a class="" href="departments.php">
                Departments
              </a>
              <a class="" href="dokter.php">
                dokter
              </a>
              <a class="" href="contact.php">
                Contact Us
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col ">
          <h4>
            Newsletter
          </h4>
       <form action="#">
            <input type="email" placeholder="Enter email" />
            <button type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By Kelompok 2 Universitas Pamulang
        </p>
       
      </div>  
    </div>
  </footer>
  <!-- footer section -->

 <!-- jQery -->
 <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
 </script>
 <!-- bootstrap js -->
 <script type="text/javascript" src="assets/js/bootstrap.js"></script>
 <!-- owl slider -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
 </script>
 <!-- custom js -->
 <script type="text/javascript" src="assets/js/custom.js"></script>
 <!-- Google Map -->
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
 </script>
 <!-- End Google Map -->

</body>

</html>