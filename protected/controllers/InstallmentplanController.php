<?php



class InstallmentplanController extends Controller

{

	
public function actionInstallmentplan()
{

	 if(Yii::app()->session['user_array']['per3']=='1')

			{

	

		$connection = Yii::app()->db;  

		$sql_country  = "SELECT * from size_cat
		";

		$result_size = $connection->createCommand($sql_country)->query();

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
		
		
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
	
		

		$this->render('installmentplan',array('projects'=>$result_projects,'size'=>$result_size));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

}


	public function actionAdd()
	 	{ 
			if(Yii::app()->session['user_array']['per3']=='1')
			{   
			$error='';
			 $error =array();
			$connection = Yii::app()->db;
			if(!empty($_POST['tno'])){ 
				if(!(ctype_digit($_POST['tno']))){
					$error="Please Enter Only Digit In Total No.";
					}					 
			}
              if(empty($error))
								{		 
				 $sql  = "INSERT INTO installment_plan (project_id,description,category_id,p_type,tamount,tno,
				 lab1,lab2,lab3,lab4,lab5,lab6,lab7,lab8,lab9,lab10,
				 lab11,lab12,lab13,lab14,lab15,lab16,lab17,lab18,lab19,lab20,
				 lab21,lab22,lab23,lab24,lab25,lab26,lab27,lab28,lab29,lab30,
				 lab31,lab32,lab33,lab34,lab35,lab36,lab37,lab38,lab39,lab40,
				 lab41,lab42,lab43,lab44,lab45,lab46,lab47,lab48,lab49,lab50,
				 lab51,lab52,lab53,lab54,lab55,lab56,lab57,lab58,lab59,lab60,
				 lab61,lab62,
				 `1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`11`,`12`,`13`,`14`,`15`,`16`,`17`,`18`,`19`,`20`,`21`,`22`,`23`,`24`,`25`,`26`,`27`,`28`,`29`,`30`,`31`,`32`,`33`,`34`,`35`,`36`, `37`,`38`,`39`,`40`,`41`,`42`,`43`,`44`,`45`,`46`,`47`,`48`,`49`,`50`,`51`,`52`,`53`,`54`,`55`,`56`,`57`,`58`,`59`,`60`,`61`,`62`)
				  VALUES ('".$_POST['project']."','".$_POST['description']."','".$_POST['category_id']."','".$_POST['p_type']."','".$_POST['tamount']."','".$_POST['tno']."',
				  
				  '".$_POST['lab1']."','".$_POST['lab2']."','".$_POST['lab3']."','".$_POST['lab4']."','".$_POST['lab5']."','".$_POST['lab6']."','".$_POST['lab7']."','".$_POST['lab8']."','".$_POST['lab9']."','".$_POST['lab10']."','".$_POST['lab11']."','".$_POST['lab12']."','".$_POST['lab13']."','".$_POST['lab14']."','".$_POST['lab15']."','".$_POST['lab16']."','".$_POST['lab17']."','".$_POST['lab18']."','".$_POST['lab19']."','".$_POST['lab20']."','".$_POST['lab21']."','".$_POST['lab22']."','".$_POST['lab23']."','".$_POST['lab24']."','".$_POST['lab25']."','".$_POST['lab26']."','".$_POST['lab27']."','".$_POST['lab28']."','".$_POST['lab29']."','".$_POST['lab30']."','".$_POST['lab31']."','".$_POST['lab32']."','".$_POST['lab33']."','".$_POST['lab34']."','".$_POST['lab35']."','".$_POST['lab36']."','".$_POST['lab37']."','".$_POST['lab38']."','".$_POST['lab39']."','".$_POST['lab40']."','".$_POST['lab41']."','".$_POST['lab42']."','".$_POST['lab43']."','".$_POST['lab44']."','".$_POST['lab45']."','".$_POST['lab46']."','".$_POST['lab47']."','".$_POST['lab48']."','".$_POST['lab49']."','".$_POST['lab50']."','".$_POST['lab51']."','".$_POST['lab52']."','".$_POST['lab53']."','".$_POST['lab54']."','".$_POST['lab55']."','".$_POST['lab56']."','".$_POST['lab57']."','".$_POST['lab58']."','".$_POST['lab59']."','".$_POST['lab60']."','".$_POST['lab61']."','".$_POST['lab62']."'				  
				  
,'".$_POST['1']."','".$_POST['2']."','".$_POST['3']."','".$_POST['4']."','".$_POST['5']."','".$_POST['6']."','".$_POST['7']."','".$_POST['8']."','".$_POST['9']."','".$_POST['10']."','".$_POST['11']."','".$_POST['12']."','".$_POST['13']."','".$_POST['14']."','".$_POST['15']."','".$_POST['16']."','".$_POST['17']."','".$_POST['18']."','".$_POST['19']."','".$_POST['20']."','".$_POST['21']."','".$_POST['22']."','".$_POST['23']."','".$_POST['24']."','".$_POST['25']."','".$_POST['26']."','".$_POST['27']."','".$_POST['28']."','".$_POST['29']."','".$_POST['30']."','".$_POST['31']."','".$_POST['32']."','".$_POST['33']."','".$_POST['34']."','".$_POST['35']."','".$_POST['36']."','".$_POST['37']."','".$_POST['38']."','".$_POST['39']."','".$_POST['40']."','".$_POST['41']."','".$_POST['42']."','".$_POST['43']."','".$_POST['44']."','".$_POST['45']."','".$_POST['46']."','".$_POST['47']."','".$_POST['48']."','".$_POST['49']."','".$_POST['50']."','".$_POST['51']."','".$_POST['52']."','".$_POST['53']."','".$_POST['54']."','".$_POST['55']."','".$_POST['56']."','".$_POST['57']."','".$_POST['58']."','".$_POST['59']."','".$_POST['60']."','".$_POST['61']."','".$_POST['62']."')";	
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
                        //$command -> execute();
					echo 'Installment Plan Added Successfully';
                    exit;
						

				}
				else{
					echo $error;
					}

		}

		

	}

    public function actionListreq()

	{
		//echo 123;exit;
			  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per3']=='1')

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
			if (isset($_POST['size']) && $_POST['size']!=""){
				$plotno=$_POST['size'];
				if ($and==true)
				{
					  $where.=" and size_cat.id LIKE '%".$_POST['size']."%'";
				}
				else
				{
					$where.=" size_cat.id LIKE '%".$_POST['size']."%'";
				}
				$and=true;
			}
			if (isset($_POST['p_type']) && $_POST['p_type']!=""){
				
				if ($and==true)
				{
					  $where.=" and ins.p_type LIKE '%".$_POST['p_type']."%'";
				}
				else
				{
					$where.=" ins.p_type LIKE '%".$_POST['p_type']."%'";
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
echo $sql_memberas = "SELECT
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
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 

	//$sql = "SELECT * FROM streets";
 $sql="SELECT
    ins.id
    , ins.project_id
    , ins.category_id
	, ins.tno
	,ins.p_type
	, ins.description
	, ins.tamount
    , projects.project_name
	
	,size_cat.size
FROM
    installment_plan ins
	Left JOIN projects  ON (ins.project_id = projects.id) 
    Left JOIN size_cat  ON (ins.category_id = size_cat.id) 

	 $where  limit $start,$limit"; 
	$result_members = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	 $sql_size  = "SELECT * from size_cat";
	$result_size = $connection->createCommand($sql_size)->query();
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
			

			echo '<tr><td>'.$i.'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td>
			<td>';if($key['p_type']=='R'){echo 'Residential';} elseif($key['p_type']=='C'){echo'Commercial';}   echo'</td>
			<td>'.$key['description'].'</td><td>'.$key['tno'].'</td><td style="text-align:right;">'.$key['tamount'].'</td><td><a target="_blank" href="'.Yii::app()->request->baseUrl.'/index.php/installmentplan/update?id='.$key['id'].'">Edit</a>/
			<a href="#" onclick="deletethis('.$key['id'].','.$key['id'].')">Delete</a>
			</td></tr>';

$i++;
			}?>

			 <script>
    function deletethis(id,idd){
		var x = confirm("Are you sure you want to delete?");
 
if(x == true){

window.location="Delete?id=" + id + "&&did=" + idd + "";

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
 echo '<tr  ><td colspan="7"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="7">'.$pagination.'</td></tr>'; exit; 
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
	  public function actionlist()

	{
			  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per3']=='1')

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
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	 $sql_size  = "SELECT * from size_cat";
	$result_size = $connection->createCommand($sql_size)->query();
     

	$this->render('list',array('streets'=>$result,'projects'=>$result_project,'size'=>$result_size));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

 public function actionUpdate()

     	{

		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	 $sql= "SELECT
    projects.project_name
	,size_cat.size
	,ins.*
    FROM
    installment_plan ins
	Left JOIN projects  ON (ins.project_id = projects.id)
	  Left JOIN size_cat  ON (ins.category_id = size_cat.id)  

	  WHERE ins.id='".$_GET['id']."'";

	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
   $sql_size = "SELECT * from size_cat";
	$result_size = $connection->createCommand($sql_size)->query();

	$this->render('update',array('pla'=>$result,'projects'=>$result_project,'size'=>$result_size));

	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
public function actionPlanupdate()

	{       
	
		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

			   $connection = Yii::app()->db;  
				

			   $sql="UPDATE installment_plan set 
			 project_id='".$_POST['project_id']."',
			  p_type='".$_POST['p_type']."',
			  description='".$_POST['description']."',
			 category_id='".$_POST['category_id']."',
			 tno='".$_POST['tno']."',
			 tamount='".$_POST['tamount']."',
			 lab1='".$_POST['lab1']."',
			 lab2='".$_POST['lab2']."',
			 lab3='".$_POST['lab3']."',
			 lab4='".$_POST['lab4']."',
			 lab5='".$_POST['lab5']."',
			 lab6='".$_POST['lab6']."',
			 lab7='".$_POST['lab7']."',
			 lab8='".$_POST['lab8']."',
			 lab9='".$_POST['lab9']."',
			 lab10='".$_POST['lab10']."',
			 lab11='".$_POST['lab11']."',
			 lab12='".$_POST['lab12']."',
			 lab13='".$_POST['lab13']."',
			 lab14='".$_POST['lab14']."',
			 lab15='".$_POST['lab15']."',
			 lab16='".$_POST['lab16']."',
			 lab17='".$_POST['lab17']."',
			 lab18='".$_POST['lab18']."',
			 lab19='".$_POST['lab19']."',
			 lab20='".$_POST['lab20']."',
			 lab21='".$_POST['lab21']."',
			 lab22='".$_POST['lab22']."',
			 lab23='".$_POST['lab23']."',
			 lab24='".$_POST['lab24']."',
			 lab25='".$_POST['lab25']."',
			 lab26='".$_POST['lab26']."',
			 lab27='".$_POST['lab27']."',
			 lab28='".$_POST['lab28']."',
			 lab29='".$_POST['lab29']."',
			 lab30='".$_POST['lab30']."',
             lab31='".$_POST['lab31']."',
			 lab32='".$_POST['lab32']."',
			 lab33='".$_POST['lab33']."',
			 lab34='".$_POST['lab34']."',
			 lab35='".$_POST['lab35']."',
			 lab36='".$_POST['lab36']."',
			 lab37='".$_POST['lab37']."',
			 lab38='".$_POST['lab38']."',
			 lab39='".$_POST['lab39']."',
			 lab40='".$_POST['lab40']."',
			 lab41='".$_POST['lab41']."',
			 lab42='".$_POST['lab42']."',
			 lab43='".$_POST['lab43']."',
			 lab44='".$_POST['lab44']."',
			 lab45='".$_POST['lab45']."',
			 lab46='".$_POST['lab46']."',
			 lab47='".$_POST['lab47']."',
			 lab48='".$_POST['lab48']."',
			 lab49='".$_POST['lab49']."',
			 lab50='".$_POST['lab50']."',
			  lab51='".$_POST['lab51']."',
			 lab52='".$_POST['lab52']."',
			 lab53='".$_POST['lab53']."',
			 lab54='".$_POST['lab54']."',
			 lab55='".$_POST['lab55']."',
			 lab56='".$_POST['lab56']."',
			 lab57='".$_POST['lab57']."',
			 lab58='".$_POST['lab58']."',
			 lab59='".$_POST['lab59']."',
			 lab60='".$_POST['lab60']."',
			 lab61='".$_POST['lab61']."',
			 lab62='".$_POST['lab62']."',
			 `1`='".$_POST['1']."',
			 `2`='".$_POST['2']."',
			 `3`='".$_POST['3']."',
			 `4`='".$_POST['4']."',
			 `5`='".$_POST['5']."', 
			 `6`='".$_POST['6']."',
			 `7`='".$_POST['7']."',
			 `8`='".$_POST['8']."', 
			 `9`='".$_POST['9']."',
			 `10`='".$_POST['10']."',
			 `11`='".$_POST['11']."',
			 `12`='".$_POST['12']."',
			 `13`='".$_POST['13']."',
			 `14`='".$_POST['14']."',
			 `15`='".$_POST['15']."', 
			 `16`='".$_POST['16']."',
			 `17`='".$_POST['17']."',
			 `18`='".$_POST['18']."', 
			 `19`='".$_POST['19']."',
			 `20`='".$_POST['20']."',
			 `21`='".$_POST['21']."',
			 `22`='".$_POST['22']."',
			 `23`='".$_POST['23']."',
			 `24`='".$_POST['24']."',
			 `25`='".$_POST['25']."', 
			 `26`='".$_POST['26']."',
			 `27`='".$_POST['27']."',
			 `28`='".$_POST['28']."', 
			 `29`='".$_POST['29']."',
			 `30`='".$_POST['30']."',
			 `31`='".$_POST['31']."',
			 `32`='".$_POST['32']."',
			 `33`='".$_POST['33']."',
			 `34`='".$_POST['34']."',
			 `35`='".$_POST['35']."', 
			 `36`='".$_POST['36']."',
			 `37`='".$_POST['37']."',
			 `38`='".$_POST['38']."', 
			 `39`='".$_POST['39']."',
			 `40`='".$_POST['40']."',
			 `41`='".$_POST['41']."',
			 `42`='".$_POST['42']."',
			 `43`='".$_POST['43']."',
			 `44`='".$_POST['44']."',
			 `45`='".$_POST['45']."', 
			 `46`='".$_POST['46']."',
			 `47`='".$_POST['47']."',
			 `48`='".$_POST['48']."', 
			 `49`='".$_POST['49']."',
			 `50`='".$_POST['50']."',
			 `51`='".$_POST['51']."',
			 `52`='".$_POST['52']."',
			 `53`='".$_POST['53']."',
			 `54`='".$_POST['54']."',
			 `55`='".$_POST['55']."', 
			 `56`='".$_POST['56']."',
			 `57`='".$_POST['57']."',
			 `58`='".$_POST['58']."', 
			 `59`='".$_POST['59']."',
			 `60`='".$_POST['60']."',
			 `61`='".$_POST['61']."',
			 `62`='".$_POST['62']."' where id=".$_POST['ide']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Plan Updated Successfully';
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
			  
	}

/////////////////////////DELETE //////////////

	public function actionDelete()
	{ 
		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))
			{
				

			 $connection = Yii::app()->db; 
			 $sql_del = "DELETE from installment_plan where id=".$_GET['did'];
			 $command = $connection -> createCommand($sql_del);

             $command -> execute();

			 $this->redirect(array('installmentplan/list'));
		}
		
	  else{
		  $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
		  }
	  }


}