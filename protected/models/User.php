<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $ID
 * @property integer $N_TAHUN
 * @property integer $N_BULAN
 * @property string $N_NIK
 * @property integer $C_KODE_AGAMA
 * @property string $V_NAMA_AGAMA
 * @property string $V_NAMA_KARYAWAN
 * @property string $C_KODE_DIVISI
 * @property string $V_SHORT_DIVISI
 * @property string $C_KODE_LOKER
 * @property string $V_SHORT_UNIT
 * @property integer $OBJID_POSISI
 * @property string $C_KODE_POSISI
 * @property string $V_SHORT_POSISI
 * @property string $V_BAND_POSISI
 * @property string $V_KELAS_POSISI
 * @property string $C_GROUP_HOST
 * @property string $C_HOST
 * @property string $C_KODE_USIA
 * @property string $V_NAMA_USIA
 * @property string $C_PERSONNEL_AREA
 * @property string $V_PERSONNEL_AREA
 * @property string $C_PERSONNEL_SUBAREA
 * @property string $V_PERSONNEL_SUBAREA
 * @property string $C_EMPLOYEE_GROUP
 * @property string $V_EMPLOYEE_GROUP
 * @property string $C_EMPLOYEE_SUBGROUP
 * @property string $V_EMPLOYEE_SUBGROUP
 * @property integer $C_LEVEL_PENDIDIKAN
 * @property string $V_LEVEL_PENDIDIKAN
 * @property string $V_JURUSAN_PENDIDIKAN
 * @property integer $N_TAHUN_NKI
 * @property string $V_NKI
 * @property integer $N_TAHUN_KOMPETENSI
 * @property string $V_KOMPETENSI
 * @property string $C_JOB_CHARACTERISTIC
 * @property string $V_JOB_CHARACTERISTIC
 * @property string $D_TGL_LAHIR
 * @property string $D_TGL_POSISI
 * @property string $D_TGL_BANDPOSISI
 * @property string $C_NILAI_BEHAVIOR
 * @property string $N_JUMLAH_TUDAS
 * @property string $N_JUMLAH_GADAS
 * @property string $V_JENIS_KELAMIN
 * @property string $C_KODE_PASUTRI
 * @property string $C_KODE_KK
 * @property string $C_PAYROLL_AREA
 * @property string $V_PAYROLL_AREA
 * @property string $D_TGL_PENSIUN
 * @property string $D_TGL_DIVISI
 * @property string $D_TGL_LOKER
 */
class User extends CActiveRecord
{
	public $updated_date;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('N_TAHUN, N_BULAN, C_KODE_AGAMA, OBJID_POSISI, C_LEVEL_PENDIDIKAN, N_TAHUN_NKI, N_TAHUN_KOMPETENSI', 'numerical', 'integerOnly'=>true),
			array('N_NIK', 'length', 'max'=>11),
			array('V_NAMA_AGAMA, V_LEVEL_PENDIDIKAN', 'length', 'max'=>50),
			array('V_LONG_UNIT', 'length', 'max'=>150),
			array('V_NAMA_KARYAWAN, V_SHORT_DIVISI, V_SHORT_UNIT, V_SHORT_POSISI, V_PERSONNEL_AREA, V_PERSONNEL_SUBAREA, V_JURUSAN_PENDIDIKAN', 'length', 'max'=>100),
			array('C_KODE_DIVISI, C_KODE_LOKER, C_KODE_POSISI', 'length', 'max'=>30),
			array('V_BAND_POSISI, V_KELAS_POSISI, C_GROUP_HOST, C_KODE_USIA', 'length', 'max'=>5),
			array('C_HOST, C_EMPLOYEE_GROUP, C_EMPLOYEE_SUBGROUP, V_NKI, V_KOMPETENSI', 'length', 'max'=>3),
			array('V_NAMA_USIA, V_JOB_CHARACTERISTIC', 'length', 'max'=>20),
			array('C_PERSONNEL_AREA, C_PERSONNEL_SUBAREA', 'length', 'max'=>4),
			array('V_EMPLOYEE_GROUP, V_EMPLOYEE_SUBGROUP', 'length', 'max'=>25),
			array('C_JOB_CHARACTERISTIC, C_NILAI_BEHAVIOR, C_PAYROLL_AREA', 'length', 'max'=>2),
			array('N_JUMLAH_TUDAS, N_JUMLAH_GADAS', 'length', 'max'=>10),
			array('V_JENIS_KELAMIN, V_PAYROLL_AREA', 'length', 'max'=>45),
			array('C_KODE_PASUTRI, C_KODE_KK', 'length', 'max'=>1),
			array('D_TGL_LAHIR, D_TGL_POSISI, D_TGL_BANDPOSISI, D_TGL_PENSIUN, D_TGL_DIVISI, D_TGL_LOKER', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, N_TAHUN, N_BULAN, N_NIK, C_KODE_AGAMA, V_NAMA_AGAMA, V_NAMA_KARYAWAN, C_KODE_DIVISI, V_LONG_UNIT, V_SHORT_DIVISI, C_KODE_LOKER, V_SHORT_UNIT, OBJID_POSISI, C_KODE_POSISI, V_SHORT_POSISI, V_BAND_POSISI, V_KELAS_POSISI, C_GROUP_HOST, C_HOST, C_KODE_USIA, V_NAMA_USIA, C_PERSONNEL_AREA, V_PERSONNEL_AREA, C_PERSONNEL_SUBAREA, V_PERSONNEL_SUBAREA, C_EMPLOYEE_GROUP, V_EMPLOYEE_GROUP, C_EMPLOYEE_SUBGROUP, V_EMPLOYEE_SUBGROUP, C_LEVEL_PENDIDIKAN, V_LEVEL_PENDIDIKAN, V_JURUSAN_PENDIDIKAN, N_TAHUN_NKI, V_NKI, N_TAHUN_KOMPETENSI, V_KOMPETENSI, C_JOB_CHARACTERISTIC, V_JOB_CHARACTERISTIC, D_TGL_LAHIR, D_TGL_POSISI, D_TGL_BANDPOSISI, C_NILAI_BEHAVIOR, N_JUMLAH_TUDAS, N_JUMLAH_GADAS, V_JENIS_KELAMIN, C_KODE_PASUTRI, C_KODE_KK, C_PAYROLL_AREA, V_PAYROLL_AREA, D_TGL_PENSIUN, D_TGL_DIVISI, D_TGL_LOKER', 'safe', 'on'=>'search'),
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
			'ID' => 'ID',
			'N_TAHUN' => 'N Tahun',
			'N_BULAN' => 'N Bulan',
			'N_NIK' => 'N Nik',
			'C_KODE_AGAMA' => 'C Kode Agama',
			'V_NAMA_AGAMA' => 'V Nama Agama',
			'V_NAMA_KARYAWAN' => 'V Nama Karyawan',
			'C_KODE_DIVISI' => 'C Kode Divisi',
			'V_SHORT_DIVISI' => 'V Short Divisi',
			'C_KODE_LOKER' => 'C Kode Loker',
			'V_SHORT_UNIT' => 'V Short Unit',
			'OBJID_POSISI' => 'Objid Posisi',
			'C_KODE_POSISI' => 'C Kode Posisi',
			'V_SHORT_POSISI' => 'V Short Posisi',
			'V_BAND_POSISI' => 'V Band Posisi',
			'V_KELAS_POSISI' => 'V Kelas Posisi',
			'C_GROUP_HOST' => 'C Group Host',
			'C_HOST' => 'C Host',
			'C_KODE_USIA' => 'C Kode Usia',
			'V_NAMA_USIA' => 'V Nama Usia',
			'C_PERSONNEL_AREA' => 'C Personnel Area',
			'V_PERSONNEL_AREA' => 'V Personnel Area',
			'C_PERSONNEL_SUBAREA' => 'C Personnel Subarea',
			'V_PERSONNEL_SUBAREA' => 'V Personnel Subarea',
			'C_EMPLOYEE_GROUP' => 'C Employee Group',
			'V_EMPLOYEE_GROUP' => 'V Employee Group',
			'C_EMPLOYEE_SUBGROUP' => 'C Employee Subgroup',
			'V_EMPLOYEE_SUBGROUP' => 'V Employee Subgroup',
			'C_LEVEL_PENDIDIKAN' => 'C Level Pendidikan',
			'V_LEVEL_PENDIDIKAN' => 'V Level Pendidikan',
			'V_JURUSAN_PENDIDIKAN' => 'V Jurusan Pendidikan',
			'N_TAHUN_NKI' => 'N Tahun Nki',
			'V_NKI' => 'V Nki',
			'N_TAHUN_KOMPETENSI' => 'N Tahun Kompetensi',
			'V_KOMPETENSI' => 'V Kompetensi',
			'C_JOB_CHARACTERISTIC' => 'C Job Characteristic',
			'V_JOB_CHARACTERISTIC' => 'V Job Characteristic',
			'D_TGL_LAHIR' => 'D Tgl Lahir',
			'D_TGL_POSISI' => 'D Tgl Posisi',
			'D_TGL_BANDPOSISI' => 'D Tgl Bandposisi',
			'C_NILAI_BEHAVIOR' => 'C Nilai Behavior',
			'N_JUMLAH_TUDAS' => 'N Jumlah Tudas',
			'N_JUMLAH_GADAS' => 'N Jumlah Gadas',
			'V_JENIS_KELAMIN' => 'V Jenis Kelamin',
			'C_KODE_PASUTRI' => 'C Kode Pasutri',
			'C_KODE_KK' => 'C Kode Kk',
			'C_PAYROLL_AREA' => 'C Payroll Area',
			'V_PAYROLL_AREA' => 'V Payroll Area',
			'D_TGL_PENSIUN' => 'D Tgl Pensiun',
			'D_TGL_DIVISI' => 'D Tgl Divisi',
			'D_TGL_LOKER' => 'D Tgl Loker',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('N_TAHUN',$this->N_TAHUN);
		$criteria->compare('N_BULAN',$this->N_BULAN);
		$criteria->compare('N_NIK',$this->N_NIK,true);
		$criteria->compare('C_KODE_AGAMA',$this->C_KODE_AGAMA);
		$criteria->compare('V_NAMA_AGAMA',$this->V_NAMA_AGAMA,true);
		$criteria->compare('V_NAMA_KARYAWAN',$this->V_NAMA_KARYAWAN,true);
		$criteria->compare('C_KODE_DIVISI',$this->C_KODE_DIVISI,true);
		$criteria->compare('V_SHORT_DIVISI',$this->V_SHORT_DIVISI,true);
		$criteria->compare('C_KODE_LOKER',$this->C_KODE_LOKER,true);
		$criteria->compare('V_SHORT_UNIT',$this->V_SHORT_UNIT,true);
		$criteria->compare('OBJID_POSISI',$this->OBJID_POSISI);
		$criteria->compare('C_KODE_POSISI',$this->C_KODE_POSISI,true);
		$criteria->compare('V_SHORT_POSISI',$this->V_SHORT_POSISI,true);
		$criteria->compare('V_BAND_POSISI',$this->V_BAND_POSISI,true);
		$criteria->compare('V_KELAS_POSISI',$this->V_KELAS_POSISI,true);
		$criteria->compare('C_GROUP_HOST',$this->C_GROUP_HOST,true);
		$criteria->compare('C_HOST',$this->C_HOST,true);
		$criteria->compare('C_KODE_USIA',$this->C_KODE_USIA,true);
		$criteria->compare('V_NAMA_USIA',$this->V_NAMA_USIA,true);
		$criteria->compare('C_PERSONNEL_AREA',$this->C_PERSONNEL_AREA,true);
		$criteria->compare('V_PERSONNEL_AREA',$this->V_PERSONNEL_AREA,true);
		$criteria->compare('C_PERSONNEL_SUBAREA',$this->C_PERSONNEL_SUBAREA,true);
		$criteria->compare('V_PERSONNEL_SUBAREA',$this->V_PERSONNEL_SUBAREA,true);
		$criteria->compare('C_EMPLOYEE_GROUP',$this->C_EMPLOYEE_GROUP,true);
		$criteria->compare('V_EMPLOYEE_GROUP',$this->V_EMPLOYEE_GROUP,true);
		$criteria->compare('C_EMPLOYEE_SUBGROUP',$this->C_EMPLOYEE_SUBGROUP,true);
		$criteria->compare('V_EMPLOYEE_SUBGROUP',$this->V_EMPLOYEE_SUBGROUP,true);
		$criteria->compare('C_LEVEL_PENDIDIKAN',$this->C_LEVEL_PENDIDIKAN);
		$criteria->compare('V_LEVEL_PENDIDIKAN',$this->V_LEVEL_PENDIDIKAN,true);
		$criteria->compare('V_JURUSAN_PENDIDIKAN',$this->V_JURUSAN_PENDIDIKAN,true);
		$criteria->compare('N_TAHUN_NKI',$this->N_TAHUN_NKI);
		$criteria->compare('V_NKI',$this->V_NKI,true);
		$criteria->compare('N_TAHUN_KOMPETENSI',$this->N_TAHUN_KOMPETENSI);
		$criteria->compare('V_KOMPETENSI',$this->V_KOMPETENSI,true);
		$criteria->compare('C_JOB_CHARACTERISTIC',$this->C_JOB_CHARACTERISTIC,true);
		$criteria->compare('V_JOB_CHARACTERISTIC',$this->V_JOB_CHARACTERISTIC,true);
		$criteria->compare('D_TGL_LAHIR',$this->D_TGL_LAHIR,true);
		$criteria->compare('D_TGL_POSISI',$this->D_TGL_POSISI,true);
		$criteria->compare('D_TGL_BANDPOSISI',$this->D_TGL_BANDPOSISI,true);
		$criteria->compare('C_NILAI_BEHAVIOR',$this->C_NILAI_BEHAVIOR,true);
		$criteria->compare('N_JUMLAH_TUDAS',$this->N_JUMLAH_TUDAS,true);
		$criteria->compare('N_JUMLAH_GADAS',$this->N_JUMLAH_GADAS,true);
		$criteria->compare('V_JENIS_KELAMIN',$this->V_JENIS_KELAMIN,true);
		$criteria->compare('C_KODE_PASUTRI',$this->C_KODE_PASUTRI,true);
		$criteria->compare('C_KODE_KK',$this->C_KODE_KK,true);
		$criteria->compare('C_PAYROLL_AREA',$this->C_PAYROLL_AREA,true);
		$criteria->compare('V_PAYROLL_AREA',$this->V_PAYROLL_AREA,true);
		$criteria->compare('D_TGL_PENSIUN',$this->D_TGL_PENSIUN,true);
		$criteria->compare('D_TGL_DIVISI',$this->D_TGL_DIVISI,true);
		$criteria->compare('D_TGL_LOKER',$this->D_TGL_LOKER,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search_by_unit($unit)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->addInCondition('V_SHORT_UNIT', $unit);
		$criteria->compare('ID',$this->ID);
		$criteria->compare('N_TAHUN',$this->N_TAHUN);
		$criteria->compare('N_BULAN',$this->N_BULAN);
		$criteria->compare('N_NIK',$this->N_NIK,true);
		$criteria->compare('C_KODE_AGAMA',$this->C_KODE_AGAMA);
		$criteria->compare('V_NAMA_AGAMA',$this->V_NAMA_AGAMA,true);
		$criteria->compare('V_NAMA_KARYAWAN',$this->V_NAMA_KARYAWAN,true);
		$criteria->compare('C_KODE_DIVISI',$this->C_KODE_DIVISI,true);
		$criteria->compare('V_SHORT_DIVISI',$this->V_SHORT_DIVISI,true);
		$criteria->compare('C_KODE_LOKER',$this->C_KODE_LOKER,true);
		$criteria->compare('V_SHORT_UNIT',$this->V_SHORT_UNIT,true);
		$criteria->compare('OBJID_POSISI',$this->OBJID_POSISI);
		$criteria->compare('C_KODE_POSISI',$this->C_KODE_POSISI,true);
		$criteria->compare('V_SHORT_POSISI',$this->V_SHORT_POSISI,true);
		$criteria->compare('V_BAND_POSISI',$this->V_BAND_POSISI,true);
		$criteria->compare('V_KELAS_POSISI',$this->V_KELAS_POSISI,true);
		$criteria->compare('C_GROUP_HOST',$this->C_GROUP_HOST,true);
		$criteria->compare('C_HOST',$this->C_HOST,true);
		$criteria->compare('C_KODE_USIA',$this->C_KODE_USIA,true);
		$criteria->compare('V_NAMA_USIA',$this->V_NAMA_USIA,true);
		$criteria->compare('C_PERSONNEL_AREA',$this->C_PERSONNEL_AREA,true);
		$criteria->compare('V_PERSONNEL_AREA',$this->V_PERSONNEL_AREA,true);
		$criteria->compare('C_PERSONNEL_SUBAREA',$this->C_PERSONNEL_SUBAREA,true);
		$criteria->compare('V_PERSONNEL_SUBAREA',$this->V_PERSONNEL_SUBAREA,true);
		$criteria->compare('C_EMPLOYEE_GROUP',$this->C_EMPLOYEE_GROUP,true);
		$criteria->compare('V_EMPLOYEE_GROUP',$this->V_EMPLOYEE_GROUP,true);
		$criteria->compare('C_EMPLOYEE_SUBGROUP',$this->C_EMPLOYEE_SUBGROUP,true);
		$criteria->compare('V_EMPLOYEE_SUBGROUP',$this->V_EMPLOYEE_SUBGROUP,true);
		$criteria->compare('C_LEVEL_PENDIDIKAN',$this->C_LEVEL_PENDIDIKAN);
		$criteria->compare('V_LEVEL_PENDIDIKAN',$this->V_LEVEL_PENDIDIKAN,true);
		$criteria->compare('V_JURUSAN_PENDIDIKAN',$this->V_JURUSAN_PENDIDIKAN,true);
		$criteria->compare('N_TAHUN_NKI',$this->N_TAHUN_NKI);
		$criteria->compare('V_NKI',$this->V_NKI,true);
		$criteria->compare('N_TAHUN_KOMPETENSI',$this->N_TAHUN_KOMPETENSI);
		$criteria->compare('V_KOMPETENSI',$this->V_KOMPETENSI,true);
		$criteria->compare('C_JOB_CHARACTERISTIC',$this->C_JOB_CHARACTERISTIC,true);
		$criteria->compare('V_JOB_CHARACTERISTIC',$this->V_JOB_CHARACTERISTIC,true);
		$criteria->compare('D_TGL_LAHIR',$this->D_TGL_LAHIR,true);
		$criteria->compare('D_TGL_POSISI',$this->D_TGL_POSISI,true);
		$criteria->compare('D_TGL_BANDPOSISI',$this->D_TGL_BANDPOSISI,true);
		$criteria->compare('C_NILAI_BEHAVIOR',$this->C_NILAI_BEHAVIOR,true);
		$criteria->compare('N_JUMLAH_TUDAS',$this->N_JUMLAH_TUDAS,true);
		$criteria->compare('N_JUMLAH_GADAS',$this->N_JUMLAH_GADAS,true);
		$criteria->compare('V_JENIS_KELAMIN',$this->V_JENIS_KELAMIN,true);
		$criteria->compare('C_KODE_PASUTRI',$this->C_KODE_PASUTRI,true);
		$criteria->compare('C_KODE_KK',$this->C_KODE_KK,true);
		$criteria->compare('C_PAYROLL_AREA',$this->C_PAYROLL_AREA,true);
		$criteria->compare('V_PAYROLL_AREA',$this->V_PAYROLL_AREA,true);
		$criteria->compare('D_TGL_PENSIUN',$this->D_TGL_PENSIUN,true);
		$criteria->compare('D_TGL_DIVISI',$this->D_TGL_DIVISI,true);
		$criteria->compare('D_TGL_LOKER',$this->D_TGL_LOKER,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search_by_divisi($divisi)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->addInCondition('C_KODE_DIVISI', $divisi);
		$criteria->compare('ID',$this->ID);
		$criteria->compare('N_TAHUN',$this->N_TAHUN);
		$criteria->compare('N_BULAN',$this->N_BULAN);
		$criteria->compare('N_NIK',$this->N_NIK,true);
		$criteria->compare('C_KODE_AGAMA',$this->C_KODE_AGAMA);
		$criteria->compare('V_NAMA_AGAMA',$this->V_NAMA_AGAMA,true);
		$criteria->compare('V_NAMA_KARYAWAN',$this->V_NAMA_KARYAWAN,true);
		$criteria->compare('C_KODE_DIVISI',$this->C_KODE_DIVISI,true);
		$criteria->compare('V_SHORT_DIVISI',$this->V_SHORT_DIVISI,true);
		$criteria->compare('C_KODE_LOKER',$this->C_KODE_LOKER,true);
		$criteria->compare('V_SHORT_UNIT',$this->V_SHORT_UNIT,true);
		$criteria->compare('OBJID_POSISI',$this->OBJID_POSISI);
		$criteria->compare('C_KODE_POSISI',$this->C_KODE_POSISI,true);
		$criteria->compare('V_SHORT_POSISI',$this->V_SHORT_POSISI,true);
		$criteria->compare('V_BAND_POSISI',$this->V_BAND_POSISI,true);
		$criteria->compare('V_KELAS_POSISI',$this->V_KELAS_POSISI,true);
		$criteria->compare('C_GROUP_HOST',$this->C_GROUP_HOST,true);
		$criteria->compare('C_HOST',$this->C_HOST,true);
		$criteria->compare('C_KODE_USIA',$this->C_KODE_USIA,true);
		$criteria->compare('V_NAMA_USIA',$this->V_NAMA_USIA,true);
		$criteria->compare('C_PERSONNEL_AREA',$this->C_PERSONNEL_AREA,true);
		$criteria->compare('V_PERSONNEL_AREA',$this->V_PERSONNEL_AREA,true);
		$criteria->compare('C_PERSONNEL_SUBAREA',$this->C_PERSONNEL_SUBAREA,true);
		$criteria->compare('V_PERSONNEL_SUBAREA',$this->V_PERSONNEL_SUBAREA,true);
		$criteria->compare('C_EMPLOYEE_GROUP',$this->C_EMPLOYEE_GROUP,true);
		$criteria->compare('V_EMPLOYEE_GROUP',$this->V_EMPLOYEE_GROUP,true);
		$criteria->compare('C_EMPLOYEE_SUBGROUP',$this->C_EMPLOYEE_SUBGROUP,true);
		$criteria->compare('V_EMPLOYEE_SUBGROUP',$this->V_EMPLOYEE_SUBGROUP,true);
		$criteria->compare('C_LEVEL_PENDIDIKAN',$this->C_LEVEL_PENDIDIKAN);
		$criteria->compare('V_LEVEL_PENDIDIKAN',$this->V_LEVEL_PENDIDIKAN,true);
		$criteria->compare('V_JURUSAN_PENDIDIKAN',$this->V_JURUSAN_PENDIDIKAN,true);
		$criteria->compare('N_TAHUN_NKI',$this->N_TAHUN_NKI);
		$criteria->compare('V_NKI',$this->V_NKI,true);
		$criteria->compare('N_TAHUN_KOMPETENSI',$this->N_TAHUN_KOMPETENSI);
		$criteria->compare('V_KOMPETENSI',$this->V_KOMPETENSI,true);
		$criteria->compare('C_JOB_CHARACTERISTIC',$this->C_JOB_CHARACTERISTIC,true);
		$criteria->compare('V_JOB_CHARACTERISTIC',$this->V_JOB_CHARACTERISTIC,true);
		$criteria->compare('D_TGL_LAHIR',$this->D_TGL_LAHIR,true);
		$criteria->compare('D_TGL_POSISI',$this->D_TGL_POSISI,true);
		$criteria->compare('D_TGL_BANDPOSISI',$this->D_TGL_BANDPOSISI,true);
		$criteria->compare('C_NILAI_BEHAVIOR',$this->C_NILAI_BEHAVIOR,true);
		$criteria->compare('N_JUMLAH_TUDAS',$this->N_JUMLAH_TUDAS,true);
		$criteria->compare('N_JUMLAH_GADAS',$this->N_JUMLAH_GADAS,true);
		$criteria->compare('V_JENIS_KELAMIN',$this->V_JENIS_KELAMIN,true);
		$criteria->compare('C_KODE_PASUTRI',$this->C_KODE_PASUTRI,true);
		$criteria->compare('C_KODE_KK',$this->C_KODE_KK,true);
		$criteria->compare('C_PAYROLL_AREA',$this->C_PAYROLL_AREA,true);
		$criteria->compare('V_PAYROLL_AREA',$this->V_PAYROLL_AREA,true);
		$criteria->compare('D_TGL_PENSIUN',$this->D_TGL_PENSIUN,true);
		$criteria->compare('D_TGL_DIVISI',$this->D_TGL_DIVISI,true);
		$criteria->compare('D_TGL_LOKER',$this->D_TGL_LOKER,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
