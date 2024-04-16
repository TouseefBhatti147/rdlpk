<?php

class ChargesController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionCreate()
	{
		
		
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		$error = '';
		 $connection = Yii::app()->db;
		if ((isset($_POST['name']) && empty($_POST['name'])) || (isset($_POST['note']) && empty($_POST['note'])))
		{
			$error = 'Please complete all required fields <br />';
		}
			
		
		if(empty($error))
		        {
				  
				$name = mysql_real_escape_string($_POST['name']);
				
			    $note = mysql_real_escape_string($_POST['note']);
			    $monthly = mysql_real_escape_string($_POST['monthly']);
			    $total = mysql_real_escape_string($_POST['total']);
			  
				  
                $sql  = "INSERT INTO charges(name,note,monthly,total) VALUES('".$name."','".$note."','".$monthly."','".$total."')";		
                $command = $connection -> createCommand($sql);
                $command -> execute();
				$this->redirect(array('charges/charges_list'));
				
				
				}
			}
		
		
		else
		{
				
				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
			
		
		}
			exit;
	}
	public function actionCharges_list()
	{	
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM charges";
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('charges_list',array('charges'=>$result_projects));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionUpdate_charges()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM charges where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('update_charges',array('update_charges'=>$result_projects));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }
	
	
	
	
	
	
	/////////////////////////// function for update project 


		public function actionUpdate_charg()
	     {
			 if(Yii::app()->session['user_array']['per3']=='1')
			{
		    $connection = Yii::app()->db;
	   
		    $id=$_POST['id']; 
		   
		
			 $name=$_POST['name'];
			
			 $note=$_POST['note'];
			 $monthly=$_POST['monthly'];
			 $total=$_POST['total'];
					
				 $sql_update = "UPDATE charges SET name ='$name',note ='$note',monthly ='$monthly',total ='$total' WHERE id =".$id;
	
    		 $command = $connection -> createCommand($sql_update);
              $command -> execute();
			  $this->redirect(array("charges_list"));	
	   }
		 
		 else{
			 $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
		 }
		 }

	 function actionDelete_charges()
	 {
		  if(Yii::app()->session['user_array']['per3']=='1')
			{
		
		  $connection = Yii::app()->db;
	  $sql  = "Delete from charges where id='".$_REQUEST['id']."'";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			
		 		 $this->redirect(array("charges/charges_list"));
			}
			else{
				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
				
			}
		
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 function actionEdit()
	 {
		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{
			$this->layout='column3';
			$this->render('edit_register');
		}
		 
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
	

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{
			 $this->redirect(array('datasource'));
		}else
		{
			$error = '';
			$layout='//layouts/column1';
			$this->render('index');
		}
	}
	
	
	
	public function actionCharges()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		
					
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
				$this->render('charges');
			
			}
			else{
				$this->redirect(array('user/user'));
				
			}
			}
	}
	
	
	
	 
	  
	
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
