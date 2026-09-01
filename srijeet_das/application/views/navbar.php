<?php $logged_in = $this->session->userdata('logged_in'); ?>
<?php //print_r($logged_in); ?>
<style>
.badge {
	position: absolute;
	top: 7px;
	right: 8px;
	padding: 3px;
	border-radius: 50%;
	background-color: red;
	color: #fff;
	font-size: 8px;
}
</style>
<style>
@media (max-width: 767px) {
	.navbar,
	.navbar a,
	.navbar-brand,
	.nav-link {
		font-size: 20px !important;
	}
	.navbar-nav > li > a,
	.navbar-brand {
		font-size: 20px !important;
    }
	.navbar .btn.dropdown-toggle {
		font-size: 20px !important;
	}
	.navbar .btn.dropdown-toggle i {
		font-size: 20px !important;
	}
}
</style>
<div class="fixed-top">

	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">

		<div class="container-fluid">
			<a class="navbar-brand" href="<?=base_url()?>">
				<img src="<?=base_url('assets/images/logo.png')?>" class="img-responsive" width="100" />
			</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<i class="bi bi-three-dots-vertical"></i>
			</button>
		
			<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
				<ul class="navbar-nav">
					
					<?php if ($this->session->userdata('logged_in')) { ?>
						<li class="nav-item">
							<a class="btn btn-light" href="<?=site_url('user/dashboard')?>">
								<i class="fa-solid fa-gauge"></i>&nbsp;<?=$this->lang->line('dashboard')?>
							</a>
						</li>
					<?php } ?>
					
					<?php if ($this->session->userdata('logged_in')) { ?>
						<?php if(in_array('All',explode(',',$logged_in['settings']))){ ?>
							<li class="nav-item dropdown">
								<button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-cog"></i>&nbsp;<?=$this->lang->line('settings')?>
								</button>
								<ul class="dropdown-menu dropdown-menu-dark">
									<li><a class="dropdown-item" href="<?=site_url('settings')?>"><i class="fa-solid fa-gears"></i>&nbsp;<?=$this->lang->line('settings')?></a></li>
									<li><a class="dropdown-item" href="<?=site_url('account')?>"><i class="fa-solid fa-user-gear"></i>&nbsp;<?=$this->lang->line('account')?></a></li>
								</ul>
							</li>
						<?php } ?>
					<?php } ?>
					<?php if ($this->session->userdata('logged_in')) { ?>
						<?php if(in_array('Add',explode(',',$logged_in['user'])) || in_array('List',explode(',',$logged_in['user'])) || in_array('List_all',explode(',',$logged_in['user']))){ ?>
							<li class="nav-item dropdown">
								<button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-users"></i>&nbsp;<?=$this->lang->line('users')?>
								</button>
								<ul class="dropdown-menu dropdown-menu-dark">
									<?php if(in_array('Add',explode(',',$logged_in['user']))){ ?>
										<li><a class="dropdown-item" href="<?=site_url('user/add_user')?>"><i class="fa-solid fa-person-circle-plus"></i>&nbsp;<?=$this->lang->line('add_user')?></a></li>
									<?php } ?>
									<?php if(in_array('List',explode(',',$logged_in['user'])) || in_array('List_all',explode(',',$logged_in['user']))){ ?>
										<li><a class="dropdown-item" href="<?=site_url('user/user_list')?>"><i class="fa-solid fa-users-between-lines"></i>&nbsp;<?=$this->lang->line('user_list')?></a></li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
					<?php } ?>
					<?php if (!$this->session->userdata('logged_in')) { ?>
						<li class="nav-item">
							<a class="btn btn-light" href="<?=site_url('login')?>">
								<i class="fa-solid fa-user-tie"></i>&nbsp;<?=$this->lang->line('login')?>
							</a>
						</li>
					<?php } else { ?>
						<li class="nav-item dropdown">
							<button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa-solid fa-user-tie"></i>&nbsp;<?=substr($logged_in['name'],0,5)?>
							</button>
							<ul class="dropdown-menu dropdown-menu-dark">
								<?php if ($this->session->userdata('logged_in')) { ?>
									<?php if(in_array('Myaccount',explode(',',$logged_in['user']))){ ?>
									<li><a class="dropdown-item" href="<?=site_url('user/myaccount')?>"><i class="fa-solid fa-house-user"></i>&nbsp;<?=$this->lang->line('myaccount')?></a></li>
									<li><hr class="dropdown-divider"></li>
									<?php } ?>
									<li><a class="dropdown-item" href="<?=site_url('login/logout')?>"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;<?=$this->lang->line('logout')?></a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
</div>
