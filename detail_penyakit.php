<?php 
  require_once 'koneksi.php';

  $id_penyakit = $_GET['id_penyakit'];

  $data_penyakit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM penyakit INNER JOIN obat ON penyakit.id_obat = obat.id_obat WHERE id_penyakit = '$id_penyakit'"));
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once 'include/head.php'; ?>
  <title><?= $data_penyakit['nama_penyakit']; ?></title>
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
            <h1 class="text-center"><?= $data_penyakit['nama_penyakit']; ?></h1>
            <?= htmlspecialchars_decode($data_penyakit['deskripsi_penyakit']); ?>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card shadow mb-5" style="border-radius: 8px;">
              <div class="card-body">
                <img src="assets/images/obat/<?= $data_penyakit['foto_obat']; ?>" alt="<?= $data_obat['foto_obat']; ?>" width="400px" style="display: block; margin: auto; margin-bottom: 10px;">
                <h1 class="text-center">Rekomendasi Obat: <?= $data_penyakit['nama_obat']; ?></h1>
                <?= htmlspecialchars_decode($data_penyakit['deskripsi_obat']); ?>
              </div>
            </div>
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