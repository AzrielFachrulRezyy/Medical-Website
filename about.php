<?php
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
  <title>About</title>
  <?php include_once 'include/head.php'; ?>
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <?php include_once 'include/header.php'; ?>
    <!-- end header section -->
  </div>

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="assets/images/Rumah-sakit.jpg" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About <span>Us</span>
              </h2>
            </div>
            <p class="text-justify">
              Selamat datang di Doxscien! <br>
              Doxscien adalah platform yang menyediakan informasi penyakit, rekomendasi obat, informasi dokter, dan layanan konsultasi online. Kami berkomitmen untuk menyediakan informasi medis yang akurat dan terpercaya, serta memberikan akses yang mudah dan praktis bagi pengguna. Visi kami adalah meningkatkan kesehatan dan kualitas hidup setiap individu dengan menyediakan sumber daya medis yang handal. Terima kasih telah memilih Doxscien sebagai sumber informasi medis Anda.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- footer section -->
  <?php include_once 'include/footer.php' ?>
  <!-- footer section -->

  <?php include_once 'include/script.php'; ?>

</body>

</html>