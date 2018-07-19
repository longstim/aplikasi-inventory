<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<style type="text/css"> 
#operation
{
	margin-top:-50px;
}
</style>

<?php
	if($model->jumlah_buruk!=0)
	{
?>
<h1>Form Laporan Kerusakan Barang</h1>

<?php if(Yii::app()->user->hasFlash('error')):?>
  <div class="flash-error a">
        <?php echo Yii::app()->user->getFlash('error'); ?>
 </div>
<?php endif; ?>
<div class="form">

<div id="operation">
<?php
$items = array(
	10=>array(
        'name' => 'Daftar Barang',
        'link' => array('/barang/index'),
        'icon' => 'google',
        'active' => 'dashboard'
		),
	30=>array(
		'name' => 'Stock Opname',
        'link' => array('/barang/stockOpname'),
        'icon' => 'google',
        'active' => 'dashboard',
		),
	20=>array(
		'name' => 'Transaksi Barang',
        'link' => '#',
        'icon' => 'google',
        'active' => 'dashboard',
		'sub' => array(
            array(
                'name' => 'Pemasukan Barang',
                'link' => array('/barang/listPemasukan'),
            ),
            array(
                'name' => 'Peminjaman Barang',
                'link' => array('/barang/listPeminjaman'),
            ),
			array(
                'name' => 'Pengeluaran Barang',
                'link' => array('/barang/listPengeluaran'),
            ),
			array(
                'name' => 'Penyimpanan Barang',
                'link' => array('/barang/simpanBarang'),
            )
        ),
	)
);

$this->widget('ext.menu.EMenu', array('items' => $items));
?>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barang-form',
	'enableAjaxValidation'=>false,
)); ?>
	<table>
	<tr>
		<td><b>Tanggal Pengajuan</b></td>
		<td><input type="text" size=50 value="<?php echo date("d-m-Y");?>" name="lap[0]" disabled></td>
	</tr>
	
	<tr>
		<td><b>Nama Barang</b></td>
		<td><input type="text" size=50 value="<?php echo $model->nama;?>" name="lap[1]" disabled></td>
	</tr>
	<tr>
		<td><b>Detail Barang</b></td>
		<td><input type="text" size=50 value="<?php echo $model->deskripsi;?>" name="lap[2]" disabled></td>
	</tr>
	
	<tr>
		<td><b>Jumlah Barang Rusak</b></td>
		<td><input type="text" size=50 value="<?php echo $model->jumlah_buruk;?>" name="lap[3]" disabled></td>
	</tr>
	<tr>
		<td><b>Nama Pemohon</b></td>
		<td><input type="text" size=50 name="lap[4]" > <font color="gray"> Isi nama pemohon</font></td>
	</tr>
	<tr>
		<td><b>Jumlah Barang yang diperbaiki</b></td>
		<td><input type="text" size=50 name="lap[6]" ><font color="gray"> Isi jumlah barang yang diperbaiki</font></td>
	</tr>

	<tr>
		<td><b>Deskripsi</b></td>
		<td><textarea name="lap[5]" rows=8 cols=60 ></textarea></td>
	</tr>

</table>


<?php echo CHtml::submitButton('Cetak');?>
	
<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
	}
	else
	{
?>
		
<script>
alert('Tidak ada barang rusak!');
window.location = 'index.php?r=barang';
</script>

<?php
	}
?>

