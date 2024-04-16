<?php
class VisitorsController extends Controller
{	
public function actionVisitors_dashboard(){
	
				if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
			
			$connection = Yii::app()->db; 
	
			
			
	
			$layout='//layouts/back';
			$this->render('visitors_dashboard');
			}
			else{
				$this->redirect(array('user/dashboard'));
				}
	
	
	}
public function actionOperators_detail()
	{	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
				$connection = Yii::app()->db; 
		
	       $sql_size  = "SELECT size,id FROM size_cat";  
      		$result_siz = $connection->createCommand($sql_size)->queryAll();
			 foreach($result_siz as $size){
		
			
			 }
	
         //projects permission start
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

		////////projects permission end
		   //Centers permission start
		 $connection = Yii::app()->db; 
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$sql11 =   "select * from sales_center where";
		$num_of_centers_counter--;
		while($num_of_centers_counter>-1)
		{
			$sql12[$num_of_centers_counter] = " id=".Yii::app()->session['centers_array'][$num_of_centers_counter]['center_id'];
			$num_of_centers_counter--;
		}
		
		$sql_center = $sql11;
		$sql_center = $sql_center.implode(' or',$sql12);
		$pro = $connection->createCommand($sql_center)->query() or mysql_error();

		////////Centers permission end
		
            $res=array();
             $sql_vis  = "SELECT * FROM daily_visitors_report ";
			$result_vis = $connection->createCommand($sql_vis)->queryAll();
			$result=count ( $result_vis );
			


			$this->render('operators_detail',array('result'=>$result,'pro'=>$pro,'result_siz'=>$result_siz));

			}else{
				$this->redirect(array('user/dashboard'));
				}
	}
public function actionSearchcenter()
	 	{
		
		
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			
	$uid=Yii::app()->session['user_array']['id'];	
		
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
$sql_user = "SELECT count(*) as total_records,  user.firstname,
   user.middelname,
   user.lastname,
   visit_details.visitors_id,
   visit_details.visit_type,
   visit_details.deal_by  class  FROM visit_details
   Left JOIN user  ON (visit_details.deal_by = user.id) 
	 GROUP BY user.id  ";  
      		
 
 $co = $connection->createCommand($sql_user)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 
           $sql_visitor  = "SELECT user.id, user.firstname,
   user.middelname,
   user.lastname,
    user.pic,
   0 as visitors,
   0 as callers,
   0 as booking FROM user  ";  
   
      		$result_vis = $connection->createCommand($sql_visitor)->queryAll();
			
			$tnoofvisitors=0;
			$tnoofcallers=0;
			$tnoofbookings=0;
        
		
	$count=0;



	if ($result_vis!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;
 $res=array();
$i=0;

            foreach($result_vis as $key){
				$noofvisits=0;
				$noofcalls=0;
				$noofbookings=0;

				echo $sql_test  ="SELECT count(visit_details.id) as tvistors,centers_permissions.center_id,centers_permissions.user_id FROM visit_details Left JOIN user ON (user.id = visit_details.deal_by) Left JOIN centers_permissions ON (user.id = centers_permissions.user_id) where visit_details.visit_type='visitor'  and centers_permissions.center_id='".$_POST['center_id']."' and deal_by = ".$key["id"]; 
$result_test = $connection->createCommand($sql_test)->queryAll();

				foreach($result_test as $visit1){
					$noofvisits=$visit1["tvistors"];
				}
				
				 $sql_caller="SELECT count(visit_details.id) as tcallers,centers_permissions.center_id,centers_permissions.user_id FROM visit_details Left JOIN user ON (user.id = visit_details.deal_by) Left JOIN centers_permissions ON (user.id = centers_permissions.user_id) where visit_details.visit_type='caller' and 
				  centers_permissions.center_id='".$_POST['center_id']."' and deal_by = ".$key["id"]; 
      		$result_caller = $connection->createCommand($sql_caller)->queryAll();
				foreach($result_caller as $visit){
					$noofcalls=$visit["tcallers"];
				}
			 	$sql_booking  = "SELECT count(interest_booking.id) as tbooking,sales_center.id  FROM interest_booking
			LEFT JOIN daily_visitors_report ON(daily_visitors_report.id=interest_booking.visitors_id)
			LEFT JOIN sales_center ON(sales_center.id=daily_visitors_report.center_id)
          where interest_booking.type='Booking' and sales_center.id=".$_POST['center_id']."  and deal_by = ".$key["id"]; 
      		$result_booking = $connection->createCommand($sql_booking)->queryAll();

				foreach($result_booking as $booking){
					$noofbookings=$booking["tbooking"];
				}
				
				if($noofvisits>0 || $noofcalls >0)
				{
					$i++;
					$count++;
		
				$tnoofvisitors=$noofvisits+$tnoofvisitors;
				$tnoofcallers=$noofcalls+$tnoofcallers;
			    $tnoofbookings=$noofbookings+$tnoofbookings;
		  
		
					echo '<tr><td>'.$i.'</td><td><img width="60" height="60" src="/images/user/'.$key['pic'].'"></td><td>'.$key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp;'.$key['lastname'].'</td><td style="text-align:center;">'.$noofvisits.'</td><td style="text-align:center;">'.$noofcalls.'</td><td style="text-align:center;">'.$noofbookings.'&nbsp;
 <a href="operators_detail?id='.$key['id'].'"><button type="button" class="btn btn-primary" >Detail</button></a>';
		
		
		
					echo '</tr>';
				  }
 
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
 echo '<tr style="background-color:#0CF";  ><td  colspan="2" ><b >Total</b></td><td></td><td style="text-align:center;"><b>'.$tnoofvisitors.'</b></td><td style="text-align:center;"><b>'.$tnoofcallers.'</td><td style="text-align:center;"><b>'.$tnoofbookings.'</b></td></tr>';
  echo '<tr  ><td  colspan="6" ><span style="float:right;"><button type="button" class="btn btn-default">Print Report</button></span></tr>';
 exit; 
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
public function actionSearchmain()
	 	{
			$where='';

		$and=false;
		  
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			
				if ( isset($_POST['center_id']) &&  $_POST['center_id']!=""){				
				$pro=$_POST['center_id'];
				if ($and==true)
				{
					$where.=" and centers_permissions.center_id = '".$_POST['center_id']."'";
				}
				else
				{
					$where.=" centers_permissions.center_id = '".$_POST['center_id']."'";
				}
				$and=true;
			}
	$uid=Yii::app()->session['user_array']['id'];	
		
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
$sql_user = "SELECT count(*) as total_records,  user.firstname,
   user.middelname,
   user.lastname,
   visit_details.visitors_id,
   visit_details.visit_type,
   visit_details.deal_by  class  FROM visit_details
   Left JOIN user  ON (visit_details.deal_by = user.id) 
	 GROUP BY user.id  ";  
      		
 
 $co = $connection->createCommand($sql_user)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 
           $sql_visitor  = "SELECT user.id, user.firstname,
   user.middelname,
   user.lastname,
    user.pic,
	centers_permissions.user_id,
   0 as visitors,
   0 as callers,
   0 as booking 
   
        FROM user
		 Left JOIN centers_permissions  ON (user.id = centers_permissions.user_id)
	Left JOIN sales_center  ON (sales_center.id = centers_permissions.center_id)

		  where $where  ";  
   
      		$result_vis = $connection->createCommand($sql_visitor)->queryAll();
			
			$tnoofvisitors=0;
			$tnoofcallers=0;
			$tnoofbookings=0;
        
		
	$count=0;



	if ($result_vis!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;
 $res=array();
$i=0;

            foreach($result_vis as $key){
				$noofvisits=0;
				$noofcalls=0;
				$noofbookings=0;

				 $sql_test  ="SELECT count(visit_details.id) as tvistors,centers_permissions.center_id,centers_permissions.user_id FROM visit_details Left JOIN user ON (user.id = visit_details.deal_by) Left JOIN centers_permissions ON (user.id = centers_permissions.user_id) where visit_details.visit_type='visitor'  and centers_permissions.center_id='".$_POST['center_id']."' and deal_by = ".$key["id"]; 
$result_test = $connection->createCommand($sql_test)->queryAll();

				foreach($result_test as $visit1){
					$noofvisits=$visit1["tvistors"];
				}
				
				 $sql_caller="SELECT count(visit_details.id) as tcallers,centers_permissions.center_id,centers_permissions.user_id FROM visit_details Left JOIN user ON (user.id = visit_details.deal_by) Left JOIN centers_permissions ON (user.id = centers_permissions.user_id) where visit_details.visit_type='caller' and  centers_permissions.center_id='".$_POST['center_id']."' and deal_by = ".$key["id"]; 
      		$result_caller = $connection->createCommand($sql_caller)->queryAll();
				foreach($result_caller as $visit){
					$noofcalls=$visit["tcallers"];
				}
				$sql_booking  = "SELECT count(id) as tbooking  FROM interest_booking
          where interest_booking.type='Booking' and deal_by = ".$key["id"]; 
      		$result_booking = $connection->createCommand($sql_booking)->queryAll();

				foreach($result_booking as $booking){
					$noofbookings=$booking["tbooking"];
				}
				
				if($noofvisits>0 || $noofcalls >0)
				{
					$i++;
					$count++;
		
				$tnoofvisitors=$noofvisits+$tnoofvisitors;
				$tnoofcallers=$noofcalls+$tnoofcallers;
			    $tnoofbookings=$noofbookings+$tnoofbookings;
		  
		
					echo '<tr><td>'.$i.'</td><td><img width="60" height="60" src="/images/user/'.$key['pic'].'"></td><td>'.$key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp;'.$key['lastname'].'</td><td>'.$noofvisits.'</td><td>'.$noofcalls.'</td><td>'.$noofbookings.'</td>';
		
		
		
					'</tr>';
				  }
 
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
 echo '<tr style="background-color:#0CF";  ><td  colspan="2" ><b >Total</b></td><td></td><td><b>'.$tnoofvisitors.'</b></td><td><b>'.$tnoofcallers.'</td><td><b>'.$tnoofbookings.'</b></td></tr>';
  echo '<tr  ><td  colspan="6" ><span style="float:right;"><button type="button" class="btn btn-default">Print Report</button></span></tr>';
 exit; 
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
public function actionMain_lis()
	{	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
				
	   	$connection = Yii::app()->db; 
    $sql_visitors = "SELECT * FROM daily_visitors_report";

		$result_visitors = $connection->createCommand($sql_visitors)->query();
         //projects permission start
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

		////////projects permission end
		   //Centers permission start
		 $connection = Yii::app()->db; 
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$sql11 =   "select * from sales_center where";
		$num_of_centers_counter--;
		while($num_of_centers_counter>-1)
		{
			$sql12[$num_of_centers_counter] = " id=".Yii::app()->session['centers_array'][$num_of_centers_counter]['center_id'];
			$num_of_centers_counter--;
		}
		
		$sql_center = $sql11;
		$sql_center = $sql_center.implode(' or',$sql12);
		$pro = $connection->createCommand($sql_center)->query() or mysql_error();

		////////Centers permission end
		
            $res=array();
             $sql_vis  = "SELECT * FROM daily_visitors_report ";
			$result_vis = $connection->createCommand($sql_vis)->queryAll();
			$result=count ( $result_vis );


			$this->render('main_lis',array('visitors'=>$result_visitors,'result'=>$result,'pro'=>$pro));

			}else{
				$this->redirect(array('user/dashboard'));
				}
	}
	public function actionSearchhis()
	 	{
			
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			
			
	$uid=Yii::app()->session['user_array']['id'];	
		
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
  $sql_memberas = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.id as pid,profession.profession      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
 	 Where dvr.id='".$_REQUEST['id']."'";  
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 

     $sql_member = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.id as pid,profession.profession      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
 	 Where dvr.id='".$_REQUEST['id']."'
 	 "; 
      		$result_members = $connection->createCommand($sql_member)->query();
 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();
$i=0;


            foreach($result_members as $key){

			$i++;

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
			

			echo '<tr><td>'.$i.'</td><td>'.$key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp;'.$key['lastname'].'</td><td>Visitors</td><td>Callers</td><td>Booking</td><td>Remarks</td>';



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
 echo '<tr  ><td colspan="2"><b style="color:#08c">Total</b></td><td></td><td></td><td></td></tr>';
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
	
	
	public function actionHistory_lis()
	{	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
	   	$connection = Yii::app()->db; 
    $sql_visitors = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.id as pid,profession.profession      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
 	 Where dvr.id='".$_REQUEST['id']."'";

		$result_visitors = $connection->createCommand($sql_visitors)->query();
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
		    $home=Yii::app()->request->baseUrl; 
		
            $res=array();
             $sql_vis  = "SELECT * FROM daily_visitors_report ";
			$result_vis = $connection->createCommand($sql_vis)->queryAll();
			$result=count ( $result_vis );


			$this->render('history_lis',array('visitors'=>$result_visitors,'result'=>$result));

			}else{
				$this->redirect(array('user/dashboard'));
				}
	}
public function actionSearchreq()
	 	{
			
		if(Yii::app()->session['user_array']['per12']=='1')
			{
				$uid=Yii::app()->session['user_array']['id'];
				$where='visit_details.deal_by='.$uid;
		    $and = false;
			
			/*if (!empty($_POST['name1'])){
				$where.=" dvr.name LIKE '%".$_POST['name1']."%'";
				$and = true;
			}*/
				if (!empty($_POST['name1'])){	
				 $and = true;			
				if ($and==true)
				{
					$where.=" and dvr.name LIKE '%".$_POST['name1']."%'";

				}
				else
				{

					$where.=" dvr.name1 LIKE '%".$_POST['name1']."%'";

				}
				$and=true;

			}
				if (!empty($_POST['contactno'])){	
				 $and = true;				
				if ($and==true)
				{
					$where.=" and dvr.contactno LIKE '%".$_POST['contactno']."%'";

				}
				else
				{

					$where.=" dvr.contactno LIKE '%".$_POST['contactno']."%'";

				}
				$and=true;

			}

			
	$uid=Yii::app()->session['user_array']['id'];	
		
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
 $sql_memberas = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.profession,visit_details.visitors_id,visit_details.deal_by      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
	Left JOIN visit_details  ON (dvr.id = visit_details.visitors_id)  where
 	  $where GROUP BY vname ";  
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 

   echo  $sql_member = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.profession,visit_details.visitors_id,visit_details.deal_by      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
	Left JOIN visit_details  ON (dvr.id = visit_details.visitors_id)  
 	 Where $where  GROUP BY vname limit $start,$limit  "; 
      		$result_members = $connection->createCommand($sql_member)->query();
 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();
$i=0;


            foreach($result_members as $key){

			$i++;

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
			

			echo '<tr><td>'.$i.'</td><td>Date</td><td>'.$key['vname'].'</td><td>'.$key['profession'].'</td><td>'.$key['contactno'].'</td><td>'.$key['email'].'</td><td>'.$key['city'].'</td><td>'.$key['refered_by'].'</td><td>'.$key['reference'].'</td>';

		if(Yii::app()->session['user_array']['per12']=='1')
			{
echo '<td><div class="dropdown" style="width:15px;" >
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a href="history_lis?id='.$key['vid'].'">Visit History</a></li>
			<li role="presentation"><a href="updatevisitors?id='.$key['vid'].'">Edit Visitor</a></li>
			<li role="presentation"><a href="deletevisitor?id='.$key['vid'].'">Delete Visitor</a></li>
			<li role="presentation"><a href="visitdetailsec?id='.$key['vid'].'">Add Visit Detail</a></li>
		</td>';}

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
 echo '<tr  ><td colspan="10"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="10">'.$pagination.'</td></tr>'; exit; 
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
	public function actionCreate()
	{ 
	      $connection = Yii::app()->db;  
        $error="";
	         $error =array();
			
			if(isset($_POST['name']) && empty($_POST['name']))
		{
				$error = 'Please Enter Name<br>';
			}
			if(isset($_POST['email']) && empty($_POST['email']))
			{
				$error .= 'Please Enter Email<br>';
			}
          

			if(isset($_POST['profession']) && empty($_POST['profession']))
			{

				$error .= 'Please Enter Profession<br>';
			}
			

				if(isset($_POST['contactno']) && empty($_POST['contactno']))
			{
				$error .= 'Please Select Contact No.<br>';
			}
				if(isset($_POST['city']) && empty($_POST['city']))
			{
				$error .= 'Please Enter City<br>';
			}
				if(isset($_POST['refered_by']) && empty($_POST['refered_by']))
			{
				$error .= 'Please Enter Refered By<br>';
			}
				
			
			
				if(isset($_POST['reference']) && empty($_POST['reference']))

			{
				$error .= 'Please Enter Reference<br>';
			}
				  if(empty($error))

	{

         $sql  = 'INSERT INTO daily_visitors_report 
(name,email, profession, city,contactno,refered_by,reference,date,center_id )
               	    	  VALUES ( "'.$_POST['name'].'", "'.$_POST['email'].'", "'.$_POST['profession'].'", "'.$_POST['city'].'",  "'.$_POST['contactno'].'" ,"'.$_POST['refered_by'].'"
,"'.$_POST['reference'].'","'.date('d-m-Y').'","'.$_POST['center'].'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   
			   $last_insert_id = Yii::app()->db->getLastInsertID();
			   //Adding  to Database
	        	echo $note="New Record Inserted Successfully";
			
	}
	else{
		echo $error;
		}

		}
		public function actionAdd_direct_booking()
	{
		
	      $connection = Yii::app()->db;  
        $error="";
	         $error =array();
		
			
		  if(isset($_POST['name1']) && empty($_POST['name1']))
			{
				$error = 'Please Enter Name<br>';
			}	
             if(isset($_POST['booking_date']) && empty($_POST['booking_date']))
			{
				$error .= 'Please Enter Booking Date<br>';
			}	
			
           
			$uid=Yii::app()->session['user_array']['id'];
     if(empty($error))
	{   
	   		 $sql  = 'INSERT INTO daily_visitors_report (name,center_id ) VALUES ( "'.$_POST['name1'].'","'.$_POST['center'].'")';	
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			 $last_insert_id = Yii::app()->db->getLastInsertID();
			foreach($_POST as $key1=>$value)
			{
	
        //	echo substr($key1,0,4)." ";
			if( substr($key1,0,4) == "cat_")
			{  
			
				$catid= substr($key1,4,strlen($key1));
		
				//  $_POST["no_of_plots_".$catid]." ";
			  $sql = 'INSERT INTO interest_booking ( com_res,visitors_id,size2,type,booking_date,no_of_plots,deal_by )
			VALUES ( "'.$_POST['com_res'].'","'.$last_insert_id.'","'.$catid.'","Booking","'.$_POST['booking_date'].'","'.$_POST["no_of_plots_".$catid].'","'.$uid.'")';
					   $command = $connection -> createCommand($sql);
					   $command -> execute();
			
		
				}
				

			}			
            
				$sql1  = 'INSERT INTO visit_details (visitors_id,visit_date,deal_by,followup_status)
              VALUES ( "'.$last_insert_id.'","'.date('Y-m-d').'","'.$uid.'","2")';	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();

			  	          	echo "New Record Inserted Successfully";
	
	}
	else{
		echo $error;
		}

		}
		public function actionAdd_visit_detail()
	{
		
	      $connection = Yii::app()->db;  
        $error="";
	         $error =array();
		
			
		
             if(isset($_POST['remarks']) && empty($_POST['remarks']))
			{
				$error = 'Please Enter Remarks<br>';
			}	
			
             if(isset($_POST['next_visit']) && empty($_POST['next_visit']))
			{
				$error = 'Please Enter Next visit<br>';
			}
             if(isset($_POST['vtype']) && empty($_POST['vtype']))
			{
				$error = 'Select Visit Type<br>';
			}
           
			           $type='';
						$fustatus='';
						if($_POST['vtype']=='direct' )
							{
							$type = 'Booking';
							$fustatus='2';
							
							}else{
								$type =$_POST["type"];
								$fustatus='1';
								}
			$uid=Yii::app()->session['user_array']['id'];
  if(empty($error))
	{  
		foreach($_POST as $key1=>$value)
		{
	
        //	echo substr($key1,0,4)." ";
			if( substr($key1,0,4) == "cat_")
			{  
			
				$catid= substr($key1,4,strlen($key1));
		
				//  $_POST["no_of_plots_".$catid]." ";
			 $sql = 'INSERT INTO interest_booking ( com_res,visitors_id,size2,type,booking_date,no_of_plots,deal_by )
			VALUES ( "'.$_POST['com_res'].'","'.$_POST['id'].'","'.$catid.'","'.$type.'","'.$_POST['booking_date'].'","'.$_POST["no_of_plots_".$catid].'","'.$uid.'")';
					   $command = $connection -> createCommand($sql);
					   $command -> execute();
			
		
				}
				

			}			
            
				$sql1  = 'INSERT INTO visit_details (visitors_id,visit_date,deal_by,next_visit,remarks,visit_type,followup_status)
              VALUES ( "'.$_POST['id'].'","'.date('Y-m-d').'","'.$uid.'","'.$_POST['next_visit'].'","'.$_POST['remarks'].'","'.$_POST["vtype"].'","'.$fustatus.'")';	
               $command = $connection -> createCommand($sql1);
			   $command -> execute();

			  	          	echo "New Record Inserted Successfully";
	
	}
	else{
		echo $error;
		}

		}
		public function actionUpload_image()
	{



		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{ 



		$this->layout='//layouts/back';



		$this->render('upload_image');



		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/user"); }

	}
public function actionAppro_req_list()
 {
	 if(Yii::app()->session['user_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " p.project_id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
	   $sql_project = implode(' or',$sql2);
					 $sql_details  = "SELECT tp.id,tp.plot_id,tp.transferfrom_id,tp.transferto_id,tp.uid,tp.status, tp.image, tp.cmnt,tp.create_date,s.street,p.plot_detail_address,p.plot_size,p.com_res,p.size2,pro.project_name,m_from.name from_name,m_to.name to_name,p.project_id FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id WHERE tp.status='Approved' AND (".$sql_project.")   ";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('appro_req_list',array('plotdetails'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}

public function actionCenter_lis()
	{	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
				
	   	$connection = Yii::app()->db; 
    $sql_visitors = "SELECT * FROM daily_visitors_report";

		$result_visitors = $connection->createCommand($sql_visitors)->query();
         //projects permission start
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

		////////projects permission end
		   //Centers permission start
		 $connection = Yii::app()->db; 
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$sql11 =   "select * from sales_center where";
		$num_of_centers_counter--;
		while($num_of_centers_counter>-1)
		{
			$sql12[$num_of_centers_counter] = " id=".Yii::app()->session['centers_array'][$num_of_centers_counter]['center_id'];
			$num_of_centers_counter--;
		}
		
		$sql_center = $sql11;
		$sql_center = $sql_center.implode(' or',$sql12);
		$pro = $connection->createCommand($sql_center)->query() or mysql_error();

		////////Centers permission end
		
            $res=array();
             $sql_vis  = "SELECT * FROM daily_visitors_report ";
			$result_vis = $connection->createCommand($sql_vis)->queryAll();
			$result=count ( $result_vis );
			


			$this->render('center_lis',array('visitors'=>$result_visitors,'result'=>$result,'pro'=>$pro));

			}else{
				$this->redirect(array('user/dashboard'));
				}
	}
public function actionFollowup_lis()
	{	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
				
	   	$connection = Yii::app()->db; 
    $sql_visitors = "SELECT * FROM daily_visitors_report";

		$result_visitors = $connection->createCommand($sql_visitors)->query();
         //projects permission start
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

		////////projects permission end
		   //Centers permission start
		 $connection = Yii::app()->db; 
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$sql11 =   "select * from sales_center where";
		$num_of_centers_counter--;
		while($num_of_centers_counter>-1)
		{
			$sql12[$num_of_centers_counter] = " id=".Yii::app()->session['centers_array'][$num_of_centers_counter]['center_id'];
			$num_of_centers_counter--;
		}
		
		$sql_center = $sql11;
		$sql_center = $sql_center.implode(' or',$sql12);
		$pro = $connection->createCommand($sql_center)->query() or mysql_error();

		////////Centers permission end
		
            $res=array();
             $sql_vis  = "SELECT * FROM daily_visitors_report ";
			$result_vis = $connection->createCommand($sql_vis)->queryAll();
			$result=count ( $result_vis );
			


			$this->render('followup_lis',array('visitors'=>$result_visitors,'result'=>$result,'pro'=>$pro));

			}else{
				$this->redirect(array('user/dashboard'));
				}
	}
	public function actionSearchfollowup()
	 	{
			
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			
			
	$uid=Yii::app()->session['user_array']['id'];	
	$date=date('Y-m-d');	
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
$sql_memberas = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,interest_booking.com_res,visit_details.visit_date,visit_details.visit_type,visit_details.followup_status,dvr.reference,profession.profession,visit_details.visitors_id,visit_details.deal_by,visit_details.id as vdid,visit_details.next_visit,interest_booking.size2,size_cat.size      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
	 Left JOIN interest_booking  ON (dvr.id = interest_booking.visitors_id)
	Left JOIN visit_details  ON (dvr.id = visit_details.visitors_id)  
	 Left JOIN size_cat  ON (size_cat.id = interest_booking.size2)
 	  Where (visit_details.next_visit ='".$date."') And visit_details.deal_by='".$uid."' And visit_details.followup_status=1 GROUP BY vname "; 
 /*$sql_memberas = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,visit_details.followup_status,dvr.reference,dvr.date,profession.profession,visit_details.visitors_id,visit_details.deal_by,visit_details.next_visit      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
	Left JOIN visit_details  ON (dvr.id = visit_details.visitors_id)  
 	  Where (visit_details.next_visit <='".$date."') And visit_details.deal_by='".$uid."' And visit_details.followup_status=1  ";  */
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 
			/*echo  $sql_member = "SELECT vd.id as vdid,daily_visitors_report.contactno,daily_visitors_report.email,daily_visitors_report.name as vname,vd.visit_type,vd.visit_date,vd.deal_by,vd.	next_visit,vd.followup_status,vd.	remarks,profession.profession,interest_booking.com_res,interest_booking.id as ibid,interest_booking.size2,size_cat.size      FROM visit_details vd
			Left JOIN daily_visitors_report  ON (daily_visitors_report.id = vd.visitors_id)  
    Left JOIN profession  ON (daily_visitors_report.profession = profession.id)
	 Left JOIN interest_booking  ON (daily_visitors_report.id = interest_booking.visitors_id)
	  Left JOIN size_cat  ON (size_cat.id = interest_booking.size2)
 	  Where (vd.next_visit ='".$date."') And vd.deal_by='".$uid."' And vd.followup_status=1  ";*/

  echo  $sql_member = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,interest_booking.com_res,visit_details.visit_date,visit_details.visit_type,visit_details.followup_status,dvr.reference,profession.profession,visit_details.visitors_id,visit_details.deal_by,visit_details.id as vdid,visit_details.next_visit,interest_booking.size2,size_cat.size      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
	 Left JOIN interest_booking  ON (dvr.id = interest_booking.visitors_id)
	Left JOIN visit_details  ON (dvr.id = visit_details.visitors_id)  
	 Left JOIN size_cat  ON (size_cat.id = interest_booking.size2)
 	  Where (visit_details.next_visit ='".$date."') And visit_details.deal_by='".$uid."' And visit_details.followup_status=1 GROUP BY vname  ";
			//$result_vis = $connection->createCommand($sql_vis)->queryAll(); 
	  		$result_members = $connection->createCommand($sql_member)->query();
 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();
$i=0;


            foreach($result_members as $key){

			$i++;

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
			

			echo '<tr><td>'.$i.'</td>
			<td>'.$key['visit_date'].'</td><td>'.$key['vname'].'</td><td>'.$key['visit_type'].'</td><td>'.$key['contactno'].'</td><td>'.$key['email'].'</td><td><a href="add_follow_up?vdid='.$key['vdid'].'">Add Follow Up</a>
    </tr>';

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
	public function actionSum()
	 	{  
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			
				
	$uid=Yii::app()->session['user_array']['id'];	
		
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
$sql_user = "SELECT count(*) as total_records,  user.firstname,
   user.middelname,
   user.lastname,
   visit_details.visitors_id,
   visit_details.visit_type,
   visit_details.deal_by  class  FROM visit_details
   Left JOIN user  ON (visit_details.deal_by = user.id) 
	 GROUP BY user.id  ";  
      		
 
 $co = $connection->createCommand($sql_user)->queryAll();
		$rows =count($co);
		//for Pagination end 	
			$connection = Yii::app()->db; 
           $sql_visitor  = "SELECT sales_center.id,
   0 as visitors,
   0 as callers,
   sales_center.name,
   sales_center.image,
   0 as booking 
  FROM sales_center
	";  
      		$result_vis = $connection->createCommand($sql_visitor)->queryAll();
			$tnoofvisitors=0;
			$tnoofcallers=0;
			$tnoofbookings=0;
			$count=0;
	 $trec=0;
          $i=1;
if ($result_vis!=''){

            foreach($result_vis as $key){
				$noofvisits=0;
				$noofcalls=0;
				$noofbookings=0;

	 $sql_test  ="SELECT count(visit_details.visitors_id) as totalvistors
	 FROM visit_details 
			Left JOIN daily_visitors_report ON (visit_details.visitors_id = daily_visitors_report.id) 
			Left JOIN sales_center ON (daily_visitors_report.center_id = sales_center.id) 
			where visit_details.visit_type='visitor' and sales_center.id='".$key['id']."'   ";
$result_test = $connection->createCommand($sql_test)->queryAll();

			foreach($result_test as $visit1){
					$noofvisits=$visit1["totalvistors"];
			
					$tnoofvisitors=$noofvisits+$tnoofvisitors;
				
			}
			$sql_callers  ="SELECT count(visit_details.visitors_id) as totalcallers
	 FROM visit_details 
			Left JOIN daily_visitors_report ON (visit_details.visitors_id = daily_visitors_report.id) 
			Left JOIN sales_center ON (daily_visitors_report.center_id = sales_center.id) 
			where visit_details.visit_type='caller' and sales_center.id='".$key['id']."'   ";
$result_callers = $connection->createCommand($sql_callers)->queryAll();

			foreach($result_callers as $visit2){
					$noofcalls=$visit2["totalcallers"];
			
					$tnoofcallers=$noofcalls+$tnoofcallers;
				
			}
				 $sql_bookings  ="SELECT count(interest_booking.id) as tbooking  FROM interest_booking
				Left JOIN daily_visitors_report ON (interest_booking.visitors_id = daily_visitors_report.id) 
			Left JOIN sales_center ON (daily_visitors_report.center_id = sales_center.id)
          where interest_booking.type='Booking' and sales_center.id='".$key['id']."'   ";
$result_booking = $connection->createCommand($sql_bookings)->queryAll();
			 $sql_bookings;

			foreach($result_booking as $book){
					$noofbooking=$book["tbooking"];
			
					$tnoofbookings=$noofbooking+$tnoofbookings;
				
			}
			
echo '<tr><td>'.$i.'</td><td><img width="70"  src="/images/centers/'.$key['image'].'"></td><td style=text-align:left;>'.$key['name'].'</td><td >'.$noofvisits.'</td><td>'.$noofcalls.'</td><td>'.$noofbooking.'</td><td><a href="center_lis?center_id='.$key['id'].'">Detail</a></td>';
		
		
		
					'</tr>';
			$i++;	 
				
			} 
 echo '<tr style="background-color:#0CF";  ><td  colspan="2" ><b >Total</b></td><td></td><td><b>'.$tnoofvisitors.'</b></td><td><b>'.$tnoofcallers.'</td>
 <td><b>'.$tnoofbookings.'</b>&nbsp;
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">View Detail</button>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <b>Size Wise Booking Detail</b><br>
	  <table class="table" border="1">
	  <tr><td> <b>Size</b></td><td> <b>No Of Plots</b></td></tr>
	
	  '; 
	    $sql_size  = "SELECT size,id FROM size_cat";  
      		$result_siz = $connection->createCommand($sql_size)->queryAll();
			 foreach($result_siz as $size){
		$connection = Yii::app()->db; 
		 $j=0;
			$sql_sizebooking  ="SELECT count(interest_booking.id) as tbooking,size_cat.size  FROM interest_booking
			Left JOIN size_cat ON (size_cat.id = interest_booking.size2)
          where size2='".$size['id']."' ";   
            $sizeresbook = $connection->createCommand($sql_sizebooking)->queryAll();
//			echo $sql_sizebooking; exit();

	 
	 foreach($sizeresbook as $sizebook){
		
		    $tr=$sizebook["tbooking"];
			$trec=$tr+$trec;
	  
 echo'<tr><td> <b>'.$size['size'].'</b></td><td> <b>'.$sizebook['tbooking'].'</b></td></tr>
  
	 
 ';}
	  }
  echo '
   <tr><td><b>Total</b></td><td><b>'.$trec.'</b></td></tr>';
 echo' </table>
	  
	  
	  
    </div>
  </div>
</div>
</td><td></td></tr>';
  echo '<tr  ><td  colspan="7" ><span style="float:right;"><button type="button" class="btn btn-default">Print Report</button></span></tr>';
 exit; }
	// for pagination END 
	exit;
echo'

';
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
public function actionSummary()
	{	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
				
	   	$connection = Yii::app()->db; 
    $sql_visitors = "SELECT * FROM daily_visitors_report";

		$result_visitors = $connection->createCommand($sql_visitors)->query();
      
		
		
           

			$this->render('summary',array('visitors'=>$result_visitors));

			}else{
				$this->redirect(array('user/dashboard'));
				}
	}
public function actionVisitors_lis()
	{	
if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
			$uid=Yii::app()->session['user_array']['id'];	
	$date=date('Y-m-d');		
	   	$connection = Yii::app()->db; 
    $sql_visitors = "SELECT * FROM daily_visitors_report";

		$result_visitors = $connection->createCommand($sql_visitors)->query();
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
		    $home=Yii::app()->request->baseUrl; 
		//centers permission start
		 $connection = Yii::app()->db; 
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$sql3 =   "select * from sales_center where";
		$num_of_centers_counter--;
		while($num_of_centers_counter>-1)
		{

			$sql4[$num_of_centers_counter] = " id=".Yii::app()->session['centers_array'][$num_of_centers_counter]['center_id'];

			$num_of_centers_counter--;

		}
     	$sql_center = $sql3;
		$sql_center = $sql_center.implode(' or',$sql4);
			$result_centers = $connection->createCommand($sql_center)->queryAll() or mysql_error();
		    $home=Yii::app()->request->baseUrl; 
		////////centers permission end
            $res=array();
            $sql_vis  = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,interest_booking.com_res,visit_details.visit_date,visit_details.visit_type,visit_details.followup_status,dvr.reference,profession.profession,visit_details.visitors_id,visit_details.deal_by,visit_details.id as vdid,visit_details.next_visit,interest_booking.size2,size_cat.size      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
	 Left JOIN interest_booking  ON (dvr.id = interest_booking.visitors_id)
	Left JOIN visit_details  ON (dvr.id = visit_details.visitors_id)  
	 Left JOIN size_cat  ON (size_cat.id = interest_booking.size2)
 	  Where (visit_details.next_visit ='".$date."') And visit_details.deal_by='".$uid."' And visit_details.followup_status=1 GROUP BY vname ";
			$result_vis = $connection->createCommand($sql_vis)->queryAll();
			 $result=count ( $result_vis );


			$this->render('visitors_lis',array('visitors'=>$result_visitors,'result'=>$result));

			}else{
				$this->redirect(array('user/dashboard'));
				}
	}


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
	public function actionAjaxRequest6($val1)

	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from plots where plot_detail_address='".$val1."'";

		$result_city = $connection->createCommand($sql_city)->query();

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

	echo json_encode($city); exit();

	}

	public function actionAjaxRequest7($val1, $val2)

	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from plots where project_id='".$val2."' AND plot_detail_address='".$val1."' ";

		$result_city = $connection->createCommand($sql_city)->query();

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

	echo json_encode($city); exit();

	}

	public function actionAjaxRequest($val1)

	{



			$connection = Yii::app()->db;  



		$sql_street  = "SELECT * from sectors where project_id='".$val1."'";



		$result_streets = $connection->createCommand($sql_street)->query();



			



		$street=array();



		foreach($result_streets as $str){



			$street[]=$str;



			} 



		



	echo json_encode($street); exit();



	}

public function actionAjaxRequest2($pro,$sec)
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

	public function actionVisitors1()

	{
		if(Yii::app()->session['user_array']['per4']=='1')
			{
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

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			
			$sql_center  = "SELECT * from sales_center";
		    $center = $connection->createCommand($sql_center)->query();
            
			$sql_profession  = "SELECT * from profession";
		    $profession = $connection->createCommand($sql_profession)->query();
			
			$this->render('visitors1',array('projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'center'=>$center,'profession'=>$profession));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionVisitors()

	{
		if(Yii::app()->session['user_array']['per4']=='1')
			{
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

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			
			 //Centers permission start
		 $connection = Yii::app()->db; 
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$sql11 =   "select * from sales_center where";
		$num_of_centers_counter--;
		while($num_of_centers_counter>-1)
		{
			$sql12[$num_of_centers_counter] = " id=".Yii::app()->session['centers_array'][$num_of_centers_counter]['center_id'];
			$num_of_centers_counter--;
		}
		
		$sql_center = $sql11;
		$sql_center = $sql_center.implode(' or',$sql12);
		$center = $connection->createCommand($sql_center)->query() or mysql_error();

		////////Centers permission end
            
			$sql_profession  = "SELECT * from profession";
		    $profession = $connection->createCommand($sql_profession)->query();
			
			$this->render('visitors',array('projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'center'=>$center,'profession'=>$profession));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
		public function actionUpdatevisitors()

	{
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			$connection = Yii::app()->db;  
               $sql_visitors = "SELECT dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.reg_date,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.id as pid,profession.profession      FROM daily_visitors_report dvr
    Left JOIN profession  ON (dvr.profession_id = profession.id)
 	 Where dvr.id='".$_REQUEST['id']."'"; 
			$result_visitors = $connection->createCommand($sql_visitors)->query();
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

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			
			$sql_center  = "SELECT * from sales_center";
		    $center = $connection->createCommand($sql_center)->query();
            
			$sql_profession  = "SELECT * from profession";
		    $profession = $connection->createCommand($sql_profession)->queryAll();
			$connection = Yii::app()->db;
			
			$this->render('updatevisitors',array('visitors'=>$result_visitors,'projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'center'=>$center,'profession'=>$profession));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionVisitdetail()

	{
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			$connection = Yii::app()->db;  
              $sql  = 'INSERT INTO daily_visitors_report 
(name,email, profession_id, city,contactno,refered_by,reference,reg_date,center_id )
               	    	  VALUES ( "'.$_POST['name'].'", "'.$_POST['email'].'", "'.$_POST['profession'].'", "'.$_POST['city'].'",  "'.$_POST['contactno'].'" ,"'.$_POST['refered_by'].'"
,"'.$_POST['reference'].'","'.date('d-m-Y').'","'.$_POST['center'].'")';	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $last_insert_id = Yii::app()->db->getLastInsertID();
			   
			   $sql_visitors = "SELECT  dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.profession,profession.id as pid     FROM daily_visitors_report dvr
	 Left JOIN profession  ON (dvr.profession_id = profession.id)
              where dvr.id='".$last_insert_id."'"; 
			$result_visitors = $connection->createCommand($sql_visitors)->query();
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

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			
			$sql_center  = "SELECT * from sales_center";
		    $center = $connection->createCommand($sql_center)->query();
            
			$sql_profession  = "SELECT * from profession";
		    $profession = $connection->createCommand($sql_profession)->query();
			$connection = Yii::app()->db;
			
			$this->render('visitdetail',array('visitors'=>$result_visitors,'projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'center'=>$center,'profession'=>$profession));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
		public function actionDirectbooking()

	{
		if(Yii::app()->session['user_array']['per12']=='1')
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
           $connection = Yii::app()->db;  
        
			   //Centers permission start
		 $connection = Yii::app()->db; 
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$temp_centers_array = Yii::app()->session['centers_array'];
		$num_of_centers_counter = count($temp_centers_array);	
		$num_of_centers_counter2 = $num_of_centers_counter;
		$sql11 =   "select * from sales_center where";
		$num_of_centers_counter--;
		while($num_of_centers_counter>-1)
		{
			$sql12[$num_of_centers_counter] = " id=".Yii::app()->session['centers_array'][$num_of_centers_counter]['center_id'];
			$num_of_centers_counter--;
		}
		
		$sql_center = $sql11;
		$sql_center = $sql_center.implode(' or',$sql12);
		$center = $connection->createCommand($sql_center)->query() or mysql_error();

		////////Centers permission end
		     $sql_size  = "SELECT * from size_cat";

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			
		
            
			$sql_profession  = "SELECT * from profession";
		    $profession = $connection->createCommand($sql_profession)->query();
			$connection = Yii::app()->db;
			
			$this->render('directbooking',array('projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'center'=>$center,'profession'=>$profession));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
		public function actionVisitdetailsec()

	{
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			$connection = Yii::app()->db;  
            
			   
			   $sql_visitors = "SELECT  dvr.id as vid,dvr.contactno,dvr.name as vname,dvr.email,dvr.profession_id,dvr.city,dvr.refered_by,dvr.reference,profession.profession,profession.id as pid     FROM daily_visitors_report dvr
	 Left JOIN profession  ON (dvr.profession_id = profession.id)
              where dvr.id='".$_GET['id']."'"; 
			$result_visitors = $connection->createCommand($sql_visitors)->query();
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

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			
			$sql_center  = "SELECT * from sales_center";
		    $center = $connection->createCommand($sql_center)->query();
            
			$sql_profession  = "SELECT * from profession";
		    $profession = $connection->createCommand($sql_profession)->query();
			$connection = Yii::app()->db;
			
			$this->render('visitdetailsec',array('visitors'=>$result_visitors,'projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'center'=>$center,'profession'=>$profession));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionAdd_follow()
	{      $connection = Yii::app()->db;  
		if(Yii::app()->session['user_array']['per12']=='1')
			{
				$error='';
		
			if(isset($_POST['followup_status']) && empty($_POST['followup_status']))
		{
				$error = 'Please Select FollowUp Status<br>';
	     }
		if($_POST['followup_status']=='1' )
		{
			if(isset($_POST['next_visit']) && empty($_POST['next_visit']))
			{
				$error = 'Please Enter Next Visit Date<br>';
			}
		}	
			
			
		        if(empty($error))
			{
			 $sql="UPDATE visit_details set visit_date='".date('Y-m-d')."',followup_status='".$_POST['followup_status']."',next_visit='".$_POST['next_visit']."' where id='".$_POST['id']."' "; 
  $command = $connection -> createCommand($sql);
               $command -> execute();
			 echo "Record Updated Successfully";
		} 
			if(!empty($error)){
			echo $error;
			}

			   



			}else{

				

				

				 

				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

				

				}





	}
		public function actionAdd_follow_up()

	{
		if(Yii::app()->session['user_array']['per12']=='1')
			{
			$connection = Yii::app()->db;  
            
			   /* $sql_visitors = "SELECT vd.id as vdid,daily_visitors_report.contactno,daily_visitors_report.email,daily_visitors_report.reference,daily_visitors_report.city,daily_visitors_report.refered_by ,daily_visitors_report.name as vname,vd.visit_type,vd.visit_date,vd.deal_by,vd.	next_visit,vd.followup_status,vd.	remarks,profession.profession,interest_booking.com_res,interest_booking.type,interest_booking.id as ibid,interest_booking.size2,size_cat.size      FROM visit_details vd
			Left JOIN daily_visitors_report  ON (daily_visitors_report.id = vd.visitors_id)  
    Left JOIN profession  ON (daily_visitors_report.profession = profession.id)
	 Left JOIN interest_booking  ON (daily_visitors_report.id = interest_booking.visitors_id)
	  Left JOIN size_cat  ON (size_cat.id = interest_booking.size2)
 	  Where  interest_booking.id='".$_GET['vdid']."'"; */ 
			  $sql_visitors = "SELECT visit_details.id as vdid,
							visit_details. next_visit,
							visit_details.followup_status,
							visit_details. remarks,
							visit_details.visit_type,
							visit_details.visitors_id,
							visit_details.visit_date,
							visit_details.deal_by,
							daily_visitors_report.contactno,
							daily_visitors_report.email,
							daily_visitors_report.name as vname,
							daily_visitors_report.reference,
							daily_visitors_report.city,
							daily_visitors_report.refered_by ,
							profession.profession
							
							FROM visit_details 
							Left JOIN daily_visitors_report ON (daily_visitors_report.id = visit_details.visitors_id)
							Left JOIN profession ON (daily_visitors_report.profession_id = profession.id)
							
							where visit_details.id='".$_GET['vdid']."'"; 
			$result_visitors = $connection->createCommand($sql_visitors)->query();
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

		    $result_size = $connection->createCommand($sql_size)->query();

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();
			
			$sql_center  = "SELECT * from sales_center";
		    $center = $connection->createCommand($sql_center)->query();
            
			$sql_profession  = "SELECT * from profession";
		    $profession = $connection->createCommand($sql_profession)->query();
			$connection = Yii::app()->db;
			
			$this->render('add_follow_up',array('visitors'=>$result_visitors,'projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'center'=>$center,'profession'=>$profession));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionUpdate()
	{      $connection = Yii::app()->db;  
		if(Yii::app()->session['user_array']['per12']=='1')
			{
				$error='';
		
			if(isset($_POST['name']) && empty($_POST['name']))
		{
				$error = 'Please Enter Name<br>';
			}
			if(isset($_POST['email']) && empty($_POST['email']))
			{
				$error .= 'Please Enter Email<br>';
			}
          

			if(isset($_POST['profession']) && empty($_POST['profession']))
			{

				$error .= 'Please Enter Profession<br>';
			}
			
				if(isset($_POST['contactno']) && empty($_POST['contactno']))
			{
				$error .= 'Please Select Contact No.<br>';
			}
				if(isset($_POST['city']) && empty($_POST['city']))
			{
				$error .= 'Please Enter City<br>';
			}
				if(isset($_POST['refered_by']) && empty($_POST['refered_by']))
			{
				$error .= 'Please Enter Refered By<br>';
			}
			
			
			
				if(isset($_POST['date']) && empty($_POST['date']))

			{
				$error .= 'Please Enter Date<br>';
			}
			
				if(isset($_POST['reference']) && empty($_POST['reference']))

			{
				$error .= 'Please Enter Reference<br>';
			}
			
		        if(empty($error))
			{
			 $sql="UPDATE daily_visitors_report set name='".$_POST['name']."',profession_id='".$_POST['profession']."',email='".$_POST['email']."',contactno='".$_POST['contactno']."',reg_date='".$_POST['reg_date']."',city='".$_POST['city']."',refered_by='".$_POST['refered_by']."',reference='".$_POST['reference']."' where id='".$_POST['id']."' "; 
  $command = $connection -> createCommand($sql);
               $command -> execute();
			 echo "Record Updated Successfully";
		} 
			if(!empty($error)){
			echo $error;
			}

			   



			}else{

				

				

				 

				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

				

				}





	}
public function actionDeletevisitor()
	{      $connection = Yii::app()->db;  
		if(Yii::app()->session['user_array']['per12']=='1')
			{
				
		     
			  $sql="DELETE FROM daily_visitors_report where id='".$_GET['id']."' "; 
           $command = $connection -> createCommand($sql);
               $command -> execute();
			$this->redirect(Yii::app()->baseUrl."/index.php/visitors/visitors_lis");
			}else{
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


	protected function performAjaxValidation($model)
	{



		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')



		{



			echo CActiveForm::validate($model);



			Yii::app()->end();



		}



	}


}




