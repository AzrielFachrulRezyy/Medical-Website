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
            <a href="obat.php" class="btn btn-success text-white">Back</a>
          </div>
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