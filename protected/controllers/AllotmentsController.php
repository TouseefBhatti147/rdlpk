<?php
class AllotmentsController extends Controller
{

////////////////////////////START:NEW BALLOTTING////////////////////////////////
function actionView_result()
{
   if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
	   {
		   $result_members = '';
		   $pro='';
		   $st='';
		   $sector='';
		   $categories='';
		   $sizes='';
		   $result_com_res='';

		   $connection = Yii::app()->db;
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
$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();

$sql_sector ="SELECT * FROM sectors where project_id='1'";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();
$sql_plotsdata ="SELECT files_balloting_data.plot_id,memberplot.plotno,memberplot.app_no,files_balloting_data.plot_detail_address,files_balloting_data.type,projects.project_name,files_balloting_data.bid,

size_cat.size,files_balloting_data.plot_size,streets.street,sectors.sector_name,files_balloting_data.due_amount,files_balloting_data.paid_amount,files_balloting_data.paid_perc
FROM files_balloting_data
Left JOIN plots  ON (files_balloting_data.plot_id = plots.id)
Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
Left JOIN projects  ON (files_balloting_data.project_id = projects.id)
Left JOIN streets  ON (files_balloting_data.street_id = streets.id)
Left JOIN sectors  ON (files_balloting_data.sector = sectors.id)
Left JOIN size_cat  ON (size_cat.id = files_balloting_data.size2)
inner JOIN ballotting1  ON (files_balloting_data.bid = ballotting1.id) 
	  where  ballotting1.balloting_status !='2'  ORDER BY files_balloting_data.plot_detail_address ASC";
$result_plotsdata = $connection->createCommand($sql_plotsdata)->query();


$this->layout='//layouts/back';
$this->render('view_result',array('plotsdata'=>$result_plotsdata,'members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
//$this->render('ballotting_new');
	   }
	   else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
}
public function actionDraw()
{
	$connection = Yii::app()->db; 
	  $sql="UPDATE plots INNER JOIN files_balloting_data ON plots.id = files_balloting_data.plot_id
SET
    plots.type = files_balloting_data.type,
    plots.street_id = files_balloting_data.street_id,
    plots.size2 = files_balloting_data.size2,
    plots.sector = files_balloting_data.sector,
    plots.bid = files_balloting_data.bid,
	plots.plot_detail_address = files_balloting_data.plot_detail_address,
    plots.bstatus = 'done'
    
WHERE
     files_balloting_data.project_id = '".$_GET['project_id']."' AND files_balloting_data.sector = '".$_GET['sector']."' and files_balloting_data.bid='".$_GET['bid']."'";
	 $command = $connection -> createCommand($sql);
	$command -> execute();
	 $sql1="UPDATE memberplot INNER JOIN files_balloting_data ON memberplot.plot_id = files_balloting_data.plot_id
SET
 
    memberplot.bstatus = 'done'
    
WHERE
     files_balloting_data.project_id = '".$_GET['project_id']."' AND files_balloting_data.sector = '".$_GET['sector']."' and files_balloting_data.bid='".$_GET['bid']."'";
	$command = $connection -> createCommand($sql1);
	$command -> execute();
	$sql2="UPDATE ballotting1 
SET
 
    balloting_status = '2'
    
WHERE
      id='".$_GET['bid']."'";
	$command = $connection -> createCommand($sql2);
	$command -> execute();
	echo 'Balloting Completed Successfully';
	
}
public function actionDrawballoting1()
{

		   if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		   { 
			
			$where="files_balloting_data.type!=''";
			$and=''; 
			
			if (!empty($_POST['project'])){
			if($and==true)
			{
			$where.="AND files_balloting_data.project_id =".$_POST['project']."";
			}
			else
			{
			$where.="files_balloting_data.project_id=".$_POST['project']."";
			}
			$and=true;
			}
				if (isset($_POST['sector']) && $_POST['sector']!="")
				{				
				$where.=" and files_balloting_data.sector ='".$_POST['sector']."'";
								$and = true;
								$sector=$_POST['sector'];
				}
				if (isset($_POST['zone']) && $_POST['zone']!="")
				{				
				$where.=" and files_balloting_data.zone ='".$_POST['zone']."'";
								$and = true;
								$zone=$_POST['zone'];
				}
				if (isset($_POST['allotment_type']) && $_POST['allotment_type']!="")
				{				
				$where.=" and files_balloting_data.atype ='".$_POST['allotment_type']."'";
								$and = true;
								$allotment_type=$_POST['allotment_type'];
				}
				if (isset($_POST['bid']) && $_POST['bid']!="")
				{				
				$where.=" and files_balloting_data.bid ='".$_POST['bid']."'";
								$and = true;
								$bid=$_POST['bid'];
				}
				
				if (isset($_POST['street']) && $_POST['street']!="")
				{				
				$where.=" and files_balloting_data.street_id ='".$_POST['street']."'";
								$and = true;
								$street=$_POST['street'];
				}
	
	
					if (!empty($_POST['plotno'])){
					if ($and==true)
					{
						$where.=" and files_balloting_data.plotno Like '%".$_POST['procode']."-".$_POST['plotno']."%'";
					}
					else
					{
						$where.="files_balloting_data.plotno Like '%".$_POST['procode']."-".$_POST['plotno']."%'";
					}
					$and==true;
					}
	 
					if (isset($_POST['plot_detail_address']) && $_POST['plot_detail_address']!=""){
					$plot_detail_address=$_POST['plot_detail_address'];
					if ($and==true)
					{
						  $where.=" and files_balloting_data.plot_detail_address ='".$_POST['plot_detail_address']."'";
					}
					else
					{
	
						$where.=" files_balloting_data.plot_detail_address ='".$_POST['plot_detail_address']."'";
					}
					$and=true;
					}
				
	
				
$and=false;
   $connection = Yii::app()->db; 
       $sql_plotsdata ="SELECT files_balloting_data.atype,files_balloting_data.zone,files_balloting_data.plot_id,memberplot.plotno,memberplot.app_no,files_balloting_data.plot_detail_address,files_balloting_data.type,projects.project_name,files_balloting_data.bid,

	 size_cat.size,files_balloting_data.plot_size,streets.street,sectors.sector_name,files_balloting_data.due_amount,files_balloting_data.paid_amount,files_balloting_data.paid_perc
	 FROM files_balloting_data
	 inner JOIN plots  ON (files_balloting_data.plot_id = plots.id)
	 inner JOIN memberplot  ON (memberplot.plot_id = plots.id)
	 inner JOIN projects  ON (files_balloting_data.project_id = projects.id)
	 inner JOIN streets  ON (files_balloting_data.street_id = streets.id)
	 inner JOIN sectors  ON (files_balloting_data.sector = sectors.id)
	 inner JOIN size_cat  ON (size_cat.id = files_balloting_data.size2) 
	 inner JOIN ballotting1  ON (files_balloting_data.bid = ballotting1.id) 
	  where $where and ballotting1.balloting_status !='2'  ORDER BY files_balloting_data.plot_detail_address ASC
";
$result_plotsdata = $connection->createCommand($sql_plotsdata)->query();

$count=0;

$home=Yii::app()->request->baseUrl; 
$res=array();
$count='';
foreach($result_plotsdata as $key){
  $count++;        
  $home="";
  $home=Yii::app()->request->baseUrl;

	        
	$home="";
	$home=Yii::app()->request->baseUrl;
	echo '<tr><td>'.$count.'</td><td>';if(!empty($key['plotno'])){ echo $key['plotno'];}else{ echo $key['app_no'];}  echo'</td>  <td>'.$key['type'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td>
  
	<td>'.$key['street'].'</a></td><td>'.$key['sector_name'].'</td><td>'.$key['atype'].'</td><td>'.$key['due_amount'].'</td>
	<td>'.$key['paid_amount'].'</td><td>';
	 echo round($key['paid_perc']).'%';
	echo' </td><td>';if($key['zone']==0){ echo '<span style="color:Red">Zone B</span>';}else{ echo'<span style="color:Green">Zone A</span>';}echo'</td>
	<td>';if($key['bid']==1){ echo 'Balloted';}else{ echo'<a href="mergeplot?plot_id='.$key['plot_id'].'">Merge</a>';}echo'</td></tr>
	';
  
}

   
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
}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
}
function actionDrawballoting()
{
   if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
	   {
		   $result_members = '';
		   $pro='';
		   $st='';
		   $sector='';
		   $categories='';
		   $sizes='';
		   $result_com_res='';

		   $connection = Yii::app()->db;
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
$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors where project_id='1'";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();
$sql_plotsdata ="SELECT files_balloting_data.plot_id,memberplot.plotno,memberplot.app_no,files_balloting_data.plot_detail_address,files_balloting_data.type,projects.project_name,files_balloting_data.bid,

size_cat.size,files_balloting_data.plot_size,streets.street,sectors.sector_name,files_balloting_data.due_amount,files_balloting_data.paid_amount,files_balloting_data.paid_perc
FROM files_balloting_data
Left JOIN plots  ON (files_balloting_data.plot_id = plots.id)
Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
Left JOIN projects  ON (files_balloting_data.project_id = projects.id)
Left JOIN streets  ON (files_balloting_data.street_id = streets.id)
Left JOIN sectors  ON (files_balloting_data.sector = sectors.id)
Left JOIN size_cat  ON (size_cat.id = files_balloting_data.size2)";
$result_plotsdata = $connection->createCommand($sql_plotsdata)->query();


$this->layout='//layouts/back';
$this->render('drawballoting',array('plotsdata'=>$result_plotsdata,'members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
//$this->render('ballotting_new');
	   }
	   else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
}

public function actionSearchballotablef()
{

		   if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		   { 
			$where="files_balloting_data.type!=''";
			$and=''; 
			
			if (!empty($_POST['project'])){
			if($and==true)
			{
			$where.="AND files_balloting_data.project_id =".$_POST['project']."";
			}
			else
			{
			$where.="files_balloting_data.project_id=".$_POST['project']."";
			}
			$and=true;
			}
				if (isset($_POST['sector']) && $_POST['sector']!="")
				{				
				$where.=" and files_balloting_data.sector ='".$_POST['sector']."'";
								$and = true;
								$sector=$_POST['sector'];
				}
				if (isset($_POST['zone']) && $_POST['zone']!="")
				{				
				$where.=" and files_balloting_data.zone ='".$_POST['zone']."'";
								$and = true;
								$zone=$_POST['zone'];
				}
				if (isset($_POST['allotment_type']) && $_POST['allotment_type']!="")
				{				
				$where.=" and files_balloting_data.atype ='".$_POST['allotment_type']."'";
								$and = true;
								$allotment_type=$_POST['allotment_type'];
				}
				if (isset($_POST['mstatus']) && $_POST['mstatus']!="")
				{				
				$where.=" and files_balloting_data.mstatus ='".$_POST['mstatus']."'";
								$and = true;
								$mstatus=$_POST['mstatus'];
				}
				if (isset($_POST['balloting_status']) && $_POST['balloting_status']!="")
				{				
				$where.=" and files_balloting_data.type ='".$_POST['balloting_status']."'";
								$and = true;
								$balloting_status=$_POST['balloting_status'];
				}
				if (isset($_POST['street']) && $_POST['street']!="")
				{				
				$where.=" and files_balloting_data.street_id ='".$_POST['street']."'";
								$and = true;
								$street=$_POST['street'];
				}
	
	
					if (!empty($_POST['plotno'])){
					if ($and==true)
					{
						$where.=" and memberplot.plotno Like '%".$_POST['plotno']."%'";
					}
					else
					{
						$where.="files_balloting_data.plotno Like '%".$_POST['plotno']."%'";
					}
					$and==true;
					}
	 
					if (isset($_POST['plot_detail_address']) && $_POST['plot_detail_address']!=""){
					$plot_detail_address=$_POST['plot_detail_address'];
					if ($and==true)
					{
						  $where.=" and files_balloting_data.plot_detail_address ='".$_POST['plot_detail_address']."'";
					}
					else
					{
	
						$where.=" files_balloting_data.plot_detail_address ='".$_POST['plot_detail_address']."'";
					}
					$and=true;
					}
				
	
				
$and=false;
   $connection = Yii::app()->db; 
      $sql_plotsdata ="SELECT files_balloting_data.atype,files_balloting_data.zone,files_balloting_data.plot_id,memberplot.plotno,memberplot.app_no,files_balloting_data.plot_detail_address,files_balloting_data.type,projects.project_name,files_balloting_data.bid,

	 size_cat.size,files_balloting_data.plot_size,streets.street,sectors.sector_name,files_balloting_data.due_amount,files_balloting_data.paid_amount,files_balloting_data.paid_perc
	 FROM files_balloting_data
	 Left JOIN plots  ON (files_balloting_data.plot_id = plots.id)
	 Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
	 Left JOIN projects  ON (files_balloting_data.project_id = projects.id)
	 Left JOIN streets  ON (files_balloting_data.street_id = streets.id)
	 Left JOIN sectors  ON (files_balloting_data.sector = sectors.id)
	 Left JOIN size_cat  ON (size_cat.id = files_balloting_data.size2)  where $where ORDER BY files_balloting_data.plot_detail_address ASC
";
$result_plotsdata = $connection->createCommand($sql_plotsdata)->query();

$count=0;

$home=Yii::app()->request->baseUrl; 
$res=array();
$count='';
foreach($result_plotsdata as $key){
  $count++;        
  $home="";
  $home=Yii::app()->request->baseUrl;

	        
	$home="";
	$home=Yii::app()->request->baseUrl;
	echo '<tr><td>'.$count.'</td><td>';if(!empty($key['plotno'])){ echo $key['plotno'];}else{ echo $key['app_no'];}  echo'</td>  <td>'.$key['type'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td>
  
	<td>'.$key['street'].'</a></td><td>'.$key['sector_name'].'</td><td>'.$key['atype'].'</td><td>'.$key['due_amount'].'</td>
	<td>'.$key['paid_amount'].'</td><td>';
	 echo round($key['paid_perc']).'%';
	echo' </td><td>';if($key['zone']==0){ echo '<span style="color:Red">Zone B</span>';}else{ echo'<span style="color:Green">Zone A</span>';}echo'</td>
	<td>';if($key['type']=='Plot'){ echo 'Balloted';}else{ echo'<a href="mergeplot?plot_id='.$key['plot_id'].'">Merge</a>';}echo'</td></tr>
	';
  
}

   
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
}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
}
public function actionSearchballotable()
{

		   if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		   { 
			$where="plots_balloting_data.type='Plot'";
			$and=''; 
			
			if (!empty($_POST['project'])){
			if($and==true)
			{
			$where.="AND plots_balloting_data.project_id =".$_POST['project']."";
			}
			else
			{
			$where.="plots_balloting_data.project_id=".$_POST['project']."";
			}
			$and=true;
			}
				if (isset($_POST['sector']) && $_POST['sector']!="")
				{				
				$where.=" and plots_balloting_data.sector ='".$_POST['sector']."'";
								$and = true;
								$sector=$_POST['sector'];
				}
				if (isset($_POST['street']) && $_POST['street']!="")
				{				
				$where.=" and plots_balloting_data.street_id ='".$_POST['street']."'";
								$and = true;
								$street=$_POST['street'];
				}
	
	
					if (!empty($_POST['plotno'])){
					if ($and==true)
					{
						$where.=" and plots_balloting_data.plotno Like '%".$_POST['procode']."-".$_POST['plotno']."%'";
					}
					else
					{
						$where.="plots_balloting_data.plotno Like '%".$_POST['procode']."-".$_POST['plotno']."%'";
					}
					$and==true;
					}
	 
					if (isset($_POST['plot_detail_address']) && $_POST['plot_detail_address']!=""){
					$plot_detail_address=$_POST['plot_detail_address'];
					if ($and==true)
					{
						  $where.=" and plots_balloting_data.plot_detail_address ='".$_POST['plot_detail_address']."'";
					}
					else
					{
	
						$where.=" plots_balloting_data.plot_detail_address ='".$_POST['plot_detail_address']."'";
					}
					$and=true;
					}
				
	
				
$and=false;
   $connection = Yii::app()->db; 
     $sql_plotsdata ="SELECT plots_balloting_data.id,size_cat.size,projects.project_name,plots_balloting_data.plot_size,plots_balloting_data.type,streets.street,
plots_balloting_data.plot_detail_address,sectors.sector_name,plots_balloting_data.bid,plots.bstatus,plots.status as plotstatus 

 FROM plots_balloting_data
    Left JOIN plots  ON (plots_balloting_data.plot_id = plots.id)
	Left JOIN projects  ON (plots_balloting_data.project_id = projects.id)
	Left JOIN streets  ON (plots_balloting_data.street_id = streets.id)
	Left JOIN sectors  ON (plots_balloting_data.sector = sectors.id)
	Left JOIN size_cat  ON (size_cat.id = plots_balloting_data.size2)  where $where ORDER BY plots_balloting_data.plot_detail_address ASC
";
$result_plotsdata = $connection->createCommand($sql_plotsdata)->query();

$count=0;

$home=Yii::app()->request->baseUrl; 
$res=array();
$count='';
foreach($result_plotsdata as $key){
  $count++;        
  $home="";
  $home=Yii::app()->request->baseUrl;
  echo '<tr><td>'.$count.'</td><td>'.$key['size'].'</td><td>'.$key['project_name'].'</td><td>'.$key['plot_size'].'</td>
  <td>'.$key['type'].'</td><td>'.$key['plot_detail_address'].'</td>
  <td>'.$key['street'].'</a></td><td>'.$key['sector_name'].'</td>
  <td>';
  if(empty($key['plotstatus'])){ echo'Not Alotted';}else{ echo $key['plotstatus'];}echo'</td>
  <td>';
  if($key['bid']==1){ echo'Rederved for Ballot';}echo'</td>
  <td>'.$key['bstatus'].'</td></tr>';
}

   
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
}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
}
public function actionAjaxBalloting1($sec,$pro) {
	$connection = Yii::app()->db;
	  $sql_street = "SELECT * from ballotting1 	 
	 where sector='".$sec."' and project_id='".$pro."' and status='1' and balloting_status='1'";
	$result_streets = $connection->createCommand($sql_street)->query();
	$street = array();
	foreach ($result_streets as $str) {
		$street[] = $str;
	}

	echo json_encode($street);
	exit();
}
public function actionajaxBalloting($sec,$pro) {
	$connection = Yii::app()->db;
	 $sql_street = "SELECT * from ballotting1 	 
	 where sector='".$sec."' and project_id='".$pro."' and status='1' and balloting_status='0'";
	$result_streets = $connection->createCommand($sql_street)->query();
	$street = array();
	foreach ($result_streets as $str) {
		$street[] = $str;
	}

	echo json_encode($street);
	exit();
}
public function actionAjaxSector($pro) {
	$connection = Yii::app()->db;
	////$sql_street = "SELECT * from sectors where project_id='" . $val1 . "'";
	 $sql_street = "SELECT sectors.* from sectors where project_id='" . $pro . "'";
	$result_streets = $connection->createCommand($sql_street)->query();
	$street = array();
	foreach ($result_streets as $str) {
		$street[] = $str;
	}
	echo json_encode($street);
	exit();
}
public function actionCreateballot() {
	
	$connection = Yii::app()->db;
	

		$error = '';
		$error = array();
			
		if (isset($_POST['project']) && empty($_POST['project'])) {
			$error = 'Please Selec Project.<br>';
		}
		
		if (isset($_POST['desc']) && empty($_POST['desc'])) {
			$error .= 'Please Enter Description.<br>';
		}
		
		if (empty($error)) {
			$connection = Yii::app()->db;
			 $sql = 'INSERT INTO ballotting1 (project_id, sector, desc1, status, balloting_status,create_date )VALUES ( "' . $_POST['project'] . '","' . $_POST['sector'] . '", "' . $_POST['desc'] . '", "' . $_POST['status'] . '", "0", "' . date('Y-m-d') . '" )';
			 $command = $connection->createCommand($sql);
			 $command->execute();
			echo 'Successfully Created';
		} else {

			echo $error;
		}
	
}
function actionNewballott()
	 {
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
			{
	 $this->layout='//layouts/back';
	 $this->render('newballotting');
			}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	

function actionBallotting2()	 
	{
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
			{
	 $this->layout='//layouts/back';
	 $this->render('ballotting2');
	 }
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
public function actionAjaxRequest12($sec) {
	$connection = Yii::app()->db;
	$sql_street = "SELECT * from streets where sector_id='" . $sec . "'";
	$result_streets = $connection->createCommand($sql_street)->query();
	$street = array();
	foreach ($result_streets as $str) {
		$street[] = $str;
	}
	echo json_encode($street);
	exit();
}
public function actionAjaxRequest123($val1) {
	$connection = Yii::app()->db;
	$sql_city = "SELECT * from size_cat where type='" . $val1 . "'";
	$result_city = $connection->createCommand($sql_city)->query();
	$city = array();
	foreach ($result_city as $cit) {
		$city[] = $cit;
	}
	echo json_encode($city);
	exit();
}

public function actionAjaxplot($sec, $size2, $ptype,$street) {
	$connection = Yii::app()->db;
	 $sql_street = "SELECT plots_balloting_data.plot_detail_address,plots_balloting_data.plot_id as id from plots_balloting_data 	 
	 where sector='" . $sec . "' and type ='Plot' and street_id='" . $street . "' and status='' and size2='" . $size2 . "' and com_res='" . $ptype . "'";
	$result_streets = $connection->createCommand($sql_street)->query();
	$street = array();
	foreach ($result_streets as $str) {
		$street[] = $str;
	}

	echo json_encode($street);
	exit();
}
public function actionMergereservedplot() {
	if ((Yii::app()->session['user_array']['per4'] == '1') && (Yii::app()->session['user_array']['per34'] != '1')) {
	  $connection = Yii::app()->db;
	  $sql_plots = "SELECT 
plots.id
, plots.street_id
, plots.plot_size
, plots.com_res
, plots.price
, plots.cstatus
, plots.size2
, plots.create_date
, plots.sector
, plots.category_id
, plots.status
, plots.image
, plots.project_id
, plots.street_id
, plots.plot_detail_address
, memberplot.plotno
, projects.project_name
, streets.street
, size_cat.size
,sectors.sector_name
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
Left JOIN projects  ON (plots.project_id = projects.id)
Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
Left JOIN size_cat  ON (plots.size2 = size_cat.id)
Left JOIN sectors  ON (plots.sector = sectors.id)
where plots.id='" . $_REQUEST['plot_id'] . "'";
	  $result_plots = $connection->createCommand($sql_plots)->query();
	  Yii::app()->session['projects_array'];

	  $connection = Yii::app()->db;
	  $temp_projects_array = Yii::app()->session['projects_array'];
	  $num_of_projects_counter = count($temp_projects_array);
	  $num_of_projects_counter2 = $num_of_projects_counter;
	  $sql1 = "select * from projects where";
	  $num_of_projects_counter--;
	  while ($num_of_projects_counter > -1) {
		  $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
		  $num_of_projects_counter--;
	  }
	  $sql_project = $sql1;
	  $sql_project = $sql_project . implode(' or', $sql2);
	  $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

	  $num_of_category = 'SELECT count(id) as num_of_category from categories';

	  $num_of_category = $connection->createCommand($num_of_category)->queryAll();
	  $sql_categories = "SELECT * from categories";
	  $categories = $connection->createCommand($sql_categories)->query();
	  $sql_size = "SELECT * from size_cat";
	  $result_size = $connection->createCommand($sql_size)->query();
	  $sql12 = "SELECT categories.name,cat_plot.id from cat_plot
	  Left JOIN categories  ON (cat_plot.cat_id = categories.id)
	   where plot_id='" . $_REQUEST['plot_id'] . "'";
	  $result12 = $connection->createCommand($sql12)->queryAll();
	  $this->render('mergereservedplot', array('plots' => $result_plots, 'projects' => $result_projects, 'categories' => $categories, 'size' => $result_size, 'cat' => $result12));
  } else {
	  $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
  }
}
public function actionMergeplot() {
	if ((Yii::app()->session['user_array']['per4'] == '1') && (Yii::app()->session['user_array']['per34'] != '1')) {
	  $connection = Yii::app()->db;
	  $sql_plots = "SELECT 
plots.id
, plots.street_id
, plots.plot_size
, plots.com_res
, plots.price
, plots.cstatus
, plots.size2
, plots.create_date
, plots.sector
, plots.category_id
, plots.status
, plots.image
, plots.project_id
, plots.street_id
, plots.plot_detail_address
, memberplot.plotno
, projects.project_name
, streets.street
, size_cat.size
,sectors.sector_name
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
Left JOIN projects  ON (plots.project_id = projects.id)
Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
Left JOIN size_cat  ON (plots.size2 = size_cat.id)
Left JOIN sectors  ON (plots.sector = sectors.id)
where plots.id='" . $_REQUEST['plot_id'] . "'";
	  $result_plots = $connection->createCommand($sql_plots)->query();
	  Yii::app()->session['projects_array'];

	  $connection = Yii::app()->db;
	  $temp_projects_array = Yii::app()->session['projects_array'];
	  $num_of_projects_counter = count($temp_projects_array);
	  $num_of_projects_counter2 = $num_of_projects_counter;
	  $sql1 = "select * from projects where";
	  $num_of_projects_counter--;
	  while ($num_of_projects_counter > -1) {
		  $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
		  $num_of_projects_counter--;
	  }
	  $sql_project = $sql1;
	  $sql_project = $sql_project . implode(' or', $sql2);
	  $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

	  $num_of_category = 'SELECT count(id) as num_of_category from categories';

	  $num_of_category = $connection->createCommand($num_of_category)->queryAll();
	  $sql_categories = "SELECT * from categories";
	  $categories = $connection->createCommand($sql_categories)->query();
	  $sql_size = "SELECT * from size_cat";
	  $result_size = $connection->createCommand($sql_size)->query();
	  $sql12 = "SELECT categories.name,cat_plot.id from cat_plot
	  Left JOIN categories  ON (cat_plot.cat_id = categories.id)
	   where plot_id='" . $_REQUEST['plot_id'] . "'";
	  $result12 = $connection->createCommand($sql12)->queryAll();
	  $this->render('mergeplot', array('plots' => $result_plots, 'projects' => $result_projects, 'categories' => $categories, 'size' => $result_size, 'cat' => $result12));
  } else {
	  $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
  }
}
public function actionMerge() {
	$connection = Yii::app()->db;
	if (Yii::app()->session['user_array']['per4'] == '1') {

		$error = '';
		$error = array();


		if (isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address'])) {
			$error = 'Please Enter Plot No.<br>';
		}
		if (!empty($_POST['plot_detail_address'])) {
			$sq = "SELECT * from plots where id='" . $_POST['plot_detail_address'] . "'";
			$result_sq = $connection->createCommand($sq)->queryRow();
			if (empty($result_sq)) {
				$error = 'Plot Not found';
			}
		}
		if (empty($error)) {
			
			     $sql = "UPDATE  files_balloting_data set type='Plot',street_id='" . $result_sq['street_id'] . "',mstatus='" . $_POST['mstatus'] . "',plot_detail_address='" . $result_sq['plot_detail_address'] . "',plot_size='" . $result_sq['plot_size'] . "',size2='" . $result_sq['size2'] . "',sector='" . $result_sq['sector']  . "',bid='" . $_POST['balloting_id']  . "' where plot_id='" . $_POST['plot_id'] . "' ";
				 $command = $connection -> createCommand($sql);
				$command -> execute();   
	
			
			 $query = 'DELETE from  plots_balloting_data 
		   where plot_id=' . $_POST['plot_detail_address'] . '';
			$command = $connection->createCommand($query);
			$command->execute();

			echo 'Successfully Convert';
		} else {

			echo $error;
		}
	}
}


public function actionFilterdata()
	{
		     $connenction=yii::app()->db;
			$sqlchdel="Delete from files_balloting_data where paid_perc<'".$_POST['min']."'";
			$cmd=$connenction->CreateCommand($sqlchdel);
			$cmd->execute();
			echo 'Record Filtered Successfully';
	}
function actionBallotting1()
	 {
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
			{
	 $this->layout='//layouts/back';
	 $this->render('ballotting1');
	 }

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionFilesdata()
	{ 

	      $connection = Yii::app()->db;  
	         $error =array();
	         $ctag='';
			if(isset($_POST['project_id']) && empty($_POST['project_id']))
			{
         	$error .= 'Please Select Plot Project<br>';
			} 
				if(isset($_POST['sector_id']) && empty($_POST['sector_id']))
			{
				$error = 'Please Select Sector<br>';
			}
			  if(empty($error))
			{
				
						$connection = Yii::app()->db;
						//$truncate="TRUNCATE TABLE files_balloting_data"; 
						//$restruncate=$connection->createCommand($truncate);
						//$restruncate->execute();
						$count=0;
							$due_amount='';
							$paid_amount='';
							$discount='';
							$price='';
							     $sqlplots="
							INSERT INTO files_balloting_data(
								plot_id,
								TYPE,
								project_id,
								block_id,
								street_id,
								plot_detail_address,
								plot_size,
								price,
								size2,
								com_res,
								sector,
								atype
							)
							SELECT
								id,
								type,
								project_id,
								block_id,
								street_id,
								plot_detail_address,
								plot_size,
								price,
								size2,
								com_res,
								sector,
								atype
							FROM
								plots
							WHERE
								plots.status !='' and plots.type = 'file' AND project_id = '".$_GET['project_id']."' AND sector = '".$_GET['sector']."'";
								/* $sqlplots="UPDATE files_balloting_data
									JOIN plots ON files_balloting_data.plot_id = plots.id
									SET
										files_balloting_data.TYPE = plots.type,
										files_balloting_data.project_id = plots.project_id,
										files_balloting_data.block_id = plots.block_id,
										files_balloting_data.street_id = plots.street_id,
										files_balloting_data.plot_detail_address = plots.plot_detail_address,
										files_balloting_data.plot_size = plots.plot_size,
										files_balloting_data.price = plots.price,
										files_balloting_data.size2 = plots.size2,
										files_balloting_data.com_res = plots.com_res,
										files_balloting_data.sector = plots.sector,
										files_balloting_data.atype = plots.atype
									WHERE plots.status !='' and plots.type = 'file' AND plots.project_id = '".$_GET['project_id']."' AND plots.sector = '".$_GET['sector']."'";*/
								$command = $connection -> createCommand($sqlplots);
								$command -> execute(); 	
									/////////////Calculate paidamount and store in table////////////////
									
									 $paidamountsql="UPDATE
									 files_balloting_data
														INNER JOIN(
															SELECT
																installpayment.plot_id,
																SUM(
																	CASE WHEN installpayment.fstatus != 'Cancelled' THEN installpayment.paidamount ELSE 0
																END
														) AS total_paid_amount,
														SUM(
															CASE WHEN installpayment.fstatus != 'Cancelled' THEN installpayment.dueamount ELSE 0
														END
														) AS total_due_amount
														FROM
																installpayment
															GROUP BY
																installpayment.plot_id
														) AS ip ON files_balloting_data.plot_id = ip.plot_id
														SET
															files_balloting_data.paid_amount = ip.total_paid_amount,
															files_balloting_data.due_amount = ip.total_due_amount,
															files_balloting_data.paid_perc = 
															ROUND( total_paid_amount / total_due_amount * 100,2)
															WHERE
															files_balloting_data.atype != 'Against Land'";
															$command = $connection -> createCommand($paidamountsql);
															$command -> execute();
															$last_insert_id = Yii::app()->db->getLastInsertID();
														
															$sqlzone="UPDATE files_balloting_data set zone='1' where paid_perc>=50";  
															$command = $connection -> createCommand($sqlzone);
															$command -> execute();	 
													echo 'Successfully done';
	
									}


						else{

							echo $error;
							}
							}
	function actionFilesballot()
	 {
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
			{
				$result_members = '';
				$pro='';
				$st='';
				$sector='';
				$categories='';
				$sizes='';
				$result_com_res='';

				$connection = Yii::app()->db;
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
$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors where project_id='1'";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();
$sql_plotsdata ="SELECT files_balloting_data.plot_id,memberplot.plotno,memberplot.app_no,files_balloting_data.plot_detail_address,files_balloting_data.type,projects.project_name,files_balloting_data.bid,

	size_cat.size,files_balloting_data.plot_size,streets.street,sectors.sector_name,files_balloting_data.due_amount,files_balloting_data.paid_amount,files_balloting_data.paid_perc
	FROM files_balloting_data
    Left JOIN plots  ON (files_balloting_data.plot_id = plots.id)
	Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
	Left JOIN projects  ON (files_balloting_data.project_id = projects.id)
	Left JOIN streets  ON (files_balloting_data.street_id = streets.id)
	Left JOIN sectors  ON (files_balloting_data.sector = sectors.id)
	Left JOIN size_cat  ON (size_cat.id = files_balloting_data.size2)";
$result_plotsdata = $connection->createCommand($sql_plotsdata)->query();


	 $this->layout='//layouts/back';
	 $this->render('files_ballot',array('plotsdata'=>$result_plotsdata,'members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
	 //$this->render('ballotting_new');
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}

public function actionPaid_perc_files_count(){
	if(isset(Yii::app()->session['user_array']['username']))
{	
$connection = Yii::app()->db;
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
$result_projects = $connection->createCommand($sql_project)->queryAll() or mysql_error();
//$sql_project = "SELECT * from projects";
//$result_project = $connection->createCommand($sql_project)->query();
$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors";
$result_sector = $connection->createCommand($sql_sector)->query();
$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();
$home=Yii::app()->request->baseUrl;
$this->render('paid_perc_files_count',array('projects'=>$result_projects,'sectors'=>$result_sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
}else{
$this->redirect(array('user/dashboard'));
}
}

	
function actionPlotsballot()
	 {
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
			{
				$result_members = '';
				$pro='';
				$st='';
				$sector='';
				$categories='';
				$sizes='';
				$result_com_res='';

				$connection = Yii::app()->db;
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
$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors where project_id='1'";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();
$sql_plotsdata ="SELECT plots_balloting_data.id,size_cat.size,projects.project_name,plots_balloting_data.plot_size,plots_balloting_data.type,streets.street,
plots_balloting_data.plot_detail_address,sectors.sector_name,plots_balloting_data.bid,plots.bstatus,plots.status as plotstatus 

 FROM plots_balloting_data
    Left JOIN plots  ON (plots_balloting_data.plot_id = plots.id)
	Left JOIN projects  ON (plots_balloting_data.project_id = projects.id)
	Left JOIN streets  ON (plots_balloting_data.street_id = streets.id)
	Left JOIN sectors  ON (plots_balloting_data.sector = sectors.id)
	Left JOIN size_cat  ON (size_cat.id = plots_balloting_data.size2) where plots_balloting_data.project_id='".$_GET['pid']."' and plots_balloting_data.sector='".$_GET['sector']."'  ORDER BY plots_balloting_data.plot_detail_address ASC
";
$result_plotsdata = $connection->createCommand($sql_plotsdata)->query();


	 $this->layout='//layouts/back';
	 $this->render('plots_ballot',array('plotsdata'=>$result_plotsdata,'members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
	 //$this->render('ballotting_new');
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	} 

public function actionPlotsdata()
	{ 
  
	      $connection = Yii::app()->db;  
	         $error =array();
	         $ctag='';
			if(isset($_POST['project_id']) && empty($_POST['project_id']))
			{
         	     $error .= 'Please Select Plot Project<br>';
			} 
				if(isset($_POST['sector']) && empty($_POST['sector']))
			{
				 $error = 'Please Select Sector<br>';
			}
			if(isset($_POST['balloting_id']) && empty($_POST['balloting_id']))
			{
				 $error = 'Please Select Balloting<br>';
			}
			  if(empty($error))
			{
				
						//$connection = Yii::app()->db;
						//$truncate="TRUNCATE TABLE plots_balloting_data"; 
						//$restruncate=$connection->createCommand($truncate);
						//$restruncate->execute();
						  $sqlplots="
						INSERT INTO plots_balloting_data(
							plot_id,
							type,
							project_id,
							block_id,
							street_id,
							plot_detail_address,
							plot_size,
							price,
							size2,
							com_res,
							sector,
							bid,
							status
						)
						SELECT
							id,
							type,
							project_id,
							block_id,
							street_id,
							plot_detail_address,
							plot_size,
							price,
							size2,
							com_res,
							sector,'".$_GET['bid']."',
							status
						FROM
							plots
						WHERE
							 plots.type = 'Plot' AND plots.status = '' AND project_id = '".$_GET['project_id']."' AND sector = '".$_GET['sector']."'";
							$command = $connection -> createCommand($sqlplots);
                            $command -> execute();   
							$sqlballot="UPDATE ballotting1 set balloting_status='1' where id='".$_GET['bid']."' ";  
							$command = $connection -> createCommand($sqlballot);
							$command -> execute();	
								echo 'Successfully done';	
		}


	else{

		echo $error;
		}
		}
////////////////////////////END: NEW BALLOTTING////////////////////////////////





public function actionMerge1()
{
	     
	   $connection = Yii::app()->db;  
		if(Yii::app()->session['user_array']['per4']=='1')
			{
			
			$sql_balres="select * from member_plot";
			$result_bal = $connection->createCommand($sql_balres)->queryAll();
			$count=0;
			foreach($result_bal as $row1){
			
			$sql_file="select * from memberplot where id='".$row1['ms_id']."'";
			$result_file = $connection->createCommand($sql_file)->queryRow();
			
			$sql_plot="select * from plots where id='".$row1['plot_id']."'";
			$result_plot = $connection->createCommand($sql_plot)->queryRow();
			
				
			   $sql="UPDATE plots set type='Plot',street_id='".$result_plot['street_id']."',plot_detail_address='".$result_plot['plot_detail_address']."',plot_size='".$result_plot['plot_size']."',size2='".$result_plot['size2']."',sector='".$result_plot['sector']."',image='".$result_plot['image']."',shap_id='".$result_plot['shap_id']."',ctag='".$result_plot['ctag']."',bstatus='".$result_plot['bstatus']."',bid='".$result_plot['bid']."' where id='".$result_file['plot_id']."' ";  
               $command = $connection -> createCommand($sql);
               $command -> execute();	
				$updatecat="UPDATE cat_plot SET plot_id='".$result_file['plot_id']."' where plot_id='".$row1['plot_id']."'";
				$command = $connection -> createCommand($updatecat);
                $command -> execute();
				 $query  = 'DELETE from  plots 
			   where id='.$row1['plot_id'].'';
		        $command = $connection -> createCommand($query);
               $command -> execute();
				echo $count.'Successfully Convert</br>';
				$count=$count+1;
				}
	    
			}


	
	
	
	}	
public function actionAjaxRequest($sec)
	{	
	$connection = Yii::app()->db;  
		$sql_street  = "SELECT * from streets where sector_id='".$sec."'";
		$result_streets = $connection->createCommand($sql_street)->query();
		$street=array();
		foreach($result_streets as $str){
			$street[]=$str;
			} 
	echo json_encode($street); exit();
	}

function actionGenpdf()
	{
			
	if (!empty($_POST['submit'])){

    include Yii::app()->baseUrl."/dompdf/dompdf_config.inc.php";

	$stream=TRUE;

    $dompdf = new DOMPDF();

	$html=$_POST['html'];

	//echo $html;exit;

	$filename='PDF File';

    $dompdf->set_paper('letter','landscape');

	$dompdf->load_html($html);

    $dompdf->render();

	$dompdf->set_base_path(realpath(APPLICATION_PATH . 'styles.css'));

    if ($stream) {

        $dompdf->stream($filename.".pdf");

    } else {

        return $dompdf->output();

    }

}}
public function actionSearchreqnew()

	 	{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
			

		$where='';
$where.="plots.bid='".$_POST['bid']."'";
		$and=true;
			if ( isset($_POST['project_name']) &&  $_POST['project_name']!=""){				

				if ($and==true)

				{

					$where.=" and plots.project_id LIKE '%".$_POST['project_name']."%'";

				}

				else

				{

					$where.=" plots.project_id LIKE '%".$_POST['project_name']."%'";

				}

				$and=true;

			}
		 if (isset($_POST['sector']) && $_POST['sector']!=""){

				$where.="plots.sector LIKE '%".$_POST['sector']."%'";

				$and = true;

				$sector=$_POST['sector'];

			}

			 if (isset($_POST['com_res']) && $_POST['com_res']!=""){

				$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";

				$and = true;

				$com_res=$_POST['com_res'];

			}

			if ($and==true)

				{

					$where.="  and type='plot' ";

				}

				else

				{

					$where.="type='plot' ";

				}

				$and=true;

			if (isset($_POST['plotno']) && $_POST['plotno']!=""){

				$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and plots.plot_detail_address ='".$_POST['plotno']."'";

				}

				else

				{

					$where.=" plots.plot_detail_address ='".$_POST['plotno']."'";

				}

				$and=true;

			}

			if (isset($_POST['size']) && $_POST['size']!=""){

				$plotno=$_POST['size'];

				if ($and==true)

				{

					  $where.=" and plots.size2 LIKE '%".$_POST['size']."%'";

				}

				else

				{

					$where.=" plots.size2 LIKE '%".$_POST['size']."%'";

				}

				$and=true;

			}

			$catt='';

			$extra1='';

			if (isset($_POST['cat']) && $_POST['cat']!=""){

			$aa=0;

			$extra1="Left JOIN cat_plot  ON (plots.id = cat_plot.plot_id)";	

				foreach($_POST['cat'] as $ass){if($aa==1){$catt.=',';} $catt.=$ass;$aa++; };

				if ($and==true)

				{

					  $where.=" and cat_plot.cat_id IN (".$catt.") GROUP by plots.id HAVING count(*) = ".$aa."";

				}

				else

				{

					$where.=" cat_plot.cat_id IN (".$catt.") GROUP by plots.id HAVING count(*) = ".$aa."";

				}

				$and=true;

			}
	if (!empty($_POST['status11'])){
		$where.=" and plots.bstatus='".$_POST['status11']."'";
		}
		

			if (!empty($_POST['stat'])){

			if($_POST['stat']==1){$where.="and plots.rstatus ='reallocated'";}

			if($_POST['stat']==2){$where.="and plots.status ='Alotted'";}

			if($_POST['stat']==3){$where.="and plots.status =''";}

			if($_POST['stat']==4){$where.="and plots.bstatus ='reserved'";}

						$and = true;	

			 } 

			if (isset($_POST['street_id']) && $_POST['street_id']!=""){

				$st=$_POST['street_id'];

				if ($and==true)

				{

					$where.=" and plots.street_id LIKE '%".$_POST['street_id']."%'";

				}

				else

				{

					$where.=" plots.street_id LIKE '%".$_POST['street_id']."%'";

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
echo $sql_memberas = "SELECT * FROM plots
    Left JOIN streets  ON (plots.street_id = streets.id)
	".$extra1."
Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)
where $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 

    $sql_member = "SELECT

    plots.id

    , plots.street_id

    , plots.plot_size
, plots.project_id
    , plots.com_res

	 , plots.size2

    , plots.rstatus

	, plots.sector

	, plots.category_id

	, plots.status

	, memberplot.fstatus

	, plots.bstatus

	, plots.plot_detail_address

	, memberplot.plotno

    , projects.project_name

	, streets.street

	, size_cat.size
	,sector_name

FROM

   plots



    Left JOIN streets  ON (plots.street_id = streets.id)

	".$extra1."

	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)

	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)

	Left JOIN size_cat  ON (size_cat.id = plots.size2)



where $where limit $start,$limit"; 


        $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();



		



		



		



		$sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();





	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

	   $sql_com ="SELECT DISTINCT com_res FROM plots";

		$result_com = $connection->createCommand($sql_com)->query();

		

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_size  = "SELECT * from size_cat";



		$sizes = $connection->createCommand($sql_size)->query();

		

 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();



            foreach($result_members as $key){



            $count++;

			/*?>
$catplot=array();

			$sql_categories1  = "SELECT * from cat_plot where plot_id='".$key['id']."'";

			$categories1 = $connection->createCommand($sql_categories1)->query();

			foreach($categories1 as $wr1){$catplot[]= $wr1['cat_id'];};

			if(isset($_POST['cat']) && $_POST['cat']!=''){

			$check=0;	

			//print_r($catplot);exit;

			//print_r($_POST['cat']);exit;

			

			if (count(array_diff($_POST['cat'], array_keys($catplot))) == 0) {

			

			$check=1;	

			}

			}
            <?php */

		

			

			echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl; 
			$F='';

			$M='';

			echo '<tr><td>'.$key['project_name'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td>';
			

			

			echo '<td>'.$key['bstatus'].'</td>';

		
echo '<td><div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a href="edit_plot?pid='.$key['id'].'&&bid='.$_POST['bid'].'">Edit</a></li>
		</td>';

			'</tr>';

			}

			 

		

			

			}

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
 echo '<tr  ><td colspan="8"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="8">'.$pagination.'</td></tr>'; exit; 
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







	
			}
	}
	function actionNewballott1()

	{

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')



			{

		$connection = Yii::app()->db;  

			

			$sql="INSERT INTO ballotting SET project='".$_POST['project']."', size='".$_POST['plot_size']."',

status='".$_POST['status']."', desc1='".$_POST['desc']."', createdate='".date('y-m-d')."'";	  



        $command = $connection -> createCommand($sql);



        $command -> execute();

		echo "New Ballot Saved ";

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

function actionResdrow()

	{
			if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{
			   $i=0;
			
				do{
					
					if($_POST['appno'.$i]!=0){
						$connection = Yii::app()->db;  
						$sql="INSERT INTO member_plot SET plot_id='".$_POST['plot_id'.$i]."', ms_id='".$_POST['appno'.$i]."'";	  
						$command = $connection -> createCommand($sql);
						$command -> execute();
					$sql="UPDATE memberplot SET bstatus='done' WHERE id='".$_POST['appno'.$i]."'";	  
						 $command = $connection -> createCommand($sql);
						$command -> execute();
					$sql="UPDATE plots SET bstatus='done' WHERE id='".$_POST['plot_id'.$i]."'";	  
						$command = $connection -> createCommand($sql);
						$command -> execute();
					}
					$i++;
				}while($_POST['tno1']>$i);
			$this->redirect(Yii::app()->baseUrl."/index.php/allotments/reserve?bid=". $_REQUEST['bid']."");
		
			exit;
		
			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

	

	

	 function actionGenerate()



	 {

			if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{

	

	 $this->layout='//layouts/back';



	 $this->render('generate_list');



		 

	}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	 function actionRefreshdraw()



	 {

			if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{

   $connection = Yii::app()->db;  

    $sql="Update ballotting SET  status='Open' where id='".$_POST['bid']."'";	  

	$command = $connection -> createCommand($sql);

	$command -> execute();

    $sql1="Delete member_plot.* From member_plot

	Left JOIN plots ON plots.id=member_plot.plot_id 

    where plots.project_id='".$_POST['project']."' and plots.size2='".$_POST['plot_size']."' ";	  

	$command = $connection -> createCommand($sql1);

	$command -> execute();

	 $this->render('ballotting');

	}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	 function actionProject_wise_list()



	 {

			if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{

	 $this->layout='//layouts/back';



	 $this->render('project_wise_list');

		 

	}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
		function actionGenblock()
 		{
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		{
			
			$connection = Yii::app()->db; 
$sql_memberas = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.plot_id, 
mp.plot_id as mppid,mp.id as mpid,mp.create_date as mpcd
FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id
	Left JOIN plots pf ON pf.id=mp.plot_id
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id where pf.atype!='Against Land'"; 
 $result_members = $connection->createCommand($sql_memberas)->queryAll();
$set ="SELECT * FROM setting";
$result_set = $connection->createCommand($set)->queryRow();	
		 foreach($result_members as $row8)	
		  {
			 // echo 123;
			$sql_com123 =" SELECT * 
 FROM  installpayment
 WHERE 
  plot_id='".$row8['mppid']."'";
$result_com123 = $connection->createCommand($sql_com123)->query();
$sql_com1234 =" SELECT * 
 FROM  installpayment
 WHERE 
 paidamount='' and plot_id='".$row8['mppid']."'";
$result_com1234 = $connection->createCommand($sql_com1234)->query();
$totalunp=0;
$number=0;
$now=time();
$due=0;
$due1=0;
$due2=0;
$paid=0;$per;
foreach($result_com1234 as $row10){
$your_date1 = strtotime($row10['due_date']);
$datediff1 = $now - $your_date1;
$number=floor($datediff1/(60*60*24));
if($number>=0){$due2++;}
}

foreach($result_com123 as $row9){
$due=$due+$row9['dueamount'];
$paid=$paid+$row9['paidamount'];
}
$your_date = strtotime($row8['mpcd']);
$datediff = $now - $your_date;
$number=floor($datediff/(60*60*24));

$due1=$number/30;
if($due==0){$due=1;}
$per=($paid/$due)*100;
//echo $due2;exit;
//echo round($per);exit;
if($per<$result_set['blacklist_per'] or $due2>$result_set['blacklist_mo']){
	if($due1>$result_set['blacklist_no']){
	$sql="Update member_plot set status='Blocked',shap_id='".round($per)."%'  where ms_id='".$row8['mpid']."'";
	$command = $connection -> createCommand($sql);
    $command -> execute();
	}
	
}
}$this->redirect(Yii::app()->baseUrl."/index.php/allotments/blockedlist?bid=");
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
function actionEditresq()
 		{
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		{
			
			$connection = Yii::app()->db; 
			$sql="Update member_plot set plot_id='".$_POST['plotss']."' where id='".$_POST['resid']."'";
			$command = $connection -> createCommand($sql);
			$command -> execute();
			echo 'Updated';
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	function actionBlockedlist()
 		{
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		{
		 $this->layout='//layouts/back';
		 $this->render('blockedlist');
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}

function actionUnblock()
 		{
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		{
		$connection = Yii::app()->db; 
		$sql="Update member_plot set status='UnBlocked' where id='".$_REQUEST['red']."'";
		$command = $connection -> createCommand($sql);
    	$command -> execute();
		$this->redirect(Yii::app()->baseUrl."/index.php/allotments/blockedlist?bid=".$_REQUEST['bid']);
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	function actionBlocknow()
 		{
		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
		{
		$connection = Yii::app()->db; 
		$sql="Update member_plot set status='Blocked' where id='".$_REQUEST['red']."'";
		$command = $connection -> createCommand($sql);
    	$command -> execute();
		$this->redirect(Yii::app()->baseUrl."/index.php/allotments/blockedlist?bid=".$_REQUEST['bid']);
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}

	 function actionAllot()



	 {

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{



	 $this->layout='//layouts/back';

	 $this->render('index');

	 }

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	 

	}

	function actionAddballott()



	 {

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{

	 $this->layout='//layouts/back';



	 $this->render('addballotting');

			}

		 

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

	

	 function actionPlots()



	 {

		 	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{



	$this->layout='//layouts/back';

	$connection = Yii::app()->db; 	

	$list_sql = "select plots.* FROM plots

	Left JOIN projects p ON p.id=plots.project_id where bid='".$_REQUEST['bid']."'";

	$result_details = $connection->createCommand($list_sql)->query();

	$list_sql5 = "select plots.* FROM plots

	Left JOIN projects p ON p.id=plots.project_id where project_id='".$_REQUEST['pid']."' and type='Plot' and ctag=''";

	$result_details5 = $connection->createCommand($list_sql5)->query();

	$total=0;

	$totalr=0;

	foreach($result_details5 as $row){$total++;if($row['bstatus']=='reserved'){$totalr++;}}

	$list_sql1 = "select ballotting.*,p.project_name FROM ballotting

	Left JOIN projects p ON p.id=ballotting.project

	 where ballotting.id='".$_REQUEST['bid']."'";

	$result_details1 = $connection->createCommand($list_sql1)->query();
 $connection = Yii::app()->db; 

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
$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
 $sql_sector ="SELECT * FROM sectors";
$result_sector = $connection->createCommand($sql_sector)->query();
$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();
	

	//print_r($result_details);exit;

	 $this->render('plots', array('plots'=>$result_details,'plot'=>$result_details1,'total'=>$total,'totalr'=>$totalr,'projects'=>$result_projects,'sectors'=>$result_sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));

			}

			

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	function actionRand()
	{

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{



	$connection = Yii::app()->db; 	

	$list_sql1 = "select *,ballotting.status as bbstatus FROM ballotting

	Left JOIN projects p ON p.id=ballotting.project where ballotting.id='".$_REQUEST['bid']."'";

	$result_details1 = $connection->createCommand($list_sql1)->query();

	

	//$list_sql = "select * FROM member_plot

//	Left JOIN plots p ON p.id=member_plot.plot_id

	//Left JOIN app a ON a.id=member_plot.member_name where a.project='".$_REQUEST['pid']."' AND a.plot_size='".$_REQUEST['size']."' ORDER BY a.app_no";

	//$result_details = $connection->createCommand($list_sql)->query();

	$this->layout='//layouts/back';

	$this->render('Random_allotment', array('plot'=>$result_details1));//'list'=>$result_details));

	}

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	

	}

	

	function actionEditplotform()

	{

				if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{



		$connection = Yii::app()->db;

		$sql="Update plots SET bstatus='".$_POST['status']."' where id='".$_POST['pid']."'";	  

        $command = $connection -> createCommand($sql);

        $command -> execute(); 

		$this->redirect(array("allotments/plots?pid=".$_POST['pid']."&size=&bid=".$_REQUEST['bid'].""));

		}

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

	

	function actionEditballotform()

	{	

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

    	{

		$connection = Yii::app()->db;

		$sql="Update ballotting SET desc1='".$_POST['desc1']."', status='".$_POST['status']."' where id='".$_POST['bid']."'";	  

        $command = $connection -> createCommand($sql);

        $command -> execute(); 

		$this->redirect(array("allotments/ballotting"));

		}

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

	

	

	function actionEditmemberform()

	{

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

    	{

		$connection = Yii::app()->db;

		$error =array();

		
			
			if(isset($_POST['status']) && empty($_POST['status']))
			{
				$error .= 'Please Select Status<br>';
			}
			if(empty($error)){
		$query  = 'DELETE from app 
		 where msid='.$_POST['mid'].' ';
		        $command = $connection -> createCommand($query);
               $command -> execute();
		$sql="INSERT INTO app SET msid='".$_POST['mid']."',sector_id='".$_POST['sector_id']."'";	  
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$sqln="Update memberplot SET bstatus='".$_POST['status']."' where id='".$_POST['mid']."' ";	  
        $command = $connection -> createCommand($sqln);
        $command -> execute();
		
		$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
		$res=array();
		foreach($num_of_category as $num_of_category)
		{
			$num_of_category = 	$num_of_category['num_of_category'];
		}
		if($num_of_category>0)
		{$query  = 'DELETE from  cat_app 
		 where ms_id='.$_POST['mid'].' ';
		        $command = $connection -> createCommand($query);
               $command -> execute();}
		while ($num_of_category>0)
		{
			if (isset($_POST[$num_of_category]))
		{
					$cat_id = $_POST[$num_of_category]; 
					$connection = Yii::app()->db;
					$add_project_per_query = "INSERT into cat_app	set cat_id='".$cat_id."', ms_id='".$_POST['mid']."' ";
					$command = $connection -> createCommand($add_project_per_query);
					$command -> execute();
				}
			$num_of_category--;
		}
			echo "Record Updated Successfully";
			}
			if(!empty($error))
			{
			echo $error;
			}
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
		function actionBallotting()
	 {



		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

			{

	 $this->layout='//layouts/back';

	 $this->render('ballotting');

	 }

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	function actionEdit_plot()
	{

		 if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{

    $this->layout='//layouts/back';

	$connection = Yii::app()->db; 	

	$list_sql = "select * FROM plots

	Left JOIN projects p ON p.id=plots.project_id where plots.id='".$_REQUEST['pid']."'";

	$result_details = $connection->createCommand($list_sql)->query();



	 $this->render('edit_plot',array('plot'=>$result_details));

		 }

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

	

	function actionEdit_app()

	{

    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{

 	$this->layout='//layouts/back';

	$connection = Yii::app()->db;  

		$sql_member  = "SELECT
    members.id
	,memberplot.plotno
	, members.name
    , members.sodowo
    , members.cnic
    , members.address
    , members.dob
    , members.email
    , members.phone
    , members.image
    , members.nomineename
	,members.city_id
	,plots.street_id
	,plots.type
	,plots.plot_size
	,plots.com_res
	,plots.sector
	,plots.size2
	,projects.project_name
	,projects.status
	,size_cat.size
	,plots.plot_detail_address
	,memberplot.create_date
	,streets.street
	,sectors.sector_name
	,sectors.id as sid
	,app.status as bstatus
	,memberplot.bstatus
	FROM
    memberplot
    LEFT JOIN members 
        ON (memberplot.member_id = members.id ) 
		left join plots on memberplot.plot_id=plots.id
		left join projects on plots.project_id=projects.id
		left join app on memberplot.id=app.msid
		left join sectors on app.sector_id=sectors.id
		left join size_cat on plots.size2=size_cat.id
		left join streets on plots.street_id=streets.id
		where memberplot.id=".$_REQUEST['mid'];
		$result_details = $connection->createCommand($sql_member)->queryAll();
		$sql_categories  = "SELECT * from categories";
		$categories = $connection->createCommand($sql_categories)->query();
		$sql12  = "SELECT categories.name,cat_app.id from cat_app
		Left JOIN categories  ON (cat_app.cat_id = categories.id)
			 where ms_id='".$_REQUEST['mid']."'";
		    $result12 = $connection->createCommand($sql12)->queryAll();
	$this->render('edit_app',array('plot'=>$result_details ,'categories'=>$categories,'cat'=>$result12));

    }

	else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

	function actionDelete_ballott()

	{

    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{

 	$connection = Yii::app()->db; 	

	$sql = "DELETE FROM ballotting where id='".$_REQUEST['bid']."'";

	$command = $connection -> createCommand($sql);

    $command -> execute(); 

	

	   $sql1="Delete member_plot.* From member_plot

	Left JOIN plots ON plots.id=member_plot.plot_id 

    where plots.project_id='".$_GET['pid']."' and plots.size2='".$_GET['size']."' ";	  

	$command = $connection -> createCommand($sql1);

	$command -> execute();



	$this->redirect(array("allotments/ballotting?pid=".$_REQUEST['pid']."&size=".$_REQUEST['size']."&bid=".$_REQUEST['bid'].""));	

	    }

	else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	function actionDeleteapp()

	{

	    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{

 	$connection = Yii::app()->db; 	

	$sql = "DELETE FROM app where id='".$_REQUEST['mid']."'";

	$command = $connection -> createCommand($sql);

    $command -> execute(); 

	$this->redirect(array("allotments/add_members?mid=".$_REQUEST['mid']."&pid=".$_REQUEST['pid']."&size=".$_REQUEST['size']."&bid=".$_REQUEST['bid'].""));

	   }

	else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	

	}

	function actionDeleteplot()

	 {

    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

    $this->layout='//layouts/back';

	$connection = Yii::app()->db;

	$sql = "Update plots SET bid='',bstatus='' where id=".$_REQUEST['pid']."";

	$command = $connection -> createCommand($sql);

    $command -> execute();  

	$this->redirect(array("allotments/plots?bid=".$_REQUEST['bid']."&size=".$_REQUEST['size']."&pid=".$_REQUEST['pid'].""));		

	}

	else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	

	}

	

	function actionEdit_ballott()

	 {

    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

 	$this->layout='//layouts/back';

	$connection = Yii::app()->db; 	

	$list_sql = "select * FROM ballotting

	Left JOIN projects p ON p.id=ballotting.project

	Left JOIN size_cat s ON s.id=ballotting.size

	 where ballotting.id='".$_REQUEST['bid']."'";

	$result_details = $connection->createCommand($list_sql)->query();

	 $this->render('edit_ballott',array('ballott'=>$result_details));

	}

	else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	function actionAdd()

	 {

	    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

	$this->layout='//layouts/back';

    $connection = Yii::app()->db;



	

//echo $_REQUEST['pid'].$_REQUEST['size'].$_REQUEST['bid']; exit;	

			$error =array();

			if(isset($_POST['member_name']) && empty($_POST['member_name']))



			{



				$error = 'Please Enter Member Name<br>';



			}

			if(isset($_POST['cnic']) && empty($_POST['cnic']))



			{



				$error .= 'Please Enter CNIC<br>';



			}

			if(isset($_POST['app']) && empty($_POST['app']))



			{



				$error .= 'Please Enter Application #<br>';



			}

			if(!empty($_POST['app'])){

				

			 $check_user_query = 'select * from app where app_no="'.$_POST['app'].'"';

		    $check_user_result = $connection->createCommand($check_user_query)->queryRow();

	  		if($check_user_result['app_no']==$_POST['app'])

				{

					$error ="Application # Already Exists<br>";

				}

			}	

	

			

			if(isset($_POST['email']) && empty($_POST['email']))



			{



				$error .= 'Please Enter Email<br>';



			}

			if(isset($_POST['mobile']) && empty($_POST['mobile']))



			{



				$error .= 'Please Enter Mobile #<br>';



			}

			if(isset($_POST['status']) && empty($_POST['status']))



			{



				$error .= 'Please Select Status<br>';



			}

							if(empty($error)){

							$member_name = $_POST['member_name'];

							$plot_size = $_POST['size'];

							$cnic = $_POST['cnic'];

							$app = $_POST['app'];

							$sql_insert_member = "insert into app (project,member_name,CNIC,app_no,plot_size,mobile,email,status ) values('".$_POST[		                            'project']."','".$member_name."','".$cnic."','".$app."','".$plot_size."','". $_POST['mobile']."','". $_POST['email'].                            "','". $_POST['status']."')";

							$command = $connection -> createCommand($sql_insert_member);

							$command -> execute();

							echo "Applicant Added Successfully";

							}

							if(!empty($error))

							{

								echo $error;

							}

								}

	else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



function actionAdd_members()



	 {

		 	    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

{


	   		$plotno='';

			$st='';

			$pro='';

			$com_res='';

			$sector='';

			$size='';



			$cat='';



			$where='';



			$and = false;



			$where='';

                if (!empty($_POST['status'])){

					if($_POST['status']=='Alloted'){

			$where.="plots.status ='".$_POST['status']."'";

			$and = true;

					}

			 }  



     		if (isset($_POST['rstatus'])){

			$where.="plots.rstatus LIKE '%".$_POST['rstatus']."%'";

			$and = true;

			 }

				



			if (isset($_POST['sector']) && $_POST['sector']!=""){

				$where.="plots.sector LIKE '%".$_POST['sector']."%'";

				$and = true;

				$sector=$_POST['sector'];

			}

			



			if (isset($_POST['com_res']) && $_POST['com_res']!=""){

				$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";

				$and = true;

				$sector=$_POST['com_res'];

			}



			if ($and==true)



				{



					$where.="  and type='plot' ";



				}



				else



				{



					$where.="type='plot' ";



				}



				$and=true;



			



			



			



			if (isset($_POST['plotno']) && $_POST['plotno']!=""){



				$plotno=$_POST['plotno'];



				if ($and==true)



				{



					  $where.=" and plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";



				}



				else



				{



					$where.=" plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";



				}



				$and=true;



			}



				if (isset($_POST['size']) && $_POST['size']!=""){



				$size=$_POST['size'];



				if ($and==true)



				{



					  $where.=" and plots.size2 LIKE '%".$_POST['size']."%'";



				}



				else



				{



					$where.=" plots.size2 LIKE '%".$_POST['size']."%'";



				}



				$and=true;



			}





			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				



				$pro=$_POST['project_id'];



				if ($and==true)



				{



					$where.=" and plots.project_id LIKE '%".$_POST['project_id']."%'";



				}



				else



				{



					$where.=" plots.project_id LIKE '%".$_POST['project_id']."%'";



				}



				$and=true;



			}



			



			



			if (isset($_POST['street_id']) && $_POST['street_id']!=""){



				$st=$_POST['street_id'];



				if ($and==true)



				{



					$where.=" and plots.street_id LIKE '%".$_POST['street_id']."%'";



				}



				else



				{



					$where.=" plots.street_id LIKE '%".$_POST['street_id']."%'";



				}



				$and=true;



			}



			



			



			



			



		



	$connection = Yii::app()->db; 



    $sql_member = "SELECT



    plots.id



    , plots.street_id


 , plots.project_id

    , plots.plot_size



    , plots.com_res



	 , plots.size2



    , plots.rstatus



	, plots.sector



	, plots.category_id



	, plots.status



	, plots.plot_detail_address



	, memberplot.plotno



    , projects.project_name



	, streets.street





	



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)





	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)



where $where";

		$result_members = $connection->createCommand($sql_member)->query();



        $connection = Yii::app()->db; 
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

		

		

		//$sql_project = "SELECT * from projects";



		//$result_project = $connection->createCommand($sql_project)->query();



	



		



		$sql_categories  = "SELECT * from categories";



		$categories = $connection->createCommand($sql_categories)->query();



		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();



	    $sql_sector ="SELECT * FROM sectors";



		$result_sector = $connection->createCommand($sql_sector)->query();

		

	    $sql_com_res ="SELECT DISTINCT com_res FROM plots";



		$result_com_res = $connection->createCommand($sql_com_res)->query();



		

		    $home=Yii::app()->request->baseUrl; 



			if(isset($_POST['search'])){



            $res=array();







            foreach($result_members as $key){



            echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size2'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['rstatus'].'</td><td>';



			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'&&pro='.$key['project_id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>



			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td>';

				if($key['status']=='Alloted')

			{ 

			echo '<td></td>';

			}

			else {echo '<td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td>';}

			'</tr>'; 



            }}



			$this->render('add_members',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));

			}else{
				$this->redirect(array('user/dashboard'));
				}



	 }

	 

	 function actionReserve()
	{
		 	 	    if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
	{ 
	
	$where='';
			if ( isset($_POST['block']) &&  $_POST['block']!=""){				
				$where.=" and se.id ='".$_POST['block']."'";
			}
			if ( isset($_POST['plot_no']) &&  $_POST['plot_no']!=""){				
					$where.=" and plots.plot_detail_address ='".$_POST['plot_no']."'";
			}
			if ( isset($_POST['street']) &&  $_POST['street']!=""){				
					$where.=" and s.id ='".$_POST['street']."'";
			}
	 $this->layout='//layouts/back';
	$connection = Yii::app()->db;


	 $list_sql1 = "select * FROM ballotting

	Left JOIN projects p ON p.id=ballotting.project where ballotting.id='".$_REQUEST['bid']."'";

	$result_details1 = $connection->createCommand($list_sql1)->query();

		
	$list_sql2 = "SELECT mp.member_id,mp.plotno,tp.status as tstatus,mp.create_date,p.id,p.type,p.project_id,m.name,m.email,m.phone,mp.plotno,mp.id as msid,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.plot_id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where p.type='file' and mp.bstatus='reserve' and j.id='1' order by mp.plotno";

	$result_details2 = $connection->createCommand($list_sql2)->queryAll();



	$list_sql5 = "select plots.*,s.street,sc.code, se.sector_name,
se.id as seid
 FROM plots
	Left JOIN projects p ON p.id=plots.project_id
	Left JOIN size_cat sc ON plots.size2=sc.id
	left join streets s on plots.street_id=s.id
	left join sectors se on plots.sector=se.id
	where plots.bid='".$_REQUEST['bid']."' and  plots.bstatus='reserved' $where Limit 0, 50";

	$result_details5 = $connection->createCommand($list_sql5)->queryAll();

	

	

	//foreach($result_details5 as $row){$total++;if($row['status']=='reserve'){$totalr++;}}

	 $this->render('reserved', array('plot'=>$result_details1,'app'=>$result_details2,'plots'=>$result_details5));

		}

	else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	 }

	 function actionDeleteres()

	{

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 
	$connection = Yii::app()->db; 
$sql_size  = "SELECT * FROM member_plot where id='".$_REQUEST['resid']."'";
$result_size = $connection->createCommand($sql_size)->queryRow();


$sql11="Update plots SET bstatus='reserved' where id='".$result_size['plot_id']."' ";	 
$command = $connection -> createCommand($sql11);
$command -> execute();
$sql="Update memberplot SET bstatus='reserve' where id='".$result_size['ms_id']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();

$sql="Delete from member_plot where id='".$_REQUEST['resid']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();
$this->redirect(Yii::app()->baseUrl."/index.php/allotments/managelist?bid=".$_REQUEST['bid']);
	}

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}

	function actionProject_wise()

	{

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

	

	$this->layout='//layouts/back';

	$this->render('project_wise');

	}

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	function actionConsheet()
	{
	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
	{ 
	$this->layout='//layouts/back';
	$this->render('sumsheet');
	}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}

	public function actionSearchreqnew1()

	 	{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
			

		$where='';
$where.="p.type Like '%Plot%'";
$and=true;
		//$and=false;
			if ( isset($_POST['cnic']) &&  $_POST['cnic']!=""){				

				if ($and==true)

				{

					$where.=" and a.cnic ='".$_POST['cnic']."'";

				}

				else

				{

					$where.=" a.cnic='".$_POST['cnic']."'";

				}

				$and=true;

			}

			

			if (isset($_POST['plotno']) && $_POST['plotno']!=""){

				$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and mp.plotno Like '%".$_POST['plotno']."%'";

				}

				else

				{

					$where.=" mp.plotno Like '%".$_POST['plotno']."%'";

				}

				$and=true;

			}

			
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
$sql_memberas = "select p.*,projects.project_name,a.name,mp.plotno,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.plot_id FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id
where $where"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 

    $sql_member = "select p.*,projects.project_name,a.name,mp.plotno,sectors.sector_name,a.cnic,a.sodowo,streets.street,
	mp.plot_id as mppid,member_plot.status as mpstatus,
	size_cat.size,member_plot.plot_id FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id
	where $where limit $start,$limit"; 


        $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();

$sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();





	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

	   $sql_com ="SELECT DISTINCT com_res FROM plots";

		$result_com = $connection->createCommand($sql_com)->query();

		

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_size  = "SELECT * from size_cat";



		$sizes = $connection->createCommand($sql_size)->query();

		

 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();
$set ="SELECT * FROM setting";
$result_set = $connection->createCommand($set)->queryRow();


           $i=1;
		  foreach($result_members as $row8)	
		  {
				 echo '<tr><td>'.$i.'</td><td>'.$row8['plotno'].'</td><td>'.$row8['name'].'</td><td>'.$row8['cnic'].'</td><td>'.$row8['size'].'</td><td>'.$row8['plot_detail_address'].'</td><td>'.$row8['street'].'</td><td>'.$row8['sector_name'].'</td>
				 
				 
				 <td>'.$row8['mpstatus'].'</td>

			</tr>'; 

           $i++ ;
		   //}
		   }

			 

		

			

			}

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
 echo '<tr  ><td colspan="9"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="9">'.$pagination.'</td></tr>'; exit; 
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







	
			}
	}
	public function actionSearchblocked()

	 	{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
			

		$where='';
$where.="p.type Like '%Plot%'";
$and=true;
		//$and=false;
			if ( isset($_POST['cnic']) &&  $_POST['cnic']!=""){				

				if ($and==true)

				{

					$where.=" and a.cnic ='".$_POST['cnic']."'";

				}

				else

				{

					$where.=" a.cnic='".$_POST['cnic']."'";

				}

				$and=true;

			}

			

			if (isset($_POST['plotno']) && $_POST['plotno']!=""){

				$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and mp.plotno ='".$_POST['plotno']."'";

				}

				else

				{

					$where.=" mp.plotno='".$_POST['plotno']."'";

				}

				$and=true;

			}

			
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
$sql_memberas = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.plot_id,member_plot.bid as mpbid FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id
where $where and member_plot.status!='0'"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 

    $sql_member = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,
	mp.plot_id as mppid,mp.plotno,member_plot.bid as mpbid,
	size_cat.size,member_plot.plot_id,member_plot.shap_id,member_plot.status,member_plot.id as mppidd FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id
	where $where and member_plot.status!='0' limit $start,$limit"; 


        $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();

$sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();





	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

	   $sql_com ="SELECT DISTINCT com_res FROM plots";

		$result_com = $connection->createCommand($sql_com)->query();

		

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_size  = "SELECT * from size_cat";



		$sizes = $connection->createCommand($sql_size)->query();

		

 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();
           $i=1;
		  foreach($result_members as $row8)	
		  {

				 echo '<tr><td>'.$i.'</td><td>'.$row8['plotno'].'</td><td>'.$row8['name'].'</td><td>'.$row8['cnic'].'</td><td>'.$row8['shap_id'].'</td>
				
				 <td>';
				 if($row8['status']=='Blocked'){
				 echo '<b style="color:red;">'.$row8['status'].'</b>';}
				  if($row8['status']=='UnBlocked'){ echo '<b style="color:blue;">'.$row8['status'].'</b>';}
				 
				 
				echo ' </td><td>';
				 if($row8['status']=='Blocked'){
				echo '<a href="unblock?bid='.$_REQUEST['bid'].'&&red='.$row8['mppidd'].'" class="btn">Unblock</a>';}
				 if($row8['status']=='UnBlocked'){	
				echo '<a href="blocknow?bid='.$_REQUEST['bid'].'&&red='.$row8['mppidd'].'" class="btn">Block</a>';}
echo '</td>

			</tr>'; 

           $i++ ;
		   //}
		   }

			 

		

			

			}

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







	
			}
	}
	public function actionSearchreqnew11()

	 	{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
			

		$where='';
if(isset($_POST['empty']) && $_POST['empty']!==''){
			$where.="p.id IS NULL";			
			}else{$where.="p.type Like '%Plot%'";}
$and=true;
		//$and=false;
			if ( isset($_POST['cnic']) &&  $_POST['cnic']!=""){				

				if ($and==true)

				{

					$where.=" and a.cnic ='".$_POST['cnic']."'";

				}

				else

				{

					$where.=" a.cnic='".$_POST['cnic']."'";

				}

				$and=true;

			}

			

			if (isset($_POST['block']) && $_POST['block']!=""){
				$plotno=$_POST['block'];
				if ($and==true)
				{	  $where.=" and p.sector Like'%".$_POST['block']."%'"; }
				else
				{$where.=" p.sector Like '%".$_POST['block']."%'";}
				$and=true;
			}
			if (isset($_POST['street']) && $_POST['street']!=""){
				$plotno=$_POST['street'];
				if ($and==true)
				{	  $where.=" and p.street_id Like'%".$_POST['street']."%'"; }
				else
				{$where.=" p.street_id Like '%".$_POST['street']."%'";}
				$and=true;
			}
			if (isset($_POST['pno']) && $_POST['pno']!=""){
				$plotno=$_POST['pno'];
				if ($and==true)
				{	  $where.=" and p.plot_detail_address Like'%".$_POST['pno']."%'"; }
				else
				{$where.=" p.plot_detail_address Like '%".$_POST['pno']."%'";}
				$and=true;
			}
			if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{	  $where.=" and mp.plotno Like'%".$_POST['plotno']."%'"; }
				else
				{$where.=" mp.plotno Like '%".$_POST['plotno']."%'";}
				$and=true;
			}

			
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
 $sql_memberas = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.id as resid,member_plot.plot_id FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id 
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id
where $where  "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 

    $sql_member = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.plot_id,member_plot.id as resid FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id 
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id
	where $where limit $start,$limit"; 


        $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();

$sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();





	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

	   $sql_com ="SELECT DISTINCT com_res FROM plots";

		$result_com = $connection->createCommand($sql_com)->query();

		

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_size  = "SELECT * from size_cat";



		$sizes = $connection->createCommand($sql_size)->query();

		

 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();



           $i=1;foreach($result_members as $row8)	

			 {

				// $array=$row8['app_no'];

				 echo '<tr><td><input type="checkbox" name="baction" id="baction"/></td><td>'.$i.'</td><td>'.$row8['name'].'</td><td>'.$row8['sodowo'].'</td><td>'.$row8['cnic'].'</td><td>'.$row8['size'].'</td><td>'.$row8['plot_detail_address'].'</td><td>'.$row8['street'].'</td><td>'.$row8['sector_name'].'</td><td>
				 <a href="deleteres?bid='.$_REQUEST['bid'].'&resid='.$row8['resid'].'">Delete</a> / 
<a href="editres?bid='.$_REQUEST['bid'].'&resid='.$row8['resid'].'">Edit</a>
				 
				 
				 </td>

			</tr>'; 

           $i++ ;}

			 

		

			

			}

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
 echo '<tr  ><td colspan="9"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="9">'.$pagination.'</td></tr>'; exit; 
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







	
			}
	}

	function actionReslist()



	 {

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

		 $connection = Yii::app()->db;

	$list_sql = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.plot_id FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id where projects.id='".$_GET['pid']."'";

	$result_details = $connection->createCommand($list_sql)->queryAll();

	 $this->layout='//layouts/back';



	 $this->render('reslist',array('list'=>$result_details));

     }

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	function actionReslis()



	 {

		if(isset(Yii::app()->session['user_array']['username'] ))

	{ 

		 $connection = Yii::app()->db;

	$list_sql = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.plot_id FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id where projects.id='".$_GET['pid']."'";

	$result_details = $connection->createCommand($list_sql)->queryAll();

	 $this->layout='//layouts/back';



	 $this->render('reslis',array('list'=>$result_details));

     }

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	function actionManagelist()



	 {

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

		 $connection = Yii::app()->db;



	 $this->layout='//layouts/back';



	 $this->render('managelist',array());

     }

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
function actionEditres()



	 {

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

		 $connection = Yii::app()->db;



	 $this->layout='//layouts/back';



	 $this->render('editres',array());

     }

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}

	function actionAddtoballot()



	 {

			if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

	

	$connection = Yii::app()->db;

	$s=0;

	

	if(isset($_POST['vara'])){

	$check=$_POST['vara'];

	foreach($check as $checked)

	{

	$sql="Update plots SET bstatus='Open', bid='".$_POST['bid']."' where id='".$checked."' ";	  

    $command = $connection -> createCommand($sql);

    $command -> execute(); 

	

	

	}}

	$this->redirect(array("allotments/plots?pid=".$_POST['pid']."&size=".$_POST['size']."&bid=".$_POST['bid'].""));

	}

		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



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



		if(Yii::app()->session['user_array']['per3']=='1')



			{



		



					



		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{	



				$this->render('category');



			



			}



			else{



				$this->redirect(array('user/user'));



				



			}



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

	 

	 public function actionSearchreq()
	 	{

					if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
					{ 
		$where='';
		$and=false;
			$connection = Yii::app()->db; 
			$sql_member = "SELECT
			plots.id
			, plots.street_id
			, plots.type
			, plots.plot_size
			, plots.com_res
			, plots.size2
			, plots.create_date
			, plots.sector
			, plots.category_id
			, plots.status
			, plots.plot_detail_address
			, projects.project_name
			, streets.street
			,size_cat.size
FROM
    plots
    left join size_cat ON (plots.size2=size_cat.id)
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
where $where bid='' AND ctag='' and type='Plot'"; 
       $result_members = $connection->createCommand($sql_member)->query();
	    $sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		$categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 
    $res=array();
            foreach($result_members as $key){
            $count++;
			echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['com_res'].'/'.$key['type'].'</td><td>'.$key['sector'].'</td><td><input type="checkbox" name="vara[]" value="'.$key['id'].'"></input></tr>';
			} 

			}else{echo '';}
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
	}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}



	public function actionAddplots()

	{	

		if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')

	{ 

				   

	   		$plotno='';

			$st='';

			$pro='';

			$sector='';

			$cat='';

			$where='';

			$and = false;

			$where='';

			

			if (isset($_POST['sector']) && $_POST['sector']!=""){

				$where.="plots.sector LIKE '%".$_POST['sector']."%'";

				$and = true;

				$sector=$_POST['sector'];

			}

			

			if ($and==true)

				{

					$where.="  and type='plot' ";

				}

				else

				{

					$where.="type='plot' ";

				}

				$and=true;

			

			if (isset($_POST['cat']) && $_POST['cat']!=""){

				$cat=$_POST['cat'];

			

				

				if ($and==true)

				{

					  $where.=" and plots.category_id LIKE '%".$_POST['cat']."%'";

				}

				else

				{

					$where.=" plots.category_id LIKE '%".$_POST['cat']."%'";

				}

				$and=true;

			}

			

			if (isset($_POST['plotno']) && $_POST['plotno']!=""){

				$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";

				}

				else

				{

					$where.=" plots.plot_detail_address LIKE '%".$_POST['plotno']."%'";

				}

				$and=true;

			}

			

			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				

				$pro=$_POST['project_id'];

				if ($and==true)

				{

					$where.=" and plots.project_id LIKE '%".$_POST['project_id']."%'";

				}

				else

				{

					$where.=" plots.project_id LIKE '%".$_POST['project_id']."%'";

				}

				$and=true;

			}

			

			

			if (isset($_POST['street_id']) && $_POST['street_id']!=""){

				$st=$_POST['street_id'];

				if ($and==true)

				{

					$where.=" and plots.street_id LIKE '%".$_POST['street_id']."%'";

				}

				else

				{

					$where.=" plots.street_id LIKE '%".$_POST['street_id']."%'";

				}

				$and=true;

			}

			

			

			

			

		

	$connection = Yii::app()->db; 

    $sql_member = "SELECT

    plots.id

    , plots.street_id

    , plots.plot_size

    , plots.com_res

	 , plots.size2

    , plots.create_date

	, plots.sector

	, plots.category_id

	, plots.status

	, plots.plot_detail_address

	, memberplot.plotno

    , projects.project_name
	,size_cat.size
	, streets.street

	

FROM

    plots
    left join size_cat  ON (plots.size2=size_cat.id)
    Left JOIN streets  ON (plots.street_id = streets.id)

	Left JOIN projects  ON (plots.project_id = projects.id)

	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)

where $where"; 

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();

		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			

	   

	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$result_members = $connection->createCommand($sql_member)->query();

		 

		    $home=Yii::app()->request->baseUrl; 

			if(isset($_POST['search'])){

            $res=array();



            foreach($result_members as $key){



			



			



            	

            echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['create_date'].'</td><td>';

			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('plots_lis',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories));

			

	   

	}

	

	}


public function actionSearchreq11()

	 	{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
			

		$where='';

		$and=false;
			if ( isset($_POST['project_name']) &&  $_POST['project_name']!=""){				

				if ($and==true)

				{

					$where.=" and plots.project_id = '".$_POST['project_name']."'";

				}

				else

				{

					$where.=" plots.project_id = '".$_POST['project_name']."%'";

				}

				$and=true;

			}
		
			if ($and==true)

				{

					$where.="  and type='file' ";

				}

				else

				{

					$where.="type='file' ";

				}

				$and=true;

			if (isset($_POST['plotno']) && $_POST['plotno']!=""){

				$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and plots.plot_detail_address ='".$_POST['plotno']."'";

				}

				else

				{

					$where.=" plots.plot_detail_address ='".$_POST['plotno']."'";

				}

				$and=true;

			}

if (isset($_POST['msno']) && $_POST['msno']!=""){

		

				if ($and==true)

				{

					  $where.=" and memberplot.plotno Like '%".$_POST['msno']."%'";

				}

				else

				{

					$where.=" memberplot.plotno Like '%".$_POST['msno']."%'";

				}

				$and=true;

			}

			if (isset($_POST['size']) && $_POST['size']!=""){

				$plotno=$_POST['size'];

				if ($and==true)

				{

					  $where.=" and plots.size2 LIKE '%".$_POST['size']."%'";

				}

				else

				{

					$where.=" plots.size2 LIKE '%".$_POST['size']."%'";

				}

				$and=true;

			}

			$catt='';

			$extra1='';

			if (isset($_POST['cat']) && $_POST['cat']!=""){

			$aa=0;

			$extra1="Left JOIN cat_app  ON (memberplot.id = cat_app.ms_id)";	

				foreach($_POST['cat'] as $ass){if($aa==1){$catt.=',';} $catt.=$ass;$aa++; };
//echo $catt;exit;
				if ($and==true)

				{

					  $where.=" and cat_app.cat_id IN (".$catt.") GROUP by memberplot.id HAVING count(*) = ".$aa."";

				}

				else

				{

					$where.=" cat_app.cat_id IN (".$catt.") GROUP by memberplot.id HAVING count(*) = ".$aa."";

				}

				$and=true;

			}

		

			if (!empty($_POST['stat'])){

			

			if($_POST['stat']==3){$where.=" and memberplot.bstatus ='open'";}

			if($_POST['stat']==4){$where.="and memberplot.bstatus ='reserve'";}

						$and = true;	

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
 $sql_memberas = "SELECT * FROM memberplot
   Left JOIN plots ON (plots.id = memberplot.plot_id)
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	".$extra1."
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 
   $sql_member = "SELECT
    plots.id
    , plots.street_id
    , plots.plot_size
, plots.project_id
    , plots.com_res
	 , plots.size2
    , plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
	, memberplot.fstatus
	, plots.bstatus
	, plots.plot_detail_address
	, memberplot.plotno
	, memberplot.bstatus
	, memberplot.id as msid
    , projects.project_name
	, streets.street
	, size_cat.size
	,sector_name
	,members.name
	,members.cnic
FROM
   memberplot
   Left JOIN plots ON (plots.id = memberplot.plot_id)
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN members  ON (memberplot.member_id = members.id)
	".$extra1."
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where  limit $start,$limit"; 
        $sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
	   $sql_com ="SELECT DISTINCT com_res FROM plots";
		$result_com = $connection->createCommand($sql_com)->query();
		$result_members = $connection->createCommand($sql_member)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
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
			$F='';
			$M='';
			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['size'].'</td>';
			echo '<td>';
			echo $key['status'];echo '</td>

			<td>'.$key['bstatus'].'</td>';

		
echo '<td><div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a href="edit_app?mid='.$key['msid'].'&pid=">Edit</a></li>
		
			</td>';

			'</tr>';

			}

			 

		

			

			}

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







	
			}
	}
	



}


