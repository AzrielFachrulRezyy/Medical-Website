<?php 
require_once '../../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
	exit;
}

$id_user = $_SESSION['id_user'];

$id_konsultasi = htmlspecialchars($_GET['id_konsultasi']);
$data_konsultasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM konsultasi WHERE id_konsultasi = '$id_konsultasi'"));
$nama_pasien = $data_konsultasi['nama_pasien'];

$hapus_konsultasi = mysqli_query($koneksi, "DELETE FROM konsultasi WHERE id_konsultasi = '$id_konsultasi'");

if ($hapus_konsultasi) {
	$tgl_riwayat = date('Y-m-d H:i:s');
	mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Konsultasi $nama_pasien Berhasil dihapus!', '$tgl_riwayat', '$id_user')");

	setAlert("Berhasil!", "Konsultasi $nama_pasien Berhasil dihapus!", "success");
	header("Location:" . BASE_URL . "/admin/konsultasi/index.php");
	exit;
} else {
	setAlert("Gagal!", "Konsultasi $nama_pasien Gagal dihapus!", "error");
	header("Location:" . BASE_URL . "/admin/konsultasi/index.php");
	exit;
}

?>