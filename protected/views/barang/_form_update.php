<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barang-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>


	<?php echo $form->errorSummary($model); ?>
	
	<table border=1px>
	<tr>
		<td><?php echo $form->label($model,'nama'); ?></td>
		<td><?php echo $form->textField($model,'nama',array('size'=>66,'maxlength'=>200)); ?></td>
		<td><?php echo $form->error($model,'nama'); ?></td>
	<tr>

	<tr>
		<td><?php echo $form->label($model,'tipe'); ?></td>
		<td><?php echo $form->dropDownList($model,'tipe', CHtml::listData(Tipe::model()->findAll(array('order' => 'id')),'id','tipe'));?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($model,'Jumlah'); ?></td>
		<td><input type="text" name="jumlah_baik" value="<?php echo $model->jumlah_baik;?>"><font color="gray"> Jumlah barang baik</font></td>
		<td><?php echo $form->error($model,'jumlah_baik'); ?></td>
	<tr>
		<td></td>
		<td><input type="text" name="jumlah_buruk" value="<?php echo $model->jumlah_buruk;?>"><font color="gray"> Jumlah barang buruk</font></td>
		<td><?php echo $form->error($model,'jumlah_buruk'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($model,'deskripsi'); ?></td>
		<td><?php echo $form->textArea($model,'deskripsi',array('rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($model,'deskripsi'); ?></td>
	</tr>

	
	<tr>
        <td><?php echo $form->labelEx($model,'Gambar'); ?></td>
        <td><?php echo $form->fileField($model, 'url_gambar'); ?></td>
        <td><?php echo $form->error($model,'url_gambar'); ?>
	</tr>

	<tr>
		<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Update'); ?></td>
	</tr>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->