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
					<?=form_open('settings/update_template/'.base64_encode(encrypt($result['tid'])),array('enctype'=>'multipart/form-data','id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<div class="form-group">
							<label for="survey_type"><?php echo $this->lang->line('survey_type');?> <font color="red">*</font></label> 
							<select name="survey_type" id="survey_type" required class="form-select select-arrow" autofocus>
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?php echo $this->lang->line('residential');?>" <?php if ($result['survey_type'] == $this->lang->line('residential')) echo "selected" ?>><?=$this->lang->line('residential')?></option>
								<option value="<?php echo $this->lang->line('commercial');?>" <?php if ($result['survey_type'] == $this->lang->line('commercial')) echo "selected" ?>><?=$this->lang->line('commercial')?></option>
								<option value="<?php echo $this->lang->line('other');?>" <?php if ($result['survey_type'] == $this->lang->line('other')) echo "selected" ?>><?=$this->lang->line('other')?></option>
							</select>
						</div>
						<div class="form-group">
							<label for="state"><?php echo $this->lang->line('state');?> <font color="red">*</font></label> 
							<select name="state_id" id="state_id" required class="form-select select-arrow" onChange="fetch_district()">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($state_list as $state){ ?>
								<option value="<?=$state['state_id']?>" <?php if ($result['state_id'] == $state['state_id']) echo "selected" ?>><?=$state['state']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('district');?> <font color="red">*</font></label>
							<select name="district_id" id="district_id" required class="form-select select-arrow" onChange="fetch_location()">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($district_list as $district){ ?>
								<option value="<?=$district['district_id']?>" <?php if ($result['district_id'] == $district['district_id']) echo "selected" ?>><?=$district['district']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="municipality"><?php echo $this->lang->line('municipality');?></label>
							<select name="municipality_id" id="municipality_id" class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($municipality_list as $municipality){ ?>
								<option value="<?=$municipality['municipality_id']?>" <?php if ($result['municipality_id'] == $municipality['municipality_id']) echo "selected" ?>><?=$municipality['municipality']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="block"><?php echo $this->lang->line('block');?></label> 
							<select name="block_id" id="block_id" class="form-select select-arrow" onChange="fetch_panchayat()">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($block_list as $block){ ?>
								<option value="<?=$block['block_id']?>" <?php if ($result['block_id'] == $block['block_id']) echo "selected" ?>><?=$block['block']?></option>
								<?php } ?>
							</select> 
						</div>
						<div class="form-group">
							<label for="panchayat"><?php echo $this->lang->line('panchayat');?></label> 
							<select name="panchayat_id" id="panchayat_id" class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<?php foreach ($panchayat_list as $panchayat){ ?>
								<option value="<?=$panchayat['panchayat_id']?>" <?php if ($result['panchayat_id'] == $panchayat['panchayat_id']) echo "selected" ?>><?=$panchayat['panchayat']?></option>
								<?php } ?>
							</select> 
						</div>
						<div class="form-group">
							<label for="template"><?php echo $this->lang->line('template');?> <font color="red">*</font></label> 
							<input type="text" required name="template" class="form-control" value="<?=$result['template']?>" autocomplete="off" /> 
						</div>
						<div class="form-group">
							<label for="template_image">
								<?php echo $this->lang->line('template_image');?>
								<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="<?=base_url('uploads/'.$result['template_image']);?>" class="openImageModal">
									<i class="far fa-eye"></i>
								</a>
							</label> 
							<input type="file" name="template_image" class="form-control" placeholder="<?= $this->lang->line('template_image') ?>" accept=".jpg" capture="camera" /> 
						</div>
						<div class="form-group">	
							<label for="inputEmail"><?php echo $this->lang->line('status');?> <font color="red">*</font></label>
							<select name="template_status" required class="form-select select-arrow">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?php echo $this->lang->line('active');?>" <?php if ($result['template_status'] == $this->lang->line('active')) echo "selected" ?>><?php echo $this->lang->line('active');?></option>
								<option value="<?php echo $this->lang->line('inactive');?>" <?php if ($result['template_status'] == $this->lang->line('inactive')) echo "selected" ?>><?php echo $this->lang->line('inactive');?></option>
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