<?php 
  require_once 'koneksi.php';
  $obat = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY nama_obat ASC");
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once 'include/head.php'; ?>
  <title>Obat</title>
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
            Info Obat
          </h2>
          <p>
           Berikut adalah informasi mengenai obat-obatan secara umum, semoga dapat membantu anda untuk menemukan obat yang tepat.
          </p>
        </div>
        <div class="row">
          <?php foreach ($obat as $data_obat): ?>
            <div class="col-md-3">
              <div class="box ">
                <div class="img-box">
                  <img src="assets/images/obat/<?= $data_obat['foto_obat']; ?>" alt="<?= $data_obat['foto_obat']; ?>">
                </div>
                <div class="detail-box">
                  <h5>
                    <?= $data_obat['nama_obat']; ?>
                  </h5>
                  <p>
                    <?php $deskripsi_obat = strip_tags(html_entity_decode($data_obat['deskripsi_obat'])); ?>
                    <?= strlen($deskripsi_obat) > 100 ? substr($deskripsi_obat, 0, 100) . "..." : $deskripsi_obat; ?>
                  </p>
                  <a href="detail_obat.php?id_obat=<?= $data_obat['id_obat']; ?>" class="btn btn-success text-white">Read More</a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <!-- end department section -->
  
  <!-- footer section -->
  <?php include_once 'include/footer.php' ?>
  <?php include_once 'include/script.php'; ?>

</body>

</html>