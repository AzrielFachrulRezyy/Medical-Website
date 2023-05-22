<?php 
  require_once '../koneksi.php';
  
  if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if ($dataUser = mysqli_fetch_assoc($data)) {
        if (password_verify($password, $dataUser['password'])) {
            $id_user = $dataUser['id_user'];
            $tgl_riwayat = date('Y-m-d H:i:s');
            mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'User Berhasil login!', '$tgl_riwayat', '$id_user')");
            $_SESSION['id_user'] = $id_user;
            $_SESSION['username'] = $dataUser['username'];
            header("Location: index.php");
            exit;
        }
        else
        {
            setAlert("Perhatian!", "Username atau password yang anda masukkan salah!", "error");
            header("Location: login.php");
            exit;
        }
    }
    else
    {
        setAlert("Perhatian!", "Username atau password yang anda masukkan salah!", "error");
        header("Location: login.php");
        exit;
    }
}

if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
  <?php include_once 'include/head.php'; ?>
  <title>Login</title>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <!-- <img src="../assets/images/logos/dark-logo.svg" width="180" alt=""> -->
                  <h1>Login</h1>
                  <h2>Doxscien</h2>
                </a>
                <form method="post">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <button type="submit" name="btnLogin" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>