<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
      header("Location: login.php");
      exit;
  }

  $id_user = $_SESSION['id_user'];
  
  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
      header("Location: logout.php");
      exit;
  }

?>

<!doctype html>
<html lang="en">
<head>
  <?php include_once '../include/head.php'; ?>
  <title>Profile</title>
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
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <h4 class="card-title fw-semibold">Profile</h4>
                <h6>Username:</h6>
                <h6><?= $dataUser['username']; ?></h6>
                <h6>Nama Lengkap:</h6>
                <h6><?= $dataUser['nama_lengkap']; ?></h6>
                <div class="row">
                  <div class="col">
                    <a class="btn btn-success me-2" href="ubah_profile.php">Ubah Profile</a>
                    <a class="btn btn-success" href="ubah_password.php">Ubah Password</a>
                  </div>
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