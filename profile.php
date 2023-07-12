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

  $konsultasi = mysqli_query($koneksi, "SELECT * FROM konsultasi INNER JOIN user ON konsultasi.id_user = user.id_user WHERE user.id_user = '$id_user' ORDER BY status_konsultasi = 'BELUM DITANGGAPI' DESC");
?>
<!doctype html>
<html lang="en">
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Profile - <?= $dataUser['username']; ?></title>
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
              <h2>Profile  - <?= $dataUser['username']; ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <table cellpadding="5">
              <tr>
                <th>Username</th>
                <td>:</td>
                <td><?= $dataUser['username']; ?></td>
              </tr>
              <tr>
                <th>Nama Lengkap</th>
                <td>:</td>
                <td><?= $dataUser['nama_lengkap']; ?></td>
              </tr>
              <tr>
                <th>Jenis Kelamin</th>
                <td>:</td>
                <td><?= $dataUser['jenis_kelamin']; ?></td>
              </tr>
              <tr>
                <th>No. WhatsApp</th>
                <td>:</td>
                <td><?= $dataUser['no_whatsapp']; ?></td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>:</td>
                <td><?= $dataUser['alamat']; ?></td>
              </tr>
              <tr>
                <td>
                  <a href="ubah_profile.php" class="btn btn-success">Ubah Profile</a>
                </td>
                <td></td>
                <td>
                  <a href="ubah_password.php" class="btn btn-danger">Ubah Password</a>
                </td>
              </tr>
            </table>
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