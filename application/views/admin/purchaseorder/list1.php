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
						<a href="<?php echo site_url('admin/purchaseorder/add') ?>"><i class="fas fa-plus"></i> Tambah po</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="tablePO" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No PO</th>
										<th>Tanggal PO</th>
										<th>Customer</th>
										<th>PIC Customer</th>
										<th>Marketing</th>
										<th>Potongan</th>
										<th>PPN</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($po as $rowpo): ?>
									<tr>
										<td>
											<?php echo $rowpo->nopo ?>
										</td>
										<td>
											<?php echo $rowpo->tanggalpo ?>
										</td>
										<td>
											<?php echo $rowpo->nama ?>
										</td>
										<td>
											<?php echo $rowpo->namapic ?>
										</td>
										<td>
											<?php echo $rowpo->namamarketing ?>
										</td>
										<td>
											<?php echo $rowpo->potongan ?>
										</td>
										<td>
											<?php echo $rowpo->ppn ?>
										</td>
										<td>
											<?php echo $rowpo->total ?>
										</td>
										<td width="250">
											<a href="<?php echo site_url('admin/purchaseorder/edit/'.$rowpo->nopo) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											 <a target="_blank" href="<?php echo site_url('admin/purchaseorder/cetakInvoice/'.$rowpo->nopo) ?>" class="btn btn-small text-primary"><i class="fas fa-print"></i> Print</a>
											<!-- <a onclick="deleteConfirm('<?php echo site_url('admin/purchaseorder/delete/'.$rowpo->nopo) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a> -->
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
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

			$('#tablePO').dataTable( {
				"searching": false,
				"bSort": false,
				"columnDefs": [
					{"className": "dt-center", "targets": "_all"}
				],
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
