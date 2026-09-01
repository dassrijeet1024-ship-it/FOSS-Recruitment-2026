<script>
setTimeout(function() {
	window.close();
}, 2000);
</script>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="col-md-6">
			<div class="card shadow shadow-sm">
				<div class="card-header">
					<?php echo $title;?>
				</div>
				<div class="card-body">
					<div class="form-group d-flex justify-content-center">
						<p><img src="<?=base_url('assets/images/processing.gif')?>" id="loader" alt="Loading..." style="height: 80px;"></p>
					</div>
					<div class="form-group">
						<?php 
							if($this->session->flashdata('message')){
								echo $this->session->flashdata('message');	
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
