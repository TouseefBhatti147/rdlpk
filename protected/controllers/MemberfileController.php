<?php

class MemberfileController extends Controller

{

	
	
	public function actionAjaxRequest123($val1)
	{	
		$connection = Yii::app()->db;  
		 $sql_city  = "SELECT * from size_cat where typee='".$val1."'";
		$result_city = $connection->createCommand($sql_city)->query();
		$city=array();
		foreach($result_city as $cit){
			$city[]=$cit;
			} 
	echo json_encode($city); exit();
	}


	public function actionUpdatemem_plot()



	 	{ 

			if(Yii::app()->session['user_array']['per2']=='1')

			{   

					$error='';



                                    $error =array();



									$connection = Yii::app()->db;  

									

								  if ((isset($_POST['plotno']) && empty($_POST['plotno']))){



								 $error="Plot Membership No required. <br>";



								 }

								

								 	$pn=$_POST['plotno'];

									if(!empty($pn)){

									 $q ="SELECT * from memberplot where plotno='".$pn."'"; 

									  

									  $result_q = $connection->createCommand($q)->queryRow();

									if ($result_q['plotno']==$pn){

									 $error ="Membership # Already Added Try Another. <br>";

									}}

										 if(empty($error)){

										

		

				 $sql  = "Update memberplot set plotno='".$pn."' where plot_id='".$_POST['plot_id']."'";	

					 

					   $command = $connection -> createCommand($sql);

                        $command -> execute();

		             

					 

					 echo'Membership No. Updated Successfully';

					 } else{

						 

						 echo $error;

						 }



		

			}

		



	}

	////////////////////TRANSFER DETAIL//////////////
		public function actionTreq_detail()
	{
		if(isset(Yii::app()->session['user_array']))
			{
			$connection = Yii::app()->db; 	
			 $sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,sc.size,mp.comment,se.sector_name,pro.project_name,m_from.name from_name,m_to.name to_name 
			,m_to.cnic,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.state
			FROM transferplot tp
Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN memberplot mp ON p.id=mp.plot_id
			left join user u on tp.uid=u.id
			Left JOIN projects pro ON pro.id=p.project_id where tp.plot_id=".$_REQUEST['id']."";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('treq_detail',array('plotdetails'=>$result_details)); 
			}else{$this->redirect(Yii::app()->baseUrl.'/index.php/user/dashboard');}



	}
	public function actionTransfer_detail()

	 {

	if(Yii::app()->session['user_array']['per2']=='1')

			{

			$connection = Yii::app()->db; 	

		 $sql_details  = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.create_date,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.type,mp.insplan,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat c on p.size2=c.id
left join user u on mp.user_name=u.id

left join projects j on s.project_id=j.id where mp.plot_id=".$_REQUEST['id'];

			$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('transfer_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	}
	public function actionCrequest()
	 	{
			
		    $error =''; 
	   
									  $connection = Yii::app()->db;  
									 
									    $sql1="UPDATE plots set status='Allotted' WHERE id='".$_REQUEST['pid']."' ";	
        		   					 $command = $connection -> createCommand($sql1);
                      				 $command -> execute();
	            					    $sql="DELETE FROM transferplot WHERE plot_id='".$_REQUEST['pid']."'  ";	 
        		   					 
									 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
									 	
									$this->redirect(Yii::app()->baseUrl.'/index.php/files/files_lis'); 
	
			}
public function actionTimage(){
		
		 $connection = Yii::app()->db;  
  
				 $path="images/imagetransfer/";
				 $image=$_FILES['image']["name"];
				$newfilename = $_POST['plot_id'].$_FILES["image"]["name"];
				
				move_uploaded_file($_FILES["image"]["tmp_name"],
				$path.$newfilename);
				 $sql="UPDATE transferplot SET image='".$newfilename."' WHERE plot_id='".$_POST['plot_id']."'";
					$command = $connection -> createCommand($sql);
	               $command -> execute();
					$this->redirect(Yii::app()->baseUrl.'/index.php//memberfile/treq_detail?id='.$_POST['plot_id'].''); 
		
		}

		public function actionUpdatemember_plot()



	{	



	 if(Yii::app()->session['user_array']['per2']=='1')



			{



	



		$connection = Yii::app()->db;  



		$sql_country  = "SELECT * from tbl_country";



		$result_country = $connection->createCommand($sql_country)->query();



		

		$sql_plan  = "SELECT * from installment_plan";

		$result_plan = $connection->createCommand($sql_plan)->query();



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

	, memberplot.noi

, memberplot.insplan



    , projects.project_name



	, categories.name



	, streets.street

    , members.cnic

	

	



	



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)




	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)

    Left JOIN members ON (member_id = members.id)



	Left JOIN categories  ON (plots.category_id = categories.id) where type='plot' and plots.id='".$_REQUEST['id']."'";



	//	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";



		$result = $connection->createCommand($sql)->query();



		$this->render('updatemember_plot',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));



		



			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



				



	}

	

	

	

	//////////////////////////////////////////



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

$sqln="DELETE FROM  plotpayment where plot_id='".$plotid."'";		

        $command = $connection -> createCommand($sqln);

        $command -> execute();


		$this->redirect(array("files/files_lis"));

	

		}



	public function actionAjaxRequest7($pro,$size)



	{	



		$connection = Yii::app()->db;  



		$sql_plot  = "SELECT * from installment_plan where project_id='".$pro."' and category_id='".$size."'";



		$result_plots = $connection->createCommand($sql_plot)->query();



			



		$plot=array();



		foreach($result_plots as $plo){



			$plot[]=$plo;



			} 



		



	echo json_encode($plot); exit();



	}



public function actionRequested_detail()



	 {



	if(Yii::app()->session['user_array']['per2']=='1')



			{



			$connection = Yii::app()->db; 	



		 $sql_details  = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.insplan,mp.noi,mp.id,mp.create_date,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.status,p.type,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp

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



	



	public function actionCreate()







	{







		







		$model=new memberfile;







		$error = '';







		







		if ((isset($_POST['project_id']) && empty($_POST['project_id'])) || (isset($_POST['street_id']) && empty($_POST['street_id'])) || (isset($_POST['file_id']) && empty($_POST['file_id'])) || (isset($_POST['file_size']) && empty($_POST['file_size'])) || (isset($_POST['usename']) && empty($_POST['username'])) || (isset($_POST['address']) && empty($_POST['address'])) || (isset($_POST['sodowo']) && empty($_POST['sodowo'])) || (isset($_POST['cnic']) && empty($_POST['cnic'])) || (isset($_POST['mobile']) && empty($_POST['mobile'])) || (isset($_POST['mem_code']) && empty($_POST['mem_code'])))







		{







			$error = 'Please complete all required fields <br />';







		}







		







		







		if(empty($error))







		{







				$model->project_id = mysql_real_escape_string($_POST['project_id']);







				$model->street_id = mysql_real_escape_string($_POST['street_id']);







				$model->file_id = mysql_real_escape_string($_POST['file_id']);







				$model->file_size = mysql_real_escape_string($_POST['file_size']);







				$model->username = mysql_real_escape_string($_POST['username']);







				$model->address = mysql_real_escape_string($_POST['address']);







				$model->cnic = mysql_real_escape_string($_POST['cnic']);







				$model->sodowo = mysql_real_escape_string($_POST['sodowo']);







				$model->mobile = mysql_real_escape_string($_POST['mobile']);







				$model->mem_code = mysql_real_escape_string($_POST['mem_code']);







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







	 function actionEdit()







	 {







		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))







		{







			$this->layout='column3';







			$this->render('edit_register');







		}







		 







	}







	







		public function actionAlotfile()







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
	Left JOIN categories  ON (plots.category_id = categories.id) where type='file' and plots.id='".$_REQUEST['id']."'";
	//	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";
	$result = $connection->createCommand($sql)->query();

	$sql_plotss = "SELECT * from plots where id='".$_REQUEST['id']."'";
	$result_plotss = $connection->createCommand($sql_plotss)->queryRow();

	$sql_plan  = "SELECT * from installment_plan where project_id='".$_REQUEST['pro']."' and category_id='".$result_plotss['size2']."'";
	$result_plan = $connection->createCommand($sql_plan)->query();




		$this->render('allotfile',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));







		







			}







			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }







				







	}







	public function actionInstalment()







	{







		







		if(Yii::app()->session['user_array']['per2']=='1')







			{







		







		$error = '';







		if((isset($_POST['payment_type']) && empty($_POST['payment_type'])) ||(isset($_POST['file_id']) && empty($_POST['file_id'])) || (isset($_POST['member_id']) && empty($_POST['member_id'])) || (isset($_POST['amount']) && empty($_POST['amount'])) || (isset($_POST['paid-as']) && empty($_POST['paid-as'])) || (isset($_POST['detail']) && empty($_POST['detail'])) || (isset($_POST['date']) && empty($_POST['date'])))







		{







			$error = 'Please complete all required fields <br />';







		}



		



			if($error==''){







					  // Insert in to member a new member







                                        $connection = Yii::app()->db;  







                                        $sql  = 'INSERT INTO filepayment  (payment_type, file_id, mem_id, amount,discount, paidas, detail, surcharge, date, create_date ) VALUES ("'.$_POST['payment_type'].'","'.$_POST['file_id'].'", "'.$_POST['member_id'].'", "'.$_POST['amount'].'", "'.$_POST['discount'].'", "'.$_POST['paid-as'].'", "'.$_POST['detail'].'", "'.$_POST['surcharge'].'", "'.$_POST['date'].'", "'.date('Y-m-d h:i:s').'")';		                    $command = $connection -> createCommand($sql);







                                        $command -> execute();







										$this->redirect('memberfile/member_list');







                                        $transferto_memberid=Yii::app()->db->getLastInsertID();						 







					  // $transferto_memberid = 







                                    }else{







										$this->redirect(array('memberfile'=>$error)); 







                                        exit();







					 







                                    }







	







	}







	}







	







	







									public function actionAlotafile()
									{
										//echo $_POST['file_id'].'123';exit;
									if(Yii::app()->session['user_array']['per2']=='1')
									{    
									$error =array();
									$error='';
									$connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
$sql12 ="SELECT * from plots where id='".$_POST['file_id']."'"; 
									  $result_data12 = $connection->createCommand($sql12)->queryRow();
if($result_data12['status']=='Requested' or $result_data12['status']=='Alotted' ){
$error.='File Already Proceeded<br>';}									
if ((isset($base) && empty($base))){
									 $error.="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }elseif($result_data['status']!=1){
									 $error.='Applicant Containing '.$base.' CNIC is Not Active Register Member.<br>';
									}
									 if ((isset($_POST['project']) && empty($_POST['project']))){
								    	 $error.="Please Select Project. <br>";
										 }
										 if ((isset($_POST['street_id']) && empty($_POST['street_id']))){
									 $error.="Please Select Street <br>";
										 }
									if ((isset($_POST['file_id']) && empty($_POST['file_id']))){
									 $error.="File No Required. <br>";
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
								
								  if ((isset($_POST['plotno']) && empty($_POST['plotno']))){
								 $error.="File Membership No required. <br>";
								 }
								     $plotq ="SELECT * from plots where id='".$_POST['file_id']."'"; 
								 $plotr = $connection->createCommand($plotq)->queryRow();
								 $projectq ="SELECT * from projects where id='".$_POST['project']."'"; 
								 $projectr = $connection->createCommand($projectq)->queryRow();
								 $sizeq ="SELECT * from size_cat where id='".$plotr['size2']."'"; 
								 $sizer = $connection->createCommand($sizeq)->queryRow();
								 $typecode='';
								 if($plotr['com_res']=='Commercial'){$typecode='C';}else{$typecode='R';}
								 $pn=$projectr['code'].'-'.$_POST['plotno'].'-'.$typecode.$sizer['code'];

									if(!empty($pn)){
									$q ="SELECT plotno from memberplot where plotno='".$pn."'"; 
									  $result_q = $connection->createCommand($q)->queryRow();
									if ($result_q['plotno']==$pn){
									 $error .="Membership # Already Added Try Another. <br>";
									}}
									 $q ="SELECT * from memberplot left join plots on plots.id=memberplot.plot_id where memberplot.app_no='".$_POST['appnoo']."' and plots.project_id='".$_POST['project']."'"; 
									$result_q = $connection->createCommand($q)->queryRow();
									if (!empty($result_q)){
									$error.="Application # Already Added Try Another. <br>";
									}
						   if(empty($error)){
							  
						 $uname=Yii::app()->session['user_array']['username'];
					$sql  = "INSERT INTO memberplot (plot_id,user_name,member_id,lo_id,create_date,noi,insplan,status,plotno) 
	VALUES ('".$_POST['file_id']."','".$uname."','".$result_data['id']."','".$_POST['landowner']."','".date('Y-m-d H:i:s')."','".$_POST['noi']."','".$_POST['insplan']."','New','".$pn."')";		
        		        $command = $connection -> createCommand($sql);
                        $command -> execute();
						$insert_id = Yii::app()->db->getLastInsertID();
			
			$discount  = "INSERT INTO discnt (ms_id,status,details,discount)VALUES ('".$insert_id."','New','".$_POST['discd']."','".$_POST['disc']."')";		
  			$command = $connection -> createCommand($discount);
            $command -> execute();
			$sql_cat12  = "SELECT * from charges where name LIKE '%MS Fee%'";
       		 $result_cat12 = $connection->createCommand($sql_cat12)->queryRow();
			 if($result_cat12!==''){
			 $sqlchargesm="INSERT INTO plotpayment SET payment_type='Registration Charges',amount='".$result_cat12['total']."', duedate='".$_POST['date']."', plot_id='".$_POST['file_id']."',mem_id='".$result_data['id']."'";							
   		               $command = $connection -> createCommand($sqlchargesm);
                        $command -> execute();}
		
				
						 $update  = "UPDATE plots set status='Requested', atype='".$_POST['atype']."'  WHERE id='".$_POST['file_id']."'";		
					   $command = $connection -> createCommand($update);
                        $command -> execute();
						 $sqlinstalplan ="SELECT * from installment_plan where id='".$_POST['insplan']."'"; 
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
						 $sqlinstall="INSERT INTO installpayment SET lab='".$dataplan['lab'.$lab.'']."',dueamount='".$dataplan[''.$instalno.'']."', due_date='".$create."', plot_id='".$_POST['file_id']."',mem_id='".$result_data['id']."'"; 
						$next_due_date = strtotime($create.' + '.$tno.' Months');
						$create=date('d-m-Y', $next_due_date);			
   		               $command = $connection -> createCommand($sqlinstall);
                        $command -> execute();
						$insert++;
						
						}while($insert<$insplan);
						
					echo 'File Allotment Request Sent For Verification';

exit;

					//	$this->redirect(array('memberfile/memberfile')); 	







						  }



						  else if(!empty($error)){ 







						    echo $error;







                                   } 







      



	   }



	   }








			















public function actionMemberfile_list()

	{	

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per6']=='1')

			{

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.id,p.size2,mp.fstatus,mp.plot_id,mp.plotno,mp.create_date,p.type,p.status, m.name,siz.size,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join size_cat siz on p.size2=siz.id

left join projects j on s.project_id=j.id where p.type='file' and mp.fstatus='approved' and mp.status='new' and mp.fstatus='Approved' ";

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

		$this->render('memberfile_list',array('memberfile_list'=>$memberplot_list,'projects'=>$result_projects));

		}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



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







	







	/////////////////////////////SEARCH MEMBERPLOT BY APP NO, BY MEM ID, BY STATUS, BY DATE//////////////////







	







	







	







	public function actionMemberfile_search_lis()







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







				$and=true;







			}



	$connection = Yii::app()->db; 







 	$sql_member = "SELECT mp.id,mp.member_id,mp.plotno,siz.size,mp.plot_id,mp.create_date,p.id,m.username, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp







left join members m on mp.member_id=m.id







left join plots p on mp.plot_id=p.id





left join size_cat siz on p.size2=siz.id

left join streets s on p.street_id=s.id







left join projects j on s.project_id=j.id 







where ".$where." AND p.type='file' and mp.fstatus='approved' and mp.status='new' and mp.fstatus='Approved' ";







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











		















			$this->render('memberfile_list',array('memberfile_list'=>$result_members,'projects'=>$result_projects));







	}







	}







	







	







	







	////////////////////////////////////////////////////////////////////////////////////







	







	







	







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







			 $this->redirect(array('memberfile'));







		}else







		{







			$error = '';







			$layout='//layouts/column1';







			/*$dataProvider=new CActiveDataProvider('User');*/







			$this->render('index');







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







			/*echo "<pre>";







			print_r($dataset);







			exit;*/







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







								$entity_dataset[] =  array('key' => $entities->disambiguated_name,'values' => array(array( time() * 1000, 0),







								array(( strtotime( $data->publishedDate ) ) * 1000  , round((( $entities->doccount )),2))));







																						







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







	







	







	public function actionSearch_memberfile()







	{	







	







		if(Yii::app()->session['user_array']['per2']=='1')







			{







		







	$connection = Yii::app()->db;  







		$sql_project  = "SELECT * from projects";







		$result_projects = $connection->createCommand($sql_project)->query();







			$this->render('search_memberfile',array('projects'=>$result_projects));







	}







	}







	public function actionPayment()







	{	







		if(Yii::app()->session['user_array']['per5']=='1')







			{







		







			$this->layout='//layouts/back';







			$connection = Yii::app()->db;







			$sql_projects  = "SELECT * from filehistory where transferfrom_id='".$_REQUEST['id']."'";







			$result_projects = $connection->createCommand($sql_projects)->query();







			







			$sql_page  = "SELECT mp.member_id,mp.create_date, m.name,m.username,m.sodowo,m.cnic, m.address,p.id   file_id,p.file_detail_address,p.file_size,s.street, j.project_name FROM memberfile mp left join members m on mp.member_id=m.id left join file p on mp.file_id=p.id







left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id WHERE file_id ='".$_REQUEST['id']."'";







			$result_pages = $connection->createCommand($sql_page)->query();







			







			







			







			$sql_charges  = "SELECT * from charges";







			$result_charges = $connection->createCommand($sql_charges)->query();







			







			$this->render('payment',array('projects'=>$result_projects,'pages'=>$result_pages,'charges'=>$result_charges));







	}







		/////////////////////////////REQUEST DETAIL///////////////







	







	}







	







	public function actionReq_detail()







	 {







	if(Yii::app()->session['user_array']['per2']=='1')







			{







			$connection = Yii::app()->db; 	



$sql_details  = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.create_date,mp.fcomment,mp.fstatus,mp.insplan,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp



left join members m on mp.member_id=m.id



left join plots p on mp.plot_id=p.id



left join streets s on p.street_id=s.id



left join size_cat c on p.size2=c.id



left join user u on mp.user_name=u.id







left join projects j on s.project_id=j.id where mp.plot_id=".$_REQUEST['plot_id'];



			$result_details = $connection->createCommand($sql_details)->query();







			







			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['plot_id']."'";







			$result_payments = $connection->createCommand($sql_payment)->queryRow();







			$this->render('req_detail',array('filedetails'=>$result_details, 'filepayments'=>$result_payments)); 







			}else{$this->redirect(array("dashboard"));}







	}

public function actionMemberfile()
	{	
	if(!empty(Yii::app()->session['user_array']) && Yii::app()->session['user_array']['per2']=='1')

			{

	    $connection = Yii::app()->db;  
        	$sqllo="Select * from tbl_landowner where status=1";
		$reslo=$connection->CreateCommand($sqllo)->query() ;  
		
		$sql_country  = "SELECT * from tbl_country";

		$result_country = $connection->createCommand($sql_country)->query();

		$sql_plan = "SELECT * FROM installment_plan	";
		$result_plan = $connection->createCommand($sql_plan)->query();
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
		$this->render('memberfile',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan,'landowner'=>$reslo));
			}

			else{







				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 







			}







	}















		public function actionMember_list()







	{	







	







		if(Yii::app()->session['user_array']['per2']=='1')







			{







		







	$connection = Yii::app()->db; 







	$sql_member = "SELECT mp.member_id,mp.create_date, m.name,m.sodowo,m.cnic,p.file_detail_address,p.file_size,s.street, j.project_name FROM memberfile mp







left join members m on mp.member_id=m.id







 left join file p on mp.file_id=p.id







left join streets s on p.street_id=s.id







left join projects j on s.project_id=j.id";







	$result_members = $connection->createCommand($sql_member)->query();







	$this->render('member_list',array('members'=>$result_members));







	}







	}







	public function actionMember_lis()







	{	







		if(Yii::app()->session['user_array']['per2']=='1')







			{







		







			$where='';







			if ($_POST['name']!=""){







				$where.="WHERE m.name LIKE '%".$_POST['name']."%'";







			}







			if ($_POST['sodowo']!=""){







				$where.="WHERE m.sodowo LIKE '%".$_POST['sodowo']."%'";







			}







			if ($_POST['cnic']!=""){







				$where.="WHERE m.cnic LIKE '%".$_POST['cnic']."%'";







			}







			if ($_POST['file_size']!=""){







				$where.="WHERE p.file_size LIKE '%".$_POST['file_size']."%'";







			}







			if ($_POST['project_name']!=""){







				$where.="WHERE j.project_name LIKE '%".$_POST['project_name']."%'";







			}







			if ($_POST['file_detail_address']!=""){







				if($where!='')







					$where.=" AND ";







				else $where.=' WHERE ';







				$where.="p.file_detail_address LIKE '%".$_POST['file_detail_address']."%'";







			}







			







		







	$connection = Yii::app()->db; 







	$sql_member = "SELECT mp.member_id,mp.create_date,p.id, m.name,m.image,m.sodowo,m.cnic,p.file_detail_address, 					p.file_size,s.street, j.project_name FROM memberfile mp







left join members m on mp.member_id=m.id







left join file p on mp.file_id=p.id







left join streets s on p.street_id=s.id







left join projects j on s.project_id=j.id 







$where ";







		$result_members = $connection->createCommand($sql_member)->query();







		$this->render('member_lis',array('members'=>$result_members));







	}







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



	public function actionAjaxRequest($sec,$pro)



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
public function actionAjaxRequestlo($val1)
	{	
		$connection = Yii::app()->db;  
		$sql_city  = "SELECT lo.name,lo.id as lid FROM `tbl_landowner` lo
			LEFT JOIN project_perm_lo perm ON lo.id=perm.lo_id
				WHERE perm.project_id= '".$val1."'";
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







		$sql_plot  = "SELECT * from plots where street_id='".$_POST['street']."' and project_id='".$_POST['pro']."' and size2='".$_POST['size']."' and type='file' and status=''" ;







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







		$sql_city  = "SELECT * from members where cnic=".$val1."";







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



public function actionSubmitstatus()

        {
      if(isset($_POST['statusapp']) || $_POST['statusapp']=='Approved')
		{
		$connection = Yii::app()->db;
//$memberid=$_POST['member_id'];
		$fileid=$_POST['file_id'];
   	    $status=$_POST['status'];
		 $sql="Update plots SET status='Alotted' where id='".$fileid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$sql="Update memberplot SET status='Approved' where plot_id='".$fileid."'";
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$this->redirect(array("memberfile/memberfile_list"));
		} 
			if($_POST['statusapp']=='pending')
		{
			
		$connection = Yii::app()->db;
		$plotid=$_POST['plot_id'];

    	$sql="Update memberplot SET fstatus='".$_POST['statusapp']."', fcomment='".$_POST['cmnt']."' where plot_id='".$plotid."'";	

        $command = $connection -> createCommand($sql);
        $command -> execute();
			$this->redirect(array("memberplot/memberfile_list"));

		}
	/*	if(isset($_POST['statusapp']) || $_POST['statusapp']=='Rejected')
		{  
			$connection = Yii::app()->db;
		$plotid=$_POST['plot_id'];
			//echo $sqlup="Update plots SET status='' where id='".$plotid."'";	
          $sqlup="UPDATE plots set status='' WHERE id='".$plotid."'"; 
		$command = $connection -> createCommand($sqlup);
        $command -> execute();
		$sqldel="DELETE FROM memberplot WHERE plot_id='".$plotid."'  ";
		$command = $connection -> createCommand($sqldel);
        $command -> execute();
      $sql2="DELETE FROM  installpayment where plot_id='".$plotid."'";		
        $command = $connection -> createCommand($sql2);
        $command -> execute();
		$this->redirect(array("memberfile/memberfile_list"));			
		}else{echo 'Please submit again';exit;}*/

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