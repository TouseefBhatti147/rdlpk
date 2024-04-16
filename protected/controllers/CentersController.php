<?php



class CentersController extends Controller

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

		if ((isset($_POST['name']) && empty($_POST['name'])) || (isset($_POST['detail']) && empty($_POST['detail'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			

			$newfilename =  $_FILES["image"]["name"];

			move_uploaded_file($_FILES["image"]["tmp_name"],'images/centers/'.$newfilename);

      			

	

		if(empty($error))

		        {

				  

				$name = ($_POST['name']);

				$detail = ($_POST['detail']);

			     

				  

                $sql  = "INSERT INTO  sales_center(name,image,detail) VALUES('".$name."','".$_FILES["image"]['name']."','".$detail."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();

			//	$this->redirect(array('centers/centers_list'));
					
				$note="Message";
				 
			   $this->redirect(array('centers/centers_list','note'=>$note) );
			   
				

				

				}

		

		

			}

			exit;

	}

	public function actionCenters_list()

	{	

	if(Yii::app()->session['user_array']['per5']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM sales_center";

	$result_centers = $connection->createCommand($sql)->query();

	$this->render('centers_list',array('centers'=>$result_centers));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_center()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM sales_center where id=".$_GET['id'];

	$result_centers = $connection->createCommand($sql)->query();

	$this->render('update_center',array('update_centers'=>$result_centers));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	

	

	

	

	

	/////////////////////////// function for update project 





		public function actionUpdate_cen()

	     {

			  if(Yii::app()->session['user_array']['per5']=='1')

			{

		    $connection = Yii::app()->db;
			$sql = "SELECT * FROM sales_center where id=".$_POST['id'];

			$result = $connection->createCommand($sql)->queryRow();

	   

		    $id=$_POST['id']; 

		   

			 

			 $name=$_POST['name'];

			 $detail=$_POST['detail'];

			 	if ($_FILES['image']["name"]==''){

				

				$image=$result['image'];

				}else{ 


			 $image=$_FILES['image']["name"];

						

			$newfilename = $_FILES["image"]["name"];

			move_uploaded_file($_FILES["image"]["tmp_name"],

      		'images/centers/'.$newfilename);

				}

			 $sql_update = "UPDATE sales_center SET name ='$name',detail ='$detail',image ='$image' WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

              $command -> execute();

			  $this->redirect(array("centers/centers_list"));	

			}

	   }



	 function actionDelete_center()

	 {

		  if(Yii::app()->session['user_array']['per5']=='1')

			{

		

		  $connection = Yii::app()->db;

	  $sql  = "Delete from sales_center where id='".$_REQUEST['id']."'";

               $command = $connection -> createCommand($sql);

               $command -> execute();

			

		 		 $this->redirect(array("centers/centers_list"));

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

	

	

	

	

	public function actionCenters()

	{

		if((Yii::app()->session['user_array']['per5']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{

		

					

			

				$this->render('centers');

			

			}

			else{

				$this->redirect(array('user/dashboard'));

				

			
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

