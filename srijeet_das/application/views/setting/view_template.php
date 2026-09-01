
<div class="modal-header">
    <h5 class="modal-title" id="modalTitle"><?php echo $title;?></h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-12">
				<div class="card shadow shadow-sm" id="printableArea">
					<div class="card-body">

						<?php 
						if($this->session->flashdata('message')){
							echo $this->session->flashdata('message');	
						}
						?>
						<img src="<?=base_url('uploads/'.$result['template_image'])?>" class="img-fluid" style="padding:1px; border:1px solid #999;" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-footer">
	<div class="col-lg-12 text-center">
		<a href="#" class="btn btn-default" id="printButton" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i></a>
	</div>
</div>

<script>
	function printDiv(divId) 
	{
		var divContents = document.getElementById(divId).innerHTML;
		var printWindow = window.open('', '', 'height=600,width=800');
		printWindow.document.write('<html><head><title><?=$title?></title>');
		printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">');
		printWindow.document.write('<style>body{font-family:Arial,sans-serif;font-size: 12px;}h4{font-size: 16px;font-weight:bold;}img{max-width:100%;height:auto;padding:1px;border:1px solid #333;}table{width:100%;border-collapse:collapse;}table, th, td{border:1px solid black;}th, td{font-size: 10px;padding:8px;text-align:left;}</style>');
		printWindow.document.write('</head><body>');
		printWindow.document.write(divContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.focus();
		printWindow.onload = function() {
			printWindow.print();
			printWindow.close();
		};
	}
</script>