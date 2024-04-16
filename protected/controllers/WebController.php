<?php



class WebController extends Controller

{

	

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */



	 

	



	/**

	 * Updates a particular model.

	 * If update is successful, the browser will be redirected to the 'view' page.

	 * @param integer $id the ID of the model to be updated

	 */

	

	/**

	 * Deletes a particular model.

	 * If deletion is successful, the browser will be redirected to the 'admin' page.

	 * @param integer $id the ID of the model to be deleted

	 */
//////////*****Start:Online Booking***********//////
	public function actionAjaxRequest3($val1)

	{	
		$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from tbl_city where country_id='".$val1."'";
		$result_city = $connection->createCommand($sql_city)->query();
		$city=array();
		foreach($result_city as $cit){
			$city[]=$cit;
			} 
	echo json_encode($city); exit();
	}
public function actionAjaxRequest5($val1)
		{
		$connection = Yii::app()->db;
		$sql_city  = "SELECT members.*,c.country,p.city from members
		Left JOIN tbl_country c ON c.id=members.country_id 
			Left JOIN tbl_city p ON p.id=members.city_id 
		 where cnic=".$val1." AND status=1";
		$result_city = $connection->createCommand($sql_city)->query();
		$city=array();
		foreach($result_city as $cit){
			 $city[]=$cit;
				 
			}
	echo json_encode($city); exit();
	}
public function actionAlotaplot()
{


if(Yii::app()->session['user_array']['per12']=='1')
{
$error='';
//$error =array();
$connection = Yii::app()->db;
// $appno='';

//echo $_POST['member_id'];exit;

if ((isset($_POST['app_no']) && empty($_POST['app_no']))){
$error.="Application # Required. <br>";

}
if ((isset($_POST['start_date']) && empty($_POST['start_date']))){
$error.="Start Date Required. <br>";

}
if ((isset($_POST['disc']) && empty($_POST['disc']))){
$error.="Discount Required. <br>";

}
if ((isset($_POST['noi']) && empty($_POST['noi']))){
$error.="No.Of Installment required. <br>";
}
if (!empty($_POST['noi']) ){
$noi='';
$noi=$_POST['noi'];
if($noi<=0){
$error.="No.Of Installment Must be 1 or More . <br>";
}}
if ((isset($_POST['insplan']) && empty($_POST['insplan']))){
$error.="Installment Plan required. <br>";
}

 $q ="SELECT * from memberplot left join plots on plots.id=memberplot.plot_id where memberplot.app_no='".$_POST['app_no']."' and plots.project_id='".$_POST['project_id']."'";
$result_q = $connection->createCommand($q)->queryRow();
if (!empty($result_q)){
$error.="Application # Already Added Try Another. <br>";
}
if(empty($error)){

$uid=Yii::app()->session['user_array']['id'];

$sql  = "INSERT INTO memberplot (app_no,plot_id,member_id,create_date,noi,insplan,status,uid,fstatus)
VALUES ('".$_POST['app_no']."','".$_POST['plot_id']."','".$_POST['member_id']."','".date('Y-m-d')."','".$_POST['noi']."','".$_POST['insplan']."','Sales',
'".Yii::app()->session['user_array']['id']."','Sales')";

$command = $connection -> createCommand($sql);
$command -> execute();
$insert_id = Yii::app()->db->getLastInsertID();

$discount  = "INSERT INTO discnt (ms_id,status,discount)VALUES ('".$insert_id."','New','".$_POST['disc']."')";
$command = $connection -> createCommand($discount);
$command -> execute();

$sql_cat  = "SELECT * from cat_plot where plot_id='".$_POST['plot_id']."'";
$result_cat = $connection->createCommand($sql_cat)->queryAll();
foreach($result_cat as $new){
$sql1  = "SELECT * from charges where type='".$new['cat_id']."'";
$result1 = $connection->createCommand($sql1)->queryRow();
$plot  = "SELECT * from plots where id='".$_POST['plot_id']."'";
$plots = $connection->createCommand($plot)->queryRow();
$chargess=$plots['price']/100*$result1['total'];
$sqlcharges="INSERT INTO plotpayment SET payment_type='".$result1['name']."',amount='".$chargess."', duedate='".$_POST['start_date']."', plot_id='".$_POST['plot_id']."',mem_id='".$_POST['member_id']."'";
$command = $connection -> createCommand($sqlcharges);
$command -> execute();
}
$sql_cat12  = "SELECT * from charges where name LIKE '%MS Fee%'";
$result_cat12 = $connection->createCommand($sql_cat12)->queryRow();
if($result_cat12!==''){
$sqlchargesm="INSERT INTO plotpayment SET payment_type='MS Fee',amount='".$result_cat12['total']."', duedate='".$_POST['start_date']."', plot_id='".$_POST['plot_id']."',mem_id='".$_POST['member_id']."'";
$command = $connection -> createCommand($sqlchargesm);
$command -> execute();}

$update  = "UPDATE plots set status='Requested', public='3' WHERE id='".$_POST['plot_id']."'";
$command = $connection -> createCommand($update);
$command -> execute();
$upbook  = "UPDATE booking set status='3' WHERE plot_id='".$_POST['plot_id']."'";
$command = $connection -> createCommand($upbook);
$command -> execute();

$sqlinstalplan ="SELECT * from installment_plan where id='".$_POST['insplan']."'";
$dataplan = $connection->createCommand($sqlinstalplan)->queryRow();

$tno=$_POST['noi'];
$insplan=$dataplan['tno'];
$insert=0;
$create=$_POST['start_date'];
$instalno=0;
$lab=0;

do{
$lab++;
$instalno++;

$tno=$_POST['noi'];

//if($instalno==1){$tno=$tno+1;}
$sqlinstall="INSERT INTO installpayment SET lab='".$dataplan['lab'.$lab.'']."',dueamount='".$dataplan[''.$instalno.'']."', due_date='".$create."', plot_id='".$_POST['plot_id']."',mem_id='".$_POST['member_id']."'";
$next_due_date = strtotime($create.' + '.$tno.' Months');
$create=date('d-m-Y', $next_due_date);
$command = $connection -> createCommand($sqlinstall);
$command -> execute();
$insert++;

}while($insert<$insplan);

echo 'Plot Allotment Request Sent For Verification';
exit;

}
else if(!empty($error)){

echo $error;
}



}

}
	public function actionTos()
		{
		  	$this->layout='//layouts/front';  
        	$this->render('terms-of-services'); 

	    }
	public function actionPrivacy()
		{
		  	$this->layout='//layouts/front';  
        	$this->render('privacy-policy'); 

	    }
	public function actionReq_detail()
		{


	if(Yii::app()->session['user_array']['per12']=='1'&& isset(Yii::app()->session['user_array']['username']))
			{
			$this->layout='//layouts/back';
			$connection = Yii::app()->db; 	

				$sql_details  = "SELECT mp.member_id,mp.plot_id,j.code,c.code as scode,c.size,mp.id as sid,p.com_res,mp.member_id,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.type ,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name,se.sector_name FROM  booking mp
		left join members m on mp.member_id=m.id
		left join plots p on mp.plot_id=p.id
		left join streets s on p.street_id=s.id
		left join size_cat c on p.size2=c.id
		left join sectors se on p.sector=se.id
		
		left join projects j on s.project_id=j.id where mp.plot_id=".$_REQUEST['id'];
		$result_details = $connection->createCommand($sql_details)->queryAll();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();
			$sql_plotss = "SELECT * from plots where id='".$_REQUEST['id']."'";
			$result_plotss = $connection->createCommand($sql_plotss)->queryRow();
			
			$sql_plan  = "SELECT * from installment_plan where project_id='".$_REQUEST['pro']."' and category_id='".$result_plotss['size2']."'";
			$result_plan = $connection->createCommand($sql_plan)->query();
			$this->render('req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments,'plan'=>$result_plan)); 

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
public function actionBooking_list()
{
	$this->layout='//layouts/back';
	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username'])||(Yii::app()->session['user_array']['per34']=='1'))
{

if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) && (empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))){
$error = "Please Fill Atleast one field";
$members="";
$connection = Yii::app()->db;
$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();
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
$this->render('booking_list',array('error'=>$error,'members'=>$members,'projects'=>$result_projects,'com_res'=>$result_com_res));
exit;
}
$error="";
$and = false;
$where='';
if ($_POST['name']!=""){
$where.=" m.name LIKE '%".$_POST['name']."%'";
$and = true;
}


if ($_POST['sodowo']!=""){
if ($and==true)
{
$where.=" and m.sodowo LIKE '%".$_POST['sodowo']."%'";
}
else
{
$where.=" m.sodowo LIKE '%".$_POST['sodowo']."%'";
}
$and=true;
}


if ($_POST['cnic']!=""){
if ($and==true)
{
$where.=" and m.cnic LIKE '%".$_POST['cnic']."%'";
}
else
{
$where.=" m.cnic LIKE '%".$_POST['cnic']."%'";
}
$and=true;
}





if ($_POST['project_name']!=""){
if($and==true)
{
$where.=" and p.project_id LIKE '%".$_POST['project_name']."%'";
}
else
{
$where.=" p.project_id LIKE '%".$_POST['project_name']."%'";
}
$and=true;

}

if (!empty($_POST['plotno'])){
if ($and==true)
{
$where.=" and mp.plotno ='".$_POST['plotno']."'";
}
else
{
$where.="mp.plotno='".$_POST['plotno']."'";
}
$and==true;
}

if ($_POST['plot_detail_address']!=""){
if ($and==true)
{
$where.=" and p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";
}
else
{
$where.=" p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";
}
/*if($where!='')
$where.=" AND ";
else $where.=' WHERE ';
$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";*/
}


$connection = Yii::app()->db;
$sql_member = "SELECT mp.member_id,mp.create_date,mp.plotno,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.project_id,p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where $where  and mp.status='Approved' ";
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
$this->render('booking_list',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));
}else{
$this->redirect(array("user/dashboard"));
}
}
public function actionSearchbooking()
{
$where="p.id>0";
$and=true;
if (!empty($_POST['project_name'])){
if($and==true)
{
$where.=" AND p.project_id LIKE '%".$_POST['project_name']."%'";
}
else
{
$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
}
$and=true;
}
if (!empty($_POST['name1'])){
$where.="and m.name LIKE '%".$_POST['name1']."%'";
$and = true;
}
if (isset($_POST['com_res']) && $_POST['com_res']!=""){
$where.="and p.com_res LIKE '%".$_POST['com_res']."%'";
$and = true;
$com_res=$_POST['com_res'];
}
if (!empty($_POST['sodowo'])){
if ($and==true)
{
$where.=" and m.sodowo LIKE '%".$_POST['sodowo']."%'";
}
else
{
$where.=" m.sodowo LIKE '%".$_POST['sodowo']."%'";
}
$and=true;
}
if (!empty($_POST['cnic'])){
if ($and==true)
{
$where.=" and m.cnic =".$_POST['cnic']."";
}
else
{
$where.=" m.cnic =".$_POST['cnic']."";
}
$and=true;
}



if (!empty($_POST['plot_detail_address'])){
if ($and==true)
{
$where.=" and p.plot_detail_address ='".$_POST['plot_detail_address']."'";
}
else
{
$where.="p.plot_detail_address='".$_POST['plot_detail_address']."'";
}
$and==true;
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
$sql_memberas = "SELECT * FROM booking mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where $where and p.public=2";
$co = $connection->createCommand($sql_memberas)->query();
$rows =count($co);
//for Pagination end
$connection = Yii::app()->db;
$sql_member = "SELECT assoc.id as associd,cp.status as cpstatus,mp.member_id,p.com_res,p.id,p.type,p.project_id,m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM booking mp
left join members m on mp.member_id=m.id
left join associates assoc on mp.id=assoc.msid
left join plots p on mp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join cancelplot cp on cp.plot_id=p.id
left join projects j on p.project_id=j.id
where  $where and p.public=2 limit $start,$limit";

$result_members = $connection->createCommand($sql_member)->query();



$count=0;
if ($result_members!=''){
$home=Yii::app()->request->baseUrl;
$check=1;
$i=0;
$res=array();
foreach($result_members as $key){
$i++;
$count++;


echo $count.' result found';
$msco='';
//if($key['stst']==0){$msco='Green';}if($key['stst']==1){$msco='Orange';}if($key['stst']==2){$msco='Red';}if($key['stst']==3){$msco='Black';}





/// echo '<tr>';


echo'<tr><td style=" font-weight:bold;color;"></td>
<td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td>
<td>';echo $key['size'].'&nbsp;('.$key['plot_size'].')';echo'</td>
<td></td>
<td>'; echo $key['street']; echo '</td>
<td>';echo $key['sector_name'];echo'</td>
<td>'.$key['project_name'].'</td><td><a href="req_detail?id='.$key['plot_id'].'&&pro='.$key['project_id'].'">View Request</a>';
echo' </td></tr>';              }

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
echo '<tr  ><td colspan="11"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
echo '<tr><td colspan="11">'.$pagination.'</td></tr>'; exit;
// for pagination END




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


public function actionBook()
{
						
						
						$error='';
						///echo $_FILES["receipt"]["name"];exit;
						 $receipt=$_FILES['receipt']["name"];
						 move_uploaded_file($_FILES["receipt"]["tmp_name"],
						'images/payment_evidence/'.$receipt);
						if(empty($_POST['name1']) && empty($_POST['email1'])&& empty($_POST['sodowo1'])&& empty($_POST['phone1'])){  
						///////////////////////QUERY FOR NON Member/////////////
	   				 $picture=$_FILES['picture']["name"];
						 move_uploaded_file($_FILES["picture"]["tmp_name"],
						'upload_pic/'.$picture);
					$connection = Yii::app()->db;
          			$sql  = 'INSERT INTO members 
				   (name,username,password,sodowo, cnic, address, email, city_id,country_id,phone,dob,status,image,nomineename,nomineecnic,rwa)VALUES (
				   "'.$_POST['name'].'", "'.$_POST['email'].'",
				   "'.$_POST['cnic'].'","'.($_POST['sodowo']).'",
				   "'.$_POST['cnic'].'",
				   "'.($_POST['address']).'","'.$_POST['email'].'",
				   "'.$_POST['city_id'].'","'.$_POST['country'].'",
				   "'.$_POST['phone'].'", "'.$_POST['dob'].'",1, "'.$picture.'"
				   , "'.$_POST['nomineename'].'", "'.$_POST['nomineecnic'].'", "'.$_POST['rwa'].'"
				   )'
				   
				   ;	
				   $command = $connection -> createCommand($sql);
          		   $command -> execute();
				   $member_id = Yii::app()->db->getLastInsertID();
				   $sql='INSERT INTO booking 
				   (plot_id,member_id,status,booking_type,reference_no,transaction_date,payment_evidence)VALUES (
				   "'.$_POST['plot_id'].'", "'.$member_id.'",1, "'.$_POST['dealer'].'", "'.$_POST['reference_no'].'", "'.$_POST['transaction_date'].'", "'.$receipt.'")';	
					 $command = $connection -> createCommand($sql);
          			  $command -> execute();
					   $bid = Yii::app()->db->getLastInsertID();
					  
					  
					$update  = "UPDATE plots set public='2' WHERE id='".$_POST['plot_id']."'";
					$command = $connection -> createCommand($update);
					$command -> execute();
					
					
					
						/*$connection = Yii::app()->db;
						$sql_max= "SELECT MAX(app_no) as app_no FROM `memberplot`";
		                $result_max = $connection->createCommand($sql_max)->queryRow();
						$value=$result_max['app_no'];
						$app_no= $value+1;*/
					//	$this->render('plots_lis',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));

				$this->redirect("confirmation_plot?member_id=".$member_id."&&id=".$_POST['plot_id']."&&bid=".$bid."");
					///////////////////////////////////////////
				
					}else{
				///////////////////////QUERY FOR Member/////////////
				 $member_id=$_POST['member_id'];
					$connection = Yii::app()->db;
				$base=$_POST['cnic'];
				 $sql ="SELECT * from members where cnic='".$base."'";
				$result_data = $connection->createCommand($sql)->queryRow();
				if(!empty($result_data)){
					 $connection = Yii::app()->db;
          			$sql  = 'INSERT INTO booking 
				   (plot_id,member_id,status,booking_type,reference_no,transaction_date,payment_evidence)VALUES (
				   "'.$_POST['plot_id'].'", "'.$result_data['id'].'",1, "'.$_POST['dealer'].'", "'.$_POST['reference_no'].'", "'.$_POST['transaction_date'].'", "'.$receipt.'")';	
					 $command = $connection -> createCommand($sql);
          			  $command -> execute();
					  $bid = Yii::app()->db->getLastInsertID();
					$update  = "UPDATE plots set public='2' WHERE id='".$_POST['plot_id']."'";
					$command = $connection -> createCommand($update);
					$command -> execute();
						$this->redirect("confirmation_plot?member_id=".$member_id."&&id=".$_POST['plot_id']."&&bid=".$bid."");
				///	$this->redirect("http://localhost/rdlpk/index.php/web/confirmation_plot?member_id=".$member_id."&&id='".$_POST['plot_id']."&&bid=".$bid."");
					 }
					 
					}
 


}
public function actionBook1()
{
	$error='';
	

if ((isset($_POST['cnic']) && empty($_POST['cnic']))){
$error.="Enter Your CNIC<br>";

}

	if ((isset($_POST['name'])&& empty($_POST['name']))){
$error.="Enter your name. <br>";}
if ((isset($_POST['sodowo'])&& empty($_POST['sodowo']))){
$error.="Enter your Father/Spouse. <br>";}

if ((isset($_POST['address']) && empty($_POST['address']))){
$error.="Enter your address. <br>";
}
if ((isset($_POST['phone']) && empty($_POST['phone']))){
$error.="Enter your mobile no <br>";
}
if ((isset($_POST['email']) && empty($_POST['email']))){
$error.="Enter your Email Address<br>";

}
if ((isset($_POST['dob']) && empty($_POST['dob']))){
$error.="Enter your Date of birth<br>";
}
if ((isset($_POST['country']) && empty($_POST['country']))){
$error.="Select your country<br>";
}
if ((isset($_POST['city_id']) && empty($_POST['city_id']))){
$error.="Select your City<br>";
}

	if(empty($error)){ 
				$connection = Yii::app()->db;
				$base=$_POST['cnic'];
				 $sql ="SELECT * from members where cnic='".$base."'";
				$result_data = $connection->createCommand($sql)->queryRow();
				if(!empty($result_data)){
					 $connection = Yii::app()->db;
          			$sql  = 'INSERT INTO booking 
				   (plot_id,member_id,status,booking_type)VALUES (
				   "'.$_POST['plot_id'].'", "'.$result_data['id'].'",1, "'.$_POST['channel'].'")';	
					 $command = $connection -> createCommand($sql);
          			  $command -> execute();
					$update  = "UPDATE plots set public='2' WHERE id='".$_POST['plot_id']."'";
					$command = $connection -> createCommand($update);
					$command -> execute();
					echo 'Booking Request Sent Successfully';
					 }
					 else{
	                $connection = Yii::app()->db;
          			$sql  = 'INSERT INTO members 
				   (name,username,sodowo, cnic, address, email, city_id,country_id,phone,dob,status)VALUES (
				   "'.$_POST['name'].'", "'.$_POST['email'].'",
				   "'.($_POST['sodowo']).'", "'.$_POST['cnic'].'",
				   "'.($_POST['address']).'","'.$_POST['email'].'",
				   "'.$_POST['city_id'].'","'.$_POST['country_id'].'",
				   "'.$_POST['phone'].'", "'.$_POST['dob'].'",1)';	
					 $command = $connection -> createCommand($sql);
          			  $command -> execute();
					  $member_id = Yii::app()->db->getLastInsertID();
						$sql  = 'INSERT INTO booking 
				   (plot_id,member_id,status,booking_type)VALUES (
				   "'.$_POST['plot_id'].'", "'.$member_id.'",1, "'.$_POST['channel'].'")';	
					 $command = $connection -> createCommand($sql);
          			  $command -> execute();
					$update  = "UPDATE plots set public='2' WHERE id='".$_POST['plot_id']."'";
					$command = $connection -> createCommand($update);
					$command -> execute();
					echo 'Booking Request Sent Successfully';
				}
					}{

					echo $error;
					}
 


}
 public function actionPlot_map()
 {
	 $this->render('plot_map');
 }

	public function actionPlots_lis()
				{
					$this->layout='//layouts/back';
					
					
					 $this->layout='//layouts/front';
					 
		
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
		where $where ORDER BY `plot_detail_address` ASC, `street` ASC, `sector` ASC";
				$result_members = $connection->createCommand($sql_member)->query();
		        $connection = Yii::app()->db;
				
				$sql1 =   "select * from projects where status=1";
				
				$result_projects = $connection->createCommand($sql1)->query() or mysql_error();
				
				
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
			$this->render('plots_lis',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
			
			
	
	}
	public function actionSearchreqbook()
		{
			
	//	$where="plots.type='plot'";
$and='';
$where='';
if (!empty($_POST['project'])){
if($and==true)
{
$where.=" AND plots.project_id LIKE '%".$_POST['project']."%'";
}
else
{
$where.="  plots.project_id LIKE '%".$_POST['project']."%'";
}
$and=true;
}

if (isset($_POST['com_res']) && $_POST['com_res']!=""){
$where.="and plots.com_res LIKE '%".$_POST['com_res']."%'";
$and = true;
$com_res=$_POST['com_res'];
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
				foreach($_POST['cat'] as $ass){if($aa==1){$catt.',';} $catt=$ass;$aa++; };
				if ($and==true)
				{
					$where.=" and cat_plot.cat_id IN (".$catt.")";
				}
				else
				{
					$where.=" cat_plot.cat_id IN (".$catt.")";
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
 $sql_memberas = "SELECT * FROM plots
Left JOIN streets  ON (plots.street_id = streets.id)
".$extra1."
Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)
where plots.public =1 and $where ";
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
	, plots.ctag
	,plots.price
	, memberplot.fstatus
	, plots.bstatus
	, plots.plot_detail_address
	, memberplot.plotno
, projects.project_name
	, streets.street

	, size_cat.size
	, size_cat.typee
	,sector_name
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
	".$extra1."
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where plots.public =1 and  $where  limit $start,$limit ";
$result_members = $connection->createCommand($sql_member)->queryAll();
$sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		
		
	
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
echo '<tr><td>'.$count.'</td><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')<td>'.$key['com_res'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td>
<td>'.$key['price'].'</td>';
echo '<td>'.$key['bstatus'].'</td>';
echo '<td><a href="plot_map?id='.$key['id'].'&&pro='.$key['project_id'].'">Sketch/Map/Image</a></td>';
echo '<td><a href="book_plot?id='.$key['id'].'&&pro='.$key['project_id'].'">Book Plot</a></td>';
				'</tr>';
				}
				echo'<tr><td>';?>
<?php echo'</td></tr>';
				
				
		}?>
<?php

		echo '<tr  ><td colspan="12"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
			echo '<tr><td colspan="12"></td></tr>'; exit;
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
			
			
			public function actionBook_plot()
{
	   $this->layout='//layouts/front';

$connection = Yii::app()->db;
$sql_country  = "SELECT * from tbl_country";
$result_country = $connection->createCommand($sql_country)->query();
$sql_bank  = "SELECT * from bank";
$result_bank = $connection->createCommand($sql_bank)->query();




$sql_project  = "SELECT * from projects";
$result_projects = $connection->createCommand($sql_project)->query();
$sql = "SELECT
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
, plots.plot_detail_address
, memberplot.plotno
, projects.project_name
, categories.name
, streets.street
, sectors.sector_name
,size_cat.size
,projects.code
,size_cat.code as scode
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
Left JOIN size_cat  ON (plots.size2 = size_cat.id)
Left JOIN sectors  ON (plots.sector = sectors.id)
Left JOIN projects  ON (plots.project_id = projects.id)
Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
Left JOIN categories  ON (plots.category_id = categories.id) where plots.type='plot' and plots.id='".$_REQUEST['id']."'";
//	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";
$result = $connection->createCommand($sql)->query();
$sql_plotss = "SELECT * from plots where id='".$_REQUEST['id']."'";
$result_plotss = $connection->createCommand($sql_plotss)->queryRow();
$sql_plan  = "SELECT * from installment_plan where project_id='".$_REQUEST['pro']."' and category_id='".$result_plotss['size2']."'";
$result_plan = $connection->createCommand($sql_plan)->query();
$sql_dealer = "SELECT * from members where mtype='Dealer'";
$result_dealer = $connection->createCommand($sql_dealer)->query();
$this->render('book_plot',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan,'dealer'=>$result_dealer,'banks'=>$result_bank));


}
	public function actionConfirmation_plot()
{		
						
						
	   $this->layout='//layouts/front';

$connection = Yii::app()->db;
$sql_country  = "SELECT * from tbl_country";
$result_country = $connection->createCommand($sql_country)->query();
$sql_bank  = "SELECT * from bank";
$result_bank = $connection->createCommand($sql_bank)->query();




$sql_project  = "SELECT * from projects";
$result_projects = $connection->createCommand($sql_project)->query();
$sql = "SELECT
plots.id
, plots.street_id
, plots.project_id
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
, plots.plot_detail_address
, memberplot.plotno
, projects.project_name
, categories.name
, streets.street
, sectors.sector_name
,size_cat.size
,charges.name
,projects.code
,size_cat.code as scode

FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
Left JOIN size_cat  ON (plots.size2 = size_cat.id)
Left JOIN sectors  ON (plots.sector = sectors.id)
Left JOIN projects  ON (plots.project_id = projects.id)
Left JOIN charges  ON (charges.project_id = projects.id)
Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
Left JOIN members  ON (members.id = memberplot.member_id)
Left JOIN categories  ON (plots.category_id = categories.id) where plots.type='plot' and plots.id=".$_REQUEST['id']."";
$result = $connection->createCommand($sql)->queryAll();
$sql_plotss = "SELECT * from plots where id=".$_REQUEST['id']."";
$result_plotss = $connection->createCommand($sql_plotss)->queryRow();
$this->render('confirmation_plot',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country));


}

//////////*****END:Online Booking****//////////


		public function actionBallotres()
	{	
		$connection = Yii::app()->db;
        $sql_setting ="select * from setting ";
        $result_setting = $connection->createCommand($sql_setting)->queryRow();
        if($result_setting['showsearch_bal']==1)
            {
	         $this->layout='//layouts/front';
			$and = false;
			$where='';
			if (isset($_POST['appno']) && $_POST['appno']!="")
			{
			  $where.="plots.sector = '".$_POST['appno']."'";
               $and = true;
			}
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){
			if ($and==true)
				{
					  $where.=" and plots.category_id = '".$_POST['cnic']."'";
				}
				else
				{
					$where.=" plots.category_id = '".$_POST['cnic']."'";
				}
				$and=true;
			}
            	$connection = Yii::app()->db; 
                $sql_member = "SELECT
            	size_cat.size,
                member_plot.*
            FROM
                member_plot
                Left JOIN app ON (member_plot.ms_id = app.id)
            	Left JOIN plots ON (member_plot.plot_id = plots.id)
            	Left JOIN projects ON (plots.project_id = projects.id)
            	Left JOIN streets ON (plots.street_id = streets.id)
            	Left JOIN size_cat ON (plots.size2 = size_cat.id)"; 
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
            echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size2'].'&n('.$key['plot_size'].')</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['create_date'].'</td><td>';
			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>
			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 
            }}
			$this->render('ballotres',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector,'categories'=>$categories));
	   }

	}
 public function actionSearchreq1()

	 	{

		$this->layout='//layouts/front';

		$where='';

		$and=false;

	//	if ($_POST['cnic']=="" && $_POST['appno']==""){echo "<td colspan='8' style='color:red;'>Please Enter CNIC or Application No</td> ";exit;}

		

		if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				$where.="members.CNIC ='".$_POST['cnic']."'";

				$and = true;

				

			}

			

			

			if (isset($_POST['appno']) && $_POST['appno']!=""){

			if (isset($_POST['cnic']) && $_POST['cnic']==""){echo "<td colspan='8' style='color:red;'>Please Enter CNIC</td>"; exit;}

				if ($and==true)
				{	  $where.=" and memberplot.plotno LIKE '%".$_POST['appno']."%'";
}
				else
				{
					$where.="memberplot.plotno LIKE '%".$_POST['appno']."%'";
				}
				$and=true;

			}

			

			

			$connection = Yii::app()->db; 

  echo  $sql_member = "SELECT
member_plot.status as mpst,
   size_cat.size,
member_plot.*
,memberplot.*
	,plots.*

	,projects.*

	,streets.*
	,members.*
	,sectors.sector_name

	

FROM

    member_plot

    Left JOIN memberplot ON (member_plot.ms_id= memberplot.id)
	Left JOIN members ON (memberplot.member_id= members.id)
	Left JOIN plots ON (member_plot.plot_id = plots.id)
	Left JOIN sectors ON (plots.sector=sectors.id)
	Left JOIN projects ON (plots.project_id = projects.id)
	Left JOIN streets ON (plots.street_id = streets.id)
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
where $where"; 

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();

		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			

	   

	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$result_members = $connection->createCommand($sql_member)->query();

	

	$count=0;

	if (count($result_members)>0){

		$home=Yii::app()->request->baseUrl; 

    $res=array();

            foreach($result_members as $key){

            $count++;

			echo 'Cogartulation result found'.$count;
if($key['mpst']=='Blocked'){
	echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td colspan="6" ><b style="color:red;">Result Blocked </b></td>

			</tr>';
	}else{
			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')'.'</td><td> <b>'.$key['plot_detail_address'].'</b></td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td>
<td><a target="blank" href="#">View Map</a></td>
			</tr>';
}
			

			} 

			}else{echo '<td colspan="8">&nbsp;<b style="color:red;">Sorry! Result Not Found</b></td>' ;exit;}

	

	    

			



	}

		public function actionBallotres1()

	{	

		$connection = Yii::app()->db;
$sql_setting ="select * from setting ";
$result_setting = $connection->createCommand($sql_setting)->queryRow();
if($result_setting['showsearch_bal']==1){

	   $this->layout='//layouts/front';

	   		

			$and = false;

			$where='';

			

			if (isset($_POST['appno']) && $_POST['appno']!=""){

				$where.="plots.sector = '".$_POST['appno']."'";

				$and = true;

				

			}

			

			if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				

				if ($and==true)

				{

					  $where.=" and plots.category_id = '".$_POST['cnic']."'";

				}

				else

				{

					$where.=" plots.category_id = '".$_POST['cnic']."'";

				}

				$and=true;

			}

			

			

			

			

			

		

	$connection = Yii::app()->db; 

    $sql_member = "SELECT

	size_cat.size,

    member_plot.*

FROM

    member_plot

    Left JOIN app ON (member_plot.ms_id = app.id)

	Left JOIN plots ON (member_plot.plot_id = plots.id)

	Left JOIN projects ON (plots.project_id = projects.id)

	Left JOIN streets ON (plots.street_id = streets.id)

	Left JOIN size_cat ON (plots.size2 = size_cat.id)

"; 

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



			



			



            	

            echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td>'.$key['plot_size'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['size2'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['create_date'].'</td><td>';

			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('ballotres1',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector,'categories'=>$categories));

			

	   }

	}

	  public function actionSearchreq()

	 	{ 

		$this->layout='//layouts/front';

		$where='';

		$and=false;

		if ($_POST['cnic']=="" && $_POST['appno']==""){echo "<td colspan='8' style='color:red;'></td> ";exit;}

		

		if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				$where.="members.CNIC ='".$_POST['cnic']."'";

				$and = true;

				

			}

			

			

			if (isset($_POST['appno']) && $_POST['appno']!=""){

			if (isset($_POST['cnic']) && $_POST['cnic']==""){echo "<td colspan='8' style='color:red;'>Please Enter CNIC</td>"; exit;}

				if ($and==true)
				{	  $where.=" and memberplot.plotno LIKE '%".$_POST['appno']."%'";
}
				else
				{
					$where.="memberplot.plotno LIKE '%".$_POST['appno']."%'";
				}
				$and=true;

			}

			

			

			$connection = Yii::app()->db; 

     $sql_member = "SELECT
memberplot.mstatus as mpst,
   size_cat.size,
memberplot.*
,memberplot.*
	,plots.*

	,projects.*

	,streets.*
	,members.*
	,sectors.sector_name

	

FROM

    memberplot

	Left JOIN members ON (memberplot.member_id= members.id)
	Left JOIN plots ON (memberplot.plot_id = plots.id)
	Left JOIN sectors ON (plots.sector=sectors.id)
	Left JOIN projects ON (plots.project_id = projects.id)
	Left JOIN streets ON (plots.street_id = streets.id)
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
where $where and plots.bid !=''"; 

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();

		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			

	   

	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$result_members = $connection->createCommand($sql_member)->query();

	

	$count=0;

	if (count($result_members)>0){

		$home=Yii::app()->request->baseUrl; 

    $res=array();

            foreach($result_members as $key){

            $count++;

			echo 'Cogartulation result found'.$count;
if($key['mpst']=='2'){
	echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong style="color:red">Location Blocked</strong></td>

			</tr>';
	}else{
			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td>Plot No.&nbsp;'.$key['plot_detail_address'].',&nbsp;'.$key['street'].',&nbsp;'.$key['sector_name'].'</td>
			</tr>';
}
			

			} 

			}else{echo '<td colspan="8">&nbsp;<b style="color:red;">Sorry! Result Not Found</b></td>' ;exit;}

	

	    

			



	}



	public function actionIndex()

	{	

		  	$connection = Yii::app()->db;

			$sql_projects  = "SELECT * from projects where status='1'";

			$result_projects = $connection->createCommand($sql_projects)->query();
            $sql_ss  = "select * From splashscreen where status='1'";

			$resss = $connection->createCommand($sql_ss)->query();
			

			$sql_slider  = "SELECT * from slider  ORDER BY id DESC";

			$result_slider = $connection->createCommand($sql_slider)->query();
			
			
			$sql_slider1  = "SELECT * from slider";

			$result_slider1 = $connection->createCommand($sql_slider1)->query();

			

			$sql_uprojects  = "SELECT * from uprojects where status='1'";

			$result_uprojects = $connection->createCommand($sql_uprojects)->query();

			

			

			$sql_page  = "SELECT * from pages where page_type='index'";

			$result_pages = $connection->createCommand($sql_page)->query();

			

			//$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";

			$sql_news ="select * from latest_news where status='Active' ";

			$result_news = $connection->createCommand($sql_news)->query();

			

			$sql_setting ="select * from setting ";

			$result_setting = $connection->createCommand($sql_setting)->queryAll();

			$sql_splash ="select * from splashscreen where status='1' ";

			$result_splash = $connection->createCommand($sql_splash)->query();

			$this->render('index',array('projects'=>$result_projects,'uprojects'=>$result_uprojects,'pages'=>$result_pages,'news'=>$result_news,'setting'=>$result_setting,'slider'=>$result_slider,'slider1'=>$result_slider1,'hord'=>$result_splash,'resss'=>$resss));

			

	}

	public function actionProject_detail()

	{

			$connection = Yii::app()->db;

			$sql  = "SELECT * from projects where id='".$_REQUEST['id']."'";

			$project = $connection->createCommand($sql)->query();

			

			$this->render('project_details',array('project'=>$project));

	}

	public function actionUproject_details()

	{ 

			$connection = Yii::app()->db;

		 $sql_page  = "SELECT * from uprojects where id='".$_REQUEST['id']."'";

			$result = $connection->createCommand($sql_page)->query();

			

			$this->render('uproject_details',array('content'=>$result));

	}

	public function actionPlots()

	{

			$connection = Yii::app()->db;

			//echo $_REQUEST['plotno']; exit;

			$sql = "SELECT mp.member_id,mp.create_date,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.com_res,p.size2,siz.size,p.sector,mp.plotno,p.plot_detail_address,mp.plot_id,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join size_cat siz on siz.id=p.size2

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id 

where plotno='".$_REQUEST['plotno']."'";

			// $sql  = "SELECT * from plots where plot_detail_address=".$_REQUEST['plotno']; 

			$res = $connection->createCommand($sql)->query();

			

			$this->render('plots',array('plots'=>$res));

	}

	public function actionPages()

	{

		$connection = Yii::app()->db;

		$sql_page1  = "SELECT * from pages where id='".$_REQUEST['id']."'";

		$result1 = $connection->createCommand($sql_page1)->queryRow();

		if($result1['page_type']=="2col-left")

		{

			$sql_page  = "SELECT * from pages where id='".$_REQUEST['id']."'";

			$result = $connection->createCommand($sql_page)->query();

			

			$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";

			$result1 = $connection->createCommand($sql_news)->query();

			

			$this->render('2col-left',array('content'=>$result,'news'=>$result1));

		}

		if($result1['page_type']=="1col_left")

		{

			$sql_page  = "SELECT * from pages where id='".$_REQUEST['id']."'";

			$result = $connection->createCommand($sql_page)->query();

			$this->render('1col-left',array('content'=>$result));

		}

		if($result1['page_type']=="3col_left")

		{

		$sql_page1  = "SELECT * from pages where id='".$_REQUEST['id']."'";

		$result1 = $connection->createCommand($sql_page1)->query();

		

		$sql  = "SELECT * from projects ";

		$res = $connection->createCommand($sql)->query();

		

		$sql_news  = "SELECT * from latest_news where status=1 OR status='active'";

		$result = $connection->createCommand($sql_news)->query();

			

			

		$this->render('3col-left',array('content'=>$result1,'projects'=>$res,'news'=>$result));

		}


	}

	

	

	 function actionView_gallery()

	 {

	

		

		$this->layout='//layouts/front';

	    $this->render('view_gallery');

		 

	}

	function actionV_tour()

	 {

	

		

		$this->layout='//layouts/front';

	    $this->render('v-tour');

		 

	}

	 function actionTabs()

	 {

	

		

		$this->layout='//layouts/front';

	    $this->render('tabs');

		 

	}

	

	public function actionGallery_list()

	{	

	

	$this->layout='//layouts/front';

    $connection = Yii::app()->db; 

	$sql_projects = "SELECT * FROM gallery";

	$result_projects = $connection->createCommand($sql_projects)->queryAll();

	$this->render('gallery_list',array('gallery'=>$result_projects));

	  	

	}	

	

	public function actionSend()

	{

		$error = '';

		



if((isset($_POST['name']) && empty($_POST['name'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['message']) 	&& empty($_POST['message'])))

		{

			$error = 'Please complete all required fields <br />';

		}

	

		

		if(isset($_POST['email']) && !empty($_POST['email']) &&  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 

			$error .= 'Please enter valid Email Address<br>';

		}

		

		$query="INSERT INTO message(name,email,message) VALUES('$_POST[name]','$_POST[email]','$_POST[message]'";

		if(mysql_query($query))

		{

			

		}

		

		

	}

	//////////////////////////EMAIL SUBCRIPTION//////////////

	

	public function actionSubcribe()

	{ 
	   
		
			$connection = Yii::app()->db;
		$email=$_POST['email'];
       if(empty($email))
	   {
		$error='Please Enter Required Fields';
     	}
 
		$date=date('d-m-Y');
        if(empty($error)){
           
        
        
		$sql="INSERT INTO subcription(email,date) VALUES('".$email."','".$date."')";
		 $command = $connection -> createCommand($sql);
         $command -> execute();
        }
		 
else{
		echo $error;
		
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



	

	public function actionPieChart()

	{

			$document_data = $this->GetDocument(Yii::app()->session['user_array']['user_id']);

			$arr=(json_decode($document_data));

			$counter =1;

			$result = array();

			$count_entity = '0';

		

			foreach($arr->data as $data) {

				

				 foreach($data->source as $entities) {

				

					$result[] =  $entities;

					 break;

			 }

		 } 

		

			$result_data = array();

			$total_array = array_count_values($result);

			foreach ($total_array  as $key => $value)  

			  $result_data[] =  array('sources'=>$key,'results'=>number_format((($value/$arr->stats->found)*100),2),'total_results'=>$value); 

			echo json_encode($result_data);

			exit;

	}

	

	public $layout='//layouts/front';	

//	public function actionWeb()
//	{
//		$this->layout='column3';
//		$this->render('web');
//	}



	

	public function actionProject_details()
	{	
	$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from projects WHERE id='".$_REQUEST['id']."'";
				$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('project_details',array('projects'=>$result_projects));
	}

	public function actionNews_details()

	{	

	$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from latest_news where status='Active' AND id='".$_REQUEST['id']."'";

		$result_projects = $connection->createCommand($sql_project)->query();

		$this->render('newsevent',array('projects'=>$result_projects));

	}

	

	public function actionNewsevent()

	{	

	$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from latest_news where status='Active'";

		$result_projects = $connection->createCommand($sql_project)->query();

		$this->render('newsevent',array('projects'=>$result_projects));

	}

    public function actionCenter_details()

	{	

	$connection = Yii::app()->db;  

		$sql  = "SELECT * from sales_center";

		

			$result = $connection->createCommand($sql)->queryAll();

			$this->render('center_details',array('center'=>$result));

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