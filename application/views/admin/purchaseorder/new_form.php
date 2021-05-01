<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
	<style>
      ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width: 94%;
		z-index: 999;
      }
      ul.list-unstyled li{
        padding:12px;
        border:thin solid #F0F8FF;
      }
      ul.list-unstyled li:hover{
        background-color:#7FFFD4;
      }

	  #barangList {
		  left:0;
	  }
	  .dt-center {
		  text-align: center;
	  }
    </style>
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

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/purchaseorder/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/purchaseorder/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="row">
								<div class="form-group col-lg-6">
									<label for="nopo">No PO*</label>
									<div class="input-group">
									<input class="form-control <?php echo form_error('nopo') ? 'is-invalid':'' ?>"
									type="text" name="nopo" id="nopo"  placeholder="No PO" />
									<div class="invalid-feedback">
										<?php echo form_error('nopo') ?>
									</div>
									</div>
								</div>
								<div class="form-group col-lg-6">
									<label for="tanggalpo">Tanggal PO*</label>
									<input class="form-control tanggal <?php echo form_error('tanggalpo') ? 'is-invalid':'' ?>"
									type="text" name="tanggalpo" id="tanggalpo" placeholder="Tanggal PO" id="tanggalpo" readonly/>
									<div class="invalid-feedback">
										<?php echo form_error('tanggalpo') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6">
									<label for="idcust">Customer*</label>
									<!-- <select class="selectpicker" data-live-search="true">
									<option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
									<option data-tokens="mustard">Burger, Shake and a Smile</option>
									<option data-tokens="frosting">Sugar, Spice and all things nice</option>
									</select> -->
									<input type="hidden" name="idcust" id="idcust" />
									<input class="form-control <?php echo form_error('idcust') ? 'is-invalid':'' ?>"
									type="text" name="customer" id="customer" placeholder="Customer" />
									<div id="customerList"></div>
									<div class="invalid-feedback">
										<?php echo form_error('idcust') ?>
									</div>
								</div>
								<div class="form-group col-lg-6">
									<label for="piccustomer">PIC Customer*</label>
									<select name="piccustomer" id="piccustomer" class="form-control <?php echo form_error('piccustomer') ? 'is-invalid':'' ?>">
									
									</select>
									
									<div class="invalid-feedback">
										<?php echo form_error('piccustomer') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6">
									<label for="marketing">Marketing*</label>
									<select name="marketing" id="marketing" class="form-control <?php echo form_error('marketing') ? 'is-invalid':'' ?>">
									<?php foreach ($marketing as $rowmarketing): ?>
										<option value="<?php echo $rowmarketing->idmarketing;?>">
											<?php echo $rowmarketing->namamarketing;?>
										</option>
									<?php endforeach; ?>
									</select>
									
									<div class="invalid-feedback">
										<?php echo form_error('marketing') ?>
									</div>
								</div>
								<div class="form-group col-lg-6">
									<label for="potongan">Potongan*</label>
									<div class="input-group">
									<input class="form-control allownumericwithoutdecimal <?php echo form_error('potongan') ? 'is-invalid':'' ?>"
									type="text" name="potongan" id="potongan"  placeholder="Potongan" />
									<div class="invalid-feedback">
										<?php echo form_error('potongan') ?>
									</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6">
									<label for="ppn">PPN*</label>
									<div class="input-group">
									<input class="form-control allownumericwithoutdecimal <?php echo form_error('ppn') ? 'is-invalid':'' ?>"
									type="text" name="ppn" id="ppn"  placeholder="PPN" />
									<div class="invalid-feedback">
										<?php echo form_error('ppn') ?>
									</div>
									</div>
								</div>
								<div class="form-group col-lg-6">
									<label for="total">Total</label>
									<div class="input-group">
									<input class="form-control <?php echo form_error('grandtotal') ? 'is-invalid':'' ?>"
									type="text" name="grandtotal" id="grandtotal" placeholder="Total" disabled/>
									<div class="invalid-feedback">
										<?php echo form_error('grandtotal') ?>
									</div>
									</div>
								</div>
							</div>
							<button class="btn btn-primary" type="button" onclick="tambahBarangModal()"><i class="fas fa-plus"></i> Tambah barang</button>
							<br/><br/>
							<div class="table-responsive">
							<table class="table table-hover" id="tblBarang" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th style="width: 89px;"></th>
										<th>Nama Barang</th>
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Status</th>
										<th>Sub Total</th>
									</tr>
								</thead>
								<tbody>
									

								</tbody>
							</table>
						</div>
						<br/>
						
						
						</form>

					</div>
					<div class="card-footer small text-muted">
						<input class="btn btn-success" type="submit" name="btn" value="Simpan" onclick="simpanPO()"/>
						<input class="btn btn-warning" type="submit" name="btn" value="Reset" onclick="reset()"/>
					</div>
					


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- Modal -->
		

		<div class="modal fade" id="tambahBarangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document" style="max-width:900px;">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-lg-6">
						<label for="barang">Barang*</label>
						<input type="hidden" name="idbarang" id="idbarang" />
						<input class="form-control <?php echo form_error('barang') ? 'is-invalid':'' ?>"
						type="text" name="barang" id="barang" placeholder="Barang" />
						
						<div id="barangList"></div>
						<div class="invalid-feedback">
							<?php echo form_error('barang') ?>
						</div>
					</div>
					<div class="form-group col-lg-6">
						<label for="harga">Harga*</label>
						<input class="form-control allownumericwithoutdecimal <?php echo form_error('harga') ? 'is-invalid':'' ?>"
						type="text" name="harga" id="harga" placeholder="Harga"  />
						<div class="invalid-feedback">
							<?php echo form_error('harga') ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-6">
						<label for="jumlah">Jumlah*</label>
						<input class="form-control allownumericwithoutdecimal <?php echo form_error('jumlah') ? 'is-invalid':'' ?>"
						type="text" name="jumlah" id="jumlah" placeholder="Jumlah" maxlength="4"/>
						
						<div class="invalid-feedback">
							<?php echo form_error('jumlah') ?>
						</div>
					</div>
					
					<div class="form-group col-lg-6">
						<label for="total">Total*</label>
						<input class="form-control"
						type="text" name="total" id="total" placeholder="Total" disabled/>
					</div>
					
				</div>
				<div class="row">
					<div class="form-group col-lg-6"></div>
					<div class="form-group col-lg-6">					
						<div class="checkbox">
							<label">
							<input type="checkbox" name="status" id="status"/> Sudah dikirim
							</label>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
			<button class="btn btn-primary" type="button" onclick="simpanBarang()"><i class="fas fa-plus"></i> Simpan</button>
			</div>
			</div>
		</div>
		</div>
		<div class="modal fade" id="editBarangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document" style="max-width:900px;">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-lg-6">
						<label for="barang">Barang*</label>
						<input type="hidden" name="editidbarang" id="editidbarang" />
						<input class="form-control <?php echo form_error('editbarang') ? 'is-invalid':'' ?>"
						type="text" name="editbarang" id="editbarang" placeholder="Barang" />
						
						<div id="barangList"></div>
						<div class="invalid-feedback">
							<?php echo form_error('editbarang') ?>
						</div>
					</div>
					<div class="form-group col-lg-6">
						<label for="harga">Harga*</label>
						<input class="form-control allownumericwithoutdecimal <?php echo form_error('editharga') ? 'is-invalid':'' ?>"
						type="text" name="editharga" id="editharga" placeholder="Harga"  />
						<div class="invalid-feedback">
							<?php echo form_error('editharga') ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-6">
						<label for="jumlah">Jumlah*</label>
						<input class="form-control allownumericwithoutdecimal <?php echo form_error('editjumlah') ? 'is-invalid':'' ?>"
						type="text" name="editjumlah" id="editjumlah" placeholder="Jumlah" maxlength="4"/>
						
						<div class="invalid-feedback">
							<?php echo form_error('editjumlah') ?>
						</div>
					</div>
					
					<div class="form-group col-lg-6">
						<label for="total">Total*</label>
						<input class="form-control"
						type="text" name="edittotal" id="edittotal" placeholder="Total" disabled/>
					</div>
					
				</div>
				<div class="row">
					<div class="form-group col-lg-6"></div>
					<div class="form-group col-lg-6">					
						<div class="checkbox">
							<label">
							<input type="checkbox" name="editstatus" id="editstatus"/> Sudah dikirim
							</label>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
			<button class="btn btn-primary" type="button" onclick="updateBarang()"><i class="fas fa-plus"></i> Update</button>
			</div>
			</div>
		</div>
		</div>
		<?php $this->load->view("admin/_partials/modal.php") ?>
		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>
	<script>
		var tambahBarang = [];
		$(document).ready(function () {
			
			$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
			$(this).val($(this).val().replace(/[^\d].+/, ""));
				if ((event.which < 48 || event.which > 57)) {
					event.preventDefault();
				}
			});
                $('.tanggal').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });

				$('#tblBarang').dataTable( {
					"searching": false,
					"paging": false,
					"bSort": false,
					"columnDefs": [
						{"className": "dt-center", "targets": "_all"}
					],
				});

				$('#customer').keyup(function(){  
				var query = $(this).val(); 
				if(query != '')  
				{  
						$.ajax({  
							url: "searchCustomer",  
							method:"POST",  
							data:{query:query},  
							success:function(data)  
							{  
								// $('#customerList').();  
								$('#customerList').fadeIn(10)
								$('#customerList').html(data);  
							}  
						});  
				}  else {
					$('#customerList').fadeOut(10);
				}
				});  

				$('#barang').keyup(function(){  
				var query = $(this).val(); 
				if(query != '')  
				{  
						$.ajax({  
							url: "searchBarang",  
							method:"POST",  
							data:{query:query},  
							success:function(data)  
							{  
								// $('#customerList').();  
								$('#barangList').fadeIn(10)
								$('#barangList').html(data);  
							}  
						});  
				}  else {
					$('#barangList').fadeOut(10);
				}
				});  

				$('#jumlah').keyup(function(){ 
					var jumlah = $(this).val(); 
					var harga = $('#harga').val();

					if (jumlah != null && harga != null) {
						var total = parseInt(jumlah) * parseInt(harga);
						$('#total').val(total);
					} else {
						$('#total').val(0);
					}
				});


				$('#potongan').keyup(function(){ 
					calculateGrandTotal();
				});

				$('#ppn').keyup(function(){ 
					calculateGrandTotal();
				});
				
				$('#editjumlah').keyup(function(){ 
					var jumlah = $(this).val(); 
					var harga = $('#editharga').val();

					if (jumlah != null && harga != null) {
						var total = parseInt(jumlah) * parseInt(harga);
						$('#edittotal').val(total);
					} else {
						$('#edittotal').val(0);
					}
				});

		});
		

		function tambahBarangModal(){
			$('#tambahBarangModal').modal();
		}

		function editBarangModal(){
			$('#editBarangModal').modal();
		}

		function simpanBarang(){
			if ($('#idbarang').val() != "" && $('#harga').val() != "" && $('#jumlah').val() != "") {
				
				var idbrg = $('#idbarang').val();
				var namabrg = $('#barang').val();
				var harga = $('#harga').val();
				var jumlah = $('#jumlah').val();
				var status = $('#status:checked').val() == "on" ? 1 : 0;
				var total = parseInt(jumlah) * parseInt(harga);
				
				var validateBarang = tambahBarang.find(a => a.idbarang == idbrg);
				if (validateBarang != null) {
					var jmlBaru = parseInt(validateBarang.jumlah) + parseInt(jumlah);
					validateBarang.jumlah = jmlBaru;
					validateBarang.total = jmlBaru * parseInt(harga);

				} else {
					tambahBarang.push({
						idbarang: idbrg,
						namabrg,
						harga,
						jumlah,
						status,
						total
					});

					

				}
				
				addRowBarang();
				
				
				clearInputPopUpBarang();
			}
			
		}

		function updateBarang(){
			if ($('#editidbarang').val() != "" && $('#editharga').val() != "" && $('#editjumlah').val() != "") {
				
				var idbrg = $('#editidbarang').val();
				var namabrg = $('#editbarang').val();
				var harga = $('#editharga').val();
				var jumlah = $('#editjumlah').val();
				var status = $('#editstatus:checked').val() == "on" ? 1 : 0;
				var total = parseInt(jumlah) * parseInt(harga);
				
				var updateBarang = tambahBarang.find(a => a.idbarang == idbrg);
				if (updateBarang != null) {
					updateBarang.harga = harga;
					updateBarang.jumlah = jumlah;
					updateBarang.total = total;	
					updateBarang.status = status;		

				}
				
				addRowBarang();
				
				
				clearInputPopUpBarang();

				$('#editBarangModal').modal('toggle');
			}
			
		}

		function addRowBarang() {
			var t = $('#tblBarang').DataTable();
			t.clear().draw();
			var grandTotal = 0;
				$.each(tambahBarang, function( index, value ) {
					var statusRow = value.status == 1 ? "SUDAH DIKIRIM" : "BELUM DIKIRIM";
					var subTotal =  commaSeparateNumber(value.total);
					t.row.add( [
						'<a href="#" class="text-danger" onclick="deleteBarangById(' + value.idbarang + ')"><i class="fas fa-times-circle"></i></a> ' +
						' <a href="#" class="text-success" onclick="editBarangById(' + value.idbarang + ')"><i class="fas fa-edit"></i></a>',
						value.namabrg,
						value.harga,
						value.jumlah,
						statusRow,
						subTotal,
					] ).draw();
					
					grandTotal += parseInt(value.total);
					
				});
				var potongan = $('#potongan').val();
				var ppn = $('#ppn').val();
				grandTotal = grandTotal - ((potongan / 100) * grandTotal) - ((ppn / 100) * grandTotal);
				grandTotal = commaSeparateNumber(grandTotal);
				$('#grandtotal').val(grandTotal);
		}

		function calculateGrandTotal() {
			var grandTotal = 0;
				$.each(tambahBarang, function( index, value ) {
					grandTotal += parseInt(value.total);
				});
				var potongan = $('#potongan').val() ?? 0;
				var ppn = $('#ppn').val() ?? 0;
				grandTotal = grandTotal - ((potongan / 100) * grandTotal) - ((ppn / 100) * grandTotal);
				grandTotal = commaSeparateNumber(grandTotal);
				$('#grandtotal').val(grandTotal);
		}

		function commaSeparateNumber(val){
			while (/(\d+)(\d{3})/.test(val.toString())){
			val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return val;
		}

		function removeCommaSeparateNumber(val){
			val = val.toString().replace(/,/g, '');
			return val;
		}

		function deleteBarangById(id) {

			var index = tambahBarang.map(x => { return x.idbarang; }).indexOf(id);

			tambahBarang.splice(index, 1);

			addRowBarang();
		}

		function editBarangById(id) {
			var dataBarang = tambahBarang.find(a => a.idbarang == id);
			editBarangModal();

			$('#editidbarang').val(dataBarang.idbarang);
			$('#editbarang').val(dataBarang.namabrg);
			$('#editbarang').attr("disabled", "disabled");
			$('#editharga').val(dataBarang.harga);
			$('#editjumlah').val(dataBarang.jumlah);
			$('#edittotal').val(dataBarang.total);
			$('#editstatus').prop('checked', dataBarang.status);
		}

		
		function clearInputPopUpBarang(){
			$('#idbarang').val('');
			$('#barang').val('');
			$('#harga').val('');
			$('#jumlah').val('');
			$('#total').val('');
			$('#status').prop('checked', false);
		}

		function setValueCustomer(id, nama){
			$('#idcust').val(id);
			$('#customer').val(nama);
			$('#customerList').fadeOut(10);

			getPICCustomerByCustId(id);
		}

		function setValueBarang(idbarang, namabrg, harga){
			$('#idbarang').val(idbarang);
			$('#barang').val(namabrg);
			$('#harga').val(harga);
			$('#barangList').fadeOut(10);

		}

		function getPICCustomerByCustId(CustId) {
			$.ajax({  
				url: "getPICCustomer",  
				method:"POST",  
				data:{idcust:CustId},  
				success:function(data)  
				{  
					console.log(data)
					$('#piccustomer').append(data);  
				}  
			});  
		}

		function simpanPO() {
			var nopo = $('#nopo').val();
			var tanggalpo = $('#tanggalpo').val();
			var customer = $('#idcust').val();
			var piccustomer = $('#piccustomer').val();
			var marketing = $('#marketing').val();
			var potongan = $('#potongan').val();
			var ppn = $('#ppn').val();
			var grandtotal = removeCommaSeparateNumber($('#grandtotal').val());
			var datapo = {
				po: { 
					nopo,
					tanggalpo,
					customer,
					piccustomer,
					marketing,
					potongan,
					ppn,
					grandtotal
				},
				detailPO: tambahBarang
			};
			var baseUrl = '<?php echo base_url("admin/purchaseorder/"); ?>';
			$.ajax({  
				url: "simpanPO",  
				method:"POST",  
				data:{datapo},  
				success:function(data)  
				{  
					Swal.fire({
						title: 'Success!',
						text: 'Data PO berhasil ditambahkan',
						icon: 'success',
						// confirmButtonText: 'Ok'
					}).then(function() {
						window.location.replace(baseUrl);
					});
					
				}  
			});  
		}

		function reset() {
			$('#nopo').val('');
			$('#tanggalpo').val('');
			$('#customer').val('');
			$('#piccustomer').val('');
			$('#potongan').val('');
			$('#ppn').val('');
			$('#grandtotal').val('');
			clearInputPopUpBarang();
			tambahBarang = [];
			var t = $('#tblBarang').DataTable();
			t.clear().draw();
		}
	</script>
</body>

</html>
