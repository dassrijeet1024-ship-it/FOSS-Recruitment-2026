<div class="container">
	
	<div class="row d-flex justify-content-center">
		<div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12">
			<?php if($this->session->flashdata('message')){ ?>
				<?php echo $this->session->flashdata('message');?>
			<?php } ?>
		</div>
	</div>
	
	<div class="row d-flex justify-content-center">
		<div class="col-md-8">
			<div class="card shadow shadow-sm">
				<div class="card-header">
					<?php echo $title;?>
				</div>
				<div class="card-body">
					<?=form_open('account/remove_account/'.$aid)?>
						<div class="form-group">
							<?php echo $this->lang->line('remove_account_message');?> 
						</div>
						<div class="form-group">
							<select name="maid" class="form-select select-arrow">
								<option value="" hidden><?=$this->lang->line('select')?></option>
								<?php foreach($result as $gk => $val){ ?>
									<?php if($aid != $val['aid']){ ?>
										<option value="<?php echo $val['aid'];?>"><?=$val['account']?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						<div class="form-group mt-4">
							<button class="btn btn-danger" type="submit"><?php echo $this->lang->line('submit');?></button>
							<a href="<?php echo site_url('account');?>" class="btn btn-default"><?php echo $this->lang->line('cancel');?></a>
						</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>