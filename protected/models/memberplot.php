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
class memberplot extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'memberplot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, street_id, plot_id, plot_size, username, mem_code ', 'required'),
			array('cnic, mem_code, mobile', 'numerical', 'integerOnly'=>true),
			//array('username', 'length', 'max'=>255),
			//array('email', 'length', 'max'=>100),
			//array('username', 'length', 'max'=>150),
			//array('password', 'length', 'max'=>50),
			//array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('project_id, street_id, sodowo, cnic, mobile, address, plot_id, plot_size, username, mem_code', 'safe', 'on'=>'search'),
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
			'project_id' => 'Project ID',
			'street_id' => 'Street ID',
			'plot_id' => 'Plot_id',
			'plot_size' => 'Plot_size',
			'username' => 'Username',
			'address' => 'Address',
			'cnic' => 'CNIC',
			'mobile' => 'Mobile',
			'mem_code' => 'Mem Code',
			'sodowo' => 'SODOWO',		
			'create_date' => 'Create Date',
			'modify_date' => 'Modify Date',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('projects_id',$this->projects_id);
		$criteria->compare('street_id',$this->street_id,true);
		$criteria->compare('plot_id',$this->plot_id,true);
		$criteria->compare('plot_size',$this->plot_size,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('cnic',$this->cnic,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('mem_code',$this->mem_code,true);
		$criteria->compare('sodowo',$this->mobile,true);
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
