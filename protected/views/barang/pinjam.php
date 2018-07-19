
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
        'link' => array('/site/index'),
        'icon' => 'google',
        'active' => 'dashboard'
		),
);

$this->widget('ext.menu.EMenu', array('items' => $items));
?>
</div>

<h1>Form Peminjaman Barang</h1>
<?php if(Yii::app()->user->hasFlash('error')):?>
  <div class="flash-error a">
        <?php echo Yii::app()->user->getFlash('error'); ?>
 </div>
<?php endif; ?>

<?php echo $this->renderPartial('_form_pinjam', array('model'=>$model,'peminjaman'=>$peminjaman)); ?>