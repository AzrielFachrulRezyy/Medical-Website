<?php 
	define('BASE_URL', 'http://localhost/doxscien');
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	$host = "localhost";
	$user = "root";
	$pass = "";
	$database = "doxscien";

	$koneksi = mysqli_connect($host, $user, $pass, $database);

	function setAlert($title='', $text='', $type='', $buttons='') 
	{
		$_SESSION["alert"]["title"]		= $title;
		$_SESSION["alert"]["text"] 		= $text;
		$_SESSION["alert"]["type"] 		= $type;
		$_SESSION["alert"]["buttons"]	= $buttons; 
	}

	// call alert in script
?>
