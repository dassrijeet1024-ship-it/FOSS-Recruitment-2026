<?php $logged_in=$this->session->userdata('logged_in'); ?>
<?php //print_r($logged_in); ?>
<style>
.hover-zoom {
    transition: transform 0.3s ease;
}
.hover-zoom:hover {
    transform: scale(1.1);
}
</style>
<style>
.email-wrap {
	word-break: break-all;
	overflow-wrap: break-word;
}
</style>

<div class="container">
	
	<?php if($this->session->flashdata('message')){ ?>
		<div class="row d-flex justify-content-center">
			<div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12">
				<?php echo $this->session->flashdata('message');?>
			</div>
		</div>
	<?php } ?>
	
	<div class="row d-flex justify-content-center">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
			<div class="card shadow shadow-sm mb-2">
				<div class="card-body" id="show_user_data">
					<table class="table table-bordered table-hover border-dark" width="100%">
						<tr>
							<th class="text-center">
								<?php if (!empty($user['picture'])) { ?>
									<img 
										src="<?=base_url('uploads/user/picture/'.$user['picture'])?>" 
										class="img-fluid rounded-circle shadow shadow-lg hover-zoom" 
										style="width:250px; height:250px; object-fit:cover; border:1px solid #ccc; padding:5px; margin:10px;"
									/>
								<?php } else { ?>
									<img 
										src="<?=base_url('assets/images/profile.png')?>" 
										class="img-fluid rounded-circle shadow shadow-lg hover-zoom" 
										style="width:250px; height:250px; object-fit:cover; border:1px solid #ccc; padding:5px; margin:10px;"
									/>
								<?php } ?>
							</th>
						</tr>
					</table>
					<p></p>
					<table class="table table-bordered table-hover border-dark" width="100%">
						<tr>
							<th class="text-left align-middle"><?=$this->lang->line('name')?></th>
							<td colspan="2"><?=$user['name']?></td>
						</tr>
						<tr>
							<th class="text-left align-middle"><?=$this->lang->line('mobile')?></th>
							<td colspan="2"><?=$user['mobile']?></td>
						</tr>
						<tr>
							<th class="text-left align-middle"><?=$this->lang->line('email')?></th>
							<td colspan="2" class="email-wrap"><?=$user['email']?></td>
						</tr>
						<?php if (!empty($user['gender'])) { ?>
							<tr>
								<th class="text-left align-middle"><?=$this->lang->line('gender')?></th>
								<td colspan="2"><?=$user['gender']?></td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
