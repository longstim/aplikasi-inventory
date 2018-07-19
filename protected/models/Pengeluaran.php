<?php

/**
 * This is the model class for table "inv_t_pengeluaran".
 *
 * The followings are the available columns in table 'inv_t_pengeluaran':
 * @property integer $id
 * @property string $tgl_pengeluaran
 * @property integer $id_pengeluaran_barang
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
 * @property InvMBarang $idPengeluaranBarang
 */
class Pengeluaran extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pengeluaran the static model class
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
		return 'inv_t_pengeluaran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tgl_pengeluaran, id_pengeluaran_barang,id_pengeluaran_gudang, jumlah', 'required'),
			array('id_pengeluaran_barang, id_pengeluaran_gudang, jumlah', 'numerical', 'integerOnly'=>true),
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
			array(
				'jumlah',
				'checkjumlah'
			),
			array('id, tgl_pengeluaran, id_pengeluaran_barang, id_pengeluaran_gudang, jumlah, keterangan, ucrea, dcrea, icrea, uupd, dupd, iupd', 'safe', 'on'=>'search'),
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
			'idPengeluaranBarang' => array(self::BELONGS_TO, 'InvMBarang', 'id_pengeluaran_barang'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tgl_pengeluaran' => 'Tgl Pengeluaran',
			'id_pengeluaran_barang' => 'Id Pengeluaran Barang',
			'id_pengeluaran_gudang' => 'Id Pengeluaran Gudang',
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
		$criteria->compare('tgl_pengeluaran',$this->tgl_pengeluaran,true);
		$criteria->compare('id_pengeluaran_barang',$this->id_pengeluaran_barang);
		$criteria->compare('id_pengeluaran_gudang',$this->id_pengeluaran_gudang);
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
		$criteria->compare('tgl_pengeluaran',$keyword,true,'OR');
		$criteria->compare('id_pengeluaran_barang',$keyword,true,'OR');
		$criteria->compare('id_pengeluaran_gudang',$keyword,true,'OR');
		$criteria->compare('jumlah',$keyword,true,'OR');
		$criteria->compare('keterangan',$keyword,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function checkjumlah($attribute,$params)
	{
		$Barang = BarangGudang::model()->findByAttributes(array('id_barang'=>$this->id_pengeluaran_barang,'id_gudang'=>$this->id_pengeluaran_gudang));

		if(!$this->hasErrors())
		{
			if($Barang->jumlah <= 0)
			{
				$this->addError('Jumlah','Barang tidak tersedia');
			}
			else if(($Barang->jumlah) < ($this->jumlah))
			{
				$this->addError('Jumlah','Jumlah barang yang tersedia '.$Barang->jumlah);
			}
		}
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