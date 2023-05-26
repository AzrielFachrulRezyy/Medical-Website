<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
      header("Location: ".BASE_URL."/admin/login.php");
      exit;
  }

  $id_user = $_SESSION['id_user'];
  
  $id_dokter = $_GET['id_dokter'];
  $data_dokter = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM dokter INNER JOIN spesialis ON dokter.id_spesialis = spesialis.id_spesialis WHERE id_dokter = '$id_dokter'"));
  $spesialis = mysqli_query($koneksi, "SELECT * FROM spesialis ORDER BY spesialis ASC");

  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
    header("Location: ".BASE_URL."/admin/logout.php");
    exit;
  }

  if (isset($_POST['btnUbah'])) {
    $nama_dokter = htmlspecialchars(trim($_POST['nama_dokter']));
    $jadwal_praktek = htmlspecialchars(trim(nl2br($_POST['jadwal_praktek'])));
    $id_spesialis = htmlspecialchars(trim($_POST['id_spesialis']));

    if ($id_spesialis == 0) {
      setAlert("Gagal!", "Pilih Spesialis terlebih dahulu!", "error");
      echo "
        <script>
          window.history.back();
        </script>
      ";
      exit;
    }
    
    $foto_dokter = $_POST['foto_dokter_old'];
    $foto_dokter_new = $_FILES['foto_dokter']['name'];
    
    if ($foto_dokter_new != '') {
      $acc_extension = array('png','jpg', 'jpeg', 'gif');
      $extension = explode('.', $foto_dokter_new);
      $extension_lower = strtolower(end($extension));
      $size = $_FILES['foto_dokter']['size'];
      $file_tmp = $_FILES['foto_dokter']['tmp_name'];   
      
      if(!in_array($extension_lower, $acc_extension))
      {
        setAlert("Perhatian!", "File yang di upload bukan gambar!", "error");
        echo "
          <script>
            window.history.back();
          </script>
        ";
        exit;
      }

      // hapus foto lama dokter
      unlink($_SERVER['DOCUMENT_ROOT'].'/doxscien/assets/images/dokter/'.$foto_dokter);

      $foto_dokter = uniqid() . $foto_dokter_new;
      $upload = move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/doxscien/assets/images/dokter/'. $foto_dokter);
    }
    
    $update_dokter = mysqli_query($koneksi, "UPDATE dokter SET nama_dokter = '$nama_dokter', jadwal_praktek = '$jadwal_praktek', id_spesialis = '$id_spesialis', foto_dokter = '$foto_dokter' WHERE id_dokter = '$id_dokter'");

    if ($update_dokter) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Dokter $nama_dokter Berhasil diubah!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Dokter ".$nama_dokter." Berhasil diubah!", "success");
      header("Location: ".BASE_URL."/admin/dokter/index.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Dokter ".$nama_dokter." Gagal diubah!", "error");
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
  <title>Ubah Dokter - <?= $data_dokter['nama_dokter']; ?></title>
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
                  <h5 class="card-title fw-semibold">Ubah Dokter - <?= $data_dokter['nama_dokter']; ?></h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="foto_dokter_old" value="<?= $data_dokter['foto_dokter']; ?>">
                    <div class="mb-3">
                      <label for="nama_dokter" class="form-label">Nama Dokter</label>
                      <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?= $data_dokter['nama_dokter']; ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="jadwal_praktek" class="form-label">Jadwal Praktek</label>
                      <textarea class="form-control" id="jadwal_praktek" name="jadwal_praktek" required><?= strip_tags(htmlspecialchars_decode($data_dokter['jadwal_praktek'])); ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="foto_dokter" class="form-label">Foto Dokter (Upload foto jika ingin mengubah foto)</label>
                      <input type="file" class="form-control" id="foto_dokter" name="foto_dokter">
                    </div>
                    <div class="mb-3">
                      <label for="id_spesialis" class="form-label">Spesialis</label>
                      <select class="form-control" id="id_spesialis" name="id_spesialis" required>
                        <option value="<?= $data_dokter['id_spesialis']; ?>"><?= $data_dokter['spesialis']; ?></option>
                        <?php foreach ($spesialis as $data_spesialis): ?>
                          <?php if ($data_dokter['id_spesialis'] != $data_spesialis['id_spesialis']): ?>
                            <option value="<?= $data_spesialis['id_spesialis']; ?>"><?= $data_spesialis['spesialis']; ?></option>
                          <?php endif ?>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <button type="submit" name="btnUbah" class="btn btn-primary">Submit</button>
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