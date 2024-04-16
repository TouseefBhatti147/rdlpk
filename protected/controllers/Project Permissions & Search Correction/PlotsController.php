<?php

class PlotsController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionCreate()
	{
	
		$model=new plots;
		$error = '';
		
		if ((isset($_POST['project_id']) && empty($_POST['project_id'])) || (isset($_POST['street_id']) && empty($_POST['street_id'])) || (isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address'])) || (isset($_POST['plot_size']) && empty($_POST['plot_size'])))
		{
			$error = 'Please complete all required fields <br />';
		}
	
		
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		if(empty($error))
		{
			   $connection = Yii::app()->db;  
            $sql  = 'INSERT INTO plots 
                	      (project_id,street_id, plot_detail_address, plot_size,create_date, com_res )
               	    	  VALUES ( "'.$_POST['project_id'].'", "'.$_POST['street_id'].'", "'.$_POST['plot_detail_address'].'", "'.$_POST['plot_size'].'", "'.date('Y-m-d h:i:s').'" ,"'.$_POST['com_res'].'")';	
					
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   $this->redirect('plots/plots'); 
			   
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
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 =   "select * from plots where";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " project_id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
		$sql_member = $sql1;
		$sql_member = $sql_member.implode(' or',$sql2);
		
		
		$result_members = $connection->createCommand($sql_member)->query() or mysql_error();
		$this->render('plots_list',array('members'=>$result_members));
		
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionHistory()
	{	
	if(Yii::app()->session['user_array']['per2']=='1')
			{
	$connection = Yii::app()->db;
			$sql_projects  = "SELECT * from plothistory where plot_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			
			$sql_page  = "SELECT * from memberplot where plot_id='".$_REQUEST['id']."'";
			$result_pages = $connection->createCommand($sql_page)->query();
			
			//$result_pages = $connection->createCommand($sql_page)->queryRow();
			$this->render('history',array('projects'=>$result_projects,'pages'=>$result_pages));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	public function actionPlots_lis()
	{	
			$where='';
			$and = false;
			$where='';
			if ($_POST['firstname']!=""){
				$where.=" plots.plot_size LIKE '%".$_POST['firstname']."%'";
				$and = true;
			}
			
			
			if ($_POST['sodowo']!=""){				
				if ($and==true)
				{
					$where.=" and plots.com_res LIKE '%".$_POST['sodowo']."%'";
				}
				else
				{
					$where.=" plots.com_res LIKE '%".$_POST['sodowo']."%'";
				}
				$and=true;
			}
			
			
			if ($_POST['cnic']!=""){
				if ($and==true)
				{
					$where.=" and projects.project_name LIKE '%".$_POST['cnic']."%'";
				}
				else
				{
					$where.=" projects.project_name LIKE '%".$_POST['cnic']."%'";
				}
				$and=true;
			}
			
			
			
		
	$connection = Yii::app()->db; 
	$sql_member = "SELECT
    plots.id
    , plots.street_id
    , plots.plot_size
    , plots.com_res
    , plots.create_date
	, plots.plot_detail_address
    , projects.project_name
FROM
    plots
    Left JOIN projects 
        ON (plots.project_id = projects.id)
where $where ";
		$result_members = $connection->createCommand($sql_member)->query();
			$this->render('plots_lis',array('members'=>$result_members));
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
	
	
	
	public function actionPlots()
	
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('plots',array('projects'=>$result_projects));
			
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
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
