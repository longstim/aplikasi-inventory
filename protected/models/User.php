<?php

/**
 * This is the model class for table "sys_m_user".
 *
 * The followings are the available columns in table 'sys_m_user':
 * @property integer $id
 * @property string $nkey
 * @property string $nickname
 * @property string $password
 * @property string $email
 * @property integer $id_sys_user_role
 * @property integer $profile
 * @property integer $imap_server
 * @property string $imap_user
 * @property string $imap_host
 * @property string $ucrea
 * @property string $dcrea
 * @property string $icrea
 * @property string $uupd
 * @property string $dupd
 * @property string $iupd
 *
 * The followings are the available model relations:
 * @property InvTPeminjaman[] $invTPeminjamen
 * @property SysXUserRole[] $sysXUserRoles
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'sys_m_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nkey, password', 'required'),
			array('nkey','unique'),
			array('id_sys_user_role, profile, imap_server', 'numerical', 'integerOnly'=>true),
			array('nkey, nickname, email, imap_user, imap_host, ucrea, uupd', 'length', 'max'=>200),
			array('password', 'length', 'max'=>100),
			array('icrea, iupd', 'length', 'max'=>15),
			array('dcrea, dupd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nkey, nickname, password, email, id_sys_user_role, profile, imap_server, imap_user, imap_host, ucrea, dcrea, icrea, uupd, dupd, iupd', 'safe', 'on'=>'search'),
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
			'invTPeminjamen' => array(self::HAS_MANY, 'InvTPeminjaman', 'id_peminjaman_user'),
			'sysXUserRoles' => array(self::HAS_MANY, 'SysXUserRole', 'key_sys_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nkey' => 'Nkey',
			'nickname' => 'Nickname',
			'password' => 'Password',
			'email' => 'Email',
			'id_sys_user_role' => 'Id Sys User Role',
			'profile' => 'Profile',
			'imap_server' => 'Imap Server',
			'imap_user' => 'Imap User',
			'imap_host' => 'Imap Host',
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
		$criteria->compare('nkey',$this->nkey,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sys_user_role',$this->id_sys_user_role);
		$criteria->compare('profile',$this->profile);
		$criteria->compare('imap_server',$this->imap_server);
		$criteria->compare('imap_user',$this->imap_user,true);
		$criteria->compare('imap_host',$this->imap_host,true);
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