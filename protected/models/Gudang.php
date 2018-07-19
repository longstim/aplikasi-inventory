<?php

/**
 * This is the model class for table "inv_r_gudang".
 *
 * The followings are the available columns in table 'inv_r_gudang':
 * @property integer $id
 * @property string $nama
 * @property string $keterangan
 * @property string $ucrea
 * @property string $dcrea
 * @property string $icrea
 * @property string $uupd
 * @property string $dupd
 * @property string $iupd
 *
 * The followings are the available model relations:
 * @property InvXBarangGudang[] $invXBarangGudangs
 */
class Gudang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gudang the static model class
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
		return 'inv_r_gudang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama', 'required'),
			array('nama, ucrea, uupd', 'length', 'max'=>200),
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
			array('id, nama, keterangan, ucrea, dcrea, icrea, uupd, dupd, iupd', 'safe', 'on'=>'search'),
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
			'invXBarangGudangs' => array(self::HAS_MANY, 'InvXBarangGudang', 'id_gudang'),
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
		$criteria->compare('nama',$this->nama,true);
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
}