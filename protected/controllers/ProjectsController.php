<?php



class ProjectsController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	 
	public function actionSector()
	{
		
		if((Yii::app()->session['user_array']['per3']=='1')&& isset(Yii::app()->session['user_array']['username']))

		{
			$connection = Yii::app()->db; 
			$sql_projects = "SELECT * FROM projects";
			$result_projects = $connection->createCommand($sql_projects)->query();
			$sql_blocks = "SELECT * FROM blocks";
			$result_blocks = $connection->createCommand($sql_blocks)->query();
			$sql_sector = "SELECT sectors.*,p.project_name,b.block_name FROM sectors
			left join projects p on (project_id=p.id)
			left join blocks b on (sectors.block_id=b.id)
			";
			$result_sectors = $connection->createCommand($sql_sector)->query();
			$this->render('sector',array('projects'=>$result_projects,'sectors'=>$result_sectors,'blocks'=>$result_blocks));
			}
			else{
				$this->redirect(array('user/user'));
			}

		
	}
	public function actionAddsector()
	{ 
	if(Yii::app()->session['user_array']['per3']=='1')
		{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
			$error='';
			if ($_POST['project']==''){$error.='Please Select Project</br>';}
			if ($_POST['sectorname']==''){$error.='Please Enter Sector Name</br>';}
			if ($_POST['disc']==''){$error.='Please Enter Discription</br>';}
			if ($_POST['block_name']==''){$error.='Please Enter Block Name</br>';}
			$error;
			$connection = Yii::app()->db;  
			 $sql ="SELECT * from sectors where sector_name='".$_POST['sectorname']."' and project_id='".$_POST['project']."'and block_id='".$_POST['block_name']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();
			if(!empty($result_data)){
			$error.='Sector Already Exist on this location';
		}
		if(empty($error)){
		$sql  = "INSERT INTO sectors (project_id,sector_name,block_id,details) 
	VALUES ('".$_POST['project']."','".$_POST['sectorname']."','".$_POST['block_name']."','".$_POST['disc']."')";	 
					$command = $connection -> createCommand($sql);
                    $command -> execute();		
					echo 'Sector Added';
					exit;
					}
				    else if(!empty($error)){ 
 				    echo $error;
             } 	
		}
		}
	}
	public function actionDelete_sector()
	{

		if(Yii::app()->session['user_array']['per3']=='1')

			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects_check = "SELECT * from plots where sector=".$_GET['id'];

	$result_projects_check = $connection->createCommand($sql_projects_check)->queryAll();
	
	

	

	if (empty($result_projects_check)){

			 $connection = Yii::app()->db; 
			
			$sql_projects_del1 = "DELETE from sectors where id=".$_GET['id'];
			$command = $connection -> createCommand($sql_projects_del1);
            $command -> execute();
			 
			
			$this->redirect (array('projects/sector?error=0'));

		}

	else 

	{

		$this->redirect (array('projects/sector?error=1'));

	}

	

	

		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionUpdate_sector()
	{

		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	       $this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT sectors.*,p.project_name,p.id as projectid,b.id as blockid,b.block_name FROM sectors 
	left join projects p on (project_id=p.id)
	left join blocks b on (sectors.block_id=b.id)
	where sectors.id=".$_GET['id'];

	$result_projects = $connection->createCommand($sql_projects)->query();
		$this->render('update_sector',array('update_project'=>$result_projects));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionUpdate_sec()
    {

	$error='';
		$connection = Yii::app()->db;  
		 $sql ="SELECT * from sectors where sector_name='".$_POST['sector_name']."' and project_id='".$_POST['projectid']."'and block_id='".$_POST['blockid']."'"; 
	   $result_data = $connection->createCommand($sql)->queryRow();
	   if(!empty($result_data))
	   {
	   echo $error.='Sector Already Exist on this location';exit;
 		 }
   if(empty($error))
   			{
		      $connection = Yii::app()->db; 	 
			  $sql_update = "UPDATE sectors SET sector_name ='".$_POST['sector_name']."',details ='".$_POST['details']."' WHERE id =".$_POST['id'];
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("sector"));	
  			 }		

	   } 


	public function actionCreate()

	{

		if(Yii::app()->session['user_array']['per7']=='1')

			{

		

		$model=new projects;

		$error = '';

		

		if ((isset($_POST['project_name']) && empty($_POST['project_name'])) || (isset($_POST['teaser']) && empty($_POST['teaser'])) || (isset($_POST['project_details']) && empty($_POST['project_details'])))

		{

			$error = 'Please complete all required fields <br />';

		}

		
			 $image=time().$_FILES['map']["name"];
				$path= 'http://localhost'.Yii::app()->baseUrl.'/images/projects/'.$image;				
				 move_uploaded_file($_FILES["map"]["tmp_name"],'images/projects/'.$image);
				 
				 
			$info = getimagesize($_FILES['project_image']['tmp_name']); 

			$type = $info[2];

			$random_digit= rand(0 ,3000);

						

			$newfilename = $random_digit . $_FILES["project_image"]["name"];

			move_uploaded_file($_FILES["project_image"]["tmp_name"],

      		'images/upload/'.$newfilename);

      					//"Stored in: " . "upload/" . $newfilename;

	

		if(empty($error))

		{		$model->project_name = ($_POST['project_name']);

				$model->teaser = ($_POST['teaser']);
					
                                $model->url = ($_POST['url']);

				$model->details =($_POST['project_details']);
$model->status=($_POST['status']);

				$model->project_image =($newfilename);
				$model->map =($image);


				$model->create_date = date('Y-m-d h:i:s');
		try {

						$model->save();

			 			
					$this->redirect(array("project_list"));	

						//$note="Message";
				 
//			         $this->redirect(array('project_list','note'=>$note) );
			   

					} catch (Exception $e) {

						//echo 'Caught exception: ',  $e->getMessage(), "\n";

					}

				

						  }

		

		

			}

			exit;

	}

	public function actionProject_list()

	{	

	if(Yii::app()->session['user_array']['per7']=='1')

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

		if(Yii::app()->session['user_array']['per7']=='1')

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

		if(Yii::app()->session['user_array']['per7']=='1')

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

	       $connection = Yii::app()->db; 

			$sql = "SELECT * FROM projects where id=".$_POST['id'];

			$result = $connection->createCommand($sql)->queryRow();

			

			$random_digit= rand(0 ,3000);

			$target_path='images/upload';

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

      		'images/upload/'.$newfilename);	}

      		

			

			$sql_update = "UPDATE projects SET project_name ='$project_name',url ='".$_POST['url']."',status='".$_POST['status']."',teaser ='$teaser',details ='$details',project_image ='$project_image' WHERE id =".$id;

	

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

	



	

	public function actionProjects()

	{

		if(Yii::app()->session['user_array']['per7']=='1')

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
