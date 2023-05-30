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

  $id_konsultasi = $_GET['id_konsultasi'];

  $data_konsultasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM konsultasi WHERE id_konsultasi = '$id_konsultasi'"));

  $data_tanggapan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tanggapan WHERE id_konsultasi = '$id_konsultasi'"));

  $konsultasi = mysqli_query($koneksi, "SELECT * FROM konsultasi ORDER BY tanggal_daftar ASC");
?>

<!doctype html>
<html lang="en">
<head>
  <?php include_once '../include/head.php'; ?>
  <title>Tanggapan - <?= $data_konsultasi['nama_pasien']; ?></title>
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
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold">Tanggapan - <?= $data_konsultasi['nama_pasien']; ?></h5>
              <div class="card">
                <div class="card-body">
                  <h5>Data Pasien</h5>
                  <div class="card">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><h6>Nama Pasien:</h6> <?= $data_konsultasi['nama_pasien']; ?></li>
                      <li class="list-group-item"><h6>No. WhatsApp Pasien:</h6> <a class="btn btn-success" target="_blank" href="https://wa.me/<?= $data_konsultasi['no_wa_pasien']; ?>"><i class="ti ti-brand-whatsapp"></i>+<?= $data_konsultasi['no_wa_pasien']; ?></a></li>
                      <li class="list-group-item"><h6>Alamat Pasien:</h6> <?= $data_konsultasi['alamat_pasien']; ?></li>
                      <li class="list-group-item"><h6>Gejala Pasien:</h6> <?= $data_konsultasi['gejala_pasien']; ?></li>
                      <li class="list-group-item"><h6>Tanggal Daftar:</h6> <?= date("d-m-Y H:i", strtotime($data_konsultasi['tanggal_daftar'])); ?></li>
                      <li class="list-group-item"><h6>Status Konsultasi:</h6> <?= $data_konsultasi['status_konsultasi']; ?></li>
                    </ul>
                  </div>
                  <hr>
                  <h5>Tanggapan</h5>
                  <?php if ($data_tanggapan): ?>
                  <?php else: ?>
                    <h5 class="text-muted">Belum ditanggapi</h5>
                    <a href="tambah_tanggapan.php?id_konsultasi=<?= $data_konsultasi['id_konsultasi']; ?>" class="btn btn-primary">Tanggapi</a>
                  <?php endif ?>
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