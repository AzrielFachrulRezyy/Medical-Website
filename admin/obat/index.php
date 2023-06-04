<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
    exit;
  }

  $id_user = $_SESSION['id_user'];
  
  $obat = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY nama_obat ASC");

  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
      header("Location: ".BASE_URL."/admin/logout.php");
      exit;
  }

?>

<!doctype html>
<html lang="en">
<head>
  <?php include_once '../include/head.php'; ?>
  <title>Obat</title>
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
                  <h5 class="card-title fw-semibold">Obat</h5>
                </div>
                <div class="col-md-6 head-right">
                  <a href="<?= BASE_URL; ?>/admin/obat/tambah_obat.php" class="btn btn-primary">Tambah Obat</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Obat</th>
                      <th>Deskripsi Obat</th>
                      <th>Foto Obat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($obat as $data_obat): ?>
                      <tr>
                        <td><?= $i++; ?>.</td>
                        <td><?= $data_obat['nama_obat']; ?></td>
                        <td><?= strip_tags(html_entity_decode((strlen($data_obat['deskripsi_obat']) > 50) ? substr($data_obat['deskripsi_obat'], 0, 50) . '...' : $data_obat['deskripsi_obat'])); ?></td>
                        <td class="max-width-100">
                          <a target="_blank" href="<?= BASE_URL; ?>/assets/images/obat/<?= $data_obat['foto_obat']; ?>">
                            <img class="img-fluid" src="<?= BASE_URL; ?>/assets/images/obat/<?= $data_obat['foto_obat']; ?>" alt="<?= $data_obat['foto_obat']; ?>">
                          </a>
                        </td>
                        <td>
                          <a href="ubah_obat.php?id_obat=<?= $data_obat['id_obat']; ?>" class="m-1 btn btn-sm btn-success">Ubah</a>
                          <a data-nama="Obat <?= $data_obat['nama_obat']; ?> akan terhapus!" href="hapus_obat.php?id_obat=<?= $data_obat['id_obat']; ?>" class="btn-delete m-1 btn btn-sm btn-danger">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
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