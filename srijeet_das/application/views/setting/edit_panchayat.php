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
					<?=form_open('settings/update_panchayat/'.base64_encode(encrypt($panchayat['panchayat_id'])),array('id'=>'myForm','class'=>'needs-validation','novalidate' => 'novalidate'))?>
						<div class="form-group">
							<label for="state"><?php echo $this->lang->line('state');?> <font color="red">*</font></label> 
							<select name="state_id" id="state_id" required class="form-select select-arrow" onChange="fetch_district()" autofocus>
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($state_list as $state){ ?>
								<option value="<?=$state['state_id']?>" <?php if ($state['state_id']==$panchayat['state_id']) echo "selected"; ?>><?=$state['state']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('district');?> <font color="red">*</font></label>
							<select name="district_id" id="district_id" required class="form-select select-arrow" onChange="fetch_block()">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($district_list as $district){ ?>
								<option value="<?=$district['district_id']?>" <?php if ($district['district_id']==$panchayat['district_id']) echo "selected"; ?>><?=$district['district']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('block');?> <font color="red">*</font></label> 
							<select name="block_id" id="block_id" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($block_list as $block){ ?>
								<option value="<?=$block['block_id']?>" <?php if ($block['block_id']==$panchayat['block_id']) echo "selected"; ?>><?=$block['block']?></option>
								<?php } ?>
							</select> 
						</div>
						<div class="form-group">
							<label for="code"><?php echo $this->lang->line('panchayat');?></label> 
							<input type="text" name="panchayat" class="form-control" value="<?=$panchayat['panchayat']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('status');?> <font color="red">*</font></label> 
							<select name="panchayat_status" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?= $this->lang->line('active') ?>" <?php if($panchayat['panchayat_status']==$this->lang->line('active')) print("selected"); ?>><?php echo $this->lang->line('active');?></option>
								<option value="<?= $this->lang->line('inactive') ?>" <?php if($panchayat['panchayat_status']==$this->lang->line('inactive')) print("selected"); ?>><?php echo $this->lang->line('inactive');?></option>
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