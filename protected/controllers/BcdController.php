<?php
class BcdController extends Controller
{
    
    
    public function actionCreate_Request()
	{
	if(isset(yii::app()->session['user_array']['username'])&&(yii::app()->session['user_array']['per_bcd_mgm']==1))
		 {					$connection = Yii::app()->db;
										 $sql_plots = "SELECT distinct bcd.plot_id, bcd.construction_status,bcd.building_type,bcd.possession,bcd.family_shifted,bcd.remarks,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.address,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM plots p
					left join bcd bcd on bcd.plot_id=p.id
					left join memberplot mp on mp.plot_id=p.id
					left join members m on mp.member_id=m.id
					left join sectors sec on sec.id=p.sector
					left join size_cat size_cat on size_cat.id=p.size2
					left join streets s on p.street_id=s.id
					left join plotpayment pp on pp.plot_id=p.id
					left join projects j on p.project_id=j.id 
					where p.id=".$_GET['plot_id']." and payment_type='Possession Fee' ORDER BY pp.paid_date_temp DESC";	
		$result_plots = $connection->createCommand($sql_plots)->queryAll();	
					 
					 	$this->render('create_request',array('plots'=>$result_plots));		
					} 
					else{
							$this->redirect(array('user/dashboard'));
						}
	}
      public function actionSearchreq1()
	{
		$where="p.type='plot'";
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
			if (!empty($_POST['app_no'])){

				if ($and==true)
				{
					$where.=" and mp.app_no =".$_POST['app_no']."";
				}
				else
				{
					$where.=" mp.app_no =".$_POST['app_no']."";
				}
				$and=true;
			}
			
					$allotmentstatus='';
					
			
			
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
			
	
			
	 $connection = Yii::app()->db; 
        $sql_member = "SELECT DISTINCT bcd.plot_id, bcd.construction_status,bcd.building_type,bcd.possession,bcd.family_shifted,bcd.remarks,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM plots p
left join bcd bcd on bcd.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join plotpayment pp on pp.plot_id=p.id
left join projects j on p.project_id=j.id 
where  $where and pp.payment_type='Possession Fee' and p.possession_status =0  and p.type='Plot'  ORDER BY mp.plotno ASC,paid_date_temp DESC";
	 $i=0;
		$result_members = $connection->createCommand($sql_member)->queryAll();
				  foreach($result_members as $key){
					 
					  $i++;
				 echo'<tr><td>'.$i.'</td><td>';if(empty($key['plotno'])){ echo 'App-'. $key['app_no'];}else { echo $key['plotno'];} echo'</td>
			<td>'.$key['name'].'</td>
			<td>'.$key['cnic'].'</td>
			 <td>';echo $key['size'].'&nbsp;('.$key['plot_size'].')';echo'</td>
			 <td><strong>';if($key['stst']==2){echo'<span style="color:red">Blocked</span>';}else{
				  echo ''.$key['plot_detail_address'];}echo'</strong></td>
			<td>'.$key['street'].'/'.$key['sector_name'].'</td>
				  <td>'.$key['project_name'].'</td>
				  
			
				 <td> ';
                               if(isset(yii::app()->session['user_array']['username'])&&(yii::app()->session['user_array']['per_bcd_mgm']==1))
		 {
		     
                                  echo'
								  <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				  <li><a href="create_request?plot_id='.$key['plot_id'].'">Grant Possession</a></li>
				 </ul></div>';}
                       echo' </td></tr>'; }
		 
	exit;	 



	}
	/////////////START:BCD REPORTS//////////////////
public function actionReportmain()
	{
		if((Yii::app()->session['user_array']['per_bcd_rpt']=='1')&& isset(Yii::app()->session['user_array']['username']))
					{ 
						 if(isset($_POST['summary']))
						 {						
							$this->render('summary',array('project_id'=>$_POST['project_id']));
						 }
						if(isset($_POST['family_shifted_summary']))
						{
							$this->render('family_shifted_summary',array('project_id'=>$_POST['project_id']));
						}
						
					} 
	
			else{
					$this->redirect(array('user/dashboard'));
				}
	}
	public function actionBcd_reports()
	{
		if((Yii::app()->session['user_array']['per_bcd_rpt']=='1')&& isset(Yii::app()->session['user_array']['username']))
			{
			$this->render('bcd_reports');
			} 
			else{
				$this->redirect(array('user/dashboard'));
				}
	}
	
	
	//////////////END:BCD REPOSTS/////////////////////
	
	
	/////////////START:Summary/////////////////////
	 public function actionSummary()
	{ 

		$this->layout='//layouts/back';
		$this->render('summary');
	}
	
	/////////////END: Summary//////////////////////
	
	/////////////START: Add Family///////////////
	
	public function actionAdd_family_detail()
	{
			$uid=Yii::app()->session['user_array']['id'];
		 $error ='';
		 $living_type='';
		if(isset($_POST['portion']) && empty($_POST['portion'])){ 
			$error = 'Please Select Portion<br>';
		}
		if(isset($_POST['family_member']) && empty($_POST['family_member'])){ 
			$error .= 'Please Enter Family Member<br>';
		}
		if(isset($_POST['living_type']) && empty($_POST['living_type'])){ 
			$error .= 'Please Select Living Type<br>';
		}
		
		if(!empty($error)){
			echo $error;
			}else
				{
$connection = Yii::app()->db;
   $sql  = "insert into bcd_family(plot_id,portion,family_member,living_type) Values('".$_POST['plot_id']."','".$_POST['portion']."','".$_POST['family_member']."','".$_POST['living_type']."')";	
 $command = $connection -> createCommand($sql);
 $command -> execute();
 $update="Update bcd set family_shifted='1' where plot_id='".$_POST['plot_id']."'"; 
 $command=$connection->CreateCommand($update);
 $command->execute();
 echo 'Family detail added successfully';
	}
	}
	 public function actionAdd_family()
	{ 

		$this->layout='//layouts/back';
		$this->render('add_family');
	}
	/////////////END : Add Family/////////////////
	/////////////START: UPDATE CONSTRUCTION STATUS///////////////
	public function actionUpdate_cstatus()
	{
			$uid=Yii::app()->session['user_array']['id'];
		 $error ='';
		if(isset($_POST['construction_status']) && empty($_POST['construction_status'])){ 
			$error .= 'Please Select Status<br>';
		}
		if(!empty($error)){
			echo $error;
			}else
				{
$connection = Yii::app()->db;
  $sql  = 'Update bcd SET construction_status="'.$_POST['construction_status'].'" where plot_id="'.$_POST['plot_id'].'"';	
$command = $connection -> createCommand($sql);
 $command -> execute(); 
 echo 'Construction Status Updated';
	}
	}
	 public function actionConstruction_status()
	{ 

		$this->layout='//layouts/back';
		$this->render('construction_status');
	}
	/////////////END : UPDATE CONSTRUCTION STATUS/////////////////

	/////////////START: CREATE POSSESSION ///////////////
public function actionCreate()
	{ 
		$error='';
		$connection = Yii::app()->db;
			if((isset($_POST['building_type']) && empty($_POST['building_type'])))
		{
			$error .= 'Please Select Building Type </br>';
		}
		if((isset($_POST['remarks']) && empty($_POST['remarks'])))
		{
			$error .= 'Please Enter Remarks</br>';
		}
					if(empty($error))
						{
							$query="Select * from bcd where plot_id='".$_POST['plot_id']."'";
									 $result_q = $connection->createCommand($query)->queryRow();
									/// echo $_POST['plot_id'];exit;
									if ($result_q['plot_id']==$_POST['plot_id']){
									 echo $error .="Membership # Already Added Try Another. <br>";exit;
									}	
							  $update="Update plots set possession_status='1' where id=".$_POST['plot_id']."";
						 $command=$connection->CreateCommand($update);
						 $command->execute();		
						  $insert="INSERT INTO bcd(plot_id,building_type,possession,remarks) Values('".$_POST['plot_id']."','".$_POST['building_type']."','Given','".$_POST['remarks']."')";
						 $commad=$connection->CreateCommand($insert);
						 $commad->execute();
						
						 echo 'Possession Granted';
						}else
						{
							echo $error;exit;
						}
	}
	public function actionPossesion_req()
	{
		 if(isset(yii::app()->session['user_array']['username'])&&(yii::app()->session['user_array']['per_bcd_mgm']==1))
		 {
			$connection = Yii::app()->db;  
		$sql_country  = "SELECT * from tbl_country";
		$result_country = $connection->createCommand($sql_country)->query();
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
		$sql_plan  = "SELECT ip.*,p.project_name from installment_plan ip
		left join projects p on ip.project_id=p.id";
		$result_plan = $connection->createCommand($sql_plan)->query();
		$this->render('possesion_req',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));
		}
			else{
				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
				} 
			 
	
		 }
	/////////////END : CREATE POSSESSION/////////////////
	
	/////////////START: POSSESSION LIST ///////////////
	public function actionSelectPlot($val1)
	 {	
		$connection = Yii::app()->db;  
		 $sql_city  = "SELECT streets.street,plots.plot_detail_address,plots.com_res,size_cat.size,memberplot.*,members.name,members.address,members.cnic,members.image,projects.project_name
		  from memberplot 
		  left join members  on memberplot.member_id=members.id
		  Left JOIN plots  ON (memberplot.plot_id = plots.id)
		  Left JOIN projects  ON (plots.project_id = projects.id)
		  Left JOIN size_cat  ON (plots.size2 = size_cat.id)
		  Left JOIN streets  ON (plots.street_id = streets.id)
		  Left JOIN bcd  ON (plots.id =bcd.plot_id)
		 where plotno= '".$val1."'";
		$result_city = $connection->createCommand($sql_city)->query();
		$city=array();
		foreach($result_city as $cit){
			$city[]=$cit;
			} 
		echo json_encode($city); exit();
	}
	public function actionPossession_list()
	{	
			if((Yii::app()->session['user_array']['per_bcd_mgm']=='1')&& isset(Yii::app()->session['user_array']['username']))
			{
	$connection = Yii::app()->db; 
	 $sql_member = "SELECT mp.plot_id,mp.member_id,mp.create_date,mp.plotno,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.project_id,p.plot_size,s.street, j.project_name FROM bcd bcd
left join plots p on bcd.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id

left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id 
where mp.status='Approved' "; 
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

			$this->render('possession_list',array('members'=>$result_members,'projects'=>$result_projects));

	}else{
		  $this->redirect(array("user/dashboard"));	

		}

	}
	  public function actionSearchreq()
	{
		$where="p.type='plot'";
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
			if (!empty($_POST['app_no'])){

				if ($and==true)
				{
					$where.=" and mp.app_no =".$_POST['app_no']."";
				}
				else
				{
					$where.=" mp.app_no =".$_POST['app_no']."";
				}
				$and=true;
			}
			
					$allotmentstatus='';
					if(($_POST['family_shifted'])!=='')
					{
					if($_POST['family_shifted']==1){
						if ($and==true)
									{
										$where.="and bcd.family_shifted='1'";
									}
									else
									{
										$where.="bcd.family_shifted='1'";
									}
									
									}
					if($_POST['family_shifted']==0){if ($and==true)
									{
										$where.="and bcd.family_shifted='0'";
									}
									else
									{
										$where.="and bcd.family_shifted='0'";
									}
										$and=true;
													}
				}
					if(($_POST['construction_status'])!=='')
					{
					if($_POST['construction_status']=='25% Completed'){
						if ($and==true)
									{
										$where.="and bcd.construction_status='25% Completed'";
									}
									else
									{
										$where.="bcd.construction_status='25% Completed'";
									}
									
									}
					if($_POST['construction_status']=='50% Completed'){if ($and==true)
									{
										$where.="and bcd.construction_status='50% Completed'";
									}
									else
									{
										$where.="and bcd.construction_status='50% Completed'";
									}
										$and=true;
													}
					if($_POST['construction_status']=='Completed'){if ($and==true)
									{
										$where.="and bcd.construction_status='Completed'";
									}
									else
									{
										$where.="and bcd.construction_status='Completed'";
									}
										$and=true;
													}
					if($_POST['construction_status']=='0'){if ($and==true)
									{
										$where.="and bcd.construction_status=''";
									}
									else
									{
										$where.="and bcd.construction_status=''";
									}
										$and=true;
													}
				}
			
			
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno LIKE '%".$_POST['plotno']."%'";
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
 $sql_memberas = "SELECT * FROM bcd bcd

left join plots p on bcd.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id
left join associates assoc on mp.id=assoc.msid
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join cancelplot cp on cp.plot_id=p.id
left join projects j on p.project_id=j.id

where $where";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
        $sql_member = "SELECT bcd.construction_status,bcd.building_type,bcd.possession,bcd.family_shifted,bcd.remarks,assoc.id as associd,cp.status as cpstatus,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM bcd bcd
left join plots p on bcd.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id
left join associates assoc on mp.id=assoc.msid
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join cancelplot cp on cp.plot_id=p.id
left join projects j on p.project_id=j.id


where  $where ORDER BY mp.plotno ASC limit $start,$limit";
	
		$result_members = $connection->createCommand($sql_member)->queryAll();
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
			  if($key['stst']==0){$msco='Green';}if($key['stst']==1){$msco='Orange';}if($key['stst']==2){$msco='Red';}if($key['stst']==3){$msco='Black';}
		          echo'<tr><td style=" font-weight:bold;color:'.$msco.';">';if(empty($key['plotno'])){ echo 'App-'. $key['app_no'];}else { echo $key['plotno'];} echo'</td>
			<td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td>
			<td>'.$key['cnic'].'</td>
			 <td>';echo $key['size'].'&nbsp;('.$key['plot_size'].')';echo'</td>
			 <td><strong>';if($key['stst']==2){echo'<span style="color:red">Blocked</span>';}else{
				  echo '<a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'];}echo'</strong></a></td>
		    	<td>'.$key['street'].'/'.$key['sector_name'].'</td>
				  <td>'.$key['project_name'].'</td>
				  	  <td>';echo $key['building_type'];echo '</td>
				  <td>';echo $key['possession'];echo'</td>
				   <td>';if(empty($key['construction_status'])){echo'<span style="color:red">Not Started</span>';}else{echo '<span style="color:green">'. $key['construction_status'].'</span>';}echo'</td>
				   <td>';if($key['family_shifted']==1){ echo'Yes';}else {echo 'No';}echo'</td>
				    <td>';echo $key['remarks'];echo'</td>
					
				 <td> ';
                               if(Yii::app()->session['user_array']['per34']=='1'){echo'<a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a>';}else{
                                  echo'<div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';
				  	if($key['construction_status']=='Completed'){ echo'';	}else{
			echo'<li role="presentation"><a target="_blank" href="construction_status?plot_id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Construction Status</a></li>';
					}
			if($key['construction_status']=='Completed'){	
			echo'<li role="presentation"><a target="_blank" href="add_family?plot_id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Add Family</a></li>'; 
			}else{ echo'';}
 				 echo'
				 </ul></div>';}
                       echo' </td></tr>';             
                        
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
    echo '<tr  ><td colspan="11"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td>';?>
	<td><form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="landscape">
<textarea style="display:none;" name="html" id="html">

<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
td{  }
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:0px solid;}

</style>
<table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
    <tr>
      <td style="padding:0 0 0 0; ">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php   echo'<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo1.png"/>';?>
                  </td>
                  <td colspan="8" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Possession Property Report</span></td>
                  <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
                    </tr>
                    <tr>
                      <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                    </tr>
                    
                  </table></td>
                </tr>
                <tr>
                  <td height="20" colspan="10" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php  echo $key['project_name']; ?></strong></span></td>
                </tr>
                <tr>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                MS No.
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Name
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                CNIC
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                Plot Size
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                Plot No.
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Building Type
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Possession
                </td>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Construction
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Family Shfted
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Remarks
                </td>
                </tr>
                
                
                
            <?php 
		  foreach($result_members as $key){?>
                <tr>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            <?php if(empty($key['plotno'])){ echo 'App-'. $key['app_no'];}else { echo $key['plotno'];}?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             <?php echo $key['name'];?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                <?php echo $key['cnic'];?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               <?php echo $key['size'].'&nbsp;('.$key['plot_size'].')';?>
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php echo $key['plot_detail_address'];?>
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                <?php echo $key['building_type'];?>
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
              <?php echo $key['possession'];?>
                </td>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               <?php if(empty($key['construction_status'])){echo'<span style="color:red">Not Started</span>';}else{echo '<span style="color:green">'. $key['construction_status'].'</span>';}?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             <?php if($key['family_shifted']==1){ echo'Yes';}else {echo 'No';}?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               <?php echo $key['remarks'];?>
                </td>
                </tr>
                <?php }?>
                
                
                
                
                
                
            </table></td>
          </tr>
      </table></td>
      </tr>
    
   
  </table>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Watch List PDF Report</title>
						
						
						
							</textarea>
	
					<input type="submit" class="btn-input" name="Add" value="Print" style="float:right;"  />
							</form></td>
	
	<?php echo'</tr>';
	echo '<tr><td colspan="12">'.$pagination.'</td></tr>'; exit; 
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
	/////////////END : POSSESSION LIST/////////////////
	

}
?>