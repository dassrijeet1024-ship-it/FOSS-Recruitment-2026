<?php //print_r($result); ?>
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
					<?=form_open('settings/update_ps/'.base64_encode(encrypt($ps['ps_id'])),array('id'=>'myForm','class'=>'needs-validation','novalidate' => 'novalidate'))?>
						<div class="form-group">
							<label for="state"><?php echo $this->lang->line('state');?> <font color="red">*</font></label> 
							<select name="state_id" id="state_id" required class="form-select select-arrow" onChange="fetch_district()" autofocus>
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($state_list as $state){ ?>
								<option value="<?=$state['state_id']?>" <?php if ($state['state_id']==$ps['state_id']) echo "selected"; ?>><?=$state['state']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('district');?> <font color="red">*</font></label>
							<select name="district_id" id="district_id" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($district_list as $district){ ?>
								<option value="<?=$district['district_id']?>" <?php if ($district['district_id']==$ps['district_id']) echo "selected"; ?>><?=$district['district']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('ps');?> <font color="red">*</font></label> 
							<input type="text" required name="ps" class="form-control" value="<?=$ps['ps']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('status');?> <font color="red">*</font></label> 
							<select name="ps_status" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?= $this->lang->line('active') ?>" <?php if($ps['ps_status']==$this->lang->line('active')) print("selected"); ?>><?php echo $this->lang->line('active');?></option>
								<option value="<?= $this->lang->line('inactive') ?>" <?php if($ps['ps_status']==$this->lang->line('inactive')) print("selected"); ?>><?php echo $this->lang->line('inactive');?></option>
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