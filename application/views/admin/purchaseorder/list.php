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
						<a href="<?php echo site_url('admin/purchaseorder/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah PO</a>
						<button class="btn btn-success" type="button" id="btnEdit"><i class="fas fa-edit"></i> Edit PO</button>
						<button class="btn btn-danger" type="button" id="btnDelete"><i class="fas fa-trash"></i> Hapus PO</button>
						<button class="btn btn-warning" type="button" id="btnPrintInvoice"><i class="fas fa-print"></i> Print Invoice</button>
						<button class="btn btn-secondary" type="button" id="btnPrintSJ"><i class="fas fa-print"></i> Print Surat Jalan</button>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="tablePO" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th><input type="checkbox" class="selectAll"></th>
										<th>No PO</th>
										<th>Tanggal PO</th>
										<th>Customer</th>
										<th>PIC Customer</th>
										<th>Marketing</th>
										<th>Potongan</th>
										<th>PPN</th>
										<th>Total</th>
										
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
			var tablePO = $('#tablePO').dataTable( {
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
					"url": "<?php echo site_url('admin/PurchaseOrder/getAllPO')?>"
				},
				columns: [
					{
						data:   "nopo",
						sortable: false,
						render: function ( data, type, row ) {
							if ( type === 'display' ) {
								return '<input type="checkbox" class="_check" value="' + data + '" onclick="uncheckAll(this)">';
							}
							return data;
						},
					},
					{ data: "nopo", sortable: true },
					{ data: "tanggalpo", sortable: true },
					{ data: "nama", sortable: true },
					{ data: "namapic", sortable: true },
					{ data: "namamarketing", sortable: true },
					{ data: "potongan", sortable: false },
					{ data: "ppn", sortable: false },
					{ 
						data: "total",
						sortable: false,
						render: function ( data, type, row ) {
							var dataNumber = commaSeparateNumber(data);
							return dataNumber;
						},
					},
					
				],
				columnDefs: [{
					orderable: false,
					targets: 0
				}],
				select: {
					style: 'os',
					selector: 'td:first-child'
				},
				order: [
					[1, 'asc']
				]
			});

			$(".selectAll").on( "click", function(e) {
				if ($(this).is(":checked")) {
					$('._check').prop('checked', true);
				} else {
					$('._check').prop('checked', false);
				}
			});

			

			$('#btnEdit').click(function(){
				var _arr = [];
				// Read all checked checkboxes
				$("input:checkbox[class=_check]:checked").each(function () {
					_arr.push($(this).val());
				});
				
				if (_arr.length < 1) {
					Swal.fire({
						title: 'Kesalahan!',
						text: 'Silahkan pilih satu nomor PO',
						icon: 'error',
						// confirmButtonText: 'Ok'
					});
				} else if (_arr.length > 1) {
					Swal.fire({
						title: 'Kesalahan!',
						text: 'Hanya boleh memilih satu nomor PO',
						icon: 'error',
						// confirmButtonText: 'Ok'
					});
				} else {
					window.location.href="<?php echo base_url('admin/purchaseorder/edit/'); ?>" + _arr[0];
				}
				
			});

			$('#btnDelete').click(function(){
				var _arr = [];
				// Read all checked checkboxes
				$("input:checkbox[class=_check]:checked").each(function () {
					_arr.push($(this).val());
				});
				
				if (_arr.length < 1) {
					Swal.fire({
						title: 'Kesalahan!',
						text: 'Silahkan pilih minimal satu nomor PO',
						icon: 'error',
						// confirmButtonText: 'Ok'
					});
				} else {
					Swal.fire({
						title: 'Apakah anda yakin ?',
						text: 'Data yang dihapus tidak akan bisa dikembalikan.',
						icon: 'warning',
						showConfirmButton: true,
						showCancelButton: true,
						confirmButtonText: 'Yes',
    					cancelButtonText: "No",
						// confirmButtonText: 'Ok'
					}).then(function(isConfirm) {
						if (isConfirm) {
							var url = "<?php echo base_url('admin/purchaseorder/deletePO'); ?>";
							console.log(url)
							$.ajax({  
								url: url,  
								method:"POST",  
								data:{datapo:_arr},  
								success:function(data)  
								{  
									Swal.fire({
										title: 'Success!',
										text: 'Data PO berhasil dihapus',
										icon: 'success',
										// confirmButtonText: 'Ok'
									}).then(function() {
										$('#tablePO').DataTable().ajax.reload();
										$('.selectAll').prop('checked', false);
									});

								}  
							});  
						} 
					});
				}
				
			});

			$('#btnPrintInvoice').click(function(){
				var _arr = [];
				// Read all checked checkboxes
				$("input:checkbox[class=_check]:checked").each(function () {
					_arr.push($(this).val());
				});
				
				if (_arr.length < 1) {
					Swal.fire({
						title: 'Kesalahan!',
						text: 'Silahkan pilih minimal satu nomor PO',
						icon: 'error',
						// confirmButtonText: 'Ok'
					});
				} else {
					var url = "<?php echo base_url('admin/purchaseorder/cetakInvoices'); ?>";
					$.ajax({  
						url: url,  
						method:"POST",  
						data:{datapo:_arr[0]},  
						success:function(data)  
						{  
							console.log(data)
						}  
					});  
				}
				
			});

			$('#btnPrintSJ').click(function(){
				var _arr = [];
				// Read all checked checkboxes
				$("input:checkbox[class=_check]:checked").each(function () {
					_arr.push($(this).val());
				});
				
				if (_arr.length < 1) {
					Swal.fire({
						title: 'Kesalahan!',
						text: 'Silahkan pilih minimal satu nomor PO',
						icon: 'error',
						// confirmButtonText: 'Ok'
					});
				}
				
			});
	});

	function commaSeparateNumber(val){
			while (/(\d+)(\d{3})/.test(val.toString())){
			val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return val;
	}

	function uncheckAll(e){
		if (!$(e).is(":checked")) {
			$('.selectAll').prop('checked', false);
		}
	}
	</script>

</body>

</html>
