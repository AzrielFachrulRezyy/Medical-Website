<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
    exit;
  }

  $id_user = $_SESSION['id_user'];
  
  $konsultasi = mysqli_query($koneksi, "SELECT * FROM konsultasi ORDER BY tanggal_daftar ASC");

  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
      header("Location: ".BASE_URL."/admin/logout.php");
      exit;
  }

?>

<!doctype html>
<html lang="en">
<head>
  <?php include_once '../include/head.php'; ?>
  <title>Konsultasi</title>
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
              <div class="row mb-3">
                <div class="col-md-6 head-left">
                  <h5 class="card-title fw-semibold">Konsultasi</h5>
                </div>
                <div class="col-md-6 head-right">
                  <a href="<?= BASE_URL; ?>/admin/konsultasi/tambah_konsultasi.php" class="btn btn-primary">Tambah Konsultasi</a>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Pasien</th>
                          <th>No. WhatsApp Pasien</th>
                          <th>Alamat Pasien</th>
                          <th>Gejala Pasien</th>
                          <th>Tanggal Daftar</th>
                          <th>Status Konsultasi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($konsultasi as $data_konsultasi): ?>
                          <tr>
                            <td><?= $i++; ?>.</td>
                            <td><?= $data_konsultasi['nama_pasien']; ?></td>
                            <td><a class="btn btn-success" target="_blank" href="https://wa.me/<?= $data_konsultasi['no_wa_pasien']; ?>"><i class="ti ti-brand-whatsapp"></i>+<?= $data_konsultasi['no_wa_pasien']; ?></a></td>
                            <td><?= $data_konsultasi['alamat_pasien']; ?></td>
                            <td><?= $data_konsultasi['gejala_pasien']; ?></td>
                            <td><?= date("d-m-Y H:i", strtotime($data_konsultasi['tanggal_daftar'])); ?></td>
                            <td><?= $data_konsultasi['status_konsultasi']; ?></td>
                            <td>
                              <a href="tanggapan_konsultasi.php?id_konsultasi=<?= $data_konsultasi['id_konsultasi']; ?>" class="m-1 btn btn-sm btn-primary">Tanggapi</a>
                              <a href="ubah_konsultasi.php?id_konsultasi=<?= $data_konsultasi['id_konsultasi']; ?>" class="m-1 btn btn-sm btn-success">Ubah</a>
                              <a data-nama="Pasien <?= $data_konsultasi['nama_pasien']; ?> akan terhapus!" href="hapus_konsultasi.php?id_konsultasi=<?= $data_konsultasi['id_konsultasi']; ?>" class="btn-delete m-1 btn btn-sm btn-danger">Hapus</a>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
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