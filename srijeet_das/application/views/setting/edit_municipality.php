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
					<?=form_open('settings/update_municipality/'.base64_encode(encrypt($municipality['municipality_id'])),array('id'=>'myForm','class'=>'needs-validation','novalidate' => 'novalidate'))?>
						<div class="form-group">
							<label for="state"><?php echo $this->lang->line('state');?> <font color="red">*</font></label> 
							<select name="state_id" id="state_id" required class="form-select select-arrow" onChange="fetch_district()" autofocus>
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($state_list as $state){ ?>
								<option value="<?=$state['state_id']?>" <?php if ($state['state_id']==$municipality['state_id']) echo "selected"; ?>><?=$state['state']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('district');?> <font color="red">*</font></label>
							<select name="district_id" id="district_id" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($district_list as $district){ ?>
								<option value="<?=$district['district_id']?>" <?php if ($district['district_id']==$municipality['district_id']) echo "selected"; ?>><?=$district['district']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('municipality');?> <font color="red">*</font></label> 
							<input type="text" required name="municipality" class="form-control" value="<?=$municipality['municipality']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('website_url');?></label> 
							<input type="text" name="website_url" class="form-control" value="<?=$municipality['website_url']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('property_payment_url');?></label> 
							<input type="text" name="property_payment_url" class="form-control" value="<?=$municipality['property_payment_url']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('water_payment_url');?></label> 
							<input type="text" name="water_payment_url" class="form-control" value="<?=$municipality['water_payment_url']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('grabage_payment_url');?></label> 
							<input type="text" name="grabage_payment_url" class="form-control" value="<?=$municipality['grabage_payment_url']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('status');?> <font color="red">*</font></label> 
							<select name="municipality_status" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?= $this->lang->line('active') ?>" <?php if($municipality['municipality_status']==$this->lang->line('active')) print("selected"); ?>><?php echo $this->lang->line('active');?></option>
								<option value="<?= $this->lang->line('inactive') ?>" <?php if($municipality['municipality_status']==$this->lang->line('inactive')) print("selected"); ?>><?php echo $this->lang->line('inactive');?></option>
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