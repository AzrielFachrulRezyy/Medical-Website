<?php 
require_once '../../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
	exit;
}

$id_user = $_SESSION['id_user'];

$id_spesialis = htmlspecialchars($_GET['id_spesialis']);
$data_spesialis = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM spesialis WHERE id_spesialis = '$id_spesialis'"));
$spesialis = $data_spesialis['spesialis'];

$hapus_spesialis = mysqli_query($koneksi, "DELETE FROM spesialis WHERE id_spesialis = '$id_spesialis'");

if ($hapus_spesialis) {
	$tgl_riwayat = date('Y-m-d H:i:s');
	mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Spesialis $spesialis Berhasil dihapus!', '$tgl_riwayat', '$id_user')");

	setAlert("Berhasil!", "Spesialis $spesialis Berhasil dihapus!", "success");
	header("Location:" . BASE_URL . "/admin/spesialis/index.php");
	exit;
} else {
	setAlert("Gagal!", "Spesialis $spesialis Gagal dihapus!", "error");
	header("Location:" . BASE_URL . "/admin/spesialis/index.php");
	exit;
}

?>