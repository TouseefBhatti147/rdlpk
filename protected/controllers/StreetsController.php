<?php
class StreetsController extends Controller
{

 public function actionAjaxBlock($val1) {
        $connection = Yii::app()->db;
         $sql_blocks = "SELECT * from blocks where project_id='" . $val1 . "'";
        $result_blocks = $connection->createCommand($sql_blocks)->query();
        $blocks = array();
        foreach ($result_blocks as $blk) {
            $blocks[] = $blk;
        }
        echo json_encode($blocks);
        exit();
    }
	 public function actionAjaxRequest($pro, $blk) {
        $connection = Yii::app()->db;
        ////$sql_street = "SELECT * from sectors where project_id='" . $val1 . "'";
		 $sql_street = "SELECT sectors.* from sectors where project_id='" . $pro . "' and block_id='" . $blk . "'";
        $result_streets = $connection->createCommand($sql_street)->query();
        $street = array();
        foreach ($result_streets as $str) {
            $street[] = $str;
        }
        echo json_encode($street);
        exit();
    }
 public function actionAjaxRequest1($pro, $blk) {
        $connection = Yii::app()->db;
        ////$sql_street = "SELECT * from sectors where project_id='" . $val1 . "'";
		 $sql_street = "SELECT sectors.*,blocks.block_name from sectors left join blocks on blocks.id=sectors.block_id where sectors.project_id='" . $pro . "' and sectors.block_id='" .$blk. "'";
        $result_streets = $connection->createCommand($sql_street)->query();
        $street = array();
        foreach ($result_streets as $str) {
            $street[] = $str;
        }
        echo json_encode($street);
        exit();
    }
	 public function actionCreate()

	{

		if(Yii::app()->session['user_array']['per3']=='1')

			{		  

			$connection = Yii::app()->db;

			$error =array();

			if(isset($_POST['project_id']) && empty($_POST['project_id']))
			{
			$error = 'Please Select Project<br>';
			}
			if(isset($_POST['block']) && empty($_POST['block']))
			{
			$error = 'Please Block<br>';
			}
			if(isset($_POST['street']) && empty($_POST['street']))

			{

			$error = 'Please Select Street<br>';

			}

				if(isset($_POST['sector_id']) && empty($_POST['sector_id']))

			{

			$error .= 'Please Select Sector<br>';

			}

			   $sq  = "SELECT * from streets where project_id='".$_POST['project_id']."' AND sector_id='".$_POST['sector_id']."' AND block_id='".$_POST['block']."' AND street='".$_POST['street']."' ";
			 $result_sq = $connection->createCommand($sq)->queryAll();

			 $count=0;

			 $re=array();

			foreach($result_sq as $key1){$count=$count+1;}

			if($count!=0)

			 {

				  $error="Street Name Already Exists";

			}	

			if(empty($error))

			{            

				$sql  = "INSERT INTO streets(street,project_id,sector_id,block_id,create_date) VALUES('".$_POST['street']."','".$_POST['project_id']."','".$_POST['sector_id']."','".$_POST['block']."','".date('Y-m-d')."')";	



                $command = $connection -> createCommand($sql);

		       $command -> execute();

				 echo "New Record Inserted Successfully";

				 echo '<span style="float:right"><a href="'. Yii::app()->request->baseUrl.'/index.php/streets/streets_list"'.'class="btn-info button">Back To List</a></span>';



			}

			if(!empty($error))

			{

				echo $error;

			}

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



	
  public function actionStreets_list()
	{	 
	 $connection = Yii::app()->db; 
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
		$this->layout='//layouts/back';
       	$and = false;
			$where='';
	if (!empty($_POST['sector'])){				
				if ($and==false)
				{
					$where.="where streets.sector_id LIKE '%".$_POST['sector']."%'";
				}
				else
				{
					$where.="where streets.sector_id LIKE '%".$_POST['sector']."%'";
				}
				
			}
			if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="and streets.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="and streets.project_id LIKE '%".$_POST['project_id']."%'";
				}
				
			}
 $sql="SELECT
    projects.id
    , streets.create_date
    , streets.id
	, streets.street
	,streets.sector_id
	, streets.project_id
    , projects.project_name
	 , blocks.block_name
	, sectors.sector_name
	, streets.street
FROM
    streets
	Left JOIN projects  ON (streets.project_id = projects.id) 
	Left JOIN blocks  ON (streets.block_id = blocks.id) 
	Left JOIN sectors  ON (streets.sector_id = sectors.id) 
	 $where ORDER BY streets.street,sectors.sector_name ASC "; 
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	$this->render('streets_list',array('streets'=>$result,'projects'=>$result_project));
	   }

	  	else{
		$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	



	/**



	 * Deletes a particular model.



	 * If deletion is successful, the browser will be redirected to the 'admin' page.



	 * @param integer $id the ID of the model to be deleted



	 */



/////////////////////////DELETE STREET//////////////



	public function actionDelete_Streets()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
        $connection = Yii::app()->db; 
	    $sql_check = "SELECT * from plots where street_id=".$_GET['id'];
	    $result_check = $connection->createCommand($sql_check)->queryAll();
	    if (empty($result_projects_check)){
		$connection = Yii::app()->db; 
		$sql_del = "DELETE from streets where id=".$_GET['id'];
		$command = $connection -> createCommand($sql_del);
        $command -> execute();
		$this->redirect (array('streets/streets_list?error=0'));
		}
	else 
	{
		$this->redirect (array('streets/streets_list?error=1'));
	}
		}
	  else{
		  $this->redirect (array('user/user'));
	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
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



  public function actionUpdate_streets()
     	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
$sql = "SELECT
    projects.id
    , streets.create_date
    , streets.id
	, streets.street
	, streets.project_id
	, streets.sector_id
    , projects.project_name
	, sectors.sector_name
	, streets.street
FROM
    streets
	Left JOIN projects  ON (streets.project_id = projects.id) 
	Left JOIN sectors  ON (streets.sector_id = sectors.id) 
	where streets.id=".$_GET['id']."";
	$result = $connection->createCommand($sql)->query();
	$this->render('update_streets',array('update_streets'=>$result));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }


	/////////////////////////// function for update project 
	public function actionUpdate_stree()
	     {
		 $connection = Yii::app()->db;
				 $error =array();
     			$id=$_POST['id'];
				if(isset($_POST['project_id']) && empty($_POST['project_id']))
				{
				$error = 'Please Select Project<br>';
			}
			if(isset($_POST['street']) && empty($_POST['street']))
			{
				$error .= 'Please Select Street<br>';
			}
					  $sq  = "SELECT * from streets where project_id='".$_POST['project_id']."' AND  sector_id='".$_POST['Sector_id']."' AND street='".$_POST['street']."' ";
			 $result_sq = $connection->createCommand($sq)->queryAll();
			 $count=0;
			 $re=array();
			 foreach($result_sq as $key1){$count=$count+1;}
			if($count!=0)
			 {
				  $error="Street Name Already Exists";
			}	
					$project_id=$_POST['project_id'];
			 $street=$_POST['street'];
			  $create_date=$_POST['create_date'];
			  $sector_id=$_POST['Sector_id'];
            if(empty($error))
			{	
			 $sql_update = "UPDATE streets SET project_id ='$project_id',street ='$street',sector_id=$sector_id,create_date ='$create_date' WHERE id =".$id;
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			    echo $note="Record Updated Successfully";
			}
			if(!empty($error))
			{
				echo $error;
			}
	   }






	



	public function actionStreets()



	{



		



		if(Yii::app()->session['user_array']['per3']=='1')



		{



		$connection = Yii::app()->db;  



		$sql_project  = "SELECT * from projects";



		$result_projects = $connection->createCommand($sql_project)->query();



	$sql_sector  = "SELECT * from sectors";



		$result_sectors = $connection->createCommand($sql_sector)->query();



		$this->render('streets',array('projects'=>$result_projects, 'sectors'=>$result_sectors));

	

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



