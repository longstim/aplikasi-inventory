
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<?php
/* @var $this BarangController */
/* @var $model Barang */
?>
<div id="operation">
<?php
$items = array(
	10=>array(
        'name' => 'Tambah Barang Baru',
        'link' => array('/barang/create'),
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
<?php

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

<h1>Daftar Barang</h1>
<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'keyword'=>$keyword,

)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'barang-grid',
	'dataProvider'=>$model->cariNamaBarang($keyword),
	'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} barang.'),
	'emptyText'=>'Tidak ada barang yang ditemukan',
	'pager'=>array(
		'header'=>'',
		'prevPageLabel'=>'&lt; Sebelumnya',
		'nextPageLabel'=>'Selanjutnya &gt;',
	),
	//'filter'=>$model,	
	'columns'=>array(
		'id',
		'nama',
		array(
			'name'=>'tipe',
			'header'=>'Tipe',
			'value'=>'$data->listTipe($data->tipe)',
			),
		'jumlah',
		'deskripsi',
		array(
            'class'=>'CLinkColumn',
            'label'=>'Cetak',
            'urlExpression'=>'Yii::app()->createUrl("barang/laporanKerusakan", array("id"=>$data->id))',
            'header'=>'Lap. Kerusakan'
            ),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{add}{update}{delete}{out}',
			'buttons'=>array
			(
				'add' => array(
				 'label'=>'Tambah',
				 'imageUrl'=>Yii::app()->request->baseUrl.'/images/tambah.png',
				 'url'=>'Yii::app()->createUrl("barang/add", array("id"=>$data->id))',
				 ),
				 'update' => array(
				 'label'=>'Update',
				 'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				 'url'=>'Yii::app()->createUrl("barang/update", array("id"=>$data->id))',
				 ),
				 'delete' => array(
				 'label'=>'Hapus',
				 'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
				 'url'=>'Yii::app()->createUrl("barang/delete", array("id"=>$data->id))',
				 ),
				 'out' => array(
				 'label'=>'Keluar',
				 'imageUrl'=>Yii::app()->request->baseUrl.'/images/keluar.png',
				 'url'=>'Yii::app()->createUrl("barang/barangKeluar", array("id"=>$data->id))',
				 ),
			),
		),
	),
)); ?>
