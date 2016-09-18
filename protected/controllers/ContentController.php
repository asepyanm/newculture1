<?php

class ContentController extends PortalController
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

	public function actions(){
	    return array(
            'toggle'=>'ext.jtogglecolumn.ToggleAction',
            // 'switch'=>'ext.jtogglecolumn.SwitchAction', // only if you need it
            'qtoggle'=>'ext.jtogglecolumn.QtoggleAction', // only if you need it
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
				'actions'=>array('displayImage','displayVideo','displayFile'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('toggle','switch','qtoggle','index','view','create','update','deleteImage','deleteVideo','deleted','indexdelete','indexdraft','deletes','deleter','restore','publish','changeSub','createmessage'),
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
		$isLogin = Yii::app()->user->id;
        if ($isLogin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
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
	  	$model = $commands->queryAll();
	  	$mod = Content::model()->findByPk($id);
		$lampiran = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
		$this->render('view',array(
			'model'=>$model,
			'lampiran'=>$lampiran,
			'mod'=>$mod,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionChangeSub()
	{
		$userid = Yii::app()->user->id;
		$isAdmin = Yii::app()->user->itemname;
		if(isset($_POST)){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
			}else{
				$id = $_POST['Content']['idsubkategori'];
			}
		}
		$boole = Booleancontent::model()->findByAttributes(array('idsubkategori'=>$id));
		
		$lamp = null;
		$model = new Content;
		
		$model->slide = 'N';
		$model->link = 'N';
		$path = str_replace('protected', '', Yii::app()->basePath);
		$path = $path . 'upload';
		if (!is_dir($path)) {
		    mkdir($path);
		}

		$user = null;
		if($boole->judul==1 && $boole->label_judul=='NIK'){
			$user=new User('search');
			$user->unsetAttributes();  // clear any default values
			if (isset($_GET['User'])) {
				$user->attributes=$_GET['User'];
			}
		}

		if (isset($_POST['Content'])) {
			$model->attributes=$_POST['Content'];
			if($_POST['tombol']=='draft'){
				$model->idstatus=2;
			}else if($_POST['tombol']=='simpan'){
				$model->idstatus=1;
				if($isAdmin=='adminhr'){
					$model->statusinternal='1';
				}
				else if($isAdmin=='adminunit'){
					$model->statusinternal='0';
				}
			}
			// if (@!empty($_FILES['Content']['name']['gambar'])) {
	  //           $model->gambar = $_POST['Content']['gambar'];
	  //           if ($model->validate(array('gambar'))) {
	  //               $model->gambar = CUploadedFile::getInstance($model, 'gambar');
	            
		 //            $model->gambar->saveAs($path . '/' . date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->gambar)));
	  //       		$model->gambar = date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->gambar));
	  //       	}
	  //       }

	  //       if (@!empty($_FILES['Content']['name']['video'])) {
	  //           $model->video = $_POST['Content']['video'];
	  //           if ($model->validate(array('video'))) {
	  //               $model->video = CUploadedFile::getInstance($model, 'video');
	 
		 //            $model->video->saveAs($path . '/' . date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->video)));
		 //        	$model->video = date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->video));
		 //        }
	  //       }
			if (@!empty($_FILES['Content']['name']['gambar'])){
                $gambar = CUploadedFile::getInstance($model, 'gambar');
                $model->gambar_size = $gambar->size;
                $model->gambar_type = $gambar->type;
                $model->gambar_name = $gambar->name;
                $model->gambar = file_get_contents($gambar->tempName);            
			}
            if (@!empty($_FILES['Content']['name']['video'])){
                $video = CUploadedFile::getInstance($model, 'video');
                $model->video_size = $video->size;
                $model->video_type = $video->type;
                $model->video_name = $video->name;
                $model->video = file_get_contents($video->tempName);
			}

			if ($model->save()) {
				$history = new HistoryLog;
				$history->id_auth_assignment=$userid;
				$history->created_by=$userid;
				$history->created_date=date('Y-m-d H:i:s');
				$history->updated_by=$userid;
				$history->updated_date=date('Y-m-d H:i:s');
				$history->idcontent=$model->idcontent;
				$history->save();
                
				$xi=0;
        if($_POST['tombol']=='simpan'){
            if(!empty($_POST['Content']['isi']) && $model->idstatus==1){   ///artikel
              if($id==5){  ///leader talk value
                $idratingparam=2;
              }elseif($id==3){  ///culture strory
                $idratingparam=4;
              }elseif($id==4){  ///Culture Inspiring Legend
                $idratingparam=6;
              }elseif($id==9){  ///employee testimonial
                
              }
              if(!empty($idratingparam)){
                $rating = new Rating;
                $rating->idratingparam = $idratingparam;
                $rating->idcontent = $model->idcontent;
                $rating->nik = $userid;
                $rating->created_date = date('Y-m-d H:i:s');
                $rating->save();
                ++$xi;
              }
            }
            
            				///foto
          if (@!empty($_FILES['Content']['name']['gambar'])){
            if($id==5){  ///leader talk value
                
            }elseif($id==3){  ///culture strory
              $idratingparam=5;
            }elseif($id==4){  ///Culture Inspiring Legend
              $idratingparam=7;
            }elseif($id==20){  ///employee testimonial
              
            }
            if(!empty($idratingparam) && $model->idstatus==1){
              $rating = new Rating;
              $rating->idratingparam = $idratingparam;
              $rating->idcontent = $model->idcontent;
              $rating->nik = $userid;
              $rating->created_date = date('Y-m-d H:i:s');
              $rating->save();
              ++$xi;
            }				
          }
          
          				///video
          if (@!empty($_FILES['Content']['name']['video'])){
            if($id==5){  ///leader talk value
              $idratingparam=1;
            }elseif($id==3){  ///culture strory
              $idratingparam=3;
            }elseif($id==4){  ///Culture Inspiring Legend
              
            }elseif($id==20){  ///employee testimonial
              $idratingparam=8;
            }
            if(!empty($idratingparam) && $model->idstatus==1){
              $rating = new Rating;
              $rating->idratingparam = $idratingparam;
              $rating->idcontent = $model->idcontent;
              $rating->nik = $userid;
              $rating->created_date = date('Y-m-d H:i:s');
              $rating->save();
              ++$xi;
            }
          }
				}

			
				
				if($xi>0){
					if((int)date('d')<7){
							$rating2 = new Rating;
							$rating2->idratingparam = 10;
							$rating2->idcontent = $model->idcontent;
							$rating2->nik = $userid;
							$rating2->created_date = date('Y-m-d H:i:s');
							$rating2->save();
						}elseif((int)date('d')==7){
							$rating2 = new Rating;
							$rating2->idratingparam = 11;
							$rating2->idcontent = $model->idcontent;
							$rating2->nik = $userid;
							$rating2->created_date = date('Y-m-d H:i:s');
							$rating2->save();
						}else{
							$rating2 = new Rating;
							$rating2->idratingparam = 12;
							$rating2->idcontent = $model->idcontent;
							$rating2->nik = $userid;
							$rating2->created_date = date('Y-m-d H:i:s');
							$rating2->save();
					}
				}
				// if (isset($_FILES['lampiran']['name'])){
    //                 $lampiranArr = CUploadedFile::getInstancesByName('lampiran');
    //                 if (isset($lampiranArr) && count($lampiranArr) > 0)
    //                 {
    //                     foreach ($lampiranArr as $lampiran => $file)
    //                     {
    //                     	$lampiranArr[$lampiran]->saveAs($path . '/' . date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($file->name)), $file->tempName);
    //                     	$lamp = new Lampiran;
    //                     	$lamp->idcontent = $model->idcontent;
    //                     	$lamp->filetype = $file->type;
    //                     	$lamp->filesize = $file->size;
    //                     	$lamp->created_by = $userid;
    //                         $lamp->create_date = date('Y-m-d H:i:s');
    //                         $lamp->updated_by = $userid;
    //                         $lamp->updated_date = date('Y-m-d H:i:s');
    //                         $lamp->idstatus = 1;
    //                         $lamp->filename = date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($file->name));
    //                         $lamp->save();
    //                     }
    //                 }
				// }
				if (isset($_FILES['lampiran']['name'])){
                    $lampiranArr = CUploadedFile::getInstancesByName('lampiran');
                    if (isset($lampiranArr) && count($lampiranArr) > 0)
                    {
                        foreach ($lampiranArr as $lampiran => $file)
                        {
                            $lamp = new Lampiran;
                            $lamp->idcontent = $model->idcontent;
                            $lamp->filename = $file->name;
                            $lamp->filetype = $file->type;
                            $lamp->filesize = $file->size;
                            $lamp->file = file_get_contents($file->tempName);
                            $lamp->created_by = $userid;
                            $lamp->create_date = date('Y-m-d H:i:s');
                            $lamp->updated_by = $userid;
                            $lamp->updated_date = date('Y-m-d H:i:s');
                            $lamp->idstatus = 1;
                            $lamp->save();
                        }
                    }
                }
				if($_POST['tombol']=='draft'){
					$this->redirect(array('indexdraft'));
				}
				else{
					$this->redirect(array('index'));
				}
			}

		}

		$this->renderPartial('_form',array(
			'model'=>$model,
			'lampiran'=>$lamp,
			'boole'=>$boole,
			'user'=>$user,
		));
	}

	public function actionCreate()
	{
		$userid = Yii::app()->user->id;
		$isAdmin = Yii::app()->user->itemname;
		$divisi = null;
        if($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
        else if($isAdmin=='adminhr'){
        	$subs = Subkategori::model()->findAll();
        }
        else if($isAdmin=='adminunit'){
        	$crit = new CDbCriteria;
			$crit->condition = 'idsubkategori<>1';
			$crit->condition .= ' AND idsubkategori<>2';
        	$subs = Subkategori::model()->findAll($crit);
        	$divisi = User::model()->findByAttributes(array('N_NIK'=>Yii::app()->user->id))->C_KODE_DIVISI;
        }

        $user=new User('search');
			$user->unsetAttributes();  // clear any default values
			if (isset($_GET['User'])) {
				$user->attributes=$_GET['User'];
			}
		// var_dump($divisi);exit;
        $this->render('create',array(
			'subs'=>$subs,
			'user'=>$user,
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
		$boole = Booleancontent::model()->findByAttributes(array('idsubkategori'=>$model->idsubkategori));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
    
		$userid = Yii::app()->user->id;
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		$lamp = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id, 'idstatus'=>1));
		// $path = Yii::app()->basePath . '/../upload';
		$path = str_replace('protected', '', Yii::app()->basePath);
		$path = $path . 'upload';
		if (!is_dir($path)) {
		    mkdir($path);
		    // chmod($path, 0777);
		}
    $idsub=$_POST['idsub'];
		$gbr = Content::model()->findByAttributes(array('idcontent'=>$id));
		
		if (isset($_POST['Content'])) {
			$model->attributes=$_POST['Content'];
			if($_POST['tombol']=='draft'){
				$model->idstatus=2;
			}else if($_POST['tombol']=='simpan'){
				$model->idstatus=1;
				if($isAdmin=='adminhr'){
					$model->statusinternal='1';
				}
				else if($isAdmin=='adminunit'){
					$model->statusinternal='0';
				}
			}
			// if (@!empty($_FILES['Content']['name']['gambar'])) {
	  //           $model->gambar = $_POST['Content']['gambar'];
	  //           if ($model->validate(array('gambar'))) {
	  //               $model->gambar = CUploadedFile::getInstance($model, 'gambar');
	            
		 //            $model->gambar->saveAs($path . '/' . date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->gambar)));
		 
		 //            // $model->gambar = $model->gambar->getName();
	  //           // $model->gambar = $model->gambar->getSize();
	  //       		$model->gambar = date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->gambar));
	  //       	}
	  //       }else{
	  //       	$model->gambar = $gbr->gambar;
	  //       }

	  //       if (@!empty($_FILES['Content']['name']['video'])) {
	  //           $model->video = $_POST['Content']['video'];
	  //           if ($model->validate(array('video'))) {
	  //               $model->video = CUploadedFile::getInstance($model, 'video');
	 
		 //            $model->video->saveAs($path . '/' . date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->video)));
		 
		 //            // $model->video = $model->video->getName();
	  //           // $model->gambar = $model->gambar->getSize();
		 //        	$model->video = date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($model->video));
		 //        }
	  //       }else{
	  //       	$model->video = $gbr->video;
	  //       }
			if (@!empty($_FILES['Content']['name']['gambar'])){
                $gambar = CUploadedFile::getInstance($model, 'gambar');
                $model->gambar_size = $gambar->size;
                $model->gambar_type = $gambar->type;
                $model->gambar_name = $gambar->name;
                $model->gambar = file_get_contents($gambar->tempName);
            }else{
	        	$model->gambar = $gbr->gambar;
	        }
            if (@!empty($_FILES['Content']['name']['video'])){
                $video = CUploadedFile::getInstance($model, 'video');
                $model->video_size = $video->size;
                $model->video_type = $video->type;
                $model->video_name = $video->name;
                $model->video = file_get_contents($video->tempName);
            }else{
	        	$model->video = $gbr->video;
	        }

			if ($model->save()) {
				$xi=0;
        
				if($_POST['tombol']=='simpan'){
          if(!empty($_POST['Content']['isi']) && $model->idstatus==1){   ///artikel
            if($idsub==5){  ///leader talk value
              $idratingparam=2;
            }elseif($idsub==3){  ///culture strory
              $idratingparam=4;
            }elseif($idsub==4){  ///Culture Inspiring Legend
              $idratingparam=6;
            }elseif($idsub==9){  ///employee testimonial
              
            }
          
          if(isset($idratingparam)){
            $sq="select idrating from rating where idratingparam=".$idratingparam." AND idcontent=".$id." LIMIT 1";
            $cc = Yii::app()->db->createCommand($sq);
            $is_exist = $cc->queryAll();
                      
            if(empty($is_exist[0]['idrating'])){    
              if(!empty($idratingparam)){
                  $rating = new Rating;
                  $rating->idratingparam = $idratingparam;
                  $rating->idcontent = $model->idcontent;
                  $rating->nik = $userid;
                  $rating->created_date = date('Y-m-d H:i:s');
                  $rating->save();
                  ++$xi;
                }
              }
            }
          }
				 ////die('here3');
          ///foto
          if (@!empty($_FILES['Content']['name']['gambar'])){
            if($idsub==5){  ///leader talk value
                
            }elseif($idsub==3){  ///culture strory
              $idratingparam=5;
            }elseif($idsub==4){  ///Culture Inspiring Legend
              $idratingparam=7;
            }elseif($idsub==20){  ///employee testimonial
              
            }
            
            if(isset($idratingparam)){
              $sq2="select idrating from rating where idratingparam=".$idratingparam." AND idcontent=".$id." LIMIT 1";
              $cc2 = Yii::app()->db->createCommand($sq2);
              $is_exist2 = $cc2->queryAll();
              
              if(empty($is_exist2[0]['idrating'])){ 
                if(!empty($idratingparam) && $model->idstatus==1){
                  $rating = new Rating;
                  $rating->idratingparam = $idratingparam;
                  $rating->idcontent = $model->idcontent;
                  $rating->nik = $userid;
                  $rating->created_date = date('Y-m-d H:i:s');
                  $rating->save();
                  ++$xi;
                }				
              }
            }
          }
				
          ///video
          if (@!empty($_FILES['Content']['name']['video'])){
            if($idsub==5){  ///leader talk value
              $idratingparam=1;
            }elseif($idsub==3){  ///culture strory
              $idratingparam=3;
            }elseif($idsub==4){  ///Culture Inspiring Legend
              
            }elseif($idsub==20){  ///employee testimonial
              $idratingparam=8;
            }
            
            if(isset($idratingparam)){
              $sq3="select idrating from rating where idratingparam=".$idratingparam." AND idcontent=".$id." LIMIT 1";
              $cc3 = Yii::app()->db->createCommand($sq3);
              $is_exist3 = $cc3->queryAll();
              
              if(empty($is_exist3[0]['idrating'])){ 
                if(!empty($idratingparam) && $model->idstatus==1){
                  $rating = new Rating;
                  $rating->idratingparam = $idratingparam;
                  $rating->idcontent = $model->idcontent;
                  $rating->nik = $userid;
                  $rating->created_date = date('Y-m-d H:i:s');
                  $rating->save();
                  ++$xi;
                }
              }
            }
          }
				}
        
				if($xi>0){
					if((int)date('d')<7){
              $sq3="select idrating from rating where idratingparam=10 AND idcontent=".$id." LIMIT 1";
              $cc3 = Yii::app()->db->createCommand($sq3);
              $is_exist3 = $cc3->queryAll();
							if(empty($is_exist3[0]['idrating'])){   
                $rating2 = new Rating;
                $rating2->idratingparam = 10;
                $rating2->idcontent = $model->idcontent;
                $rating2->nik = $userid;
                $rating2->created_date = date('Y-m-d H:i:s');
                $rating2->save();
              }
            }elseif((int)date('d')==7){
              $sq3="select idrating from rating where idratingparam=11 AND idcontent=".$id." LIMIT 1";
              $cc3 = Yii::app()->db->createCommand($sq3);
              $is_exist3 = $cc3->queryAll();
              if(empty($is_exist3[0]['idrating'])){   
                $rating2 = new Rating;
                $rating2->idratingparam = 11;
                $rating2->idcontent = $model->idcontent;
                $rating2->nik = $userid;
                $rating2->created_date = date('Y-m-d H:i:s');
                $rating2->save();
              }
						}else{
              $sq3="select idrating from rating where idratingparam=12 AND idcontent=".$id." LIMIT 1";
              $cc3 = Yii::app()->db->createCommand($sq3);
              $is_exist3 = $cc3->queryAll();
              
              if(empty($is_exist3[0]['idrating'])){   
                $rating2 = new Rating;
                $rating2->idratingparam = 12;
                $rating2->idcontent = $model->idcontent;
                $rating2->nik = $userid;
                $rating2->created_date = date('Y-m-d H:i:s');
                $rating2->save();
              }
					}
				}
				// if (isset($_FILES['lampiran']['name'])){
    //         		$lampiranArr = CUploadedFile::getInstancesByName('lampiran');
    //         		$existid = isset($_POST['lampiran_exist_id'])?$_POST['lampiran_exist_id']:null;
    //         		//var_dump($existid[0]);exit;
    //         		if(count($existid)>0){
				// 		if (isset($lampiranArr) && count($lampiranArr) > 0){
	   //          			$jml=0;
	   //          			foreach ($lampiranArr as $lampiran => $file)
	   //                      {
	   //                      	$lampiranArr[$lampiran]->saveAs($path . '/' . date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($file->name)), $file->tempName);
	   //                      	// $lampiranArr->saveAs($path . '/' . $file->tempName);
	   //                      	$lamp = Lampiran::model()->findByPk($existid[$jml]);
	   //                      	$lamp->idcontent = $model->idcontent;
	   //                      	$lamp->filetype = $file->type;
	   //                      	$lamp->filesize = $file->size;
	   //                      	$lamp->updated_by = $userid;
	   //                          $lamp->updated_date = date('Y-m-d H:i:s');
	   //                          $lamp->idstatus = 1;
	   //                          $lamp->filename = date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($file->name));
	   //                          $lamp->save();
	   //                      }
				// 		}
    //         		}else{
    //         			foreach ($lampiranArr as $lampiran => $file)
				// 		{
				// 			$lampiranArr[$lampiran]->saveAs($path . '/' . date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($file->name)), $file->tempName);
	                        
		  //                   $lamp = new Lampiran;
		  //                   $lamp->idcontent = $model->idcontent;
		  //                   $lamp->filetype = $file->type;
		  //                   $lamp->filesize = $file->size;
		  //                   $lamp->created_by = $userid;
	   //                      $lamp->create_date = date('Y-m-d H:i:s');
	   //                      $lamp->updated_by = $userid;
	   //                      $lamp->updated_date = date('Y-m-d H:i:s');
	   //                      $lamp->idstatus = 1;
	   //                      $lamp->filename = date('Y-m-d-H-i-s') . '_' . str_replace(' ', '_', strtolower($file->name));
	   //                      $lamp->save();
				// 		}
    //         		}
				// } 
				if (isset($_FILES['lampiran']['name'])){
            		$lampiranArr = CUploadedFile::getInstancesByName('lampiran');
            		$existid = isset($_POST['lampiran_exist_id'])?$_POST['lampiran_exist_id']:null;
            		//var_dump($existid[0]);exit;
            		if(count($existid)>0){
						if (isset($lampiranArr) && count($lampiranArr) > 0){
	            			$jml=0;
	            			foreach ($lampiranArr as $lampiran => $file)
							{
								$lamp = Lampiran::model()->findByPk($existid[$jml]);
								$lamp->idcontent = $model->idcontent;
								$lamp->filename = $file->name;
								$lamp->filetype = $file->type;
								$lamp->filesize = $file->size;
								$lamp->file = file_get_contents($file->tempName);
		                        $lamp->updated_by = $userid;
		                        $lamp->updated_date = date('Y-m-d H:i:s');
								$lamp->idstatus = 1;
								$lamp->save();
								$jml++;
							}
						}
            		}else{
            			foreach ($lampiranArr as $lampiran => $file)
						{
							$lamp = new Lampiran;
							$lamp->idcontent = $model->idcontent;
							$lamp->filename = $file->name;
							$lamp->filetype = $file->type;
							$lamp->filesize = $file->size;
							$lamp->file = file_get_contents($file->tempName);
							$lamp->created_by = $userid;
	                        $lamp->create_date = date('Y-m-d H:i:s');
	                        $lamp->updated_by = $userid;
	                        $lamp->updated_date = date('Y-m-d H:i:s');
							$lamp->idstatus = 1;
							$lamp->save();
						}
            		}
				}
				$critx = new CDbCriteria;
				$critx->select = 't.created_by, t.created_date';
				$critx->join = 'INNER JOIN user e ON t.updated_by=e.N_NIK';
				$critx->condition = 'idcontent=:idx';
		        $critx->params = array(':idx' => $id);
		        $critx->order = 't.updated_date DESC';
		        $critx->limit = 1;
		        $cekHistory = HistoryLog::model()->find($critx);
				if(isset($cekHistory)){
					$history = new HistoryLog;
					$history->id_auth_assignment=$userid;
					$history->created_by=$cekHistory->created_by;
					$history->created_date=$cekHistory->created_date;
					$history->updated_by=$userid;
					$history->updated_date=date('Y-m-d H:i:s');
					$history->idcontent=$id;
					$history->save();
					
				}
				$this->redirect(array('index'));
			}
		}

		$user=new User('search');
			$user->unsetAttributes();  // clear any default values
			if (isset($_GET['User'])) {
				$user->attributes=$_GET['User'];
			}
      
		$this->render('update',array(
			'model'=>$model,
			'lampiran'=>$lamp,
			'boole'=>$boole,
			'user'=>$user
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeletes()
	{
		$userid = Yii::app()->user->id;
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		// if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
        // var_dump($_POST['Content']);exit;
        if(isset($_POST['Content'])){
			$id=$_POST['ids'];
			//var_dump($id);exit;
			$model=Content::model()->findByPk($id);
			$model->alasan=$_POST['Content']['alasan'];
			$model->rejectoleh=Yii::app()->user->id;
			$model->statusinternal=0;
			$model->idstatus=4;
			if($model->save()){
				$critx = new CDbCriteria;
				$critx->select = 't.created_by, t.created_date';
				$critx->join = 'INNER JOIN user e ON t.updated_by=e.N_NIK';
				$critx->condition = 'idcontent=:idx';
		        $critx->params = array(':idx' => $id);
		        $critx->order = 't.updated_date DESC';
		        $critx->limit = 1;
		        $cekHistory = HistoryLog::model()->find($critx);
		        // var_dump($cekHistory->created_by);var_dump($cekHistory->created_date);exit;
				if(isset($cekHistory)){
					$history = new HistoryLog;
					$history->id_auth_assignment=$cekHistory->created_by;
					$history->created_by=$cekHistory->created_by;
					$history->created_date=$cekHistory->created_date;
					$history->updated_by=$userid;
					$history->updated_date=date('Y-m-d H:i:s');
					$history->idcontent=$id;
					$history->save();
					
				}

				$message = new Message;
				$message->created_by = Yii::app()->user->id;
	        	$message->created_date = date('Y-m-d H:i:s');
	        	$message->status = 0;
	        	$message->idcontent = $id;
	        	$message->isi = 'Konten Di reject dengan alasan : "'.$_POST['Content']['alasan'].'"';
	        	$message->to = $cekHistory->created_by;
	        	$message->save();
        
        $rat=Rating::model()->findAllByAttributes(array('idcontent'=>$id));
        if(!empty($rat)){
          foreach ($rat as $val1) {
            $val1->delete();
          }
        }

			}
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view','id'=>$id));
			}
		}
		// } else {
		// 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		// }
	}

	public function actionDeleted()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		// if (Yii::app()->request->isPostRequest) {
		// 	// we only allow deletion via POST request
			$id=$_GET['id'];
			$model=Content::model()->findByPk($id);
			$history=HistoryLog::model()->findAllByAttributes(array('idcontent'=>$id));
			if(!empty($history)){
				foreach ($history as $value) {
					$value->delete();
				}
			}
			$lamp=Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
			if(!empty($lamp)){
				foreach ($lamp as $val) {
					$val->delete();
				}
			}
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('indexdelete'));
			}
		// } else {
		// 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		// }
	}

	public function actionDeleter()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		// if (Yii::app()->request->isPostRequest) {
		// 	// we only allow deletion via POST request
			$id=$_GET['id'];
			$model=Content::model()->findByPk($id);
			$history=HistoryLog::model()->findAllByAttributes(array('idcontent'=>$id));
			if(!empty($history)){
				foreach ($history as $value) {
					$value->delete();
				}
			}
			$lamp=Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
			if(!empty($lamp)){
				foreach ($Lamp as $val) {
					$val->delete();
				}
			}
      $rat=Rating::model()->findAllByAttributes(array('idcontent'=>$id));
			if(!empty($rat)){
				foreach ($rat as $val1) {
					$val1->delete();
				}
			}
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('indexdraft'));
			}else{
				$this->redirect(array('indexdraft'));
			}
		// } else {
		// 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		// }
	}

	public function actionRestore()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		// if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$id=$_GET['id'];
			$model=Content::model()->findByPk($id);
			// $model->updated_date=date('Y-m-d H:i:s');
			$model->idstatus=1;
			$model->save();
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
	// 	$dataProvider=new CActiveDataProvider('Content');
	// 	$this->render('index',array(
	// 		'dataProvider'=>$dataProvider,
	// 	));
	// }

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		// $crit = new CDbCriteria;
        // $crit->select = 't.itemname, t.nik, a.V_NAMA_KARYAWAN, a.V_SHORT_POSISI';
        // $crit->join = 'join user a on (a.N_NIK=t.nik)';
        // $crit->condition = 't.nik=:nik';
        // $crit->params = array(':nik' => $this->username);
        // $auth = Authassignment::model()->find($crit);

		$criteria=new CDbCriteria;
		$criteria->select = 't.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.C_KODE_DIVISI as divisi';
		$criteria->join = 'INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent)';
		$criteria->join .= ' INNER JOIN user u ON d.created_by=u.N_NIK';
		$criteria->condition = "t.idstatus=1";
		$criteria->order = "u.C_KODE_DIVISI ASC";
        $criteria->group = "u.C_KODE_DIVISI";
        $list_divisi = Content::model()->findAll($criteria);
        $list_unit = Unit::model()->findAll();
        
        //echo "<pre>";
        //print_r($criteria);
        //echo "</pre>";
        
        //var_dump($list_divisi->divisi_create);exit;
        if (isset($_POST['Content'], $_POST['ids'])) {
        	$alas= Content::model()->findByPk($_POST['ids']);
        	// $alas->attributes=$_POST['Content'];
        	$alas->alasan=$_POST['Content']['alasan'];
        	$alas->idstatus=2;
        	$alas->rejectoleh=Yii::app()->user->id;
        	$alas->save;
        }
		$model=new Content('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Content'])) {
			$model->attributes=$_GET['Content'];
		}

		$permit_unit = Roleunit::model()->findByAttributes(array('nik'=>Yii::app()->user->id))->id_unit;
		// var_dump($permit_unit);exit;
		$this->render('index',array(
			'model'=>$model,
			'list_divisi'=>$list_divisi,
			'list_unit'=>$list_unit,
			'permit_unit'=>$permit_unit,
		));
	}

	public function actionIndexdraft()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		$model=new Content('searchDraft');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Content'])) {
			$model->attributes=$_GET['Content'];
		}
		$criteria=new CDbCriteria;
		$criteria->select = 't.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.C_KODE_DIVISI as divisi';
		$criteria->join = 'INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent)';
		$criteria->join .= ' INNER JOIN user u ON d.created_by=u.N_NIK';
		$criteria->condition = "t.idstatus=1";
		$criteria->order = "u.C_KODE_DIVISI ASC";
        $criteria->group = "u.C_KODE_DIVISI";
        $list_divisi = Content::model()->findAll($criteria);
        $list_unit = Unit::model()->findAll();
        $permit_unit = Roleunit::model()->findByAttributes(array('nik'=>Yii::app()->user->id))->id_unit;

        $message =  new Message;
        if(isset($_POST['Message'])){
        	// var_dump($_POST);exit;
        	$message->created_by = Yii::app()->user->id;
        	$message->created_date = date('Y-m-d H:i:s');
        	$message->status = 0;
        	$message->idcontent = $_POST['ids'];
        	$message->isi = $_POST['Message']['isi'];
        	$message->to = Content::model()->findByPk($_POST['ids'])->rejectoleh;
        	if($message->save()){
        		$this->refresh();
        	}
    	}

		$this->render('indexdraft',array(
			'model'=>$model,
			'list_divisi'=>$list_divisi,
			'message'=>$message,
			'list_unit'=>$list_unit,
			'permit_unit'=>$permit_unit,
		));
	}

	public function actionIndexdelete()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		// $crit = new CDbCriteria;
        // $crit->select = 't.itemname, t.nik, a.V_NAMA_KARYAWAN, a.V_SHORT_POSISI';
        // $crit->join = 'join user a on (a.N_NIK=t.nik)';
        // $crit->condition = 't.nik=:nik';
        // $crit->params = array(':nik' => $this->username);
        // $auth = Authassignment::model()->find($crit);
		$model=new Content('searchDelete');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Content'])) {
			$model->attributes=$_GET['Content'];
		}

		$this->render('indexdelete',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Content the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Content::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Content $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='content-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDeleteImage()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$model = Content::model()->findByPk($id);
			$model->gambar=null;
			$model->save();
		}
	}

	public function actionDeleteVideo()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$model = Content::model()->findByPk($id);
			$model->video=null;
			$model->save();
		}
	}

	public function actionSwitch()
	{
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin!='adminhr') {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
        if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$model = Content::model()->findByPk($id);
			if($model->statusinternal == 1){
				$model->statusinternal = 0;
			}
			else if($model->statusinternal == 0){
				$model->statusinternal = 1;
			}
			$model->save();
			$this->redirect(array('view','id'=>$id));
		}
	}

	public function actionPublish()
	{
		$userid = Yii::app()->user->id;
		$isAdmin = Yii::app()->user->itemname;
        if ($isAdmin==null) {
            $this->redirect(Yii::app()->user->returnUrl.'?r=site/index');
        }
		// if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$id=$_GET['id'];
			$model=Content::model()->findByPk($id);
			if($isAdmin=='adminhr'){
				$model->statusinternal=1;
			}
			else if($isAdmin=='adminunit'){
				$model->statusinternal=0;
			}
			$model->idstatus=1;
			if($model->save()){
				$critx = new CDbCriteria;
				$critx->select = 't.created_by, t.created_date';
				$critx->join = 'INNER JOIN user e ON t.updated_by=e.N_NIK';
				$critx->condition = 'idcontent=:idx';
		        $critx->params = array(':idx' => $id);
		        $critx->order = 't.updated_date DESC';
		        $critx->limit = 1;
		        $cekHistory = HistoryLog::model()->find($critx);
				if(isset($cekHistory)){
					$history = new HistoryLog;
					$history->id_auth_assignment=$userid;
					$history->created_by=$cekHistory->created_by;
					$history->created_date=$cekHistory->created_date;
					$history->updated_by=$userid;
					$history->updated_date=date('Y-m-d H:i:s');
					$history->idcontent=$id;
					$history->save();
					
				}
			}
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view','id'=>$id));
			}
		// } else {
		// 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		// }
	}

	public function actionDisplayImage()
	{
		if(isset($_GET['id'])){
			$model = Content::model()->findByAttributes(array('idcontent'=>$_GET['id']));
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

	public function actionDisplayVideo()
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

	public function actionDisplayFile()
	{
		if(isset($_GET['id'])){
			$model = Lampiran::model()->findByAttributes(array('idlampiran'=>$_GET['id']));
			if($model){
				header('Pragma: public');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Content-Transfer-Encoding: binary');
				header('Content-length: '.$model->filesize);
				header('Content-Type: '.$model->filetype);
				header('Content-Disposition: attachment; filename='.$model->filename);
				echo $model->file;
			}else echo "Data tidak ditemukan";
		}
	}

	public function actionCreatemessage()
	{
		if(isset($_POST['Message'])){
        	// var_dump($_POST);exit;
        	$message->created_by = Yii::app()->user->id;
        	$message->created_date = date('Y-m-d H:i:s');
        	$message->status = 0;
        	$message->idcontent = $_POST['ids'];
        	$message->isi = $_POST['Message']['isi'];
        	if($message->save()){
        		$this->redirect(array('indexdraft'));
        	}
    	}
	}
}