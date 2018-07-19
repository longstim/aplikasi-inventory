<?php
/* @var $this BarangController */
/* @var $model Barang */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('barang-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<h1>Daftar Barang Inventory Del</h1>

<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'keyword'=>$keyword,
)); ?>
</div><!-- search-form -->


<?php 

	$role = UserRole::model()->findByAttributes(array('key_sys_user'=>Yii::App()->user->id));

	$userRole='';
	if(isset($role->key_sys_role))
	{
		$userRole=$role->key_sys_role;
	}
	
	if($userRole=='Administrator')
	{
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'barang-grid',
		'dataProvider'=>$model->cariNamaBarang($keyword),
		'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} barang.'),
		'emptyText'=>'Tidak ada barang yang ditemukan',
		'pager'=>array(
			'header'=>'',
			'prevPageLabel'=>'&lt; Sebelumnya',
			'nextPageLabel'=>'Selanjutnya &gt;',
		),
		'columns'=>array(
			array(
				'header'=>'No',
				'value'=>'$row+1'
				),
			'nama',
			array(
				'header'=>'Jumlah',
				'value'=>'$data->jumlah==0?"Tidak Tersedia":$data->jumlah',
				),
			array(
			'class' => 'CButtonColumn',
			'template' => '{lihat}',
			'buttons'=>array(
					   'lihat' => array(
					   'label' => 'Lihat',
						'url'=>'Yii::app()->createUrl("barang/view", array("id"=>$data->id,"asDialog"=>1))',
						'options'=>array(  
							'ajax'=>
								array(
									'type'=>'POST',
									'url'=>"js:$(this).attr('href')", 
									'update'=>'#id_view',
									)		
							),
					),
				),
			),
		),
	)); 
	}
	else
	{
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'barang-grid',
		'dataProvider'=>$model->cariNamaBarang($keyword),
		'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} barang.'),
		'emptyText'=>'Tidak ada barang yang ditemukan',
		'pager'=>array(
			'header'=>'',
			'prevPageLabel'=>'&lt; Sebelumnya',
			'nextPageLabel'=>'Selanjutnya &gt;',
		),
		'columns'=>array(
			array(
				'header'=>'No',
				'value'=>'$row+1'
				),
			'nama',
			array(
				'header'=>'Jumlah',
				'value'=>'$data->jumlah_baik==0?"Tidak Tersedia":$data->jumlah_baik',
				),
			array(
			'class' => 'CButtonColumn',
			'template' => '{lihat}',
			'buttons'=>array(
					   'lihat' => array(
					   'label' => 'Lihat',
						'url'=>'Yii::app()->createUrl("barang/view", array("id"=>$data->id,"asDialog"=>1))',
						'options'=>array(  
							'ajax'=>
								array(
									'type'=>'POST',
									'url'=>"js:$(this).attr('href')", 
									'update'=>'#id_view',
									)		
							),
					),
				),
			),
		),
	)); 

	}
	?>
	
<div id="id_view"></div>
<?php
