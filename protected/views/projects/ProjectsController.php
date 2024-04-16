<?php

class ProjectsController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionCreate()
	{
		
		$model=new projects;
		$error = '';
		
		if ((isset($_POST['project_name']) && empty($_POST['project_name'])) || (isset($_POST['teaser']) && empty($_POST['teaser'])) || (isset($_POST['project_details']) && empty($_POST['project_details'])))
		{
			$error = 'Please complete all required fields <br />';
		}
		
			$info = getimagesize($_FILES['project_image']['tmp_name']); 
			$type = $info[2];
			$random_digit= rand(0 ,3000);
						
			$newfilename = $random_digit . $_FILES["project_image"]["name"];
			move_uploaded_file($_FILES["project_image"]["tmp_name"],
      		'images/upload/'.$newfilename);
      					echo "Stored in: " . "upload/" . $newfilename;
	
		if(empty($error))
		{print_r($_POST);
				$model->project_name = mysql_real_escape_string($_POST['project_name']);
				$model->teaser = mysql_real_escape_string($_POST['teaser']);
				$model->details = mysql_real_escape_string($_POST['project_details']);
				$model->project_image = mysql_real_escape_string($newfilename);
				$model->create_date = date('Y-m-d h:i:s');
				
				try {
						$model->save();
			 			
					 $this->redirect(array("project_list"));	
		
					} catch (Exception $e) {
						echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
				
						  }
		
		
		else
		{
			
		}
			exit;
	}
	public function actionProject_list()
	{	
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM projects";
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('project_list',array('projects'=>$result_projects));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionUpdate_project()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM projects where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('update_project',array('update_project'=>$result_projects));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }
	
	public function actionDetail_project()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM projects where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('detail_project',array('detail_project'=>$result_projects));
		}
	  else{
		  $this->redirect (array('user/user'));
	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionDelete_project()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects_check = "SELECT * from plots where project_id=".$_GET['id'];
	$result_projects_check = $connection->createCommand($sql_projects_check)->queryAll();
	
	if (empty($result_projects_check)){
			 $connection = Yii::app()->db; 
			 $sql_projects_del = "DELETE from projects where id=".$_GET['id'];
			
			 
			 $command = $connection -> createCommand($sql_projects_del);
             $command -> execute();
			 $this->redirect (array('projects/project_list?error=0'));
		}
	else 
	{
		$this->redirect (array('projects/project_list?error=1'));
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
	   
			$random_digit= rand(0 ,3000);
			$target_path='images/upload';
		    $id=$_POST['id']; 
		   	 $target_path;
			 $teaser=$_POST['teaser'];
			 $details=$_POST['details'];
			 $project_image=$random_digit.$_FILES['project_image']["name"];
			 $create_date=$_POST['create_date'];
 			 
			 
			$info = getimagesize($_FILES['project_image']['tmp_name']); 
			$type = $info[2];
			
						
			$newfilename = $random_digit . $_FILES["project_image"]["name"];
			move_uploaded_file($_FILES["project_image"]["tmp_name"],
      		'images/upload/'.$newfilename);
      		echo "Stored in: " . "upload/" . $newfilename;
			
			$sql_update = "UPDATE projects SET teaser ='$teaser',details ='$details',project_image ='$project_image',create_date ='$create_date' WHERE id =".$id;
	
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("project_list"));	
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
	
	public function actionDashboard()
	{
		if(isset(Yii::app()->session['user_array']))
		{
			$error = '';
			$arr = array();
			$this->layout='column2';
			$entity_dataset =array();
			$document_data = $this->GetDocument(Yii::app()->session['user_array']['user_id']);
			$dataset=(json_decode($document_data));
			
			if(isset($dataset))
			{
				foreach($dataset->data as $data) {
				if(isset($data->entities))
				{
					foreach($data->entities as $entities) {
							$current = date("Y-m-d", strtotime($data->publishedDate));
							$mod_date = time() + ( 24 * 60 * 60);
			
							if(in_array($entities->disambiguated_name,$arr, true))
							{
								$arr_exist_at = array_search($entities->disambiguated_name, $arr);
								$counter_array = count($entity_dataset[$arr_exist_at]['values']);
								
								$dtt = date("Y-m-d",strtotime($data->publishedDate) );
								$entity_dataset[$arr_exist_at]['values'][$counter_array][0] = strtotime( $data->publishedDate )*1000;
								$entity_dataset[$arr_exist_at]['values'][$counter_array][1] = round( $entities->frequency ,2);
							}
								
							else {
								$arr[] = $entities->disambiguated_name;
								
								$dtt = date("Y-m-d",strtotime($data->publishedDate) );
								
								$entity_dataset[] =  array(
															'key' => $entities->disambiguated_name,
															'values' => array(
																			array( time() * 1000, 0),
																					array(
																							( strtotime( $data->publishedDate ) ) * 1000  , round((( $entities->doccount )),2))));
																						
							}
					} // END FOREACH - ENTITIES
				}
			
		}
			}else
			{
			   $entity_dataset = '';	
			}
			
			$dataset_array = $dataset->data;
			$this->render('dashboard',array('document_data'=>$dataset_array,'entity_data'=>$entity_dataset));
		}else
		{
			 $this->redirect(array('index'));
		}
		
	}
	
	
	
	public function actionProjects()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		
					
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
				$this->render('projects');
			
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
