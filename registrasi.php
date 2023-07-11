<?php 
  require_once 'koneksi.php';
   
  if (isset($_POST['btnTambah'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars($_POST['password']);
    $verifikasi_password = htmlspecialchars($_POST['verifikasi_password']);
    $nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap']));
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $no_whatsapp = htmlspecialchars($_POST['no_whatsapp']);
    
    if (substr($no_whatsapp, 0, 2) == "08") { // check if it starts with "08"
      $no_whatsapp = "62" . substr($no_whatsapp, 1);
    }

    $alamat = htmlspecialchars(trim($_POST['alamat']));

    // cek username 
    $check_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($check_username) > 0) {
      setAlert("Perhatian!", "Username sudah digunakan!", "error");
      echo "
          <script>
              window.history.back();
          </script>
      ";
      exit;
    }

    // cek password
    if ($password != $verifikasi_password) {
      setAlert("Perhatian!", "Password tidak sama dengan Ketik Ulang Password!", "error");
      echo "
        <script>
          window.history.back();
        </script>
      ";
      exit;
    }
  
    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    $insert_pasien = mysqli_query($koneksi, "INSERT INTO user (username, password, nama_lengkap, jenis_kelamin, no_whatsapp, alamat, role) VALUES ('$username', '$password_hash', '$nama_lengkap', '$jenis_kelamin', '$no_whatsapp', '$alamat', 'pasien')");

    if ($insert_pasien) {
      if ($jenis_kelamin == 'L') {
        $panggilan = 'Bapak';
      }
      else
      {
        $panggilan = 'Ibu';
      }
      setAlert("Berhasil!", "Akun ".$panggilan." ".$nama_lengkap." berhasil dibuat. Mohon melakukan Login untuk Konsultasi!", "success");
      header("Location: login.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Akun ".$panggilan." ".$nama_lengkap." gagal dibuat!", "error");
      echo "
        <script>
          window.history.back();
        </script>
      ";
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
  <title>Registrasi</title>
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
          Registrasi
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
              <div class="mb-3">
                <label for="verifikasi_password" class="form-label">Ketik Ulang Password</label>
                <input type="password" class="form-control" id="verifikasi_password" name="verifikasi_password" required>
              </div>
              <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <input type="radio" id="l" name="jenis_kelamin" value="L">
                    <label for="l" class="form-label ms-2">Laki-laki</label>
                  </div>
                  <div class="col">
                    <input type="radio" id="p" name="jenis_kelamin" value="P">
                    <label for="p" class="form-label ms-2">Perempuan</label>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="no_whatsapp" class="form-label">No. WhatsApp</label>
                <input type="number" class="form-control" id="no_whatsapp" name="no_whatsapp" required>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
              </div>
              <button type="submit" name="btnTambah" class="btn btn-primary">Submit</button>
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