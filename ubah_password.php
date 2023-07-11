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

  if (isset($_POST['btnUbah'])) {
    $password_lama = htmlspecialchars($_POST['password_lama']);
    $password_baru = htmlspecialchars($_POST['password_baru']);
    $verifikasi_password_baru = htmlspecialchars($_POST['verifikasi_password_baru']);
    
    // check password with verify
    if ($password_baru != $verifikasi_password_baru) {
      echo "
        <script>
          alert('Password baru harus sama dengan ketik ulang password baru!')
          window.history.back()
        </script>
      ";
      exit;
    }

    // check password lama
    if (!password_verify($password_lama, $dataUser['password'])) {
      echo "
        <script>
          alert('Password lama tidak sesuai!')
          window.history.back()
        </script>
      ";
      exit;
    }
    
    $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);


    $ubah_password = mysqli_query($koneksi, "UPDATE user SET password = '$password_baru' WHERE id_user = '$id_user'");

    if ($ubah_password) {
      setAlert("Berhasil!", "Password berhasil diubah!", "success");
      header("Location: profile.php");
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
    
?>
<!doctype html>
<html lang="en">
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Ubah Password - <?= $dataUser['username']; ?></title>
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
              <h2>Ubah Password - <?= $dataUser['username']; ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
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
                <label for="verifikasi_password_baru" class="form-label">Ketik Ulang Password Baru</label>
                <input type="password" class="form-control" id="verifikasi_password_baru" name="verifikasi_password_baru" required>
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