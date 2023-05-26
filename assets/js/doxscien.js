$(document).ready(function() {
	$('.btn-delete').on('click', function(e){
		e.preventDefault();

		const href = $(this).attr('href');
		const nama 	= $(this).data('nama');

		Swal.fire({
		  title: 'Apakah Anda yakin?',
		  text: nama,
		  icon: 'warning',
		  showCancelButton: true,
		  cancelButtonColor: '#3085d6',
		  confirmButtonColor: '#d33',
		  confirmButtonText: 'Hapus',
		  cancelButtonText: 'Batal'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = href;
		  }
		});
	});
});

var quill = new Quill('#editor', {
	theme: 'snow',
	modules: {
    	toolbar: [
	        [{ header: [1, 2, 3, 4, 5, 6, false] }],
	        [{ font: [] }],
	        ["bold", "italic"],
	        ["link", "blockquote", "code-block", "image"],
	        [{ list: "ordered" }, { list: "bullet" }],
	        [{ script: "sub" }, { script: "super" }],
	        [{ color: [] }, { background: [] }],
      	]
    }
});

quill.on('text-change', function (delta, oldDelta, source) {
	document.querySelector("input[name='content']").value = quill.root.innerHTML;
});

