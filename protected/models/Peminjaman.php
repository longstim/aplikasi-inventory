<?php

/**
 * This is the model class for table "inv_t_peminjaman".
 *
 * The followings are the available columns in table 'inv_t_peminjaman':
 * @property integer $id
 * @property string $tgl_peminjaman
 * @property string $tgl_pengembalian
 * @property integer $id_peminjaman_barang
 * @property integer $id_peminjaman_user
 * @property integer $jumlah
 * @property string $keterangan
 * @property string $status_approval
 * @property string $ucrea
 * @property string $dcrea
 * @property string $icrea
 * @property string $uupd
 * @property string $dupd
 * @property string $iupd
 *
 * The followings are the available model relations:
 * @property InvMBarang $idPeminjamanBarang
 * @property SysMUser $idPeminjamanUser
 */
class Peminjaman extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Peminjaman the static model class
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
		return 'inv_t_peminjaman';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tgl_peminjaman, tgl_pengembalian,  id_peminjaman_barang, id_peminjaman_user, jumlah,', 'required'),
			array('id_peminjaman_barang, id_peminjaman_user, jumlah', 'numerical', 'integerOnly'=>true),
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
			   'tgl_pengembalian',
			   'compare',
			   'compareAttribute'=>'tgl_peminjaman',
			   'operator'=>'>=', 
			   'message'=>'Tanggal Pengembalian harus lebih besar daripada tanggal peminjaman'),
			array(
				'jumlah',
				'checkjumlah'
			),
			array('id, tgl_peminjaman, tgl_pengembalian, id_peminjaman_barang, id_peminjaman_user, jumlah, keterangan, ucrea, dcrea, icrea, uupd, dupd, iupd',    'safe', 'on'=>'search'),
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
			'idPeminjamanBarang' => array(self::BELONGS_TO, 'InvMBarang', 'id_peminjaman_barang'),
			'idPeminjamanUser' => array(self::BELONGS_TO, 'SysMUser', 'id_peminjaman_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tgl_peminjaman' => 'Tgl Peminjaman',
			'tgl_pengembalian' => 'Tgl Pengembalian',
			'id_peminjaman_barang' => 'Id Peminjaman Barang',
			'id_peminjaman_user' => 'Id Peminjaman User',
			'jumlah' => 'Jumlah',
			'keterangan' => 'Keterangan',
			'status_approval'=> 'Status Approval',
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
		$criteria->compare('tgl_peminjaman',$this->tgl_peminjaman,true);
		$criteria->compare('tgl_pengembalian',$this->tgl_pengembalian,true);
		$criteria->compare('id_peminjaman_barang',$this->id_peminjaman_barang);
		$criteria->compare('id_peminjaman_user',$this->id_peminjaman_user);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('status_approval',$this->status_approval,true);
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
		$criteria->compare('tgl_peminjaman',$keyword,true,'OR');
		$criteria->compare('tgl_pengembalian',$keyword,true,'OR');
		$criteria->compare('id_peminjaman_barang',$keyword,true,'OR');
		$criteria->compare('id_peminjaman_user',$keyword,true,'OR');
		$criteria->compare('jumlah',$keyword,true,'OR');
		$criteria->compare('keterangan',$keyword,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function checkjumlah($attribute,$params)
	{
		$Barang = Barang::model()->findByPk($this->id_peminjaman_barang);

		if(!$this->hasErrors())
		{
			if($Barang->jumlah <= 0)
			{
				$this->addError('Jumlah','Barang tidak tersedia');
			}
			else if(($Barang->jumlah_baik) < ($this->jumlah))
			{
				$this->addError('Jumlah','Jumlah barang yang tersedia '.$Barang->jumlah_baik);
			}
			else if($this->jumlah<=0)
			{
				$this->addError('Jumlah','Jumlah barang yang dipinjam harus lebih besar dari 0');
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
}