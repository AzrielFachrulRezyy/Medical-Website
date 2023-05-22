<?php 
	define('BASE_URL', 'http://localhost/doxscien');
?>

<script src="<?= BASE_URL; ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

<?php 
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

	if (isset($_SESSION['alert'])) 
	{
		$title 		= $_SESSION["alert"]["title"];
		$text 		= $_SESSION["alert"]["text"];
		$type 		= $_SESSION["alert"]["type"];
		$buttons	= $_SESSION["alert"]["buttons"];

		echo "
			<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
			<script>
				let title 		= $('#msg').data('title');
				let type 		= $('#msg').data('type');
				let text 		= $('#msg').data('text');
				let buttons		= $('#msg').data('buttons');
				if(text != '' && type != '' && title != '') {
					Swal.fire({
						title: title,
						text: text,
						icon: type,
					});
				}
			</script>
		";
		unset($_SESSION["alert"]);
	}
?>
