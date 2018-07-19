<?php

/**
 * This is the model class for table "sys_x_user_role".
 *
 * The followings are the available columns in table 'sys_x_user_role':
 * @property integer $id
 * @property string $key_sys_user
 * @property string $key_sys_role
 * @property string $dstart
 * @property string $dend
 * @property string $ucrea
 * @property string $dcrea
 * @property string $icrea
 * @property string $uupd
 * @property string $dupd
 * @property string $iupd
 *
 * The followings are the available model relations:
 * @property SysMRole $keySysRole
 * @property SysMUser $keySysUser
 */
class UserRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserRole the static model class
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
		return 'sys_x_user_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key_sys_user, key_sys_role, ucrea, uupd', 'length', 'max'=>200),
			array('icrea, iupd', 'length', 'max'=>15),
			array('dstart, dend, dcrea, dupd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, key_sys_user, key_sys_role, dstart, dend, ucrea, dcrea, icrea, uupd, dupd, iupd', 'safe', 'on'=>'search'),
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
			'keySysRole' => array(self::BELONGS_TO, 'SysMRole', 'key_sys_role'),
			'keySysUser' => array(self::BELONGS_TO, 'SysMUser', 'key_sys_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'key_sys_user' => 'Key Sys User',
			'key_sys_role' => 'Key Sys Role',
			'dstart' => 'Dstart',
			'dend' => 'Dend',
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
		$criteria->compare('key_sys_user',$this->key_sys_user,true);
		$criteria->compare('key_sys_role',$this->key_sys_role,true);
		$criteria->compare('dstart',$this->dstart,true);
		$criteria->compare('dend',$this->dend,true);
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