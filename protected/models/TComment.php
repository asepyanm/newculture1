<?php

/**
 * This is the model class for table "t_comment".
 *
 * The followings are the available columns in table 't_comment':
 * @property integer $id_comment
 * @property string $isi_comment
 * @property string $created_date
 * @property integer $nik_user
 * @property integer $id_content
 *
 * The followings are the available model relations:
 * @property Content $idContent
 * @property User $nikUser
 */
class TComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nik_user, id_content', 'numerical', 'integerOnly'=>true),
			array('isi_comment', 'length', 'max'=>255),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_comment, isi_comment, created_date, nik_user, id_content', 'safe', 'on'=>'search'),
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
			'idContent' => array(self::BELONGS_TO, 'Content', 'id_content'),
			'nikUser' => array(self::BELONGS_TO, 'User', 'nik_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_comment' => 'Id Comment',
			'isi_comment' => 'Isi Comment',
			'created_date' => 'Created Date',
			'nik_user' => 'Nik User',
			'id_content' => 'Id Content',
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

		$criteria->compare('id_comment',$this->id_comment);
		$criteria->compare('isi_comment',$this->isi_comment,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('nik_user',$this->nik_user);
		$criteria->compare('id_content',$this->id_content);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
