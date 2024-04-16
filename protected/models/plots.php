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
class Plots extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plots';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' id, project_id, street_id', 'required'),
			array('id', 'length', 'max'=>50),
			array('project_id', 'length', 'max'=>50),
			//array('username', 'length', 'max'=>150),
			array('street_id', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('plot_id, street_id, project_id, plot_detail_address, plot_size, create_date, modify_date', 'safe', 'on'=>'search'),
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
			'plot_id' => 'Plot ID',
			//'company' => 'Company',
			'project_id' => 'Project ID',
			//'name' => 'Name',
			'Street_id' => 'Street ID',
			'plot_detail_address' => 'Plot_detail_address',
			'plot_size' => 'Plot Size',
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

		$criteria->compare('plot_id',$this->plot_id);
		//criteria->compare('company',$this->company,true);
		$criteria->compare('project_id',$this->project_id,true);
		//$criteria->compare('name',$this->name,true);
		$criteria->compare('street_id',$this->street_id,true);
		$criteria->compare('plot_detail_address',$this->plot_detail_address,true);
		$criteria->compare('plot_size',$this->plot_size,true);
		
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
