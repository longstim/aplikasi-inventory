<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barang-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<table>

	<tr>
		<td><?php echo $form->label($model,'Nama'); ?></td>
		<td><?php echo $form->textField($model,'penyimpan'); ?></td>
		<td><?php echo $form->error($model,'penyimpan'); ?></td>
	</tr>
			
	<tr>
		<td><?php echo $form->label($model,'Tanggal'); ?></td>
		<td><?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,
			'attribute'=>'tgl_penyimpanan',
            'value'=>$model->tgl_penyimpanan,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
				'changeMonth'=>'true',
				'changeYear'=>'true',
            ),
        ));
		?></td>
		<td><?php echo $form->error($model,'tgl_penyimpanan'); ?></td>
	</tr>

	<tr>
		<td><b>Jumlah jenis Barang</b></td>
		<td><input type="text" value="" name="jumlah"></td>
	</tr>


	<tr>
		<td><?php echo $form->label($model,'Keterangan'); ?></td>
		<td><?php echo $form->textArea($model,'keterangan',array('rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($model,'keterangan'); ?></td>
	</tr>


	<tr>
		<td><?php echo CHtml::submitButton('Berikutnya'); ?></td> 
	</tr>

	
	</table>


<?php $this->endWidget(); ?>

</div><!-- form -->