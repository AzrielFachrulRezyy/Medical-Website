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

    if (isset($_POST['btnUbahPassword'])) {
        $password_lama = $_POST['password_lama'];
        $password_baru = $_POST['password_baru'];
        $verifikasi_password_baru = $_POST['verifikasi_password_baru'];
        
        // cek password
        if (password_verify($password_lama, $dataUser['password'])) {
            if ($password_baru == $verifikasi_password_baru) {
                $password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                $update_password = mysqli_query($koneksi, "UPDATE user SET password = '$password_baru_hash' WHERE id_user = '$id_user'");
                if ($update_password) {
                    $tgl_riwayat = date('Y-m-d H:i:s');
                    mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Password berhasil diubah!', '$tgl_riwayat', '$id_user')");
                    
                    setAlert("Berhasil!", "Password berhasil diubah!", "success");
                    header("Location: index.php");
                    exit;
                }
                else
                {
                    setAlert("Perhatian!", "Password gagal diubah!", "error");
                    echo "
                        <script>
                            window.history.back();
                        </script>
                    ";
                    exit;
                }
            } 
            else 
            {
                setAlert("Perhatian!", "Password baru tidak sama dengan verifikasi Password!", "error");
                echo "
                    <script>
                        window.history.back();
                    </script>
                ";
                exit;
            }
        } 
        else
        {
            setAlert("Perhatian!", "Password lama salah!", "error");
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
  <title>Ubah Password</title>
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
                <h4 class="card-title fw-semibold">Ubah Password</h4>
                <form method="post">
                    <div class="mb-3">
                      <label for="password_lama" class="form-label">Password Lama</label>
                      <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                    </div>
                    <div class="mb-3">
                      <label for="password_baru" class="form-label">Password Baru</label>
                      <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                    </div>
                    <div class="mb-3">
                      <label for="verifikasi_password_baru" class="form-label">Verifikasi Password Baru</label>
                      <input type="password" class="form-control" id="verifikasi_password_baru" name="verifikasi_password_baru" required>
                    </div>
                    <button type="submit" name="btnUbahPassword" class="btn btn-primary">Submit</button>
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