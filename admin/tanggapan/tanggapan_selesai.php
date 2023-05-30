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

$tanggapan_selesai = mysqli_query($koneksi, "UPDATE konsultasi SET status_konsultasi = 'SELESAI' WHERE id_konsultasi = '$id_konsultasi'");

if ($tanggapan_selesai) {
	$tgl_riwayat = date('Y-m-d H:i:s');
	mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Konsultasi $nama_pasien Selesai!', '$tgl_riwayat', '$id_user')");

	setAlert("Berhasil!", "Konsultasi $nama_pasien Selesai!", "success");
	header("Location:" . BASE_URL . "/admin/konsultasi/index.php");
	exit;
} else {
	setAlert("Gagal!", "Konsultasi $nama_pasien Gagal diubah!", "error");
	header("Location:" . BASE_URL . "/admin/konsultasi/index.php");
	exit;
}

?>