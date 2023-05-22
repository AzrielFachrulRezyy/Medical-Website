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

    if (isset($_POST['btnUbahProfile'])) {
        $username = $_POST['username'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $update_profile = mysqli_query($koneksi, "UPDATE user SET username = '$username', nama_lengkap = '$nama_lengkap' WHERE id_user = '$id_user'");
        if ($update_profile) {
            $tgl_riwayat = date('Y-m-d H:i:s');
            mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Profile berhasil diubah!', '$tgl_riwayat', '$id_user')");

            setAlert("Berhasil!", "Profile berhasil diubah!", "success");

            header("Location: profile.php");
            exit;
        }
        else
        {
            setAlert("Perhatian!", "Profile gagal diubah!", "error");
            echo "
                <script>
                    window.history.back();
                </script>
            ";
            exit;
        }
    }

    if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
        header("Location: logout.php");
        exit;
    }
?>


<!doctype html>
<html lang="en">
<head>
  <?php include_once '../include/head.php'; ?>
  <title>Ubah Profile</title>
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
                <h4 class="card-title fw-semibold">Ubah Profile</h4>
                <form method="post">
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" value="<?= $dataUser['username']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $dataUser['nama_lengkap']; ?>">
                    </div>
                    <button type="submit" name="btnUbahProfile" class="btn btn-primary">Submit</button>
                </form>
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