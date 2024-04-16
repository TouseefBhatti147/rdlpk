<?php



class NewsController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	 

	public function actionCreate()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

		

		

		$error = '';

		

		if ((isset($_POST['teaser']) && empty($_POST['teaser'])) || (isset($_POST['details']) && empty($_POST['details'])) || (isset($_POST['status']) && empty($_POST['status'])))

		{

			$error = 'Please complete all required fields <br />';

		}

		

		

		if(empty($error))

		        {

				$teaser = ($_POST['teaser']);

				$details = ($_POST['details']);

				$status = ($_POST['status']);

				$create_date = date('Y-m-d h:i:s');

				$connection = Yii::app()->db;  

                $sql  = "INSERT INTO latest_news (teaser,details, status, create_date) VALUES('".$teaser."','".$details."','".$status."','".$create_date."')";		

                        				$command = $connection -> createCommand($sql);

                                        $command -> execute();
											
										$note="Message";
										$this->redirect(array('news/news_list','note'=>$note) );
				
										//$this->redirect(array('news/news_list'));				

				}

		

		

			}

			exit;

	}

	public function actionNews_list()

	{	

	if(Yii::app()->session['user_array']['per5']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM latest_news";

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('news_list',array('news'=>$result_projects));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_news()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM latest_news where id=".$_GET['id'];

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('update_news',array('update_news'=>$result_projects));

		}else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	public function actionDetail_news()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM latest_news where id=".$_GET['id'];

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('detail_news',array('detail_news'=>$result_projects));

		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}



	/////////////////////////// function for update 





		public function actionUpdate_new()

	     {

			 if(Yii::app()->session['user_array']['per5']=='1')

			{

		

		 $connection = Yii::app()->db;

	        $id=$_POST['id']; 

			 $teaser=$_POST['teaser'];

			 $details=$_POST['details'];

			 $status=$_POST['status'];

			 $create_date=$_POST['create_date'];

 			 

			 

			$sql_update = "UPDATE latest_news SET teaser ='$teaser',details ='$details',status ='$status',create_date ='$create_date' WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

             $command -> execute();

			  $this->redirect(array("news_list"));	

	   }



		 }

	public function actionNews()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

				$this->render('news');

			

		}

		else{

			$this->redirect(array('user/user'));

		

			}

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

