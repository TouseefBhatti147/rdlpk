<?php



class HordingsController extends Controller

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

		 $connection = Yii::app()->db;
			$newfilename =  $_FILES["image"]["name"];

			move_uploaded_file($_FILES["image"]["tmp_name"],'images/hordings/'.$newfilename);

				$title =($_POST['title']);

				$detail =($_POST['detail']);

			     

				  

                $sql  = "INSERT INTO hordings(title,detail,image,status) VALUES('".$title."','".$detail."','".$_FILES["image"]['name']."','".$_POST['status']."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();
				
				$this->redirect(array('hordings/hordings_list') );

		

			}

			exit;

	}

	public function actionHordings_list()

	{	

	if(Yii::app()->session['user_array']['per5']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM hordings";

	$result = $connection->createCommand($sql)->query();

	$this->render('hordings_list',array('hordings'=>$result));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_hordings()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM hordings where id=".$_GET['id'];

	$result = $connection->createCommand($sql)->query();

	$this->render('update_hordings',array('update_hordings'=>$result));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	

	

	

	

	

	/////////////////////////// function for update project 





		public function actionUpdate_hord()

	     {

			 if(Yii::app()->session['user_array']['per5']=='1')

			{	

   		   $connection = Yii::app()->db; 

			$sql = "SELECT * FROM hordings where id=".$_POST['id'];

			$result = $connection->createCommand($sql)->queryRow();

		    

			$id=$_POST['id'];

		   

			 $title=$_POST['title'];

			 $detail=$_POST['detail'];
			 $status=$_POST['status'];

			if ($_FILES['image']["name"]==''){

				

				$image=$result['image'];

				}else{ 

				$image=$_FILES['image']["name"];			

				$newfilename = $_FILES["image"]["name"];

				move_uploaded_file($_FILES["image"]["tmp_name"],

				'images/hordings/'.$newfilename);

				}

      		

			 $sql_update = "UPDATE hordings SET title ='$title',detail ='$detail',image ='$image',status=$status WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

              $command -> execute();

			  $this->redirect(array("hordings_list"));	

	   }

		 }



	 function actionDelete_hordings()

	 {

		 if(Yii::app()->session['user_array']['per2']=='1')

			{

		

		

		  $connection = Yii::app()->db;

	  $sql  = "Delete from hordings where id='".$_REQUEST['id']."'";

               $command = $connection -> createCommand($sql);

               $command -> execute();

			

		 		 $this->redirect(array("hordings/hordings_list"));		

		

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

	

	

	

	

	public function actionHordings()

	{

			if((Yii::app()->session['user_array']['per5']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
		

				$this->render('hordings');

			

			}

			else{

				$this->redirect(array('user/user'));

				

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

