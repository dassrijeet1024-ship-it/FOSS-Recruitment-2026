<?php //print_r($result); ?>
<style>
.custom-img {
	max-width: 100%;
	width: auto;
	height: auto;
}
.email-wrap {
	word-break: break-all;
	overflow-wrap: break-word;
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
	<div class="card shadow shadow-sm">
		<div class="card-header reversed-header">
			<?php echo $title;?>
		</div>

		<div class="row d-flex justify-content-center">
			<div class="col-md-12">
				<div class="card shadow shadow-sm" id="printableArea">
					<div class="card-body">

						<?php 
						if($this->session->flashdata('message')){
							echo $this->session->flashdata('message');	
						}
						?>
						<div class="row">
							<div class="col-md-4 text-center">
								<?php if (!empty($user['picture'])) { ?>
									<img src="<?=base_url('uploads/user/picture/'.$user['picture'])?>" class="img-fluid" style="padding:1px; border:1px solid #999;" />
									<p></p>
								<?php } ?>
							</div>
							<div class="col-md-8">
								<table class="table table-bordered table-hover border-dark" width="100%">
									<tr>
										<th><?=$this->lang->line('name')?></th>
										<td><?=$user['name']?></td>
									</tr>
									<tr>
										<th><?=$this->lang->line('address')?></th>
										<td class="email-wrap"><?=$user['address']?></td>
									</tr>
									<tr>
										<th><?=$this->lang->line('mobile')?></th>
										<td><?=$user['mobile']?></td>
									</tr>
									<tr>
										<th><?=$this->lang->line('email')?></th>
										<td class="email-wrap"><?=$user['email']?></td>
									</tr>
									<?php if (!empty($user['gender'])) { ?>
									<tr>
										<th><?=$this->lang->line('gender')?></th>
										<td><?=$user['gender']?></td>
									</tr>
									<?php } ?>
									<tr>
										<th><?=$this->lang->line('status')?></th>
										<td><?=$user['user_status']?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>