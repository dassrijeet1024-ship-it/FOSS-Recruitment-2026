<html lang="en">
	<head>
	<title><?=$title?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" />
	<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
	<link href="<?=base_url('assets/css/sb-admin-2.css')?>" rel="stylesheet" />
	<link href="<?=base_url('assets/css/style.css?q='.time())?>" rel="stylesheet" />
	<link href="<?=base_url('assets/css/main.css?q='.time())?>" rel="stylesheet" />

	<style>
	</style>
</head>
<body style="background-image: url(<?=base_url('assets/images/bg.jpg')?>);">
	<div class="container-fluid">
		<div class="row">
			<div class="col d-flex flex-column align-items-center justify-content-center main-col" style="">
				<div class="col hide-on-mobile"></div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="card shadow shadow-sm">
						<div class="card-header"><?=$title?></div>
						<div class="card-body">
							<p></p>
							<?=$message?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>