<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />


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

<h1>Daftar Transaksi Peminjaman Barang</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'barang-grid',
	'dataProvider'=>$model->cari($keyword),
	'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} transaksi peminjaman barang.'),
	'emptyText'=>'Tidak ada barang yang ditemukan',
	'pager'=>array(
		'header'=>'',
		'prevPageLabel'=>'&lt; Sebelumnya',
		'nextPageLabel'=>'Selanjutnya &gt;',
	),
	//'filter'=>$model,
	'rowCssClassExpression'=>'$data->status_approval == "setuju" || $data->status_approval == "tidaksetuju" ? "approve" : "belumlihat"',
	'columns'=>array(
		array(
			'header'=>'No',
			'value'=>'$row+1',
			),
		array(
			'name'=>'id_peminjaman_user',
			'header'=>'Nama User',
			'value'=>'$data->userList($data->id_peminjaman_user)',
			),
		array(
			'name'=>'id_peminjaman_barang',
			'header'=>'Nama Barang',
			'value'=>'$data->barangList($data->id_peminjaman_barang)',
			),
		array(
			'name'=>'tgl_peminjaman',
			'header'=>'Tanggal Peminjaman',
			'value'=>'Yii::app()->dateFormatter->format("d MMMM y",strtotime($data->tgl_peminjaman))',
			),
		array(
			'name'=>'tgl_pengembalian',
			'header'=>'Tanggal Pengembalian',
			'value'=>'Yii::app()->dateFormatter->format("d MMMM y",strtotime($data->tgl_pengembalian))',
			),
		'jumlah',
		'keterangan',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{Detail}',
			'buttons'=>array
			(
				'Detail' => array(
				 'label'=>'Lihat',
				 'url'=>'Yii::app()->createUrl("barang/approval", array("id"=>$data->id))',
				 ),
			),
		),
	),
)); ?>
