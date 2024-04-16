<?php

class SizeController extends Controller
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
		if ((isset($_POST['size']) && empty($_POST['size'])))
		{
			$error = 'Please complete all required fields <br />';
		}
			
		
		if(empty($error))
		        {
				  
				$size =$_POST['size'];
				
			  
			  
				  $sql  = "INSERT INTO size_cat(size,code) VALUES('".$size."','".$_POST['code']."')";		
                $command = $connection -> createCommand($sql);
                $command -> execute();
				$note="Message";
				//$this->redirect(array('charges/charges_list','note'=>$note) );
				
				$this->redirect(array('size/size_list','note'=>$note));
				
				
				
				}
			}
		
		
		else
		{
				
				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
			
		
		}
			exit;
	}
	public function actionSize_list()
	{	
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db;
	$sql="SELECT * FROM size_cat"; 
	$result = $connection->createCommand($sql)->query();
	
	$this->render('size_list',array('size'=>$result));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	
	
	
	public function actionUpdate_size()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db;
			 
	$sql_projects = "SELECT * FROM size_cat where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('update_size',array('update_size'=>$result_projects));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }
	
	
	
	
	
	
	/////////////////////////// function for update project 


		public function actionUpdate_siz()
	     {
			 if(Yii::app()->session['user_array']['per3']=='1')
			{
		    $connection = Yii::app()->db;
	   
		    $id=$_POST['id']; 
		   
		
			 $size=$_POST['size'];
			
			
					
				 $sql_update = "UPDATE size_cat SET size ='$size',code='".$_POST['code']."' WHERE id =".$id;
	
    		 $command = $connection -> createCommand($sql_update);
              $command -> execute();
			  $this->redirect(array("size_list"));	
	   }
		 
		 else{
			 $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
		 }
		 }

	 function actionDelete_size()
	 {
		  if(Yii::app()->session['user_array']['per3']=='1')
			{
		
		  $connection = Yii::app()->db;
	  $sql  = "Delete from size_cat where id='".$_REQUEST['id']."'";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			
		 		 $this->redirect(array("size/size_list"));
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
	
	
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	
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
	
	
	
	public function actionSize()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		
					
			
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
			$connection = Yii::app()->db;
			
				$this->render('size');
			
			}
			else{
				$this->redirect(array('user/user'));
				
			}
			}
	}
	
	
	
	//////////////////////START: SIZES FOR PROPERTY/////////////////////////////////////
	public function actionCreate1()
	{	
	if(Yii::app()->session['user_array']['per3']=='1')
			{
		$error = '';
		 $connection = Yii::app()->db;
		if ((isset($_POST['size']) && empty($_POST['size'])))
		{
			$error = 'Please complete all required fields <br />';
		}	
		if(empty($error))
		        {		  
				$size =$_POST['size'];
			  $sql  = "INSERT INTO size_cat_prop(size,code,dimension) VALUES('".$size."','".$_POST['code']."','".$_POST['dimension']."')";		
                $command = $connection -> createCommand($sql);
                $command -> execute();
				$note="Message";
				//$this->redirect(array('charges/charges_list','note'=>$note) );		
				$this->redirect(array('size/size_list_property','note'=>$note));
				}
			}
		else
		{
			$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
			
		}
			exit;
	}
	public function actionSize_list_property()
	{	
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db;
	$sql="SELECT * FROM size_cat_prop"; 
	$result = $connection->createCommand($sql)->query();
	
	$this->render('size_list_property',array('size'=>$result));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionSize_property()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{
			$connection = Yii::app()->db;
			$this->render('size_property');			
			}
			else{
			$this->redirect(array('user/user'));				
			}
			}
	}
	/*public function actionSize_list_property()
	{	
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db;
	$sql="SELECT * FROM size_cat"; 
	$result = $connection->createCommand($sql)->query();
	
	$this->render('size_list_property',array('size'=>$result));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}*/
	
	 function actionDelete_size_prop()
	 {
		  if(Yii::app()->session['user_array']['per3']=='1')
			{
		
		  $connection = Yii::app()->db;
	  $sql  = "Delete from size_cat_prop where id='".$_REQUEST['id']."'";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			
		 		 $this->redirect(array("size/size_list_property"));
			}
			else{
				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
				
			}
		
	}
	
	public function actionUpdate_siz_prop()
	     {
		 if(Yii::app()->session['user_array']['per3']=='1')
			{
		    $connection = Yii::app()->db;	   
		    $id=$_POST['id']; 
		 $size=$_POST['size'];
		 $dimension=$_POST['dimension'];
			 $sql_update = "UPDATE size_cat_prop SET size ='$size',dimension ='$dimension',code='".$_POST['code']."' WHERE id =".$id;	
    		 $command = $connection -> createCommand($sql_update);
              $command -> execute();
			  $this->redirect(array("size_list_property"));	
	   }
		 
		 else{
			 $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
		 }
		 }

		
	public function actionUpdate_size_property()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db;
			 
	$sql_projects = "SELECT * FROM size_cat_prop where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('update_size_property',array('update_size'=>$result_projects));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }
	
	///////////////////////END: SIZES FOR PROPERTY///////////////////////////////////////
	 
	  
	
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
