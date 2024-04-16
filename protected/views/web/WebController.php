<?php

class WebController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	 
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	
	public function actionIndex()
	{	
		  	$connection = Yii::app()->db;
			$sql_projects  = "SELECT * from projects";
			$result_projects = $connection->createCommand($sql_projects)->query();
			
			$sql_uprojects  = "SELECT * from uprojects";
			$result_uprojects = $connection->createCommand($sql_uprojects)->query();
			
			
			$sql_page  = "SELECT * from pages where page_type='index'";
			$result_pages = $connection->createCommand($sql_page)->query();
			
			//$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";
			$sql_news ="select * from latest_news ";
			$result_news = $connection->createCommand($sql_news)->query();
			
			$sql_setting ="select * from setting ";
			$result_setting = $connection->createCommand($sql_setting)->query();
			
			$this->render('index',array('projects'=>$result_projects,'uprojects'=>$result_uprojects,'pages'=>$result_pages,'news'=>$result_news,'setting'=>$result_setting));
			
	}
	public function actionProject_detail()
	{
			$connection = Yii::app()->db;
			$sql_page  = "SELECT * from projects where id='".$_REQUEST['id']."'";
			$result = $connection->createCommand($sql_page)->query();
			
			$this->render('project_details',array('content'=>$result));
	}
	public function actionUproject_detail()
	{
			$connection = Yii::app()->db;
			$sql_page  = "SELECT * from uprojects where id='".$_REQUEST['id']."'";
			$result = $connection->createCommand($sql_page)->query();
			
			$this->render('uproject_details',array('content'=>$result));
	}
	
	public function actionPages()
	{
		$connection = Yii::app()->db;
		$sql_page1  = "SELECT * from pages where id='".$_REQUEST['id']."'";
		$result1 = $connection->createCommand($sql_page1)->queryRow();
		if($result1['page_type']=="2col-left")
		{
			$sql_page  = "SELECT * from pages where id='".$_REQUEST['id']."'";
			$result = $connection->createCommand($sql_page)->query();
			
			$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";
			$result1 = $connection->createCommand($sql_news)->query();
			
			$this->render('2col-left',array('content'=>$result,'news'=>$result1));
		}
		if($result1['page_type']=="1col_left")
		{
			$sql_page  = "SELECT * from pages where id='".$_REQUEST['id']."'";
			$result = $connection->createCommand($sql_page)->query();
			$this->render('1col-left',array('content'=>$result));
		}
		if($result1['page_type']=="3col_left")
		{
		$sql_page1  = "SELECT * from pages where id='".$_REQUEST['id']."'";
		$result1 = $connection->createCommand($sql_page1)->query();
		
		$sql  = "SELECT * from projects ";
		$res = $connection->createCommand($sql)->query();
		
		$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";
		$result = $connection->createCommand($sql_news)->query();
			
			
		$this->render('3col-left',array('content'=>$result1,'projects'=>$res,'news'=>$result));
		}
	}
	
	
	 function actionView_gallery()
	 {
	
		
		$this->layout='//layouts/front';
	    $this->render('view_gallery');
		 
	}
	 function actionTabs()
	 {
	
		
		$this->layout='//layouts/front';
	    $this->render('tabs');
		 
	}
	
	public function actionGallery_list()
	{	
	
	$this->layout='//layouts/front';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM gallery";
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('gallery_list',array('gallery'=>$result_projects));
	  	
	}	
	
	public function actionSend()
	{
		$error = '';
		

if((isset($_POST['name']) && empty($_POST['name'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['message']) 	&& empty($_POST['message'])))
		{
			$error = 'Please complete all required fields <br />';
		}
	
		
		if(isset($_POST['email']) && !empty($_POST['email']) &&  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
			$error .= 'Please enter valid Email Address<br>';
		}
		
		$query="INSERT INTO message(name,email,message) VALUES('$_POST[name]','$_POST[email]','$_POST[message]'";
		if(mysql_query($query))
		{
			
		}
		
		
	}
	//////////////////////////EMAIL SUBCRIPTION//////////////
	
	public function actionSubcribe()
	{
		
			$connection = Yii::app()->db;
	
	
		$mail=$_POST['email'];
		
		
		$sql="INSERT INTO subcription(email) VALUES('".$mail."')";
		 $command = $connection -> createCommand($sql);
         $command -> execute();
		$this->redirect('index');
				
		
		
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

	
	public function actionPieChart()
	{
			$document_data = $this->GetDocument(Yii::app()->session['user_array']['user_id']);
			$arr=(json_decode($document_data));
			$counter =1;
			$result = array();
			$count_entity = '0';
		
			foreach($arr->data as $data) {
				
				 foreach($data->source as $entities) {
				
					$result[] =  $entities;
					 break;
			 }
		 } 
		
			$result_data = array();
			$total_array = array_count_values($result);
			foreach ($total_array  as $key => $value)  
			  $result_data[] =  array('sources'=>$key,'results'=>number_format((($value/$arr->stats->found)*100),2),'total_results'=>$value); 
			echo json_encode($result_data);
			exit;
	}
	
	public $layout='//layouts/front';	
	public function actionWeb()
	
	{
		
		$this->layout='column3';
		$this->render('web');
	}

	
	public function actionProject_details()
	{	
	$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from projects WHERE id='".$_REQUEST['id']."'";
		
			$result_projects = $connection->createCommand($sql_project)->queryRow();
			$this->render('project_details',array('projects'=>$result_projects));
	}
    public function actionCenter_details()
	{	
	$connection = Yii::app()->db;  
		$sql  = "SELECT * from sales_center";
		
			$result = $connection->createCommand($sql)->queryAll();
			$this->render('center_details',array('center'=>$result));
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
