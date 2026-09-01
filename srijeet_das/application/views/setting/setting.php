<?php $logged_in=$this->session->userdata('logged_in'); ?>
<?php $acp=explode(',',$logged_in['settings']); ?>

<div class="container">  

	<div class="row d-flex justify-content-center">
		<div class="col-md-8">
			<div class="card shadow shadow-sm">
				<div class="card-header">
					<?php echo $title;?>
				</div>
				<div class="card-body">
					<?php if($this->session->flashdata('message')){ ?>
						<?php echo $this->session->flashdata('message');?>
					<?php } ?>
			
					<?=form_open('settings/update',array('id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<ul class="nav nav-tabs mb-2">
							<?php foreach($tabs as $k => $val){ ?>
								<?php if ($k!=4) { ?>
								<li class="nav-item" style="background:#dddddd;margin-right:5px;">
									<a class="nav-link <?php if($k == 0){ echo 'active'; } ?>" data-bs-toggle="tab" href="#tab<?php echo $k;?>">
										<?php echo str_replace('_',' ',$val);?>
									</a>
								</li>
								<?php } ?>
							<?php } ?>
						</ul>
						<div class="tab-content">
							<?php foreach($tabs as $k => $val){ ?>
								<div id="tab<?php echo $k;?>" class="tab-pane fade <?php if($k == 0){ echo 'show active'; } ?>">
									<div class="card-heading" style="padding:5px;margin-left:15px;"><h4><?php echo str_replace('_',' ',$val);?></h4></div>
									<?php $set=$settings[$val]; ?>
									<?php foreach($set as $sk => $sval){ ?>
										<div class="form-group">
											<label><?php echo str_replace('_',' ',ucfirst($sk));?> </label>
											<?php if($sval[0] == 'true' || $sval[0] == 'false'){ ?>
												<select name="<?php echo $sk;?>" class="form-select form-control">
													<option value="true" <?php if($sval[0]=='true'){ echo 'selected'; } ?> ><?=$this->lang->line('enabled')?></option>
													<option value="false" <?php if($sval[0]=='false'){ echo 'selected'; } ?> ><?=$this->lang->line('disabled')?></option>
												</select>            
											<?php } else { ?>
												<input type="text" class="form-control" name="<?php echo $sk;?>" value="<?php echo $sval[0];?>" /> 
											<?php } ?>
											<span style="color:#666666;font-size:12px"><?php echo $sval[1];?></span>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>

						<div class="form-group mt-4">
							<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
							<button class="btn btn-default" type="reset"><?php echo $this->lang->line('reset');?></button>
						</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>