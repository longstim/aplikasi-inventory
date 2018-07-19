<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<style type="text/css"> 
#operation
{
	margin-top:-50px;
}
</style>

<h1>Simpan Barang</h1>
<?php if(Yii::app()->user->hasFlash('error')):?>
  <div class="flash-error a">
        <?php echo Yii::app()->user->getFlash('error'); ?>
 </div>
<?php endif; ?>
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
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barang-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php for($i=0;$i<$jumlah;$i++)
	{
	?>
	<table>
	<b>
	<tr>
		<td><b>Nama Barang</b></td>
		<td><input type="text" value="" name="jumlah[<?php echo $i;?>][0]"></td>
	</tr>
	
	<tr>
		<td><b>Jumlah</b></td>
		<td><input type="text" value="" name="jumlah[<?php echo $i;?>][1]"></td>
	</tr>

	<tr>
		<td><b>Spesifikasi</b></td>
		<td><input type="text" value="" name="jumlah[<?php echo $i;?>][2]"></td>
	</tr>
	<tr>
	<td><b>Kondisi</b></td>
	<td><select name='jumlah[<?php echo $i;?>][3]'> 
		<option value='Baik'>Baik</option>
		<option value='Buruk'>Buruk</option>
	
	</select></td>
	</tr>
	</b>
</table>
<hr/>
	<?php
	}
	?>
	
	<?php echo CHtml::submitButton('Simpan');?>
	


<?php $this->endWidget(); ?>

</div><!-- form -->

