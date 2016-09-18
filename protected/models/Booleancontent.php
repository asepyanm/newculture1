<?php

/**
 * This is the model class for table "booleancontent".
 *
 * The followings are the available columns in table 'booleancontent':
 * @property integer $idstts
 * @property string $idsubkategori
 * @property string $judul
 * @property string $sinopsis
 * @property string $isi
 * @property string $video
 * @property string $gambar
 * @property string $lampiran
 * @property string $slide
 * @property string $link
 * @property string $label_judul
 * @property string $label_sinopsis
 * @property string $label_isi
 *
 * The followings are the available model relations:
 * @property Subkategori $idsubkategori0
 */
class Booleancontent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'booleancontent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idsubkategori', 'required'),
			array('idsubkategori', 'length', 'max'=>10),
			array('judul, sinopsis, isi, video, gambar, lampiran, slide, link', 'length', 'max'=>1),
			array('label_judul, label_sinopsis, label_isi', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idstts, idsubkategori, judul, sinopsis, isi, video, gambar, lampiran, slide, link, label_judul, label_sinopsis, label_isi', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idstts' => 'Idstts',
			'idsubkategori' => 'Idsubkategori',
			'judul' => 'Judul',
			'sinopsis' => 'Sinopsis',
			'isi' => 'Isi',
			'video' => 'Video',
			'gambar' => 'Gambar',
			'lampiran' => 'Lampiran',
			'slide' => 'Slide',
			'link' => 'Link',
			'label_judul' => 'Label Judul',
			'label_sinopsis' => 'Label Sinopsis',
			'label_isi' => 'Label Isi',
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

		$criteria->compare('idstts',$this->idstts);
		$criteria->compare('idsubkategori',$this->idsubkategori,true);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('sinopsis',$this->sinopsis,true);
		$criteria->compare('isi',$this->isi,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('lampiran',$this->lampiran,true);
		$criteria->compare('slide',$this->slide,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('label_judul',$this->label_judul,true);
		$criteria->compare('label_sinopsis',$this->label_sinopsis,true);
		$criteria->compare('label_isi',$this->label_isi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Booleancontent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
