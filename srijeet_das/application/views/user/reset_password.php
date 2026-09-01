
	<div class="container">
		<div class="row justify-content-center mt-4">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
				<div class="card">
					<div class="card-header reversed-header">
						<?php echo $title;?>
					</div>
					<div class="card-body">
						<?php if($this->session->flashdata('message')){ ?>
							<?php echo $this->session->flashdata('message');?>
						<?php } ?>
						<?= form_open('login/reset_password',array('id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate')) ?>
							<div class="form-group">
								<label for="usr" class="lbl"><?php echo $this->lang->line('email');?> <font color="red">*</font></label>
								<input type="text" name="username" required value="<?=$username?>" class="form-control textbox" readonly autocomplete="off">
							</div>
							<div class="form-group">
								<label for="usr" class="lbl">New password <font color="red">*</font></label>
								<div class="position-relative">
									<input type="password" id="password" name="password" class="form-control textbox pe-5">
									<i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3"
									   style="cursor: pointer; color: #6c757d;" 
									   onclick="togglePassword(this, 'password')"></i>
								</div>
							</div>
							<div class="form-group">
								<label for="usr" class="lbl">Confirm password <font color="red">*</font></label>
								<input type="password" name="confpassword" required
									placeholder="Retype password" class="form-control textbox" autocomplete="off">
							</div>
							<div class="row mb-3 px-3 d-flex justify-content-1 logindiv">
								Password should be minimum 8 characters with combination of Uppercase, lowercase, numbers and special characters.
							</div>
							<div class="form-group mt-4">
								<?= form_submit(array('type'=>'submit', 'value'=>$this->lang->line("submit"), 'class'=>'btn btn-default')) ?>
							</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
