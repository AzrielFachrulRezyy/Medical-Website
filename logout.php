<?php 
	require_once 'koneksi.php';

	$id_user = $_SESSION['id_user'];
    $tgl_riwayat = date('Y-m-d H:i:s');
    mysqli_query($koneksi, "INSERT INTO riwayat VALUES ('', 'User Berhasil logout!', '$tgl_riwayat', '$id_user')");
	
	session_destroy();
	header("Location: ".BASE_URL."/login.php");
	exit;
?>