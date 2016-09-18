<?php

class SubkategoriController extends PortalController
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('displayImage'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','deleted'),
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
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
        $ceklis = Booleancontent::model()->findByAttributes(array('idsubkategori'=>$id));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'ceklis'=>$ceklis
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		// $userid = Yii::app()->user->id;
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }

		$model=new Subkategori;
		$ceklis=new Booleancontent;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		// $path = Yii::app()->basePath . '/../upload';
		$path = str_replace('protected', '', Yii::app()->basePath);
		$path = $path . 'upload';
		if (!is_dir($path)) {
		    mkdir($path);
		}
		
		if (isset($_POST['Subkategori'])) {
			// var_dump($_POST);exit;
			$model->attributes=$_POST['Subkategori'];
			// if (@!empty($_FILES['Subkategori']['name']['gambar'])) {
	  //           $model->gambar = $_POST['Subkategori']['gambar'];
	  //           if ($model->validate(array('gambar'))) {
	  //               $model->gambar = CUploadedFile::getInstance($model, 'gambar');
	            
		 //            $model->gambar->saveAs($path . '/' . strtolower($model->gambar));
		 
		 //            // $model->gambar = $model->gambar->getName();
	  //           // $model->gambar = $model->gambar->getSize();
	  //       		$model->gambar = strtolower($model->gambar);
	  //       	}
	  //       }
	        if (@!empty($_FILES['Subkategori']['name']['gambar'])){
                $gambar = CUploadedFile::getInstance($model, 'gambar');
                $model->gambar_size = $gambar->size;
                $model->gambar_type = $gambar->type;
                $model->gambar_name = $gambar->name;
                $model->gambar = file_get_contents($gambar->tempName);
            }
			if ($model->save()) {
				$ceklis->attributes=$_POST['Booleancontent'];
				$ceklis->judul = $_POST['Booleancontent']['judul'];
				$ceklis->sinopsis = $_POST['Booleancontent']['sinopsis'];
				$ceklis->isi = $_POST['Booleancontent']['isi'];
				$ceklis->gambar = $_POST['Booleancontent']['gambar'];
				$ceklis->video = $_POST['Booleancontent']['video'];
				$ceklis->lampiran = $_POST['Booleancontent']['lampiran'];
				$ceklis->idsubkategori=$model->idsubkategori;
				$ceklis->save();
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'ceklis'=>$ceklis
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

		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
        $ceklis = Booleancontent::model()->findByAttributes(array('idsubkategori'=>$id));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        // $path = Yii::app()->basePath . '/../upload';
        $path = str_replace('protected', '', Yii::app()->basePath);
		$path = $path . 'upload';
		if (!is_dir($path)) {
		    mkdir($path);
		}

		$gbr = Subkategori::model()->findByAttributes(array('idsubkategori'=>$id));

		if (isset($_POST['Subkategori'])) {
			$model->attributes=$_POST['Subkategori'];
			// if (@!empty($_FILES['Subkategori']['name']['gambar'])) {
	  //           $model->gambar = $_POST['Subkategori']['gambar'];
	  //           if ($model->validate(array('gambar'))) {
	  //               $model->gambar = CUploadedFile::getInstance($model, 'gambar');
	            
		 //            $model->gambar->saveAs($path . '/' . strtolower($model->gambar));
		 
		 //            // $model->gambar = $model->gambar->getName();
	  //           // $model->gambar = $model->gambar->getSize();
	  //       		$model->gambar = strtolower($model->gambar);
	  //       	}
	  //       }
			if (@!empty($_FILES['Subkategori']['name']['gambar'])){
                $gambar = CUploadedFile::getInstance($model, 'gambar');
                $model->gambar_size = $gambar->size;
                $model->gambar_type = $gambar->type;
                $model->gambar_name = $gambar->name;
                $model->gambar = file_get_contents($gambar->tempName);
            }
	        else{
	        	$model->gambar = $gbr->gambar;
	        }
			if ($model->save()) {
				$ceklis->attributes=$_POST['Booleancontent'];
				$ceklis->idsubkategori=$model->idsubkategori;
				$ceklis->save();
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'ceklis'=>$ceklis
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleted()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		// if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
        	$id=$_GET['id'];
			$model=Subkategori::model()->findByPk($id);

			$cont = Content::model()->findAllByAttributes(array('idsubkategori'=>$id));
			if(count($cont)>0){
				Yii::app()->user->setFlash('danger', array('title' => 'Mohon Maaf', 'text' => 'sub kategori tidak dapat dihapus karena terhubung dengan data lain'));
				$this->redirect(array('subkategori/index'));
			}
			else{
				$model->delete();
			}

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
	// 	$dataProvider=new CActiveDataProvider('Subkategori');
	// 	$this->render('index',array(
	// 		'dataProvider'=>$dataProvider,
	// 	));
	// }

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		$model=new Subkategori('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Subkategori'])) {
			$model->attributes=$_GET['Subkategori'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Subkategori the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Subkategori::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Subkategori $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='subkategori-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDisplayImage()
	{
		if(isset($_GET['id'])){
			$model = Subkategori::model()->findByAttributes(array('idsubkategori'=>$_GET['id']));
			if($model){
				header('Pragma: public');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Content-Transfer-Encoding: binary');
				header('Content-length: '.$model->gambar_size);
				header('Content-Type: '.$model->gambar_type);
				// header('Content-Disposition: attachment; filename='.$model->gambar_name);
				echo $model->gambar;
			}else echo "Data tidak ditemukan";
		}
	}
}