<?php

class MemberController extends Controller
{
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 function actionCrop()
	 {
		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
			$this->layout='//layouts/front';
			$this->render('crop');
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
	}
	public function actionCreate()
	{
		

		$error = '';
		
		if((isset($_POST['id']) && empty($_POST['id'])) || (isset($_POST['name']) && empty($_POST['name']))|| (isset($_POST['mem_id']) && empty($_POST['mem_id']))|| (isset($_POST['dob']) && empty($_POST['address']))  || (isset($_POST['sodowo']) && empty($_POST['sodowo'])) || (isset($_POST['cnic']) && empty($_POST['cnic'])) || (isset($_POST['address']) && empty($_POST['address'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['city']) && empty($_POST['city'])) ||  (isset($_POST['country']) && empty($_POST['country']))  || (isset($_POST['phone']) && empty($_POST['phone'])) || (isset($_POST['nomineename']) && empty($_POST['nomineename'])))
		{
			$error = 'Please complete all required fields <br />';
		}
	
		
		if(isset($_POST['email']) && !empty($_POST['email']) &&  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
			$error .= 'Please enter valid Email Address<br>';
		}
				$connection = Yii::app()->db;  
		$sql_name  = "SELECT * FROM members where name ='".$_POST['email']."'";
		$result_name = $connection->createCommand($sql_name)->queryRow();
		
		
		$sql_email  = "SELECT * FROM members where email ='".$_POST['email']."'";
		$result_email = $connection->createCommand($sql_email)->queryRow();
		if($result_name || $result_email)
		{
			$error .= 'The Email Already Exists<br>';
		}
		
		 if($error==''){
		// Insert in to member a new member
          $connection = Yii::app()->db; 
		  
    $sql  = 'INSERT INTO members 
          (name,mem_id,username,password,sodowo, cnic, address, email, city, country,phone,nomineename,dob,create_date )VALUES ( "'.$_POST['firstname'].'", "'.$_POST['mem_id'].'", "'.$_POST['username'].'", "'.md5($_POST['password']).'", "'.$_POST['sodowo'].'", "'.($_POST['cnic']).'", "'.($_POST['address']).'", "'.$_POST['email'].'", "'.$_POST['city'].'", "'.$_POST['country'].'", "'.$_POST['phone'].'", "'.$_POST['nomineename'].'", "'.$_POST['dob'].'", "'.date('Y-m-d H:i:s').'" )';	
            $command = $connection -> createCommand($sql);
            $command -> execute();}
			$pw=$_POST['password']; 
			$memid=Yii::app()->db->getInsertID();	
			
			$connection = Yii::app()->db;  
		    
			$sql="SELECT * from members where id='".$memid."'";
			
			$result = $connection->createCommand($sql)->queryRow();
			
			$content='Thank You For Registeration your user name='.$_POST['username'].' and password= '.$pw.'';
			
			//mail($_POST['email'],$_POST['email'],$content);
			$useremail=(Yii::app()->session['user_array']['email']);
			
			 
			$sql1="SELECT * from user where email='".$useremail."'";
			
			$result1 = $connection->createCommand($sql1)->queryRow();
		
			$this->render('email',array('result'=>$result,'content'=>$content,'result1'=>$result1)); 		
		}
		public function actionRequestTransfer()
	 	{		
            $error ='';
	    if(isset($_POST['cnic']) && empty($_POST['cnic']))
			{
				echo $error = 'Please enter cnic<br>';
			}
						
			if($error=='')
			{	
				  $connection = Yii::app()->db;  
				  $base=$_POST['cnic'];
				  $sql ="SELECT * from members where cnic=".$base;
				  $result_data = $connection->createCommand($sql)->queryRow();
                 			      if(empty($result_data))
				  {	 
                                    $error='';
                                    if ((isset($_POST['firstname']) && empty($_POST['firstname']))){
                                        $error.="name required. <br>";
                                    }
                                   
                                    if ((isset($_POST['sodowo']) && empty($_POST['sodowo']))){
                                        $error.="SODOWO required. <br>";
                                    }
                                    if ((isset($_POST['cnic']) && empty($_POST['cnic']))){
                                        $error.="CNIC required. <br>";
                                    }
                                    if ((isset($_POST['address']) && empty($_POST['address']))){
                                        $error.="Address required. <br>";
                                    }
                                    if ((isset($_POST['email']) && empty($_POST['email']))){
                                        $error.="Email required. <br>";
                                    }
                                    if ((isset($_POST['city']) && empty($_POST['city']))){
                                        $error.="City required. <br>";
                                    }
                                    if ((isset($_POST['state']) && empty($_POST['state']))){
                                        $error.="State required. <br>";
                                    }		
		
                                    if($error==''){
					  					// Insert in to member a new member
                                        $connection = Yii::app()->db;  
                                        $sql  = 'INSERT INTO members 
                                        (name, sodowo, cnic, address, email, city )VALUES ( "'.$_POST['firstname'].'", "'.$_POST['sodowo'].'", "'.$base.'", "'.($_POST['address']).'", "'.$_POST['email'].'", "'.$_POST['city'].'" )';		
                        				$command = $connection -> createCommand($sql);
                                        $command -> execute();
							            $transferto_memberid=Yii::app()->db->getLastInsertID();						 
					 				 //$transferto_memberid = 
                                    }else{
										$this->redirect(array('transferplot'=>$error)); 
                                        exit();
                                   }
                                         }
										 else{
                                        $transferto_memberid = $result_data['id'];
				  		                 }
	            					  $sql="INSERT INTO transferplot SET plot_id='".$_POST['plot_id']."',transferfrom_id='".$_POST['transfer_from_memberid']."',transferto_id='".                                     $transferto_memberid."',status='newrequest',cmnt='New Request',create_date='".date('Y-m-d H:i:s')."'";	  
        		   					 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
		}
		
	}

	 function actionEdit()
	 {
		
		 if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
			$this->layout='column3';
			$this->render('edit_register');
			
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
		 
	}
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

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
	
	//////////////////////email member
	
	
	
	
	public function actionsend_email()
	{
		
		 if (isset($_POST["from"]))
    {
	$To = $_POST["To"];
    $from = $_POST["from"]; 
    
    $content = $_POST["content"];
    
   

		mail($To,$content,"From: $from\n");

	 	echo "Email Sended successfully";
	    $this->redirect(array('plots/plots'));
	 	
    }
		
	
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
			$this->render('index');
		}
	}
	
	public function actionDashboard()
	{	
		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
		    $this->layout='//layouts/front';
			$user_data = Yii::app()->session['member_array'];
			$connection = Yii::app()->db; 
			$sql_member = "SELECT * from members WHERE id = '".$user_data['id']."'";
			
			$result_members = $connection->createCommand($sql_member)->query();
			$sql = "SELECT mp.member_id,mp.plot_id,mp.create_date,m.image,m.phone,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,p.id,p.plot_detail_address,p.plot_size,p.street_id,s.street, j.project_name FROM
			 memberplot mp left join members m on mp.member_id=m.id
			  left join plots p on mp.plot_id=p.id
			   left join streets s on p.street_id=s.id
			left join projects j on s.project_id=j.id WHERE m.id = '".$user_data['id']."'";
			
			$result = $connection->createCommand($sql)->query();
		
		$sqlfile = "SELECT mf.member_id,mf.file_id,mf.create_date,m.image,m.phone,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,f.id,f.file_detail_address,f.file_size,f.street_id,s.street, j.project_name FROM
			 memberfile mf left join members m on mf.member_id=m.id
			  left join file f on mf.file_id=f.id
			   left join streets s on f.street_id=s.id
			left join projects j on s.project_id=j.id WHERE m.id = '".$user_data['id']."'";
			
			$resultfile = $connection->createCommand($sqlfile)->query();
		
			
			$this->render('dashboard',array('result_members'=>$result_members,'result'=>$result,'resultfile'=>$resultfile));
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }		
	}
		
 public function actionMemberimage()
	 {
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT * from members where id='".$_REQUEST['id']."'";
			
			$result_details = $connection->createCommand($sql_details)->queryRow();
			
			$this->render('dashboard',array('result_details'=>$result_details)); 		
	}		
	
	public function actionQuery()
	{
	
		  $connection = Yii::app()->db;  
	if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
	         $session=Yii::app()->session['member_array']['id'];
			 $sql  = 'INSERT INTO query (user_id,subject, message ) VALUES ( "'.$session.'", "'.$_POST['subject'].'", "'.$_POST['message'].'" )';	
			 $command = $connection -> createCommand($sql);
             $command -> execute();
			 $this->redirect('dashboard'); 
                        	
		}
	}
	
	public function actionRegister()
	{
		
		$this->layout='//layouts/back';
		$this->render('register');
		
	}
			
	
	
	public function actionUpload_image()
	{
		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
		$this->layout='//layouts/front';
		$this->render('upload_image');
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
		

	}
	function actionDoc_Upload_Form()
	 {
		
		$this->layout='//layouts/front';
		$this->render('Doc_Upload_Form');
		 
	}
	
	  function actionDoc_Upload()
	 {
		
		$this->layout='//layouts/front';
		$this->render('Doc_Upload');
		 
	}
	 function actionView_member_document()
	 {
		 
		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
		$this->layout='//layouts/front';
		$this->render('view_member_document'); }else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
		 
	}
	
public function actionUpload_memberimage()
{
  		$connection = Yii::app()->db;  
	    if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
	    $session=Yii::app()->session['member_array']['id'];
		if(!empty($_FILES["image"]["name"]))
			{
				$time_rand = time();
				$target_path="member_profile_images/";
				$target_path = $target_path.$time_rand.$_FILES['image']['name'];
				$ad=explode('.',$_FILES['image']['name']); 
				$rnd=sizeof($ad);
				$ads=$rnd-1;
			     move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
				
			}
            	$sql="UPDATE members SET image='".$time_rand.$_FILES['image']['name']."' WHERE id=$session ";

 				$command = $connection -> createCommand($sql);
                $command -> execute();
			    $this->redirect('dashboard'); 
 		}	
	
}
	
	public function actionReq_send()
	{
		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{
		$this->layout='//layouts/front';
		$this->render('req_send');
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
	}	
	public function actionMember()
	{ 
		$this->layout='//layouts/front';
		$this->render('member');
	}
	
	public function actionCss_Media()
	{ 
		$this->layout='//layouts/front';
		$this->render('www/test/css_media');
	}
	
	
	public function actionDownload()
{
	$plot_id = $_GET['plot_id'];
	$this->layout='//layouts/front';
	$connection = Yii::app()->db;  
		$sql_member  = "SELECT
    members.name
    , members.sodowo
    , members.cnic
    , members.address
    , members.dob
    , members.email
    , members.phone
    , members.image
    , members.nomineename
	,members.city
FROM
    memberplot
    LEFT JOIN members 
        ON (memberplot.member_id = members.id) where memberplot.plot_id=".$plot_id;
		
		$member_result = $connection->createCommand($sql_member)->queryAll();
	 	$this->render('pdf',array('member'=>$member_result)); 
}

	/*public function actionDownload()
	{ 
	
	$this->layout='//layouts/front';
	$connection = Yii::app()->db;  
    $user_data = Yii::app()->session['user_array'];
    $sql_plotedtails = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic,p.id,p.price,   plot_id,p.plot_detail_address,p.plot_size,s.street, 		j.project_name FROM memberplot mp left join members m on mp.member_id=m.id left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id
   left join projects j on s.project_id=j.id WHERE p.id ='".$_REQUEST['plot_id']."'";
	$plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
    $this->render('demo',array('plotdetails'=>$plotdetails));	
	}	 */
	public function actionLogout()
	{
		
		if(isset(Yii::app()->session['member_array']))
		{
			 $connection = Yii::app()->db;  
			 $sql_update = "UPDATE members SET login_status ='0' WHERE id = ".Yii::app()->session['member_array']['id']."";
    		 $command=$connection->createCommand($sql_update);
			 $command->execute();
			 unset(Yii::app()->session['member_array']);
			$this->redirect(Yii::app()->baseUrl."/index.php/web");
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
				  $sql = "SELECT * FROM members where username ='".$username."' AND  password='".$password."' AND status=1"  ;
				  $result_data = $connection->createCommand($sql)->queryRow();
				  if($result_data)
				  {
						Yii::app()->session['member_array'] = $result_data;
						echo 1;
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
	public function actionMember_list()
	{	
	if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{
	$this->layout='//layouts/front';
	$user_data = Yii::app()->session['member_array'];
    $connection = Yii::app()->db; 
	$sql_member = "SELECT mp.member_id,mp.plot_id,mp.create_date,m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id WHERE m.id = '".    $user_data['id']."'";
	$result_members = $connection->createCommand($sql_member)->query();
	$this->render('member_list',array('members'=>$result_members));
	}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
			
	}
	///////////////////////MEMBER PLOT PAYMENT///////////////
	public function actionMember_plotpayment()
	{
   if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{
	$this->layout='//layouts/front';
	$user_data = Yii::app()->session['member_array'];
    $connection = Yii::app()->db; 
	$sql = "SELECT * from plotpayment WHERE mem_id= '".$user_data['id']."' and plot_id='".$_GET['plot_id']."'";
	$result = $connection->createCommand($sql)->queryAll();
	$this->render('member_plotpayment',array('members'=>$result));
	
	
	}else
	{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); 
	}
			
	}
	//////////////////////////////////////////////////////
	
	///////////////////////MEMBER File PAYMENT///////////////
	public function actionMember_filepayment()
	{
   if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{
	$this->layout='//layouts/front';
	$user_data = Yii::app()->session['member_array'];
    $connection = Yii::app()->db; 
	$sql = "SELECT * from filepayment WHERE mem_id= '".$user_data['id']."' and file_id='".$_GET['file_id']."'";
	$result = $connection->createCommand($sql)->queryAll();
	$this->render('member_filepayment',array('members'=>$result));
	
	
	}else
	{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); 
	}
			
	}
	//////////////////////////////////////////////////////
	public function actionTransferplot()
	{	
	
	if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
	$this->layout='//layouts/front';
	$plotid = $_REQUEST['plot_id'];		 
	$connection = Yii::app()->db;  
	$sql ="SELECT * from transferplot where plot_id='".$plotid."'";
	$result_data = $connection->createCommand($sql)->queryRow();
	
	if(empty($result_data)){  
	$this->layout='//layouts/front';
	$connection = Yii::app()->db;  
    $user_data = Yii::app()->session['user_array'];
    $sql_plotedtails = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM memberplot mp left join members m on mp.member_id=m.id left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id 
   WHERE p.id ='".$_REQUEST['plot_id']."' ";
	$plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
                    	
	$this->render('transferplot',array('plotdetails'=>$plotdetails));
	exit();
	}else
	$connection = Yii::app()->db;
	$sql_new = "SELECT id FROM transferplot where plot_id=".$_REQUEST['plot_id']."";
	$result_new = $connection->createCommand($sql_new)->queryRow();	
			
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.name from_name,m_from.name from_name,m_to.name to_name,m_to.name to_name FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id='".$result_new['id']."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('req_detail',array('plotdetails1'=>$result_details)); 
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
	
	}
	public function actionPlothistory()
	{	
	if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
			$this->layout='//layouts/front';
			$connection = Yii::app()->db;
			
			$sql_page  = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp left join members m on mp.member_id=m.id
           left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id WHERE plot_id ='".$_REQUEST['id']."'";
		    $result_pages = $connection->createCommand($sql_page)->query();
			
			$sql_history  = "SELECT mp.transferfrom_id,mp.transfer_date, m.name,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM plothistory mp left join members m on mp.transferfrom_id=m.id
           left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id WHERE plot_id ='".$_REQUEST['id']."'";
		    $result_history = $connection->createCommand($sql_history)->query();
			
			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			
			
			
			$sql_plot_installment = "select installment from plots where id=1";
			$result_plot_installment = $connection->createCommand($sql_plot_installment)->query();	
			
			
			$this->render('plothistory',array('pages'=>$result_pages,'history'=>$result_history, 'projects'=>$result_projects,'num_of_installments'=>$result_plot_installment));
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
	}
	///////////////////////////FILE HISTORY////////////////
	public function actionFilehistory()
	{	
	if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
			$this->layout='//layouts/front';
			$connection = Yii::app()->db;
			
			$sql_page  = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic, m.address,p.id   file_id,p.file_detail_address,p.file_size,s.street, j.project_name FROM memberfile mp left join members m on mp.member_id=m.id
           left join file p on mp.file_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id WHERE file_id ='".$_REQUEST['id']."'";
		    $result_pages = $connection->createCommand($sql_page)->query();
			
			$sql_history  = "SELECT mp.transferfrom_id,mp.transfer_date, m.name,m.name,m.sodowo,m.cnic, m.address,p.id   file_id,p.file_detail_address,p.file_size,s.street, j.project_name FROM filehistory mp left join members m on mp.transferfrom_id=m.id
           left join file p on mp.file_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id WHERE file_id ='".$_REQUEST['id']."'";
		    $result_history = $connection->createCommand($sql_history)->query();
			
			$sql_projects  = "SELECT * from filehistory where transferfrom_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
			
			
			
			$this->render('filehistory',array('pages'=>$result_pages,'history'=>$result_history, 'projects'=>$result_projects));
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }
	}
	
		
	//////////////////////////////////////////////////////
		
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
