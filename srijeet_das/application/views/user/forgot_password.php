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
	<div class="row justify-content-center mt-4">
		<div class="col-md-6 mb-2">
			<div class="card">
				<div class="card-header reversed-header">
					<?php echo $title;?>
				</div>
				<div class="card-body">
					<?php if($this->session->flashdata('message')){ ?>
						<?php echo $this->session->flashdata('message');?>
					<?php } ?>
					<?=form_open('login/forgot_password',array('id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<?php echo $this->lang->line('email_linked_account');?>
						<div class="form-group mt-2">
							<label for="usr" class="lbl"><?php echo $this->lang->line('email');?> / <?php echo $this->lang->line('mobile');?> <font color="red">*</font></label>
							<input type="text" id="emailInput" name="username" required class="form-control textbox" autocomplete="off" autofocus />
						</div>
						<div class="form-group recaptcha-container">
							<div class="g-recaptcha" data-sitekey="<?=$this->config->item('recaptcha_site_key')?>" style="width:100%;"></div>
						</div>
						<div class="form-group mt-4">
							<button type="submit" class="btn btn-default"><?php echo $this->lang->line('submit');?></button>
							&nbsp;
							<a href="<?php echo site_url('login');?>" class="btn btn-default"><?php echo $this->lang->line('login');?> </a>
						</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>
