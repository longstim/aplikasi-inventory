<?php

/**
 * This is the model class for table "inv_t_pemasukan".
 *
 * The followings are the available columns in table 'inv_t_pemasukan':
 * @property integer $id
 * @property string $tgl_pemasukan
 * @property integer $id_pemasukan_barang
 * @property string $harga
 * @property integer $jumlah
 * @property string $keterangan
 * @property string $ucrea
 * @property string $dcrea
 * @property string $icrea
 * @property string $uupd
 * @property string $dupd
 * @property string $iupd
 *
 * The followings are the available model relations:
 * @property InvMBarang $idPemasukanBarang
 */
class Pemasukan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pemasukan the static model class
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
		return 'inv_t_pemasukan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tgl_pemasukan, id_pemasukan_barang, id_pemasukan_gudang, harga, jumlah', 'required'),
			array('id_pemasukan_barang, id_pemasukan_gudang, jumlah', 'numerical', 'integerOnly'=>true),
			array('harga', 'length', 'max'=>11),
			array('harga', 'type', 'type'=>'float'),
			array('ucrea, uupd', 'length', 'max'=>200),
			array('icrea, iupd', 'length', 'max'=>15),
			array('keterangan, dcrea, dupd', 'safe'),
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
			array('id, tgl_pemasukan, id_pemasukan_barang, id_pemasukan_gudang, harga, jumlah, keterangan, ucrea, dcrea, icrea, uupd, dupd, iupd', 'safe', 'on'=>'search'),
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
			'idPemasukanBarang' => array(self::BELONGS_TO, 'Barang', 'id_pemasukan_barang'),
			'idPemasukanUser' => array(self::BELONGS_TO, 'User', 'id_pemasukan_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tgl_pemasukan' => 'Tgl Pemasukan',
			'id_pemasukan_barang' => 'Id Pemasukan Barang',
			'id_pemasukan_gudang' => 'Id Pemasukan Gudang',
			'harga' => 'Harga',
			'jumlah' => 'Jumlah',
			'keterangan' => 'Keterangan',
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
		$criteria->compare('tgl_pemasukan',$this->tgl_pemasukan,true);
		$criteria->compare('id_pemasukan_barang',$this->id_pemasukan_barang);
		$criteria->compare('id_pemasukan_gudang',$this->id_pemasukan_gudang);
		$criteria->compare('harga',$this->harga,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('keterangan',$this->keterangan,true);
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

	
	public function cari($keyword='')
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$keyword,true,'OR');
		$criteria->compare('tgl_pemasukan',$keyword,true,'OR');
		$criteria->compare('id_pemasukan_barang',$keyword,true,'OR');
		$criteria->compare('id_pemasukan_gudang',$keyword,true,'OR');
		$criteria->compare('harga',$keyword,true,'OR');
		$criteria->compare('jumlah',$keyword,true,'OR');
		$criteria->compare('keterangan',$keyword,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function userList($id)
	{
		$user = User::model()->findByPk($id);

		return $user->nickname;
	}

	public function barangList($id)
	{
		$barang = Barang::model()->findByPk($id);

		return $barang->nama;
	}

	public function gudangList($id)
	{
		$gudang = Gudang::model()->findByPk($id);

		return $gudang->nama;
	}

}