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

						<a href="<?php echo site_url('admin/marketing/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/marketing/edit') ?>" method="post" enctype="multipart/form-data">

							<input type="hidden" name="idmarketing" value="<?php echo $marketing->idmarketing?>" />

							<div class="form-group">
								<label for="nama">Nama Marketing*</label>
								<input class="form-control <?php echo form_error('namamarketing') ? 'is-invalid':'' ?>"
								 type="text" name="namamarketing" placeholder="Nama PIC" value="<?php echo $marketing->namamarketing ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('namamarketing') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="telepon">Telepon*</label>
								<input class="form-control <?php echo form_error('nohp') ? 'is-invalid':'' ?>"
								 type="text" name="nohp" placeholder="Telepon" value="<?php echo $marketing->nohp ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('nohp') ?>
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
