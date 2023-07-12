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

  $data_konsultasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM konsultasi INNER JOIN user ON konsultasi.id_user = user.id_user WHERE id_konsultasi = '$id_konsultasi'"));
  
  if (!$data_konsultasi) {
    header("Location: ".BASE_URL."/admin/konsultasi/index.php");
    exit;
  }

  if ($data_konsultasi['status_konsultasi'] == 'SUDAH DITANGGAPI' || $data_konsultasi['status_konsultasi'] == 'SELESAI') {
    header("Location: ".BASE_URL."/admin/tanggapan/index.php?id_konsultasi=$id_konsultasi");
    exit;
  }

  $nama_pasien = $data_konsultasi['nama_lengkap'];
  $jenis_kelamin = $data_konsultasi['jenis_kelamin'];

  $dokter = mysqli_query($koneksi, "SELECT * FROM dokter INNER JOIN spesialis ON dokter.id_spesialis = spesialis.id_spesialis ORDER BY nama_dokter ASC");

  if (isset($_POST['btnTambah'])) {
    if ($data_konsultasi['status_konsultasi'] == 'SUDAH DITANGGAPI' || $data_konsultasi['status_konsultasi'] == 'SELESAI') 
    {
      header("Location: ".BASE_URL."/admin/tanggapan/index.php?id_konsultasi=$id_konsultasi");
      exit;
    }
    $id_dokter = htmlspecialchars(trim($_POST['id_dokter']));
    if ($id_dokter == 0) {
      setAlert("Gagal!", "Pilih Dokter terlebih dahulu!", "error");
      echo "
        <script>
          window.history.back();
        </script>
      ";
      exit;
    }

    $nama_dokter = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter = '$id_dokter'"))['nama_dokter'];

    $tanggal_konsultasi = htmlspecialchars(trim($_POST['tanggal_konsultasi']));
    
    $jam = date('H'); 
    if ($jam >= 0 && $jam < 12) {
      $selamat = 'Selamat pagi, ';
    } elseif ($jam >= 12 && $jam < 15) {
      $selamat = 'Selamat siang, ';
    } else {
      $selamat = 'Selamat sore, ';
    }

    if ($jenis_kelamin == 'L') {
      $jenis_kelamin = 'Bapak ';
    } else {
      $jenis_kelamin = 'Ibu ';
    }
    
    $tanggal_konsultasi_keterangan = date("d-m-Y, H:i", strtotime($tanggal_konsultasi));
    $keterangan = $selamat . $jenis_kelamin . $nama_pasien . ", kami dari Doxscien. " . $jenis_kelamin . "telah kami jadwalkan konsultasi dengan dokter " . $nama_dokter . " pada waktu berikut: " . $tanggal_konsultasi_keterangan;

    $insert_tanggapan = mysqli_query($koneksi, "INSERT INTO tanggapan (id_konsultasi, id_dokter, tanggal_konsultasi, keterangan, id_user) VALUES ('$id_konsultasi', '$id_dokter', '$tanggal_konsultasi', '$keterangan', '$id_user')");

    if ($insert_tanggapan) {
      // update status konsultasi
      mysqli_query($koneksi, "UPDATE konsultasi SET status_konsultasi = 'SUDAH DITANGGAPI' WHERE id_konsultasi = '$id_konsultasi'");

      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Tanggapan $nama_pasien Berhasil ditambahkan!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Tanggapan ".$nama_pasien." Berhasil ditambahkan!", "success");

      header("Location: ".BASE_URL."/admin/tanggapan/index.php?id_konsultasi=$id_konsultasi");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Tanggapan ".$nama_pasien." Gagal ditambahkan!", "error");
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
  <?php include_once '../include/head.php'; ?>
  <title>Tambah Tanggapan - <?= $data_konsultasi['nama_lengkap']; ?></title>
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
                <div class="col head-left">
                  <h5 class="card-title fw-semibold">Tambah Tanggapan - <?= $data_konsultasi['nama_lengkap']; ?></h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label for="id_dokter" class="form-label">Nama Dokter</label>
                      <select name="id_dokter" id="id_dokter" required class="form-select">
                        <option value="0">--- Pilih Nama Dokter ---</option>
                        <?php foreach ($dokter as $data_dokter): ?>
                          <option value="<?= $data_dokter['id_dokter']; ?>"><?= $data_dokter['nama_dokter']; ?> (<?= $data_dokter['spesialis']; ?>)</option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_konsultasi" class="form-label">Tanggal Konsultasi</label>
                      <input type="datetime-local" class="form-control" id="tanggal_konsultasi" name="tanggal_konsultasi" required>
                    </div>
                    <button type="submit" name="btnTambah" class="btn btn-primary">Submit</button>
                  </form>
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