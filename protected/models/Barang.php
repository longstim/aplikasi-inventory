<?php

/**
 * This is the model class for table "inv_m_barang".
 *
 * The followings are the available columns in table 'inv_m_barang':
 * @property integer $id
 * @property string $nama
 * @property integer $tipe
 * @property integer $jumlah
 * @property string $deskripsi
 * @property string $url_gambar
 * @property string $ucrea
 * @property string $dcrea
 * @property string $icrea
 * @property string $uupd
 * @property string $dupd
 * @property string $iupd
 *
 * The followings are the available model relations:
 * @property InvRTipe $tipe0
 * @property InvTPemasukan[] $invTPemasukans
 * @property InvTPeminjaman[] $invTPeminjamen
 * @property InvTPengeluaran[] $invTPengeluarans
 * @property InvXBarangGudang[] $invXBarangGudangs
 */
class Barang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Barang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inv_m_barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, tipe, jumlah', 'required'),
			array('nama','unique'),
			array('jumlah_baik,jumlah_buruk', 'my_required'),
			array('tipe, jumlah,jumlah_baik, jumlah_buruk', 'numerical', 'integerOnly'=>true),
			array('nama, ucrea, uupd', 'length', 'max'=>200),
			array('icrea, iupd', 'length', 'max'=>15),
			array('deskripsi, dcrea, dupd', 'safe'),
			array('ucrea','default',
              'value'=>Yii::app()->user->name,
              'setOnEmpty'=>false,'on'=>'insert'),
			array('dcrea','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
			array('icrea','default',
              'value'=>Yii::app()->request->userHostAddress,
              'setOnEmpty'=>false,'on'=>'insert'),
			array('uupd','default',
              'value'=>Yii::app()->user->name,
              'setOnEmpty'=>false,'on'=>'update'),
			array('dupd','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'update'),
			array('iupd','default',
              'value'=>Yii::app()->request->userHostAddress,
              'setOnEmpty'=>false,'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('url_gambar', 'file','types'=>'jpg, gif, png','allowEmpty'=>true),
			array('id, nama, tipe, jumlah, deskripsi, ucrea, dcrea, icrea, uupd, dupd, iupd', 'safe', 'on'=>'search'),
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
			'tipes' => array(self::BELONGS_TO, 'InvRTipe', 'tipe'),
			'invTPemasukans' => array(self::HAS_MANY, 'InvTPemasukan', 'id_pemasukan_barang'),
			'invTPeminjamen' => array(self::HAS_MANY, 'InvTPeminjaman', 'id_peminjaman_barang'),
			'invTPengeluarans' => array(self::HAS_MANY, 'InvTPengeluaran', 'id_pengeluaran_barang'),
			'invXBarangGudangs' => array(self::HAS_MANY, 'InvXBarangGudang', 'id_barang'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Nama',
			'tipe' => 'Tipe',
			'jumlah' => 'Jumlah',
			'jumlah_baik'=>'Jumlah Baik',
			'jumlah_buruk'=>'Jumlah Buruk',
			'deskripsi' => 'Deskripsi',
			'url_gambar' => 'Url Gambar',
			'ucrea' => 'Ucrea',
			'dcrea' => 'Dcrea',
			'icrea' => 'Icrea',
			'uupd' => 'Uupd',
			'dupd' => 'Dupd',
			'iupd' => 'Iupd',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tipe',$this->tipe);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('jumlah_baik',$this->jumlah_baik);
		$criteria->compare('jumlah_buruk',$this->jumlah_baik);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('url_gambar',$this->deskripsi,true);
		$criteria->compare('ucrea',$this->ucrea,true);
		$criteria->compare('dcrea',$this->dcrea,true);
		$criteria->compare('icrea',$this->icrea,true);
		$criteria->compare('uupd',$this->uupd,true);
		$criteria->compare('dupd',$this->dupd,true);
		$criteria->compare('iupd',$this->iupd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function listTipe($id)
	{
		$tipe = Tipe::model()->findByPk($id);

		return $tipe->tipe;
	}

	public function cari($keyword='')
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$keyword,true,'OR');
		$criteria->compare('nama',$keyword,true,'OR');
		$criteria->compare('tipe',$keyword,true,'OR');
		$criteria->compare('jumlah',$keyword,true,'OR');
		$criteria->compare('deskripsi',$keyword,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function cariNamaBarang($keyword='')
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		$criteria->compare('nama',$keyword,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function my_required($attribute, $params)
	{
		if(!$this->hasErrors())
		{
			if ($this->jumlah_baik<=0 && $this->jumlah_buruk<=0)
			{
				$this->addError('jumlah', 'Isi jumlah barang dengan benar.');
			}
			if ($this->jumlah_baik<0 || $this->jumlah_buruk<0)
			{
				$this->addError('jumlah', 'Isi jumlah barang dengan benar.');
			}
		}
	}
}