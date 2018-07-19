<?php

/**
 * This is the model class for table "inv_x_barang_gudang".
 *
 * The followings are the available columns in table 'inv_x_barang_gudang':
 * @property integer $id
 * @property integer $id_barang
 * @property integer $id_gudang
 * @property string $ucrea
 * @property string $dcrea
 * @property string $icrea
 * @property string $uupd
 * @property string $dupd
 * @property string $iupd
 *
 * The followings are the available model relations:
 * @property InvMBarang $idBarang
 * @property InvRGudang $idGudang
 */
class BarangGudang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BarangGudang the static model class
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
		return 'inv_x_barang_gudang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_barang, id_gudang', 'required'),
			array('id_barang, id_gudang', 'numerical', 'integerOnly'=>true),
			array('ucrea, uupd', 'length', 'max'=>200),
			array('icrea, iupd', 'length', 'max'=>15),
			array('dcrea, dupd', 'safe'),
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
			array('id, id_barang, id_gudang, ucrea, dcrea, icrea, uupd, dupd, iupd', 'safe', 'on'=>'search'),
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
			'idBarang' => array(self::BELONGS_TO, 'InvMBarang', 'id_barang'),
			'idGudang' => array(self::BELONGS_TO, 'InvRGudang', 'id_gudang'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_barang' => 'Id Barang',
			'id_gudang' => 'Id Gudang',
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
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('id_gudang',$this->id_gudang);
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

	public function barangList($id)
	{
		$barang = Barang::model()->findByPk($id);

		return $barang->nama;
	}
}