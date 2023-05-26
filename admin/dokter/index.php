<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
    exit;
  }

  $id_user = $_SESSION['id_user'];
  
  $dokter = mysqli_query($koneksi, "SELECT * FROM dokter INNER JOIN spesialis ON dokter.id_spesialis = spesialis.id_spesialis ORDER BY nama_dokter ASC");

  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
      header("Location: ".BASE_URL."/admin/logout.php");
      exit;
  }

?>

<!doctype html>
<html lang="en">
<head>
  <?php include_once '../include/head.php'; ?>
  <title>Dokter</title>
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
                  <h5 class="card-title fw-semibold">Dokter</h5>
                </div>
                <div class="col-md-6 head-right">
                  <a href="<?= BASE_URL; ?>/admin/dokter/tambah_dokter.php" class="btn btn-primary">Tambah Dokter</a>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Dokter</th>
                          <th>Jadwal Praktek</th>
                          <th>Foto Dokter</th>
                          <th>Spesialis</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($dokter as $data_dokter): ?>
                          <tr>
                            <td><?= $i++; ?>.</td>
                            <td><?= $data_dokter['nama_dokter']; ?></td>
                            <td><?= htmlspecialchars_decode($data_dokter['jadwal_praktek']); ?></td>
                            <td class="max-width-100">
                              <a target="_blank" href="<?= BASE_URL; ?>/assets/images/dokter/<?= $data_dokter['foto_dokter']; ?>">
                                <img class="img-fluid" src="<?= BASE_URL; ?>/assets/images/dokter/<?= $data_dokter['foto_dokter']; ?>" alt="<?= $data_dokter['foto_dokter']; ?>">
                              </a>
                            </td>
                            <td><?= $data_dokter['spesialis']; ?></td>
                            <td>
                              <a href="ubah_dokter.php?id_dokter=<?= $data_dokter['id_dokter']; ?>" class="m-1 btn btn-sm btn-success">Ubah</a>
                              <a data-nama="Dokter <?= $data_dokter['nama_dokter']; ?> akan terhapus!" href="hapus_dokter.php?id_dokter=<?= $data_dokter['id_dokter']; ?>" class="btn-delete m-1 btn btn-sm btn-danger">Hapus</a>
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