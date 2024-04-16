<?php
Yii::import('ext.swiftMailer.SwiftMailer');
// Create a new Transport object
////$Transport = SwiftMailer::smtpTransport($host, $port);
class MemberController extends Controller

{
  
 //////START:DASHBOARD//////////////
 	public function actionChangepasswrd()
	{ 
	$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		$error = array();
		$error = "";
		if(empty($_POST['newpassword'])|| empty($_POST['oldpassword'])|| empty($_POST['cnewpassword']))
		{
			echo $error = "Please Enter Data in All Field ";exit;
			
		}else{
					 $sql_member="Select password from members where id='".$uid."'";
					$result = $connection->createCommand($sql_member)->queryRow();
					if($result['password']==$_POST['oldpassword'])
					{
							if($_POST['newpassword']==$_POST['cnewpassword'])
								{
									 $sql = "UPDATE members SET password='".$_POST['newpassword']."' WHERE id='".$uid."'";
									$command = $connection->createCommand($sql);
									$command->execute();
									echo 'Password Change Successfully';										
								}								
					}
					else
					{
						echo 'Wrong Old Password Entered';
			
					}
			}
	}
	public function actionForgot_password()
	{
		//$uid = yii::app()->session['member_array']['id'];	
			$this->layout = '//layouts/login1';
			$this->render('forgot_password');
	}
	public function actionInbox()
	{    $uid=Yii::app()->session['member_array']['id'];
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;
			$sql_inbox = "SELECT * from register_member_answer where status=0 and user_id='".$uid."' order by date";
			$result_inbox = $connection->createCommand($sql_inbox)->queryAll();
			$sql_inbox1 = "SELECT count(id) as total from register_member_answer where user_id='".$uid."' and status=0 order by date";
			$result_inbox1 = $connection->createCommand($sql_inbox1)->queryRow();
			$this->render('inbox', array('inbox' => $result_inbox,'inbox1' => $result_inbox1));	
			//$this->render('profile');
		} else {
			$this->redirect(array("dashboard"));
		}
	} 
  public function actionApps()
	
	{    $uid=Yii::app()->session['member_array']['id'];
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
		
			$this->render('apps');	
			//$this->render('profile');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionNews()
	
	{    $uid=Yii::app()->session['member_array']['id'];
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;
			$sql_news = "SELECT * from latest_news where status='Active' order by create_date";
			$result_news = $connection->createCommand($sql_news)->queryAll();
			$this->render('news', array('news' => $result_news));	
			//$this->render('profile');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
    public function actionSendmessage()
	
	{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('sendmessage');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionChangepassword()
	
	{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('changepassword');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionPaymentsummary()
	
	{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('paymentsummary');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionTransaction()
	
	{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('transaction');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionMytransaction()
	{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "
		  
		  SELECT rpt_print.r_no,mp.plotno,receipt.create_date,receipt.type,receipt.comm,receipt.amount,receipt.fstatus, m.name, receipt.id AS rid, m.cnic AS mcnic, receipt.create_date AS rcd FROM receipt 
		  INNER JOIN members m ON receipt.mem_id = m.id 
		  INNER JOIN rpt_print ON rpt_print.rid = receipt.id 
		  INNER JOIN plots p ON rpt_print.msid = p.id 
		  INNER JOIN memberplot mp ON p.id = mp.plot_id 
		  WHERE m.id='".$uid."' ORDER BY receipt.create_date DESC";
		$result_data = $connection->createCommand($sql_data)->query();
		$i=1;
		foreach($result_data as $key){
		echo '<tr>
<td class="center">'.$i.'</td>
<td class="">'.date('d-m-Y',strtotime($key['create_date'])).'</td>
<td class="">'.$key['plotno'].'</td>
<td class="hidden-480">'.$key['type'].'</td>
<td class="hidden-480">'.$key['comm'].'</td>
<td class="">'.$key['amount'].'</td>
<td class="">'.$key['r_no'].'</td>
<td >'.($key['name']).'</td>
<td class="hidden-480">'.($key['fstatus']).'</td>
</tr>';	$i++;
		}
	}
	public function actionProfile()
	
	{    $uid=Yii::app()->session['member_array']['id'];
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;
			$sql_member = 'SELECT mem.*,cont.country,ct.city from members mem
			 INNER JOIN tbl_country cont ON mem.country_id = cont.id 
		       INNER JOIN tbl_city ct ON mem.city_id = ct.id 
			 where mem.id='.$uid;
			$result_member = $connection->createCommand($sql_member)->queryAll();
			$this->render('profile', array('member' => $result_member));	
			
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	
	public function actionCancellation()
		{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('cancellation');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionMyCancel()
	{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "SELECT m.nomineename, s.sector_name, pro.project_name, p.com_res, mp.app_no, mp.mstatus AS stst, mp.plotno AS plotno, mp.create_date, p.com_res, p.id, p.type, p.project_id, mp.plotno, p.plot_detail_address, mp.plot_id, p.plot_size, p.project_id, p.street_id, p.status AS pstatus, mp.id AS msid, size_cat.size FROM cancelplot cancel left JOIN plots p on p.id=cancel.plot_id left JOIN memberplot mp on p.id=mp.plot_id left JOIN members m on mp.member_id=m.id left JOIN projects pro on p.project_id=pro.id LEFT JOIN sectors s ON p.sector = s.id LEFT JOIN size_cat size_cat ON size_cat.id = p.size2 WHERE cancel.member_id ='".$uid."'";
		$result_data = $connection->createCommand($sql_data)->query();
		$i=1;
		foreach($result_data as $key){
		echo '<tr>
<td class="center">'.$i.'</td>
<td class="">'.$key['project_name'].'</td>
<td class="">'.$key['com_res'].'</td>
<td class="">'.$key['plotno'].'</td>
<td class="hidden-480">'.$key['app_no'].'</td>
<td class="">'.$key['sector_name'].'</td>
<td class="">'.$key['nomineename'].'</td>
<td class="hidden-480">'.date('d-m-Y',strtotime($key['create_date'])).'</td>
<td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-info btn-small dropdown-toggle">Action<span class="caret"></span></button>
			<ul class="dropdown-menu">
			<li><a href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li><a href="plothistory?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">History</a></li> 
			</ul>
		  </div></td>
</tr>';	$i++;
		}
	}
	public function actionMyTransfers()
	{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "SELECT m_from.name from_name, m_to.name to_name, s.sector_name, j.project_name, p.com_res, mp.app_no, mp.plotno AS plotno, tp.create_date, p.id, p.project_id, mp.plot_id, size_cat.size FROM transferplot tp LEFT JOIN memberplot mp ON mp.plot_id = tp.plot_id LEFT JOIN members m_from ON m_from.id = tp.transferfrom_id LEFT JOIN members m_to ON m_to.id = tp.transferto_id LEFT JOIN plots p ON mp.plot_id = p.id LEFT JOIN size_cat size_cat ON size_cat.id = p.size2 LEFT JOIN sectors s ON p.sector = s.id LEFT JOIN projects j ON p.project_id = j.id  WHERE (tp.transferfrom_id = '".$uid."' || tp.transferto_id='".$uid."') and tp.status !='Approved' Order By tp.create_date";
		$result_data = $connection->createCommand($sql_data)->query();
		$i=1;
		foreach($result_data as $key){
		echo '<tr>
<td class="center">'.$i.'</td>
<td class="">'.$key['project_name'].'</td>
<td class="">'.$key['com_res'].'</td>
<td class="">'.$key['plotno'].'</td>
<td class="hidden-480">'.$key['app_no'].'</td>
<td class="">'.$key['sector_name'].'</td>
<td class="">'.$key['from_name'].'</td>
<td class="">'.$key['to_name'].'</td>
<td class="hidden-480">'.date('d-m-Y',strtotime($key['create_date'])).'</td>
<td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-info btn-small dropdown-toggle">Action<span class="caret"></span></button>
			<ul class="dropdown-menu">
			<li><a href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li><a href="plothistory?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">History</a></li> 
			</ul>
		  </div></td>
</tr>';	$i++;
		}
	}
	public function actionTransfer()
		{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('transfer');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionMyjointmembership()
	{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "SELECT
    m.nomineename,
    s.sector_name,
    pro.project_name,
    p.com_res,
    mp.app_no,
    mp.mstatus AS stst,
    mp.plotno AS plotno,
    mp.create_date,
    p.com_res,
    p.id,
    p.type,
    p.project_id,
    mp.plotno,
    p.plot_detail_address,
    mp.plot_id,
    p.plot_size,
    p.project_id,
    p.street_id,
    p.status AS pstatus,
    mp.id AS msid,
    size_cat.size


FROM
    `associates` assoc
    left JOIN members m on assoc.mid=m.id
    left JOIN memberplot mp on assoc.msid=mp.id
    left JOIN plots p on p.id=mp.plot_id
    left JOIN projects pro on p.project_id=pro.id
    LEFT JOIN sectors s ON p.sector = s.id
    LEFT JOIN size_cat size_cat ON size_cat.id = p.size2
WHERE
    assoc.mid ='".$uid."'";
		$result_data = $connection->createCommand($sql_data)->query();
		$i=1;
		foreach($result_data as $key){
		echo '<tr>
<td class="center">'.$i.'</td>
<td class="">'.$key['project_name'].'</td>
<td class="">'.$key['com_res'].'</td>
<td class="">'.$key['plotno'].'</td>
<td class="">'.$key['app_no'].'</td>
<td class="">'.$key['sector_name'].'</td>
<td class="hidden-480">'.$key['nomineename'].'</td>
<td class="hidden-480">'.date('d-m-Y',strtotime($key['create_date'])).'</td>
<td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-info btn-small dropdown-toggle">Action<span class="caret"></span></button>
			<ul class="dropdown-menu">
			<li><a href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li><a href="plothistory?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">History</a></li> 
			</ul>
		  </div></td>
</tr>';	$i++;
		}
	}
	public function actionJointMembership()
		{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('jointmembership');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionAllotments()
		{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('allotments');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionMyallotments()
	{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "SELECT m.nomineename,s.sector_name,j.project_name,p.com_res,mp.app_no,mp.mstatus as stst,mp.plotno as plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,mp.plotno,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,size_cat.size FROM memberplot mp
										 left join members m on mp.member_id=m.id
										  left join plots p on mp.plot_id=p.id
										 left join size_cat size_cat on size_cat.id=p.size2
										  left join sectors s on p.sector=s.id
										 left join projects j on p.project_id=j.id where member_id='".$uid."'";
		$result_data = $connection->createCommand($sql_data)->query();
		$i=1;
		foreach($result_data as $key){
		echo '<tr>
<td class="center">'.$i.'</td>
<td class="">'.$key['project_name'].'</td>
<td class="">'.$key['com_res'].'</td>
<td class="">'.$key['plotno'].'</td>
<td class="">'.$key['app_no'].'</td>
<td class="">'.$key['sector_name'].'</td>
<td class="hidden-480">'.$key['nomineename'].'</td>
<td class="hidden-480">'.date('d-m-Y',strtotime($key['create_date'])).'</td>
<td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-info btn-small dropdown-toggle">Action<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			  <li><a href="plothistory?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">History</a></li> 
			</ul>
		  </div></td>
</tr>';	$i++;
		}
	}
	public function actionBooking1()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		 $sql_street  = "SELECT count(id) as booking from memberplot where member_id='".$uid."' and status='Sales'";
		$result_streets = $connection->createCommand($sql_street)->query();
		$street = array();
		foreach ($result_streets as $str) {
			$street[] = $str;
		}
		echo json_encode($street);
		exit();
	}
	public function actionBooking()
		{
		$this->layout = '//layouts/login2';
		if(isset(Yii::app()->session['member_array']['username'])) {
			$connection = Yii::app()->db;	
			$this->render('booking');
		} else {
			$this->redirect(array("dashboard"));
		}
	}
	public function actionMybookings()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "SELECT m.nomineename,s.sector_name,j.project_name,p.com_res,mp.app_no,mp.mstatus as stst,mp.plotno as plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,mp.plotno,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,size_cat.size FROM memberplot mp
										 left join members m on mp.member_id=m.id
										  left join plots p on mp.plot_id=p.id
										 left join size_cat size_cat on size_cat.id=p.size2
										  left join sectors s on p.sector=s.id
										 left join projects j on p.project_id=j.id where member_id='".$uid."' and mp.status='Sales'";
		$result_data = $connection->createCommand($sql_data)->query();
		$i=1;
		foreach($result_data as $key){
		echo '<tr>
<td class="center">'.$i.'</td>
<td class="">'.$key['project_name'].'</td>
<td class="">'.$key['com_res'].'</td>
<td class="">'.$key['plotno'].'</td>
<td class="">'.$key['app_no'].'</td>
<td class="">'.$key['sector_name'].'</td>
<td class="hidden-480">'.$key['nomineename'].'</td>
<td class="hidden-480">'.date('d-m-Y',strtotime($key['create_date'])).'</td>
<td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-info btn-small dropdown-toggle">Action<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			  <li><a href="plothistory?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">History</a></li> 
			</ul>
		  </div></td>
</tr>';	$i++;
		}    
		    
	}
	public function actionAlt()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		 $sql_alt  = "SELECT count(id) as alt  FROM memberplot mp where member_id='".$uid."'";
		$result_alt = $connection->createCommand($sql_alt)->query();
		$street = array();
		foreach ($result_alt as $alt) {
			$alt[] = $alt;
		}
		echo json_encode($alt);
		exit();
	}
	public function actionJm()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		 $sql_jm  = "SELECT count(mid) as jm from associates WHERE mid='".$uid."'";
		$result_jm = $connection->createCommand($sql_jm)->query();
		$jm = array();
		foreach ($result_jm as $jm) {
			$jm[] = $jm;
		}
		echo json_encode($jm);
		exit();
	}
	public function actionTrans()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		 $sql_trans  = "SELECT count(transferplot.id) as trans from transferplot where (transferto_id='".$uid."' || transferfrom_id='".$uid."') and transferplot.status !='Approved'";
		$result_trans = $connection->createCommand($sql_trans)->query();
		$street = array();
		foreach ($result_trans as $trans) {
			$trans[] = $trans;
		}
		echo json_encode($trans);
		exit();
	}
	public function actionCancelplot()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		 $sql_cancel  = "SELECT count(plots.id) as cancel from plots left join memberplot on memberplot.plot_id=plots.id where (memberplot.member_id='".$uid."') and plots.status ='Requested(C)'";
		$result_cancel = $connection->createCommand($sql_cancel)->query();
		$street = array();
		foreach ($result_cancel as $cancel) {
			$cancel[] = $cancel;
		}
		echo json_encode($cancel);
		exit();
	}
	public function actionMyPaymentsummary()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "SELECT discnt.discount,p.PLcharges,p.price,j.project_name,p.com_res,mp.app_no,mp.mstatus as stst,mp.plotno as plotno,mp.create_date,p.com_res,p.id as id,p.type,p.project_id,mp.plotno,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,size_cat.size FROM memberplot mp
										 left join plots p on mp.plot_id=p.id
										 left join discnt discnt on mp.id=discnt.ms_id
										 
										 left join size_cat size_cat on size_cat.id=p.size2
										 left join projects j on p.project_id=j.id where member_id='".$uid."'";
		$result_data = $connection->createCommand($sql_data)->queryAll();
		;$i=1;
		$paidamount=0;
		$dueamount=0;
		$tprice=0;
				foreach($result_data as $key)
				{
					  $sql_payment  = "SELECT paidamount,dueamount,(dueamount) as totaldue,SUM(paidamount) as totalpaid FROM installpayment where (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='') and others !='Cancelled'  and plot_id='".$key['id']."' ";
					 $result_payments = $connection->createCommand($sql_payment)->queryAll();
					foreach($result_payments as $key1){
					//$paidamount=floatval($paidamount)+floatval($key1['paidamount']);
					//$dueamount=($key1['totaldue'])-($key1['totalpaid']);
					$tprice=floatval(($key['price'])+floatval($key['PLcharges'])-$key['discount']);
					echo '
					<tr>
						<td class="">'.$i.'</td>
						<td>'.$key['project_name'];echo '</td>
						<td>';if(!empty($key['plotno'])) { echo $key['plotno'];}else{ echo $key['app_no']; }echo'</td>
						<td>';echo $key['com_res'];echo '</td>
						<td>';echo $key['size'];echo '</td>
						<td>';echo $tprice;echo '</td>
						<td>';echo $key1['totalpaid'];echo '</td>
						<td>';echo $tprice-$key1['totalpaid'];echo '</td> 
						
				</tr>';
				$i++;
				}
				}
				
  


	}
	public function actionPropertydata()
		{
		$uid=Yii::app()->session['member_array']['id'];
		$connection = Yii::app()->db;
		  $sql_data  = "SELECT j.project_name,p.com_res,mp.app_no,mp.mstatus as stst,mp.plotno as plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,mp.plotno,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,size_cat.size FROM memberplot mp
										 left join plots p on mp.plot_id=p.id
										 left join size_cat size_cat on size_cat.id=p.size2
										 left join projects j on p.project_id=j.id where member_id='".$uid."'";
		$result_data = $connection->createCommand($sql_data)->query();
		echo '<table id="table_bug_report" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th><i>Sr N0</i></th>
						<th><i></i> Project</th>
						<th>MS No/App No</th>
						<th>Property Type</th>
						<th>Property Size</th>
						
					</tr>
				</thead>
				<tbody>';$i=1;
				foreach($result_data as $key)
				{
					
					echo '
					<tr>
						<td class="">'.$i.'</td>
						<td>'.$key['project_name'].'</td>
						<td>';if(!empty($key['plotno'])) { echo $key['plotno'];}else{ echo $key['app_no']; }echo'</td>
						<td>'.$key['com_res'].'</td>
						<td>'.$key['size'].'</td>
						
				</tr>';
				$i++;
				}
				echo'</tbody>
			  </table>';	
  //$sql_project = "SELECT DISTINCT projects.project_name
// FROM projects  WHERE
//projects.STATUS
 //   = 1";
//			 $result_project = $connection->createCommand($sql_project)->query();
//foreach($result_data as $projects){
//	  $i=2;
//echo ' <tr>
 //   <th rowspan="'.$i.'">'.$projects['project_name'].' </th>
 //   <td>'.$projects['com_res'].'</td>
    
 //   <td rowspan=>Total Value</td>
 // </tr>';
			/*
			echo'<table class="table table-bordered table-striped">
<thead class="thin-border-bottom">
<tr>
    <th class="text-left">Project</th>
    <th>Type</th>
    <th>Plots</th>
    <th>Total</th>
  </tr>'; 
  $sql_project = "SELECT DISTINCT projects.project_name
 FROM projects  WHERE
projects.STATUS
    = 1";
			 $result_project = $connection->createCommand($sql_project)->query();
foreach($result_project as $projects){
	  $i=2;
echo ' <tr>
    <th rowspan="'.$i.'">'.$projects['project_name'].' </th>
    <td>Residential</td>
    <td>Residential Plots Value</td>
    <td rowspan=>Total Value</td>
  </tr>
  <tr>
    <td>Commercial</td> 
    <td>Commercial Plots Value</td>
  </tr>
</table>'; <tr>
    <th rowspan="2">Sargodha </th>
    <td>Residential</td>
    <td>Residential Plots Value</td>
    <td rowspan="2">Total Value</td>
  </tr>
  <tr>
    <td>Commercial</td> 
    <td>Commercial Plots Value</td>
  </tr>
  <tr>
    <th rowspan="2">Sahiwal </th>
    <td>Residential</td>
    <td>Residential Plots Value</td>
    <td rowspan="2">Total Value</td>
  </tr>
  <tr>
    <td>Commercial</td> 
    <td>Commercial Plots Value</td>
  </tr>*/
//$i++;}

	}
////////////END:DASHBARD///////////////
	
//////////////////////////////START:Land Owner Module////////////////////////////////
		public function actionAdd_landowner()
	     {
	if(isset(Yii::app()->session['user_array']['username']))
			{
				$this->layout='//layouts/back';
		          $connection = Yii::app()->db; 
		  $sql_projects  = "SELECT * from projects";
		$result_projects = $connection->createCommand($sql_projects)->queryAll();
		$this->render('add_landwoner',array('projects'=>$result_projects));
			}else{
				$this->redirect(array('user/dashboard'));
				}
		}
		public function actionAdd()
	     {	
		 if(isset(Yii::app()->session['user_array']['username']))
			{			
						 if(isset($_FILES['image']))
						 { 
						 $last_insert_lo_id='';
						 $path="images/landowner/";
						  $image=$_FILES['image']["name"];
						  $newfilename = $_FILES["image"]["name"];			
						  move_uploaded_file($_FILES["image"]["tmp_name"],$path.$image);
						 }
						 $connection = Yii::app()->db; 
					     $sql  = 'INSERT INTO tbl_landowner (title,name,phone, email,image,remarks,create_date,status )
						 VALUES
						 ("'.($_POST['title']).'",
						 "'.$_POST['name'].'",
						 "'.$_POST['phone'].'",
						 "'.$_POST['email'].'", 
						 "'.$newfilename.'", 
						 "'.$_POST['remarks'].'", 
						 "'.date('Y-m-d').'",1)';
						 	
					$command = $connection -> createCommand($sql);
					$command -> execute();
					$last_lo_id = Yii::app()->db->getLastInsertID();
					
		//Adding Project Permission to Database
		$num_of_projects_query = 'SELECT count(id) as num_of_projects from projects';
		$num_of_projects = $connection->createCommand($num_of_projects_query)->queryAll();
		$res=array();
		foreach($num_of_projects as $num_of_projects)
		{
			$num_of_projects = $num_of_projects['num_of_projects'];
		}
		while ($num_of_projects>0)
		{
			if (isset($_POST[$num_of_projects]))
				{   
					$project_id = $_POST[$num_of_projects]; 
					$connection = Yii::app()->db;
					 $add_project_per_query = 'insert into project_perm_lo 
												set 
												lo_id='.$last_lo_id.', 
												project_id='.$project_id;
					$command = $connection -> createCommand($add_project_per_query);
					$command -> execute();
				}
			$num_of_projects--;

		}
					$this->render('landownerlist');
					
			}else
			{
			  $this->redirect('dashboard');
			}
	}
	public function actionLandownerlist()
	     {
			 if(Yii::app()->session['user_array']['per2']=='1')
				{
						$connection = Yii::app()->db; 	
						$sql_details  = "select * from tbl_landowner where status='1'";
						$result_details = $connection->createCommand($sql_details)->query();
						$this->render('landownerlist',array('membershiprequest'=>$result_details));
				}else{
						$this->redirect(array("dashboard"));
					}
	   }
public function actionLandownersearch()
	     {  
	     if(Yii::app()->session['user_array']['per2']=='1')
			{
			$connection = Yii::app()->db; 
	    $where=" status ='".$_POST['status']."'";
		$and=true;
			if (!empty($_POST['name'])){
				$where.="And name LIKE '%".$_POST['name']."%'";
				$and = true;
			}
			if (!empty($_POST['status'])){
				if ($and==true)
				{
					$where.=" and status ='".$_POST['status']."'";
				}
				else
				{
					$where.="status ='".$_POST['status']."'";
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
  $sql_memberas = 'SELECT 
	  * from tbl_landowner where'.$where;
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 
		$connection = Yii::app()->db; 
      $sql_member = "SELECT 
	  * from tbl_landowner
	   where  $where  limit $start,$limit"; 
		$result_members = $connection->createCommand($sql_member)->query();
	///	echo $sql_member;exit();
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 
        $check=1;
        $res=array();
	 foreach($result_members as $key){
	            echo '<tr><td>'.$key['id'].'</td>
				<td>'.$key['name'].'</td>
				<td>'.$key['title'].'</td>
				<td>'.$key['phone'].'</td>
				<td>'.$key['email'].'</td>
				<td><img src="'.Yii::app()->request->baseUrl.'/images/landowner/'.$key['image'].'" width="100" height="100" /></td>
				
				<td>';
			if($key['status']=='' OR $key['status']=='0')
			{echo 'In Active';}
			else{ echo 'Active';}
			echo '</td>
			<td>'.$key['remarks'].'</td><td>';
			$proj="Select * from projects pr LEFT JOIN project_perm_lo perm on pr.id=perm.project_id where perm.lo_id='".$key['id']."'";
			$respro = $connection->createCommand($proj)->query();
			$t=1;foreach($respro as $pro)
			{ 
				
			echo $t.')'.$pro['project_name'].'<br>';
			$t++;
			}
			echo'</td><td>'.$key['create_date'].'</td>
			<td><a href="update_landowner?id='.$key['id'].'">Edit</a>/<a href="delete_landowner?id='.$key['id'].'">Delete</a></td></tr>'; 

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
public function actionUpdate_landowner()
	     {
		 if(Yii::app()->session['user_array']['per1']=='1')
			{
		 		$connection = Yii::app()->db;
				$sql_projects  ="SELECT * FROM projects";
				$result_projects = $connection->createCommand($sql_projects)->query();
		 		$sql_details  = "SELECT lo.*,pro.project_name FROM tbl_landowner lo Left JOIN projects pro ON lo.project_id=pro.id where lo.id='".$_REQUEST['id']."'";
				$result_details = $connection->createCommand($sql_details)->query();
				$sql_projects = "SELECT id,project_name from projects";
				$result_projects = $connection->createCommand($sql_projects)->query();
				$pp = 'SELECT per.id,per.project_id,proj.project_name from project_perm_lo  per Left JOIN projects proj ON proj.id=per.project_id
					 where lo_id='.$_GET['id'];
				$ppr = $connection->createCommand($pp)->queryAll();
				$this->render('update_landowner',array('update_member'=>$result_details,'projects'=>$result_projects,'projectper'=>$ppr));

			}else{$this->redirect(array("dashboard"));}

	   }
public function actionLandownerupdate()
	{  
	 if(Yii::app()->session['user_array']['per1']=='1')
			{
		if(isset(Yii::app()->session['user_array']))
		{
			 $connection = Yii::app()->db;  
				if($_POST['status']=='0')
			{  
			 $sql_update1 = "UPDATE tbl_landowner SET status ='0' WHERE id = ".$_POST['memreq_id']."";
			 $command = $connection -> createCommand($sql_update1);
             $command -> execute();
			 $this->redirect(array("landownerlist"));
			}
			if($_POST['status']=='1')
			{	
				 $connection = Yii::app()->db; 
	 $sql_check = "SELECT * from project_perm_lo  where lo_id=".$_POST['memreq_id'];
	$result_check = $connection->createCommand($sql_check)->queryAll();
	    if (!empty($result_check)){
			  
			 $sql_del = "DELETE from project_perm_lo where lo_id=".$_POST['memreq_id'];
			 $command = $connection -> createCommand($sql_del);
             $command -> execute();
		}
	   //Adding Project Permission to Database
		$num_of_projects_query = 'SELECT count(id) as num_of_projects from projects';
		$num_of_projects = $connection->createCommand($num_of_projects_query)->queryAll();
		$res=array();
		foreach($num_of_projects as $num_of_projects)
		{
			$num_of_projects = $num_of_projects['num_of_projects'];
		}
		while ($num_of_projects>0)
		{
			if (isset($_POST[$num_of_projects]))
				{   
					$project_id = $_POST[$num_of_projects]; 
					$connection = Yii::app()->db;
					 $add_project_per_query = 'insert into project_perm_lo 
												set 
												lo_id='.$_POST['memreq_id'].', 
												project_id='.$project_id;
					$command = $connection -> createCommand($add_project_per_query);
					$command -> execute();
				}
			$num_of_projects--;

		}
			
				 $s = "SELECT * from tbl_landowner user where id=".$_POST['memreq_id'];
				  $res = $connection->createCommand($s)->queryRow();
				  if ($_FILES['image']["name"]==''){
				  $image=$res['image'];
					}else{		     
						 $image =  $_FILES["image"]["name"];
						 move_uploaded_file($_FILES["image"]["tmp_name"],'images/landowner/'.$image);
						 }
			
  $sql_update = "UPDATE tbl_landowner SET status ='1', name='".$_POST['name']."', title='".$_POST['title']."', phone='".$_POST['phone']."',email='".$_POST['email']."',
 image='".$image."', remarks='".$_POST['remarks']."' WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("landownerlist"));
			 
			}
			}
			}

	   }
function actionDelete_landowner()
	 {
		  if(Yii::app()->session['user_array']['per1']=='1')
			{
				  $connection = Yii::app()->db;
				  $sql  = "Delete from tbl_landowner where id='".$_REQUEST['id']."'";
            	  $command = $connection -> createCommand($sql);
               	  $command -> execute();
		 		 $this->redirect(array("landownerlist"));		
	}else{$this->redirect(array("dashboard"));}
	 }

//////////////////////////////END:Land Owner MOdule/////////////////////////////////////
    

//////////////////////////////Start: Asssociate MEMBERS DIRECTORY/////////////////////
public function actionSearchassoc()
	 	{
	 
     
	
	 $connection = Yii::app()->db; 
      
          $sql_member = "SELECT assoc.msid as msid,assoc.id,COUNT(assoc.msid) total,m.name,m.cnic,assoc.mid,sec.sector_name,s.street,pro.project_name,p.sector,p.plot_detail_address,p.plot_size,m.image,p.size2,p.street_id,mp.plotno FROM associates assoc 
	 LEFT JOIN members m ON m.id = assoc.mid
	  LEFT JOIN memberplot mp ON mp.id = assoc.msid
	  LEFT JOIN plots p ON p.id = mp.plot_id
	   LEFT JOIN projects pro ON pro.id = p.project_id
	    LEFT JOIN streets s ON s.id = p.street_id
		  LEFT JOIN sectors sec ON sec.id = p.sector
		  GROUP BY assoc.msid"; 
		$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
			
		$home=Yii::app()->request->baseUrl; 
			 $i=0;
foreach($result_members as $key){ 
    $i++;
     
            $count++;
		$sql="SELECT assoc.msid as msid,m.name,m.cnic,sec.sector_name,s.street,pro.project_name,p.sector,p.plot_detail_address,p.plot_size,m.image,p.size2,p.street_id,mp.plotno,assoc.* FROM associates assoc "
                          . "LEFT JOIN members m on m.id=assoc.mid "
                        
                           ." LEFT JOIN memberplot mp ON mp.id = assoc.msid
                            LEFT JOIN plots p ON p.id = mp.plot_id
                             LEFT JOIN projects pro ON pro.id = p.project_id
                              LEFT JOIN streets s ON s.id = p.street_id
                                 LEFT JOIN sectors sec ON sec.id = p.sector"
                          . " where msid='".$key['msid']."'";
                 $ressql=$connection->CreateCommand($sql)->queryAll();
          if($key['total']>1){
              $cnt=0;
			 echo '<tr><td rowspan="'.count($ressql).'">'.$i.'</td><td rowspan="'.count($ressql).'">'.$key['plotno'].'</td>';
                                foreach($ressql as $key1){
                                    $cnt++;
                                   
                                    echo '<td>'.$key1['name'].'</td><td>'.$key1['cnic'].'</td>';
                 if($cnt<=1){     echo'<td >'.$key1['plot_size'].'</td><td>'.$key1['plot_detail_address'].'</td><td>'.$key1['street'].'<td>'.$key1['sector_name'].'</td><td>'.$key['project_name'].'</td>';}else { echo'<td colspan="5"></td>'; } echo'</tr>';
                          
                                 }  
                             
                           
  
                        }else{
                             echo '<tr><td>'.$i.'</td><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td>';
                             echo'<td>'.$key['plot_size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'<td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td></tr>';
                        }
                                         }
			
			
			
	}
	
	public function actionAssociate_lis(){	
	
		          $connection = Yii::app()->db; 
		  $sql_country  = "SELECT * from tbl_country ORDER BY country ASC";
		$result_country = $connection->createCommand($sql_country)->queryAll();

	
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

  

            }
			}

			$this->render('associate_lis',array('members'=>$result_members,'projects'=>$result_projects,'country'=>$result_country));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
	///////////END Associate Members////////////////////////
    

	//////////////////////////////ACTIVE MEMBERS DIRECTORY/////////////////////

	public function actionActive_lis()
	{	
	
		          $connection = Yii::app()->db; 
		  $sql_country  = "SELECT * from tbl_country ORDER BY country ASC";
		$result_country = $connection->createCommand($sql_country)->queryAll();

	
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

  

            }
			}

			$this->render('active_lis',array('members'=>$result_members,'projects'=>$result_projects,'country'=>$result_country));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
public function actionSearchactive()
	 	{
	

	
	$connection = Yii::app()->db; 
       $sql_member = "SELECT count(m.id) as mid,m.name, m.title, m.sodowo, m.cnic, m.phone, m.email, m.address,MAX(ml.date_time) as last_login FROM members m 
	 LEFT JOIN members_log ml ON m.id = ml.member_id where ml.date_time IS NOT NULL GROUP BY m.name "; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$i=0;
$total=0;
    $res=array();

            foreach($result_members as $key){
				$i++;
            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$i.'</td><td>'.$key['name'].'</td><td>'.$key['title'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td><strong>'.$key['email'].'</strong><td>'.$key['address'].'</td><td>'.$key['last_login'].'</td><td><strong>'.$key['mid'].' &nbsp;Time<strong></td></tr>';
			
		
			}
			
			
	}
	}
///////////////////////////////////////////////////////////////////////////	
		
	public function actionNewsletter_lis()
	{	
	
		          $connection = Yii::app()->db; 
		  $sql_country  = "SELECT * from tbl_country ORDER BY country ASC";
		$result_country = $connection->createCommand($sql_country)->queryAll();

	
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

			$this->render('newsletter_lis',array('members'=>$result_members,'projects'=>$result_projects,'country'=>$result_country));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
public function actionSearchnl()
	 	{
		$where='';
		$and=false;
	
		     if (!empty($_POST['project_name'])){
				$where.=" p.project_id =".$_POST['project_name']."";
				$and = true;
			}else{
				$where="";
				}
			if (isset($_POST['country']) && !empty($_POST['country'])){				
				if ($and==true)
				{
					$where.=" and m.country_id LIKE '%".$_POST['country']."%'";

				}
				else
				{

					$where.=" m.country_id =''";

				}
				$and=true;

			}	
			if (isset($_POST['city_id']) && !empty($_POST['city_id'])){			
				if ($and==true)
				{
					$where.=" and m.city_id LIKE '%".$_POST['city_id']."%'";

				}
				else
				{

					$where.=" m.city_id =''";

				}
				$and=true;

			}

			
			if (!empty($_POST['inactive'])){				
				if ($and==true)
				{
					 $where.=" and mp.member_id IS NULL";

				}
				else
				{

					$where.=" mp.member_id IS NOT NULL";

				}
				$and=true;

			}
						
	

	
	$connection = Yii::app()->db; 
        $sql_member = "SELECT m.name, m.title, m.sodowo, m.cnic, m.phone, m.email, m.address, cty.city, cnty.country, j.project_name FROM memberplot mp LEFT JOIN members m ON mp.member_id = m.id LEFT JOIN plots p ON mp.plot_id = p.id LEFT JOIN projects j ON p.project_id = j.id LEFT JOIN tbl_city cty ON m.city_id = cty.id LEFT JOIN tbl_country cnty ON m.country_id = cnty.id where $where GROUP BY mp.member_id"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=count($result_members);

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['name'].'</td><td>'.$key['title'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td><strong>'.$key['email'].'</strong><td>'.$key['address'].'</td><td>'.$key['city'].'</td><td>'.$key['country'].'</td><td>'.$key['project_name'].'</td>';
			}
			
	}if($count=="0"){
		echo $count.' result found';
	}
	}

public function actionNewsletter_lis1()
	{	
	
		          $connection = Yii::app()->db; 
		  $sql_country  = "SELECT * from tbl_country ORDER BY country ASC";
		$result_country = $connection->createCommand($sql_country)->queryAll();

	
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

			$this->render('newsletter_lis1',array('members'=>$result_members,'projects'=>$result_projects,'country'=>$result_country));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
public function actionSearchnl1()
	 	{
		$where='';
		$and=false;
	
		     if (!empty($_POST['project_name'])){
				$where.=" plots.project_id =".$_POST['project_name']."";
				$and = true;
			}else{
				$where="";
				}
			if (!empty($_POST['country'])){				
				if ($and==true)
				{
					$where.=" and members.country_id LIKE '%".$_POST['country']."%'";

				}
				else
				{

					$where.=" members.country_id =''";

				}
				$and=true;

			}	
			if (!empty($_POST['city_id'])){				
				if ($and==true)
				{
					$where.=" and members.city_id LIKE '%".$_POST['city_id']."%'";

				}
				else
				{

					$where.=" members.city_id =''";

				}
				$and=true;

			}

			
			
						
	

	
	$connection = Yii::app()->db; 
       $sql_member = "Select
  plothistory.plot_id,
  plothistory.transferfrom_id,
  members.name,
   members.title,
    members.sodowo,
	 members.phone,
	  members.email,
	   members.cnic,
	   members.address,
	    cty.city,
		 cnty.country,
		  members.name,
		  
  projects.project_name
From
  plothistory Inner Join
  members On plothistory.transferfrom_id = members.id Inner Join
  plots On plothistory.plot_id = plots.id Inner Join
  streets On plots.street_id = streets.id Inner Join
  projects On streets.project_id = projects.id
  left join tbl_city cty on members.city_id=cty.id
  
  left join tbl_country cnty on members.country_id=cnty.id
Where
  plothistory.transferfrom_id In (Select
    members.id
  From
    members
  Where
    members.id Not In (Select
      memberplot.member_id
    From
      memberplot)) and $where GROUP BY members.name
"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=Count($result_members);

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['name'].'</td><td>'.$key['title'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td><strong>'.$key['email'].'</strong><td>'.$key['address'].'</td><td>'.$key['city'].'</td><td>'.$key['country'].'</td><td>'.$key['project_name'].'</td>';
			}
			
	}
	if($count=="0"){ echo  $count.' result found'; }
	}

 

/////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////Account Activation Module Start///////////////

	public function actionActivate_account1()

	{ 
		$this->layout='//layouts/front';
		$this->render('activate_account1');

	}
//////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////
 public function actionForgot_password_detail()
		 {
		  if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 
				
			 $sql_details  = "SELECT * from forgot_password_requests where id='".$_REQUEST['id']."'";
			$result_details = $connection->createCommand($sql_details)->query();
   			$sql="UPDATE forgot_password_requests SET status='1' where id=".$_REQUEST['id'].""; 
			 
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			$this->render('forgot_password_detail',array('forgot_password_detail'=>$result_details)); 



			}else{$this->redirect(array("dashboard"));}



	}


////////////////////////////////////////////////////////////////////////////////////////////

 public function actionForgot_password_requests ()

	 {
		 if(Yii::app()->session['user_array']['per8']=='1')



			{



			$connection = Yii::app()->db; 	



			$sql_details  = "select forgot_password_requests.*,members.id as mid from forgot_password_requests
			 left join members on members.cnic=forgot_password_requests.cnic 
			 where forgot_password_requests.status=0 and forgot_password_requests.replied=0 or forgot_password_requests.replied='' ORDER BY forgot_password_requests.create_date DESC";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('forgot_password_requests',array('visitorqueries'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}
	
/////////////////////////////////////////////////////////////////////////////////

public function actionForgot_password_add()

	{		//echo 12121212;exit;	
		  $connection = Yii::app()->db;
 $error1 ='';
 if((isset($_POST['username']) && empty($_POST['username'])) || (isset($_POST['cnic']) && empty($_POST['cnic']))|| (isset($_POST['message']) && empty($_POST['message'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['password']) && empty($_POST['password'])))
{
 $error1 ='Please Enter All Fields';
	
}

     if(!empty($_POST['cnic'])){
      if(!is_numeric($_POST['cnic'])){
                
                $error1='Enter CNIC Witout Dashes/Only Digits';
            }
             if(strlen($_POST['cnic'])<13){
                
                $error1='Enter Complete CNIC';
            }} else{ $error1='Please Enter CNIC';}
			
			if(!empty($_POST['email'])){
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				  $error1 = "Invalid email format"; 
				}
				
				
				}
	if(empty($error1)){
//echo 123;exit;
	$connection = Yii::app()->db;
 $sql  = 'INSERT INTO forgot_password_requests (cnic,email,username,password,message,status,create_date) VALUES ( "'.$_POST['cnic'].'","'.$_POST['email'].'","'.$_POST['username'].'","'.$_POST['password'].'", "'.$_POST['message'].'",0,"'.date('Y-m-d h:i:s').'")';		
$command = $connection -> createCommand($sql);
 $command -> execute();
 echo"<script type=text/javascript>alert('Message Delivered Successfully We will send you a reply as soon as possible');</script>";
    // $this->redirect('member/member'); 

	}
	else{ 
	
	
		 echo $error1;exit;
		}
	
								
			  
	}
///////////////////////////////////////////////////////////////////////////////
 public function actionUa_activate_requests()

	 {
		 if(Yii::app()->session['user_array']['per8']=='1')



			{



			$connection = Yii::app()->db; 	



			$sql_details  = "select ua_activate_requests.*,members.id as mid from ua_activate_requests
			 left join members on members.cnic=ua_activate_requests.cnic 
			 where ua_activate_requests.status=0 and ua_activate_requests.replied=0 or ua_activate_requests.replied='' ORDER BY ua_activate_requests.create_date DESC";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('ua_activate_requests',array('visitorqueries'=>$result_details));
			}else{$this->redirect(array("dashboard"));}
	}
	
////////////////////////////////////////////////////////////////////////////////////	
public function actionActivate_account()

	{
		$this->layout = '//layouts/login1';
		$this->render('activate_account');
	}
	public function actionActivate()
	{		
		$connection = Yii::app()->db;
		$error1 = '';
		if ((isset($_POST['username']) && empty($_POST['username'])) || (isset($_POST['cnic']) && empty($_POST['cnic'])) || (isset($_POST['message']) && empty($_POST['message'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['password']) && empty($_POST['password']))) {
			$error1 .= 'Please Enter All Fields';
		}
		if (!empty($_POST['cnic'])) {
			if (!is_numeric($_POST['cnic'])) {
				$error1 = 'Enter CNIC Witout Dashes/Only Digits';
			}
			if (strlen($_POST['cnic']) < 13) {

				$error1 = 'Enter Complete CNIC';
			}
		} 

		if (!empty($_POST['email'])) {
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$error1 = "Invalid email format";
			}
		}
		if (empty($error1)) {
			//echo 123;exit;
			$connection = Yii::app()->db;
			$sql  = 'INSERT INTO ua_activate_requests (cnic,email,username,password,message,status,create_date) VALUES ( "' . $_POST['cnic'] . '","' . $_POST['email'] . '","' . $_POST['username'] . '","' . $_POST['password'] . '", "' . $_POST['message'] . '",0,"' . date('Y-m-d h:i:s') . '")';
			$command = $connection->createCommand($sql);
			$command->execute();
			echo "<script type=text/javascript>alert('Message Delivered Successfully We will send you a reply as soon as possible');</script>";
			// $this->redirect('member/member');

		} else {


			echo $error1;
			exit;
		}
	}

////////////////////////////////////////////////////////////////////////////////



	 public function actionUa_activate_detail()
		 {
		  if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 	
			/*$sql_details  = "SELECT * from ua_activate_requests where id='".$_REQUEST['id']."'";
			$result_details = $connection->createCommand($sql_details)->query();
   			$sql="UPDATE ua_activate_requests SET status='1' where id=".$_REQUEST['id'].""; 
			 
			 $command = $connection -> createCommand($sql);
			 $command -> execute();*/
			$this->render('ua_activate_detail',array('ua_activate_detail'=>$result_details)); 



			}else{$this->redirect(array("dashboard"));}



	}
////////////////////////////////////////////////////////////////////////////////////////////


	 public function actionUa_activation_detail()
		 {
		  if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 
				
			$sql_details  = "SELECT * from ua_activate_requests where id='".$_REQUEST['id']."'";
			$result_details = $connection->createCommand($sql_details)->query();
   			$sql="UPDATE ua_activate_requests SET status='1' where id=".$_REQUEST['id'].""; 
			 
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			$this->render('ua_activation_detail',array('visitor_query_detail'=>$result_details)); 



			}else{$this->redirect(array("dashboard"));}



	}


////////////////////////////////////////////////////////////////////////////////////////////

	 public function actionUa_send_mail()
		 {
		  if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "select ua_activate_requests.*,members.id as mid,members.password as mpassword,members.cnic as mcnic,members.username as musername,members.name as name,members.email as memail from ua_activate_requests
			 left join members on members.cnic=ua_activate_requests.cnic  where ua_activate_requests.id='".$_REQUEST['id']."'";
			
		
			$result_details = $connection->createCommand($sql_details)->query();
   			$sql="UPDATE ua_activate_requests SET status='1' where id=".$_REQUEST['id'].""; 
			 
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			$this->render('ua_send_mail',array('mail'=>$result_details)); 



			}else{$this->redirect(array("dashboard"));}



	}
////////////////////////////////////////////////////////////////////////////////////////////

	 public function actionfp_send_mail()
		 {
		  if(Yii::app()->session['user_array']['per8']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "select forgot_password_requests.*,members.id as mid,members.password as mpassword,members.cnic as mcnic,members.username as musername,members.name as name,members.email as memail from forgot_password_requests
			 left join members on members.cnic=forgot_password_requests.cnic  where forgot_password_requests.id='".$_REQUEST['id']."'";
			
		
			$result_details = $connection->createCommand($sql_details)->query();
   			$sql="UPDATE forgot_password_requests SET status='1' where id=".$_REQUEST['id'].""; 
			 
			 $command = $connection -> createCommand($sql);
			 $command -> execute();
			$this->render('fp_send_mail',array('mail'=>$result_details)); 



			}else{$this->redirect(array("dashboard"));}



	}

///////////////////////////////////////////////////////////////////////////////

public function actionMail()

	{	ob_clean();      
	    $email=$_POST['email'];     
	        try {
	          error_reporting(E_ALL);
	          //echo 123;exit;
	         
			     
	             $message = '<table class="table" >   
      <tr>
        <td>Respected Member,<strong>'.$_POST['name'].' ,</strong> AoA!<br/><br/></td>
      </tr>
     
     
      	 <tr>
        	<td>Please find below your credentials for online web portal access to view your updated payment status to avoid further delay resulting any surcharges etc.</td>
         </tr>
         <tr><td></td></tr><tr><td></td></tr>
         </br>
    	 <tr>
        <td>Web portal online URL : http://www.rdlpk.com/index.php/member</td>
        </tr>
        <tr><td></td></tr><tr><td></td></tr>
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
        	      'mail_to'=> $email,
        	      'mail_subject'=> 'Account Activation Email',
        	      'mail_detail'=> $message,
        	      
        	      
        	      ];
        	      
        	    //  print_r($data);
        	 // exit;
        	 MyHelper::send_email($data);
        	   $connection = Yii::app()->db;
				 $sql="UPDATE members SET username='".$_POST['username']."',password='".$_POST['password']."' where id=".$_REQUEST['mid']."";
				$command = $connection -> createCommand($sql);
			   $command -> execute();  
				$sql="UPDATE ua_activate_requests SET replied=1 where id=".$_REQUEST['id']."";
				$command = $connection -> createCommand($sql);
			    $command -> execute();  
        	    /*Yii::import('application.extensions.phpmailer.JPhpMailer');
                $mail = new JPhpMailer;
                $mail->IsSMTP();
                $mail->Host = 'mail.rdlpk.com';
                $mail->SMTPAuth = true;
                $mail -> Port = 465;
                $mail -> SMTPSecure = 'ssl';
                $mail->Username = 'info@rdlpk.com';
                $mail->Password = '%c!+y~^;FJ[3';
                $mail->SetFrom('info@rdlpk.com', 'Royal Orchard');
                $mail->isHTML(true);
                $mail->CharSet='UTF-8';
                $mail->ContentType = "text/html";

        
                $mail->Subject = 'User Account Activation';
                $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail->MsgHTML($message);
              
                $mail->addAddress($email);
                $mail->Send();
                $mail->ClearBCCs();
                $mail->ClearAddresses();*/
                
                
               $this->redirect('ua_activate_requests'); 
               
               
               
               
               
               
	      }catch(Exception $e){
             echo  $e->getMessage();exit;
	      }
	    
		        

				
				
				
			  //  $this->redirect('ua_activate_requests'); 
	}
	
	
	public function actionFpmailtest(){
	  
	             $email=$_REQUEST['email'];
	         try {
	          

	           $message = 'test';   
        	  
        	  
        	    Yii::import('application.extensions.phpmailer.JPhpMailer');
                $mail = new JPhpMailer;
               $mail->IsSMTP();
               $mail->Host = 'smtp.gmail.com';
               $mail->SMTPAuth = true;
               $mail -> Port = 587;
               $mail -> SMTPSecure = 'tls';
               $mail->Username = 'rehmansaeed@rdlpk.com';
               $mail->Password = '>4XWqePG#';
               $mail->SetFrom('rehmansaeed@rdlpk.com', 'Royal Orchard');
               $mail->Subject = 'Forgot Username/Password';
               $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
               $mail->MsgHTML($message);
               $mail->addAddress($email);
               $mail->Send();
        	  /*
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
                $mail->Subject = 'Forgot Username/Password';
                $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail->MsgHTML($message);
                $mail->addAddress($email);
                $mail->Send();
               /*  if ( headers_sent($path, $lineno) )
                 {
                    echo '<pre>Debug: output started at ', $path, ':', $lineno, "</pre>\n";
                 }
               */
               echo "Email Sent";
                //$this->redirect('forgot_password_requests');
                $mail->ClearBCCs();
                $mail->ClearAddresses();
               // $this->redirect('forgot_password_requests'); 
	      }catch(Exception $e){
             echo  $e->getMessage();exit;
	      }
	}
	
	public function actionFpmail(){
	  
	             $email=$_POST['email'];
	         try {
	          
	             $connection = Yii::app()->db;
			    $sql="UPDATE forgot_password_requests SET replied=1 where id=".$_REQUEST['id']."";
				$command = $connection -> createCommand($sql);
		       $command -> execute();  
		       $sql="UPDATE members SET username='".$_POST['username']."',password='".$_POST['password']."' where id=".$_REQUEST['mid']."";
			    $command = $connection -> createCommand($sql);
			   $command -> execute(); 
			     
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
        	      'mail_to'=> $email,
        	      'mail_subject'=> 'Forgot Password',
        	      'mail_detail'=> $message,
        	      
        	      
        	      ];
        	  
        	 MyHelper::send_email($data);
/*        	   Yii::import('application.extensions.phpmailer.JPhpMailer');
                $mail = new JPhpMailer;
               $mail->IsSMTP();
               $mail->Host = 'smtp.gmail.com';
               $mail->SMTPAuth = true;
               $mail ->Port =587 ;
               $mail ->SMTPSecure = 'tls';
               $mail->Username = 'junaidahmed@rdlpk.com';
               $mail->Password = '@smart112233';
               $mail->SetFrom('junaidahmed@rdlpk.com', 'Royal Orchard');
               $mail->Subject = 'Forgot Username/Password';
               $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
               $mail->MsgHTML($message);
               $mail->addAddress($email);
               $mail->Send();*/
        	     /* Yii::import('application.extensions.phpmailer.JPhpMailer');
                $mail = new JPhpMailer;
                $mail->IsSMTP();
                $mail->Host = 'mail.rdlpk.com';
                $mail->SMTPAuth = true;
                $mail -> Port = 465;
                $mail -> SMTPSecure = 'ssl';
                $mail->Username = 'info@rdlpk.com';
                $mail->Password = '%c!+y~^;FJ[3';
                $mail->SetFrom('info@rdlpk.com', 'Royal Orchard');
                $mail->Subject = 'Forgot Username/Password';
                $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail->MsgHTML($message);
                $mail->addAddress($email);
                $mail->Send(); */
               /*  if ( headers_sent($path, $lineno) )
                 {
                    echo '<pre>Debug: output started at ', $path, ':', $lineno, "</pre>\n";
                 }
               */
                $this->redirect('forgot_password_requests');
                $mail->ClearBCCs();
                $mail->ClearAddresses();
               // $this->redirect('forgot_password_requests'); 
	      }catch(Exception $e){
             echo  $e->getMessage();exit;
	      }
	}
///////////////////////////////////////////////////////////////////////////////


public function actionFpmail2()

	{			
		         $connection = Yii::app()->db;
			
			///	 $sql="UPDATE forgot_password_requests SET replied=1 where id=".$_REQUEST['id']."";
			///	$command = $connection -> createCommand($sql);
			 // ///  $command -> execute();  
			////	 $sql="UPDATE members SET username='".$_POST['username']."',password='".$_POST['password']."' where id=".$_REQUEST['mid']."";
			////	$command = $connection -> createCommand($sql);
			 ///   $command -> execute();  
				
                try {
			////	$subject = "Forgot Member Account Email";
     		////    $message = $_POST["message"];
			////    $email = $_POST["email"];
			    
		/////	    Yii::import('application.extensions.phpmailer.JPhpMailer');
        ////        $mail = new JPhpMailer;
               
        ////        $mail -> SMTPDebug = 3;
    //////            $mail -> isSMTP();
          //      $mail -> Host = 'mail.rdlpk.com';
            //    $mail -> Port = 465;
             //   $mail -> SMTPSecure = 'tls';
    
              //  $mail->SMTPAuth = true;
            //    $mail->Username = 'info@rdlpk.com';
              //  $mail->Password = '%c!+y~^;FJ[3';
            //    $mail->SetFrom('info@rdlpk.com', 'Royal Orchard');
              //  $mail->Subject = 'PHPMailer Test Subject via smtp, basic with authentication';
                //$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
            //    $mail->MsgHTML('<h1>JUST A TEST!</h1>');
              //  $mail->AddAddress($email);
            //    $mail->Send();
              //   	 echo "<script>window.location.assign('forgot_password_requests')</script>";
               ///	$this->redirect('forgot_password_requests'); 
                
                    
                    $message            = new YiiMailMessage;
           //this points to the file test.php inside the view path
        //		$message->view = "test";
        	//	$sid                 = 1;
        	//	$criteria            = new CDbCriteria();
        	//	$criteria->condition = "studentID=".$sid."";			
        	//	$studModel1 	     = Student::model()->findByPk($sid);		
        	//	$params              = array('myMail'=>$studModel1);
        		$message->subject    = 'My TestSubject';
        		$message->setBody('ff', 'text/html');				
        		$message->addTo('bhatti_147@hotmail.com');
        		$message->from = 'info@rdlpk.com';	
        		Yii::app()->mail->send($message);
                    
                }
                catch (Exception $e) {
                                        
                                        $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail -> ErrorInfo;
                                        Header("Location:forgot_password_requests");
                                        die();
                                        
                                    }
             /*  if (!$mail->Send())
                    {
                    echo "Error: $mail->ErrorInfo";
                    }
                    else
                         {
                            echo "Message Sent!";
                        }   
			 echo "<script>window.location.assign('forgot_password_requests')</script>";*/
								
			    ///$this->redirect('forgot_password_requests'); 
	}
////////////////////////////////////////////////////////////////////////////////
function actionUa_activate_delete()
	 {
		  if(Yii::app()->session['user_array']['per8']=='1')

		{
	  $connection = Yii::app()->db;
	  $sql  = "Delete from ua_activate_requests where id='".$_REQUEST['id']."'";
              $command = $connection -> createCommand($sql);
            $command -> execute();
		 		 $this->redirect(array("member/ua_activate_requests"));		
			}else{$this->redirect(array("dashboard"));}



	}
////////////////////////////////////////////////////////////////////////////////
function actionForgot_password_delete()
	 {
		  if(Yii::app()->session['user_array']['per8']=='1')

		{
	  $connection = Yii::app()->db;
	  $sql  = "Delete from forgot_password_requests where id='".$_REQUEST['id']."'";
              $command = $connection -> createCommand($sql);
            $command -> execute();
		 		 $this->redirect(array("member/forgot_password_requests"));		
			}else{$this->redirect(array("dashboard"));}



	}
///////////////////////////////////////////////////////////////////////////////

		public function actionaddcity()
	{
		  $connection = Yii::app()->db; 

				$city = ($_POST['city']);
				$country_id =($_POST['country_id']);
				$zipcode =($_POST['zipcode']);
				$sql  = "INSERT INTO tbl_city(city,country_id,zipcode) VALUES('".$city."','".$country_id."','".$zipcode."')";		
                $command = $connection -> createCommand($sql);
                $command -> execute();
				$this->redirect(array('member/register') );

	}




public function actionDealerreport()

	{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{ 

		$this->layout='//layouts/back';

		$this->render('dealerreport');

		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/user"); }
	}
	public function actionDetaildealer()

	{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{ 

		$this->layout='//layouts/back';

		$this->render('detaildealer');

		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/user"); }
	}
		public function actionDownload()

{
	$plot_id = $_GET['plot_id'];


	$this->layout='//layouts/front';

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
    ,blocks.block_name
	FROM

    memberplot

    LEFT JOIN members 

        ON (memberplot.member_id = members.id ) 

		left join plots on memberplot.plot_id=plots.id
		left join size_cat on plots.size2=size_cat.id
		left join streets on plots.street_id=streets.id
        left join blocks on plots.block_id=blocks.id
		where memberplot.plot_id=".$plot_id;

		

		$member_result = $connection->createCommand($sql_member)->queryAll();

	 	$this->render('pdf1',array('member'=>$member_result)); 

}




	







	/**







	 * Creates a new model.







	 * If creation is successful, the browser will be redirected to the 'view' page.







	 */


	public function actionRFM()

	{
		if((Yii::app()->session['user_array']['per6']=='1')&& isset(Yii::app()->session['user_array']['username']))

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
	, members.status
	, members.RFM
	

	, plots.plot_detail_address

	, memberplot.plotno
	, memberplot.plot_id
	, transferplot.RFM

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
    Left JOIN members  ON (memberplot.member_id = members.id)

where $where AND transferplot.RFM='RFM'";
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

			$this->render('RFM',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$result_projects,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));
			}
			else{
					$this->redirect(array('user/dashboard'));
				}


	   }


public function actionTransferreq()

	 	{
		$where='';

		$and=false;
		
			
			

		 if (isset($_POST['status']) && $_POST['status']!=""){

				if($_POST['status']=='new'){$where.="tp.fstatus=''";}else{
				$where.="tp.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
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
					$where.=" and p.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.=" p.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}

		$connection = Yii::app()->db; 

		$sql_payment  = "SELECT tp.*,s.street,siz.size,p.price,mp.comment,mp.plot_id,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name,mp.plotno,m_from.name from_name,m_to.name to_name,m_to.RFM RFM FROM transferplot tp



			Left JOIN members m_from ON m_from.id=tp.transferfrom_id



			Left JOIN members m_to ON m_to.id=tp.transferto_id



			Left JOIN plots p ON p.id=tp.plot_id


			Left JOIN memberplot mp ON mp.plot_id=p.id
         
			Left JOIN streets s ON s.id=p.street_id


				Left JOIN size_cat siz  ON p.size2 = siz.id

			Left JOIN projects pro ON pro.id=p.project_id where $where  AND tp.RFM='RFM' ";

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
            foreach($sql_payments as $key){

          
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
		$i++;

		//$due=$due+$row['amount'];
		//$paid=$paid+$row['paidamount'];
   echo '<tr><td>'.$key['id'].'</td><td>'.$key['from_name'].'</td><td>'.$key['to_name'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['price'].'</td><td>'.$key['size'].'</td><td>'.$key['plotno'].'</td><td>'.$key['com_res'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="treq_detail?id='.$key['id'].'">View Request</a></td></tr>'; 

		 

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
		public function actionProceed(){
		
		 $connection = Yii::app()->db;  
     $sql3 = "UPDATE transferplot SET RFM='' WHERE id = '".$_REQUEST['tid']."'"; 	
	
	$command = $connection -> createCommand($sql3);
	$command -> execute();
					$this->redirect('RFM'); 
		
		}
		public function actionTimage(){
		
		 $connection = Yii::app()->db;  
    
				 $path="images/imagetransfer/";
				 $image=$_FILES['image']["name"];
				$newfilename = $_FILES["image"]["name"];
				
				move_uploaded_file($_FILES["image"]["tmp_name"],
				$path.$image);
				 $sql="UPDATE transferplot SET image='".$newfilename."' WHERE id='".$_REQUEST['tid']."'";
					$command = $connection -> createCommand($sql);
	               $command -> execute();
					$this->redirect('RFM'); 
		
		}


	public function actionTreq_detail()
	{
	if(Yii::app()->session['user_array']['per9']=='1')
			{
			$connection = Yii::app()->db; 	
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,mp.comment,pro.project_name,m_from.name from_name,m_to.name to_name 
			,m_to.cnic,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.state
			FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN memberplot mp ON p.id=mp.plot_id
			left join user u on tp.uid=u.id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id=".$_REQUEST['id']."";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('treq_detail',array('plotdetails'=>$result_details)); 
			}else{$this->redirect(array("dashboard"));}



	}
	
public function actionUpdate_member()

	     {
		
		$uid=yii::app()->session['member_array']['id'];

		 if(!empty(Yii::app()->session['member_array']))
			{
			$this->layout='//layouts/front';
			$connection = Yii::app()->db;
				$sql_country  ="SELECT * FROM tbl_country";
			$result_country = $connection->createCommand($sql_country)->query();
		 $sql_details  = "SELECT m.*,c.country,p.city FROM members m
			Left JOIN tbl_country c ON c.id=m.country_id 
			Left JOIN tbl_city p ON p.id=m.city_id 
			 where m.id='".$uid."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('update_member',array('update_member'=>$result_details,'country'=>$result_country));

			}else{$this->redirect(array("dashboard"));}

	   }



	 function actionCrop()







	 {







		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))







		{ 







			$this->layout='//layouts/front';







			$this->render('crop');







		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }







	}







	public function actionDownload1()







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







	,members.city_id







FROM







    memberplot







    LEFT JOIN members 







        ON (memberplot.member_id = members.id) where memberplot.plot_id=".$plot_id;







		







		$member_result = $connection->createCommand($sql_member)->queryAll();







	 	$this->render('pdf',array('member'=>$member_result)); 







}







public function actionMemberupdate()
	{  
	 if(Yii::app()->session['user_array']['per1']=='1')
			{

		if(isset(Yii::app()->session['user_array']))



		{
			 $connection = Yii::app()->db;  

				
			if($_POST['status']=='1')
			{	

  $sql_update = "UPDATE members SET status ='1',RFM='', name='".$_POST['name']."', username='".$_POST['username']."', cnic='".$_POST['cnic']."', sodowo='".$_POST['sodowo']."', email='".$_POST['email']."', address='".$_POST['address']."', country_id='".$_POST['country']."', city_id='".$_POST['city']."', nomineename='".$_POST['nomineename']."', nomineecnic='".$_POST['nomineecnic']."', rwa='".$_POST['rwa']."' WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_update);
             $command -> execute();
			  $this->redirect(array("RFM"));
			}
			if($_POST['status']==2)
			{
			 $sql_delete = "Delete from  members  WHERE id = ".$_POST['memreq_id']."";
    		 $command = $connection -> createCommand($sql_delete);
             $command -> execute();
			 $this->redirect(array("RFM"));
			}
			}
			}

	   }




public function actionUpdate_member1()

	     {

		 if(Yii::app()->session['user_array']['per1']=='1')
			{
			$connection = Yii::app()->db;
				$sql_country  ="SELECT * FROM tbl_country";
			$result_country = $connection->createCommand($sql_country)->query();
		 $sql_details  = "SELECT m.*,c.country,p.city FROM members m
			Left JOIN tbl_country c ON c.id=m.country_id 
			Left JOIN tbl_city p ON p.id=m.city_id 
			 where m.id='".$_REQUEST['id']."'";
			
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('update_member1',array('update_member'=>$result_details,'country'=>$result_country));

			}else{$this->redirect(array("dashboard"));}

	   }

	public function actionCreate()

	{
		if (isset(Yii::app()->session['user_array']['username'])) {
			$error = array();
			if(($_POST['mtype']=='Dealer') &&  empty($_POST['business_title']))
			{
				
					$error = 'Please Enter Business Title'; 
				
			 }
			if ((isset($_POST['name']) && empty($_POST['name'])) || (isset($_POST['dob']) && empty($_POST['address']))  || (isset($_POST['sodowo']) && empty($_POST['sodowo'])) || (isset($_POST['cnic']) && empty($_POST['cnic'])) || (isset($_POST['address']) && empty($_POST['address'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['city_id']) && empty($_POST['city_id'])) ||  (isset($_POST['country']) && empty($_POST['country']))  || (isset($_POST['phone']) && empty($_POST['phone'])) || (isset($_POST['nomineename']) && empty($_POST['nomineename'])) || (isset($_POST['rwa']) && empty($_POST['rwa'])) || (isset($_POST['nomineecnic']) && empty($_POST['nomineecnic'])) || (isset($_POST['title']) && empty($_POST['title']))) {

				$error .= 'Please complete all required fields <br />'; 
			}
			
			$connection = Yii::app()->db;
			$sql_email  = "SELECT * FROM members where email ='" . $_POST['email'] . "'";
			$result_email = $connection->createCommand($sql_email)->queryRow();



			$sql_cnic  = "SELECT cnic FROM members where cnic ='".$_POST['cnic']."'";
			$result_sq = $connection->createCommand($sql_cnic)->queryrow();
			if (!empty($result_sq)) {
				echo $error = "CNIC Already Exists Please Enter Another CNIC ";exit;
			}

			// Insert in to member a new member
			$dealer = '';
			if (isset($_POST['mtype'])) {
				$dealer = $_POST['mtype'];
			}
			if (empty($error)) {

		 $sql  = 'INSERT INTO members
          (title,name,username,password,sodowo, cnic, address, email, city_id, mtype,  country_id,phone,nomineename,nomineecnic,rwa,dob,create_date,status,business_title)VALUES ("' . ($_POST['title']) . '","' . $_POST['name'] . '", "' . $_POST['email'] . '", "' . ($_POST['cnic']) . '", "' . $_POST['sodowo'] . '", "' . ($_POST['cnic']) . '", "' . ($_POST['address']) . '", "' . $_POST['email'] . '", "' . $_POST['city_id'] . '", "' . $dealer . '","' . $_POST['country'] . '", "' . $_POST['phone'] . '", "' . $_POST['nomineename'] . '", "' . $_POST['nomineecnic'] . '", "' . $_POST['rwa'] . '", "' . $_POST['dob'] . '", "' . date('Y-m-d') . '",1,"'.$_POST['business_title'].'")';

				$command = $connection->createCommand($sql);
				$command->execute();
				$pw = $_POST['cnic'];
				$memid = Yii::app()->db->getLastInsertID();

				$connection = Yii::app()->db;
				$sql = "SELECT * from members where id='" . $memid . "'";

				$result = $connection->createCommand($sql)->queryRow();
				//$content='Thank You For Registeration your user name='.$_POST['email'].' and password= '.$pw.'';

				$content = 'Dear Member,<br />

      We have the Honer to intimate that you have been registered in <b>Royal Developers & Bulders.</b><br />

      <br />

      Your user name = ' . $_POST['email'] . ' <br />

      Password =' . $pw . '<br />

      <br />

      To view your onine profile  <a href="www.rdlpk.com/index.php/member/member">click hare to login </a><br />

      <br />

      Regards,<br />



      <b>Col. Fahim-ud-Din Shad</b><br />

      (Manager Marketing)<br />

      <img src="http://localhost/hb/images/logo.png" width="90" height="57" />

      ';

				//mail($_POST['email'],$_POST['email'],$content);



				$useremail = (Yii::app()->session['user_array']['email']);



				$sql1 = "SELECT * from user where email='" . $useremail . "'";



				$result1 = $connection->createCommand($sql1)->queryRow();



				echo 'New Member Added Successfully<br>';

				echo '<a target="_blank" href="image?id=' . $memid . '"><input type="button" class="btn-info" value="Add Image"><br>';

				echo

				'<span class="btn-info button" font-size="16px"; style="color:#FFFFF";><a  href="sendmail?id=' . $memid . '">Send Email To Member</a></span>';
				//	$this->render('sendmail',array('result'=>$result,'content'=>$content,'result1'=>$result1));
			}



			if (!empty($error)) {
				echo $error;
				exit;
			}
		}
	}


	public function actionCreate111()

	{	
	    if(isset(Yii::app()->session['user_array']['username']))
		{
		  /* if(($_POST['mtype']=='Dealer') &&  empty($_POST['business_title']))
			{
					$error = 'Please Enter Business Title';
			}*/    
		    
		    
         $error =array();

		if((isset($_POST['name']) && empty($_POST['name']))|| (isset($_POST['dob']) && empty($_POST['address']))  || (isset($_POST['sodowo']) && empty($_POST['sodowo'])) || (isset($_POST['cnic']) && empty($_POST['cnic'])) || (isset($_POST['address']) && empty($_POST['address'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['city_id']) && empty($_POST['city_id'])) ||  (isset($_POST['country']) && empty($_POST['country']))  || (isset($_POST['phone']) && empty($_POST['phone'])) || (isset($_POST['nomineename']) && empty($_POST['nomineename'])) || (isset($_POST['rwa']) && empty($_POST['rwa'])) || (isset($_POST['nomineecnic']) && empty($_POST['nomineecnic']))||(isset($_POST['title']) && empty($_POST['title'])))
		{

			$error = 'Please complete all required fields <br />';

		}
		$connection = Yii::app()->db;  
		$sql_email  = "SELECT * FROM members where email ='".$_POST['email']."'";
		$result_email = $connection->createCommand($sql_email)->queryRow();

		

       $sql_cnic  = "SELECT * FROM members where cnic ='".$_POST['cnic']."'";
			 $result_sq = $connection->createCommand($sql_cnic)->queryrow();
			 if(!empty($result_sq))
			 {
				  $error .="CNIC Already Exists Please Enter Another CNIC  ";
		}	

		// Insert in to member a new member
$dealer='';
if(isset($_POST['mtype'])){ $dealer=$_POST['mtype'];}
if(empty($error)){ 

    $sql  = 'INSERT INTO members 
          (title,name,username,password,sodowo, cnic, address, email, city_id, mtype,  country_id,phone,nomineename,nomineecnic,rwa,dob,create_date,status )VALUES ("'.($_POST['title']).'","'.$_POST['name'].'", "'.$_POST['email'].'", "'.($_POST['cnic']).'", "'.$_POST['sodowo'].'", "'.($_POST['cnic']).'", "'.($_POST['address']).'", "'.$_POST['email'].'", "'.$_POST['city_id'].'", "'.$dealer.'","'.$_POST['country'].'", "'.$_POST['phone'].'", "'.$_POST['nomineename'].'", "'.$_POST['nomineecnic'].'", "'.$_POST['rwa'].'", "'.$_POST['dob'].'", "'.date('Y-m-d').'",1)';	

            $command = $connection -> createCommand($sql);
            $command -> execute();
			$pw=$_POST['cnic']; 
			$memid=Yii::app()->db->getLastInsertID();	
			
			$connection = Yii::app()->db;  
			$sql="SELECT * from members where id='".$memid."'";

			$result = $connection->createCommand($sql)->queryRow();
			//$content='Thank You For Registeration your user name='.$_POST['email'].' and password= '.$pw.'';

			$content='Dear Member,<br />

      We have the Honer to intimate that you have been registered in <b>Royal Developers & Bulders.</b><br />

      <br />

      Your user name = '.$_POST['email'].' <br />

      Password ='.$pw.'<br />

      <br />

      To view your onine profile  <a href="www.rdlpk.com/index.php/member/member">click hare to login </a><br />

      <br />

      Regards,<br />

      

      <b>Col. Fahim-ud-Din Shad</b><br />

      (Manager Marketing)<br />

      <img src="http://localhost/hb/images/logo.png" width="90" height="57" />

      ';

			//mail($_POST['email'],$_POST['email'],$content);



			$useremail=(Yii::app()->session['user_array']['email']);



			$sql1="SELECT * from user where email='".$useremail."'";



			$result1 = $connection->createCommand($sql1)->queryRow();



			echo'New Member Added Successfully<br>';

				echo '<a target="_blank" href="image?id='.$memid.'"><input type="button" class="btn-info" value="Add Image"><br>';

			echo 

			'<span class="btn-info button" font-size="16px"; style="color:#FFFFF";><a  href="sendmail?id='.$memid.'">Send Email To Member</a></span>'

			;
		//	$this->render('sendmail',array('result'=>$result,'content'=>$content,'result1'=>$result1));
	}



	if(!empty($error)){echo $error;exit;}



	}



	}





public function actionImage()

	{

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

		{ 

		$this->layout='//layouts/back';

		$this->render('image');

		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/user"); }
	}
public function actionMemimage()

{		
$connection = Yii::app()->db;  
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
				{ 
				 $id= $_POST['id'];
				$time_rand = time();
				$target_path="upload_pic/";
				$target_path = $target_path.$id.$_FILES['image']['name'];
				$ad=explode('.',$_FILES['image']['name']); 
				$rnd=sizeof($ad);
				$ads=$rnd-1;
			     move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
				 $sql="UPDATE members SET image='".$id.$_FILES['image']['name']."' WHERE id=$id ";
				$command = $connection -> createCommand($sql);
			    $command -> execute();
			    $this->redirect(Yii::app()->baseUrl."/index.php/user/membershiprequest"); 
 		}	

	

}
                public function actionUpdateimg()
				{
				
				/////////////////////////////////////////	
				
	              $path="upload_pic/";
				$connection = Yii::app()->db;  
				  $s = "SELECT * FROM members where id=".$_POST['id'];
			     $res = $connection->createCommand($s)->queryRow();
				
				 if($_FILES['image']["name"]==''){
				 $image=$res['image'];
				  
					}else{ 
					
                 $image=$_FILES['image']["name"]; 
				$newfilename =$_FILES["image"]["name"];
				
				
				
				if($res['image']!=='' && file_exists($path.$res['image'])==1){
				
				unlink($path.$res['image']);}


				move_uploaded_file($_FILES["image"]["tmp_name"],
				$path.$_POST['id'].$newfilename);
			    }
				  $sql="UPDATE members set image='".$_POST['id'].$image."' where id='".$_POST['id']."' ";
								 $command = $connection -> createCommand($sql);
                 $command -> execute(); 
				 $this->redirect(Yii::app()->baseUrl."/index.php/user/memhistory?id=".$_REQUEST['id']);
/*if(isset($_POST['from'])){	 $this->redirect(Yii::app()->baseUrl."/index.php/user/memhistory?id=".$_REQUEST['id']);}else{
				 $this->redirect(Yii::app()->baseUrl."/index.php/user/membershiprequest");}*/
				
				

             	}

		public function actionSendmail()

			{

        	$connection = Yii::app()->db;  

			$sql="SELECT * from members where id='".$_REQUEST['id']."'";

			$result = $connection->createCommand($sql)->queryRow();

			//$content='Thank You For Registeration your user name='.$result['email'].' and password= '.$result['password'].'';

			//mail($_POST['email'],$_POST['email'],$content);

			$content='

			

			Dear Member,<br />

      We have the Honer to intimate that you have been registered in <b>Royal Developers & Bulders.</b><br />

      <br />

      Your user name = '.$result['email'].' <br />

      Password ='.$result['password'].'<br />

      <br />

      To view your onine profile  <a href="www.rdlpk.com/index.php/member/member">click hare to login </a><br />

      <br />

      Regards,<br />

      

      <b>Col. Fahim-ud-Din Shad</b><br />

      (Manager Marketing)<br />

      <img src="http://localhost/hb/images/logo.png" width="90" height="57" />';



stripslashes($content);

			$useremail=(Yii::app()->session['user_array']['email']);







			







			 







			$sql1="SELECT * from user where email='".$useremail."'";







			







			$result1 = $connection->createCommand($sql1)->queryRow();		







    $this->render('sendmail',array('result'=>$result,'content'=>$content,'result1'=>$result1)); 		







		







	







	}







		







		public function actionRequestTransfer()

	 	{

		if(Yii::app()->session['member_array'])
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
                                    if ((isset($_POST['name']) && empty($_POST['name']))){
                                        $error.="name required. <br>";

                                    }
                                    if ((isset($_POST['name']) && empty($_POST['name']))){
                                        $error.=" Name required. <br>";
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

                                        $connection = Yii::app()->db;  

                                       $sql  = 'INSERT INTO members 
                (name,RFM,username, sodowo, cnic, address, email, city_id, state,status )VALUES ( "'.$_POST['name'].'","RFM", "'.$_POST['email'].'", "'.$_POST['sodowo'].'", "'.$base.'", "'.($_POST['address']).'", "'.$_POST['email'].'", "'.$_POST['city'].'", "'.$_POST['state'].'",0 )';		






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







	            					  $sql="INSERT INTO transferplot SET plot_id='".$_POST['plot_id']."',RFM='RFM',transferfrom_id='".$_POST['transfer_from_memberid']."',transferto_id='".                                     $transferto_memberid."',status='New Request',cmnt='New Request',create_date='".date('Y-m-d H:i:s')."'";	  







        		   					 $command = $connection -> createCommand($sql);







                      				 $command -> execute();



									 $this->redirect(Yii::app()->baseUrl."/index.php/member/dashboard");







		}







		







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



	if(Yii::app()->session['user_array']['per2']=='1')



		{



			$connection = Yii::app()->db;  



			if (isset($_POST["from"]))



			{



			$To = $_POST["To"];



			$from = $_POST["from"];



			$subject="Registeration Confirmation"; 



		   $date= date('Y-m-d H:i:s');



			$content = $_POST["detail_content"];



			$sender=Yii::app()->session['user_array']['username'];



		   ////////////////save data in mailto member table////////////////



				$sql="INSERT into mailto_member(member_id,date,sender,message) VALUES('".$To."','".$date."','".$sender."','".$content."')";



				$command = $connection -> createCommand($sql);



				$command -> execute();



		 ///////////////////////EMAIL to MEMBER//////////////



				mail($To, $subject, $content,"From: $from\n");



				



			}



		}



		$this->redirect(array('member/maillist'));



	}







		/////////////////////Update email to member







	







	







	







	







	







	/////////////////////////MEMBER QUERY DETAIL////////////







	 public function actionRegister_member_query_detail()







	 {







		 $this->layout='//layouts/front';







		 if(Yii::app()->session['user_array']['per8']=='1')







			{







			$connection = Yii::app()->db; 	



	



			$sql="UPDATE register_member_answer SET status='1' WHERE id='".$_REQUEST['id']."'";
			$command = $connection -> createCommand($sql);
            $command -> execute();







			$sql_details  = "SELECT * from register_member_answer where id='".$_REQUEST['id']."'";



			$result_details = $connection->createCommand($sql_details)->query();







			$this->render('register_member_query_detail',array('register_member_query_detail'=>$result_details)); 







			}else{$this->redirect(array("dashboard"));}







	}







	







	







	







	







	/////////////////////////MEMBER MAIL BOX/////////////////







	public function actionMailbox()







	{	







	







	$this->layout='//layouts/front';







    $connection = Yii::app()->db; 







	$uid=yii::app()->session['member_array']['id'];







	$sql = "SELECT * FROM register_member_answer where user_id='".$uid."'";







	$result = $connection->createCommand($sql)->query();







	$this->render('mailbox',array('mailbox'=>$result));







	  	







	}







	/////////////////////////CHANGE MEMBER PASSWORD/////////////////







	public function actionChangepass()







	{	



	$this->layout='//layouts/front';







   $this->render('changepass');



	}






	public function actionUpdateinfo()
	{  

		$this->layout='//layouts/front';	
		$connection = Yii::app()->db; 
		 $error =array();
			 $error="";
			if(isset($_POST['address']) && empty($_POST['address']))
			{
				$error = 'Please Enter Address<br>';
			}
			if(isset($_POST['phone']) && empty($_POST['phone']))
			{
				$error .= 'Please Enter Contact No.<br>';
			}
				if(isset($_POST['city']) && empty($_POST['city']))
			{
				$error .= 'Please Enter City.<br>';
			}
				if(isset($_POST['country']) && empty($_POST['country']))
			{
				$error .= 'Please Enter Country.<br>';
			}
		$uid=yii::app()->session['member_array']['id'];
		if(empty($error)){
		
		 $sql="UPDATE members SET address='".$_POST['address']."',phone='".$_POST['phone']."', country_id='".$_POST['country']."', city_id='".$_POST['city']."' WHERE id='".$uid."'";
	    $command = $connection -> createCommand($sql);
        $command -> execute();
		echo 'Information Changed Successfully';
		
		}
		else{
			echo $error;
		}



		}

	public function actionChangepasswordlatest()
	{  

		$this->layout='//layouts/front';	
		$connection = Yii::app()->db; 
		 $error =array();
			 $error="";
			if(isset($_POST['newpassword']) && empty($_POST['newpassword']))
			{
				$error = 'Please Enter New Password<br>';
			}
			if(isset($_POST['newpassword1']) && empty($_POST['newpassword1']))
			{
				$error .= 'Please Enter Confirm New Password<br>';
			}
		$uid=yii::app()->session['member_array']['id'];
		if(empty($error)){
		if($_POST['newpassword']==$_POST['newpassword1'])
		{ 
		$pass=$_POST['newpassword'];	
		$sql="UPDATE members SET password='$pass' WHERE id='$uid'";
	    $command = $connection -> createCommand($sql);
        $command -> execute();
		echo 'Password Change Successfully';
		}

		else{
			echo "New Password And Confirm New Password Are Not Same "; exit;
		}

		}



		else{



			echo $error;



		}



		}



		



	







	 







	//////////////////////////DELETE MAIL/////////////







	







	public function actionRemove_mail()







	{	







	







	







    $connection = Yii::app()->db; 







	







	$sql = "Delete from register_member_answer where id='".$_GET['id']."' ";







	$command = $connection -> createCommand($sql);







    $command -> execute();







 $this->redirect(array("member/mailbox"));		







		







	}







	







	







		







	public function actionMaillist()
	{

	if((Yii::app()->session['user_array']['per8']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{






		$connection=yii::app()->db;







		$sql="Select * from mailto_member";







		$result=$connection->CreateCommand($sql)->QueryAll();







		$this->render('maillist',array('maillist'=>$result));




			}else{
				$this->redirect(array('user/dashboard'));
				}


			







	}







	public function actionMaildelete()







	{







		







		  $connection = Yii::app()->db;







	     $sql  = "Delete from mailto_member where id='".$_REQUEST['id']."'";







         $command = $connection -> createCommand($sql);







         $command -> execute();







			







		 $this->redirect(array("member/maillist"));		







		







			







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







		







		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))







		{







			 $this->redirect(array('member/dashboard'));







		}else







		{







			$error = '';







			







		$this->redirect('member/member'); 







		}







	}


public function actionDashboard()

	{
		if (isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username'])) {
			$this->layout = '//layouts/login2';
			$user_data = Yii::app()->session['member_array'];
			$connection = Yii::app()->db;
			$sql_member = "SELECT * from members WHERE id = '" . $user_data['id'] . "'";
			$result_members = $connection->createCommand($sql_member)->query();

			$sql = "SELECT  mp.mstatus as stst,mp.member_id,mp.plot_id,mp.status,mp.create_date,m.image,m.phone,p.project_id,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,p.id,p.plot_detail_address,mp.plotno,p.sector,p.plot_size,siz.size,p.street_id,s.street, j.project_name,sec.sector_name FROM
			 memberplot mp left join members m on mp.member_id=m.id
			   left join plots p on mp.plot_id=p.id
			  left join sectors sec on sec.id=p.sector
			   left join streets s on p.street_id=s.id
			   left join size_cat siz on p.size2=siz.id
			left join projects j on s.project_id=j.id  WHERE m.id = '" . $user_data['id'] . "' and type='plot' ";
			$result = $connection->createCommand($sql)->query();
			$rowspt = count($result);
			$sqlfile = "SELECT  mf.mstatus as ststf,mf.member_id,mf.plot_id,mf.plotno,mf.create_date,sectors.sector_name,f.sector,f.project_id,siz.size,m.image,m.phone,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,f.id,f.plot_detail_address,f.plot_size,f.street_id,s.street, j.project_name FROM
			 memberplot mf left join members m on mf.member_id=m.id

			  left join plots f on mf.plot_id=f.id
 left join sectors on f.sector=sectors.id
			  left join size_cat siz on f.size2=siz.id
			   left join streets s on f.street_id=s.id
			left join projects j on s.project_id=j.id WHERE m.id = '" . $user_data['id'] . "' and type='file'";

			$resultfile = $connection->createCommand($sqlfile)->queryAll();
			$rowsfl = count($resultfile);

			$sqlvilla = "SELECT  mf.mstatus as ststf,mf.member_id,mf.plot_id,mf.plotno,mf.create_date,sectors.sector_name,f.sector,f.project_id,siz.size,m.image,m.phone,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,f.id,f.plot_detail_address,f.plot_size,f.street_id,s.street, j.project_name FROM
			 memberplot mf left join members m on mf.member_id=m.id

			  left join plots f on mf.plot_id=f.id
 left join sectors on f.sector=sectors.id
			  left join size_cat siz on f.size2=siz.id
			   left join streets s on f.street_id=s.id
			left join projects j on s.project_id=j.id WHERE m.id = '" . $user_data['id'] . "' and type='Villa'";

			$resultvilla = $connection->createCommand($sqlvilla)->queryAll();
			$rowsvilla = count($resultvilla);



			$sql_history  = "SELECT mp.plot_id,mp.transferfrom_id,mp.transfer_date,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,siz.size,sector,mp.transfer_date,p.plot_size,s.street,a.plotno, j.project_name FROM plothistory mp
			left join members m on mp.transferfrom_id=m.id
			left join memberplot a on mp.plot_id=a.plot_id
			 left join plots p on mp.plot_id=p.id
			 left join streets s on p.street_id=s.id
			  left join size_cat siz on p.size2=siz.id
			 left join projects j on s.project_id=j.id
			 WHERE transferfrom_id =" . $user_data['id'] . "";
			$result_pages = $connection->createCommand($sql_history)->query();

			$connection = Yii::app()->db;

			$sql_ut = "SELECT tp.*,s.street,siz.size,p.price,mp.comment,sec.sector_name,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name,p.project_id,mp.plotno,m_from.name from_name,m_to.name to_name,tp.plot_id as tid,m_to.RFM RFM FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN memberplot mp ON mp.plot_id=p.id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
				Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id
where tp.transferto_id =" . $user_data['id'] . " and p.status='Requested(T)'";
			$result_ut = $connection->createCommand($sql_ut)->query();
			$rowsut = count($result_ut);
			$this->render('dashboard', array(
				'rowsvilla' => $rowsvilla, 'resultvilla' => $resultvilla, 'result_members' => $result_members, 'result' => $result, 'resultfile' => $resultfile, 'pages' => $result_pages, 'rowspt' => $rowspt, 'rowsfl' => $rowsfl, 'ut' => $result_ut,
				'utc' => $rowsut
			));
		} else {
			$this->redirect(Yii::app()->baseUrl . "/index.php/member/member");
		}
	}

public function actionDashboardlatest()

	{	
		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
		    $this->layout='//layouts/front';
			$user_data = Yii::app()->session['member_array'];
			$connection = Yii::app()->db; 
			$sql_member = "SELECT * from members WHERE id = '".$user_data['id']."'";
			$result_members = $connection->createCommand($sql_member)->query();
			
			$sql = "SELECT  mp.mstatus as stst,mp.member_id,mp.plot_id,mp.status,mp.create_date,m.image,m.phone,p.project_id,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,p.id,p.plot_detail_address,mp.plotno,p.sector,p.plot_size,siz.size,p.street_id,s.street, j.project_name,sec.sector_name FROM
			 memberplot mp left join members m on mp.member_id=m.id
			   left join plots p on mp.plot_id=p.id
			  left join sectors sec on sec.id=p.sector
			   left join streets s on p.street_id=s.id
			   left join size_cat siz on p.size2=siz.id
			left join projects j on s.project_id=j.id  WHERE m.id = '".$user_data['id']."' and type='plot' ";
			$result = $connection->createCommand($sql)->query();
				$rowspt =count($result);
		$sqlfile = "SELECT  mf.mstatus as ststf,mf.member_id,mf.plot_id,mf.plotno,mf.create_date,sectors.sector_name,f.sector,f.project_id,siz.size,m.image,m.phone,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,f.id,f.plot_detail_address,f.plot_size,f.street_id,s.street, j.project_name FROM
			 memberplot mf left join members m on mf.member_id=m.id
			 
			  left join plots f on mf.plot_id=f.id
 left join sectors on f.sector=sectors.id
			  left join size_cat siz on f.size2=siz.id
			   left join streets s on f.street_id=s.id
			left join projects j on s.project_id=j.id WHERE m.id = '".$user_data['id']."' and type='file'";
			
			$resultfile = $connection->createCommand($sqlfile)->queryAll();
            	$rowsfl =count($resultfile);
            	
            	$sqlvilla = "SELECT  mf.mstatus as ststf,mf.member_id,mf.plot_id,mf.plotno,mf.create_date,sectors.sector_name,f.sector,f.project_id,siz.size,m.image,m.phone,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,f.id,f.plot_detail_address,f.plot_size,f.street_id,s.street, j.project_name FROM
			 memberplot mf left join members m on mf.member_id=m.id
			 
			  left join plots f on mf.plot_id=f.id
 left join sectors on f.sector=sectors.id
			  left join size_cat siz on f.size2=siz.id
			   left join streets s on f.street_id=s.id
			left join projects j on s.project_id=j.id WHERE m.id = '".$user_data['id']."' and type='Villa'";
			
			$resultvilla = $connection->createCommand($sqlvilla)->queryAll();
            	$rowsvilla =count($resultvilla);
            	
            	
            	
			 $sql_history  = "SELECT mp.plot_id,mp.transferfrom_id,mp.transfer_date,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,siz.size,sector,mp.transfer_date,p.plot_size,s.street,a.plotno, j.project_name FROM plothistory mp 
			left join members m on mp.transferfrom_id=m.id
			left join memberplot a on mp.plot_id=a.plot_id
			 left join plots p on mp.plot_id=p.id 
			 left join streets s on p.street_id=s.id
			  left join size_cat siz on p.size2=siz.id 
			 left join projects j on s.project_id=j.id 
			 WHERE transferfrom_id =".$user_data['id'].""; 
		    $result_pages = $connection->createCommand($sql_history)->query();
			
			$connection = Yii::app()->db; 

     $sql_ut = "SELECT tp.*,s.street,siz.size,p.price,mp.comment,sec.sector_name,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name,p.project_id,mp.plotno,m_from.name from_name,m_to.name to_name,tp.plot_id as tid,m_to.RFM RFM FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN memberplot mp ON mp.plot_id=p.id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
				Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id
where tp.transferto_id =".$user_data['id']." and p.status='Requested(T)'";
		 $result_ut = $connection->createCommand($sql_ut)->query();	
		 $rowsut =count($result_ut);
		$this->render('dashboard',array('rowsvilla'=>$rowsvilla,'resultvilla'=>$resultvilla,'result_members'=>$result_members,'result'=>$result,'resultfile'=>$resultfile,'pages'=>$result_pages,'rowspt'=>$rowspt,'rowsfl'=>$rowsfl,'ut'=>$result_ut,
		'utc'=>$rowsut));
		}
		else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }		
	}

public function actionUndertransfer_payments()
	{
	     if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{  
		    $member_id=Yii::app()->session['member_array']['id'];
		$this->layout='//layouts/front';
		
			$connection = Yii::app()->db; 	
			 $member= "SELECT fstatus,transferfrom_id,transferto_id FROM transferplot 

		where plot_id='".$_REQUEST['id']."'and fstatus!='Approved' and (transferfrom_id='".$member_id."' or transferto_id='".$member_id."')";
	        $members = $connection->createCommand($member)->queryRow();
	      
	       
	          //  $members['transferto_id'].$members['transferfrom_id'];
	     
	      
			$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.com_res,p.atype,p.plot_size,sc.size,mp.id as mssid,mp.comment,mp.plotno,se.sector_name,pro.project_name,m_from.name from_name,m_to.name to_name 
			,m_to.cnic,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.state,mp.mmtype
			FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN memberplot mp ON p.id=mp.plot_id
			left join user u on tp.uid=u.id
			Left JOIN projects pro ON pro.id=p.project_id where tp.plot_id=".$_REQUEST['id']." and tp.fstatus !='Approved'";
			$result_details = $connection->createCommand($sql_details)->queryAll();
	if($member_id==$members['transferfrom_id'])
			{
			    // $members['transferfrom_id'];exit;
				    $this->render('undertransfer_payments',array('plotdetails'=>$result_details));
			}elseif($member_id==$members['transferto_id'])
			{
			   /// echo $members['transferto_id'];exit;
			    $this->render('undertransfer_payments',array('plotdetails'=>$result_details));
			}else{
			   	$this->redirect(array('member/dashboard'));
				}
		
		//$this->render('undertransfer_payments',array('plotdetails'=>$result_details));
	


}
	}





	

/*





	public function actionDashboard()

	{	
		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
		    $this->layout='//layouts/front';
			$user_data = Yii::app()->session['member_array'];
			$connection = Yii::app()->db; 
			$sql_member = "SELECT * from members WHERE id = '".$user_data['id']."'";
			$result_members = $connection->createCommand($sql_member)->query();
			
			$sql = "SELECT mp.member_id,mp.plot_id,mp.status,mp.create_date,m.image,m.phone,p.project_id,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,p.id,p.plot_detail_address,mp.plotno,p.sector,p.plot_size,siz.size,p.street_id,s.street, j.project_name,sec.sector_name FROM
			 memberplot mp left join members m on mp.member_id=m.id
			 
			   left join plots p on mp.plot_id=p.id
			  left join sectors sec on sec.id=p.sector
			   left join streets s on p.street_id=s.id
			   left join size_cat siz on p.size2=siz.id
			left join projects j on s.project_id=j.id  WHERE m.id = '".$user_data['id']."' and type='plot' ";
			$result = $connection->createCommand($sql)->query();
				$rowspt =count($result);
		$sqlfile = "SELECT mf.member_id,mf.plot_id,mf.plotno,mf.create_date,sectors.sector_name,f.sector,f.project_id,siz.size,m.image,m.phone,m.address,m.name,m.username,m.mem_id,m.sodowo,m.cnic,f.id,f.plot_detail_address,f.plot_size,f.street_id,s.street, j.project_name FROM
			 memberplot mf left join members m on mf.member_id=m.id
			 
			  left join plots f on mf.plot_id=f.id
 left join sectors on f.sector=sectors.id
			  left join size_cat siz on f.size2=siz.id
			   left join streets s on f.street_id=s.id
			left join projects j on s.project_id=j.id WHERE m.id = '".$user_data['id']."' and type='file'";
			$resultfile = $connection->createCommand($sqlfile)->query();
            	$rowsfl =count($resultfile);
			 $sql_history  = "SELECT mp.plot_id,mp.transferfrom_id,mp.transfer_date,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,siz.size,sector,mp.transfer_date,p.plot_size,s.street,a.plotno, j.project_name FROM plothistory mp 
			left join members m on mp.transferfrom_id=m.id
			left join memberplot a on mp.plot_id=a.plot_id
			 left join plots p on mp.plot_id=p.id 
			 left join streets s on p.street_id=s.id
			  left join size_cat siz on p.size2=siz.id 
			 left join projects j on s.project_id=j.id 
			 WHERE transferfrom_id =".$user_data['id'].""; 







		    $result_pages = $connection->createCommand($sql_history)->query();



		



		



		



		$this->render('dashboard',array('result_members'=>$result_members,'result'=>$result,'resultfile'=>$resultfile,'pages'=>$result_pages,'rowspt'=>$rowspt,'rowsfl'=>$rowsfl));







		}







		else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }		







	}




*/


		







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

			 $sql  = 'INSERT INTO query (user_id,subject, message,create_date,status ) VALUES ( "'.$session.'", "'.$_POST['subject'].'", "'.$_POST['message'].'","'.date('Y-m-d').'","0" )';	

			 $command = $connection -> createCommand($sql);

             $command -> execute();

			 $this->redirect('dashboard'); 







                        	







		}







	}







	







	public function actionRegister()
{


		if(isset(Yii::app()->session['user_array']['username']))

			{






	$this->layout='//layouts/back';







		          $connection = Yii::app()->db; 







		  $sql_country  = "SELECT * from tbl_country ORDER BY country ASC";







		$result_country = $connection->createCommand($sql_country)->queryAll();















		$this->render('register',array('country'=>$result_country));


			}else{
				$this->redirect(array('user/dashboard'));
				}
	}







			







	public function actionAjaxRequest3($val1)







	{	







		$connection = Yii::app()->db;  







		$sql_city  = "SELECT * from tbl_city where country_id='".$val1."' ORDER BY city ASC";







		$result_city = $connection->createCommand($sql_city)->query();







			







		$city=array();







		foreach($result_city as $cit){







			$city[]=$cit;







			} 







		







	echo json_encode($city); exit();







	}







	







	public function actionUpload_image()



	{

		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))

		{ 

		$this->layout='//layouts/front';

		$this->render('upload_image');

		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }

	}

	public function actionUpload_image1()



	{

		if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))

		{ 

		$this->layout='//layouts/front';

		$this->render('upload_image1');

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

				$target = ("SELECT image FROM members WHERE id=$session");
              	$result_image = $connection->createCommand($target)->query();
				foreach($result_image as $row){
				$old_image_name=$row['image'];
				$path="upload_pic/";
				unlink($path.$old_image_name);



				}



				$time_rand = time();

				$target_path="upload_pic/";

				$target_path = $target_path.$time_rand.$_FILES['image']['name'];

				$ad=explode('.',$_FILES['image']['name']); 

				$rnd=sizeof($ad);

				$ads=$rnd-1;

			     move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

			}  $sql="UPDATE members SET image='".$time_rand.$_FILES['image']['name']."' WHERE id=$session ";



				$command = $connection -> createCommand($sql);



			    $command -> execute();

			    $this->redirect('dashboard'); 

 		}	



}



public function actionUpload_memberimage1()



{

		$connection = Yii::app()->db;  

	    if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))

		{ 

	    $session=Yii::app()->session['member_array']['id'];

		

			

				$time_rand = time();

				$target_path="upload_pic/";

				$target_path = $target_path.$time_rand.$_FILES['image']['name'];

				$ad=explode('.',$_FILES['image']['name']); 

				$rnd=sizeof($ad);

				$ads=$rnd-1;

			     move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

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
		$this->layout = '//layouts/login1';
		$this->render('member');
	}

	public function actionMemberlatest()
	{ 

		$this->layout='//layouts/front';
		$this->render('member');
	}
	

      






	







	public function actionCss_Media()







	{ 







		$this->layout='//layouts/front';







		$this->render('www/test/css_media');







	}







	







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

		 $error ='';

	    if(isset($_POST['username']) && empty($_POST['username']))

			{

				$error = 'Please Enter Username<br>';

			}

			if(isset($_POST['password']) && empty($_POST['password']))

			{

				$error .= 'Please Enter Password<br>';

			}

			if(empty($error))

			{

				 $username = $_POST['username'];

				 $password = $_POST['password'];

				  $connection = Yii::app()->db;  

				  $sql = "SELECT * FROM members where username ='".$username."' AND  password='".$password."' AND status=1"  ;

				  $result_data = $connection->createCommand($sql)->queryRow();

				  if($result_data)

				  {
$sql1  = 'INSERT INTO members_log (member_id,date_time) 
VALUES ( "'.$result_data['id'].'","'.date('Y-m-d h:i:s').'")';		
$command = $connection -> createCommand($sql1);
 $command -> execute();

						Yii::app()->session['member_array'] = $result_data;

						echo 1;

				  }else

				  {

					 echo "Invalid Username and Password"; 

				  }

			}

			if(!empty($error))

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







	$sql = "SELECT * from filepayment WHERE mem_id= '".$user_data['id']."' and file_id='".$_GET['plot_id']."'";



	//$sql = "SELECT * from plotpayment WHERE mem_id= '".$user_data['id']."' and plot_id='".$_GET['plot_id']."'";











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
 $member_id=Yii::app()->session['member_array']['id'];
	$this->layout='//layouts/front';
	$plotid = $_REQUEST['plot_id'];		 
		$connection = Yii::app()->db;
	$sql_new = "SELECT id FROM transferplot where plot_id=".$_REQUEST['plot_id']."";
	$result_new = $connection->createCommand($sql_new)->queryRow();	
	 $member= "SELECT member_id FROM memberplot mp where plot_id='".$_REQUEST['id']."' and member_id='".$member_id."'";
	        	$members = $connection->createCommand($member)->queryRow();
	/*		$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.name from_name,m_from.name from_name,m_to.name to_name,m_to.name to_name FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id='".$result_new['id']."'"; */
						$sql_details  = "SELECT tp.*,s.street,p.plot_detail_address,p.plot_size,pro.project_name,m_from.name from_name,m_to.name to_name,m_to.cnic to_cnic,m_to.sodowo to_sodowo,m_to.email to_email,m_to.address to_address,m_from.cnic from_cnic 
			,m_to.cnic,tp.create_date,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.city_id,m_to.state
			FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN streets s ON s.id=p.street_id
			left join user u on tp.uid=u.id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id=".$result_new['id']."";
			$result_details = $connection->createCommand($sql_details)->query();

			$result_details = $connection->createCommand($sql_details)->query();
			if($member_id==$members['member_id']){
	$this->render('req_detail',array('plotdetails1'=>$result_details));
	
	    
	}else{
	    	$this->redirect(array('member/dashboard'));
		}
		 
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }

	}

public function actionPayment_details()

	{
	    if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
		     $member_id=Yii::app()->session['member_array']['id'];
	        	
			$this->layout='//layouts/front';
		$connection = Yii::app()->db;
$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
	 $land  = "SELECT * FROM installpayment where fstatus !='Cancelled' and others !='Cancelled' and fstatus !='Bounce' and plot_id='".$_REQUEST['id']."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
			    $member= "SELECT member_id FROM memberplot mp where plot_id='".$_REQUEST['id']."' and member_id='".$member_id."'";
	        	$members = $connection->createCommand($member)->queryRow();
	        	 
		//	echo $members['member_id'];exit;

		   $sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."'";
$result_payments = $connection->createCommand($sql_payment)->queryAll();
	    $sql_member= "SELECT mp.id,mp.member_id,mp.plot_id,mp.member_id,m.cnic,m.image,mp.plotno,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."' "; 
		$result_members = $connection->createCommand($sql_member)->queryAll();
		 $sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc
left join charges c on pc.charges_id=c.id 
where plot_id='".$_REQUEST['id']."'";
		$res=$connection->createCommand($sql)->queryAll();

		 $sql_plotinfo  = "SELECT mp.mstatus as stst,p.*,proj.project_name,sectors.sector_name,streets.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join memberplot mp on mp.plot_id=p.id
left join sectors on p.sector=sectors.id
left join streets on p.street_id=streets.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."' and mp.member_id='".$member_id."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
	if($member_id==$members['member_id']){
		$this->render('payment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));
	
	    
	}else{
	    	$this->redirect(array('member/dashboard'));
		}
		    
		}
	}

	public function actionPayment()



	{	



		



			$this->layout='//layouts/front';



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



	
public function actionInstallment_details()

	{
 if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 
		    $member_id=Yii::app()->session['member_array']['id'];
		    $connection = Yii::app()->db;
            $this->layout='//layouts/front';

        	$sql_primeloc  = "SELECT *  FROM cat_plot
        LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
        WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
        $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
		
       $member= "SELECT member_id FROM memberplot mp where plot_id='".$_REQUEST['id']."' and member_id='".$member_id."'";
	   $members = $connection->createCommand($member)->queryRow();
	$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' AND others!='Cancelled' AND fstatus!='Cancelled' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			     $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."' and member_id='".$member_id."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'  ";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
		$sql_plotinfo  = "SELECT mp.mstatus as stst,p.*,proj.project_name,sectors.sector_name,streets.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join memberplot mp on mp.plot_id=p.id
left join sectors on p.sector=sectors.id
left join streets on p.street_id=streets.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."' and  member_id='".$member_id."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";
		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
	        	if($member_id==$members['member_id']){
		$this->render('installment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));
		}else{
	    	$this->redirect(array('member/dashboard'));
		}
		
		}

	}

	


public function actionPlothistory()

	{	

	if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))
		{ 

		$this->layout='//layouts/front';
			$connection = Yii::app()->db;
             $member_id=Yii::app()->session['member_array']['id'];
            $member= "SELECT member_id FROM memberplot mp where plot_id='".$_REQUEST['id']."' and member_id='".$member_id."'";
	        $members = $connection->createCommand($member)->queryRow();
			
			$sql_page  = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name,size_cat.size FROM memberplot mp left join members m on mp.member_id=m.id
           left join plots p on mp.plot_id=p.id 
		   left join streets s on p.street_id=s.id
		   left join size_cat size_cat on size_cat.id=p.size2
		    left join projects j on s.project_id=j.id WHERE plot_id ='".$_REQUEST['id']."'";
		    $result_pages = $connection->createCommand($sql_page)->query();

			$sql_history  = "SELECT mp.transferfrom_id,mp.transfer_date, m.name,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name,size_cat.size FROM plothistory mp
			 left join members m on mp.transferfrom_id=m.id
           left join plots p on mp.plot_id=p.id
		    left join streets s on p.street_id=s.id 
			left join size_cat size_cat on size_cat.id=p.size2
			left join projects j on s.project_id=j.id 
			WHERE plot_id ='".$_REQUEST['id']."'";

		    $result_history = $connection->createCommand($sql_history)->query();
			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";
			$result_projects = $connection->createCommand($sql_projects)->query();
	

			$sql_plot_installment = "select installment from plots where id=1";
		$result_plot_installment = $connection->createCommand($sql_plot_installment)->query();	
    if($member_id==$members['member_id']){
			$this->render('plothistory',array('pages'=>$result_pages,'history'=>$result_history, 'projects'=>$result_projects,'num_of_installments'=>$result_plot_installment));

	
	    
	}else{
	    	$this->redirect(array('member/dashboard'));
		}
		

		


			///$this->render('plothistory',array('pages'=>$result_pages,'history'=>$result_history, 'projects'=>$result_projects,'num_of_installments'=>$result_plot_installment));


		}







		else{$this->redirect(Yii::app()->baseUrl."/index.php/member/member"); }







	}


public function actionTransferplothistory()







	{	







	if(isset(Yii::app()->session['member_array']) && isset(Yii::app()->session['member_array']['username']))







		{ 







			$this->layout='//layouts/front';







			$connection = Yii::app()->db;



			 /* $sql_page  = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp left join members m on mp.member_id=m.id







           left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id WHERE plot_id ='".$_REQUEST['id']."'";



	    $result_pages = $connection->createCommand($sql_page)->query();*/



			



			 $sql_history  = "SELECT mp.plot_id,mp.transferfrom_id,mp.transfer_date,m.name,m.sodowo,m.cnic, m.address,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM plothistory mp 



			left join members m on mp.transferfrom_id=m.id



			 left join plots p on mp.plot_id=p.id 



			 left join streets s on p.street_id=s.id 



			 left join projects j on s.project_id=j.id 



			 WHERE transferfrom_id =".$_REQUEST['id'].""; 







		    $result_pages = $connection->createCommand($sql_history)->query();







			$sql_projects  = "SELECT * from plothistory where transferfrom_id='".$_REQUEST['id']."'";







			$result_projects = $connection->createCommand($sql_projects)->query();



     		



			$this->render('dashboard',array('pages'=>$result_pages, 'projects'=>$result_projects));







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







		

  public function actionMs_status()
	{ 

		$this->layout='//layouts/back';
		$this->render('ms_status');
	}
	
  public function actionMs_status123()
	{ 

		$this->layout='//layouts/back';
		$this->render('ms_status123');
	}
public function actionMsstupdate123()
	{
			$uid=Yii::app()->session['user_array']['id'];
		 $error ='';
		if(isset($_POST['det']) && empty($_POST['det'])){ 
			$error .= 'Please enter detail<br>';
		}
		if(!empty($error)){
			echo $error;
			}else
				{
$connection = Yii::app()->db;
 /*echo $sql  = 'Update memberplot SET mstatus="'.$_POST['msstatus'].'",status_type="'.$_POST['type'].'",status_com="'.$_POST['det'].'" where id="'.$_POST['msid'].'"';	exit;	
$command = $connection -> createCommand($sql);
 $command -> execute(); */
 
$qry=" SELECT * FROM `memberplot` WHERE `mstatus` !=0";
	$result_members = $connection->createCommand($qry)->queryAll();
	foreach($result_members as $roww){
	    
      $sqlstatus = "insert into status_history123 (user_id,status,detail,status_date,plot_id,type) value ("."'".$roww['uid']."'".",'".$roww['mstatus']."','".$roww['det']."','".date('Y-m-d h:i:s')."','".$roww['plot_id']."','".$roww['status_type']."')"; 		

$command = $connection -> createCommand($sqlstatus);
 $command -> execute();
	}
 echo 'Plot Status Updated';
	}
	}
public function actionMsstupdate()
	{
			$uid=Yii::app()->session['user_array']['id'];
		 $error ='';
		if(isset($_POST['det']) && empty($_POST['det'])){ 
			$error .= 'Please enter detail<br>';
		}
		if(!empty($error)){
			echo $error;
			}else
				{
$connection = Yii::app()->db;
 $sql  = 'Update memberplot SET mstatus="'.$_POST['msstatus'].'" where id="'.$_POST['msid'].'"';	
$command = $connection -> createCommand($sql);
 $command -> execute(); 
$sqlstatus = "insert into status_history123 (user_id,status,detail,status_date,plot_id,type) value ("."'".$uid."'".",'".$_POST['msstatus']."','".$_POST['det']."','".date('Y-m-d h:i:s')."','".$_POST['plot_id']."','".$_POST['type']."')"; 		
$command = $connection -> createCommand($sqlstatus);
 $command -> execute();
 echo 'Plot Status Updated';
	}
	}
/*public function actionMsstupdate()
	{
			$uid=Yii::app()->session['user_array']['id'];
		 $error ='';
		if(isset($_POST['det']) && empty($_POST['det'])){ 
			$error .= 'Please enter detail<br>';
		}
		if(!empty($error)){
			echo $error;
			}else
				{
$connection = Yii::app()->db;
 $sql  = 'Update memberplot SET mstatus="'.$_POST['msstatus'].'",status_type="'.$_POST['type'].'",status_com="'.$_POST['det'].'" where id="'.$_POST['msid'].'"';		
$command = $connection -> createCommand($sql);
 $command -> execute(); 
$sqlstatus = "insert into status_history (user_id,status,type,detail,status_date,plot_id) value ("."'".$uid."'".",'".$_POST['msstatus']."','".$_POST['type']."','".$_POST['det']."','".date('Y-m-d h:i:s')."','".$_POST['plot_id']."')"; 		
$command = $connection -> createCommand($sqlstatus);
 $command -> execute();
 echo 'Plot Status Updated';
	}
	}*/







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




