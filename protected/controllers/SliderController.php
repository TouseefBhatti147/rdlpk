<?php



class SliderController extends Controller

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

		if ((isset($_POST['title']) && empty($_POST['title'])) || (isset($_POST['detail']) && empty($_POST['detail'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			

			$newfilename =  $_FILES["image"]["name"];

			move_uploaded_file($_FILES["image"]["tmp_name"],'images/slider/'.$newfilename);

      			

	

		if(empty($error))

		        {

				  

				$title =($_POST['title']);

				$detail =($_POST['detail']);
                	$link =($_POST['link']);
			     

				  

                $sql  = "INSERT INTO slider(title,detail,image,link) VALUES('".$title."','".$detail."','".$_FILES["image"]['name']."','".$link."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();
				
				$note="Message";
				$this->redirect(array('slider/slider_list','note'=>$note) );
				
			//	$this->redirect(array('slider/slider_list'));

				

				

				}

		

			}

			exit;

	}

	public function actionSlider_list()

	{	

	if(Yii::app()->session['user_array']['per5']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM slider";

	$result = $connection->createCommand($sql)->query();

	$this->render('slider_list',array('slider'=>$result));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_slider()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM slider where id=".$_GET['id'];

	$result = $connection->createCommand($sql)->query();

	$this->render('update_slider',array('update_slider'=>$result));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	

	

	

	

	

	/////////////////////////// function for update project 





		public function actionUpdate_slid()

	     {

			 if(Yii::app()->session['user_array']['per5']=='1')

			{	

   		   $connection = Yii::app()->db; 

			$sql = "SELECT * FROM slider where id=".$_POST['id'];

			$result = $connection->createCommand($sql)->queryRow();

		    

			$id=$_POST['id'];

		   

			 $title=$_POST['title'];

			 $detail=$_POST['detail'];
			 $link =($_POST['link']);

			if ($_FILES['image']["name"]==''){

				

				$image=$result['image'];

				}else{ 

				$image=$_FILES['image']["name"];			

				$newfilename = $_FILES["image"]["name"];

				move_uploaded_file($_FILES["image"]["tmp_name"],

				'images/slider/'.$newfilename);

				}

      		

			 $sql_update = "UPDATE slider SET title ='$title',detail ='$detail',image ='$image',link='$link' WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

              $command -> execute();

			  $this->redirect(array("slider_list"));	

	   }

		 }



	 function actionDelete_slider()

	 {

		 if(Yii::app()->session['user_array']['per2']=='1')

			{

		

		

		  $connection = Yii::app()->db;

	  $sql  = "Delete from slider where id='".$_REQUEST['id']."'";

               $command = $connection -> createCommand($sql);

               $command -> execute();

			

		 		 $this->redirect(array("slider/slider_list"));		

		

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

	

	

	

	

	public function actionSlider()

	{

		if(Yii::app()->session['user_array']['per5']=='1')

			{

		

					

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

				$this->render('slider');

			

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

