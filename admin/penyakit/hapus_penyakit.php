<?php 
require_once '../../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
	exit;
}

$id_user = $_SESSION['id_user'];

$id_penyakit = htmlspecialchars($_GET['id_penyakit']);
$data_penyakit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM penyakit WHERE id_penyakit = '$id_penyakit'"));
$nama_penyakit = $data_penyakit['nama_penyakit'];

$hapus_penyakit = mysqli_query($koneksi, "DELETE FROM penyakit WHERE id_penyakit = '$id_penyakit'");

if ($hapus_penyakit) {
	$tgl_riwayat = date('Y-m-d H:i:s');
	mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Penyakit $nama_penyakit Berhasil dihapus!', '$tgl_riwayat', '$id_user')");

	setAlert("Berhasil!", "Penyakit $nama_penyakit Berhasil dihapus!", "success");
	header("Location:" . BASE_URL . "/admin/penyakit/index.php");
	exit;
} else {
	setAlert("Gagal!", "Penyakit $nama_penyakit Gagal dihapus!", "error");
	header("Location:" . BASE_URL . "/admin/penyakit/index.php");
	exit;
}

?>