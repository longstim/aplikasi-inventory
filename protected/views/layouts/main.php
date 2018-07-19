<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<!-- <div id="logo"> <?php echo CHtml::encode(Yii::app()->name); ?> </div> -->
		<?php echo CHtml::image(Yii::app()->request->baseUrl."/images/header.jpg")?>
	</div><!-- header -->

	<div id="mainmenu">
		
		<?php 

		$role = UserRole::model()->findByAttributes(array('key_sys_user'=>Yii::App()->user->id));

		$userRole='';
		if(isset($role->key_sys_role))
		{
			$userRole=$role->key_sys_role;
		}
	
		if($userRole=='Administrator')
		{
			$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Beranda', 'url'=>array('/site/index')),
				array('label'=>'Barang', 'url'=>array('/barang/index')),
				array('label'=>'Lokasi', 'url'=>array('/gudang/index')),
				array('label'=>'Tentang', 'url'=>array('/site/page', 'view'=>'about')),
			),
		)); 
		}
		else
		{
			
			$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Beranda', 'url'=>array('/site/index')),
				array('label'=>'Tentang', 'url'=>array('/site/page', 'view'=>'about')),
			),
		)); 
		}			
		?>

	</div><!-- mainmenu -->
	
	<div id="sidebar-left">
		<div id="side-login">
			<?php 
				if(Yii::app()->user->isGuest)
				{
					$this->renderPartial('/site/login',array('model'=>$this->Login()));
				}
				else
				{
					$this->renderPartial('/site/logout');
				}	
			?>
		</div>
		<?php
			if ($userRole=='Administrator')
			{
		?>
		<div id="side-notifikasi">
		<?php $this->renderPartial('/site/notifikasi');?>
		</div>
		<?php
			}
		?>
	</div>

	<?php
		if(Yii::App()->Controller->id=='site')
		{
	?>
		<div id="sidebar-right1">
				<?php $this->widget('ext.simple-calendar.SimpleCalendarWidget'); ?>
		</div>

	<?php
		}
		else
		{
	?>
		<div id="sidebar-right">
				<?php $this->widget('ext.simple-calendar.SimpleCalendarWidget'); ?>
		</div>
	<?php 
		}
	?>
		

	<?php echo $content; ?>
	
	<div class="clear"></div>
	
	<div id="footer">
		<br/>
		Politeknik Informatika Del
		<br/>
		Copyright &copy; <?php echo date('Y'); ?> by <b>SYP14</b>.
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
