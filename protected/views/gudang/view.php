<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<div id="operation">
<?php
$items = array(
	10=>array(
        'name' => 'Daftar Lokasi',
        'link' => array('/gudang/index'),
        'icon' => 'google',
        'active' => 'dashboard'
		),
	20=>array(
		'name' => 'Tambah Lokasi',
        'link' => array('/gudang/create'),
        'icon' => 'google',
        'active' => 'dashboard',
	),
);

$this->widget('ext.menu.EMenu', array('items' => $items));
?>
</div>

<h1>Daftar Barang di <?php echo $model->nama; ?></h1>

<?php
	
	$dataProvider = new CActiveDataProvider('BarangGudang',array(
	'criteria' =>array(
		'condition'=>'id_gudang='.$model->id,
		)
	));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gudangbarang-grid',
	'dataProvider'=>$dataProvider,
	'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} barang.'),
	'emptyText'=>'Tidak ada barang  yang ditemukan',
	'pager'=>array(
		'header'=>'',
		'prevPageLabel'=>'&lt; Sebelumnya',
		'nextPageLabel'=>'Selanjutnya &gt;',
	),
	//'filter'=>$model,
	'columns'=>array(
		array(
		  'header'=>'No',
		  'value'=>'$row+1',
		),
		array(
		  'name'=>'id_barang',
		  'header'=>'Nama Barang',
		  'value'=>'$data->barangList($data->id_barang)',
		),
		'jumlah',
	),
)); ?>