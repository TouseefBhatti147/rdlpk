<?php
class FinanceController extends Controller
{  
    public function actionExtra_land() {
		$connection = Yii::app()->db;
		$query = "SELECT SUM(dueamount)as extralandprice,plot_id FROM installpayment WHERE lab ='Extra Land Charges'
		  group by installpayment.plot_id ";
		$result= $connection->createCommand($query)->query();
		$rows = count($result);

		foreach($result as $row){

			$totalDueAmount = $row['extralandprice'];
			
			$sql1 = "UPDATE plots SET extra_land_price = '" . $totalDueAmount . "' WHERE id = '" .$row['plot_id'] . "'";
			$command = $connection->createCommand($sql1);
			$command->execute();

		

			if ($totalDueAmount == 0 || $totalDueAmount=='') {
				// If extra_land_price is empty or 0, set basic_price = price
				$sql = "UPDATE plots SET basic_price = price WHERE id = '" .$row['plot_id']."'";
			} else {
				// If extra_land_price is not empty or 0, set basic_price = price - extra_land_price
				 $sql = "UPDATE plots SET basic_price = (price - extra_land_price) WHERE id = '" .$row['plot_id']. "'";
			}
		
			$command = $connection->createCommand($sql);
			$command->execute();
		} 
		    $sql2 = "UPDATE plots SET basic_price = (price - extra_land_price)";
			$command = $connection->createCommand($sql2);
			$command->execute();

			
		
		
			echo 'Extra Land Price Updated';
	}
///////////////START:Property Module//////////////////////
public function actionPro_installment_details() {

	if (isset(Yii::app()->session['user_array']['username'])) {
		$connection = Yii::app()->db;
		$sql_payment = "SELECT * FROM installpayment where plot_id='" . $_REQUEST['id'] . "' and (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='') and others !='Cancelled' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
		$sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
left join members m on mp.member_id=m.id
where plot_id='" . $_REQUEST['id'] . "'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges = "SELECT * FROM plotcharges where plot_id='" . $_REQUEST['id'] . "'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo = "SELECT buildings.name as building_name,floors.name as floor_name,mp.mstatus as stst,p.*,proj.project_name,s.size FROM plots p
left join projects proj on p.project_id=proj.id
left join memberplot mp on mp.plot_id=p.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id)
left join size_cat s on p.size2=s.id
where p.id='" . $_REQUEST['id'] . "'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		$sql_minfo = "SELECT * FROM memberplot where plot_id='" . $_REQUEST['id'] . "'";
		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
		$result_prime = $connection->createCommand($sql_primeloc)->queryAll();

		$this->render('pro_installment_details', array('payments' => $result_payments, 'primeloc' => $result_prime, 'charges' => $result_charges, 'info' => $result_plotinfo, 'minfo' => $result_minfo, 'members' => $result_members));
	} else {

		$this->redirect(array('user/dashboard'));
	}
}
	public function actionProp_payment_details() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $land = "SELECT * FROM installpayment	where plot_id='" . $_REQUEST['id'] . "' ";
            $land_cost = $connection->createCommand($land)->queryAll();

            $member = "SELECT * FROM memberplot mp where plot_id='" . $_REQUEST['id'] . "'";
            $members = $connection->createCommand($member)->queryRow();
            $sql_payment = "Select * from plotpayment where plot_id='" . $_REQUEST['id'] . "' and (mem_id='" . $members['member_id'] . "' or pobm !='' or payment_type NOT IN ('MS Fee','Transfer Fee')) ";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
left join members m on mp.member_id=m.id
where plot_id = '" . $_REQUEST['id'] . "'";
            $result_members = $connection->createCommand($sql_member)->queryAll();
            $sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc
left join charges c on pc.charges_id=c.id
where plot_id='" . $_REQUEST['id'] . "'";
            $res = $connection->createCommand($sql)->queryAll();

            $sql_plotinfo = "SELECT buildings.name as building_name,floors.name as floor_name,mp.mstatus as stst,p.*,proj.project_name,s.size FROM plots p
left join projects proj on p.project_id=proj.id
left join memberplot mp on mp.plot_id=p.id
left join size_cat s on p.size2=s.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (buildings.id = floors.building_id)
where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('prop_payment_details', array('payments' => $result_payments, 'primeloc' => $result_prime, 'landcost' => $land_cost, 'info' => $result_plotinfo, 'receivable' => $res, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }
	public function actionProp_alotment_lis()
	{		if((Yii::app()->session['user_array']['per9']=='1')&& isset(Yii::app()->session['user_array']['username']))
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
					$where.="  and plots.is_property='1' ";
				}
				else
				{
					$where.="plots.is_property='1' ";
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
       plots.street_id
    , plots.plot_size
    , plots.com_res
	 , plots.size2
    , plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
	, plots.plot_detail_address
	, property.plotno
	, property.create_date
	, property.id as mp_id
    , projects.project_name
	, streets.street
FROM
    memberplot property
	Left JOIN plots  ON (plots.id = property.plot_id) 
	Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
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
			$this->render('prop_alotment_lis',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$result_projects,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));

			}else{
				$this->redirect(array('user/dashboard'));	
				}
	   
	}
	public function actionPropalotmentreq()
	{    
		
		$where='';
		$and=false;
		if (isset($_POST['fromdate']) &&  $_POST['fromdate']!="")
				{
			$from=$_POST['fromdate'];
				}
				if ( isset($_POST['todate']) &&  $_POST['todate']!="")
				{
						$to=$_POST['todate'];
				}
					
		 if (isset($_POST['status']) && $_POST['status']!=""){
				if($_POST['status']=='New'){ $where.="mp.status=''"; }else{
				$where.="mp.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
			}
				if (!empty($from) && (!empty($to))) {
				if ($and==true)
				{
				$where.="and mp.create_date BETWEEN '".$from."' AND '".$to."' ";
				}else{$where.="mp.create_date BETWEEN '".$from."' AND '".$to."' ";}
			$and=true;
			}
		if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and p.plot_detail_address ='".$_POST['plotno']."'";
				}
				else
				{
					$where.=" p.plot_detail_address ='".$_POST['plotno']."'";
				}
				$and=true;
			}
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and p.is_property='1'and p.project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.="p.is_property='1' and p.project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}
		$connection = Yii::app()->db; 
		  $sql_payment  = "SELECT  p.is_property,buildings.name as building_name,floors.name as floor_name,mp.member_id,mp.app_no,mp.create_date,mp.id as mp_id,p.type,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,j.project_name FROM memberplot mp
inner join members m on mp.member_id=m.id
inner join plots p on mp.plot_id=p.id
inner join projects j on p.project_id=j.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id)
where $where";
	$result_payments = $connection->createCommand($sql_payment)->queryAll();
 //echo $sql_payment;exit();
        $sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
	
	
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
	$count=0;

	if ($result_payments!=''){
		$home=Yii::app()->request->baseUrl; 
    $res=array();
$i=1;
            foreach($result_payments as $key){
		$ID=$key['mp_id'];
  echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['app_no'].'</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['plot_size'].'<td>'.$key['plot_detail_address'].'</td><td>'.$key['building_name'].'</td><td>'.$key['floor_name'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="prop_req_detail?id='.$ID.'">Detail</a>
  </td></tr>';
		 $i++;
			} 
			}else{echo exit;}
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
	public function actionProp_req_detail()
	{
	if(Yii::app()->session['user_array']['per9']=='1')
			{
			$connection = Yii::app()->db; 	
		$sql_details  = "
		SELECT
       plots.id
     , plots.street_id
     , plots.plot_size
     , plots.project_id
     , plots.com_res
	 , plots.size2
	 , property.id as propid
	 , plots.type
	 , property.fstatus
     , property.plotno
	 , plots.price
	 , property.create_date
	 , property.insplan
	 , property.member_id
	 , plots.plot_detail_address
	 , property.fcomment
     , projects.project_name
	 , streets.street
	 , size_cat.size
	 , size_cat.dimension
	 , property.status
	 , sector_name
	 , buildings.name as buildname
	 , floors.name as fname
	 , projects.project_name
	 , members.name
	 , members.cnic
	 , members.image
	 
FROM
   memberplot property 
   left join members  on property.member_id=members.id
    Left JOIN plots  ON (property.plot_id = plots.id)
	
	Left JOIN floors  ON (plots.floor_id = floors.id)
	Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN buildings  ON (buildings.id = floors.building_id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2) where property.id=".$_REQUEST['id'];
			$result_details = $connection->createCommand($sql_details)->query();
			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryRow();
			$this->render('prop_req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 
			}else{$this->redirect(array("dashboard"));}
	}		
	
	public function actionInstallmenttttt_details()
	{if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
		

		$this->render('installment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	} 
	public function actionProp_submitstatus()
	{
        $connection = Yii::app()->db;
		//$memberid=$_POST['member_id'];
		$plotid=$_POST['plot_id'];
		if($_POST['statusapp']=='Rejected')
		{
		 $sqldel="Delete from  memberplot where plot_id='".$plotid."'";
        $command = $connection -> createCommand($sqldel);
        $command -> execute(); 
		$sqlup="Update plots SET status='' where id='".$plotid."'";	
		
        $command = $connection -> createCommand($sqlup);
        $command -> execute();
		
		$sql2="DELETE FROM  installpayment where plot_id='".$plotid."'";		
        $command = $connection -> createCommand($sql2);
        $command -> execute();

		$this->redirect(array("finance/prop_alotment_lis"));
		}
		if($_POST['statusapp']=='approved')
		{ 
		 $sql="Update memberplot SET fstatus='".$_POST['statusapp']."', fcomment='".$_POST['cmnt']."' where plot_id='".$plotid."'";
		//$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		
		$this->redirect(array("finance/prop_alotment_lis"));
		}
		if($_POST['statusapp']=='Pending')
		{
		$sql="Update memberplot SET fstatus='".$_POST['statusapp']."', fcomment='".$_POST['cmnt']."' where plot_id='".$plotid."'";	
		//$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$this->redirect(array("finance/prop_alotment_lis"));
		}
		
	}
///////////////END:Property Module/////////////////////////

public function actionDaily()
	{ 
		if(isset(Yii::app()->session['user_array']['username']))
			{
				$connection = Yii::app()->db;
				 $connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		 $sql1 =   "select * from projects where ";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
		$sql_project = $sql1.'status =1 and';
		$sql_project = $sql_project.implode(' or',$sql2);
		$pro = $connection->createCommand($sql_project)->queryAll() or mysql_error();
				
				$sql_center  = "SELECT * from sales_center";
      		$result_center = $connection->createCommand($sql_center)->queryAll();			
		
				$this->render('daily',array('result_center'=>$result_center,'pro'=>$pro));	
			}else{
				$this->redirect(array('user/dashboard'));
				}
	   	}
	   		public function actionDailysummary()
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
		$where='';
		$fromdate='';
		$todate='';
		$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and (project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.="(project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}		
				if ( isset($_POST['fromdate']) &&  $_POST['fromdate']!="")
				{				
						
							$fromdate=$_POST['fromdate'];
				}
				else
				{
					$fromdate=date('Y-m-01');
				}
				if ( isset($_POST['todate']) &&  $_POST['todate']!="")
					{				
							
								$todate=$_POST['todate'];
					}
					else
					{
						$todate=date('Y-m-d');
					}
		
												$currmonth=date('M');
														$sql_test="select paid_date_temp from installpayment where paid_date_temp between  '".$fromdate."' and '".$todate."' group by paid_date_temp Order BY paid_date_temp ASC";
												           
										$result = $connection->createCommand($sql_test)->queryAll();
                                                $tcash1 = 0;
                                                $tcash = 0;
												$tpo = 0;
												$tcheque = 0;
												$tonline = 0;
												$tjv=0;
												  $totalpp=0;
												  $t=0;
                                              	$gt=0;
                                                  $total=0;                                         
                            			   foreach($result as $row)
												 {
												      $paid_date_temp = strtotime($row['paid_date_temp']); 
	                                                  $paid_date_temp = date('d-m-Y', $paid_date_temp);
												  ///   $thisdate = date("Y-m-d",strtotime($row["create_date"]));                                                  
                                                    $days = $row['paid_date_temp'];
												 echo'
                                                    <tr><td class="text-left"> ';                           
                                                            echo $paid_date_temp;                                                                    
                                                        echo'</td> <td style="text-align:right">';
                                                        $sql_cash  ="SELECT
                                                                                    SUM(total) AS cash
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type = 'cash' || installpayment.payment_type = 'Cash'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                   
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas = 'cash' || plotpayment.paidas = 'Cash'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                               
                                                                                ) AS installpayment";
														
																			$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo number_format($csh['cash']/1000000,2);
														 $tcash = ($csh['cash']+$tcash);
												 }
													   
                                                        echo'</td>
                                                         <td style="text-align:right">';
                                                          $sql_cheque  ="SELECT
                                                                                    SUM(total) AS cheque
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'cheque' || installpayment.payment_type LIKE 'Cheque'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Cheque' || plotpayment.paidas LIKE 'cheque'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";
                                                   										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo number_format($chq['cheque']/1000000,2);
														 $tcheque = ($chq['cheque']+$tcheque);
												 }
                                                       echo'</td>
                                                        <td style="text-align:right">';
                                                                    $sql_po="SELECT
                                                                                    SUM(total) AS po
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Pay Order' || installpayment.payment_type LIKE 'po'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Pay Order' || plotpayment.paidas LIKE 'po'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";
                                                                      
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo number_format($po['po']/1000000,2);
														 $tpo = ($po['po']+$tpo);
												 }
                                                        echo'</td>
                                                        <td  style="text-align:right">';
                                                         
														 	$sql_online="SELECT
                                                                                    SUM(total) AS online
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Online' || installpayment.payment_type LIKE 'online'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Online' || plotpayment.paidas LIKE 'online'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo number_format($online['online']/1000000,2);
														 $tonline = ($online['online']+$tonline);
												 }
                                                        echo'</td>
                                                        <td  style="text-align:right">';
                                                        $sql_jv="SELECT
                                                                                    SUM(total) AS jv
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'JV' || installpayment.payment_type LIKE 'jv'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'JV' || plotpayment.paidas LIKE 'jv'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";
                                                                
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo $jv['jv']/1000000;
														 $tjv = ($jv['jv']+$tjv);
												 }
														  echo'</td><td  style="text-align:right"><strong>'; 
													
														 
														 $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Pay Order' || installpayment.payment_type LIKE'po' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                inner JOIN plots on installpayment.plot_id=plots.id
                                                                 where plots.project_id='".$_POST['project_id']."' && installpayment.fstatus !='Cancelled' and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row['paid_date_temp']."'";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												
													}
												$sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Pay Order' || plotpayment.paidas LIKE'po' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                inner JOIN plots on plotpayment.plot_id=plots.id
                                                                where plots.project_id='".$_POST['project_id']."' && plotpayment.fstatus !='Cancelled' and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row['paid_date_temp']."'";   
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
													//echo  round($tcash2,2);	
													}
													
                                                       echo  round(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
														 
														  echo'</strong></td>';
                                                    
                                                     echo'</tr>';
												 }
                                               

                                                echo'<tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong>'.round(($tcash/1000000),2).'</strong></td><td style="text-align:right"><strong>'.round(($tcheque/1000000),2).'</strong></td><td style="text-align:right"><strong>'.round(($tpo/1000000),2).'</strong></td><td style="text-align:right"><strong>'.round(($tonline/1000000),2).'</strong></td>
                                                <td style="text-align:right"><strong>'.round(($tjv/1000000),2).'</strong></td><td style="text-align:right"><strong>'.(round($gt,2)).'</strong></td>
                                                </tr>';?>
												   
												
											
												<tr >  <td colspan="7" >
                   <table width="100%">
				
                    <tr  id="piechart" style="height: 300px;"><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Date', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  foreach($result as $row1){?>  
		
          ['<?php echo $row1['paid_date_temp']?>', 
		  <?php
		   $sql_cash="SELECT
                                                                                    SUM(total) AS cash
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type = 'cash' || installpayment.payment_type = 'Cash'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                   
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas = 'cash' || plotpayment.paidas = 'Cash'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                               
                                                                                ) AS installpayment";          
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT
                                                                                    SUM(total) AS cheque
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE'cheque' || installpayment.payment_type LIKE'Cheque'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE'Cheque' || plotpayment.paidas LIKE'cheque'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";         
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT
                                                                                    SUM(total) AS po
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Pay Order' || installpayment.payment_type LIKE 'po'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Pay Order' || plotpayment.paidas LIKE 'PO'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";          
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT
                                                                                    SUM(total) AS online
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Online' || installpayment.payment_type LIKE 'online'
                                                                                        ) and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Online' || plotpayment.paidas LIKE 'online'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";         
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>, <?php
		   $sql_jv="SELECT
                                                                                    SUM(total) AS jv
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    inner JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'JV' || installpayment.payment_type LIKE 'jv'
                                                                                        ) and (installpayment.fstatus !='Bounce') AND installpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                inner JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'JV' || plotpayment.paidas LIKE 'jv'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.paid_date_temp ='".$row1['paid_date_temp']."'
                                                                                
                                                                                ) AS installpayment";          
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo ($jv['jv']);
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('daily'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 
									
									</script>
                                    <div id="daily"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
												
												
        
	<?php }
	public function actionDailysummary111()
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
		$where='';
		$fromdate='';
		$todate='';

$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and (project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.="(project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}
			
        if ( isset($_POST['fromdate']) &&  $_POST['fromdate']!="")
        {				
				
					$fromdate=$_POST['fromdate'];
        }
				else
				{
					$fromdate=date('01-m-Y');
				}
				if ( isset($_POST['todate']) &&  $_POST['todate']!="")
        {				
				
					$todate=$_POST['todate'];
        }
				else
				{
					$todate=date('d-m-Y');
				}
													$currmonth=date('M');
												$sql_test="select * from installpayment where str_to_date(paid_date ,'%d-%m-%Y') between str_to_date('".$fromdate."','%d-%m-%Y') and str_to_date('".$todate."','%d-%m-%Y')  group by paid_date Order BY paid_date ASC";
										$result = $connection->createCommand($sql_test)->queryAll();
                                                $tcash1 = 0;
                                                $tcash = 0;
												$tpo = 0;
												$tcheque = 0;
												$tonline = 0;
												$tjv=0;
                                              	$gt=0;
                                                  $total=0;                                         
                            			   foreach($result as $row)
												 {
													
                                              
                                                  ///   $thisdate = date("Y-m-d",strtotime($row["create_date"]));                                                  
                                                    $days = $row['paid_date'];
												 echo'
                                                    <tr><td class="text-left"> ';                           
                                                            echo $row['paid_date'];                                                                    
                                                        echo'</td> <td style="text-align:right">';
                                                        $sql_cash  ="SELECT
                                                                                    SUM(total) AS cash
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type = 'cash' || installpayment.payment_type = 'Cash'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row['paid_date']."'
                                                                                   
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas = 'cash' || plotpayment.paidas = 'Cash'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date']."'
                                                                               
                                                                                ) AS installpayment";
														  /*$sql_cash="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS cash FROM installpayment left join plots p on installpayment.plot_id=p.id 
														 	where p.project_id='".$_POST['project_id']."' and (installpayment.payment_type='cash'||installpayment.payment_type='Cash') and installpayment.paid_date ='".$row['paid_date']."' group by installpayment.paid_date";
														 	*/
														          
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo number_format($csh['cash']/1000000,2);
														 $tcash = ($csh['cash']+$tcash);
												 }
													   
                                                        echo'</td>
                                                         <td style="text-align:right">';
                                                          $sql_cheque  ="SELECT
                                                                                    SUM(total) AS cheque
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'cheque' || installpayment.payment_type LIKE 'Cheque'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Cheque' || plotpayment.paidas LIKE 'cheque'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date']."'
                                                                                
                                                                                ) AS installpayment";
                                                         /* $sql_cheque="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS cheque FROM installpayment left join plots p on installpayment.plot_id=p.id 
														 	where p.project_id='".$_POST['project_id']."' and (installpayment.payment_type='cheque'||installpayment.payment_type='Cheque') and installpayment.paid_date ='".$row['paid_date']."' group by installpayment.paid_date";*/         
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo number_format($chq['cheque']/1000000,2);
														 $tcheque = ($chq['cheque']+$tcheque);
												 }
                                                       echo'</td>
                                                        <td style="text-align:right">';
                                                                    $sql_po="SELECT
                                                                                    SUM(total) AS po
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Pay Order' || installpayment.payment_type LIKE 'po'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Pay Order' || plotpayment.paidas LIKE 'po'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date']."'
                                                                                
                                                                                ) AS installpayment";
                                                                    /*$sql_po="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS po FROM installpayment left join plots p on installpayment.plot_id=p.id 
														 	where p.project_id='".$_POST['project_id']."' and (installpayment.payment_type='PO'||installpayment.payment_type='Pay Order') and installpayment.paid_date ='".$row['paid_date']."' group by installpayment.paid_date"; */         
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo number_format($po['po']/1000000,2);
														 $tpo = ($po['po']+$tpo);
												 }
                                                        echo'</td>
                                                        <td  style="text-align:right">';
                                                         /* $sql_online="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS online FROM installpayment left join plots p on installpayment.plot_id=p.id 
														 	where p.project_id='".$_POST['project_id']."' and (installpayment.payment_type='online'||installpayment.payment_type='Online') and installpayment.paid_date ='".$row['paid_date']."' group by installpayment.paid_date";*/
														 	$sql_online="SELECT
                                                                                    SUM(total) AS online
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Online' || installpayment.payment_type LIKE 'online'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Online' || plotpayment.paidas LIKE 'online'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date']."'
                                                                                
                                                                                ) AS installpayment";
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo number_format($online['online']/1000000,2);
														 $tonline = ($online['online']+$tonline);
												 }
                                                        echo'</td>
                                                        <td  style="text-align:right">';
                                                        $sql_jv="SELECT
                                                                                    SUM(total) AS jv
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'JV' || installpayment.payment_type LIKE 'jv'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'JV' || plotpayment.paidas LIKE 'jv'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date']."'
                                                                                
                                                                                ) AS installpayment";
                                                          /*$sql_jv="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS jv FROM installpayment left join plots p on installpayment.plot_id=p.id 
														 	where p.project_id='".$_POST['project_id']."' and installpayment.payment_type='JV' and installpayment.paid_date ='".$row['paid_date']."' group by installpayment.paid_date";*/         
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo $jv['jv']/1000000;
														 $tjv = ($jv['jv']+$tjv);
												 }
														  echo'</td><td  style="text-align:right"><strong>'; 
													/*	$sql_d  ="SELECT p.project_id,installpayment.paid_date,
																	SUM(CASE When installpayment.payment_type='Cash' Then paidamount Else 0 End ) as cash1,
																	SUM(CASE When installpayment.payment_type='Online' Then paidamount Else 0 End ) as online1,
																	SUM(CASE When installpayment.payment_type='Pay Order' || installpayment.payment_type='PO' Then paidamount Else 0 End ) as po1,
																	SUM(CASE When installpayment.payment_type='Cheque' Then paidamount Else 0 End ) as cheque1,
																	SUM(CASE When installpayment.payment_type='JV' Then paidamount Else 0 End ) as jv1
																	from installpayment 
															       	LEFT JOIN plots p ON installpayment.plot_id = p.id
																	  where p.project_id='".$_POST['project_id']."' AND installpayment.paid_date ='".$row['paid_date']."'";   
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000);
													echo  round($tcash1,2);	
													}
														$t=($tcash1)/1000000;
                                                       //  echo round($t,2);
														 $gt=$t+$gt; */
														 
														 $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Pay Order' || installpayment.payment_type LIKE'po' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                 where plots.project_id='".$_POST['project_id']."' && installpayment.fstatus !='Cancelled' and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row['paid_date']."'";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												///	echo  round($tcash1,2);	
													}
												$sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Pay Order' || plotpayment.paidas LIKE'po' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                where plots.project_id='".$_POST['project_id']."' && plotpayment.fstatus !='Cancelled' and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date']."'";   
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
													//echo  round($tcash2,2);	
													}
													
                                                       echo  round(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
														 
														  echo'</strong></td>';
                                                    
                                                     echo'</tr>';
												 }
                                               

                                                echo'<tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong>'.round(($tcash/1000000),2).'</strong></td><td style="text-align:right"><strong>'.round(($tcheque/1000000),2).'</strong></td><td style="text-align:right"><strong>'.round(($tpo/1000000),2).'</strong></td><td style="text-align:right"><strong>'.round(($tonline/1000000),2).'</strong></td>
                                                <td style="text-align:right"><strong>'.round(($tjv/1000000),2).'</strong></td><td style="text-align:right"><strong>'.(round($gt,2)).'</strong></td>
                                                </tr>';?>
												   
												
											
												<tr >  <td colspan="7" >
                   <table width="100%">
				
                    <tr  id="piechart" style="height: 300px;"><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Date', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  foreach($result as $row1){?>  
		
          ['<?php echo $row1['paid_date']?>', 
		  <?php
		   $sql_cash="SELECT
                                                                                    SUM(total) AS cash
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type = 'cash' || installpayment.payment_type = 'Cash'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row1['paid_date']."'
                                                                                   
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas = 'cash' || plotpayment.paidas = 'Cash'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row1['paid_date']."'
                                                                               
                                                                                ) AS installpayment";          
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT
                                                                                    SUM(total) AS cheque
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE'cheque' || installpayment.payment_type LIKE'Cheque'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row1['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE'Cheque' || plotpayment.paidas LIKE'cheque'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row1['paid_date']."'
                                                                                
                                                                                ) AS installpayment";         
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT
                                                                                    SUM(total) AS po
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Pay Order' || installpayment.payment_type LIKE 'po'
                                                                                        ) and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row1['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Pay Order' || plotpayment.paidas LIKE 'PO'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row['paid_date']."'
                                                                                
                                                                                ) AS installpayment";          
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT
                                                                                    SUM(total) AS online
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'Online' || installpayment.payment_type LIKE 'online'
                                                                                        ) and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row1['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'Online' || plotpayment.paidas LIKE 'online'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row1['paid_date']."'
                                                                                
                                                                                ) AS installpayment";         
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>, <?php
		   $sql_jv="SELECT
                                                                                    SUM(total) AS jv
                                                                                FROM
                                                                                    (
                                                                                    SELECT
                                                                                        paidamount AS `total`
                                                                                    FROM
                                                                                        installpayment
                                                                                    LEFT JOIN plots ON installpayment.plot_id = plots.id
                                                                                    WHERE
                                                                                        plots.project_id = '".$_POST['project_id']."' AND(
                                                                                            installpayment.payment_type LIKE 'JV' || installpayment.payment_type LIKE 'jv'
                                                                                        ) and (installpayment.fstatus !='Bounce') AND installpayment.paid_date ='".$row1['paid_date']."'
                                                                                    
                                                                                    UNION ALL
                                                                                SELECT
                                                                                    paidamount AS `total`
                                                                                FROM
                                                                                    plotpayment
                                                                                LEFT JOIN plots ON plotpayment.plot_id = plots.id
                                                                                WHERE
                                                                                    plots.project_id = '".$_POST['project_id']."' AND(
                                                                                        plotpayment.paidas LIKE 'JV' || plotpayment.paidas LIKE 'jv'
                                                                                    ) and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND plotpayment.date ='".$row1['paid_date']."'
                                                                                
                                                                                ) AS installpayment";          
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo ($jv['jv']);
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('daily'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 
									
									</script>
                                    <div id="daily"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
												
												
        
	<?php }
public function actionYearly()
	{ 
		if(isset(Yii::app()->session['user_array']['username']))
			{
				$connection = Yii::app()->db;
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
		$pro = $connection->createCommand($sql_project)->queryAll() or mysql_error();
				
				$sql_center  = "SELECT * from sales_center";
      		$result_center = $connection->createCommand($sql_center)->queryAll();			
			 $sql_year="SELECT DISTINCT YEAR(STR_TO_DATE(`paid_date`,'%d-%m-%Y')) as years,paid_date from installpayment where YEAR(STR_TO_DATE(`paid_date`,'%d-%m-%Y')) >0 GROUP BY years";
													$years = $connection->createCommand($sql_year)->queryAll();
				$this->render('yearly',array('result_center'=>$result_center,'pro'=>$pro,'years'=>$years));	
			}else{
				$this->redirect(array('user/dashboard'));
				}
	   	}
	   	public function actionYearlysummary()
	{  
	// echo $_POST['year'];exit;
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
		$where='';

$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and (project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.="(project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}

		
			if ($and==true){$co='where';}
		
												 $sql_year="SELECT DISTINCT YEAR((`paid_date_temp`)) as years,`paid_date_temp` from installpayment where YEAR((`paid_date_temp`)) >0 GROUP BY years";
													$years = $connection->createCommand($sql_year)->queryAll();
												$currmonth=date('M');
												
                                             
                                               $total = 0;
                                                $gt = 0;
												$tcash = 0;
												$tchq = 0;
												$tpo = 0;
												$tcheque=0;
												$tonline = 0;
												 $totalpp=0;
												 $t=0;
                                                $tjv=0;
                                                       foreach($years as $yrs) {                                   
                            			 
												echo'
                                                    <tr>
                                                       
                                                        <td class="text-left">'.$yrs['years'];
															
															                                                                 
                                                        echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'Cash' || installpayment.payment_type LIKE 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cash' || plotpayment.paidas = 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
                                                      //  $sql_cash="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS cash FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Cash' || installpayment.payment_type = 'cash' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";         
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo round(($csh['cash']/1000000),2);
														 $tcash = ($csh['cash']+$tcash);
												 }
                                                        echo'</td>
                                                         <td style="text-align:right">'; 
                                                          $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type = 'Cheque' || installpayment.payment_type = 'cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cheque' || plotpayment.paidas = 'Cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
													  // $sql_cheque="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS cheque FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Cheque' || installpayment.payment_type = 'cheque' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$rescheque = $connection->createCommand($sql_cheque)->queryAll();
												foreach($rescheque as $chq)
												 {
                                                         echo round(($chq['cheque']/1000000),2);
														 $tchq =($chq['cheque']+$tchq);
												 }
														
                                                        echo'</td>
                                                       <td style="text-align:right">';
                                                         $sql_po="SELECT SUM(total) as po FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'po' || installpayment.payment_type LIKE 'Pay Order' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas LIKE 'po' || plotpayment.paidas LIKE 'Pay Order' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
                                                       //  $sql_po="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS po FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Pay Order' || installpayment.payment_type = 'PO' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo round(($po['po']/1000000),2);
														 $tpo = ($po['po']+$tpo);
												 }
                                                        echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_online="SELECT SUM(total) as online FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas LIKE 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
														 //$sql_online="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS online FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Online' || installpayment.payment_type = 'online' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo round(($online['online']/1000000),2);
														 $tonline = ($online['online']+$tonline);
												 }
                                                        echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas LIKE 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
														 //$sql_jv="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS jv FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'JV' || installpayment.payment_type = 'jv' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo round(($jv['jv']/1000000),2);
														 $tjv = ($jv['jv']+$tjv);
												 }
                                                       echo'</td><td  style="text-align:right"><strong>'; 
													
																	  
															 $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Pay Order' || installpayment.payment_type LIKE 'PO' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                where plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												//	echo  round($tcash1,2);	
													}
													$sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE 'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Pay Order' || plotpayment.paidas LIKE 'PO' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                               WHERE  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')";  
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
												//	echo  round($tcash2,2);	
													}
													
                                                      echo  number_format(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
													
														  echo'</strong></td></tr>';
                                                       }
                                               
												echo ' <tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong>'.round(($tcash/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tchq/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tpo/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tonline/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tjv/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round($gt,2).'</strong></td>
												</tr>';?>
												 <tr> <td colspan="7" >
                   <table width="100%">
				
                    <tr  id="piechart" style="height: 300px;"><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Date', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  foreach($years as $yrs1){?>  
		
          ['<?php echo $yrs1['years']?>', 
		  <?php
		   $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Cash' || installpayment.payment_type LIKE 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cash' || plotpayment.paidas = 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";          
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Cheque' || installpayment.payment_type LIKE 'cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cheque' || plotpayment.paidas = 'cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";         
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT SUM(total) as po FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Pay Order' || installpayment.payment_type LIKE 'po' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Pay Order' || plotpayment.paidas = 'po' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";          
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT SUM(total) as online FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Online' || installpayment.payment_type LIKE 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Online' || plotpayment.paidas = 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";         
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>, <?php
		   $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'JV' || installpayment.payment_type LIKE 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'JV' || plotpayment.paidas = 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date_temp` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";          
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo ($jv['jv']);
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('daily'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 				 
					 
									
									</script>
                                    <div id="daily"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
												
        
	<?php }
public function actionYearlysummary1112()
	{  
	// echo $_POST['year'];exit;
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
		$where='';

$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and (project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.="(project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}

		
			if ($and==true){$co='where';}
		
												 $sql_year="SELECT DISTINCT YEAR(STR_TO_DATE(`paid_date`,'%d-%m-%Y')) as years,paid_date from installpayment where YEAR(STR_TO_DATE(`paid_date`,'%d-%m-%Y')) >0 GROUP BY years";
													$years = $connection->createCommand($sql_year)->queryAll();
												$currmonth=date('M');
												
                                             
                                               $total = 0;
                                                $gt = 0;
												$tcash = 0;
												$tchq = 0;
												$tpo = 0;
												$tcheque=0;
												$tonline = 0;
                                                $tjv=0;
                                                       foreach($years as $yrs) {                                   
                            			 
												echo'
                                                    <tr>
                                                       
                                                        <td class="text-left">'.$yrs['years'];
															
															                                                                 
                                                        echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'Cash' || installpayment.payment_type LIKE 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cash' || plotpayment.paidas = 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
                                                      //  $sql_cash="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS cash FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Cash' || installpayment.payment_type = 'cash' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";         
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo round(($csh['cash']/1000000),2);
														 $tcash = ($csh['cash']+$tcash);
												 }
                                                        echo'</td>
                                                         <td style="text-align:right">'; 
                                                          $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type = 'Cheque' || installpayment.payment_type = 'cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cheque' || plotpayment.paidas = 'Cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
													  // $sql_cheque="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS cheque FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Cheque' || installpayment.payment_type = 'cheque' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$rescheque = $connection->createCommand($sql_cheque)->queryAll();
												foreach($rescheque as $chq)
												 {
                                                         echo round(($chq['cheque']/1000000),2);
														 $tchq =($chq['cheque']+$tchq);
												 }
														
                                                        echo'</td>
                                                       <td style="text-align:right">';
                                                         $sql_po="SELECT SUM(total) as po FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'po' || installpayment.payment_type LIKE 'Pay Order' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas LIKE 'po' || plotpayment.paidas LIKE 'Pay Order' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
                                                       //  $sql_po="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS po FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Pay Order' || installpayment.payment_type = 'PO' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo round(($po['po']/1000000),2);
														 $tpo = ($po['po']+$tpo);
												 }
                                                        echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_online="SELECT SUM(total) as online FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas LIKE 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
														 //$sql_online="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS online FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'Online' || installpayment.payment_type = 'online' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo round(($online['online']/1000000),2);
														 $tonline = ($online['online']+$tonline);
												 }
                                                        echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas LIKE 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment
                                                                                ";
														 //$sql_jv="SELECT installpayment.paid_date,p.project_id, SUM(paidamount) AS jv FROM installpayment left join plots p on installpayment.plot_id=p.id WHERE ( installpayment.payment_type = 'JV' || installpayment.payment_type = 'jv' )  AND  p.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$_POST['years']."%'";          
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo round(($jv['jv']/1000000),2);
														 $tjv = ($jv['jv']+$tjv);
												 }
                                                       echo'</td><td  style="text-align:right"><strong>'; 
													
																	  
															 $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Pay Order' || installpayment.payment_type LIKE 'PO' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                where plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												//	echo  round($tcash1,2);	
													}
													$sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE 'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Pay Order' || plotpayment.paidas LIKE 'PO' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                               WHERE  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')";  
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
												//	echo  round($tcash2,2);	
													}
													
                                                      echo  number_format(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
													
														  echo'</strong></td></tr>';
                                                       }
                                               
												echo ' <tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong>'.round(($tcash/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tchq/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tpo/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tonline/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round(($tjv/1000000),2).'</strong></td>
												<td style="text-align:right"><strong>'.round($gt,2).'</strong></td>
												</tr>';?>
												 <tr> <td colspan="7" >
                   <table width="100%">
				
                    <tr  id="piechart" style="height: 300px;"><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Date', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  foreach($years as $yrs1){?>  
		
          ['<?php echo $yrs1['years']?>', 
		  <?php
		   $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Cash' || installpayment.payment_type LIKE 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cash' || plotpayment.paidas = 'cash' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";          
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Cheque' || installpayment.payment_type LIKE 'cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Cheque' || plotpayment.paidas = 'cheque' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";         
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT SUM(total) as po FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Pay Order' || installpayment.payment_type LIKE 'po' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Pay Order' || plotpayment.paidas = 'po' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";          
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT SUM(total) as online FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'Online' || installpayment.payment_type LIKE 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'Online' || plotpayment.paidas = 'online' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";         
										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>, <?php
		   $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                    SELECT paidamount AS `total` FROM installpayment 
                                                                                     LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                    WHERE ( installpayment.payment_type LIKE'JV' || installpayment.payment_type LIKE 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `paid_date` LIKE '%".$yrs1['years']."%' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                    UNION ALL
                                                                                    SELECT paidamount AS `total` FROM  plotpayment 
                                                                                     LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                       WHERE ( plotpayment.paidas = 'JV' || plotpayment.paidas = 'jv' )  AND  plots.project_id='".$_POST['project_id']."' AND `date` LIKE '%".$yrs1['years']."%' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                     
                                                                                ) As installpayment";          
										$resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo ($jv['jv']);
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('daily'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 				 
					 
									
									</script>
                                    <div id="daily"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
												
        
	<?php }
		public function actionMonthly123()
	{ 
		if(isset(Yii::app()->session['user_array']['username']))
			{
				$connection = Yii::app()->db;
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
		$pro = $connection->createCommand($sql_project)->queryAll() or mysql_error();
				
				$sql_center  = "SELECT * from sales_center where status=1";
      		$result_center = $connection->createCommand($sql_center)->queryAll();			
			$sql_month = "SELECT DISTINCT MONTHNAME(paid_date) AS MONTHNAME FROM installpayment where paid_date!='' ORDER BY paid_date";
      		$result_month = $connection->createCommand($sql_month)->queryAll();
			$sql_year = "SELECT DISTINCT YEAR(paid_date) AS year FROM installpayment where paid_date!='' ORDER BY paid_date";
      		$result_year = $connection->createCommand($sql_year)->queryAll();
				$this->render('monthly',array('result_center'=>$result_center,'pro'=>$pro,'result_month'=>$result_month,'year'=>$result_year));	
			}else{
				$this->redirect(array('user/dashboard'));
				}
	   	}
	   	
			public function actionMonthlysummary123()
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
		$where='';

$and=false;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and (project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.="(project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}

		
			if ($and==true){$co='where';}
			
			
			
												$currmonth=date('M');
									/*	echo $sql_month="SELECT DISTINCT MONTHNAME(str_to_date(create_date ,'%d-%m-%Y')) AS MONTHNAME,  str_to_date(create_date,'%d-%m-%Y') AS DATE  FROM receipt WHERE str_to_date(create_date ,'%d-%m-%Y') LIKE '%".$_POST['year']."%' GROUP BY MONTHNAME
 ORDER BY MONTHNAME DESC";exit;*/
												/*$sql_month="SELECT DISTINCT MONTHNAME(str_to_date(paid_date,'%d-%m-%Y')) as MONTHNAME,paid_date from installpayment where paid_date between DATE_FORMAT(CURDATE() ,'%".$_POST['year']."%')
											AND CURDATE() GROUP BY monthname ORDER BY MONTHNAME";*/
								$sql_month="SELECT MONTHNAME(str_to_date(paid_date ,'%d-%m-%Y')) AS MONTHNAME,paid_date FROM installpayment WHERE str_to_date(paid_date ,'%d-%m-%Y') LIKE '%".$_POST['year']."%' GROUP BY MONTHNAME ORDER BY Month(str_to_date(paid_date ,'%d-%m-%Y'))";

													$monthly = $connection->createCommand($sql_month)->queryAll();
                                      
                                              $total = 0;
                                              $gt = 0;
                                              $tc=0;
											  $tcq=0;
											  $tp=0;
											  $to=0;
											  $tjv=0;
                                              $count = 0;                                               
                            			   foreach($monthly as $month)
												 {
													echo'<tr>
                                                     
                                                        <td class="text-left">';
															echo $month['MONTHNAME']; 
													                                                            
                                                       echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                                                                                            installpayment.payment_type LIKE 'cash') AND STR_TO_DATE(
                                                                                                            installpayment.paid_date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."'and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                                                                                            plotpayment.paidas LIKE 'cash') AND STR_TO_DATE(
                                                                                                            plotpayment.date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
                                                           							
																	
													$cash = $connection->createCommand($sql_cash)->queryAll();
														  foreach($cash as $cash){
														  
														  echo round($cash['cash']/1000000,2);
														   $tc =($cash['cash']+$tc);
														   
														  }
														 
                                                        echo' </td>
                                                         <td style="text-align:right">';
                                                           $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                                                                                            installpayment.payment_type LIKE 'cheque') AND STR_TO_DATE(
                                                                                                            installpayment.paid_date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                                                                                            plotpayment.paidas LIKE 'cheque') AND STR_TO_DATE(
                                                                                                            plotpayment.date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
													$cheque = $connection->createCommand($sql_cheque)->queryAll();
														  foreach($cheque as $cheque){
														  
														   echo round($cheque['cheque']/1000000,2);
														   
														    $tcq =($cheque['cheque']+$tcq);
														  }
														 
                                                       echo'  </td>
                                                        <td style="text-align:right">';
                                                            $sql_po="SELECT SUM(total) as po FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                            LEFT JOIN plots on installpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  
                                                            AND( installpayment.payment_type LIKE 'po' ||installpayment.payment_type LIKE 'Pay Order') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND STR_TO_DATE( installpayment.paid_date, '%d-%m-%Y' )
                                                            BETWEEN LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH )UNION ALL
                                                            SELECT paidamount AS `total` FROM plotpayment LEFT JOIN plots on plotpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  AND( plotpayment.paidas LIKE 'po') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND STR_TO_DATE( plotpayment.date, '%d-%m-%Y' ) 
                                                            BETWEEN LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH )) As installpayment
";
													$po = $connection->createCommand($sql_po)->queryAll();
														  foreach($po as $po){
														  
														  echo round($po['po']/1000000,2);
														  $tp=($po['po']+$tp);
														  
														  } 
                                                        echo' </td>
                                                        <td  style="text-align:right">';
                                                        $sql_online="SELECT SUM(total) as online FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'Online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'Online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$online = $connection->createCommand($sql_online)->queryAll();
														  foreach($online as $online){ 
														 $to=($online['online']+$to);
														 echo round($online['online']/1000000,2);
														  }
														    echo'</td><td  style="text-align:right">';
                                                        $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$jv = $connection->createCommand($sql_jv)->queryAll();
														  foreach($jv as $jv){ 
														 $tjv=($jv['jv']+$tjv);
														 echo round($jv['jv']/1000000,2);
														  }
														
                                                        echo' </td> <td  style="text-align:right"><strong>'; 
														/*$sql_d  ="SELECT 
																	SUM(CASE When installpayment.payment_type='Cash' Then paidamount Else 0 End ) as cash1,
																	SUM(CASE When installpayment.payment_type='Online' Then paidamount Else 0 End ) as online1,
																	SUM(CASE When installpayment.payment_type='Pay Order' || installpayment.payment_type='PO' Then paidamount Else 0 End ) as po1,
																	SUM(CASE When installpayment.payment_type='Cheque' Then paidamount Else 0 End ) as cheque1,
																	SUM(CASE When installpayment.payment_type='JV' Then paidamount Else 0 End ) as jv1
																	from installpayment 
																	LEFT JOIN plots on installpayment.plot_id=plots.id
																	   WHERE project_id='".$_POST['project_id']."' AND STR_TO_DATE(
                                                                        installpayment.paid_date,
                                                                        '%d-%m-%Y'
                                                                    ) BETWEEN LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                    )";
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000);
													echo  round($tcash1,2);	
													}
														$t=($tcash1)/1000000;
                                                      
														 $gt=$t+$gt;*/
														 	 $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type='Pay Order' || installpayment.payment_type='PO' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                  
                                                                  WHERE installpayment.fstatus !='Cancelled' and (installpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND STR_TO_DATE(
                                                                        installpayment.paid_date,
                                                                        '%d-%m-%Y'
                                                                    ) BETWEEN LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                    )";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												//	echo  round($tcash1,2);	
													}
													$sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Pay Order' || plotpayment.paidas LIKE'PO' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                WHERE plotpayment.fstatus !='Cancelled' and (plotpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND STR_TO_DATE(
                                                                        plotpayment.date,
                                                                        '%d-%m-%Y'
                                                                    ) BETWEEN LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                    )";   
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
												//	echo  round($tcash2,2);	
													}
													
                                                      echo  number_format(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
														 
														  echo'</strong></td></tr>'; 
														} 
   echo'<tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong>'.number_format($tc/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($tcq/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($tp/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($to/1000000,2).'</strong></td>
        <td style="text-align:right"><strong>'.number_format($tjv/1000000,2).'</strong></td>                                        <td style="text-align:right"><strong>'.number_format($gt,2).'</strong></td>
                                                </tr>';?>
                                              
                                             <tr>  <td colspan="7" >
                   <table width="100%">
				
                    <tr  id="piechart" style="height: 300px;"><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Year', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  
		$sql_month="SELECT MONTHNAME(str_to_date(paid_date ,'%d-%m-%Y')) AS MONTHNAME,paid_date FROM installpayment WHERE str_to_date(paid_date ,'%d-%m-%Y') LIKE '%".$_POST['year']."%' GROUP BY MONTHNAME ORDER BY Month(str_to_date(paid_date ,'%d-%m-%Y'))";
													$monthly = $connection->createCommand($sql_month)->queryAll();
		 foreach($monthly as $month)
												 {?>  
		
          ['<?php echo $month['MONTHNAME']?>', 
		  <?php
		   $sql_cash="SELECT SUM(total) as cash FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'cash') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'cash') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";        
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT SUM(total) as cheque FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'cheque') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'cheque') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
																											
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT SUM(total) as po FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'po' ||installpayment.payment_type LIKE 'Pay Order') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'po' || plotpayment.paidas LIKE 'pay order') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT SUM(total) as online FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>,<?php
		   $sql_jv="SELECT SUM(total) as jv FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
                                                                                                    $resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo $jv['jv'];
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('daily'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 
									
									</script>
                                    <div id="daily"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
		
																		
        
	<?php }
		public function actionMonthly()
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
		if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username'])||(Yii::app()->session['user_array']['per34']=='1'))
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
		$connection = Yii::app()->db;
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
		
			$sql_month="SELECT MONTHNAME(str_to_date(paid_date ,'%d-%m-%Y')) AS MONTHNAME,paid_date FROM installpayment WHERE str_to_date(paid_date ,'%d-%m-%Y') LIKE '2014' GROUP BY MONTHNAME ORDER BY Month(str_to_date(paid_date ,'%d-%m-%Y'))";

													$monthly = $connection->createCommand($sql_month)->queryAll();
                                      
                                              $total = 0;
                                              $gt = 0;
                                              $tc=0;
											  $tcq=0;
											  $tp=0;
											  $to=0;
											  $tjv=0;
                                              $count = 0;                                               
                            			   foreach($monthly as $month)
												 {
													echo'<tr>
                                                     
                                                        <td class="text-left">';
															echo $month['MONTHNAME']; 
													                                                            
                                                       echo'</td>
                                                        <td style="text-align:right">';
                                                         $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                                                                                            installpayment.payment_type LIKE 'cash') AND STR_TO_DATE(
                                                                                                            installpayment.paid_date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."'and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                                                                                            plotpayment.paidas LIKE 'cash') AND STR_TO_DATE(
                                                                                                            plotpayment.date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
                                                           							
																	
													$cash = $connection->createCommand($sql_cash)->queryAll();
														  foreach($cash as $cash){
														  
														  echo round($cash['cash']/1000000,2);
														   $tc =($cash['cash']+$tc);
														   
														  }
														 
                                                        echo' </td>
                                                         <td style="text-align:right">';
                                                           $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                                                                                            installpayment.payment_type LIKE 'cheque') AND STR_TO_DATE(
                                                                                                            installpayment.paid_date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                                                                                            plotpayment.paidas LIKE 'cheque') AND STR_TO_DATE(
                                                                                                            plotpayment.date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
													$cheque = $connection->createCommand($sql_cheque)->queryAll();
														  foreach($cheque as $cheque){
														  
														   echo round($cheque['cheque']/1000000,2);
														   
														    $tcq =($cheque['cheque']+$tcq);
														  }
														 
                                                       echo'  </td>
                                                        <td style="text-align:right">';
                                                            $sql_po="SELECT SUM(total) as po FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                            LEFT JOIN plots on installpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  
                                                            AND( installpayment.payment_type LIKE 'po' ||installpayment.payment_type LIKE 'Pay Order') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND STR_TO_DATE( installpayment.paid_date, '%d-%m-%Y' )
                                                            BETWEEN LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH )UNION ALL
                                                            SELECT paidamount AS `total` FROM plotpayment LEFT JOIN plots on plotpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  AND( plotpayment.paidas LIKE 'po') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND STR_TO_DATE( plotpayment.date, '%d-%m-%Y' ) 
                                                            BETWEEN LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH )) As installpayment
";
													$po = $connection->createCommand($sql_po)->queryAll();
														  foreach($po as $po){
														  
														  echo round($po['po']/1000000,2);
														  $tp=($po['po']+$tp);
														  
														  } 
                                                        echo' </td>
                                                        <td  style="text-align:right">';
                                                        $sql_online="SELECT SUM(total) as online FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'Online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'Online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$online = $connection->createCommand($sql_online)->queryAll();
														  foreach($online as $online){ 
														 $to=($online['online']+$to);
														 echo round($online['online']/1000000,2);
														  }
														    echo'</td><td  style="text-align:right">';
                                                        $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$jv = $connection->createCommand($sql_jv)->queryAll();
														  foreach($jv as $jv){ 
														 $tjv=($jv['jv']+$tjv);
														 echo round($jv['jv']/1000000,2);
														  }
														
                                                        echo' </td> <td  style="text-align:right"><strong>'; 
														
														 	 $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type='Pay Order' || installpayment.payment_type='PO' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                  
                                                                  WHERE installpayment.fstatus !='Cancelled' and (installpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND STR_TO_DATE(
                                                                        installpayment.paid_date,
                                                                        '%d-%m-%Y'
                                                                    ) BETWEEN LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                    )";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												//	echo  round($tcash1,2);	
													}
													$sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Pay Order' || plotpayment.paidas LIKE'PO' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                WHERE plotpayment.fstatus !='Cancelled' and (plotpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND STR_TO_DATE(
                                                                        plotpayment.date,
                                                                        '%d-%m-%Y'
                                                                    ) BETWEEN LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                    )";   
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
												//	echo  round($tcash2,2);	
													}
													
                                                      echo  number_format(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
														 
														  echo'</strong></td></tr>'; 
														} 
  
	
			$this->render('monthly',array('projects'=>$result_projects,'pro'=>$pro));
			}else{
				$this->redirect(array('user/dashboard'));
				}
			
	

	
	}
		public function actionMonthlysummary()
		{ 			$connection = Yii::app()->db; 
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		
$where='';
$totalpp=0;
$t=0;
$year=0;
$project_id=0;
if (!empty($_POST['project_id'])){
	$project_id=$_POST['project_id'];
$where.=" project_id LIKE '%".$_POST['project_id']."%'";
}
if (!empty($_POST['year1']))
{
$year=$_POST['year1'];
}
$sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		
		
	
	$count=0;
		$home=Yii::app()->request->baseUrl;
  $sql_month="SELECT MONTHNAME(paid_date_temp) AS MONTHNAME,paid_date_temp FROM installpayment WHERE (paid_date_temp) LIKE '%".$year."%' GROUP BY MONTHNAME ORDER BY Month(paid_date_temp)" ;

													$monthly = $connection->createCommand($sql_month)->queryAll();
                                      
                                              $total = 0;
                                              $gt = 0;
                                              $tc=0;
											  $tcq=0;
											  $tp=0;
											  $to=0;
											  $tjv=0;
                                              $count = 0;                                               
                            			   foreach($monthly as $month)
												 {
													echo'<tr>
                                                     
                                                        <td class="text-left">';
															echo $month['MONTHNAME']; 
													                                                            
                                                       echo'</td>
                                                        <td style="text-align:right">';
                                                           $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                           installpayment.payment_type LIKE 'cash') AND (installpayment.paid_date_temp) BETWEEN 
										   LAST_DAY(('".$month['paid_date_temp']."') - INTERVAL 1 MONTH) + INTERVAL 1 DAY 
										   AND LAST_DAY(('".$month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."'and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                        plotpayment.paidas LIKE 'cash') AND (plotpayment.paid_date_temp) BETWEEN 
										LAST_DAY(('".$month['paid_date_temp']."') - INTERVAL 1 MONTH) + INTERVAL 1 DAY AND 
										LAST_DAY(('".$month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
                                                           							
																	
													$cash = $connection->createCommand($sql_cash)->queryAll();
														  foreach($cash as $cash){
														  
														  echo round($cash['cash']/1000000,2);
														   $tc =($cash['cash']+$tc);
														   
														  }
														 
                                                        echo' </td>
                                                         <td style="text-align:right">';
                                                           $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                                                                                            installpayment.payment_type LIKE 'cheque') AND 
										(installpayment.paid_date_temp) BETWEEN LAST_DAY(
                                                                                                            ('".$month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            ('".$month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                                                                                            plotpayment.paidas LIKE 'cheque') AND
																											(plotpayment.paid_date_temp) BETWEEN LAST_DAY(
                                                                                                            ('".$month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            ('".$month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
													$cheque = $connection->createCommand($sql_cheque)->queryAll();
														  foreach($cheque as $cheque){
														  
														   echo round($cheque['cheque']/1000000,2);
														   
														    $tcq =($cheque['cheque']+$tcq);
														  }
														 
                                                       echo'  </td>
                                                        <td style="text-align:right">';
                                                            $sql_po="SELECT SUM(total) as po FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                            LEFT JOIN plots on installpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  
                                                            AND( installpayment.payment_type LIKE 'po' ||installpayment.payment_type LIKE 'Pay Order') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND ( installpayment.paid_date_temp)
                                                            BETWEEN LAST_DAY(('". $month['paid_date_temp']."') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY( ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH )UNION ALL
                                                            SELECT paidamount AS `total` FROM plotpayment LEFT JOIN plots on plotpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  AND( plotpayment.paidas LIKE 'po') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND ( plotpayment.paid_date_temp) 
                                                            BETWEEN LAST_DAY(('". $month['paid_date_temp']."') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY(('". $month['paid_date_temp']."') + INTERVAL 1 MONTH )) As installpayment
";
													$po = $connection->createCommand($sql_po)->queryAll();
														  foreach($po as $po){
														  
														  echo round($po['po']/1000000,2);
														  $tp=($po['po']+$tp);
														  
														  } 
                                                        echo' </td>
                                                        <td  style="text-align:right">';
                                                        $sql_online="SELECT SUM(total) as online FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'Online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND
																								  (installpayment.paid_date_temp) BETWEEN LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'Online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND(plotpayment.paid_date_temp) BETWEEN LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$online = $connection->createCommand($sql_online)->queryAll();
														  foreach($online as $online){ 
														 $to=($online['online']+$to);
														 echo round($online['online']/1000000,2);
														  }
														    echo'</td><td  style="text-align:right">';
                                                        $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND 
																								 (installpayment.paid_date_temp) BETWEEN LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND (
                                                                                                                    plotpayment.paid_date_temp
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$jv = $connection->createCommand($sql_jv)->queryAll();
														  foreach($jv as $jv){ 
														 $tjv=($jv['jv']+$tjv);
														 echo round($jv['jv']/1000000,2);
														  }
														
                                                        echo' </td> <td  style="text-align:right"><strong>'; 
														
														 	  $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type='Pay Order' || installpayment.payment_type='PO' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                  
                                                                  WHERE installpayment.fstatus !='Cancelled' and (installpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND (installpayment.paid_date_temp) BETWEEN LAST_DAY(
                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                    )";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												//	echo  round($tcash1,2);	
													}
													 $sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Pay Order' || plotpayment.paidas LIKE'PO' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                WHERE plotpayment.fstatus !='Cancelled' and (plotpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND (
                                                                        plotpayment.paid_date_temp
                                                                    ) BETWEEN LAST_DAY(
                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                    )";   
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
												//	echo  round($tcash2,2);	
													}
													
                                                      echo  number_format(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
														 
														  echo'</strong></td></tr>'; 
														} 
   echo'<tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong>'.number_format($tc/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($tcq/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($tp/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($to/1000000,2).'</strong></td>
        <td style="text-align:right"><strong>'.number_format($tjv/1000000,2).'</strong></td>                                        <td style="text-align:right"><strong>'.number_format($gt,2).'</strong></td>
                                                </tr>';?>
		
	<tr>  <td colspan="7" >
                   <table width="100%">
				
                    <tr  id="piechart" style="height: 300px;"><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Year', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  
		$sql_month="SELECT MONTHNAME((paid_date_temp)) AS MONTHNAME,paid_date_temp FROM installpayment WHERE (paid_date_temp ) LIKE '%".$year."%' GROUP BY MONTHNAME ORDER BY Month((paid_date_temp))";
													$monthly = $connection->createCommand($sql_month)->queryAll();
		 foreach($monthly as $month)
												 {?>  
		
          ['<?php echo $month['MONTHNAME']?>', 
		  <?php
		   $sql_cash="SELECT SUM(total) as cash FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'cash') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                        installpayment.paid_date_temp                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'cash') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                                    plotpayment.paid_date_temp
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";        
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT SUM(total) as cheque FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'cheque') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                        installpayment.paid_date_temp
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'cheque') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                                    plotpayment.paid_date_temp
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
																											
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT SUM(total) as po FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'po' ||installpayment.payment_type LIKE 'Pay Order') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                        installpayment.paid_date_temp
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'po' || plotpayment.paidas LIKE 'pay order') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                                    plotpayment.date
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT SUM(total) as online FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                        installpayment.paid_date_temp
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                                    plotpayment.paid_date_temp
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>,<?php
		   $sql_jv="SELECT SUM(total) as jv FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                        installpayment.paid_date_temp
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."' AND (
                                                                                                                    plotpayment.paid_date_temp
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    ('". $month['paid_date_temp']."') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
                                                                                                    $resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo $jv['jv'];
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('daily'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 
									
									</script>
                                    <div id="daily"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
		
																		
        
	<?php }
		}
		public function actionMonthlysummary111()
		{ 			$connection = Yii::app()->db; 
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		
$where='';
$totalpp=0;
$t=0;
$year=0;
$project_id=0;
if (!empty($_POST['project_id'])){
	$project_id=$_POST['project_id'];
$where.=" project_id LIKE '%".$_POST['project_id']."%'";
}
if (!empty($_POST['year1']))
{
$year=$_POST['year1'];
}
$sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		
		
	
	$count=0;
		$home=Yii::app()->request->baseUrl;
 $sql_month="SELECT MONTHNAME(str_to_date(paid_date ,'%d-%m-%Y')) AS MONTHNAME,paid_date FROM installpayment WHERE str_to_date(paid_date ,'%d-%m-%Y') LIKE '%".$year."%' GROUP BY MONTHNAME ORDER BY Month(str_to_date(paid_date ,'%d-%m-%Y'))"; ;

													$monthly = $connection->createCommand($sql_month)->queryAll();
                                      
                                              $total = 0;
                                              $gt = 0;
                                              $tc=0;
											  $tcq=0;
											  $tp=0;
											  $to=0;
											  $tjv=0;
                                              $count = 0;                                               
                            			   foreach($monthly as $month)
												 {
													echo'<tr>
                                                     
                                                        <td class="text-left">';
															echo $month['MONTHNAME']; 
													                                                            
                                                       echo'</td>
                                                        <td style="text-align:right">';
                                                           $sql_cash="SELECT SUM(total) as cash FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                                                                                            installpayment.payment_type LIKE 'cash') AND STR_TO_DATE(
                                                                                                            installpayment.paid_date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."'and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                                                                                            plotpayment.paidas LIKE 'cash') AND STR_TO_DATE(
                                                                                                            plotpayment.date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
                                                           							
																	
													$cash = $connection->createCommand($sql_cash)->queryAll();
														  foreach($cash as $cash){
														  
														  echo round($cash['cash']/1000000,2);
														   $tc =($cash['cash']+$tc);
														   
														  }
														 
                                                        echo' </td>
                                                         <td style="text-align:right">';
                                                           $sql_cheque="SELECT SUM(total) as cheque FROM (
                                                                                                        SELECT paidamount AS `total` FROM installpayment 
                                                                                                         LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id ='".$_POST['project_id']."' and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND(
                                                                                                            installpayment.payment_type LIKE 'cheque') AND STR_TO_DATE(
                                                                                                            installpayment.paid_date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )UNION ALL
                                                                                                        SELECT paidamount AS `total` FROM plotpayment 
                                                                                                         LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE
                                                                                                        project_id = '".$_POST['project_id']."' and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND(
                                                                                                            plotpayment.paidas LIKE 'cheque') AND STR_TO_DATE(
                                                                                                            plotpayment.date,
                                                                                                            '%d-%m-%Y'
                                                                                                        ) BETWEEN LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                        ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                            STR_TO_DATE('".$month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                        )) As installpayment";
													$cheque = $connection->createCommand($sql_cheque)->queryAll();
														  foreach($cheque as $cheque){
														  
														   echo round($cheque['cheque']/1000000,2);
														   
														    $tcq =($cheque['cheque']+$tcq);
														  }
														 
                                                       echo'  </td>
                                                        <td style="text-align:right">';
                                                            $sql_po="SELECT SUM(total) as po FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                            LEFT JOIN plots on installpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  
                                                            AND( installpayment.payment_type LIKE 'po' ||installpayment.payment_type LIKE 'Pay Order') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce') AND STR_TO_DATE( installpayment.paid_date, '%d-%m-%Y' )
                                                            BETWEEN LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH )UNION ALL
                                                            SELECT paidamount AS `total` FROM plotpayment LEFT JOIN plots on plotpayment.plot_id=plots.id WHERE project_id = '".$_POST['project_id']."'  AND( plotpayment.paidas LIKE 'po') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') AND STR_TO_DATE( plotpayment.date, '%d-%m-%Y' ) 
                                                            BETWEEN LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH ) + INTERVAL 1 DAY AND LAST_DAY( STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH )) As installpayment
";
													$po = $connection->createCommand($sql_po)->queryAll();
														  foreach($po as $po){
														  
														  echo round($po['po']/1000000,2);
														  $tp=($po['po']+$tp);
														  
														  } 
                                                        echo' </td>
                                                        <td  style="text-align:right">';
                                                        $sql_online="SELECT SUM(total) as online FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'Online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'Online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$online = $connection->createCommand($sql_online)->queryAll();
														  foreach($online as $online){ 
														 $to=($online['online']+$to);
														 echo round($online['online']/1000000,2);
														  }
														    echo'</td><td  style="text-align:right">';
                                                        $sql_jv="SELECT SUM(total) as jv FROM (
                                                                                                SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='".$_POST['project_id']."'  AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
													$jv = $connection->createCommand($sql_jv)->queryAll();
														  foreach($jv as $jv){ 
														 $tjv=($jv['jv']+$tjv);
														 echo round($jv['jv']/1000000,2);
														  }
														
                                                        echo' </td> <td  style="text-align:right"><strong>'; 
														
														 	  $sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type='Pay Order' || installpayment.payment_type='PO' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE 'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                  
                                                                  WHERE installpayment.fstatus !='Cancelled' and (installpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND STR_TO_DATE(
                                                                        installpayment.paid_date,
                                                                        '%d-%m-%Y'
                                                                    ) BETWEEN LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                    )";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												//	echo  round($tcash1,2);	
													}
													 $sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Pay Order' || plotpayment.paidas LIKE'PO' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                WHERE plotpayment.fstatus !='Cancelled' and (plotpayment.fstatus !='Bounce') AND plots.project_id='".$_POST['project_id']."' AND STR_TO_DATE(
                                                                        plotpayment.date,
                                                                        '%d-%m-%Y'
                                                                    ) BETWEEN LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                    )";   
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
												//	echo  round($tcash2,2);	
													}
													
                                                      echo  number_format(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
														 
														  echo'</strong></td></tr>'; 
														} 
   echo'<tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong>'.number_format($tc/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($tcq/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($tp/1000000,2).'</strong></td><td style="text-align:right"><strong>'.number_format($to/1000000,2).'</strong></td>
        <td style="text-align:right"><strong>'.number_format($tjv/1000000,2).'</strong></td>                                        <td style="text-align:right"><strong>'.number_format($gt,2).'</strong></td>
                                                </tr>';?>
		
	<tr>  <td colspan="7" >
                   <table width="100%">
				
                    <tr  id="piechart" style="height: 300px;"><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Year', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  
		$sql_month="SELECT MONTHNAME(str_to_date(paid_date ,'%d-%m-%Y')) AS MONTHNAME,paid_date FROM installpayment WHERE str_to_date(paid_date ,'%d-%m-%Y') LIKE '%".$year."%' GROUP BY MONTHNAME ORDER BY Month(str_to_date(paid_date ,'%d-%m-%Y'))";
													$monthly = $connection->createCommand($sql_month)->queryAll();
		 foreach($monthly as $month)
												 {?>  
		
          ['<?php echo $month['MONTHNAME']?>', 
		  <?php
		   $sql_cash="SELECT SUM(total) as cash FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'cash') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'cash') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";        
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT SUM(total) as cheque FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'cheque') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'cheque') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
																											
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT SUM(total) as po FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'po' ||installpayment.payment_type LIKE 'Pay Order') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'po' || plotpayment.paidas LIKE 'pay order') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT SUM(total) as online FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";										$resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>,<?php
		   $sql_jv="SELECT SUM(total) as jv FROM ( SELECT paidamount AS `total` FROM installpayment 
                                                                                                 LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                                                 WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                        installpayment.paid_date,
                                                                                                        '%d-%m-%Y'
                                                                                                    ) BETWEEN LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                    ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                        STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                    )
                                                                                                UNION ALL
                                                                                                SELECT paidamount AS `total` FROM  plotpayment 
                                                                                                 LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                                                    WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                                                                                 and plots.project_id='1' AND STR_TO_DATE(
                                                                                                                    plotpayment.date,
                                                                                                                    '%d-%m-%Y'
                                                                                                                ) BETWEEN LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') - INTERVAL 1 MONTH
                                                                                                                ) + INTERVAL 1 DAY AND LAST_DAY(
                                                                                                                    STR_TO_DATE('". $month['paid_date']."', '%d-%m-%Y') + INTERVAL 1 MONTH
                                                                                                                )
                                                                                                                                        ) As installpayment";
                                                                                                    $resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo $jv['jv'];
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('daily'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 
									
									</script>
                                    <div id="daily"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
		
																		
        
	<?php }
		}
			public function actionFinancial_Reports()
	{ 
		if(isset(Yii::app()->session['user_array']['username']))
			{
				 $connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 =   "select * from projects where ";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
		$sql_project = $sql1;
		$sql_project = $sql_project.implode(' or',$sql2);
		$pro = $connection->createCommand($sql_project)->queryAll() or mysql_error();
				
				$sql_proj  = "SELECT * from projects where status=1";
      		$result_proj = $connection->createCommand($sql_proj)->queryAll();			
		
				$this->render('financial_reports',array('proj'=>$result_proj,'pro'=>$pro));	
			}else{
				$this->redirect(array('user/dashboard'));
				}
	   	}
	   	public function actionSales_Centers()
	{ 
		if(isset(Yii::app()->session['user_array']['username']))
			{
				$connection = Yii::app()->db;
				 $result_center = ''; 
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
		$pro = $connection->createCommand($sql_project)->queryAll() or mysql_error();
				
				$sql_proj  = "SELECT * from projects where status=1";
      		$result_proj = $connection->createCommand($sql_proj)->queryAll();
      	
		
				$this->render('sales_centers',array('result_center'=>$result_center,'proj'=>$result_proj));	
			}else{
				$this->redirect(array('user/dashboard'));
				}
	   	}
	///////END:Financial Reports/////////////////////
	
    
    
    
		/////////////////////START:Unsupervised  List//////////////////////
	public function actionUnsup_list()
	{
		if(isset(Yii::app()->session['user_array']['username']))
			{
			
			
		$connection = Yii::app()->db; 
    

		$sql1 =   "select * from projects";
		$result_projects = $connection->createCommand($sql1)->query();
		
	
		$sql_categories  = "SELECT * from categories";
		$categories = $connection->createCommand($sql_categories)->query();
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();
		    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
		    $home=Yii::app()->request->baseUrl; 
			if(isset($_POST['search'])){
            $res=array();
           }
			$this->render('unsup_list',array('sectors'=>$result_sector,'pro'=>$result_projects,'categories'=>$categories,'sizes'=>$sizes));
			}else{
				$this->redirect(array('user/dashboard'));
				}
	   	}
	public function actionSusr()
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
		
		$where='receipt.fstatus !="Cancelled" and receipt.fstatus !="Bounce" ';

$and=true;
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and (p.project_id ='".$_POST['project_id']."' )";
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
			/*if(Yii::app()->session['user_array']['per18']==1 && Yii::app()->session['user_array']['per19']==0 && Yii::app()->session['user_array']['per20']==0 && Yii::app()->session['user_array']['per21']==0){
			
			if ($and==true){	
			$where .=' and receipt.user='.Yii::app()->session['user_array']['id'];	
			}else{$where .=' receipt.user='.Yii::app()->session['user_array']['id'];	}*/
			$and=true;
			
			$where .=" and receipt.bank_details='' and receipt.fstatus=''";	
		
			//}	
			///if(Yii::app()->session['user_array']['per19']==1){
			//if ($and==true){
			//////$where .=' and user.sc_id='.Yii::app()->session['user_array']['sc_id'];	
			///}else{$where .=' user.sc_id='.Yii::app()->session['user_array']['sc_id'];}
			$jo='Left Join user on(receipt.user=user.id)';
			$and=true;
			if (!isset($_POST['status1'])){	
			$where .=" and receipt.bank_details=''";	
			}
			///}
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
$limit = 100;}
$adjacent = 100;
$page = $_REQUEST['page'];
if($page==1){
$start = 0;  
}
else{
$start = ($page-1)*$limit;
} 

		$connection = Yii::app()->db; 
	 $sql_payment1  = "SELECT rpt_print.r_no,receipt.*,m.*,receipt.id as rid FROM receipt 
left join members m on receipt.mem_id=m.id
Inner join rpt_print on rpt_print.rid=receipt.id
left join plots p on rpt_print.msid=p.id 
left join property prop on rpt_print.msid=prop.id 

$jo
$co $where $filter  group by rpt_print.rid
";//echo 123;exit;

		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
		$rows =count($result_payments1);
		 $sql_payment  = "SELECT rpt_print.r_no,receipt.*,receipt.id as rid,m.name,m.cnic as mcnic,receipt.create_date as rcd  FROM receipt
left join members m on receipt.mem_id=m.id
Inner join rpt_print on rpt_print.rid=receipt.id
left join plots p on rpt_print.msid=p.id 
left join property prop on rpt_print.msid=prop.id 

$jo
$co 
$where $filter group by rpt_print.rid
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
		$count++;
	$connection = Yii::app()->db; 
 	$sql_payment2  = "SELECT * FROM rpt_print where rid='".$key['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	  echo '<tr><td>'.$count.'</td><td>'.$key['r_no'].'</td><td>';
  if(($key['fstatus']=='Cancelled')||($key['fstatus']=='Bounce')){
	  echo'';
	  }
	  else if($key['typed']==0){
  echo $key['rid'];
  }else{echo '<a  href="Updaterecieptd?id='.$key['rid'].'">'.$key['rid'].'</a>';
  }
  echo '</td><td>'.date("d-m-Y", strtotime($key['rcd'] )).'</td><td>'.$key['name'].'</td><td>'.$key['mcnic'].'</td><td style="text-align:right;">'.number_format($key['amount']).'</td><td>'.$key['ref_no'].'</td><td>'.$key['type'].'</td><td>';
  echo '<span style="color:red;">'.$key['fstatus'].'</span>';echo'</td>';
?>

<?php 
echo'';
$color='';

if($key['enableedit']=='1'){$color='red';}else{$color='';}
  echo '<td style="background-color:'.$color.';  ">';
  if(($key['fstatus']=='Cancelled')||($key['fstatus']=='Bounce')){
	  echo'';
	  }else{
  echo''.count($result_payments2).'';
	  }
  echo'</td>';
          
                 
          echo '</tr>';
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
	/////////////////////END: Unsupervised List////////////////////////
	
     		//////////////////////START: CANCELLATION MODULE////////////////////
	
	public function actionCancellation_lis()
		{
             if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) &&(empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
				$connection = Yii::app()->db;
                                $error="";
				$sql_com_res = "SELECT DISTINCT com_res FROM plots";
				$result_com_res = $connection->createCommand($sql_com_res)->query();
				$temp_projects_array = Yii::app()->session['projects_array'];
				$num_of_projects_counter = count($temp_projects_array);
				$num_of_projects_counter2 = $num_of_projects_counter;
				$sql1 =   "select * from projects where";
				$num_of_projects_counter--;
				while ($num_of_projects_counter > -1) {
					$sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
					$num_of_projects_counter--;
				}
				$sql_project = $sql1;
				$sql_project = $sql_project . implode(' or', $sql2);
				$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
				$this->render('cancellation_lis', array('error' => $error, 'projects' => $result_projects, 'com_res' => $result_com_res));
				exit;
			}
            if(isset(Yii::app()->session['user_array']['username'])){	
			$name='';
			$sodowo='';
			$cnic='';
			$plotno='';
			$project_name='';
			$plot_detail_address='';
			$where='';
			$and = false;
			if (!empty($_POST['name'])){
				$where.=" m.name =".$_POST['name']."";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo =".$_POST['sodowo']."";

				}
				else
				{

					$where.=" m.sodowo =".$_POST['sodowo']."";

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
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id  '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
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
				$sql2='';
				$members="";
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
					$error="";
			$and = false;
			$where='';
			if (!empty($_POST['name'])){
				$where.=" m.name LIKE '%".$_POST['name']."%'";
				$and = true;
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
					$where.=" and m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				else
				{
					$where.=" m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				$and=true;
			}
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

//if($and ==true){echo 0;}else{echo 1;}exit;

			

			if (!empty($_POST['plot_detail_address'])){

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

	 $sql_member = "SELECT cp.detail,cp.type,cp.status,cp.cancel_date,cp.fstatus,mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
Left JOIN cancelplot cp ON p.id=cp.plot_id
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id "; 
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

			if(isset($_POST['search'])){

            $res=array();
			

            foreach($members as $key){

  echo '<tr><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a>
  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

</br>';if($key['status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer asdsaasdPlot</a>';}

echo'  </td></tr>'; 

            }
			}

			$this->render('cancellation_lis',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionCancellationreq()
 		{
		$where='';
		$and=false;
		$and = false;
			if (!empty($_POST['name1'])){
				$where.=" m.name LIKE '%".$_POST['name1']."%'";
				$and = true;
			}
			/*if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m_to.name LIKE '%".$_POST['sodowo']."%'";

				}
				else
				{

					$where.=" m_to.name LIKE '%".$_POST['sodowo']."%'";

				}
				$and=true;

			}*/

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m_from.cnic =".$_POST['cnic']."";
				}
				else
				{
					$where.=" m_from.cnic =".$_POST['cnic']."";
				}
				$and=true;
			}if (!empty($_POST['allotmentstatus'])){
$allotmentstatus='';
if($_POST['allotmentstatus']==1){if ($and==true)
				{
					$where.=" and mp.status='Approved'";
				}
				else
				{
					$where.=" mp.status='Approved'";
				}}
if($_POST['allotmentstatus']==2){if ($and==true)
				{
					$where.=" and mp.status!='Approved'";
				}
				else
				{
					$where.=" mp.status!='Approved'";
				}}
				
				$and=true;
			}
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
			/*if (!empty($_POST['stat'])){
				$q='';
				if($_POST['stat']=='1'){$q="tp.status='New Request'";}
				if($_POST['stat']=='2'){$q="tp.status='sales'";}
				if($_POST['stat']=='3'){$q="tp.status='Approved'";}
				if ($and==true)
				{
					$where.=" and ".$q."";
				}
				else
				{
					$where.=$q;
				}
				$and==true;
			}*/
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotnoLIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
			
			/*if(Yii::app()->session['user_array']['per12']==1 && Yii::app()->session['user_array']['per20']==0){
			if ($and==true){
			$where .=' and tp.uid='.Yii::app()->session['user_array']['id'];	
			}else{$where .=' tp.uid='.Yii::app()->session['user_array']['id'];}
			$and=true;
			if (!isset($_POST['stat'])){	
			$where .=" and tp.status!='sales'";	
			}
			}
			
			if(Yii::app()->session['user_array']['per20']==1){
			
			if (!isset($_POST['stat'])){	
			if ($and==true){
			$where .="and tp.status!='Sales'";	
			}else{$where .=" tp.status!='Sales'";}
			$and=true;
			}
			}
			
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
			}	*/			
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
echo $sql_memberas = "SELECT mp.*,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name,mp.plotno,m.name to_name FROM memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN projects pro ON pro.id=p.project_id
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			 where $where and cp.status='approved' and cp.fstatus='New'";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     $sql_member = "SELECT cp.status as cpstatus,mp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name, cp.status as cpstatus, mp.plotno,m.name from memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where $where and cp.status='approved' and cp.fstatus='New' limit $start,$limit"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

				echo '<tr><td>';if(empty($key['plotno'])){ echo 'App-'. $key['app_no'];}else { echo $key['plotno'];}echo'</td>
				<td>'.$key['name'].'</td>
				
				<td>'.$key['size'].'</td>
				<td>'.$key['plot_detail_address'].'</td>
				<td>'.$key['street'].'</td>
				<td>'.$key['sector_name'].'</td>
				<td>'.$key['project_name'].'</td>
				<td>';if($key['cpstatus']=='New'){ echo 'Requested (M)';}else {echo'Requested (F)';}echo'</td>
				
				<td>';
				echo '<a href="creq_detail?plot_id='.$key['plot_id'].'">Request Detail</a>';
				
				if(Yii::app()->session['user_array']['per12']==1){
					if($key['cpstatus']=='New'){
				//echo '<a href="treq_detail?id='.$key['tid'].'">Cancel Transfer Request</a>';
					}
				}
				echo '</td></tr>'; 
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



	}
		public function actionCreq_detail()
		{
	if((Yii::app()->session['user_array']['per12']=='1') && isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db; 	
			  $sql_details  = "SELECT cp.damount,cp.detail,cp.type,cp.status as cpstatus,cp.cancel_date,cp.fstatus as cpfstatus,cp.fcomment as cpfcomment,cp.sucomment as sucomment,mp.*,mp.id as mpid,cp.status as cpstatus,s.street,p.plot_detail_address,p.plot_size,pro.code,sc.code as scode,mp.plotno,mp.tempms,sc.size,mp.comment,se.sector_name,pro.project_name,m.id as mid,m.name,ss.name as ssname,p.com_res,u.email,u.firstname,u.middelname,u.lastname,p.project_id FROM memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN cancelplot cp ON p.id=cp.plot_id
			left join user u on cp.uid=u.id
			left join sales_center ss on u.sc_id=ss.id
			Left JOIN projects pro ON pro.id=p.project_id where cp.plot_id=".$_REQUEST['plot_id']."";
			$result_details = $connection->createCommand($sql_details)->queryRow();
			$this->render('creq_detail',array('plotdetails'=>$result_details)); 
			}else{$this->redirect(array("dashboard"));}



	}
	
	public function actionFapproved()
	{
				$connection = Yii::app()->db; 
				$error='';
				if(isset($_POST['fstatus']) && $_POST['fstatus']==''){
					$error .='Please Select Status<br>';
				}
					if(isset($_POST['fcomment']) && $_POST['fcomment']==''){
					$error .='Please Enter Comments';
				}
				if(empty($error)){
				 $update  = "UPDATE cancelplot set fstatus='Approved',status='approved',fcomment='".$_POST['fcomment']."' WHERE plot_id='".$_REQUEST['plot_id']."'";		
   			    $command = $connection -> createCommand($update);
                $command -> execute();

				echo '<script>location.href="cancellation_lis";</script>';exit;
				}else{
					echo $error;
					}

	}
	
	
	
//////////////////////////END: CANCELLATION MODULE/////////////////////////	
     		
     		public function actionReceivableexl(){
			$connection = Yii::app()->db; 
		
	 ///////////////////////FUNCTION 1 START//////////////////
	  	$connection = Yii::app()->db; 
	   $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
	///////////////////////FUNCTION 1 END/////////////////////////
	
	///////////////////////FUNCTIOM 2 START//////////////////////
		  $totaldays = 28;
		  $date=date("d-m-Y");
		 
		  $type=3;
        $datetime1 = date_create(date("d-m-Y",  strtotime($date)));
        $datetime2 = date_create(date("d-m-Y", strtotime($startdate)));
      /*  print_r($datetime1);
		echo '</br>';
		print_r($datetime2);exit;*/
		$interval = date_diff($datetime1, $datetime2);
       
        $months = ($interval->y * 12) + $interval->m + ($interval->d==0? 0: 1);

        $count=0;
        $i=0;
		$model=array();
        
        while($i < $months) {
           $datetime1->modify("+".$type." months");
			 $model[]=array(
              'id'=>  $datetime1->format("m"),
              'secid'=>  $datetime1->format("Y"),
              'value'=>  $datetime1->format("M")."-".$datetime1->format("Y"),
              'tag'=>  $datetime1->format("Y")
            );
            $count++;
            $i+=$type;
			
        } //print_r($model);exit;
      //////////////////////////////////FUNCTION 2 END///////////////////////////////
	  
	  
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,plots.price,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";

        $fixedcolumns.=" ,installpayments.Due_Amount, installpayments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) installpayments 
			  
			on installpayments.plot_id = memberplot.plot_id  ";
        $count=0;
        $nextcount=3;
        for($i=0; $i<count($model);$i++) {
		    $dynamiccolumns .= " ,ip".$model[$i]["id"].$model[$i]["secid"].".Due_Amount as due".$model[$i]["id"].$model[$i]["secid"]." ";
            $dynamicjoins.= " left join
	  (Select
	  Sum(installpayment.dueamount) As Due_Amount,
	  installpayment.plot_id
     From
     installpayment
     Where
	 Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') >=
	 Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')  +  INTERVAL ".$count." MONTH
     AND
     Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
     Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d') +  INTERVAL ".$nextcount." MONTH
     Group By
     installpayment.plot_id) ip".$model[$i]["id"].$model[$i]["secid"]." 
     on ip".$model[$i]["id"].$model[$i]["secid"].".plot_id = memberplot.plot_id";
            $count+=3;
            $nextcount+=3;
			
        }
		  $sorting.=" Order By  memberplot.plotno ";
		  $sql = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting;			
        
		$connection = Yii::app()->db; 
     
		$cmdrow1 = $connection->createCommand($sql)->queryAll();
       // return $cmdrow->queryAll();

			
			
		
	
			$this->render('receivableexl',array('model'=>$model,'cmdrow1'=>$cmdrow1));
			} 
     public function actionRecajax(){
	
	 ///////////////////////FUNCTION 1 START//////////////////
	  	$connection = Yii::app()->db; 
	   $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
	///////////////////////FUNCTION 1 END/////////////////////////
	
	///////////////////////FUNCTIOM 2 START//////////////////////
		  $totaldays = 28;
		  $date=date("d-m-Y");
		 
		  $type=3;
        $datetime1 = date_create(date("d-m-Y",  strtotime($date)));
        $datetime2 = date_create(date("d-m-Y", strtotime($startdate)));
      /*  print_r($datetime1);
		echo '</br>';
		print_r($datetime2);exit;*/
		$interval = date_diff($datetime1, $datetime2);
       
        $months = ($interval->y * 12) + $interval->m + ($interval->d==0? 0: 1);

        $count=0;
        $i=0;
		$model=array();
        
        while($i < $months) {
           $datetime1->modify("+".$type." months");
			 $model[]=array(
              'id'=>  $datetime1->format("m"),
              'secid'=>  $datetime1->format("Y"),
              'value'=>  $datetime1->format("M")."-".$datetime1->format("Y"),
              'tag'=>  $datetime1->format("Y")
            );
            $count++;
            $i+=$type;
			
        } //print_r($model);exit;
      //////////////////////////////////FUNCTION 2 END///////////////////////////////
	  
	  
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";

        $fixedcolumns.=" ,installpayments.Due_Amount, installpayments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) installpayments 
			  
			on installpayments.plot_id = memberplot.plot_id  ";
        $count=0;
        $nextcount=3;
        for($i=0; $i<count($model);$i++) {
		    $dynamiccolumns .= " ,ip".$model[$i]["id"].$model[$i]["secid"].".Due_Amount as due".$model[$i]["id"].$model[$i]["secid"]." ";
            $dynamicjoins.= " left join
	  (Select
	  Sum(installpayment.dueamount) As Due_Amount,
	  installpayment.plot_id
     From
     installpayment
     Where
	 Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') >=
	 Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')  +  INTERVAL ".$count." MONTH
     AND
     Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
     Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d') +  INTERVAL ".$nextcount." MONTH
     Group By
     installpayment.plot_id) ip".$model[$i]["id"].$model[$i]["secid"]." 
     on ip".$model[$i]["id"].$model[$i]["secid"].".plot_id = memberplot.plot_id";
            $count+=3;
            $nextcount+=3;
			
        }
		  $sorting.=" Order By  memberplot.plotno ";
		  $sql = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting;			
        
		$connection = Yii::app()->db; 
     
		$cmdrow1 = $connection->createCommand($sql)->queryAll();
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
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
	 $this->render('recajax',array('model'=>$model,'cmdrow1'=>$cmdrow1,'projects'=>$result_projects));
	 
	  }
 
  public function actionSearch_receivable_ajax()
	 	{
		$where='';
		$and=false;
			 
			if (!empty($_POST['cut_date'])){
			 $cut_date=$_POST['cut_date'];
			 }else{
				 
				 $cut_date=date('d-m-Y');
				 }
				 if (!empty($_POST['plotno'])){
			 $plotno=$_POST['plotno'];
			 }else{
				 
				 $plotno='';
				 }
		$connection = Yii::app()->db; 
	  $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		
		
		
					 
	///////////////////////FUNCTION 1 END/////////////////////////
	///////////////////////FUNCTIOM 2 START//////////////////////
		  $date=date("d-m-Y",strtotime($cut_date));
		 //echo $date;exit();
		  $type=3;
		$model=array();
      //////////////////////////////////FUNCTION 2 END/////////////////////////////// 
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";
        $fixedcolumns.=" ,duepayments.Due_Amount, payments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) duepayments 
			  
			on duepayments.plot_id = memberplot.plot_id left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."'and memberplot.plotno LIKE '%".$plotno."%'";
		  $sorting.=" Order By  memberplot.plotno ";
		 $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting; 
	
		$result_members = $connection->createCommand($sql_member)->query();
		 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();
			$tplotprice=0;
			$tdueamount=0;
			$tdiscount=0;
			$balance_amount=0;
			$treceivedamount=0;
            $tbalance_amount=0;
			$balance_percentage=0;
			$tbalance_percentage=0;
			foreach($result_members as $key){
			$tdiscount=$key['discount']+$tdiscount;
			$tplotprice=$key['price']+$tplotprice;
            $tdueamount=$key['Due_Amount']+$tdueamount;
			$treceivedamount=$key['Received_Amount']+$treceivedamount;
			//$balance_amount=$key['Due_Amount']-$key['Received_Amount'];
			$balance_amount=$key['price']-$key['discount']-$key['Received_Amount'];
                          $tbalance_amount=$balance_amount+$tbalance_amount;
		 	$tbalancedue=$key['Due_Amount']-$key['Received_Amount']+$tbalancedue;
                        $balance_amount=$key['price']-$key['discount']-$key['Received_Amount'];
		/*	if(empty($balance_percentage)){
				$balance_percentage=($balance_amount/$key['price'])*100;
				}else{
					 $balance_percentage=0;
					}*/
			$count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td style="text-align:right">'.number_format(floatval($key['price'])).'</td><td style="text-align:right">'.number_format(floatval($key['discount'])).'</td><td style="text-align:right">'.number_format($key['Due_Amount']).'</td><td style="text-align:right">'.number_format($key['Received_Amount']).'</td>
<td style="text-align:right">'.number_format($key['Due_Amount']-$key['Received_Amount']).'</td><td style="text-align:right">'.number_format($balance_amount).'</td>
                          
                        <td>';
			if($key['Due_Amount']>0){
				$balance_percentage=$balance_amount/$key['price']*100;
				echo ROUND($balance_percentage,2);
				}else{
					echo'0';
					}
			 echo'%</td></tr>';
			}
			echo'<tr><td><strong>Total</strong>:</td><td ></td><td></td><td></td><td></td><td align="right"><strong>'.number_format($tplotprice).'</strong></td>
			<td style="text-align:right"><strong>'.number_format($tdiscount).'</strong></td><td style="text-align:right"><strong>'.number_format($tdueamount).'</strong></td>
			<td style="text-align:right"><strong>'.number_format($treceivedamount).'</strong></td>
                         <td style="text-align:right"><strong>'.number_format($tbalancedue).'</strong></td>
                        <td style="text-align:right"><strong>'.number_format($tbalance_amount).'</strong></td>
			<td><strong>';echo (ROUND($tbalance_amount/$tplotprice*100,2)).'%';'</strong></td>
			</tr>';
	}

	
	}

	 public function actionReceivable(){
	//echo 123;exit;
		$connection = Yii::app()->db; 
     
		
       // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	 $this->render('receivable',array('projects'=>$result_projects));
	 
	  }
	  public function actionReceivable1(){
	$where='';
		$and=false;
		$and = false;
			

			
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND plots.project_id=".$_POST['project_name']."";
				}
				else
				{
					$where.="  plots.project_id =".$_POST['project_name']."";
				}
				$and=true;
			}
                             if (!empty($_POST['plotno'])){

				if ($and==true)
				{
					$where.=" and memberplot.plotno ='".$_POST['plotno']."'";
				}
				else
				{
					$where.="memberplot.plotno='".$_POST['plotno']."'";
				}
				$and==true;
			}
		//echo $_POST['project_name'];exit;
			
	 ///////////////////////FUNCTION 1 START//////////////////
	  	$connection = Yii::app()->db; 
	   $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
	///////////////////////FUNCTION 1 END/////////////////////////
	
	///////////////////////FUNCTIOM 2 START//////////////////////
		  $date=date("d-m-Y",strtotime($_POST['cut_date']));
		 //echo $date;exit();
		  $type=3;
		$model=array();
        
      //////////////////////////////////FUNCTION 2 END///////////////////////////////
	  
	  
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,plots.price,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";

        $fixedcolumns.=" ,duepayments.Due_Amount, payments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) duepayments 
			  
			on duepayments.plot_id = memberplot.plot_id left join
			  
			  (Select
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.paid_date, '%d-%m-%Y'), '%Y-%m-%d') <=
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) payments 
			  
			on payments.plot_id = memberplot.plot_id  ";

		$where="where plots.project_id='".$_POST['project_name']."'";
		  $sorting.=" Order By  memberplot.plotno ";
		 $sql = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting;			
        
		$connection = Yii::app()->db; 
     
		$cmdrow1 = $connection->createCommand($sql)->queryAll();
       // return $cmdrow->queryAll();
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
	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////
	 $this->render('receivable1',array('model'=>$model,'cmdrow1'=>$cmdrow1,'projects'=>$result_projects));
	 
	  }
 	 public function actionSearchrec()
	{ 
		$where='';
		$and=false;
		$and = false;
			if (!empty($_POST['name1'])){
				$where.=" members.name LIKE '%".$_POST['name1']."%'";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and members.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				else
				{

					$where.=" members.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and members.cnic =".$_POST['cnic']."";
				}
				else
				{
					$where.=" members.cnic =".$_POST['cnic']."";
				}
				$and=true;
			}
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND plots.project_id=".$_POST['project_name']."";
				}
				else
				{
					$where.="  plots.project_id =".$_POST['project_name']."";
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

	 ///////////////////////FUNCTION 1 START//////////////////
	  	$connection = Yii::app()->db; 
	    $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
		//print_r($startdate);exit;
	///////////////////////FUNCTION 1 END/////////////////////////
	
	///////////////////////FUNCTIOM 2 START//////////////////////
		  $totaldays = 28;
		  $date=date("d-m-Y");
		 
		  $type=3;
        $datetime1 = date_create(date("d-m-Y",  strtotime($date)));
        $datetime2 = date_create(date("d-m-Y", strtotime($startdate)));
       //print_r($datetime1);
	//	echo '</br>';
		//print_r($datetime2);exit;
		$interval = date_diff($datetime1, $datetime2);
       
        $months = ($interval->y * 12) + $interval->m + ($interval->d==0? 0: 1);

        $count=0;
        $i=0;
		$model=array();
        
        while($i < $months) {
           $datetime1->modify("+".$type." months");
			 $model[]=array(
              'id'=>  $datetime1->format("m"),
              'secid'=>  $datetime1->format("Y"),
              'value'=>  $datetime1->format("M")."-".$datetime1->format("Y"),
              'tag'=>  $datetime1->format("Y")
            );
            $count++;
            $i+=$type;
			
        } //print_r($model);exit;
		
      //////////////////////////////////FUNCTION 2 END///////////////////////////////
	  
	  
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
         $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";

        $fixedcolumns.=" ,installpayments.Due_Amount, installpayments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) installpayments 
			  
			on installpayments.plot_id = memberplot.plot_id  ";
        $count=0;
        $nextcount=3;
        for($i=0; $i<count($model);$i++) {
		    $dynamiccolumns .= " ,ip".$model[$i]["id"].$model[$i]["secid"].".Due_Amount as due".$model[$i]["id"].$model[$i]["secid"]." ";
            $dynamicjoins.= " left join
	  (Select
	  Sum(installpayment.dueamount) As Due_Amount,
	  installpayment.plot_id
     From
     installpayment
     Where
	 Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') >=
	 Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')  +  INTERVAL ".$count." MONTH
     AND
     Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
     Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d') +  INTERVAL ".$nextcount." MONTH
     Group By
     installpayment.plot_id) ip".$model[$i]["id"].$model[$i]["secid"]." 
     on ip".$model[$i]["id"].$model[$i]["secid"].".plot_id = memberplot.plot_id";
            $count+=3;
            $nextcount+=3;
			
        }
		  $sorting.=" Order By  memberplot.plotno ";
	 $sql_memberas = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting."  $where";			
     
		$connection = Yii::app()->db; 
		$co = $connection->createCommand($sql_memberas)->queryAll();
       		//print_r($co);exit;
			$rows =count($co);

		

	  //////////////////////////////////FUNCTION 3 END///////////////////////////////////////////

 		//for Pagination end 		
	
	
	 ///////////////////////FUNCTION 1 START//////////////////
	 
	  	$connection = Yii::app()->db; 
	   $sqldata = "Select  max( Date_Format( Str_To_Date( due_date, '%d-%m-%Y' ) , '%Y-%m-%d' ) ) as duedate From  " .
                " installpayment";
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();
        foreach ($rows as $row) {
           $startdate= $row["duedate"];
        }
	//	print_r($startdate);exit;
	///////////////////////FUNCTION 1 END/////////////////////////
	
	///////////////////////FUNCTIOM 2 START//////////////////////
		  $totaldays = 28;
		  $date=date("d-m-Y");
		 
		  $type=3;
        $datetime1 = date_create(date("d-m-Y",  strtotime($date)));
        $datetime2 = date_create(date("d-m-Y", strtotime($startdate)));
      /*  print_r($datetime1);
		echo '</br>';
		print_r($datetime2);exit;*/
		$interval = date_diff($datetime1, $datetime2);
       
        $months = ($interval->y * 12) + $interval->m + ($interval->d==0? 0: 1);

        $count=0;
        $i=0;
		$model=array();
        
        while($i < $months) {
           $datetime1->modify("+".$type." months");
			 $model[]=array(
              'id'=>  $datetime1->format("m"),
              'secid'=>  $datetime1->format("Y"),
              'value'=>  $datetime1->format("M")."-".$datetime1->format("Y"),
              'tag'=>  $datetime1->format("Y")
            );
            $count++;
            $i+=$type;
			
        }// print_r($model);exit;
      //////////////////////////////////FUNCTION 2 END///////////////////////////////
	  
	  
	  //////////////////////////////////FUNCTION 3 START///////////////////////////
        $fixedcolumns = "";
        $dynamiccolumns = "";
        $fixedjoins = "";
        $dynamicjoins = "";
        $where = "";
        $grouping = "";
        $having = "";
        $sorting = "";
        $fixedcolumns.="  memberplot.member_id,  memberplot.plot_id,  memberplot.id,  "
                . "memberplot.plotno,  members.name,  members.sodowo,  members.cnic,  "
                . "members.phone,  members.email,  size_cat.code,size_cat.size, plots.plot_size, discnt.discount ";

        $fixedcolumns.=" ,installpayments.Due_Amount, installpayments.Received_Amount";
					$fixedjoins.="  members Inner Join
			  memberplot On members.id = memberplot.member_id Inner Join
			  plots On memberplot.plot_id = plots.id Inner Join
			  size_cat On plots.size2 = size_cat.id Left Join
			  discnt On memberplot.id = discnt.ms_id left join
			  
			  (Select
			  Sum(installpayment.dueamount) As Due_Amount,
			  Sum(installpayment.paidamount) As Received_Amount,
			  installpayment.plot_id
			From
			  installpayment
			Where
			  Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
			  Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')
			Group By
			  installpayment.plot_id) installpayments 
			  
			on installpayments.plot_id = memberplot.plot_id  ";
        $count=0;
        $nextcount=3;
        for($i=0; $i<count($model);$i++) {
		    $dynamiccolumns .= " ,ip".$model[$i]["id"].$model[$i]["secid"].".Due_Amount as due".$model[$i]["id"].$model[$i]["secid"]." ";
            $dynamicjoins.= " left join
	  (Select
	  Sum(installpayment.dueamount) As Due_Amount,
	  installpayment.plot_id
     From
     installpayment
     Where
	 Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') >=
	 Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d')  +  INTERVAL ".$count." MONTH
     AND
     Date_Format(Str_To_Date(installpayment.due_date, '%d-%m-%Y'), '%Y-%m-%d') <
     Date_Format(Str_To_Date('" . $date . "', '%d-%m-%Y'), '%Y-%m-%d') +  INTERVAL ".$nextcount." MONTH
     Group By
     installpayment.plot_id) ip".$model[$i]["id"].$model[$i]["secid"]." 
     on ip".$model[$i]["id"].$model[$i]["secid"].".plot_id = memberplot.plot_id";
            $count+=3;
            $nextcount+=3;
			
        }
		  $sorting.=" Order By  memberplot.plotno ";
		   $sql_member = "select " . $fixedcolumns . $dynamiccolumns . " From " . $fixedjoins . $dynamicjoins . $where . $grouping . $having . $sorting." $where  limit $start,$limit";
	 $connection = Yii::app()->db; 
     
	
		 $result_members = $connection->createCommand($sql_member)->queryAll();
		
	  //  print_r($result_members);exit;
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'"><strong>'.$key['phone'].'</strong></a><td>'.$key['email'].'</td><td>'.$key['code'].'</td><td>'.$key['discount'].'</td><td>'.$key['Due_Amount'].'</td><td>'.$key['Received_Amount'].'</td>
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



	}

			public function actionTestcsv(){
			$connection = Yii::app()->db; 
			$sql_member = "Select memberplot.member_id,size_cat.size,plots.plot_detail_address, memberplot.plot_id,plots.plot_size, memberplot.id, memberplot.plotno, members.name, members.sodowo, members.cnic, members.phone, members.email, size_cat.code, discnt.discount, installpayments.Due_Amount, installpayments.Received_Amount From members Inner Join memberplot On members.id = memberplot.member_id Inner Join plots On memberplot.plot_id = plots.id Inner Join size_cat On plots.size2 = size_cat.id Left Join discnt On memberplot.id = discnt.ms_id Left Join (Select Sum(installpayment.dueamount) As Due_Amount, Sum(installpayment.paidamount) As Received_Amount, installpayment.plot_id From installpayment group by installpayment.plot_id ) installpayments On installpayments.plot_id = memberplot.plot_id where installpayments.Due_Amount - ifnull( installpayments.Received_Amount,0) - ifnull(discnt.discount,0)=0";
			
			
		$result_members = $connection->createCommand($sql_member)->query();
	
			$this->render('testcsv',array('members'=>$result_members));
			}
	/*Payment Sheet Start*/
	
	
	
	
	public function actionPayment_sheet()
	{	
	if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username'])){
			$name='';
			$sodowo='';
			$cnic='';
			$plotno='';
			$project_name='';
			$plot_detail_address='';
			$where='';
			$and = false;
			if (!empty($_POST['name'])){
				$where.=" m.name =".$_POST['name']."";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo =".$_POST['sodowo']."";

				}
				else
				{

					$where.=" m.sodowo =".$_POST['sodowo']."";

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
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND p.project_id  '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.="  p.project_id LIKE '%".$_POST['project_name']."%'";
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
				$sql2='';
				$members="";
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
					$error="";
			$and = false;
			$where='';
			if (!empty($_POST['name'])){
				$where.=" m.name LIKE '%".$_POST['name']."%'";
				$and = true;
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
					$where.=" and m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				else
				{
					$where.=" m.cnic LIKE '%".$_POST['cnic']."%'";
				}
				$and=true;
			}
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

//if($and ==true){echo 0;}else{echo 1;}exit;

			

			if (!empty($_POST['plot_detail_address'])){

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

	 $sql_member = "Select memberplot.member_id, memberplot.plot_id, memberplot.id, memberplot.plotno, members.name, members.sodowo, members.cnic, members.phone, members.email, size_cat.code, discnt.discount, installpayments.Due_Amount, installpayments.Received_Amount From members Inner Join memberplot On members.id = memberplot.member_id Inner Join plots On memberplot.plot_id = plots.id Inner Join size_cat On plots.size2 = size_cat.id Left Join discnt On memberplot.id = discnt.ms_id Left Join (Select Sum(installpayment.dueamount) As Due_Amount, Sum(installpayment.paidamount) As Received_Amount, installpayment.plot_id From installpayment group by installpayment.plot_id ) installpayments On installpayments.plot_id = memberplot.plot_id where installpayments.Due_Amount - ifnull( installpayments.Received_Amount,0) - ifnull(discnt.discount,0)=0 Order By memberplot.plotno  "; 

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

			if(isset($_POST['search'])){

            $res=array();
			

            foreach($members as $key){

  echo '<tr><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a>
  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

</br>';if($key['status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer asdsaasdPlot</a>';}

echo'  </td></tr>'; 

            }
			}

			$this->render('payment_sheet',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
public function actionSearchsheet()
	 	{
		$where='';
		$and=false;
		$and = false;
			if (!empty($_POST['name1'])){
				$where.=" members.name LIKE '%".$_POST['name1']."%'";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and members.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				else
				{

					$where.=" members.sodowo LIKE '%".$_POST['sodowo']."%'";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and members.cnic =".$_POST['cnic']."";
				}
				else
				{
					$where.=" members.cnic =".$_POST['cnic']."";
				}
				$and=true;
			}if (!empty($_POST['allotmentstatus'])){
$allotmentstatus='';
if($_POST['allotmentstatus']==1){if ($and==true)
				{
					$where.=" and memberplot.status='Approved'";
				}
				else
				{
					$where.=" memberplot.status='Approved'";
				}}
if($_POST['allotmentstatus']==2){if ($and==true)
				{
					$where.=" and memberplot.status!='Approved'";
				}
				else
				{
					$where.=" memberplot.status!='Approved'";
				}}
				
				$and=true;
			}
			if (!empty($_POST['project_name'])){
				if($and==true)
				{
					$where.=" AND plots.project_id=".$_POST['project_name']."";
				}
				else
				{
					$where.="  plots.project_id =".$_POST['project_name']."";
				}
				$and=true;
			}
			if (!empty($_POST['plot_detail_address'])){

				if ($and==true)
				{
					$where.=" and plots.plot_detail_address ='".$_POST['plot_detail_address']."'";
				}
				else
				{
					$where.="plots.plot_detail_address='".$_POST['plot_detail_address']."'";
				}
				$and==true;
			}
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and memberplot.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
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
 echo $sql_memberas = "Select memberplot.member_id,size_cat.size,plots.plot_detail_address, memberplot.plot_id,plots.plot_size, memberplot.id, memberplot.plotno, members.name, members.sodowo, members.cnic, members.phone, members.email, size_cat.code, discnt.discount, installpayments.Due_Amount, installpayments.Received_Amount From members Inner Join memberplot On members.id = memberplot.member_id Inner Join plots On memberplot.plot_id = plots.id Inner Join size_cat On plots.size2 = size_cat.id Left Join discnt On memberplot.id = discnt.ms_id Left Join (Select Sum(installpayment.dueamount) As Due_Amount, Sum(installpayment.paidamount) As Received_Amount, installpayment.plot_id From installpayment group by installpayment.plot_id ) installpayments On installpayments.plot_id = memberplot.plot_id where installpayments.Due_Amount - ifnull( installpayments.Received_Amount,0) - ifnull(discnt.discount,0)=0
and  $where  ";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     $sql_member = "Select memberplot.member_id,size_cat.size,plots.plot_detail_address, memberplot.plot_id,plots.plot_size, memberplot.id, memberplot.plotno, members.name, members.sodowo, members.cnic, members.phone, members.email, size_cat.code, discnt.discount, installpayments.Due_Amount, installpayments.Received_Amount From members Inner Join memberplot On members.id = memberplot.member_id Inner Join plots On memberplot.plot_id = plots.id Inner Join size_cat On plots.size2 = size_cat.id Left Join discnt On memberplot.id = discnt.ms_id Left Join (Select Sum(installpayment.dueamount) As Due_Amount, Sum(installpayment.paidamount) As Received_Amount, installpayment.plot_id From installpayment group by installpayment.plot_id ) installpayments On installpayments.plot_id = memberplot.plot_id where installpayments.Due_Amount - ifnull( installpayments.Received_Amount,0) - ifnull(discnt.discount,0)=0 and $where Order By memberplot.plotno  limit $start,$limit"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'"><strong>'.$key['phone'].'</strong></a><td>'.$key['email'].'</td><td>'.$key['code'].'</td><td>'.$key['discount'].'</td><td>'.$key['Due_Amount'].'</td><td>'.$key['Received_Amount'].'</td>
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



	}
	
	
	
	
	
	
	/*Payment Sheet End*/
	
	public function actionDocs()
	{
		if(Yii::app()->session['user_array']['per9']=='1' && isset(Yii::app()->session['user_array']['username']))
			{
	$this->layout='//layouts/back';
	$this->render('doc');


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
public function actionPayment_details()
		{
if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;
$land  = "SELECT * FROM installpayment	where fstatus !='Cancelled' and others !='Cancelled' and plot_id='".$_REQUEST['id']."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		
		   $member= "SELECT * FROM memberplot mp where plot_id='".$_REQUEST['id']."'";
		$members = $connection->createCommand($member)->queryRow();
			

		 $sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."' and (mem_id='".$members['member_id']."' or payment_type NOT IN ('MS Fee','Transfer Fee'))";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

		

	   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		

		

		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='".$_REQUEST['id']."'";

		$res=$connection->createCommand($sql)->queryAll();

		

		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";

		//$result_charges = $connection->createCommand($sql_charges)->queryAll();

		

		$sql_plotinfo  = "SELECT  memberplot.mstatus as stst,p.type,p.is_property,buildings.name as building_name,floors.name as floor_name,p.*,j.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join sectors sec on p.sector=sec.id
		left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		left join projects j on p.project_id=j.id
        Left JOIN floors  ON (p.floor_id = floors.id)
        Left JOIN buildings  ON (floors.building_id = buildings.id)
		Left JOIN memberplot  ON (memberplot.plot_id = p.id)
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
			$connection = Yii::app()->db;
			$sql_primeloc  = "SELECT *  FROM cat_plot
			LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
			WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
			$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
					

	

		$this->render('payment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));
		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionInstallment_details()
		{if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' AND others!='Cancelled' AND fstatus!='Cancelled' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."' ";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";

		$sql_plotinfo  = "SELECT  mp.mstatus as stst,floors.name as floor_name,buildings.name as building_name,p.is_property,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		left join projects j on p.project_id=j.id
        Left JOIN floors  ON (p.floor_id = floors.id)
        Left JOIN buildings  ON (floors.building_id = buildings.id) 
		left join memberplot mp on mp.plot_id=p.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
		

		$this->render('installment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}   public function actionSearchreq()

	 {
		$where='';

		$and=false;
		  
			//echo $from.$to; exit;
		
		
		 if (isset($_POST['status']) && $_POST['status']!=""){
                $and=true;

				if($_POST['status']=='new'){$where.="plotpayment.fstatus='' and paidamount>0";}
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
 $sql_memberas = "SELECT * FROM
    plotpayment
    Left JOIN plots  ON (plots.id = plotpayment.plot_id)
	Left JOIN projects  ON (projects.id = plots.project_id)
	Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
where $where and plotpayment.r_id=0 and plotpayment.re_id=0"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end


		$connection = Yii::app()->db; 
 echo $sql_payment  = "SELECT plots.plot_detail_address
    , plotpayment.id
    , plotpayment.amount
	, plotpayment.payment_type
	, plotpayment.paidamount
	, plotpayment.duedate
	, plotpayment.paidas
	, plotpayment.detail
	, plotpayment.date
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
	 where $where and plotpayment.r_id=0 and plotpayment.re_id=0  limit $start,$limit";  
 
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
		if($row['amount']==''){$row['amount']=0;}
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['plotno'] . '</td>

 <td>' . $row['plot_detail_address'] . '</td>
 <td>' . $row['payment_type'] . '</td>
 <td style="text-align:right">'.floatval($row['amount']). '</td>
 <td style="text-align:right">' . number_format($row['paidamount']). '</td>
  <td >' . $row['duedate']. '</td>
  <td>' . $row['paidas'] . '</td>
  <td>' . $row['detail'] . '</td>
   <td>' . $row['date'] . '</td>
  <td><a class="btn" href="update_charges?id='.$row['id'].'">Detail</a><input class="btn" type="submit" name="sub" id="'.$row['id'].'" onclick="myfunction('.$row['id'].')" class="btn-info button" value="Verify"></td>
</tr> 
<script>
var id =document.getElementById(id);
function myfunction(id)
{
$.ajax({
     type: "POST",
      url:    "ajaxRequest3?val1="+id,
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
		if((Yii::app()->session['user_array']['per9']=='1')&& isset(Yii::app()->session['user_array']['username']))

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
		$pro = $connection->createCommand($sql_project)->query() or mysql_error();
		

			$this->render('payment_lis',array('pro'=>$pro));
			}
			else{
				$this->redirect(array('user/dashboard'));
				}
			

	   

	}
	
public function actionAlotmentreq()

	 {  
		$where='';
		$and=false;
			$from=$_POST['fromdate'];
			$to=$_POST['todate'];
		 if (isset($_POST['status']) && $_POST['status']!=""){
				if($_POST['status']=='new'){$where.="mp.fstatus=''";}else{
				$where.="mp.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
			}
				if (($_POST['fromdate']!="") && ($_POST['todate']!="")) {
				if ($and==true)
				{
				$where.="and mp.create_date BETWEEN '".$from."' AND '".$to."' ";
				}else{$where.="mp.create_date BETWEEN '".$from."' AND '".$to."' ";}
			$and=true;
			}
		if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and p.plot_detail_address ='".$_POST['plotno']."'";
				}
				else
				{
					$where.=" p.plot_detail_address ='".$_POST['plotno']."'";
				}
				$and=true;
			}
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
			}
		$connection = Yii::app()->db; 
		$sql_payment  = "SELECT  mp.member_id,mp.plotno,mp.create_date,mp.id as mp_id,p.type,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,s.street,j.project_name FROM memberplot mp
inner join members m on mp.member_id=m.id
inner join plots p on mp.plot_id=p.id
inner join streets s on p.street_id=s.id
inner join projects j on p.project_id=j.id
where $where ";
	$result_payments = $connection->createCommand($sql_payment)->queryAll();
 ///echo $sql_payment;exit();
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
$i=1;
            foreach($sql_payments as $key){
		$ID=$key['mp_id'];
  echo '<tr><td>'.$i.'</td><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['plot_detail_address'].'<td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="req_detail?id='.$ID.'">Detail</a>
  </td></tr>';
		 $i++;
			} 
			}else{echo exit;}
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
	
public function actionAlotment_lis()

	{
		if((Yii::app()->session['user_array']['per9']=='1')&& isset(Yii::app()->session['user_array']['username']))

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

			$this->render('alotment_lis',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$result_projects,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));

			}else{
				$this->redirect(array('user/dashboard'));
				
				}

	   

	}	
	


public function actionTransferreq()

	 	{
		$where='';

		$and=false;
		
			$from=$_POST['fromdate'];

			$to=$_POST['todate'];
			

		 if (isset($_POST['status']) && $_POST['status']!=""){

				if($_POST['status']=='new'){$where.="(tp.fstatus = '' OR tp.status IS NULL)";}else{
				$where.="tp.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
			}
							if (($_POST['fromdate']!="") && ($_POST['todate']!="")) {
				

				if ($and==true)

				{

				$where.="and tp.create_date BETWEEN '".$from."' AND '".$to."' ";

				}else{$where.="tp.create_date BETWEEN '".$from."' AND '".$to."' ";}

			$and=true;

			}

		if (isset($_POST['plotno']) && $_POST['plotno']!=""){

				$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and p.plot_detail_address ='".$_POST['plotno']."'";

				}

				else

				{

					$where.=" p.plot_detail_address ='".$_POST['plotno']."'";

				}

				$and=true;

			}
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and p.project_id =".$_POST['project_id']."";
				}
				else
				{
					$where.=" p.project_id =".$_POST['project_id']."";
				}
				$and=true;
			}

		$connection = Yii::app()->db; 

		  $sql_payment  = "SELECT tp.*,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name,mp.plotno,m_from.name from_name,m_to.name to_name,m_to.RFM RFM FROM transferplot tp



			Left JOIN members m_from ON m_from.id=tp.transferfrom_id



			Left JOIN members m_to ON m_to.id=tp.transferto_id



			Left JOIN plots p ON p.id=tp.plot_id


			Left JOIN memberplot mp ON mp.plot_id=p.id


			Left JOIN streets s ON s.id=p.street_id


				Left JOIN size_cat siz  ON p.size2 = siz.id

			Left JOIN projects pro ON pro.id=p.project_id where $where AND tp.RFM=''AND tp.fstatus !='Approved' ";

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
$i=1;
            foreach($sql_payments as $key){

          
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
		

		//$due=$due+$row['amount'];
		//$paid=$paid+$row['paidamount'];
   echo '<tr><td>'.$i.'</td><td>'.$key['from_name'].'</td><td>'.$key['to_name'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['price'].'</td><td>'.$key['size'].'</td><td>'.$key['plotno'].'</td><td>'.$key['com_res'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="treq_detail?id='.$key['id'].'">View Request</a></td></tr>'; 

		 $i++;

			} 

			}else{echo exit;}

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
	

public function actionTransfer_lis()

	{
		if((Yii::app()->session['user_array']['per9']=='1')&& isset(Yii::app()->session['user_array']['username']))

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
	, transferplot.RFM
	

	, plots.plot_detail_address

	, memberplot.plotno

    , projects.project_name

	, streets.street
	, size_cat.size


	

FROM

    plots

    Left JOIN streets  ON (plots.street_id = streets.id)


	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)

	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
    Left JOIN transferplot  ON (memberplot.plot_id = transferplot.id)

where $where AND transferplot.RFM='' ";
		$result_members = $connection->createCommand($sql_member)->query();

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
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

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
            echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['size'].'</td><td>'.$key['size2'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['rstatus'].'</td><td>';

			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('transfer_lis',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$result_projects,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));
			}else{
				$this->redirect(array('user/dashboard'));
				}
			

	   

	}	



public function actionUpdate_charges()

     	{

		if(Yii::app()->session['user_array']['per9']=='1' && isset(Yii::app()->session['user_array']['username']))

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
public function actionChargupdate()

	{       

			   $connection = Yii::app()->db;  
				 $error='';
			if ((isset($_POST['status']) && empty($_POST['status']))){
			$error.="Select  status. <br>";}
			if ((isset($_POST['remark']) && empty($_POST['remark']))){
			$error.="Enter Remark. <br>";
			}
			if(empty($error)){

			   $sql="UPDATE plotpayment set 
			 	fstatus='".$_POST['status']."',
			    others='".$_POST['remark']."',
 fid='".Yii::app()->session['user_array']['id']."'			    
where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Updated Successfully';}
				else{ echo $error;}
			  
	}
	
	
  public function actionSearchinstallment()

	 	{
		$where='';

		$and=true;
//$where.="installpayment.fstatus='' and paidamount!=''";
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
echo $sql_memberas = "SELECT p.project_id,mp.plotno,installpayment.payment_type,installpayment.dueamount,installpayment.paidamount,installpayment.due_date,installpayment.paidas,installpayment.detail,installpayment.surcharge,installpayment.paid_date,installpayment.id,installpayment.fstatus,installpayment.lab FROM installpayment 
		left join memberplot mp on(installpayment.plot_id=mp.plot_id)
		left join plots p on(installpayment.plot_id=p.id)
		where $where and installpayment.r_id=0 and installpayment.re_id=0 "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end

		$connection = Yii::app()->db; 

		$sql_payment  = "SELECT p.project_id,mp.plotno,installpayment.payment_type,installpayment.dueamount,installpayment.paidamount,installpayment.due_date_temp,installpayment.paidas,installpayment.detail,installpayment.surcharge,installpayment.paid_date_temp,installpayment.id,installpayment.fstatus,installpayment.lab FROM installpayment 
		left join memberplot mp on(installpayment.plot_id=mp.plot_id)
		left join plots p on(installpayment.plot_id=p.id)
		where $where and installpayment.r_id=0 and installpayment.re_id=0 limit $start,$limit";  
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
				$due_date_temp = strtotime($row['due_date_temp']); 
				$due_date_temp = date('d-m-Y', $due_date_temp);
				$paid_date_temp = strtotime($row['paid_date_temp']); 
				$paid_date_temp = date('d-m-Y', $paid_date_temp);
		$i++;
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['plotno'] . '</td>
 <td>' . $row['lab'] . '</td>

 <td style="text-align:right;">' .number_format($row['dueamount']) . '</td>
 <td style="text-align:right;">' . number_format($row['paidamount'] ). '</td>
  <td>' . $due_date_temp. '</td>
  <td>' . $row['payment_type'] . '</td>
  <td>' . $row['detail'] . '</td>
  <td>' . $row['surcharge'] . '</td>
   <td>' .$paid_date_temp. '</td>
  <td><a class="btn" href="update_installment?id='.$row['id'].'">Detail</a>
<input type="submit" name="sub" id="'.$row['id'].'" onclick="myfunction('.$row['id'].')" class="btn-info button" value="Verify"></td>
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
	public function actionAjaxRequest3($val1)
	{	
		$connection = Yii::app()->db;  
		$sql  = "UPDATE plotpayment set fstatus='approved' where  id='".$val1."'";
		
		   $command = $connection -> createCommand($sql);
               $command -> execute();
		
		//echo json_encode($city); 
		echo 1;exit();
	}
	public function actionAjaxRequest4($val1)
	{	
		$connection = Yii::app()->db;  
		$sql  = "UPDATE installpayment set 
			 	fstatus='approved',
			    others='Verified'
			    where  id='".$val1."'";
		
		   $command = $connection -> createCommand($sql);
               $command -> execute();
		
		//echo json_encode($city); 
		echo 1;exit();
	}	
	public function actionInstallment_lis()
	{
		
			if((Yii::app()->session['user_array']['per9']=='1')&& isset(Yii::app()->session['user_array']['username']))

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
	
			$connection = Yii::app()->db; 
			$temp_projects_array = Yii::app()->session['projects_array'];
			$num_of_projects_counter = count($temp_projects_array);	
			$num_of_projects_counter2 = $num_of_projects_counter;
			$sql_categories  = "SELECT * from categories";
			$categories = $connection->createCommand($sql_categories)->query();
			$sql_pro  = "SELECT * from projects";
		$pro = $connection->createCommand($sql_pro)->query();
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
	
				<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 
	
				}}
	
				$this->render('installment_lis',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));
			}else{
				$this->redirect(array('user/dashboard'));
				}
				
	
		   
	
		}

	public function actionUpdate_installment()
	{

		if(Yii::app()->session['user_array']['per9']=='1' && isset(Yii::app()->session['user_array']['username']))

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
	
	public function actionInstallmentupdate()
	{       
				$error='';
				
			   $connection = Yii::app()->db;  
				 $error='';
			if ((isset($_POST['status']) && empty($_POST['status']))){
			$error.="Please Select Status. <br>";}
			if ((isset($_POST['remark']) && empty($_POST['remark']))){
			$error.="Please Enter Remarks. <br>";
			}
				
				if(empty($error))
				{
			   $sql="UPDATE installpayment set 
			 	fstatus='".$_POST['status']."',
			    others='".$_POST['remark']."',
	 fid='".Yii::app()->session['user_array']['id']."'
			    where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Updated Successfully';
				}
				else{
					echo $error;
					}
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

	public function actionFinance()
	 {
				if((Yii::app()->session['user_array']['per9']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
			
			$connection = Yii::app()->db; 
	
			  $sql_unsup  = "SELECT count(id) from receipt WHERE receipt.fstatus != 'Cancelled' AND receipt.fstatus != 'Bounce' AND receipt.bank_details = ''";
			$result_unsup = $connection->createCommand($sql_unsup)->queryAll();
			$unsup=count ( $result_unsup );
			$sql_payment  = "SELECT * FROM installpayment where fstatus='' and paidamount!='' and r_id=0 and re_id=0 ";
			$result_payments = $connection->createCommand($sql_payment)->queryAll();
			$installments=count ( $result_payments );
$sql_payment12  = "SELECT * FROM receipt where bank_details !='' and fstatus=''";
				 $result_payments12 = $connection->createCommand($sql_payment12)->queryAll();
			$sql_project = "SELECT * FROM plotpayment where fstatus='' and paidamount >0 and r_id=0 and re_id=0";
			$result_project = $connection->createCommand($sql_project)->query();
			$payments=count ( $result_project );
			
			$sql_transfer = "
			SELECT *
			FROM transferplot 
						  where RFM='' AND fstatus =''";
			$result_transfer = $connection->createCommand($sql_transfer)->query();
			$transfer=count ( $result_transfer );
			
			$sql_allot = "SELECT mp.member_id,mp.plotno,mp.create_date,mp.id as mp_id,p.type,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,s.street,j.project_name FROM memberplot mp Inner join members m on mp.member_id=m.id left join plots p on mp.plot_id=p.id Inner join streets s on p.street_id=s.id left join projects j on p.project_id=j.id where mp.fstatus=''";
			$result_allot = $connection->createCommand($sql_allot)->query();
			$allot=count ( $result_allot);
		 $sql_cancel = "SELECT cp.fstatus,cp.status,mp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name, cp.status as cpstatus, mp.plotno,m.name from memberplot mp
			Inner JOIN members m ON m.id=mp.member_id
			
			Inner JOIN plots p ON p.id=mp.plot_id
			
			Inner JOIN streets s ON s.id=p.street_id
			Inner JOIN size_cat siz  ON p.size2 = siz.id
			Inner JOIN sectors sec  ON p.sector = sec.id
			Inner JOIN projects pro ON pro.id=p.project_id 
			Inner JOIN cancelplot cp ON cp.plot_id=p.id
			where cp.status='approved' and cp.fstatus='New'"; 
			$result_cancel = $connection->createCommand($sql_cancel)->query();
				$cancelplot=count ($result_cancel);
	
			$layout='//layouts/back';
			$this->render('finance',array('unsup'=>$unsup,'payments'=>$payments,'transfer'=>$transfer,'instr'=>count($result_payments12),'allot'=>$allot,'installments'=>$installments,'cancelplot'=>$cancelplot));
			}
			else{
				$this->redirect(array('user/dashboard'));
				}
	}
	//////////////////////////////////////////

	

	  

	

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
	
	public function actionReq_detail()
	{

	if(Yii::app()->session['user_array']['per9']=='1')

			{

			$connection = Yii::app()->db; 	

		$sql_details  = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.fcomment,mp.noi,mp.id,mp.create_date,mp.insplan,mp.fstatus,mp.comment,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.status,p.plot_detail_address,p.type,p.id,p.plot_size,p.project_id,s.street, mp.plot_id,j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat c on p.size2=c.id
left join user u on mp.user_name=u.id

left join projects j on s.project_id=j.id where mp.id=".$_REQUEST['id'];

			$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	}
	
	public function actionSubmitstatus()
	{
		
	
		$connection = Yii::app()->db;
		//$memberid=$_POST['member_id'];
		$plotid=$_POST['plot_id'];
		if($_POST['statusapp']=='Rejected')
		{
		 $sqldel="Delete from  memberplot where plot_id='".$plotid."'";
        $command = $connection -> createCommand($sqldel);
        $command -> execute(); 
		$sqlup="Update plots SET status='' where id='".$plotid."'";	
		
        $command = $connection -> createCommand($sqlup);
        $command -> execute();
		
		$sql2="DELETE FROM  installpayment where plot_id='".$plotid."'";		
        $command = $connection -> createCommand($sql2);
        $command -> execute();

		$this->redirect(array("finance/alotment_lis"));
		}
		if($_POST['statusapp']=='approved')
		{ 
		$sql="Update memberplot SET fstatus='".$_POST['statusapp']."', fcomment='".$_POST['cmnt']."' where plot_id='".$plotid."'";	
		//$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		
		$this->redirect(array("finance/alotment_lis"));
		}
		if($_POST['statusapp']=='Pending')
		{
		$sql="Update memberplot SET fstatus='".$_POST['statusapp']."', fcomment='".$_POST['cmnt']."' where plot_id='".$plotid."'";	
		//$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$this->redirect(array("finance/alotment_lis"));
		}
		
	}
	
	public function actionTreq_detail()
	{
	if(Yii::app()->session['user_array']['per9']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT sc_user.firstname as sc_user,admin_user.firstname as admin_user,ach.*,ach.id as achid,tp.*,s.street,p.com_res,p.atype,p.plot_detail_address,p.plot_size,mp.id as mssid,mp.tempms,sc.size,mp.comment,mp.plotno,se.sector_name,pro.project_name,m_from.name from_name,m_to.name to_name 
			,m_to.cnic,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.state,mp.mmtype
			FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN memberplot mp ON p.id=mp.plot_id
	    	Left JOIN tp_action_history ach ON p.id=ach.plot_id
			left join user u on tp.uid=u.id
			Left JOIN user sc_user ON sc_user.id=ach.sc_id
			Left JOIN user admin_user ON admin_user.id=ach.admin_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id=".$_REQUEST['id']."";
			$result_details = $connection->createCommand($sql_details)->queryAll();
			$this->render('treq_detail',array('plotdetails'=>$result_details)); 
			}else{$this->redirect(array("dashboard"));}



	}
	
	public function actionTsubmitstatus()
	{
	$connection = Yii::app()->db;  
	
	if($_POST['status']=='Approved'){
				  $tpaction  = "UPDATE tp_action_history set 
				finance_comment='".$_POST['cmnt']."',
				finance_status='Approved',
				f_id='".Yii::app()->session['user_array']['id']."',
				finance_date= '".date('Y-m-d H:i:s')."' 	
				WHERE id='".$_POST['achid']."'";
   			    $command = $connection -> createCommand($tpaction);
                $command -> execute();
			  $connection = Yii::app()->db;  
			 $sql3 = "UPDATE transferplot SET fstatus ='".$_POST['status']."',fcomment ='".$_POST['cmnt']."' WHERE id = ".$_POST['plot_id'].""; 
			  $command = $connection -> createCommand($sql3);
			  $command -> execute(); 	
						}else{
			  $connection = Yii::app()->db;  
			  $sql3 = "UPDATE transferplot SET fstatus ='".$_POST['status']."',fcomment ='".$_POST['cmnt']."' WHERE id = ".$_POST['plot_id']."";
			  $command = $connection -> createCommand($sql3);
			  $command -> execute(); 
			   echo 'Request Sent Successfully ';
			   echo '<script>location.href="transfer_lis";</script>';
					}

                        }
}