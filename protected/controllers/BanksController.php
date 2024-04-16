<?php



class BanksController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	 

	public function actionCreate()
	{	
		$error = '';
		 $connection = Yii::app()->db;
		if (isset($_POST['project']) && empty($_POST['name']))
		{
			$error = 'Please complete all required fields <br />';
		}
		if(empty($error))
		        {
				$title =($_POST['name']);
                $sql  = "INSERT INTO bank(project_id,name,disc,code) VALUES('".$_POST['project']."','".$title."','".$_POST['details']."','".$_POST['cpode']."')";		
                $command = $connection -> createCommand($sql);
                $command -> execute();
				//$note="Message";
			   $this->redirect(array('bank/bank_list') );
		}else{echo $error;}
		
	}
 public function actionBankslistreq()

	{
		
			  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per3']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {
		   
		   
		$this->layout='//layouts/back';
		
       	$and = false;
			$where='';
		
		if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="where bank.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="where bank.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
			
	//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 15;}
$adjacent = 15;
$page = $_REQUEST['page'];

if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 
$connection = Yii::app()->db; 
$sql_memberas = "SELECT bank.*,projects.project_name FROM bank
	left join projects on(projects.id=bank.project_id)
	 $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
	
		//for Pagination end 

	//$sql = "SELECT * FROM streets";
 $sql="SELECT bank.*,projects.project_name FROM bank
	left join projects on(projects.id=bank.project_id)
	 $where  limit $start,$limit"; 
	$result_members = $connection->createCommand($sql)->query();
	
	
   $i=1;
	$count=0;
     if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 

      $check=1;

    $res=array();



            foreach($result_members as $key){



            $count++;

		echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl; 
			
        echo '<tr><td>'.$i.'</td><td>'.$key['name'].'</td><td>'.$key['project_name'].'</td><td>'.$key['code'].'</td><td></td>
			<td><a href="'.Yii::app()->request->baseUrl.'/index.php/banks/update_bank?id='.$key['id'].'">Edit</a>
			<a href="#" onclick="deletethis('.$key['id'].','.$key['id'].')">Delete</a>
			</td></tr>'; 

$i++;
			}?>

			 <script>
    function deletethis(id,idd){
		var x = confirm("Are you sure you want to delete?");
 
if(x == true){

window.location="Delete_banks?id=" + id + "&&did=" + idd + "";

}
if(x == false){return false;}
}
    
    </script>

		

			

			<?php }
			// for pagination 
$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	$adjacents=$adjacent;
	if($lastpage > 1)
	{	if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
		else{	}
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
        	}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
		else{
			}
		$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
		$pagination.= "</div>\n";		
	}
 echo '<tr  ><td colspan="6"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="6">'.$pagination.'</td></tr>'; exit; 
	// for pagination END 
	exit;

	echo $count.' result found' ;exit;

	    if(isset($_POST['username']) && empty($_POST['username']))

			{
			$error = 'Please enter username<br>';
		}

		if(isset($_POST['password']) && empty($_POST['password']))
	{
			$error .= 'Please enter Password<br>';
			}
		if(empty($error))
	{



				  $username = $_POST['username'];



				 $password = md5($_POST['password']);



				  $connection = Yii::app()->db;  



				   $sql = "SELECT * FROM user where username ='".$username."' AND  password='".$password."' AND status=1";



				  $result_data = $connection->createCommand($sql)->queryRow();



				  if($result_data)



				  {



						Yii::app()->session['user_array'] = $result_data;



						echo 1;exit();



				  }else



				  {



					 echo "Invalid Username and Password"; 



				  }



			}else
		{

		echo $error;

			}
	exit;	

	//$this->render('list',array('streets'=>$result,'projects'=>$result_project,'size'=>$result_size));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}	
	public function actionBank_list()

	{	

	 if(Yii::app()->session['user_array']['per3']=='1')

			{

		

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT bank.*,projects.project_name FROM bank
	left join projects on(projects.id=bank.project_id)
	";
	
	$result_projects = $connection->createCommand($sql_projects)->query();
	
	$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 =   "select * from projects where";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
		$sql_project = $sql1;
		$sql_project = $sql_project.implode(' or',$sql2);
		
		
		$projects = $connection->createCommand($sql_project)->query() or mysql_error();
	
	$this->render('banks_list',array('categories'=>$result_projects,'projects'=>$projects));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	public function actionUpdate_Bank()

	{

		if(Yii::app()->session['user_array']['per3']=='1')

			{

	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {	

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM bank where id=".$_GET['id'];

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
		   
			 $name=$_POST['name'];

			 $sql_update = "UPDATE bank SET name ='".$_POST['name']."',code ='".$_POST['code']."',disc ='".$_POST['details']."' WHERE id =".$id;

	

    		 $command = $connection -> createCommand($sql_update);

              $command -> execute();

			  $this->redirect(array("bank_list"));	

			}

			else{

				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

			}

	   }



	 function actionDelete_banks()

	 {

		 

		if(Yii::app()->session['user_array']['per3']=='1')

			{

		  $connection = Yii::app()->db;

	  $sql  = "Delete from bank where id=".$_REQUEST['did'];

               $command = $connection -> createCommand($sql);

               $command -> execute();

			

		 		 $this->redirect(array("banks/bank_list"));

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

	

	

	

	

	

	public function actionBank()

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

