<?php $logged_in=$this->session->userdata('logged_in'); ?>
<?php //print_r($logged_in); ?>
<style>
/* Style for the text overlay */
.image-text {
    position: absolute;
    top: 50%; /* Center vertically */
    left: 50%; /* Center horizontally */
    transform: translate(-50%, -50%); /* Adjust for centering */
    color: white; /* Change as per your image background */
    background: rgba(0, 0, 0, 0.5); /* Optional: Add a background for readability */
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 34px;
    text-align: center;
    font-weight: bold;
    width: auto;
}
</style>
<div class="container-fluid">
   	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
			<img src="<?=base_url('assets/images/banner.jpg')?>" class="img-fluid w-100 hidden-sm hidden-xs" />
			<h3 class="image-text"><?=strtoupper($title)?></h3>
		</div>
	</div>
</div>
