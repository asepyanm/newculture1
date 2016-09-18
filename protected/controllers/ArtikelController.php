<?php

class ArtikelController extends Tema3Controller
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
			$id = $_GET['id'];

			$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.V_SHORT_UNIT
					FROM content t
					INNER JOIN p_status p ON t.idstatus = p.idstatus
					INNER JOIN (SELECT x.idsubkategori, x.nama AS namasub, y.idkategori, y.nama AS namakat FROM subkategori x INNER JOIN kategori y 
					ON x.idkategori = y.idkategori) z ON z.idsubkategori = t.idsubkategori
					INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
					b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK
					WHERE t.idcontent =:id AND t.idstatus=1 GROUP BY t.idcontent ORDER BY t.idcontent DESC";

			// $sql = "SELECT t.*, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
			// 		d.updated_by, d.updated_date
			// 		FROM content t
			// 		INNER JOIN (SELECT x.idsubkategori, x.nama AS namasub, y.idkategori, y.nama AS namakat FROM subkategori x INNER JOIN kategori y 
			// 		ON x.idkategori = y.idkategori) z ON z.idsubkategori = t.idsubkategori
			// 		INNER JOIN (SELECT b.idcontent, b.updated_date, b.created_by, b.created_date,
			// 		b.updated_by, b.id_auth_assignment FROM (SELECT * FROM history_log WHERE idcontent =:id) b ORDER BY b.updated_date DESC LIMIT 1) d
			// 		  ON (t.idcontent = d.idcontent)
			// 		WHERE t.idcontent =:id GROUP BY t.idcontent ORDER BY t.idcontent DESC";

			$commands = Yii::app()->db->createCommand($sql);
		    $commands->bindParam(':id', $id, PDO::PARAM_INT);
		    $artstory = $commands->queryAll();

		    $result = array();
		    foreach ($artstory as $value) {
		    	$result['idsubkategori']=$value['idsubkategori'];
		    	$result['idcontent']=$value['idcontent'];
		    }

		    $criteria=new CDbCriteria();
			$criteria->condition='idsubkategori=:idsub';
			$criteria->condition.=' AND idcontent<>:idcon';
			$criteria->condition.=' AND idstatus=1';
			if(Yii::app()->user->isGuest){
				$criteria->condition.=' AND statusinternal=1';
			}
			$criteria->order='idcontent DESC';
			$criteria->params=array(':idsub'=>$result['idsubkategori'], 'idcon'=>$result['idcontent']);

		    $count=Content::model()->count($criteria);
		    $pages=new CPagination($count);
		    $pages->pageSize=5;
		    $pages->applyLimit($criteria);
		    $storyLain=Content::model()->findAll($criteria);

		    $lampiran = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));

		    $komen = new TComment;
		    if (isset($_POST['TComment'])) {
				$komen->attributes=$_POST['TComment'];
				$komen->isi_comment=$_POST['TComment']['isi_comment'];
				$komen->created_date=date('Y-m-d H:i:s');
				$komen->nik_user=Yii::app()->user->id;
				$komen->id_content=$id;
				$komen->stts_comment=0;
				$komen->save();
			}

			// $komentar = TComment::model()->findAllByAttributes(array('id_content'=>$id));
			$critcom=new CDbCriteria();
			$critcom->condition='id_content=:idcom';
			$critcom->order='created_date DESC';
			$critcom->params=array(':idcom'=>$id);
			$komentar=TComment::model()->findAll($critcom);

		    $this->render('_artStory', array(
		        'artstory' => $artstory,
		        'lampiran' => $lampiran,
		        'storyLain' => $storyLain,
		        'komen' => $komen,
		        'komentar' => $komentar,
		        'id'=>$id
		    ));
		}
	}

	public function actionSubactivation()
	{
		if(isset($_GET['id'])){
			$id = $_GET['id'];

			$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.V_SHORT_UNIT
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
		    $art = $commands->queryAll();

		    $result = array();
		    foreach ($art as $value) {
		    	$result['idsubkategori']=$value['idsubkategori'];
		    	$result['idcontent']=$value['idcontent'];
		    }

		    $criteria=new CDbCriteria();
			$criteria->condition='idsubkategori=:idsub';
			$criteria->condition.=' AND idcontent<>:idcon';
			$criteria->condition.=' AND idstatus=1';
			if(Yii::app()->user->isGuest){
				$criteria->condition.=' AND statusinternal=1';
			}
			$criteria->order='idcontent DESC';
			$criteria->params=array(':idsub'=>$result['idsubkategori'], 'idcon'=>$result['idcontent']);

		    $count=Content::model()->count($criteria);
		    $pages=new CPagination($count);
		    $pages->pageSize=5;
		    $pages->applyLimit($criteria);
		    $artLain=Content::model()->findAll($criteria);

		    $lampiran = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
		    $komen = new TComment;
		    if (isset($_POST['TComment'])) {
				$komen->attributes=$_POST['TComment'];
				$komen->isi_comment=$_POST['TComment']['isi_comment'];
				$komen->created_date=date('Y-m-d H:i:s');
				$komen->nik_user=Yii::app()->user->id;
				$komen->id_content=$id;
				$komen->stts_comment=0;
				$komen->save();
			}

			// $komentar = TComment::model()->findAllByAttributes(array('id_content'=>$id));
			$critcom=new CDbCriteria();
			$critcom->condition='id_content=:idcom';
			$critcom->order='created_date DESC';
			$critcom->params=array(':idcom'=>$id);
			$komentar=TComment::model()->findAll($critcom);

		    $this->render('_artActivation', array(
		        'art' => $art,
		        'lampiran' => $lampiran,
		        'artLain' => $artLain,
		        'komen' => $komen,
		        'komentar' => $komentar,
		        'id'=>$id,
		    ));
		}
	}

	public function actionPrint()
	{
		$this->layout = 'print';
		if(isset($_GET['id'])){
			$id = $_GET['id'];

			$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.V_SHORT_UNIT
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
		    $art = $commands->queryAll();

		    $result = array();
		    foreach ($art as $value) {
		    	$result['idsubkategori']=$value['idsubkategori'];
		    	$result['idcontent']=$value['idcontent'];
		    }

		    $criteria=new CDbCriteria();
			$criteria->condition='idsubkategori=:idsub';
			$criteria->condition.=' AND idcontent<>:idcon';
			$criteria->condition.=' AND idstatus=1';
			if(Yii::app()->user->isGuest){
				$criteria->condition.=' AND statusinternal=1';
			}
			$criteria->order='idcontent DESC';
			$criteria->params=array(':idsub'=>$result['idsubkategori'], 'idcon'=>$result['idcontent']);

		    $count=Content::model()->count($criteria);
		    $pages=new CPagination($count);
		    $pages->pageSize=10;
		    $pages->applyLimit($criteria);
		    $artLain=Content::model()->findAll($criteria);

		    $lampiran = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
		    $komen = new TComment;
		    if (isset($_POST['TComment'])) {
				$komen->attributes=$_POST['TComment'];
				$komen->isi_comment=$_POST['TComment']['isi_comment'];
				$komen->created_date=date('Y-m-d H:i:s');
				$komen->nik_user=Yii::app()->user->id;
				$komen->id_content=$id;
				$komen->stts_comment=0;
				$komen->save();
			}

			// $komentar = TComment::model()->findAllByAttributes(array('id_content'=>$id));
			$critcom=new CDbCriteria();
			$critcom->condition='id_content=:idcom';
			$critcom->order='created_date DESC';
			$critcom->params=array(':idcom'=>$id);
			$komentar=TComment::model()->findAll($critcom);

		    $this->render('_print', array(
		        'art' => $art,
		        'lampiran' => $lampiran,
		        'artLain' => $artLain,
		        'komen' => $komen,
		        'komentar' => $komentar
		    ));
		}
	}

	public function actionKnowledge()
	{
		if(isset($_GET['id'])){
			$id = $_GET['id'];

			$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.V_SHORT_UNIT
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
		    $artstory = $commands->queryAll();

		    $result = array();
		    foreach ($artstory as $value) {
		    	$result['idsubkategori']=$value['idsubkategori'];
		    	$result['idcontent']=$value['idcontent'];
		    }

		    $criteria=new CDbCriteria();
			$criteria->condition='idsubkategori=:idsub';
			$criteria->condition.=' AND idcontent<>:idcon';
			$criteria->condition.=' AND idstatus=1';
			if(Yii::app()->user->isGuest){
				$criteria->condition.=' AND statusinternal=1';
			}
			$criteria->order='idcontent DESC';
			$criteria->params=array(':idsub'=>$result['idsubkategori'], 'idcon'=>$result['idcontent']);

		    $count=Content::model()->count($criteria);
		    $pages=new CPagination($count);
		    $pages->pageSize=5;
		    $pages->applyLimit($criteria);
		    $storyLain=Content::model()->findAll($criteria);

		    $lampiran = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
		    $komen = new TComment;
		    if (isset($_POST['TComment'])) {
				$komen->attributes=$_POST['TComment'];
				$komen->isi_comment=$_POST['TComment']['isi_comment'];
				$komen->created_date=date('Y-m-d H:i:s');
				$komen->nik_user=Yii::app()->user->id;
				$komen->id_content=$id;
				$komen->stts_comment=0;
				$komen->save();
			}

			// $komentar = TComment::model()->findAllByAttributes(array('id_content'=>$id));
			$critcom=new CDbCriteria();
			$critcom->condition='id_content=:idcom';
			$critcom->order='created_date DESC';
			$critcom->params=array(':idcom'=>$id);
			$komentar=TComment::model()->findAll($critcom);

		    $this->render('_artKnowledge', array(
		        'artstory' => $artstory,
		        'lampiran' => $lampiran,
		        'storyLain' => $storyLain,
		        'komen' => $komen,
		        'komentar' => $komentar,
		        'id'=>$id
		    ));
		}
	}

	public function actionExpert()
	{
		if(isset($_GET['id'])){
			$id = $_GET['id'];

			$sql = "SELECT t.*, p.status, z.namasub, z.namakat, z.idkategori, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.V_SHORT_UNIT
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
		    $artstory = $commands->queryAll();

		    $result = array();
		    foreach ($artstory as $value) {
		    	$result['idsubkategori']=$value['idsubkategori'];
		    	$result['idcontent']=$value['idcontent'];
		    }

		    $criteria=new CDbCriteria();
			$criteria->condition='idsubkategori=:idsub';
			$criteria->condition.=' AND idcontent<>:idcon';
			$criteria->condition.=' AND idstatus=1';
			if(Yii::app()->user->isGuest){
				$criteria->condition.=' AND statusinternal=1';
			}
			$criteria->order='idcontent DESC';
			$criteria->params=array(':idsub'=>$result['idsubkategori'], 'idcon'=>$result['idcontent']);

		    $count=Content::model()->count($criteria);
		    $pages=new CPagination($count);
		    $pages->pageSize=5;
		    $pages->applyLimit($criteria);
		    $storyLain=Content::model()->findAll($criteria);

		    $lampiran = Lampiran::model()->findAllByAttributes(array('idcontent'=>$id));
		    $komen = new TComment;
		    if (isset($_POST['TComment'])) {
				$komen->attributes=$_POST['TComment'];
				$komen->isi_comment=$_POST['TComment']['isi_comment'];
				$komen->created_date=date('Y-m-d H:i:s');
				$komen->nik_user=Yii::app()->user->id;
				$komen->id_content=$id;
				$komen->stts_comment=0;
				$komen->save();
			}

			// $komentar = TComment::model()->findAllByAttributes(array('id_content'=>$id));
			$critcom=new CDbCriteria();
			$critcom->condition='id_content=:idcom';
			$critcom->order='created_date DESC';
			$critcom->params=array(':idcom'=>$id);
			$komentar=TComment::model()->findAll($critcom);

		    $this->render('_artExpert', array(
		        'artstory' => $artstory,
		        'lampiran' => $lampiran,
		        'storyLain' => $storyLain,
		        'komen' => $komen,
		        'komentar' => $komentar,
		        'id'=>$id
		    ));
		}
	}

	public function actionViewComment()
	{
		if(isset($_GET['id'])){
			$idkonten = $_GET['id'];
			$comment = TComment::model()->findAllByAttributes(array('id_content'=>$idkonten));
			if(!empty($comment)){
				foreach ($comment as $value) {
					$value->stts_comment=1;
					$value->save();
				}
			}

		}
		$this->actionStory();
	}
}