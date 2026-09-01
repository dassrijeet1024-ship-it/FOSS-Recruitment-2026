	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-5">
				<img src="<?=base_url('assets/images/spacer.gif')?>" class="mt-3" />
			</div>
		</div>
	</div>
	<footer class="fixed-bottom">
		<div align="center">SRIJEET &copy; 2026</div>
	</footer>
	
	<script>
	// JavaScript for enabling Bootstrap validation
	(function () {
		'use strict';
		const form = document.getElementById('myForm');
		form.addEventListener('submit', function (event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
	})();
    </script>

	<script>
	// Wait for the page to fully load
	window.onload = function() {
		// Hide the loading div
		document.getElementById('loading').style.display = 'none';
		// Show the page content
		//document.getElementById('content').style.display = 'block';
	};
	</script>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	
	<?php if ($this->config->item('tinymce') != 'false') { ?>
		<script type="text/javascript" src="<?= base_url('editor/tinymce.min.js');?>"></script>
		<script type="text/javascript">
			tinymce.init({
				mode: 'specific_textareas',
				editor_selector : "myTextEditor",
				images_dataimg_filter: function(img) {
					return img.hasAttribute('internal-blob');
				},
				height: 200,
				theme: 'modern',
				browser_spellcheck : true,
				menubar: 'edit view insert format table', // Exclude 'file'
				plugins: [
					'lists link <?php if($this->config->item('eqneditor')){ ?>eqneditor<?php } ?> charmap preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen',
					'insertdatetime nonbreaking save table contextmenu directionality',
					'emoticons paste textcolor colorpicker textpattern codesample toc'
				],
				toolbar1: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | preview | forecolor backcolor emoticons | link <?php if($this->config->item('eqneditor')){ ?>eqneditor<?php } ?> | codesample',
				image_advtab: true,
				image_description: false,
				image_dimensions: false,
				image_class_list: [
					{title: 'Responsive', value: 'img-responsive'}
				],
				templates: [
					{ title: 'Test template 1', content: 'Test 1' },
					{ title: 'Test template 2', content: 'Test 2' }
				],
			});
		</script>
	<?php } ?>

</body>
</html>
