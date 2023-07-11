<?php 
  require_once 'koneksi.php';
  
  if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if ($dataUser = mysqli_fetch_assoc($data)) {
      if ($dataUser['role'] != 'administrator' && $dataUser['role'] != 'operator') {
        if (password_verify($password, $dataUser['password'])) {
          $id_user = $dataUser['id_user'];
          $tgl_riwayat = date('Y-m-d H:i:s');
          mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'User Berhasil login!', '$tgl_riwayat', '$id_user')");
          $_SESSION['id_user'] = $id_user;
          $_SESSION['role'] = $dataUser['role'];
          $_SESSION['username'] = $dataUser['username'];
          header("Location: dashboard.php");
          exit;
        }
        else
        {
          setAlert("Perhatian!", "Username atau password yang anda masukkan salah!", "error");
          header("Location: ".BASE_URL."/login.php");
          exit;
        }
      }
      else
      {
        header("Location: ".BASE_URL."/admin/login.php");
        exit;
      }
    }
    else
    {
      setAlert("Perhatian!", "Username atau password yang anda masukkan salah!", "error");
      header("Location: ".BASE_URL."/login.php");
      exit;
    }
}

if (isset($_SESSION['id_user'])) {
  header("Location: dashboard.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Login</title>
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <?php include_once 'include/header.php'; ?>
    <!-- end header section -->
  </div>

  <!-- contact section -->
  <section class="layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Login
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" name="btnLogin" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- footer section -->
  <?php include_once 'include/footer.php' ?>
  <!-- footer section -->

  <?php include_once 'include/script.php'; ?>

</body>

</html>