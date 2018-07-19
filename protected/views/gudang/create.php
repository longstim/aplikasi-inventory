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
);

$this->widget('ext.menu.EMenu', array('items' => $items));
?>
</div>

<h1>Tambah Lokasi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>