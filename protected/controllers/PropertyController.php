<?php
class PropertyController extends Controller
{
//////////////////////START:RECEIPT MODULE//////////////////////////////
public function actionReciept()
	{
			$layout='//layouts/column1';
			$this->render('reciept');
	}
///////////////////////END RECEIPT MODULE/////////////////////////////
	
	
	
   /////////////////////START: Buildings and Floors//////////////////
  
  /////////////////////START: Add office/shops in building//////////
  
  public function actionProperty()
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
		 $sql_building = "SELECT * from buildings";
	     $result_building = $connection->createCommand($sql_building)->query();
		     $sql_size  = "SELECT * from size_cat where typee='P'";
		    $result_size = $connection->createCommand($sql_size)->query();
			$sql_ptype  = "SELECT * from ptype";
		    $result_ptype = $connection->createCommand($sql_ptype)->query();
			$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
			$this->render('property',array('projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'buildings'=>$result_building,'ptype'=>$result_ptype));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionCreate()
	{  ///echo $_POST['floor_id'];exit;
	      $connection = Yii::app()->db;  
	         $error ='';
			if(isset($_POST['project_id']) && empty($_POST['project_id']))
			{
         	$error = 'Please Select Plot Project<br>';
			}
			if(isset($_POST['building_id']) && empty($_POST['building_id']))
			{
         	$error .= 'Please Select Building<br>';
			}
			if(isset($_POST['floor_id']) && empty($_POST['floor_id']))
			{
         	$error .= 'Please Select Floor<br>';
			}
			if(isset($_POST['price']) && empty($_POST['price']))
			{
			$error = 'Please Enter Plot Price<br>';
			}

             if(isset($_POST['size2']) && empty($_POST['size2']))
			{
				$error .= 'Please Enter Plot Size<br>';

			}
			if(isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address']))
			{
				$error .= 'Please Enter Plot No<br>';
			}
			if(isset($_POST['type']) && empty($_POST['type']))
			{
				$error.= 'Please Select Type<br>';

			}

				
			

				if(isset($_POST['plot_size']) && empty($_POST['plot_size']))
			{

				$error .= 'Please Enter Plot Diemension<br>';
			}
					$sq  = "SELECT * from plots where project_id='".$_POST['project_id']."'  AND floor_id='".$_POST['floor_id']."'
					 AND plot_detail_address='".$_POST['plot_detail_address']."'";
					$result_sq = $connection->createCommand($sq)->queryAll();
					$count=0;
					$re=array();
					foreach($result_sq as $key1){$count=$count+1;}
					if($count!=0)
					{ $error="Property Already Added On This Address Please Enter Another Plot Address  ";}
			
		    
			
			  if(empty($error))
			{
				 $sql  = 'INSERT INTO plots
		(type,project_id,floor_id, plot_detail_address, plot_size, size2,price,create_date,is_property)
				VALUES ( "'.$_POST['type'].'","'.$_POST['project_id'].'", "'.$_POST['floor_id'].'", "'.$_POST['plot_detail_address'].'", "'.$_POST['plot_size'].'", "'.$_POST['size2'].'",
				 "'.$_POST['price'].'", "'.date('Y-m-d').'" ,1)';
			
         
                $command = $connection -> createCommand($sql);
			    $command -> execute();
			    $last_insert_id = Yii::app()->db->getLastInsertID();
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
							$add_project_per_query = "insert into cat_plot
														set plot_id='".$last_insert_id."',cat_id='".$cat_id."' ";
							$command = $connection -> createCommand($add_project_per_query);
							$command -> execute();
						}
					$num_of_category--;
				}
	
	          	echo $note="New Record Inserted Successfully";
				//echo '<a target="_blank" href="upload_image?id='.$last_insert_id.'"><input type="button" class="btn-info" value="Add Image">';
	}
	else{
	echo $error;
		}
		}

	public function actionPro_installment_details()
	{if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM proinstallpayment where plot_id='".$_REQUEST['id']."' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
		   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM property mp
	   left join members m on mp.member_id=m.id
	    where mp.id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "
		SELECT
       plots.id
     , plots.street_id
     , plots.plot_size
     , plots.project_id
     , plots.com_res
	 , plots.size2
	 , plots.remarks
	 , property.id as propid
	 , property.ptype
	 , property.pname
	 , property.ptype
	 , property.pdetails
	 , property.carea
	 , property.pstatus
     , property.plotno
	 , property.price
	 , property.create_date
	 , property.plot_detail_address
     , projects.project_name
	 , streets.street
	 , size_cat_prop.size
	 , size_cat_prop.dimension
	 , property.status
	 , sector_name
	 , buildings.name as buildname
	 , floors.name as fname
	 , ptype.project_name as prop_type
FROM
   property
    Left JOIN plots  ON (property.plot_id = plots.id)
	Left JOIN buildings  ON (buildings.plot_id = plots.id)
	Left JOIN floors  ON (property.floor_id = floors.id)
	Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN ptype  ON (property.ptype = ptype.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN size_cat_prop  ON (size_cat_prop.id = property.size2) where property.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
		

		$this->render('pro_installment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionProp_payment_details()
	{
if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;
     $land  = "SELECT * FROM proinstallpayment where plot_id='".$_REQUEST['id']."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		
		   $member= "SELECT * FROM property where id='".$_REQUEST['id']."'";
		$members = $connection->createCommand($member)->queryRow();
			

		 $sql_payment  = "SELECT * FROM propertypayment where plot_id='".$_REQUEST['id']."' and (mem_id='".$members['member_id']."' or payment_type NOT IN ('MS Fee','Transfer Fee'))";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

		

	   $sql_member= "SELECT buildings.name as buildname,floors.name as fname,mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM property mp
	   left join members m on mp.member_id=m.id
	   Left JOIN plots  ON (mp.plot_id = plots.id)
	   Left JOIN buildings  ON (buildings.plot_id = plots.id)
       Left JOIN floors  ON (mp.floor_id = floors.id)
	   Left JOIN ptype  ON (mp.ptype = ptype.id)
	  
	    where mp.id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		

		

		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='".$_REQUEST['id']."'";

		$res=$connection->createCommand($sql)->queryAll();

		

		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";

		//$result_charges = $connection->createCommand($sql_charges)->queryAll();

		

		$sql_plotinfo  = "SELECT
       plots.id
     , plots.street_id
     , plots.plot_size
     , plots.project_id
     , plots.com_res
	 , plots.size2
	 , property.id as propid
	 , property.ptype
	 , property.pname
	 , property.ptype
	 , property.pdetails
	 , property.carea
	 , property.pstatus
     , property.plotno
	 , property.price
	 , property.create_date
	 , property.plot_detail_address
     , projects.project_name
	 , streets.street
	 , size_cat_prop.size
	 , size_cat_prop.dimension
	 , property.status
	 , sector_name
	 , buildings.name as buildname
	 , floors.name as fname
	 , ptype.project_name as prop_type
FROM
   property
    Left JOIN plots  ON (property.plot_id = plots.id)
	Left JOIN buildings  ON (buildings.plot_id = plots.id)
	Left JOIN floors  ON (property.floor_id = floors.id)
	Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN ptype  ON (property.ptype = ptype.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN size_cat_prop  ON (size_cat_prop.id = property.size2) where property.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
		$connection = Yii::app()->db;
		$sql_primeloc  = "SELECT *  FROM cat_plot
		LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
		WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
		$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
$this->render('prop_payment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));
		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
  //////////////////////////////////////////////////////////////////

  		 public function actionAjaxRequest9($val1,$building_id)
		{
		$connection = Yii::app()->db;  
	      $sql_plot="SELECT projects.id , floors.id , floors.name ,floors.no_of_shops ,floors.building_id ,buildings.plot_id,buildings.name as buildname,buildings.status , floors.project_id , projects.project_name FROM floors Left JOIN projects ON (floors.project_id = projects.id) 
		Left JOIN buildings ON (floors.building_id = buildings.id) 
		where buildings.status LIKE '%1%' and floors.project_id='".$val1."' and building_id='".$building_id."'";
		
    	$result_plots = $connection->createCommand($sql_plot)->query();
		$plot=array();
		foreach($result_plots as $plo){
			$plot[]=$plo;
			} 
    	echo json_encode($plot); exit();
		}
  		 public function actionAjaxRequest8($val1)
		{
			

		$connection = Yii::app()->db;  
	$sql_plot  = "SELECT projects.*,buildings.* from buildings 
		
		left join projects on (projects.id=buildings.project_id)
		where buildings.status=1 and buildings.project_id='".$val1."' ";
	
	$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
			 public function actionAjaxRequest4($val1)
		{
			

		$connection = Yii::app()->db;  
	$sql_plot  = "SELECT projects.*,buildings.* from buildings 
		
		left join projects on (projects.id=buildings.project_id)
		where buildings.project_id='".$val1."' ";
	
	$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
		public function actionAjaxRequest0000($val1)
		{
			

		$connection = Yii::app()->db;  
	$sql_plot  = "SELECT projects.*,buildings.* from buildings 
		
		left join projects on (projects.id=buildings.project_id)
		where buildings.project_id='".$val1."' and buildings.status=''";
	
	$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
  		public function actionAssignbuilding()
	     {
		 $connection = Yii::app()->db;
				 $error =array();
     			
				$status=$_REQUEST['status'];
				$bid=$_REQUEST['building_id'];
			
			  $sql_update = "UPDATE buildings SET status ='$status' WHERE id =$bid";
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			 $this->redirect(array('property/buildings_list'));
	   }
		public function actionBuilding_detail()
		
    	{	
				  $connection = Yii::app()->db; 
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
		$this->layout='//layouts/back';
       	$and = false;
			$where='';
	if (!empty($_POST['building_id'])){				
				if ($and==false)
				{
					$where.="where floors.building_id LIKE '%".$_POST['building_id']."%'";
				}
				else
				{
					$where.="where floors.building_id LIKE '%".$_POST['building_id']."%'";
				}
				
			}
			if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="and floors.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="and floors.project_id LIKE '%".$_POST['project_id']."%'";
				}
				
			}
	
	//$sql = "SELECT * FROM streets";
  $sql="SELECT buildings.name AS buildname,buildings.status,buildings.building_image, projects.project_name FROM buildings LEFT JOIN projects ON( buildings.project_id = projects.id ) where buildings.id='".$_GET['id']."'"; 
	$result = $connection->createCommand($sql)->query();
	$sqlfloor="SELECT
    projects.id
    , floors.id
	, floors.name
	,floors.no_of_shops
	,floors.building_id
	,buildings.name as buildname
	, floors.project_id
    , projects.project_name
FROM
    floors
	Left JOIN projects  ON (floors.project_id = projects.id) 
	Left JOIN buildings  ON (floors.building_id = buildings.id) where buildings.id='".$_GET['id']."'"; 
	$resultfloor = $connection->createCommand($sqlfloor)->query();
	 $sql_plots = "SELECT
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
	, plots.bstatus
	, plots.plot_detail_address
    , projects.project_name
	, streets.street
	, size_cat.size
	, size_cat.typee
	,sector_name
FROM
   plots
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN buildings  ON (plots.id = buildings.plot_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where buildings.plot_id='".$_GET['plot_id']."'"; 
	$result_plots = $connection->createCommand($sql_plots)->query();
	
	
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	$this->render('building_detail',array('buildings'=>$result,'floors'=>$resultfloor,'plots'=>$result_plots,'projects'=>$result_project));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	
		}
		public function actionAssigned_property_list()
		
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

			 $sql_com_res ="SELECT DISTINCT com_res FROM plots";
		$result_com_res = $connection->createCommand($sql_com_res)->query();



		

	$connection = Yii::app()->db; 

	 $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where p.type='plot' and mp.status='Approved' "; 
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

			$this->render('assigned_property_list',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects,'com_res'=>$result_com_res));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
		public function actionSearchAP()
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
			if (!empty($_POST['allotmentstatus'])){
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
if($_POST['allotmentstatus']==3){if ($and==true)
				{
					$where.=" and p.status='Requested(T)'";
				}
				else
				{
					$where.=" p.status='Requested(T)'";
				}
				
				}
				if($_POST['allotmentstatus']==4){if ($and==true)
				{
					$where.=" and mp.mstatus=2";
				}
				else
				{
					$where.=" mp.mstatus=0";
				}
				
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
			/*if (!empty($_POST['plotno'])){
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
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
			}*/				
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
 $sql_memberas = "SELECT * FROM propertyc pc
left join plots p on pc.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where  $where";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
      $sql_member = "SELECT
  p.com_res,
  p.id,
  p.type,
  p.project_id,
  p.plot_detail_address,
  pc.plot_id,
  pc.status,
  p.plot_size,
  p.project_id,
  p.street_id,
  p.status AS pstatus,
  s.street,
  s.id,
  j.id,
  j.project_name,
  mp.app_no
  ,sec.sector_name,
  size_cat.size
	FROM
	  propertyc pc	
	LEFT JOIN
	  plots p ON pc.plot_id = p.id
	  LEFT JOIN
	  buildings b ON b.plot_id = p.id
	LEFT JOIN
	  memberplot mp ON mp.plot_id = p.id
	LEFT JOIN
	  sectors sec ON sec.id = p.sector
	LEFT JOIN
	  size_cat size_cat ON size_cat.id = p.size2
	LEFT JOIN
	  streets s ON p.street_id = s.id
	LEFT JOIN
	  projects j ON p.project_id = j.id
	WHERE
	 $where limit $start,$limit"; 
			$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();
            foreach($result_members as $key){
            $count++;
			echo $count.' result found';
			  $msco='';
			  
			 echo '<tr><td>';if(empty($key['plotno'])){ echo 'App-'. $key['app_no'];}else { echo $key['plotno'];} echo'</td><td></td><td></td><td></td><td></td>
			 <td>';echo $key['size'].'&nbsp;('.$key['plot_size'].')';echo'</td>
			 <td><strong>';
				  echo '<a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'];echo'</strong></a>
				  <td>';echo $key['street']; echo '</td>
				  <td>';echo $key['sector_name'];echo'</td>
				  <td>'.$key['project_name'].'</td><td>
			  <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a></li>';
				if(Yii::app()->session['user_array']['per32']=='1')
			{		//echo'<li role="presentation"><a href="'.Yii::app()->baseUrl.'/index.php/member/ms_status?msid='.$key['msid'].'&& plot_id='.$key['plot_id'].'">Update Status</a></li>';
			}
			
			echo'<li role="presentation"><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li role="presentation"><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a></li>
			<li role="presentation"><a target="_blank" href="reallocate?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Reallocation</a></li>
'; 

$sqltest = "SELECT * FROM  plots where id='".$key['plot_id']."'  "; 
	
		$resulttest = $connection->createCommand($sqltest)->query();
	
	echo'
	<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to cancel?");
      if (x)
          return true;
      else
        return false;
    }
</script>    
	
	';
            foreach($resulttest as $test){
 	
	 
			if($test['status']=='Requested(T)'){ echo '<li role="presentation"><a  href="'.$home.'/index.php/memberplot/treq_detail?id='.$key['plot_id'].'">Transfer Details</a></li>';}
			if($test['status']!='Requested(T)' && $key['status']=='Approved') {echo '<li role="presentation"><a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer Plot</a></li>';}
			
			
			}
  echo'

<li role="presentation"><a href="amembers">Associates Member</a></li>
<li role="presentation"><a href="updatemember_plot?id='.$key['plot_id'].'">Update Membership</a></li>
  </ul></div>
  </td>';
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
	
		
		public function actionAssignnewproperty()
		{
			 
			if(Yii::app()->session['user_array']['per4']=='1')
			{   
					$error='';
                                ///  echo 	$sqlplots= "UPDATE plots SET status='Requested' and hrl_reserved='1' where id='".$_POST['plot_id']."'";	exit;
									$connection = Yii::app()->db;  
									
									if ((isset($_POST['plot_id']) && empty($_POST['plot_id']))){
									 $error.="Please Select Plot. <br>";}								  
								  	
									if ((isset($_POST['project']) && empty($_POST['project']))){
									 $error.="Please Select Project. <br>";
									 }
									 if ((isset($_POST['sector']) && empty($_POST['sector']))){
									 $error.="Please Select Sector. <br>";
									 }
									 if ((isset($_POST['street_id']) && empty($_POST['street_id']))){
									 $error.="Please Select Street. <br>";
									 }
									 if ((isset($_POST['size_id']) && empty($_POST['size_id']))){
									 $error.="Please Select Size. <br>";
									 }
									 if ((isset($_POST['plot_id']) && empty($_POST['plot_id']))){
									 $error.="Please Select Plot No. <br>";
									 }
									 if ((isset($_POST['buildings']) && empty($_POST['buildings']))){
									 $error.="Please Select Building. <br>";
									 }
									
								
								 	
									/* if(!empty($pn)){
									echo $q ="SELECT * from property where plot_id='".$_POST['plot_id']."' and pno='".$pno."' "; exit;
									  $result_q = $connection->createCommand($q)->queryRow();
									if(!empty($result_q)){
									 $error .="Property # Already Added Try Another. <br>";
									}} */
										 if(empty($error)){
					
						$sqlplots ="SELECT * from plots where id='".$_POST['plot_id']."'"; 
						$resplots = $connection->createCommand($sqlplots)->query();
						$uid=Yii::app()->session['user_array']['id']; 
						
						 $sqlplots= "UPDATE plots set is_building='1' where id='".$_POST['plot_id']."'";	
				   		$command = $connection -> createCommand($sqlplots);
                        $command -> execute();
						$sqlbuildings= "UPDATE buildings SET status='2',plot_id='".$_POST['plot_id']."' where id='".$_POST['buildings']."'";	
				   		$command = $connection -> createCommand($sqlbuildings);
                        $command -> execute();
						
						echo 'Property Assigned Successfully';
						exit;
							 }
						else if(!empty($error)){ 
 						echo $error;

             } 
			
			}
		}
		
	public function actionAssignproperty()
		{
				

	 if(Yii::app()->session['user_array']['per2']=='1')

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

		$sql_plan  = "SELECT ip.*,p.project_name from installment_planp ip
		left join projects p on ip.project_id=p.id
		
		 ";
		$result_plan = $connection->createCommand($sql_plan)->query();
	
		$sql_buildings = "SELECT * from 	buildings where status=''";
		$result_buildings= $connection->createCommand($sql_buildings)->query();

		$this->render('assignproperty',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan, 'buildings'=>$result_buildings));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
     public function actionBuildings()
	{
		
		if((Yii::app()->session['user_array']['per3']=='1')&& isset(Yii::app()->session['user_array']['username']))

		{
		
			$connection = Yii::app()->db; 
			$sql_projects = "SELECT * FROM projects";
			$result_projects = $connection->createCommand($sql_projects)->query();
			$sql_ptype = "SELECT * FROM ptype";
			$result_ptype = $connection->createCommand($sql_ptype)->queryAll();
			
			$sql_buildings = "SELECT projects.*,buildings.* FROM buildings
			left join projects  on (buildings.project_id=projects.id)";
			$result_buildings = $connection->createCommand($sql_buildings)->query();
			$this->render('buildings',array('projects'=>$result_projects,'buildings'=>$result_buildings,'ptype'=>$result_ptype));
			}
			else{
				$this->redirect(array('user/user'));
			}

		
	}
	 
	 public function actionAddbuilding()
	 	 {
			if(Yii::app()->session['user_array']['per3']=='1')
			{   
			$error='';
			// $error =array();
			$connection = Yii::app()->db;
			if(empty($_POST['project'])){ 
					$error .="Please Select Project Name.".'<br/>'; 
			}
			if(empty($_POST['name'])){ 
					$error .="Please Enter Building Name.<br/>"; 
			}
		
			
			 $name="SELECT * FROM buildings where name='".$_POST['name']."' AND project_id='".$_POST['project']."' ";
			     $resultname=$connection->createCommand($name)->queryRow();
			  	  if(!empty($resultname))
				  {
					 $error ="This Building Already exists";
				  }	
            if(empty($error))
			  {	
			    
			 $sql  = "INSERT INTO buildings (name,project_id) VALUES ('".$_POST['name']."','".$_POST['project']."')";	
			$command = $connection -> createCommand($sql);
            $command -> execute();
            echo 'Building Added Successfully';
                    exit;
				}
				else{
					echo $error;
					}
		}
	    }
	public function actionUpdate_buildings()
		 {
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
     $connection = Yii::app()->db; 
	 $sql = "SELECT buildings.*,projects.project_name,projects.id as project_id FROM buildings
	Left JOIN projects  ON (buildings.project_id = projects.id) 
	 where buildings.id=".$_GET['id'];
	$result = $connection->createCommand($sql)->query();
	$sqlprojects="SELECT * FROM projects";
	$resultpro=$connection->createCommand($sqlprojects)->query();
	
	$this->render('update_buildings',array('update_buildings'=>$result,'projects'=>$resultpro));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }
	public function actionUpdate_build()
	     {
		 $connection = Yii::app()->db;
				 $error =array();
     			$id=$_POST['id'];
			 $connection = Yii::app()->db;  
				 $s = "SELECT * FROM buildings where id=".$_POST['id'];
		       $res = $connection->createCommand($s)->queryRow();
				 if ($_FILES['building_image']["name"]==''){
				 $image=$res['building_image'];
					}else{ 
                $image=$_FILES['building_image']["name"];			
				$newfilename = $_FILES["building_image"]["name"];
				move_uploaded_file($_FILES["building_image"]["tmp_name"],
				'images/buildings/'.$newfilename);
				}
		//	echo $newfilename;exit;
			  $sq  = "SELECT * from buildings where project_id='".$_POST['project']."'AND name='".$_POST['bname']."' and building_image='".$_FILES['building_image']["name"]."' ";
			 $result_sq = $connection->createCommand($sq)->queryAll();
			 $count=0;
			 $re=array();
			 foreach($result_sq as $key1){$count=$count+1;}
			if($count!=0)
			 {
				  $error="Building Name Already Exists";
			}	
				
			 $name=$_POST['bname'];
			  
            if(empty($error))
			{	
			 $sql_update = "UPDATE buildings SET name ='$name',building_image='$newfilename' WHERE id =".$id;
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			   $this->redirect (array('property/buildings_list'));
			}
			if(!empty($error))
			{
				echo $error;
			}
	   }
		public function actionDelete_buildings()
		 {
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
        $connection = Yii::app()->db; 
	 
	 
		$connection = Yii::app()->db; 
		$sql_del = "DELETE from buildings where id=".$_GET['id'];
		$command = $connection -> createCommand($sql_del);
        $command -> execute();
		$this->redirect (array('property/buildings_list'));
	{
		$this->redirect (array('property/buildings_list'));
	}
		}
	  else{
		  $this->redirect (array('user/user'));
	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
    public function actionBuildings_list()
		 {	
		 
	  $connection = Yii::app()->db; 
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	          if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	  			 {
					$where='buildings.id !=""'; 
					$and=false;
				if (!empty($_POST['bname'])){
				$where.="and buildings.name LIKE '%".$_POST['bname']."%'";
				$and = true;
						}
			if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="and buildings.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="and buildings.project_id LIKE '%".$_POST['project_id']."%'";
				}
				
				
			}
		if (!empty($_POST['status'])){
		if($_POST['status']==0){ $where.=" and buildings.status='0'";}
		if($_POST['status']==1){ $where.=" and buildings.status='1'";}
	    if($_POST['status']==2){ $where.=" and buildings.status='2'";}
			}	
				 
			$this->layout='//layouts/back';
			$sqlprojects="SELECT * FROM projects "; 
			$resultpro = $connection->createCommand($sqlprojects)->query();
			 $sql="SELECT ptype.project_name as buildingtype,buildings.*,projects.project_name FROM buildings
			LEFT JOIN projects on projects.id=buildings.project_id
			LEFT JOIN ptype on ptype.id=buildings.ptype_id
			where $where ORDER BY buildings.name ASC "; 
			$result = $connection->createCommand($sql)->query();
		
			$this->render('buildings_list',array('buildings'=>$result,'projects'=>$resultpro));
				   }
					else{
						$this->redirect (array('user/user'));
						}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionFloors()
	     {
		if(Yii::app()->session['user_array']['per3']=='1')
		{
		$connection = Yii::app()->db;  
		$sql_project  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_project)->query();
		$sql_buildings  = "SELECT buildings.*,projects.project_name FROM buildings
			LEFT JOIN projects on projects.id=buildings.project_id
			 ORDER BY buildings.name ASC";
		$result_buildings = $connection->createCommand($sql_buildings)->query();
		$this->render('floors',array('projects'=>$result_projects, 'buildings'=>$result_buildings));
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	public function actionAddflor()
	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{		  
			$connection = Yii::app()->db;
			$error ='';
			if(isset($_POST['project_id']) && empty($_POST['project_id']))
			{
			$error = 'Please Select Project<br>';
			}
			if(isset($_POST['building_id']) && empty($_POST['building_id']))
			{
			$error .= 'Please Select Building<br>';
			}
				if(isset($_POST['floor_name']) && empty($_POST['floor_name']))
			{
			$error .= 'Please Enter Floor Name<br>';
			}
				if(isset($_POST['no_of_shops']) && empty($_POST['no_of_shops']))
			{
			$error .= 'Please Enter No Of Shops/Offices<br>';
			}
			 $sq  = "SELECT * from floors where project_id='".$_POST['project_id']."' AND building_id='".$_POST['building_id']."' AND name='".$_POST['floor_name']."' ";
			 $result_sq = $connection->createCommand($sq)->queryAll();
			 $count=0;
			 $re=array();
			foreach($result_sq as $key1){$count=$count+1;}
			if($count!=0)
			 {
				  $error="Floor Name Already Exists";
			}	
			if(empty($error))
			{            
				$sql  = "INSERT INTO floors(name,no_of_shops,project_id,building_id) VALUES('".$_POST['floor_name']."','".$_POST['no_of_shops']."','".$_POST['project_id']."','".$_POST['building_id']."')";	
                $command = $connection -> createCommand($sql);
		       $command -> execute();
				 echo "New Record Inserted Successfully";
				 echo '<span style="float:right"><a href="'. Yii::app()->request->baseUrl.'/index.php/property/floors_list"'.'class="btn-info button">Back To List</a></span>';
			}
			if(!empty($error))
			{
				echo $error;
			}
			}
			else{
			$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
			}
	}

    public function actionFloors_list()
		 {	  $connection = Yii::app()->db; 
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
		$this->layout='//layouts/back';
       	$and = false;
			$where='';
	if (!empty($_POST['building_id'])){				
				if ($and==false)
				{
					$where.="where floors.building_id LIKE '%".$_POST['building_id']."%'";
				}
				else
				{
					$where.="where floors.building_id LIKE '%".$_POST['building_id']."%'";
				}
				
			}
			if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="and floors.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="and floors.project_id LIKE '%".$_POST['project_id']."%'";
				}
				
			}
	
	//$sql = "SELECT * FROM streets";
  $sql="SELECT
    projects.id
    
    , floors.id
	, floors.name
	,floors.no_of_shops
	,floors.building_id
	,buildings.name as buildname
	, floors.project_id
    , projects.project_name
	
FROM
    floors
	Left JOIN projects  ON (floors.project_id = projects.id) 
	Left JOIN buildings  ON (floors.building_id = buildings.id) 
	 $where ORDER BY floors.name,buildings.name ASC "; 
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	$this->render('floors_list',array('floors'=>$result,'projects'=>$result_project));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	  public function actionUpdate_floors()
     	{
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	    if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
$sql = "SELECT
    projects.id
    
   
	, floors.name
	, floors.project_id
	,floors.no_of_shops
    , projects.project_name
	, buildings.name as bname
	, buildings.id as building_id
FROM
    floors
	Left JOIN projects  ON (floors.project_id = projects.id) 
	Left JOIN buildings  ON (floors.building_id = buildings.id) 
	where floors.id=".$_GET['id']."";
	$result = $connection->createCommand($sql)->query();
	$this->render('update_floors',array('update_floors'=>$result));
		}else{
			$this->redirect (array('user/user'));
	  		}
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
    }

	public function actionUpdate_flor()
	     {
		 $connection = Yii::app()->db;
				 $error =array();
     			$id=$_POST['fid'];
				if(isset($_POST['project_id']) && empty($_POST['project_id']))
				{
				$error = 'Please Select Project<br>';
			}
			if(isset($_POST['name']) && empty($_POST['name']))
			{
				$error .= 'Please Enter Floor Name<br>';
			}
					   $sq  = "SELECT * from floors where project_id='".$_POST['project_id']."' AND  building_id='".$_POST['building_id']."' AND name='".$_POST['name']."' AND
					   no_of_shops='".$_POST['no_of_shops']."' ";
			 $result_sq = $connection->createCommand($sq)->queryAll();
			 $count=0;
			 $re=array();
			 foreach($result_sq as $key1){$count=$count+1;}
			if($count!=0)
			 {
				  $error="Same Record Already Exists";
			 }	
			
			 $name=$_POST['name'];
			  $project_id=$_POST['project_id'];
			   $building_id=$_POST['building_id'];
			  $no_of_shops=$_POST['no_of_shops'];
            if(empty($error))
			{
			
					
			   $sql_update = "UPDATE floors SET name ='$name',no_of_shops='$no_of_shops' WHERE id =".$id;
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			    echo $note="Record Updated Successfully";
			}
			if(!empty($error))
			{
				echo $error;
			}
	   }
	public function actionDelete_floors()
		 {
		if(Yii::app()->session['user_array']['per3']=='1')
			{
	if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
      
	
		$connection = Yii::app()->db; 
		$sql_del = "DELETE from floors where id=".$_GET['id'];
		$command = $connection -> createCommand($sql_del);
        $command -> execute();
		$this->redirect (array('property/floors_list'));
		
		}
	  else{
		  $this->redirect (array('user/user'));
	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}

   
   
   //////////////////////////END: Buildings and Floors/////////////////////////////////////////
   
   //////////////////////////START: INSTALLMENT PLAN///////////////////////////////////////////
   public function actionInstallmentplan()
		{
	 if(Yii::app()->session['user_array']['per3']=='1')
			{
		$connection = Yii::app()->db;  
		$sql_ptype  = "SELECT * from ptype";
		$result_ptype = $connection->createCommand($sql_ptype)->query();
		$sql_size  = "SELECT * from size_cat where typee='P'";
		$result_size = $connection->createCommand($sql_size)->query();
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
		$this->render('installmentplan',array('projects'=>$result_projects,'ptype'=>$result_ptype,'size'=>$result_size));
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
				$sql  = "INSERT INTO installment_planp (project_id,description,category_id,p_type,tamount,tno,
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
 public function actionInsplanlist()
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
	,size_cat.dimension
FROM
    installment_planp ins
	Left JOIN projects  ON (ins.project_id = projects.id) 
    Left JOIN size_cat  ON (ins.category_id = size_cat.id) 

	 $where "; 
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
	$this->render('insplanlist',array('streets'=>$result,'projects'=>$result_project));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
		}
		
 	public function actionUpdateinstall()
     	{
		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))
			{
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	 $sql= "SELECT
    projects.project_name
	,size_cat.size
	,size_cat.dimension
	,ins.*
    FROM
    installment_planp ins
	Left JOIN projects  ON (ins.project_id = projects.id)
	  Left JOIN size_cat  ON (ins.category_id = size_cat.id)  
	  WHERE ins.id='".$_GET['id']."'";
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
   $sql_size = "SELECT * from size_cat where typee='P'";
	$result_size = $connection->createCommand($sql_size)->query();
	$sql_type = "SELECT * from ptype";
	$result_type = $connection->createCommand($sql_type)->query();
	$this->render('updateinstall',array('pla'=>$result,'projects'=>$result_project,'size'=>$result_size,'type'=>$result_type));
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    
		}
	public function actionPlanupdate()
	{       
	
		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

			   $connection = Yii::app()->db;  
				

			   $sql="UPDATE installment_planp set 
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
		
 ////////////////////////////END : INSTALLMENT PLAN///////////////////////////////////////////////

	
   
		
public function actionSelectplot($pro,$street,$size,$sector)
		{
				

		$connection = Yii::app()->db;  

		  $sql_plot  = "SELECT * from plots
		where project_id='".$pro."' And sector='".$sector."' And street_id='".$street."' and size2='".$size."' and `type` LIKE 'Plot' AND `com_res` LIKE 'Commercial' and `status` ='Alotted' and is_building='0'";
		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}

/////////////////////////DELETE //////////////

	public function actionDelete()
		{	
			
		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))
			{

			 $connection = Yii::app()->db; 
			 $sql_del = "DELETE from installment_planp where id=".$_GET['id'];
			 $command = $connection -> createCommand($sql_del);

             $command -> execute();
             echo'Deleted Succesfully';
			 $this->redirect(array('property/list'));
		}
		
	  else{
		  $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
		  }
	  
	    }
   
	public function actionProperty_list()
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
					if (!empty($_POST['status']))
					{
						if($_POST['status']=='Alloted')
						{
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
	
	
	
			$sql_size  = "SELECT * from size_cat where typee='P'";
	
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
	
	
	
				$this->render('property_list',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
	
	
	
				
	
	
	
		   
	
	
	
		
		}
	public function actionAddnew()
		{
				

	 if(Yii::app()->session['user_array']['per2']=='1')

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

		$sql_plan  = "SELECT ip.*,p.project_name from installment_planp ip
		left join projects p on ip.project_id=p.id
		
		 ";
		$result_plan = $connection->createCommand($sql_plan)->query();
	
		$sql_ptype = "SELECT * from ptype";
		$result_ptype= $connection->createCommand($sql_ptype)->query();

		$this->render('addnew',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan, 'ptype'=>$result_ptype));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
	
	public function actionAdminrequest()

		{
				

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per6']=='1')

			{

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.id,mp.plot_id,mp.pname,mp.carea,mp.create_date,mp.fstatus,mp.plotno,p.status,p.type, p.size2,siz.size,m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM property mp

left join members m on m.id=mp.member_id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id
left join size_cat siz on p.size2=siz.id

left join projects j on s.project_id=j.id where mp.member_id!=''";// p.type='plot' and mp.status='new'and mp.fstatus='approved' ";

		$memberplot_list = $connection->createCommand($sql_member)->query();

		

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

		

		$this->render('adminrequest',array('memberplot_list'=>$memberplot_list,'projects'=>$result_projects));

		}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
	public function actionFinancerequest()

		{
				

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per6']=='1')

			{

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.id,mp.plot_id,mp.pname,mp.carea,mp.create_date,mp.fstatus,mp.plotno,p.status,p.type, p.size2,siz.size,m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM property mp

left join members m on m.id=mp.member_id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id
left join size_cat siz on p.size2=siz.id

left join projects j on s.project_id=j.id where mp.member_id!=''";// p.type='plot' and mp.status='new'and mp.fstatus='approved' ";

		$memberplot_list = $connection->createCommand($sql_member)->query();

		

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

		

		$this->render('financerequest',array('memberplot_list'=>$memberplot_list,'projects'=>$result_projects));

		}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
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

					  $where.=" and property.pname LIKE '%".$_POST['plotno']."%'";

				}

				else

				{

					$where.=" property.pname LIKE '%".$_POST['plotno']."%'";

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
,property.pname

	

FROM

    plots

    Left JOIN streets  ON (plots.street_id = streets.id)


	Left JOIN projects  ON (plots.project_id = projects.id)

	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	
	Left JOIN property  ON (plots.id = property.pname)

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

					  $where.=" and mp.pname ='".$_POST['plotno']."'";

				}

				else

				{

					$where.=" mp.pname ='".$_POST['plotno']."'";

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

		$sql_payment  = "SELECT  mp.member_id,mp.plotno,mp.pname,mp.carea,mp.create_date,mp.id as mp_id,p.type,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,s.street,j.project_name FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id


left join ptype j on mp.ptype=j.id

where $where ";

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
//$i=0;
            foreach($sql_payments as $key){

          
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
		
		$ID=$key['mp_id'];
		
		//$due=$due+$row['amount'];
		//$paid=$paid+$row['paidamount'];
  echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['pname'].'<td>'.$key['carea'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="req_detail?id='.$ID.'">Detail</a>

 

  </td></tr>';

		 

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

	public function actionMemberproperty_lis()
		{
				
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

	 $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where p.type='plot' and mp.status='Approved' "; 
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

			$this->render('memberproperty_lis',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));

	
		}
	public function actionSearchreq()
		{
			
		$where='';
		
		$and = false;
			if (!empty($_POST['name1'])){
				$where.=" m.name LIKE '%".$_POST['name1']."%'";
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
					$where.=" and m.cnic =".$_POST['cnic']."";
				}
				else
				{
					$where.=" m.cnic =".$_POST['cnic']."";
				}
				$and=true;
			}
/*if (!empty($_POST['allotmentstatus'])){
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
				}s
				else
				{
					$where.=" mp.status!='Approved'";
				}}
				
				$and=true;
			}*/
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
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
					$where.=" and mp.plotno Like '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno Like '%".$_POST['plotno']."%'";
				}
				$and==true;
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
 $sql_memberas = "SELECT mp.id as mid,mp.member_id,mp.plotno,mp.pname,mp.ptype,mp.carea ,mp.create_date,ss.sector_name,p.sector,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,pt.project_name FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join ptype pt on mp.ptype=pt.id

left join sectors ss on p.sector=ss.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id

where $where  ";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		

	$connection = Yii::app()->db; 
   echo $sql_member = "SELECT mp.id as mid,mp.member_id,mp.plotno,mp.pname,mp.ptype,mp.carea ,mp.create_date,ss.sector_name,p.sector,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id as jid,pt.project_name, floors.name as fname, buildings.name as buildname FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join ptype pt on mp.ptype=pt.id

left join sectors ss on p.sector=ss.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id
Left JOIN buildings  ON (buildings.plot_id = p.id)
Left JOIN floors  ON (mp.floor_id = floors.id)

where $where limit $start,$limit"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){
            $count++; 
$sql1t ="SELECT * from transferplot where plot_id=".$key['plot_id']." and status='New Request'";
		$result_datat = $connection->createCommand($sql1t)->queryRow();
			echo $count.' result found';
			 echo '<tr><td>'.$count.'</td><td>'.$key['plotno'].'</td><td>';if(empty($key['image'])){echo'';}else{echo'<img src="/upload_pic/'.$key['image'].'" width="100" height="130" />';}echo'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['buildname'].'</td><td>'.$key['fname'].'</td><td><strong>'.$key['carea'].'</strong></a></td><td>'.$key['project_name'].'</td><td>';
			 if($key['status']=='') {echo'<a href=allot?id='.$key['mid'].'&&pro='.$key['jid'].'>Allot Property</a>';}else{
				 echo' <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			 
			<li role="presentation"> <a target="_blank" href="plotcharges?id='.$key['mid'].'&& pid='.$key['project_id'].'">Plot Charges</a></li>
			<li role="presentation"><a target="_blank" href="prop_payment_details?id='.$key['mid'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li role="presentation"><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a></li>
			<li role="presentation">';if($result_datat['status']=='New Request'){ echo '<a  href="'.$home.'/index.php/memberplot/treq_detail?id='.$key['plot_id'].'">Transfer Details</a>';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer File</a>';}

  echo'</li><li role="presentation"><a href="updatemember_plot?id='.$key['plot_id'].'">Update Membership</a></li>
	   <li role="presentation"><a href="amembers?mid=">Associates Member</a></li>
<li role="presentation"><a href="'.Yii::app()->baseUrl.'/index.php/allotments/edit_app?mid=">Application Information</a></li>
</ul></div>';
				 }
echo'</td></tr>'; 

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
		
	public function actionAddnewproperty()
		{
			 
			if(Yii::app()->session['user_array']['per4']=='1')
			{   
					$error='';
                                    //$error =array();
									$connection = Yii::app()->db;  
									
									if ((isset($_POST['plot_id']) && empty($_POST['plot_id']))){
									 $error.="Please Select Plot. <br>";}								  
								  	
									if ((isset($_POST['p_type']) && empty($_POST['p_type']))){
									 $error.="Please Select Property Type. <br>";
									 }
									 if ((isset($_POST['number']) && empty($_POST['number']))){
									 $error.="Please Enter Unique No. <br>";
									 }
									 if ((isset($_POST['details']) && empty($_POST['details']))){
									 $error.="Please add Detail. <br>";
									 }
									 if ((isset($_POST['floor']) && empty($_POST['floor']))){
									 $error.="Please Enter NO. of Floor. <br>";
									 }
									 if ((isset($_POST['cov_a']) && empty($_POST['cov_a']))){
									 $error.="Please Enter Covered Area. <br>";
									 }
									 if ((isset($_POST['status']) && empty($_POST['status']))){
									 $error.="Select Status. <br>";
									 }
								
								 	$pn=$_POST['number'];
									if(!empty($pn)){
									$q ="SELECT * from property where plot_id='".$_POST['plot_id']."' and pname='".$pn."' "; 
									  $result_q = $connection->createCommand($q)->queryRow();
									if(!empty($result_q)){
									 $error .="Property # Already Added Try Another. <br>";
									}}
										 if(empty($error)){
										
										
									$insert=0;
						
						
						do{
							$sqlplots ="SELECT * from plots where id='".$_POST['plot_id']."'"; 
						$resplots = $connection->createCommand($sqlplots)->query();
							 foreach($resplots as $plots){
								 
						 $uid=Yii::app()->session['user_array']['id']; 
				 $sql  = "INSERT INTO propertyc (plot_id,ptype,pname,pdetails,floors,carea,user_name,create_date,pstatus) 
	VALUES ('".$_POST['plot_id']."','".$_POST['p_type']."','".$_POST['number']."','".$_POST['details']."','".$_POST['floor']."','".$_POST['cov_a']."','".$uid."','".date('Y-m-d H:i:s')."','".$_POST['status']."')";	
				   $command = $connection -> createCommand($sql);
                        $command -> execute();
						
							
								 
						$tno=$_POST['details'];
						
						//if($instalno==1){$tno=$tno+1;}
						
						  $sql  = 'INSERT INTO plots 
(ref_id,type,project_id,street_id, plot_detail_address, plot_size, size2,price,create_date, com_res,sector,cstatus,bstatus)
               	    	  VALUES ( "'.$plots['id'].'","'.$plots['type'].'","'.$plots['project_id'].'", "'.$plots['street_id'].'", "'.$plots['plot_detail_address'].'", "'.$plots['plot_size'].'", "'.
						  $plots['size2'].'", "'.$plots['price'].'", "'.date('Y-m-d h:i:s').'" ,"'.$plots['com_res'].'","'.$plots['sector'].'"
,"'.$plots['cstatus'].'","open" '.''.')';	
					


               $command = $connection -> createCommand($sql);

			   $command -> execute();

						
						
						
						
						$insert++;
						 }
						}while($insert<$tno);
							
						echo 'Property Inserted';
						exit;
						}
						else if(!empty($error)){ 
 						echo $error;

             } 
			}
	
		}
	public function actionMemberproperty()
		{
				

	 if(Yii::app()->session['user_array']['per2']=='1')

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
		left join projects p on ip.project_id=p.id
		
		 ";
		$result_plan = $connection->createCommand($sql_plan)->query();
	
		

		$this->render('memberproperty',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
	

	public function actionMemberplot_search_lis()
		{
				

	if(Yii::app()->session['user_array']['per2']=='1')

			{
					$connection = Yii::app()->db; 

			$and = false;

			$where='';
	    // echo   $qry="Select * from memberplot where create_date BETWEEN '".$_POST['fromdate']."'  AND  '".$_POST['todate']."'  ";

			//exit;		

			

			

			if (($_POST['fromdate']!="") && ($_POST['todate']!="")) {
			$from=$_POST['fromdate'];
			
						$to=$_POST['todate'];
				if ($and==true)

				{

				$where.="and mp.create_date BETWEEN '".$from."' AND '".$to."' ";

				}else{$where.="mp.create_date BETWEEN '".$from."' AND '".$to."' ";}

			$and=true;

			}

			

				if ($_POST['username']!=""){

				if ($and==true)

				{

				$where.="and m.name LIKE '%".$_POST['username']."%'";

				}else{

				$where.=" m.name  LIKE '%".$_POST['username']."%'";

				}

			$and=true;	

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

				$and=true;

			}

			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				

				$pro=$_POST['project_id'];

				if ($and==true)

				{

					$where.=" and p.project_id LIKE '%".$_POST['project_id']."%'";

				}
				else
				{

					$where.=" p.project_id LIKE '%".$_POST['project_id']."%'";

				}
}
				$and=true;

  $sql_member = "SELECT mp.id,mp.fstatus,mp.member_id,mp.status,mp.fstatus,mp.plot_id,mp.plotno,mp.create_date,p.id,m.username, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,mp.carea,mp.floors,pt.project_name,j.project_name as prname,mp.pname, j.project_name FROM property mp

left join members m on mp.member_id=m.id
left join ptype pt on mp.ptype=pt.id
left join plots p on mp.plot_id=p.id
left join projects j on p.project_id=j.id
where ".$where." and mp.status='new'and mp.fstatus='approved' ";

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_projects = "SELECT * from projects ";





		$result_projects = $connection->createCommand($sql_projects)->query();



			$this->render('adminrequest',array('memberplot_list'=>$result_members,'projects'=>$result_projects));

	}

	

	

	
		}
	public function actionReq_detail()
		{
			
	if(Yii::app()->session['user_array']['per2']=='1')
	{
		$connection = Yii::app()->db; 	
		$sql_details  = "SELECT mp.id,mp.fstatus,mp.member_id,mp.status,mp.fstatus,mp.plot_id,mp.price,mp.plotno,mp.insplan,mp.create_date,m.username, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,mp.carea,mp.floors,pt.project_name,j.project_name as prname, mp.pname,mp.noi FROM property mp
left join members m on mp.member_id=m.id
left join ptype pt on mp.ptype=pt.id
left join plots p on mp.plot_id=p.id
left join projects j on p.project_id=j.id
 where mp.id=".$_REQUEST['plot_id'];

			$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['plot_id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	
		}
	public function actionPlotcharges()
		{
				

			$this->layout='//layouts/back';

			$connection = Yii::app()->db;

			$plot_id =$_REQUEST['id'];
				//exit;		
			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";
			$result_charges = $connection->createCommand($sql_charges)->query();

			$sql_plots  = "SELECT * from property where id='".$plot_id."'";
			$result_plots = $connection->createCommand($sql_plots)->query();
			

			$this->render('plotcharges',array('plots'=>$result_plots,'charges'=>$result_charges));

	
		}
	public function actioncharge()
		{
			

		if(Yii::app()->session['user_array']['per2']=='1')

			{

		

		$error =array();
		$error = '';

		if((isset($_POST['plot_id']) && empty($_POST['plot_id']))  ||(isset($_POST['duedate']) && empty($_POST['duedate']))  || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment']))|| (isset($_POST['total']) && empty($_POST['total'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			if(empty($error)){
				    $connection = Yii::app()->db;
					$sqlchrgesdetail='Select * from charges where id="'.$_POST['charges_id'].'"';
					 $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
                      $sql  = 'INSERT INTO propertypayment  (plot_id,payment_type,amount, remarks,duedate) VALUES ("'.$_POST['plot_id'].'","'.$resultcharges['name'].'", "'.$_POST['total'].'","'.$_POST['comment'].'","'.$_POST['duedate'].'")';                      
					    $command = $connection -> createCommand($sql);
			            $command -> execute();
						echo "Charges Added Successfully";
			        }

					if(!empty($error)){
					echo $error;
				}

	}

	
		}
	
	
	public function actionSubmitstatus()
		{
			
	if($_POST['statusapp']=='Approved')
		{
		$connection = Yii::app()->db;
	 	$memberid=$_POST['member_id'];
		 $plotid=$_POST['plot_id'];
   	     $status=$_POST['status'];
		
		$sql="Update property SET status='Approved',comment='".$_POST['cmnt']."' where id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		
		$this->redirect(array("property/adminrequest"));
		} 
		
		if($_POST['statusapp']=='Rejected')
		{
			
		$connection = Yii::app()->db;
		$plotid=$_POST['plot_id'];
		//echo $sqlup="Update plots SET status='' where id='".$plotid."'";	
          $sqlup="UPDATE property set status='' WHERE id='".$plotid."'"; 
		$command = $connection -> createCommand($sqlup);
        $command -> execute();
		
$sql2="DELETE FROM  proinstallpayment where plot_id='".$plotid."'";		
        $command = $connection -> createCommand($sql2);
        $command -> execute();



			$this->redirect(array("property/adminrequest"));

		}

		
		}

	public function actionDownload()
		{
			

	$plot_id = $_GET['id'];

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
	,size_cat.size

	,plots.plot_detail_address

	,memberplot.create_date
	,streets.street

	FROM

    memberplot

    LEFT JOIN members 

        ON (memberplot.member_id = members.id ) 

		left join plots on memberplot.plot_id=plots.id
		left join size_cat on plots.size2=size_cat.id
		left join streets on plots.street_id=streets.id

		where memberplot.plot_id=".$plot_id;

		

		$member_result = $connection->createCommand($sql_member)->queryAll();

	 	$this->render('pdf',array('member'=>$member_result)); 
		}
	public function actionAjaxRequest7($val1,$pro)
		{
				

		$connection = Yii::app()->db;  

		  $sql_plot  = "SELECT * from installment_planp where project_id='".$pro."' ";

		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
	public function actionProjectcode($val1)
		{
				

		$connection = Yii::app()->db;  

		$sql_plot  = "SELECT * from projects where id='".$val1."' ";

		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
	public function actionSizecode($size)
		{
				

		$connection = Yii::app()->db;  

		$sql_plot  = "SELECT * from size_cat where id='".$size."' ";

		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
	public function actionSearchreq1()
		{
			
if((Yii::app()->session['user_array']['per3']=='1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
		$where="plots.is_property='1'";
$and=true;
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
if (isset($_POST['sector']) && $_POST['sector']!="")
{				
$where.=" and plots.sector ='".$_POST['sector']."'";
				$and = true;
				$sector=$_POST['sector'];
}
if (isset($_POST['com_res']) && $_POST['com_res']!=""){
$where.="and plots.com_res LIKE '%".$_POST['com_res']."%'";
$and = true;
$com_res=$_POST['com_res'];
}
			if (!empty($_POST['plotno'])){
if ($and==true)
{
$where.=" and plots.plot_detail_address ='".$_POST['plotno']."'";
}
else
{
$where.="plots.plot_detail_address='".$_POST['plotno']."'";
}
$and==true;
}
if (isset($_POST['plotno1']) && $_POST['plotno1']!=""){
				$plotno=$_POST['plotno1'];
				if ($and==true)
				{
					$where.=" and memberplot.plotno  Like '%".$_POST['plotno1']."%'";
				}
				else
				{
					$where.=" memberplot.plotno Like '%".$_POST['plotno1']."%'";
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
if (isset($_POST['ctag']) && $_POST['ctag']!=""){
				
				if ($and==true)
				{
					$where.=" and plots.ctag LIKE '%".$_POST['ctag']."%'";
				}
				else
				{
					$where.=" plots.ctag LIKE '%".$_POST['ctag']."%'";
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
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
if($_POST['allotmentstatus']==4){if ($and==true)
{
$where.=" and mp.mstatus=2";
}
else
{
$where.=" mp.mstatus=0";
}

}
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
					$where.=" and plots.street_id='".$_POST['street_id']."'";
				}
				else
				{
					$where.=" plots.street_id='".$_POST['street_id']."'";
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
, plots.ctag
, memberplot.fstatus
, plots.bstatus
, plots.plot_detail_address
, memberplot.plotno
, projects.project_name
, size_cat.size
, size_cat.typee
,floors.name as floor_name
,buildings.name as building_name
FROM
plots
    Left JOIN floors  ON (plots.floor_id = floors.id)
	".$extra1."
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN buildings  ON (floors.building_id = buildings.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where  limit $start,$limit ";
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
echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['com_res'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['building_name'].'</td><td>'.$key['floor_name'].'</td>
<td>';
	
		if($key['status']=='Alotted'){echo'Alotted';}
		if($key['status']==''){echo'Not Alotted';}
			if($key['bstatus']=='reserved'){echo'Reserved';}
			
			if($key['ctag']!='')
			{
				echo ' &nbsp;('.$key['ctag'].')';
			}
echo'</td>';
echo '<td>';
		if($key['status']==''){
		echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'&&pro='.$key['project_id'].'">' ."Allot".'</a>';
		}elseif($key['status']=='Requested'){if(!empty($key['fstatus'])){$M='M';}else{$F='F'; } echo'<a href="'.$home.'/index.php/memberplot/requested_detail?id='.$key['id'].'">' ."Requested".'('.$M.$F.')'.'</a>';
}else{ echo $key['status'];}echo '</td>
<td>'.$key['bstatus'].'</td>';
if((Yii::app()->session['user_array']['per1']=='1')||(Yii::app()->session['user_array']['per34']!='1'))
{
echo '<td><div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
		Dropdown
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation"><a href="updateplot?id='.$key['id'].'&&project_id='.$key['project_id'].'">Edit</a></li>
				<li role="presentation"><a href="reallocate?id='.$key['id'].'">Reallocate</a></li>';
				if($key['status']=='')
				{
				echo '<li role="presentation">
						<a href="#" onclick="deletethis('.$key['id'].','.$key['project_id'].')">Delete</a></li>';}
						echo '<li role="presentation"><a target="_blank" href="'.$home.'/fileupload/index.php?id='.$key['id'].'">Upload Docs</a></li></td>';}else echo'<td></td>';
				'</tr>';
				}
				echo'<tr><td>';?>
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="landscape">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<meta charset="utf-8">
<title></title>
<style>
	td{ padding:0px;  border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}
</style>
<html>
<body>
<table  class="table table-striped table-new table-bordered">
<tr>  <th><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>"  width="270px">
   </th></tr><tr><th><?php // echo $key['project_name'];?> Plots</th></tr>
  <tr style="background:#666; border-color:#ccc; color:#fff; ">
       
         
            <th style="width:100px"><b>Plot Size </b></th> 
              <th style="width:100px"><b>Type </b></th>
                <th style="width:100px"><b>Unit No </b></th>
             <th style="width:100px"><b>Street</b></th>
              <th style="width:100px"><b>Sector</b></th>
              <th style="width:100px"><b>Status </b></th>
               <th style="width:100px"><b>MS No. </b></th>
  </tr>
  

</table>
</body>
</html>
    
</textarea>
<div style="text-align: left; margin-top: 1em;">
<button type="submit">Print Report</button>
</div>
</form>
<?php echo'</td></tr>';
				
				
		}?> 
<script>
		function deletethis(id,idd){
				var x = confirm("Are you sure you want to delete?");
		
		if(x == true){
		window.location="deleteplot?id=" + id + "&&did=" + idd + "";
		}
		if(x == false){return false;}
		}
		
		</script>
<?php
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
		echo '<tr  ><td colspan="12"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
			echo '<tr><td colspan="12">'.$pagination.'</td></tr>'; exit;
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
	public function actionInstalment()
		{
			

		if(Yii::app()->session['user_array']['per2']=='1')

			{

		
		$error =array();
		$error = '';

		if((isset($_POST['payment-type']) && empty($_POST['payment-type'])) ||(isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['member_id']) && empty($_POST['member_id'])) || (isset($_POST['amount']) && empty($_POST['amount'])) || (isset($_POST['paid-as']) && empty($_POST['paid-as'])) || (isset($_POST['detail']) && empty($_POST['detail'])) || (isset($_POST['date']) && empty($_POST['date'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			if(empty($error)){

					  // Insert in to member a new member

                                        $connection = Yii::app()->db;  

                                   
									 $sql  = 'INSERT INTO plotpayment  (payment_type, plot_id, mem_id, amount,discount, paidas, detail, surcharge, date, create_date ) VALUES ("'.$_POST['payment_type'].'","'.$_POST['plot_id'].'", "'.$_POST['member_id'].'", "'.$_POST['amount'].'", "'.$_POST['discount'].'",  "'.$_POST['paid-as'].'", "'.$_POST['detail'].'", "'.$_POST['surcharge'].'", "'.$_POST['date'].'", "'.date('Y-m-d h:i:s').'")';		                  $command = $connection -> createCommand($sql);

                                        $command -> execute();
										echo $note="Payment Added Successfully";

			}
				if(!empty($error)){
					echo $error;
				}

	}

	

	
		}

	public function actionDelete_Ins()
		{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
   
			 $connection = Yii::app()->db; 
			  $sql_del = "DELETE from installpayment where id=".$_GET['did'];
			 $command = $connection -> createCommand($sql_del);
             $command -> execute();
			 $this->redirect (array('memberplot/installment_details?id='.$_GET['id'].''));
		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	
		}
	public function actionDelete_Charges()
		{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
   
			 $connection = Yii::app()->db; 
			  $sql_del = "DELETE from plotpayment where id=".$_GET['id'];
			 $command = $connection -> createCommand($sql_del);
             $command -> execute();
			 $this->redirect (array('memberplot/payment_details?id='.$_GET['pid'].''));
		}

	  else{

		  $this->redirect (array('user/user'));

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	
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
	public function actionSearch_memberplot()
		{
				

	  

		 if(Yii::app()->session['user_array']['per2']=='1')

			{

		

	$connection = Yii::app()->db;  

		$sql_project  = "SELECT * from projects";

		$result_projects = $connection->createCommand($sql_project)->query();

			$this->render('search_memberplot',array('projects'=>$result_projects));

			}

			else{

				$this->redirect('dashboard');

			}

	
		}
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
	public function actionPayment()
		{
				

	if(Yii::app()->session['user_array']['per2']=='1')

			{

		

			$this->layout='//layouts/back';

			$connection = Yii::app()->db;

			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";

			$result_projects = $connection->createCommand($sql_projects)->query();

			

			$sql_page  = "SELECT mp.member_id,mp.create_date, m.name,m.username,m.sodowo,m.cnic, m.address,p.id   ,mp.plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 

FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id 

WHERE plot_id ='".$_REQUEST['id']."'";

			$result_pages = $connection->createCommand($sql_page)->query();

				

			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";

			$result_charges = $connection->createCommand($sql_charges)->query();

			

			$this->render('payment',array('projects'=>$result_projects,'pages'=>$result_pages,'charges'=>$result_charges));

			}

	
		}
///////////////////////////START: ALLOT PROPERTY/////////
	public function actionAllot()
		{		
	 if(Yii::app()->session['user_array']['per2']=='1')
		{
		$connection = Yii::app()->db;  
		$sql_country  = "SELECT * from tbl_country";
		$result_country = $connection->createCommand($sql_country)->query();	 
		$sql_plan  = "SELECT * from installment_planp where project_id='".$_REQUEST['pro']."'";
		$result_plan = $connection->createCommand($sql_plan)->queryAll();
		$sql_project  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_project)->query();
				  $sql = "SELECT plots.id ,
				  plots.street_id ,
				   property.plot_size ,
				    plots.com_res , 
					property.price , 
					plots.cstatus ,
					 property.size2 ,
					  property.create_date , 
					  plots.sector ,
					   plots.category_id ,
					   floors.name as fname,
					    property.status , property.plot_detail_address , property.plotno , projects.project_name , projects.code , plots.project_id , categories.name , streets.street ,size_cat_prop.code as scode ,size_cat_prop.size ,buildings.name as bname FROM property Left JOIN plots ON (plots.id = property.plot_id) 
						Left JOIN buildings ON (plots.id = buildings.plot_id)
						Left JOIN floors ON (property.floor_id = floors.id) 
						
						Left JOIN streets ON (plots.street_id = streets.id) Left JOIN size_cat_prop ON (property.size2 = size_cat_prop.id) Left JOIN projects ON (plots.project_id = projects.id) Left JOIN memberplot ON (plots.id = memberplot.plot_id) Left JOIN categories ON (plots.category_id = categories.id) where property.id=".$_REQUEST['id']."";
	//	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";
		$result = $connection->createCommand($sql)->query();
		$this->render('allot',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
		}		
		public function actionAllotproperty()
		{		 
	   
									   $error='';
									   $base='';
									   $connection = Yii::app()->db;  
									   if(isset($_POST['cnic'])){ $base=$_POST['cnic']; }
										$sql ="SELECT * from members where cnic='".$base."'"; 
										$result_data = $connection->createCommand($sql)->queryRow();
										$dealer='';
										if(isset($_POST['mtype'])){
										if($result_data['mtype']!=='Dealer'){
										$error.='Applicant Containing '.$base.' CNIC is Not a Dealer and not authorized to purchase plot For Resale  <br>';
										}
										$dealer=$_POST['mtype'];
										}
										
								   if ((isset($base) && empty($base))){
									$error="CNIC required. <br>";
								   }elseif(empty($result_data)){
									$error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									}elseif($result_data['status']!=1){
									$error.='Applicant Containing '.$base.' CNIC is Not Active Register Member.<br>';
								   }
								   
								   if ((isset($_POST['plot_id']) && empty($_POST['plot_id']))){
									$error.="Property No Required. <br>";}
								   
										if ((isset($_POST['project_id']) && empty($_POST['project_id']))){
										$error.="Please Select Project. <br>";
										}
										
										if ((isset($_POST['building_id']) && empty($_POST['building_id'])))
										{
											$error.="Please Select Building <br>";
										 }
										  if ((isset($_POST['atype']) && empty($_POST['atype'])))
										{
											$error.="Please Select Allotment Type <br>";
										 }
								   if ((isset($_POST['floor_id']) && empty($_POST['floor_id'])))
									   {
											$error.="Please Select Floor. <br>";
										}
								 
								 if ((isset($_POST['noi']) && empty($_POST['noi']))){

									$error.="No.Of Installment required. <br>";
									}
									  if ((isset($_POST['date']) && empty($_POST['date']))){

									$error.="Enter Plan Start Date. <br>";
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
				   
									   
						if(empty($error)){
									   $uid=Yii::app()->session['user_array']['id'];							 
				$sql  = "INSERT INTO memberplot (app_no,plot_id,user_name,member_id,create_date,mmtype,noi,insplan,status,fstatus,comment,uid) 
   VALUES ('".$_POST['appnoo']."','".$_POST['plot_id']."','".$uid."','".$result_data['id']."','".date('Y-m-d')."','".$dealer."','".$_POST['noi']."','".$_POST['insplan']."','Sales','Sales','','".Yii::app()->session['user_array']['id']."')";			 
					  $command = $connection -> createCommand($sql);
					   $command -> execute();
					   $insert_id = Yii::app()->db->getLastInsertID();
		   
	   
			$sql_cat  = "SELECT * from cat_plot where plot_id='".$_POST['plot_id']."'";
			   $result_cat = $connection->createCommand($sql_cat)->queryAll();
		   foreach($result_cat as $new){
			  $sql1  = "SELECT * from charges where type='".$new['cat_id']."'";
			$result1 = $connection->createCommand($sql1)->queryRow();
			$plot  = "SELECT * from plots where id='".$_POST['plot_id']."'";
			$plots = $connection->createCommand($plot)->queryRow();
		   $chargess=$plots['price']/100*$result1['total'];
			$sqlcharges="INSERT INTO plotpayment SET payment_type='".$result1['name']."',amount='".$chargess."', due_date_temp='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";							
						 $command = $connection -> createCommand($sqlcharges);
					   $command -> execute();
		   }
		   $sql_cat12  = "SELECT * from charges where name LIKE '%MS Fee%'";
			   $result_cat12 = $connection->createCommand($sql_cat12)->queryRow();
			if($result_cat12!==''){
			$sqlchargesm="INSERT INTO plotpayment SET payment_type='MS Fee',amount='".$result_cat12['total']."', due_date_temp='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";							
						 $command = $connection -> createCommand($sqlchargesm);
					   $command -> execute();}
	   
				  $update  = "UPDATE plots set status='Requested', atype='".$_POST['atype']."' WHERE id='".$_REQUEST['plot_id']."'";		
 
					  $command = $connection -> createCommand($update);
					   $command -> execute();
					   $sqlinstalplan ="SELECT * from installment_planp where id='".$_POST['insplan']."'"; 
					   $dataplan = $connection->createCommand($sqlinstalplan)->queryRow();
						   
					   $tno=$_POST['noi'];
					   $insplan=$dataplan['tno'];
					   $insert=0;
					   $create=$_POST['date'];
					   $instalno=0;
					   $lab=0;
					   
					   do{
					   $lab++;
					   $instalno++;	
					   
					   $tno=$_POST['noi'];
					   
					   //if($instalno==1){$tno=$tno+1;}
						$sqlinstall="INSERT INTO installpayment SET lab='".$dataplan['lab'.$lab.'']."',dueamount='".$dataplan[''.$instalno.'']."', due_date_temp='".$create."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'"; 
					   $next_due_date = strtotime($create.' + '.$tno.' Months');
					   $create=date('Y-m-d', $next_due_date);			
						 $command = $connection -> createCommand($sqlinstall);
					   $command -> execute();
					   $insert++;
					   }while($insert<$insplan);
				   echo 'Allotment Request Sent For Verification';
exit;
					   }
						 else if(!empty($error)){ 
						   echo $error;
			} 
   
	   }
///////////////////////////END:ALLOT A PROPERTY//////////////////////////
	public function actionMember_list()
		{
				

			if(Yii::app()->session['user_array']['per2']=='1')

			{

    

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.create_date, m.name,m.sodowo,m.cnic,p.plot_detail_address,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id where p.type='plot' and mp.status='Approved'";

		$result_members = $connection->createCommand($sql_member)->query();

		$this->render('member_list',array('members'=>$result_members));

			}

			else

			{

			$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");

			}

	
		}
	public function actionSearchreqf()
		{
			
		$where='';
		
		$and = false;
			if (!empty($_POST['name1'])){
				$where.=" m.name LIKE '%".$_POST['name1']."%'";
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
	$connection = Yii::app()->db; 
     $sql_member = "SELECT mp.member_id,mp.plotno,tp.status,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where and p.type='file' and mp.status='Approved' "; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a></br><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a>

  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

  </br>';if($key['tp.status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer File</a>';}

  echo'</br><a href="updatemember_plot?id='.$key['plot_id'].'">Update Membership</a></td></tr>'; 

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



	
		}
	
	public function actionMember_lisf()
		{
				
			$name='';
			$sodowo='';
			$cnic='';
			$plotno='';
			$project_name='';
			$plot_detail_address='';
			$where='';
			$and = false;
			if (!empty($_POST['name1'])){
				$where.=" m.name ".$_POST['name1']."%'";
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

	 $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where p.type='file' and mp.status='Approved' "; 
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

  echo '<tr><td>'.$key['plotno'].'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a></br><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a>

  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

  </br><a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer Plot</a>

  </td></tr>'; 

            }
			}

			$this->render('member_lisf',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));

	
		}
	public function actionMember_flist()
		{
				

	if(Yii::app()->session['user_array']['per2']=='1')

			{

		

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.create_date, m.name,m.sodowo,m.cnic,p.plot_detail_address,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id where p.type='file'  and mp.status='Approved'";

		$result_members = $connection->createCommand($sql_member)->query();

		$this->render('member_flist',array('members'=>$result_members));

	}

	
		}
	public function actionMember_flis()
		{
				

	if(Yii::app()->session['user_array']['per2']=='1')

			{

		

			if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) && (empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))){

				$error = "Please Fill Atleast one field";

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


				$this->render('member_flis',array('error'=>$error,'members'=>$members,'projects'=>$result_projects));

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

where $where and p.type='file'  and mp.status='Approved' "; 

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

			$this->render('member_flis',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));

	}

	
		}
	
	public function actionUpdate()
  		{
			

		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	  /*?>
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
    <?php */

//	$this->render('update',array('pla'=>$result,'projects'=>$result_project,'size'=>$result_size));
$this->render('update');
	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    
		}
	public function actionUpdate_charges()
 		{
			

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per2']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
			
		 $sql_payment  = "SELECT * FROM plotpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";

			$result_charges = $connection->createCommand($sql_charges)->query();

			
		$this->render('update_charges',array('charges'=>$result_charges,'payments'=>$result_payments));


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    
		}
	public function actionUp_charges()
		{
			

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per2']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
			
		 $sql_payment  = "SELECT * FROM plotpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";

			$result_charges = $connection->createCommand($sql_charges)->query();

			
		$this->render('up_charges',array('charges'=>$result_charges,'payments'=>$result_payments));


	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    
		}
	public function actionPaymentupdate()
		{
			       $error='';
			if ((isset($_POST['dueamount']) && empty($_POST['dueamount']))){
			$error.="Enter Due Amount. <br>";}
			if ((isset($_POST['lab']) && empty($_POST['lab']))){
			$error.="Enter Label. <br>";}
			if ((isset($_POST['paidamount']) && empty($_POST['paidamount']))){
			$error.="Enter Paid Amount. <br>";
			}
			if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))){
			$error.="Please Select Payment Type <br>";
			}		  
			if ((isset($_POST['detail']) && empty($_POST['detail']))){
			$error.="Enter Voucher NO. <br>";
			 }
		  if ((isset($_POST['remarks']) && empty($_POST['remarks']))){
			$error.="Enter Remarks. <br>";
			}
			
			if ((isset($_POST['paid_date']) && empty($_POST['paid_date']))){
			$error.="Enter Paid Date. <br>";
			 }	
			   $connection = Yii::app()->db;  
				  if(empty($error))

			{
			   $sql="UPDATE installpayment set 
			 dueamount='".$_POST['dueamount']."',
			 lab='".$_POST['lab']."',  
			 paidsurcharge='".$_POST['paidsurcharge']."',
			 paidamount='".$_POST['paidamount']."',
			 payment_type='".$_POST['payment_type']."',
			 detail='".$_POST['detail']."',
			 surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',
			 paid_date='".$_POST['paid_date']."',
			 due_date='".$_POST['due_date']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Updated Successfully';}
				else{
					echo $error;
					}
			  
	
		}
	public function actionInstallmentup()
		{
			       $error='';
			if ((isset($_POST['dueamount']) && empty($_POST['dueamount']))){
			$error.="Enter Due Amount. <br>";}
			if ((isset($_POST['lab']) && empty($_POST['lab']))){
			$error.="Enter Label. <br>";}
			
		  if ((isset($_POST['remarks']) && empty($_POST['remarks']))){
			$error.="Enter Remarks. <br>";
			}
			
			if ((isset($_POST['due_date']) && empty($_POST['due_date']))){
			$error.="Enter Due Date. <br>";
			 }	
			   $connection = Yii::app()->db;  
				  if(empty($error))

			{
			   $sql="UPDATE installpayment set 
			 dueamount='".$_POST['dueamount']."',
			 lab='".$_POST['lab']."',  
			surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',
			 due_date='".$_POST['due_date']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Updated Successfully';}
				else{
					echo $error;
					}
			  
	
		}
	public function actionChargupdate()
		{
			        $error='';
			if ((isset($_POST['amount']) && empty($_POST['amount']))){
			$error.="Enter Due Amount. <br>";}
			if ((isset($_POST['paidamount']) && empty($_POST['amount']))){
			$error.="Enter Paid Amount. <br>";
			}
			if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))){
			$error.="Please Select Payment Type <br>";
			}		  
			if ((isset($_POST['detail']) && empty($_POST['detail']))){
			$error.="Enter Voucher NO. <br>";
			 }
		  if ((isset($_POST['remarks']) && empty($_POST['remarks']))){
			$error.="Enter Remarks. <br>";
			}
			
			if ((isset($_POST['date']) && empty($_POST['date']))){
			$error.="Enter Paid Date. <br>";
			 }	
			

			   $connection = Yii::app()->db;  
				
			if(empty($error)){
			   $sql="UPDATE plotpayment set 
			 amount='".$_POST['amount']."',
			  paidas='".$_POST['paidas']."',
			 paidsurcharge='".$_POST['paidsurcharge']."',
			 paidamount='".$_POST['paidamount']."',
			 payment_type='".$_POST['payment_type']."',
			 detail='".$_POST['detail']."',
			 surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',
			 date='".$_POST['date']."',
			 duedate='".$_POST['duedate']."',
			  mem_id='".$_POST['mem_id']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Payments Updated Successfully';
			}
			else{
				echo $error;
				}
			  
	
		}
	public function actionChargup()
		{
			        
	
	
	$error='';
			if ((isset($_POST['amount']) && empty($_POST['amount']))){
			$error.="Enter Due Amount. <br>";}
			
			if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))){
			$error.="Please Select Payment Type <br>";
			}		
			if(empty($_POST['duedate'])){
				$error.="Please Enter Due Date";
				}  
		
		
				
			   $connection = Yii::app()->db;  
				
			if(empty($error)){
			   $sql="UPDATE plotpayment set 
			 amount='".$_POST['amount']."',
			 remarks='".$_POST['remarks']."',
			 duedate='".$_POST['duedate']."',
			  mem_id='".$_POST['mem_id']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Payments Updated Successfully';
			}
			else{
				echo $error;
				}
			  
	
		}
	public function actionRequested_detail()
		{
			

	if(Yii::app()->session['user_array']['per2']=='1')

			{

			$connection = Yii::app()->db; 	

		 $sql_details  = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.create_date,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat c on p.size2=c.id
left join user u on mp.user_name=u.id

left join projects j on s.project_id=j.id where mp.status!='Approved' And mp.plot_id=".$_REQUEST['id'];

			$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('requested_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	
		}
	public function actionCancelreq()
		{
			
	
		$connection = Yii::app()->db;
	 
		 $plotid=$_POST['pid'];
   	 
		 $sql="Update plots SET status='' where id='".$plotid."'"; 	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$sql1="DELETE FROM  memberplot where plot_id='".$plotid."'";	
		//$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql1);
        $command -> execute();
		$sql2="DELETE FROM  installpayment where plot_id='".$plotid."'";		
        $command = $connection -> createCommand($sql2);
        $command -> execute();
		$this->redirect(array("plots/plots_lis"));
	
		
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
	
	public function actionAjaxRequest31($val1)
		{
				
		$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from charges where id='".$val1."' ";
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

		$sql_city  = "SELECT * from members where cnic=".$val1." AND status=1";

		$result_city = $connection->createCommand($sql_city)->query();

			

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

		

	echo json_encode($city); exit();

	
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


