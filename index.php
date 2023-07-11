<?php
require_once 'koneksi.php';

$penyakit = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY nama_penyakit ASC LIMIT 5");

$obat = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY nama_obat ASC LIMIT 5");

$dokter = mysqli_query($koneksi, "SELECT * FROM dokter INNER JOIN spesialis ON dokter.id_spesialis = spesialis.id_spesialis ORDER BY nama_dokter ASC LIMIT 5");


?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once 'include/head.php'; ?>
  <title>Doxscien</title>
</head>

<body>

  <div class="hero_area">

    <div class="hero_bg_box">
      <img src="assets/images/hero-bg.png" alt="">
    </div>

    <!-- header section strats -->
    <?php include_once 'include/header.php'; ?>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      We provide health information services
                    </h1>
                    <p>
                      Kami menyediakan layanan informasi penyakit dan obat serta menyediakan informasi dokter dan pendaftaran konsultasi online.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Read More
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      We provide health information services
                    </h1>
                    <p>
                      Kami menyediakan layanan informasi penyakit dan obat serta menyediakan informasi dokter dan pendaftaran konsultasi online.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Read More
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      We provide health information services
                    </h1>
                    <p>
                      Kami menyediakan layanan informasi penyakit dan obat serta menyediakan informasi dokter dan pendaftaran konsultasi online.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Read More
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- department section -->

  <section class="department_section layout_padding">
    <div class="department_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Info Penyakit
          </h2>
          <p>
            Berikut adalah informasi mengenai penyakit-penyakit secara umum, semoga dapat membantu anda untuk menemukan penyakit yang tepat.
          </p>
        </div>
        <div class="row justify-content-center">
          <?php foreach ($penyakit as $data_penyakit) : ?>
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
                    <?php $deskripsi_penyakit = strip_tags(html_entity_decode($data_penyakit['deskripsi_penyakit'])); ?>
                    <?= strlen($deskripsi_penyakit) > 100 ? substr($deskripsi_penyakit, 0, 100) . "..." : $deskripsi_penyakit; ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
        <div class="btn-box">
          <a href="penyakit.php">
            View All
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- end department section -->

  <!-- department section -->

  <section class="department_section layout_padding">
    <div class="department_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Info Obat
          </h2>
          <p>
            Berikut adalah informasi mengenai obat-obatan secara umum, semoga dapat membantu anda untuk menemukan obat yang tepat.
          </p>
        </div>
        <div class="row justify-content-center">
          <?php foreach ($obat as $data_obat) : ?>
            <div class="col-md-3">
              <div class="box ">
                <div class="img-box">
                  <img src="assets/images/s1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    <?= $data_obat['nama_obat']; ?>
                  </h5>
                  <p>
                    <?php $deskripsi_obat = strip_tags(html_entity_decode($data_obat['deskripsi_obat'])); ?>
                    <?= strlen($deskripsi_obat) > 100 ? substr($deskripsi_obat, 0, 100) . "..." : $deskripsi_obat; ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
        <div class="btn-box">
          <a href="obat.php">
            View All
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- end department section -->

  <!-- about section -->

  <section class="about_section layout_margin-bottom">
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
              Doxscien adalah platform yang menyediakan informasi penyakit, rekomendasi obat, informasi dokter, dan layanan konsultasi online. Kami berkomitmen untuk menyediakan informasi medis yang akurat dan terpercaya, serta memberikan akses yang mudah dan praktis bagi pengguna. Visi kami adalah meningkatkan kesehatan dan kualitas hidup setiap individu dengan menyediakan sumber daya medis yang handal. Terima kasih telah memilih Doxscien sebagai sumber informasi medis Anda.
            </p>
            <a href="about.php">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- doctor section -->

  <section class="doctor_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our dokter
        </h2>
        <p class="col-md-10 mx-auto px-0">
          Berikut adalah informasi mengenai dokter-dokteran secara umum, semoga dapat membantu anda untuk menemukan dokter yang tepat.
        </p>
      </div>
      <div class="row justify-content-center">
        <?php foreach ($dokter as $data_dokter) : ?>
          <div class="col-sm-6 col-lg-4 mx-auto">
            <div class="box">
              <div style="height: 300px;">
                <img style="height: 100%; width: 100%; object-fit: cover; background-position: center;" src="assets/images/dokter/<?= $data_dokter['foto_dokter']; ?>" alt="<?= $data_dokter['foto_dokter']; ?>">
              </div>
              <div class="detail-box">
                <h5>
                  <?= $data_dokter['nama_dokter']; ?>
                </h5>
                <h6>
                  <?= $data_dokter['spesialis']; ?>
                </h6>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <div class="btn-box">
        <a href="dokter.php">
          View All
        </a>
      </div>
    </div>
  </section>

  <!-- end doctor section -->


  <!-- footer section -->
  <?php include_once 'include/footer.php' ?>
  <!-- footer section -->

  <?php include_once 'include/script.php'; ?>

</body>

</html>