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

<body class="bg-white">
	<div style="text-align:center;margin-top:50px;">
	<img src="<?php echo base_url('assets/image/sm.png') ?>" width="150px" height="100px"/>
	</div>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
		
      <div class="card-header" style="text-align:center;font-size:larger;color:#a6a9ad;">SEM Teknik Indonesia</div>
      <div class="card-body">
				<form action="<?php echo base_url('login/aksi_login'); ?>" method="post" enctype="multipart/form-data">
          
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
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>" 
							placeholder="Password" required="required" >
							<label for="password">Password</label>
							<div class="invalid-feedback">
									<?php echo form_error('password') ?>
							</div>
						</div>
					</div>
		  
          <input type="submit" class="btn btn-primary btn-block" value="Login"/>
		  
        </form>

					<?php if ($this->session->flashdata('error')): ?>
					<br />
					<div class="alert alert-danger" role="alert">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>
				<?php if ($this->session->flashdata('success')): ?>
					<br />
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif; ?>
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
