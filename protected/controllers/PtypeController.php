<?php
class PtypeController extends Controller
{
	public function actionCreate()
	{
	if(Yii::app()->session['user_array']['per10']=='1')
	{
	$model=new ptype;

		$error = '';
		if ((isset($_POST['project_name']) && empty($_POST['project_name'])) || (isset($_POST['project_code']) && empty($_POST['project_code'])) || (isset($_POST['teaser']) && empty($_POST['teaser'])) || (isset($_POST['project_details']) && empty($_POST['project_details'])))
		{
			$error = 'Please complete all required fields <br />';
		}
			$info = getimagesize($_FILES['project_image']['tmp_name']); 

			$type = $info[2];

			$random_digit= rand(0 ,3000);
			$newfilename = $random_digit . $_FILES["project_image"]["name"];

			move_uploaded_file($_FILES["project_image"]["tmp_name"],

      		'images/upload/ptype/'.$newfilename);
			
			$random_digit1= rand(3000 ,6000);
			
			$newfilename1 = $random_digit1 . $_FILES["project_icon"]["name"];

			move_uploaded_file($_FILES["project_icon"]["tmp_name"],

      		'images/upload/ptype/'.$newfilename1);

      					//"Stored in: " . "upload/" . $newfilename;

	

		if(empty($error))

		{		$model->project_name = ($_POST['project_name']);
				
				$model->code = ($_POST['project_code']);

				$model->teaser = ($_POST['teaser']);

				$model->details =($_POST['project_details']);

				$model->project_image =($newfilename);
				
				$model->icon =($newfilename1);

				$model->create_date = date('Y-m-d h:i:s');
		try {

						$model->save();

			 			
					$this->redirect(array("ptype_list"));	

						//$note="Message";
				 
//			         $this->redirect(array('project_list','note'=>$note) );
			   

					} catch (Exception $e) {

						//echo 'Caught exception: ',  $e->getMessage(), "\n";

					}

				

						  }

		

		

			}

			exit;

	}

	public function actionProject_content()

	{	

	if(Yii::app()->session['user_array']['per10']=='1')
		{
			$id=$_POST['proid'];
			$random_digit= rand(0 ,3000);
			$newfilename = $random_digit . $_FILES["images"]["name"];
			move_uploaded_file($_FILES["images"]["tmp_name"],
      		'images/upload/prodetail/'.$newfilename);
			$random_digit1= rand(3000 ,6000);
			$newfilename1 = $random_digit1 . $_FILES["icon"]["name"];
			move_uploaded_file($_FILES["icon"]["tmp_name"],
      		'images/upload/prodetail/'.$newfilename1);
			 $connection = Yii::app()->db;
			$sql_update = "INSERT into projectdetail SET heading ='".$_POST['heading']."',details ='".$_POST['details']."',icon ='".$newfilename1."',images ='".$newfilename."', project_id ='".$id."'";
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			
			 $this->redirect (array('update_project?id='.$id));
		}else{$this->redirect (array('user/user'));}
		}
	public function actionPtype_list()

	{	

	if(Yii::app()->session['user_array']['per10']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM ptype";

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('ptype_list',array('projects'=>$result_projects));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_ptype()

	{

		if(Yii::app()->session['user_array']['per10']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM ptype where id=".$_GET['id'];

	$result_projects = $connection->createCommand($sql_projects)->query();
	
	$sql_projects1 = "SELECT * FROM ptypedetail where project_id=".$_GET['id'];

	$result_projects1 = $connection->createCommand($sql_projects1)->queryall();

	$this->render('update_ptype',array('update_project'=>$result_projects,'project_detail'=>$result_projects1));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	public function actionDetail_ptype()

	{

		if(Yii::app()->session['user_array']['per10']=='1')

			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM ptype where id=".$_GET['id'];

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('detail_ptype',array('detail_project'=>$result_projects));

		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionDelete_ptype()

	{

		if(Yii::app()->session['user_array']['per10']=='1')

			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects_check = "SELECT * from property where ptype=".$_GET['id'];

	$result_projects_check = $connection->createCommand($sql_projects_check)->queryAll();
	
	

	

	if (empty($result_projects_check)){

			 $connection = Yii::app()->db; 
			$sql= "SELECT * from ptype where id=".$_GET['id'];
			$result= $connection->createCommand($sql)->queryRow();
			
			unlink('images/upload/ptype/'.$result['project_image']);
			unlink('images/upload/ptype/'.$result['icon']);
			
			$sql1= "SELECT * from ptypedetail where project_id=".$_GET['id'];
			$result1= $connection->createCommand($sql1)->queryAll();
			foreach($result1 as $row){
			if($row['images']!==''){unlink('images/upload/prodetail/'.$row['images']);}
			if($row['icon']!==''){unlink('images/upload/prodetail/'.$row['icon']);}
			}
			
			$sql_projects_del1 = "DELETE from ptypedetail where project_id=".$_GET['id'];
			$command = $connection -> createCommand($sql_projects_del1);
            $command -> execute();
			 
			$sql_projects_del = "DELETE from ptype where id=".$_GET['id'];
			$command = $connection -> createCommand($sql_projects_del);
            $command -> execute();

			$this->redirect (array('ptype/ptype_list?error=0'));

		}

	else 

	{

		$this->redirect (array('ptype/ptype_list?error=1'));

	}

	

	

		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	
	
	public function actionDeletedetail()

	{

		if(Yii::app()->session['user_array']['per10']=='1')

			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

	
			 $connection = Yii::app()->db; 
			
			$sql1= "SELECT * from projectdetail where id=".$_GET['id'];
			$result1= $connection->createCommand($sql1)->queryAll();
			foreach($result1 as $row){
			if($row['images']!==''){unlink('images/upload/prodetail/'.$row['images']);}
			if($row['icon']!==''){unlink('images/upload/prodetail/'.$row['icon']);}
			}
			
			$sql_projects_del1 = "DELETE from projectdetail where id=".$_GET['id'];
			$command = $connection -> createCommand($sql_projects_del1);
            $command -> execute();
			 
			
			$this->redirect (array('projects/update_project?id='.$_GET['pid']));

		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	public function actionUpdate_proj()

	     {

		

	       $connection = Yii::app()->db; 

			$sql = "SELECT * FROM ptype where id=".$_POST['id'];

			$result = $connection->createCommand($sql)->queryRow();
			$random_digit= rand(0 ,3000);
			$random_digit1= rand(3000 ,6000);
			$target_path='images/upload/ptype';
		    $id=$_POST['id']; 
		   	 $target_path;
			 $teaser=$_POST['teaser'];
			 $details=$_POST['details'];
			 $project_name=$_POST['project_name'];
			 if ($_FILES['project_image']["name"]==''){
				$project_image=$result['project_image'];
				}else{ 
			unlink('images/upload/ptype/'.$result['project_image']); 	
			 $project_image=$random_digit.$_FILES['project_image']["name"];
			$info = getimagesize($_FILES['project_image']['tmp_name']); 
			$type = $info[2];
			$newfilename = $random_digit . $_FILES["project_image"]["name"];
			move_uploaded_file($_FILES["project_image"]["tmp_name"],
      		'images/upload/ptype/'.$newfilename);	}
			if ($_FILES['project_icon']["name"]==''){
				$project_icon=$result['icon'];
				}else{
			unlink('images/upload/ptype/'.$result['icon']); 
			 $project_icon=$random_digit1.$_FILES['project_icon']["name"];
			$info = getimagesize($_FILES['project_icon']['tmp_name']); 
			$type = $info[2];
			$newfilename = $random_digit1 . $_FILES["project_icon"]["name"];
			move_uploaded_file($_FILES["project_icon"]["tmp_name"],
      		'images/upload/ptype/'.$newfilename);	}
			 
			$sql_update = "UPDATE ptype SET project_name ='$project_name',code ='".$_POST['project_code']."',teaser ='$teaser',details ='$details',project_image ='$project_image', icon ='$project_icon'  WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

             $command -> execute();

			  $this->redirect(array("ptype_list"));	

	   }

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
	public function actionPtype()

	{

		if(Yii::app()->session['user_array']['per10']=='1')

			{

		

					

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

				$this->render('ptype');

			

			}

			else{

				$this->redirect(array('user/user'));

				

			}

			}

	}
	
	public function actionSector()
	{
		if(Yii::app()->session['user_array']['per10']=='1')
		{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
			$connection = Yii::app()->db; 
			$sql_projects = "SELECT * FROM projects";
			$result_projects = $connection->createCommand($sql_projects)->query();
			$sql_sector = "SELECT * FROM sectors";
			$result_sectors = $connection->createCommand($sql_sector)->query();
			$this->render('sector',array('projects'=>$result_projects,'sectors'=>$result_sectors));
			}
			else{
				$this->redirect(array('user/user'));
			}

			}

	}

	public function actionAddsector()
	{ 
	if(Yii::app()->session['user_array']['per10']=='1')
		{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
			$error='';
			if ($_POST['project']==''){$error.='Please Select Project</br>';}
			if ($_POST['sectorname']==''){$error.='Please Enter Sector Name</br>';}
			if ($_POST['disc']==''){$error.='Please Enter Discription</br>';}
			$error;
			$connection = Yii::app()->db;  
			$sql ="SELECT * from sectors where sector_name='".$_POST['sectorname']."' and project_id='".$_POST['project']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();
			if(!empty($result_data)){
			$error.='Sector Already Exist';
		}
		if(empty($error)){
		$uid=Yii::app()->session['user_array']['id'];						 
		$sql  = "INSERT INTO memberplot (plot_id,user_name,member_id,create_date,noi,insplan,status,plotno) 
	VALUES ('".$_POST['plot_id']."','".$uid."','".$result_data['id']."','".date('Y-m-d H:i:s')."','".$_POST['noi']."','".$_POST['insplan']."','New','".$_POST['plotno']."')";	 
					$command = $connection -> createCommand($sql);
                    $command -> execute();		
					echo 'Plot Allotment Request Sent For Verification';
					exit;
					}
				    else if(!empty($error)){ 
 				    echo $error;
             } 
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

