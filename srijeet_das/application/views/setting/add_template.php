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
					<?=form_open('settings/insert_template',array('enctype'=>'multipart/form-data','id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<div class="form-group">
							<label for="survey_type"><?php echo $this->lang->line('survey_type');?> <font color="red">*</font></label> 
							<select name="survey_type" id="survey_type" required class="form-select select-arrow" autofocus>
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?php echo $this->lang->line('residential');?>"><?=$this->lang->line('residential')?></option>
								<option value="<?php echo $this->lang->line('commercial');?>"><?=$this->lang->line('commercial')?></option>
								<option value="<?php echo $this->lang->line('other');?>"><?=$this->lang->line('other')?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="state"><?php echo $this->lang->line('state');?> <font color="red">*</font></label> 
							<select name="state_id" id="state_id" required class="form-select select-arrow" onChange="fetch_district()">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($state_list as $state){ ?>
								<option value="<?=$state['state_id']?>"><?=$state['state']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('district');?> <font color="red">*</font></label>
							<select name="district_id" id="district_id" required class="form-select select-arrow" onChange="fetch_location()">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="municipality"><?php echo $this->lang->line('municipality');?></label>
							<select name="municipality_id" id="municipality_id" class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="block"><?php echo $this->lang->line('block');?></label> 
							<select name="block_id" id="block_id" class="form-select select-arrow" onChange="fetch_panchayat()">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
							</select> 
						</div>
						<div class="form-group">
							<label for="panchayat"><?php echo $this->lang->line('panchayat');?></label> 
							<select name="panchayat_id" id="panchayat_id" class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
							</select> 
						</div>
						<div class="form-group">
							<label for="template"><?php echo $this->lang->line('template');?> <font color="red">*</font></label> 
							<input type="text" required name="template" class="form-control" placeholder="<?= $this->lang->line('template') ?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label for="template_image"><?php echo $this->lang->line('template_image');?> <font color="red">*</font></label> 
							<input type="file" required name="template_image" class="form-control" placeholder="<?= $this->lang->line('template_image') ?>" accept=".jpg" capture="camera" /> 
						</div>
						<div class="form-group">	
							<label for="inputEmail"><?php echo $this->lang->line('status');?> <font color="red">*</font></label>
							<select name="template_status" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?php echo $this->lang->line('active');?>"><?php echo $this->lang->line('active');?></option>
								<option value="<?php echo $this->lang->line('inactive');?>"><?php echo $this->lang->line('inactive');?></option>
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