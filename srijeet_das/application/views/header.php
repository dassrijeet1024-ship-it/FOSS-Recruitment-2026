<?php $logged_in=$this->session->userdata('logged_in'); ?>
<?php //print_r($logged_in); ?>
<html lang="en">
	<head>
	<title><?=$this->config->item('app_name')?> :: <?php echo $title;?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?=$this->config->item('app_title')?>">
	<meta name="author" content="">
	
	<?php if ($this->session->userdata('logged_in')) { ?>
	<meta http-equiv="refresh" content="<?=$this->config->item('logout_timer')?>;url=<?=site_url('login/logout')?>" />
	<?php } ?>

	<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
	<link href="<?php echo base_url('assets/css/sb-admin-2.css?v=3');?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/main.css?q='.time());?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/style.css?q='.time());?>" rel="stylesheet" />
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url('assets/js/basic.js?q='.time());?>"></script>
	<script src="<?php echo base_url('assets/js/sb-admin-2.js?q='.time());?>"></script>
	
	<script>
	var base_url="<?=base_url()?>";
	</script>
	
	<style>
	.full-width-banner {
		background-image: url('<?=base_url('assets/images/bg.webp')?>');
		width: 100%;
		height: 100vh; /* Adjust height as needed */
		background-size: cover; /* Ensures the image covers the page */
		background-position: bottom center; /* Positions the image at the bottom */
		background-attachment: fixed; /* Keeps the background fixed */
	}
	</style>
	<style>
	.is-invalid {
		border-color: #ff0000 !important; /* Customize the red border */
	}
	</style>
	<script>
	function togglePassword(icon, fieldId) {
		const input = document.getElementById(fieldId);
		if (input.type === "password") {
			input.type = "text";
			icon.classList.remove("fa-eye");
			icon.classList.add("fa-eye-slash");
		} else {
			input.type = "password";
			icon.classList.remove("fa-eye-slash");
			icon.classList.add("fa-eye");
		}
	}
	</script>

</head>

<body id="page-top" class="full-width-banner">

<div id="loading">
	<img src="<?=base_url('assets/images/processing.gif')?>" id="loader" alt="Loading...">
</div>

