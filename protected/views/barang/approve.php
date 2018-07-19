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


<h1>Persetujuan Peminjaman Barang</h1>

<?php
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Nama Peminjam',
			'value'=>$model->userList($model->id_peminjaman_user),
			),
		array(
			'label'=>'Nama Barang',
			'value'=>$model->barangList($model->id_peminjaman_barang),
			),
		'tgl_peminjaman',
		'tgl_pengembalian',
		'jumlah',
		array(
			'label'=>'Status Peminjaman',
			'value'=>$model->status_approval == "setuju"? "Peminjaman disetujui": ($model->status_approval == "tidaksetuju"?"Peminjaman tidak disetujui":"-"),
			),
		'keterangan',
		),
	)); 
?>

<div class="persetujuan">
	<a href = "<?php echo $this->createURL('barang/approval',array('id'=>$model->id,'setuju'=>1));?>"><img src="<?php echo Yii::app()->request->baseUrl.'/images/setuju.png';?>"></img></a>
	<a href = "<?php echo $this->createURL('barang/approval',array('id'=>$model->id,'setuju'=>2));?>"><img src="<?php echo Yii::app()->request->baseUrl.'/images/tidaksetuju.png';?>"></img></a>
</div>

