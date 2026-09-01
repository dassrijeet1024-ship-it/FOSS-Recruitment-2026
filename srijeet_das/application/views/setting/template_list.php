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
				if (column.index() == 1 || column.index() == 3 || column.index() == 4 || column.index() == 5 || column.index() == 6 || column.index() == 7 || column.index() == 8) {
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
		"lengthMenu": [[25, 50, 100, 500, 1000, -1], [25, 50, 100, 500, 1000, "All"]],
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
	$('#example').on('click', '.view-template', function (e) {
		e.preventDefault();
		var tid = $(this).data('id'); // Assuming your button has data-id
		$.ajax({
			url: '<?= base_url("settings/view_template") ?>', // or wherever you fetch modal content
			type: 'POST',
			data: { tid: tid },
			success: function (response) {
				$('#templateModal .modal-content').html(response); // only update modal-body or entire modal-content
				$('#templateModal').modal('show'); // show modal after content loaded
			}
		});
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

<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="card shadow shadow-sm">
				<div class="card-header">
					<?php echo $title;?>
				</div>
				<div class="card-body">
					<?php if(in_array('All',explode(',',$logged_in['settings']))){ ?>
						<div class="form-group">
							<a href="<?php echo site_url('settings/add_template');?>" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add_new');?> <?php echo $this->lang->line('template');?></a>
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
								<th><?php echo $this->lang->line('survey_type');?></th>
								<th><?php echo $this->lang->line('template');?></th>
								<th><?php echo $this->lang->line('state');?></th>
								<th><?php echo $this->lang->line('district');?></th>
								<th><?php echo $this->lang->line('municipality');?></th>
								<th><?php echo $this->lang->line('block');?></th>
								<th><?php echo $this->lang->line('panchayat');?></th>
								<th class="text-center"><?php echo $this->lang->line('status');?></th>
								<th class="text-center"><?php echo $this->lang->line('action');?></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach($template_list as $template){ ?>
								<tr>
									<td class="text-center"><?= $template['tid'] ?>)</td>
									<td><?php echo strtoupper($template['survey_type']);?></td>
									<td><?php echo $template['template'];?></td>
									<td><?php echo $template['state'];?></td>
									<td><?php echo $template['district'];?></td>
									<td><?php echo $template['municipality'];?></td>
									<td><?php echo $template['block'];?></td>
									<td><?php echo $template['panchayat'];?></td>
									<td class="text-center"><?php echo $template['template_status'];?></td>
									<td class="text-center">
										<nobr>
										<?php if(in_array('All',explode(',',$logged_in['settings']))){ ?>
											<button class="btn btn-info view-template" data-id="<?=base64_encode(encrypt($template['tid']))?>">
												<i class="far fa-eye"></i></a>
											</button>
											<a href="<?php echo site_url('settings/edit_template/'.base64_encode(encrypt($template['tid'])));?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
											<a href="javascript:remove_entry('<?php echo('settings/remove_template/'.base64_encode(encrypt($template['tid'])));?>')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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

<style>
.modal-body {
	max-height: 80%;
	overflow-y: auto;
}
.modal-content {
	max-width: 100%;
}
</style>
<div class="modal fade" id="templateModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<!-- This gets replaced by AJAX -->
		</div>
	</div>
</div>