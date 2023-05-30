<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
      header("Location: ".BASE_URL."/admin/login.php");
      exit;
  }

  $id_user = $_SESSION['id_user'];
  
  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
      header("Location: ".BASE_URL."/admin/logout.php");
      exit;
  }

  if (isset($_POST['btnTambah'])) {
    $nama_pasien = htmlspecialchars(trim($_POST['nama_pasien']));
    $no_wa_pasien = htmlspecialchars($_POST['no_wa_pasien']);
    if (substr($no_wa_pasien, 0, 2) == "08") { // check if it starts with "08"
      $no_wa_pasien = "62" . substr($no_wa_pasien, 1);
    }

    $alamat_pasien = htmlspecialchars(trim($_POST['alamat_pasien']));
    $gejala_pasien = htmlspecialchars(trim($_POST['gejala_pasien']));
    $tanggal_daftar = date("Y-m-d H:i");
    $status_konsultasi = 'BELUM DITANGGAPI';

    $insert_konsultasi = mysqli_query($koneksi, "INSERT INTO konsultasi (nama_pasien, no_wa_pasien, alamat_pasien, gejala_pasien, tanggal_daftar, status_konsultasi) VALUES ('$nama_pasien', '$no_wa_pasien', '$alamat_pasien', '$gejala_pasien', '$tanggal_daftar', '$status_konsultasi')");

    if ($insert_konsultasi) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Konsultasi $nama_pasien Berhasil ditambahkan!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Konsultasi ".$nama_pasien." Berhasil ditambahkan!", "success");
      header("Location: ".BASE_URL."/admin/konsultasi/index.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Konsultasi ".$nama_pasien." Gagal ditambahkan!", "error");
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
  <?php include_once '../include/head.php'; ?>
  <title>Tambah Konsultasi</title>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php 
      include_once '../include/sidebar.php';
    ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php 
        include_once '../include/navbar.php';
      ?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col head-left">
                  <h5 class="card-title fw-semibold">Tambah Konsultasi</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label for="nama_pasien" class="form-label">Nama Pasien</label>
                      <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
                    </div>
                    <div class="mb-3">
                      <label for="no_wa_pasien" class="form-label">No. WhatsApp Pasien</label>
                      <input type="number" class="form-control" id="no_wa_pasien" name="no_wa_pasien" required>
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
            </div>
          </div>
        </div>
        <?php include_once '../include/footer.php'; ?>
      </div>
    </div>
  </div>
  <?php 
    include_once '../include/script.php';
  ?>
</body>
</html>