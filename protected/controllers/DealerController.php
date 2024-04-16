<?php
class DealerController extends Controller
{
	public function actionSearchreq1()
	 	{
		$where='';
		$and=false;
		$and = false;
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
			if (!empty($_POST['stat'])){
				$q='';
            	$q="drp.status='".$_POST['stat']."'";
				if ($and==true)
				{
					$where.=" and ".$q."";
				}
				else
				{
					$where.=$q;
				}
				$and==true;
			}
	
			
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
			}				
			$filter='';
			$jo='';
			if(Yii::app()->session['user_array']['per12']){$filter='and mp.uid='.Yii::app()->session['user_array']['id'];}
			if(Yii::app()->session['user_array']['per20']){
				$filter='';
				//and user.sc_id='.Yii::app()->session['user_array']['sc_id']
				$jo='';
				//Left join user on(mp.uid=user.id)
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
echo $sql_memberas = "SELECT * FROM dealer_reserve_plot drp
left join plots p on drp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
left join sectors sec on sec.id=p.sector
where  $where  ".$filter."";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
   echo  $sql_member = "SELECT *,drp.create_date as drpcd FROM dealer_reserve_plot drp
left join plots p on drp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
left join sectors sec on sec.id=p.sector
left join size_cat sc on p.size2=sc.id
where $where ".$filter."   limit $start,$limit"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){
			$sst='';
			date_default_timezone_set('Asia/Karachi');
$time1 = new DateTime($key['drpcd']);
$time2 = new DateTime(date('Y-m-d H:m:s'));
$interval = $time1->diff($time2);
echo $deff45= $interval->format('%H hour(H)');
if($deff45 > 24){$sst='background-color:red;';}
            $count++;
			echo $count.' result found';
			 echo '<tr style="'.$sst.'"><td>'.$key['drpcd'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td>';
$status12='';
//echo $deff45;
if($deff45 < 24){
			echo '<a href="req_detail?plot_id='.$key['plot_id'].'">Delete Request</a>';
			}
			echo '</td>';
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
	public function actionAjaxRequest12($val1)
		{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from sectors where project_id='".$val1."'";

		$result_city = $connection->createCommand($sql_city)->query();

			

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

		

	echo json_encode($city); exit();

	}
	public function actionAjaxRequest1()
		{	

		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from plots where street_id='".$_POST['street']."' and size2='".$_POST['size']."' and status=''";
		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	}
	
	public function actionAlotaplot1()
	{ 
		$error='';
		date_default_timezone_set('Asia/Karachi');
		$connection = Yii::app()->db; 
		
		$uid=Yii::app()->session['dealer_array']['id'];
		$sql  = "INSERT INTO dealer_reserve_plot (plot_id,status,dealer_id,create_date) 
	VALUES ('".$_POST['plot_id']."','1','".$uid."','".date('Y-m-d H-m-s')."')";	
	    $command = $connection -> createCommand($sql);
        $command -> execute();
	    echo 'Plot Resereved for 24 hour after 24 hour plot will be Available in Reservation List';
	   }
	
	public function actionMemberplot()
		{	
$this->layout='//layouts/dealer';
	 if(Yii::app()->session['dealer_array'])

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
		//$sql_project = $sql_project.implode(' or',$sql2);
		$sql_project = 'SELECT * from projects';
		
$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

		$sql_plan  = "SELECT ip.*,p.project_name from installment_plan ip
		left join projects p on ip.project_id=p.id
		
		 ";
		$result_plan = $connection->createCommand($sql_plan)->query();
	
		

		$this->render('memberplot',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/dealer/dashboard"); }

				

	}
	public function actionAllotments_lis()
		{	
		$this->layout='//layouts/dealer';

	if((Yii::app()->session['dealer_array']['id']!=='')&& isset(Yii::app()->session['dealer_array']['username'])){
	    $connection = Yii::app()->db; 
	//	$temp_projects_array = Yii::app()->session['projects_array'];
		//$num_of_projects_counter = count($temp_projects_array);	
		//$num_of_projects_counter2 = $num_of_projects_counter;
		//$sql1 =   "select * from projects where";
		//$num_of_projects_counter--;
		//while($num_of_projects_counter>-1)
		//{
			//$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			//$num_of_projects_counter--;
		//}
		
		//$sql_project = $sql1;
		//$sql_project = $sql_project.implode(' or',$sql2);
		//$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
		$sql_project = 'SELECT * from projects';
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

			
			//$this->render('allotments_lis',array('members'=>$result_members,'projects'=>$result_projects));
			$this->render('allotments_lis',array('projects'=>$result_projects));
	}else{
		 $this->redirect(array("dealer/dashboard"));	

		}
	}
	public function actionAjaxRequest($pro,$sec)
		{	

	$connection = Yii::app()->db;  

		$sql_street  = "SELECT * from streets where project_id='".$pro."' and sector_id='".$sec."'";

		$result_streets = $connection->createCommand($sql_street)->query();

			

		$street=array();

		foreach($result_streets as $str){

			$street[]=$str;

			} 

		

	echo json_encode($street); exit();

	}
	public function actionMeminfo()
	{	
			

			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			
			$sql_mem  = "SELECT * from members where id='".$_REQUEST['id']."'";
			$result_mems = $connection->createCommand($sql_mem)->query();
		    $this->render('meminfo',array('member'=>$result_mems));
		
	}
	public function actionDocs()
	{
		if(Yii::app()->session['dealer_array']['per6']=='1' && isset(Yii::app()->session['dealer_array']['username']))
			{
	$this->layout='//layouts/back';
	$this->render('doc');


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
    public function actionChange_password()
	{       

			   $connection = Yii::app()->db;  
			
			  $sql="UPDATE user set password='".$_POST['password']."',address='".$_POST['address']."',mobile='".$_POST['mobile']."',city='".$_POST['city']."',country='".$_POST['country']."' where id='".$_POST['id']."' ";  

               $command = $connection -> createCommand($sql);

               $command -> execute();
			   
			   $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

			   
	}
	public function actionChange_picture()
	{       

			   $connection = Yii::app()->db;
			   if(!empty($_POST['ppic'])){
			   unlink('images/user/'.$_POST['ppic']);  
			   }
			    $pic =  $_FILES["pic"]["name"];
			 move_uploaded_file($_FILES["pic"]["tmp_name"],'images/user/'.$pic);
			   $sql="UPDATE user set pic='".$pic."' where id='".$_POST['id']."' ";  

               $command = $connection -> createCommand($sql);

               $command -> execute();
			   
			   $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

			   
	}
	public function actionAjaxRequest7($val1)
	{	
			$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from user where username='".$val1."'";
		$result_city = $connection->createCommand($sql_city)->query();
		$city=array();
		foreach($result_city as $cit){
			$city[]=$cit;
			} 
	echo json_encode($city); exit();
	}
	function actionDelete_subcriber()
	{
		  if(Yii::app()->session['dealer_array']['per3']=='1')
			{
		
		  $connection = Yii::app()->db;
	  $sql  = "Delete from subcription where id='".$_REQUEST['id']."'";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			
		 		 $this->redirect(array("user/subcriber_list"));
			}
			else{
				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
				
			}
		
	}
	public function actionSubcriber_list()
	{	
	if(Yii::app()->session['dealer_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['dealer_array']) && isset(Yii::app()->session['dealer_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db;
	
	//$sql="SELECT * FROM charges
	 
	// $where";
	 $sql="SELECT * FROM subcription "; 
	$result = $connection->createCommand($sql)->query();
	
	$this->render('subcriber_list',array('subcriber'=>$result));
	   }
	  	else{
			$this->redirect (array('dealer/login'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionPdf_forms()
	{



		$this->layout='//layouts/front';



		$this->render('pdf_forms');



	}
	public function actionAjaxRequest6($val1)
	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from memberplot where plotno='".$val1."'";

		$result_city = $connection->createCommand($sql_city)->query();

			

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

		

	echo json_encode($city); exit();

	}
	 public function actionReq_list()
	 {
		 if(Yii::app()->session['dealer_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
			  $sql_details  = "SELECT size.size,tp.*,sec.sector_name,s.street,tp.fstatus,p.plot_detail_address,mp.plotno,p.plot_size,pro.project_name,m_from.name from_name,m_to.name to_name FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
                        Left JOIN size_cat size ON size.id=p.size2
                        Left JOIN sectors sec ON p.sector=sec.id
                        Left JOIN memberplot mp ON p.id=mp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id 
			where tp.status='New Request' And tp.fstatus='Approved'  ";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('req_list',array('plotdetails'=>$result_details));



			}else{$this->redirect(array("dashboard"));}



	}
	public function actionUser_detail()
    {
		 if(Yii::app()->session['dealer_array']['username'])
			{
			$connection = Yii::app()->db; 	
			$session=Yii::app()->session['dealer_array']['id'];
			$sql_details  = "SELECT * from user where id='".$session."'";
			$result_details = $connection->createCommand($sql_details)->query();
			 $sql  = "SELECT p.id,pp.project_id,pp.user_id,p.project_name from project_permissions pp
			left join projects p on pp.project_id=p.id
			
			 where user_id='".$session."' ORDER BY p.id ASC";
			$result = $connection->createCommand($sql)->query();

			$this->render('user_detail',array('user_detail'=>$result_details,'project'=>$result));
			}



			else{



				$this->redirect('dashboard');



			}



			







	   }
	public function actionMemhistory()
	{	



			if(Yii::app()->session['dealer_array']['id']!=='')



			{



			$this->layout='//layouts/back';



			$connection = Yii::app()->db;



			$sql_projects  = "SELECT
  mp.plot_id,
  mp.member_id,
  mp.plotno,
  mp.create_date,
  m.name,
  m.username,
  m.sodowo,
  m.cnic,
  p.id plot_id,
  p.plot_detail_address,
  p.plot_size,
  s.street,
  j.project_name,
  size_cat.size,
  sec.sector_name
FROM
  plothistory ph
LEFT JOIN
  plots p ON ph.plot_id = p.id
LEFT JOIN
  memberplot mp ON mp.plot_id = p.id
LEFT JOIN
  members m ON mp.member_id = m.id
LEFT JOIN
  size_cat size_cat ON p.size2 = size_cat.id
LEFT JOIN
  streets s ON p.street_id = s.id
LEFT JOIN
  sectors sec ON p.sector = sec.id
LEFT JOIN
  projects j ON s.project_id = j.id
WHERE
  ph.transferfrom_id ='".$_REQUEST['id']."'";



			$result_projects = $connection->createCommand($sql_projects)->query();



			



			$sql_page  = "SELECT mp.member_id,mp.plotno,mp.create_date, m.name,m.username,m.sodowo,m.cnic,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name ,size_cat.size,sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join size_cat size_cat on p.size2=size_cat.id
left join streets s on p.street_id=s.id
left join sectors sec on p.sector=sec.id
left join projects j on s.project_id=j.id 
WHERE member_id ='".$_REQUEST['id']."'";



			$result_pages = $connection->createCommand($sql_page)->query();



			



			$sql_mem  = "SELECT * from members where id='".$_REQUEST['id']."'";



			$result_mems = $connection->createCommand($sql_mem)->query();



		    $this->render('memhistory',array('projects'=>$result_projects,'pages'=>$result_pages,'member'=>$result_mems));



			}else{$this->redirect(array("dashboard"));}



	}
	public function actionReq_detail()
	{
	if(Yii::app()->session['dealer_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,sec.sector_name,siz.size,p.com_res, mp.id as mssid,p.sector,mp.tempms,mp.plotno,p.plot_detail_address,p.plot_size,tp.fp,tp.fstatus,pro.project_name,m_from.name from_name,m_to.name to_name 
			,m_to.cnic,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.city_id,m_to.state
			FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
                        Left JOIN memberplot mp ON p.id=mp.plot_id
                        Left JOIN sectors sec ON sec.id=p.sector
			Left JOIN size_cat siz ON siz.id=p.size2
			Left JOIN streets s ON s.id=p.street_id
			left join user u on tp.uid=u.id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id=".$_REQUEST['id']."";
			$result_details = $connection->createCommand($sql_details)->queryAll();
			$this->render('req_detail',array('plotdetails'=>$result_details)); 
			
       }else{$this->redirect(array("dashboard"));}



	}
	 public function actionVerreq_list()
	 {
	if(Yii::app()->session['dealer_array']['per10']=='1')
			{
				
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,sec.sector_name,siz.size,s.street,tp.fp,tp.fstatus,p.plot_detail_address,p.plot_size,pro.project_name,m_from.name from_name,m_to.name to_name FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
                        Left JOIN size_cat siz ON siz.id=p.size2
                         Left JOIN sectors sec ON sec.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id 
			where tp.fp=''";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('verreq_list',array('plotdetails'=>$result_details));

}else{$this->redirect(array("dashboard"));}

			


	}
	public function actionUpdate_user()
	{	
	if(Yii::app()->session['dealer_array']['per1']=='1')
			{
		$this->layout='//layouts/back';
		$connection = Yii::app()->db; 
		$sql_projects = "SELECT * FROM user where id=".$_GET['id'];
		$result_projects = $connection->createCommand($sql_projects)->query();
		$project = 'SELECT id,project_name from projects';
		$project = $connection->createCommand($project)->queryAll();
		$pp = 'SELECT per.id,per.project_id,proj.project_name from project_permissions per
		
		Left JOIN projects proj ON proj.id=per.project_id
		 where user_id='.$_GET['id'];
		$ppr = $connection->createCommand($pp)->queryAll();
		

	$this->render('update_user',array('update_user'=>$result_projects,'project'=>$project,'projectper'=>$ppr));
			}else{$this->redirect(array("dashboard"));}
	}
	public function actionIndex()
	{



		



		if(isset(Yii::app()->session['dealer_array']) && isset(Yii::app()->session['dealer_array']['username']))



		{



			 $this->redirect(array('user/dashboard'));



		}else



		{



			$error = '';






			



			 $this->redirect(array("dealer/login"));	



		}



		



	



	}
	public function actionDashboard()
	{

		 if(isset(Yii::app()->session['dealer_array']) && isset(Yii::app()->session['dealer_array']['username']))
		{ 
		
		$this->layout='//layouts/dealer';
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.name from_name,m_to.name to_name FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id";

			$result_details = $connection->createCommand($sql_details)->query();



			$this->render('dashboard',array('plotdetails'=>$result_details)); 



		}else



		{



		$this->redirect(array('dealer/login'));	



			}



		



		



		}
	public function actionLogin()
	{



		if(isset(Yii::app()->session['dealer_array']) && isset(Yii::app()->session['dealer_array']['username']))



		{



			 $this->redirect(array('user/dashboard'));



		}else



		{



		$this->layout='//layouts/login';



		$this->render('user');



		}



	}
	public function actionLogout()
	{



	



		if(isset(Yii::app()->session['dealer_array']))



		{



			 $connection = Yii::app()->db;  



			 $sql_update = "UPDATE user SET login_status ='0' WHERE id = ".Yii::app()->session['dealer_array']['id']."";



    		 $command=$connection->createCommand($sql_update);



			 $command->execute();



			 



			 unset(Yii::app()->session['dealer_array']);



			 $this->redirect(array("login"));



		}



		



		}
	public function actionGetLogin()
 	{
		 $error ='';
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
   				 $password = $_POST['password'];
				  $connection = Yii::app()->db;  
				   $sql = "SELECT * FROM members where username ='".$username."' AND  password='".$password."' AND mtype='Dealer'";
				  $result_data = $connection->createCommand($sql)->queryRow();
				  if(!empty($result_data))
				  {
					//$sql1 = "SELECT * FROM dealerproject_permissions where dealer_id ='".$result_data['id']."'";
					//$result_data1 = $connection->createCommand($sql1)->queryAll();
					Yii::app()->session['dealer_array'] = $result_data;
					//Yii::app()->session['projects_array']=$result_data1;
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