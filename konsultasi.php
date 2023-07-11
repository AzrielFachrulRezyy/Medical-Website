<<<<<<< HEAD
<?php 
  require_once 'koneksi.php';

  if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/login.php");
    exit;
  }

  $id_user = $_SESSION['id_user'];
  
  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
    header("Location: ".BASE_URL."/logout.php");
    exit;
  }

  $nama_pasien = $dataUser['nama_lengkap'];

  if (isset($_POST['btnTambah'])) {
    $gejala_pasien = htmlspecialchars($_POST['gejala_pasien']);
    $tanggal_daftar = date("Y-m-d H:i");
    $status_konsultasi = 'BELUM DITANGGAPI';

    $insert_konsultasi = mysqli_query($koneksi, "INSERT INTO konsultasi (gejala_pasien, tanggal_daftar, status_konsultasi, id_user) VALUES ('$gejala_pasien', '$tanggal_daftar', '$status_konsultasi', '$id_user')");

    if ($insert_konsultasi) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Konsultasi $nama_pasien Berhasil ditambahkan!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Konsultasi ".$nama_pasien." Berhasil dibuat!", "success");
      header("Location: ".BASE_URL."/dashboard.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Konsultasi ".$nama_pasien." Gagal dibuat!", "error");
      echo "
=======
<?php
require_once 'koneksi.php';

if (isset($_POST['btnTambah'])) {
  $nama_pasien = htmlspecialchars(trim($_POST['nama_pasien']));
  $no_wa_pasien = htmlspecialchars($_POST['no_wa_pasien']);
  $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
  if (substr($no_wa_pasien, 0, 2) == "08") { // check if it starts with "08"
    $no_wa_pasien = "62" . substr($no_wa_pasien, 1);
  }

  $alamat_pasien = htmlspecialchars(trim($_POST['alamat_pasien']));
  $gejala_pasien = htmlspecialchars(trim($_POST['gejala_pasien']));
  $tanggal_daftar = date("Y-m-d H:i");
  $status_konsultasi = 'BELUM DITANGGAPI';

  $insert_konsultasi = mysqli_query($koneksi, "INSERT INTO konsultasi (nama_pasien, jenis_kelamin, no_wa_pasien, alamat_pasien, gejala_pasien, tanggal_daftar, status_konsultasi) VALUES ('$nama_pasien', '$jenis_kelamin', '$no_wa_pasien', '$alamat_pasien', '$gejala_pasien', '$tanggal_daftar', '$status_konsultasi')");

  if ($insert_konsultasi) {
    if ($jenis_kelamin == 'L') {
      $panggilan = 'Bapak';
    } else {
      $panggilan = 'Ibu';
    }
    setAlert("Berhasil!", "Konsultasi " . $panggilan . " " . $nama_pasien . " sedang kami proses. Mohon tunggu pesan dari WhatsApp kami!", "success");
    header("Location: konsultasi.php");
    exit;
  } else {
    setAlert("Perhatian!", "Konsultasi " . $panggilan . " " . $nama_pasien . " Gagal!", "error");
    echo "
>>>>>>> c2ca9c3f24b182cd07895c91969d168fefd1934a
        <script>
          window.history.back();
        </script>
      ";
    exit;
  }
}
?>
<<<<<<< HEAD
<!doctype html>
<html lang="en">
=======

<!DOCTYPE html>
<html>

>>>>>>> c2ca9c3f24b182cd07895c91969d168fefd1934a
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Konsultasi - <?= $dataUser['username']; ?></title>
</head>

<<<<<<< HEAD
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php 
        include_once 'include/navbar.php';
      ?>
      <!--  Header End -->
      <div class="container mt-5 py-5">
        <!--  Row 1 -->
        <div class="row">
          <div class="col">
            <h2>Konsultasi  - <?= $dataUser['username']; ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
=======
<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <?php include_once 'include/header.php'; ?>
    <!-- end header section -->
  </div>

  <!-- contact section -->
  <section class="layout_padding">
    <div class="container">
      <div class="heading_container text-center">
        <h2>
          Konsultasi
        </h2>
      </div>
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="mb-3">
              <label for="nama_pasien" class="form-label">Nama Pasien</label>
              <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <input type="radio" id="l" name="jenis_kelamin" value="L">
                  <label for="l" class="form-label ms-2">Laki-laki</label>
                </div>
                <div class="col">
                  <input type="radio" id="p" name="jenis_kelamin" value="P">
                  <label for="p" class="form-label ms-2">Perempuan</label>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="no_wa_pasien" class="form-label">No. WhatsApp Pasien</label>
              <input type="text" class="form-control" id="no_wa_pasien" name="no_wa_pasien" required>
            </div>
            <div class="mb-3">
              <label for="alamat_pasien" class="form-label">Alamat Pasien</label>
              <textarea class="form-control" id="alamat_pasien" name="alamat_pasien" required></textarea>
            </div>
            <div class="mb-3">
              <label for="gejala_pasien" class="form-label">Gejala Pasien</label>
              <textarea class="form-control" id="gejala_pasien" name="gejala_pasien" required></textarea>
            </div>
            <button type="submit" name="btnTambah" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>

      <!-- <div class="row">
        <div class="col-md-6">
          <div class="form_container">
>>>>>>> c2ca9c3f24b182cd07895c91969d168fefd1934a
            <form method="post">
              <div class="mb-3">
                <label for="gejala_pasien" class="form-label">Gejala</label>
                <textarea class="form-control" id="gejala_pasien" name="gejala_pasien" required></textarea>
              </div>
              <button type="submit" name="btnTambah" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div> -->

    </div>
  </div>
  <?php 
    include_once 'include/script.php';
  ?>
</body>
</html>