<?php

class TestimoniController extends PortalController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('create','update','index','view','switch','DisplayVideo','deleter','cekUser','CekUserUpdate'),
				'users'=>array('@'),
			),
			// array('allow', // allow admin user to perform 'admin' and 'delete' actions
			// 	'actions'=>array('delete'),
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
		$test = Testimoni::model()->findByPk($id);
		$test->stts_notif = 1;
		$test->save();

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionSwitch()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect('site/index');
        }
        if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$model = Testimoni::model()->findByPk($id);
			if($model->stts_testimoni == 1){
				$model->stts_testimoni = 0;
			}
			else if($model->stts_testimoni == 0){
				$model->stts_testimoni = 1;
			}
			$model->save();
			$this->redirect(array('testimoni/index'));
		}
	}

	public function actionCekUser()
	{
		$nik = $_POST['id'];
		$model = Testimoni::model()->findAllByAttributes(array('nik_user'=>$nik));
		$count = count($model);
		if($count>0){
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}
	}

	public function actionCekUserUpdate()
	{
		$nik = $_POST['id'];
		$nik_ori = $_POST['id_ori'];
		if ($nik != $nik_ori){
			$model = Testimoni::model()->findAllByAttributes(array('nik_user'=>$nik));
			$count = count($model);
			if($count>0){
				echo json_encode(false);
			}else{
				echo json_encode(true);
			}
		}else{
			echo json_encode(true);
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Testimoni;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	    if (isset($_POST['Testimoni'])) {
			$model->attributes=$_POST['Testimoni'];

			if (@!empty($_FILES['Testimoni']['name']['video'])){
                $video = CUploadedFile::getInstance($model, 'video');
                $model->video_size = $video->size;
                $model->video_type = $video->type;
                $model->video_name = $video->name;
                $model->video = file_get_contents($video->tempName);
        	}

			$model->isi_testimoni=$_POST['Testimoni']['isi_testimoni'];
			$model->created_date=date('Y-m-d H:i:s');
			$model->stts_testimoni=0;
			$model->stts_notif=0;
			if ($model->save()) {
				$this->redirect(array('testimoni/index'));
			}
		}

		$isAdmin = Yii::app()->user->itemname;
		$unit=null;
		if ($isAdmin=='adminunit'){
			$unit = User::model()->findByAttributes(array('N_NIK'=>Yii::app()->user->id))->V_SHORT_UNIT;
			$divisi = User::model()->findByAttributes(array('N_NIK'=>Yii::app()->user->id))->C_KODE_DIVISI;
		}
		$user=new User('search');
		$user->unsetAttributes();
		if (isset($_GET['User'])) {
			$user->attributes=$_GET['User'];
		}

		$this->render('create',array(
			'model'=>$model,
			'user'=>$user,
			'unit'=>$unit,
			'divisi'=>$divisi,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$vid = $model->video;
		$type = $model->video_type;
		$size = $model->video_size;
		$name = $model->video_name;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Testimoni'])) {
			$model->attributes=$_POST['Testimoni'];
			if (@!empty($_FILES['Testimoni']['name']['video'])){
                $video = CUploadedFile::getInstance($model, 'video');
                $model->video_size = $video->size;
                $model->video_type = $video->type;
                $model->video_name = $video->name;
                $model->video = file_get_contents($video->tempName);
        	}else{
        		$model->video_size = $size;
                $model->video_type = $type;
                $model->video_name = $name;
        		$model->video = $vid;
        	}
			if ($model->save()) {
				$this->redirect(array('testimoni/index'));
			}
		}

		$isAdmin = Yii::app()->user->itemname;
		$unit=null;
		if ($isAdmin=='adminunit'){
			$unit = User::model()->findByAttributes(array('N_NIK'=>Yii::app()->user->id))->V_SHORT_UNIT;
		}
		$user=new User('search');
		$user->unsetAttributes();
		if (isset($_GET['User'])) {
			$user->attributes=$_GET['User'];
		}

		$this->render('update',array(
			'model'=>$model,
			'user'=>$user,
			'unit'=>$unit
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
			$this->loadModel($id)->delete();

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
	public function actionIndex()
	{
		$model=new Testimoni('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Testimoni'])) {
			$model->attributes=$_GET['Testimoni'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Testimoni('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Testimoni'])) {
			$model->attributes=$_GET['Testimoni'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Testimoni the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Testimoni::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Testimoni $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='testimoni-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDisplayVideo()
	{
		if(isset($_GET['id'])){
			$model = Testimoni::model()->findByAttributes(array('id_testimoni'=>$_GET['id']));
			if($model){
				header('Pragma: public');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Content-Transfer-Encoding: binary');
				header('Content-length: '.$model->video_size);
				header('Content-Type: '.$model->video_type);
				// header('Content-Disposition: attachment; filename='.$model->video_name);
				echo $model->video;
			}else echo "Data tidak ditemukan";
		}
	}
}