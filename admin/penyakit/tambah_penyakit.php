<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
      header("Location: ".BASE_URL."/admin/login.php");
      exit;
  }

  $id_user = $_SESSION['id_user'];
  
  $penyakit = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY nama_penyakit ASC");

  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
      header("Location: ".BASE_URL."/admin/logout.php");
      exit;
  }

  if (isset($_POST['btnTambah'])) {
    $nama_penyakit = htmlspecialchars(trim($_POST['nama_penyakit']));
    $deskripsi_penyakit = htmlspecialchars(trim($_POST['content']));
    
    $insert_penyakit = mysqli_query($koneksi, "INSERT INTO penyakit (nama_penyakit, deskripsi_penyakit) VALUES ('$nama_penyakit', '$deskripsi_penyakit')");

    if ($insert_penyakit) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Penyakit $nama_penyakit Berhasil ditambahkan!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Penyakit ".$nama_penyakit." Berhasil ditambahkan!", "success");
      header("Location: ".BASE_URL."/admin/penyakit/index.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Penyakit ".$nama_penyakit." Gagal ditambahkan!", "error");
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
  <title>Tambah Penyakit</title>
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
                  <h5 class="card-title fw-semibold">Tambah Penyakit</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                      <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" required>
                    </div>
                    <div class="mb-3">
                      <label for="editor" class="form-label">Deskripsi Penyakit</label>
                      <input type="hidden" name="content">
                      <div id="editor"></div>
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