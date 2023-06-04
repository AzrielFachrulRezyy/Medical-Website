<script src="<?= BASE_URL; ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?= BASE_URL; ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/js/sidebarmenu.js"></script>
<!-- <script src="<?= BASE_URL; ?>/assets/js/app.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/libs/simplebar/dist/simplebar.js"></script> -->
<script src="<?= BASE_URL; ?>/assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/libs/datatables/dataTables.bootstrap5.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/libs/quill/quill.js"></script>
<script src="<?= BASE_URL; ?>/assets/js/dashboard.js"></script>
<script src="<?= BASE_URL; ?>/assets/js/doxscien.js"></script>


<?php 

if (isset($_SESSION['alert'])) 
{
	$title 		= $_SESSION["alert"]["title"];
	$text 		= $_SESSION["alert"]["text"];
	$type 		= $_SESSION["alert"]["type"];
	$buttons	= $_SESSION["alert"]["buttons"];

	echo "
		<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
		<script>
	        let title = $('#msg').data('title');
	        let type = $('#msg').data('type');
	        let text = $('#msg').data('text');
	        let buttons = $('#msg').data('buttons');
	        if (text !== '' && type !== '' && title !== '') {
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