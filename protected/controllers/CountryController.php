<?php



class CountryController extends Controller

{
 public function actionUpdate()

     	{

		if(Yii::app()->session['user_array']['per5']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	 $sql= "SELECT
    city.*, country.country
FROM
    tbl_city city
	Left JOIN tbl_country country   ON (city.country_id = country.id) 
	 where city.id='".$_GET['id']."'";

	$result = $connection->createCommand($sql)->query();
	$sql_country = "SELECT * from tbl_country";
	$result_country = $connection->createCommand($sql_country)->query();
	
	$this->render('update',array('pla'=>$result,'country'=>$result_country));

	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
public function actionCityupdate()

	{       
	
		if(Yii::app()->session['user_array']['per5']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

			   $connection = Yii::app()->db;  
				

			   $sql="UPDATE tbl_city set 
			 country_id='".$_POST['country_id']."',
			  city='".$_POST['city']."',
			 zipcode='".$_POST['zipcode']."' where id=".$_POST['ide']."";
			 
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'City Updated Successfully';
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
			  
	}
	
  public function actionListreq()

	{
		
			  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per5']=='1')

			{
		
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {
		$this->layout='//layouts/back';
		
       	$and = false;
			$where='';
		//echo $_POST['project_id']; exit;
		if (!empty($_POST['country_id'])){				
				if ($and==true)
				{
					$where.=" city.country_id LIKE '%".$_POST['country_id']."%'";
				}
				else
				{
					$where.=" city.country_id LIKE '%".$_POST['country_id']."%'";
				}
				$and=true;
			}
			if (!empty($_POST['city_id'])){				
				if ($and==true)
				{
					$where.="and city.city LIKE '%".$_POST['city_id']."%'";
				}
				else
				{
					$where.=" city.city LIKE '%".$_POST['city_id']."%'";
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
 $sql_memberas = "SELECT city.*, country.country FROM tbl_city city
	Left JOIN tbl_country country   ON (city.country_id = country.id) 
	  where $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 

	
 $sql="SELECT
    city.*, country.country
FROM
    tbl_city city
	Left JOIN tbl_country country   ON (city.country_id = country.id) 
	where $where ORDER BY `city` ASC
	 limit $start,$limit"; 
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
			

			echo '<tr><td>'.$i.'</td><td>'.$key['country'].'</td><td>'.$key['city'].'</td><td>'.$key['zipcode'].'</td>
			<td><a target="_blank" href="'.Yii::app()->request->baseUrl.'/index.php/country/update?id='.$key['id'].'">Edit</a>/
			<a href="#" onclick="deletethis('.$key['id'].','.$key['id'].')">Delete</a>
			</td></tr>';

$i++;
			}?>

			 <script>
    function deletethis(id,idd){
		var x = confirm("Are you sure you want to delete?");
 
if(x == true){

window.location="Delete_city?id=" + id + "&&did=" + idd + "";

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
 echo '<tr  ><td colspan="5"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="5">'.$pagination.'</td></tr>'; exit; 
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
     public function actionCitieslist()

	{
			  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per5']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {
		$this->layout='//layouts/back';
		
       	$and = false;
			$where='';
		//echo $_POST['project_id']; exit;
		if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="where ins.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="where ins.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
	

	//$sql = "SELECT * FROM streets";
 $sql="SELECT
    ins.id
    , ins.project_id
    , ins.category_id
	, ins.tno
	, ins.description
	, ins.tamount
    , projects.project_name
	
	,size_cat.size
FROM
    installment_plan ins
	Left JOIN projects  ON (ins.project_id = projects.id) 
    Left JOIN size_cat  ON (ins.category_id = size_cat.id) 

	 $where "; 
	$result = $connection->createCommand($sql)->query();
	$sql_country = "SELECT * from tbl_country";
	$result_country = $connection->createCommand($sql_country)->query();
	

	$this->render('citieslist',array('streets'=>$result,'country'=>$result_country));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
		public function actionCreate()

	{	

		if(Yii::app()->session['user_array']['per5']=='1')

			{

		

		$error = '';

		 $connection = Yii::app()->db;

		if ((isset($_POST['country']) && empty($_POST['country'])) )

		{

			$error = 'Please complete all required fields <br />';

		}

			

		

		if(empty($error))

		        {

				  

				$country = ($_POST['country']);

				

			    ;

			  

				  

                $sql  = "INSERT INTO tbl_country(country) VALUES('".$country."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();
					
				$note="Message";
				$this->redirect(array('country/country_list','note'=>$note) );
				
				//$this->redirect(array('country/country_list'));

				

				

				}

		

		

			}

			exit;

	}

	

		public function actionaddcity()

	{

		

		if(Yii::app()->session['user_array']['per5']=='1')

			{

		

		$error = '';

		 $connection = Yii::app()->db;

		if ((isset($_POST['city']) && empty($_POST['city'])) && (isset($_POST['zipcode']) && empty($_POST['zipcode'])) )

		{

			$error = 'Please complete all required fields <br />';

		}

			

		

		if(empty($error))

	      {

				  

				$city = ($_POST['city']);

				$country_id =($_POST['country_id']);

				$zipcode =($_POST['zipcode']);

				$sql  = "INSERT INTO tbl_city(city,country_id,zipcode) VALUES('".$city."','".$country_id."','".$zipcode."')";		

                $command = $connection -> createCommand($sql);

                $command -> execute();

				
				$this->redirect(array('country/citieslist') );
				
				

				

				}

		

		

			}

			exit;

	}

	

	public function actionCity()

	{

	 if(Yii::app()->session['user_array']['per5']=='1')

	{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	     $connection = Yii::app()->db;

				$country  = "SELECT * from tbl_country";

			    $result_charges = $connection->createCommand($country)->query();

			   $this->render('city',array('country'=>$result_charges));

				

			

		}

		else{

			$this->redirect(array('user/user'));

		

			}

	}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	

	

	

	public function actionCountry()

	{

	 if(Yii::app()->session['user_array']['per5']=='1')

	{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{	

				$this->render('country');

			

		}

		else{

			$this->redirect(array('user/user'));

		

			}

	}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

	

	function actionDoc_Upload()

	 {

		

		$this->layout='//layouts/front';

			$this->render('Doc_Upload');

		 

	}

	

	public function actionCountry_list()

	{	

	if(Yii::app()->session['user_array']['per5']=='1')

	  {

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM tbl_country";

	$result = $connection->createCommand($sql)->query();

	$this->render('country_list',array('country'=>$result));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}

	  }else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}	 

	  

	  public function actionCity_list()

	{	

	if(Yii::app()->session['user_array']['per5']=='1')

	  {

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 

	$sql = "SELECT * FROM tbl_city";

	$result = $connection->createCommand($sql)->query();

	$this->render('city_list',array('city'=>$result));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}

	  }else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}	 

	

	public function loadModel($id)

	{

		$model=User::model()->findByPk($id);

		if($model===null)

			throw new CHttpException(404,'The requested page does not exist.');

		return $model;

	}

	

	 function actionDelete_country()

	 {     

	 			if(Yii::app()->session['user_array']['per5']=='1')

			{

	 

	 		  $uid=Yii::app()->session['user_array']['id'];

			  $uid;

			 

			   $connection = Yii::app()->db;

	  		   $sql  = "Delete from tbl_country where id=".$_GET['did'];
               $command = $connection -> createCommand($sql);

               $command -> execute();

			   

		 	   $this->redirect(array("country/country_list"));		

			   

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	 function actionDelete_city()

	 {     

	 			if(Yii::app()->session['user_array']['per5']=='1')

			{

	 

	 		  $uid=Yii::app()->session['user_array']['id'];

			  $uid;

			 

			   $connection = Yii::app()->db;

	  		   $sql  = "Delete from tbl_city where id=".$_GET['did'];

               $command = $connection -> createCommand($sql);

               $command -> execute();

			   

		 	   $this->redirect(array("country/citieslist"));		

			   

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

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

