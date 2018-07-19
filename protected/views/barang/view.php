<?php	

	$role = UserRole::model()->findByAttributes(array('key_sys_user'=>Yii::App()->user->id));

	$userRole='';
	if(isset($role->key_sys_role))
	{
		$userRole=$role->key_sys_role;
	}
	if($userRole=='Administrator')
	{
	
		$target = 'window.location='."'".$this->createUrl('barang/pinjam',array('id'=>$model->id))."'";
		$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'grid-dialog',
			'options'=>array(
				'title'=>'Detail Barang',
				'autoOpen'=>true,
				'modal'=>true,
				'width'=>700,
				'height'=>600,
				'close'=>'js:function(){
						$("#grid-frame").attr("src","");
						$.fn.yiiGridView.update("subscriptionclaims-grid", {
							data: $(this).serialize()
					   });
					 
				}',
				'buttons'=>array(
					array('text'=>'OK','click'=>'js:function(){$(this).dialog("close")}')),	
			),
			));
	}
	else
	{
		if($model->jumlah_baik==0)
		{
			$target = 'window.location='."'".$this->createUrl('barang/pinjam',array('id'=>$model->id))."'";
			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'grid-dialog',
			'options'=>array(
				'title'=>'Detail Barang',
				'autoOpen'=>true,
				'modal'=>true,
				'width'=>700,
				'height'=>600,
				'close'=>'js:function(){
						$("#grid-frame").attr("src","");
						$.fn.yiiGridView.update("subscriptionclaims-grid", {
							data: $(this).serialize()
					   });
					 
				}',
				'buttons'=>array(
					array('text'=>'OK','click'=>'js:function(){$(this).dialog("close")}')),	
			),
			));
		}
		else
		{
			$target = 'window.location='."'".$this->createUrl('barang/pinjam',array('id'=>$model->id))."'";
			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'grid-dialog',
			'options'=>array(
				'title'=>'Detail Barang',
				'autoOpen'=>true,
				'modal'=>true,
				'width'=>700,
				'height'=>600,
				'close'=>'js:function(){
						$("#grid-frame").attr("src","");
						$.fn.yiiGridView.update("subscriptionclaims-grid", {
							data: $(this).serialize()
					   });
					 
				}',
				'buttons'=>array(
					array('text'=>'Pinjam','click'=>'js:function(){'.$target.'}'),
					array('text'=>'Batal','click'=>'js:function(){$(this).dialog("close")}')),	
			),
			));
		}

	}
		
		$this->renderPartial('_view', array('model'=>$model,'gudang'=>$gudang));
		
		$this->endWidget();
?>
