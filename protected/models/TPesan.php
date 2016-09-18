<?php

/**
 * This is the model class for table "t_pesan".
 *
 * The followings are the available columns in table 't_pesan':
 * @property integer $idpesan
 * @property string $nama
 * @property string $email
 * @property string $hp
 * @property string $isipesan
 * @property integer $stts_pesan
 * @property string $created_date
 */
class TPesan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_pesan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('idpesan', 'required'),
			// array('idpesan, stts_pesan', 'numerical', 'integerOnly'=>true),
			array('nama, email', 'length', 'max'=>100),
			array('hp', 'length', 'max'=>20),
			array('isipesan', 'length', 'max'=>255),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idpesan, nama, email, hp, isipesan, stts_pesan, created_date', 'safe', 'on'=>'search'),
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
			'idpesan' => 'Idpesan',
			'nama' => 'NAMA',
			'email' => 'EMAIL',
			'hp' => 'HP',
			'isipesan' => 'ISI PESAN',
			'stts_pesan' => 'STATUS',
			'created_date' => 'CREATED DATE',
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

		$criteria->compare('idpesan',$this->idpesan);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('hp',$this->hp,true);
		$criteria->compare('isipesan',$this->isipesan,true);
		$criteria->compare('stts_pesan',$this->stts_pesan);
		$criteria->compare('created_date',$this->created_date,true);

		$criteria->order = "idpesan DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TPesan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
