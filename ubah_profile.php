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
    $username = htmlspecialchars(trim($_POST['username']));
    $nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap']));
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $no_whatsapp = htmlspecialchars($_POST['no_whatsapp']);
    
    if (substr($no_whatsapp, 0, 2) == "08") { // check if it starts with "08"
      $no_whatsapp = "62" . substr($no_whatsapp, 1);
    }

    $alamat = htmlspecialchars(trim($_POST['alamat']));

    // cek username 
    $check_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if ($dataUser['username'] != mysqli_fetch_assoc($check_username)['username']) {
      if (mysqli_num_rows($check_username) > 0) {
        setAlert("Perhatian!", "Username sudah digunakan!", "error");
        echo "
          <script>
            window.history.back();
          </script>
        ";
        exit;
      }
    }

    $update_user = mysqli_query($koneksi, "UPDATE user SET username = '$username', nama_lengkap = '$nama_lengkap', jenis_kelamin = '$jenis_kelamin', no_whatsapp = '$no_whatsapp', alamat = '$alamat' WHERE id_user = '$id_user'");

    if ($update_user) {
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
    
?>
<!doctype html>
<html lang="en">
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Ubah Profile - <?= $dataUser['username']; ?></title>
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
              <h2>Ubah Profile - <?= $dataUser['username']; ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <form method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $dataUser['username']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $dataUser['nama_lengkap']; ?>" required>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <input type="radio" id="l" <?= ($dataUser['jenis_kelamin'] == 'L') ? 'checked' : ''; ?> name="jenis_kelamin" value="L">
                    <label for="l" class="form-label ms-2">Laki-laki</label>
                  </div>
                  <div class="col">
                    <input type="radio" id="p" <?= ($dataUser['jenis_kelamin'] == 'P') ? 'checked' : ''; ?> name="jenis_kelamin" value="P">
                    <label for="p" class="form-label ms-2">Perempuan</label>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="no_whatsapp" class="form-label">No. WhatsApp</label>
                <input type="number" class="form-control" id="no_whatsapp" value="<?= $dataUser['no_whatsapp']; ?>" name="no_whatsapp" required>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?= $dataUser['alamat']; ?></textarea>
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