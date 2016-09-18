<?php

/**
 * This is the model class for table "history_log".
 *
 * The followings are the available columns in table 'history_log':
 * @property integer $idlog
 * @property string $id_auth_assignment
 * @property string $created_by
 * @property string $created_date
 * @property string $updated_by
 * @property string $updated_date
 * @property integer $idcontent
 *
 * The followings are the available model relations:
 * @property Content $idcontent0
 * @property Authassignment $idAuthAssignment
 */
class HistoryLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'history_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_auth_assignment, idcontent', 'required'),
			array('idcontent', 'numerical', 'integerOnly'=>true),
			array('id_auth_assignment', 'length', 'max'=>11),
			array('created_by, updated_by', 'length', 'max'=>100),
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idlog, id_auth_assignment, created_by, created_date, updated_by, updated_date, idcontent', 'safe', 'on'=>'search'),
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
			'idcontent0' => array(self::BELONGS_TO, 'Content', 'idcontent'),
			'idAuthAssignment' => array(self::BELONGS_TO, 'Authassignment', 'id_auth_assignment'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idlog' => 'Idlog',
			'id_auth_assignment' => 'Id Auth Assignment',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
			'updated_by' => 'Updated By',
			'updated_date' => 'Updated Date',
			'idcontent' => 'Idcontent',
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

		$criteria->compare('idlog',$this->idlog);
		$criteria->compare('id_auth_assignment',$this->id_auth_assignment,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('idcontent',$this->idcontent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistoryLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
