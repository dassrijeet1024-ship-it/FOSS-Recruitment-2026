<?php $logged_in=$this->session->userdata('logged_in'); ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap.min.css">


<script>
$(document).ready(function() {
    var exampleDataTable = $('#example').DataTable({
		initComplete: function () {
			this.api().columns().every(function () {
				var column = this;
				if (column.index() == 2) {
					var select = $('<select class="form-select select-arrow"><option value="">ALL</option></select>')
					.appendTo($(column.footer()).empty())
					.on('change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);
						column
							.search(val ? '^' + val + '$' : '', true, false)
							.draw();
					});
					column.data().unique().sort().each(function (d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		},
		autoWidth: true,
		responsive: true,
		"lengthMenu": [[50, 100, 500, 1000, -1], [50, 100, 500, 1000, "All"]],
		dom: 'lBfrtip',
		"sPaginationType": "full_numbers",
		"order": [],
		language: {
			oPaginate: {
				sNext: '<i class="fa fa-forward"></i>',
				sPrevious: '<i class="fa fa-backward"></i>',
				sFirst: '<i class="fa fa-step-backward"></i>',
				sLast: '<i class="fa fa-step-forward"></i>' 
			}
		},
		columnDefs: [
			{ responsivePriority: 1, targets: 0 },
			{ responsivePriority: 2, targets: -1 }
		]
    });
} );
</script>
<style>
tfoot input {
    width: 100%;
    padding: 3px;
    box-sizing: border-box;
}
 tfoot {
display: table-header-group;}
</style>

<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="card shadow shadow-sm">
				<div class="card-header">
					<a href="<?php echo site_url('settings/block/'.base64_encode(encrypt($district['district_id'])));?>">
						<?php echo $title;?>
					</a>
				</div>
				<div class="card-body">
					<?php if(in_array('All',explode(',',$logged_in['settings']))){ ?>
						<div class="form-group">
							<a href="<?php echo site_url('settings/add_panchayat');?>" class="btn btn-default"><i class="fas fa-plus"></i> <?php echo $this->lang->line('add_new');?> <?php echo $this->lang->line('panchayat');?></a>
						</div>
					<?php } ?>
					<?php 
					if($this->session->flashdata('message')){
						echo $this->session->flashdata('message');	
					}
					?>
					<table id="example" class="table table-hover table-striped table-bordered dt-responsive" style="width:100%">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th><?php echo $this->lang->line('panchayat');?></th>
								<th><?php echo $this->lang->line('status');?></th>
								<th class="text-center"><?php echo $this->lang->line('action');?></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($panchayat_list as $key => $val){ ?> 
							<tr>
								<td class="text-center"><?=$key+1?>)</td>
								<td><?=$val['panchayat']?></td>
								<td class="text-center"><?php echo $val['panchayat_status']; ?></td>
								<td class="text-center">
									<nobr>
									<?php if(in_array('All',explode(',',$logged_in['settings']))){ ?>
										<a href="<?php echo site_url('settings/edit_panchayat/'.base64_encode(encrypt($val['panchayat_id']))); ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
										<a href="javascript:remove_entry('<?php echo('settings/remove_panchayat/'.base64_encode(encrypt($val['panchayat_id'])));?>')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
									<?php } ?>
									</nobr>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>