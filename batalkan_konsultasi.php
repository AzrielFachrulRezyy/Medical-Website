<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: ".BASE_URL."/login.php");
	    exit;
	}

	$id_konsultasi = $_GET['id_konsultasi'];
	$id_user = $_SESSION['id_user'];
	  
	if (!$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"))) {
		header("Location: ".BASE_URL."/logout.php");
	    exit;
	}

	$batalkan_konsultasi = mysqli_query($koneksi, "UPDATE konsultasi SET status_konsultasi = 'DIBATALKAN' WHERE id_konsultasi = '$id_konsultasi' AND id_user = '$id_user'");

	$nama_pasien = $dataUser['nama_lengkap'];
    if ($batalkan_konsultasi) {
      $tgl_riwayat = date('Y-m-d H:i:s');
      mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Konsultasi $nama_pasien telah dibatalkan oleh pengguna!', '$tgl_riwayat', '$id_user')");
      
      setAlert("Berhasil!", "Konsultasi ".$nama_pasien." telah dibatalkan!", "success");
      header("Location: ".BASE_URL."/dashboard.php");
      exit;
    }
    else
    {
      setAlert("Perhatian!", "Konsultasi ".$nama_pasien." gagal dibatalkan!", "error");
      echo "
        <script>
          window.history.back();
        </script>
      ";
    exit;
  }
?>