<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
					<a href="<?php echo site_url('admin/cashflow/add') ?>"><i class="fas fa-plus"></i> Tambah Cashflow</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="tableCashflow" width="100%" cellspacing="0">
								<thead>
									<tr>										
										<th>Tanggal</th>
										<th>Keterangan</th>
										<th>Jumlah</th>
										<th>PPN</th>
										<th>Nomor PO</th>
										<th>Nama</th>
										<th>Jenis</th>
										<th>Jenis 2</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>

	<?php $this->load->view("admin/_partials/js.php") ?>

	<script>
	$(document).ready(function () {
			var tableCashflow = $('#tableCashflow').dataTable( {
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
					"url": "<?php echo site_url('admin/cashflow/getCashFlow')?>"
				},
				columns: [
					{ data: "tanggal", sortable: true },
					{ data: "keterangan", sortable: true },
					{ 
						data: "jumlah",
						sortable: false,
						render: function ( data, type, row ) {
							var dataNumber = commaSeparateNumber(data);
							return dataNumber;
						},
					},
					{ data: "ppn", sortable: true },
					{ data: "nomorpo", sortable: true },
					{ data: "nama", sortable: false },
					{ data: "jenis", sortable: false },
					{ data: "jenis2", sortable: false },
					{ data: "status", sortable: false },
					{
						data:   "kdcashflow",
						sortable: false,
						render: function ( data, type, row ) {
							if ( type === 'display' ) {
								var btn = '<a href="<?php echo site_url("admin/cashflow/edit/") ?>' + data + '" class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>' +
										  '<a onclick=\'deleteConfirm("<?php echo site_url("admin/cashflow/delete/") ?>' + data + '")\' href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>';
								return btn;
							}
							return data;
						},
					}
					
				],
				columnDefs: [{
					orderable: false,
					targets: 0
				}],
				order: [
					[1, 'asc']
				]
			});

	});

	function commaSeparateNumber(val){
			while (/(\d+)(\d{3})/.test(val.toString())){
			val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return val;
	}

	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}

	</script>

</body>

</html>
