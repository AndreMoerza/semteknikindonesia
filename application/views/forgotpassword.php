<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo SITE_NAME ." - login" ?></title>
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('css/sb-admin.css') ?>" rel="stylesheet">
</head>

<body class="bg-dark">
	<div style="text-align:center;margin-top:50px;">
	<img src="<?php echo base_url('assets/image/logo.svg.png') ?>" width="180px" height="180px"/>
	</div>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
		
      <div class="card-header" style="text-align:center;font-size:larger;">
	  <b>Reset Password</b>
	  </div>
      <div class="card-body">
	  	<div class="text-center mb-4">
          <h4>Lupa password?</h4>
          <p>Masukan username dan kami akan mengirimkan cara untuk mereset password.</p>
        </div>
		<form action="<?php echo base_url('login/aksi_resetpassword'); ?>" method="post" enctype="multipart/form-data">

			<div class="form-group">
				<div class="form-label-group">
					<input type="text" name="username" class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>" 
					placeholder="Username" required="required" autofocus="autofocus" >
					<label for="username">Username</label>
					<div class="invalid-feedback">
							<?php echo form_error('username') ?>
					</div>
				</div>
			</div>
		  
          	<input type="submit" class="btn btn-primary btn-block" value="Reset Password"/>
		  
        </form>

					<?php if ($this->session->flashdata('errorreset')): ?>
					<br />
					<div class="alert alert-danger" role="alert">
						<?php echo $this->session->flashdata('errorreset'); ?>
					</div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('successreset')): ?>
					<br />
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('successreset'); ?>
					</div>
				<?php endif; ?>
      </div>
	  <div class="text-center">
          <a class="d-block small" href="<?php echo site_url('login/') ?>">Login Page</a>
	</div>
		
    </div>

		
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>

</body>

</html>
