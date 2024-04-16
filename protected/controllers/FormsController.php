<?php
class FormsController extends Controller
{
public function actionCsvexport1()
	 	{
			$col='';
			$col1='';
			
	if($_POST['type']=='booking'){$col='tmfstatus';$col1='tm';}
	if($_POST['type']=='membership'){$col='fsfstatus';$col1='mscharges';}
	if($_POST['type']=='certificate'){$col='ocfstatus';$col1='oc';}
	
			$connection = Yii::app()->db; 
	$pro='';
			$cnic='';		
			$where="";
			$and = "";
			
			if(!isset($_POST['status'])){$st='0';}else{$st=$_POST['status'];}
			    
			
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.=" and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) ='".$_POST['formno']."'";
				}
				else
				{
					$where.=" CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` )= '".$_POST['formno']."'";
				}
				$and=true;
			}


			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
				
	}
	if(isset($_POST['type']) && $_POST['type']!==''){ $where.=" and installform.type = '".$_POST['type']."'";}
if ( isset($_POST['city']) &&  $_POST['city']!==""){				
				if ($and==true)
				{
					$where.=" and user.city LIKE '%".$_POST['city']."%'";
				}
				else
				{
					$where.=" user.city LIKE '%".$_POST['city']."%'";
				}
				$and=true;
			}
			if(isset($_POST['status'])){
			if($_POST['status']==0 or $_POST['status']==1 or $_POST['status']==2 or $_POST['status']==3){
$where.=" and forms.".$col1."='1' and ".$col."='".$st."'";
}}

	$connection = Yii::app()->db; 
	 $sql_member12 = " SELECT *
	FROM installform 
	left join forms on installform.form_id=forms.id 
left join user on installform.user_id=user.id 
	where $where"; 
	 $co = $connection->createCommand($sql_member12)->query();
	$rows =count($co);
     $sql_member = "SELECT installform.id as iid,forms.id as fid,
	 installform.payment_type, 
installform.paidamount, 
installform.dueamount, 
installform.discount, 
installform.lab, 
installform.paidas, 
installform.detail, 
installform.remarks, 
installform.paid_date ,
forms.name, 
forms.sodowo, 
forms.cnic, 
forms.phone, 
forms.phoneres, 
forms.mobile, 
forms.email, 
forms.address, 
forms.city, 
forms.profession, 
forms.type, 
forms.smode,  

user.firstname
	FROM installform 
	left join forms on installform.form_id=forms.id 
    left join user on installform.user_id=user.id 
	where $where "; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
	$sql_size  = "SELECT * from size_cat";
	$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	 $colnames = array(
    'plot_detail_address' => "Plot No.",
    'project_name' => "Project Name",
    'plotno' => "Membership #",
	
	 'sector' => "Sector.",
    'price' => "Price",
    'status' => "Status",
	
	 'name' => "Name.",
    'cnic' => "CNIC",
    'com_res' => "Type",
	
	 'cat_size.size' => "Size.",);
// print_r($colnames);exit;
  function map_colnames($input)
  { 
    global $colnames;
    return isset($colnames[$input]) ? $colnames[$input] : $input;
  }
  function cleanData(&$str)
  {
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "CSV Report" . date('Ymd') . ".csv";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv");
  $out = fopen("php://output", 'w');
  $flag = false;
  foreach($result_members as $row) {
    if(!$flag) {
      // display field/column names as first row
	 
      $firstline = array_map("map_colnames", array_keys($row));
      fputcsv($out, $firstline, ',', '"');
      $flag = true;
    }
    array_walk($row, 'cleanData');
    fputcsv($out, array_values($row), ',', '"');
  }
  fclose($out);
  exit;
			
	}
	public function actionCsvexport()
	 	{
			$connection = Yii::app()->db; 
			$pro='';
			$cnic='';		
			$where='';
			$and = false;
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.="and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				else
				{
					$where.="CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				$and=true;
			}


			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
			//for Pagination 
 
$connection = Yii::app()->db; 
$sql_memberas = "SELECT
    forms.id

FROM
    forms
	Left JOIN user  ON (user.id = forms.user_id)
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
where $where and forms.cnic is not null"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);//for Pagination 		


	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    *
FROM
    forms
	
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

where $where and forms.cnic !='' "; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
	$sql_size  = "SELECT * from size_cat";
	$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	 $colnames = array(
    'plot_detail_address' => "Plot No.",
    'project_name' => "Project Name",
    'plotno' => "Membership #",
	
	 'sector' => "Sector.",
    'price' => "Price",
    'status' => "Status",
	
	 'name' => "Name.",
    'cnic' => "CNIC",
    'com_res' => "Type",
	
	 'cat_size.size' => "Size.",);
// print_r($colnames);exit;
  function map_colnames($input)
  { 
    global $colnames;
    return isset($colnames[$input]) ? $colnames[$input] : $input;
  }
  function cleanData(&$str)
  {
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "CSV Report" . date('Ymd') . ".csv";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv");
  $out = fopen("php://output", 'w');
  $flag = false;
  foreach($result_members as $row) {
    if(!$flag) {
      // display field/column names as first row
	 
      $firstline = array_map("map_colnames", array_keys($row));
      fputcsv($out, $firstline, ',', '"');
      $flag = true;
    }
    array_walk($row, 'cleanData');
    fputcsv($out, array_values($row), ',', '"');
  }
  fclose($out);
  exit;
	}
public function actionExport()
	{

	if(Yii::app()->session['user_array']['per13']=='1')		
			{

            $connection = Yii::app()->db; 
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->queryAll();
		 
          $this->render('export',array('projects'=>$result_projects));
			}
else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
public function actionBal_res()
	{	

		
	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	    		    $home=Yii::app()->request->baseUrl; 
			
			$this->render('balform',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}
	public function actionSearch()
	{	
	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
";
$result_members = $connection->createCommand($sql_member)->query();
        $connection = Yii::app()->db; 
		
		$sql_project = 'select * from projects';
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	    		    $home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
            $res=array();
            foreach($result_members as $key){
            echo '<tr><td>'.$key['formno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</a></td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td>'.$key['email'].'</td><td>'.$key['address'].'</td><td>'.$key['mscharges'].'</td><td>'.$key['tm'].'</td>
			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td>';
				if($key['status']=='Alloted')
			{ 
			echo '<td></td>';
			}
			else {echo '<td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td>';}
			'</tr>'; 
            }}
			$this->layout='//layouts/front';
			$this->render('bal_res1',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}
	public function actionBalreport()
	{	
	   		
		
	$connection = Yii::app()->db; 
    $sql_member = "
		
    SELECT seller.name as sname
	,forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
	, forms.rdate
	
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,seller.logo
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
	Left JOIN seller  ON (seller.id = forms.seller_id) GROUP BY sname
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('balreport',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}
public function actionLispayret()
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
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();	
		  $this->render('lispayret',array('projects'=>$result_projects));
	}
		public function actionFinancereqret()

	 	{
			$col='';
			$col1='';
			
	
			if($_POST['status']=='undefined'){$_POST['status']=0;}
		
			$connection = Yii::app()->db; 
	$pro='';
			$cnic='';		
			$where="rtrn_form.type='".$_REQUEST['type']."'";
			$and = true;
			if(!isset($_POST['status'])){$st='0';}else{$st=$_POST['status'];}
			    
			
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.=" and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) ='".$_POST['formno']."'";
				}
				else
				{
					$where.=" CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` )= '".$_POST['formno']."'";
				}
				$and=true;
			}


			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
				
	}
if ( isset($_POST['city']) &&  $_POST['city']!=""){				
				if ($and==true)
				{
					$where.=" and user.city LIKE '%".$_POST['city']."%'";
				}
				else
				{
					$where.=" user.city LIKE '%".$_POST['city']."%'";
				}
				$and=true;
			}
			if ( isset($_POST['status']) &&  $_POST['status']!=""){				
				if ($and==true)
				{
					$where.=" and rtrn_form.fstatus = '".$_POST['status']."'";
				}
				else
				{
					$where.=" rtrn_form.status = '".$_POST['status']."'";
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
	 $sql_member12 = " SELECT *
	FROM rtrn_form 
	left join forms on rtrn_form.form_id=forms.id 
left join user on rtrn_form.user_id=user.id 
	where $where"; 
	 $co = $connection->createCommand($sql_member12)->query();
	$rows =count($co);
     $sql_member = " SELECT *,rtrn_form.id as iid,forms.id as fid
	FROM rtrn_form 
	left join forms on rtrn_form.form_id=forms.id 
left join user on rtrn_form.user_id=user.id 
	where $where limit $start,$limit"; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
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
			

			 echo '<tr><td>'.$count.'</td><td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td style="text-align:right;"><b>'.number_format($key['paidamount']).'</b></td><td>'.$key['paidas'].'</td><td>'.$key['detail'].'</td><td>'.$key['date'].'</a></td>
			 <td><a class="btn" href="paymentdetails1?id='.$key['iid'].'">Details</a>
			 <input type="submit" name="sub" id="'.$key['id'].'" onclick="myfunction1('.$key['fid'].',\'' .$_POST['type']. '\')" class="btn" value="Verify">
			 </td><tr>';
			 echo '<script>
					 var id =document.getElementById(id );
					 function myfunction1(id , type)
					{
					$.ajax({
						 type: "POST",
						  url:    "payapprove1?val1="+ id + "&&val2=" + type ,
						  contenetType:"json",
						  success: function(jsonList){var json = $.parseJSON(jsonList);
						  var listItems="";
						  listItems+="<option value=>Select Street</option>";
						  $(json).each(function(i,val){
					      document.getElementById(id).style.visibility = "hidden"; 
						  listItems+= " ";
					      });listItems+="";
						  $("#street_id").html(listItems);
							  }
						});
					}
					</script>';
			 
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

			}
  exit;
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
Public function actionPayapprove1()
	{ 
	
	$col='';
	
	
		$connection = Yii::app()->db; 
		 $sql  = "UPDATE rtrn_form SET fstatus='1' where id='".$_GET['val1']."'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   echo '1';exit;
	}
public function actionAddbal()
	{

	if(Yii::app()->session['user_array']['per13']=='1')		
			{

            $connection = Yii::app()->db; 
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->query();
		  $projects1  = "SELECT fm_balloting.*,projects.project_name,projects.id as pid from fm_balloting 
		  Left join projects on fm_balloting.pid=projects.id
		  ";
		 $result_projects1 = $connection->createCommand($projects1)->query();
          $this->render('addballot',array('projects'=>$result_projects,'balloting'=>$result_projects1));
			}
else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionDrawmain()

	{

	if(Yii::app()->session['user_array']['per13']=='1'){		
			

            
          $this->render('drawmain');
			}
else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionDraw()
	{
	if(Yii::app()->session['user_array']['per13']=='1')
	{
         $connection = Yii::app()->db; 
		 $bid=$_REQUEST['bid'];
		 $total_plots=0;
		
		 $rem=0;
		 $top=0;
	 	 $tof=0;
		 $plots  = "SELECT * from fm_balloting where id='".$bid."' ";
		 $result_plots = $connection->createCommand($plots)->queryRow();
		 $top= $result_plots['tplot'];
		
		 $forms  = "SELECT * from forms where project_id='".$_REQUEST['pid']."' and tm='1' and bstatus='0' ORDER BY RAND()
LIMIT $top ";
		 $result_forms = $connection->createCommand($forms)->queryAll();
		 $tof= count($result_forms);
		
		 foreach($result_forms as $fa){
		 $sql  = "Update forms SET bstatus='".$_REQUEST['bid']."' where id='".$fa['id']."'";	
		 $command = $connection -> createCommand($sql);
         $command -> execute();
		 }
		 $rem=$top-$tof;
		 $sql  = "Update fm_balloting SET tplot='".$rem."' where id='".$_REQUEST['bid']."'";	
		 $command = $connection -> createCommand($sql);
         $command -> execute();
		
		 $rem=0;
		 $top=0;
	 	 $tof=0;
		 $plots  = "SELECT * from fm_balloting where id='".$bid."' ";
		 $result_plots = $connection->createCommand($plots)->queryRow();
		 $top= $result_plots['tplot'];
		 
		 $forms  = "SELECT * from forms where project_id='".$_REQUEST['pid']."' and bstatus='0' and mscharges='1' ORDER BY RAND()
LIMIT $top ";
		 $result_forms = $connection->createCommand($forms)->queryAll();
		  $tof= count($result_forms);
		
		 foreach($result_forms as $fa){
		 $sql  = "Update forms SET bstatus='".$_REQUEST['bid']."' where id='".$fa['id']."'";	
		 $command = $connection -> createCommand($sql);
         $command -> execute();
		 }
		 $rem=$top-$tof;
		 $sql  = "Update fm_balloting SET tplot='".$rem."',status='1' where id='".$_REQUEST['bid']."'";	
		 $command = $connection -> createCommand($sql);
         $command -> execute();
		 
		 
		
		 }
    else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionAddplot()
	{

	if(Yii::app()->session['user_array']['per13']=='1')		
			{

            $connection = Yii::app()->db; 
		 $projects  = "SELECT * from size_cat ";
		 $result_projects = $connection->createCommand($projects)->query();
		  $projects1  = "SELECT * from bplot_details 
		  Left join fm_balloting on bplot_details.bid=fm_balloting.id
		  Left join projects on fm_balloting.pid=projects.id
		  Left join size_cat on bplot_details.size=size_cat.id
		  ";
		 $result_projects1 = $connection->createCommand($projects1)->query();
          $this->render('addplot',array('size'=>$result_projects,'balloting'=>$result_projects1));
		  

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionAddballots()
	{if(Yii::app()->session['user_array']['per13']=='1'){		
		$connection = Yii::app()->db; 
		$sql  = 'INSERT INTO fm_balloting(pid,title,details,cdate,uid,tplot) VALUES ( "'.$_POST['project_id'].'","'.$_POST['title'].'","'.$_POST['details'].'","'.date('d-m-y').'","'.Yii::app()->session['user_array']['id'].'","'.$_POST['tplot'].'")';	
        $command = $connection -> createCommand($sql);
		$command -> execute();
		echo "New Balloting Added";}
	}
	public function actionAddplots()
	{
		if(Yii::app()->session['user_array']['per13']=='1'){		
		$connection = Yii::app()->db; 
		$sql  = 'INSERT INTO bplot_details(size,tno,bid,uid) VALUES ( "'.$_POST['size_id'].'","'.$_POST['tno'].'","'.$_POST['bid'].'","'.Yii::app()->session['user_array']['id'].'")';	
        $command = $connection -> createCommand($sql);
		$command -> execute();
		echo "Plots Added";}
	}
public function actionMainreport()
	{if(isset(Yii::app()->session['user_array']['username'])){	
	 $this->render('mainreport');
}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
    public function actionReturnb()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db;
			
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.scode1
	, forms.seller_id
	, forms.sdealer
	, forms.Gserial
    , forms.name
	   , forms.tmco
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.smode
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

WHERE forms.id=".$_REQUEST['id'].""; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			 Yii::app()->session['projects_array'];
			$connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_formpayment  = "SELECT * from formpayment WHERE title='booking'";
		    $result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
			$this->render('returnb',array('formpayment'=>$result_formpayment,'plots'=>$result_plots));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
		public function actionBookingret()
	{ 			$error =array();
	          $error='';
	
			if(isset($_POST['paidamount']) && empty($_POST['paidamount']))
			{
				$error = 'Please Enter Paidamount<br>';
			}
			
		
			if(isset($_POST['paidas']) && empty($_POST['paidas']))
			{
				$error .= 'Please Enter Paid As<br>';
			}
			if(isset($_POST['detail']) && empty($_POST['detail']))
			{
				$error .= 'Please Enter Detail<br>';
			}
		 if(empty($error))
			{
	         $connection = Yii::app()->db;  
			 $form_id=$_POST['form_id'];
			 $paidamount=$_POST['paidamount'];

             $paidas=$_POST['paidas'];
			 $detail=$_POST['detail'];
			$remarks=$_POST['remarks'];
			 
			   
				   $sql  = 'INSERT INTO rtrn_form(form_id,paidamount,paidas,detail,remarks,paid_date,type, user_id) VALUES ( "'.$form_id.'","'.$paidamount.'","'.$paidas.'","'.$detail.'","'.$remarks.'","'.date('d-m-y').'","booking","'.Yii::app()->session['user_array']['id'].'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $last_insert=Yii::app()->db->getLastInsertId();
		
			   
			  
			   $sql1  = "UPDATE forms SET book_rt='".$last_insert."' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			echo 1;
			// echo '<script>$("#submit").attr("disabled",true);
			}else{
				echo $error;
				}
			  
			

		}
		
	 public function actionReturnmm()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db;
			
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.scode1
	, forms.seller_id
	, forms.sdealer
	, forms.Gserial
    , forms.name
	   , forms.tmco
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.smode
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

WHERE forms.id=".$_REQUEST['id'].""; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			 Yii::app()->session['projects_array'];
			$connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_formpayment  = "SELECT * from formpayment WHERE title='membership'";
		    $result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
			$this->render('returnmm',array('formpayment'=>$result_formpayment,'plots'=>$result_plots));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
		public function actionMemberret()
	{ 			$error =array();
	          $error='';
	
			if(isset($_POST['paidamount']) && empty($_POST['paidamount']))
			{
				$error = 'Please Enter Paidamount<br>';
			}
			
		
			if(isset($_POST['paidas']) && empty($_POST['paidas']))
			{
				$error .= 'Please Enter Paid As<br>';
			}
			if(isset($_POST['detail']) && empty($_POST['detail']))
			{
				$error .= 'Please Enter Detail<br>';
			}
		 if(empty($error))
			{
	         $connection = Yii::app()->db;  
			 $form_id=$_POST['form_id'];
			 $paidamount=$_POST['paidamount'];

             $paidas=$_POST['paidas'];
			 $detail=$_POST['detail'];
			$remarks=$_POST['remarks'];
			 
			   
				   $sql  = 'INSERT INTO rtrn_form(form_id,paidamount,paidas,detail,remarks,paid_date,type, user_id) VALUES ( "'.$form_id.'","'.$paidamount.'","'.$paidas.'","'.$detail.'","'.$remarks.'","'.date('d-m-y').'","Membership","'.Yii::app()->session['user_array']['id'].'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $last_insert=Yii::app()->db->getLastInsertId();
		
			   
			  
			   $sql1  = "UPDATE forms SET book_rt='".$last_insert."' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			echo 1;
			// echo '<script>$("#submit").attr("disabled",true);
			}else{
				echo $error;
				}
			  
			

		}	
public function actionReport4()
	{	
	   if(isset(Yii::app()->session['user_array']['username'])){		
		
	$connection = Yii::app()->db; 

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
		$sql_size  = "SELECT * from tbl_city";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('report4',array('projects'=>$result_projects,'sizes'=>$sizes));
}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionReport5()
	{	
	   		
	if(isset(Yii::app()->session['user_array']['username'])){	
	$connection = Yii::app()->db; 

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('report5',array('projects'=>$result_projects,'sizes'=>$sizes));
}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionMembership()
	{
		
			$connection = Yii::app()->db;
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
	, forms.seller_id
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.Gserial
	, tbl_city.city
	, tbl_city.id as cid
	, forms.scode1
	, tbl_country.country
	, tbl_country.id as cuid
    , forms.name
	, forms.sodowo
	, forms.sdealer
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.address
	, forms.smode
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN tbl_city  ON (tbl_city.id = forms.city)
	Left JOIN tbl_country  ON (tbl_country.id = tbl_city.country_id)
	Left JOIN projects  ON (forms.project_id = projects.id)

WHERE forms.id=".$_REQUEST['id'].""; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			
			 Yii::app()->session['projects_array'];
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
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_formpayment  = "SELECT * from formpayment where title='membership'";
		    $result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
			  $connection = Yii::app()->db; 
		  $sql_country  = "SELECT * from tbl_country ORDER BY country ASC";
$result_country = $connection->createCommand($sql_country)->query();

			$this->render('membership',array('projects'=>$result_projects,'formpayment'=>$result_formpayment,'plots'=>$result_plots,'country'=>$result_country));
			
	}
	public function actionEditmembership()
	{
		
			$connection = Yii::app()->db;
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
	, forms.seller_id
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.Gserial
	, tbl_city.city
	, tbl_city.id as cid
	, forms.scode1
	, tbl_country.country
	, tbl_country.id as cuid
    , forms.name
	, forms.sodowo
	, forms.sdealer
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.address
	, forms.smode
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN tbl_city  ON (tbl_city.id = forms.city)
	Left JOIN tbl_country  ON (tbl_country.id = tbl_city.country_id)
	Left JOIN projects  ON (forms.project_id = projects.id)

WHERE forms.id=".$_REQUEST['id'].""; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			
			 Yii::app()->session['projects_array'];
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
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_formpayment  = "SELECT * from formpayment where title='membership'";
		    $result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
			  $connection = Yii::app()->db; 
		  $sql_country  = "SELECT * from tbl_country ORDER BY country ASC";
$result_country = $connection->createCommand($sql_country)->query();

			$this->render('editmembership',array('projects'=>$result_projects,'formpayment'=>$result_formpayment,'plots'=>$result_plots,'country'=>$result_country));
			
	}
	public function actionAddmembership()
	{            

	$error =array();
	$error='';
	
			if(isset($_POST['name']) && empty($_POST['name']))
			{
				$error = 'Please Enter Name<br>';
			}
			if(isset($_POST['sodowo']) && empty($_POST['sodowo']))
			{
				$error .= 'Please Enter Father/Spouse Name<br>';
			}
			if(isset($_POST['cnic']) && empty($_POST['cnic']))
			{
				$error .= 'Please Enter CNIC<br>';
			}
			if(isset($_POST['phone']) && empty($_POST['phone']))
			{
				$error .= 'Please Enter Phone No<br>';
			}
			if(isset($_POST['address']) && empty($_POST['address']))
			{
				$error .= 'Please Enter Address<br>';
			}
			if(isset($_POST['email']) && empty($_POST['email']))
			{
				$error .= 'Please Enter Email<br>';
			}  
		   if(isset($_POST['paidamount']) && empty($_POST['paidamount']))
			{
				$error .= 'Please Enter Paidamount<br>';
			}
			if(isset($_POST['paidas']) && empty($_POST['paidas']))
			{
				$error .= 'Please Enter Paid As<br>';
			}
			if(isset($_POST['detail']) && empty($_POST['detail']))
			{
				$error .= 'Please Enter Detail<br>';
			}
			if(isset($_POST['country']) && empty($_POST['country']))
			{
				$error .= 'Please Enter country<br>';
			}
			if(isset($_POST['city_id']) && empty($_POST['city_id']))
			{
				$error .= 'Please Enter City<br>';
			}
			 
			 $connection = Yii::app()->db;  
			$fid  = "SELECT * from installform where form_id= '".$_POST['form_id']."' and type='membership'";
			$last_fid = $connection->createCommand($fid)->queryRow();

			
				if(!empty($last_fid)){
					$error .= 'Membershipe Already Created<br>';
						}
			if(empty($error))
			{
	         
	  	     $form_id=$_POST['form_id'];
			 $paidamount=$_POST['paidamount'];
             $paidas=$_POST['paidas'];
			 $detail=$_POST['detail'];
			$remarks=$_POST['remarks'];
			
			
				   $sql  = 'INSERT INTO installform(form_id,paidamount,paidas,detail,remarks,paid_date,type,sdid,ststatus,date,user_id) VALUES ( "'.$form_id.'","'.$paidamount.'","'.$paidas.'","'.$detail.'","'.$remarks.'","'.date('d-m-y').'","membership","'.$_POST['sdealer'].'","'.$_POST['typer'].'","'.$_POST['date'].'","'.Yii::app()->session['user_array']['id'].'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   
			   $sql1  = "UPDATE forms SET mscharges='1' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			   
			   $sqlup="UPDATE forms set project_id='".$_POST['project_id']."',name='".$_POST['name']."',sodowo='".$_POST['sodowo']."',cnic='".$_POST['cnic']."',phone='".$_POST['phone']."',address='".$_POST['address']."',city='".$_POST['city_id']."',mobile='".$_POST['mobile']."',phoneres='".$_POST['phoneres']."',profession='".$_POST['profession']."',email='".$_POST['email']."' where id='".$form_id."' ";  

              $command = $connection -> createCommand($sqlup);
               $command -> execute();

			   echo 'Membership Added Successfully';
			   echo '<script>$("#login").attr("disabled",true);</script>';
			   }else{
				   echo $error;exit;
				   }
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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	
		}
		public function actionUpdatemembership()
	{            

	$error =array();
	$error='';
	
			if(isset($_POST['name']) && empty($_POST['name']))
			{
				$error = 'Please Enter Name<br>';
			}
			if(isset($_POST['sodowo']) && empty($_POST['sodowo']))
			{
				$error .= 'Please Enter Father/Spouse Name<br>';
			}
			if(isset($_POST['cnic']) && empty($_POST['cnic']))
			{
				$error .= 'Please Enter CNIC<br>';
			}
			if(isset($_POST['phone']) && empty($_POST['phone']))
			{
				$error .= 'Please Enter Phone No<br>';
			}
			if(isset($_POST['address']) && empty($_POST['address']))
			{
				$error .= 'Please Enter Address<br>';
			}
			if(isset($_POST['email']) && empty($_POST['email']))
			{
				$error .= 'Please Enter Email<br>';
			}  
		   if(isset($_POST['paidamount']) && empty($_POST['paidamount']))
			{
				$error .= 'Please Enter Paidamount<br>';
			}
			if(isset($_POST['paidas']) && empty($_POST['paidas']))
			{
				$error .= 'Please Enter Paid As<br>';
			}
			if(isset($_POST['detail']) && empty($_POST['detail']))
			{
				$error .= 'Please Enter Detail<br>';
			}
			if(isset($_POST['country']) && empty($_POST['country']))
			{
				$error .= 'Please Enter country<br>';
			}
			if(isset($_POST['city_id']) && empty($_POST['city_id']))
			{
				$error .= 'Please Enter City<br>';
			}
			 
			 $connection = Yii::app()->db;  
			
			if(empty($error))
			{
	         
	  	     $form_id=$_POST['form_id'];
			 $paidamount=$_POST['paidamount'];
             $paidas=$_POST['paidas'];
			 $detail=$_POST['detail'];
			$remarks=$_POST['remarks'];
			
			
			   $sql  = "UPDATE installform SET paidamount='".$paidamount."',paidas='".$paidas."',detail='".$detail."',remarks='".$remarks."'
			   ,sdid='".$_POST['sdealer']."',ststatus='".$_POST['typer']."',date='".$_POST['date']."',user_id='".Yii::app()->session['user_array']['id']."' where form_id='".$form_id."' and type='membership'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			      
			   $sqlup="UPDATE forms set project_id='".$_POST['project_id']."',name='".$_POST['name']."',sodowo='".$_POST['sodowo']."',cnic='".$_POST['cnic']."',phone='".$_POST['phone']."',address='".$_POST['address']."',city='".$_POST['city_id']."',mobile='".$_POST['mobile']."',phoneres='".$_POST['phoneres']."',profession='".$_POST['profession']."',email='".$_POST['email']."' where id='".$form_id."' ";  

              $command = $connection -> createCommand($sqlup);
               $command -> execute();

			   echo 'Membership Updated Successfully';
			   echo '<script>$("#login").attr("disabled",true);</script>';
			   }else{
				   echo $error;exit;
				   }
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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	
		}
	public function actionSearchreqbal()
	{
			$connection = Yii::app()->db; 
			$pro='';
			$cnic='';		
			$where='';
			$and = false;
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			if($_POST['cnic']=='' && $_POST['formno']==''){
if ($and==true)
				{
					$where.=" and forms.bstatus='".$_REQUEST['id']."'";
				}
				else
				{
					$where.=" forms.bstatus='".$_REQUEST['id']."'";
				}
				$and=true;
}
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.="and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				else
				{
					$where.="CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				$and=true;
			}


			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
			//for Pagination 

$connection = Yii::app()->db;

$sql_memberas = "SELECT
    forms.id

FROM
    forms
	Left JOIN user  ON (user.id = forms.user_id)
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
where $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);//for Pagination 		


	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	 , forms.scode
	  , forms.scode1
	   , forms.Gserial
    , forms.name
, forms.bstatus
	, seller.name as sname
	, user.username as username
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.rdate
	, forms.phone
	, forms.phoneres
	, forms.mobile
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,forms.fsfstatus
	,forms.tmfstatus
	,forms.ocfstatus
	,size_cat.size
FROM
    forms
	Left JOIN user  ON (user.id = forms.user_id)
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

where $where  "; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 if(isset($_POST['cnic'])){
	  $sql_memberas = "SELECT * FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where  m.cnic='".$_POST['cnic']."' and mp.status='Approved' ";}
 $co = $connection->createCommand($sql_memberas)->queryAll();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
	$sql_size  = "SELECT * from size_cat";
	$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	$this->render('bal_res',array('members'=>$result_members,'co'=>$co,'projects'=>$result_project));
	exit;	 

			
	}
	public function actionSearchreqbal1()
 	{
			
$connection = Yii::app()->db; 
			$pro='';
			$cnic='';		
			$where='';
			$and = false;
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.="and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				else
				{
					$where.="CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				$and=true;
			}

if($_POST['cnic']=='' && $_POST['formno']==''){
if ($and==true)
				{
					$where.=" and forms.project_id LIKE '00'";
				}
				else
				{
					$where.=" forms.project_id LIKE '00'";
				}
				$and=true;
}
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
			//for Pagination 

$connection = Yii::app()->db;

$sql_memberas = "SELECT
    forms.id

FROM
    forms
	Left JOIN user  ON (user.id = forms.user_id)
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
where $where"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);//for Pagination 		


	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	 , forms.scode
	  , forms.scode1
	   , forms.Gserial
, forms.bstatus
    , forms.name
	, seller.name as sname
	, user.username as username
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.rdate
	, forms.phone
	, forms.phoneres
	, forms.mobile
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,forms.fsfstatus
	,forms.tmfstatus
	,forms.ocfstatus
	,size_cat.size
FROM
    forms
	Left JOIN user  ON (user.id = forms.user_id)
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

where $where "; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 if(isset($_POST['cnic'])){
	  $sql_memberas = "SELECT * FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where  m.cnic='".$_POST['cnic']."' and mp.status='Approved' ";}
 $co = $connection->createCommand($sql_memberas)->queryAll();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
	$sql_size  = "SELECT * from size_cat";
	$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	$this->layout='//layouts/front';

	$this->render('bal_res1',array('members'=>$result_members,'co'=>$co,'projects'=>$result_project));
	exit;	 

			
	}
		public function actionSearchreqnew()
	 	{
			
		
			
		
			$connection = Yii::app()->db; 
			$pro='';
			$cnic='';		
			$where='';
			$and = false;
				
			    
			
					if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.="and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				else
				{
					$where.="CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['seller']) && $_POST['seller']!=""){
       		$seller=$_POST['seller'];
		if ($and==true)
				{
					  $where.="and forms.seller_id = '".$_POST['seller']."'";
				}
				else
				{
					$where.="forms.seller_id = '".$_POST['seller']."'";
				}
				$and=true;
			}
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		
		if ($and==true)
				{
					  $where.="and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.="forms.cnic = '".$_POST['cnic']."'";
				}
				$and=true;
			}


			if ( isset($_POST['sseller']) &&  $_POST['sseller']!=""){				
				if ($and==true)
				{
					$where.=" and installform.sdid = '".$_POST['sseller']."'";
				}
				else
				{
					$where.=" installform.sdid = '".$_POST['sseller']."'";
				}
				$and=true;
			}
			if ( isset($_POST['type']) &&  $_POST['type']!=""){				
				if ($and==true)
				{
					$where.=" and installform.type = '".$_POST['type']."'";
				}
				else
				{
					$where.=" installform.type = '".$_POST['type']."'";
				}
				$and=true;
			}
			if ( isset($_POST['mode']) &&  $_POST['mode']!=""){				
				if ($and==true)
				{
					$where.=" and installform.ststatus = '".$_POST['mode']."'";
				}
				else
				{
					$where.=" installform.ststatus = '".$_POST['mode']."'";
				}
				$and=true;
			}

			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
			if ( isset($_POST['con']) &&  $_POST['con']!=""){				
				
				if ($and==true)
				{
					$where.=" and forms.tmco='".$_POST['con']."'";
				}
				else
				{
					$where.=" forms.tmco='".$_POST['con']."'";
				}
				$and=true;
			}
			if ( isset($_POST['active']) &&  $_POST['active']!=""){				
				
				if ($and==true)
				{
					$where.=" and installform.user_id='".Yii::app()->session['user_array']['id']."'";
				}
				else
				{
					$where.=" installform.user_id='".Yii::app()->session['user_array']['id']."'";
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
$sql_memberas = "SELECT
    forms.id

FROM
    installform
	Left JOIN forms  ON (installform.form_id = forms.id)
	Left JOIN seller  ON (forms.seller_id = seller.id)
	Left JOIN projects  ON (forms.project_id = projects.id)
	
where $where"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);//for Pagination 		


	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	 , forms.scode
	  , forms.scode1
	   , forms.Gserial
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.rdate
	, forms.phone
	, forms.phoneres
	, forms.mobile
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,forms.fsfstatus
	,forms.tmfstatus
	,forms.ocfstatus
	
	
FROM
    installform
	Left JOIN forms  ON (installform.form_id = forms.id)
	Left JOIN projects  ON (forms.project_id = projects.id)
	where $where limit $start,$limit "; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
	$sql_size  = "SELECT * from size_cat";

	$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 

$check=1;
    $res=array();
   foreach($result_members as $key){
            $count++;
			 
			
$home="";
$home=Yii::app()->request->baseUrl; 
			

			 echo '<tr><td>'. $count.'</td><td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td>';
			 
			 
			
		
echo '<a  href="fstatus?id='.$key['id'].'">View Status</a>';
echo '</td>';
			

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

	echo '<tr><td colspan="6">Total Record Found :'.$rows.''.$pagination.'</td></tr>'; exit; 
	// for pagination  
	exit;
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
	
	public function actionFormssearch()
	{	

		if(isset(Yii::app()->session['user_array']['username'])){	
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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	    		    $home=Yii::app()->request->baseUrl; 
		$sql_seller  = "SELECT * from seller";
		$sellers = $connection->createCommand($sql_seller)->query();	
		$sql_sseller  = "SELECT * from sdealer";
		$ssellers = $connection->createCommand($sql_sseller)->query();	
		$this->render('forms_lis1',array('projects'=>$result_projects,'sizes'=>$sizes,'sellers'=>$sellers,'dealers'=>$ssellers));
	}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionCheck($cnic)
	{	

	$connection = Yii::app()->db;  

		$sql_street  = "SELECT * from forms where cnic='".$cnic."'";

		$result_streets = $connection->createCommand($sql_street)->queryAll();

			

		$street=array();

		foreach($result_streets as $str){

			$street[]=$str;

			} 

		

	echo json_encode($street); exit();

	}
	
	public function actionAddschema()
	{ 
	      $connection = Yii::app()->db;  
	             $error =array();
				  $error='';
				if(isset($_POST['scode']) && empty($_POST['scode']))
			{
				$error = 'Please First Code <br>';
			}
				if(isset($_POST['gserial']) && empty($_POST['gserial']))
			{
				$error .= 'Please G.Serial<br>';
			}
			if(isset($_POST['scode1']) && empty($_POST['scode1']))
			{
				$error .= 'Please Second Code<br>';
			}
			 $id  = "SELECT * from `schema` where project_id='".$_POST['project_id']."' ";
			 $last_id = $connection->createCommand($id)->queryRow();
			if(!empty($last_id)){$error .= 'Schema for selected Project aleady Exist  <br>';} 
			 
			  if(empty($error))
			{
           
 $sql  = "INSERT INTO `schema` (`scode`,`scode1`,`Gserial`,`project_id`) VALUES ( '".$_POST['scode']."','".$_POST['scode1']."','".$_POST['gserial']."','".$_POST['project_id']."')";
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			 
			  	echo $note="New Record Inserted Successfully";exit;
	}
	else{
		echo $error;
		}
		}
	
	
		public function actionAddpayment()
	{ 
	          $connection = Yii::app()->db;  
	             $error =array();
				if(isset($_POST['title']) && empty($_POST['title']))
			{
				$error = 'Please Enter Title<br>';
			}
			if(isset($_POST['amount']) && empty($_POST['amount']))
			{
				$error .= 'Please Enter Amount<br>';
			}
			  if(empty($error))
			{
          
			$title= $_POST['title'];
             $amount=$_POST['amount'];
			
			   $sql  = 'INSERT INTO formpayment (title,amount) VALUES ( "'.$title.'","'.$amount.'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			 
			

	          	echo $note="New Record Inserted Successfully";
	}
	else{
		echo $error;
		}
		}
	
	public function actionAllot()
	{

	if(isset(Yii::app()->session['user_array']['username']))
			{

            $connection = Yii::app()->db; 

          $id  = "SELECT max(formno) as formno,scode,scode1 from forms ";
		 $last_id = $connection->createCommand($id)->queryRow();
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->query();
		 $seller  = "SELECT * from seller ";
		 $result_seller = $connection->createCommand($seller)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	  		  $this->render('allot',array('last_id'=>$last_id,'projects'=>$result_projects,'seller'=>$result_seller,'sizes'=>$sizes));
			}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionAuthorize()
	{



            $connection = Yii::app()->db; 

          $id  = "SELECT max(formno) as formno,scode,scode1,Gserial from forms ";
		 $last_id = $connection->createCommand($id)->queryRow();
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->query();
		 $user  = "SELECT * from user ";
		 $result_user= $connection->createCommand($user)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	  		  $this->render('authorize',array('last_id'=>$last_id,'projects'=>$result_projects,'user'=>$result_user,'sizes'=>$sizes));
	}
	
	public function actionFstatus()
	{
		 $connection = Yii::app()->db; 
		 $id  = "SELECT forms.*,projects.project_name,seller.name as sname,seller.logo from forms
		 
		 left join projects on forms.project_id=projects.id
		
		  left join seller on forms.seller_id=seller.id
		 where forms.id='".$_REQUEST['id']."' ";
		 $last_id = $connection->createCommand($id)->queryRow();
		 $this->render('fstatus',array('formde'=> $last_id));
	}
	
	public function actionFinancedb()
	{
       
		       
               $this->render('financedb');
	}
	public function actionChangeapp()
	{  
	$connection = Yii::app()->db;
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.scode1
	, forms.seller_id
	, forms.sdealer
	, forms.Gserial
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.smode
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

WHERE forms.id=".$_REQUEST['id'].""; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			$sql_country  = "SELECT * from tbl_country ORDER BY country ASC";
$result_country = $connection->createCommand($sql_country)->query();
	$this->render('changeapp',array('plots'=>$result_plots, 'country'=>$result_country));
	}
	public function actionEditdist()
	{  
	$this->render('editdist');
	}
	public function actionDisedit()
	{  
	$connection = Yii::app()->db;
	$sql  = "UPDATE disforms SET `from`='".$_POST['from']."',`to`='".$_POST['to']."',`remarks`='".$_POST['remarks']."' where id='".$_POST['did']."'";	
     $command = $connection -> createCommand($sql);
	 $command -> execute();
	 $this->redirect(Yii::app()->baseUrl."/index.php/forms/allot"); 
	}
	Public function actionPaymentdetails()
	{  
	$connection = Yii::app()->db; 
	$sql_formpayment  = "SELECT installform.type as ftype,user.*,user.mobile as umobile, installform.*,forms.id as fid,forms.*,seller.name as dname,sdealer.name as sdname
	
	from installform
	left join forms on installform.form_id=forms.id
	left join user on installform.user_id=user.id
	left join seller on forms.seller_id=seller.id
	left join sdealer on installform.sdid=sdealer.id
	where installform.id='".$_REQUEST['id']."' 
		 ";
		$formpayment = $connection->createCommand($sql_formpayment)->queryAll();
	$this->render('paymentdetails',array('payments'=>$formpayment));
	}
	Public function actionPaymentupdate()
	{  
	$col='';
	if($_POST['paytype']=='booking'){$col='tmfstatus';}
	if($_POST['paytype']=='membership'){$col='fsfstatus';}
	if($_POST['paytype']=='certificate'){$col='ocfstatus';}
	
		$connection = Yii::app()->db; 
		 $sql  = "UPDATE forms SET ".$col."='".$_POST['status']."' where id='".$_POST['fid']."'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   echo 'Payment Updated';exit;
	}
	public function actionFinance()
	{

	

            $connection = Yii::app()->db; 


          $id  = "SELECT max(formno) as formno,scode,scode1,Gserial from forms ";
		 $last_id = $connection->createCommand($id)->queryRow();
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->query();
		 $user  = "SELECT * from user ";
		 $result_user= $connection->createCommand($user)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	  		  $this->render('finance',array('last_id'=>$last_id,'projects'=>$result_projects,'user'=>$result_user,'sizes'=>$sizes));
		


	}
	public function actionSchema_lis()
	{
		 $this->render('schema_lis');
	}
	public function actionCheckdb1()
	{
//echo 123;exit;
		 $this->render('checkdb1');
	}
public function actionCheckdb2()
	{
//echo 123;exit;
		 $this->render('checkdb2');
	}
public function actionCheckdb3()
	{
//echo 123;exit;
		 $this->render('checkdb3');
	}
	public function actionAuthorizeforms()
	{ 
	         $connection = Yii::app()->db;  
	         $error =array();
				if(isset($_POST['from']) && empty($_POST['from']))
			{
				$error = 'Please Enter From<br>';
			}
			if(isset($_POST['to']) && empty($_POST['to']))
			{
				$error .= 'Please Enter To<br>';
			}
			  if(empty($error))
			{
             
			
			 $user_id=$_POST['user_id'];
			 $from=$_POST['from'];
             $to=$_POST['to'];
			 $sql  = 'UPDATE forms set user_id="'.$user_id.'" where formno BETWEEN '.$from.' AND '.$to.' AND scode='.$_POST['scode'].' AND scode1='.$_POST['scode1'].' AND project_id='.$_POST['project_id'].'';	
             $command = $connection -> createCommand($sql);
			 $command -> execute();
			 echo $note="Forms Authorized  Successfully";
			
	}
	else{
		echo $error;
		}
		}
		public function actionAssignforms()
	{ 
	         $connection = Yii::app()->db;  
	         $error =array();
				if(isset($_POST['from']) && empty($_POST['from']))
			{
				$error = 'Please Enter From<br>';
			}
			if(isset($_POST['to']) && empty($_POST['to']))
			{
				$error .= 'Please Enter To<br>';
			}
			  if(empty($error))
			{
             
			
			 $fuser_id=$_POST['fuser_id'];
			 $from=$_POST['from'];
             $to=$_POST['to'];
			 $sql  = 'UPDATE forms set fuser_id="'.$fuser_id.'" where formno BETWEEN '.$from.' AND '.$to.' AND scode='.$_POST['scode'].' AND scode1='.$_POST['scode1'].' AND project_id='.$_POST['project_id'].'';	
             $command = $connection -> createCommand($sql);
			 $command -> execute();
			 echo $note="Forms Assigned  Successfully";
			
	}
	else{
		echo $error;
		}
		}
	
	public function actionAllotforms()
	{ 
	      $connection = Yii::app()->db;  
	         $error =array();
				if(isset($_POST['from']) && empty($_POST['from']))

			{
				$error = 'Please Enter From<br>';

			}
			
			if(isset($_POST['to']) && empty($_POST['to']))

			{
				$error .= 'Please Enter To<br>';

			}
			  if(empty($error))
			{
           
			 $seller_id=$_POST['seller_id'];
			 $from=$_POST['from'];
			 
             $to=$_POST['to'];
			 $sql  = 'UPDATE forms set seller_id="'.$seller_id.'" where formno BETWEEN '.$from.' AND '.$to.' AND scode='.$_POST['scode'].' AND scode1='.$_POST['scode1'].' AND project_id='.$_POST['project_id'].'';	
			 	
            $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $sql1  = 'INSERT INTO disforms (`dis_id`,`from`,`to`,`date`) VALUES ( "'.$seller_id.'","'.$from.'","'.$to.'","'.date('d-m-y').'")';	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			
	          	echo $note="Forms Allotted  Successfully";
	}
	else{
		echo $error;
		}
		}
	
	public function actionCreate()
	{ 
	      $connection = Yii::app()->db;  
	             $error =array();
				if(isset($_POST['qty']) && empty($_POST['qty']))
			{
				$error = 'Please Enter Quantity<br>';
			}
			if(isset($_POST['project_id']) && empty($_POST['project_id']))
			{
				$error .= 'Please Select Project<br>';
			}
			  if(empty($error))
			{
            $qty=$_POST['qty'];
			 $loop=0;
			  $gserial=1;
			  $formno=$_POST['formno'];
			$scema  = "SELECT * from `schema` WHERE project_id='".$_POST['project_id']."'";
			$schema = $connection->createCommand($scema)->queryRow();
		     $scode1=$schema['scode1'];
			 $project_id=$_POST['project_id'];
			 $scode=$schema['scode'];
			 do{		
			$id  = "SELECT max(formno) as formno,scode,scode1 from forms ";
			$last_id = $connection->createCommand($id)->queryRow();
			$tform= $last_id['formno'];
			
			 if($tform>=9999 && $tform<19999){
				 $gserial=2;	
                  }
			      elseif($tform>=19999 && $tform<29999){
				  $gserial=3;}
				  elseif(($tform>=29999) && ($tform<39999)){
				  $gserial=4;}
				  elseif(($tform>=39999) && ($tform<49999)){
				  $gserial=5;}
				  elseif(($tform>=49999) && ($tform<59999)){
				  $gserial=6;}
				  elseif(($tform>=59999) && ($tform<69999)){
				  $gserial=7;}
				  elseif(($tform>=69999) && ($tform<79999)){
				  $gserial=8;}
				   elseif(($tform>=79999) && ($tform<89999)){
				  $gserial=9;}
				   elseif(($tform>=89999) && ($tform<99999)){
				  $gserial=0;}
				  elseif(($tform>=99999) && ($tform<110000)){
				  $gserial='';}
				$formno++;
			   	$loop++;
			   $sql  = 'INSERT INTO forms (formno,scode,scode1,smode,Gserial,project_id,rdate) VALUES 
			   ( "'.$formno.'","'.$scode.'","'.$scode1.'","Dealer","'. $gserial.'","'.$project_id.'","'.date('d-m-y').'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			    
			 }while($qty > $loop);
			echo $note="New Record Inserted Successfully";
		}
	else{
		echo $error;
		}
		}
	
	
	
		public function actionAddbooking()
	{ 			$error =array();
	          $error='';
	
			if(isset($_POST['paidamount']) && empty($_POST['paidamount']))
			{
				$error = 'Please Enter Paidamount<br>';
			}
			if(isset($_POST['size']) && empty($_POST['size']))
			{
				$error .= 'Please Enter Size<br>';
			}
		
			if(isset($_POST['paidas']) && empty($_POST['paidas']))
			{
				$error .= 'Please Enter Paid As<br>';
			}
			if(isset($_POST['detail']) && empty($_POST['detail']))
			{
				$error .= 'Please Enter Detail<br>';
			}
		 if(empty($error))
			{
	         $connection = Yii::app()->db;  
			 $form_id=$_POST['form_id'];
			 $paidamount=$_POST['paidamount'];

             $paidas=$_POST['paidas'];
			 $detail=$_POST['detail'];
			$remarks=$_POST['remarks'];
			  if(isset($_POST['ftype']) && $_POST['ftype']!==''){
			   $sql  = "UPDATE installform SET paidamount='".$paidamount."',paidas='".$paidas."',detail='".$detail."',remarks='".$remarks."'
			   ,sdid='".$_POST['sdealer']."',ststatus='".$_POST['typer']."',date='".$_POST['date']."',user_id='".Yii::app()->session['user_array']['id']."'
			    where form_id='".$form_id."' and type='booking'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			  	$num_of_category = 'SELECT count(id) as num_of_category from categories';

		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();

		$res=array();

		foreach($num_of_category as $num_of_category)



		{

			$num_of_category = 	$num_of_category['num_of_category'];

		}

		if($num_of_category>0)

		{$query  = 'DELETE from  cat_forms 



			   where form_id='.$form_id.' ';



		        $command = $connection -> createCommand($query);



               $command -> execute();}



		while ($num_of_category>0)



		{

			if (isset($_POST[$num_of_category]))
				{
					$cat_id = $_POST[$num_of_category]; 
					$connection = Yii::app()->db;
					$add_project_per_query = "INSERT into cat_forms	set form_id='".$form_id."',cat_id='".$cat_id."' ";
					$command = $connection -> createCommand($add_project_per_query);
					$command -> execute();
				}

			$num_of_category--;

		}

			   }else
			   {
				   $sql  = 'INSERT INTO installform(form_id,paidamount,paidas,detail,remarks,paid_date,type,sdid,ststatus,date, user_id) VALUES ( "'.$form_id.'","'.$paidamount.'","'.$paidas.'","'.$detail.'","'.$remarks.'","'.date('d-m-y').'","booking","'.$_POST['sdealer'].'","'.$_POST['typer'].'","'.$_POST['date'].'","'.Yii::app()->session['user_array']['id'].'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
		$num_of_category = 'SELECT count(id) as num_of_category from categories';

		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();

		$res=array();

		foreach($num_of_category as $num_of_category)

		{

			$num_of_category = 	$num_of_category['num_of_category'];

		}

		while ($num_of_category>0)

		{

			if (isset($_POST[$num_of_category]))

				{			 

					$cat_id = $_POST[$num_of_category]; 

					$connection = Yii::app()->db;

					$add_project_per_query = "insert into cat_forms 

												set form_id='".$form_id."',cat_id='".$cat_id."' ";

					$command = $connection -> createCommand($add_project_per_query);

					$command -> execute();

				}

			$num_of_category--;

		}
			   }
			  
			   $sql1  = "UPDATE forms SET tm='1',type='".$_POST['type']."',size='".$_POST['size']."',smode='".$_POST['typer']."',tmco='".$_POST['confirm']."',sdealer='".$_POST['sdealer']."' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			echo 1;
			// echo '<script>$("#submit").attr("disabled",true);
			}else{
				echo $error;
				}
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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
			

		}
		public function actionAddcertificate()
	{ 			$error =array();
	          $error='';
	
			if(isset($_POST['paidamount']) && empty($_POST['paidamount']))
			{
				$error = 'Please Enter Paidamount<br>';
			}
			
		
			if(isset($_POST['paidas']) && empty($_POST['paidas']))
			{
				$error .= 'Please Enter Paid As<br>';
			}
			if(isset($_POST['detail']) && empty($_POST['detail']))
			{
				$error .= 'Please Enter Detail<br>';
			}
 $connection = Yii::app()->db; 
			 $sql_size1  = "SELECT * from installform where form_id='".$_POST['form_id']."' and type='certificate'";
		$sizes1 = $connection->createCommand($sql_size1)->queryAll();
			$co=count($sizes1);
			if($co!==0){$error .= 'Alreadt Submited';}
			 if(empty($error))
			{
	         $connection = Yii::app()->db;  
			 $form_id=$_POST['form_id'];
			 $paidamount=$_POST['paidamount'];

             $paidas=$_POST['paidas'];
			 $detail=$_POST['detail'];
			$remarks=$_POST['remarks'];
			   $sql  = 'INSERT INTO installform(form_id,paidamount,paidas,detail,remarks,paid_date,type,sdid,ststatus,date,user_id) VALUES ( "'.$form_id.'","'.$paidamount.'","'.$paidas.'","'.$detail.'","'.$remarks.'","'.date('d-m-y').'","certificate","'.$_POST['sdealer'].'","'.$_POST['typer'].'" ,"'.$_POST['date'].'" ,"'.Yii::app()->session['user_array']['id'].'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   
			  
			   $sql1  = "UPDATE forms SET oc='1' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			echo 1;
		
			}else{
				echo $error;
				}
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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
			

		}
		
	function actionGenpdf()

	{ if (!empty($_POST['submit'])){

exit;

    //require_once();

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
public function actionUpdatecertificate()
	{ 			$error =array();
	          $error='';
	
			if(isset($_POST['paidamount']) && empty($_POST['paidamount']))
			{
				$error = 'Please Enter Paidamount<br>';
			}
			
		
			if(isset($_POST['paidas']) && empty($_POST['paidas']))
			{
				$error .= 'Please Enter Paid As<br>';
			}
			if(isset($_POST['detail']) && empty($_POST['detail']))
			{
				$error .= 'Please Enter Detail<br>';
			}
			 if(empty($error))
			{
	         $connection = Yii::app()->db;  
			 $paidas=$_POST['paidas'];
			 $detail=$_POST['detail'];
			$remarks=$_POST['remarks'];
			$form_id=$_POST['form_id'];
			  
			    $sql1  = "UPDATE installform SET paidas='".$paidas."',detail='".$detail."',remarks='".$remarks."',sdid='".$_POST['sdealer']."',ststatus='".$_POST['typer']."',date='".$_POST['date']."',user_id='".Yii::app()->session['user_array']['id']."' where form_id='".$form_id."' AND type='certificate'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			echo'Successfully Updated';
			}else{
				echo $error;
				}
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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
			

		}
public function actionUpdatecert()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db;
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.scode1
	, forms.Gserial
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.seller_id
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
		,forms.sdealer
	,size_cat.size
	,installform.detail
	,installform.paidas
	,installform.date
	,installform.paidamount
	,installform.sdid
	,installform.ststatus
	,installform.type
	,installform.remarks
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
	Left JOIN installform  ON (installform.form_id = forms.id)
where forms.id='".$_REQUEST['id']."' AND installform.type='certificate'"; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			 Yii::app()->session['projects_array'];
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
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_formpayment  = "SELECT * from formpayment Where title='open certificate'";
		    $result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
	
			$this->render('updatecert',array('projects'=>$result_projects,'formpayment'=>$result_formpayment,'plots'=>$result_plots));
			}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
public function actionBooking()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db;
			$sql12  = "SELECT categories.name,cat_forms.id from cat_forms
			Left JOIN categories  ON (cat_forms.cat_id = categories.id)
			 where form_id='".$_REQUEST['id']."'";
		    $result12 = $connection->createCommand($sql12)->queryAll();
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.scode1
	, forms.seller_id
	, forms.sdealer
	, forms.Gserial
    , forms.name
	   , forms.tmco
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.smode
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

WHERE forms.id=".$_REQUEST['id'].""; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			 Yii::app()->session['projects_array'];
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
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_formpayment  = "SELECT * from formpayment WHERE title='booking'";
		    $result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
			$sql_size =   "select * from size_cat";
			$result_size = $connection->createCommand($sql_size)->queryAll();
			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			$this->render('booking',array('projects'=>$result_projects,'formpayment'=>$result_formpayment,'plots'=>$result_plots,'size'=>$result_size,'categories'=>$categories,'cat'=>$result12));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionOpencert()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db;
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
	 , forms.oc
    , forms.size
	, forms.scode
	, forms.scode1
	, forms.Gserial
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.address
	, forms.seller_id
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

WHERE forms.id=".$_REQUEST['id'].""; 
			$result_plots = $connection->createCommand($sql_plots)->queryAll();
			 Yii::app()->session['projects_array'];
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
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_formpayment  = "SELECT * from formpayment Where title='open certificate'";
		    $result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
	
			$this->render('opencert',array('projects'=>$result_projects,'formpayment'=>$result_formpayment,'plots'=>$result_plots));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}

public function actionAjaxRequest3($val1)
{	








		$connection = Yii::app()->db;  







		$sql_city  = "SELECT * from tbl_city where country_id='".$val1."' ORDER BY city ASC";







		$result_city = $connection->createCommand($sql_city)->query();







			







		$city=array();







		foreach($result_city as $cit){







			$city[]=$cit;







			} 







		







	echo json_encode($city); exit();







	}
	
public function actionUpdateforms()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db;
			 $sql_plots = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	, forms.scode
	, forms.scode1
	, forms.Gserial
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.phoneres
	, forms.profession
	, forms.mobile
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

where forms.id='".$_REQUEST['id']."'"; 
			$result_plots = $connection->createCommand($sql_plots)->query();
			 Yii::app()->session['projects_array'];
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
			$num_of_category = 'SELECT count(id) as num_of_category from categories';
		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();
			$sql_size  = "SELECT * from size_cat";
		    $result_size = $connection->createCommand($sql_size)->query();
			$this->render('updateforms',array('projects'=>$result_projects,'size'=>$result_size,'plots'=>$result_plots));



			   



			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionformpayment_edit()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db;
			 $sql_plots = "SELECT  * FROM formpayment where id='".$_REQUEST['id']."'"; 
			$result_plots = $connection->createCommand($sql_plots)->query();
			 Yii::app()->session['projects_array'];
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
		
			$this->render('formpayment_edit',array('projects'=>$result_projects,'plots'=>$result_plots));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
}
	public function actionUpdate11()
	{            $error =array();
	$error='';

		
			
               $connection = Yii::app()->db;  
				 $sql="UPDATE forms set project_id='".$_POST['project_id']."',name='".$_POST['name']."',sodowo='".$_POST['sodowo']."',cnic='".$_POST['cnic']."',phone='".$_POST['phone']."',address='".$_POST['address']."',mobile='".$_POST['mobile']."',phoneres='".$_POST['phoneres']."',profession='".$_POST['profession']."',email='".$_POST['email']."' where id='".$_POST['id']."' ";  

              $command = $connection -> createCommand($sql);
               $command -> execute();
			$this->redirect(Yii::app()->baseUrl."/index.php/forms/forms_lis");
			 
			 
	}
	public function actionUpdatebook()
	{     
	       $connection = Yii::app()->db;
	      $sql_forms  = "SELECT * from forms where id ='".$_POST['id']."'";
		  $result_forms = $connection->createCommand($sql_forms)->queryAll();
	        foreach($result_forms as $key){
				  $sql11="INSERT INTO formshistory set  form_id='".$key['id']."',project_id='".$key['project_id']."',name='".$key['name']."',sodowo='".$key['sodowo']."',cnic='".$key['cnic']."',phone='".$key['phone']."',address='".$key['address']."',city='".$key['city']."',mobile='".$key['mobile']."',phoneres='".$key['phoneres']."',profession='".$key['profession']."',email='".$key['email']."'  "; 
			}
              $command = $connection -> createCommand($sql11);
               $command -> execute();
		  $error =array();
	      $error='';
		   if(isset($_POST['name']) && empty($_POST['name']))
			{
				$error .= 'Please Enter Name<br>';
			}
			if(isset($_POST['sodowo']) && empty($_POST['sodowo']))
			{
				$error .= 'Please Enter Father/Spouse Name<br>';
			}
			if(isset($_POST['cnic']) && empty($_POST['cnic']))
			{
				$error .= 'Please Enter CNIC<br>';
			}
			if(isset($_POST['phone']) && empty($_POST['phone']))
			{
				$error .= 'Please Enter Phone No<br>';
			}
			if(isset($_POST['address']) && empty($_POST['address']))
			{
				$error .= 'Please Enter Address<br>';
			}
			if(isset($_POST['country']) && empty($_POST['country']))
			{
				$error .= 'Please Enter Country<br>';
			}
			if(isset($_POST['city']) && empty($_POST['city']))
			{
				$error .= 'Please Enter City<br>';
			}
			if(isset($_POST['email']) && empty($_POST['email']))
			{
				$error .= 'Please Enter Email<br>';
			}  
			  
			
			if(empty($error))
			{
               $connection = Yii::app()->db;  
				 $sql="UPDATE forms set project_id='".$_POST['project_id']."',name='".$_POST['name']."',sodowo='".$_POST['sodowo']."',cnic='".$_POST['cnic']."',phone='".$_POST['phone']."',address='".$_POST['address']."',city='".$_POST['city_id']."',mobile='".$_POST['mobile']."',phoneres='".$_POST['phoneres']."',profession='".$_POST['profession']."',email='".$_POST['email']."' where id='".$_POST['id']."' ";  

              $command = $connection -> createCommand($sql);
               $command -> execute();
			echo'Form Updated Successfully';
			}else{
				echo $error;
				}
			 
			 
	}
	public function actionUpdate()
	{            $error =array();
	$error='';

		   if(isset($_POST['name']) && empty($_POST['name']))
			{
				$error .= 'Please Enter Name<br>';
			}
			if(isset($_POST['sodowo']) && empty($_POST['sodowo']))
			{
				$error .= 'Please Enter Father/Spouse Name<br>';
			}
			if(isset($_POST['cnic']) && empty($_POST['cnic']))
			{
				$error .= 'Please Enter CNIC<br>';
			}
			if(isset($_POST['phone']) && empty($_POST['phone']))
			{
				$error .= 'Please Enter Phone No<br>';
			}
			if(isset($_POST['address']) && empty($_POST['address']))
			{
				$error .= 'Please Enter Address<br>';
			}
			if(isset($_POST['email']) && empty($_POST['email']))
			{
				$error .= 'Please Enter Email<br>';
			}  
			  
			
			if(empty($error))
			{
               $connection = Yii::app()->db;  
				 $sql="UPDATE forms set project_id='".$_POST['project_id']."',name='".$_POST['name']."',sodowo='".$_POST['sodowo']."',cnic='".$_POST['cnic']."',phone='".$_POST['phone']."',address='".$_POST['address']."',mobile='".$_POST['mobile']."',phoneres='".$_POST['phoneres']."',profession='".$_POST['profession']."',email='".$_POST['email']."' where id='".$_POST['id']."' ";  

              $command = $connection -> createCommand($sql);
               $command -> execute();
			echo'Form Updated Successfully';
			}else{
				echo $error;
				}
			 
			 
	}
	public function actionEdit()
	{            $error =array();
	$error='';

               $connection = Yii::app()->db;  
				 $sql="UPDATE formpayment set title='".$_POST['title']."',amount='".$_POST['amount']."' where id='".$_POST['id']."' ";  

              $command = $connection -> createCommand($sql);
               $command -> execute();
			 $this->redirect(Yii::app()->baseUrl."/index.php/forms/formpayment_lis");
			 
			 
	}
	public function actionDeleteform()

	{          

			   $connection = Yii::app()->db;  
			  $query  = "DELETE from forms where id='".$_REQUEST['id']."'";
		      $command = $connection -> createCommand($query);
              $command -> execute();
				$query  = "DELETE from installform where form_id='".$_REQUEST['id']."'";
		        $command = $connection -> createCommand($query);
                $command -> execute();
			   $this->redirect(Yii::app()->baseUrl."/index.php/forms/forms_lis");



	} 	

public function actionSearchreq()
{
			
		
			
		
			$connection = Yii::app()->db; 
			$pro='';
			$cnic='';		
			$where='';
			$and = false;
				
			    
			
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.="and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				else
				{
					$where.="CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				$and=true;
			}


			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
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
$sql_memberas = "SELECT
    forms.id

FROM
    forms
	Left JOIN user  ON (user.id = forms.user_id)
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
where $where"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);//for Pagination 		


	$connection = Yii::app()->db; 
 $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	 , forms.scode
	  , forms.scode1
	   , forms.Gserial
    , forms.name
	, seller.name as sname
	, user.username as username
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.rdate
	, forms.phone
	, forms.phoneres
	, forms.mobile
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,forms.fsfstatus
	,forms.tmfstatus
	,forms.ocfstatus
	,size_cat.size
FROM
    forms
	Left JOIN user  ON (user.id = forms.user_id)
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

where $where limit $start,$limit "; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
	$sql_size  = "SELECT * from size_cat";
	$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 

$check=1;
    $res=array();
   foreach($result_members as $key){
            $count++;
			 
			
$home="";
$home=Yii::app()->request->baseUrl; 
			

			 echo '<tr><td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td>';
			 
			 
			 if($key['mscharges']==0){echo '<a target="_parent" href="membership?id='.$key['id'].'">Apply for MS</a>'; }elseif(Yii::app()->session['user_array']['per13']=='1' or $key['fsfstatus']==0){echo '<a target="_parent" href="editmembership?type=edit&id='.$key['id'].'">Edit MS</a>';
			 
			 if($key['oc']==0){echo '<a  href="javascript:delete_id('.$key['id'].')"> / Revert</a>';}}elseif($key['fsfstatus']==1){echo 'Approved';}elseif($key['fsfstatus']==2){echo 'Pending';}elseif($key['fsfstatus']==3){echo 'Rejected';}
			 
			 echo '</td><td>';
			 
			 if($key['oc']==0 && $key['mscharges']==1){echo '<a target="_parent" href="Opencert?id='.$key['id'].'">Open Certificate</a>';}
			 elseif($key['oc']==1 && $key['mscharges']==1 ){if(Yii::app()->session['user_array']['per13']=='1' or $key['ocfstatus']==0){echo '<a target="_parent" href="updatecert?id='.$key['id'].'">Edit/Print</a>';if($key['tm']==0){echo '<a  href="javascript:delete_id0('.$key['id'].')"> / Revert</a>';}}elseif($key['ocfstatus']==1){echo 'Approved</br><a target="_parent" href="updatecert?id='.$key['id'].'">Print</a>';}elseif($key['ocfstatus']==2){echo 'Pending</br><a target="_parent" href="updatecert?id='.$key['id'].'">Print</a>';}elseif($key['ocfstatus']==3){echo 'Rejected';}}
			 echo '</td><td>';
			 
			 if($key['tm']==0 && $key['mscharges']==1){echo '<a target="_parent" href="booking?id='.$key['id'].'">Booking</a>';}if($key['tm']==1 && $key['mscharges']==1){if(Yii::app()->session['user_array']['per13']=='1' or $key['tmfstatus']==0){echo '<a target="_parent" href="booking?type=edit&id='.$key['id'].'">Edit Booking</a><a  href="javascript:delete_id1('.$key['id'].')"> / Revert</a>';}elseif($key['tmfstatus']==1){echo 'Approved';}elseif($key['tmfstatus']==2){echo 'Pending';}elseif($key['tmfstatus']==3){echo 'Rejected';}}
			 '</td><td>'.$key['tm'].'</td>
			';
echo '<td>';
				echo '<li style="list-style: none;" role="presentation" class="dropdown"> 
				<a id="drop6" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Select Action <span class="caret"></span> </a> <ul id="menu3" class="dropdown-menu" aria-labelledby="drop6">
				 ';
		if(Yii::app()->session['user_array']['per13']=='1'){		
echo '<li><a target="_parent" href="updateforms?id='.$key['id'].'">Update Form</a></li>';
echo '<li><a  href="deleteform?id='.$key['id'].'">Delete</a></li>';
}
echo '<li><a  href="fstatus?id='.$key['id'].'">Status</a></li>';
if($key['mscharges']==1){echo '<li><a  href="returnmm?id='.$key['id'].'">Return Membership</a></li>';}
if($key['tm']==1){echo '<li><a  href="returnb?id='.$key['id'].'">Return Booking</a></li>';}
echo ' </ul> </li>';
echo '</td>';
			

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

	echo '<tr><td colspan="9">'.$pagination.'</td></tr>'; exit; 
	// for pagination  
	exit;
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
	public function actionSearchedit()

	 	{
			
		
			
		
			$connection = Yii::app()->db; 
			$pro='';
			$cnic='';		
			$where='';
			$and = false;
				
			    
			
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.="and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				else
				{
					$where.="CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) = '".$_POST['formno']."'";
				}
				$and=true;
			}


			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
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
$sql_memberas = "SELECT
    forms.id

FROM
    forms
	
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
where $where"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);//for Pagination 		


	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
	 , forms.scode
	  , forms.scode1
	   , forms.Gserial
    , forms.name
	, seller.name as sname
	
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.rdate
	, forms.phone
	, forms.phoneres
	, forms.mobile
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,forms.oc
	,forms.fsfstatus
	,forms.tmfstatus
	,forms.ocfstatus
	,size_cat.size
FROM
    forms
	
	Left JOIN seller  ON (seller.id = forms.seller_id)
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)

where $where limit $start,$limit "; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
	$sql_size  = "SELECT * from size_cat";
	$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 

$check=1;
    $res=array();
   foreach($result_members as $key){
            $count++;
			 
			
$home="";
$home=Yii::app()->request->baseUrl; 
			

echo '<tr>

<td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td>';

			 if($key['mscharges']==0){echo '<a target="_parent" href="membership?id='.$key['id'].'">Apply for MS</a>'; }elseif(Yii::app()->session['user_array']['per17']=='1' or $key['fsfstatus']==0){echo '<a target="_parent" href="editmembership?type=edit&id='.$key['id'].'">Edit MS</a>';
			 
			 if($key['oc']==0){echo '<a  href="javascript:delete_id('.$key['id'].')"> / Revert</a>';}}elseif($key['fsfstatus']==1){echo 'Approved';}elseif($key['fsfstatus']==2){echo 'Pending';}elseif($key['fsfstatus']==3){echo 'Rejected';}			 
			 echo '</td><td>';
			 
			 if($key['oc']==0 && $key['mscharges']==1){echo '<a target="_parent" href="Opencert?id='.$key['id'].'">Open Certificate</a>';}
			 elseif($key['oc']==1 && $key['mscharges']==1 ){if(Yii::app()->session['user_array']['per17']=='1' or $key['ocfstatus']==0){echo '<a target="_parent" href="updatecert?id='.$key['id'].'">Edit/Print</a>';if($key['tm']==0){echo '<a  href="javascript:delete_id0('.$key['id'].')"> / Revert</a>';}}elseif($key['ocfstatus']==1){echo 'Approved</br><a target="_parent" href="updatecert?id='.$key['id'].'">Print</a>';}elseif($key['ocfstatus']==2){echo 'Pending</br><a target="_parent" href="updatecert?id='.$key['id'].'">Print</a>';}elseif($key['ocfstatus']==3){echo 'Rejected';}}
			 echo '</td><td>';
			 
			 if($key['tm']==0 && $key['mscharges']==1){echo '<a target="_parent" href="booking?id='.$key['id'].'">Booking</a>';}if($key['tm']==1 && $key['mscharges']==1){if(Yii::app()->session['user_array']['per17']=='1' or $key['tmfstatus']==0){echo '<a target="_parent" href="booking?type=edit&id='.$key['id'].'">Edit Booking</a><a  href="javascript:delete_id1('.$key['id'].')"> / Revert</a>';}elseif($key['tmfstatus']==1){echo 'Approved';}elseif($key['tmfstatus']==2){echo 'Pending';}elseif($key['tmfstatus']==3){echo 'Rejected';}}
			 '</td><td>'.$key['tm'].'</td>
			';
				echo '<td>';
		if(Yii::app()->session['user_array']['per17']=='1'){		
echo '<a target="_parent" href="updateforms?id='.$key['id'].'">Update Form</a>';
echo '<a  href="deleteform?id='.$key['id'].'">/Delete</a>';
}
echo '<a  href="fstatus?id='.$key['id'].'">/Status</a>';
echo '</td>';
			

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

	echo '<tr><td colspan="9">'.$pagination.'</td></tr>'; exit; 
	// for pagination  
	exit;
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
	Public function actionPayapprove()
	{ 
	
	$col='';
	if($_GET['val2']=='booking'){$col='tmfstatus';}
	if($_GET['val2']=='membership'){$col='fsfstatus';}
	if($_GET['val2']=='certificate'){$col='ocfstatus';}
	
		$connection = Yii::app()->db; 
		 $sql  = "UPDATE forms SET ".$col."='1' where id='".$_GET['val1']."'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   echo '1';exit;
	}
	public function actionFinancereq()

	 	{
			$col='';
			$col1='';
			
	if($_POST['type']=='booking'){$col='tmfstatus';$col1='tm';}
	if($_POST['type']=='membership'){$col='fsfstatus';$col1='mscharges';}
	if($_POST['type']=='certificate'){$col='ocfstatus';$col1='oc';}
			
		
			$connection = Yii::app()->db; 
	$pro='';
			$cnic='';		
			$where="installform.type='".$_REQUEST['type']."'";
			$and = true;
			if(!isset($_POST['status'])){$st='0';}else{$st=$_POST['status'];}
			    
			
					if (isset($_POST['cnic']) && $_POST['cnic']!=""){
       		$formno=$_POST['cnic'];
		if ($and==true)
				{
					  $where.=" and forms.cnic = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" forms.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['formno']) && $_POST['formno']!=""){
       		$formno=$_POST['formno'];
		if ($and==true)
				{
					  $where.=" and CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` ) ='".$_POST['formno']."'";
				}
				else
				{
					$where.=" CONCAT( `scode` ,  `formno` ,  `scode1` ,  `Gserial` )= '".$_POST['formno']."'";
				}
				$and=true;
			}


			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" forms.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
				
	}
if ( isset($_POST['city']) &&  $_POST['city']!=""){				
				if ($and==true)
				{
					$where.=" and user.city LIKE '%".$_POST['city']."%'";
				}
				else
				{
					$where.=" user.city LIKE '%".$_POST['city']."%'";
				}
				$and=true;
			}
			if(isset($_POST['status'])){
			if($_POST['status']==0 or $_POST['status']==1 or $_POST['status']==2 or $_POST['status']==3){
$where.=" and forms.".$col1."='1' and ".$col."='".$st."'";
}}
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
	 $sql_member12 = " SELECT *
	FROM installform 
	left join forms on installform.form_id=forms.id 
left join user on installform.user_id=user.id 
	where $where"; 
	 $co = $connection->createCommand($sql_member12)->query();
	$rows =count($co);
     $sql_member = " SELECT *,installform.id as iid,forms.id as fid,forms.cnic as cnics
	FROM installform 
	left join forms on installform.form_id=forms.id 
left join user on installform.user_id=user.id 
	where $where limit $start,$limit"; 
     $sql_project = "SELECT * from projects";
	 $result_project = $connection->createCommand($sql_project)->query();
	 $sql_categories  = "SELECT * from categories";
	 $categories = $connection->createCommand($sql_categories)->query();
	 $sql_sector ="SELECT DISTINCT sector FROM plots";
	 $result_sector = $connection->createCommand($sql_sector)->query();
     $sql_com ="SELECT DISTINCT com_res FROM plots";
    $result_com = $connection->createCommand($sql_com)->query();
	$result_members = $connection->createCommand($sql_member)->queryAll();
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
			

			 echo '<tr><td>'.$count.'</td><td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['cnics'].'</td><td style="text-align:right;"><b>'.number_format($key['paidamount']).'</b></td><td>'.$key['paidas'].'</td><td>'.$key['detail'].'</td><td>'.$key['remarks'].'</a></td><td>'.$key['date'].'</a></td>
			 <td><a href="paymentdetails?id='.$key['iid'].'">Details</a>
			 <input type="submit" name="sub" id="'.$key['id'].'" onclick="myfunction1('.$key['fid'].',\'' .$_POST['type']. '\')" class="btn" value="Verify">
			 </td><tr>';
			 echo '<script>
					 var id =document.getElementById(id );
					 function myfunction1(id , type)
					{
					$.ajax({
						 type: "POST",
						  url:    "payapprove?val1="+ id + "&&val2=" + type ,
						  contenetType:"json",
						  success: function(jsonList){var json = $.parseJSON(jsonList);
						  var listItems="";
						  listItems+="<option value=>Select Street</option>";
						  $(json).each(function(i,val){
					      document.getElementById(id).style.visibility = "hidden"; 
						  listItems+= " ";
					      });listItems+="";
						  $("#street_id").html(listItems);
							  }
						});
					}
					</script>';
			 
			

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
    echo '<tr  ><td colspan="10"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="10">'.$pagination.'</td></tr>'; exit; 
	// for pagination END 

			}
  exit;
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
	public function actionSearchreq1()
	 	{
			
		if(isset(Yii::app()->session['user_array']['username']))
			{
				$connection = Yii::app()->db; 
			$sql_count  ="SELECT COUNT(id) FROM forms GROUP BY `seller_id` ";
            $res_count = $connection->createCommand($sql_count)->queryRow();

			
$num_rec_per_page=40;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 	
$start_from = ($page-1) * $num_rec_per_page; 
			$connection = Yii::app()->db; 
	$pro='';
			$cnic='';		
			$where='';
			$name='';
			$and = false;
				
			    
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				$pro=$_POST['project_id'];
				if ($and==true)
				{
					$where.=" and forms.project_id =".$_POST['project_id']."";
				}
				else
				{
					$where.=" forms.project_id =".$_POST['project_id']."";
				}
				$and=true;
			}
				
						
			if (isset($_POST['name']) && $_POST['name']!=""){
       		$name=$_POST['name'];
		if ($and==true)
				{
					  $where.=" and seller.name='".$_POST['name']."'";
				}
				else
				{
					$where.=" seller.name= '".$_POST['name']."'";
				}
				$and=true;
			}


			
			
	
     $sql_member = "SELECT 
	 seller.name as sname
	,forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.rdate
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,seller.logo
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
	Left JOIN seller  ON (seller.id = forms.seller_id)

where $where GROUP BY sname";
  $sql_project = "SELECT * from projects";

;
		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

	   $sql_com ="SELECT DISTINCT com_res FROM plots";

		$result_com = $connection->createCommand($sql_com)->query();
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();	
	$count=0;
	
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 


	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 

$res=array(); $i=1;
            foreach($result_members as $key){
				foreach($res_count as $count){
            echo '<tr><td>'.$i.'</td><td>'.$key['sname'].'</td><td><img src="'.Yii::app()->request->baseUrl.'/images/seller/'.$key['logo'].'" width="100" height="130" /></td><td>'.$count.'</a></td><td>'.$key['rdate'].'</td><td>Issued</td><td>'.$key['mscharges'].'</td><td>Open Certf</td><td>'.$key['tm'].'</td><td>Balance Open</td>
			<td>Remarks</a></td>';
				}
			
			
		
			$i++;
			}
			'</tr>'; 
			}

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

			}
	}
public function actionReport()
	{	
	   		
		
	$connection = Yii::app()->db; 
    $sql_member = "
		
    SELECT seller.name as sname
	,forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
	, forms.rdate
	
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,seller.logo
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
	Left JOIN seller  ON (seller.id = forms.seller_id) GROUP BY sname
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('report',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}
	public function actionReport1()
	{	
	   		
		
	$connection = Yii::app()->db; 
    $sql_member = "
		
    SELECT seller.name as sname
	,forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
	, forms.rdate
	
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,seller.logo
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
	Left JOIN seller  ON (seller.id = forms.seller_id) GROUP BY sname
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('report1',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}
	public function actionSubdealer()
	{	
	   		
		
	$connection = Yii::app()->db; 
    $sql_member = "
		
    SELECT seller.name as sname
	,forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
	, forms.rdate
	
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,seller.logo
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
	Left JOIN seller  ON (seller.id = forms.seller_id) GROUP BY sname
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('report2',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}
	public function actionBookingreport()
	{	
	   	if(isset(Yii::app()->session['user_array']['username']))
			{	
		
	$connection = Yii::app()->db; 
    $sql_member = "
		
    SELECT seller.name as sname
	,forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
	, forms.rdate
	
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,seller.logo
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
	Left JOIN seller  ON (seller.id = forms.seller_id) GROUP BY sname
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('report3',array('projects'=>$result_projects));
}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionFormpayment_lis()
	{	
	   		
		
	$connection = Yii::app()->db; 
    $sql_member = " SELECT * FROM formpayment";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		
		$home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
               }
			$this->render('formpayment_lis',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}
public function actionForms_lis()
	{	

		
	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	    		    $home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
            $res=array();
            foreach($result_members as $key){
            echo '<tr><td>'.$key['formno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</a></td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td>'.$key['email'].'</td><td>'.$key['address'].'</td><td>'.$key['mscharges'].'</td><td>'.$key['tm'].'</td>
			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td>';
				if($key['status']=='Alloted')
			{ 
			echo '<td></td>';
			}
			else {echo '<td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td>';}
			'</tr>'; 
            }}
			$this->render('forms_lis',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}

public function actionEditorlis()
	{	

		
	$connection = Yii::app()->db; 
    $sql_member = "SELECT
    forms.id
    , forms.formno
    , forms.project_id
    , forms.size
    , forms.name
	, forms.sodowo
	, forms.cnic
	, forms.email
	, forms.phone
	, forms.address
    , projects.project_name
	, forms.mscharges
	,forms.tm
	,size_cat.size
FROM
    forms
	Left JOIN size_cat  ON (size_cat.id = forms.size)
	Left JOIN projects  ON (forms.project_id = projects.id)
";

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
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	    		    $home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
            $res=array();
            foreach($result_members as $key){
            echo '<tr><td>'.$key['formno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</a></td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td>'.$key['email'].'</td><td>'.$key['address'].'</td><td>'.$key['mscharges'].'</td><td>'.$key['tm'].'</td>
			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td>';
				if($key['status']=='Alloted')
			{ 
			echo '<td></td>';
			}
			else {echo '<td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td>';}
			'</tr>'; 
            }}
			$this->render('forms_lis2',array('members'=>$result_members,'projects'=>$result_projects,'sizes'=>$sizes));

	}

public function actionDelete($id)
	{ 
		
	$connection = Yii::app()->db;  
		$id=$_REQUEST['id'];
		$sql="DELETE FROM formpayment WHERE id='".$id."'";
		$command = $connection -> createCommand($sql);
         $command -> execute();
		 $this->redirect(Yii::app()->baseUrl."/index.php/forms/formpayment_lis");
	}
	
	public function actionDeleteinfo()
	{ 
	$connection = Yii::app()->db;  
		$form_id=$_REQUEST['id'];
			   $sql  = "DELETE from installform where form_id='".$form_id."' and type='membership'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   
			   $sql1  = "UPDATE forms SET mscharges='0' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			   
			   $sqlup="UPDATE forms set name='',sodowo='',cnic='',phone='',address='',mobile='',phoneres='',profession='',email='' where id='".$form_id."' ";  
              $command = $connection -> createCommand($sqlup);
               $command -> execute();
			    $this->redirect(Yii::app()->baseUrl."/index.php/forms/forms_lis");
	}
	public function actionDeleteinfo1()
	{ 
	$connection = Yii::app()->db;  
		$form_id=$_REQUEST['id'];
			   $sql  = "DELETE from installform where form_id='".$form_id."' and type='certificate'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $sql1  = "UPDATE forms SET oc='0' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
             
			    $this->redirect(Yii::app()->baseUrl."/index.php/forms/forms_lis");
	}
	public function actionDeleteinfo2()
	{ 
	$connection = Yii::app()->db;  
		$form_id=$_REQUEST['id'];
			   $sql  = "DELETE from installform where form_id='".$form_id."' and type='booking'";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $sql1  = "UPDATE forms SET tm='0' where id='".$form_id."'";	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();
			    $sql2  = "DELETE from cat_forms where form_id='".$form_id."'";	
               $command = $connection -> createCommand($sql2);
			   $command -> execute();
             
			    $this->redirect(Yii::app()->baseUrl."/index.php/forms/forms_lis");
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
	
	
	
	public function actionForms()
	{
	if(isset(Yii::app()->session['user_array']['username']))
			{

            $connection = Yii::app()->db; 

          $id  = "SELECT max(formno) as formno,scode,scode1,Gserial from forms ";
		 $last_id = $connection->createCommand($id)->queryRow();
		 $ids  = "SELECT * from `schema` where project_id='".$_POST['project_id']."'";
		 $last_ids = $connection->createCommand($ids)->query();
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->query();
		 $seller  = "SELECT * from seller ";
		 $result_seller = $connection->createCommand($seller)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	  
		  $this->render('forms',array('last_id'=>$last_id,'last_ids'=>$last_ids,'projects'=>$result_projects,'seller'=>$result_seller,'sizes'=>$sizes));
	}
	



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
		}

	public function actionFmain()
	{
		$this->render('fmain');
	}
	public function actionSelectpr()
	{
		  $connection = Yii::app()->db; 
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->query();
		  $this->render('selectpr',array('projects'=> $result_projects)); 
	}
	public function actionFinacesc()
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
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();	
		  $this->render('finacesc',array('projects'=>$result_projects));
	}
	public function actionSchema()
	{

	if(isset(Yii::app()->session['user_array']['username']))
			{

            $connection = Yii::app()->db; 
		 $projects  = "SELECT * from projects ";
		 $result_projects = $connection->createCommand($projects)->query();
          $this->render('schema',array('projects'=>$result_projects));
		  

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionFormpayment()
	{

	if(isset(Yii::app()->session['user_array']['username']))
			{
            $connection = Yii::app()->db; 
         
		  $this->render('formpayment');
		  

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
	protected function performAjaxValidation($model)
	{



		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')



		{



			echo CActiveForm::validate($model);



			Yii::app()->end();



		}



	}



}