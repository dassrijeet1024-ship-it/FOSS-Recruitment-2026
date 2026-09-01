<style>
	.panel-title a {
		display: block;
		position: relative;
	}
	.panel-title a:after {
		content: '\f068'; /* FontAwesome unicode for plus */
		font-family: 'FontAwesome';
		position: absolute;
		right: 20px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 18px;
	}
	.panel-title a.collapsed:after {
		content: '\f067'; /* FontAwesome unicode for minus */
	}
</style>

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
					<?=form_open('account/insert_account/',array('id'=>'myForm','class'=>'needs-validation','novalidate'=>'novalidate'))?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label><b>Name</b> <font color="red">*</font></label>
									<input type="text" name="account" value="<?=$result['account']?>" required class="form-control" autofocus />
								</div>
								<div class="form-group">
									<label><b>Description</b></label>
									<textarea name="description" class="form-control"><?=$result['description']?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel-group" id="accordion">
									<div class="panel panel-default m-2">
										<div class="panel-heading">
											<h4 class="panel-title mx-3">
												<a data-bs-toggle="collapse" data-parent="#accordion" href="#collapseSettings" class="collapsed mx-2">Settings</a>
											</h4>
										</div>
										<div id="collapseSettings" class="panel-collapse collapse" style="background-color:#eee; border:1px solid #ccc;">
											<div class="panel-body">
												<div class="form-group m-2">
													<label><b>Settings</b></label><br>
													<label class="checkbox-inline mx-2">
													<input type="checkbox" value="All" name="settings" /> All &nbsp;
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-default m-2">
										<div class="panel-heading">
											<h4 class="panel-title mx-3">
												<a data-bs-toggle="collapse" data-parent="#accordion" href="#collapseUser" class="collapsed mx-2">User</a>
											</h4>
										</div>
										<div id="collapseUser" class="panel-collapse collapse" style="background-color:#eee; border:1px solid #ccc;">
											<div class="form-group m-2">
												<label><b>User</b></label><br>
												<label class="checkbox-inline">
													<input type="checkbox" value="Add" name="user[]" /> Add&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="Edit" name="user[]" /> Edit&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="View" name="user[]" /> View&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="Download" name="user[]" /> Download&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="List" name="user[]" /> List&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="List_all" name="user[]" /> List All&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="Myaccount" name="user[]" /> My Account&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="Remove" name="user[]" /> Remove&nbsp;&nbsp;
												</label>
												<label class="checkbox-inline">
													<input type="checkbox" value="Report" name="user[]" /> Report&nbsp;&nbsp;
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label><b><?php echo $this->lang->line('status');?></b> <font color="red">*</font></label> 
									<select name="account_status" required class="form-control">
										<option value="" hidden><?php echo $this->lang->line('select');?></option>
										<option value="<?= $this->lang->line('active') ?>"><?php echo $this->lang->line('active');?></option>
										<option value="<?= $this->lang->line('inactive') ?>"><?php echo $this->lang->line('inactive');?></option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="form-group mt-2">
									<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
								</div>
							</div>
						</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// Change the plus/minus icon when the collapse element is shown or hidden
	$('#accordion').on('show.bs.collapse', function (e) {
		$(e.target).prev('.panel-heading').find('.panel-title a').removeClass('collapsed');
	}).on('hide.bs.collapse', function (e) {
		$(e.target).prev('.panel-heading').find('.panel-title a').addClass('collapsed');
	});
</script>