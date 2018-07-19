<?php

class GudangController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function filterCheckPrivilages($filterChain)
	{
		$accessController = new AccessController();
		if(!$accessController->isAllowed())
		{
		//redirect ke form login
			if(Yii::App()->user->isGuest)
			{
				$this->redirect(array('site/alertLogin'));
			}
			else
			{
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$filterChain->run();
	}


	public function filters()
	{
		//applikasikan filter ke semua action
		return array(
			'checkPrivilages',
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('if11049'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCreate()
	{
		$model=new Gudang;

		if(isset($_POST['Gudang']))
		{
			$model->attributes=$_POST['Gudang'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Gudang']))
		{
			$model->attributes=$_POST['Gudang'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$model=new Gudang('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gudang']))
			$model->attributes=$_GET['Gudang'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function loadModel($id)
	{
		$model=Gudang::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gudang-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
