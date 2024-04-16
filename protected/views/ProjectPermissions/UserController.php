<?php

class UserController extends Controller
{
	
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
		
		/*if(!isset($_POST['agree']) && empty($_POST['agree']))
		{
			$error .= 'Please accept the agreement<br>';
		}*/
		
		$connection = Yii::app()->db;  
		$sql_username  = "SELECT * FROM user where username ='".$_POST['email']."'";
		$result_username = $connection->createCommand($sql_username)->queryRow();
		
		
		$sql_email  = "SELECT * FROM user where email ='".$_POST['email']."'";
		$result_email = $connection->createCommand($sql_email)->queryRow();
		if($result_username || $result_email)
		{
			$error .= 'The Email Already Exists<br>';
		}
		
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		if(empty($error))
		{
			    $model->firstname = mysql_real_escape_string(htmlentities($_POST['firstname']));
				$model->lastname = mysql_real_escape_string($_POST['lastname']);
				$model->cnic = mysql_real_escape_string($_POST['cnic']);
				$model->city = mysql_real_escape_string($_POST['city']);
				$model->state = mysql_real_escape_string($_POST['state']);
				$model->zip = mysql_real_escape_string($_POST['zip']);
				/*print_r($model->attributes);
				exit;
				$model->country = mysql_real_escape_string($_POST['country']);
				*/
				$model->middelname = mysql_real_escape_string($_POST['middelname']);
				$model->sodowo = mysql_real_escape_string($_POST['sodowo']);
				$model->username = mysql_real_escape_string($_POST['name']);
				
				$model->password = mysql_real_escape_string(md5($_POST['password']));
				$model->per1 = mysql_real_escape_string($_POST['per1']);
				$model->per2 = mysql_real_escape_string($_POST['per2']);
				$model->per3 = mysql_real_escape_string($_POST['per3']);
				$model->per4 = mysql_real_escape_string($_POST['per4']);
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

	//Send Email News Letter
	
	public function actionsend_newsletter()
	{
		$this->render('send_newsletter');
	}
	
	public function actionVirtual_tour_video_uploaded()
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
			
			$video_name = $_POST['video_name'];
			$video_description = $_POST['video_description'];
			
			$connection = Yii::app()->db;
			$sql = "insert into video_table (video_name,video_description,filename,video_thumbnail) value ("."'".$video_name."'".",'".$video_description."','".$filename."','".$vpath."')";
			$command = $connection -> createCommand($sql);
			$command -> execute() or die(mysql_error());	
		}


	}
	
	
	public function actionvirtual_tour_view_video()
	{
		$video_id = $_GET['id'];
		$connection = Yii::app()->db;
		$sql = "select filename from video_table where id=".$video_id;
		$result = $connection->createCommand($sql)->queryRow();
		
		$this->render('virtual_tour_view_video',array('filename'=>$result));

	}
	
	public function actionfilemanager()
	{
		//$connection = Yii::app()->db;
		//$sql = "";
		//$result = $connection->createCommand($sql)->queryRow();
		//$this->redirect('google.com');
	}
	
	public function actionsend_newsletter_func()
	{
		//$this->render('send_newsletter');
		//echo "done done done";
		 if (isset($_POST["from"]))
    {
	$To = $_POST["To"];
    $from = $_POST["from"]; 
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    
    //$message = wordwrap($message, 70);
    
	$To = explode(',',$To);
	
	$num_of_emails = count($To);

	$num_of_emails = $num_of_emails - 1;



    while($num_of_emails>-1){

		mail($To[$num_of_emails],$subject,$message,"From: $from\n");
   
		$num_of_emails --;
	
	}
	 	echo "Email Sended successfully";
	    $this->redirect(array("send_newsletter"));
	 	
    }
		
	
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 public function actionReq_list()
	 {
		 if(Yii::app()->session['user_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.firstname from_firstname,m_from.lastname from_lastname,m_to.firstname to_firstname,m_to.lastname to_lastname FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.status='newrequest' ";
			
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
			$sql_details  = "SELECT * from query where id='".$_REQUEST['id']."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
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
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.firstname from_firstname,m_from.lastname from_lastname,m_to.firstname to_firstname,m_to.lastname to_lastname FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.status='pending' ";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('pend_req_list',array('plotdetails'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}
	public function actionRej_req_list()
	 {
		 if(Yii::app()->session['user_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.firstname from_firstname,m_from.lastname from_lastname,m_to.firstname to_firstname,m_to.lastname to_lastname FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.status='rejected' ";
			
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

		$error = '';
		if(empty($error))
		{
			   $connection = Yii::app()->db;  
               $sql  = 'INSERT INTO register_member_answer 
                	      (user_id, message )
               	    	  VALUES ( "'.$_POST['user_id'].'", "'.$_POST['message'].'" )';		
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   $this->redirect('dashboard'); 
			   
		}else
		{
			echo 123;
			exit;
			echo json_encode(array($error,$_POST));
		}
		
			 
		
			exit;
	}

	 function actionDelete_query()
	 {
		 
		 if(Yii::app()->session['user_array']['per4']=='1')
			{
		  $connection = Yii::app()->db;
	  $sql  = "Delete from query where id='".$_REQUEST['id']."'";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			
		 		 $this->redirect(array("user/register_member_query"));		
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


/*	
	public function actionMail_unregister_user()
	
	{ 
		$error = '';
		if(empty($error))
		{
			   $connection = Yii::app()->db;  
             
			   //$name=$_POST['id'];
			 //  $subject=$_POST['subject'];
			 //  $message=$_POST['message'];
			//  mail("webmaster@example.com",$subject,$message,"From: $from\n");
		      $this->redirect('dashboard'); 
			   
		}else
		{
			echo 123;
			exit;
			echo json_encode(array($error,$_POST));
		}
		
			 
		
			exit;
	} */
	
	public function actionVirtual_tour_upload_video()
	 {
		
			$this->render('virtual_tour_upload_video');
	}
	
	
	public function actionVirtual_tour_video_gallery()
	 {
		
			$connection = Yii::app()->db;
			$sql = "select * from video_table";
			$vresult = $connection->createCommand($sql)->queryAll();
			$this->render('virtual_tour_video_gallery',array('vresult'=>$vresult));
	}
	
	public function actionRegister_member_query()
	 {
		 
		 if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "select * from query";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('Register_member_query',array('register_member_query'=>$result_details));
	
						}else{$this->redirect(array("dashboard"));}

	}




public function actionMail()
	
	{ 
			   /*?> $connection = Yii::app()->db;  
               $sql  = 'INSERT INTO unregister_user_query_answer  (id,name,email, message )
               	    	  VALUES ( "'.$_POST['id'].'", "'.$_POST['name'].'", "'.$_POST['email'].'", "'.$_POST['message'].'" )';
			   $command = $connection -> createCommand($sql);
               $command -> execute();<?php 
			   from
			   
			   
			   
			   */
			    $subject = $_POST["subject"];
     		    $message = $_POST["message"];
			    $email = $_POST["email"];
			    mail($email ,$subject ,$message);  
			    $this->redirect('dashboard'); 
			   
	}


	public function actionMembershiprequest()
	     {
		 
		 if(Yii::app()->session['user_array']['per7']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "select * from members where status=0";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('membershiprequest',array('membershiprequest'=>$result_details));
	
			}else{
				$this->redirect(array("dashboard"));
				}

	   }

	/////////////FOr Membership Detail   
	public function actionMembership_detail()
	     {
		 
		 if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT * from members where id='".$_REQUEST['id']."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('membership_detail',array('membershipdetail'=>$result_details));
	
			}else{$this->redirect(array("dashboard"));}

	   }
	   /////////////FOr User Detail   
	public function actionUser_detail()
	     {
		 
		
			$connection = Yii::app()->db; 	
			$session=Yii::app()->session['user_array']['id'];
			$sql_details  = "SELECT * from user where id='".$session."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('user_detail',array('user_detail'=>$result_details));
	
			

	   }



///////////////////////////for update member status


public function actionMemberupdate()
	{
	
		if(isset(Yii::app()->session['user_array']))
		{
			 $connection = Yii::app()->db;  
			if($_POST['status']==1)
			{
			
			 $sql_update = "UPDATE members SET status ='1' WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("membershiprequest"));
			 
			 }
			if($_POST['status']==0)
			{
			 $sql_delete = "Delete from  members  WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_delete);
             $command -> execute();
			 $this->redirect(array("membershiprequest"));
			
			}
			// $this->render('membership_detail',array('membershipdetail'=>$result_details));
	
			}else{
				$this->redirect(array("dashboard"));
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
			$sql_project  = "SELECT * from unregister_user_query_answer ";
			$result_projects = $connection->createCommand($sql_project)->query();
			$this->render('mail_unregister_user',array('mail_unregister_user'=>$result_projects));
			$error = '';
		
		}
			}else {$this->redirect(array("dashboard")); }
	 }
	
	  
	  
	  
	  
	  
 public function actionVisitor_query()
	 {
		
		 if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "select * from unregister_user_query";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('visitor_query',array('visitorqueries'=>$result_details));
	
			}else{$this->redirect(array("dashboard"));}
	}
	
	
	
	public function actionAppro_req_list()
	 {
		 if(Yii::app()->session['user_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.firstname from_firstname,m_from.lastname from_lastname,m_to.firstname to_firstname,m_to.lastname to_lastname FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.status='approved' ";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('appro_req_list',array('plotdetails'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}
	
	public function actionMemhistory()
	{	
			if(Yii::app()->session['user_array']['per2']=='1')
			{
			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			
			$sql_page  = "SELECT mp.member_id,mp.create_date, m.firstname,m.lastname,m.sodowo,m.cnic,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE member_id ='".$_REQUEST['id']."'";
			$result_pages = $connection->createCommand($sql_page)->query();
			
			$sql_mem  = "SELECT * from members where id='".$_REQUEST['id']."'";
			$result_mems = $connection->createCommand($sql_mem)->query();
			
			//$result_pages = $connection->createCommand($sql_page)->queryRow();
			$this->render('memhistory',array('projects'=>$result_projects,'pages'=>$result_pages,'member'=>$result_mems));
			}else{$this->redirect(array("dashboard"));}
	}
	
	public function actionPlothistory()
	{	
	if(Yii::app()->session['user_array']['per2']=='1')
	{
			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			
			$sql_page  = "SELECT mp.member_id,mp.create_date, m.firstname,m.middelname,m.lastname,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE plot_id ='".$_REQUEST['id']."'";
			$result_pages = $connection->createCommand($sql_page)->query();
			
			
			
			//$result_pages = $connection->createCommand($sql_page)->queryRow();
			$this->render('plothistory',array('projects'=>$result_projects,'pages'=>$result_pages));
	}else{$this->redirect(array("dashboard"));}
	}
	
	
	 public function actionReq_detail()
	 {
	if(Yii::app()->session['user_array']['per6']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.firstname from_firstname,m_from.lastname from_lastname,m_to.firstname to_firstname,m_to.lastname to_lastname FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id=".$_REQUEST['id']."";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('req_detail',array('plotdetails'=>$result_details)); 
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
	$this->render('update_user',array('update_user'=>$result_projects));
			}else{$this->redirect(array("dashboard"));}
	}
	
	public function actionUpdate()
	{
		 
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
		 if (!empty($_POST['password']))
		 {
		 	$password = md5($_POST['password']);
		 }
		 else
		 {
		 	$password = $_POST['password_not_changed'];
		 }
		 
		 $connection = Yii::app()->db;
	     //$target_path=Yii::app()->request->baseUrl.'/images/'>
		     $id=$_POST['id']; 
		   
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
			
			
			
			
			$sql_update = "UPDATE user SET firstname ='$firstname',middelname ='$middelname',lastname ='$lastname',sodowo ='$sodowo',cnic ='$cnic',address ='$address',city ='$city',email ='$email',state ='$state',zip ='$zip',country ='$country',username ='$username',password ='$password',per1 ='$per1',per2 ='$per2',per3 ='$per3',per4 ='$per4',per5 ='$per5',per6 ='$per6',per7 ='$per7',per8 ='$per8' WHERE id =".$id;
	
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("user_list"));		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
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
			/*$dataProvider=new CActiveDataProvider('User');*/
			$this->render('user');
		}
		
	
	}
	
	
	
	public function actionDashboard()
	{
		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{ 
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.firstname from_firstname,m_from.lastname from_lastname,m_to.firstname to_firstname,m_to.lastname to_lastname FROM transferplot tp
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
		
		
		//Getting Projects List for ComboBox
		$connection = Yii::app()->db;
		$project_sql = 'SELECT id,project_name from projects';
		$project_result = $connection->createCommand($project_sql)->queryAll();
		
		
		//If Form Submitted than Add Records into the Database
		
		if (isset($_POST['submit']))
		{
			
			//Checking User Already Exists or Not
			$connection = Yii::app()->db;
			$check_user_query = 'select username from user where username="'.$_POST['username'].'"';
			$check_user_result = $connection->createCommand($check_user_query)->queryAll();
			
			if (isset($check_user_result))
			{
			$res=array();
			foreach($check_user_result as $check_user_result)
			{
				$user_exists = $check_user_result['username'];
			}
			
			if (isset($user_exists))
				{
					$user_exists = 1;
				}
			else
				{
					$user_exists = 0;
				}
			}
			
			if ($user_exists == 0){
			$connection = Yii::app()->db;
		   
			$firstname=$_POST['firstname'];
			$middelname=$_POST['middelname'];
			$lastname=$_POST['lastname'];
			$sodowo=$_POST['sodowo'];
			$cnic=$_POST['cnic'];
			$address=$_POST['address'];
			$city=$_POST['city'];
			$email=$_POST['email'];
			$state=$_POST['state'];			//Exception Handling For Check Box
			
			if (isset($_POST['per1']))
			{
			$per1=$_POST['per1'];
			}
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
			$zip=$_POST['zip'];
			$country=$_POST['country'];
			$username=$_POST['username'];
			$password=(md5($_POST['password']));
			

			
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
			
		
		}else{
			echo "User Already Exists!";
		}
	
	}
		
		
			$this->render('register',array('project_result'=>$project_result));}else{$this->redirect(array("dashboard"));}
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
	
	public function actionSubmitstatus()
	{
	if($_POST['status']=='approved')
		{
		$connection = Yii::app()->db;  
		$sql1 ="SELECT * from transferplot where id=".$_POST['plot_id']."";
		$result_data = $connection->createCommand($sql1)->queryRow();
		
		
		$sql="INSERT INTO plothistory
		SET transferplot_id='".$result_data['id']."',
		plot_id='".$result_data['plot_id']."',
		transferfrom_id='".$result_data['transferfrom_id']."',
		transferto_id='".$result_data['transferto_id']."',
		status='Approved',
		cmnt='".$_POST['cmnt']."',
		transfer_date='".$result_data['create_date']."'";	  
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$sql2 = "UPDATE memberplot SET member_id ='".$result_data['transferto_id']."' WHERE id = ".$result_data['id']."";	
    	$command = $connection -> createCommand($sql2);
    	$command -> execute();
		}
		if($_POST['status']=='rejacted'){}
		if($_POST['status']=='panding'){}
		
		else{			 
		}
	$error =array();
    if ((isset($_POST['status']) && empty($_POST['status']))){
        $error="Status required. <br>";
    }
    
    if ((isset($_POST['cmnt']) && empty($_POST['cmnt']))){
     $error .="Comment required. <br>";
    }		
	
	if($error==''){
	
	echo $error;
    exit();
    }else{
	
	// Insert in to member a new member
    $connection = Yii::app()->db;  
    $sql = "UPDATE transferplot SET status ='".$_POST['status']."', cmnt='".$_POST['cmnt']."' WHERE id = ".$_POST['plot_id']."";	
    $command = $connection -> createCommand($sql);
    $command -> execute();
	$this->redirect('req_list');
    // $transferto_memberid = 
	}
	}
	public function actionLogout()
	{
		/*session_start();
		if(isset($_SESSION))
		{
			session_destroy();
			$this->redirect(array("index"));
		}*/
		if(isset(Yii::app()->session['user_array']))
		{
			 $connection = Yii::app()->db;  
			 $sql_update = "UPDATE user SET login_status ='0' WHERE id = ".Yii::app()->session['user_array']['id']."";
    		 $command=$connection->createCommand($sql_update);
			 $command->execute();
			 /*$sql_delete = "Delete from users_source WHERE id = ".Yii::app()->session['user_array']['id']."";
    		 $command=$connection->createCommand($sql_delete);
			 $command->execute();*/
			 unset(Yii::app()->session['user_array']);
			 $this->redirect(array("user"));
		}
		
		}
		public function actionGetLogin()
	 	{
		 $error =array();
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
						echo 1;
						
						//Projects Permission
				  
				  		$connection = Yii::app()->db;
				  		$projects_query = 'select * from project_permissions where user_id='.$result_data['id'];
				  		$result_projects = $connection->createCommand($projects_query)->queryAll();
				  
				 		Yii::app()->session['projects_array'] = $result_projects;
				 		
						
						//Ends Here
						
						exit();
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
