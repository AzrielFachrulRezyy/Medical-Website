<?php 
require_once '../../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ".BASE_URL."/admin/login.php");
	exit;
}

$id_user = $_SESSION['id_user'];

$id_obat = htmlspecialchars($_GET['id_obat']);
$data_obat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM obat WHERE id_obat = '$id_obat'"));
$nama_obat = $data_obat['nama_obat'];
$foto_obat = $data_obat['foto_obat'];

// hapus foto lama dokter
unlink($_SERVER['DOCUMENT_ROOT'].'/doxscien/assets/images/obat/'.$foto_obat);

$hapus_obat = mysqli_query($koneksi, "DELETE FROM obat WHERE id_obat = '$id_obat'");

if ($hapus_obat) {
	$tgl_riwayat = date('Y-m-d H:i:s');
	mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'Obat $nama_obat Berhasil dihapus!', '$tgl_riwayat', '$id_user')");

	setAlert("Berhasil!", "Obat $nama_obat Berhasil dihapus!", "success");
	header("Location:" . BASE_URL . "/admin/obat/index.php");
	exit;
} else {
	setAlert("Gagal!", "Obat $nama_obat Gagal dihapus!", "error");
	header("Location:" . BASE_URL . "/admin/obat/index.php");
	exit;
}

?>