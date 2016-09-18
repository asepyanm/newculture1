<?php

/**
 * This is the model class for table "authassignment".
 *
 * The followings are the available columns in table 'authassignment':
 * @property string $id
 * @property string $itemname
 * @property integer $nik
 * @property string $bizrule
 * @property string $data
 *
 * The followings are the available model relations:
 * @property Authitem $itemname0
 * @property User $nik0
 * @property HistoryLog[] $historyLogs
 */

class Authassignment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $kodedivisi;
	public $divisi;
	public $namakar;
	public $posisi;	
	public function tableName()
	{
		return 'authassignment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('itemname, nik', 'required'),
			array('nik', 'numerical', 'integerOnly'=>true),
			array('itemname', 'length', 'max'=>64),
			array('bizrule, data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, itemname, nik, bizrule, data,namakar,kodedivisi,posisi', 'safe', 'on'=>'search'),
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
			'itemname0' => array(self::BELONGS_TO, 'Authitem', 'itemname'),
			// 'nik0' => array(self::BELONGS_TO, 'User', 'nik'),
			'historyLogs' => array(self::HAS_MANY, 'HistoryLog', 'id_auth_assignment'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'itemname' => 'Posisi Admin',
			'nik' => 'NIK',
			'bizrule' => 'Bizrule',
			'data' => 'Data',
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

		$criteria=new CDbCriteria;
		$criteria->select = 't.*, u.C_KODE_DIVISI, u.V_SHORT_DIVISI, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI';
		$criteria->join = 'INNER JOIN user u ON t.nik = u.N_NIK';
		$criteria->compare('id',$this->id);
		$criteria->compare('lower(itemname)',strtolower($this->itemname),true);
		$criteria->compare('lower(nik)',strtolower($this->nik));
		$criteria->compare('lower(bizrule)',strtolower($this->bizrule),true);
		$criteria->compare('lower(data)',strtolower($this->data),true);
		$criteria->compare('lower(u.V_NAMA_KARYAWAN)',strtolower($this->namakar),true);
		$criteria->compare('lower(u.C_KODE_DIVISI)',strtolower($this->kodedivisi),true);
		$criteria->compare('lower(u.V_SHORT_POSISI)',strtolower($this->posisi),true);

		// $criteria->order = "u.V_NAMA_KARYAWAN ASC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Authassignment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterFind()
	{
		$cdc = $this->getCreated();
		$this->kodedivisi = $cdc['C_KODE_DIVISI'];
		$this->divisi = $cdc['V_SHORT_DIVISI'];
		$this->namakar = $cdc['V_NAMA_KARYAWAN'];
		$this->posisi = $cdc['V_SHORT_POSISI'];

		return true;
	}

	public function getCreated()
	{
		$idc = $this->id;
		$sql = "SELECT t.itemname, t.nik, u.C_KODE_DIVISI, u.V_SHORT_DIVISI, u.V_NAMA_KARYAWAN, u.V_SHORT_POSISI FROM authassignment t INNER JOIN
				user u ON t.nik = u.N_NIK WHERE t.id=:id";

		$commands = Yii::app()->db->createCommand($sql);
	    $commands->bindParam(':id',$idc, PDO::PARAM_INT);
	    $oleh = $commands->queryRow();

	    return $oleh;
	}
}
