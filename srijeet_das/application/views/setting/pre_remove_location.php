<div class="container">
	<h2><?=$title?></h2>
	<div class="row">
		<div class="col-md-6">
			<?php 
			if($this->session->flashdata('message')){
				echo $this->session->flashdata('message');	
			}
			?>
			<form method="post" action="<?php echo site_url('setting/remove_location/'.$loid);?>">
				<div class="form-group">
					<?php echo $this->lang->line('remove_location_message');?> 
				</div>
				<div class="form-group">
					<select name="mloid" required class="form-control">
						<option value="" hidden><?=$this->lang->line('select')?></option>
						<?php foreach($location_list as $gk => $val){ ?>
							<?php if($loid != $val['loid']){ ?>
								<option value="<?php echo $val['loid'];?>"><?php echo $val['location'];?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-danger" type="submit"><?php echo $this->lang->line('submit');?></button>
					<a href="<?php echo site_url('setting/location');?>" class="btn btn-default"  ><?php echo $this->lang->line('cancel');?></a>
				</div>
			</form>
		</div>
	</div>
</div>