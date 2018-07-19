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

	<?php echo $form->errorSummary($peminjaman); ?>
	
	
	<table>
	<tr>
		<td><?php echo $form->label($model,'Nama Barang'); ?></td>
		<td><?php echo $form->textField($model,'nama',array('disabled'=>'true'))?></td>
		<td><?php echo $form->error($model,'nama'); ?></td>
	</tr>
	
	<tr>
		<td><?php echo $form->label($peminjaman,'Tanggal Peminjaman'); ?></td>
		<td><?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$peminjaman,
			'attribute'=>'tgl_peminjaman',
            'value'=>date("Y-M-D"),
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
				'changeMonth'=>'true',
				'changeYear'=>'true',
            ),
        ));
		?></td>
		<td><?php echo $form->error($peminjaman,'tgl_peminjaman'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($peminjaman,'Tanggal Pengembalian'); ?></td>
		<td><?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$peminjaman,
			'attribute'=>'tgl_pengembalian',
            'value'=>$peminjaman->tgl_pengembalian,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
				'changeMonth'=>'true',
				'changeYear'=>'true',
            ),
        ));
		?></td>
		<td><?php echo $form->error($peminjaman,'tgl_pengembalian'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($peminjaman,'jumlah'); ?></td>
		<td><?php echo $form->textField($peminjaman,'jumlah'); echo "<font color=gray> Jumlah barang yang tersedia:".$model->jumlah_baik."</font>";?></td>
		<td><?php echo $form->error($peminjaman,'jumlah'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($peminjaman,'keterangan'); ?></td>
		<td><?php echo $form->textArea($peminjaman,'keterangan',array('rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($peminjaman,'keterangan'); ?></td>
	</tr>

	<tr>
		<td><?php echo CHtml::submitButton('Pinjam'); ?></td>
	</tr>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->