<?php

/**
 * This is the model class for table "lampiran".
 *
 * The followings are the available columns in table 'lampiran':
 * @property integer $idlampiran
 * @property integer $idcontent
 * @property string $filename
 * @property string $filesize
 * @property string $filetype
 * @property string $dirfile
 * @property integer $idstatus
 * @property string $created_by
 * @property string $create_date
 * @property string $updated_by
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property PStatus $idstatus0
 * @property Content $idcontent0
 */
class Lampiran extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lampiran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcontent, idstatus, create_date', 'required'),
			array('idcontent, idstatus', 'numerical', 'integerOnly'=>true),
			array('filename, filetype', 'file', 'types' => 'pdf', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 50, 'tooLarge' => 'The file was larger than 50MB. Please upload a smaller file.'),
			array('filesize', 'length', 'max'=>20),
			array('created_by, updated_by', 'length', 'max'=>100),
			array('updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idlampiran, idcontent, filename, filesize, filetype, dirfile, idstatus, created_by, create_date, updated_by, updated_date', 'safe', 'on'=>'search'),
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
			'idstatus0' => array(self::BELONGS_TO, 'PStatus', 'idstatus'),
			'idcontent0' => array(self::BELONGS_TO, 'Content', 'idcontent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idlampiran' => 'Idlampiran',
			'idcontent' => 'Idcontent',
			'filename' => 'Filename',
			'filesize' => 'Filesize',
			'filetype' => 'Filetype',
			'idstatus' => 'Idstatus',
			'created_by' => 'Created By',
			'create_date' => 'Create Date',
			'updated_by' => 'Deleted By',
			'updated_date' => 'Delete Date',
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

		$criteria->compare('idlampiran',$this->idlampiran);
		$criteria->compare('idcontent',$this->idcontent);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('filesize',$this->filesize,true);
		$criteria->compare('filetype',$this->filetype,true);
		$criteria->compare('idstatus',$this->idstatus);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lampiran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
