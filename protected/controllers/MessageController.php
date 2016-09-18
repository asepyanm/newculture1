<?php

class MessageController extends PortalController
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
				'actions'=>array('index','view','create','update','admin','delete','coba'),
				'users'=>array('@'),
			),
			// array('allow', // allow admin user to perform 'admin' and 'delete' actions
			// 	'actions'=>array('admin','delete'),
			// 	'users'=>array('admin'),
			// ),
			// array('deny',  // deny all users
			// 	'users'=>array('*'),
			// ),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$id = $_GET['id'];
		$nik_kirim = $_GET['nik_kirim'];

		

		$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
				d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
				FROM content t
				INNER JOIN p_status p ON t.idstatus = p.idstatus
				INNER JOIN (SELECT x.idsubkategori, x.nama AS namasub, y.idkategori, y.nama AS namakat FROM subkategori x INNER JOIN kategori y 
				ON x.idkategori = y.idkategori) z ON z.idsubkategori = t.idsubkategori
				INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
				b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
				  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK
				WHERE t.idcontent =:id GROUP BY t.idcontent ORDER BY t.idcontent DESC";

		$commands = Yii::app()->db->createCommand($sql);
	  	$commands->bindParam(':id', $id, PDO::PARAM_INT);
	  	$content = $commands->queryAll();

		$lampiran = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
		// $content = Content::model()->findByPk($id);
		$criteria = new CDbCriteria;
		$criteria->condition = 'idcontent=:id';
		$criteria->order = 'created_date DESC';
		$criteria->params = array('id'=>$id);

		$up = Message::model()->findAllByAttributes(array('idcontent'=>$id,'to'=>Yii::app()->user->id));
		foreach ($up as $value) {
			$data = Message::model()->findByPk($value->idmessage);
			$data->status = 1;
			$data->save();
		}

		$dataProvider = new CActiveDataProvider('Message', array(
			'criteria'=>$criteria,
		));


		$model = new Message;
		if(isset($_POST['Message'])){
			$model->created_by = Yii::app()->user->id;
        	$model->created_date = date('Y-m-d H:i:s');
        	$model->status = 0;
        	$model->idcontent = $id;
        	$model->isi = $_POST['Message']['isi'];
        	$model->to = $nik_kirim;
        	if($model->save()){
        		$this->refresh();
        	}
		}
		$this->render('view',array(
			'dataProvider'=>$dataProvider,
			'content'=>$content,
			'lampiran'=>$lampiran,
			'model'=>$model
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Message;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Message'])) {
			$model->attributes=$_POST['Message'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->idmessage));
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Message'])) {
			$model->attributes=$_POST['Message'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->idmessage));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	// public function actionIndex()
	// {
	// 	$dataProvider=new CActiveDataProvider('Message');
	// 	$this->render('index',array(
	// 		'dataProvider'=>$dataProvider,
	// 	));
	// }

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Message('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Message'])) {
			$model->attributes=$_GET['Message'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Message the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}


	/**
	 * Performs the AJAX validation.
	 * @param Message $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='message-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}