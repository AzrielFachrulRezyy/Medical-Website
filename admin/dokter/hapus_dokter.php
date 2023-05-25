<?php 
require_once '../../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
	exit;
}

$id_user = $_SESSION['id_user'];

$id_dokter = htmlspecialchars($_GET['id_dokter']);
$data_dokter = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter = '$id_dokter'"));
$nama_dokter = $data_dokter['nama_dokter'];

$hapus_dokter = mysqli_query($koneksi, "DELETE FROM dokter WHERE id_dokter = '$id_dokter'");

if ($hapus_dokter) {
	$tgl_riwayat = date('Y-m-d H:i:s');
	mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Dokter $nama_dokter Berhasil dihapus!', '$tgl_riwayat', '$id_user')");

	setAlert("Berhasil!", "Dokter $nama_dokter Berhasil dihapus!", "success");
	header("Location:" . BASE_URL . "/admin/dokter/index.php");
	exit;
} else {
	setAlert("Gagal!", "Dokter $nama_dokter Gagal dihapus!", "error");
	header("Location:" . BASE_URL . "/admin/dokter/index.php");
	exit;
}

?>