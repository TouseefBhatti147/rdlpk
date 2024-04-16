<?php



class DownloadsController extends Controller

{

	

	 public function actionCreate()
	{
		if(Yii::app()->session['user_array']['per4']=='1')
			{		  
			$connection = Yii::app()->db;
				$newfilename = $_FILES["image"]["name"];
				move_uploaded_file($_FILES["image"]["tmp_name"],

				'images/downloads/'.$newfilename);

			
				$sql  = "INSERT INTO downloads(title,project_id,detail,image) VALUES('".$_POST['title']."','".$_POST['project_id']."','".$_POST['detail']."','".$newfilename."')";	
                $command = $connection -> createCommand($sql);
		       $command -> execute();
			 $this->redirect (array('downloads/downloads_list'));
		   
			}
			else{
			$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
			}
	}

	
     public function actionDownloads_list()

	{	  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per4']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {
		$this->layout='//layouts/back';
		
       	$and = false;
			$where='';
		//echo $_POST['project_id']; exit;
		if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="where downloads.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="where downloads.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
	

	//$sql = "SELECT * FROM streets";
 $sql="SELECT
    projects.id
    ,  downloads.id
	,  downloads.title
	,  downloads.detail
	,  downloads.image
    , projects.project_name

FROM
    downloads
	Left JOIN projects  ON (downloads.project_id = projects.id) 
	 $where"; 
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	   

	$this->render('downloads_list',array('downloads'=>$result,'projects'=>$result_project));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	public function actionPdf_forms()
	{
		  $connection = Yii::app()->db; 
		
	$this->layout='//layouts/front';
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	
	$sql_download = "SELECT * from downloads";
	$result_downloads = $connection->createCommand($sql_download)->queryAll();
	
	$this->render('pdf_forms',array('downloads'=>$result_downloads,'projects'=>$result_project));
	}

	public function actionDelete_Downloads()

	{
		if(Yii::app()->session['user_array']['per4']=='1')
			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
    $connection = Yii::app()->db; 
			 $connection = Yii::app()->db; 
			 $sql_del = "DELETE from downloads where id=".$_GET['id'];
			 $command = $connection -> createCommand($sql_del);
             $command -> execute();
			 $this->redirect (array('downloads/downloads_list'));
	
		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

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

    public function actionUpdate_downloads()

     	{

		if(Yii::app()->session['user_array']['per4']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

//	$sql = "SELECT * FROM streets where id=".$_GET['id'];
$sql = "SELECT
    projects.id
    ,  downloads.id
	 ,  downloads.project_id
	,  downloads.title
	,  downloads.detail
	,  downloads.image
    , projects.project_name

FROM
    downloads
	Left JOIN projects  ON (downloads.project_id = projects.id) 
	where downloads.id=".$_GET['id']." ";
	$result = $connection->createCommand($sql)->query();

	$this->render('update_downloads',array('update_streets'=>$result));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	/////////////////////////// function for update project 





		public function actionUpdate()
	     {
	     	 $connection = Yii::app()->db;
			 $project_id=$_POST['project_id'];
			 $title=$_POST['title'];
			 $detail=$_POST['detail'];
			 $id=$_POST['id'];
			$s = "SELECT * FROM downloads where id=".$_POST['id'];
			$res = $connection->createCommand($s)->queryRow();
			if ($_FILES['image']["name"]==''){
			$image=$res['image'];
					}else{ 
            
				$image = $_FILES["image"]["name"];
				move_uploaded_file($_FILES["image"]["tmp_name"],
				'images/downloads/'.$image);
				}

 
 			 $sql_update = "UPDATE downloads SET project_id ='$project_id',title ='$title',detail ='$detail',image ='$image' WHERE id =".$_POST['id'];
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect (array('downloads/downloads_list'));
		   
	   }


	

	public function actionDownloads()

	{

		

		if(Yii::app()->session['user_array']['per4']=='1')

		{

		$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from projects";

		$result_projects = $connection->createCommand($sql_project)->query();

		$this->render('downloads',array('projects'=>$result_projects));

		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	

	

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

