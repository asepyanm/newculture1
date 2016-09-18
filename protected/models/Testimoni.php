<?php

/**
 * This is the model class for table "testimoni".
 *
 * The followings are the available columns in table 'testimoni':
 * @property integer $id_testimoni
 * @property string $isi_testimoni
 * @property string $created_date
 * @property integer $nik_user
 * @property string $video
 * @property string $video_name
 * @property string $video_size
 * @property string $video_type
 * @property integer $stts_testimoni
 * @property integer $stts_notif
 */
class Testimoni extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'testimoni';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nik_user, stts_testimoni, stts_notif', 'numerical', 'integerOnly'=>true),
			array('video_name, video_type', 'length', 'max'=>200),
			array('video_size', 'length', 'max'=>20),
			array('isi_testimoni, created_date, video', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_testimoni, isi_testimoni, created_date, nik_user, video, video_name, video_size, video_type, stts_testimoni, stts_notif', 'safe', 'on'=>'search'),
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
			'id_testimoni' => 'Id Testimoni',
			'isi_testimoni' => 'Isi Testimoni',
			'created_date' => 'Created Date',
			'nik_user' => 'Nik User',
			'video' => 'Video',
			'video_name' => 'Video Name',
			'video_size' => 'Video Size',
			'video_type' => 'Video Type',
			'stts_testimoni' => 'Stts Testimoni',
			'stts_notif' => 'Stts Notif',
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

		$criteria->compare('id_testimoni',$this->id_testimoni);
		$criteria->compare('isi_testimoni',$this->isi_testimoni,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('nik_user',$this->nik_user);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('video_name',$this->video_name,true);
		$criteria->compare('video_size',$this->video_size,true);
		$criteria->compare('video_type',$this->video_type,true);
		$criteria->compare('stts_testimoni',$this->stts_testimoni);
		$criteria->compare('stts_notif',$this->stts_notif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Testimoni the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
