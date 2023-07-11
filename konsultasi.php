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
        <script>
          window.history.back();
        </script>
      ";
      exit;
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Konsultasi - <?= $dataUser['username']; ?></title>
</head>

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
            <form method="post">
              <div class="mb-3">
                <label for="gejala_pasien" class="form-label">Gejala</label>
                <textarea class="form-control" id="gejala_pasien" name="gejala_pasien" required></textarea>
              </div>
              <button type="submit" name="btnTambah" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
    include_once 'include/script.php';
  ?>
</body>
</html>