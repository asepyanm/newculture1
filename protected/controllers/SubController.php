<?php

class SubController extends Tema3Controller
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

	public function actionStory()
	{
		if(isset($_GET['id'])){
			$slide = Content::model()->findAllByAttributes(array('slide'=>'Y'));

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
                    $this->redirect(array('content/index'));
                }
            }

			$id = $_GET['id'];
			$isLogin= Yii::app()->user->id;
			$sub = Subkategori::model()->findByAttributes(array('idsubkategori'=>$id));
			$kategori = Kategori::model()->findByAttributes(array('idkategori'=>$sub->idkategori));

			$criteria=new CDbCriteria();
			if(isset($isLogin)){
				$criteria->condition='idsubkategori=:id AND idstatus=1';
			}
			else{
				$criteria->condition='idsubkategori=:id AND idstatus=1 AND statusinternal=1';
			}
			$criteria->order='idcontent ASC';
			$criteria->params=array(':id'=>$id);
		    $count=Content::model()->count($criteria);
		    $pages=new CPagination($count);
		    $pages->pageSize=10;
		    $pages->applyLimit($criteria);
		    $ourstory=Content::model()->findAll($criteria);
			$this->render('_story',array(
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
            	'ourstory'=>$ourstory));
		}
	}

	public function actionTtway()
	{
		if(isset($_GET['id'])){
			$slide = Content::model()->findAllByAttributes(array('slide'=>'Y'));

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
                    $this->redirect(array('content/index'));
                }
            }

			$id = $_GET['id'];
			$isLogin= Yii::app()->user->id;
			$sub = Subkategori::model()->findByAttributes(array('idsubkategori'=>$id));
			$kategori = Kategori::model()->findByAttributes(array('idkategori'=>$sub->idkategori));

			if(isset($isLogin)){
		    $sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent ASC";
			}else{
			$sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 AND t.statusinternal=1 GROUP BY t.idcontent ORDER BY t.idcontent ASC";
				
			}
			// $sql = "SELECT t.*, d.created_by, d.created_date,
			// 		d.updated_by, d.updated_date, m.filename, m.idstatus AS stts_lampiran, m.created_by AS owner_lampiran,
			// 		m.create_date AS tglbuat_lampiran, m.updated_by AS update_lampiran, m.updated_date AS tglupdate_lampiran
			// 		FROM content t
			// 		INNER JOIN lampiran m ON t.idcontent = m.idcontent
			// 		INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
			// 		b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
			// 		  ON (t.idcontent = d.idcontent)
			// 		WHERE t.idcontent =:id ORDER BY t.idcontent DESC";

			$commands = Yii::app()->db->createCommand($sql);
		    $commands->bindParam(':id', $id, PDO::PARAM_INT);
		    $ourculture = $commands->queryAll();

		    $cek = Testimoni::model()->findByAttributes(array('nik_user'=>Yii::app()->user->id));
		    $allow = count($cek)>0 ? false : true;

		    $model = new Testimoni;
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
				$model->nik_user=Yii::app()->user->id;
				$model->stts_testimoni=0;
				$model->stts_notif=0;
				$model->save();
				$this->refresh();
			}

			$crit=new CDbCriteria();
			if(Yii::app()->user->isGuest){
				$crit->condition='stts_testimoni=1';
			}
			$crit->order='created_date DESC';
			$testimoni=Testimoni::model()->findAll($crit);

			$this->render('_ttway',array(
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'ourculture'=>$ourculture,
				'model'=>$model,
				'testimoni'=>$testimoni,
				'allow'=>$allow
				));
		}
	}

	public function actionSubactivation()
	{
		if(isset($_GET['id'])){
			$slide = Content::model()->findAllByAttributes(array('slide'=>'Y', 'idstatus'=>1));

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
                    $this->redirect(array('content/index'));
                }
            }

			$id = $_GET['id'];
			$isLogin= Yii::app()->user->id;
			$sub = Subkategori::model()->findByAttributes(array('idsubkategori'=>$id));
			$kategori = Kategori::model()->findByAttributes(array('idkategori'=>$sub->idkategori));

			if(isset($isLogin)){
		    $sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
			}else{
			$sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 AND t.statusinternal=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
				
			}
			// 	$sql = "SELECT t.*, d.created_by, d.created_date,
			// 			d.updated_by, d.updated_date
			// 			FROM content t
			// 			INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
			// 			a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
			// 		  	ON (t.idcontent = d.idcontent) WHERE t.idsubkategori =:id AND t.idstatus=1 AND statusinternal='N' GROUP BY t.idcontent ORDER BY t.idcontent DESC";
			// }
			// $sql = "SELECT t.*, d.created_by, d.created_date,
			// 		d.updated_by, d.updated_date, m.filename, m.idstatus AS stts_lampiran, m.created_by AS owner_lampiran,
			// 		m.create_date AS tglbuat_lampiran, m.updated_by AS update_lampiran, m.updated_date AS tglupdate_lampiran
			// 		FROM content t
			// 		INNER JOIN lampiran m ON t.idcontent = m.idcontent
			// 		INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
			// 		b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
			// 		  ON (t.idcontent = d.idcontent)
			// 		WHERE t.idcontent =:id ORDER BY t.idcontent DESC";

			$commands = Yii::app()->db->createCommand($sql);
		    $commands->bindParam(':id', $id, PDO::PARAM_INT);
		    $artact = $commands->queryAll();
		    $modelart = new CArrayDataProvider($artact);

		    if(isset($isLogin)){
		        $sql = "SELECT t.*, d.created_by, d.created_date,
		          d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
		          FROM content t
		          INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
		          a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
		            ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =5 AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
		      }else{
		      $sql = "SELECT t.*, d.created_by, d.created_date,
		          d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
		          FROM content t
		          INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
		          a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
		            ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =5 AND t.statusinternal=1 AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
		      }
		      
		    $commands = Yii::app()->db->createCommand($sql);
		    $leadertalk = $commands->queryAll();

		    $judultalk = Subkategori::model()->findByAttributes(array('idsubkategori'=>5));

		    if(isset($isLogin)){
		        $sql = "SELECT t.*, d.created_by, d.created_date,
		          d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
		          FROM content t
		          INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
		          a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
		            ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =20 AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
		      }else{
		      $sql = "SELECT t.*, d.created_by, d.created_date,
		          d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
		          FROM content t
		          INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
		          a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
		            ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =20 AND t.idstatus=1 AND t.statusinternal=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
		      }
		      
		    $commands = Yii::app()->db->createCommand($sql);
		    $testimoni = $commands->queryAll();
		    //var_dump($testimoni);exit;
		    if($_GET['id']==5){
		    	$this->render('/site/_leadertalk',array(
				'leadertalk'=>$leadertalk,
				'judultalk'=>$judultalk,
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'artact'=>$artact,
				'modelart'=>$modelart));
		    }elseif($_GET['id']==20){
		    	$this->render('/site/_testimoni3',array(
				'testimoni'=>$testimoni,
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'artact'=>$artact,
				'modelart'=>$modelart));
		    }else{
		    	$this->render('_subActivation',array(
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'artact'=>$artact,
				'modelart'=>$modelart));	
		    }			
		}
	}

	public function actionKnowledge()
	{
		if(isset($_GET['id'])){
			$slide = Content::model()->findAllByAttributes(array('slide'=>'Y'));

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
                    $this->redirect(array('content/index'));
                }
            }

			$id = $_GET['id'];
			$isLogin= Yii::app()->user->id;
			$sub = Subkategori::model()->findByAttributes(array('idsubkategori'=>$id));
			$kategori = Kategori::model()->findByAttributes(array('idkategori'=>$sub->idkategori));

		    if(isset($isLogin)){
		    $sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
			}else{
			$sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 AND t.statusinternal=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
				
			}
			// $sql = "SELECT t.*, d.created_by, d.created_date,
			// 		d.updated_by, d.updated_date, m.filename, m.idstatus AS stts_lampiran, m.created_by AS owner_lampiran,
			// 		m.create_date AS tglbuat_lampiran, m.updated_by AS update_lampiran, m.updated_date AS tglupdate_lampiran
			// 		FROM content t
			// 		INNER JOIN lampiran m ON t.idcontent = m.idcontent
			// 		INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
			// 		b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
			// 		  ON (t.idcontent = d.idcontent)
			// 		WHERE t.idcontent =:id ORDER BY t.idcontent DESC";

			$commands = Yii::app()->db->createCommand($sql);
		    $commands->bindParam(':id', $id, PDO::PARAM_INT);
		    $know = $commands->queryAll();
			$this->render('_knowledge',array(
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'know'=>$know));
		}
	}

	public function actionDetailgbr()
	{
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN p_status p ON t.idstatus = p.idstatus
					INNER JOIN (SELECT x.idsubkategori, x.nama AS namasub, y.idkategori, y.nama AS namakat FROM subkategori x INNER JOIN kategori y 
					ON x.idkategori = y.idkategori) z ON z.idsubkategori = t.idsubkategori
					INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
					b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK
					WHERE t.idcontent =:id AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";

			$commands = Yii::app()->db->createCommand($sql);
		    $commands->bindParam(':id', $id, PDO::PARAM_INT);
		    $knowgbr = $commands->queryAll();
		    $this->renderPartial('_knowgbr', array(
		        'knowgbr' => $knowgbr,
		    ));
		}
	}

	public function actionExpert()
	{
		if(isset($_GET['id'])){
			$slide = Content::model()->findAllByAttributes(array('slide'=>'Y'));

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
                    $this->redirect(array('content/index'));
                }
            }

			$id = $_GET['id'];
			$isLogin= Yii::app()->user->id;
			$sub = Subkategori::model()->findByAttributes(array('idsubkategori'=>$id));
			$kategori = Kategori::model()->findByAttributes(array('idkategori'=>$sub->idkategori));

		    if(isset($isLogin)){
		    $sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
			}else{
			$sql = "SELECT t.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idsubkategori =:id AND t.idstatus=1 AND t.statusinternal=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";
				
			}
			// $sql = "SELECT t.*, d.created_by, d.created_date,
			// 		d.updated_by, d.updated_date, m.filename, m.idstatus AS stts_lampiran, m.created_by AS owner_lampiran,
			// 		m.create_date AS tglbuat_lampiran, m.updated_by AS update_lampiran, m.updated_date AS tglupdate_lampiran
			// 		FROM content t
			// 		INNER JOIN lampiran m ON t.idcontent = m.idcontent
			// 		INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
			// 		b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
			// 		  ON (t.idcontent = d.idcontent)
			// 		WHERE t.idcontent =:id ORDER BY t.idcontent DESC";

			$commands = Yii::app()->db->createCommand($sql);
		    $commands->bindParam(':id', $id, PDO::PARAM_INT);
		    $expertsub = $commands->queryAll();
			$this->render('_expertSub',array(
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'expertsub'=>$expertsub));
		}
	}

	public function actionDetailexp()
	{
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
					FROM content t
					INNER JOIN p_status p ON t.idstatus = p.idstatus
					INNER JOIN (SELECT x.idsubkategori, x.nama AS namasub, y.idkategori, y.nama AS namakat FROM subkategori x INNER JOIN kategori y 
					ON x.idkategori = y.idkategori) z ON z.idsubkategori = t.idsubkategori
					INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
					b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK
					WHERE t.idcontent =:id AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";

			$commands = Yii::app()->db->createCommand($sql);
		    $commands->bindParam(':id', $id, PDO::PARAM_INT);
		    $expgbr = $commands->queryAll();
		    $this->renderPartial('_expgbr', array(
		        'expgbr' => $expgbr,
		    ));
		}
	}

	public function actionDetailexpsess()
	{
		$sql = "SELECT t.*, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
				d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
				FROM content t
				INNER JOIN (SELECT x.idsubkategori, x.nama AS namasub, y.idkategori, y.nama AS namakat FROM subkategori x INNER JOIN kategori y 
				ON x.idkategori = y.idkategori) z ON z.idsubkategori = t.idsubkategori
				INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
				b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log) b) d
				  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK
				WHERE t.idsubkategori=7 AND t.idstatus=1 ORDER BY t.idcontent DESC LIMIT 1";

		$commands = Yii::app()->db->createCommand($sql);
	    $expgbr = $commands->queryAll();
	    $this->renderPartial('_expgbr', array(
	        'expgbr' => $expgbr,
	    ));
	}

	public function actionDetailknowsess()
	{
		$sql = "SELECT t.*, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
				d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI
				FROM content t
				INNER JOIN (SELECT x.idsubkategori, x.nama AS namasub, y.idkategori, y.nama AS namakat FROM subkategori x INNER JOIN kategori y 
				ON x.idkategori = y.idkategori) z ON z.idsubkategori = t.idsubkategori
				INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
				b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log) b) d
				  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK
				WHERE t.idsubkategori=6 AND t.idstatus=1 ORDER BY t.idcontent DESC LIMIT 1";

		$commands = Yii::app()->db->createCommand($sql);
	    $knowgbr = $commands->queryAll();
	    $this->renderPartial('_knowgbr', array(
	        'knowgbr' => $knowgbr,
	    ));
	}
	public function actionDisplayVideoTestimoni()
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
	public function actionPlayVideoTestimoni(){
		if(isset($_POST['id'])){
			$model = Testimoni::model()->findByAttributes(array('id_testimoni'=>$_POST['id']));
			$this->renderPartial('_contentmodalbody', array(
	        	'model' => $model,
	    	));
		}
	}

	public function actionExpression(){
		$galleri = Content::model()->findAll(array('condition'=>'idstatus=1 AND statusinternal=1 AND gambar IS NOT NULL','limit'=>15,'order'=>'idcontent DESC'));
    	$isigalleri = Kategori::model()->findByAttributes(array('idkategori'=>4));

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

    	$this->render('/site/_gallery', array(
	        'galleri' => $galleri,
	        'isigalleri' => $isigalleri,
	    ));
	}
	
	public function actionSubdashboard()
	{		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			$sub = Subkategori::model()->findByAttributes(array('idsubkategori'=>$id));
			$kategori = Kategori::model()->findByAttributes(array('idkategori'=>$sub->idkategori));
			
			$type=0;
			if($id==35){   ///divisi/center
				$type=1;
			}elseif($id==36){   ///direktorat
				$type=2;
			}elseif($id==37){   ///witel
				$type=3;
			}
			$sql="SELECT SUM(a.nilai) as nilai, d.nama_unit FROM ratingparam a, rating b, roleunit c, unit d
				WHERE a.idratingparam=b.idratingparam AND b.nik=c.nik AND c.id_unit=d.id_unit and d.type=".$type."
				GROUP BY d.nama_unit ORDER BY SUM(a.nilai) DESC";
			
			
			$commands = Yii::app()->db->createCommand($sql);
		    $subdashboard = $commands->queryAll();
		    
			$this->render('_subDashboard',array(
				'kategori'=>$kategori,
				'sub'=>$sub,
				'subdashboard'=>$subdashboard));	
				
		   // var_dump($dashboard);exit;
		   /*
		    if($_GET['id']==5){
		    	$this->render('/site/_leadertalk',array(
				'leadertalk'=>$leadertalk,
				'judultalk'=>$judultalk,
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'artact'=>$artact));
		    }elseif($_GET['id']==20){
		    	$this->render('/site/_testimoni3',array(
				'testimoni'=>$testimoni,
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'artact'=>$artact));
		    }else{
		    	$this->render('_subActivation',array(
				'kategori'=>$kategori,
				'sub'=>$sub,
				'login'=>$login,
            	'slide'=>$slide, 
				'artact'=>$artact));	
		    }
			*/
			
		}
	}
}