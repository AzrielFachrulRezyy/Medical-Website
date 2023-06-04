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
          <p>
           Berikut adalah informasi mengenai penyakit-penyakit secara umum, semoga dapat membantu anda untuk menemukan penyakit yang tepat.
          </p>
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
                    <?= strip_tags(html_entity_decode($data_penyakit['deskripsi_penyakit'])); ?>
                  </p>
                  <a href="detail_penyakit.php?id_penyakit=<?= $data_penyakit['id_penyakit']; ?>" class="btn btn-success text-white">Read More</a>
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