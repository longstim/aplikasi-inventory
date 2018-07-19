<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
	$sql='SELECT * FROM inv_r_gudang WHERE nama NOT LIKE "Gudang%"';
	$lok=Gudang::model()->findAllBySql($sql);

	$temp='SELECT * FROM inv_x_barang_gudang
		INNER JOIN inv_r_gudang 
		ON inv_x_barang_gudang.id_gudang=inv_r_gudang.id
		WHERE nama LIKE "Gudang%" AND id_barang="'.$model->id.'"';

	$loc=Gudang::model()->findAllBySql($temp);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barang-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($pengeluaran); ?>
	
	
	<table>
	<tr>
		<td><?php echo $form->label($model,'ID Barang'); ?></td>
		<td><?php echo $form->textField($model,'id',array('disabled'=>'true'))?></td>
		<td><?php echo $form->error($model,'id'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($model,'Nama Barang'); ?></td>
		<td><?php echo $form->textField($model,'nama',array('disabled'=>'true'))?></td>
		<td><?php echo $form->error($model,'nama'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($gudang,'Dikeluarkan dari Gudang: '); ?></td>
		<td><select name='locate'> 
			<?php foreach($loc as $s)
			{
			?>
			<option value='<?php echo $s->id;?>' ><?php echo $s->nama;?></option>
			<?php
			}
			?>
		</select></td>
	</tr>

	<tr>
		<td><?php echo $form->label($gudang,'Ditempatkan ke Lokasi: '); ?></td>
		<td><select name='lokasi'> 
			<?php foreach($lok as $l)
			{
			?>
			<option value='<?php echo $l->id;?>' ><?php echo $l->nama;?></option>
			<?php
			}
			?>
		</select></td>
	</tr>
	
	<tr>
		<td><?php echo $form->label($pengeluaran,'Tanggal Pengeluaran'); ?></td>
		<td><?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$pengeluaran,
			'attribute'=>'tgl_pengeluaran',
            'value'=>$pengeluaran->tgl_pengeluaran,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
				'changeMonth'=>'true',
				'changeYear'=>'true',
            ),
        ));
		?></td>
		<td><?php echo $form->error($pengeluaran,'tgl_pengeluaran'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($model,'Jumlah'); ?></td>
		<td><input type="text" name="jumlah_baik"><font color="gray"> Jumlah barang baik</font></td>
		<td><?php echo $form->error($model,'jumlah'); ?></td>
	<tr>
		<td></td>
		<td><input type="text" name="jumlah_buruk"><font color="gray"> Jumlah barang buruk</font></td>
		<td><?php echo $form->error($model,'jumlah'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->label($pengeluaran,'keterangan'); ?></td>
		<td><?php echo $form->textArea($pengeluaran,'keterangan',array('rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($pengeluaran,'keterangan'); ?></td>
	</tr>

	<tr>
		<td><?php echo CHtml::submitButton('Simpan'); ?></td>
	</tr>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->