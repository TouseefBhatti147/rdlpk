<?php

class PagesController extends Controller
{
	public function actionCreate()
	{
		$model=new pages;
		$error = '';
		
		if ((isset($_POST['page_type']) && empty($_POST['page_type'])) || (isset($_POST['content_type']) && empty($_POST['content_type'])) || (isset($_POST['teaser']) && empty($_POST['teaser'])) || (isset($_POST['detail_content']) && empty($_POST['detail_content'])) || (isset($_POST['description']) && empty($_POST['description'])))
		{
			$error = 'Please complete all required fields <br />';
		}	
		if(empty($error))
		{
				$model->page_type = $_POST['page_type'];
				$model->content_type = $_POST['content_type'];
				$model->description = $_POST['description'];
				$model->teaser = $_POST['teaser'];
				$model->detail_content = $_POST['detail_content'];
				
				$model->create_date = date('Y-m-d h:i:s');
				try {
						$model->save();
					} catch (Exception $e) {
						echo 'Caught exception: ',  $e->getMessage(), "\n";
					}		
		}else
		{	
			echo json_encode(array($error,$_POST));
		}
		exit;
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
	
	
	
	public function actionPages()
	{	
	if(Yii::app()->session['user_array']['per4']=='1')
			{
	$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from pages";
		$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('pages',array('pages'=>$result_projects));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	
	public function actionPages_list()
	{	
	if(Yii::app()->session['user_array']['per4']=='1' )
			{
	$connection = Yii::app()->db;  
		$sql_page  = "SELECT * from pages ORDER BY page_type";
		$result_pages = $connection->createCommand($sql_page)->query();
			$this->render('pages_list',array('pages'=>$result_pages));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
			
	}
	
	public function actionEdit_page()
	{
		if(Yii::app()->session['user_array']['per4']=='1')
			{	
	$connection = Yii::app()->db;  
		$sql_page  = "SELECT * from pages WHERE id='".$_REQUEST['id']."'";
	
			$result_pages = $connection->createCommand($sql_page)->queryRow();
			$this->render('edit_page',array('pages'=>$result_pages));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionDelete_page()
	{
		$connection=Yii::app()->db;
		 $id=$_REQUEST['id'];
		
		  $sql  = "Delete from pages where id='".$_REQUEST['id']."'";
		$command=$connection->CreateCommand($sql);
		$command->execute();
		$this->redirect(array("pages_list"));
		
	}
	public function actionAbout()
	{	
	if(Yii::app()->session['user_array']['per4']=='1')
			{
	$connection = Yii::app()->db;  
		$sql_page  = "SELECT * from pages WHERE page_type LIKE '%index%'";
		
		$result_pages = $connection->createCommand($sql_page)->queryRow();
		$this->render('about',array('pages'=>$result_pages));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionUpdate1()
	{	
	$page_type=$_POST['page_type'];
	$content_type=$_POST['content_type'];
	$description=$_POST['description'];
	$teaser=$_POST['teaser'];
	$detail_content=$_POST['detail_content'];
	
	$connection=Yii::app()->db;
	$sql = "UPDATE pages SET page_type = '".$page_type."', content_type='".$content_type."', description='".$description."', teaser='".$teaser."', detail_content='".$detail_content."' WHERE id='".$_REQUEST['id']."'";
	$command = $connection->createCommand($sql);
	$command->execute();
	 
			  $this->redirect(array("pages_list"));

	}
	public function actionDelete_splash()
	{
		$connection=Yii::app()->db;
		$id=$_REQUEST['id'];
		$sql_page  = "SELECT * from splashscreen WHERE id='".$id."'";
		$result_pages = $connection->createCommand($sql_page)->queryRow();
		if($result_pages['images']!=='' && file_exists('images/splash/'.$result_pages['images'])==1){

unlink('images/splash/'.$result_pages['images']);

}
		$sql  = "Delete from splashscreen where id='".$_REQUEST['id']."'";
		$command=$connection->CreateCommand($sql);
		$command->execute();
		$this->redirect(array("splashscreen"));
		
	}
	public function actionSplashscreen()
	{	
	if(Yii::app()->session['user_array']['per5']=='1')
	{
		$connection = Yii::app()->db; 
		 $sql_page  = "SELECT * from splashscreen WHERE status='1'";
		
		$result_pages = $connection->createCommand($sql_page)->queryAll();
		$this->render('splash',array('splash'=>$result_pages));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionEdit_splash()
	{
		if(Yii::app()->session['user_array']['per5']=='1')
			{	
	$connection = Yii::app()->db;  
		$sql_page  = "SELECT * from splashscreen WHERE id='".$_REQUEST['id']."'";
	
			$result_pages = $connection->createCommand($sql_page)->queryRow();
			$this->render('edit_splash',array('splash'=>$result_pages));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionAddsplashscreen()
	{
		if(Yii::app()->session['user_array']['per5']=='1')
			{	
	$connection = Yii::app()->db;  
		
			$this->render('addsplashscreen');
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionAddnewsplash()
	{ 
			if(Yii::app()->session['user_array']['per4']=='1')
			{   
					$error='';
                                    //$error =array();
									$connection = Yii::app()->db;  
									
									if ((isset($_POST['heading']) && empty($_POST['heading']))){
									 $error.="Please Enter heading. <br>";}								  
								  	
									if ((isset($_POST['detail']) && empty($_POST['detail']))){
									 $error.="Please Enter detail. <br>";
									 }
									 if ((isset($_POST['image1']) && empty($_POST['image1']))){
									 $error.="Please Select Image. <br>";
									 }
									 if ((isset($_POST['from']) && empty($_POST['from']))){
									 $error.="Enter From Date. <br>";
									 }
									 if ((isset($_POST['to']) && empty($_POST['to']))){
									 $error.="Enter To Date. <br>";
									 }
									 
								
								 	
										 if(empty($error)){
										 $uid=Yii::app()->session['user_array']['id']; 
				 $sql  = "INSERT INTO splashscreen (heading,details,images,status,`from`,`to`) 
	VALUES ('".$_POST['heading']."','".$_POST['detail']."','".$_FILES['image1']['name']."','".$_POST['status']."','".$_POST['from']."','".$_POST['to']."')";	
					 
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
						$path="images/splash/";
				 $image=$_FILES['image1']["name"];
				 $newfilename = $_FILES["image1"]["name"];
				
				move_uploaded_file($_FILES["image1"]["tmp_name"],
				$path.$image);
						echo 'Spalash Screen Inserted';
						exit;
						}
						else if(!empty($error)){ 
 						echo $error;

             } 
			}
	}
	public function actionUpdatesplash()
	{ 
			if(Yii::app()->session['user_array']['per4']=='1')
			{   
					$error='';
                                    //$error =array();
									$connection = Yii::app()->db;  
									
									if ((isset($_POST['heading']) && empty($_POST['heading']))){
									 $error.="Please Enter heading. <br>";}								  
								  	
									if ((isset($_POST['detail']) && empty($_POST['detail']))){
									 $error.="Please Enter detail. <br>";
									 }
									 if ((isset($_POST['image1']) && empty($_POST['image1']))){
									 $error.="Please Select Image. <br>";
									 }
									  $s = "SELECT * FROM splashscreen where id=".$_POST['id'];
			                         $res = $connection->createCommand($s)->queryRow();
			                          if ($_FILES['image1']["name"]==''){
			                    	 $image=$res['images'];
			                          }else{
			                              $image1="images='".$_FILES['image1']['name']."',";
								$path="images/splash/";
								$image=$_FILES['image1']["name"];
								$newfilename = $_FILES["image1"]["name"];
								move_uploaded_file($_FILES["image1"]["tmp_name"],
								$path.$image);
			                              
			                          }
			                         
			                         if(empty($error)){
										 $uid=Yii::app()->session['user_array']['id']; 
										   $sql  = "Update splashscreen SET 
										  heading='".$_POST['heading']."',
										  details='".$_POST['detail']."',
                            			  images='".$image."', 
                            			  `status`='".$_POST['status']."',
                            			  `from`='".$_POST['from']."', 
                            			   `to` ='".$_POST['to']."' where id=".$_POST['id'];	
					 
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
					
						echo 'Spalash Screen Updated';
						exit;
						}
						else if(!empty($error)){ 
 						echo $error;

             } 
			   								 
			}
	}
	public function actionAjaxRequest($val1)
	{	
	$connection = Yii::app()->db;  
		$sql_street  = "SELECT * from streets where project_id='".$val1."'";
		$result_streets = $connection->createCommand($sql_street)->query();
			
		$street=array();
		foreach($result_streets as $str){
			$street[]=$str;
			} 
		
	echo json_encode($street); exit();
	}
	
	
	public function actionAjaxRequest1($val1)
	{	
	
	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from plots where street_id='".$val1."'";
		$result_plots = $connection->createCommand($sql_plot)->query();
			
		$plot=array();
		foreach($result_plots as $plo){
			$plot[]=$plo;
			} 
		
	echo json_encode($plot); exit();
	}
	
	
	 	public function actionNewsflash()
	{ 
       	$connection = Yii::app()->db;  
        $sql_plot  = "SELECT * from splashscreen where status='1'";
		$result_plots = $connection->createCommand($sql_plot)->query();
		$this->layout='//layouts/front';
		$this->render('newsflash',array('splash'=>$result_plots));
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
