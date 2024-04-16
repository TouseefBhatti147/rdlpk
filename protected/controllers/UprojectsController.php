<?php

class UprojectsController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionCreate(){
	if(Yii::app()->session['user_array']['per7']=='1')

			{
		 $connection = Yii::app()->db;
		$error = '';
		
			$newfilename =  $_FILES["project_image"]["name"];
			   move_uploaded_file($_FILES["project_image"]["tmp_name"],'images/uprojects/'.$newfilename);
			    
				$project_name =($_POST['project_name']);
				$teaser =($_POST['teaser']);
				$project_details =($_POST['project_details']);
				$date =date('Y-m-d');
				
                $sql  = "INSERT INTO uprojects(project_name,teaser,details,project_image,status,create_date) VALUES('".$project_name."','".$teaser."','".$project_details."','".$_FILES["project_image"]['name']."','".$_POST['status']."','".$date."')";		
                $command = $connection -> createCommand($sql);
                $command -> execute();
					$this->redirect(array("uproject_list"));	

		
			}

	}
	public function actionUproject_list()
	{	
	if(Yii::app()->session['user_array']['per7']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM uprojects";
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('uproject_list',array('projects'=>$result_projects));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionUpdate_uproject()
	{
		if(Yii::app()->session['user_array']['per7']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM uprojects where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('update_uproject',array('update_project'=>$result_projects));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }
	
	public function actionDetail_uproject()
	{
		if(Yii::app()->session['user_array']['per7']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM uprojects where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('detail_uproject',array('detail_project'=>$result_projects));
		}
	  else{
		  $this->redirect (array('user/user'));
	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionDelete_uproject()
	{
		if(Yii::app()->session['user_array']['per7']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects_check = "SELECT * from plots where project_id=".$_GET['id'];
	$result_projects_check = $connection->createCommand($sql_projects_check)->queryAll();
	
	if (empty($result_projects_check)){
			 $connection = Yii::app()->db; 
			 $sql_projects_del = "DELETE from uprojects where id=".$_GET['id'];
			
			 
			 $command = $connection -> createCommand($sql_projects_del);
             $command -> execute();
			 $this->redirect (array('uprojects/uproject_list?error=0'));
		}
	else 
	{
		$this->redirect (array('uprojects/project_list?error=1'));
	}
	
	
		}
	  else{
		  $this->redirect (array('user/user'));
	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	
	
	
	
	/////////////////////////// function for update project 


		public function actionUpdate_proj()
	     {
		 $connection = Yii::app()->db;
	       $connection = Yii::app()->db; 
			$sql = "SELECT * FROM uprojects where id=".$_POST['id'];
			$result = $connection->createCommand($sql)->queryRow();
			
			$random_digit= rand(0 ,3000);
			$target_path='images/uprojects';
		    $id=$_POST['id']; 
		   	 $target_path;
			 $teaser=$_POST['teaser'];
			
			 $details=$_POST['details'];
			 $project_name=$_POST['project_name'];
			 if ($_FILES['project_image']["name"]==''){
				
				$project_image=$result['project_image'];
				}else{ 
			//echo  $project_image=$_POST['project_image']; exit;
			 $project_image=$random_digit.$_FILES['project_image']["name"];
			
 			 $info = getimagesize($_FILES['project_image']['tmp_name']); 
			$type = $info[2];
			
						
			$newfilename = $random_digit . $_FILES["project_image"]["name"];
			move_uploaded_file($_FILES["project_image"]["tmp_name"],
      		'images/uprojects/'.$newfilename);	}
      		
			
			$sql_update = "UPDATE uprojects SET project_name ='$project_name',teaser ='$teaser',details ='$details',status='".$_POST['status']."',project_image ='$project_image' WHERE id =".$id;
	
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("uprojects/uproject_list"));	
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
	

	
	public function actionUprojects()
	{
		if(Yii::app()->session['user_array']['per7']=='1')
			{
		
					
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
				$this->render('uprojects');
			
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
