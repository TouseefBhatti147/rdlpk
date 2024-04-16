<?php



class CategoryController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	 

	public function actionCreate()

	{

		

		if(Yii::app()->session['user_array']['per3']=='1')

			{

		$error = '';

		 $connection = Yii::app()->db;

		if ((isset($_POST['category_title']) && empty($_POST['category_title'])) || (isset($_POST['category_name']) && empty($_POST['category_name'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			

			$newfilename =  $_FILES["category_sign"]["name"];

			move_uploaded_file($_FILES["category_sign"]["tmp_name"],'images/category/'.$newfilename);

      			

	

		if(empty($error))

		        {

				  

				$title =($_POST['category_title']);

				$name =($_POST['category_name']);

			     

				  

                $sql  = "INSERT INTO categories(title,name,sign) VALUES('".$title."','".$name."','".$_FILES["category_sign"]['name']."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();

				//$this->redirect(array('category/category_list'));
					
				$note="Message";
				 
			   $this->redirect(array('category/category_list','note'=>$note) );
			   
				

				

				}

			}

			

		else{

			$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");

		}

			

	}

	public function actionCategory_list()

	{	

	 if(Yii::app()->session['user_array']['per3']=='1')

			{

		

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM categories";

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('category_list',array('categories'=>$result_projects));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_category()

	{

		if(Yii::app()->session['user_array']['per3']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM categories where id=".$_GET['id'];

	$result_projects = $connection->createCommand($sql_projects)->query();

	$this->render('update_category',array('update_category'=>$result_projects));

		}else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }

	

	

	

	

	

	

	/////////////////////////// function for update project 





		public function actionUpdate_cat()

	     {

			 if(Yii::app()->session['user_array']['per3']=='1')

			{

		    $connection = Yii::app()->db;

	   

		    $id=$_POST['id']; 

		   

			 $title=$_POST['title'];

			 $name=$_POST['name'];

			 
			$newfilename =  $_FILES["category_sign"]["name"];

			move_uploaded_file($_FILES["category_sign"]["tmp_name"],'images/category/'.$newfilename);

			 

      		

			 $sql_update = "UPDATE categories SET title ='$title',name ='$name',sign ='".$_FILES["category_sign"]['name']."' WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

              $command -> execute();

			  $this->redirect(array("category_list"));	

			}

			else{

				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

			}

	   }



	 function actionDelete_category()

	 {

		 

		if(Yii::app()->session['user_array']['per3']=='1')

			{

		  $connection = Yii::app()->db;

	  $sql  = "Delete from categories where id='".$_REQUEST['id']."'";

               $command = $connection -> createCommand($sql);

               $command -> execute();

			

		 		 $this->redirect(array("category/category_list"));

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

	

	

	

	

	

	public function actionCategory()

	{

		if((Yii::app()->session['user_array']['per3']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{

		
				$this->render('category');

			

			}

				else{

				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

			

				

		

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

