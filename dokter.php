<?php 
  require_once 'koneksi.php';

  $dokter = mysqli_query($koneksi, "SELECT * FROM dokter INNER JOIN spesialis ON dokter.id_spesialis = spesialis.id_spesialis ORDER BY nama_dokter ASC");
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once 'include/head.php'; ?>
  <title>Dokter</title>
</head>

<body class="sub_page">

  <div class="hero_area">

    <!-- header section strats -->
    <?php include_once 'include/header.php'; ?>
    <!-- end header section -->
  </div>

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
      <div class="row">
        <?php foreach ($dokter as $data_dokter): ?>
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
    </div>
  </section>

  <!-- end doctor section -->

  <!-- footer section -->
  <?php include_once 'include/footer.php' ?>

  <?php include_once 'include/script.php'; ?>
</body>

</html>