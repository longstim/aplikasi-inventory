<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<?php
	
	$tipe=Tipe::model()->findByAttributes(array('id'=>$model->tipe));
	if($this->periksaRole(Yii::app()->user->id)=='Administrator')
	{
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'nama',
			array(
				'label'=>'Tipe',
				'value'=>$tipe->tipe,
				),
			array(
				'label'=>'Jumlah',
				'value'=>$model->jumlah==0?"Tidak Tersedia":$model->jumlah,
			),
			array
			(
				'label'=>'Kondisi Barang',
				'value'=>"Jumlah Baik: ".$model->jumlah_baik.", Jumlah Buruk: ".$model->jumlah_buruk,
			),
			array
			(
				'label'=>'Lokasi',
				'value'=>$gudang,
			),
			'deskripsi',
			),
		)); 
	}
	else
	{
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'nama',
			array(
				'label'=>'Tipe',
				'value'=>$tipe->tipe,
				),
			array(
				'label'=>'Jumlah',
				'value'=>$model->jumlah_baik==0?"Tidak Tersedia":$model->jumlah_baik,
			),
			'deskripsi',
			),
		)); 
	}
?>

	
<div class="gambar">
<?php
	if($model->url_gambar==NULL)
	{
?>
	<img src=<?php echo Yii::app()->request->baseUrl.'/images/barang/cover.jpg';?>></img>
<?php
	}
	else
	{
?>
	<img src=<?php echo Yii::app()->request->baseUrl.'/images/barang/'.$model->url_gambar;?>></img>
<?php
	}
?>
</div>