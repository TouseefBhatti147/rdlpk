<?php

class TransferplotController extends Controller
{
	function actionTransferplot()
	 {
		 if(Yii::app()->session['user_array']['per6']=='1')
			{
			$this->layout='//layouts/front';
			$this->render('transferplot');
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
		 
	}
	
	
	public function actionCreate()
	 
	 {
	 
	 $error ='';
	    if(isset($_POST['cnic']) && empty($_POST['cnic']))
			{
				echo $error = 'Please enter cnic<br>';
			}
						
			if($error=='')
			{	
		
				  $cnic = $_POST['cnic'];		 
				  $connection = Yii::app()->db;  
				  $sql ="SELECT * from members where cnic='".$cnic."'";
				  $result_data = $connection->createCommand($sql)->queryRow();
				 
				  if($result_data==0)
				  {
					 
				$error='';
			if ((isset($_POST['name']) && empty($_POST['name']))){
				$error.=" Name required. <br>";
				}
			$error='';
			
				$error='';
			if ((isset($_POST['sodowo']) && empty($_POST['sodowo']))){
				$error.="SODOWO required. <br>";
				}
				$error='';
			if ((isset($_POST['cnic']) && empty($_POST['cnic']))){
				$error.="CNIC required. <br>";
				}
				$error='';
			if ((isset($_POST['address']) && empty($_POST['address']))){
				$error.="Address required. <br>";
				}
				$error='';
			if ((isset($_POST['email']) && empty($_POST['email']))){
				$error.="Email required. <br>";
				}
				$error='';
			if ((isset($_POST['city']) && empty($_POST['city']))){
				$error.="City required. <br>";
				}
				$error='';
			if ((isset($_POST['state']) && empty($_POST['state']))){
				$error.="State required. <br>";
				}		
		
		if($error==''){
					  // Insert in to member a new member
					  $connection = Yii::app()->db;  
		$sql  = 'INSERT INTO members 
		(name, sodowo, cnic, address, email, city, state )
		VALUES ( "'.$_POST['name'].'", "'.$_POST['sodowo'].'", "'.$_POST['cnic'].'", "'.($_POST['address']).'", "'.$_POST['email'].'", "'.$_POST['city'].'", "'.$_POST['state'].'" )';		
					
		$command = $connection -> createCommand($sql);
        $command -> execute();

						 
					  // then get a new insert id by using some last_insert_id
					  // $transferto_memberid = 
			}else{
						 
					  //set the id in member id
					  	$transferto_memberid = $result_data;
						echo $error; exit();
			}
				  
			  
			}else{
				
			 $transferto_id = Yii::app()->db->getLastInsertID();	
			 echo $transferto_id; exit();
			 $sq="INSERT INTO transferplot
				SET plot_id='".$_POST['plot_id']."',
				transferfrom_id='".$_POST['transferfrom_id']."',
				transferto_id='".$transferto_id."',
				status='New Request',
				create_date='".date('Y-m-d H:i:s')."'";	  
				$command = $connection -> createCommand($sq);
        		$command -> execute();
					  
		    }
				  
		
		if($error=='')
		{
		
		}else
		{	
			echo $error;
		exit;
	 
		}
		exit;
	 
		}
		
		exit;	 
		
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
	
	
	public function actionSearch_memberplot()
	{	
	$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('search_memberplot',array('projects'=>$result_projects));
	}
	
	public function actionMemberplot()
	{	
	$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('memberplot',array('projects'=>$result_projects));
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
