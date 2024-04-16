<?php

class MemberplotsalesController extends Controller

{

	public function actionDealer() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_dealer = "SELECT * from	members where mtype='Dealer'";
            $res_dealer = $connection->createCommand($sql_dealer)->query();
            $sql_details = "SELECT * from	members 
			 Left JOIN memberplot ON memberplot.dealer_id=members.id
			 where memberplot.id=" . $_REQUEST['msid'] . "";
            $result_details = $connection->createCommand($sql_details)->query();
            $this->render('dealer', array('amemdetails' => $result_details,'dealer' => $res_dealer));
        } else {
            $this->redirect(array("dashboard"));
        }
    }
	public function actionAdddealer() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $error = '';
            $dealer='';
            $msid='';
            //$error =array();
            $connection = Yii::app()->db;
            if(isset($_POST['dealer'])){$dealer = $_POST['dealer'];}
            if(isset($_POST['msid'])){$msid = $_POST['msid'];}

            if ((isset($dealer) && empty($dealer))) {
                $error = "Select Dealer. <br>";
            } 
            if (empty($error)) {
                $uid = Yii::app()->session['user_array']['id'];
                $sql = "UPDATE memberplot set dealer_id='" . $dealer . "' where id='".$msid."'";
            $command = $connection->createCommand($sql);
            $command->execute();
            echo 'Dealer Added Successfully';
                exit;
            } else if (!empty($error)) {

                echo $error;
            }
        } 
    }

	 /////////////////////////////START: Property Module///////////////////
	 public function actionTransferprop()
		{	if(isset(Yii::app()->session['user_array']['username'])){	

	 
	$this->layout='//layouts/back';
	$plotid = $_GET['plot_id'];		 
	$connection = Yii::app()->db;  
	$sql_plotedtails = "SELECT assoc.id as associd,cp.status as cpstatus,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,m.phone,m.address,
	mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,j.id,j.project_name,
	floors.name as fname,buildings.name as bname,size_cat.size FROM memberplot mp left join members m on mp.member_id=m.id left join associates assoc on mp.id=assoc.msid left join plots p on mp.plot_id=p.id left join floors floors on floors.id=p.floor_id left join size_cat size_cat on size_cat.id=p.size2 left join buildings buildings on floors.building_id=buildings.id left join cancelplot cp on cp.plot_id=p.id left join projects j on p.project_id=j.id 
   WHERE p.id ='".$plotid."' ";
	$plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
	$this->render('transferprop',array('plotdetails'=>$plotdetails));
	}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	exit();
	}
	 public function actionMember_prop_lis() {
        if ((Yii::app()->session['user_array']['per2'] == '1') && isset(Yii::app()->session['user_array']['username']) || (Yii::app()->session['user_array']['per12'] == '1')) {

            if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) && (empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
                $error = "Please Fill Atleast one field";
                $members = "";
                $connection = Yii::app()->db;
                $sql_com_res = "SELECT DISTINCT com_res FROM plots";
                $result_com_res = $connection->createCommand($sql_com_res)->query();
                $temp_projects_array = Yii::app()->session['projects_array'];
                $num_of_projects_counter = count($temp_projects_array);
                $num_of_projects_counter2 = $num_of_projects_counter;
                $sql1 = "select * from projects where";
                $num_of_projects_counter--;
                while ($num_of_projects_counter > -1) {
                    $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                    $num_of_projects_counter--;
                }

                $sql_project = $sql1;

                $sql_project = $sql_project . implode(' or', $sql2);
                $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
                $this->render('member_prop_lis', array('error' => $error, 'members' => $members, 'projects' => $result_projects, 'com_res' => $result_com_res));
                exit;
            }
            $error = "";
            $and = false;
            $where = '';
            if ($_POST['name'] != "") {
                $where .= " m.name LIKE '%" . $_POST['name'] . "%'";
                $and = true;
            }


            if ($_POST['sodowo'] != "") {
                if ($and == true) {
                    $where .= " and m.sodowo LIKE '%" . $_POST['sodowo'] . "%'";
                } else {
                    $where .= " m.sodowo LIKE '%" . $_POST['sodowo'] . "%'";
                }
                $and = true;
            }


            if ($_POST['cnic'] != "") {
                if ($and == true) {
                    $where .= " and m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                } else {
                    $where .= " m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                }
                $and = true;
            }





            if ($_POST['project_name'] != "") {
                if ($and == true) {
                    $where .= " and p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= " p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                }
                $and = true;
            }

            if (!empty($_POST['plotno'])) {
                if ($and == true) {
                    $where .= " and mp.plotno ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= "mp.plotno='" . $_POST['plotno'] . "'";
                }
                $and == true;
            }

            if ($_POST['plot_detail_address'] != "") {
                if ($and == true) {
                    $where .= " and p.plot_detail_address LIKE '%" . $_POST['plot_detail_address'] . "%'";
                } else {
                    $where .= " p.plot_detail_address LIKE '%" . $_POST['plot_detail_address'] . "%'";
                }
                /* if($where!='')
                  $where.=" AND ";
                  else $where.=' WHERE ';
                  $where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'"; */
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
            $sql1 = "select * from projects where";
            $num_of_projects_counter--;
            while ($num_of_projects_counter > -1) {
                $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                $num_of_projects_counter--;
            }

            $sql_project = $sql1;
            $sql_project = $sql_project . implode(' or', $sql2);
            $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
            $this->render('member_prop_lis', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects));
        } else {
            $this->redirect(array("user/dashboard"));
        }
    }

    public function actionSearchreqprop() {

        $where = "p.is_property='1'";
        $and = true;
        if (!empty($_POST['project_name'])) {
            if ($and == true) {
                $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            } else {
                $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            }
            $and = true;
        }
        if (!empty($_POST['name1'])) {
            $where .= "and m.name LIKE '%" . $_POST['name1'] . "%'";
            $and = true;
        }
        if (isset($_POST['com_res']) && $_POST['com_res'] != "") {
            $where .= "and p.com_res LIKE '%" . $_POST['com_res'] . "%'";
            $and = true;
            $com_res = $_POST['com_res'];
        }
        if (!empty($_POST['sodowo'])) {
            if ($and == true) {
                $where .= " and m.sodowo LIKE '%" . $_POST['sodowo'] . "%'";
            } else {
                $where .= " m.sodowo LIKE '%" . $_POST['sodowo'] . "%'";
            }
            $and = true;
        }
        if (!empty($_POST['cnic'])) {
            if ($and == true) {
                $where .= " and m.cnic =" . $_POST['cnic'] . "";
            } else {
                $where .= " m.cnic =" . $_POST['cnic'] . "";
            }
            $and = true;
        }
        if (!empty($_POST['app_no'])) {
            if ($and == true) {
                $where .= " and mp.app_no =" . $_POST['app_no'] . "";
            } else {
                $where .= " mp.app_no =" . $_POST['app_no'] . "";
            }
            $and = true;
        }
        if (!empty($_POST['allotmentstatus'])) {
            $allotmentstatus = '';
            if ($_POST['allotmentstatus'] == 1) {
                if ($and == true) {
                    $where .= " and mp.status='Approved'";
                } else {
                    $where .= " mp.status='Approved'";
                }
            }
            if ($_POST['allotmentstatus'] == 2) {
                if ($and == true) {
                    $where .= " and mp.status!='Approved'";
                } else {
                    $where .= " mp.status!='Approved'";
                }
            }
            if ($_POST['allotmentstatus'] == 3) {
                if ($and == true) {
                    $where .= " and p.status='Requested(T)'";
                } else {
                    $where .= " p.status='Requested(T)'";
                }
            }

            $and = true;
        }

        if (!empty($_POST['plot_detail_address'])) {
            if ($and == true) {
                $where .= " and p.plot_detail_address ='" . $_POST['plot_detail_address'] . "'";
            } else {
                $where .= "p.plot_detail_address='" . $_POST['plot_detail_address'] . "'";
            }
            $and == true;
        }
        if (!empty($_POST['plotno'])) {
            if ($and == true) {

                $where .= " and mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
        }
        if (!empty($_POST['allotmentstatus'])) {
            if ($_POST['allotmentstatus'] == 1) {
                $where .= " and mp.status='Approved'";
            }
            if ($_POST['allotmentstatus'] == 2) {
                $where .= " and mp.status!='Approved' and mp.fstatus!='Approved'";
            }
            if ($_POST['allotmentstatus'] == 4) {
                if ($and == true) {
                    $where .= " and mp.mstatus=2";
                } else {
                    $where .= " mp.mstatus=0";
                }
            }
        }
        //for Pagination
        if (isset($_POST['limit']) && $_POST['limit'] !== '') {
            $limit = $_POST['limit'];
        } else {
            $limit = 15;
        }
        $adjacent = 15;
        $page = $_REQUEST['page'];
        if ($page == 1) {
            $start = 0;
        } else {
            $start = ($page - 1) * $limit;
        }
        $connection = Yii::app()->db;
        $sql_memberas = "SELECT * FROM memberplot mp
			left join members m on mp.member_id=m.id
			left join plots p on mp.plot_id=p.id
			left join transferplot tp on p.id=tp.id
			left join streets s on p.street_id=s.id
			left join projects j on p.project_id=j.id
			where $where";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end
        $connection = Yii::app()->db;
        $sql_member = "SELECT assoc.id as associd,cp.status as cpstatus,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,j.id,j.project_name,floors.name as fname,buildings.name as bname,size_cat.size FROM memberplot mp left join members m on mp.member_id=m.id left join associates assoc on mp.id=assoc.msid left join plots p on mp.plot_id=p.id left join floors floors on floors.id=p.floor_id left join size_cat size_cat on size_cat.id=p.size2 left join buildings buildings on floors.building_id=buildings.id left join cancelplot cp on cp.plot_id=p.id left join projects j on p.project_id=j.id
			where  $where  ORDER BY mp.plotno ASC limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;
        if ($result_members != '') {
            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $i = 0;
            $res = array();
            foreach ($result_members as $key) {
                $i++;
                $count++;

                echo $count . ' result found';
                $msco = '';
                if ($key['stst'] == 0) {
                    $msco = 'Green';
                }if ($key['stst'] == 1) {
                    $msco = 'Orange';
                }if ($key['stst'] == 2) {
                    $msco = 'Red';
                }if ($key['stst'] == 3) {
                    $msco = 'Black';
                }

                if ($key['cpstatus'] == 'New') {
                    echo'<tr style=" font-weight:bold;color:red;"><td style=" font-weight:bold;color:red;">';

                    if (empty($key['plotno'])) {
                        echo 'App-' . $key['app_no'];
                    } else {
                        echo $key['plotno'];
                    } echo'</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['name'] . '</td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td>' . $key['size'] . '&nbsp;(' . $key['plot_size'] . ')</td><td><strong>' . $key['plot_detail_address'] . '</strong><td>' . $key['street'] . '</td><td>' . $key['sector_name'] . '</td><td>' . $key['project_name'] . '</td><td>Requested for cancellation</td>';
                } else {


                    /// echo '<tr>';


                    echo'<tr><td style=" font-weight:bold;color:' . $msco . ';">';
                    if (empty($key['plotno'])) {
                        echo 'App-' . $key['app_no'];
                    } else {
                        echo $key['plotno'];
                    } echo'</td>
			<td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td>
			<td>';
                    echo $key['size'] . '&nbsp;(' . $key['plot_size'] . ')';
                    echo'</td>
			<td><strong>';
                    if ($key['stst'] == 2) {
                        echo'<span style="color:red">Blocked</span>';
                    } else {
                        echo '<a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'];
                    }echo'</strong></a>
			<td>';
                    if ($key['stst'] == 2) {
                        echo'<span style="color:red">Blocked</span>';
                    } else {
                        echo $key['fname'];
                    } echo '</td>
			<td>';
                    if ($key['stst'] == 2) {
                        echo'<span style="color:red">Blocked</span>';
                    } else {
                        echo $key['bname']; 
                    }echo'</td>
			<td>' . $key['project_name'] . '</td><td>
			<div class="dropdown">
			   <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
				Dropdown
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		  <li role="presentation"><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
		  <li role="presentation"><a href="amembers?mid='.$key['msid'].'">Associates Member</a></li>

		  ';
			if(Yii::app()->session['user_array']['per32']==1 ){
 echo '<li role="presentation"><a href="'.Yii::app()->baseUrl.'/index.php/member/ms_status?msid='.$key['msid'].'&& plot_id='.$key['plot_id'].'">Update Status</a></li>';}
$sqltest = "SELECT * FROM  plots where id='".$key['plot_id']."'  "; 
$resulttest = $connection->createCommand($sqltest)->query();
  
    
		  foreach($resulttest as $test){	 
		 if($test['status']=='Requested(T)'){ echo '<li role="presentation"><a  href="'.$home.'/index.php/memberplot/treq_detail?id='.$key['plot_id'].'">Transfer Details</a></li>';}
		  if($test['status']=='Alotted') {echo '<li role="presentation"><a target="_blank" href="transferprop?plot_id='.$key['plot_id'].'"> Transfer Plot</a></li>';}
		  }
		  
		  }
echo '  </ul></div>
</td>';
		
		
		
		}
        }



        // for pagination
        $pagination = '';
        if ($page == 0)
            $page = 1;     //if no page var is given, default to 1.
        $prev = $page - 1;       //previous page is page - 1
        $next = $page + 1;       //next page is page + 1
        $prev_ = '';
        $first = '';
        $lastpage = ceil($rows / $limit);
        $next_ = '';
        $last = '';
        $adjacents = $adjacent;
        if ($lastpage > 1) {
            if ($page > 1)
                $prev_ .= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
            else {
                
            }
            if ($lastpage < 5 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                $first = '';
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                }
                $last = '';
            } elseif ($lastpage > 3 + ($adjacents * 2)) { //enough pages to hide some
                $first = '';
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"current\">$counter</span>";
                        else
                            $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                    }
                    $last .= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $first .= "<a class='page-numbers' href=\"?page=1\">First</a>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"current\">$counter</span>";
                        else
                            $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                    }
                    $last .= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
                } else {
                    $first .= "<a class='page-numbers' href=\"?page=1\">First</a>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"current\">$counter</span>";
                        else
                            $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                    }
                    $last = '';
                }
            }
            if ($page < $counter - 1)
                $next_ .= "<a class='page-numbers' href=\"?page=$next\">next</a>";
            else {
                
            }
            $pagination = "<div class=\"pagination\">" . $first . $prev_ . $pagination . $next_ . $last;
            $pagination .= "</div>\n";
        }
        echo '<tr  ><td colspan="11"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;' . $rows . '</b></td></tr>';
        echo '<tr><td colspan="11">' . $pagination . '</td></tr>';
        exit;
        // for pagination END




        echo $count . ' result found';
        exit;
        if (isset($_POST['username']) && empty($_POST['username'])) {
            $error = 'Please enter username<br>';
        }
        if (isset($_POST['password']) && empty($_POST['password'])) {
            $error .= 'Please enter Password<br>';
        }
        if (empty($error)) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $connection = Yii::app()->db;
            $sql = "SELECT * FROM user where username ='" . $username . "' AND  password='" . $password . "' AND status=1";
            $result_data = $connection->createCommand($sql)->queryRow();
            if ($result_data) {
                Yii::app()->session['user_array'] = $result_data;
                echo 1;
                exit();
            } else {
                echo "Invalid Username and Password";
            }
        } else {
            echo $error;
        }
        exit;
    }
	public function actionRequest_form()
	{
		if(isset(Yii::app()->session['user_array']['username'])){	

	 
			$this->layout='//layouts/back';
			///$plotid = $_GET['plot_id'];		 
			$connection = Yii::app()->db;  
			$sql_plotedtails = "SELECT  mp.plotno,m_from.name as fromname,m_from.sodowo as fromsodowo,m_from.cnic as fromcnic,m_from.phone as fromphone,m_from.address as fromaddress,m_to.name as toname,m_to.sodowo as tosodowo,m_to.cnic as tocnic,m_to.phone as tophone,m_to.address as toaddress,p.id  plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name ,se.sector_name,sc.size
		FROM transferplot tp 
		Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id 
		left join plots p on tp.plot_id=p.id 
		left join memberplot mp on mp.plot_id=p.id 
		left join streets s on p.street_id=s.id 
		left join projects j on s.project_id=j.id 
		left join sectors se on p.sector=se.id 
		left join size_cat sc on p.size2=sc.id 
		   WHERE tp.id='".$_GET['id']."'";
			$plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
			$this->render('request_form',array('plotdetails'=>$plotdetails));
	}  } 
    
	public function actionTransferdocs()
	{
		if(isset(Yii::app()->session['user_array']['username'])){	

	 
			$this->layout='//layouts/back';
			$plotid = $_GET['plot_id'];		 
			$connection = Yii::app()->db;  
			$sql_plotedtails = "SELECT  m_from.name as fromname,m_from.sodowo as fromsodowo,m_from.cnic as fromcnic,m_from.phone as fromphone,m_from.address as fromaddress,m_to.name as toname,m_to.sodowo as tosodowo,m_to.cnic as tocnic,m_to.phone as tophone,m_to.address as toaddress,p.id  plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name ,se.sector_name,sc.size
		FROM transferplot tp 
		Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id 
		left join plots p on tp.plot_id=p.id 
		left join streets s on p.street_id=s.id 
		left join projects j on s.project_id=j.id 
		left join sectors se on p.sector=se.id 
		left join size_cat sc on p.size2=sc.id 
		   WHERE p.id ='".$plotid."' and tp.status !='Approved' ";
			$plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
			$this->render('transferdocs',array('plotdetails'=>$plotdetails));
	}  } 
    
    ///////START:ASSOCIATE MEMBER//////////
    	public function actionAmembers()
	{
	if(isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db; 	
			 $sql_details  = "SELECT * from	associates 
			 Left JOIN members ON members.id=associates.mid
			 where msid=".$_REQUEST['mid']."";
			$result_details = $connection->createCommand($sql_details)->query();
			$this->render('amemdetails',array('amemdetails'=>$result_details)); 
			}else{$this->redirect(array("dashboard"));}


	}
	public function actionAddamem()
	 	{ 
			if(isset(Yii::app()->session['user_array']['username']))
			{   
					$error='';
                                    //$error =array();
									$connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
									if ((isset($base) && empty($base))){
									 $error="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }elseif($result_data['status']!=1){
									 $error.='Applicant Containing '.$base.' CNIC is Not Active Register Member.<br>';
									}
								  	 if(empty($error)){		 	
										 $uid=Yii::app()->session['user_array']['id'];
				 $sql  = "INSERT INTO associates (msid,mid,uid,cdate) 
				VALUES ('".$_POST['msid']."','".$result_data['id']."','".$uid."','".date('Y-m-d H:i:s')."')";			 
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
					echo 'New Associates Inserted';
                        exit;
						}
						  else if(!empty($error)){ 
						    echo $error;

             } 

			}
		
	}    
    
    //////END: ASSOCIATE MEMBER///////////
    
    
    
    
    ///////////////////////START: PROPERTY MODULE///////////////////////
		public function actionAjaxRequest11($building_id,$sizep,$floor_id)
		{	
		$connection = Yii::app()->db;  
//if($_POST['pptype']=='C'){$type='Commercial';}else{$type='Residential';}
		 $sql_plot  = "SELECT * from property where building_id='".$building_id."' and size2='".$size."' and floor_id='".$floor_id."' and status=''";
		$result_plots = $connection->createCommand($sql_plot)->query();
		$plot=array();
		foreach($result_plots as $plo)
		{
			$plot[]=$plo;

		} 
	echo json_encode($plot); exit();
	}
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
		public function actionAllotmentsprop_lis()
		{	
	if((Yii::app()->session['user_array']['id']!=='')&& isset(Yii::app()->session['user_array']['username'])){
			$name='';
			$sodowo='';
			$cnic='';
			$plotno='';
			$project_name='';
			$plot_detail_address='';
			$error='';
			$where='';
			$members='';
			$result_projects='';
			$result_com_res='';

			if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) && (empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
				$connection = Yii::app()->db;
				$sql_com_res = "SELECT DISTINCT com_res FROM plots";
				$result_com_res = $connection->createCommand($sql_com_res)->query();
				$temp_projects_array = Yii::app()->session['projects_array'];
				$num_of_projects_counter = count($temp_projects_array);
				$num_of_projects_counter2 = $num_of_projects_counter;
				$sql1 =   "select * from projects where";
				$num_of_projects_counter--;
				while ($num_of_projects_counter > -1) {
					$sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
					$num_of_projects_counter--;
				}
				$sql_project = $sql1;
				$sql_project = $sql_project . implode(' or', $sql2);
				$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
				$this->render('allotmentsprop_lis', array('error' => $error, 'members' => $members, 'projects' => $result_projects, 'com_res' => $result_com_res));
				exit;
			}
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
				
					$error="";
			$and = false;
			$where="mp.status='Sales'";
			
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
			if (!empty($_POST['plot_detail_address'])){
				if ($and==true)
				{
					$where.=" and mp.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";
				}
			    else
				{
					$where.=" mp.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";
				}
				/*if($where!='')
					$where.=" AND ";
				else $where.=' WHERE ';
				$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";*/
			}
			$connection = Yii::app()->db;
$temp_projects_array = Yii::app()->session['projects_array'];
$num_of_projects_counter = count($temp_projects_array);
$num_of_projects_counter2 = $num_of_projects_counter;
$sql1 ="select * from projects where";
$num_of_projects_counter--;
while($num_of_projects_counter>-1)
{
 $sql2[$num_of_projects_counter] ="id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];

 $num_of_projects_counter--;
}

$sql_project = $sql1;
$sql_project = $sql_project.$sql2;
$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
	$connection = Yii::app()->db; 
	 $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM property mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id";
	    	$result_members = $connection->createCommand($sql_member)->query();
   			if(isset($_POST['search'])){
            $res=array();
			            foreach($members as $key){
  echo '<tr><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a>
  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>
</br>';if($key['status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer asdsaasdPlot</a>';}
echo'  </td></tr>'; 
            }
			}
			$this->render('allotmentsprop_lis',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));
	}else{
		 $this->redirect(array("user/dashboard"));	

		}
	}
			public function actionPropreq_detail()
		{

	if(Yii::app()->session['user_array']['per12']=='1')

			{

			$connection = Yii::app()->db; 	

				 $sql_details  = "SELECT buildings.id as buildid,buildings.name as building_name,floors.name as floor_name,mp.member_id,mp.plot_id,u.firstname,u.middelname,u.lastname,u.cnic,u.email,j.code,c.code as scode,c.size,mp.noi,mp.id as sid,mp.fcomment,p.com_res,mp.create_date,mp.fstatus,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.type ,p.status,p.plot_detail_address,p.id,p.plot_size,j.id as proid, j.project_name,sc.name as scname FROM  memberplot mp
		left join members m on mp.member_id=m.id
		left join plots p on mp.plot_id=p.id
		left join size_cat c on p.size2=c.id
		left join user u on mp.user_name=u.id
		left join sales_center sc on u.sc_id=sc.id
		Left JOIN floors  ON (p.floor_id = floors.id)
		Left JOIN projects j  ON (p.project_id = j.id)
		Left JOIN buildings  ON (floors.building_id = buildings.id)
		
		 where mp.plot_id=".$_REQUEST['plot_id'];
		$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['plot_id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('propreq_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	}
				public function actionPro_installment_details()
			{	
				$connection = Yii::app()->db;
				$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' ";
				$result_payments = $connection->createCommand($sql_payment)->queryAll();
					   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
			   left join members m on mp.member_id=m.id
				where plot_id='".$_REQUEST['id']."'";
				$result_members = $connection->createCommand($sql_member)->queryAll();
				$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
				$result_charges = $connection->createCommand($sql_charges)->queryAll();
			//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
				$sql_plotinfo  = "SELECT mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
				left join projects proj on p.project_id=proj.id
				left join memberplot mp on mp.plot_id=p.id
				left join sectors sec on p.sector=sec.id
				 left join streets st on p.street_id=st.id
				left join size_cat s on p.size2=s.id
				 where p.id='".$_REQUEST['id']."'";
				$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
		
				
				$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";
		
				$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
				$sql_primeloc  = "SELECT *  FROM cat_plot
		LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
		WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
		$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
				
		
				$this->render('pro_installment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));
		
				}
			public function actionProp_payment_details()
			{
				if(isset(Yii::app()->session['user_array']['username'])){	
				$connection = Yii::app()->db;
				$land  = "SELECT * FROM installpayment	where plot_id='".$_REQUEST['id']."' ";
				$land_cost = $connection->createCommand($land)->queryAll();
				$member= "SELECT * FROM memberplot mp where plot_id='".$_REQUEST['id']."'";
				$members = $connection->createCommand($member)->queryRow();
				$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."' and (mem_id='".$members['member_id']."' or payment_type NOT IN ('MS Fee','Transfer Fee'))";		
				$result_payments = $connection->createCommand($sql_payment)->queryAll();
				$sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
			   left join members m on mp.member_id=m.id
				where plot_id='".$_REQUEST['id']."'";
				$result_members = $connection->createCommand($sql_member)->queryAll();
				$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc left join charges c on pc.charges_id=c.id 
		
		where plot_id='".$_REQUEST['id']."'";
		
				$res=$connection->createCommand($sql)->queryAll();
				//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
				//$result_charges = $connection->createCommand($sql_charges)->queryAll();
				$sql_plotinfo  = "SELECT  p.type,p.is_property,buildings.name as building_name,floors.name as floor_name,mp.mstatus as stst, p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
				left join projects proj on p.project_id=proj.id
				left join memberplot mp on mp.plot_id=p.id
				left join sectors sec on p.sector=sec.id
				left join streets st on p.street_id=st.id
	    		Left JOIN floors  ON (p.floor_id = floors.id)
                Left JOIN buildings  ON (floors.building_id = buildings.id)     
				left join size_cat s on p.size2=s.id
				 where p.id='".$_REQUEST['id']."'";
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
////////////////////////START: ALLOT a Property///////////////////////////
        public function actionPropmemberplot()
		{	
	 if(Yii::app()->session['user_array']['per12']=='1')
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
		 $sql_building = "SELECT * from buildings";
	     $result_building = $connection->createCommand($sql_building)->query();
		     $sql_size  = "SELECT * from size_cat where typee='P'";
		    $result_size = $connection->createCommand($sql_size)->query();
			$sql_ptype  = "SELECT * from ptype";
		    $result_ptype = $connection->createCommand($sql_ptype)->query();
			$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
		$this->render('propmemberplot',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan,'categories'=>$categories,'size'=>$result_size,'buildings'=>$result_building,'ptype'=>$result_ptype));
		
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
///////////////////////////////////END: ALLOT a Property//////////////////////////////////////	
	public function actionSubmitprop()
	{
		$error='';
		$connection = Yii::app()->db;
		$pid='';
		
									 $pid=$_POST['plot_id'];
								if ((isset($_POST['tempms']) && empty($_POST['tempms']))){
								 echo $error.="Membership No required. <br>";exit;
								
								 }
								
								 	  $ms='';
									  $plotid='';
									 if(empty($error)){
										$ms=$_POST['procode'].'-'.$_POST['tempms'].'-'.$_POST['sizecode'];
									if(!empty($ms)){
										
										 
									$q ="SELECT * from property where plotno='".$ms."'"; 
									$result_q = $connection->createCommand($q)->queryRow();
									if ($result_q['plotno']==$ms){
									echo $error.="Membership # Already Added Try Another. <br>";
									exit;
									}
									}
									 $sql="Update property SET status='New', fstatus='',plotno='".$ms."' where id='".$pid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		echo '<script>location.href="allotmentsprop_lis";</script>';exit;
		

		
									 }
									 else{
										 echo $error;exit;
										 }
	
		
	 }
		       
///////////////////////////////////END: PROPERTY MODULE	
       
public function actionAjaxDealer($val1)
{	
	$connection = Yii::app()->db;  
	$sql_dealer = "SELECT * from members WHERE status='1' and mtype='Dealer'";
	$result_dealer = $connection->createCommand($sql_dealer)->query();
	$dealer=array();
	foreach($result_dealer as $dealer){
		$dealer[]=$deal;
		}
echo json_encode($dealer); exit();
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
     
     //////////////START:CANCEL ALLOTMENT REQUEST////////////////////
	public function actionCancelallot(){
		$connenction=yii::app()->db;
		$sqlcharges="Select * from plotpayment where plot_id='".$_REQUEST['plot_id']."' and mem_id='".$_REQUEST['mem_id']."'";
		$rescharges=$connenction->CreateCommand($sqlcharges)->queryRow();
		
		$sqlins="Select * from installpayment where plot_id='".$_REQUEST['plot_id']."' and mem_id='".$_REQUEST['mem_id']."'";
		$resins=$connenction->CreateCommand($sqlins)->queryRow();
		if(empty($rescharges['paidamount'])&& empty($resins['paidamount']))
		{
			$connenction=yii::app()->db;
			$sqlchdel="Delete from plotpayment where plot_id='".$_REQUEST['plot_id']."'";
			$cmd=$connenction->CreateCommand($sqlchdel);
			$cmd->execute();
			
			$sqlinsdel="Delete from installpayment where plot_id='".$_REQUEST['mem_id']."'";
			$cmd1=$connenction->CreateCommand($sqlinsdel);
			$cmd1->execute;
			
			$sqlupdate="update plots set status='' where plot_id='".$_REQUEST['plot_id']."'";
			$updt=$connenction->CreateCommand($sqlupdate);
			$updt->execute();
			
			$sqldel="delete from memberplot where plot_id='".$_REQUEST['plot_id']."'";
			$cmddel=$connenction->CreateCommand($sqldel);
			
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
			
			$cmddel->execute();
			
		$this->render('allotments_lis',array('projects'=>$result_projects));
		}else{
			$connenction=yii::app()->db;
			$sqlcnclpp="Update plotpayment set fstatus='Cancelled',others='Cancelled' where plot_id='".$_REQUEST['plot_id']."'";
			$cmdcnclpp=$connenction->CreateCommand($sqlcnclpp);
			$cmdcnclpp->execute();
			
			$sqlcnclip="Update installpayment set fstatus='Cancelled',others='Cancelled' where plot_id='".$_REQUEST['plot_id']."'";
			$cmdcnclip=$connenction->CreateCommand($sqlcnclip);
			$cmdcnclip->execute();
			
			$sqldel="Delete from memberplot where plot_id='".$_REQUEST['plot_id']."'";
			$cmddel=$connenction->CreateCommand($sqldel);
			$cmddel->execute();
			
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
			
					$this->render('allotments_lis',array('projects'=>$result_projects));
			}
		
		}
	
	
	
	/////////////END:CANCEL ALLOTMENT REQUEST///////////////////////
	
	///////////////START:CANCEL TRANSFER REQUEST////////////////////
		public function actionCanceltransfer(){
		echo 123;exit;
		
		$connenction=yii::app()->db;
		 $sqlcharges="Select * from plotpayment where plot_id='".$_REQUEST['plot_id']."' and mem_id='".$_REQUEST['mem_transto']."' and paidamount !=''";
		$rescharges=$connenction->CreateCommand($sqlcharges)->queryRow();
		
		$sqlins="Select * from installpayment where plot_id='".$_REQUEST['plot_id']."' and mem_id='".$_REQUEST['mem_transto']."' and paidamount !=''";
		$resins=$connenction->CreateCommand($sqlins)->queryRow();
		if(empty($rescharges['paidamount'])&& empty($resins['paidamount']))
		{
			$connenction=yii::app()->db;
			$sqlchdel="Delete from transferplot where plot_id='".$_REQUEST['plot_id']."'";
			$cmd=$connenction->CreateCommand($sqlchdel);
			$cmd->execute();
			
			
			$sqlupdate="update plots set status='Alotted' where plot_id='".$_REQUEST['plot_id']."'";
			$updt=$connenction->CreateCommand($sqlupdate);
			$updt->execute();
			
			$sqldel="delete from memberplot where plot_id='".$_REQUEST['plot_id']."'";
			$cmddel=$connenction->CreateCommand($sqldel);
			
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
			
			$cmddel->execute();
			
		$this->render('allotments_lis',array('projects'=>$result_projects));
		}else{?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
        
        
 				
              <?php $html='<div id="myElem" class="">
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Notification</h4>
        </div>
        <div class="modal-body">
          <p>Payment received against this property.this request can not be deleted .</p>
        </div>
        
     
    </div>	       
             </div>';?>
			
            
      
			
			 <?php $connection = Yii::app()->db; 
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
			
					$this->render('transfer_lis',array('projects'=>$result_projects,'html'=>$html));
			}
		
		}
	
	
	///////////////END:CANCEL TRANSFER REQUEST//////////////////////
     
     
       
       ///////////Start:Location charges///////////////////////////////
	   public function actionLocationch() {
        $error = '';
        if ((isset($_POST['price']) && empty($_POST['price']))) {
            $error = 'Please Enter Plot Price<br />';
        }


        if (empty($error)) {//echo 123;exit;
            $connection = Yii::app()->db;

            $sql1 = "UPDATE plots SET price='" . $_POST['price'] . "',basic_price='" . $_POST['basic_price'] . "',PLcharges='" . $_POST['PLcharges'] . "',extra_land_price='" . $_POST['extra_land_price'] . "',remarks='" . $_POST['remarks'] . "' where id= '" . $_REQUEST['id'] . "'";
            $command = $connection->createCommand($sql1);
            $command->execute();

            echo 'Plot Pricing Updated';
            exit;
        } else {
            echo $error;
        }
    }
	public function actionLocation_charges()

	{
		$this->render('location_charges');
	}
	///////////END: Location Charges////////////////////////////////
       
       
        //////////////////////START: CANCELLATION MODULE////////////////////
              public function actionPayment_detailsc()

	{
if(isset(Yii::app()->session['user_array']['username']))

			{
		$connection = Yii::app()->db;

		$land  = "SELECT * FROM installpayment	where fstatus ='Cancelled' and others ='Cancelled' and plot_id='".$_REQUEST['id']."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		
		   $member= "SELECT * FROM memberplot mp where plot_id='".$_REQUEST['id']."'";
		$members = $connection->createCommand($member)->queryRow();
			

		 $sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."' and (mem_id='".$members['member_id']."' or payment_type NOT IN ('MS Fee','Transfer Fee'))";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

		

	   $sql_member= "SELECT cp.plot_id, cph.msno, cp.member_id,m.cnic,m.image,m.name FROM cancelplot cp
			 		   left join members m on cp.member_id=m.id
			 LEFT JOIN cancelplothistory cph ON cp.plot_id = cph.plot_id
			 WHERE cp.plot_id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		

		

		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='".$_REQUEST['id']."'";

		$res=$connection->createCommand($sql)->queryAll();

		

		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";

		//$result_charges = $connection->createCommand($sql_charges)->queryAll();

		

		$sql_plotinfo  = "SELECT mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join memberplot mp on mp.plot_id=p.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
			$connection = Yii::app()->db;
			$sql_primeloc  = "SELECT *  FROM cat_plot
			LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
			WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
			$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
					

	

		$this->render('payment_detailsc',array('payments'=>$result_payments,'primeloc'=>$result_prime,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));
			}else{
				
					$this->redirect(array('user/dashboard'));

				}
		

	}
	public function actionInstallment_detailsc()

	{
if(isset(Yii::app()->session['user_array']['username']))

			{
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' and fstatus in('Cancelled')";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			    $sql_member= "
			 SELECT cp.plot_id, cph.msno, cp.member_id,m.cnic,m.image,m.name FROM cancelplot cp
			 		   left join members m on cp.member_id=m.id
			 LEFT JOIN cancelplothistory cph ON cp.plot_id = cph.plot_id
			 WHERE cp.plot_id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "SELECT mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join memberplot mp on mp.plot_id=p.id
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
		

		$this->render('installment_detailsc',array('payments'=>$result_payments,'primeloc'=>$result_prime,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		}else{
				
					$this->redirect(array('user/dashboard'));

				}

	}
       
        ////////START:cancelled files list
		public function actionAjaxRequest1233($val1)
		{	
			$connection = Yii::app()->db;  
			 $sql_city  = "SELECT * from size_cat where typee ='P'";
			$result_city = $connection->createCommand($sql_city)->query();
			$city=array();
			foreach($result_city as $cit){
				$city[]=$cit;
				} 
		echo json_encode($city); exit();
		}
    	
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
public function actionDeleteins()

	{
			 $connection = Yii::app()->db; 
			  $sql_del = "DELETE from installpayment where id=".$_GET['did'];
			 $command = $connection -> createCommand($sql_del);
             $command -> execute();
			 $this->redirect (array('memberplotsales/installment_details?id='.$_GET['id'].''));
		
	}

public function actionCalsur()
	{
	$surchargedur=0;
	$connection = Yii::app()->db;
	$plot_id =$_REQUEST['id'];			
	$sql_charges  = "SELECT * from installpayment where plot_id='".$_REQUEST['id']."' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
	$result_charges = $connection->createCommand($sql_charges)->queryAll();	
	$totalssss=0;
	foreach($result_charges as $key){
	$ddamount=0;
	$sql_charges1  = "SELECT * from installpayment where ref='".$_REQUEST['id']."' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
	$result_charges1 = $connection->createCommand($sql_charges1)->queryAll();
	$ddamount=$key['dueamount']-$key['paidamount'];
	foreach($result_charges1 as $key1){
		if($key1['paid_date']==''){$curdate=$_REQUEST['datee'];}else{$curdate=$key1['paid_date'];}
	$surchargeratio=($ddamount)/100*0.05;
	$duedate=$key['due_date'];
	if($key['paid_date']==''){$paiddate=$_REQUEST['datee'];}else{$paiddate=$key['paid_date'];}
	$datetime1 = new DateTime($duedate);
	$datetime2 = new DateTime($paiddate);
	$interval = $datetime1->diff($datetime2); 
	$surchargedur= $interval->format('%R%a ');
	if($surchargedur > 1){
	$totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}	
	$totalssss=$totalssss+$totalduesur;
	$ddamount=$ddamount+$key1['paidamount'];
		}
	if($key['paid_date']==''){$curdate=$_REQUEST['datee'];}else{$curdate=$key['paid_date'];}
	$surchargeratio=$key['dueamount']/100*0.05;
	$duedate=$key['due_date'];
	if($key['paid_date']==''){$paiddate=$_REQUEST['datee'];}else{$paiddate=$key['paid_date'];}
	$datetime1 = new DateTime($duedate);
	$datetime2 = new DateTime($paiddate);
	$interval = $datetime1->diff($datetime2); 
	$surchargedur= $interval->format('%R%a ');
	if($surchargedur > 1){
	$totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}	
	$totalssss=$totalssss+$totalduesur;
	}
	echo round($totalssss);exit;
    }
public function actionSurchargedef()
		{
			$error =array();
			$error = '';
			if (!empty($_REQUEST['datee'])) {
				$datee = $_REQUEST['datee'];
			} else {
				$datee = date('Y-m-d');
			}
			if((isset($_POST['plot_id']) && empty($_POST['plot_id']))  ||(isset($_POST['duedate']) && empty($_POST['duedate']))  || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment']))|| (isset($_POST['total']) && empty($_POST['total'])))
			{
				$error = 'Please complete all required fields <br />';
			}
				if(empty($error)){
						$connection = Yii::app()->db;
						$sqlchrgesdetail='Select * from charges where id="'.$_POST['charges_id'].'"';
						$resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
						$sql  = 'INSERT INTO plotpayment  (plot_id,payment_type,amount, remarks,duedate) VALUES ("'.$_POST['plot_id'].'","'.$resultcharges['name'].'", "'.$_POST['total'].'","'.$_POST['comment'].'","'.$_POST['duedate'].'")';          
						$command = $connection -> createCommand($sql);
						$command -> execute();
						
						$plot_id =$_POST['plot_id'];			
						$sql_charges  = "SELECT * from installpayment where plot_id='".$_POST['plot_id']."' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
						$result_charges = $connection->createCommand($sql_charges)->queryAll();
						$totalssss=0;
						foreach($result_charges as $key){
						if($key['paid_date']==''){$curdate=$_POST['cdate'];}else{$curdate=$key['paid_date'];}
						$surchargeratio=$key['dueamount']/100*0.05;
						$duedate=$key['due_date'];
						if($key['paid_date']==''){$paiddate=$_POST['cdate'];}else{$paiddate=$key['paid_date'];}
						$datetime1 = new DateTime($duedate);
						$datetime2 = new DateTime($paiddate);
						$interval = $datetime1->diff($datetime2); 
						$surchargedur= $interval->format('%R%a ');
						$datetime3 = new DateTime($datee);
	if($datetime1 < $datetime3){
  //
						$interval = $datetime1->diff($datetime2); 
						$surchargedur= $interval->format('%R%a ');
						if($surchargedur > 1){
						$sql  = 'UPDATE installpayment SET surcharge_re=1 where id="'.$key['id'].'"';                      
					    $command = $connection -> createCommand($sql);
			            $command -> execute();
						}}	
						 $sql_charges1  = "SELECT * from installpayment where ref='".$key['id']."' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
								$result_charges1 = $connection->createCommand($sql_charges1)->queryAll();
								///$ddamount=$key['dueamount']-$key['paidamount'];
								foreach($result_charges1 as $key1){
								//////	if($key1['paid_date']!==$key['paid_date']){
								//	if($key1['paid_date']==''){$curdate=$_REQUEST['datee'];}else{$curdate=$key1['paid_date'];}
							//	$surchargeratio=($ddamount)/100*0.05;
							//	$duedate=$key['paid_date'];
							//	if($key1['paid_date']==''){$paiddate=$_REQUEST['datee'];}else{$paiddate=$key1['paid_date'];}
							///	$datetime1 = new DateTime($duedate);
								//$datetime2 = new DateTime($paiddate);
							   // $datetime3 = new DateTime($_REQUEST['datee']);
								///if($datetime2 < $datetime3){
								//$interval = $datetime1->diff($datetime2); 
								//$surchargedur= $interval->format('%R%a ');
								//if($surchargedur > 1){
									 $sql1  = 'UPDATE installpayment SET surcharge_re=1 where id="'.$key1['id'].'"';                      
											$command = $connection -> createCommand($sql1);
											$command -> execute();
								
								//}	
								
								//	}
								//	}
								}
						}
												
						echo "Charges Added Successfully";
						}
						if(!empty($error)){
						echo $error;
					}
	
	
		}
	
	
public function actionDiscount1()
	{
		$error='';
		if((isset($_POST['total']) && empty($_POST['total'])) && (isset($_POST['details']) && empty($_POST['details'])))
		{
			$error = 'Please complete all required fields <br />';
		}
if($error==''){//echo 123;exit;
				    $connection = Yii::app()->db;
					$sql_payment  = "SELECT * FROM discnt where ms_id='".$_POST['pid']."'";
					$result_payments = $connection->createCommand($sql_payment)->queryRow();
					
					if($result_payments==''){
					$sql  = "INSERT INTO discnt SET ms_id= '".$_POST['pid']."',discount='".$_POST['total']."',details='".$_POST['details']."'";
					$command = $connection -> createCommand($sql);
					$command -> execute();}else{
					$sql1  = "UPDATE discnt SET discount='".$_POST['total']."',details='".$_POST['details']."' where ms_id= '".$_POST['pid']."'";
					$command = $connection -> createCommand($sql1);
					$command -> execute();
						
						}
						//echo 123;exit;
						echo 'Discount Applied';exit; 
				}
	}

public function actionPlotsurcharge()
	{	if(isset(Yii::app()->session['user_array']['username']))

			{
			$this->layout='//layouts/back';
			$connection = Yii::app()->db;
			$plot_id =$_REQUEST['id'];			
			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."' and name like '%Surcharge%'";
			$result_charges = $connection->createCommand($sql_charges)->query();
			$sql_plots  = "SELECT * from plots where id='".$plot_id."'";
			$result_plots = $connection->createCommand($sql_plots)->query();
			$this->render('plotsurcharge',array('plots'=>$result_plots,'charges'=>$result_charges));

	}else{
		$this->redirect(array('user/dashboard'));

		}

	}


public function actionDiscount()
	{
		$this->render('discount');

		}
	public function actionSearchreq1()
	 	{
		$where='is_property=0';
		$and='And ';
		if (isset($_POST['type']) && $_POST['type'] != "") {
			$type = $_POST['type'];
			if($type=="Plot" || $type=="file"|| $type=="Villa" )
				{
					$where .= "p.type ='" . $_POST['type'] . "'";
					$and = true;
				}
			
		}
			/*if (isset($_POST['type']) && $_POST['type'] != "") {
				$where .= "p.type ='" . $_POST['type'] . "'";
				$and = true;
				$type = $_POST['type'];
			}*/
				if (!empty($_POST['name1'])){
				$where.=" m.name LIKE '%".strip_tags($_POST['name1'])."%'";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m.sodowo LIKE '%".strip_tags($_POST['sodowo'])."%'";

				}
				else
				{

					$where.=" m.sodowo LIKE '%".strip_tags($_POST['sodowo'])."%'";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m.cnic =".strip_tags($_POST['cnic'])."";
				}
				else
				{
					$where.=" m.cnic =".strip_tags($_POST['cnic'])."";
				}
				$and=true;
			}if (!empty($_POST['allotmentstatus'])){
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
			if (!empty($_POST['stat'])){
				$q='';
				if($_POST['stat']=='1'){
					$q="mp.status='New'";
					}else{$q="mp.status='Sales'";}
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
	
			if (!empty($_POST['appno'])){

				if ($and==true)
				{
					$where.=" and mp.app_no ='".strip_tags($_POST['appno'])."'";
				}
				else
				{
					$where.="mp.app_no ='".strip_tags($_POST['appno'])."'";
				}
				$and==true;
			}
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".strip_tags($_POST['plotno'])."%'";
				}
				else
				{
					$where.="mp.plotnoLIKE '%".strip_tags($_POST['plotno'])."%'";
				}
				$and==true;
			}
			 if (isset($_POST['com_res']) && $_POST['com_res']!=""){

				$where.="and p.com_res LIKE '%".$_POST['com_res']."%'";

				$and = true;

				$com_res=$_POST['com_res'];

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
 $sql_memberas = "SELECT * FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.id
left join streets s on p.street_id=s.id
".$jo."
left join projects j on p.project_id=j.id
where  $where  ".$filter."";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.app_no,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
".$jo."
left join projects j on p.project_id=j.id
where $where ".$filter."   limit $start,$limit"; 
		$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
	if ($result_members!=''){
		$home=Yii::app()->request->baseUrl; 
		$check=1;
		$res=array();
            foreach($result_members as $key){
            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['app_no'].'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'"><strong>'.$key['plot_detail_address'].'</strong></a><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td><td>
			<a target="_blank" href="req_detail?plot_id='.$key['plot_id'].'">Request Detail</a></br>
			<a target="_blank" href="'.Yii::app()->request->baseUrl.'/index.php/memberplot/amembers?mid='.$key['msid'].'">Associates Member</a>
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
    echo '<tr  ><td colspan="12"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="12">'.$pagination.'</td></tr>'; exit; 
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
	public function actionAllotments_lis()
	{
if(isset(Yii::app()->session['user_array']['username'])){
		$name='';
		$sodowo='';
		$cnic='';
		$plotno='';
		$project_name='';
		$plot_detail_address='';
		$where='';
		$and = false;
		$members = "";
		$error='';
		if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) && (empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
				$connection = Yii::app()->db;
				$sql_com_res = "SELECT DISTINCT com_res FROM plots";
				$result_com_res = $connection->createCommand($sql_com_res)->query();
				$temp_projects_array = Yii::app()->session['projects_array'];
				$num_of_projects_counter = count($temp_projects_array);
				$num_of_projects_counter2 = $num_of_projects_counter;
				$sql1 =   "select * from projects where";
				$num_of_projects_counter--;
				while ($num_of_projects_counter > -1) {
					$sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
					$num_of_projects_counter--;
				}
				$sql_project = $sql1;
				$sql_project = $sql_project . implode(' or', $sql2);
				$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
				$this->render('allotments_lis', array('error' => $error, 'members' => $members, 'projects' => $result_projects, 'com_res' => $result_com_res));
				exit;
			}
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
		$connection = Yii::app()->db;
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 ="select * from projects where";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
		$sql2[$num_of_projects_counter] ="id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
		$num_of_projects_counter--;
		}
		$sql_project = $sql1;
		$sql_project = $sql_project.$sql2;
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
		if (!empty($_POST['plot_detail_address'])){
			if ($and==true)
			{
				$where.=" and p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";
			}
			else
			{
				$where.=" p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";
			}
		}
$connection = Yii::app()->db;
 $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where $where p.type='plot' and mp.status='Approved' and mp.uid='".Yii::app()->session['user_array']['id']."' ";
		 $result_members = $connection->createCommand($sql_member)->query();
		if(isset($_POST['search'])){
		$res=array();
		foreach($members as $key){
echo '<tr><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a>
</br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>
</br>';if($key['status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer asdsaasdPlot</a>';}
echo'  </td></tr>';
		}
		}

		$this->render('allotments_lis',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));
}else{
	 $this->redirect(array("user/dashboard"));

	}
}
public function actionAlotaplot1()
	 	{ 
		
          
			if(Yii::app()->session['user_array']['id']!=='')

			{   
					$error='';

                                    //$error =array();

									$connection = Yii::app()->db;  

									 $base=$_POST['cnic']; 
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
									 $error.="Plot No Required. <br>";}
									
										 if ((isset($_POST['project']) && empty($_POST['project']))){
								    	 $error.="Please Select Project. <br>";
										 }
										 if ((isset($_POST['street_id']) && empty($_POST['street_id']))){
										 $error.="Please Select Street <br>";
									 }
								  
								  if ((isset($_POST['noi']) && empty($_POST['noi']))){

									 $error.="No.Of Installment required. <br>";
									 }
									 if ((isset($_POST['appnoo']) && empty($_POST['appnoo']))){

									 $error.="Application # Required. <br>";
									 }
									 if ((isset($_POST['atype']) && empty($_POST['atype']))){

									 $error.="Allotment Type Required. <br>";
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
								

								  //if ((isset($_POST['plotno']) && empty($_POST['plotno']))){
								 //$error.="Plot Membership No required. <br>";
								 //}
								
								 	//$pn=$_POST['procode'].'-'.$_POST['plotno'].'-'.$_POST['sizecode'];
									//if(!empty($pn)){
									//$q ="SELECT * from memberplot where plotno='".$pn."'"; 
									  //$result_q = $connection->createCommand($q)->queryRow();
									//if ($result_q['plotno']==$pn){
									 //$error.="Membership # Already Added Try Another. <br>";
									//}
									//}
								 $q ="SELECT * from memberplot left join plots on plots.id=memberplot.plot_id where memberplot.app_no='".$_POST['appnoo']."' and plots.project_id='".$_POST['project']."'"; 
									$result_q = $connection->createCommand($q)->queryRow();
									if (!empty($result_q)){
									$error.="Application # Already Added Try Another. <br>";
									}
										 if(empty($error)){
											 	
	
										 $uid=Yii::app()->session['user_array']['id'];
										 
				 $sql  = "INSERT INTO memberplot (app_no,plot_id,user_name,member_id,lo_id,create_date,mmtype,noi,insplan,status,fstatus,comment,uid) 

	VALUES ('".$_POST['appnoo']."','".$_POST['plot_id']."','".$uid."','".$result_data['id']."','".$_POST['landowner']."','".date('Y-m-d H:i:s')."','".$dealer."','".$_POST['noi']."','".$_POST['insplan']."','Sales','Sales','','".Yii::app()->session['user_array']['id']."')";	
					 
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
						$insert_id = Yii::app()->db->getLastInsertID();
			
			//$discount  = "INSERT INTO discnt (ms_id,status,details,discount)VALUES ('".$insert_id."','New','".$_POST['discd']."','".$_POST['disc']."')";			
  			//$command = $connection -> createCommand($discount);
            //$command -> execute();				
		
			 $sql_cat  = "SELECT * from cat_plot where plot_id='".$_POST['plot_id']."'";
       		 $result_cat = $connection->createCommand($sql_cat)->queryAll();
			foreach($result_cat as $new){
       		$sql1  = "SELECT * from charges where type='".$new['cat_id']."'";
			 $result1 = $connection->createCommand($sql1)->queryRow();
			 $plot  = "SELECT * from plots where id='".$_POST['plot_id']."'";
			 $plots = $connection->createCommand($plot)->queryRow();
			  $update  = "UPDATE plots set status='Requested', atype='".$_POST['atype']."' WHERE id='".$_REQUEST['plot_id']."'";		
			 $command = $connection -> createCommand($update);
			  $command -> execute();
			 $chargess=$plots['price']/100*$result1['total'];
			/// $sqlcharges="INSERT INTO plotpayment SET payment_type='".$result1['name']."',amount='".$chargess."', duedate='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";							
   		    $sqlcharges="INSERT INTO plotpayment SET payment_type='".$result1['name']."',amount='".$chargess."', due_date_temp='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";	
   		   
   		               $command = $connection -> createCommand($sqlcharges);
                        $command -> execute();
			}
			$sql_cat12  = "SELECT * from charges where name LIKE '%MS Fee%'";
       		 $result_cat12 = $connection->createCommand($sql_cat12)->queryRow();
			 if($result_cat12!==''){
			/// $sqlchargesm="INSERT INTO plotpayment SET payment_type='MS Fee',amount='".$result_cat12['total']."', duedate='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";							
   		        $sqlchargesm="INSERT INTO plotpayment SET payment_type='MS Fee',amount='".$result_cat12['total']."', due_date_temp='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";	
   		               $command = $connection -> createCommand($sqlchargesm);
                        $command -> execute();}
                        
						$update  = "UPDATE plots set status='Requested', atype='".$_POST['atype']."' WHERE id='".$_REQUEST['plot_id']."'";		
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
						// $sqlinstall="INSERT INTO installpayment SET lab='".$dataplan['lab'.$lab.'']."',dueamount='".$dataplan[''.$instalno.'']."', due_date='".$create."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'"; 
					//	$next_due_date = strtotime($create.' + '.$tno.' Months');
					
						 $sqlinstall="INSERT INTO installpayment SET lab='".$dataplan['lab'.$lab.'']."',dueamount='".$dataplan[''.$instalno.'']."', due_date_temp='".$create."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'"; 
						$next_due_date = strtotime($create.' + '.$tno.' Months');
						$create=date('Y-m-d', $next_due_date);			
   		               $command = $connection -> createCommand($sqlinstall);
                        $command -> execute();
						$insert++;
						
						}while($insert<$insplan);
						
					echo 'Plot Allotment Request Sent For Verification';
exit;
						}

						  else if(!empty($error)){ 
 
						    echo $error;



             } 

		

					

		
			}
		

	}
				

	public function actionCreate1()
		{	if(Yii::app()->session['user_array']['per2']=='1')
		{
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
          (title,name,username,password,sodowo, cnic, address, email, city_id, mtype,  country_id,phone,nomineename,nomineecnic,rwa,dob,create_date,status,RFM )VALUES ("'.($_POST['title']).'","'.$_POST['name'].'", "'.$_POST['email'].'", "'.($_POST['cnic']).'", "'.$_POST['sodowo'].'", "'.($_POST['cnic']).'", "'.($_POST['address']).'", "'.$_POST['email'].'", "'.$_POST['city_id'].'", "'.$dealer.'","'.$_POST['country'].'", "'.$_POST['phone'].'", "'.$_POST['nomineename'].'", "'.$_POST['nomineecnic'].'", "'.$_POST['rwa'].'", "'.$_POST['dob'].'", "'.date('Y-m-d').'",1,"RFSC")';	

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

      To view your onine profile  <a href="www.rdlpk.com/index.php/member/member">click here to login </a><br />

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



			echo 1;

				//echo '<a target="_blank" href="image?id='.$memid.'"><input type="button" class="btn-info" value="Add Image"><br>';

			//echo 

			///'<span class="btn-info button" font-size="16px"; style="color:#FFFFF";><a  href="sendmail?id='.$memid.'">Send Email To Member</a></span>'

			//;
		//	$this->render('sendmail',array('result'=>$result,'content'=>$content,'result1'=>$result1));
	}



	if(!empty($error)){echo $error;exit;}



	}



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
			
			if ((isset($_POST['paid_date_temp']) && empty($_POST['paid_date_temp']))){
			$error.="Enter Paid Date. <br>";
			 }		
			   $connection = Yii::app()->db;  
				  if(empty($error))

			{
			$newfilename = $_POST['id'];
			$new='';
			/*if(isset($_FILES["image2"]) && $_FILES["image2"]!==''){
				if(file_exists("images/payment/$newfilename")==true){
				unlink("images/payment/$newfilename");}
			$image=$_FILES['image2']["name"];			
		   move_uploaded_file($_FILES["image2"]["tmp_name"],
			'images/payment/'.$newfilename);
			$new="image2='".$newfilename."',"; 
			
			}*/
			   $sql="UPDATE installpayment set 
			 dueamount='".$_POST['dueamount']."',
			 lab='".$_POST['lab']."',  
			 paidsurcharge='".$_POST['paidsurcharge']."',
			 paidamount='".$_POST['paidamount']."',
			 payment_type='".$_POST['payment_type']."',
			 detail='".$_POST['detail']."',
			 surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',
			$new
			paid_date_temp='".$_POST['paid_date_temp']."',
			 due_date_temp='".$_POST['due_date_temp']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	  	echo 'Installment Updated Successfully';
				}else{echo $error;}
				//$this->redirect(Yii::app()->baseUrl."/index.php/memberplotsales/installment_update?id=".$_POST['id']."&error=".$error."");
			  
	}
	public function actioncharget()
		{

		if(Yii::app()->session['user_array']['per12']=='1')

			{

		

		$error =array();
		$error = '';

		if((isset($_POST['plot_id']) && empty($_POST['plot_id']))  ||(isset($_POST['date']) && empty($_POST['date']))  || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks']))|| (isset($_POST['total']) && empty($_POST['total']))|| (isset($_POST['paidamount']) && empty($_POST['paidamount']))|| (isset($_POST['paidas']) && empty($_POST['paidas']))		|| (isset($_POST['detail']) && empty($_POST['detail'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			if(empty($error)){
			    
			    if(!isset($_POST['paidamount'])){$_POST['paidamount']=0;}
			    if(!isset($_POST['detail'])){$_POST['detail']=0;}
			    if(!isset($_POST['paidas'])){$_POST['paidas']=0;}
			    if(!isset($_POST['remarks'])){$_POST['remarks']=0;}
			    if(!isset($_POST['date'])){$_POST['date']=0;}
				    $connection = Yii::app()->db;
					$sqlchrgesdetail='Select * from charges where id="'.$_POST['charges_id'].'"';
					 $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
                      $sql  = 'INSERT INTO plotpayment  (
					  plot_id,payment_type,amount,paidamount,mem_id,detail,paidas, remarks,date) VALUES ("'.$_POST['plot_id'].'","'.$resultcharges['name'].'","'.$_POST['total'].'","'.$_POST['paidamount'].'","'.$_POST['mem'].'","'.$_POST['detail'].'", "'.$_POST['paidas'].'", "'.$_POST['remarks'].'","'.$_POST['date'].'")';                      
					    $command = $connection -> createCommand($sql);
			            $command -> execute();
						echo "Charges Added Successfully";
			        }

					if(!empty($error)){
					echo $error;
				}

	}

	}
	public function actionInstallt()
		{

		if(Yii::app()->session['user_array']['per12']=='1')

			{

		

		$error =array();
		$error = '';

		if((isset($_POST['plot_id']) && empty($_POST['plot_id']))  ||(isset($_POST['date']) && empty($_POST['date']))  || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks']))|| (isset($_POST['paidamount']) && empty($_POST['paidamount']))|| (isset($_POST['paidas']) && empty($_POST['paidas']))		|| (isset($_POST['detail']) && empty($_POST['detail'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			if(empty($error)){
				    $connection = Yii::app()->db;
				      $sql  = 'UPDATE installpayment SET 
					  paidamount= "'.$_POST['paidamount'].'",
					  mem_id="'.$_POST['mem'].'",
					  detail="'.$_POST['detail'].'",
					  paidas="'.$_POST['paidas'].'", 
					  remarks="'.$_POST['remarks'].'",
					  paid_date="'.$_POST['date'].'" where id="'.$_POST['charges_id'].'"';                      
					    $command = $connection -> createCommand($sql);
			            $command -> execute();
						echo "Installment Updated Successfully";
			        }

					if(!empty($error)){
					echo $error;
				}

	}

	}
	public function actionPlotchargest()
		{	
if(isset(Yii::app()->session['user_array']['username']))
			{
			$this->layout='//layouts/back';

			$connection = Yii::app()->db;

			$plot_id =$_REQUEST['id'];
						
			

			$sql_plots  = "SELECT * from plots where id='".$plot_id."'";
			$result_plots = $connection->createCommand($sql_plots)->queryRow();
			
			$sql_charges  = "SELECT * from charges";
			$result_charges = $connection->createCommand($sql_charges)->query();	

			$this->render('plotchargest',array('plots'=>$result_plots,'charges'=>$result_charges));
		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionPlotinstallt()
		{	

			$this->layout='//layouts/back';

			$connection = Yii::app()->db;

			$plot_id =$_REQUEST['id'];
						
			$sql_charges  = "SELECT * from installpayment where plot_id='".$plot_id."'";
			$result_charges = $connection->createCommand($sql_charges)->query();

			$sql_plots  = "SELECT * from plots where id='".$plot_id."'";
			$result_plots = $connection->createCommand($sql_plots)->query();
			

			$this->render('plotinstallt',array('plots'=>$result_plots,'charges'=>$result_charges));

	}
	public function actionTreq_detail()
		{
	if((Yii::app()->session['user_array']['per12']=='1') && isset(Yii::app()->session['user_array']['username']))
			{
			$connection = Yii::app()->db; 	
			  $sql_details  = "SELECT ach.*,ach.id as achid,tp.*,tp.*,tp.status as tpsts,tp.id as tpid,mp.plot_id,s.street,p.plot_detail_address,p.plot_size,pro.code,sc.code as scode,mp.plotno,mp.tempms,sc.size,mp.comment,se.sector_name,pro.project_name,m_from.name from_name,m_to.name to_name,mp.id as mssid,ss.name as ssname,m_to.cnic,m_to.address,p.com_res,m_to.sodowo,u.email,u.firstname,u.middelname,u.lastname,m_to.state,p.project_id FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN memberplot mp ON p.id=mp.plot_id
			Left JOIN tp_action_history ach ON p.id=ach.plot_id
			left join user u on tp.uid=u.id
			left join sales_center ss on u.sc_id=ss.id
			Left JOIN projects pro ON pro.id=p.project_id where tp.id=".$_REQUEST['id']."";
			$result_details = $connection->createCommand($sql_details)->queryRow();
			$this->render('treq_detail',array('plotdetails'=>$result_details)); 
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionDoc()
 		{

		if(Yii::app()->session['user_array']['per12']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';
	$this->render('doc');

	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionUpdocs()
		{
	
	if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }	
		//mkdir("images/imagetransfer/".$_REQUEST['id']);	
         $desired_dir="images/imagetransfer/".$_REQUEST['id'];
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"images/imagetransfer/".$_REQUEST['id']."/".$file_name);
            }else{									//rename the file if another one exist
                $new_dir="images/imagetransfer/".$_REQUEST['id']."/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
          		
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		echo "Success";
	}
}


	}	
	public function actionSplitinstallment()
		{
if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM installpayment where id='".$_REQUEST['id']."'";
		$result_payments = $connection->createCommand($sql_payment)->queryRow();
		//print_r($result_payments);
		$sql  = "INSERT INTO installpayment SET dueamount='00',
			 lab='".$result_payments['lab']."',
			 ref='".$_GET['id']."',  
			 plot_id='".$result_payments['plot_id']."', 
			  mem_id='".$result_payments['mem_id']."'  
		";
			         $command = $connection -> createCommand($sql);
					 $command -> execute();
					 $this->redirect(Yii::app()->baseUrl."/index.php/memberplotsales/installment_details?id=".$result_payments['plot_id']."&pid=");
		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
		}
	public function actionUpdatemem_plot()
	 	{ 
			if(Yii::app()->session['user_array']['per12']=='1')
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
	public function actionUpdatemember_plot()
		{	

	 if(Yii::app()->session['user_array']['per12']=='1')

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

	Left JOIN categories  ON (plots.category_id = categories.id) where  plots.id='".$_REQUEST['id']."'";

	//	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";

		$result = $connection->createCommand($sql)->query();

		$this->render('updatemember_plot',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	}
	function actionGenpdf()
		{ if (!empty($_POST['submit'])){

    //require_once();
    include Yii::app()->baseUrl."/dompdf/dompdf_config.inc.php";
	$stream=TRUE;
    $dompdf = new DOMPDF();
	$html=$_POST['html'];
	//echo $html;exit;
	$filename='PDF File';
    $dompdf->set_paper('letter','landscape');
	$dompdf->load_html($html);
    $dompdf->render();
	$dompdf->set_base_path(realpath(APPLICATION_PATH . 'styles.css'));
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}}
	public function actionInstallment_up()
		{

		if( Yii::app()->session['user_array']['per12']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
 $sql_payment  = "SELECT * FROM installpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

	$this->render('installment_up',array('payments'=>$result_payments));

	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionCapture_image()
		{

		



    $connection = Yii::app()->db; 
	$this->render('index');

	
			
    }
	public function actionInstallment_update()
     	{

		if(Yii::app()->session['user_array']['per12']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
 $sql_payment  = "SELECT * FROM installpayment where id='".$_GET['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

	$this->render('installment_update',array('payments'=>$result_payments));

	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionPhotofortransfer()
		{
	
		echo 123;exit;
		$name = $_REQUEST['id'];
		
		$newname="images/imagetransfer/".$name.".jpg";
		$file = file_put_contents( $newname, file_get_contents('php://input') );
		 $connection = Yii::app()->db;  
      $sql3 = "UPDATE transferplot SET image='".$_REQUEST['id']."' WHERE id = '".$_REQUEST['id']."'"; 	
    
	$command = $connection -> createCommand($sql3);
	$command -> execute();
		

	  		$url = 'http://rdlpk.com/' . $newname;
		print "$url\n";
		}
	public function actionCreate()
		{

		if(Yii::app()->session['user_array']['per12']=='1')

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
	,sectors.sector_name

	FROM

    memberplot

    LEFT JOIN members 

        ON (memberplot.member_id = members.id ) 

		left join plots on memberplot.plot_id=plots.id
		left join sectors on plots.sector=sectors.id
		left join size_cat on plots.size2=size_cat.id
		left join streets on plots.street_id=streets.id

		where memberplot.plot_id=".$plot_id;

		

		$member_result = $connection->createCommand($sql_member)->queryAll();

	 	$this->render('pdf',array('member'=>$member_result)); 
}
public function actionAjaxRequest70($val1,$pro)
		{	

		$connection = Yii::app()->db;  
		
		  $sql_plot  = "SELECT * from installment_planp where category_id='".$val1."' and project_id='".$pro."' ";

		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	}	
public function actionAjaxRequest7($val1,$pro)
		{	

		$connection = Yii::app()->db;  
		
		  $sql_plot  = "SELECT * from installment_plan where category_id='".$val1."' and project_id='".$pro."' ";

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
	public function actionPo()
		{	
	$i=0;
$count= count($_POST['dueamount']);
do{
	$connection = Yii::app()->db;  
	$sql1="UPDATE installpayment SET paidamount='".$_POST['paidamount'][$i]."',dueamount='".$_POST['dueamount'][$i]."', lab='".$_POST['lab'][$i]."',due_date='".$_POST['due_date'][$i]."',paid_date='".$_POST['paid_date'][$i]."' WHERE id='".$_POST['ppid'][$i]."' ";	
    $command = $connection -> createCommand($sql1);
    $command -> execute();
	$i++;
	}while($i<$count);
	$this->redirect(array("installment_edit?id=".$_POST['ploid'].""));
	
	}
	public function actionTransferplot()
		{	if(isset(Yii::app()->session['user_array']['username'])){	

	 
	$this->layout='//layouts/back';
	$plotid = $_GET['plot_id'];		 
	$connection = Yii::app()->db;  
	$sql_plotedtails = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic,m.phone,m.address,p.id  plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name ,se.sector_name,sc.size
FROM memberplot mp 
left join members m on mp.member_id=m.id 
left join plots p on mp.plot_id=p.id 
left join streets s on p.street_id=s.id 
left join projects j on s.project_id=j.id 
left join sectors se on p.sector=se.id 
left join size_cat sc on p.size2=sc.id 
   WHERE p.id ='".$plotid."' ";
	$plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
	$this->render('transferplot',array('plotdetails'=>$plotdetails));
	}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	exit();
	}
	public function actionCrequest()
	 	{
			
		    $error ='';
	   
									  $connection = Yii::app()->db;  
									
									      $sql1="UPDATE plots set status='Allotted' WHERE id='".$_REQUEST['plot_id']."' ";	
        		   					 $command = $connection -> createCommand($sql1);
                      				 $command -> execute();
	            					    $sql="DELETE FROM transferplot WHERE plot_id='".$_REQUEST['plot_id']."'  ";	 
        		   					 
									 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
									 	
									 $this->redirect (array('memberplot/member_lis'));
	
			}
	public function actionRequestTransferprop()
	 	{
			
		    $error ='';
	   
									  $connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 $uid=Yii::app()->session['user_array']['id'];
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
									  
									  $sql1 ="SELECT * from transferplot where plot_id='".$_POST['plot_id']."' and status!='Approved'"; 
									  $result_data1 = $connection->createCommand($sql1)->queryRow();
									  if(!empty($result_data1)){
										
										  $error="Already Requested. <br>";
										
										  }
										  
									if ((isset($base) && empty($base))){
									 $error="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }
									  if(empty($_POST['sc_comment']))
										{
											$error .='Please Enter Comments <br>';
										}
										if(empty($_POST['app_no']))
										{
											$error .='Please Enter Form No';
										}
									if(!empty($error)){
											echo $error;exit;
											}else{
											    if(($_POST['plot_id']!=756)||($_POST['plot_id']!=757)){
                                        $transferto_memberid = $result_data['id'];
				  		                 $tpaction="Insert into tp_action_history(plot_id,sc_id,sc_date,sc_status,sc_comment) VALUES('".$_POST['plot_id']."',
										 '".Yii::app()->session['user_array']['id']."',
										 '".date('Y-m-d H:i:s')."','Sales','".$_POST['sc_comment']."' )";	
        		   						 $command = $connection -> createCommand($tpaction);
                      				 	 $command -> execute();
                      				 	 
	            					   $sql="INSERT INTO transferplot SET plot_id='".$_POST['plot_id']."',app_no='".$_POST['app_no']."',uid='".$uid."',transferfrom_id='".$_POST['transfer_from_memberid']."',transferto_id='".$transferto_memberid."',status='Sales',fstatus='Sales',cmnt='New Request',create_date='".date('Y-m-d H:i:s')."' ";	 
        		   					 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
									 	
									 $sql1="UPDATE plots set status='Requested(T)' WHERE id='".$_POST['plot_id']."' ";	 
        		   					 $command = $connection -> createCommand($sql1);
                      				 $command -> execute();
									 	echo "Plot transfer request has been sent successfully ";
											    }
										}
			}
			public function actionRequestTransfer()
	 	{
			
		    $error ='';
	   
									  $connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 $uid=Yii::app()->session['user_array']['id'];
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
									  
									  $sql1 ="SELECT * from transferplot where plot_id='".$_POST['plot_id']."' and status!='Approved'"; 
									  $result_data1 = $connection->createCommand($sql1)->queryRow();
									  if(!empty($result_data1)){
										
										  $error="Already Requested. <br>";
										
										  }
										  
									if ((isset($base) && empty($base))){
									 $error="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }
									  if(empty($_POST['sc_comment']))
										{
											$error .='Please Enter Comments <br>';
										}
										if(empty($_POST['app_no']))
										{
											$error .='Please Enter Form No';
										}
									if(!empty($error)){
											echo $error;exit;
											}else{
											    if(($_POST['plot_id']!=756)||($_POST['plot_id']!=757)){
                                        $transferto_memberid = $result_data['id'];
				  		                 $tpaction="Insert into tp_action_history(plot_id,sc_id,sc_date,sc_status,sc_comment) VALUES('".$_POST['plot_id']."',
										 '".Yii::app()->session['user_array']['id']."',
										 '".date('Y-m-d H:i:s')."','Sales','".$_POST['sc_comment']."' )";	
        		   						 $command = $connection -> createCommand($tpaction);
                      				 	 $command -> execute();
                      				 	 
	            					   $sql="INSERT INTO transferplot SET plot_id='".$_POST['plot_id']."',app_no='".$_POST['app_no']."',uid='".$uid."',transferfrom_id='".$_POST['transfer_from_memberid']."',transferto_id='".                                     $transferto_memberid."',status='Sales',fstatus='Sales',cmnt='New Request',create_date='".date('Y-m-d H:i:s')."' ";	 
        		   					 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
									 	
									 $sql1="UPDATE plots set status='Requested(T)' WHERE id='".$_POST['plot_id']."' ";	 
        		   					 $command = $connection -> createCommand($sql1);
                      				 $command -> execute();
									 	echo "Plot transfer request has been sent successfully ";
											    }
										}
			}
	public function actionTimage()
		{
		
		 $connection = Yii::app()->db; 
				 $path="images/imagetransfer/";
				 $image=$_FILES['image']["name"];
				$newfilename = $_FILES["image"]["name"];
				move_uploaded_file($_FILES["image"]["tmp_name"],
				$path.$image);
				$sql="UPDATE transferplot SET `image`='".$newfilename."' WHERE id='".$_POST['reqid']."'";
				$command = $connection -> createCommand($sql);
				$command -> execute();
					$this->redirect('treq_detail?id='.$_POST['reqid']); 
		
		}
	public function actionInstalment()
		{

		if(Yii::app()->session['user_array']['per12']=='1')

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

	////////////////////////////////////////PLOT CHARGES FUNCTION////////////////////

	public function actioncharge()
		{

		if(Yii::app()->session['user_array']['per12']=='1')

			{

	///	echo 123;exit;

		$error =array();
		$error = '';

		if((isset($_POST['plot_id']) && empty($_POST['plot_id']))  ||(isset($_POST['duedate']) && empty($_POST['duedate']))  || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment']))|| (isset($_POST['total']) && empty($_POST['total'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			if(empty($error)){
			   /// echo 123;exit;
				    $connection = Yii::app()->db;
				 $sqlchrgesdetail='Select * from charges where id="'.$_POST['charges_id'].'"';
						 $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
				
                        $sql  = 'INSERT INTO plotpayment  (plot_id,mem_id,payment_type,amount, remarks,due_date_temp) VALUES ("'.$_POST['plot_id'].'","'.$_POST['mems'].'","'.$resultcharges['name'].'", "'.$_POST['total'].'","'.$_POST['comment'].'","'.$_POST['duedate'].'")';
					   $command = $connection -> createCommand($sql);
			            $command -> execute();
						echo "Charges Added Successfully";
			        }

					if(!empty($error)){
					echo $error;
				}

	}

	}

	

	////////////////////////////////////////////////////////////////////////////////
/*
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

	}*/

	public function actionDelete($id)
		{

		$this->loadModel($id)->delete();



		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

		if(!isset($_GET['ajax']))

			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

	}
	public function actionAddins()
	{
			if($_REQUEST['id']!=='' && $_REQUEST['mid']!=='')
				{
				    $connection = Yii::app()->db;
					 $sql  = "INSERT INTO installpayment SET plot_id= '".$_REQUEST['id']."',mem_id='".$_REQUEST['mid']."'";                     
					    $command = $connection -> createCommand($sql);
			         
					    $command -> execute();
						//echo 123;exit;
						$this->redirect(Yii::app()->baseUrl."/index.php/memberplot/installment_edit?id=".$_REQUEST['id']."&pid=".$_REQUEST['pid']);
				}
	}

	public function actionDelete_Ins()
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

	  }
	}
	public function actionDelete_Charges()
		{
		if(Yii::app()->session['user_array']['per12']=='1')
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

	  

		 if(Yii::app()->session['user_array']['per12']=='1')

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
	public function actionPlotprice()
		{	//$_REQUEST['pid']=1;
		$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from plots where id='".$_REQUEST['pid']."'";
		$result_plot = $connection->createCommand($sql_plot)->query();

		$plot=array();

		foreach($result_plot as $plo){
			$plot[]=$plo;
		} 
	echo json_encode($plot);exit;
	}
	public function actionCatprice()
		{	
		$connection = Yii::app()->db;  
		//$_REQUEST['pid']=1;
		//$_REQUEST['pid']=7;
		$sql_cat  = "SELECT * from cat_plot where plot_id='".$_REQUEST['pid']."'";
		$result_cat = $connection->createCommand($sql_cat)->queryAll();
		
		$cat=array();
		foreach($result_cat as $cate){
			$sql  = "SELECT * from categories where id='".$cate['cat_id']."'";
			$result = $connection->createCommand($sql)->queryRow();
			//echo $result['title'];exit;
			$result1=1;
			if($result!==''){
			//echo $result['title'];
			$sql1  = "SELECT * from charges where name LIKE '%".$result['title']."%'";
			$result1 = $connection->createCommand($sql1)->queryRow();}
			if($result1!==1 && $result1!==false && $result1!==''){
			$cat[]=$result1;
			}
			
		} 
	
		 
	echo json_encode($cat);exit;
	

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

	if(Yii::app()->session['user_array']['per12']=='1')

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

	///////////////////////////PLOT CHARGES////////////////////

	

	public function actionPlotcharges()
		{	

			$this->layout='//layouts/back';

			$connection = Yii::app()->db;

			$plot_id =$_REQUEST['id'];
						
			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";
			$result_charges = $connection->createCommand($sql_charges)->query();

			$sql_plots  = "SELECT * from plots where id='".$plot_id."'";
			$result_plots = $connection->createCommand($sql_plots)->query();
			$mem  = "SELECT * from memberplot where plot_id='".$plot_id."'";
			$mems= $connection->createCommand($mem)->queryRow();
			

			$this->render('plotcharges',array('plots'=>$result_plots,'charges'=>$result_charges,'mem'=>$mems));

	}
	//////////////////////////////////////////////////////////////
	public function actionMemberplot()
		{	

	 if(Yii::app()->session['user_array']['per12']=='1')

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
	
		

		$this->render('memberplot',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	}
	public function actionAllotplot()
		{	

	 if(Yii::app()->session['user_array']['per12']=='1')

			{

	

		$connection = Yii::app()->db;  

		$sql_country  = "SELECT * from tbl_country";

		$result_country = $connection->createCommand($sql_country)->query();

		
		
		 
		$sql_plan  = "SELECT * from installment_plan where project_id='".$_REQUEST['pro']."'";
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
    , projects.project_name
	, projects.code as pcode
	, categories.name
	, streets.street
	, sectors.sector_name
	, size_cat.code as scode
FROM
    plots
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN categories  ON (plots.category_id = categories.id) where type='plot' and plots.id='".$_REQUEST['id']."'";

	//	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";

		$result = $connection->createCommand($sql)->query();

		$this->render('allotplot',array('plot'=>$result,'projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	}
	public function actionMember_list()
		{	

			if(Yii::app()->session['user_array']['per12']=='1')

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
	public function actionSearchreq()
	 	{
		$where='';
		$and=false;
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
				if (isset($_POST['type']) && $_POST['type'] != "") {
						$where .= " and p.type ='" . $_POST['type'] . "'";
						$and = true;
						$type = $_POST['type'];
					}
			if (!empty($_POST['name1'])){
				$where.="and m.name LIKE '%".$_POST['name1']."%'";
				$and = true;
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
				}}
				
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
 $sql_memberas = "SELECT
    mp.status AS mpstatus,
    mp.member_id,
    mp.app_no,
    mp.mstatus AS stst,
    mp.plotno,
    mp.create_date,
    p.com_res,
    p.id,
    p.type,
    p.project_id,
    m.name,
    mp.plotno,
    m.image,
    m.sodowo,
    m.cnic,
    p.plot_detail_address,
    mp.plot_id,
    mp.status,
    p.plot_size,
    p.project_id,
    p.street_id,
    p.status AS pstatus,
    mp.id AS msid,
    s.street,
    s.id,
    j.id,
    j.project_name,
    sec.sector_name,
    size_cat.size
FROM
    memberplot mp

LEFT JOIN members m ON mp.member_id = m.id
LEFT JOIN plots p ON mp.plot_id = p.id
LEFT JOIN transferplot tp ON p.id = tp.id
LEFT JOIN streets s ON p.street_id = s.id
LEFT JOIN projects j ON p.project_id = j.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
where  $where ";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     $sql_member = "SELECT mp.dealer_id,mp.lo_id,mortg.status as mortgstatus,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join mortgaged_plots mortg on p.id=mortg.plot_id
left join projects j on p.project_id=j.id

where $where  limit $start,$limit"; 
	
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
			  if($key['stst']==0){$msco='Green';}if($key['stst']==1){$msco='Orange';}if($key['stst']==2){$msco='Red';}if($key['stst']==3){$msco='Black';}
			 echo '<tr><td style=" font-weight:bold;color:'.$msco.';">';if(empty($key['plotno'])){ echo 'App-'. $key['app_no'];}else { echo $key['plotno'];}
			   if(!empty($key['mortgstatus']))
	            {
	                echo'<img src="/images/mortgage.png" width="100" height="130" />';
	            }
			 echo'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>';echo $key['size'].'&nbsp;('.$key['plot_size'].')';echo'</td>
			 <td><strong>';if($key['stst']==2){echo'<span style="color:red">Blocked</span>';}else{
				  echo '<a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'];}echo'</strong></a>
				  <td>';if($key['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key['street'];} echo '</td>
				  <td>';if($key['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key['sector_name'];}echo'</td>
				  <td>'.$key['project_name'].'</td><td>
			  <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li role="presentation"><a target="_blank" href="request_form?plot_id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Request Form</a></li>
			<li role="presentation"><a href="amembers?mid='.$key['msid'].'">Associates Member</a></li>';
			if($key['dealer_id'] == '0') {
				echo'<li role="presentation"><a target="_blank" href="dealer?id=' . $key['plot_id'] . '&& msid=' . $key['msid'] . '">Add Dealer</a></li>';
			}
			  if(Yii::app()->session['user_array']['per32']==1 ){
   echo '<li role="presentation"><a href="'.Yii::app()->baseUrl.'/index.php/member/ms_status?msid='.$key['msid'].'&& plot_id='.$key['plot_id'].'">Update Status</a></li>';}
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
	
	';      if(empty($key['mortgstatus']))
	            {
            foreach($resulttest as $test){	 
		   if($test['status']=='Requested(T)'){ echo '<li role="presentation"><a  href="'.$home.'/index.php/memberplot/treq_detail?id='.$key['plot_id'].'">Transfer Details</a></li>';}
			if($test['status']=='Alotted') {echo '<li role="presentation"><a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer Plot</a></li>';}
            }
			
			}
  echo '  </ul></div>
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
	public function actionSearchreqf()
	 	{
		$where='';
		//echo $_POST['project_name'];exit;
		$connection = Yii::app()->db; 
   
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
			}	if (!empty($_POST['app_no'])){

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
				       
                                       $where.=" and mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno LIKE '%".$_POST['plotno']."%'";
				}
				$and==true;
			}
				$connection = Yii::app()->db; 
   
    $sql_member = "SELECT mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,tp.status as tstatus,mp.create_date,mp.fstatus,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.status as pstatus,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.plot_id
left join streets s on p.street_id=s.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join projects j on p.project_id=j.id
where $where and p.type='file'  "; 
	//echo $sql_member;exit;
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			//echo $count.' result found';
			
			 $msco='';
			  if($key['stst']==0){$msco='Green';}if($key['stst']==1){$msco='Orange';}if($key['stst']==2){$msco='Red';}if($key['stst']==3){$msco='Black';}
			 echo '<tr><td style=" font-weight:bold;color:'.$msco.';">';if(empty($key['plotno'])){ echo 'F-'. $key['app_no'];}else { echo $key['plotno'];} echo'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td><a href="'.$home.'/index.php/user/meminfo?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a>';
			 
			 echo '<td>';

$M='';
$F='';
			if($key['pstatus']=='Requested'){if(!empty($key['fstatus'])){$M='M';}else{$F='F'; } echo 'Requested('.$M.$F.')';

			}else{echo $key['pstatus'];}
			echo '</td>
			 
			 <td>'.$key['project_name'].'</td><td>';

if($key['tstatus']=='New Request' or $key['tstatus']=='Sales'){}else {
if($key['pstatus']=='Alotted'){
echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer File</a>';}}
  if(Yii::app()->session['user_array']['per32']==1 ){
   echo '/<li role="presentation"><a href="'.Yii::app()->baseUrl.'/index.php/member/ms_status?msid='.$key['msid'].'">Update Status</a></li>';}

echo '</br><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a>
<li role="presentation"><a target="_blank" href="request_form?plot_id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Request Form</a></li>
	';

 

 

			}
			 
			
			
			
			}else{echo '';}
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
	public function actionMember_lis() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) && (empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
                $error = "Please Fill Atleast one field";
                $members = "";
                $connection = Yii::app()->db;
                $sql_com_res = "SELECT DISTINCT com_res FROM plots";
                $result_com_res = $connection->createCommand($sql_com_res)->query();
                $temp_projects_array = Yii::app()->session['projects_array'];
                $num_of_projects_counter = count($temp_projects_array);
                $num_of_projects_counter2 = $num_of_projects_counter;
                $sql1 = "select * from projects where";
                $num_of_projects_counter--;
                while ($num_of_projects_counter > -1) {
                    $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                    $num_of_projects_counter--;
                }
                $sql_project = $sql1;
                $sql_project = $sql_project . implode(' or', $sql2);
                $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
                $this->render('member_lis', array('error' => $error, 'members' => $members, 'projects' => $result_projects, 'com_res' => $result_com_res));
                exit;
            }
            $error = "";
            $and = false;
            $where = '';
            if ($_POST['name'] != "") {

                $where .= " m.name LIKE '%" . $_POST['name'] . "%'";

                $and = true;
            }
            if ($_POST['sodowo'] != "") {
                if ($and == true) {
                    $where .= " and m.sodowo LIKE '%" . $_POST['sodowo'] . "%'";
                } else {
                    $where .= " m.sodowo LIKE '%" . $_POST['sodowo'] . "%'";
                }
                $and = true;
            }
            if ($_POST['cnic'] != "") {
                if ($and == true) {
                    $where .= " and m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                } else {
                    $where .= " m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                }
                $and = true;
            }
            if ($_POST['project_name'] != "") {
                if ($and == true) {
                    $where .= " and p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= " p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                }
                $and = true;
            }
            if (!empty($_POST['plotno'])) {
                if ($and == true) {
                    $where .= " and mp.plotno ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= "mp.plotno='" . $_POST['plotno'] . "'";
                }
                $and == true;
            }
            if ($_POST['plot_detail_address'] != "") {
                if ($and == true) {
                    $where .= " and p.plot_detail_address LIKE '%" . $_POST['plot_detail_address'] . "%'";
                } else {
                    $where .= " p.plot_detail_address LIKE '%" . $_POST['plot_detail_address'] . "%'";
                }
            }
            $connection = Yii::app()->db;
            $sql_member = "SELECT cp.cpstatus,mp.member_id,mp.create_date,mp.plotno,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.project_id,p.plot_size,s.street, j.project_name FROM memberplot mp
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
            $sql1 = "select * from projects where";
            $num_of_projects_counter--;
            while ($num_of_projects_counter > -1) {
                $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                $num_of_projects_counter--;
            }
            $sql_project = $sql1;
            $sql_project = $sql_project . implode(' or', $sql2);
            $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
            $this->render('member_lis', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects));
        } else {
            $this->redirect(array("user/dashboard"));
        }
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

	if(Yii::app()->session['user_array']['per12']=='1')

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

	if(Yii::app()->session['user_array']['per12']=='1')

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
	public function actionPayment_details()

	{
if(isset(Yii::app()->session['user_array']['username']))

			{
		$connection = Yii::app()->db;

		$land  = "SELECT * FROM installpayment	where (fstatus not in ( 'Cancelled','Rejected','Bounce') OR fstatus is null or fstatus='') and plot_id='".$_REQUEST['id']."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		
		   $member= "SELECT * FROM memberplot mp where plot_id='".$_REQUEST['id']."'";
		$members = $connection->createCommand($member)->queryRow();
			

		 $sql_payment="Select * from plotpayment where plot_id='".$_REQUEST['id']."' and (mem_id='".$members['member_id']."' or pobm>0 or payment_type NOT IN ('MS Fee','Transfer Fee'))";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

		

	   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		

		

		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='".$_REQUEST['id']."'";

		$res=$connection->createCommand($sql)->queryAll();

		

		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";

		//$result_charges = $connection->createCommand($sql_charges)->queryAll();

		

		$sql_plotinfo  = "SELECT floors.name as floor_name,buildings.name as building_name,mp.mstatus as stst,p.*,j.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join memberplot mp on mp.plot_id=p.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		left join projects j on p.project_id=j.id
        Left JOIN floors  ON (p.floor_id = floors.id)
        Left JOIN buildings  ON (floors.building_id = buildings.id) 
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
			$connection = Yii::app()->db;
			$sql_primeloc  = "SELECT *  FROM cat_plot
			LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
			WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
			$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
					

	

		$this->render('payment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));
			}else{
				
					$this->redirect(array('user/dashboard'));

				}
		

	}
	public function actionPayment_details123()
		{
if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;

	$land  = "SELECT * FROM installpayment	where fstatus !='Cancelled' and fstatus !='Bounce' and others !='Cancelled' and plot_id='".$_REQUEST['id']."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		
		   $member= "SELECT * FROM memberplot mp where plot_id='".$_REQUEST['id']."'";
		$members = $connection->createCommand($member)->queryRow();
			

		 $sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."' and ((mem_id='".$members['member_id']."') and pobm>0 or payment_type NOT IN ('MS Fee','Transfer Fee'))";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

		

	   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		

		

		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='".$_REQUEST['id']."'";

		$res=$connection->createCommand($sql)->queryAll();

		

		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";

		//$result_charges = $connection->createCommand($sql_charges)->queryAll();

		

		$sql_plotinfo  = "SELECT mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join memberplot mp on mp.plot_id=p.id
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
			$connection = Yii::app()->db;
			$sql_primeloc  = "SELECT *  FROM cat_plot
			LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
			WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
			$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
					

	

		$this->render('payment_details',array('payments'=>$result_payments,'primeloc'=>$result_prime,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));
		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionInstallment_details()
		{if(isset(Yii::app()->session['user_array']['username'])){	
		$connection = Yii::app()->db;
	
			$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."'  and (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='')";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "SELECT floors.name as floor_name,buildings.name as building_name,p.is_property,mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join memberplot mp on mp.plot_id=p.id
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		left join streets st on p.street_id=st.id
		left join projects j on p.project_id=j.id
        Left JOIN floors  ON (p.floor_id = floors.id)
        Left JOIN buildings  ON (floors.building_id = buildings.id) 
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();
		$sql_primeloc  = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$_REQUEST['id']."'" ;
$result_prime = $connection->createCommand($sql_primeloc)->queryAll();
			//$sqlcharges = "Select * from plotpayment where plot_id='" . $_REQUEST['id'] . "' and ( pobm>0 or payment_type IN ('MS Fee','Transfer Fee'))";
			//$result_charges1 = $connection->createCommand($sqlcharges)->queryAll();

	
	

		$this->render('installment_details',array('charges' => $result_charges,'payments'=>$result_payments,'primeloc'=>$result_prime,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionInstallment_edit()
		{
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."'  and (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='') ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			   $sql_member= "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM memberplot where plot_id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();

		

		$this->render('installment_edit',array('payments'=>$result_payments,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		

	}
	public function actionUpdate()
	    {

		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	  /*?>$sql= "SELECT
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
	$result_size = $connection->createCommand($sql_size)->query();<?php */

//	$this->render('update',array('pla'=>$result,'projects'=>$result_project,'size'=>$result_size));
$this->render('update');
	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    }
	public function actionUpdate_charges()
    	{

		if(Yii::app()->session['user_array']['per12']=='1' &&Yii::app()->session['user_array']['per12']=='1'&& isset(Yii::app()->session['user_array']['username']))

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

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per12']=='1'&& isset(Yii::app()->session['user_array']['username']))

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
	public function actionInstallmentup()
		{       $error='';
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
		{        $error='';
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
			
			$newfilename = $_POST['id'];
			$new='';
			if(isset($_FILES["image2"]) && $_FILES["image2"]!==''){
				if(file_exists("images/payment1/$newfilename")==true){
				unlink("images/payment1/$newfilename");}
			$image=$_FILES['image2']["name"];			
		   move_uploaded_file($_FILES["image2"]["tmp_name"],
			'images/payment1/'.$newfilename);
			$new="image2='".$newfilename."',"; 
			
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
	public function actionMemberplot_list()
		{	

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per6']=='1')

			{

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.id,mp.plot_id,mp.create_date,mp.fstatus,mp.plotno,p.status,p.type, p.size2,siz.size,m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on m.id=mp.member_id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id
left join size_cat siz on p.size2=siz.id

left join projects j on s.project_id=j.id where p.type='plot' and mp.status='new'and mp.fstatus='approved' ";

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

		

		$this->render('memberplot_list',array('memberplot_list'=>$memberplot_list,'projects'=>$result_projects));

		}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	}
	/////////////////////////////SEARCH MEMBERPLOT BY APP NO, BY MEM ID, BY STATUS, BY DATE//////////////////
	public function actionMemberplot_search_lis()
		{	

	if(Yii::app()->session['user_array']['per12']=='1')

			{
					$connection = Yii::app()->db; 

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
}
				$and=true;

  $sql_member = "SELECT mp.id,mp.fstatus,mp.member_id,mp.status,mp.fstatus,mp.plot_id,mp.plotno,mp.create_date,p.id,m.username, m.name,siz.size,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id 
left join size_cat siz on p.size2=siz.id

where ".$where." AND p.type='plot' and mp.status='new'and mp.fstatus='approved' ";

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_projects = "SELECT * from projects ";





		$result_projects = $connection->createCommand($sql_projects)->query();



			$this->render('memberplot_list',array('memberplot_list'=>$result_members,'projects'=>$result_projects));

	}

	

	

	}
	public function actionRequested_detail()
	 	{

	if(Yii::app()->session['user_array']['per12']=='1')

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
	////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////REQUEST DETAIL///////////////
	public function actionReq_detail()
		{

	if(Yii::app()->session['user_array']['per12']=='1'&& isset(Yii::app()->session['user_array']['username']))

			{

			$connection = Yii::app()->db; 	
				$sql_details  = "SELECT floors.name as floor_name,buildings.name as building_name,p.is_property,mp.member_id,mp.plot_id,u.firstname,u.middelname,u.lastname,u.cnic,u.email,j.code,c.code as scode,c.size,mp.noi,mp.id as sid,mp.fcomment,p.com_res,mp.create_date,mp.fstatus,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.type ,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name,se.sector_name,sc.name as scname FROM  memberplot mp
		left join members m on mp.member_id=m.id
		left join plots p on mp.plot_id=p.id
		left join streets s on p.street_id=s.id
		left join size_cat c on p.size2=c.id
		left join sectors se on p.sector=se.id
		left join user u on mp.user_name=u.id
		left join sales_center sc on u.sc_id=sc.id
		left join projects j on p.project_id=j.id
        Left JOIN floors  ON (p.floor_id = floors.id)
        Left JOIN buildings  ON (floors.building_id = buildings.id) 
		 where mp.plot_id=".$_REQUEST['plot_id'];
		$result_details = $connection->createCommand($sql_details)->query();
			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['plot_id']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryRow();
			$this->render('req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

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
		$this->redirect(array("plots/plots_lis"));
	
		}
	////////////////////SUBMIT STATUS///////
	public function actionSubmitp()
	{
		
		$connection = Yii::app()->db;
		if(isset($_POST['plot_id'])) 
		{ 
			$plotid=$_POST['plot_id'];
   	    $ms='';
		if(isset($_POST['completems'])){ $ms=$_POST['completems']; 
								if ((isset($_POST['completems']) && empty($_POST['completems']))){
								 $error.="Membership No required. <br>";
								 exit;
								 }
								
								 	
									if(!empty($ms)){ //echo $ms;exit;
									 $q ="SELECT * from memberplot where plotno='".$ms."'";	 
									$result_q = $connection->createCommand($q)->queryRow();
									if (!empty($result_q['plotno'])){
									$error.="Membership # Already Added Try Another. <br>";
									exit;
									}
									}
		

		 $sql="Update memberplot SET status='New', fstatus='',plotno='".$ms."' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		echo '<script>location.href="allotmentsprop_lis";</script>';exit;
								}}
		
	}
	public function actionSubmit()
	{
		$error='';
		$connection = Yii::app()->db;
		$plotid=$_POST['plot_id'];
   	    $ms='';
		$ms=$_POST['procode'].'-'.$_POST['tempms'].'-'.$_POST['sizecode'];
								if ((isset($_POST['tempms']) && empty($_POST['tempms']))){
								 $error.="Membership No required. <br>";
								 exit;
								 }
								
								 	
									if(!empty($ms)){
									$q ="SELECT * from memberplot where plotno='".$ms."'"; 
									$result_q = $connection->createCommand($q)->queryRow();
									if ($result_q['plotno']==$ms){
									$error.="Membership # Already Added Try Another. <br>";
									exit;
									}
									}
		
		if(empty($error)){							
		$sql="Update memberplot SET status='New', fstatus='',plotno='".$ms."' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		echo '<script>location.href="allotments_lis";</script>';exit;
		}
		else{ echo $error;}

		
	}
	public function actionSubmitstatus()
		{
	if($_POST['statusapp']=='Approved')
		{
		$connection = Yii::app()->db;
	 	$memberid=$_POST['member_id'];
		$plotid=$_POST['plot_id'];
   	    $status=$_POST['status'];
		$sql="Update plots SET status='Allotted' where id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		$sql="Update memberplot SET status='Approved',comment='".$_POST['cmnt']."' where plot_id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		
		$this->redirect(array("memberplotsales/allotments_lis"));
		} 
		
		if($_POST['statusapp']=='Rejected')
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



			$this->redirect(array("memberplot/memberplot_list"));

		}

		}
	//////////////////////////////////////////
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
	public function actionAjaxRequest100($building_id,$floor_id,$size,$pro)
		{ 
		$connection = Yii::app()->db;
		       $sql_plot  = "SELECT plots.id,plots.plot_detail_address from plots Left JOIN floors  ON (plots.floor_id = floors.id)
	Left JOIN buildings  ON (floors.building_id = buildings.id)
		    where plots.project_id='".$pro."' and buildings.id='".$building_id."' and plots.floor_id='".$floor_id."' and plots.size2='".$size."' and plots.status='' and plots.is_property='1'";
		$result_plots = $connection->createCommand($sql_plot)->query();
			
		$plot=array();
		foreach($result_plots as $plo){
			$plot[]=$plo;
			}
		
	echo json_encode($plot); exit();
	}
	public function actionAjaxRequest1()
		{	

		$connection = Yii::app()->db;  
if($_POST['pptype']=='C'){$type='Commercial';}else{$type='Residential';}
		  $sql_plot  = "SELECT * from plots where street_id='".$_POST['street']."' and size2='".$_POST['size']."' and com_res='".$type."' and type='".$_POST['pptype1']."' and status=''";
		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

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
	public function actionTransfer_lis()
		{
			if (isset(Yii::app()->session['user_array']['username'])) {
				$name='';
			$sodowo='';
			$cnic='';
			$plotno='';
			$project_name='';
			$plot_detail_address='';
			$where='';
			$and = false;
				if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) && (empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
					$error = "Please Fill Atleast one field";
					$members = "";
					$connection = Yii::app()->db;
					$sql_com_res = "SELECT DISTINCT com_res FROM plots";
					$result_com_res = $connection->createCommand($sql_com_res)->query();
					$temp_projects_array = Yii::app()->session['projects_array'];
					$num_of_projects_counter = count($temp_projects_array);
					$num_of_projects_counter2 = $num_of_projects_counter;
					$sql1 =   "select * from projects where";
					$num_of_projects_counter--;
					while ($num_of_projects_counter > -1) {
						$sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
						$num_of_projects_counter--;
					}
					$sql_project = $sql1;
					$sql_project = $sql_project . implode(' or', $sql2);
					$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
					$this->render('transfer_lis', array('error' => $error, 'members' => $members, 'projects' => $result_projects, 'com_res' => $result_com_res));
					exit;
				}			
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
			
			$this->render('transfer_lis',array('error'=>$error,'projects'=>$result_projects));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionTransferreq()
 		{
		$where='';
	
		$and ='';
			if (isset($_POST['type']) && $_POST['type'] != "") {
				$where .= "p.type ='" . $_POST['type'] . "'";
				$and = true;
				$type = $_POST['type'];
			}
			if (!empty($_POST['name1'])){
				$where.=" m_from.name LIKE '%".strip_tags($_POST['name1'])."%'";
				$and = true;
			}
			if (!empty($_POST['sodowo'])){				
				if ($and==true)
				{
					$where.=" and m_to.name LIKE '%".strip_tags($_POST['sodowo'])."%'";

				}
				else
				{

					$where.=" m_to.name LIKE '%".strip_tags($_POST['sodowo'])."%'";

				}
				$and=true;

			}

			if (!empty($_POST['cnic'])){

				if ($and==true)
				{
					$where.=" and m_from.cnic =".strip_tags($_POST['cnic'])."";
				}
				else
				{
					$where.=" m_from.cnic =".strip_tags($_POST['cnic'])."";
				}
				$and=true;
			}if (!empty($_POST['allotmentstatus'])){
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
					$where.=" and p.plot_detail_address ='".strip_tags($_POST['plot_detail_address'])."'";
				}
				else
				{
					$where.="p.plot_detail_address='".strip_tags($_POST['plot_detail_address'])."'";
				}
				$and==true;
			}
			if (!empty($_POST['stat'])){
				$q='';
				if($_POST['stat']=='1'){$q="tp.status='New Request'";}
				if($_POST['stat']=='2'){$q="tp.status='sales'";}
				if($_POST['stat']=='3'){$q="tp.status='Approved'";}
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
			if (!empty($_POST['plotno'])){

				if ($and==true)
				{
				       
                                       $where.=" and mp.plotno LIKE '%".strip_tags($_POST['plotno'])."%'";
				}
				else
				{
					$where.="mp.plotnoLIKE '%".strip_tags($_POST['plotno'])."%'";
				}
				$and==true;
			}
			
			if(Yii::app()->session['user_array']['per12']==1 && Yii::app()->session['user_array']['per20']==0){
			if ($and==true){
			$where .=' and tp.uid='.Yii::app()->session['user_array']['id'];	
			}else{$where .=' tp.uid='.Yii::app()->session['user_array']['id'];}
			$and=true;
			if (!isset($_POST['stat'])){	
			$where .=" and tp.status!='sales'";	
			}
			}
			
			if(Yii::app()->session['user_array']['per20']==1){
			
			if (!isset($_POST['stat'])){	
			if ($and==true){
			$where .="and tp.status!='Sales'";	
			}else{$where .=" tp.status!='Sales'";}
			$and=true;
			}
			}
			
			if (!empty($_POST['allotmentstatus'])){
if($_POST['allotmentstatus']==1){ $where.=" and mp.status='Approved'";}
if($_POST['allotmentstatus']==2){ $where.=" and mp.status!='Approved' and mp.fstatus!='Approved'";}
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
 $sql_memberas = "SELECT tp.*,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name,mp.plotno,m_from.name from_name,m_to.name to_name,tp.plot_id as tid,m_to.RFM RFM FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN memberplot mp ON mp.plot_id=p.id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN projects pro ON pro.id=p.project_id where $where   ";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		
	$connection = Yii::app()->db; 
     $sql_member = "SELECT tp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,m_from.image as fimage,m_to.image as timage,p.plot_detail_address,tp.id as tid,p.plot_size,pro.project_name, tp.status as tpstatus, mp.plotno,m_from.name from_name,m_to.name to_name,m_to.RFM RFM FROM transferplot tp
			Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN memberplot mp ON mp.plot_id=p.id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id where $where  limit $start,$limit";
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

				echo '<tr><td>'.$key['plotno'].'</td>
				<td><img src="/upload_pic/'.$key['fimage'].'" width="50" height="75" /></td><td>'.$key['from_name'].'</td>
				<td><img src="/upload_pic/'.$key['timage'].'" width="50" height="75" /></td><td>'.$key['to_name'].'</td>
				<td>'.$key['size'].'</td>
				<td>'.$key['plot_detail_address'].'</td>
				<td>'.$key['street'].'</td>
				<td>'.$key['sector_name'].'</td>
				<td>'.$key['project_name'].'</td>
				
				<td>';
				echo '<a href="treq_detail?id='.$key['tid'].'">Request Detail</a>';
				echo '<br><a href="transferdocs?plot_id='.$key['plot_id'].'">Document</a>';
				echo '<br><a href="request_form?id='.$key['tid'].'">Request Form</a>';
				
				if(Yii::app()->session['user_array']['per12']==1){
					if($key['tpstatus']=='Sales'){
				//echo '<a href="treq_detail?id='.$key['tid'].'">Cancel Transfer Request</a>';
					}
				}
				echo '</td></tr>'; 
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
	public function actionsubmitt()
	{         
		$ms='';
	
				$connection = Yii::app()->db; 
				if(isset($_POST['tempms']) && $_POST['tempms']==''){
					echo 'Please Enter New MS # ';exit;
				}
				if(isset($_POST['admin_comment']) && $_POST['admin_comment']==''){
					echo 'Please Enter Comments';exit;
				}
				 $tpaction  = "UPDATE tp_action_history set sc_status='Approved',admin_comment='".$_POST['admin_comment']."',admin_status='Approved',admin_id='".Yii::app()->session['user_array']['id']."',
				admin_date= '".date('Y-m-d H:i:s')."' 	
				WHERE id='".$_POST['achid']."'";		
   			    $command = $connection -> createCommand($tpaction);
                $command -> execute();
                
			    $update  = "UPDATE transferplot set status='New Request',fstatus='' WHERE id='".$_REQUEST['pid']."'";		
   			    $command = $connection -> createCommand($update);
                $command -> execute();
			
				$ms=$_POST['tempms'];				
				$update  = "UPDATE memberplot set tempms='".$ms."',app_no=".$_POST['app_no']." WHERE plot_id='".$_POST['ploid']."'";		
   			   $command = $connection -> createCommand($update);
                $command -> execute();
				echo '<script>location.href="transfer_lis";</script>';

	}
	public function actionInstallment_lis()
		{
		
			if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

			{
	
		
	
			$connection = Yii::app()->db; 
			$temp_projects_array = Yii::app()->session['projects_array'];
			$num_of_projects_counter = count($temp_projects_array);	
			$num_of_projects_counter2 = $num_of_projects_counter;
			$sql_categories  = "SELECT * from categories";
			$categories = $connection->createCommand($sql_categories)->query();
			$sql_pro  = "SELECT * from projects";
		$pro = $connection->createCommand($sql_pro)->query();
			$sql_size  = "SELECT * from size_cat";
			$sizes = $connection->createCommand($sql_size)->query();
			$sql_sector ="SELECT DISTINCT sector FROM plots";
			$result_sector = $connection->createCommand($sql_sector)->query();
				
	
				$this->render('installment_lis',array('sectors'=>$result_sector,'pro'=>$pro,'categories'=>$categories,'sizes'=>$sizes));
			}else{
				$this->redirect(array('user/dashboard'));
				}
				
	
		   
	
		}
	public function actionSearchinstallment()
 		{
		$where='';

		$and=true;
//$where.="installpayment.fstatus='' and paidamount!=''";
		 if (isset($_POST['status']) && $_POST['status']!=""){

				if($_POST['status']=='new'){$where.="installpayment.fstatus='' and paidamount!=''";}
				else if($_POST['status']=='due'){$where.="installpayment.fstatus='' and paidamount=''";}else{
				$where.="installpayment.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
			}
		if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and mp.plotno like '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.=" mp.plotno like '%".$_POST['plotno']."%'";
				}
				$and=true;
			}
			if (isset($_POST['vno']) && $_POST['vno']!=""){
				$plotno=$_POST['vno'];
				if ($and==true)
				{
					  $where.=" and installpayment.detail like '%".$_POST['vno']."%'";
				}
				else
				{
					$where.=" installpayment.detail like '%".$_POST['vno']."%'";
				}
				$and=true;
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
 $sql_memberas = "SELECT mp.plotno,installpayment.payment_type,installpayment.dueamount,installpayment.paidamount,installpayment.due_date,installpayment.paidas,installpayment.detail,installpayment.surcharge,installpayment.paid_date,installpayment.id,installpayment.fstatus,installpayment.lab FROM installpayment 
		left join memberplot mp on(installpayment.plot_id=mp.plot_id)
		where $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end

		$connection = Yii::app()->db; 

		$sql_payment  = "SELECT mp.plotno,installpayment.payment_type,installpayment.dueamount,installpayment.paidamount,installpayment.due_date,installpayment.paidas,installpayment.detail,installpayment.surcharge,installpayment.paid_date,installpayment.id,installpayment.fstatus,installpayment.lab FROM installpayment 
		left join memberplot mp on(installpayment.plot_id=mp.plot_id)
		where $where limit $start,$limit";  
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
            foreach($sql_payments as $row){
		$i++;
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['plotno'] . '</td>
 <td>' . $row['lab'] . '</td>

 <td>' . $row['dueamount'] . '</td>
 <td>' . $row['paidamount'] . '</td>
  <td>' . $row['due_date']. '</td>
  <td>' . $row['payment_type'] . '</td>
  <td>' . $row['detail'] . '</td>
  <td>' . $row['surcharge'] . '</td>
   <td>' . $row['paid_date'] . '</td>
  <td><a class="btn" href="update_installment?id='.$row['id'].'">Update</a>
</td>
</tr>  
';

		 

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
	 exit;

			}else{exit;}
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
	public function actionPayment_lis()
		{
		if((Yii::app()->session['user_array']['per12']=='1')&& isset(Yii::app()->session['user_array']['username']))

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
            $sql_payment  = "SELECT * FROM installpayment where fstatus='' and paidamount!=''";
			$result_payments = $connection->createCommand($sql_payment)->queryAll();
			$installments=count ( $result_payments );
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

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('payment_lis',array('members'=>$result_members,'installment'=>$installments,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));
			}
			else{
				$this->redirect(array('user/dashboard'));
				}
			

	   

	}
	public function action()
    	{
		$where='';

		$and=false;
		  
			//echo $from.$to; exit;
		
		
		 if (isset($_POST['status']) && $_POST['status']!=""){
                $and=true;

				if($_POST['status']=='new'){$where.="plotpayment.fstatus='' and paidamount!=''";}
				else if($_POST['status']=='due'){$where.="plotpayment.fstatus='' and paidamount=''";}else{
				$where.="plotpayment.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
				
			}
				
		if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and memberplot.plotno Like '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.=" memberplot.plotno Like '%".$_POST['plotno']."%'";
				}
				$and=true;

			}
			
			if (isset($_POST['vno']) && $_POST['vno']!=""){
				$plotno=$_POST['vno'];
				if ($and==true)
				{
					  $where.=" and plotpayment.detail Like '%".$_POST['vno']."%'";
				}
				else
				{
					$where.=" plotpayment.detail Like '%".$_POST['vno']."%'";
				}
				$and=true;

			}
			
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				

				$pro=$_POST['project_id'];

				if ($and==true)

				{

					$where.=" and plots.project_id = '".$_POST['project_id']."'";

				}

				else

				{

					$where.=" plots.project_id = '".$_POST['project_id']."'";

				}

				$and=true;

			}

		$connection = Yii::app()->db; 
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
echo $sql_memberas = "SELECT * FROM
    plotpayment
    Left JOIN plots  ON (plots.id = plotpayment.plot_id)
	Left JOIN projects  ON (projects.id = plots.project_id)
	Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
where $where "; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end


		$connection = Yii::app()->db; 
 $sql_payment  = "SELECT plots.plot_detail_address

	, plotpayment.*
    , plots.plot_detail_address
	 , plots.com_res
	 , plots.create_date
	 , projects.project_name
	 ,memberplot.plotno
FROM

    plotpayment

    Left JOIN plots  ON (plots.id = plotpayment.plot_id)
	Left JOIN projects  ON (projects.id = plots.project_id)
	Left JOIN memberplot  ON (memberplot.plot_id = plots.id)
	 where $where  limit $start,$limit";  
 
//		$sql_payment  = "SELECT * FROM plotpayment
	//	 where $where";

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
            foreach($sql_payments as $row){

          
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
		$i++;

		//$due=$due+$row['amount'];
		//$paid=$paid+$row['paidamount'];
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['plotno'] . '</td>

 <td>' . $row['plot_detail_address'] . '</td>
 <td>' . $row['payment_type'] . '</td>
 <td style="text-align:right">'.$row['amount'] . '</td>
 <td style="text-align:right">' . $row['paidamount']. '</td>
  <td >' . $row['duedate']. '</td>
  <td>' . $row['paidas'] . '</td>
  <td>' . $row['detail'] . '</td>
 
   <td>' . $row['date'] . '</td>
  <td><a class="btn" href="update_charges?id='.$row['id'].'">Detail</a></td>
</tr> 


 ';

		 

			} 

			}else{echo exit;}
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

}