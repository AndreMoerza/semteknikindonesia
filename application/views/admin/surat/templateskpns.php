<!DOCTYPE html>
<html>
<head>
<style>
.table {
  border-collapse: collapse;
}

.table, .table th,.table td {
  width:100%;
  border: 1px solid black;
  font-size:6;
  margin-top:50px
}
</style>
</head>
<body>
<table style="float:right;font-size:10;" >
	<tr>
		<td>Lampiran</td>
		<td></td>	
		<td>:</td>
		<td >Keputusan Gubernur Provinsi Daerah <br/> Khusus Ibukota Jakarta</td>
	</tr>
</table>
<br/><br/>
<table style="float:right;font-size:10;margin-right:100px;" >
	<tr>
		<td>Nomor</td>	
		<td>:</td>
		<td><?php echo $nomorsurat;?></td>
	</tr>
	<tr>
		<td>Tanggal</td>	
		<td>:</td>
		<td><?php echo $tanggalsurat; ?></td>
	</tr>
</table>
<table class="table" style="width: 100%;">
		<tr style="text-align:center;">
			<td style="width:2%;" rowspan="2">No</td>	
			<td rowspan="2">NAMA/NIP</td>
			<td rowspan="2">TEMPAT/TGL. LAHIR</td>
			<td rowspan="2">JABATAN</td>
			<td rowspan="2">GOLONGAN</td>
			<td rowspan="2">GAJI</td>
			<td colspan="2">SURAT KEPUTUSAN SEBAGAI CPNS</td>
			<td colspan="2">SURAT KETERANGAN DOKTER PENGUJI KESEHATAN</td>
			<td colspan="2">SURAT TANDA TAMAT PENDIDIKAN DAN PELATIHAN DASAR CPNS</td>
			<td rowspan="2">UNIT KERJA</td>
		</tr>
		<tr style="text-align:center;">
			
			<td>NOMOR SK</td>
			<td>TANGGAL SK</td>
			<td>NOMOR SURAT</td>
			<td>TANGGAL</td>
			<td>NOMOR STTP</td>
			<td>TANGGAL</td>
		</tr>
		<?php $no = 1 ?>
			<?php foreach ($usulan as $rowusulan): ?>
			<tr style="text-align:center;">
				<td style="width:2%;">
					<?php echo $no ?>
				</td>
				<td>
					<?php echo $rowusulan->nama." / ".$rowusulan->nip; ?>
				</td>
				<td>
					<?php echo $rowusulan->tmplahir." / ".$rowusulan->tgllahir; ?>
				</td>
				<td>
					<?php echo $rowusulan->jabatan ?>
				</td>
				
				<td>
					<?php echo $rowusulan->golongan ?>
				</td>
				<td>
					<?php echo "RP. ".$rowusulan->gaji; ?>
				</td>
				<td>
					<?php echo $rowusulan->noskcpns ?>
				</td>
				<td>
					<?php echo date("d-m-Y", strtotime($rowusulan->tglskcpns)); ?>
				</td>
				<td>
					<?php echo $rowusulan->nosuratketdokter ?>
				</td>
				<td>
					<?php echo date("d-m-Y", strtotime($rowusulan->tglsuratketdokter)); ?>
				</td>
				<td>
					<?php echo $rowusulan->nosttp ?>
				</td>
				<td>
					<?php echo date("d-m-Y", strtotime($rowusulan->tglsttp)); ?>
				</td>
				<td>
					<?php echo $rowusulan->tempattugas ?>
				</td>
			</tr>
			<?php $no++ ?>
		<?php endforeach; ?>
	</table>

<div style="float:right;font-size:10;text-align:center;margin-right:30px;margin-top:20px;">
GUBERNUR PROVINSI DAERAH KHUSUS<br/> IBUKOTA JAKARTA, <br/><br/><br/>
ANIES BASWEDAN <br/>
</div>
</body>
</html>
