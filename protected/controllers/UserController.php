<?php







class UserController extends Controller



{
    
   		/////////////////Start:Show User Password////
	public function actionShowpass()
	     {
		 if(Yii::app()->session['user_array']['username'])
			{
			$connection = Yii::app()->db; 	
			$session=Yii::app()->session['user_array']['id'];
			$sql_details  = "SELECT * from user where id='".$_GET['id']."'";	
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('showpass',array('user_detail'=>$result_details));
			}

			else{
				$this->redirect('dashboard');
			}

	   }

	/////////////////END:Show user Password////////////////////////
	public function actionSearchuser()
	     {
	    $where="(role_id=0 || role_id=1)";
			$and=true;
		if (!empty($_POST['username'])){
				$where.="And username LIKE '%".$_POST['username']."%'";
				$and = true;
			}
		  if (isset($_POST['status']) && $_POST['status']!=""){
			  if($_POST['status']==3){
				  $where="role_type=0 || role_type=1";
				  }else{

				$where.=" and status=".$_POST['status'];

				$and = true;
				  }
				//$com_res=$_POST['com_res'];

			}
		   
				
				$and=true;
			
		$connection = Yii::app()->db; 
        $sql_member = "SELECT * from user where $where";
		$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 
        $check=1;
        $res=array();
	 foreach($result_members as $key){
		 $date = date("d-m-Y", strtotime($key['create_date']));
		 //$date="Date_Format(( '".$key['create_date']."', '%Y-%m-%d' ) ,'%d-%m-%Y' )";
		echo '<tr><td>'.$key['id'].'</td><td><img   src="'.Yii::app()->request->baseUrl.'/images/user/'.$key['pic'].'" /></td><td>'.$key['firstname'].'</td><td>'.$key['middelname'].'</td><td>'.$key['lastname'].'</td><td>'.$key['username'].'</td><td>'.$key['sodowo'].'</td>
		<td>';if($key['status']==1){ echo'Active';}else{ echo'Inactive';}echo'</td><td>'.$date.'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/user/update_user?id='.$key['id'].'">Update</a>/<a href="'.Yii::app()->request->baseUrl.'/index.php/user/delete_user?id='.$key['id'].'"> Delete</a>/
		';
		if(Yii::app()->session['user_array']['per1']=='1')
			{
		echo'<a href="'.Yii::app()->request->baseUrl.'/index.php/user/showpass?id='.$key['id'].'"> Show Password</a>';
			}
			echo'</td></tr>';
	
            }
		

//echo '<tr  ><td colspan="7"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
//	echo '<tr></tr>'; exit; 

	
	
	
			}
	   }





	public function actionUser_list1()
	     {
		 if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "select * from members where status='1'";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('user_list1',array('membershiprequest'=>$result_details));
			}else{



				$this->redirect(array("dashboard"));



				}


	   }

	//////////////////////////////ACTIVE MEMBERS DIRECTORY/////////////////////

	public function actionActive_lis()
	{	
	
		 
	if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username'])){
			
			
	
			$this->render('active_lis');
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
	public function actionSearchactive()
	 	{
	
		$connection = Yii::app()->db; 	
	       $where="status ='1'";
		$and=true;
				
			
			
			
			if (!empty($_POST['username'])){
				$where.="And u.username LIKE '%".$_POST['username']."%'";
				$and = true;
			}
			if (!empty($_POST['cnic'])){
				if ($and==true)
				{
					$where.=" and cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" cnic = '".$_POST['cnic']."'";
				}
				$and=true;
			}

			
	
	$connection = Yii::app()->db; 
       $sql_member = "SELECT count(u.id) as uid,u.firstname,u.middelname,u.lastname,u.status, u.cnic, u.mobile, u.email, u.username,MAX(ul.date_time) as last_login FROM user u 
	 LEFT JOIN users_log ul ON u.id = ul.user_id where $where and ul.date_time IS NOT NULL   GROUP BY u.firstname "; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$i=0;
$total=0;
    $res=array();

            foreach($result_members as $key){
				$i++;
             $date = date("d-m-Y H:i:s ", strtotime($key['last_login']));
			 echo '<tr><td>'.$i.'</td><td>'.$key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp;'.$key['lastname'].'</td><td>'.$key['cnic'].'</td><td>'.$key['mobile'].'</td><td>'.$key['email'].'</td><td>'.$key['username'].'</td><td>'.$date.'</td><td><strong>'.$key['uid'].' &nbsp;Time<strong></td></tr>';
			
		
			}
			
			
	}
	}

	//////////////////////////////////////////////////////////////////////////// 
    
    
    
	public function actionMeminfo()
	{	
				if(isset(Yii::app()->session['user_array']['username']))
{

			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			
			$sql_mem  = "SELECT * from members where id='".$_REQUEST['id']."'";
			$result_mems = $connection->createCommand($sql_mem)->query();
		    $this->render('meminfo',array('member'=>$result_mems));
}else{
    $this->redirect('dashboard');
    
}
	}

public function actionDocs()
	{
		if(Yii::app()->session['user_array']['per6']=='1' && isset(Yii::app()->session['user_array']['username']))
			{
	$this->layout='//layouts/back';
	$this->render('doc');

			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	
    public function actionChange_password()

	{       

			   $connection = Yii::app()->db;  
			$password=$_POST['password'];
							$options = [
					'cost' => 12,
				];
			 $password=password_hash($_POST['password'], PASSWORD_BCRYPT, $options);			
			   //generating double encryption for 
               
				
                $password_e = base64_encode($_POST['password']);
				$salt="royalorchard";
				
                $str = substr($salt,5,7);
               
                $password_e = $str.$password_e;           
                $password_e = base64_encode($password_e);

                $skey = $password_e;
	//	$password=$_POST['password'];
		$address=$_POST['address'];
		$mobile=$_POST['mobile'];
		$city=$_POST['city'];
		$country=$_POST['country'];
		$connection = Yii::app()->db;  
			
			  $sql="UPDATE user set password1='".$password."',skey='".$skey."',address='".strip_tags($address)."',mobile='".$mobile."',city='".$city."',country='".$country."' where id='".$_POST['id']."' ";

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
		  if(Yii::app()->session['user_array']['per3']=='1')
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
	if(Yii::app()->session['user_array']['per3']=='1')
			{
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
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
			$this->redirect (array('user/user'));
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

	







	/**



	 * Creates a new model.



	 * If creation is successful, the browser will be redirected to the 'view' page.



	 */







	 



	public function actionCreate()



	{



		$model=new User;



		$error = '';



		



		if((isset($_POST['firstname']) && empty($_POST['firstname'])) || (isset($_POST['middelname']) && empty($_POST['middelname'])) || (isset($_POST['lastname']) && empty($_POST['lastname'])) || (isset($_POST['sodowo']) && empty($_POST['sodowo'])) || (isset($_POST['cnic']) && empty($_POST['cnic'])) || (isset($_POST['address']) && empty($_POST['address'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['city']) && empty($_POST['city'])) || (isset($_POST['state']) && empty($_POST['state'])) || (isset($_POST['zip']) && empty($_POST['zip'])) || (isset($_POST['country']) && empty($_POST['country'])) || (isset($_POST['name']) && empty($_POST['password'])) || (isset($_POST['password']) && empty($_POST['password'])) || (isset($_POST['confirm_password']) && empty($_POST['confirm_password'])))



		{



			$error = 'Please complete all required fields <br />';



		}



	



		



		if(isset($_POST['email']) && !empty($_POST['email']) &&  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 



			$error .= 'Please enter valid Email Address<br>';



		}



		if( !empty($_POST['password']) && !empty($_POST['confirm_password']) && ($_POST['password'] != $_POST['confirm_password']) )



		{



			$error .= 'The Password did not match<br>';



		}



		



		$connection = Yii::app()->db;  



		$sql_username  = "SELECT * FROM user where username ='".$_POST['email']."'";



		$result_username = $connection->createCommand($sql_username)->queryRow();



		



		



		$sql_email  = "SELECT * FROM user where email ='".$_POST['email']."'";



		$result_email = $connection->createCommand($sql_email)->queryRow();



		if($result_username || $result_email)



		{



			$error .= 'The Email Already Exists<br>';



		}



			



		



		if(empty($error))



		{



			    $model->firstname = mysql_real_escape_string(htmlentities($_POST['firstname']));



				$model->lastname = mysql_real_escape_string($_POST['lastname']);



				$model->cnic = mysql_real_escape_string($_POST['cnic']);



				$model->city = mysql_real_escape_string($_POST['city']);



				$model->state = mysql_real_escape_string($_POST['state']);



				$model->zip = mysql_real_escape_string($_POST['zip']);



				$model->middelname = mysql_real_escape_string($_POST['middelname']);



				$model->sodowo = mysql_real_escape_string($_POST['sodowo']);



				$model->username = mysql_real_escape_string($_POST['name']);



				



				$model->password = mysql_real_escape_string(md5($_POST['password']));



				$model->per1 = mysql_real_escape_string($_POST['per1']);



				$model->per2 = mysql_real_escape_string($_POST['per2']);



				$model->per3 = mysql_real_escape_string($_POST['per3']);



				$model->per4 = mysql_real_escape_string($_POST['per4']);



				$model->pic = mysql_real_escape_string($_POST['pic']);



				$model->status = 1;



				$model->email = mysql_real_escape_string($_POST['email']);



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



	function actionDelete_user()



	 {



		  if(Yii::app()->session['user_array']['per1']=='1')



			{



		 



		



				  $connection = Yii::app()->db;
				  $sql  = "Delete from user where id='".$_REQUEST['id']."'";
            	  $command = $connection -> createCommand($sql);
               	  $command -> execute();
		 		 $this->redirect(array("user/user_list"));		



		



	}



	 }



	public function actionVirtual_tour_video_uploaded()



	{



         if(Yii::app()->session['user_array']['per5']=='1')



			{



		



		if ($_FILES["file"]["error"] > 0) {



  			echo "Error: " . $_FILES["file"]["error"] . "<br>";



		} 



		else 



		{



			$filename = $_FILES["file"]["name"];



  			$filetype = $_FILES["file"]["type"];



  			$filesize =$_FILES["file"]["size"];



			$source = $_FILES["file"]["tmp_name"];



			$destination	= Yii::getPathOfAlias('webroot')."/video/upload/".$filename;



			$path = Yii::getPathOfAlias('webroot')."/video/upload/".$filename;



			



			//Getting Last Record for Namming ThumbNail







			$thumb_sr = time(); 



			$out_thumb = "img_".$thumb_sr.".jpg";





			$vpath = 'video/video_thumbnails/'.$out_thumb;



			



			$ffmpeg = Yii::getPathOfAlias('webroot')."/ffmpeg.exe";







			//Extracting Thumbnail



			exec($ffmpeg.' -v 0 -y -i "'.$source.'" -vframes 1 -ss 5 -vcodec mjpeg -f rawvideo -s 286x160 -aspect 16:9 '.$vpath) ;







			//Converting to FLV



			exec($ffmpeg." -i ".$source." -ar 22050 -ab 32 -f flv -s 1920x1080 video/upload/".$filename.".flv");







			echo "The File ".$filename. " has uploaded successfully.";



			



			//Adding Record to Database (Video Name, Video Description, Path, Thumbnail Path etc)



			



			if (isset($_POST['video_name'])){



			$video_name = $_POST['video_name'];



			}else{$video_name = "No Video Name Specified";}



			if (isset($_POST['video_description'])){



			$video_description = $_POST['video_description'];}



			else{$video_description =  "No Description Specidifed";}



			



			$connection = Yii::app()->db;



			$sql = "insert into video_table (video_name,video_description,filename,video_thumbnail) value ("."'".$video_name."'".",'".$video_description."','".$filename."','".$vpath."')";



			$command = $connection -> createCommand($sql);



			$command -> execute();	



		}



			}



			







	}



	







	public function actionVirtual_tour_upload_video()



	 {



		if((Yii::app()->session['user_array']['per5']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{



		



			$this->render('virtual_tour_upload_video');



			}

else{
		$this->redirect(array('user/dashboard'));

	}

	}



	public function actionUpdatemail()

	{
			$connection = Yii::app()->db;
				 
				$error =array();
				$mail=$_POST['username'];
				if(isset($_POST['username']) && empty($_POST['username']))


			{

				$error = 'Please Enter Username<br>';

			}	
		/*	if(!empty($_POST['email'])){
				
			 $check_user_query = 'select * from members where email="'.$_POST['email'].'"';
		    $check_user_result = $connection->createCommand($check_user_query)->queryRow();
	  		if($check_user_result['email']==$mail)
				{
					$error ="Email Already Exists<br>";
				}
			}*/	
			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please Enter Password<br>';

			}if(empty($error))
		   {
             $connection = Yii::app()->db;
			  $em="UPDATE members SET username='".$_POST['username']."',password='".$_POST['password']."' WHERE id='".$_POST['id']."'";
			$command = $connection -> createCommand($em);
            $command -> execute();
			echo"Username/Password has been changed successfully";
            $sql_email  = "SELECT * FROM members where id ='".$_POST['id']."'";
            $result_email = $connection->createCommand($sql_email)->queryRow();
            $message = '<table class="table" >   
      <tr>
        <td>Respected Member,<strong>'.$_POST['name'].' ,</strong> AoA!<br/><br/></td>
      </tr>
     
          <tr><td>To log on to the member portal please use following credentials:</td></tr><tr><td></td></tr>
        </br>
         <tr>
        <td>Login ID:  '.$_POST['username'].'</td>
        </tr>
        <tr>
        <td>Password:  '.$_POST['password'].'</td>
        </tr>
        <tr><td></td></tr><tr><td></td></tr>
        </br>
         <tr>
        <td>Thanks with profound regards, </td>
        </tr>
        <tr><td></td></tr>
        </br>
        <tr>
        <td></td>
        </tr><tr>
        <td></td>
        </tr>
        <tr><td></td></tr>
         <tr>
        <td>
         </br>
        <strong>IT Support Wing </strong>| Royal Developers & Builders (Pvt) Limited<br>
            Silver Square Plaza, Plot # 15, Street # 73, Mehr Ali Road,
            </td>
        </tr>
          <tr>
        <td> F-11 Markaz, Islamabad. </br>
              Toll Free : 0800-ROYAL (76925) </br>
              UAN : +92 51 111 444 475 </br>
              Tel : +92 51 2224301 - 04 </br>
              Email: sales@royalorchard.pk</br>

            </td>
        </tr>
        
  </table>';   
        	  $data=[
        	      'mail_to'=> $result_email['email'],
        	      'mail_subject'=> 'Account Details',
        	      'mail_detail'=> $message,
        	      
        	      
        	      ];
        	  
        	 MyHelper::send_email($data);



}
else
	{			

	echo $error;	
	}
	}
	
	public function actionvirtual_tour_view_video()



	{



		 if(Yii::app()->session['user_array']['per5']=='1')



			{

		$video_id = $_GET['id'];

		$connection = Yii::app()->db;

		$sql = "select filename from video_table where id=".$video_id;

		$result = $connection->createCommand($sql)->queryRow();

		$this->render('virtual_tour_view_video',array('filename'=>$result));



			}







	}



		public function actionVirtual_tour_video_gallery()



	 {



			if((Yii::app()->session['user_array']['per5']=='1')&& isset(Yii::app()->session['user_array']['username']))



			{



		



			$connection = Yii::app()->db;



			$sql = "select * from video_table";



			$vresult = $connection->createCommand($sql)->queryAll();



			$this->render('virtual_tour_video_gallery',array('vresult'=>$vresult));



			}
			else{
					$this->redirect(array('user/dashboard'));
				}



	}

public function actionAdd_user()
	{ 
		if(Yii::app()->session['user_array']['per1']=='1')
			{
				
		$this->layout='//layouts/back';
		$connection = Yii::app()->db;
		$project_sql = 'SELECT id,project_name from projects';
		$project_result = $connection->createCommand($project_sql)->queryAll();
		
			$this->render('Add_user',array('project_result'=>$project_result));}else{$this->redirect(array("user_list"));}

				
					
	}
			
			


/////////////////////////////Register New User UPDATED//////////////



	 public function actionReq_list()
	 {
		 if(Yii::app()->session['user_array']['per6']=='1')
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



	



	//////////////for Query Detail



	 public function actionRegister_member_query_detail()



	 {
		 if(Yii::app()->session['user_array']['per8']=='1')
			{

			$connection = Yii::app()->db; 	
		//	$sql_details  = "SELECT * from query where id='".$_REQUEST['id']."'";
			
			$sql_details  = "select q.*,m.name from query q
			 left join members m on q.user_id=m.id where 
			q.id='".$_REQUEST['id']."'";
			$result_details = $connection->createCommand($sql_details)->query();
			 $sql="UPDATE query SET status='1' where id=".$_REQUEST['id'].""; 
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			$this->render('register_member_query_detail',array('register_member_query_detail'=>$result_details)); 
			}else{$this->redirect(array("dashboard"));}



	}



	



		//////////////for Visitor Query Detail



	 public function actionVisitor_query_detail()
		 {
		  if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT * from unregister_user_query where id='".$_REQUEST['id']."'";
			$result_details = $connection->createCommand($sql_details)->query();
   			$sql="UPDATE unregister_user_query SET status='1' where id=".$_REQUEST['id'].""; 
			 
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			$this->render('visitor_query_detail',array('visitor_query_detail'=>$result_details)); 



			}else{$this->redirect(array("dashboard"));}



	}



	



	



	



	



	public function actionUser_list()



	{	



	if(Yii::app()->session['user_array']['per1']=='1')



			{



	$this->layout='//layouts/back';



    $connection = Yii::app()->db; 



	$sql_member = "SELECT * FROM user";



	$result_members = $connection->createCommand($sql_member)->query();



	$this->render('user_list',array('members'=>$result_members));



			}



			else{$this->redirect(array("dashboard"));}



	}



	



	



	public function actionPend_req_list()
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
				 $sql_details  = "SELECT siz.size,sec.sector_name, tp.*,s.street,mp.plotno,p.plot_detail_address,p.plot_size,p.com_res,p.size2,pro.project_name,m_from.name from_name,m_to.name to_name,p.project_id FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
                         Left JOIN size_cat siz ON siz.id=p.size2
                        Left JOIN sectors sec ON sec.id=p.sector
                        Left JOIN memberplot mp ON p.id=mp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.status='pending' AND (".$sql_project.")  ";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('pend_req_list',array('plotdetails'=>$result_details));
			}else{$this->redirect(array("dashboard"));}



	}



	public function actionRej_req_list()



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


			 $sql_details  = "SELECT siz.size,sec.sector_name,tp.*,s.street,p.plot_detail_address,p.plot_size,p.com_res,p.size2,pro.project_name,m_from.name from_name,m_to.name to_name,p.project_id FROM transferplot tp



			Left JOIN members m_from ON m_from.id=tp.transferfrom_id



			Left JOIN members m_to ON m_to.id=tp.transferto_id



			Left JOIN plots p ON p.id=tp.plot_id
                         Left JOIN sectors sec ON sec.id=p.sector
			Left JOIN size_cat siz ON siz.id=p.size2


			Left JOIN streets s ON s.id=p.street_id



			Left JOIN projects pro ON pro.id=p.project_id where tp.status='rejected' AND (".$sql_project.")   ";


			



			$result_details = $connection->createCommand($sql_details)->query();



			$this->render('rej_req_list',array('plotdetails'=>$result_details));



			}else{$this->redirect(array("dashboard"));}



	}



	



	




	 public function actionAdd_member_menu()



	 {



		 if(Yii::app()->session['user_array']['per4']=='1')



			{



		$this->layout='//layouts/back';



		//Pagination



		if (isset($_GET['page_num']))



		{



			if ($_GET['page_num']==1)



			{



				$offset = 0;



			}



			else



			{



			$page_num = $_GET['page_num'];



			$offset = ($page_num * 10)-10;



			}



		}



		else



		{



			$offset = 0;



		}



		



		if (isset($_POST['insert_submit']))



		{



			if (isset($_POST['status']))



				{



					$status = 1;



				}



				else



				{



						$status=0;



				}



			$connection = Yii::app()->db;



			$sql='INSERT INTO menu



			SET status='.$status.',



			sub_level='.$_POST['sub_level'].',



			page_id='.$_POST['content_type'].',



			menu_title="'.$_POST['menu_title'].'"' ;	  



        	$command = $connection -> createCommand($sql);



        	$command -> execute(); 



		}



		//Update Record



		if (isset($_POST['update_submit'])){



				



				if (isset($_POST['status']))



				{



					$status = 1;



				}



				else



				{



						$status=0;



				}



				



				



			$connection = Yii::app()->db;







			$sql_update = 'update menu 



				set page_id = '.$_POST['page_id'].', 



				status = '.$status.',



				sub_level = '.$_POST['sub_level'].', 



				menu_title = "'.$_POST['menu_title'].'" 



				where id='.$_POST['menu_id'];



				



			$command = $connection -> createCommand($sql_update);



    	    $command -> execute();



			//echo "Record Updated"; 



		}



		



		//Delete Record



		if (isset($_POST['delete_submit'])){



			$connection = Yii::app()->db;



			$sql_delete = 'DELETE FROM menu



WHERE id='.$_POST['menu_id'];	



			$command = $connection -> createCommand($sql_delete);



    	    $command -> execute();



		}



		//Show Record



		



		 $connection = Yii::app()->db;  



		 $sql_page  = "SELECT



    					menu.id



    					, menu.page_id



    					, menu.menu_title



    					, menu.status



    					, menu.sub_level



   						, pages.content_type



						



					  FROM



    					menu



    					LEFT JOIN pages 



        				ON (menu.page_id = pages.id) limit ".$offset.",10;";







		$sql_page1  = "SELECT



    					menu.id



    					, menu.page_id



    					, menu.menu_title



    					, menu.status



    					, menu.sub_level



   						, pages.content_type



						,pages.id



					  FROM



    					menu



    					LEFT JOIN pages 



        				ON (menu.page_id = pages.id);";



						



		 $result_pages = $connection->createCommand($sql_page)->queryAll();



		 	 $sql_page1  = "SELECT * FROM pages";



						



		 $result_pages1 = $connection->createCommand($sql_page1)->queryAll();



		 



		 



		 $count_query = "SELECT COUNT(*) as total FROM menu;";



		 $result_count = $connection->createCommand($count_query)->queryAll();



		 



		 



		 $this->render('add_member_menu',array('pages'=>$result_pages,'pages1'=>$result_pages1,'num_of_rows'=>$result_count));



		



		 



		 



			}



			else {$this->redirect(array("dashboard")); }



		}
public function actionMessage()
		{
		 if(Yii::app()->session['user_array']['per8']=='1')
			{  
			$error =array();
			if(isset($_POST['title']) && empty($_POST['title']))

			{

				$error = 'Please Enter Title<br>';

			}
			if(isset($_POST['message']) && empty($_POST['message']))

			{

				$error .='Please Enter Message<br>';

			}
	$date= date('Y-m-d h:i:s');
		 
		if(empty($error))
		{	
		$qid= $_POST['qid'];
			   $connection = Yii::app()->db; 
			     
          $sql  = 'INSERT INTO register_member_answer (title, message,user_id,status,date) VALUES ("'.$_POST['title'].'", "'.$_POST['message'].'", "'.$_POST['user_id'].'",0, "'.$date.'")';		
               
			   $command = $connection -> createCommand($sql);
               $command -> execute();
				$del="Update query set replied=1 where id=".$qid."";			  
				$command = $connection -> createCommand($del);
			    $command -> execute();
				
				echo "Message Sent Successfully";
		} 

			if(!empty($error)){
				echo $error;
			}
		

			}



			}







	 function actionDelete_query()
	 {
		 if(Yii::app()->session['user_array']['per8']=='1')
			{
		  $connection = Yii::app()->db;
	  $sql  = "Delete from query where id='".$_REQUEST['id']."'";
               $command = $connection -> createCommand($sql);
               $command -> execute();
		 		 $this->redirect(array("user/register_member_query"));		
			}else {$this->redirect(array("dashboard")); }
			}
	 function actionImage_capture()
	 {
		 if(Yii::app()->session['user_array']['per8']=='1')
			{
		  $connection = Yii::app()->db;
	
		 		 $this->render("imagec");		
			}else {$this->redirect(array("dashboard")); }
			}

 function actionVisitor_query_delete()



	 {



		  if(Yii::app()->session['user_array']['per8']=='1')



			{



		  $connection = Yii::app()->db;



	  $sql  = "Delete from unregister_user_query where id='".$_REQUEST['id']."'";



               $command = $connection -> createCommand($sql);



               $command -> execute();



			



		 		 $this->redirect(array("user/visitor_query"));		



			}else{$this->redirect(array("dashboard"));}



	}









public function actionRegister_member_query1()

	 {
		 if(Yii::app()->session['user_array']['per8']=='1')

			{

			$connection = Yii::app()->db; 	
			 $sql_details  = "select q.*,m.name from query q
			 left join members m on q.user_id=m.id
			where q.replied=1 or q.replied !=''";
			$result_details = $connection->createCommand($sql_details)->query();

			$this->render('register_member_query1',array('register_member_query'=>$result_details));
						}else{$this->redirect(array("dashboard"));}
	}

	public function actionRegister_member_query()

	 {
		 if(Yii::app()->session['user_array']['per8']=='1')

			{

			$connection = Yii::app()->db; 	
			 $sql_details  = "select q.*,m.name from query q
			 left join members m on q.user_id=m.id
			where q.replied=0 or q.replied=''";
			$result_details = $connection->createCommand($sql_details)->query();

			$this->render('register_member_query',array('register_member_query'=>$result_details));
						}else{$this->redirect(array("dashboard"));}
	}



	/*public function actionRegister_member_query()

	 {
		 if(Yii::app()->session['user_array']['per8']=='1')

			{

			$connection = Yii::app()->db; 	
			 $sql_details  = "select q.*,m.name from query q
			 left join members m on q.user_id=m.id
			";
			$result_details = $connection->createCommand($sql_details)->query();

			$this->render('register_member_query',array('register_member_query'=>$result_details));
						}else{$this->redirect(array("dashboard"));}
	}

*/
public function actionMail()

	{			
		  $connection = Yii::app()->db;

				$sql="UPDATE unregister_user_query SET replied=1 where id=".$_REQUEST['id']."";
				$command = $connection -> createCommand($sql);
			    $command -> execute();  
              
            
	        try {
	          
	            
			     $email = $_POST["email"]; 
	             $message = $_POST["message"];
        	    Yii::import('application.extensions.phpmailer.JPhpMailer');
                $mail = new JPhpMailer;
                $mail->IsSMTP();
                $mail->Host = 'mail.rdlpk.com';
                $mail->SMTPAuth = true;
                $mail -> Port = 465;
                $mail -> SMTPSecure = 'ssl';
                $mail->Username = 'info@rdlpk.com';
                $mail->Password = '%c!+y~^;FJ[3';
                $mail->SetFrom('info@rdlpk.com', 'Royal Orchard');

        
                $mail->Subject = 'Visitor Query Answer';
                $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail->MsgHTML($message);
              
                $mail->addAddress($email);
                $mail->Send();
                $mail->ClearBCCs();
                $mail->ClearAddresses();
               $this->redirect('visitor_query1'); 
	      }catch(Exception $e){
             echo  $e->getMessage();exit;
	      }
	    
								
			 //   $this->redirect('visitor_query'); 
	}










	public function actionMembershiprequest1()
	     {
	     if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db; 	
		$where="status ='".$_POST['status']."'";

		$and=true;

			//$where="status='1'";	$and = true;
			if (!empty($_POST['name'])){
				$where.="And name LIKE '%".$_POST['name']."%'";
				$and = true;
			}
			if (!empty($_POST['cnic'])){
				if ($and==true)
				{
					$where.=" and cnic ='".$_POST['cnic']."'";
				}
				else
				{
					$where.=" cnic = '".$_POST['cnic']."'";
				}
				$and=true;
			}
if (isset($_POST['mtype'])){
				if ($and==true)
				{
					$where.=" and mtype ='".$_POST['mtype']."'";
				}
				else
				{
					$where.=" mtype = '".$_POST['mtype']."'";
				}
				$and=true;
			}
			if (!empty($_POST['status'])){
				if ($and==true)
				{
					$where.=" and status ='".$_POST['status']."'";
				}
				else
				{
					$where.=" status = '".$_POST['status']."'";
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
  $sql_memberas = "SELECT * FROM members where  $where";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 
		$connection = Yii::app()->db; 
      $sql_member = "SELECT * from members where $where  limit $start,$limit"; 
		$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 
        $check=1;
        $res=array();
	 foreach($result_members as $key){
	            echo '<tr><td>'.$key['id'].'</td><td>'.$key['name'].'</td></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['address'].'</td><td><img src="'.Yii::app()->request->baseUrl.'/upload_pic/'.$key['image'].'" width="150" height="150" /></td><td>';
			if($key['status']=='' OR $key['status']=='0')
			{echo 'In Active';}
			else{ echo 'Active';}
			echo '</td><td>';
			if(!empty($key['fp']))
			{echo '<b style="color:green;">Verified</b>';}
			else{ echo '<b style="color:red;">Not Verified</b>';}
			echo'</td>
			<td><a href="update_member?id='.$key['id'].'">Edit</a></td>'; 
			if(Yii::app()->session['user_array']['per7']=='1')
			{
			echo '<td><a href="update_email?id='.$key['id'].'">Click For Update Username/Password</a><br>';} 
if($key['mtype']=='Dealer')
			{
			echo '<a href="/index.php/member/detaildealer?id='.$key['id'].'">Dealer Report</a></td></tr>';} 
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

	}
	
	else{echo'';}
			}else{
				$this->redirect(array("dashboard"));
				}
	   }



	public function actionMembershiprequest()
	     {
		 if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "select * from members where status='1'";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('membershiprequest',array('membershiprequest'=>$result_details));
			}else{



				$this->redirect(array("dashboard"));



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



	/////////////FOr Membership Detail   



	public function actionUpdate_member()

	     {

		 if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db;
				$sql_country  ="SELECT * FROM tbl_country";
			$result_country = $connection->createCommand($sql_country)->query();
		 $sql_details  = "SELECT m.*,c.country,p.city FROM members m
			Left JOIN tbl_country c ON c.id=m.country_id 
			Left JOIN tbl_city p ON p.id=m.city_id 
			 where m.id='".$_REQUEST['id']."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('update_member',array('update_member'=>$result_details,'country'=>$result_country));

			}else{$this->redirect(array("dashboard"));}

	   }

	public function actionUpdate_email()

	     {

		 if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db;
				$sql_country  ="SELECT * FROM tbl_country";
			$result_country = $connection->createCommand($sql_country)->query();
		 $sql_details  = "SELECT m.*,c.country,p.city FROM members m
			Left JOIN tbl_country c ON c.id=m.country_id 
			Left JOIN tbl_city p ON p.id=m.city_id 
			 where m.id='".$_REQUEST['id']."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('update_email',array('update_member'=>$result_details,'country'=>$result_country));

			}else{$this->redirect(array("dashboard"));}

	   }

	   /////////////FOr User Detail   



	public function actionUser_detail()
	     {
		 if(Yii::app()->session['user_array']['username'])
			{
			$connection = Yii::app()->db; 	
			$session=Yii::app()->session['user_array']['id'];
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


///////////////////////////for update member status
public function actionMemberupdate()
	{  
	 if(Yii::app()->session['user_array']['per2']=='1')
			{

		if(isset(Yii::app()->session['user_array']))
		{
			 $connection = Yii::app()->db;  
				if($_POST['status']=='0')
			{  
			   $sql_update1 = "UPDATE members SET status ='0' WHERE id = ".$_POST['memreq_id']."";
			 $command = $connection -> createCommand($sql_update1);
             $command -> execute();
			 $this->redirect(array("membershiprequest"));
			}
$dealer='';
if(isset($_POST['mtype'])){$dealer="Dealer";}
			if($_POST['status']=='1')
			{	

  $sql_update = "UPDATE members SET status ='1',RFM ='', name='".$_POST['name']."', username='".$_POST['username']."', cnic='".$_POST['cnic']."',title='".$_POST['title']."',
phone='".$_POST['phone']."', sodowo='".$_POST['sodowo']."', email='".$_POST['email']."', address='".$_POST['address']."', country_id='".$_POST['country']."', city_id='".$_POST['city']."', mtype='".$dealer."', nomineename='".$_POST['nomineename']."', nomineecnic='".$_POST['nomineecnic']."', rwa='".$_POST['rwa']."', business_title='".$_POST['business_title']."' WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("membershiprequest"));
			}
			if($_POST['status']==2)
			{
			 $sql_delete = "Delete from  members  WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_delete);
             $command -> execute();
			 $this->redirect(array("membershiprequest"));
			}
			}
			}

	   }
public function actionMemberupdate111()
	{  
	 if(Yii::app()->session['user_array']['per2']=='1')
			{

		if(isset(Yii::app()->session['user_array']))



		{
			 $connection = Yii::app()->db;  

				if($_POST['status']=='0')
			{  
			   $sql_update1 = "UPDATE members SET status ='0' WHERE id = ".$_POST['memreq_id']."";
			 $command = $connection -> createCommand($sql_update1);
             $command -> execute();
			 $this->redirect(array("membershiprequest"));
			}
$dealer='';
if(isset($_POST['mtype'])){$dealer="mtype='Dealer',";}
			if($_POST['status']=='1')
			{	

  $sql_update = "UPDATE members SET status ='1',RFM ='', name='".$_POST['name']."', username='".$_POST['username']."', cnic='".$_POST['cnic']."',title='".$_POST['title']."',
phone='".$_POST['phone']."', sodowo='".$_POST['sodowo']."', email='".$_POST['email']."', address='".$_POST['address']."', country_id='".$_POST['country']."', city_id='".$_POST['city']."',$dealer nomineename='".$_POST['nomineename']."', nomineecnic='".$_POST['nomineecnic']."', rwa='".$_POST['rwa']."' WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("membershiprequest"));
			}
			if($_POST['status']==2)
			{
			 $sql_delete = "Delete from  members  WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_delete);
             $command -> execute();
			 $this->redirect(array("membershiprequest"));
			}
			}
			}

	   }


 function actionreply_member()
	 { 
	 if(Yii::app()->session['user_array']['per8']=='1')
			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{
			$connection = Yii::app()->db;  
			$sql_project  = "SELECT * from register_member_answer";
			$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('reply_member',array('reply_member'=>$result_projects));
			$error = '';
		}
			}else{$this->redirect(array("dashboard"));}
	 }



     function actionMail_unregister_user()
	 { 
	 if(Yii::app()->session['user_array']['per8']=='1')

			{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{
			$connection = Yii::app()->db;  
			 $sql_project  = "SELECT * from unregister_user_query where id=".$_REQUEST['id']." ";
			
			$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('mail_unregister_user',array('mail'=>$result_projects));
			$error = '';
		}
			}else {$this->redirect(array("dashboard")); }



	 }



	



	  



	  



	  



	  



	  

public function actionFpreader()



	 {
		 	if((Yii::app()->session['user_array']['per10']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
		 
		 $this->layout='//layouts/back';
			$this->render('fpreader'); 
			}else{
				
				$this->redirect(array('user/dashboard'));
				}
		 }
 public function actionVisitor_query()

	 {
		 if(Yii::app()->session['user_array']['per8']=='1')



			{



			$connection = Yii::app()->db; 	



			$sql_details  = "select * from unregister_user_query where status=0 and replied=0 or replied='' ORDER BY create_date DESC";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('visitor_query',array('visitorqueries'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}


 public function actionVisitor_query1()

	 {
		 if(Yii::app()->session['user_array']['per8']=='1')



			{



			$connection = Yii::app()->db; 	



			$sql_details  = "select * from unregister_user_query where status=1 and replied=1  ORDER BY create_date DESC";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('visitor_query1',array('visitorqueries'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}


/* public function actionVisitor_query()
 {
		 if(Yii::app()->session['user_array']['per8']=='1')



			{



			$connection = Yii::app()->db; 	



			$sql_details  = "select * from unregister_user_query ORDER BY create_date DESC";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('visitor_query',array('visitorqueries'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}

*/

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
		

			$sql_details  = "SELECT sec.sector_name,siz.size,tp.id,mp.plotno,tp.plot_id,tp.transferfrom_id,tp.transferto_id,tp.uid,tp.status, tp.image, tp.cmnt,tp.create_date,s.street,p.plot_detail_address,p.plot_size,p.com_res,p.size2,pro.project_name,m_from.name from_name,m_to.name to_name,p.project_id FROM transferplot tp



			Left JOIN members m_from ON m_from.id=tp.transferfrom_id



			Left JOIN members m_to ON m_to.id=tp.transferto_id



			Left JOIN plots p ON p.id=tp.plot_id
                        Left JOIN size_cat siz ON siz.id=p.size2
                        Left JOIN sectors sec ON sec.id=p.sector
			Left JOIN memberplot mp ON p.id=mp.plot_id



			Left JOIN streets s ON s.id=p.street_id



			Left JOIN projects pro ON pro.id=p.project_id WHERE tp.status='Approved' AND (".$sql_project.")   ";
			$result_details = $connection->createCommand($sql_details)->query();



			$this->render('appro_req_list',array('plotdetails'=>$result_details));



			}else{$this->redirect(array("dashboard"));}



	}



	



	public function actionMemhistory()



	{	

if((Yii::app()->session['user_array']['id']!=='')&& isset(Yii::app()->session['user_array']['username']))




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
public function actionPlothistory()

	{	
	if(isset(Yii::app()->session['user_array']['username']))
{
			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			 $sql_page  = "SELECT floors.name as floor_name,buildings.name as building_name,p.is_property,mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on p.project_id=j.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id) 

WHERE mp.plot_id ='".$_REQUEST['id']."'";

			$result_pages = $connection->createCommand($sql_page)->queryAll();
				$sql_history  = "SELECT ph.msno, ph.transfer_date,m.name,m.sodowo,m.cnic, m.address,ph.transferfrom_id,p.id,ph.plot_id,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name 
FROM plothistory ph
left join members m on ph.transferfrom_id=m.id
left join plots p on ph.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id)
WHERE ph.plot_id ='".$_REQUEST['id']."'";
			$result_history= $connection->createCommand($sql_history)->queryAll();
			
			
			
			 $sql_reallocate  = "SELECT p.id,mp.plotno,p.create_date,mp.plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM reallocation_history p
left join memberplot mp on p.id=mp.plot_id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE p.plot_id ='".$_REQUEST['id']."'";
			$result_reallocate = $connection->createCommand($sql_reallocate)->queryAll();
$connection = Yii::app()->db;
$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
			$this->render('plothistory',array('projects'=>$result_projects,'primeloc'=>$result_prime,'pages'=>$result_pages,'history'=>$result_history,'reallocate'=>$result_reallocate));
}else{$this->redirect(array("dashboard"));}
	}
	


/*public function actionPlothistory()

	{	
	if(Yii::app()->session['user_array']['per2']=='1')
	{
			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			$sql_page  = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id
left join projects j on s.project_id=j.id 
WHERE plot_id ='".$_REQUEST['id']."'";

			$result_pages = $connection->createCommand($sql_page)->query();
				 $sql_history  = "SELECT ph.transfer_date,m.name,m.sodowo,m.cnic, m.address,ph.transferfrom_id,p.id,ph.plot_id,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name 
FROM plothistory ph
left join members m on ph.transferfrom_id=m.id
left join plots p on ph.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE plot_id ='".$_REQUEST['id']."'";
			$result_history= $connection->createCommand($sql_history)->query();
			
			
			
			 $sql_reallocate  = "SELECT p.id,mp.plotno,p.create_date,mp.plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM reallocation_history p
left join memberplot mp on p.id=mp.plot_id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE p.plot_id ='".$_REQUEST['id']."'";
			$result_reallocate = $connection->createCommand($sql_reallocate)->query();
$connection = Yii::app()->db;
$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
			$this->render('plothistory',array('projects'=>$result_projects,'primeloc'=>$result_prime,'pages'=>$result_pages,'history'=>$result_history,'reallocate'=>$result_reallocate));

	}else{$this->redirect(array("dashboard"));}
	}
	
*/



	public function actionFilehistory()



	{	



	if(Yii::app()->session['user_array']['per2']=='1')



	{



			$this->layout='//layouts/back';



			$connection = Yii::app()->db;



			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";



			$result_projects = $connection->createCommand($sql_projects)->query();



			



			$sql_page  = "SELECT mp.member_id,mp.create_date, m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.type,p.plot_size,s.street, j.project_name 



FROM memberplot mp



left join members m on mp.member_id=m.id



left join plots p on mp.plot_id=p.id



left join streets s on p.street_id=s.id



left join projects j on s.project_id=j.id 



WHERE plot_id ='".$_REQUEST['id']."' AND p.type ='file'";
$result_pages = $connection->createCommand($sql_page)->query();

			 $sql_reallocate  = "SELECT p.id,mp.plotno,p.create_date,mp.plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM reallocation_history p
left join memberplot mp on p.id=mp.plot_id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE p.plot_id ='".$_REQUEST['id']."'";
			$result_reallocate = $connection->createCommand($sql_reallocate)->query();

			
$sql_history  = "SELECT ph.transfer_date,m.name,m.sodowo,m.cnic, m.address,ph.transferfrom_id,p.id,ph.plot_id,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name 
FROM plothistory ph
left join members m on ph.transferfrom_id=m.id
left join plots p on ph.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE plot_id ='".$_REQUEST['id']."'";
			$result_history= $connection->createCommand($sql_history)->query();
			

			$this->render('plothistory',array('projects'=>$result_projects,'pages'=>$result_pages,'history'=>$result_history,'reallocate'=>$result_reallocate));



	}else{$this->redirect(array("dashboard"));}



	}


 
	

	

	 public function actionReq_detail()
	 {
	if(Yii::app()->session['user_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT finance_user.firstname as finance_user, sc_user.firstname as sc_user,admin_user.firstname as admin_user,ach.*,ach.id as achid,tp.*,s.street,sec.sector_name,siz.size,p.com_res, mp.id as mssid,p.sector,mp.tempms,mp.plotno,p.plot_detail_address,p.plot_size,tp.fp,tp.fstatus,pro.project_name,m_from.name from_name,m_to.name to_name 
			,m_to.cnic,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.city_id,m_to.state
			FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
            Left JOIN memberplot mp ON p.id=mp.plot_id
            Left JOIN sectors sec ON sec.id=p.sector
			Left JOIN tp_action_history ach ON p.id=ach.plot_id
			Left JOIN user sc_user ON sc_user.id=ach.sc_id
			Left JOIN user admin_user ON admin_user.id=ach.admin_id
			Left JOIN user finance_user ON finance_user.id=ach.f_id
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
	if(Yii::app()->session['user_array']['per10']=='1')
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
	if(Yii::app()->session['user_array']['per1']=='1')
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




public function actionUpdate()
	{		
	 $id=$_POST['id'];
    $connection = Yii::app()->db; 
	 $sql_check = "SELECT * from project_permissions where user_id=".$id;
	$result_check = $connection->createCommand($sql_check)->queryAll();
	if (!empty($result_check)){
			  
			 $sql_del = "DELETE from project_permissions where user_id=".$id;
			 $command = $connection -> createCommand($sql_del);
             $command -> execute();
		}
	 $num_of_projects_query = 'SELECT count(id) as num_of_projects from projects';
		$num_of_projects = $connection->createCommand($num_of_projects_query)->queryAll();
		$res=array();
		foreach($num_of_projects as $num_of_projects)
		{
			$num_of_projects = 	$num_of_projects['num_of_projects'];
		}
		while ($num_of_projects>0)
		{
			if (isset($_POST[$num_of_projects]))
				{
					$project_id = $_POST[$num_of_projects]; 
					$connection = Yii::app()->db;
					 $add_project_per_query = 'insert into project_permissions 
												set 
												user_id='.$_POST['uid'].', 
												project_id='.$project_id;
					$command = $connection -> createCommand($add_project_per_query);
					$command -> execute();
				}
			$num_of_projects--;

		}
		 			//Exception Handling For Check Box
			if (isset($_POST['per1']))
			{
			$per1=$_POST['per1'];
			}
			else
			{
			$per1 = 0;
			}
			if (isset($_POST['per2']))
			{
			$per2=$_POST['per2'];
			}
			else
			{
			$per2 = 0;
			}
			if (isset($_POST['per3']))
			{
			$per3=$_POST['per3'];
			}
			else
			{
			$per3 = 0;
			}
			if (isset($_POST['per4']))
			{
			$per4=$_POST['per4'];
			}
			else
			{
			$per4 = 0;
			}
			if (isset($_POST['per5']))
			{
			$per5=$_POST['per5'];
			}
			else
			{
			$per5 = 0;
			}
			if (isset($_POST['per6']))
			{
			$per6=$_POST['per6'];
			}
			else
			{
			$per6 = 0;
			}
			if (isset($_POST['per7']))
			{
			$per7=$_POST['per7'];
			}
			else
			{
			$per7 = 0;
			}
			if (isset($_POST['per8']))
			{
			$per8=$_POST['per8'];
			}
			else
			{
			$per8 = 0;
			}
			if (isset($_POST['per9']))
			{
			$per9=$_POST['per9'];
			}
			else
			{
			$per9 = 0;
			}
			if (isset($_POST['per10']))
			{
			$per10=$_POST['per10'];
			}
			else
			{
			$per10 =0;
			}
			if (isset($_POST['per11']))
			{
			$per11=$_POST['per11'];
			}
			else
			{
			$per11 =0;
			}
			if (isset($_POST['per12']))
			{
			$per12=$_POST['per12'];
			}
			else
			{
			$per12 =0;
			}
			if (isset($_POST['per13']))
			{
			$per13=$_POST['per13'];
			}
			else
			{
			$per13 =0;
			}
			if (isset($_POST['per14']))
			{
			$per14=$_POST['per14'];
			}
			else
			{
			$per14 =0;
			}
			if (isset($_POST['per15']))
			{
			$per15=$_POST['per15'];
			}
			else
			{
			$per15 =0;
			}
			if (isset($_POST['per16']))
			{
			$per16=$_POST['per16'];
			}
			else
			{
			$per16 =0;
			}
			if (isset($_POST['per17']))
			{
			$per17=$_POST['per17'];
			}
			else
			{
			$per17 =0;
			}
			if (isset($_POST['per18']))
			{
			$per18=$_POST['per18'];
			}
			else
			{
			$per18 =0;
			}
			if (isset($_POST['per19'])){$per19=$_POST['per19'];}
			else
			{
			$per19 = 0;
			}
			if (isset($_POST['per20'])){$per20=$_POST['per20'];}
			else
			{
			$per20 = 0;
			}
			if (isset($_POST['per21'])){$per21=$_POST['per21'];}
			else
			{
			$per21 = 0;
			}
			if (isset($_POST['per31'])){$per31=$_POST['per31'];}
			else
			{
			$per31 = 0;
			}
			if (isset($_POST['per32'])){$per32=$_POST['per32'];}
			else
			{
			$per32 = 0;
			}
			if (isset($_POST['per33'])){$per33=$_POST['per33'];}
			else
			{
			$per33 = 0;
			}
			if (isset($_POST['per34'])){$per34=$_POST['per34'];}
			else
			{
			$per34 = 0;
			}
			if (isset($_POST['per35'])){$per35=$_POST['per35'];}
			else
			{
			$per35 = 0;
			}
			if (isset($_POST['per_bcd_mgm'])){$per_bcd_mgm=$_POST['per_bcd_mgm'];}
			else
			{
			$per_bcd_mgm = 0;
			}
			if (isset($_POST['per_bcd_rpt'])){$per_bcd_rpt=$_POST['per_bcd_rpt'];}
			else
			{
			$per_bcd_rpt = 0;
			}
		 if (!empty($_POST['password']))
		 {
						$options = [
					'cost' => 12,
				];
		     	 $password=password_hash($_POST['password'], PASSWORD_BCRYPT, $options);			
			   //generating double encryption for 
               
				
                $password_e = base64_encode($_POST['password']);
				$salt="royalorchard";
				
                $str = substr($salt,5,7);
               
                $password_e = $str.$password_e;           
                $password_e = base64_encode($password_e);

                $skey = $password_e;
			
		 }
		 else
		 {
		 
		 		
		     	 $password=$_POST['password_not_changed'];			
			    $skey=$_POST['prev_skey'];	
		 }
		 $connection = Yii::app()->db;
		  $s = "SELECT * FROM user where id=".$id;
			     $res = $connection->createCommand($s)->queryRow();
		     if ($_FILES['pic']["name"]==''){
             $pic=$res['pic'];
				}else{
		     
			 $pic =  $_FILES["pic"]["name"];
			 move_uploaded_file($_FILES["pic"]["tmp_name"],'images/user/'.$pic);}
			 $firstname=$_POST['firstname'];
			 $middelname=$_POST['middelname'];
			 $lastname=$_POST['lastname'];
			 $sodowo=$_POST['sodowo'];
			 $cnic=$_POST['cnic'];
			 $address=$_POST['address'];
			 $city=$_POST['city'];
			 $email=$_POST['email'];
			 $state=$_POST['state'];
			$zip=$_POST['zip'];
			$country=$_POST['country'];
			$username=$_POST['username'];
			$status=$_POST['status'];
			 $sql_update = "UPDATE user SET firstname ='$firstname',middelname ='$middelname',lastname ='$lastname',sodowo ='$sodowo',status ='$status',cnic ='$cnic',address ='$address',city ='$city',email ='$email',state ='$state',zip ='$zip',country ='$country',pic='$pic',username ='$username',password1 ='$password',skey ='$skey',per1 ='$per1',per2 ='$per2',per3 ='$per3',per4 ='$per4',per5 ='$per5',per6 ='$per6',per7 ='$per7',per8 ='$per8',per9 ='$per9',per10 ='$per10',per11 ='$per11',per12 ='$per12',per13 ='$per13',per14 ='$per14',per15 ='$per15',per16 ='$per16',per17 ='$per17'
			,per18 ='$per18'
			,per19 ='$per19'
			,per20 ='$per20'
			,per21 ='$per21'
			,per31 ='$per31'
			,per32 ='$per32'
			,per33 ='$per33'
			,per34 ='$per34'
			,per35 ='$per35'
			,per_bcd_mgm ='$per_bcd_mgm'
			,per_bcd_rpt ='$per_bcd_rpt'
			,sc_id ='".$_POST['sales']."'
			 WHERE id =".$id;
    	$command = $connection -> createCommand($sql_update);
        $command -> execute();
				//Adding Project Permission to Database
		 
		
			  $this->redirect(array("user_list"));		
	}

public function actionAdd_usr()
	{ 

		if(Yii::app()->session['user_array']['per1']=='1')
			{
					
		$connection = Yii::app()->db;
				
				$error =array();
			if(isset($_POST['firstname']) && empty($_POST['firstname']))

			{

				$error = 'Please Enter First Name<br>';

			}
			if(isset($_POST['middelname']) && empty($_POST['middelname']))

			{

				$error .= 'Please Enter Middle Name<br>';

			}
			if(isset($_POST['lastname']) && empty($_POST['lastname']))

			{

				$error .= 'Please Enter Last Name<br>';

			}
			
			if(isset($_POST['sodowo']) && empty($_POST['sodowo']))

			{

				$error .= 'Please Enter sodowo<br>';

			}
			if(isset($_POST['cnic']) && empty($_POST['cnic']))

			{

				$error .= 'Please Enter CNIC<br>';

			}
			if(isset($_POST['address']) && empty($_POST['address']))

			{

				$error .= 'Please Enter Address<br>';

			}
				if(isset($_POST['email']) && empty($_POST['email']))

			{

				$error .= 'Please Enter Email<br>';

			}
				if(isset($_POST['city']) && empty($_POST['city']))

			{

				$error .= 'Please Enter City<br>';

			}
				
				if(isset($_POST['state']) && empty($_POST['state']))

			{

				$error .= 'Please Enter State<br>';

			}	
			
				if(isset($_POST['zip']) && empty($_POST['zip']))

			{

				$error .= 'Please Enter Zip<br>';

			}	
		
			if(isset($_POST['country']) && empty($_POST['country']))

			{

				$error .= 'Please Enter Country<br>';

			}	
			if(isset($_POST['username']) && empty($_POST['username']))

			{

				$error .= 'Please Enter Username<br>';

			}	
			if(!empty($_POST['username'])){
				
			 $check_user_query = 'select * from user where username="'.$_POST['username'].'" and status="1"';
		    $check_user_result = $connection->createCommand($check_user_query)->queryRow();
	  		if($check_user_result['username']==$_POST['username'])
				{
					$error ='Username Already Exists<br>';
				}
			}	
	
			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please Enter Password<br>';

			}
				if(isset($_POST['mobile']) && empty($_POST['mobile']))

			{

				$error .= 'Please Enter Mobile #<br>';

			}
						
			if(isset($_POST['confirm_password']) && empty($_POST['confirm_password']))

			{

				$error .= 'Please Enter Confirm Password<br>';
 
			}	
				if(!empty($_POST['password'])&& (!empty($_POST['confirm_password'])))
			{
				
			if(($_POST['password'])!=($_POST['confirm_password']))
			{
				$error .= 'Password And Confirm Are Not Same<br>';
				
			}
				
			}
		if(empty($error))
		{
			$project_sql = 'SELECT id,project_name from projects';
		$project_result = $connection->createCommand($project_sql)->queryAll();
		
			//Checking User Already Exists or Not
			$connection = Yii::app()->db;
			//$pic =  $_FILES["pic"]["name"];
		//	move_uploaded_file($_FILES["pic"]["tmp_name"],'images/user/'.$pic);

			$connection = Yii::app()->db;
			$firstname='';
			$middelname='';
			$lastname='';
			$sodowo='';
			$cnic='';
			$address="";
			$city='';
			$email='';
			$state='';
			$zip='';
			$country='';
			$username='';
			$password='';
			$mobile='';
			$per35='';
			$sales='';



			
			if (isset($_POST['sales'])) { $sales=$_POST['sales']; }
			if (isset($_POST['firstname'])) { $firstname=$_POST['firstname']; }
			if (isset($_POST['middelname'])) { $middelname=$_POST['middelname']; }
			if (isset($_POST['lastname'])) { $lastname=$_POST['lastname']; }
			if (isset($_POST['sodowo'])) { $sodowo=$_POST['sodowo']; }
			if (isset($_POST['cnic'])) { $cnic=$_POST['cnic']; }
			if (isset($_POST['address'])) { $address=$_POST['address']; }
			if (isset($_POST['city'])) { $city=$_POST['city']; }
			if (isset($_POST['email'])) { $email=$_POST['email']; }
			if (isset($_POST['state'])) { $state=$_POST['state']; }

						//Exception Handling For Check Box
			
			if (isset($_POST['per1'])){$per1=$_POST['per1'];}
			
			else
			{
			$per1 = 0;
			}
			if (isset($_POST['per2'])){$per2=$_POST['per2'];}
			else
			{
			$per2 = 0;
			}
			if (isset($_POST['per3']))
			{
			$per3=$_POST['per3'];
			}
			else
			{
			$per3 = 0;
			}
			if (isset($_POST['per4']))
			{
			$per4=$_POST['per4'];
			}
			else
			{
			$per4 = 0;
			}
			if (isset($_POST['per5']))
			{
			$per5=$_POST['per5'];
			}
			else
			{
			$per5 = 0;
			}
			if (isset($_POST['per6']))
			{
			$per6=$_POST['per6'];
			}
			else
			{
			$per6 = 0;
			}
			if (isset($_POST['per7']))
			{
			$per7=$_POST['per7'];
			}
			else
			{
			$per7 = 0;
			}
			if (isset($_POST['per8']))
			{
			$per8=$_POST['per8'];
			}
			else
			{
			$per8 = 0;
			};
			if (isset($_POST['per9'])){$per9=$_POST['per9'];}
			else
			{
			$per9 = 0;
			}
			if (isset($_POST['per10'])){$per10=$_POST['per10'];}
			else
			{
			$per10 = 0;
			}
				if (isset($_POST['per11'])){$per11=$_POST['per11'];}
			else
			{
			$per11 = 0;
			}
			if (isset($_POST['per12'])){$per12=$_POST['per12'];}
			else
			{
			$per12 = 0;
			}
			if (isset($_POST['per13'])){$per13=$_POST['per13'];}
			else
			{
			$per13 = 0;
			}
			if (isset($_POST['per14'])){$per14=$_POST['per14'];}
			else
			{
			$per14 = 0;
			}
			if (isset($_POST['per15'])){$per15=$_POST['per15'];}
			else
			{
			$per15 = 0;
			}
			if (isset($_POST['per16'])){$per16=$_POST['per16'];}
			else
			{
			$per16 = 0;
			}
			if (isset($_POST['per17'])){$per17=$_POST['per17'];}
			else
			{
			$per17 = 0;
			}
			
			if (isset($_POST['per19'])){$per19=$_POST['per19'];}
			else
			{
			$per19 = 0;
			}
			if (isset($_POST['per18'])){$per18=$_POST['per18'];}
			else
			{
			$per18 = 0;
			}
			
			if (isset($_POST['per20'])){$per20=$_POST['per20'];}
			else
			{
			$per20 = 0;
			}
			if (isset($_POST['per21'])){$per21=$_POST['per21'];}
			else
			{
			$per21 = 0;
			}
			if (isset($_POST['per31'])){$per31=$_POST['per31'];}
			else
			{
			$per31 = 0;
			}
			if (isset($_POST['per32'])){$per31=$_POST['per32'];}
			else
			{
			$per32 = 0;
			}
			if (isset($_POST['per33'])){$per33=$_POST['per33'];}
			else
			{
			$per33 = 0;
			}
			if (isset($_POST['per34'])){$per34=$_POST['per34'];}
			else
			{
			$per34 = 0;
			}
			if (isset($_POST['per35'])){$per35=$_POST['per35'];}
			else
			{
			$per34 = 0;
			}
			if (isset($_POST['per_bcd_mgm'])){$per34=$_POST['per_bcd_mgm'];}
			else
			{
			$per_bcd_mgm = 0;
			}
			if (isset($_POST['per_bcd_rpt'])){$per34=$_POST['per_bcd_rpt'];}
			else
			{
			$per_bcd_rpt = 0;
			}
			if (isset($_POST['zip'])) { $zip=$_POST['zip']; }
			if (isset($_POST['country'])) { $country=$_POST['country']; }
			if (isset($_POST['username'])) { $username=$_POST['username']; }
			if (isset($_POST['password'])) { $password=$_POST['password']; }
			if (isset($_POST['mobile'])) { $mobile=$_POST['mobile']; }
			
			//For Now status is set by Default zero
			$status = 1;
			$date= date('Y-m-d h:i:s');
			$sql= "INSERT INTO user 
			SET 
			firstname ='$firstname',
			middelname ='$middelname'
			,lastname ='$lastname',
			sodowo ='$sodowo',
			cnic ='$cnic',
			address ='$address',
			city ='$city',
			email ='$email',
			state ='$state',
			zip ='$zip',
			country ='$country',
			username ='$username',
			password ='$password',
			mobile ='$mobile',
			per1 ='$per1',
			per2 ='$per2',
			per3 ='$per3',
			per4 ='$per4',
			per5 ='$per5',
			per6 ='$per6',
			per7 ='$per7',
			per8 ='$per8',
			per9 ='$per9',
			per10 ='$per10',
			per11 ='$per11',
			per12 ='$per12',
			per13 ='$per13',
			per14 ='$per14',
			per15 ='$per15',
			per16 ='$per16',
			per17 ='$per17',
			per18 ='$per18',
			per19 ='$per19',
			per20 ='$per20',
			per21 ='$per21',
			per31 ='$per31',
			per32 ='$per32',
			per33 ='$per33',
			per34 ='$per34',
			per35 ='$per35',
			per_bcd_mgm ='$per_bcd_mgm',
			per_bcd_rpt ='$per_bcd_rpt',
			status ='$status',
			create_date ='$date',
			sc_id ='".$sales."'
			";
			$command = $connection -> createCommand($sql);
        	$command -> execute();
			$last_insert_user_id = Yii::app()->db->getLastInsertID();
		//Adding Project Permission to Database
		$num_of_projects_query = 'SELECT count(id) as num_of_projects from projects';
		$num_of_projects = $connection->createCommand($num_of_projects_query)->queryAll();
		$res=array();
		foreach($num_of_projects as $num_of_projects)
		{
			$num_of_projects = 	$num_of_projects['num_of_projects'];
		}
		while ($num_of_projects>0)
		{
			if (isset($_POST[$num_of_projects]))
				{
					$project_id = $_POST[$num_of_projects]; 
					$connection = Yii::app()->db;
					$add_project_per_query = 'insert into project_permissions 
												set 
												user_id='.$last_insert_user_id.', 
												project_id='.$project_id;
					$command = $connection -> createCommand($add_project_per_query);
					$command -> execute();
				}
			$num_of_projects--;

		}
		echo "User Added Successfully<br>";
		}
		
			}
if(!empty($error))
	{			

	echo $error;	
	}
			//$this->render('Add_user',array('project_result'=>$project_result));}else{$this->redirect(array("user_list",'note'=>$note));
			
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



			 $this->redirect(array('user/dashboard'));



		}else



		{



			$error = '';






			



			 $this->redirect(array("user/user"));	



		}



		



	



	}



	



	



	



	public function actionDashboard()
	{

		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{ 
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



		$this->redirect(array('user/user'));	



			}



		



		



		}



	



	public function actionRegister()



	{



		if(Yii::app()->session['user_array']['per1']=='1')



			{



		$this->layout='//layouts/back';



		



		//If Form Submitted than Add Records into the Database



		



		if (isset($_POST['submit']))



		{



			$connection = Yii::app()->db;



		   



			$firstname=$_POST['firstname'];



			$middelname=$_POST['middelname'];



			$lastname=$_POST['lastname'];



			$sodowo=$_POST['sodowo'];



			$cnic=$_POST['cnic'];



			$address=$_POST['address'];



			$city=$_POST['city'];



			$email=$_POST['email'];



			$state=$_POST['state'];



			$zip=$_POST['zip'];



			$country=$_POST['country'];



			$username=$_POST['username'];



			$password=(md5($_POST['password']));



			



			//Exception Handling For Check Box



			



			if (isset($_POST['per1']))



			{



			$per1=$_POST['per1'];



			}



			else



			{



			$per1 = 0;



			}



			



			if (isset($_POST['per2']))



			{



			$per2=$_POST['per2'];



			}



			else



			{



			$per2 = 0;



			}



			



			if (isset($_POST['per3']))



			{



			$per3=$_POST['per3'];



			}



			else



			{



			$per3 = 0;



			}



			



			if (isset($_POST['per4']))



			{



			$per4=$_POST['per4'];



			}



			else



			{



			$per4 = 0;



			}



			



			if (isset($_POST['per5']))



			{



			$per5=$_POST['per5'];



			}



			else



			{



			$per5 = 0;



			}



			



			if (isset($_POST['per6']))



			{



			$per6=$_POST['per6'];



			}



			else



			{



			$per6 = 0;



			}



			



			if (isset($_POST['per7']))



			{



			$per7=$_POST['per7'];



			}



			else



			{



			$per7 = 0;



			}



			



			if (isset($_POST['per8']))



			{



			$per8=$_POST['per8'];



			}



			else



			{



			$per8 = 0;



			}



			



			//For Now status is set by Default zero



			



			$status = 1;



        	



			$sql= "INSERT INTO user 



			SET 



			firstname ='$firstname',



			middelname ='$middelname'



			,lastname ='$lastname',



			sodowo ='$sodowo',



			cnic ='$cnic',



			address ='$address',



			city ='$city',



			email ='$email',



			state ='$state',



			zip ='$zip',



			country ='$country',



			username ='$username',



			password ='$password',



			per1 ='$per1',



			per2 ='$per2',



			per3 ='$per3',



			per4 ='$per4',



			per5 ='$per5',



			per6 ='$per6',



			per7 ='$per7',



			per8 ='$per8',



			status ='$status'



			;";



			



			$command = $connection -> createCommand($sql);



        	$command -> execute();



			



			



		}



		



		



		$this->render('register');



			}else{$this->redirect(array("dashboard"));}



	}



	



	



	public function actionUser()



	{



		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{



			 $this->redirect(array('user/dashboard'));



		}else



		{



		$this->layout='//layouts/login';



		$this->render('user');



		}



	}



		public function actionUser1()



	{



		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{



			 $this->redirect(array('user/dashboard'));



		}else



		{



		$this->layout='//layouts/login';



		$this->render('user1');



		}



	}


public function actionSubmitstatus()
	{
			$connection = Yii::app()->db;  
		 if(Yii::app()->session['user_array']['per2']=='1')
			{ 
			$image='';
	if($_POST['status']=='Approved')
		{ 
		    $tpaction  = "UPDATE tp_action_history set 
				sec_comment='".$_POST['cmnt']."',
				sec_status='Approved',
				sec_id='".Yii::app()->session['user_array']['id']."',
				sec_date= '".date('Y-m-d H:i:s')."' 	
				WHERE id='".$_POST['achid']."'";
   			    $command = $connection -> createCommand($tpaction);
                $command -> execute();
		$connection = Yii::app()->db;  
		$sql1 ="SELECT * from transferplot where id=".$_POST['plot_id']."";
		$result_data = $connection->createCommand($sql1)->queryRow();
		  $sq ="SELECT * from memberplot where plot_id=".$result_data['plot_id']."";
		$sup = $connection->createCommand($sq)->queryRow();
		$memnumber='';
		if($_POST['plotno']!=''){$memnumber=$_POST['plotno'];}
		if($_POST['plotno']==''){$memnumber=$sup['plotno'];}
	      $sql2 = "UPDATE memberplot SET member_id ='".$result_data['transferto_id']."',plotno='".$memnumber."',mmtype='',create_date='".date('Y-m-d')."' WHERE plot_id ='".$result_data['plot_id']."'";  
	 $command = $connection -> createCommand($sql2);
    	$command -> execute();
		$sql3 = "UPDATE plots SET status ='Alotted' WHERE id = ".$result_data['plot_id']."";
    	$command = $connection -> createCommand($sql3);
    	$command -> execute();
		$sql="INSERT INTO plothistory
		SET transferplot_id='".$result_data['id']."',
		plot_id='".$result_data['plot_id']."',
		transferfrom_id='".$result_data['transferfrom_id']."',
		transferto_id='".$result_data['transferto_id']."',
		status='Approved',
		mmtype='".$sup['mmtype']."',
		cmnt='".$_POST['cmnt']."',
		msno='".$_POST['pplotno']."',
		transfer_date='".$_POST['transferdate']."'"; 	  
      $command = $connection -> createCommand($sql);
        $command -> execute();
		
		
		$sqrej = " DELETE FROM `transferplot` WHERE plot_id = '".$_POST['plot_id']."'"; 
    $command = $connection -> createCommand($sqrej);
	$command -> execute(); 
	// Insert in to member a new member
      $connection = Yii::app()->db;  
      $sql3 = "UPDATE transferplot SET status ='".$_POST['status']."', cmnt='".$_POST['cmnt']."' WHERE id = '".$_POST['plot_id']."'"; 	
    $command = $connection -> createCommand($sql3);
	$command -> execute();
	$this->redirect('req_list');
		}
		if($_POST['status']=='Rejected'){  
			  $connection = Yii::app()->db;  
		 
       $sqrej = " DELETE FROM `transferplot` WHERE plot_id = '".$_POST['plot_id']."'"; 
		  	
    $command = $connection -> createCommand($sqrej);
	$command -> execute(); 
	 $this->redirect('req_list');}
		if($_POST['status']=='Pending'){ 
		  $connection = Yii::app()->db;  
		 $sql5 = "UPDATE transferplot SET status ='".$_POST['status']."', cmnt='".$_POST['cmnt']."',image='".$image."' WHERE id = '".$_POST['plot_id']."'"; 	
    $command = $connection -> createCommand($sql5);
	$command -> execute();  $this->redirect('req_list');
	}
			}
			
	}

	public function actionLogout()



	{



	



		if(isset(Yii::app()->session['user_array']))



		{



			 $connection = Yii::app()->db;  



			 $sql_update = "UPDATE user SET login_status ='0' WHERE id = ".Yii::app()->session['user_array']['id']."";



    		 $command=$connection->createCommand($sql_update);



			 $command->execute();



			 



			 unset(Yii::app()->session['user_array']);



			 $this->redirect(array("user"));



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
				   $sql = "SELECT * FROM user where username ='".$username."' AND  status=1";
				////  $result_data = $connection->createCommand($sql)->queryRow();
				  $result_data = $connection->createCommand($sql)->queryRow();
				  if (password_verify($_POST['password'], $result_data['password1']))
				  {
				  $sql1  = 'INSERT INTO users_log (user_id,date_time) 
							VALUES ( "'.$result_data['id'].'",CURRENT_TIMESTAMP())';		
							$command = $connection -> createCommand($sql1);
							 $command -> execute();
					 $sql1 = "SELECT * FROM project_permissions left join projects on projects.id= project_permissions.project_id where projects.status=1 and user_id ='".$result_data['id']."'";
					$result_data1 = $connection->createCommand($sql1)->queryAll();
					 $sql2 = "SELECT * FROM centers_permissions where user_id ='".$result_data['id']."'";
					$result_data2 = $connection->createCommand($sql2)->queryAll();
					Yii::app()->session['centers_array']=$result_data2;
						Yii::app()->session['user_array'] = $result_data;
						Yii::app()->session['projects_array']=$result_data1;
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