<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<center><b>Nama Barang</b>: <?php echo CHtml::textField('cari',isset($keyword)?$keyword:'',array('size'=>30,'maxlength'=>100)); ?>
		<?php echo CHtml::submitButton('Cari'); ?>
		</center>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->