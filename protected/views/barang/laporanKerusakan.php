<page backtop="7mm" backright="7mm" backbottom="7mm" backleft="7mm">
<?php echo CHtml::cssFile(Yii::app()->baseUrl.'tesla.css'); ?>
<?php 
	$namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
	$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$user=User::model()->findByAttributes(array('nkey'=>Yii::app()->user->id));
?>
	<div style="font-size:20px;text-align:left;width:700px;margin-top:-30px;position:absolute;">
		<div id="logo">
		
		</div>
		<table>
			<tr><td><b><p style="margin : 20 0 0 180">POLITEKNIK INFORMATIKA DEL</p></b></td></tr><br><br>
			<tr><td><b><p style="margin : 20 0 0 150">Formulir Pelaporan Kerusakan Inventaris</p></b></td></tr>
		</table>
	</div>
	<div style="font-size:20px;text-align:center;width:700px;margin-top:100px;position:absolute;">
		<hr width="50%" size="3" />
	</div>
	<div style="font-size:16px;text-align:center;width:700px;margin-top:150px;position:absolute;">
	<table border="0.5">
		<tr>
			<td width="200" align="left">Hari/Tanggal Pengajuan</td>
			<td width="20" align="center">:</td>
			<td width="400" align="left"><?php echo $namahari[date("w")]."/ ".date("j")." ".$namabulan[date("n")]." ".date("Y");?></td>
		</tr>
		<tr>
			<td width="200" align="left">Nama Pemohon</td>
			<td width="20" align="center">:</td>
			<td width="400" align="left"><?php echo $pemohon;?></td>
		</tr>
		<tr>
			<td width="200" align="left">Jumlah Aset Yang Mengalami Kerusakan</td>
			<td width="20" align="center">:</td>
			<td width="400" align="left"><?php echo $diperbaiki;?></td>
		</tr>
		<tr>
			<td width="200" align="left">Detail Aset Yang Mengalami Kerusakan</td>
			<td width="20" align="center">:</td>
			<td width="400" align="left"><?php echo $model->deskripsi;?></td>
		</tr>
		<tr>
			<td width="200" height="400" align="left">Deskripsi Kerusakan</td>
			<td width="20" height="400" align="center">:</td>
			<td width="400" height="400" align="left" ><?php echo $desk;?></td>
		</tr>
		
		
	</table>
	</div>
	<div style="font-size:12px;text-align:center;width:700px;margin-top:740px;position:absolute;">
		<table border="0.5">
			<tr>
				<td width="316" height="50" align="left">Pemohon</td>
				<td width="315" height="50" align="left">Bag Inventory</td>
			</tr>
		</table>
	</div>
	<div style="font-size:12px;text-align:left;width:700px;margin-top:900px;position:absolute;">
		<p>
			Politeknik Informatika Del<Br>
			Jl. Sisingamangaraja Sitoluama - Laguboti<Br>
			Toba Samosir, Sumatera Utara 22381<Br>
			Telp. +62 632 331234
		</p>
	</div>
</page>