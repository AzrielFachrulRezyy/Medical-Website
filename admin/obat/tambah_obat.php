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

  if (isset($_POST['btnTambah'])) {
    $nama_obat = htmlspecialchars(trim($_POST['nama_obat']));
    $deskripsi_obat = htmlspecialchars(trim($_POST['content']));
    
    $foto_obat = $_FILES['foto_obat']['name'];
    if ($foto_obat != '') {
      $acc_extension = array('png','jpg', 'jpeg', 'gif');
      $extension = explode('.', $foto_obat);
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

      $foto_obat = uniqid() . $foto_obat;
      $upload = move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/doxscien/assets/images/obat/'. $foto_obat);
    } else {
      $foto_obat = 'default.jpg';
    }

    $insert_obat = mysqli_query($koneksi, "INSERT INTO obat (nama_obat, deskripsi_obat, foto_obat) VALUES ('$nama_obat', '$deskripsi_obat', '$foto_obat')");

    if ($insert_obat) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Obat $nama_obat Berhasil ditambahkan!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Obat ".$nama_obat." Berhasil ditambahkan!", "success");
      header("Location: ".BASE_URL."/admin/obat/index.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Obat ".$nama_obat." Gagal ditambahkan!", "error");
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
  <title>Tambah Obat</title>
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
                  <h5 class="card-title fw-semibold">Tambah Obat</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="nama_obat" class="form-label">Nama Obat</label>
                      <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                    </div>
                    <div class="mb-3">
                      <label for="foto_obat" class="form-label">Foto Obat</label>
                      <input type="file" class="form-control" id="foto_obat" name="foto_obat">
                    </div>
                    <div class="mb-3">
                      <label for="editor" class="form-label">Deskripsi Obat</label>
                      <input type="hidden" name="content">
                      <div id="editor"></div>
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