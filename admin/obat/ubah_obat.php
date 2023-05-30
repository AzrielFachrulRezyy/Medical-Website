<?php 
  require_once '../../koneksi.php';

  if (!isset($_SESSION['id_user'])) {
      header("Location: ".BASE_URL."/admin/login.php");
      exit;
  }

  $id_user = $_SESSION['id_user'];
  
  $id_obat = $_GET['id_obat'];
  $data_obat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM obat WHERE id_obat = '$id_obat'"));

  if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
    header("Location: ".BASE_URL."/admin/logout.php");
    exit;
  }

  if (isset($_POST['btnUbah'])) {
    $nama_obat = htmlspecialchars(trim($_POST['nama_obat']));
    $deskripsi_obat = htmlspecialchars(trim($_POST['content']));

    $foto_obat = $_POST['foto_obat_old'];
    $foto_obat_new = $_FILES['foto_obat']['name'];
    
    if ($foto_obat_new != '') {
      $acc_extension = array('png','jpg', 'jpeg', 'gif');
      $extension = explode('.', $foto_obat_new);
      $extension_lower = strtolower(end($extension));
      $size = $_FILES['foto_obat']['size'];
      $file_tmp = $_FILES['foto_obat']['tmp_name'];   
      
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

      // hapus foto lama obat
      unlink($_SERVER['DOCUMENT_ROOT'].'/doxscien/assets/images/obat/'.$foto_obat);

      $foto_obat = uniqid() . $foto_obat_new;
      $upload = move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/doxscien/assets/images/obat/'. $foto_obat);
    }

    $update_obat = mysqli_query($koneksi, "UPDATE obat SET nama_obat = '$nama_obat', deskripsi_obat = '$deskripsi_obat', foto_obat = '$foto_obat' WHERE id_obat = '$id_obat'");

    if ($update_obat) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Obat $nama_obat Berhasil diubah!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Obat ".$nama_obat." Berhasil diubah!", "success");
      header("Location: ".BASE_URL."/admin/obat/index.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Obat ".$nama_obat." Gagal diubah!", "error");
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
  <title>Ubah Obat - <?= $data_obat['nama_obat']; ?></title>
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
                  <h5 class="card-title fw-semibold">Ubah Obat - <?= $data_obat['nama_obat']; ?></h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="foto_obat_old" value="<?= $data_obat['foto_obat']; ?>">
                    <div class="mb-3">
                      <label for="nama_obat" class="form-label">Nama Obat</label>
                      <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?= $data_obat['nama_obat']; ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="foto_obat" class="form-label">Foto Obat (Upload foto jika ingin mengubah foto)</label>
                      <input type="file" class="form-control" id="foto_obat" name="foto_obat">
                    </div>
                    <div class="mb-3">
                      <label for="editor" class="form-label">Deskripsi Obat</label>
                      <input type="hidden" name="content" value="<?= htmlspecialchars_decode($data_obat['deskripsi_obat']); ?>">
                      <div id="editor"><?= htmlspecialchars_decode($data_obat['deskripsi_obat']); ?></div>
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