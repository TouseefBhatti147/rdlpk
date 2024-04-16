<?php

/**
 * This is the model class for table "iknanow_users".
 *
 * The followings are the available columns in table 'iknanow_users':
 * @property integer $user_id
 * @property string $company
 * @property string $phone
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $status
 * @property integer $login_status
 * @property string $create_date
 * @property string $modify_date
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, membernumber, firstname, middelname, lastname, sodoeo, cnic, address, email, city, state, zip, country, username, password', 'required'),
			array('login_status', 'numerical', 'integerOnly'=>true),
			array('firstname','middelname', 'lastname', 'sodowo', 'username', 'length', 'max'=>255),
			array('email', 'length', 'max'=>100),
			array('name', 'length', 'max'=>150),
			array('password', 'length', 'max'=>50),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, id, membernumber, firstname, middelname, lastname, sodoeo, cnic, address, email, city, state, zip, country, username, password, password, status, login_status, create_date, modify_date', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'id' => 'id',
			'firstname' => 'firstname',
			'middelname' => 'middelname',
			'lastname' => 'lasstname',
			'sodowo' => 'sodowo',
			'cnic' => 'cnic',
			'address' => 'address',
			'email' => 'Email',
			'city' => 'city',
			'state' => 'state',
			'zip' => 'zip',
			'country' => 'country',
			'username' => 'Username',
			'password' => 'Password',
			'status' => 'Status',
			'login_status' => 'Login Status',
			'create_date' => 'Create Date',
			'modify_date' => 'Modify Date',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('id',$this->id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('middelname',$this->middelname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('sodowo',$this->sodowo,true);
		$criteria->compare('cnic',$this->cnic,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('login_status',$this->login_status);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_date',$this->modify_date,true);

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
