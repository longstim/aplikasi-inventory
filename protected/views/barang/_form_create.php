<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
	$sql='SELECT * FROM inv_r_gudang WHERE nama LIKE "Gudang%"';
	$lok=Gudang::model()->findAllBySql($sql);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barang-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<?php echo $form->errorSummary($pemasukan); ?>		
	<?php echo $form->errorSummary($model); ?>	

	<table>

	<?php
		if(isset($model->id))
		{
	?>		<tr>
				<td><?php echo $form->label($model,'ID Barang'); ?></td>
				<td><?php echo $form->textField($model,'id',array('disabled'=>'true'))?></td>
				<td><?php echo $form->error($model,'id'); ?></td>
			</tr>

			<tr>
				<td><?php echo $form->label($model,'Nama Barang'); ?></td>
				<td><?php echo $form->textField($model,'nama',array('disabled'=>'true'))?></td>
				<td><?php echo $form->error($model,'nama'); ?></td>
			</tr>
	<?php
		}
		else
		{
	?>
			<tr>
				<td><?php echo $form->label($model,'Nama Barang'); ?></td>
				<td><?php echo $form->textField($model,'nama')?></td>
				<td><?php echo $form->error($model,'nama'); ?></td>
			</tr>

			<tr>
				<td><?php echo $form->label($model,'tipe'); ?></td>
				<td><?php echo $form->dropDownList($model,'tipe', CHtml::listData(Tipe::model()->findAll(array('order' => 'id')),'id','tipe'));?></td>
			</tr>
	</tr>
	<?php
		}
	?>

	<tr>
				<td><?php echo $form->label($gudang,'Nama Gudang'); ?></td>
				<td><?php echo $form->dropDownList($gudang,'id_gudang', CHtml::listData(Gudang::model()->findAll(array('order' => 'id')),'id','nama'));?></td>
	</tr>
	
	<tr>
		<td><?php echo $form->label($pemasukan,'Tanggal'); ?></td>
		<td><?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$pemasukan,
			'attribute'=>'tgl_pemasukan',
            'value'=>$pemasukan->tgl_pemasukan,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
				'changeMonth'=>'true',
				'changeYear'=>'true',
            ),
        ));
		?></td>
		<td><?php echo $form->error($pemasukan,'tgl_pemasukan'); ?></td>
	<tr>
		<td><?php echo $form->label($model,'Jumlah'); ?></td>
		<td><input type="text" name="jumlah_baik"><font color="gray"> Jumlah barang baik</font></td>
		<td><?php echo $form->error($model,'jumlah_baik'); ?></td>
	<tr>
		<td></td>
		<td><input type="text" name="jumlah_buruk"><font color="gray"> Jumlah barang buruk</font></td>
		<td><?php echo $form->error($model,'jumlah_buruk'); ?></td>
	</tr>
		
	</tr>

	<tr>
		<td><?php echo $form->label($pemasukan,'harga'); ?></td>
		<td><?php echo $form->textField($pemasukan,'harga'); ?></td>
		<td><?php echo $form->error($pemasukan,'harga'); ?></td>
	</tr>


	<tr>
		<td><?php echo $form->label($pemasukan,'keterangan'); ?></td>
		<td><?php echo $form->textArea($pemasukan,'keterangan',array('rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($pemasukan,'keterangan'); ?></td>
	</tr>
	<?php
	if(Yii::app()->controller->action->id=="create")
	{
	?>
	<tr>
        <td><?php echo $form->labelEx($model,'Gambar'); ?></td>
        <td><?php echo $form->fileField($model, 'url_gambar'); ?></td>
        <td><?php echo $form->error($model,'url_gambar'); ?>
	</tr>
	<?php
	}
	?>
	<tr>
		<td><?php echo CHtml::submitButton('Tambah'); ?></td>
	</tr>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->
