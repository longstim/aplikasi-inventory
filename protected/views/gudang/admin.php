<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<div id="operation">
<?php
$items = array(
	
	10=>array(
		'name' => 'Tambah Lokasi',
        'link' => array('/gudang/create'),
        'icon' => 'google',
        'active' => 'dashboard',
	)
);

$this->widget('ext.menu.EMenu', array('items' => $items));
?>
</div>

<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gudang-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Daftar Lokasi</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gudang-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('gudang/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} lokasi.'),
	'emptyText'=>'Tidak ada lokasi yang ditemukan',
	'pager'=>array(
		'header'=>'',
		'prevPageLabel'=>'&lt; Sebelumnya',
		'nextPageLabel'=>'Selanjutnya &gt;',
	),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'nama',
		'keterangan',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'buttons'=>array
			(
				 'update' => array(
				 'label'=>'Update',
				 'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				 'url'=>'Yii::app()->createUrl("gudang/update", array("id"=>$data->id))',
				 ),
				 'delete' => array(
				 'label'=>'Hapus',
				 'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
				 'url'=>'Yii::app()->createUrl("gudang/delete", array("id"=>$data->id))',
				 ),
			),

		),
	),
)); ?>
