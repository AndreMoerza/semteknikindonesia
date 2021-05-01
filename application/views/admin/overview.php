<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
	<style>
	a:hover {
    color: white;
	text-decoration: ;
	}

	.notification {
	background-color: #555;
	color: white;
	text-decoration: none;
	padding: 10px 10px;
	position: relative;
	display: inline-block;
	border-radius: 2px;
	margin-right: 50px;
	}

	.notification:hover {
	background: #665b5b;
	}

	.notification .badge {
	position: absolute;
	top: -10px;
	right: -10px;
	padding: 5px 10px;
	border-radius: 50%;
	background: red;
	color: white;
	}
	</style>
</head>
<body id="page-top">

<?php $this->load->view("admin/_partials/navbar.php") ?>

<div id="wrapper">

	<?php $this->load->view("admin/_partials/sidebar.php") ?>

	<div id="content-wrapper">
		
		<div class="container-fluid">

        <!-- 
        karena ini halaman overview (home), kita matikan partial breadcrumb.
        Jika anda ingin mengampilkan breadcrumb di halaman overview,
        silahkan hilangkan komentar (//) di tag PHP di bawah.
        -->
		<?php //$this->load->view("admin/_partials/breadcrumb.php") ?>

		<!-- Icon Cards-->
		<!-- <div class="row">
			<div class="col-xl-12">
				<a href="<?php echo site_url('admin/usulan') ?>" class="notification">
					<i class="fas fa-fw fa-book"></i>
					<span>Usulan Dibuat BK</span>
					<?php if ($totalusulan != 0) { ?>	
						<span class="badge"><?php echo $totalusulan; ?></span>
					<?php } ?>
				</a> 
				<a href="<?php echo site_url('admin/verifikasi') ?>" class="notification">
				<i class="fas fa-fw fa-clipboard-check"></i>
					<span>Usulan Proses Di BKD</span>
					<?php if ($totalusulanprosesbkd != 0) { ?>	
						<span class="badge"><?php echo $totalusulanprosesbkd; ?></span>
					<?php } ?>
				</a> 
				<a href="<?php echo site_url('admin/usulan') ?>" class="notification">
					<i class="fas fa-fw fa-clipboard-check"></i>
					<span>CPNS diusulkan</span>
					<?php if ($totalcpnsdiusulkan != 0) { ?>	
						<span class="badge"><?php echo $totalcpnsdiusulkan; ?></span>
					<?php } ?>
				</a> 
				<a href="<?php echo site_url('admin/verifikasi') ?>" class="notification">
					<i class="fas fa-fw fa-user-check"></i>
					<span>CPNS diverifikasi</span>
					<?php if ($totalcpnsdiverifikasi != 0) { ?>	
						<span class="badge"><?php echo $totalcpnsdiverifikasi; ?></span>
					<?php } ?>
				</a> 
				<a href="<?php echo site_url('admin/surat/listskpns') ?>" class="notification">
					<i class="fas fa-fw fa-paper-plane"></i>
					<span>CPNS proses SK</span>
					<?php if ($totalcpnsprosessk != 0) { ?>	
						<span class="badge"><?php echo $totalcpnsprosessk; ?></span>
					<?php } ?>
				</a> 
				<a href="<?php echo site_url('admin/surat/listsuratpengembalian') ?>" class="notification">
					<i class="fas fa-fw fa-paper-plane"></i>
					<span>Berkas TMS</span>
					<?php if ($totalcpnstms != 0) { ?>	
						<span class="badge"><?php echo $totalcpnstms; ?></span>
					<?php } ?>
				</a> 
			</div>
		</div> -->
		<br />
		<!-- Area Chart Example-->
		<div class="card mb-3">
			<div class="card-header">
			<i class="fas fa-chart-area"></i> Jumlah Data
			</div>
			<div class="card-body">
			<canvas id="myChart" width="100%" height="30"></canvas>
			</div>
			<div class="card-footer small text-muted"></div>
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
	$(document).ready(function() {
		var arrData = [];
		var totalusulan = parseInt($("#totalusulan").val());
		var totalusulanprosesbkd = parseInt($("#totalusulanprosesbkd").val());
		var totalcpnsdiusulkan = parseInt($("#totalcpnsdiusulkan").val());
		var totalcpnsdiverifikasi = parseInt($("#totalcpnsdiverifikasi").val());
		var totalcpnsprosessk = parseInt($("#totalcpnsprosessk").val());
		var totalcpnstms = parseInt($("#totalcpnstms").val());
		arrData.push(totalusulan);
		arrData.push(totalusulanprosesbkd);
		arrData.push(totalcpnsdiusulkan);
		arrData.push(totalcpnsdiverifikasi);
		arrData.push(totalcpnsprosessk);
		arrData.push(totalcpnstms);
		console.log(arrData);
		// Area Chart Example
		var ctx = document.getElementById("myChart");
		var myLineChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["INVOICE SUDAH BAYAR", "INVOICE SUDAH DIKIRIM", "INVOICE BELUM DIKIRIM"],
			datasets: [{
			label: "Total",
			lineTension: 0.3,
			backgroundColor: "rgba(2,117,216,0.2)",
			borderColor: "rgba(2,117,216,1)",
			pointRadius: 5,
			pointBackgroundColor: "rgba(2,117,216,1)",
			pointBorderColor: "rgba(255,255,255,0.8)",
			pointHoverRadius: 5,
			pointHoverBackgroundColor: "rgba(2,117,216,1)",
			pointHitRadius: 50,
			pointBorderWidth: 2,
			data: arrData,
			}],
		},
		options: {
			scales: {
			xAxes: [{
				time: {
				unit: 'date'
				},
				gridLines: {
				display: false
				},
				ticks: {
				maxTicksLimit: 7
				}
			}],
			yAxes: [{
				ticks: {
				min: 0,
				max: 20,
				maxTicksLimit: 10
				},
				gridLines: {
				color: "rgba(0, 0, 0, .125)",
				}
			}],
			},
			legend: {
			display: false
			}
		}
		});
		
		
	});
</script>
</body>
</html>
