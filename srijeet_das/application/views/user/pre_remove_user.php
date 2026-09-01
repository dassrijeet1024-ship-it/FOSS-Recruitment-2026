<div class="container justify-content-center align-items-center">
	<div class="row w-100">
		<div class="col-lg-12 d-flex justify-content-center">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card shadow shadow-sm">
					<div class="card-header reversed-header">
						<?=$title?>
					</div>
					<div class="card-body">
						<?php if($this->session->flashdata('message')){ ?>
							<?php echo $this->session->flashdata('message');?>
						<?php } ?>
						<?=form_open('user/remove_user/'.base64_encode(encrypt($uid)),array('id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
							<div class="form-group">
								<?php echo $this->lang->line('remove_user_message');?>
							</div>
							<div class="form-group">
								<label for="usr" class="lbl"><?php echo $this->lang->line('select');?> <?php echo $this->lang->line('user');?> <font color="red">*</font></label>
								<select name="muid" required class="form-select select-arrow textbox">
									<option value="" hidden><?php echo $this->lang->line('select');?></option>
									<?php foreach($user_list as $key => $val) { ?>
										<?php if($uid != $val['uid']){ ?>
											<option value="<?=$val['uid']?>"><?=$val['name']?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
							<div class="form-group mt-2">
								<button class="btn btn-danger" type="submit"><?php echo $this->lang->line('submit');?></button>
								<a href="<?php echo site_url('user/user_list');?>" class="btn btn-secondary"><?php echo $this->lang->line('cancel');?></a>
							</div>
						<?=form_close()?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
