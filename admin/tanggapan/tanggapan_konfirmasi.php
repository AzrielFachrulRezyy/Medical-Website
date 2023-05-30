<?php 
require_once '../../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
	exit;
}

$id_user = $_SESSION['id_user'];

$id_konsultasi = htmlspecialchars($_GET['id_konsultasi']);
$data_konsultasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM konsultasi WHERE id_konsultasi = '$id_konsultasi'"));
$data_tanggapan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tanggapan WHERE id_konsultasi = '$id_konsultasi'"));

$keterangan = $data_tanggapan['keterangan'];

$nama_pasien = $data_konsultasi['nama_pasien'];
$no_wa_pasien = $data_konsultasi['no_wa_pasien'];

$tanggapan_konfirmasi = mysqli_query($koneksi, "UPDATE konsultasi SET status_konsultasi = 'SUDAH DIKONFIRMASI' WHERE id_konsultasi = '$id_konsultasi'");

if ($tanggapan_konfirmasi) {
	$tgl_riwayat = date('Y-m-d H:i:s');
	mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Konsultasi $nama_pasien sudah dikonfirmasi!', '$tgl_riwayat', '$id_user')");

	setAlert("Berhasil!", "Konsultasi $nama_pasien sudah dikonfirmasi!", "success");
	header("Location: https://api.whatsapp.com/send?text=$keterangan&phone=$no_wa_pasien");
	exit;
} else {
	setAlert("Gagal!", "Konsultasi $nama_pasien Gagal dikonfirmasi!", "error");
	header("Location:" . BASE_URL . "/admin/tanggapan/index.php?id_konsultasi=$id_konsultasi");
	exit;
}

?>