<?php


class RecieptController extends Controller
{
		 /////////////////////////START:CANCEL,REPRESENT AND BOUNCE////////////////
	public function actionAssignuser()
			{ 
					if(isset($_POST['userid']) && empty($_POST['userid']))
						{
							$error  = 'Please Select Alternate User <br>';
						}
						if(isset($_POST['sc_id']) && empty($_POST['sc_id']))
						{
							$error  .= 'Please Select Sales Center <br>';
						}
						if(empty($error)){
				    $connection = Yii::app()->db;
					  $sql2="UPDATE receipt SET `user`='".$_POST['userid']."',sc_id='".$_POST['sc_id']."' where id='".$_POST['rid']."'";
				    $command = $connection -> createCommand($sql2);
					$command -> execute();
					echo'User and Sales Center Assigned Successfully';				      						
						}else{
							echo $error;
							}
							
		
			}
			public function actionUnsupervised_list()
         {
             
        $connection = Yii::app()->db;
        $sql ="SELECT *,members.id as mid,receipt.create_date as mcd,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id) where sc_id=0";
        $result_data = $connection->createCommand($sql)->queryRow();
        $layout='//layouts/column1';
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
        $this->render('unsupervised_list', array('data'=>$result_data,'pro'=>$result_projects));
   		 }
   		 public function actionUnsupreq()
			{ 
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
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
			$prooo='';$pos=0;
			foreach($result_projects as $pro){
			if($pos==0){$prooo .=$pro['id'];}else{
			$prooo .=','.$pro['id'];}
			$pos=$pos+1;
			}
			//echo $prooo;
		
		$where='';

				$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and p.project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.="p.project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}
				if ( isset($_POST['reno']) &&  $_POST['reno']!=""){				
				if ($and==true)
				{
					$where.=" and rpt_print.r_no ='".$_POST['reno']."'";
				}
				else
				{
					$where.=" rpt_print.r_no = '".$_POST['reno']."'";
				}
				$and=true;
			}
		 if ( isset($_POST['typed']) &&  $_POST['typed']!=""){				
				if ($and==true)
				{
				$where.="and receipt.typed = '".$_POST['typed']."'";
				}
				else
				{
					$where.="receipt.typed = '".$_POST['typed']."'";
				}
				$and=true;
			}
		 if ( isset($_POST['type']) &&  $_POST['type']!=""){				
				if ($and==true)
				{
				$where.="and receipt.type LIKE '%".$_POST['type']."%'";
				}
				else
				{
					$where.="receipt.type LIKE '%".$_POST['type']."%'";
				}
				$and=true;
			}
		
		 if ( isset($_POST['datefrom']) &&  $_POST['datefrom']!="" && isset($_POST['dateto']) &&  $_POST['dateto']!=""){		
		 $from=date("Y-m-d", strtotime($_POST['datefrom']));
		$to=date("Y-m-d", strtotime($_POST['dateto']));		
				if ($and==true)
				{
				$where.="and receipt.create_date between '".$from."' and '".$to."'";
				}
				else
				{
					$where.="receipt.create_date between '".$from."' and '".$to."'";
				}
				$and=true;
			}	
		if (isset($_POST['ref_no']) && $_POST['ref_no']!=""){
				//$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and receipt.ref_no Like '%".$_POST['ref_no']."%'";
				}
				else
				{
					$where.=" receipt.ref_no Like '%".$_POST['ref_no']."%'";
				}
				$and=true;
			}
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){
				if ($and==true)
				{
					  $where.=" and m.cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" m.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
		
			if (isset($_POST['name']) && $_POST['name']!=""){

				if ($and==true)
				{
					  $where.=" and m.name like '%".$_POST['name']."%'";
				}
				else
				{
					$where.=" m.name like '%".$_POST['name']."%'";
				}
				$and=true;
			}
			if (isset($_POST['filed']) && $_POST['filed']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.filed ='".$_POST['filed']."'";
				}
				else
				{
					$where.=" receipt.filed ='".$_POST['filed']."'";
				}
				$and=true;
			}
			if (isset($_POST['bank']) && $_POST['bank']!=""){

				if ($and==true)
				{
					  $where.=" and rpt_print.bank_details ='".$_POST['bank']."'";
				}
				else
				{
					$where.=" rpt_print.bank_details ='".$_POST['bank']."'";
				}
				$and=true;
			}
if (isset($_POST['slipno']) && $_POST['slipno']!=""){

				if ($and==true)
				{
					  $where.=" and rpt_print.slipno ='".$_POST['slipno']."'";
				}
				else
				{
					$where.=" rpt_print.slipno ='".$_POST['slipno']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['inid']) && $_POST['inid']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.id ='".$_POST['inid']."'";
				}
				else
				{
					$where.=" receipt.id ='".$_POST['inid']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['status']) && $_POST['status']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.fstatus ='".$_POST['status']."'";
				}
				else
				{
					$where.=" receipt.fstatus ='".$_POST['status']."'";
				}
				$and=true;
			}
			
		/*	if (isset($_POST['status1']) && $_POST['status1']!=""){
				
			if ($and==true){
				
				if ($_POST['status1']==1){$where.=" and receipt.bank_details !=''";}
				if ($_POST['status1']==2){$where.=" and receipt.bank_details =''";	}
				if ($_POST['status1']==5){$where.=" ";
				
				
				}
			}else{
			
				if ($_POST['status1']==1){$where.="  receipt.bank_details!=''";$and=true;}
				if ($_POST['status1']==2){$where.="  receipt.bank_details =''";$and=true;	}
				if ($_POST['status1']==5){$where.=" ";}
			}
			
				
			}*/
//print_r(Yii::app()->session['user_array']);exit;
			$co='';
			$filter='';
			$jo='';
			if(Yii::app()->session['user_array']['per18']==1 && Yii::app()->session['user_array']['per19']==0 && Yii::app()->session['user_array']['per20']==0 && Yii::app()->session['user_array']['per21']==0){
			
			if ($and==true){	
			$where .=' and receipt.user='.Yii::app()->session['user_array']['id'];	
			}else{$where .=' receipt.user='.Yii::app()->session['user_array']['id'];	}
			$and=true;
			if (!isset($_POST['status1'])){	
			$where .=" and receipt.bank_details=''";	
			}
			}	
			
			if(Yii::app()->session['user_array']['per21']==1){
				if (!isset($_POST['filed'])){	
				if ($and==true){
				$where .=" and receipt.filed=0";	
				}else{$where .=" receipt.filed=0";	}
			$and=true;
			}
			}
			if(Yii::app()->session['user_array']['per9']==1){
			if (!isset($_POST['status'])){	
				if ($and==true){
				$where .=" and receipt.bank_details!='' and receipt.fstatus='' ";	
				}else{$where .=" receipt.bank_details!='' and receipt.fstatus='' ";}
			
			$and=true;

			}}
			
			if ($and==true){$co='where';}
			
			//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 50;}
$adjacent = 50;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 

		$connection = Yii::app()->db; 
	 $sql_payment1  = "SELECT p.project_id,receipt.*,m.*,receipt.id as rid FROM receipt 
left join members m on receipt.mem_id=m.id
Inner join rpt_print on rpt_print.rid=receipt.id
left join plots p on rpt_print.msid=p.id 

$co $where $filter and receipt.sc_id='0'  group by rpt_print.rid
";//echo $sql_payment1;exit;

		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
		$rows =count($result_payments1);
		     echo $sql_payment  = "SELECT receipt.*,m.*,receipt.id as rid,m.cnic as mcnic,receipt.create_date as rcd FROM receipt 
left join members m on receipt.mem_id=m.id
LEFT join rpt_print on rpt_print.rid=receipt.id
left join plots p on rpt_print.msid=p.id 
$jo
$co 
$where $filter and receipt.sc_id='0' group by rpt_print.rid
order by receipt.create_date DESC,receipt.id DESC
limit $start,$limit";exit;
		$result_payments = $connection->createCommand($sql_payment)->queryAll();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$sql_payments= $connection->createCommand($sql_payment)->query();
		
		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();
		

	$count=0;

	if ($sql_payments!=''){
	$home=Yii::app()->request->baseUrl; 
    $res=array();
	foreach($sql_payments as $key){
	$total=$key['amount'];	
	//if (isset($_POST['status1']) && $_POST['status1']==5){
	//	$total=0;
	//	$sql_ins  = "SELECT * from installpayment where r_id='".$key['rid']."' ";
	//	$result_ins = $connection->createCommand($sql_ins)->queryAll();
	//	$sql_plo  = "SELECT * from plotpayment where r_id='".$key['rid']."' ";
	//	$result_plo = $connection->createCommand($sql_plo)->queryAll();
	//	foreach($result_ins as $row){$total=$total+$row['paidamount'];}
	//	foreach($result_plo as $row1){$total=$total+$row1['paidamount'];}
	//	}	
	$connection = Yii::app()->db; 
 	$sql_payment2  = "SELECT * FROM rpt_print where rid='".$key['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	  echo '<tr><td>';
  if(($key['fstatus']=='Bounce')){
	  echo'';
	  }
  elseif($key['typed']==0){
  echo '<a  href="#">'.$key['rid'].'</a>';
  }else{echo '<a  href="#">'.$key['rid'].'</a>';}
  echo '</td><td>'.date("d-m-Y", strtotime($key['rcd'] )).'</td><td>'.$key['name'].'</td><td>'.$key['mcnic'].'</td><td style="text-align:right;">'.number_format($key['amount']).'</td><td>'.$key['ref_no'].'</td><td>'.$key['type'].'</td><td>'.$key['fstatus'].'</td>';
  echo '<td>';if($key['fstatus']=='Bounce'){ echo '';}else{
  if(Yii::app()->session['user_array']['per9']==1){
  echo '<a  href="#">Finance Verify</a>';}
    if(Yii::app()->session['user_array']['per19']==1 ){
   echo '/<a  href="#">Sales Center</a>';}
	 if(Yii::app()->session['user_array']['per21']==1 ){
     echo '/<a  href="#">Receipt Admin</a>';}}
   
echo '</td>';?>

<?php 
echo'';
$color='';
 
echo '<td></td><td style="background-color:'.$color.';  ">';
				echo'
			   <a href="assign_supervision?rid='.$key['rid'].'">Assign Supervision</a>';


           }
	 ?>
	
	
	 
	 
	  </td></tr>
			<?php }else{echo exit;}
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
			}
	public function actionAssign_supervision()
			{ 
				
										$connection = Yii::app()->db;
						  $sql ="SELECT *,bank.name as bname,members.id as mid,members.name as mname,receipt.id as rid from receipt 
						 Left join members on (receipt.mem_id=members.id)
						 Left join bank on (receipt.bank_details=bank.id)
						  where receipt.id='".$_REQUEST['rid']."'";
			              $result_data = $connection->createCommand($sql)->queryRow();    
						
							
							$this->render('assign_supervision', array('data'=>$result_data));
				
			
					}
	
		public function actionSwitch()
			{ 
					if(isset(Yii::app()->session['user_array']['username']))
			{
										$connection = Yii::app()->db;
						 $sql ="SELECT *,bank.name as bname,members.id as mid,members.name as mname,receipt.id as rid from receipt 
						 Left join members on (receipt.mem_id=members.id)
						 Left join bank on (receipt.bank_details=bank.id)
						  where receipt.id='".$_REQUEST['rid']."'";  
			                $result_data = $connection->createCommand($sql)->queryRow();    
							$layout='//layouts/column1';
							$sql_project = "SELECT * from projects";
							$result_project = $connection->createCommand($sql_project)->query();
							$this->render('switch', array('data'=>$result_data,'pro'=>$result_project));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
			
			}
			public function actionSwitchuser()
			{ 
					if(isset($_POST['userid']) && empty($_POST['userid']))
						{
							$error  = 'Please Select Alternate User <br>';
						}
						if(empty($error)){
				    $connection = Yii::app()->db;
					  $sql2="UPDATE receipt SET `user`='".$_POST['userid']."' where id='".$_POST['rid']."'";
				    $command = $connection -> createCommand($sql2);
					$command -> execute();
					echo'User Switched Successfully';				      						
						}else{
							echo $error;
							}
							
		
			}
			public function actionRepresent()
			{ 
				$error='';
				$connection = Yii::app()->db;		
				if((isset($_POST['bounceid']) && empty($_POST['bounceid'])))
				{ 
					 $error ='Please Select Status';
				} //echo $_POST['recid'];exit;
								if(empty($error)){			
					$sql1="UPDATE installpayment SET `fstatus`='Bounce',others='Bounce'
					where r_id='".$_REQUEST['recid']."'";	
					$command = $connection -> createCommand($sql1);
					$command -> execute();
					$sql2="UPDATE receipt SET `fstatus`='Bounce' where id='".$_REQUEST['recid']."'";	
				    $command = $connection -> createCommand($sql2);
					$command -> execute();
					$sql3="UPDATE plotpayment SET `fstatus`='Bounce',others='Bounce'
					where r_id='".$_REQUEST['recid']."'";	
					$command = $connection -> createCommand($sql3);
					$command -> execute();
					echo 'Receipt Bounce Successfully';
		
		}else{
			echo $error;exit;
			
			}
			}
			
			public function actionBouncereceipt()
		{		if(isset(Yii::app()->session['user_array']['username']))
			{
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.create_date as mcd,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('bouncereceipt', array('data'=>$result_data));
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
		}
		public function actionRepresentrec()
		{
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.create_date as mcd,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('representrec', array('data'=>$result_data));
		}
		public function actionBouncerec_list()
		{
			$connection = Yii::app()->db;
			$sql ="SELECT receipt.*,members.id as mid,receipt.create_date as mcd,receipt.id as rid from receipt 
				 Left join members on (receipt.mem_id=members.id)";
			$result_data = $connection->createCommand($sql)->query();
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
			$this->render('bouncerec_list', array('data'=>$result_data,'pro'=>$result_projects));
		}
    	public function actionBouncereq()
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
			$prooo='';$pos=0;
			foreach($result_projects as $pro){
			if($pos==0){$prooo .=$pro['id'];}else{
			$prooo .=','.$pro['id'];}
			$pos=$pos+1;
			}
			//echo $prooo;
		
		$where='';

				$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and (p.project_id ='".$_POST['project_id']."')";
				}
				else
				{
					$where.="(p.project_id = '".$_POST['project_id']."')";
				}
				$and=true;
			}else{
				if ($and==true)
				{
					$where.=" and (p.project_id IN (".$prooo.") )";
				}
				else
				{
					$where.=" (p.project_id IN (".$prooo.") )";
				}
				$and=true;

				}
				if ( isset($_POST['reno']) &&  $_POST['reno']!=""){				
				if ($and==true)
				{
					$where.=" and rpt_print.r_no ='".$_POST['reno']."'";
				}
				else
				{
					$where.=" rpt_print.r_no = '".$_POST['reno']."'";
				}
				$and=true;
			}
		 if ( isset($_POST['typed']) &&  $_POST['typed']!=""){				
				if ($and==true)
				{
				$where.="and receipt.typed = '".$_POST['typed']."'";
				}
				else
				{
					$where.="receipt.typed = '".$_POST['typed']."'";
				}
				$and=true;
			}
		 if ( isset($_POST['type']) &&  $_POST['type']!=""){				
				if ($and==true)
				{
				$where.="and receipt.type LIKE '%".$_POST['type']."%'";
				}
				else
				{
					$where.="receipt.type LIKE '%".$_POST['type']."%'";
				}
				$and=true;
			}
		
		 if ( isset($_POST['datefrom']) &&  $_POST['datefrom']!="" && isset($_POST['dateto']) &&  $_POST['dateto']!=""){		
		 $from=date("Y-m-d", strtotime($_POST['datefrom']));
		$to=date("Y-m-d", strtotime($_POST['dateto']));		
				if ($and==true)
				{
				$where.="and receipt.create_date between '".$from."' and '".$to."'";
				}
				else
				{
					$where.="receipt.create_date between '".$from."' and '".$to."'";
				}
				$and=true;
			}	
		if (isset($_POST['ref_no']) && $_POST['ref_no']!=""){
				//$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and receipt.ref_no Like '%".$_POST['ref_no']."%'";
				}
				else
				{
					$where.=" receipt.ref_no Like '%".$_POST['ref_no']."%'";
				}
				$and=true;
			}
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){
				if ($and==true)
				{
					  $where.=" and m.cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" m.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			if (isset($_POST['scf']) && $_POST['scf']!=""){
				if ($and==true)
				{
					  $where.=" and receipt.sc_id ='".$_POST['scf']."'";
				}
				else
				{
					$where.=" receipt.sc_id ='".$_POST['scf']."'";
				}
				$and=true;
			}
			if (isset($_POST['name']) && $_POST['name']!=""){

				if ($and==true)
				{
					  $where.=" and m.name like '%".$_POST['name']."%'";
				}
				else
				{
					$where.=" m.name like '%".$_POST['name']."%'";
				}
				$and=true;
			}
			if (isset($_POST['filed']) && $_POST['filed']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.filed ='".$_POST['filed']."'";
				}
				else
				{
					$where.=" receipt.filed ='".$_POST['filed']."'";
				}
				$and=true;
			}
			if (isset($_POST['bank']) && $_POST['bank']!=""){

				if ($and==true)
				{
					  $where.=" and rpt_print.bank_details ='".$_POST['bank']."'";
				}
				else
				{
					$where.=" rpt_print.bank_details ='".$_POST['bank']."'";
				}
				$and=true;
			}
if (isset($_POST['slipno']) && $_POST['slipno']!=""){

				if ($and==true)
				{
					  $where.=" and rpt_print.slipno ='".$_POST['slipno']."'";
				}
				else
				{
					$where.=" rpt_print.slipno ='".$_POST['slipno']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['inid']) && $_POST['inid']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.id ='".$_POST['inid']."'";
				}
				else
				{
					$where.=" receipt.id ='".$_POST['inid']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['status']) && $_POST['status']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.fstatus ='".$_POST['status']."'";
				}
				else
				{
					$where.=" receipt.fstatus ='".$_POST['status']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['status1']) && $_POST['status1']!=""){
				
			if ($and==true){
				
				if ($_POST['status1']==1){$where.=" and receipt.bank_details !=''";}
				if ($_POST['status1']==2){$where.=" and receipt.bank_details =''";	}
				if ($_POST['status1']==5){$where.=" ";
				
				
				}
			}else{
			
				if ($_POST['status1']==1){$where.="  receipt.bank_details!=''";$and=true;}
				if ($_POST['status1']==2){$where.="  receipt.bank_details =''";$and=true;	}
				if ($_POST['status1']==5){$where.=" ";}
			}
			
				
			}
//print_r(Yii::app()->session['user_array']);exit;
			$co='';
			$filter='';
			$jo='';
			if(Yii::app()->session['user_array']['per18']==1 && Yii::app()->session['user_array']['per19']==0 && Yii::app()->session['user_array']['per20']==0 && Yii::app()->session['user_array']['per21']==0){
			
			if ($and==true){	
			$where .=' and receipt.user='.Yii::app()->session['user_array']['id'];	
			}else{$where .=' receipt.user='.Yii::app()->session['user_array']['id'];	}
			$and=true;
			if (!isset($_POST['status1'])){	
			$where .=" and receipt.bank_details=''";	
			}
			}	
			if(Yii::app()->session['user_array']['per18']==1){
			if ($and==true){
			$where .=' and user.sc_id='.Yii::app()->session['user_array']['sc_id'];	
			}else{$where .=' user.sc_id='.Yii::app()->session['user_array']['sc_id'];}
			$jo='Left Join user on(receipt.user=user.id)';
			$and=true;
			if (!isset($_POST['status1'])){	
			$where .=" and receipt.bank_details=''";	
			}
			}
			if(Yii::app()->session['user_array']['per21']==1){
				if (!isset($_POST['filed'])){	
				if ($and==true){
				$where .=" and receipt.filed=0";	
				}else{$where .=" receipt.filed=0";	}
			$and=true;
			}
			}
			if(Yii::app()->session['user_array']['per9']==1){
			if (!isset($_POST['status'])){	
				if ($and==true){
				$where .=" and receipt.bank_details!='' and receipt.fstatus='' ";	
				}else{$where .=" receipt.bank_details!='' and receipt.fstatus='' ";}
			
			$and=true;

			}}
			
			if ($and==true){$co='where';}
			
			//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 50;}
$adjacent = 50;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 

		$connection = Yii::app()->db; 
	 $sql_payment1  = "SELECT receipt.*,m.*,receipt.id as rid FROM receipt 
left join members m on receipt.mem_id=m.id
Inner join rpt_print on rpt_print.rid=receipt.id
left join plots p on rpt_print.msid=p.id 

$jo
$co $where $filter and receipt.fstatus='Bounce'  group by rpt_print.rid
";//echo 123;exit;

		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
		$rows =count($result_payments1);
		  $sql_payment  = "SELECT receipt.*,m.*,receipt.id as rid,m.cnic as mcnic,receipt.create_date as rcd FROM receipt 
left join members m on receipt.mem_id=m.id
Inner join rpt_print on rpt_print.rid=receipt.id
left join plots p on rpt_print.msid=p.id 

$jo
$co 
$where $filter and receipt.fstatus='Bounce' group by rpt_print.rid
order by receipt.create_date DESC,receipt.id DESC
limit $start,$limit
 ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$sql_payments= $connection->createCommand($sql_payment)->query();
		
		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();
		

	$count=0;

	if ($sql_payments!=''){
	$home=Yii::app()->request->baseUrl; 
    $res=array();
	foreach($sql_payments as $key){
	$total=$key['amount'];	
	//if (isset($_POST['status1']) && $_POST['status1']==5){
	//	$total=0;
	//	$sql_ins  = "SELECT * from installpayment where r_id='".$key['rid']."' ";
	//	$result_ins = $connection->createCommand($sql_ins)->queryAll();
	//	$sql_plo  = "SELECT * from plotpayment where r_id='".$key['rid']."' ";
	//	$result_plo = $connection->createCommand($sql_plo)->queryAll();
	//	foreach($result_ins as $row){$total=$total+$row['paidamount'];}
	//	foreach($result_plo as $row1){$total=$total+$row1['paidamount'];}
	//	}	
	$connection = Yii::app()->db; 
 	$sql_payment2  = "SELECT * FROM rpt_print where rid='".$key['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	  echo '<tr><td>';
  if(($key['fstatus']=='Bounce')){
	  echo'';
	  }
  elseif($key['typed']==0){
  echo '<a  href="Updatereciept?id='.$key['rid'].'">'.$key['rid'].'</a>';
  }else{echo '<a  href="Updaterecieptd?id='.$key['rid'].'">'.$key['rid'].'</a>';}
  echo '</td><td>'.date("d-m-Y", strtotime($key['rcd'] )).'</td><td>'.$key['name'].'</td><td>'.$key['mcnic'].'</td><td style="text-align:right;">'.number_format($key['amount']).'</td><td>'.$key['ref_no'].'</td><td>'.$key['type'].'</td><td>'.$key['fstatus'].'</td>';
  echo '<td>';if($key['fstatus']=='Bounce'){ echo '';}else{
  if(Yii::app()->session['user_array']['per9']==1){
  echo '<a  href="varification?id='.$key['rid'].'">Finance Verify</a>';}
    if(Yii::app()->session['user_array']['per19']==1 ){
   echo '/<a  href="varificationsales?id='.$key['rid'].'">Sales Center</a>';}
	 if(Yii::app()->session['user_array']['per21']==1 ){
     echo '/<a  href="readmin?id='.$key['rid'].'">Receipt Admin</a>';}}
   
echo '</td>';?>

<?php 
echo'';
$color='';
if($key['enableedit']=='1'){$color='red';}else{$color='';}
 
echo '<td></td><td style="background-color:'.$color.';  ">';

          if((Yii::app()->session['user_array']['per18']==1) &&(Yii::app()->session['user_array']['per19']==1) ){
			  echo'<a href="print?id='.$key['rid'].'">View</a>/<a href="switch?rid='.$key['rid'].'">Switch User</a>';
			
			  }else{echo'
			   <a href="representrec?id='.$key['rid'].'">Represent Receipt</a>';
		   
				
				
				
		     }

           }
	 ?>
	
	
	 
	 
	  </td></tr>
			<?php }else{echo exit;}
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
		public function actionBouncerec()
        	{ 
		$error='';
		$connection = Yii::app()->db;
		if((isset($_POST['comment']) && empty($_POST['comment'])))
		{ 
			 $error ='Please Enter Comments';
		} 
						if(empty($error)){
			$sql1="UPDATE installpayment SET `fstatus`='Bounce',others='Bounce'
			where r_id='".$_REQUEST['recid']."'";	
       	    $command = $connection -> createCommand($sql1);
            $command -> execute();
			  $sql2="UPDATE receipt SET `fstatus`='Bounce',comm='".$_POST['comment']."',receipt_status='Bounce'
			where id='".$_REQUEST['recid']."'";	
            $command = $connection -> createCommand($sql2);
            $command -> execute();
			 $sql3="UPDATE plotpayment SET `fstatus`='Bounce',others='Bounce'
			where r_id='".$_REQUEST['recid']."'";	
        	$command = $connection -> createCommand($sql3);
            $command -> execute();
			echo 'Receipt Bounce Successfully';

		}else{
			echo $error;exit;
			}

	}	
		 public function actionCancelreciept()
			{
			    	if(isset(Yii::app()->session['user_array']['username']))
			{
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.create_date as mcd,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('cancelreciept', array('data'=>$result_data));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
			}
			
			
			public function actionCancel()
        	{
		 $connection = Yii::app()->db;	
			 $sql_ref  = "Select * from installpayment where id='".$_REQUEST['id']."'";
			 $result_ref = $connection->createCommand($sql_ref)->queryRow();	
			$sql_ref1  = "Select * from installpayment where r_id='".$_REQUEST['rid']."' and plot_id='".$result_ref['plot_id']."'";
			 $result_ref1 = $connection->createCommand($sql_ref1)->queryAll();
			$sql_ref2  = "Select * from plotpayment where r_id='".$_REQUEST['rid']."' and plot_id='".$result_ref['plot_id']."'";
			 $result_ref2 = $connection->createCommand($sql_ref2)->queryAll();

			if((count($result_ref1)+count($result_ref2))==1){
			$sql_delete1 = 'DELETE FROM rpt_print WHERE msid="'.$result_ref['plot_id'].'" and rid='.$_REQUEST['rid'];	
			$command = $connection -> createCommand($sql_delete1);
    	    $command -> execute();
			}
			if($result_ref['ref'] > 0){
			$sql_delete = 'DELETE FROM installpayment WHERE id='.$_REQUEST['id'];	
			$command = $connection -> createCommand($sql_delete);
    	    $command -> execute();
				}else{
			 $sql1="UPDATE installpayment SET `paidamount`='',payment_type='',`surcharge`='',`paidsurcharge`='', `paidas`='',`r_id`='',`detail`='',`paid_date_temp`='',`remarks`=''
			where id='".$_REQUEST['id']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();}
			$this->redirect(array('reciept/Updatereciept?id='.$_REQUEST['rid']));
	        	}
			public function actionCancelrec()
       { 
		$error='';
		$connection = Yii::app()->db;	
		if((isset($_POST['comnt']) && empty($_POST['comnt'])))
		{ 
			 $error ='Please Enter Comments';
		} //echo $_POST['recid'];exit;
						if(empty($error)){
			 $sql1="UPDATE installpayment SET `paidamount`='',payment_type='',`others`='', `paidas`='',`r_id`='',`detail`='',`paid_date_temp`='',`remarks`=''
			where r_id='".$_REQUEST['recid']."'";	
       	$command = $connection -> createCommand($sql1);
            $command -> execute();
			  $sql2="UPDATE receipt SET `fstatus`='Cancelled',`comm`='".$_POST['comnt']."',cancel_user='".yii::app()->session['user_array']['id']."',cancel_date='".date('Y-m-d')."'
			where id='".$_REQUEST['recid']."'";	
        $command = $connection -> createCommand($sql2);
            $command -> execute();

			 $sql3="UPDATE plotpayment SET `fstatus`='Cancelled',others='Cancelled',`paidamount`='',`date`='',`remarks`=''
			where r_id='".$_REQUEST['recid']."'";	
        	$command = $connection -> createCommand($sql3);
            $command -> execute();
			echo 'Receipt Cancelled';
			}else{
				  echo $error;exit;
				
				}


			
			///$this->redirect(array('reciept/Updatereciept?id='.$_REQUEST['id']));
	}
				public function actionUpdatere()
	{
			
		              $error ='';
	                                	if ((isset($_POST['comm']) && empty($_POST['comm']))){$error="Enter Remarks. <br>";}  
									  $connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 $uid=Yii::app()->session['user_array']['id'];
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
									if ((isset($_POST['amount']) && empty($_POST['amount']))){$error="Amount required. <br>";}  
									
									if ((isset($_POST['ref']) && empty($_POST['ref']))){$error="Amount required. <br>";}  
									if ((isset($base) && empty($base))){
									 $error.="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }
									
										if(!empty($error)){
											echo $error;exit;
											}else{
                                        $transferto_memberid = $result_data['id'];

//,'','".Yii::app()->session['user_array']['id']."'
										$newDate='';
										
										$newDate = date("Y-m-d", strtotime($_POST['fromdate'] ));
									///	echo $newDate;exit;
										 $sql="UPDATE receipt SET  fstatus='',date='".$newDate."',receipt_status='Represented',type='".$_POST['type']."',comm='".$_POST['comm']."',
										 ref_no='".$_POST['ref']."' where id='".$_POST['rid']."' ";	 
        		   					 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
									 $sql1="UPDATE installpayment SET  fstatus='' where r_id='".$_POST['rid']."' ";	 
        		   					 $command = $connection -> createCommand($sql1);
                      				 $command -> execute();
									 $sql1="UPDATE plotpayment SET  fstatus='' where r_id='".$_POST['rid']."' ";	 
        		   					 $command = $connection -> createCommand($sql1);
                      				 $command -> execute();
									
									 	echo "Represented Successfully ";
										echo '<script>location.reload();</script>';exit;
									}
			}
		 /////////////////////////END:CANCEL,REPRESENT AND BOUNCE////////////////
		
		
		////////////////////////////////////////////////////////////////////////
			public function actionUpdate_charges()

     	{

		if(Yii::app()->session['user_array']['per18']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	
			$sql_charges  = "SELECT plotpayment.*,user.firstname,user.middelname,user.lastname,mp.plotno, m.name,m.cnic,m.phone,p.plot_detail_address,s.street,pr.project_name from plotpayment
			left join members m on plotpayment.mem_id=m.id
			left join plots p on plotpayment.plot_id=p.id
			left join memberplot mp on mp.plot_id=p.id
			left join streets s on p.street_id=s.id
			left join projects pr on p.project_id=pr.id
			left join user on plotpayment.fid=user.id
			where plotpayment.id='".$_REQUEST['id']."'
			";

			$result_charges = $connection->createCommand($sql_charges)->query();
			
			
		$this->render('update_charges',array('charges'=>$result_charges));


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	 public function actionSearchreq()

	 {
		$where='';

		$and=false;
		  
			//echo $from.$to; exit;
		
		
		 if (isset($_POST['status']) && $_POST['status']!=""){
                $and=true;

				if($_POST['status']=='new'){$where.="plotpayment.fstatus='' and paidamount!=''";}
				else if($_POST['status']=='due'){$where.="plotpayment.fstatus='' and paidamount=''";}else{
				$where.="plotpayment.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
				
			}
				
		if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and memberplot.plotno Like '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.=" memberplot.plotno Like '%".$_POST['plotno']."%'";
				}
				$and=true;

			}
			if (isset($_POST['vno']) && $_POST['vno']!=""){
				$plotno=$_POST['vno'];
				if ($and==true)
				{
					  $where.=" and plotpayment.detail Like '%".$_POST['vno']."%'";
				}
				else
				{
					$where.=" plotpayment.detail Like '%".$_POST['vno']."%'";
				}
				$and=true;

			}
			
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				

				$pro=$_POST['project_id'];

				if ($and==true)

				{

					$where.=" and plots.project_id = '".$_POST['project_id']."'";

				}

				else

				{

					$where.=" plots.project_id = '".$_POST['project_id']."'";

				}

				$and=true;

			}

		$connection = Yii::app()->db; 
//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 25;}
$adjacent = 25;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 
$connection = Yii::app()->db; 
 $sql_memberas = "SELECT * FROM
    plotpayment
    Left JOIN plots  ON (plots.id = plotpayment.plot_id)
	Left JOIN projects  ON (projects.id = plots.project_id)
	Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
where $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end


		$connection = Yii::app()->db; 
 $sql_payment  = "SELECT plots.plot_detail_address

	, plotpayment.*
    , plots.plot_detail_address
	 , plots.com_res
	 , plots.create_date
	 , projects.project_name
	 ,memberplot.plotno
FROM

    plotpayment

    Left JOIN plots  ON (plots.id = plotpayment.plot_id)
	Left JOIN projects  ON (projects.id = plots.project_id)
	Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
	 where $where  limit $start,$limit";  
 
//		$sql_payment  = "SELECT * FROM plotpayment
	//	 where $where";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$sql_payments= $connection->createCommand($sql_payment)->query();
		
		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();
		

	$count=0;

	if ($sql_payments!=''){

		$home=Yii::app()->request->baseUrl; 

    $res=array();
$i=0;
            foreach($sql_payments as $row){

          
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
		$i++;

		//$due=$due+$row['amount'];
		//$paid=$paid+$row['paidamount'];
		if($row['amount']==''){$row['amount']=0;}
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['plotno'] . '</td>

 <td>' . $row['plot_detail_address'] . '</td>
 <td>' . $row['payment_type'] . '</td>
 <td style="text-align:right">'.$row['amount']. '</td>
 <td style="text-align:right">' . $row['paidamount']. '</td>
  <td >' . $row['duedate']. '</td>
  <td>' . $row['paidas'] . '</td>
  <td>' . $row['detail'] . '</td>
 
   <td>' . $row['date'] . '</td>
  <td><a  href="update_charges?id='.$row['id'].'">Charges Detail</a></td>
</tr> 


 ';

		 

			} 

			}else{echo exit;}
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
	public function actionPayment_lis()

	{
		if((Yii::app()->session['user_array']['per18']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
			$plotno='';

			$st='';

			$pro='';

			$sector='';
			$size='';

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
            $sql_payment  = "SELECT * FROM installpayment where fstatus='' and paidamount!=''";
			$result_payments = $connection->createCommand($sql_payment)->queryAll();
			$installments=count ( $result_payments );
       $connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
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
		$pro = $connection->createCommand($sql_project)->query() or mysql_error();
		$sql_categories  = "SELECT * from categories";
		$categories = $connection->createCommand($sql_categories)->query();
				$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
		    $home=Yii::app()->request->baseUrl; 
			
			$this->render('payment_lis',array('members'=>$result_members,'installment'=>$installments,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));
			}
			else{
				$this->redirect(array('user/dashboard'));
				}
			

	   

	}
	
	
		
		
		
		///////////////////////////////////////////////
		public function actionUpdate_installment()
	{

		if(Yii::app()->session['user_array']['per18']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	
			$sql_charges  = "SELECT installpayment.*,user.firstname,user.middelname,user.lastname,mp.plotno, m.name,m.cnic,m.phone,p.plot_detail_address,s.street,pr.project_name from installpayment
			left join members m on installpayment.mem_id=m.id
			left join plots p on installpayment.plot_id=p.id
			left join memberplot mp on mp.plot_id=p.id
			left join streets s on p.street_id=s.id
			left join projects pr on p.project_id=pr.id
			left join user on installpayment.fid=user.id
			where installpayment.id='".$_REQUEST['id']."'
			";
			$result_charges = $connection->createCommand($sql_charges)->query();
			
			
		$this->render('update_installment',array('charges'=>$result_charges));


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    } 
		public function actionInstallment_lis()
	{
		
			if((Yii::app()->session['user_array']['per18']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
				$plotno='';
	
				$st='';
	
				$pro='';
	
				$sector='';
				$size='';
	
				$cat='';
	
				$where='';
	
				$and = false;
	
				$where='';
	
				
	
	
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
	
				
		
		$connection = Yii::app()->db; 
	
		$sql_member = "SELECT
	
		plots.id
	
		, plots.street_id
	
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

		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		
			$sql_categories  = "SELECT * from categories";
			$categories = $connection->createCommand($sql_categories)->query();
			
			$sql_size  = "SELECT * from size_cat";
			$sizes = $connection->createCommand($sql_size)->query();
			$sql_sector ="SELECT DISTINCT sector FROM plots";
			$result_sector = $connection->createCommand($sql_sector)->query();
				$home=Yii::app()->request->baseUrl; 
				
	
				$this->render('installment_lis',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$result_projects,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));
			}else{
				$this->redirect(array('user/dashboard'));
				}
				
	
		   
	
		}
 public function actionSearchinstallment()

	 	{
		$where='';

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
		 if (isset($_POST['status']) && $_POST['status']!=""){

				if($_POST['status']=='new'){$where.="installpayment.fstatus='' and paidamount!=''";}
				else if($_POST['status']=='due'){$where.="installpayment.fstatus='' and paidamount=''";}else{
				$where.="installpayment.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
			}
		if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and mp.plotno like '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.=" mp.plotno like '%".$_POST['plotno']."%'";
				}
				$and=true;
			}
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				

				$pro=$_POST['project_id'];

				if ($and==true)

				{

					$where.=" and p.project_id = '".$_POST['project_id']."'";

				}

				else

				{

					$where.=" p.project_id = '".$_POST['project_id']."'";

				}

				$and=true;

			}

			if (isset($_POST['vno']) && $_POST['vno']!=""){
				$plotno=$_POST['vno'];
				if ($and==true)
				{
					  $where.=" and installpayment.detail like '%".$_POST['vno']."%'";
				}
				else
				{
					$where.=" installpayment.detail like '%".$_POST['vno']."%'";
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
 $sql_memberas = "SELECT p.project_id,mp.plotno,installpayment.payment_type,installpayment.dueamount,installpayment.paidamount,installpayment.due_date,installpayment.paidas,installpayment.detail,installpayment.surcharge,installpayment.paid_date,installpayment.id,installpayment.fstatus,installpayment.lab FROM installpayment 
		left join memberplot mp on(installpayment.plot_id=mp.plot_id)
		left join plots p on(installpayment.plot_id=p.id)
		where $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end

		$connection = Yii::app()->db; 

		$sql_payment  = "SELECT p.project_id,mp.plotno,installpayment.payment_type,installpayment.dueamount,installpayment.paidamount,installpayment.due_date,installpayment.paidas,installpayment.detail,installpayment.surcharge,installpayment.paid_date,installpayment.id,installpayment.fstatus,installpayment.lab FROM installpayment 
		left join memberplot mp on(installpayment.plot_id=mp.plot_id)
			left join plots p on(installpayment.plot_id=p.id)
		where $where limit $start,$limit";  
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
        $sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
		$sql_payments= $connection->createCommand($sql_payment)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	$count=0;
	if ($sql_payments!=''){
		$home=Yii::app()->request->baseUrl; 
    $res=array();
$i=0;
            foreach($sql_payments as $row){
		$i++;
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['plotno'] . '</td>
 <td>' . $row['lab'] . '</td>

 <td>' . $row['dueamount'] . '</td>
 <td>' . $row['paidamount'] . '</td>
  <td>' . $row['due_date']. '</td>
  <td>' . $row['payment_type'] . '</td>
  <td>' . $row['detail'] . '</td>
  <td>' . $row['surcharge'] . '</td>
   <td>' . $row['paid_date'] . '</td>
  <td><a href="update_installment?id='.$row['id'].'">View Detail</a>
</td>
</tr>  
<script>
var id =document.getElementById(id);
function myfunction(id)
{
$.ajax({
     type: "POST",
      url:    "ajaxRequest4?val1="+id,
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



</script>
';

		 

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
	 exit;

			}else{exit;}
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
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////BHATTI///////////////////////////////////////////////////////////////////////
	public function actionDelete_Target()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	{	
    $connection = Yii::app()->db; 
	 $connection = Yii::app()->db; 
		 $sql_del = "DELETE from monthly_payment_target where id=".$_GET['id'];
			 $command = $connection -> createCommand($sql_del);
          $command -> execute();
		 $this->redirect (array('reciept/target_list'));
		
		}
	  else{
		  $this->redirect (array('user/user'));
	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
		public function actionUpdate_targ()
	  {
		 $connection = Yii::app()->db;
				 $error =array();

	   			$id=$_POST['id'];
				if(isset($_POST['target']) && empty($_POST['target']))
			{
			$error = 'Please Enter <br>';
		     }
			
				 
			 $year=$_POST['year'];
			 $month=$_POST['month'];
			  $target=$_POST['target'];
			
            if(empty($error))
		{	
			 $sql_update = "UPDATE monthly_payment_target SET year ='$year',month ='$month',target=$target WHERE id =".$id;
    		 $command = $connection -> createCommand($sql_update);
          $command -> execute();

			    echo $note="Record Updated Successfully";
			}
			if(!empty($error))
			{
				echo $error;
			}

	   }
	   
	       public function actionUpdate_target()
   	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
	$connection = Yii::app()->db;
$sql = "SELECT * FROM monthly_payment_target
	where id=".$_GET['id']."";
	$result = $connection->createCommand($sql)->query();



	$this->render('update_target',array('update_target'=>$result));



		}else{



			$this->redirect (array('user/user'));



	  		}



			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



    }
	  public function actionTarget()
	{
		$connection = Yii::app()->db;
		
		$this->render('target_list');
	}
		 public function actionAdd_targ()
		{

		if(Yii::app()->session['user_array']['per19']=='1')
		{	
			$error =array();
			$error ='';
			if(isset($_POST['year']) && empty($_POST['year']))
			{
			$error = 'Please Select Year<br>';
			}
			if(isset($_POST['month']) && empty($_POST['month']))
			{
			$error .= 'Please Select Month<br>';
			}
			if(isset($_POST['target']) && empty($_POST['target']))
			{
			$error .= 'Please Enter target<br>';
			}
				if(empty($error)){
					$connection = Yii::app()->db;
				   $sq  = "SELECT * from monthly_payment_target where year='".$_POST['year']."' AND month='".$_POST['month']."' and target !=''";
			       $result_sq = $connection->createCommand($sq)->queryRow();
					if(!empty($result_sq)){
						$error .="Target Already exists";
						}else{
	  
			
			//echo $error;
		// 	if(empty($error)){
				$sql ="INSERT INTO monthly_payment_target(year,month,target) VALUES('".$_POST['year']."','".$_POST['month']."','".$_POST['target']."')";	
                $command = $connection -> createCommand($sql);
		       $command -> execute();
				 echo "New Record Inserted Successfully";exit;
			}}
			}
			if(!empty($error))
			{
				echo $error;exit;
			}
			
			else{
			$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
			}

	}

	public function actionAdd_target()
	{
		$connection = Yii::app()->db;
		
		$this->render('add_target');
	}
		public function actionTarget_list()
	{
		  $connection = Yii::app()->db; 

	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
		$this->layout='//layouts/back';
       	$and = false;
			$where='';
	if (!empty($_POST['year'])){				
				if ($and==false)
				{
					$where.="where monthly_payment_target.year LIKE '%".$_POST['year']."%'";
				}
				else
				{
					$where.="where monthly_payment_target.year LIKE '%".$_POST['year']."%'";
				}
				
			}
			if (!empty($_POST['month'])){				
				if ($and==true)
				{
					$where.="and monthly_payment_target.month LIKE '%".$_POST['month']."%'";
				}
				else
				{
					$where.=" and monthly_payment_target.month LIKE '%".$_POST['month']."%'";
				}
				
			}
		//$sql = "SELECT * FROM streets";
 $sql="SELECT * FROM monthly_payment_target $where"; 
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	$this->render('target_list',array('streets'=>$result,'projects'=>$result_project));
	   }
	  	else{
			$this->redirect (array('user/user'));
  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	
		   
		//$this->render('target_list');
	}
		public function actionDaily_report()
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

		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$this->render('daily_report', array('pro'=>$result_projects));
	}
	public function actionDreportrereq()
	{
		$where="";
		$month='';
		$year='';
		
		$lastdate='';
		if(empty($_POST['mon']))
		{
				$where="Date_Format( Str_To_Date( paid_date, '%d-%m-%Y' ) , '%Y-%m-%d' )  BETWEEN  '".date('Y-m-01')."' and '".date('Y-m-d')."'"; 
				
			}
			else if(!empty($_POST['mon'])) {
				$connection = Yii::app()->db;
					$month=$_POST['mon'];
					$year=$_POST['year'];
				// $lastday= 'LAST_DAY("2017-01-18")';
					  $sqlld='SELECT LAST_DAY("'.$year.'-'.$month.'-28")';
					$resld = $connection->createCommand($sqlld)->queryRow();
				//   print_r($resld);
				foreach($resld as $last)
				{
				$lastdate=$last[8];	
				$lastdate=$last[9];	
				
				}
				
				 			
				
				
				//echo $resld;exit;
				
				  $where="Date_Format( Str_To_Date( paid_date, '%d-%m-%Y' ) , '%Y-%m-%d' )  BETWEEN  '".date(''.$year.'-'.$month.'-01')."' and '".date(''.$year.'-'.$month.'-'.$last[8].$last[9].'')."'";

				  $where1="Date_Format( Str_To_Date( date, '%d-%m-%Y' ) , '%Y-%m-%d' )  BETWEEN  '".date(''.$year.'-'.$month.'-01')."' and '".date(''.$year.'-'.$month.'-'.$last[8].$last[9].'')."'";
			}
		$connection = Yii::app()->db;
//	    $sql_re  = "SELECT paid_date,SUM(installpayment.paidamount) as paidamount,SUM(plotpayment.paidamount) as //msamount from installpayment
	//  Left join plots on(installpayment.plot_id=plots.id)
	// Left join plotpayment on(plotpayment.plot_id=plots.id)
	  
	//where $where and plots.project_id='".$_POST['project_id']."' 
	//GROUP BY paid_date ORDER BY paid_date"; 
	//echo $sql_re; exit;
	//$result_re = $connection->createCommand($sql_re)->queryAll();
	//echo  "sdfsdf"; exit;
$sqlinst = "SELECT paid_date,SUM(installpayment.paidamount) as paidamount from installpayment Left join plots on(installpayment.plot_id=plots.id) where $where and plots.project_id='".$_POST['project_id']."' GROUP BY paid_date ORDER BY paid_date";
	$result_inst = $connection->createCommand($sqlinst)->queryAll();
	//echo  $sqlinst; exit;

$sqlcharges = "SELECT date,SUM(plotpayment.paidamount) as msamount from plotpayment Left join plots on(plotpayment.plot_id=plots.id) where $where1 and plots.project_id='".$_POST['project_id']."' GROUP BY date ORDER BY date";
	$result_charges = $connection->createCommand($sqlcharges)->queryAll();

$result_re=array();
for($i = 0; $i<intval($last[8].$last[9]); $i++)
{
 $instamount = 0;
 $chargesamount = 0;
 $d = $i+1;
 $m = $month;

 for($r=0; $r< count($result_inst); $r++)
 {
  if($result_inst[$r]["paid_date"] == str_pad($d, 2, "0", STR_PAD_LEFT)."-".$m."-".$year)
  {
   $instamount = $result_inst[$r]["paidamount"];
  }
 }
 for($r=0; $r< count($result_charges); $r++)
 {
  if($result_charges[$r]["date"] == str_pad($d, 2, "0", STR_PAD_LEFT)."-".$m."-".$year)
  {
   $chargesamount = $result_charges[$r]["msamount"];
  }
 }

 $date = date("Y-m-d", strtotime($year.'-'.$m.'-'.$d));
 $result_re[] = array("paid_date" => $date, "paidamount" => $instamount, "msamount" => $chargesamount);
}

	$i=0;
	$totalch=0;
	$totalins=0;
	$totalopayment=0;
	$tinsms=0;
	foreach($result_re as $row){
		$i=$i+1;
		$totalopayment=$row['paidamount']+$row['msamount'];
		//if($row['submitdate']=='0000-00-00'){$row['submitdate']='';}else{$row['submitdate']=date("d-m-Y", strtotime($row['submitdate'] ));}
//		if($row['clrdate']=='0000-00-00'){$row['clrdate']='';}else{$row['clrdate']=date("d-m-Y", strtotime($row['clrdate'] ));}
		echo '<tr>
		  <td>'.$i.'</td>
		  <td>'.$row['paid_date'].'</td>
		  <td style="text-align:right;">'.(number_format($row['msamount'])).'</td>
		  <td style="text-align:right;">'.(number_format($row['paidamount'])).'</td>
		   <td style="text-align:right;"><strong>'.(number_format($totalopayment)).'</strong></td>
		   <td></td>
		   </tr>';
			$totalins=$row['paidamount']+$totalins;
			$totalch=$row['msamount']+$totalch;
			$tinsms=$totalopayment+$tinsms;

		  
	$mon='';
		}
		 if(empty($_POST['mon']))
		{
		$mon=date('m');	
		}else
		{
			$mon=$_POST['mon'];
		}
		$connection = Yii::app()->db;
		$sql_month="SELECT * from monthly_payment_target where month='".$mon."' and year='".$_POST['year']."'";
		$res_month=$connection->createcommand($sql_month)->queryAll();
			
			
		  echo '<tr style="font-size:15"><td colspan="2"><strong>Total Amount</strong></td><td style="text-align:right;"><strong>'.number_format($totalch).'</strong></td><td style="text-align:right;"><strong>'.number_format($totalins).'</strong></td><td style="text-align:right;"><strong>'.number_format($tinsms).'</strong></td>';
		  foreach($res_month as $mo){
echo'<td><strong style="color:red;">Target:'.$mo['target'].'</strong></td>'; }?>
		    </tr>
               <tr>
				   
                   <td colspan="6" >
                   <table width="100%">
				
                    <tr id="chart_div" style="height: 300px;"><td>
				
                <script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() { 
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
      	   ['Month', 'Total Payment'],
		<?php 
		  foreach ($result_re as $row1) {
			  $totalopayment=$row1['paidamount']+$row1['msamount'];
			  echo '[\''.$row1['paid_date']; ?>',
		 <?php echo $totalopayment .'],'; }?>
		       
		 
		      ]);
 
    var options = {
      title : 'Monthly  Total Payment',
      vAxis: {title: 'Payment'},
      hAxis: {title: 'Month'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }

</script>
				
				
				
	
                    
                     <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 
                
							</td>
                        </tr>
                       </table></td></tr>
                     
                       
                       
		 	<?php }
		
		public function actionMonthly_report()
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

		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$this->render('monthly_report', array('pro'=>$result_projects));
	}
	public function actionMreportrereq()
	{
		$where1="";
		$where="";
		$month='';
		$year='';
		
		$lastdate='';
		if(empty($_POST['year']))
		{
				 $where="paid_date BETWEEN  '".date('01-m-Y')."' and '".date('d-m-Y')."'"; 
				
		}
			else if(!empty($_POST['year'])) {
				$connection = Yii::app()->db;
				
					$year=$_POST['year'];
				   $where="`paid_date` BETWEEN '01-01-$year' AND '31-12-$year'";
				//  $where1="BETWEEN  '".date(''.$year.'-'.$month)."' and '".date(''.$year.'-'.$month)."'";
			}
		$connection = Yii::app()->db;
 /*$sqlinst12 = "SELECT MONTH(paid_date) as tmonth,SUM(installpayment.paidamount) as paidamount from installpayment Left join plots on(installpayment.plot_id=plots.id) where $where  plots.project_id='".$_POST['project_id']."' GROUP BY tmonth ORDER BY paid_date";
	$result_inst12 = $connection->createCommand($sqlinst)->queryAll();
*/	
//
$sqlinst="SELECT MONTHNAME(paid_date) as month, SUM(paidamount) as insamount 
FROM installpayment
Left join plots on(installpayment.plot_id=plots.id)
where MONTHNAME(paid_date) !='' and $where and plots.project_id='".$_POST['project_id']."'
GROUP BY YEAR(paid_date) and MONTH(paid_date)";
$result_inst = $connection->createCommand($sqlinst)->queryAll();
//echo  $sqlinst; exit;
$sqlcharges = "SELECT MONTH(date),SUM(plotpayment.paidamount) as msamount from plotpayment Left join plots on(plotpayment.plot_id=plots.id) where $where1  plots.project_id='".$_POST['project_id']."' GROUP BY date ORDER BY date";
	$result_charges = $connection->createCommand($sqlcharges)->queryAll();


/*for($i = 0; $i<intval($last[8].$last[9]); $i++)
{*/
 $instamount = 0;
 $chargesamount = 0;
 //$d = $i+1;
 $m = $month;

 for($r=0; $r< count($result_inst); $r++)
 {
  

  /*if($result_inst[$r]["tmonth"] == str_pad($m, 2, "0", STR_PAD_LEFT)."-".$m."-".$year)
  {
   $instamount = $result_inst[$r]["paidamount"];
 }*/
 }
 /*for($r=0; $r< count($result_charges); $r++)
 {
  if($result_charges[$r]["date"] == str_pad($d, 2, "0", STR_PAD_LEFT)."-".$m."-".$year)
  {
   $chargesamount = $result_charges[$r]["msamount"];
  }
 }*/

 //$date = date("Y-m-d", strtotime($year.'-'.$m.'-'.$d));
 $result_re[] = array("paidamount" => $instamount);
//}


	$i=0;
	$totalch=0;
	$totalins=0;
	$totalopayment=0;
	$tinsms=0;
	foreach($result_inst as $row){
		$i=$i+1;
		//$totalopayment=$row['paidamount']+$row['msamount'];
	
/*for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));*/
     echo '<tr><td>'.$row['month'].'</td>
	   <td></td><td>'.$row['insamount'].'</td>
	 </tr>';
   //  }
			//$totalins=$row['paidamount']+$totalins;
		//	$totalch=$row['msamount']+$totalch;
		//$tinsms=$totalopayment+$tinsms;

		  
//	$mon='';
		}
		/* if(empty($_POST['mon']))
		{
		$mon=date('m');	
		}else
		{
			$mon=$_POST['mon'];
		}
		$connection = Yii::app()->db;
		$sql_month="SELECT * from monthly_payment_target where month='".$mon."' and year='".$_POST['year']."'";
		$res_month=$connection->createcommand($sql_month)->queryAll();
	*/		
			
		  echo '<tr style="font-size:15"><td colspan="2"><strong>Total Amount</strong></td><td style="text-align:right;"><strong></strong></td><td style="text-align:right;"><strong></strong></td><td style="text-align:right;"><strong></strong></td>';
		//  foreach($res_month as $mo){
//}?>
		    </tr>
             
                     
                       
                       
		 	<?php }
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function actionReport()
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

		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$this->render('reportre', array('pro'=>$result_projects));
	}
	public function actionReportrereq()
	{
		$where='';
		if($_POST['status']==1){$where='receipt.sc_id='.Yii::app()->session['user_array']['sc_id'].' and';}
		$connection = Yii::app()->db;
	 $sql_re  = "SELECT *,
	receipt.id as rptid, receipt.create_date as rcd,members.name as memname
	 FROM rpt_print
	Left join receipt on(receipt.id=rpt_print.rid)
	Left join members on(receipt.mem_id=members.id)
	Left join memberplot on(rpt_print.msid=memberplot.plot_id)
	Left join plots on(memberplot.plot_id=plots.id)
	Left join bank on(rpt_print.bank_details=bank.id)
	where ".$where." rpt_print.rid>0 and receipt.create_date BETWEEN '".$_POST['datefrom']."' and '".$_POST['dateto']."' and plots.project_id ='".$_POST['project_id']."' order by rcd,r_no";
	$result_re = $connection->createCommand($sql_re)->queryAll();
	$i=0;
	$totalch=0;
	$totalins=0;
	foreach($result_re as $row){
		$i=$i+1;
		if($row['submitdate']=='0000-00-00'){$row['submitdate']='';}else{$row['submitdate']=date("d-m-Y", strtotime($row['submitdate'] ));}
		if($row['clrdate']=='0000-00-00'){$row['clrdate']='';}else{$row['clrdate']=date("d-m-Y", strtotime($row['clrdate'] ));}
		echo '<tr>
		  <td>'.$i.'</td>
		  <td>'.date("d-m-Y", strtotime($row['rcd'] )).'</td>
		  <td>'.$row['memname'].'</td>
		  <td><b>'.$row['r_no'].'</b></td>	 
		  <td>';

if($row['plotno']==''){echo 'Form #: '.$row['app_no'];}else{echo $row['plotno'];}

echo '</td>';
		 $sql_pay  = "SELECT * from plotpayment where r_id='".$row['rptid']."'";
		$result_pay = $connection->createCommand($sql_pay)->queryAll(); 
		 $sql_inst  = "SELECT * from installpayment where r_id='".$row['rptid']."'";
		$result_inst = $connection->createCommand($sql_inst)->queryAll(); 
		$install=0;
		$charge=0;
		//$booking=0;
		foreach($result_inst as $ch){
		   	$install=$install+$ch['paidamount'];
			$totalins=$totalins+$ch['paidamount'];
		}
		foreach($result_pay as $ch1){
			$totalch=$totalch+$ch1['paidamount'];
			$charge=$charge+$ch1['paidamount'];}
		
		  echo '<td style="text-align:right;">'.number_format($install).'</td>
		  <td style="text-align:right;">'.number_format($charge).'</td>
		  <td>'.$row['ref_no'].'</td>
		  <td>'.date("d-m-Y", strtotime($row['date'] )).'</td>
		  <td>'.$row['code'].'</td>
		  <td>'.$row['slipno'].'</td>
		  <td>'.$row['submitdate'] .'</td>
		  <td>'.$row['clrdate'] .'</td>
		  <td>'.$row['comm'].'</td>
		  </tr>
		  ';
	
		}
		  echo '<tr><td colspan="5" style="text-align:right;"> Total</td><td style="text-align:right;">'.number_format($totalins).'</td><td style="text-align:right;">'.number_format($totalch).'</td><td colspan="7"></td></tr>';
		  		  echo '<tr><td colspan="5" style="text-align:right;">Grand Total</td><td colspan="2" style="text-align:right;">'.number_format($totalins+$totalch).'</td><td colspan="7"></td></tr>';
	}
	public function actionGenraterec()
	{
		//echo date('Y-m-d');
		$this->render('recieptg');
	}
public function actionUpdaterecieptotherms()
	{
		
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('recieptupdateotherms', array('data'=>$result_data));
	}
	public function actionGensub1()
	{
		
			$connection = Yii::app()->db;
			//$r  = "SELECT * FROM rpt_print where jvno='".$_POST['rno']."'";
			//$result_r = $connection->createCommand($r)->queryRow();
			$error='';
			//echo count($result_r);exit;
			if($_POST['rno']== ''){
				$error='Please Provide JV No';
			}

			//if(isset($_POST['rno'])){
			//if(count($result_r)>1){
				//$error .='Please Provide Unique Receipt No. '.$_POST['rno'].' already Exist</br>';
				//}
			//}
			if($error==''){		
				$sql="INSERT into rpt_print SET jvno='".$_POST['rno']."',mem_id='".$_POST['mem_id']."',msid='".$_POST['plots1']."' ,create_date='".date('Y-m-d')."'";	 
        		$command = $connection -> createCommand($sql);
                $command -> execute();	
			}
			else{echo $error;exit;}
			echo 'Inserted';
echo '<script>location.href="account?mid='.$_POST['mem_id'].'";</script>';exit;

				
	}
	public function actionGensub()
	{
		
			$connection = Yii::app()->db;
			$r  = "SELECT * FROM receipt where id='".$_POST['rid']."'";
			$result_r = $connection->createCommand($r)->queryRow();
			$error='';
			$sql_plot12  = "
			SELECT plot_id FROM installpayment where r_id='".$_POST['rid']."'
			UNION DISTINCT 
			SELECT plot_id FROM plotpayment where r_id='".$_POST['rid']."'";
			$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
			$error='';
			foreach($result_plots12 as $new){
			if(isset($_POST[$new['plot_id']]) and $_POST[$new['plot_id']]==''){
				$error='Please Provide Receipt # for all Receipt ';
			}
			}
			foreach($result_plots12 as $new){
				if(isset($_POST[$new['plot_id']])){
			$sql_re  = "SELECT * FROM rpt_print where r_no='".$_POST[$new['plot_id']]."'";
			$result_re = $connection->createCommand($sql_re)->queryAll();
			if(count($result_re)>0){
				$error .='Please Provide Unique Receipt No. '.$_POST[$new['plot_id']].' already Exist</br>';
				}
			}
			}
			if($error==''){
			foreach($result_plots12 as $new){
				if(isset($_POST[$new['plot_id']])){
			if($result_r['print']==''){					
				$sql="INSERT into rpt_print SET msid='".$new['plot_id']."',
				rid='".$_POST['rid']."',r_no='".$_POST[$new['plot_id']]."',create_date='".date('Y-m-d')."'";	 
        		$command = $connection -> createCommand($sql);
                $command -> execute();	
			}else{

				 $r1  = "SELECT * FROM rpt_print where msid='".$new['plot_id']."' and rid='".$_POST['rid']."'";
				$result_r1 = $connection->createCommand($r1)->queryRow();
				//echo count($result_r1);exit;
				if(count($result_r1) == 1){
					
				$sql="INSERT into rpt_print SET msid='".$new['plot_id']."',
				rid='".$_POST['rid']."',r_no='".$_POST[$new['plot_id']]."',create_date='".date('Y-m-d')."'";	 
				$command = $connection -> createCommand($sql);
                $command -> execute();
				}
				if(count($result_r1) > 1){
				$sql="Update rpt_print SET r_no='".$_POST[$new['plot_id']]."' where msid='".$new['plot_id']."' and rid='".$_POST['rid']."'";	
        		$command = $connection -> createCommand($sql);
                $command -> execute();
				}
				}
				}
				}
				$sql1="Update receipt SET print=1 where id='".$_POST['rid']."'";	 
        		$command = $connection -> createCommand($sql1);
                $command -> execute(); 
				echo 'Updated';
				echo '<script>location.href="Updatereciept?id='.$_POST['rid'].'";</script>';exit;
				}else{echo $error;}
				
	}
	public function actionDeleteinstru()
	{
			 
			 $connection = Yii::app()->db;
 			
			$sql_delete = 'DELETE FROM receipt WHERE id='.$_REQUEST['id'];	
			$command = $connection -> createCommand($sql_delete);
    	    $command -> execute();
$sql_delete1 = 'DELETE FROM rpt_print WHERE rid='.$_REQUEST['id'];	
			$command = $connection -> createCommand($sql_delete1);
    	    $command -> execute();

			$sql1="UPDATE plotpayment SET `paidamount`='',`surcharge`='',`paidsurcharge`='', `paidas`='',`r_id`='',`detail`='',`date`='',`remarks`=''
			where r_id='".$_REQUEST['id']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
			 
			 $sql1="UPDATE installpayment SET `paidamount`='',`surcharge`='',`paidsurcharge`='', `paidas`='',`r_id`='',`detail`='',`paid_date`='',`remarks`='' where r_id='".$_REQUEST['id']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
			
			$this->redirect(array('reciept/reciept_lis'));
			 }
	public function actionDeletechar()
	{
			 $connection = Yii::app()->db;
			 $sql_ref  = "Select * from plotpayment where id='".$_REQUEST['id']."'";
			 $result_ref = $connection->createCommand($sql_ref)->queryRow();	
$sql_ref1  = "Select * from installpayment where r_id='".$_REQUEST['rid']."' and plot_id='".$result_ref['plot_id']."'";
			 $result_ref1 = $connection->createCommand($sql_ref1)->queryAll();
$sql_ref2  = "Select * from plotpayment where r_id='".$_REQUEST['rid']."' and plot_id='".$result_ref['plot_id']."'";
			 $result_ref2 = $connection->createCommand($sql_ref2)->queryAll();
//print_r($result_ref1);
//print_R($result_ref2);
//echo (count($result_ref1)+count($result_ref2)); exit;
if((count($result_ref1)+count($result_ref2))==1){
			$sql_delete1 = 'DELETE FROM rpt_print WHERE msid="'.$result_ref['plot_id'].'" and rid='.$_REQUEST['rid'];	
			$command = $connection -> createCommand($sql_delete1);
    	    $command -> execute();
}
			 
if($result_ref['ref'] > 0){
			 $sql_delete = 'DELETE FROM plotpayment WHERE id='.$_REQUEST['id'];	
			 $command = $connection -> createCommand($sql_delete);
			 $command -> execute();
			}else{	 
			$sql1="UPDATE plotpayment SET `paidamount`='',`surcharge`='',`paidsurcharge`='', `paidas`='',`r_id`='',`detail`='',`date`='',`remarks`=''
			where id='".$_REQUEST['id']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
	}
			$this->redirect(array('reciept/Updatereciept?id='.$_REQUEST['rid']));
	}
	public function actionDeleteins()
	{
			 $connection = Yii::app()->db;	

			 $sql_ref  = "Select * from installpayment where id='".$_REQUEST['id']."'";
			 $result_ref = $connection->createCommand($sql_ref)->queryRow();	
$sql_ref1  = "Select * from installpayment where r_id='".$_REQUEST['rid']."' and plot_id='".$result_ref['plot_id']."'";
			 $result_ref1 = $connection->createCommand($sql_ref1)->queryAll();
$sql_ref2  = "Select * from plotpayment where r_id='".$_REQUEST['rid']."' and plot_id='".$result_ref['plot_id']."'";
			 $result_ref2 = $connection->createCommand($sql_ref2)->queryAll();
//print_r($result_ref1);
//print_R($result_ref2);
//echo (count($result_ref1)+count($result_ref2)); exit;
if((count($result_ref1)+count($result_ref2))==1){
			$sql_delete1 = 'DELETE FROM rpt_print WHERE msid="'.$result_ref['plot_id'].'" and rid='.$_REQUEST['rid'];	
			$command = $connection -> createCommand($sql_delete1);
    	    $command -> execute();
}
if($result_ref['ref'] > 0){
			$sql_delete = 'DELETE FROM installpayment WHERE id='.$_REQUEST['id'];	
			$command = $connection -> createCommand($sql_delete);
    	    $command -> execute();
	}else{
			 $sql1="UPDATE installpayment SET `paidamount`='',`surcharge`='',`paidsurcharge`='', `paidas`='',`r_id`='',`detail`='',`paid_date`='',`remarks`=''
			where id='".$_REQUEST['id']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();}
			$this->redirect(array('reciept/Updatereciept?id='.$_REQUEST['rid']));
	}
public function actionOthermemberid($val1)
	{
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from members where members.cnic='".$val1."' ";

		$result_plots = $connection->createCommand($sql_plot)->queryRow();
		echo $result_plots['id'];exit;
	}
	public function actionDeletechard()
	{
			 $connection = Yii::app()->db;
			 $sql_ref  = "Select * from plotpayment where id='".$_REQUEST['id']."'";
			 $result_ref = $connection->createCommand($sql_ref)->queryRow();	
			 if($result_ref['ref'] > 0){
			 $sql_delete = 'DELETE FROM plotpayment WHERE id='.$_REQUEST['id'];	
			 $command = $connection -> createCommand($sql_delete);
			 $command -> execute();
			}else{	 
			$sql1="UPDATE plotpayment SET `paidamount`='',`surcharge`='',`paidsurcharge`='', `paidas`='',`re_id`='',`detail`='',`date`='',`remarks`=''
			where id='".$_REQUEST['id']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
	}
			$this->redirect(array('reciept/addreciept?id='.$_REQUEST['rid'].'&&mid='.$_REQUEST['mid']));
	}
	public function actionDeleteinsd()
	{
			 $connection = Yii::app()->db;	

			 $sql_ref  = "Select * from installpayment where id='".$_REQUEST['id']."'";
			 $result_ref = $connection->createCommand($sql_ref)->queryRow();	
if($result_ref['ref'] > 0){
			$sql_delete = 'DELETE FROM installpayment WHERE id='.$_REQUEST['id'];	
			$command = $connection -> createCommand($sql_delete);
    	    $command -> execute();
	}else{
			 $sql1="UPDATE installpayment SET `paidamount`='',`surcharge`='',`paidsurcharge`='', `paidas`='',`re_id`='',`detail`='',`paid_date`='',`remarks`=''
			where id='".$_REQUEST['id']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();}
			$this->redirect(array('reciept/addreciept?id='.$_REQUEST['rid'].'&&mid='.$_REQUEST['mid']));
	}
	public function actionReciept()
	{
			$layout='//layouts/column1';
			$this->render('reciept');
	}
	public function actionVarification()
	{
		
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,bank.name as bname,members.id as mid,members.name as mname,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			 Left join bank on (receipt.bank_details=bank.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('varification', array('data'=>$result_data));
	}
	public function actionReadmin()
	{         if(isset(Yii::app()->session['user_array']['username']))
			{
		
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('readmin', array('data'=>$result_data));
			}else{
			    	$this->redirect(array('user/user'));
			    
			}
	}
	public function actionVarificationsales()
	{ 
	    		if(isset(Yii::app()->session['user_array']['username']))
		{
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,bank.name as bname,members.id as mid,members.name as mname,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			 Left join bank on (receipt.bank_details=bank.id)
			  where receipt.id='".$_REQUEST['id']."'";  
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('varificationsales', array('data'=>$result_data));
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
public function actionPrint()
	{
	    	if(isset(Yii::app()->session['user_array']['username']))
			{
			$this->layout='//layouts/print';
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.create_date as rcd,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			 $result_data = $connection->createCommand($sql)->queryRow();  
			 $this->render('print', array('data'=>$result_data));}
			 else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionUpdatereciept()
	{
		if(isset(Yii::app()->session['user_array']['username']))
{
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.create_date as mcd,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('recieptupdate', array('data'=>$result_data));
}else{
    $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
}
	}
	public function actionAccount()
	{
			if(isset(Yii::app()->session['user_array']['username']))
{
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			 where receipt.mem_id='".$_REQUEST['mid']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('account', array('data'=>$result_data));
}else{
    $this->redirect('dashboard');
}
	}
	public function actionAddreciept()
	{
		
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where members.id='".$_REQUEST['mid']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('addreciept', array('data'=>$result_data));
	}
	public function actionUpdaterecieptd()
	{
		
			 $connection = Yii::app()->db;
			 $sql ="SELECT *,members.id as mid,receipt.id as rid from receipt 
			 Left join members on (receipt.mem_id=members.id)
			  where receipt.id='".$_REQUEST['id']."'"; 
			$result_data = $connection->createCommand($sql)->queryRow();  
			$layout='//layouts/column1';
			$this->render('recieptupdated', array('data'=>$result_data));
	}
	
	public function actionCreatere()
	{
			
		    $error ='';
	   
									  $connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 $uid=Yii::app()->session['user_array']['id'];
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
									  $user ="SELECT * from user where id='".$uid."'"; 
									  $result_user = $connection->createCommand($user)->queryRow();
									if ((isset($_POST['amount']) && empty($_POST['amount']))){$error .="Amount required. <br>";}  
									if ((isset($_POST['ref']) && empty($_POST['ref']))){$error .="Ref required. <br>";}  
									if ((isset($_POST['fromdate']) && empty($_POST['fromdate']))){$error .="Date required. <br>";}  
									if ((isset($base) && empty($base))){
									 $error .="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error .='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }
										if(!empty($error)){
											echo $error;exit;
											}else{
                                        $transferto_memberid = $result_data['id'];
$ne='';
$newDate = date("Y-m-d", strtotime($_POST['fromdate'] ));
if(isset($_POST['ifd'])){$ne=",`typed`='".$_POST['ifd']."'";}
$sql="INSERT into receipt SET mem_id='".$result_data['id']."',type='".$_POST['type']."',ref_no='".$_POST['ref']."',amount='".$_POST['amount']."',`date`='".$newDate."' ".$ne.", create_date='".date('Y-m-d')."',sc_id='".$result_user['sc_id']."', user='".$uid."'";	 
        		   					 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
									 $id=Yii::app()->db->getLastInsertID();
									 echo "Insert Successfully ";
if(isset($_POST['ifd'])){echo '<script>location.href="Updaterecieptd?id='.$id.'";</script>';}else{									 
echo '<script>location.href="Updatereciept?id='.$id.'";</script>';}exit;
									}
			}
	public function actionReciept_lis()
	{
		if(isset(Yii::app()->session['user_array']['username']))

			{
			$plotno='';

			$st='';

			$pro='';

			$sector='';
			$size='';

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

    , plots.plot_size

    , plots.com_res

	 , plots.size2
	

    , plots.rstatus

	, plots.sector

	, plots.category_id

	, plots.status

	, plots.plot_detail_address

	, memberplot.plotno
	, memberplot.create_date
	, memberplot.id as mp_id

    , projects.project_name

	, streets.street


	

FROM

    plots

    inner JOIN streets  ON (plots.street_id = streets.id)


	inner JOIN projects  ON (plots.project_id = projects.id)

	inner JOIN memberplot  ON (plots.id = memberplot.plot_id)

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

		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql_categories  = "SELECT * from categories";
		$categories = $connection->createCommand($sql_categories)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
		    $home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
            $res=array();
            foreach($result_members as $key){
            echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size2'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['rstatus'].'</td><td>';

			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['mp_id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('allotment_lis',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$result_projects,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));

			}else{
				$this->redirect(array('user/dashboard'));
				
				}

	   

	}
public function actionBin()
{
		if(isset(Yii::app()->session['user_array']['username']))

			{

			$this->render('bin');

			}else{
				$this->redirect(array('user/dashboard'));
				
				}

	   

	}
	
	public function actionBinreq()
{ 
			$and=false;
			$where='';	
		
		 if ( isset($_POST['datefrom']) &&  $_POST['datefrom']!="" && isset($_POST['dateto']) &&  $_POST['dateto']!=""){		
		 $from=date("Y-m-d", strtotime($_POST['datefrom']));
		$to=date("Y-m-d", strtotime($_POST['dateto']));		
				if ($and==true)
				{
				$where.="and receipt.create_date between '".$from."' and '".$to."'";
				}
				else
				{
					$where.="receipt.create_date between '".$from."' and '".$to."'";
				}
				$and=true;
			}	
			
				

		if (isset($_POST['ref_no']) && $_POST['ref_no']!=""){

				//$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and receipt.ref_no Like '%".$_POST['ref_no']."%'";

				}

				else

				{

					$where.=" receipt.ref_no Like '%".$_POST['ref_no']."%'";

				}

				$and=true;

			}
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				if ($and==true)
				{
					  $where.=" and m.cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" m.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			if (isset($_POST['scf']) && $_POST['scf']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.sc_id ='".$_POST['scf']."'";
				}
				else
				{
					$where.=" receipt.sc_id ='".$_POST['scf']."'";
				}
				$and=true;
			}
			if (isset($_POST['name']) && $_POST['name']!=""){

				if ($and==true)
				{
					  $where.=" and m.name like '%".$_POST['name']."%'";
				}
				else
				{
					$where.=" m.name like '%".$_POST['name']."%'";
				}
				$and=true;
			}
			if (isset($_POST['inid']) && $_POST['inid']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.id ='".$_POST['inid']."'";
				}
				else
				{
					$where.=" receipt.id ='".$_POST['inid']."'";
				}
				$and=true;
			}
			
			$co='';
			$filter='';
			$jo='';
		//echo $and;exit;
			if ($and==true){  
			
				
			$where .='AND receipt.print=0 and receipt.user='.Yii::app()->session['user_array']['id'];
			}else{   $where .='where receipt.print=0 and receipt.user='.Yii::app()->session['user_array']['id'];  
				}
				
			//$and=true;
			
			
			if ($and==true){$co='where';}
				
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
	  $sql_payment1  = "SELECT receipt.*,m.*,receipt.id as rid FROM receipt 
left join members m on receipt.mem_id=m.id

$co $where $filter";
//echo $sql_payment1;exit;
//echo 123;


		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
		$rows =count($result_payments1);
		//echo $rows;exit;
		$sql_payment  = "SELECT receipt.*,m.*,receipt.id as rid,m.cnic as mcnic,receipt.create_date as rcd FROM receipt 
left join members m on receipt.mem_id=m.id
$jo
$co 
$where $filter
order by receipt.create_date DESC,receipt.id DESC
limit $start,$limit
 ";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$sql_payments= $connection->createCommand($sql_payment)->query();
		
		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();
		

	$count=0;

	if ($sql_payments!=''){
	$home=Yii::app()->request->baseUrl; 
    $res=array();
	foreach($sql_payments as $key){
	$total=$key['amount'];	
	//if (isset($_POST['status1']) && $_POST['status1']==5){
	//	$total=0;
	//	$sql_ins  = "SELECT * from installpayment where r_id='".$key['rid']."' ";
	//	$result_ins = $connection->createCommand($sql_ins)->queryAll();
	//	$sql_plo  = "SELECT * from plotpayment where r_id='".$key['rid']."' ";
	//	$result_plo = $connection->createCommand($sql_plo)->queryAll();
	//	foreach($result_ins as $row){$total=$total+$row['paidamount'];}
	//	foreach($result_plo as $row1){$total=$total+$row1['paidamount'];}
	//	}	
	$connection = Yii::app()->db; 
 	$sql_payment2  = "SELECT * FROM rpt_print where rid='".$key['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	  echo '<tr><td>';
  if($key['typed']==0){
  echo '<a  href="Updatereciept?id='.$key['rid'].'">'.$key['rid'].'</a>';
  }else{echo '<a  href="Updaterecieptd?id='.$key['rid'].'">'.$key['rid'].'</a>';}
  echo '</td><td>'.date("d-m-Y", strtotime($key['rcd'] )).'</td><td>'.$key['name'].'</td><td>'.$key['mcnic'].'</td><td style="text-align:right;">'.number_format($key['amount']).'</td><td>'.$key['ref_no'].'</td><td>'.$key['type'].'</td><td>'.$key['fstatus'].'</td>';
  echo '<td>';
  if(Yii::app()->session['user_array']['per9']==1){
  echo '<a  href="varification?id='.$key['rid'].'">Finance Verify</a>';}
    if(Yii::app()->session['user_array']['per19']==1 ){
   echo '/<a  href="varificationsales?id='.$key['rid'].'">Sales Center</a>';}
	 if(Yii::app()->session['user_array']['per21']==1 ){
     echo '/<a  href="readmin?id='.$key['rid'].'">Receipt Admin</a>';}
   
echo '</td>';?>
<?php 
$color='';
if($key['enableedit']=='1'){$color='red';}else{$color='';}
  echo '<td style="background-color:'.$color.';  "><a href="print?id='.$key['rid'].'">'.count($result_payments2).'</a></td></tr>';
	}

			}else{echo exit;}
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
/*public function actionBinreq()
{
			$and='';	
		
		 if ( isset($_POST['datefrom']) &&  $_POST['datefrom']!="" && isset($_POST['dateto']) &&  $_POST['dateto']!=""){		
		 $from=date("Y-m-d", strtotime($_POST['datefrom']));
		$to=date("Y-m-d", strtotime($_POST['dateto']));		
				if ($and==true)
				{
				$where.="and receipt.create_date between '".$from."' and '".$to."'";
				}
				else
				{
					$where.="receipt.create_date between '".$from."' and '".$to."'";
				}
				$and=true;
			}	
			
				

		if (isset($_POST['ref_no']) && $_POST['ref_no']!=""){

				//$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and receipt.ref_no Like '%".$_POST['ref_no']."%'";

				}

				else

				{

					$where.=" receipt.ref_no Like '%".$_POST['ref_no']."%'";

				}

				$and=true;

			}
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				if ($and==true)
				{
					  $where.=" and m.cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" m.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			if (isset($_POST['scf']) && $_POST['scf']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.sc_id ='".$_POST['scf']."'";
				}
				else
				{
					$where.=" receipt.sc_id ='".$_POST['scf']."'";
				}
				$and=true;
			}
			if (isset($_POST['name']) && $_POST['name']!=""){

				if ($and==true)
				{
					  $where.=" and m.name like '%".$_POST['name']."%'";
				}
				else
				{
					$where.=" m.name like '%".$_POST['name']."%'";
				}
				$and=true;
			}
			if (isset($_POST['inid']) && $_POST['inid']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.id ='".$_POST['inid']."'";
				}
				else
				{
					$where.=" receipt.id ='".$_POST['inid']."'";
				}
				$and=true;
			}
			
			$co='';
			$filter='';
			$jo='';
			
			if ($and==true){	
			$where .=' and receipt.print=0 and receipt.user='.Yii::app()->session['user_array']['id'];	
			}else{$where .='receipt.print=0 and receipt.user='.Yii::app()->session['user_array']['id'];	}
			$and=true;
			
			if ($and==true){$co='where';}
			
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
	$sql_payment1  = "SELECT receipt.*,m.*,receipt.id as rid FROM receipt 
left join members m on receipt.mem_id=m.id

$co $where $filter";//echo 123;exit;

		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
		$rows =count($result_payments1);
		echo $sql_payment  = "SELECT receipt.*,m.*,receipt.id as rid,m.cnic as mcnic,receipt.create_date as rcd FROM receipt 
left join members m on receipt.mem_id=m.id
$jo
$co 
$where $filter
order by receipt.create_date DESC,receipt.id DESC
limit $start,$limit
 ";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$sql_payments= $connection->createCommand($sql_payment)->query();
		
		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();
		

	$count=0;

	if ($sql_payments!=''){
	$home=Yii::app()->request->baseUrl; 
    $res=array();
	foreach($sql_payments as $key){
	$total=$key['amount'];	
	//if (isset($_POST['status1']) && $_POST['status1']==5){
	//	$total=0;
	//	$sql_ins  = "SELECT * from installpayment where r_id='".$key['rid']."' ";
	//	$result_ins = $connection->createCommand($sql_ins)->queryAll();
	//	$sql_plo  = "SELECT * from plotpayment where r_id='".$key['rid']."' ";
	//	$result_plo = $connection->createCommand($sql_plo)->queryAll();
	//	foreach($result_ins as $row){$total=$total+$row['paidamount'];}
	//	foreach($result_plo as $row1){$total=$total+$row1['paidamount'];}
	//	}	
	$connection = Yii::app()->db; 
 	$sql_payment2  = "SELECT * FROM rpt_print where rid='".$key['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	  echo '<tr><td>';
  if($key['typed']==0){
  echo '<a  href="Updatereciept?id='.$key['rid'].'">'.$key['rid'].'</a>';
  }else{echo '<a  href="Updaterecieptd?id='.$key['rid'].'">'.$key['rid'].'</a>';}
  echo '</td><td>'.date("d-m-Y", strtotime($key['rcd'] )).'</td><td>'.$key['name'].'</td><td>'.$key['mcnic'].'</td><td style="text-align:right;">'.number_format($key['amount']).'</td><td>'.$key['ref_no'].'</td><td>'.$key['type'].'</td><td>'.$key['fstatus'].'</td>';
  echo '<td>';
  if(Yii::app()->session['user_array']['per9']==1){
  echo '<a  href="varification?id='.$key['rid'].'">Finance Verify</a>';}
    if(Yii::app()->session['user_array']['per19']==1 ){
   echo '/<a  href="varificationsales?id='.$key['rid'].'">Sales Center</a>';}
	 if(Yii::app()->session['user_array']['per21']==1 ){
     echo '/<a  href="readmin?id='.$key['rid'].'">Receipt Admin</a>';}
   
echo '</td>';?>
<?php 
$color='';
if($key['enableedit']=='1'){$color='red';}else{$color='';}
  echo '<td style="background-color:'.$color.';  "><a href="print?id='.$key['rid'].'">'.count($result_payments2).'</a></td></tr>';
	}

			}else{echo exit;}
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



	}*/
	public function actionDealers()
	{
	if(isset(Yii::app()->session['user_array']['username'])){
			$this->render('dealersacc');
			}else{
				$this->redirect(array('user/dashboard'));
				
				}

	   

	}
/*	public function actionUpdate_charges()
    {

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per2']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
			
		 $sql_payment  = "SELECT * FROM plotpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

			$sql_charges  = "SELECT * from charges ";

			$result_charges = $connection->createCommand($sql_charges)->query();

			
		$this->render('update_charges',array('charges'=>$result_charges,'payments'=>$result_payments));


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
*/
	public function actionInstallment_update()
    {

		if(Yii::app()->session['user_array']['per2']=='1'&& Yii::app()->session['user_array']['per2']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
 $sql_payment  = "SELECT * FROM installpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

	$this->render('installment_update',array('payments'=>$result_payments));

	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionAllotmentreq()
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
$prooo='';$pos=0;
foreach($result_projects as $pro){
if($pos==0){$prooo .=$pro['id'];}else{
$prooo .=','.$pro['id'];}
$pos=$pos+1;
}
//echo $prooo;
		
		$where='';

$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and p.project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.=" p.project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}else{
if ($and==true)
				{
					$where.=" and p.project_id IN (".$prooo.")";
				}
				else
				{
					$where.=" p.project_id IN (".$prooo.")";
				}
				$and=true;

}
if ( isset($_POST['reno']) &&  $_POST['reno']!=""){				
				if ($and==true)
				{
					$where.=" and rpt_print.r_no ='".$_POST['reno']."'";
				}
				else
				{
					$where.=" rpt_print.r_no = '".$_POST['reno']."'";
				}
				$and=true;
			}
		 if ( isset($_POST['typed']) &&  $_POST['typed']!=""){				
				if ($and==true)
				{
				$where.="and receipt.typed = '".$_POST['typed']."'";
				}
				else
				{
					$where.="receipt.typed = '".$_POST['typed']."'";
				}
				$and=true;
			}
		 if ( isset($_POST['type']) &&  $_POST['type']!=""){				
				if ($and==true)
				{
				$where.="and receipt.type LIKE '%".$_POST['type']."%'";
				}
				else
				{
					$where.="receipt.type LIKE '%".$_POST['type']."%'";
				}
				$and=true;
			}
		
		 if ( isset($_POST['datefrom']) &&  $_POST['datefrom']!="" && isset($_POST['dateto']) &&  $_POST['dateto']!=""){		
		 $from=date("Y-m-d", strtotime($_POST['datefrom']));
		$to=date("Y-m-d", strtotime($_POST['dateto']));		
				if ($and==true)
				{
				$where.="and receipt.create_date between '".$from."' and '".$to."'";
				}
				else
				{
					$where.="receipt.create_date between '".$from."' and '".$to."'";
				}
				$and=true;
			}	
			
				

		if (isset($_POST['ref_no']) && $_POST['ref_no']!=""){

				//$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and receipt.ref_no Like '%".$_POST['ref_no']."%'";

				}

				else

				{

					$where.=" receipt.ref_no Like '%".$_POST['ref_no']."%'";

				}

				$and=true;

			}
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				if ($and==true)
				{
					  $where.=" and m.cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" m.cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			if (isset($_POST['scf']) && $_POST['scf']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.sc_id ='".$_POST['scf']."'";
				}
				else
				{
					$where.=" receipt.sc_id ='".$_POST['scf']."'";
				}
				$and=true;
			}
			if (isset($_POST['name']) && $_POST['name']!=""){

				if ($and==true)
				{
					  $where.=" and m.name like '%".$_POST['name']."%'";
				}
				else
				{
					$where.=" m.name like '%".$_POST['name']."%'";
				}
				$and=true;
			}
			if (isset($_POST['filed']) && $_POST['filed']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.filed ='".$_POST['filed']."'";
				}
				else
				{
					$where.=" receipt.filed ='".$_POST['filed']."'";
				}
				$and=true;
			}
			if (isset($_POST['bank']) && $_POST['bank']!=""){

				if ($and==true)
				{
					  $where.=" and rpt_print.bank_details ='".$_POST['bank']."'";
				}
				else
				{
					$where.=" rpt_print.bank_details ='".$_POST['bank']."'";
				}
				$and=true;
			}
if (isset($_POST['slipno']) && $_POST['slipno']!=""){

				if ($and==true)
				{
					  $where.=" and rpt_print.slipno ='".$_POST['slipno']."'";
				}
				else
				{
					$where.=" rpt_print.slipno ='".$_POST['slipno']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['inid']) && $_POST['inid']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.id ='".$_POST['inid']."'";
				}
				else
				{
					$where.=" receipt.id ='".$_POST['inid']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['status']) && $_POST['status']!=""){

				if ($and==true)
				{
					  $where.=" and receipt.fstatus ='".$_POST['status']."'";
				}
				else
				{
					$where.=" receipt.fstatus ='".$_POST['status']."'";
				}
				$and=true;
			}
			
			if (isset($_POST['status1']) && $_POST['status1']!=""){
				
			if ($and==true){
				
				if ($_POST['status1']==1){$where.=" and receipt.bank_details !=''";}
				if ($_POST['status1']==2){$where.=" and receipt.bank_details =''";	}
				if ($_POST['status1']==5){$where.=" ";
				
				
				}
			}else{
			
				if ($_POST['status1']==1){$where.="  receipt.bank_details!=''";$and=true;}
				if ($_POST['status1']==2){$where.="  receipt.bank_details =''";$and=true;	}
				if ($_POST['status1']==5){$where.=" ";}
			}
			
				
			}
//print_r(Yii::app()->session['user_array']);exit;
			$co='';
			$filter='';
			$jo='';
			if(Yii::app()->session['user_array']['per18']==1 && Yii::app()->session['user_array']['per19']==0 && Yii::app()->session['user_array']['per20']==0 && Yii::app()->session['user_array']['per21']==0){
			
			if ($and==true){	
			$where .=' and receipt.user='.Yii::app()->session['user_array']['id'];	
			}else{ $where .=' receipt.user='.Yii::app()->session['user_array']['id'];	}
			$and=true;
			if (!isset($_POST['status1'])){	
			$where .=" and receipt.bank_details=''";	
			}
			}	
			if(Yii::app()->session['user_array']['per19']==1){
			if ($and==true){
			$where .=' and user.sc_id='.Yii::app()->session['user_array']['sc_id'];	
			}else{$where .=' user.sc_id='.Yii::app()->session['user_array']['sc_id'];}
			$jo='Left Join user on(receipt.user=user.id)';
			$and=true;
			if (!isset($_POST['status1'])){	
			$where .=" and receipt.bank_details=''";	
			}
			}
			if(Yii::app()->session['user_array']['per21']==1){
				if (!isset($_POST['filed'])){	
				if ($and==true){
				$where .=" and receipt.filed=0";	
				}else{$where .=" receipt.filed=0";	}
			$and=true;
			}
			}
			if(Yii::app()->session['user_array']['per9']==1){
			if (!isset($_POST['status'])){	
				if ($and==true){
				$where .=" and receipt.bank_details!='' and receipt.fstatus='' ";	
				}else{$where .=" receipt.bank_details!='' and receipt.fstatus='' ";}
			
			$and=true;

			}}
			
			if ($and==true){$co='where';}
			
			//for Pagination 
if(isset($_POST['limit']) && $_POST['limit']!==''){$limit = $_POST['limit'];}else{
$limit = 50;}
$adjacent = 50;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 

		$connection = Yii::app()->db; 
	 $sql_payment1  = "SELECT receipt.*,m.*,receipt.id as rid FROM receipt 
Inner join members m on receipt.mem_id=m.id
Inner join rpt_print on rpt_print.rid=receipt.id
Inner join plots p on rpt_print.msid=p.id 
$jo
$co $where $filter  group by rpt_print.rid
";

		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
		$rows =count($result_payments1);
	   $sql_payment  = "SELECT receipt.*,m.*,receipt.id as rid,m.cnic as mcnic,receipt.create_date as rcd FROM receipt 
Inner join members m on receipt.mem_id=m.id
Inner join rpt_print on rpt_print.rid=receipt.id
Inner join plots p on rpt_print.msid=p.id 
$jo
$co 
$where $filter group by rpt_print.rid
order by receipt.create_date DESC,receipt.id DESC
limit $start,$limit
 ";
//echo $sql_payment;exit;
		 $result_payments = $connection->createCommand($sql_payment)->queryAll();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";

		$result_sector = $connection->createCommand($sql_sector)->query();

		$sql_payments= $connection->createCommand($sql_payment)->query();
		
		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();
		

	$count=0;

	if ($sql_payments!=''){
	$home=Yii::app()->request->baseUrl; 
    $res=array();
	foreach($sql_payments as $key){
	$total=$key['amount'];	
	//if (isset($_POST['status1']) && $_POST['status1']==5){
	//	$total=0;
	//	$sql_ins  = "SELECT * from installpayment where r_id='".$key['rid']."' ";
	//	$result_ins = $connection->createCommand($sql_ins)->queryAll();
	//	$sql_plo  = "SELECT * from plotpayment where r_id='".$key['rid']."' ";
	//	$result_plo = $connection->createCommand($sql_plo)->queryAll();
	//	foreach($result_ins as $row){$total=$total+$row['paidamount'];}
	//	foreach($result_plo as $row1){$total=$total+$row1['paidamount'];}
	//	}	
	$connection = Yii::app()->db; 
 	$sql_payment2  = "SELECT * FROM rpt_print where rid='".$key['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	  echo '<tr><td>'; if(($key['fstatus']=='Cancelled')||($key['fstatus']=='Bounce')){
	  echo'';
	  }
	  else if($key['typed']==0){
  echo '<a target="_blank"  href="Updatereciept?id='.$key['rid'].'">'.$key['rid'].'</a>';
  }else{echo '<a target="_blank"  href="Updaterecieptd?id='.$key['rid'].'">'.$key['rid'].'</a>';}
  echo '</td><td>'.date("d-m-Y", strtotime($key['rcd'] )).'</td><td>'.$key['name'].'</td><td>'.$key['mcnic'].'</td><td style="text-align:right;">'.number_format($key['amount']).'</td><td>'.$key['ref_no'].'</td><td>'.$key['type'].'</td><td>'.$key['fstatus'].'</td>';
  echo '<td>';
  if(Yii::app()->session['user_array']['per9']==1){
  echo '<a target="_blank"  href="varification?id='.$key['rid'].'">Finance Verify</a>';}
  if(($key['fstatus']=='Cancelled')||($key['fstatus']=='Bounce')){
	  echo'';
	  }else
    if(Yii::app()->session['user_array']['per19']==1 ){
   echo '/<a target="_blank"  href="varificationsales?id='.$key['rid'].'">Sales Center</a>';}
	 if(Yii::app()->session['user_array']['per21']==1 ){
     echo '/<a target="_blank"  href="readmin?id='.$key['rid'].'">Receipt Admin</a>';}
   
echo '</td>';

?>
<?php 
$color='';
if($key['enableedit']=='1'){$color='red';}else{$color='';}
 if(($key['fstatus']=='Cancelled')||($key['fstatus']=='Bounce')){
	  echo'';
	  }else{
  echo '<td style="background-color:'.$color.';  "><a target=" href="print?id='.$key['rid'].'">'.count($result_payments2).'</a>';}echo'</td>';
   if(Yii::app()->session['user_array']['per19']==1){echo  '<td>';
              if(!empty($key['fstatus'])){echo'';}else{echo' <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a target="_blank" href="Cancelreciept?id='.$key['rid'].'">Cancellation</a></li>
      <li><a target="_blank" href="bouncereceipt?id='.$key['rid'].'">Bounce Receipt</a></li>
    
    </ul>
  </div>';}
                  echo '</td>';}
  echo'</tr>';
	}
			}else{echo exit;}
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
	public function actionDealerssearch()
	{
		
      

		$where='';
$co='';
		$and=true;
		$where="mtype='Dealer'";
			if (isset($_POST['cnic']) && $_POST['cnic']!=""){

				if ($and==true)
				{
					  $where.=" and cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" cnic ='".$_POST['cnic']."'";
				}
				$and=true;
			}
			if (isset($_POST['name']) && $_POST['name']!=""){

				if ($and==true)
				{
					  $where.=" and name like '%".$_POST['name']."%'";
				}
				else
				{
					$where.=" m.name like '%".$_POST['name']."%'";
				}
				$and=true;
			}
			
			if ($and==true){$co='where';}
			
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
		 $sql_payment1  = "SELECT * FROM members $co $where   ";

		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
		$rows =count($result_payments1);
		 $sql_payment  = "SELECT * FROM members $co $where   
limit $start,$limit
 ";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

        $sql_project = "SELECT * from projects";

		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		$categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
		$sql_payments= $connection->createCommand($sql_payment)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		$count=0;
		if ($sql_payments!=''){
		$home=Yii::app()->request->baseUrl; 
	    $res=array();
        foreach($sql_payments as $key){
		
		$sql_paymentm  = "SELECT * FROM rpt_print where mem_id='".$key['id']."'";
		  $result_paymentsm = $connection->createCommand($sql_paymentm)->queryAll();
		  $re='';$n=0;$c='';
		  foreach($result_paymentsm as $rec){
		  if($n==1){$c=',';}
		  $re .=$c.$rec['id']; $n++;}
		  if($re==''){$re='0.2,0.1';}
		  $sql_payment1  = "SELECT * FROM plotpayment where re_id in (".$re.")";
		  $result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$totalp=0;$totalam=0;$rem=0;
	
	foreach($result_payments1 as $row){$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
	$sql_payment2  = "SELECT * FROM installpayment where re_id in (".$re.")";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	foreach($result_payments2 as $row2){$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
	$sql_rp  = "SELECT * FROM receipt where mem_id='".$key['id']."'";
	$result_rp = $connection->createCommand($sql_rp)->queryAll();
	foreach($result_rp as $row3){$totalam=$totalam+$row3['amount'];
	if($row3['fstatus']=='Verified'){$rem=$rem+$row3['amount'];}
	}
 	$style='';  
   	if($rem<$totalp){$style='background:red;';}else{$style='background:green;';}
  echo '<tr><td>'.$key['id'].'</td>
  <td><img src="/upload_pic/'.$key['image'].'"/></td>
  <td>'.$key['name'].'</td>
  <td>'.$key['cnic'].'</td>
  <td style="text-align:right;"></td>
  <td style="text-align:right;">'.$totalam.'</td>
  <td style="text-align:right;">'.$totalp.'</td>
  <td style="text-align:right; '.$style.'  ">'.$rem.'</td>
  <td><a href="account?mid='.$key['id'].'">Manage</a></td></tr>';

			} 

			}else{echo exit;}
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
	public function actionUpdatereq()
 	{
		if($_POST['charge']==''){echo 'Please Select any Plot/Payment ';exit;}
					if($_POST['paid']<1){ echo 'Paid Amount must be greater than 0 ';exit;}	
			$error ='';
	   		$connection = Yii::app()->db;  
			$sql_payment  = "SELECT * FROM receipt where id='".$_POST['refid']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryRow();
			$sql_payment1  = "SELECT * FROM plotpayment where r_id='".$_POST['refid']."'";
			$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$sql_payment2  = "SELECT * FROM installpayment where r_id='".$_POST['refid']."'";
			$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
			$totalp=0;
			$rem=0;
			$sql_payment3  = "SELECT * FROM plotpayment where id='".$_POST['charge']."'";
			$result_payments3 = $connection->createCommand($sql_payment3)->queryRow();
			foreach($result_payments1 as $row){$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
			foreach($result_payments2 as $row2){$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
			$rem=$result_payments['amount']-$totalp;
			
			if($rem < ($_POST['paidsurchargech']+$_POST['paid'])){
				echo 'Paid Amount More then Remining amount';exit; 
			}
			if($_POST['paid'] > $result_payments3['amount']){
				echo 'Paid Amount Greater then Due Amount '; exit;
				}
			
			if($result_payments3['paidamount']==''){
			$sql1="UPDATE plotpayment SET `paidamount`='".$_POST['paid']."',`surcharge`='".$_POST['surchargech']."',`paidsurcharge`='".$_POST['paidsurchargech']."', `mem_id`='".$_POST['mem_id']."',`paidas`='".$_POST['type']."',`r_id`='".$_POST['refid']."',`detail`='".$_POST['ref']."',`paid_date_temp`='".date('Y-m-d')."',`remarks`='".$_POST['remarks']."'
			where id='".$_POST['charge']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
			echo 'Payment Updated';
			echo '<script>location.reload();</script>';exit;}else{
			$sql  = "INSERT INTO plotpayment SET amount='".($result_payments3['amount']-$result_payments3['paidamount'])."', payment_type='".$result_payments3['payment_type']."',ref='".$result_payments3['id']."', plot_id='".$result_payments3['plot_id']."', mem_id='".$_POST['mem_id']."', paidamount='".($result_payments3['amount']-$result_payments3['paidamount'])."',`paidas`='".$_POST['type']."',`surcharge`='".$_POST['surchargech']."',`paidsurcharge`='".$_POST['paidsurchargech']."', `r_id`='".$_POST['refid']."',`detail`='".$_POST['ref']."',`paid_date_temp`='".date('Y-m-d', strtotime($_POST['date']))."',`remarks`='".$_POST['remarks']."' ";
			$command = $connection -> createCommand($sql);
			$command -> execute();
			echo 'Insert Payments';
			echo '<script>location.reload();</script>';exit;
			}
			$this->redirect (array('reciept/Updatereciept?id=1'));
	}
	public function actionUpdatereqin()
 	{	$paid='';
 	    $due='';
		$paidamount='';
			if($_POST['install']==''){echo 'Please Select any Plot/Payment ';exit;}
			if($_POST['paid']<1){ echo 'Paid Amount must be greater than 0 ';exit;}
			$error ='';
	   		$connection = Yii::app()->db;  
			$sql_payment  = "SELECT * FROM receipt where id='".$_POST['refid']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryRow();
			$sql_payment1  = "SELECT * FROM installpayment where r_id='".$_POST['refid']."'";
			$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$sql_payment2  = "SELECT * FROM plotpayment where r_id='".$_POST['refid']."'";
			$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
			$totalp=0;
			$totalinstall=0;
			$rem=0;
			 $sql_payment3  = "SELECT * FROM installpayment where id='".$_POST['install']."'";
			$result_payments3 = $connection->createCommand($sql_payment3)->queryRow();
			foreach($result_payments1 as $row){$paidamount=$row['paidamount'];$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
			foreach($result_payments2 as $row2){$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
			$rem=$result_payments['amount']-$totalp;
			if($rem < ($_POST['paidsurchargein']+$_POST['paid'])){
				echo 'Paid Amount More then Remining amount';exit; 
			}
				$paid=$_POST['paid'];
				$due=$result_payments3['dueamount'];
				//echo $result_payments3['dueamount'].'<br>'.$_POST['paid']; exit;
			if(($paid)>($due)){
			   ///echo $result_payments3['dueamount'].'<br>'.$_POST['paid']; exit;
				echo 'Paid Amount Greater then Due Amount '; exit;
				}
			if($result_payments3['paidamount']==''){
			
		//	$sql1="UPDATE installpayment SET `paidamount`='".$_POST['paid']."',`surcharge`='".$_POST['surchargein']."',`paidsurcharge`='".$_POST['paidsurchargein']."', `mem_id`='".$_POST['mem_id']."',`payment_type`='".$_POST['type']."',`r_id`='".$_POST['refid']."',`detail`='".$_POST['ref_no']."',`paid_date`='".date('d-m-Y')."',`remarks`='".$_POST['remarks']."'
		//	where id='".$_POST['install']."'";	
           $sql1="UPDATE installpayment SET `paidamount`='".$_POST['paid']."',`surcharge`='".$_POST['surchargein']."',`paidsurcharge`='".$_POST['paidsurchargein']."', `mem_id`='".$_POST['mem_id']."',`payment_type`='".$_POST['type']."',`r_id`='".$_POST['refid']."',`detail`='".$_POST['ref_no']."',`paid_date_temp`='".date('Y-m-d')."',`remarks`='".$_POST['remarks']."'
			where id='".$_POST['install']."'";	
        
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
			echo 'Payment Updated';
			echo '<script>location.reload();</script>';exit;}else{
				 
		///	$sql  = "INSERT INTO installpayment SET dueamount='00', payment_type='".$_POST['type']."',ref='".$result_payments3['id']."', plot_id='".$result_payments3['plot_id']."', mem_id='".$_POST['mem_id']."', paidamount='".$_POST['paid']."',`surcharge`='".$_POST['surchargein']."',`paidsurcharge`='".$_POST['paidsurchargein']."', `r_id`='".$_POST['refid']."',`detail`='".$_POST['ref_no']."',`paid_date`='".date('d-m-Y', strtotime($_POST['date']))."',`remarks`='".$_POST['remarks']."' ";
		$sql  = "INSERT INTO installpayment SET dueamount='00', payment_type='".$_POST['type']."',ref='".$result_payments3['id']."', plot_id='".$result_payments3['plot_id']."', mem_id='".$_POST['mem_id']."', paidamount='".$_POST['paid']."',`surcharge`='".$_POST['surchargein']."',`paidsurcharge`='".$_POST['paidsurchargein']."', `r_id`='".$_POST['refid']."',`detail`='".$_POST['ref_no']."',`paid_date_temp`='".date('Y-m-d', strtotime($_POST['date']))."',`remarks`='".$_POST['remarks']."' ";
		
			$command = $connection -> createCommand($sql);
			$command -> execute();
			echo 'Insert Payments';
			echo '<script>location.reload();</script>';exit;
			}}
public function actionOthermsplots($val1)
	{
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT *,plots.id as pid from plots
Left join memberplot on (plots.id=memberplot.plot_id)
Left join members on (members.id=memberplot.member_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where members.cnic='".$val1."' ";
;
		$result_plots = $connection->createCommand($sql_plot)->queryAll();
		$sql_plot1  = "SELECT *,plots.id as pid from plots
Left join transferplot on (plots.id=transferplot.plot_id)
Left join memberplot on (plots.id=memberplot.plot_id)
Left join members on (members.id=transferplot.transferto_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where members.cnic='".$val1."' ";
		$result_plots1 = $connection->createCommand($sql_plot1)->queryAll();

		$plot=array();
		foreach($result_plots as $plo){
			
			$plot[]=$plo;
			} 
			foreach($result_plots1 as $plo){
						$plot[]=$plo;
			} 
	echo json_encode($plot); exit();
	}		
	public function actionUpdatereqd()
 	{
		if($_POST['charge']==''){echo 'Please Select any Plot/Payment ';exit;}
					if($_POST['paid']<1){ echo 'Paid Amount must be greater than 0 ';exit;}	
			$error ='';
	   		$connection = Yii::app()->db;  
			
			$sql_payment  = "SELECT * FROM receipt where mem_id='".$_POST['mem_id']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryAll();
			$sql_payment1  = "SELECT * FROM installpayment where re_id='".$_POST['refid']."'";
			$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$sql_payment2  = "SELECT * FROM plotpayment where re_id='".$_POST['refid']."'";
			$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
			$totalp=0;
			$rem=0;
			$totalm=0;
			$sql_payment3  = "SELECT * FROM plotpayment where re_id='".$_POST['install']."'";
			$result_payments3 = $connection->createCommand($sql_payment3)->queryRow();
			foreach($result_payments as $rowas){$totalm=$totalm+$rowas['amount'];}
			foreach($result_payments1 as $row){$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
			foreach($result_payments2 as $rowsa){$totalp=$totalp+$rowsa['paidamount']+$rowsa['paidsurcharge'];}
			$rem=$totalm-$totalp;
			
			if($rem < ($_POST['paidsurchargech']+$_POST['paid'])){
				echo 'Paid Amount More then Remining amount';exit; 
			}
			if($_POST['paid'] > $result_payments3['amount']){
				echo 'Paid Amount Greater then Due Amount '; exit;
				}
			
			if($result_payments3['paidamount']==''){
			$sql1="UPDATE plotpayment SET `paidamount`='".$_POST['paid']."',`surcharge`='".$_POST['surchargech']."',`paidsurcharge`='".$_POST['paidsurchargech']."', `mem_id`='".$_POST['mem_id']."',`paidas`='".$_POST['type']."',`re_id`='".$_POST['refid']."',`detail`='".$_POST['ref']."',`date`='".date('d-m-Y')."',`remarks`='".$_POST['remarks']."'
			where id='".$_POST['charge']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
			echo 'Payment Updated';
			echo '<script>location.reload();</script>';exit;}else{
			$sql  = "INSERT INTO plotpayment SET amount='".($result_payments3['amount']-$result_payments3['paidamount'])."', payment_type='".$result_payments3['payment_type']."',ref='".$result_payments3['id']."', plot_id='".$result_payments3['plot_id']."', mem_id='".$_POST['mem_id']."', paidamount='".($result_payments3['amount']-$result_payments3['paidamount'])."',`paidas`='".$_POST['type']."',`surcharge`='".$_POST['surchargech']."',`paidsurcharge`='".$_POST['paidsurchargech']."', `re_id`='".$_POST['refid']."',`detail`='".$_POST['ref']."',`date`='".$_POST['date']."',`remarks`='".$_POST['remarks']."' ";
			$command = $connection -> createCommand($sql);
			$command -> execute();
			echo 'Insert Payments';
			echo '<script>location.reload();</script>';exit;
			}
			$this->redirect (array('reciept/addreciept?id='.$_POST['refid'].'&&mid='.$_POST['mem_id']));
	}
	public function actionUpdatereqind()
 	{		
			if($_POST['install']==''){echo 'Please Select any Plot/Payment ';exit;}
			if($_POST['paid']<1){ echo 'Paid Amount must be greater than 0 ';exit;}
			$error ='';
	   		$connection = Yii::app()->db;  
			$sql_payment  = "SELECT * FROM receipt where mem_id='".$_POST['mem_id']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryAll();
			$sql_payment1  = "SELECT * FROM installpayment where re_id='".$_POST['refid']."'";
			$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$sql_payment2  = "SELECT * FROM plotpayment where re_id='".$_POST['refid']."'";
			$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
			$totalp=0;
			$rem=0;
			$totalm=0;
			$sql_payment3  = "SELECT * FROM installpayment where id='".$_POST['install']."'";
			$result_payments3 = $connection->createCommand($sql_payment3)->queryRow();
			foreach($result_payments as $rowas){$totalm=$totalm+$rowas['amount'];}
			foreach($result_payments1 as $row){$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
			foreach($result_payments2 as $rowsa){$totalp=$totalp+$rowsa['paidamount']+$rowsa['paidsurcharge'];}
			$rem=$totalm-$totalp;
			//echo $rem; 
			//echo $_POST['paidsurchargein']+$_POST['paid'];
			//exit;
			if($rem < ($_POST['paidsurchargein']+$_POST['paid'])){
				echo 'Paid Amount More then Remining amount';exit; 
			}
			if($_POST['paid'] > $result_payments3['dueamount']){
				echo 'Paid Amount Greater then Due Amount '; exit;
				}
			if($result_payments3['paidamount']==''){
			
			$sql1="UPDATE installpayment SET `paidamount`='".$_POST['paid']."',`surcharge`='".$_POST['surchargein']."',`paidsurcharge`='".$_POST['paidsurchargein']."', `mem_id`='".$_POST['mem_id']."',`payment_type`='".$_POST['type']."',`re_id`='".$_POST['refid']."',`detail`='".$_POST['ref_no']."',`paid_date`='".date('d-m-Y')."',`remarks`='".$_POST['remarks']."'
			where id='".$_POST['install']."'";	
        	$command = $connection -> createCommand($sql1);
            $command -> execute();
			echo 'Payment Updated';
			echo '<script>location.reload();</script>';exit;}else{
				 
			$sql  = "INSERT INTO installpayment SET dueamount='00', payment_type='".$_POST['type']."',ref='".$result_payments3['id']."', plot_id='".$result_payments3['plot_id']."', mem_id='".$_POST['mem_id']."', paidamount='".$_POST['paid']."',`surcharge`='".$_POST['surchargein']."',`paidsurcharge`='".$_POST['paidsurchargein']."', `re_id`='".$_POST['refid']."',`detail`='".$_POST['ref_no']."',`paid_date`='".$_POST['date']."',`remarks`='".$_POST['remarks']."' ";
			$command = $connection -> createCommand($sql);
			$command -> execute();
			echo 'Insert Payments';
			echo '<script>location.reload();</script>';exit;
			}}	
	public function actionAjaxRequest($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from plotpayment where plot_id='".$val1."' and paidamount='' or paidamount is null";
		$result_plots = $connection->createCommand($sql_plot)->queryAll();
		$plot=array();
		foreach($result_plots as $plo){
			foreach($result_plots as $pl){
		if($plo['ref']==0){
			
			foreach($result_plots as $pl){if($plo['id']==$pl['ref']){	
			
			$plo['paidamount']=($plo['paidamount']+$pl['paidamount']);}}
			
			}
		    
		}
			
			$plot[]=$plo;
			} 
	echo json_encode($plot); exit();
	}
	public function actionAjaxRequest1($val1)
	{	 
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from installpayment where plot_id='".$val1."' and paidamount!=dueamount and others!='Cancelled' and fstatus not in ('Cancelled')";
		$result_plots = $connection->createCommand($sql_plot)->queryAll();
		$plot=array();
		foreach($result_plots as $plo){
			if($plo['ref']==0){
			foreach($result_plots as $pl){if($plo['id']==$pl['ref']){	
			$plo['paidamount']=($plo['paidamount']+$pl['paidamount']);}}	
			$plot[]=$plo;}
			} 
		echo json_encode($plot); 
	}
	public function actionAjaxRequest112($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from installpayment  where (fstatus not in ( 'Cancelled','Rejected') and fstatus is null or fstatus='') and paidamount!=dueamount and plot_id='".$val1."'";
		$result_plots = $connection->createCommand($sql_plot)->queryAll();
		$plot=array();
		foreach($result_plots as $plo){
			if($plo['ref']==0){
			foreach($result_plots as $pl){if($plo['id']==$pl['ref']){	
			$plo['paidamount']=($plo['paidamount']+$pl['paidamount']);}}	
			$plot[]=$plo;}
			} 
		echo json_encode($plot); 
	}
	public function actionChargesam($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from plotpayment where id='".$val1."' ";
		$result_plots = $connection->createCommand($sql_plot)->query();
		$plot=array();
		foreach($result_plots as $plo){
			$plot[]=$plo;
			} 
	echo json_encode($plot); exit();
	}
        public function actionInstallamnew($val1)
	{	
		$connection = Yii::app()->db;  
		 $sql_plot  = "SELECT * from installpayment where (id='".$val1."' or ref='".$val1."')";
		$result_plots = $connection->createCommand($sql_plot)->queryAll();
		$plot=array();
		foreach($result_plots as $plo){
$paid=0;$paid=$plo['paidamount'];
			if($plo['ref']==0){
			foreach($result_plots as $pl){if($plo['id']==$pl['ref']){	
			echo $paid=($paid+$pl['paidamount']);}}	
$plo['paidamount']=$paid;			
$plot[]=$plo;}
			} 
	echo json_encode($plot); exit();
	}
	public function actionInstallam($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from installpayment where (id='".$val1."' or ref='".$val1."')";
		$result_plots = $connection->createCommand($sql_plot)->queryAll();
		$plot=array();
		foreach($result_plots as $plo){
$paid=0;$paid=$plo['paidamount'];
			if($plo['ref']==0){
			foreach($result_plots as $pl){if($plo['id']==$pl['ref']){	
			$paid=($paid+$pl['paidamount']);}}	
$plo['paidamount']=$paid;			
$plot[]=$plo;}
			} 
	echo json_encode($plot); exit();
	}
	public function actionSurcharge($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from plotpayment where id='".$val1."' ";
		$result_plots = $connection->createCommand($sql_plot)->queryRow();
	$curdate=date('Y-m-d');	
	$surchargeratio=$result_plots['amount']/100*0.05;
	$duedate=$result_plots['duedate'];
	$paiddate=date('d-m-Y');
	$datetime1 = new DateTime($duedate);
$datetime2 = new DateTime($paiddate);
$interval = $datetime1->diff($datetime2); 
$surchargedur= $interval->format('%R%a ');
if($surchargedur>1){
$totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}	

	echo json_encode(round($totalduesur)); exit();
	}
	public function actionSurinstall($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from installpayment where id='".$val1."' ";
		$result_plots = $connection->createCommand($sql_plot)->queryRow();
	$curdate=date('Y-m-d');	
	$surchargeratio=$result_plots['dueamount']/100*0.05;
	$duedate=$result_plots['due_date'];
	$paiddate=date('d-m-Y');
	$datetime1 = new DateTime($duedate);
$datetime2 = new DateTime($paiddate);
$interval = $datetime1->diff($datetime2); 
$surchargedur= $interval->format('%R%a ');
if($surchargedur>1){
$totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}	

	echo json_encode(round($totalduesur)); exit();
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
	public function actionChargupdate()
	{
				 $connection = Yii::app()->db;  
				$sql="UPDATE plotpayment SET  payment_type='".$_POST['payment_type']."',amount='".$_POST['amount']."',paidamount='".$_POST['paidamount']."',detail='".$_POST['detail']."',surcharge='".$_POST['surcharge']."',paidsurcharge='".$_POST['paidsurcharge']."',remarks='".$_POST['remarks']."',date='".$_POST['date']."',paidas='".$_POST['paidas']."',duedate='".$_POST['duedate']."' where id='".$_REQUEST['id']."' ";	 
        		 $command = $connection -> createCommand($sql);
                 $command -> execute();
			     echo "Updated Successfully ";}
	public function actionPaymentupdate()
	{
      $connection = Yii::app()->db;  
				$sql="UPDATE installpayment SET  payment_type='".$_POST['payment_type']."',dueamount='".$_POST['dueamount']."',paidamount='".$_POST['paidamount']."',lab='".$_POST['lab']."',detail='".$_POST['detail']."',surcharge='".$_POST['surcharge']."',paidsurcharge='".$_POST['paidsurcharge']."',remarks='".$_POST['remarks']."',paid_date='".$_POST['paid_date']."',due_date='".$_POST['due_date']."' where id='".$_REQUEST['id']."' ";	 
        		 $command = $connection -> createCommand($sql);
                 $command -> execute();
			     echo "Updated Successfully ";	
	}
	public function actionSubmittoadmin()
	{ 
		$connection = Yii::app()->db; 
		$sql_plot12  = "SELECT * from rpt_print where rid='".$_POST['rid']."'";
		$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
		foreach($result_plots12 as $row){
		if(isset($_POST['bank'.$row['id']]) && $_POST['bank'.$row['id']]!==''){
				}else{ echo 'Please Select Bank for '. $row['r_no'];exit;}
		}
		foreach($result_plots12 as $row){
$submitdate = date("Y-m-d", strtotime($_POST['submitdate'.$row['id']] ));
$clrdate = date("Y-m-d", strtotime($_POST['clrdate'.$row['id']]));
		$sql="UPDATE rpt_print SET bank_details='".$_POST['bank'.$row['id']]."',slipno='".$_POST['slipno'.$row['id']]."',submitdate='".$submitdate."',clrdate='".$clrdate."' where id='".$row['id']."' ";	
        		 $command = $connection -> createCommand($sql);
                 $command -> execute();
		}
		$sql="UPDATE receipt SET bank_details='111',sub_date='".date('Y-m-d')."',enableedit=0 where id='".$_POST['rid']."' ";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		echo 'Updated';
		echo '<script>location.href="reciept_lis";</script>';exit;
	}
	public function actionSubmittofinance()
	{
		if(isset($_POST['status']) && $_POST['status']!==''){
      			$connection = Yii::app()->db; 
				$sql="UPDATE receipt SET fstatus='".$_POST['status']."', app_by='".Yii::app()->session['user_array']['id']."' ,app_date='".date('Y-m-d')."', comm='".$_POST['comm']."' where id='".$_REQUEST['rid']."' ";	 
        		 $command = $connection -> createCommand($sql);
                 $command -> execute();
			     if($_POST['status']=='Verified'){
				 $sql_payment  = "SELECT * FROM installpayment where r_id='".$_REQUEST['rid']."'";
				 $result_payments = $connection->createCommand($sql_payment)->queryAll();
				foreach($result_payments as $row){			 
				 $sql  = "UPDATE installpayment set 
			 	fstatus='approved',
			    others='Verified',
				fid='".Yii::app()->session['user_array']['id']."'
			    where  id='".$row['id']."'";
			   $command = $connection -> createCommand($sql);
               $command -> execute();}
			   
				 $sql_payment  = "SELECT * FROM plotpayment where r_id='".$_REQUEST['rid']."'";
				 $result_payments = $connection->createCommand($sql_payment)->queryAll();
				foreach($result_payments as $row){			 
				$sql  = "UPDATE plotpayment set 
				fstatus='approved' , 
				fid='".Yii::app()->session['user_array']['id']."' 
				where  id='".$row['id']."'";
			   $command = $connection -> createCommand($sql);
               $command -> execute();}
				}
				 if($_POST['status']=='Pending'){
				 $sql="UPDATE receipt SET enableedit=1 where id='".$_REQUEST['rid']."' ";	 
        		 $command = $connection -> createCommand($sql);
                 $command -> execute();
				 }
				 if($_POST['status']=='Rejected'){}
				 echo 'Updated';
				 echo '<script>location.href="reciept_lis";</script>';exit;
				 }else{echo 'Please Select Status';exit;}
	}
	public function actionReadminsubmit()
	{
		if(isset($_POST['status']) && $_POST['status']!==''){
			$uid=Yii::app()->session['user_array']['id'];
      $connection = Yii::app()->db; 
				$sql="UPDATE receipt SET filed='".$_POST['status']."',f_uid='".$uid."' where id='".$_POST['rid']."' ";	 
        		 $command = $connection -> createCommand($sql);
                 $command -> execute();
			     echo 'Updated';
				 echo '<script>location.href="reciept_lis";</script>';exit;
				 }else{echo 'Please Select Status';exit;}
	}
}
