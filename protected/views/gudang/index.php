<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<div id="operation">
<?php
$items = array(
	10=>array(
        'name' => 'Tambah Lokasi',
        'link' => array('/gudang/create'),
        'icon' => 'google',
        'active' => 'dashboard'
		),
);

$this->widget('ext.menu.EMenu', array('items' => $items));
?>
</div>

<h1>Daftar Lokasi</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} lokasi.'),

)); ?>
