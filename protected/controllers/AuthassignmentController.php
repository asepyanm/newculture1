<?php

class AuthassignmentController extends PortalController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			// array('allow',  // allow all users to perform 'index' and 'view' actions
			// 	'actions'=>array('index','view'),
			// 	'users'=>array('*'),
			// ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'deleter', 'create','update','delete','cekUser','CekUserUpdate'),
				'users'=>array('@'),
			),
			// array('allow', // allow admin user to perform 'admin' and 'delete' actions
			// 	'actions'=>array('admin','delete'),
			// 	'users'=>array('admin'),
			// ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$crit = new CDbCriteria;
        $crit->select = 't.itemname, t.nik, a.V_NAMA_KARYAWAN, a.V_SHORT_POSISI, a.V_SHORT_DIVISI';
        $crit->join = 'INNER JOIN user a on a.N_NIK=t.nik';
        $crit->condition = 't.nik=:nik';
        $crit->params = array(':nik' => $id);
        $model = Authassignment::model()->find($crit);
        var_dump($model);exit;
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Authassignment;
		$model2 = new Roleunit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$user=new User('search');
		$user->unsetAttributes();
		if (isset($_GET['User'])) {
			$user->attributes=$_GET['User'];
		}
		
		$unit = new Unit('search');
		$unit->unsetAttributes();
		if (isset($_GET['Unit'])) {
			$unit->attributes=$_GET['Unit'];
		}

		if (isset($_POST['Authassignment'])) {
			// var_dump($_POST);exit;
			$model->attributes=$_POST['Authassignment'];

			$model2->attributes = $_POST['Roleunit'];
			$model2->id_unit = $_POST['Roleunit']['id_unit'];
			$model2->nik = $_POST['Authassignment']['nik'];

			$save1 = $model->save();
			$save2 = $model2->save(); 
			
			if ($save1==true && $save2==true) {
				$this->redirect(array('index'));
			}
		}

		$listunit = Unit::model()->findAll();
		$listdivisi = Divisi::model()->findAll();

		$this->render('create',array(
			'model'=>$model,
			'model2'=>$model2,
			'user'=>$user,
			'unit'=>$unit,
			'listdivisi'=>$listdivisi,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
    error_reporting(E_ALL);
		$model=$this->loadModel($id);
		$model2=Roleunit::model()->findByAttributes(array('nik'=>$model->nik));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$user=new User('search');
		$user->unsetAttributes();
		if (isset($_GET['User'])) {
			$user->attributes=$_GET['User'];
		}
		
		$unit = new Unit('search');
		$unit->unsetAttributes();
		if (isset($_GET['Unit'])) {
			$unit->attributes=$_GET['Unit'];
		}

		if (isset($_POST['Authassignment'])) {
			$model->attributes=$_POST['Authassignment'];
			$model2->attributes = $_POST['Roleunit'];
			$model2->id_unit = $_POST['Roleunit']['id_unit'];
			$model2->nik = $_POST['Authassignment']['nik'];

			$save1 = $model->save();
			$save2 = $model2->save();

			if ($save1==true && $save2==true) {
				$this->redirect(array('index'));
			}
		}

		$listdivisi = Divisi::model()->findAll();

		$this->render('update',array(
			'model'=>$model,
			'model2'=>$model2,
			'user'=>$user,
			'unit'=>$unit,
			'listdivisi'=>$listdivisi,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleter()
	{
		// if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$id=$_GET['id'];
			$model=Authassignment::model()->findByPk($id);
			$model2=Roleunit::model()->findByAttributes(array('nik'=>$model->nik));
			$model->delete();
			$model2->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		// } else {
		// 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		// }
	}

	/**
	 * Lists all models.
	 */
	// public function actionIndex()
	// {
	// 	$dataProvider=new CActiveDataProvider('Authassignment');
	// 	$this->render('index',array(
	// 		'dataProvider'=>$dataProvider,
	// 	));
	// }

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Authassignment('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Authassignment'])) {
			$model->attributes=$_GET['Authassignment'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Authassignment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Authassignment::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Authassignment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='authassignment-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCekUserXx()
	{
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$uniq = Authassignment::model()->findByAttributes(array('nik'=>$id));
			$jml = count($uniq);
			if($jml>0){
				echo json_encode(false);
			}
			else{
				echo json_encode(true);
			}
		}
	}

	public function actionCekUser()
	{
		$id = $_POST['id'];
		$crit = Authassignment::model()->findByAttributes(array('nik'=>$id));
		
		if($crit!=null){
			$message = 'USER_EXISTS';
			echo json_encode($message);
		}else{
			$message = 'USER_AVAILABLE';
			echo json_encode($message);
		}
	}

	public function actionCekUserUpdate()
	{
		$id = $_POST['id'];
		$id_ori = $_POST['id_ori'];
		$message = 'USER_AVAILABLE';
		if($id!=$id_ori){
			$crit = Authassignment::model()->findByAttributes(array('nik'=>$id));
		
			if($crit!=null){
				$message = 'USER_EXISTS';
			}
		}
		echo json_encode($message);
		
	}
}