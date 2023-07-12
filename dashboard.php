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

  if ($dataUser['role'] != 'pasien') {
    header("Location: admin/index.php");
    exit;
  }

  $konsultasi = mysqli_query($koneksi, "SELECT * FROM konsultasi INNER JOIN user ON konsultasi.id_user = user.id_user WHERE user.id_user = '$id_user' ORDER BY status_konsultasi = 'BELUM DITANGGAPI' DESC");
?>
<!doctype html>
<html lang="en">
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Dashboard - <?= $dataUser['username']; ?></title>
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
        <div class="row mb-3">
          <div class="col-md-6 head-left">
            <h2>Dashboard - <?= $dataUser['username']; ?></h2>
          </div>
          <div class="col-md-6 head-right">
            <a href="konsultasi.php" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Konsultasi</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Gejala</th>
                    <th>Tanggal Daftar</th>
                    <th>Status Konsultasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (mysqli_num_rows($konsultasi) > 0): ?>
                    <?php $i = 1; ?>
                    <?php foreach ($konsultasi as $data_konsultasi): ?>
                      <tr>
                        <td><?= $i++; ?>.</td>
                        <td><?= $data_konsultasi['gejala_pasien']; ?></td>
                        <td><?= date("d-m-Y, H:i", strtotime($data_konsultasi['tanggal_daftar'])); ?></td>
                        <td><?= $data_konsultasi['status_konsultasi']; ?></td>
                        <td>
                          <?php if ($data_konsultasi['status_konsultasi'] == 'BELUM DITANGGAPI'): ?>
                            <a href="ubah_konsultasi.php?id_konsultasi=<?= $data_konsultasi['id_konsultasi']; ?>" class="btn btn-success m-1">Ubah</a>
                            <a data-nama="Ingin membatalkan konsultasi?" href="batalkan_konsultasi.php?id_konsultasi=<?= $data_konsultasi['id_konsultasi']; ?>" class="btn btn-danger m-1 btn-alert">Batalkan</a>
                          <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
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