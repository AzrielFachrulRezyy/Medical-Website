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
  
  $id_konsultasi = $_GET['id_konsultasi'];
  $data_konsultasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM konsultasi WHERE id_konsultasi = '$id_konsultasi'"));
  if ($data_konsultasi['status_konsultasi'] != 'BELUM DITANGGAPI') {
    header("Location: dashboard.php");
    exit;
  }
  $nama_pasien = $dataUser['nama_lengkap'];

  if (isset($_POST['btnUbah'])) {
    $gejala_pasien = htmlspecialchars($_POST['gejala_pasien']);
    $tanggal_daftar = date("Y-m-d H:i");
    $status_konsultasi = 'BELUM DITANGGAPI';

    $update_konsultasi = mysqli_query($koneksi, "UPDATE konsultasi SET gejala_pasien = '$gejala_pasien' WHERE id_konsultasi = '$id_konsultasi' AND id_user = '$id_user'");

    if ($update_konsultasi) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Konsultasi $nama_pasien Berhasil diubah!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Konsultasi ".$nama_pasien." berhasil diubah!", "success");
      header("Location: ".BASE_URL."/dashboard.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Konsultasi ".$nama_pasien." gagal diubah!", "error");
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
  <title>Ubah Konsultasi - <?= $dataUser['username']; ?></title>
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
            <h2>Ubah Konsultasi - <?= $dataUser['username']; ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <form method="post">
              <div class="mb-3">
                <label for="gejala_pasien" class="form-label">Gejala</label>
                <textarea class="form-control" id="gejala_pasien" name="gejala_pasien" required><?= $data_konsultasi['gejala_pasien']; ?></textarea>
              </div>
              <button type="submit" name="btnUbah" class="btn btn-primary">Submit</button>
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