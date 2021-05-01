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
				<div class="card mb-3">
					<div class="card-header">
						
					</div>
					<div class="card-body">
					
						<form action="" target="_blank" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="nomor">Nomor*</label>
								<input class="form-control" type="text" id="nomor" name="nomor" placeholder="Nomor Surat" />
							</div>
							<div class="form-group">
								<label for="nomor">Tanggal*</label>
								<input class="form-control tanggal" type="text" id="tanggal" name="tanggal" placeholder="Tanggal Surat" />
							</div>
							<button class="btn btn-primary" type="submit" id="btnPrint">
							<i class="fas fa-print"></i> Cetak Surat Pengembalian
							</button>
							<!-- <input class="btn btn-success" type="submit" name="btn" value="Cetak Surat Pengembalian" /> -->
						</form>
						
					</div>

					<div class="card-footer small text-muted">
						
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
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}

	$('#btnPrint').click(function () {
		if ($('#nomor').val() == '') {
			return false;			
		}
		else {
			return true;
		}
		
	});

	$(document).ready(function () {
			$('.tanggal').datepicker({
				format: "dd-mm-yyyy",
				autoclose:true
			});
	});
	</script>

</body>

</html>
