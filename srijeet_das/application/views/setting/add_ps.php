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
					<?=form_open('settings/insert_ps',array('id'=>'myForm','class'=>'needs-validation','novalidate' => 'novalidate'))?>
						<div class="form-group">
							<label for="state"><?php echo $this->lang->line('state');?> <font color="red">*</font></label> 
							<select name="state_id" id="state_id" required class="form-select select-arrow" onChange="fetch_district()" autofocus>
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($state_list as $state){ ?>
								<option value="<?=$state['state_id']?>"><?=$state['state']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('district');?> <font color="red">*</font></label>
							<select name="district_id" id="district_id" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('ps');?> <font color="red">*</font></label> 
							<input type="text" required name="ps" class="form-control" placeholder="<?= $this->lang->line('ps') ?>" autocomplete="off" /> 
						</div>
						<div class="form-group">	
							<label for="inputEmail"><?php echo $this->lang->line('status');?> <font color="red">*</font></label>
							<select name="ps_status" required class="form-select select-arrow">
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