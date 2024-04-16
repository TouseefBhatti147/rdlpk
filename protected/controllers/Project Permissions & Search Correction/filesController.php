<?php

class FilesController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionCreate()
	
	{ 
		$error = '';
		
		if ((isset($_POST['project_id']) && empty($_POST['project_id'])) || (isset($_POST['street_id']) && empty($_POST['street_id'])) || (isset($_POST['file_detail_address']) && empty($_POST['file_detail_address'])) || (isset($_POST['file_size']) && empty($_POST['file_size']))|| (isset($_POST['type']) && empty($_POST['price']))|| (isset($_POST['noi']) && empty($_POST['type'])))
		{
			$error = 'Please complete all required fields <br />';
		}
	
		
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		if(empty($error))
		{
			   $connection = Yii::app()->db;  
               $sql  = 'INSERT INTO file 
                	      (project_id,street_id, file_detail_address, file_size, type,price,noi,create_date )
               	    	  VALUES ( "'.$_POST['project_id'].'", "'.$_POST['street_id'].'", "'.$_POST['file_detail_address'].'", "'.$_POST['file_size'].'", "'.$_POST['type'].'", "'.$_POST['price'].'","'.$_POST['noi'].'","'.date('Y-m-d h:i:s').'" )';		
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   $this->redirect('files/files'); 
			   
		}else
		{
			echo 123;
			exit;
			echo json_encode(array($error,$_POST));
		}
		
			 
		
			exit;
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
	 function actionMultiplefile()
	 { 
	 if(Yii::app()->session['user_array']['per3']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{
			$connection = Yii::app()->db;  
			$sql_project  = "SELECT * from projects";
			$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('multiplefile',array('projects'=>$result_projects));
			$error = '';
		
		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	 }
	 
	 public function actionCreatemultifile()
	{
		 
		if ((isset($_POST['project_id']) && empty($_POST['project_id'])) || (isset($_POST['street_id']) && empty($_POST['street_id'])) || (isset($_POST['file_detail_address']) && 	empty($_POST['file_detail_address'])) || (isset($_POST['file_size']) && empty($_POST['file_size']))|| (isset($_POST['type']) && empty($_POST['price']))|| (isset($_POST['noi']) && empty($_POST['type'])))
			{
				$error = 'Please complete all required fields <br />';
			}
						
			$i=0;
			do {
			$i++;
			
			   $connection = Yii::app()->db;  
               $sql  = 'INSERT INTO file (project_id,street_id, file_detail_address, file_size, type,price,noi,create_date )
               	    	  VALUES ( "'.$_POST['project_id'].'", "'.$_POST['street_id'].'", "'.$_POST['file_detail_address'].'", "'.$_POST['file_size'].'", "'.$_POST['type'].'", "'.$_POST['price'].'","'.$_POST['noi'].'","'.date('Y-m-d h:i:s').'" )';  
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			} while ($i < $_POST['nof']);
			  $this->redirect('files/multiplefile'); 
			
	}
	 
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

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
	public function actionPlots_list()
	{	
	if(Yii::app()->session['user_array']['per2']=='1')
			{
	$connection = Yii::app()->db; 
	$sql_member = "SELECT * from plots";
		$result_members = $connection->createCommand($sql_member)->query();
			$this->render('plots_list',array('members'=>$result_members));
			}
	}
	
	public function actionHistory()
	{	
	$connection = Yii::app()->db;
			$sql_projects  = "SELECT * from plothistory where plot_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			
			$sql_page  = "SELECT * from memberplot where plot_id='".$_REQUEST['id']."'";
			$result_pages = $connection->createCommand($sql_page)->query();
			
			//$result_pages = $connection->createCommand($sql_page)->queryRow();
			$this->render('history',array('projects'=>$result_projects,'pages'=>$result_pages));
	}
	
	public function actionMember_lis()
	{	
			$where='';
			if ($_POST['firstname']!=""){
				$where.="WHERE m.firstname LIKE '%".$_POST['firstname']."%'";
			}
			if ($_POST['sodowo']!=""){
				$where.="WHERE m.sodowo LIKE '%".$_POST['sodowo']."%'";
			}
			if ($_POST['cnic']!=""){
				$where.="WHERE m.cnic LIKE '%".$_POST['cnic']."%'";
			}
			if ($_POST['plot_size']!=""){
				$where.="WHERE p.plot_size LIKE '%".$_POST['plot_size']."%'";
			}
			if ($_POST['project_name']!=""){
				$where.="WHERE j.project_name LIKE '%".$_POST['project_name']."%'";
			}
			if ($_POST['plot_detail_address']!=""){
				if($where!='')
					$where.=" AND ";
				else $where.=' WHERE ';
				$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";
			}
			
		
	$connection = Yii::app()->db; 
	$sql_member = "SELECT mp.member_id,mp.create_date, m.firstname,m.sodowo,m.cnic,p.plot_detail_address, 					p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
$where ";
		$result_members = $connection->createCommand($sql_member)->query();
			$this->render('member_lis',array('members'=>$result_members));
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
			/*$dataProvider=new CActiveDataProvider('User');*/
			$this->render('index');
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
			/*echo "<pre>";
			print_r($dataset);
			exit;*/
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
			/*print_r($entity_dataset);
			exit;*/
			$dataset_array = $dataset->data;
			$this->render('dashboard',array('document_data'=>$dataset_array,'entity_data'=>$entity_dataset));
		}else
		{
			 $this->redirect(array('index'));
		}
		
	}
	
	
	
	public function actionFiles()
	{	
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('files',array('projects'=>$result_projects));
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
