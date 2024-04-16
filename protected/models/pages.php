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
class pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_type, content_type, description, teaser, detail_content ', 'required'),
			array('', 'numerical', 'integerOnly'=>true),
			//array('username', 'length', 'max'=>255),
			//array('email', 'length', 'max'=>100),
			//array('username', 'length', 'max'=>150),
			//array('password', 'length', 'max'=>50),
			//array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('page_type, content_type, description, teaser, detail_content', 'safe', 'on'=>'search'),
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
			'page_type' => 'page_type',
			'content_type' => 'content_type',
			'description' => 'description',
			'teaser' => 'teaser',
			'detail_content' => 'detail_content',		
			'create_date' => 'Create Date',
			'modify_date' => 'Modify Date',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('page_type',$this->page_type);
		$criteria->compare('content_type',$this->content_type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('teaser',$this->teaser,true);
		$criteria->compare('detail_content',$this->detail_content,true);
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
