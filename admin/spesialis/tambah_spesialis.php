<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
      header("Location: ".BASE_URL."/admin/login.php");
      exit;
  }

  $id_user = $_SESSION['id_user'];
  
  $spesialis = mysqli_query($koneksi, "SELECT * FROM spesialis ORDER BY spesialis ASC");

  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
      header("Location: ".BASE_URL."/admin/logout.php");
      exit;
  }

  if (isset($_POST['btnTambah'])) {
    $spesialis = htmlspecialchars(trim($_POST['spesialis']));

    $insert_spesialis = mysqli_query($koneksi, "INSERT INTO spesialis (spesialis) VALUES ('$spesialis')");

    if ($insert_spesialis) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Spesialis $spesialis Berhasil diubah!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Spesialis ".$spesialis." Berhasil ditambahkan!", "success");
      header("Location: ".BASE_URL."/admin/spesialis/index.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Spesialis ".$spesialis." Gagal ditambahkan!", "error");
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
  <title>Tambah Spesialis</title>
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
                  <h5 class="card-title fw-semibold">Tambah Spesialis</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label for="spesialis" class="form-label">Spesialis</label>
                      <input type="text" class="form-control" id="spesialis" name="spesialis" required>
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