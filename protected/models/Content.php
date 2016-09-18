<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $idcontent
 * @property string $idsubkategori
 * @property string $judul
 * @property string $sinopsis
 * @property string $isi
 * @property string $video
 * @property string $gambar
 * @property integer $idstatus
 * @property string $slide
 * @property string $link
 * @property string $caption
 * @property string $narasi
 * @property string $statusinternal
 *
 * The followings are the available model relations:
 * @property Subkategori $idsubkategori0
 * @property PStatus $idstatus0
 * @property HistoryLog[] $historyLogs
 * @property Lampiran[] $lampirans
 */
class Content extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $created_by;
	public $updated_by;
	public $created_date;
	public $updated_date;
	public $create_oleh;
	public $update_oleh;
	public $posisi_create;
	public $posisi_update;
	public $divisi_create;
	public $divisi_update;
	public $namareject;
	public $created_n_nik;
	public $updated_n_nik;
	public $created_start_date;
	public $created_end_date;
	public $updated_start_date;
	public $updated_end_date;
	public $id_unit;
	public $nama_unit;

	public function tableName()
	{
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('idsubkategori', 'required'),
			array('idstatus', 'numerical', 'integerOnly'=>true),
			array('idsubkategori', 'length', 'max'=>10),
			array('rejectoleh', 'length', 'max'=>6),
			array('judul', 'length', 'max'=>100),
			array('sinopsis', 'length', 'max'=>300),
			array('gambar', 'file', 'types' => 'jpg, gif, png, jpeg, bmp', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 5, 'tooLarge' => 'The file was larger than 5MB. Please upload a smaller file.'),
			array('video', 'file', 'types' => 'swf, flv, 3gp, mp4, avi, mpg', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 20, 'tooLarge' => 'The file was larger than 20MB. Please upload a smaller file.'),
			array('slide, link, statusinternal', 'length', 'max'=>1),
			array('caption', 'length', 'max'=>50),
			array('narasi', 'length', 'max'=>200),
			array('alasan', 'length', 'max'=>255),
			array('isi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcontent, idsubkategori, judul, sinopsis, isi, video, gambar, idstatus, slide, link, caption, narasi, statusinternal, rejectoleh, alasan, divisi_create, created_n_nik, updated_n_nik, updated_date, created_date, id_unit', 'safe', 'on'=>'search'),
			array('idcontent, idsubkategori, judul, sinopsis, isi, video, gambar, idstatus, slide, link, caption, narasi, statusinternal, rejectoleh, alasan, divisi_create, created_n_nik, updated_n_nik, updated_date, created_date, id_unit', 'safe', 'on'=>'searchDraft'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idsubkategori0' => array(self::BELONGS_TO, 'Subkategori', 'idsubkategori'),
			'idstatus0' => array(self::BELONGS_TO, 'PStatus', 'idstatus'),
			'historyLogs' => array(self::HAS_MANY, 'HistoryLog', 'idcontent'),
			'lampirans' => array(self::HAS_MANY, 'Lampiran', 'idcontent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcontent' => 'Idcontent',
			'idsubkategori' => 'Sub Kategori',
			'judul' => 'Judul',
			'sinopsis' => 'Sinopsis',
			'isi' => 'Isi Konten',
			'video' => 'Video',
			'gambar' => 'Gambar',
			'idstatus' => 'Status',
			'slide' => 'Slide',
			'link' => 'Link',
			'caption' => 'Caption',
			'narasi' => 'Narasi',
			'statusinternal' => 'External',
			'rejectoleh' => 'Reject By',
			'alasan' => 'Alasan',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$is = Yii::app()->user->itemname;
		$id_role = Roleunit::model()->findByAttributes(array('nik'=>Yii::app()->user->id))->id_unit;
		$params = array();
		$criteria=new CDbCriteria;
		$criteria->select = 't.*, d.created_by, d.created_date, un.nama_unit, ro.id_unit,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN as nama_create, x.V_NAMA_KARYAWAN as nama_update, u.V_SHORT_POSISI, u.C_KODE_DIVISI';
		$criteria->join = 'INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent)';
		$criteria->join .= ' INNER JOIN user u ON d.created_by=u.N_NIK';
		$criteria->join .= ' INNER JOIN user x ON d.updated_by=x.N_NIK';
		$criteria->join .= ' INNER JOIN roleunit ro ON d.created_by = ro.nik';
		$criteria->join .= ' INNER JOIN unit un ON ro.id_unit = un.id_unit';
		$criteria->condition = "t.idstatus=:id1";
		$params[':id1'] = 1;
		if ($is=='adminunit') {
			$criteria->condition .= ' AND ro.id_unit = :id_role';
			$params[':id_role'] = $id_role; 
		}
		if($this->created_n_nik!=NULL){
			$criteria->condition .= ' AND (d.created_by LIKE :nik OR u.V_NAMA_KARYAWAN LIKE :nama)';
			$params[':nik'] = '%'.$this->created_n_nik.'%'; 
			$params[':nama'] = '%'.$this->created_n_nik.'%'; 
		}
		if($this->updated_n_nik!=NULL){
			$criteria->condition .= ' AND (d.updated_by LIKE :nikup OR x.V_NAMA_KARYAWAN LIKE :namaup)';
			$params[':nikup'] = '%'.$this->updated_n_nik.'%'; 
			$params[':namaup'] = '%'.$this->updated_n_nik.'%'; 
		}
		// $criteria->condition = "t.idstatus=2 OR t.idstatus=4";
		$criteria->params = $params;
        $criteria->group = "t.idcontent";
        $criteria->compare('idcontent',$this->idcontent);
		$criteria->compare('idsubkategori',$this->idsubkategori);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('sinopsis',$this->sinopsis,true);
		$criteria->compare('isi',$this->isi,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('idstatus',$this->idstatus);
		$criteria->compare('slide',$this->slide,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('narasi',$this->narasi,true);
		$criteria->compare('statusinternal',$this->statusinternal,true);
		$criteria->compare('rejectoleh',$this->rejectoleh,true);
		$criteria->compare('alasan',$this->alasan,true);
		$criteria->compare('u.C_KODE_DIVISI',$this->divisi_create,true);
		$criteria->compare('d.updated_date',$this->updated_date,true);
		$criteria->compare('d.created_date',$this->created_date,true);
		$criteria->compare('ro.id_unit',$this->id_unit);
		// $criteria->order = "d.updated_date DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array("defaultOrder"=>"d.updated_date DESC")
		));
	}

	
	public function searchDraft()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$is = Yii::app()->user->itemname;
		$id_role = Roleunit::model()->findByAttributes(array('nik'=>Yii::app()->user->id))->id_unit;
		$params = array();
		$criteria=new CDbCriteria;
		$criteria->select = 't.*, d.created_by, d.created_date, un.nama_unit, ro.id_unit,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.C_KODE_DIVISI';
		$criteria->join = 'INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent)';
		$criteria->join .= ' INNER JOIN user u ON d.created_by=u.N_NIK';
		$criteria->join .= ' INNER JOIN roleunit ro ON d.created_by = ro.nik';
		$criteria->join .= ' INNER JOIN unit un ON ro.id_unit = un.id_unit';
		// $criteria->condition = "t.idstatus=1";
		$criteria->condition = "(t.idstatus=:id1 OR t.idstatus=:id2)";
		$params[':id1'] = 2;
		$params[':id2'] = 4;
		if ($is=='adminunit') {
			$criteria->condition .= ' AND (ro.id_unit = :id_role)';
			$params[':id_role'] = $id_role; 
		}
		if($this->created_n_nik!=NULL){
			$criteria->condition .= ' AND (d.created_by LIKE :nik OR u.V_NAMA_KARYAWAN LIKE :nama)';
			$params[':nik'] = '%'.$this->created_n_nik.'%'; 
			$params[':nama'] = '%'.$this->created_n_nik.'%'; 
		}
		$criteria->params = $params;
		// $criteria->order = "d.updated_date DESC";
        $criteria->group = "t.idcontent";
        $criteria->compare('u.C_KODE_DIVISI',$this->divisi_create,true);
        $criteria->compare('idcontent',$this->idcontent);
		$criteria->compare('idsubkategori',$this->idsubkategori);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('sinopsis',$this->sinopsis,true);
		$criteria->compare('isi',$this->isi,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('idstatus',$this->idstatus);
		$criteria->compare('slide',$this->slide,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('narasi',$this->narasi,true);
		$criteria->compare('statusinternal',$this->statusinternal,true);
		$criteria->compare('rejectoleh',$this->rejectoleh,true);
		$criteria->compare('alasan',$this->alasan,true);
		$criteria->compare('ro.id_unit',$this->id_unit);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array("defaultOrder"=>"d.updated_date DESC")
		));
	}

	// public function searchDraft()
	// {
	// 	// @todo Please modify the following code to remove attributes that should not be searched.
	// 	//$admin=Yii::app()->user->id;
	// 	$criteria=new CDbCriteria;
	// 	$criteria->select = 't.*, d.created_by, d.created_date,
	// 				d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI, u.C_KODE_DIVISI';
	// 	$criteria->join = 'INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
	// 				a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
	// 				  ON (t.idcontent = d.idcontent)';
	// 	$criteria->join .= ' INNER JOIN user u ON d.created_by=u.N_NIK';
	// 	// $criteria->condition = "d.created_by=".$admin."";
	// 	$criteria->condition = "t.idstatus=2 OR t.idstatus=4";
 //        // $criteria->params = array(':admin' => $admin);
 //        $criteria->order = "d.updated_date DESC";
 //        $criteria->group = "t.idcontent";
 //        $criteria->compare('idcontent',$this->idcontent);
	// 	$criteria->compare('idsubkategori',$this->idsubkategori);
	// 	$criteria->compare('judul',$this->judul,true);
	// 	$criteria->compare('sinopsis',$this->sinopsis,true);
	// 	$criteria->compare('isi',$this->isi,true);
	// 	$criteria->compare('video',$this->video,true);
	// 	$criteria->compare('gambar',$this->gambar,true);
	// 	$criteria->compare('idstatus',$this->idstatus);
	// 	$criteria->compare('slide',$this->slide,true);
	// 	$criteria->compare('link',$this->link,true);
	// 	$criteria->compare('caption',$this->caption,true);
	// 	$criteria->compare('narasi',$this->narasi,true);
	// 	$criteria->compare('statusinternal',$this->statusinternal,true);
	// 	$criteria->compare('rejectoleh',$this->rejectoleh,true);
	// 	$criteria->compare('alasan',$this->alasan,true);
	// 	$criteria->compare('u.C_KODE_DIVISI',$this->divisi_create,true);

	// 	return new CActiveDataProvider($this, array(
	// 		'criteria'=>$criteria,
	// 	));
	// }

	public function searchDelete()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select = 't.*, d.created_by, d.created_date,
					d.updated_by, d.updated_date, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI';
		$criteria->join = 'INNER JOIN (SELECT b.* FROM (SELECT a.idcontent, a.updated_date, a.created_by, a.created_date,
					a.updated_by, a.id_auth_assignment FROM history_log a INNER JOIN content c ON a.idcontent=c.idcontent) b ORDER BY b.updated_date DESC) d
					  ON (t.idcontent = d.idcontent) INNER JOIN user u ON d.created_by=u.N_NIK WHERE t.idstatus=0';

		$criteria->compare('idcontent',$this->idcontent);
		$criteria->compare('idsubkategori',$this->idsubkategori,true);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('sinopsis',$this->sinopsis,true);
		$criteria->compare('isi',$this->isi,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('idstatus',$this->idstatus);
		$criteria->compare('slide',$this->slide,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('narasi',$this->narasi,true);
		$criteria->compare('statusinternal',$this->statusinternal,true);
		$criteria->compare('rejectoleh',$this->rejectoleh,true);
		$criteria->compare('alasan',$this->alasan,true);

		$criteria->order = "t.idcontent DESC";
        $criteria->group = "t.idcontent";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Content the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterFind()
	{
		$cdc = $this->getCreated();
		$cdx = $this->getReject();
		$this->created_by = $cdc['created_by'];
		$this->updated_by = $cdc['updated_by'];
		$this->created_date = $cdc['created_date'];
		$this->updated_date = $cdc['updated_date'];
		$this->create_oleh = $cdc['create_oleh'];
		$this->update_oleh = $cdc['update_oleh'];
		$this->posisi_create = $cdc['posisi_create'];
		$this->posisi_update = $cdc['posisi_update'];
		$this->divisi_create = $cdc['divisi_create'];
		$this->divisi_update = $cdc['divisi_update'];
		$this->namareject = $cdx['V_NAMA_KARYAWAN'];
		$this->created_n_nik = ucwords(strtolower($this->create_oleh)).'</br>'.$this->created_by;
		$this->updated_n_nik = ucwords(strtolower($this->update_oleh)).'</br>'.$this->updated_by;
		$this->id_unit = $cdc['id_unit'];
		$this->nama_unit = $cdc['nama_unit'];

		return true;
	}

	public function getCreated()
	{
		$idc = $this->idcontent;
		$sql = "SELECT a.created_by, a.updated_by, a.created_date, a.updated_date, b.V_NAMA_KARYAWAN AS create_oleh, b.V_SHORT_POSISI AS posisi_create, b.C_KODE_DIVISI AS divisi_create, 
				c.V_NAMA_KARYAWAN AS update_oleh, c.V_SHORT_POSISI AS posisi_update, c.C_KODE_DIVISI AS divisi_update, un.nama_unit, ro.id_unit FROM history_log a INNER JOIN user b ON a.created_by = b.N_NIK INNER JOIN roleunit ro ON a.created_by = ro.nik INNER JOIN unit un ON ro.id_unit = un.id_unit
				INNER JOIN (SELECT e.N_NIK, d.updated_by, d.updated_date, e.V_NAMA_KARYAWAN, e.V_SHORT_POSISI, e.C_KODE_DIVISI 
				FROM history_log d INNER JOIN user e ON d.updated_by=e.N_NIK WHERE d.idcontent=:id ORDER BY d.updated_date DESC LIMIT 1) c 
				ON a.updated_by=c.N_NIK WHERE a.idcontent=:id ORDER BY a.updated_date DESC LIMIT 1";

		$commands = Yii::app()->db->createCommand($sql);
	  $commands->bindParam(':id',$idc, PDO::PARAM_INT);
	  $oleh = $commands->queryRow();

	  return $oleh;
	}

	public function getReject()
	{
		$idx = $this->rejectoleh;
		$sql = "SELECT V_NAMA_KARYAWAN FROM user WHERE N_NIK=:id";

		$commands = Yii::app()->db->createCommand($sql);
	    $commands->bindParam(':id',$idx, PDO::PARAM_INT);
	    $reject = $commands->queryRow();

	    return $reject;
	}
}
