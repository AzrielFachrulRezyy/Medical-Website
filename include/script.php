<script src="<?= BASE_URL; ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<!-- bootstrap js -->
<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/bootstrap.js"></script>
<!-- owl slider -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- custom js -->
<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/custom.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->
<!-- Swiper JS -->
<script src="<?= BASE_URL; ?>/assets/js/swiper-bundle.min.js"></script>

<!-- JavaScript -->
<script src="<?= BASE_URL; ?>/assets/js/script.js"></script>

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