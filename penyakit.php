<?php 
  require_once 'koneksi.php';
  $penyakit = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY nama_penyakit ASC");
 ?>
<!DOCTYPE html>
<html>

<head>
  <title>Penyakit</title>
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
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Info Penyakit
          </h2>
        </div>
        <div class="row">
          <?php foreach ($penyakit as $data_penyakit): ?>
            <div class="col-md-3">
              <div class="box ">
                <div class="img-box">
                  <img src="assets/images/penyakit.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    <?= $data_penyakit['nama_penyakit']; ?>
                  </h5>
                  <p>
                    <?= htmlspecialchars_decode(html_entity_decode($data_penyakit['deskripsi_penyakit'])); ?>
                  </p>
                  <a href="" class="btn btn-success text-white">Read More</a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <!-- end department section -->
  <?php include_once 'include/footer.php' ?>
  <!-- footer section -->

  <?php include_once 'include/script.php'; ?>

</body>

</html>