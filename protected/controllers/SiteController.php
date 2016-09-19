<?php

class SiteController extends TemaController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

public function actionIndex()
  {
    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    $model = Kategori::model()->findAll();
    $slide = Content::model()->findAllByAttributes(array('idsubkategori'=>2,'idstatus'=>1));
    $journey = Content::model()->findAllByAttributes(array('idsubkategori'=>1),array(
                                                        'limit'=>2,
                                                        'order'=>'idcontent ASC',
                                                        )
                                                      );
    $isijourney = Kategori::model()->findByAttributes(array('idkategori'=>1));
    
    $crit=new CDbCriteria();
    $crit->condition='idkategori=2';
    $activation=Subkategori::model()->findAll($crit);

    $isittway = Subkategori::model()->findByAttributes(array('idsubkategori'=>2));
    $isiactiv = Kategori::model()->findByAttributes(array('idkategori'=>2));
    $expertknow = Subkategori::model()->findAllByAttributes(array('idkategori'=>3));
    $dashboard = Subkategori::model()->findAllByAttributes(array('idkategori'=>5), array(
                                                        'order'=>'nama ASC',
                                                        ));
    $isiexpertknow = Kategori::model()->findByAttributes(array('idkategori'=>3));
    $isidashboard = Kategori::model()->findByAttributes(array('idkategori'=>5));
	// $galleri = Content::model()->findAllByAttributes(array('idsubkategori'=>8));
    $isLogin= Yii::app()->user->id;
    $galleri = Content::model()->findAll(array('condition'=>'idstatus=1 AND statusinternal=1 AND gambar IS NOT NULL','limit'=>15,'order'=>'idcontent DESC'));
    $isigalleri = Kategori::model()->findByAttributes(array('idkategori'=>4));
	
    if(isset($isLogin)){
        $sql = "SELECT t.*, d.created_by, d.created_date,
          d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
          FROM content t
          INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
          a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
            ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =5 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
      }else{
      $sql = "SELECT t.*, d.created_by, d.created_date,
          d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
          FROM content t
          INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
          a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
            ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =5 AND t.statusinternal=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
      }
    
	////////////////////////dashboard
	$sdiv="SELECT SUM(a.nilai) as nilai, d.nama_unit FROM ratingparam a, rating b, roleunit c, unit d
		   WHERE a.idratingparam=b.idratingparam AND b.nik=c.nik AND c.id_unit=d.id_unit and d.type=1
		   GROUP BY d.nama_unit ORDER BY SUM(a.nilai) DESC LIMIT 3";
	
	$sdir="SELECT SUM(a.nilai) as nilai, d.nama_unit FROM ratingparam a, rating b, roleunit c, unit d
		   WHERE a.idratingparam=b.idratingparam AND b.nik=c.nik AND c.id_unit=d.id_unit and d.type=2
		   GROUP BY d.nama_unit ORDER BY SUM(a.nilai) DESC LIMIT 3";
	
	$swit="SELECT SUM(a.nilai) as nilai, d.nama_unit FROM ratingparam a, rating b, roleunit c, unit d
		   WHERE a.idratingparam=b.idratingparam AND b.nik=c.nik AND c.id_unit=d.id_unit and d.type=3
		   GROUP BY d.nama_unit ORDER BY SUM(a.nilai) DESC LIMIT 3";
	
	$cdiv = Yii::app()->db->createCommand($sdiv);
    $divisi= $cdiv->queryAll();
	
	$cdir = Yii::app()->db->createCommand($sdir);
    $direktorat= $cdir->queryAll();
	
	$cwit = Yii::app()->db->createCommand($swit);
    $witel= $cwit->queryAll();
	
	/////////////////////////
    $commands = Yii::app()->db->createCommand($sql);
    $leadertalk = $commands->queryAll();

    $judultalk = Subkategori::model()->findByAttributes(array('idsubkategori'=>5));
 
    // $sql = "SELECT * from content WHERE idsubkategori=8 AND statusinternal=1 ORDER BY idcontent DESC LIMIT 8";
    // $commands = Yii::app()->db->createCommand($sql);
   //    $galleri = $commands->queryAll();

   //    $sqlv = "SELECT * from content WHERE idsubkategori=9 AND statusinternal=1 ORDER BY idcontent DESC LIMIT 4";
    // $commandsv = Yii::app()->db->createCommand($sqlv);
   //    $vidGal = $commandsv->queryAll();

        $login=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($login);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $login->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($login->validate() && $login->login()){
                Yii::app()->user->setFlash('success', array('title' => 'Welcome', 'text' => 'Lets Share Our Culture With The World'));
                $isAdmin=Yii::app()->user->itemname;
                if($isAdmin=='ldap'){
                  $this->redirect(array('site/index'));
                }
                else{
                  $this->redirect(array('content/index'));
                }
            }
        }

    $kontak = new TPesan;
    if (isset($_POST['TPesan'])) {
      $kontak->attributes=$_POST['TPesan'];
      $kontak->created_date=date('Y-m-d H:i:s');
      $kontak->stts_pesan=0;
      if($kontak->save()){
        Yii::app()->user->setFlash('success', array('title' => 'Message Sent', 'text' => 'Your Message Sent'));
        $this->redirect(array('site/index'));
      }
    }

      $crita=new CDbCriteria();
      $crita->condition='stts_testimoni=1';
      $crita->order='created_date DESC';
      $testimoni=Testimoni::model()->findAll($crita);
	
      
      
      //echo "<pre>";
      // print_r($dashboard);
      //echo "</pre>";
      
     

        // display the login form
        $this->render('index',array(
          'login'=>$login,
          'slide'=>$slide,
          'model'=>$model,
          'journey'=>$journey,
          'isijourney'=>$isijourney,
          'isittway'=>$isittway,
          'activation'=>$activation,
          'isiactiv'=>$isiactiv,
          'expertknow'=>$expertknow,
          'dashboard'=>$dashboard,
          'isiexpertknow'=>$isiexpertknow,
          'isidashboard'=>$isidashboard,
          'galleri'=>$galleri,
          'isigalleri'=>$isigalleri,
          'kontak'=>$kontak,
          'leadertalk'=>$leadertalk,
          'judultalk'=>$judultalk,
          'testimoni'=>$testimoni,
          'divisi'=>$divisi,
          'direktorat'=>$direktorat,
          'witel'=>$witel,
        ));
  }

  public function actionView()
  {
      $this->layout = 'main2';
      $criteria = new CDbCriteria();
      $criteria->select = 't.*';
      $criteria->join = 'INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
          a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
            ON (t.idcontent = d.idcontent)';
      $criteria->join .= ' INNER JOIN roleunit ro ON ro.nik = d.created_by';
      $criteria->join .= ' INNER JOIN unit u ON u.id_unit = ro.id_unit';
      $parameter = array();
      if(isset(Yii::app()->user->id)){
        $criteria->condition='t.idstatus=:st';
      }
      else{
        $criteria->condition='t.idstatus=:st AND t.statusinternal=:stint';
        $parameter[':stint'] = 1;
      }
      $parameter[':st'] = 1;
      if (!empty($_REQUEST['subkategori'])) {
        $criteria->condition.=' AND t.idsubkategori=:subkategori';
        $parameter[':subkategori'] = $_REQUEST['subkategori'];
      }
      if (!empty($_REQUEST['unit'])) {
        $criteria->condition.=' AND u.id_unit=:id_unit';
        $parameter[':id_unit'] = $_REQUEST['unit'];
      }
      $criteria->condition.=' AND (LOWER(judul) LIKE LOWER(:keyword) OR LOWER(sinopsis) LIKE LOWER(:keyword) OR LOWER(isi) LIKE LOWER(:keyword))';
      $parameter[':keyword']="%".$_REQUEST['cari']."%";
      $criteria->params=$parameter;
      $criteria->group = "t.idcontent";
      // $model2 = Content::model()->findAll($criteria);
      $model = new CActiveDataProvider('Content',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>8,'params' => array('cari' => $_REQUEST['cari'],'subkategori' => $_REQUEST['subkategori']))));
      // var_dump($model2);exit;
      $this->render('_view',array(
        'model'=>$model,
        'key'=>$_REQUEST['cari'],
      ));
  }

  public function actionGambarContent($id)
  {
    $file= Content::model()->findByPk(intval($id));
    if (!empty($file)) {
      header('Pragma: public');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Content-Transfer-Encoding: binary');
      header('Content-Type: '.$file->gambar_type);
      $type=explode('/',$file->gambar_type);
      header('Content-Disposition: attachment; filename='.'images-'.$file->gambar_name.'.'.$type[1]);

      echo $file->gambar;
    }else { throw new CHttpException(403,'access denied');}
  }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(Yii::app()->user->isGuest){
            $model=new LoginForm;

            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            // collect user input data
            if(isset($_POST['LoginForm']))
            {
                $model->attributes=$_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if($model->validate() && $model->login()){
                    Yii::app()->user->setFlash('success', array('title' => 'Welcome', 'text' => 'Lets Share Our Culture With The World'));
                    $this->redirect(array('admin/index'));
                }
            }
            // display the login form
            $this->render('login',array('model'=>$model));
        }else{
            // display the home
            $this->redirect(array('site/index'));
        }
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
  public function actionDisplayVideoLeader()
  {
    if(isset($_GET['id'])){
      $model = Content::model()->findByAttributes(array('idcontent'=>$_GET['id']));
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
  public function actionPlayVideoLeader(){
    if(isset($_POST['id'])){
      $model = Content::model()->findByAttributes(array('idcontent'=>$_POST['id']));
      $this->renderPartial('_contentmodalbody', array(
            'model' => $model,
        ));
    }
  }
}