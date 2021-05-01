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

						<a href="<?php echo site_url('admin/barang/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/barang/edit') ?>" method="post" enctype="multipart/form-data">
							
							<input type="hidden" name="idbarang" value="<?php echo $barang->idbarang?>" />
						
							<div class="form-group">
								<label for="namabrg">Nama barang*</label>
								<input class="form-control <?php echo form_error('namabrg') ? 'is-invalid':'' ?>"
								 type="text" name="namabrg" placeholder="Nama barang" value="<?php echo $barang->namabrg ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('namabrg') ?>
								</div>
							</div>
							
							<div class="form-group">
								<label for="supplier">Supplier*</label>
								<select name="idsupp" class="form-control <?php echo form_error('idsupp') ? 'is-invalid':'' ?>">
								<?php foreach ($supplier as $rowsupplier): ?>
									<option value="<?php echo $rowsupplier->idsupp;?>" 
									<?php if ($rowsupplier->idsupp == $barang->idsupp){ echo 'selected="selected"'; } ?>>
										<?php echo $rowsupplier->nama;?>
									</option>
								<?php endforeach; ?>
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('idsupp') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="harga">Harga*</label>
								<input class="form-control <?php echo form_error('harga') ? 'is-invalid':'' ?>"
								 type="text" name="harga" placeholder="Harga" value="<?php echo $barang->harga ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('harga') ?>
								</div>
							</div>

							<input class="btn btn-success" type="submit" name="btn" value="Save" />
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

</body>

</html>
