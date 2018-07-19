
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<?php
/* @var $this BarangController */
/* @var $model Barang */
?>

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
<h1>Form Pengeluaran Barang</h1>
<?php if(Yii::app()->user->hasFlash('error')):?>
  <div class="flash-error a">
        <?php echo Yii::app()->user->getFlash('error'); ?>
 </div>
<?php endif; ?>

<?php echo $this->renderPartial('_form_keluar', array('model'=>$model,'pengeluaran'=>$pengeluaran,'gudang'=>$gudang)); ?>