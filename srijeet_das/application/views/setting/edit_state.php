<?php //print_r($state); ?>
<div class="container">

	<div class="row d-flex justify-content-center">
		<div class="col-md-6">
			<div class="card shadow shadow-sm">
				<div class="card-header">
					<?php echo $title;?>
				</div>
				<div class="card-body">
					<?php 
					if($this->session->flashdata('message')){
						echo $this->session->flashdata('message');	
					}
					?>
					<?=form_open('settings/update_state/'.base64_encode(encrypt($state['state_id'])),array('id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<div class="form-group">
							<label for="state"><?php echo $this->lang->line('state');?> <font color="red">*</font></label> 
							<input type="text" required name="state" value="<?=$state['state']?>" class="form-control" autocomplete="off" autofocus /> 
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('code');?> <font color="red">*</font></label> 
							<input type="text" required name="code" value="<?=$state['code']?>" class="form-control" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('state_url');?></label> 
							<input type="text" name="state_url" class="form-control" value="<?=$state['state_url']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('status');?> <font color="red">*</font></label> 
							<select name="state_status" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?= $this->lang->line('active') ?>" <?php if($state['state_status']==$this->lang->line('active')) print("selected"); ?>><?php echo $this->lang->line('active');?></option>
								<option value="<?= $this->lang->line('inactive') ?>" <?php if($state['state_status']==$this->lang->line('inactive')) print("selected"); ?>><?php echo $this->lang->line('inactive');?></option>
							</select>
						</div>
						<div class="form-group">
							<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
						</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>