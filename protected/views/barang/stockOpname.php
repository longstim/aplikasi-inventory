<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<h1>Stock Opname</h1>
<style type="text/css"> 
#operation
{
	margin-top:-50px;
}
</style>

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
	'method'=>'get',
)); ?>

	<tr>
	<td>Transaksi </td>
	<td><select name="transaksi"> 
		<option value='' selected >--</option>
		<option value='pemasukan'>Pemasukan</option>
		<option value='peminjaman'>Peminjaman</option>
		<option value='pengeluaran'>Pengeluaran</option>
	</select></td>
	&nbsp;
	<td>Bulan</td>
	<td><select name='bulan'> 
		<option value='' selected >--</option>
		<option value='1'>Januari</option>
		<option value='2'>Februari</option>
		<option value='3'>Maret</option>
		<option value='4'>April</option>
		<option value='5'>Mei</option>
		<option value='6'>Juni</option>
		<option value='7'>Juli</option>
		<option value='8'>Agustus</option>
		<option value='9' >September</option>
		<option value='10'>Oktober</option>
		<option value='11'>November</option>
		<option value='12'>Desember</option>
	</select></td>
	&nbsp;
	<td>Tahun</td>
	<td><select name='tahun'> 
		<option value='' selected >--</option>
		<?php for($i=2013;$i<=date("Y");$i++)
		{
		?>
		<option value='<?php echo $i;?>' ><?php echo $i;?></option>
		<?php
		}
		?>
	</select></td>
	&nbsp;
	<td><?php echo CHtml::submitButton('Lihat'); ?></td>
	</tr>
<?php $this->endWidget(); ?>

<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'barang-grid',
			'dataProvider'=>$model,
			'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} barang.'),
			'emptyText'=>'Tidak ada transaksi yang ditemukan',
			'pager'=>array(
				'header'=>'',
				'prevPageLabel'=>'&lt; Sebelumnya',
				'nextPageLabel'=>'Selanjutnya &gt;',
			),
		));
	
?>

