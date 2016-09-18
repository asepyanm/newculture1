<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $idmessage
 * @property integer $idcontent
 * @property string $isi
 * @property integer $created_by
 * @property string $created_date
 * @property string $status
 */
class Message extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $mess;
	public $jml_mess;
	public $waktu;

	public function tableName()
	{
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcontent, created_by, created_date', 'required'),
			array('idcontent, created_by', 'numerical', 'integerOnly'=>true),
			array('isi, status', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idmessage, idcontent, isi, created_by, created_date, status, mess', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmessage' => 'Idmessage',
			'idcontent' => 'Idcontent',
			'isi' => 'Isi',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
			'status' => 'Status',
			'mess' => 'Isi',
			'jml_mess' => '',
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
		$to = Yii::app()->user->id;
		$criteria=new CDbCriteria;

		$criteria->condition = 't.to = :to';
		$criteria->params = array('to'=>$to);
		$criteria->order = "t.created_date DESC";
        $criteria->group = "t.idcontent,t.created_by";

		$criteria->compare('idmessage',$this->idmessage);
		$criteria->compare('idcontent',$this->idcontent);
		$criteria->compare('isi',$this->isi,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterFind()
	{
		$cdc = $this->getMess();
		$jml = $this->countMess();
		$this->mess = $cdc['isi'];
		$this->waktu = $cdc['created_date'];
		$this->jml_mess = $jml;

		return true;
	}

	public function getMess()
	{
		$idcontent = $this->idcontent;
		$created_by = $this->created_by;
		$sql = "SELECT
					*
				FROM
					message
				WHERE
					idcontent = :idcontent
				AND created_by = :created_by
				ORDER BY
					created_date DESC
				LIMIT 1";

		$commands = Yii::app()->db->createCommand($sql);
		$commands->bindParam(":idcontent", $idcontent, PDO::PARAM_INT);
	    $commands->bindParam(':created_by',$created_by, PDO::PARAM_INT);
	    $oleh = $commands->queryRow();

	    return $oleh;
	}
	public function countMess(){
		$idcontent = $this->idcontent;
		$created_by = $this->created_by;
		$sql = "SELECT
					COUNT(idmessage) as jml_mess
				FROM
					message
				WHERE
					idcontent = :idcontent
				AND created_by = :created_by
				AND status = 0";
		$commands = Yii::app()->db->createCommand($sql);
		$commands->bindParam(":idcontent", $idcontent, PDO::PARAM_INT);
	    $commands->bindParam(':created_by',$created_by, PDO::PARAM_INT);
	    $data = $commands->queryRow();

	    return $data['jml_mess'];
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
