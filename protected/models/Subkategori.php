<?php

/**
 * This is the model class for table "subkategori".
 *
 * The followings are the available columns in table 'subkategori':
 * @property string $idsubkategori
 * @property string $idkategori
 * @property string $nama
 * @property string $deskripsi
 *
 * The followings are the available model relations:
 * @property Content[] $contents
 * @property Kategori $idkategori0
 */
class Subkategori extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subkategori';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idkategori', 'length', 'max'=>10),
			array('nama', 'length', 'max'=>50),
			array('deskripsi', 'length', 'max'=>300),
			array('gambar', 'file', 'types' => 'jpg, gif, png, jpeg, bmp', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 5, 'tooLarge' => 'The file was larger than 5MB. Please upload a smaller file.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idsubkategori, idkategori, nama, deskripsi', 'safe', 'on'=>'search'),
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
			'contents' => array(self::HAS_MANY, 'Content', 'idsubkategori'),
			'idkategori0' => array(self::BELONGS_TO, 'Kategori', 'idkategori'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idsubkategori' => 'Idsubkategori',
			'idkategori' => 'Kategori',
			'nama' => 'Nama',
			'deskripsi' => 'Deskripsi',
			'gambar' => 'Gambar',
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

		$criteria->compare('idsubkategori',$this->idsubkategori,true);
		$criteria->compare('idkategori',$this->idkategori,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subkategori the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
