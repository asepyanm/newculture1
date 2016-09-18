<?php

/**
 * This is the model class for table "rating".
 *
 * The followings are the available columns in table 'rating':
 * @property integer $idrating
 * @property integer $idratingparam
 * @property integer $idcontent
 * @property string $nik
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Content $idcontent0
 * @property Ratingparam $idratingparam0
 */
class Rating extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idratingparam, idcontent', 'numerical', 'integerOnly'=>true),
			array('nik', 'length', 'max'=>6),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idrating, idratingparam, idcontent, nik, created_date', 'safe', 'on'=>'search'),
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
			'idratingparam0' => array(self::BELONGS_TO, 'Ratingparam', 'idratingparam'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idrating' => 'Idrating',
			'idratingparam' => 'Idratingparam',
			'idcontent' => 'Idcontent',
			'nik' => 'Nik',
			'created_date' => 'Created Date',
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

		$criteria->compare('idrating',$this->idrating);
		$criteria->compare('idratingparam',$this->idratingparam);
		$criteria->compare('idcontent',$this->idcontent);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rating the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
