<?php



class StreetsController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	 public function actionCreate()

	{
		if(Yii::app()->session['user_array']['per3']=='1')

			{

		      $connection = Yii::app()->db;
			   $streets = $_POST['street'];

				$project_id =$_POST['project_id'];
            
				$sql  = "INSERT INTO streets(street,project_id,create_date) VALUES('".$streets."','".$project_id."','".date('Y-m-d h:i:s')."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();
				$note="Message";
				 
			   $this->redirect(array('streets/streets_list','note'=>$note) );
			   
				//$this->redirect(array('streets/streets_list'));

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

	
     public function actionStreets_list()

	{	  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per3']=='1')

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
					$where.="where streets.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="where streets.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
	

	//$sql = "SELECT * FROM streets";
 $sql="SELECT
    projects.id
    , streets.create_date
    , streets.id
	, streets.street
	, streets.project_id
    , projects.project_name
	, streets.street
FROM
    streets
	Left JOIN projects  ON (streets.project_id = projects.id) 
	 $where ORDER BY streets.street ASC"; 
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	   

	$this->render('streets_list',array('streets'=>$result,'projects'=>$result_project));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	/**

	 * Deletes a particular model.

	 * If deletion is successful, the browser will be redirected to the 'admin' page.

	 * @param integer $id the ID of the model to be deleted

	 */

/////////////////////////DELETE STREET//////////////

	public function actionDelete_Streets()

	{

		if(Yii::app()->session['user_array']['per3']=='1')

			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	



    $connection = Yii::app()->db; 

	$sql_check = "SELECT * from plots where street_id=".$_GET['id'];

	$result_check = $connection->createCommand($sql_check)->queryAll();

	

	if (empty($result_projects_check)){

			 $connection = Yii::app()->db; 

			 $sql_del = "DELETE from streets where id=".$_GET['id'];

			

			 

			 $command = $connection -> createCommand($sql_del);

             $command -> execute();

			 $this->redirect (array('streets/streets_list?error=0'));

		}

	else 

	{

		$this->redirect (array('streets/streets_list?error=1'));

	}

	

	

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

    public function actionUpdate_streets()

     	{

		if(Yii::app()->session['user_array']['per3']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

//	$sql = "SELECT * FROM streets where id=".$_GET['id'];
$sql = "SELECT
    projects.id
    , streets.create_date
    , streets.id
	, streets.street
	, streets.project_id
    , projects.project_name
	, streets.street
FROM
    streets
	Left JOIN projects  ON (streets.project_id = projects.id) where streets.id=".$_GET['id']." ";
	$result = $connection->createCommand($sql)->query();

	$this->render('update_streets',array('update_streets'=>$result));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	/////////////////////////// function for update project 





		public function actionUpdate_stree()

	     {

		 $connection = Yii::app()->db;

	   

			$id=$_POST['id'];

			 $project_id=$_POST['project_id'];

			 $street=$_POST['street'];

			  $create_date=$_POST['create_date'];

 			 

					

			$sql_update = "UPDATE streets SET project_id ='$project_id',street ='$street',create_date ='$create_date' WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

             $command -> execute();

			  $this->redirect(array("streets_list"));	

	   }



	

	public function actionStreets()

	{

		

		if(Yii::app()->session['user_array']['per3']=='1')

		{

		$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from projects";

		$result_projects = $connection->createCommand($sql_project)->query();

		$this->render('streets',array('projects'=>$result_projects));

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

