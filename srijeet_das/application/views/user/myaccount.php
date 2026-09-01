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
					<?=form_open('user/update_myaccount',array('enctype'=>'multipart/form-data','id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('name');?> <font color="red">*</font></label> 
							<input type="text" name="name" required class="form-control textbox" value="<?=$user['name']?>" autocomplete="off" autofocus />
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('address');?> <font color="red">*</font></label> 
							<textarea name="address" required class="form-control textbox"><?=$user['address']?></textarea>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('mobile'); ?> <font color="red">*</font></label> 
							<input type="mobile" id="mobile" name="mobile" required maxlength="10" class="form-control textbox" value="<?=$user['mobile']?>" autocomplete="off" />
							<div id="username_result"></div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('email');?> <font color="red">*</font></label> 
							<input type="email" name="email" required class="form-control textbox" value="<?=$user['email']?>" autocomplete="off" />
						</div>
						<div class="form-group">
							<div class="position-relative">
								<label for="usr" class="lbl"><?php echo $this->lang->line('password');?> <font color="red">*</font></label>
								<input type="password" id="password" name="password" value="<?=decrypt($user['password'])?>" class="form-control textbox pe-5" />
								<i class="fa-solid fa-eye"
								   id="togglePassword"
								   style="position: absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #6c757d;"
								   onclick="togglePassword(this, 'password')"></i>
							</div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('gender');?></label> 
							<select name="gender" class="form-select select-arrow textbox">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?=$this->lang->line('male')?>" <?php if ($this->lang->line('male') == $user['gender']) echo "selected"; ?> /><?php echo $this->lang->line('male');?></option>
								<option value="<?=$this->lang->line('female')?>" <?php if ($this->lang->line('female') == $user['gender']) echo "selected";  ?> /><?php echo $this->lang->line('female');?></option>
								<option value="<?=$this->lang->line('trans')?>" <?php if ($this->lang->line('trans') == $user['gender']) echo "selected";  ?> /><?php echo $this->lang->line('trans');?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl">
								<?php echo $this->lang->line('picture');?>
								<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="<?=base_url('uploads/user/picture/'.$user['picture']);?>" class="openImageModal">
									<i class="far fa-eye"></i>
								</a>
							</label>
							<input type="file" name="picture" class="form-control textbox" placeholder="<?php echo $this->lang->line('picture');?>" />
						</div>
						<div class="form-group mt-4">
							<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
						</div>
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Image Preview</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<img id="modalImage" src="" class="img-fluid" alt="Image Preview">
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
    $(".openImageModal").click(function(){
        var imageUrl = $(this).data("bs-image");
		//console.log(imageUrl);
        $("#modalImage").attr("src", imageUrl);
    });
});
</script>
<script>
$(document).ready(function() {
    $('#mobile').on('blur', function() {
        var mobile = $(this).val();
        if (mobile.length == 10) {
            $.ajax({
                url: '<?= base_url("user/check_username_exists") ?>',
                type: 'POST',
                data: { mobile: mobile },
                success: function(response) {
                    if (response === 'taken') {
                        $('#username_result').html('<span style="color:red;">Username is already taken</span>');
                    } else {
                        $('#username_result').html('<span style="color:green;">Username is available</span>');
                    }
                },
				error: function(xhr,status,strErr){
					console.log(strErr);
				}
            });
        } else {
            $('#username_result').html('');
        }
    });
});
</script>