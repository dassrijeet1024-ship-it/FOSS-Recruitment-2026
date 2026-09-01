<?php $logged_in=$this->session->userdata('logged_in'); ?>
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

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    var exampleDataTable = $('#example').DataTable({
		initComplete: function () {
			this.api().columns().every(function () {
				var column = this;
				if (column.index() == 3) {
					var select = $('<select class="form-select select-arrow"><option value=""></option></select>')
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
		dom: 'Blfrtip',
		buttons: [
			{
				extend: 'excelHtml5',
				exportOptions: {
					columns: [0,1,2,3]
				},
			},
		],
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

	<div class="row d-flex justify-content-center">
		<div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12">
			<?php if($this->session->flashdata('message')){ ?>
				<?php echo $this->session->flashdata('message');?>
			<?php } ?>
		</div>
	</div>
	<div id="app" v-once>
		<div class="row mb-4">
			<div class="col-md-12 p-2">
				<div class="card shadow shadow-sm">
					<div class="card-header">
						<?=$title?>
					</div>
					<div class="card-body">
						<?php if(in_array('Add',explode(',',$logged_in['user']))){ ?>
							<div class="form-group">
								<a href="<?php echo site_url('user/add_user');?>" class="btn btn-default"><i class="fas fa-plus"></i> <?php echo $this->lang->line('add_new');?> <?php echo $this->lang->line('user');?></a>
							</div>
						<?php } ?>

						<table id="example" class="table table-hover table-striped table-bordered dt-responsive" style="width:100%">
							<thead>
								<tr class="main-header">
									<th>#</th>
									<th><?=$this->lang->line('name')?></th>
									<th><?=$this->lang->line('mobile')?></th>
									<th><?=$this->lang->line('account')?></th>
									<th><?=$this->lang->line('status')?></th>
									<th><?=$this->lang->line('action')?></th>
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
								</tr>
							</tfoot>
							<tbody>
								<?php foreach ($user_list as $key => $val){ ?> 
								<tr>
									<td class="text-center align-middle"><?=$key+1?>)</td>
									<td class="text-center align-middle"><?=$val['name']?></td>
									<td class="text-center align-middle"><?=$val['mobile']?></td>
									<td class="text-center align-middle"><?=$val['account']?></td>
									<td class="text-center align-middle"><?=$val['user_status']?></td>
									<td class="text-center align-middle">
										<nobr>
										<?php if(in_array('View',explode(',',$logged_in['user']))){ ?>
											<a href="<?php echo site_url('user/view_user/'.base64_encode(encrypt($val['uid']))); ?>" class="btn btn-info"><i class="far fa-eye"></i></a>
										<?php } ?>
										<?php if(in_array('Edit',explode(',',$logged_in['user']))){ ?>
											<a href="<?php echo site_url('user/edit_user/'.base64_encode(encrypt($val['uid']))); ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
										<?php } ?>
										<?php if(in_array('Remove',explode(',',$logged_in['user']))){ ?>
											<a href="javascript:remove_entry('<?php echo('user/remove_user/'.base64_encode(encrypt($val['uid'])));?>')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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
</div>
