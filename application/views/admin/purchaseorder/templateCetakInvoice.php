<!DOCTYPE html>
<html>
	<head>
		<style>
.table {
  border-collapse: collapse;
}

.table1 {
  border-collapse: collapse;
}

.tableHeader {
   margin-top:20px; 
   padding-bottom:20px; 
   width:100%;
   border: 1px solid;
}
.table {
  width:100%;
  border: 1px solid;
  font-size:10;
  text-align: center;
}

.tableborder td {
  border: 1px solid;
}

.no-bottom-border td {
  border-right: 1px solid;
  border-bottom: none;
}




.table1, .table1 th,.table1 td {
  width:100%;
  border: 1px solid black;
  font-size:10;
}


</style>
	</head>
	<body>
		
			<div >
			    <div style="width:15%;min-width:100px;height:100px;float:left;padding-right:20px">
			        <img src="<?php echo base_url('assets/image/sm.jpg') ?>" width="120px" height="100px"/>
			    </div>
			    <div style="width:85%;font-size:12;height:100px;line-height: 1.4;left:130px;">
			        <b>PT. SEM TEKNIK INDONESIA </b>
				<br/>
        			Ruko Sentra Niaga Square, Blok 8C No. 09 <br/> Rt. 001/003 Simpangan, Cikarang Utara, Bekasi <br/>
        			Telp. 021 89321262  Email : Semtehnik67@gmail.com
			    </div>
			</div>
			<div style="float: right;font-size:15x;margin-bottom:20px;"><b>INVOICE</b></div>
			<table class="tableHeader">
				<tr>
					<td>
						<table style="font-size:10;">
							<tr>
								<td style="width:120px;">Nama Perusahaan</td>
								
								<td>:</td>
								<td>
									<?php echo $po->nama;?>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="font-size:10;">
							<tr>
								<td style="width:120px;">Nomor</td>
								<td>:</td>
								<td>
								001/INV/SEM-EON/III/2020
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="font-size:10;">
							<tr>
								<td style="width:120px;">Alamat</td>
								<td>:</td>
								<td>
								<?php echo $po->alamat;?>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="font-size:10;">
							<tr>
								<td style="width:120px;">Tanggal</td>
								<td>:</td>
								<td>
								<?php echo $po->tanggalpo;?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="font-size:10;">
							<tr>
								<td style="width:120px;">Telepon</td>
								<td>:</td>
								<td>
								<?php echo $po->telepon;?>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="font-size:10;">
							<tr>
								<td style="width:120px;">No S/J</td>
								<td>:</td>
								<td>
								001/SJ/SEM-EON/III/2020
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table style="font-size:10;">
							<tr>
								<td style="width:120px;">No PO</td>
								<td>:</td>
								<td>
								<?php echo $po->nopo;?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
		</table>
			<table class="table" style="width: 100%;">
				<tr class="tableborder">
				    
					<td style="width:3%;">NO</td>
					<td style="width:45%;">Nama Barang</td>
					<td style="width:12%;">Kuantum</td>
					<td style="width:20%;">Harga Satuan</td>
					<td style="width:20%;">Jumlah Harga</td>
				</tr>
				<?php $no=0;$subtotal=0;$totaldata=count($detailpo); ?>
				<?php 
				foreach ($detailpo as $rowdetailpo):
					$no += 1;
					$subtotal += ($rowdetailpo->quantity * $rowdetailpo->harga);

					if ($totaldata == $no) {
					?>
					<tr class="tableborder">
						
						<td style="width:3%;"><?php echo $no;?></td>
						<td style="width:45%;"><?php echo $rowdetailpo->namabrg;?></td>
						<td style="width:12%;"><?php echo $rowdetailpo->quantity;?></td>
						<td style="width:20%;"><?php echo $rowdetailpo->harga;?></td>
						<td style="width:20%;"><?php echo ($rowdetailpo->quantity * $rowdetailpo->harga);?></td>
					</tr>
					<?php } 
					else {

					?>
					<tr class="no-bottom-border">
						
						<td style="width:3%;"><?php echo $no;?></td>
						<td style="width:45%;"><?php echo $rowdetailpo->namabrg;?></td>
						<td style="width:12%;"><?php echo $rowdetailpo->quantity;?></td>
						<td style="width:20%;"><?php echo $rowdetailpo->harga;?></td>
						<td style="width:20%;"><?php echo ($rowdetailpo->quantity * $rowdetailpo->harga);?></td>
					</tr>
						
					<?php
					}
					endforeach; 
					?>
			    <tr class="no-bottom-border">
				    
				    <td colspan="3"></td>
					<td>Sub Total</td>
					<td><?php echo $subtotal;?></td>
				</tr>
				<tr class="no-bottom-border">
				    
				    <td colspan="3"></td>
					<td>Potongan</td>
					<td><?php echo $po->potongan;?></td>
				</tr>
				<tr class="tableborder">
				    
				    <td colspan="3" rowspan="3" style="border-bottom:none;">Hormat Kami,</td>
					<td>Total Sebelum Pajak</td>
					<td><?php echo ($subtotal - ($po->potongan/100) * $subtotal);?></td>
				</tr>
				<tr class="tableborder">
				    
					<td>PPN (10%)</td>
					<td><?php echo $po->ppn;?></td>
				</tr>
				<tr class="tableborder">
				    
					<td>Total</td>
					<td><?php echo $po->total;?></td>
				</tr>
				<tr class="no-bottom-border">
				     <td colspan="3" style="bottom:0;">Dwi Aprilianto <br/> Direktur</td>
					<td colspan="2" style="text-align:left;">Mohon Pembayaran Dengan Giro/ Transfer <br/> Bank BCA KCP Kemang Pratama <br/><br/>
					    <b>No Rek : 568-0566-200</b> <br/>
					    An : PT SEM TEKNIK INDONESIA
					</td>
					
				</tr>
			</table>
			
			
		</body>
	</html>
