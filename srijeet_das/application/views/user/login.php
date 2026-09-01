<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
<script>
	function resizeCaptcha() {
		var width = document.querySelector('.recaptcha-container').offsetWidth;

		var scale = width / 304; // 304 = default captcha width

		var captcha = document.querySelector('.g-recaptcha');
		captcha.style.transform = "scale(" + scale + ")";
		captcha.style.transformOrigin = "0 0";
	}

	window.onload = resizeCaptcha;
	window.onresize = resizeCaptcha;
</script>
<div class="container">
	<div class="row">
		<div class="col-lg-12 d-flex justify-content-center">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card shadow shadow-sm">
					<div class="card-header reversed-header">
						<?php echo $title;?>
					</div>
					<div class="card-body">
						<?php if($this->session->flashdata('message')){ ?>
							<?php echo $this->session->flashdata('message');?>
						<?php } ?>
						<?=form_open('login/verifylogin',array('id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
							<div class="form-group">
								<label for="usr" class="lbl"><?php echo $this->lang->line('email');?> / <?php echo $this->lang->line('mobile');?> <font color="red">*</font></label>
								<input type="text" name="username" required class="form-control textbox" />
							</div>
							<div class="form-group">
								<label for="usr" class="lbl"><?php echo $this->lang->line('password');?> <font color="red">*</font></label>
								<div class="position-relative">
									<input type="password" id="password" name="password" required class="form-control textbox pe-5">
									<i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3"
									   style="cursor: pointer; color: #6c757d;" 
									   onclick="togglePassword(this, 'password')"></i>
								</div>
							</div>
							<div class="form-group mt-4">
								<button type="submit" class="btn btn-default"><?php echo $this->lang->line('login');?></button>
								<a href="<?=site_url('login/register')?>" class="btn btn-primary"><?php echo $this->lang->line('register');?></a>
							</div>
						<?=form_close()?>
						<div class="right pt-3">
							<a href="<?php echo site_url('login/forgot_password');?>"><?php echo $this->lang->line('forgot_password');?> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>