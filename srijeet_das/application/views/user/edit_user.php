<?php //print_r($result); ?>
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
					<?=form_open('user/update_user/'.base64_encode(encrypt($result['uid'])),array('enctype'=>'multipart/form-data','id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('name');?> <font color="red">*</font></label> 
							<input type="text" name="name" required value="<?=$result['name']; ?>" class="form-control textbox text-uppercase" autocomplete="off" autofocus />
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('address');?></label> 
							<textarea name="address" class="form-control textbox text-uppercase"><?=$result['address']; ?></textarea>
						</div>
						<div class="form-group">	 
							<label for="usr" class="lbl"><?php echo $this->lang->line('mobile'); ?> <font color="red">*</font></label> 
							<input type="text" id="mobile" name="mobile" required value="<?=$result['mobile']; ?>" class="form-control textbox" autocomplete="off" />
							<div id="mobile_result"></div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('email');?> <font color="red">*</font></label> 
							<input type="email" id="email" name="email" required class="form-control textbox" value="<?=$result['email']; ?>" autocomplete="off" />
							<div id="email_result"></div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('password');?> <font color="red">*</font></label> 
							<div class="position-relative">
								<input type="password" id="password" name="password" required value="<?=$result['password']?>" class="form-control textbox pe-5">
								<i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3"
								   style="cursor: pointer; color: #6c757d;" 
								   onclick="togglePassword(this, 'password')"></i>
							</div>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('gender');?></label> 
							<select name="gender" class="form-select select-arrow textbox">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?=$this->lang->line('male')?>" <?php if($result['gender']==$this->lang->line('male')){ echo 'selected';}?>><?php echo $this->lang->line('male');?></option>
								<option value="<?=$this->lang->line('female')?>" <?php if($result['gender']==$this->lang->line('female')){ echo 'selected';}?>><?php echo $this->lang->line('female');?></option>
								<option value="<?=$this->lang->line('trans')?>" <?php if($result['gender']==$this->lang->line('trans')){ echo 'selected';}?>><?php echo $this->lang->line('trans');?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl">
								<?php echo $this->lang->line('picture');?>
								<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="<?=base_url('uploads/user/picture/'.$result['picture']);?>" class="openImageModal">
									<i class="far fa-eye"></i>
								</a>
							</label>
							<input type="file" name="picture" class="form-control textbox" placeholder="<?php echo $this->lang->line('picture');?>" />
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('account');?> <font color="red">*</font></label> 
							<select name="su" id="su" required class="form-select select-arrow textbox">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach($account_list as $account){ ?>
								<option value="<?php echo $account['aid'];?>" <?php if($result['su']==$account['aid']){ echo 'selected';}?>><?php echo $account['account'];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="usr" class="lbl"><?php echo $this->lang->line('status');?> <font color="red">*</font></label> 
							<select name="user_status" required class="form-select select-arrow textbox">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?=$this->lang->line('active')?>" <?php if($result['user_status']==$this->lang->line('active')){ echo 'selected';}?> /><?php echo $this->lang->line('active');?></option>
								<option value="<?=$this->lang->line('inactive')?>" <?php if($result['user_status']==$this->lang->line('inactive')){ echo 'selected';}?> /><?php echo $this->lang->line('inactive');?></option>
								<option value="<?=$this->lang->line('archive')?>" <?php if($result['user_status']==$this->lang->line('archive')){ echo 'selected';}?> /><?php echo $this->lang->line('archive');?></option>
							</select>
						</div>
						<div class="form-group mt-4">
							<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
						</div>
					<?=form_close()?>
				</div>
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
		console.log(imageUrl);
        $("#modalImage").attr("src", imageUrl);
    });
});
</script>
<script>
$(document).ready(function() {
    $('#mobile').on('blur', function() {
        var mobile = $('#mobile').val();
        if (mobile.length == 10) {
			$.ajax({
                url: '<?=base_url("user/unique_mobile")?>',
                type: 'POST',
                data: { 
					uid: '<?=$result['uid']?>',
					mobile: mobile,
				},
                success: function(response) {
                    if (response === 'taken') {
                        $('#mobile_result').html('<span style="color:red;"><?=$this->lang->line('mobile_in_use')?></span>');
                    }
                },
				error: function(xhr,status,strErr){
					$('#mobile_result').html('');
				}
            });
        } else {
            $('#mobile_result').html('Invalid mobile number');
        }
    });
	
	$('#email').on('blur', function() {
        var email = $('#email').val();
		$.ajax({
			url: '<?=base_url("user/unique_email")?>',
			type: 'POST',
			data: { 
				uid: '<?=$result['uid']?>',
				email: email,
			},
			success: function(response) {
				if (response === 'taken') {
					$('#email_result').html('<span style="color:red;"><?=$this->lang->line('email_in_use')?></span>');
				}
			},
			error: function(xhr,status,strErr){
				$('#email_result').html('');
			}
		});
    });
	
});
</script>