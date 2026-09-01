<div class="container">
	<h2><?=$title?></h2>
	<div class="row">
		<div class="col-md-8">
			<div class="login-panel panel panel-default">
				<div class="panel-body"> 
					<?php 
					if($this->session->flashdata('message')){
						echo $this->session->flashdata('message');	
					}
					?>
					<?=form_open('user/insert_group',array('id'=>'myForm','class'=>'needs-validation','novalidate' => 'novalidate'))?>
						<div class="form-group">
							<label for="inputEmail"><?php echo $this->lang->line('group'); ?> <font color="red">*</font></label> 
							<input type="text" name="group" required class="form-control" autocomplete="off" autofocus /> 
						</div>
						<div class="form-group">	 
							<label for="inputEmail"><?php echo $this->lang->line('description');?></label> 
							<textarea name="description" class="form-control myTextEditor"></textarea>
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('status');?> <font color="red">*</font></label> 
							<select name="group_status" required class="form-control">
								<option value="" hidden><?php echo $this->lang->line('select');?></option>
								<option value="<?=$this->lang->line('active')?>"><?php echo $this->lang->line('active');?></option>
								<option value="<?=$this->lang->line('inactive')?>"><?php echo $this->lang->line('inactive');?></option>
							</select>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit"><?php echo $this->lang->line('submit');?></button>
						</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>