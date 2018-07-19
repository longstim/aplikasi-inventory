<center><p><font size=3>Selamat Datang</font></p>
<?php
	echo "<p><font size=3 color=#000000><b>".Yii::app()->user->name."</b></font></p>";
	echo CHtml::link("[Logout]",'index.php?r=site/logout');
	//echo CHtml::button('Logout', array('submit' => array('site/logout')));

?>

