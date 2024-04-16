<?php

class MemberplotController extends Controller
{
	
	public function actionCreate()
	{
		if(Yii::app()->session['user_array']['per2']=='1')
			{
		
		$model=new memberplot;
		$error = '';
		if ((isset($_POST['project_id']) && empty($_POST['project_id'])) || (isset($_POST['street_id']) && empty($_POST['street_id'])) || (isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['plot_size']) && empty($_POST['plot_size']))  || (isset($_POST['cnic']) && empty($_POST['cnic'])) )
		{
			$error = 'Please complete all required fields <br />';
		}
		
		
		if(empty($error))
		{
				$model->project_id = mysql_real_escape_string($_POST['project_id']);
				$model->street_id = mysql_real_escape_string($_POST['street_id']);
				$model->plot_id = mysql_real_escape_string($_POST['plot_id']);
				$model->plot_size = mysql_real_escape_string($_POST['plot_size']);
				$model->cnic = mysql_real_escape_string($_POST['cnic']);
				$model->create_date = date('Y-m-d h:i:s');
				try {
						$model->save();
					} catch (Exception $e) {
						echo 'Caught exception: ',  $e->getMessage(), "\n";
					}		
		}else
		{	
			echo json_encode(array($error,$_POST));
		}
		exit;
			}
	 }
	 function actionEdit()
	 {
		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{
			$this->layout='column3';
			$this->render('edit_register');
		}
		 
	}
		public function actionDownload()
{
	$plot_id = $_GET['id'];
	$this->layout='//layouts/back';
	$connection = Yii::app()->db;  
		$sql_member  = "SELECT
    members.id
	, members.name
    , members.sodowo
    , members.cnic
    , members.address
    , members.dob
    , members.email
    , members.phone
    , members.image
    , members.nomineename
	,members.city
	,plots.street_id
	,plots.type
	,plots.plot_size
	,plots.com_res
	,plots.sector
	,plots.size2
	,plots.plot_detail_address
	,memberplot.create_date
	FROM
    memberplot
    LEFT JOIN members 
        ON (memberplot.member_id = members.id ) 
		left join plots on memberplot.plot_id=plots.id
		where memberplot.plot_id=".$plot_id;
		
		$member_result = $connection->createCommand($sql_member)->queryAll();
	 	$this->render('pdf',array('member'=>$member_result)); 
}
	public function actionAlotaplot()
	 	{ 
			if(Yii::app()->session['user_array']['per2']=='1')
			{   
                                    $error =array();
									$error='';
									$connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
									if ((isset($base) && empty($base))){
									 $error.="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }elseif($result_data['status']!=1){
									 $error.='Applicant Containing '.$base.' CNIC is Not Active Register Member.<br>';
									}
									
									if ((isset($_POST['plot_id']) && empty($_POST['plot_id']))){
									 $error.="Plot No Required. <br>";
										 }
								   if ((isset($_POST['downpayment']) && empty($_POST['downpayment']))){
									 $error.="Down Payment required. <br>";
										}
								  
								  if ((isset($_POST['discount']) && empty($_POST['discount']))){
								    $error.="Discount required. <br>";
									}
								  if ((isset($_POST['noi']) && empty($_POST['noi']))){
									 $error.="No.Of Installment required. <br>";
						
								  }
								 if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))){
								 $error.="Payment Type required. <br>";
								 }
								  if ((isset($_POST['plotno']) && empty($_POST['plotno']))){
								 $error.="Plot Membership No required. <br>";
								 
				  		                 }
										 if(empty($error)){
										 $uname=Yii::app()->session['user_array']['username'];
			       
					 $sql  = "INSERT INTO memberplot (plot_id,user_name,member_id,create_date,noi,status,plotno) 
	VALUES ('".$_POST['plot_id']."','".$uname."','".$result_data['id']."','".date('Y-m-d H:i:s')."','".$_POST['noi']."',0,'".$_POST['plotno']."')";		
                     
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
					
		$update  = "UPDATE plots set status= 'Requested' WHERE id='".$_REQUEST['plot_id']."'";		
                     
					   $command = $connection -> createCommand($update);
                        $command -> execute();
						echo 'Plot Success Alloted';
					
					
						  $sql1="INSERT INTO plotpayment SET amount='".$_POST['downpayment']."', discount='".$_POST['discount']."',plot_id='".$_POST['plot_id']."',payment_type='".$_POST['payment_type']."'
						  ,mem_id='".$result_data['id']."',create_date='".date('Y-m-d H:i:s')."' ";	  			
		               $command = $connection -> createCommand($sql1);
                        $command -> execute();
						}
						  else if(!empty($error)){ 

						    echo $error;

             } 
		
					
		}
		
	}
	

	public function actionInstalment()
	{
		if(Yii::app()->session['user_array']['per2']=='1')
			{
		
		$error = '';
		if((isset($_POST['payment-type']) && empty($_POST['payment-type'])) ||(isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['member_id']) && empty($_POST['member_id'])) || (isset($_POST['amount']) && empty($_POST['amount'])) || (isset($_POST['paid-as']) && empty($_POST['paid-as'])) || (isset($_POST['detail']) && empty($_POST['detail'])) || (isset($_POST['date']) && empty($_POST['date'])))
		{
			$error = 'Please complete all required fields <br />';
		}
			if($error==''){
					  // Insert in to member a new member
                                        $connection = Yii::app()->db;  
                                      $connection = Yii::app()->db;  
                                        $sql  = 'INSERT INTO plotpayment  (payment_type, plot_id, mem_id, amount,discount, paidas, detail, surcharge, date, create_date ) VALUES ("'.$_POST['payment_type'].'","'.$_POST['plot_id'].'", "'.$_POST['member_id'].'", "'.$_POST['amount'].'", "'.$_POST['discount'].'",  "'.$_POST['paid-as'].'", "'.$_POST['detail'].'", "'.$_POST['surcharge'].'", "'.$_POST['date'].'", "'.date('Y-m-d h:i:s').'")';		                    $command = $connection -> createCommand($sql);
                                        $command -> execute();
										$this->redirect('memberplot/member_list');
                                        $transferto_memberid=Yii::app()->db->getLastInsertID();						 
					  // $transferto_memberid = 
                                    }else{
										$this->redirect(array('memberplot'=>$error)); 
                                        exit();
					 
                                    }
	
	}
	
	}
	////////////////////////////////////////PLOT CHARGES FUNCTION////////////////////
	public function actioncharge()
	{
		if(Yii::app()->session['user_array']['per2']=='1')
			{
		
		$error = '';
		if((isset($_POST['plot_id']) && empty($_POST['plot_id']))  || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment'])))
		{
			$error = 'Please complete all required fields <br />';
		}
			if($error==''){
					  // Insert in to plot charges table
                                        $connection = Yii::app()->db;  
                                     
                      $sql  = 'INSERT INTO plotcharges  (plot_id,charges_id, comment ) VALUES ("'.$_POST['plot_id'].'","'.$_POST['charges_id'].'", "'.$_POST['comment'].'")';		                      $command = $connection -> createCommand($sql);
                      $command -> execute();
				      $this->redirect('memberplot/member_list');
                        
                       }else{
						$this->redirect(array('memberplot'=>$error)); 
                         exit();
					   }
	
	}
	}
	
	////////////////////////////////////////////////////////////////////////////////
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
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
				
			$sql_charges  = "SELECT * from charges";
			$result_charges = $connection->createCommand($sql_charges)->query();
			
			$this->render('payment',array('projects'=>$result_projects,'pages'=>$result_pages,'charges'=>$result_charges));
			}
	}
	///////////////////////////PLOT CHARGES////////////////////
	
	public function actionPlotcharges()
	{	
			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			$plot_id =$_REQUEST['id'];
			
			$sql_charges  = "SELECT * from charges";
			$result_charges = $connection->createCommand($sql_charges)->query();
			
			$this->render('plotcharges',array('pages'=>$plot_id,'charges'=>$result_charges));
	}
	
	
	
	
	//////////////////////////////////////////////////////////////
	 
	public function actionMemberplot()
	{	
	 if(Yii::app()->session['user_array']['per2']=='1')
			{
	
		$connection = Yii::app()->db;  
		$sql_country  = "SELECT * from tbl_country";
		$result_country = $connection->createCommand($sql_country)->query();
		
		$sql_project  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_project)->query();
		
		$this->render('memberplot',array('projects'=>$result_projects,'country'=>$result_country));
		
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
				
	}
		public function actionAllotplot()
	{	
	 if(Yii::app()->session['user_array']['per2']=='1')
			{
	
		$connection = Yii::app()->db;  
		$sql_country  = "SELECT * from tbl_country";
		$result_country = $connection->createCommand($sql_country)->query();
		
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
	
	
FROM
    plots
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN categories  ON (plots.category_id = categories.id) where type='plot' and plots.id='".$_REQUEST['id']."'";
	//	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";
		$result = $connection->createCommand($sql)->query();
		$this->render('allotplot',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country));
		
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
				
	}
	public function actionMember_list()
	{	
			if(Yii::app()->session['user_array']['per2']=='1')
			{
    
	$connection = Yii::app()->db; 
	$sql_member = "SELECT mp.member_id,mp.create_date, m.name,m.sodowo,m.cnic,p.plot_detail_address,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id where p.type='plot' and mp.status='Approved'";
		$result_members = $connection->createCommand($sql_member)->query();
		$this->render('member_list',array('members'=>$result_members));
			}
			else
			{
			$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard");
			}
	}
	public function actionMember_lis()
	{	
			if ($_POST['name']=="" && $_POST['sodowo']=="" && $_POST['cnic']=="" && $_POST['plot_size']=="" && $_POST['project_name']=="" && $_POST['plot_detail_address']==""){
				$error = "Please Fill Atleast one field";
				$members="";
				$this->render('member_lis',array('error'=>$error,'members'=>$members));
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
			
			
			if ($_POST['plot_size']!=""){
				if ($and==true)
				{
					$where.=" and p.plot_size LIKE '%".$_POST['plot_size']."%'";
				}
				else
				{
					$where.="p.plot_size LIKE '%".$_POST['plot_size']."%'";
				}
				$and==true;
			}
			
			
			if ($_POST['project_name']!=""){
				if($and==true)
				{
					$where.=" and j.project_name LIKE '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.=" j.project_name LIKE '%".$_POST['project_name']."%'";
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
				/*if($where!='')
					$where.=" AND ";
				else $where.=' WHERE ';
				$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";*/
			}
			
		
	$connection = Yii::app()->db; 
	$sql_member = "SELECT mp.member_id,mp.create_date,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
where $where and p.type='plot' and mp.status='Approved' ";
		$result_members = $connection->createCommand($sql_member)->query();
			$this->render('member_lis',array('members'=>$result_members,'error'=>$error));
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
left join projects j on s.project_id=j.id where p.type='file'  and mp.status='Approved'";
		$result_members = $connection->createCommand($sql_member)->query();
		$this->render('member_flist',array('members'=>$result_members));
	}
	}
	public function actionMember_flis()
	{	
	if(Yii::app()->session['user_array']['per2']=='1')
			{
		
			if ($_POST['name']=="" && $_POST['sodowo']=="" && $_POST['cnic']=="" && $_POST['plot_size']=="" && $_POST['project_name']=="" && $_POST['plot_detail_address']==""){
				$error = "Please Fill Atleast one field";
				$members="";
				$this->render('member_flis',array('error'=>$error,'members'=>$members));
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
			
			
			if ($_POST['plot_size']!=""){
				if ($and==true)
				{
					$where.=" and p.plot_size LIKE '%".$_POST['plot_size']."%'";
				}
				else
				{
					$where.="p.plot_size LIKE '%".$_POST['plot_size']."%'";
				}
				$and==true;
			}
			
			
			if ($_POST['project_name']!=""){
				if($and==true)
				{
					$where.=" and j.project_name LIKE '%".$_POST['project_name']."%'";
				}
				else
				{
					$where.=" j.project_name LIKE '%".$_POST['project_name']."%'";
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
				/*if($where!='')
					$where.=" AND ";
				else $where.=' WHERE ';
				$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";*/
			}
			
		
	$connection = Yii::app()->db; 
	$sql_member = "SELECT mp.member_id,mp.create_date,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
where $where and p.type='file'  and mp.status='Approved' ";
		$result_members = $connection->createCommand($sql_member)->query();
			$this->render('member_flis',array('members'=>$result_members,'error'=>$error));
	}
	}
public function actionPayment_details()
	{
		$connection = Yii::app()->db;
		
		$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."'";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
		
		
		
		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc
left join charges c on pc.charges_id=c.id where plot_id='".$_REQUEST['id']."'";
		$res=$connection->createCommand($sql)->queryAll();
		
		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		//$result_charges = $connection->createCommand($sql_charges)->queryAll();
		
		$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
		
	
		$this->render('payment_details',array('payments'=>$result_payments,'info'=>$result_plotinfo,'receivable'=>$res));
		
	}
	public function actionInstallment_details()
	{
		$connection = Yii::app()->db;
		
		$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."' AND payment_type='installment'";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
		
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
		
		$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
		
		$this->render('installment_details',array('payments'=>$result_payments,'charges'=>$result_charges,'info'=>$result_plotinfo));
		
	}
	
	public function actionMemberplot_list()
	{	
	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per2']=='1')
			{
	$connection = Yii::app()->db; 
	$sql_member = "SELECT mp.member_id,mp.id,mp.create_date,p.status,p.type, m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on m.id=mp.member_id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id where p.type='plot' and mp.status='0' ";
		$memberplot_list = $connection->createCommand($sql_member)->query();
		$this->render('memberplot_list',array('memberplot_list'=>$memberplot_list));
		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
				
	}
	/////////////////////////////SEARCH MEMBERPLOT BY APP NO, BY MEM ID, BY STATUS, BY DATE//////////////////
	
	
	
	public function actionMemberplot_search_lis()
	{	
	if(Yii::app()->session['user_array']['per2']=='1')
			{
		
	
			$and = false;
			$where='';
			
			
			
	    // echo   $qry="Select * from memberplot where create_date BETWEEN '".$_POST['fromdate']."'  AND  '".$_POST['todate']."'  ";
			//exit;		
			$from=$_POST['fromdate'];
			$to=$_POST['todate'];
			
			if (($_POST['fromdate']!="") && ($_POST['todate']!="")) {
				if ($and==true)
				{
				$where.="and mp.create_date BETWEEN '".$from."' AND '".$to."' ";
				}else{$where.="mp.create_date BETWEEN '".$from."' AND '".$to."' ";}
			$and=true;
			}
			
			if ($_POST['appno']!=""){
				if ($and==true)
				{
				$where.="and mp.id LIKE '%".$_POST['appno']."%'";
				}else{
				$where.=" mp.id LIKE '%".$_POST['appno']."%'";
				}
			$and=true;	
			}
			
			if ($_POST['mid']!=""){
				if ($and==true)
				{
					$where.=" and mp.member_id LIKE '%".$_POST['mid']."%'";
				}
				else
				{
					$where.=" mp.member_id LIKE '%".$_POST['mid']."%'";
				}
				$and=true;
			}
			
			
			if ($_POST['status']!=""){
				if ($and==true)
				{
					$where.=" and mp.status LIKE '%".$_POST['status']."%'";
				}
				else
				{
					$where.=" mp.status LIKE '%".$_POST['status']."%'";
				}
				$and=true;
			}
		
	$connection = Yii::app()->db; 
	$sql_member = "SELECT mp.id,mp.member_id,mp.create_date,p.id, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
where $where  and p.type='plot'";


		$result_members = $connection->createCommand($sql_member)->query();
			$this->render('Memberplot_list',array('memberplot_list'=>$result_members));
	}
	
	
	}
	
	////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////REQUEST DETAIL///////////////
	
	
	
	public function actionReq_detail()
	 {
	if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db; 	
		 $sql_details  = "SELECT mp.member_id,mp.noi,mp.id,mp.create_date,m.mem_id,m.id, p.size2,m.name,m.sodowo,m.email,m.cnic,p.price,p.com_res,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id where mp.id=".$_REQUEST['id'];
			$result_details = $connection->createCommand($sql_details)->query();
			
			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryRow();
			$this->render('req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 
			}else{$this->redirect(array("dashboard"));}
	}
	
	
	
	//////////////////////////////////////////
	
	////////////////////SUBMIT STATUS///////
	
	public function actionSubmitstatus()
	{
	if($_POST['statusapp']=='approved')
		{
		$connection = Yii::app()->db;
	
	 	$memberid=$_POST['member_id'];
		$plotid=$_POST['plot_id'];
   	    $status=$_POST['status'];
		

		$sql="Update plots SET status='Alotted' where id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		
		$sql="Update memberplot SET status='Approved' where plot_id='".$plotid."'";	
		//$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";	
		
        $command = $connection -> createCommand($sql);
        $command -> execute();
		
		$this->redirect(array("memberplot/memberplot_list"));
		} 
		if($_POST['statusapp']=='rejected')
		{
			
			$this->redirect(array("memberplot/memberplot_list"));
			
		}
		}
	//////////////////////////////////////////
	
	
	public function actionAjaxRequest($val1)
	{	
	$connection = Yii::app()->db;  
		$sql_street  = "SELECT * from streets where project_id='".$val1."'";
		$result_streets = $connection->createCommand($sql_street)->query();
			
		$street=array();
		foreach($result_streets as $str){
			$street[]=$str;
			} 
		
	echo json_encode($street); exit();
	}
	
	
	
	public function actionAjaxRequest1($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from plots where street_id='".$val1."' and type='plot' and status=''";
		$result_plots = $connection->createCommand($sql_plot)->query();
			
		$plot=array();
		foreach($result_plots as $plo){
			$plot[]=$plo;
			} 
		
	echo json_encode($plot); exit();
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
