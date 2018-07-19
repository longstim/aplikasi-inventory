<page backtop="7mm" backright="7mm" backbottom="7mm" backleft="7mm">
<?php echo CHtml::cssFile(Yii::app()->baseUrl.'tesla.css'); ?>
<?php 
	$namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
	$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$user=User::model()->findByAttributes(array('nkey'=>Yii::app()->user->id));

	$romawi =  array("","I","II","III","IV","V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

	$counter="SELECT COUNT(DISTINCT tgl_penyimpanan) FROM inv_t_penyimpanan WHERE penyimpan='".$penyimpan."'";
	$count=Yii::app()->db->createCommand($counter)->queryScalar();
?>
	<div style="font-size:20px;text-align:left;width:700px;margin-top:-30px;position:absolute;">
		<div id="logo">
		
		</div>
		<table>
			<tr><td><b><p style="margin : 20 0 0 180">POLITEKNIK INFORMATIKA DEL</p></b></td></tr><br><br>
			<tr><td><b><p style="margin : 20 0 0 175">Berita Acara Serah Terima Barang</p></b></td></tr>
			<tr><td><b><p style="margin : 20 0 0 165">Inventaris Pidel No. <?php echo str_pad($count , 3, '0', STR_PAD_LEFT);?>/PID/INV/BA/<?php echo $romawi[date("n")];?></p></b></td></tr>
		</table>
	</div>
	<div style="font-size:20px;text-align:center;width:700px;margin-top:150px;position:absolute;">
		<hr width="50%" size="3" />
	</div>
	<div style="font-size:15px;text-align:left;width:700px;margin-top:-180px;position:absolute;">
		<p style="margin:350 0 0 0"><Br>
			Pada hari ini, <?php echo $namahari[date("w")];?>, tanggal <?php echo date("j")." ".$namabulan[date("n")]." ".date("Y");?>,
			di kampus Politeknik Informatika Del, telah dilakukan serahterima barang dari <?php echo $penyimpan?> kepada ,
			Inventaris PI Del untuk keperluan <?php echo $penyimpan?>, yaitu berupa :
		</p>
	</div>
	<p style="margin:250 0 0 0">
	</p>
	<table border="1">
		<tr>
			<td width="30" align="center">No.</td>
			<td width="150" align="center">Nama Barang</td>
			<td width="150" align="center">Spesifikasi</td>
			<td width="150" align="center">Jumlah</td>
			<td width="150" align="center">Kondisi</td>
		</tr>
		<?php
		$a=1;
			foreach($berita as $b)
			{
			?>
				<tr>
			
			<td width='30' align='center'><?php echo $a;?></td>
			<td width='150' align='center'><?php echo $b->nama_barang;?></td>
			<td width='150' align='center'><?php echo $b->spesifikasi;?></td>
			<td width='150' align='center'><?php echo $b->jumlah;?></td>
			<td width='150' align='center'><?php echo $b->kondisi;?></td>
				
				</tr>
			<?php
				$a=$a+1;
			}
			?>
	</table>
	<p style="margin:200 0 0 0">
		Demikian berita acara ini dibuat sebenarnya pada hari ini dan tanggal tersebut di atas.
Adapun barang yang di serahterimakan kepada inventori PI DEL adalah barang yang baru dibeli 
dan total jumlah barang tersebut adalah <?php echo $sum;?> buah.</p>
	<div style="font-size:15px;text-align:left;width:700px;margin-top:720px;position:absolute;">
		<BR><BR>
		<p>Sitoluama, <?php echo date("j")." ".$namabulan[date("n")]." ".date("Y");?><BR>
		Yang Menyerahkan,<BR>
		<BR><BR><BR><BR><BR><BR><BR>
		<?php echo $penyimpan?>
		</p>
	</div>
	<div style="font-size:15px;text-align:left;width:700px;margin-top:720px;margin-left:500;position:absolute;">
		<BR><BR>
		<p><BR>
		Yang Menerima,<BR>
		Bag. Inventory<BR><BR><BR><BR><BR><BR><BR>
		<?php echo $user->nickname;?>
		</p>
	</div>
</page>