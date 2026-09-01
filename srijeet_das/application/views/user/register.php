<?php //print_r($result); ?>
<style>
    .text-uppercase {
        text-transform: uppercase;
    }
</style>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="col-md-6">
			<div class="card shadow shadow-sm">
				<div class="card-header reversed-header">
					<?php echo $title;?>
				</div>
				<div class="card-body">
					<?php 
					if($this->session->flashdata('message')){
						echo $this->session->flashdata('message');	
					}
					?>
					<?=form_open('login/insert_register',array('enctype'=>'multipart/form-data','id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('name');?> <font color="red">*</font></label> 
							<input type="text" name="name" required value="<?= set_value('name') ?>" placeholder="<?php echo $this->lang->line('name');?>" class="form-control textbox text-uppercase" autocomplete="off" autofocus />
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('address');?></label> 
							<textarea name="address" placeholder="<?php echo $this->lang->line('address');?>" class="form-control textbox text-uppercase"><?= set_value('address') ?></textarea>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('mobile'); ?> <font color="red">*</font></label> 
							<input type="mobile" name="mobile" id="mobile" required value="<?= set_value('mobile') ?>" minlength="10" maxlength="10" placeholder="<?php echo $this->lang->line('mobile'); ?>" class="form-control textbox" autocomplete="off" />
							<div id="mobile_result"></div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('email');?> <font color="red">*</font></label> 
							<input type="email" name="email" id="email" required value="<?= set_value('email') ?>" placeholder="<?php echo $this->lang->line('email');?>" class="form-control textbox" autocomplete="off" />
							<div id="email_result"></div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('password'); ?> <font color="red">*</font></label>
							<div class="position-relative">
								<input type="password" id="password" name="password" required class="form-control textbox pe-5">
								<i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3"
								   style="cursor: pointer; color: #6c757d;" 
								   onclick="togglePassword(this, 'password')"></i>
							</div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl">Confirm <?php echo $this->lang->line('password'); ?> <font color="red">*</font></label>
							<div class="position-relative">
								<input type="password" id="conf_password" name="conf_password" required class="form-control textbox pe-5">
							</div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('gender');?></label> 
							<select name="gender" class="form-select select-arrow textbox">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?=$this->lang->line('male')?>" <?php if (set_value('gender')==$this->lang->line('male')) echo "selected"; ?> /><?php echo $this->lang->line('male');?></option>
								<option value="<?=$this->lang->line('female')?>" <?php if (set_value('gender')==$this->lang->line('female')) echo "selected"; ?> /><?php echo $this->lang->line('female');?></option>
								<option value="<?=$this->lang->line('trans')?>" <?php if (set_value('gender')==$this->lang->line('trans')) echo "selected"; ?> /><?php echo $this->lang->line('trans');?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('picture');?></label>
							<input type="file" name="picture" accept=".jpg" capture="camera" value="<?= set_value('picture') ?>" placeholder="<?php echo $this->lang->line('picture');?>" class="form-control textbox" />
						</div>
						<div class="form-group mt-4">
							<button class="btn btn-default" type="submit"><?php echo $this->lang->line('register');?></button>
						</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#mobile').on('blur', function() {
        var mobile = $(this).val();
        if (mobile.length == 10) {
            $.ajax({
                url: '<?= base_url("user/check_username_exists/") ?>'+mobile,
                type: 'POST',
                data: { mobile: mobile },
                success: function(response) {
                    if (response === 'taken') {
                        $('#mobile_result').html('<span style="color:red;">&nbsp;Username ' + mobile + ' is already taken</span>');
                    } else {
                        $('#mobile_result').html('<span style="color:green;">&nbsp;Username ' + mobile + ' is available</span>');
                    }
                }
            });
        } else {
            $('#mobile_result').html('');
        }
    });
	$('#email').on('blur', function() {
        var email = $(this).val();
		$.ajax({
			url: '<?= base_url("user/check_username_exists/") ?>'+email,
			type: 'POST',
			data: { email: email },
			success: function(response) {
				if (response === 'taken') {
					$('#email_result').html('<span style="color:red;">&nbsp;Username ' + email + ' is already taken</span>');
				} else {
					$('#email_result').html('<span style="color:green;">&nbsp;Username ' + email + ' is available</span>');
				}
			}
		});
	});
});
</script>