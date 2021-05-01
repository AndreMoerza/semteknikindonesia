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

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('admin/cashflow/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/cashflow/edit') ?>" method="post" enctype="multipart/form-data">
							
							<input type="hidden" name="kdcashflow" value="<?php echo $cashflow->kdcashflow?>" />
						
							<div class="row">
								
								<div class="form-group col-lg-6">
									<label for="tanggal">Tanggal*</label>
									<input class="form-control tanggal <?php echo form_error('tanggal') ? 'is-invalid':'' ?>"
									type="text" name="tanggal" id="tanggalpo" placeholder="Tanggal" readonly value="<?php echo $cashflow->tanggal?>" />
									<div class="invalid-feedback">
										<?php echo form_error('tanggal') ?>
									</div>
								</div>
								<div class="form-group col-lg-6">
									<label for="keterangan">Keterangan</label>
									<div class="input-group">
									<input class="form-control <?php echo form_error('keterangan') ? 'is-invalid':'' ?>"
									type="text" name="keterangan" id="keterangan"  placeholder="Keterangan" value="<?php echo $cashflow->keterangan?>" />
									<div class="invalid-feedback">
										<?php echo form_error('keterangan') ?>
									</div>
									</div>
								</div>
							</div>
							<div class="row">
								
								<div class="form-group col-lg-6">
									<label for="jumlah">Jumlah*</label>
									<input class="form-control allownumericwithoutdecimal <?php echo form_error('jumlah') ? 'is-invalid':'' ?>"
									type="text" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $cashflow->jumlah?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('jumlah') ?>
									</div>
								</div>
								<div class="form-group col-lg-6">
									<label for="ppn">PPN*</label>
									<div class="input-group">
									<input class="form-control allownumericwithoutdecimal <?php echo form_error('ppn') ? 'is-invalid':'' ?>"
									type="text" name="ppn" id="ppn"  placeholder="PPN" value="<?php echo $cashflow->ppn?>"/>
									<div class="invalid-feedback">
										<?php echo form_error('ppn') ?>
									</div>
									</div>
								</div>
							</div>
							<div class="row">
								
								<div class="form-group col-lg-6">
									<label for="nomorpo">Nomor PO</label>
									<select name="nomorpo" id="nomorpo" class="form-control <?php echo form_error('nomorpo') ? 'is-invalid':'' ?>">
									<option value="">--Silahkan pilih nomor PO--</option>
									<?php foreach ($po as $rowpo): ?>
										<option value="<?php echo $rowpo->nopo;?>"
										<?php if ($rowpo->nopo == $cashflow->nomorpo){ echo 'selected="selected"'; } ?>> 
											<?php echo $rowpo->nopo;?> - <?php echo $rowpo->nama;?>
										</option>
									<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('nomorpo') ?>
									</div>
								</div>

								<div class="form-group col-lg-6">
									<label for="jenis">Jenis*</label>
									<select name="jenis" id="jenis" class="form-control <?php echo form_error('jenis') ? 'is-invalid':'' ?>">
										<option value="KAS" <?php if ($cashflow->jenis == "KAS"){ echo 'selected="selected"'; } ?>>KAS</option>
										<option value="MODAL" <?php if ($cashflow->jenis == "MODAL"){ echo 'selected="selected"'; } ?>>MODAL</option>
										<option value="FEE" <?php if ($cashflow->jenis == "FEE"){ echo 'selected="selected"'; } ?>>FEE</option>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('jenis') ?>
									</div>
								</div>
							</div>
							<div class="row">
								
								<div class="form-group col-lg-6">
									<label for="jenis2">Jenis 2</label>
									<select name="jenis2" id="jenis2" class="form-control <?php echo form_error('jenis2') ? 'is-invalid':'' ?>">
										<option value="" <?php if ($cashflow->jenis2 == ""){ echo 'selected="selected"'; } ?>></option>
										<option value="PPN" <?php if ($cashflow->jenis2 == "PPN"){ echo 'selected="selected"'; } ?>>PPN</option>
										<option value="GAJI" <?php if ($cashflow->jenis2 == "GAJI"){ echo 'selected="selected"'; } ?>>GAJI</option>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('jenis2') ?>
									</div>
								</div>
								<div class="form-group col-lg-6">
									<label for="status">Status*</label>
									<select name="status" id="status" class="form-control <?php echo form_error('status') ? 'is-invalid':'' ?>">
										<option value="OK" <?php if ($cashflow->status == "OK"){ echo 'selected="selected"'; } ?>>OK</option>
										<option value="BELUM OK" <?php if ($cashflow->status == "BELUM OK"){ echo 'selected="selected"'; } ?>>BELUM OK</option>
									</select>
									<div class="invalid-feedback">
										<?php echo form_error('status') ?>
									</div>
								</div>
							</div>
							<input class="btn btn-success" type="submit" name="btn" value="Update" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->
		<?php $this->load->view("admin/_partials/modal.php") ?>
		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>

		<script>
		$(document).ready(function () {
			$('.tanggal').datepicker({
				format: "yyyy-mm-dd",
				autoclose:true
			});

			// $("#jumlah").on("keyup",function (event) {    
			// 	$(this).val();
			// });

			
			$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
				$(this).val($(this).val().replace(/[^\d].+/, ""));
				if ((event.which < 48 || event.which > 57)) {
					event.preventDefault();
				}
			});
		});

		function commaSeparateNumber(val){
			while (/(\d+)(\d{3})/.test(val.toString())){
			val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return val;
		}
		</script>

</body>

</html>
