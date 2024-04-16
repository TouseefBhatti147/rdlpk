<?php

class MemberplotController extends Controller {
    

    ///////**********START:Change Plot Type//////////
    public function actionChange_type() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $error = '';

            $error = array();

            $connection = Yii::app()->db;

            if ((isset($_POST['type']) && empty($_POST['type']))) {

                $error = "Select Plot Type. <br>";
            }

           
            if (empty($error)) {


                 $sql = "Update plots set type='" .$_POST['type'] . "' where id='" . $_POST['plot_id'] . "'";
                
                $command = $connection->createCommand($sql);
                $command->execute();

                echo'Plot Type Updated Successfully';
            } else {

                echo $error;
            }
        }
    }
    public function actionChange_plot_type() {
        if (Yii::app()->session['user_array']['per2'] == '1' && (Yii::app()->session['user_array']['id']=='85' || Yii::app()->session['user_array']['id']=='1')) {
            $connection = Yii::app()->db;
            $sql_country = "SELECT * from tbl_country";
            $result_country = $connection->createCommand($sql_country)->query();
            $sql_plan = "SELECT * from installment_plan";
            $result_plan = $connection->createCommand($sql_plan)->query();
            $sql_project = "SELECT * from projects";
            $result_projects = $connection->createCommand($sql_project)->query();
            $sql = "SELECT
    plots.id
    , plots.street_id
    , plots.plot_size
    , plots.com_res
	, plots.price
    , plots.type
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
	Left JOIN categories  ON (plots.category_id = categories.id) where  plots.id='" . $_REQUEST['id'] . "'";
            //	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";
            $result = $connection->createCommand($sql)->query();
            $this->render('change_plot_type', array('plot' => $result, 'projects' => $result_projects, 'country' => $result_country, 'plan' => $result_plan));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    ///////**********END:Change Plot Type *******//////////////
    /////Start:MOrtgaged Property Module////////////////
    public function actionRmv_mortg_req() {
        $uid = Yii::app()->session['user_array']['id'];
        $error = '';
        $connection = Yii::app()->db;
        $update = "Delete from mortgaged_plots where plot_id='" . $_POST['plot_id'] . "'";
        $command = $connection->CreateCommand($update);
        $command->execute();
        echo 'Request Removed Successfully';
    }

    public function actionRemove_mortgage_request() {
        if (isset(yii::app()->session['user_array']['username']) && (yii::app()->session['user_array']['per_bcd_mgm'] == 1)) {
            $connection = Yii::app()->db;
            $sql_plots = "SELECT mortg.status,mortg.noc_nec,mortg.remarks,assoc.id as associd,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM mortgaged_plots mortg
										 left join plots p on mortg.plot_id=p.id
										 left join memberplot mp on mp.plot_id=p.id
										 left join members m on mp.member_id=m.id
										 left join associates assoc on mp.id=assoc.msid
										 left join sectors sec on sec.id=p.sector
										 left join size_cat size_cat on size_cat.id=p.size2
										 left join streets s on p.street_id=s.id
										 left join projects j on p.project_id=j.id

					where p.id=" . $_GET['plot_id'] . "";
            $result_plots = $connection->createCommand($sql_plots)->queryAll();

            $this->render('remove_mortgage_request', array('plots' => $result_plots));
        } else {
            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionUpdate_morstatus() {
        $uid = Yii::app()->session['user_array']['id'];
        $error = '';
        $living_type = '';
        if (isset($_POST['staus']) && empty($_POST['staus'])) {
            $error = 'Please Select Status<br>';
        }
        if (isset($_POST['noc_nec']) && empty($_POST['noc_nec'])) {
            $error .= 'Please Select Noc-Nec<br>';
        }


        if (!empty($error)) {
            echo $error;
        } else {
            $connection = Yii::app()->db;

            $update = "Update mortgaged_plots set status='" . $_POST['status'] . "',noc_nec='" . $_POST['noc_nec'] . "' where plot_id='" . $_POST['plot_id'] . "'";
            $command = $connection->CreateCommand($update);
            $command->execute();
            echo 'Status Updated successfully';
        }
    }

    public function actionUpdate_mortg_status() {
        if (isset(yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_plots = "SELECT mortg.status,mortg.noc_nec,mortg.remarks,assoc.id as associd,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM mortgaged_plots mortg
										 left join plots p on mortg.plot_id=p.id
										 left join memberplot mp on mp.plot_id=p.id
										 left join members m on mp.member_id=m.id
										 left join associates assoc on mp.id=assoc.msid
										 left join sectors sec on sec.id=p.sector
										 left join size_cat size_cat on size_cat.id=p.size2
										 left join streets s on p.street_id=s.id
										 left join projects j on p.project_id=j.id

					where p.id=" . $_GET['plot_id'] . "";
            $result_plots = $connection->createCommand($sql_plots)->queryAll();

            $this->render('update_mortg_status', array('plots' => $result_plots));
        } else {
            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionMortgage() {
        if (isset(yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_plots = "SELECT distinct mortg.plot_id, mortg.status,mortg.noc_nec,mortg.remarks,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.address,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM plots p
					left join mortgaged_plots mortg on mortg.plot_id=p.id
					left join memberplot mp on mp.plot_id=p.id
					left join members m on mp.member_id=m.id
					left join sectors sec on sec.id=p.sector
					left join size_cat size_cat on size_cat.id=p.size2
					left join streets s on p.street_id=s.id
					left join plotpayment pp on pp.plot_id=p.id
					left join projects j on p.project_id=j.id
					where p.id=" . $_GET['plot_id'] . "  ORDER BY pp.paid_date_temp DESC";
            $result_plots = $connection->createCommand($sql_plots)->queryAll();

            $this->render('mortgage', array('plots' => $result_plots));
        } else {
            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionMortgaged() {
        $error = '';
        //echo $_POST['remarks'];exit;
        $connection = Yii::app()->db;
        if ((isset($_POST['noc_nec']) && empty($_POST['noc_nec']))) {
            $error .= 'Please Select NOC-NEC </br>';
        }
        if ((isset($_POST['remarks']) && empty($_POST['remarks']))) {
            $error .= 'Please Enter Remarks';
        }
        if (empty($error)) {
            $query = "Select * from mortgaged_plots where plot_id='" . $_POST['plot_id'] . "'";
            $result_q = $connection->createCommand($query)->queryRow();
            /// echo $_POST['plot_id'];exit;
            if (!empty($result_q)) {
                echo $error .= "Plot is Already Added . <br>";
                exit;
            }

            $insert = "INSERT INTO mortgaged_plots(plot_id,status,noc_nec,remarks) Values('" . $_POST['plot_id'] . "','2','" . $_POST['noc_nec'] . "','" . $_POST['remarks'] . "')";
            $commad = $connection->CreateCommand($insert);
            $commad->execute();

            echo 'Mortgaged Successfully';
        } else {
            echo $error;
            exit;
        }
    }

    public function actionMortgaged_list() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_member = "SELECT mp.plot_id,mp.member_id,mp.create_date,mp.plotno,p.id,p.type, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.project_id,p.plot_size,s.street, j.project_name FROM bcd bcd
left join plots p on bcd.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id

left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where mp.status='Approved' ";
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

            $this->render('mortgaged_list', array('members' => $result_members, 'projects' => $result_projects));
        } else {
            $this->redirect(array("user/dashboard"));
        }
    }

    public function actionSearchreqmortg() {
        $where = "";
        $and = true;
        if (!empty($_POST['project_name'])) {
            if ($and == true) {
                $where .= " p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            } else {
                $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            }
            $and = true;
        }
        if (!empty($_POST['name1'])) {
            $where .= " and m.name LIKE '%" . $_POST['name1'] . "%'";
            $and = true;
        }
        if (isset($_POST['com_res']) && $_POST['com_res'] != "") {

            $where .= " and p.com_res LIKE '%" . $_POST['com_res'] . "%'";
            $and = true;
            $com_res = $_POST['com_res'];
        }
        if (isset($_POST['status']) && $_POST['status'] != "") {

            $where .= " and mortg.status=" . $_POST['status'] . "";
            $and = true;
            $status = $_POST['status'];
        }
        if (isset($_POST['noc_nec']) && $_POST['noc_nec'] != "") {

            $where .= " and mortg.noc_nec=" . $_POST['noc_nec'] . "";
            $and = true;
            $noc_nec = $_POST['noc_nec'];
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
        $allotmentstatus = '';
        if (!empty($_POST['plotno'])) {
            if ($and == true) {
                $where .= " and mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
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
        $sql_memberas = "SELECT * FROM mortgaged_plots mortg

left join plots p on mortg.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id
left join associates assoc on mp.id=assoc.msid
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id

where $where";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end
        $connection = Yii::app()->db;
        $sql_member = "SELECT mortg.status,mortg.noc_nec,mortg.remarks,assoc.id as associd,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM mortgaged_plots mortg
left join plots p on mortg.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id
left join associates assoc on mp.id=assoc.msid
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where  $where ORDER BY mp.plotno ASC limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->queryAll();
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
                echo'<tr><td style=" font-weight:bold;color:' . $msco . ';">';
                if (empty($key['plotno'])) {
                    echo 'App-' . $key['app_no'];
                } else {
                    echo $key['plotno'];
                } echo'</td>
			<td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td>
			<td>' . $key['cnic'] . '</td>
			 <td>';
                echo $key['size'] . '&nbsp;(' . $key['plot_size'] . ')';
                echo'</td>
			 <td><strong>';
                if ($key['stst'] == 2) {
                    echo'<span style="color:red">Blocked</span>';
                } else {
                    echo '<a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'];
                }echo'</strong></a></td>
		    	  <td>' . $key['street'] . '/' . $key['sector_name'] . '</td>
				  <td>' . $key['project_name'] . '</td>
				  <td>';
                if ($key['status'] == 1) {
                    echo '<span style="color:green;font-weight:bold;">Mortgaged</span>';
                }if ($key['status'] == 2) {
                    echo '<span style="color:red;font-weight:bold;">Under Process</span>';
                }echo '</td>
				  <td>';
                if ($key['noc_nec'] == 1) {
                    echo '<span style="color:green;font-weight:bold;">Yes</span>';
                }if ($key['noc_nec'] == 2) {
                    echo '<span style="color:red;font-weight:bold;">No</span>';
                }echo'</td>
				  <td>';
                echo $key['remarks'];
                echo'</td>
				 <td> ';
                if (Yii::app()->session['user_array']['per34'] == '1') {
                    echo'<a target="_blank" href="payment_details?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a>';
                } else {
                    echo'<div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';

                    echo'<li role="presentation"><a target="_blank" href="update_mortg_status?plot_id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Mortgage Status</a></li>';
                    echo'<li role="presentation"><a target="_blank" href="remove_mortgage_request?plot_id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Remove Mortgage Request</a></li>';
                }

                echo'
				 </ul></div>';
                echo' </td></tr>';
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
        echo '<tr  ><td colspan="10"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;' . $rows . '</b></td>';
        ?>
        <td><form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

                <input type="hidden" name="paper" value="a4">
                <input type="hidden" name="orientation" value="landscape">
                <textarea style="display:none;" name="html" id="html">

        <link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
        <style>
                        td{
                        }
                        .table-bordered{
                            border:1px solid #000;
                            border-bottom:1px solid #000;
                        }
                        table{
                            border:0px solid;
                        }

                        thead {
                            display: table-header-group;
                        }

                        .page_break {
                            page-break-before: always;
                        }
        </style>
        <table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
            <tr>
              <td style="padding:0 0 0 0; ">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                                                        <?php echo'<img style="height:40px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/logo1.png"/>'; ?>
                          </td>
                          <td colspan="8" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Mortgaged Property Report</span></td>
                          <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
                            </tr>
                            <tr>
                              <td height="10" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                            </tr>
                            
                          </table></td>
                        </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="20" colspan="8" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php echo $key['project_name']; ?></strong></span></td>
                        </tr>
                        <tr>
                          <td height="20" class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                        MS No.
                        </td>
                         <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                       Name
                        </td>
                         <td height="20" class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                        CNIC
                        </td>
                         <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                        Plot Size
                        </td>
                        <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                        Plot No.
                        </td>
                        <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                       Status
                        </td>
                        <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                       NOC-NEC
                        </td>
                      
                         <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                       Remarks
                        </td>
                        </tr>
                        
                        
                        
                                                <?php foreach ($result_members as $key) { ?>
                            <tr>
                              <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                                        <?php if (empty($key['plotno'])) {
                                                            echo 'App-' . $key['app_no'];
                                                        } else {
                                                            echo $key['plotno'];
                                                        } ?>
                            </td>
                             <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                                            <?php echo $key['name']; ?>
                            </td>
                             <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                                            <?php echo $key['cnic']; ?>
                            </td>
                             <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                                            <?php echo $key['size'] . '&nbsp;(' . $key['plot_size'] . ')'; ?>
                            </td>
                            <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                                            <?php echo $key['plot_detail_address']; ?>
                            </td>
                            <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                                            <?php if ($key['status'] == 1) {
                                                                echo '<span style="color:green;font-weight:bold;">Mortgaged</span>';
                                                            }if ($key['status'] == 2) {
                                                                echo '<span style="color:red;font-weight:bold;">Under Process</span>';
                                                            } ?>
                            </td>
                            <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                                    <?php if ($key['noc_nec'] == 1) {
                                                        echo '<span style="color:green;font-weight:bold;">Yes</span>';
                                                    }if ($key['noc_nec'] == 2) {
                                                        echo '<span style="color:red;font-weight:bold;">No</span>';
                                                    } ?>
                            </td>
                              
                             <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                                        <?php echo $key['remarks']; ?>
                            </td>
                            </tr>
                        <?php } ?>
                        
                        
                        
                        
                        
                        
                    </table></td>
                  </tr>
              </table></td>
              </tr>
            
           
          </table>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        						
        						
        						
                </textarea>

                <input type="submit" class="btn-input" name="Add" value="Print PDF" style="float:right;"  />
            </form></td>

        <?php
        echo'</tr>';
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

/////END:Mortgaged Property Module//////////////////




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

    public function actionLocation_charges() {
        $this->render('location_charges');
    }

    /////////////////////////////SART:Documents security module///////////
    /////////////////////////START:ALLOTMENT LETTER (A/L)/////////////
    public function actionReprint_allotment_letter_al() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_pages = $connection->createCommand($sql_page)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_allotment_letter_al', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_allotmentletteral() {
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;
            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['allotment_letter_al'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set allotment_letter_al='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();
            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    //////////////////////////////END::ALLOTMENT LETTER (A/L)/////////////////////
    /////////////////////////START:TRANSFER SLIP/////////////
    public function actionReprint_balloting_detail() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_pages = $connection->createCommand($sql_page)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_balloting_detail', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_ballotingdetail() {
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;
            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['balloting_detail'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set balloting_detail='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();
            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    //////////////////////////////END:TRANSFER SLIP/////////////////////
    /////////////////////////START:TRANSFER SLIP/////////////
    public function actionReprint_transfer_slip() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_pages = $connection->createCommand($sql_page)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_transfer_slip', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_transferslip() {
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;
            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['transfer_slip'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set transfer_slip='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();
            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    //////////////////////////////END:TRANSFER SLIP/////////////////////
    /////////////////////////START:TRANSFER LETTER/////////////
    public function actionReprint_transfer_letter() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";

            $result_pages = $connection->createCommand($sql_page)->queryAll();

            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_transfer_letter', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_transferletter() {
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;

            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['transfer_letter'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set transfer_letter='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();

            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    //////////////////////////////END:TRANSFER LETTER/////////////////////
    /////////////////////////START:NDC LETTER/////////////
    public function actionReprint_ndc_letter() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";

            $result_pages = $connection->createCommand($sql_page)->queryAll();

            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_ndc_letter', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_ndcletter() {
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;

            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['ndc_letter'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set ndc_letter='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();

            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    //////////////////////////////END:NDC LETTER/////////////////////
    /////////////////////////START:ALLOTMENT LETTER/////////////
    public function actionReprint_allotment_letter() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";

            $result_pages = $connection->createCommand($sql_page)->queryAll();

            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_allotment_letter', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_allotmentletter() {
        ///echo $_POST['plot_id'];exit;
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;

            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['allotment_letter'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set allotment_letter='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();

            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    //////////////////////////////END:ALLOTMENT LETTER/////////////////////
    /////////////////////////START:ALLOTMENT CERTIFICATE/////////////
    public function actionReprint_allotment_certificate() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";

            $result_pages = $connection->createCommand($sql_page)->queryAll();

            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_allotment_certificate', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_allotmentcertificate() {
        ///echo $_POST['plot_id'];exit;
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;

            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['allotment_certificate'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set allotment_certificate='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();

            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    //////////////////////////////END:ALLOTMENT CERTIFICATE/////////////////////
    /////////////////////////START:MS LETTER///////////////////////////
    public function actionReprint_ms_letter() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['plot_id'] . "'";
            $result_projects = $connection->createCommand($sql_projects)->query();
            $sql_page = "SELECT mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.plot_id ='" . $_REQUEST['plot_id'] . "'";

            $result_pages = $connection->createCommand($sql_page)->queryAll();
            $sql_history = "SELECT ph.msno, ph.transfer_date,m.name,m.sodowo,m.cnic, m.address,ph.transferfrom_id,p.id,ph.plot_id,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name 
FROM plothistory ph
left join members m on ph.transferfrom_id=m.id
left join plots p on ph.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE ph.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_history = $connection->createCommand($sql_history)->queryAll();

            $sql_reallocate = "SELECT p.id,mp.plotno,p.create_date,mp.plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM reallocation_history p
left join memberplot mp on p.id=mp.plot_id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id 
WHERE p.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_reallocate = $connection->createCommand($sql_reallocate)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['plot_id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();
            $this->render('reprint_ms_letter', array('projects' => $result_projects, 'primeloc' => $result_prime, 'pages' => $result_pages, 'history' => $result_history, 'reallocate' => $result_reallocate));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionReprint_msletter() {
        ///echo $_POST['plot_id'];exit;
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['user_id']) &&
                empty($_POST['user_id'])) || (isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;

            $sql = "INSERT INTO `reprint_requests`(`plot_id`, `remarks`, `request_date`, `user_id`, `type`, `status`) 
	VALUES ('" . $_POST['plot_id'] . "','" . $_POST['remarks'] . "','" . date('Y-m-d') . "','" . Yii::app()->session['user_array']['id'] . "','" . $_POST['ms_letter'] . "','0')";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE memberplot set ms_letter='2' WHERE plot_id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();

            echo "Request Sent Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    /////////////////////////END:MS LETTER///////////////////////////
    /////////////////////////START:DOCS LIST///////////////////////////
    public function actionReprint_list() {
        if ((Yii::app()->session['user_array']['per9'] == '1') && isset(Yii::app()->session['user_array']['username'])) {
            $plotno = '';
            $st = '';
            $pro = '';
            $sector = '';
            $size = '';
            $cat = '';
            $where = '';
            $and = false;
            $where = '';
            $from = date('d-m-Y');
            $to = date('d-m-Y');
            if (isset($_POST['status']) && $_POST['status'] != "") {
                if ($_POST['status'] == 'New') {
                    $where .= "mp.fstatus='approved'";
                } else {
                    $where .= "mp.fstatus LIKE '%" . $_POST['status'] . "%'";
                }
                $and = true;
            }
            if (($from != "") && ($to != "")) {
                if ($and == true) {
                    $where .= "and mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
                } else {
                    $where .= "mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
                }
                $and = true;
            }
            if (isset($_POST['plotno']) && $_POST['plotno'] != "") {
                $plotno = $_POST['plotno'];
                if ($and == true) {
                    $where .= " and p.plot_detail_address ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= " p.plot_detail_address ='" . $_POST['plotno'] . "'";
                }
                $and = true;
            }
            if (isset($_POST['project_id']) && $_POST['project_id'] != "") {
                if ($and == true) {
                    $where .= " and p.project_id ='" . $_POST['project_id'] . "'";
                } else {
                    $where .= " p.project_id = '" . $_POST['project_id'] . "'";
                }
                $and = true;
            }
            $connection = Yii::app()->db;
            $sql_member = "SELECT  mp.member_id,mp.plotno,mp.create_date,mp.id as mp_id,p.type,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address as pda,mp.plot_id,mp.status,p.plot_size,s.street,j.project_name FROM property mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where $where and mp.status='New' and fcomment !=''";
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
            $temp_projects_array = Yii::app()->session['projects_array'];
            $num_of_projects_counter = count($temp_projects_array);
            $num_of_projects_counter2 = $num_of_projects_counter;
            $sql_categories = "SELECT * from categories";
            $categories = $connection->createCommand($sql_categories)->query();
            $sql_size = "SELECT * from size_cat";
            $sizes = $connection->createCommand($sql_size)->query();
            $sql_sector = "SELECT DISTINCT sector FROM plots";
            $result_sector = $connection->createCommand($sql_sector)->query();
            $home = Yii::app()->request->baseUrl;
            if (isset($_POST['search'])) {
                $res = array();
                foreach ($result_members as $key) {
                    echo '<tr><td>' . $key['plotno'] . '</td><td>' . $key['project_name'] . '</td><td>' . $key['street'] . '</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['id'] . '">' . $key['plot_detail_address'] . '</a></td><td>' . $key['plot_size'] . '</td><td>' . $key['size2'] . '</td><td>' . $key['com_res'] . '</td><td>' . $key['sector'] . '</td><td>' . $key['rstatus'] . '</td><td>';
                    if ($key['status'] == '') {
                        echo'<a href="' . $home . '/index.php/memberplot/allotplot?id=' . $key['id'] . '">' . "Allot" . '</a>';
                    } else {
                        echo $key['status'];
                    }echo '</td>
			<td><a href="reallocate?id=' . $key['id'] . '">Reallocate</a></td><td><a href="updateplot?id=' . $key['id'] . '">Edit</a>/<a href="deleteplot?id=' . $key['mp_id'] . '">Delete</a></td></tr>';
                }
            }
            $this->render('reprint_list', array('members' => $result_members, 'sectors' => $result_sector, 'pro' => $result_projects, 'st' => $st, 'sector' => $sector, 'plotno' => $plotno, 'categories' => $categories, 'sizes' => $sizes));
        } else {
            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionReprint_req() {

        $where = '';
        $and = false;
        $from = $_POST['fromdate'];
        $to = $_POST['todate'];
        if (isset($_POST['type']) && $_POST['type'] != "") {
            /* if($_POST['type']=='ms_letter')
              {
              $where.="mp.ms_letter='2'";
              }
              elseif($_POST['type']=='allotment_certificate')
              {
              $where.="mp.allotment_certificate='2'";
              }
              elseif($_POST['type']=='allotment_letter')
              {
              $where.="mp.allotment_letter='2'";
              }
              elseif($_POST['type']=='ndc_letter')
              {
              $where.="mp.ndc_letter='2'";
              }
              elseif($_POST['type']=='transfer_letter')
              {
              $where.="mp.transfer_letter='2'";
              }
              elseif($_POST['type']=='transfer_slip')
              {
              $where.="mp.transfer_slip='2'";
              }
              elseif($_POST['type']=='balloting_detail')
              {
              $where.="mp.balloting_detail='2'";
              } */
            $where .= "rr.type='" . $_POST['type'] . "'";
            $and = true;
        }
        if (($_POST['fromdate'] != "") && ($_POST['todate'] != "")) {
            if ($and == true) {
                $where .= "and mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
            } else {
                $where .= "mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
            }
            $and = true;
        }
        if (isset($_POST['plotno']) && $_POST['plotno'] != "") {
            $plotno = $_POST['plotno'];
            if ($and == true) {
                $where .= " and p.plot_detail_address ='" . $_POST['plotno'] . "'";
            } else {
                $where .= " p.plot_detail_address ='" . $_POST['plotno'] . "'";
            }
            $and = true;
        }
        if (isset($_POST['project_id']) && $_POST['project_id'] != "") {
            if ($and == true) {
                $where .= " and p.project_id ='" . $_POST['project_id'] . "'";
            } else {
                $where .= " p.project_id = '" . $_POST['project_id'] . "'";
            }
            $and = true;
        }
        $connection = Yii::app()->db;
        $sql_payment = "SELECT rr.type as dtype,rr.remarks,mp.ms_letter, mp.plot_id as plotid,floors.name as floor_name,buildings.name as building_name,mp.member_id,mp.plotno,mp.create_date,p.id,p.is_property,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.app_no,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,j.id,j.project_name,size_cat.size FROM reprint_requests rr
left join memberplot mp on mp.plot_id=rr.plot_id
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join size_cat size_cat on size_cat.id=p.size2
left join projects j on p.project_id=j.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id)
where $where and rr.status='0'";
        $result_payments = $connection->createCommand($sql_payment)->queryAll();
        $sql_project = "SELECT * from projects";
        $result_project = $connection->createCommand($sql_project)->query();
        $sql_categories = "SELECT * from categories";
        $categories = $connection->createCommand($sql_categories)->query();
        $sql_sector = "SELECT DISTINCT sector FROM plots";
        $result_sector = $connection->createCommand($sql_sector)->query();
        $sql_payments = $connection->createCommand($sql_payment)->query();
        $sql_size = "SELECT * from size_cat";
        $sizes = $connection->createCommand($sql_size)->query();
        $count = 0;
        if ($sql_payments != '') {
            $home = Yii::app()->request->baseUrl;
            $res = array();
//$i=0;
            foreach ($sql_payments as $key) {
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
                ///$ID=$key['mp_id'];
                //$due=$due+$row['amount'];
                //$paid=$paid+$row['paidamount'];
                echo '<tr><td>' . $key['plotno'] . '</td><td>' . $key['name'] . '</td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td>' . $key['plot_detail_address'] . '<td>' . $key['plot_size'] . '</td><td>';
                if ($key['dtype'] == 'ms_letter') {
                    echo'MS Letter';
                } elseif ($key['dtype'] == 'allotment_letter') {
                    echo'Allotment Letter';
                } elseif ($key['dtype'] == 'allotment_certificate') {
                    echo'Allotment Certificate';
                } elseif ($key['dtype'] == 'ndc_letter') {
                    echo'NDC';
                } elseif ($key['dtype'] == 'transfer_letter') {
                    echo'Transfer Letter';
                } elseif ($key['dtype'] == 'transfer_slip') {
                    echo'Transfer Slip';
                } elseif ($key['dtype'] == 'balloting_detail') {
                    echo'Balloting Detail Letter';
                }

                echo '</td><td>' . $key['remarks'] . '</td><td>' . $key['project_name'] . '</td><td><a target="_blank" href="prop_req_detail?plot_id=' . $key['plotid'] . '">Detail</a>
  </td></tr>';
            }
        } else {
            echo exit;
        }
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

    /////////////////////////END:DOCS LIST///////////////////////////
    /////////////////////////////END:Documents security module/////////////////
    /////////////////////////////START: Property Module///////////////////
    public function actionMember_prop_lis() {
        if ((Yii::app()->session['user_array']['per2'] == '1') && isset(Yii::app()->session['user_array']['username']) || (Yii::app()->session['user_array']['per34'] == '1')) {

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
			<td>' . $key['project_name'] . '</td><td>';
                    if (Yii::app()->session['user_array']['per34'] == '1') {
                        echo'<a target="_blank" href="prop_payment_details?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a>';
                    } else {
                        echo'<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			Dropdown
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation"><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a></li>';
                        if ((Yii::app()->session['user_array']['per32'] == '1')) {
                            echo'<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/member/ms_status?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Update Status</a></li>';
                        }
                        if (Yii::app()->session['user_array']['per33'] == '1') {
                            if ($key['cpstatus'] == 'New') {
                                echo'<li role="presentation"><span style="color:red">Cancellation Requested</span></li>';
                            } else {
                                echo'<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/memberplot/cancelplot?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Cancellation</a></li>';
                            }
                        }
                        echo'<li role="presentation"><a target="_blank" href="prop_payment_details?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a></li>
				<li role="presentation"><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a></li>
				<li role="presentation"><a target="_blank" href="reallocate?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Reallocation</a></li>
				';
                        if (Yii::app()->session['user_array']['id'] == '1') {
                            echo '<li role="presentation"><a target="_blank" href="deallocate?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Deallocation</a></li>';
                        }
                        $sqltest = "SELECT * FROM  plots where id='" . $key['plot_id'] . "'  ";

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
                        foreach ($resulttest as $test) {


                            if ($test['status'] == 'Requested(T)') {
                                echo '<li role="presentation"><a  href="' . $home . '/index.php/memberplot/treq_detail?id=' . $key['plot_id'] . '">Transfer Details</a></li>';
                            }
                            if ($test['status'] != 'Requested(T)' && $key['status'] == 'Approved') {
                                echo '<li role="presentation"><a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '"> Transfer Plot</a></li>';
                            }
                        }
                        echo'
				
				<li role="presentation"><a href="amembers?mid=' . $key['msid'] . '">Associates Member</a></li>
				<li role="presentation"><a href="updatemember_plot?id=' . $key['plot_id'] . '">Update Membership</a></li>
			</ul></div>';
                    }
                    echo' </td></tr>';
                }
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

    public function actionPro_installment_details() {

        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_payment = "SELECT * FROM installpayment where plot_id='" . $_REQUEST['id'] . "' and (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='') and others !='Cancelled' ";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();
            $sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
left join members m on mp.member_id=m.id
where plot_id='" . $_REQUEST['id'] . "'";
            $result_members = $connection->createCommand($sql_member)->queryAll();
            $sql_charges = "SELECT * FROM plotcharges where plot_id='" . $_REQUEST['id'] . "'";
            $result_charges = $connection->createCommand($sql_charges)->queryAll();
//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
            $sql_plotinfo = "SELECT buildings.name as building_name,floors.name as floor_name,mp.mstatus as stst,p.*,proj.project_name,s.size FROM plots p
left join projects proj on p.project_id=proj.id
left join memberplot mp on mp.plot_id=p.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id)
left join size_cat s on p.size2=s.id
where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

            $sql_minfo = "SELECT * FROM memberplot where plot_id='" . $_REQUEST['id'] . "'";
            $result_minfo = $connection->createCommand($sql_minfo)->queryAll();
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('pro_installment_details', array('payments' => $result_payments, 'primeloc' => $result_prime, 'charges' => $result_charges, 'info' => $result_plotinfo, 'minfo' => $result_minfo, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionProp_alotment_lis() {
        if ((Yii::app()->session['user_array']['per9'] == '1') && isset(Yii::app()->session['user_array']['username'])) {
            $plotno = '';
            $st = '';
            $pro = '';
            $sector = '';
            $size = '';
            $cat = '';
            $where = '';
            $and = false;
            $where = '';
            $from = date('d-m-Y');
            $to = date('d-m-Y');
            if (isset($_POST['status']) && $_POST['status'] != "") {
                if ($_POST['status'] == 'New') {
                    $where .= "mp.fstatus='approved'";
                } else {
                    $where .= "mp.fstatus LIKE '%" . $_POST['status'] . "%'";
                }
                $and = true;
            }
            if (($from != "") && ($to != "")) {
                if ($and == true) {
                    $where .= "and mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
                } else {
                    $where .= "mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
                }
                $and = true;
            }
            if (isset($_POST['plotno']) && $_POST['plotno'] != "") {
                $plotno = $_POST['plotno'];
                if ($and == true) {
                    $where .= " and p.plot_detail_address ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= " p.plot_detail_address ='" . $_POST['plotno'] . "'";
                }
                $and = true;
            }
            if (isset($_POST['project_id']) && $_POST['project_id'] != "") {
                if ($and == true) {
                    $where .= " and p.project_id ='" . $_POST['project_id'] . "'";
                } else {
                    $where .= " p.project_id = '" . $_POST['project_id'] . "'";
                }
                $and = true;
            }
            $connection = Yii::app()->db;
            $sql_member = "SELECT  mp.member_id,mp.plotno,mp.create_date,mp.id as mp_id,p.type,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address as pda,mp.plot_id,p.status,p.plot_size,s.street,j.project_name FROM property mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where $where and mp.status='New' and fcomment !=''";
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
            $temp_projects_array = Yii::app()->session['projects_array'];
            $num_of_projects_counter = count($temp_projects_array);
            $num_of_projects_counter2 = $num_of_projects_counter;
            $sql_categories = "SELECT * from categories";
            $categories = $connection->createCommand($sql_categories)->query();
            $sql_size = "SELECT * from size_cat";
            $sizes = $connection->createCommand($sql_size)->query();
            $sql_sector = "SELECT DISTINCT sector FROM plots";
            $result_sector = $connection->createCommand($sql_sector)->query();
            $home = Yii::app()->request->baseUrl;
            if (isset($_POST['search'])) {
                $res = array();
                foreach ($result_members as $key) {
                    echo '<tr><td>' . $key['plotno'] . '</td><td>' . $key['project_name'] . '</td><td>' . $key['street'] . '</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['id'] . '">' . $key['plot_detail_address'] . '</a></td><td>' . $key['plot_size'] . '</td><td>' . $key['size2'] . '</td><td>' . $key['com_res'] . '</td><td>' . $key['sector'] . '</td><td>' . $key['rstatus'] . '</td><td>';
                    if ($key['status'] == '') {
                        echo'<a href="' . $home . '/index.php/memberplot/allotplot?id=' . $key['id'] . '">' . "Allot" . '</a>';
                    } else {
                        echo $key['status'];
                    }echo '</td>
			<td><a href="reallocate?id=' . $key['id'] . '">Reallocate</a></td><td><a href="updateplot?id=' . $key['id'] . '">Edit</a>/<a href="deleteplot?id=' . $key['mp_id'] . '">Delete</a></td></tr>';
                }
            }
            $this->render('prop_alotment_lis', array('members' => $result_members, 'sectors' => $result_sector, 'pro' => $result_projects, 'st' => $st, 'sector' => $sector, 'plotno' => $plotno, 'categories' => $categories, 'sizes' => $sizes));
        } else {
            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionPropalotmentreq() {
        $where = '';
        $and = false;
        $from = $_POST['fromdate'];
        $to = $_POST['todate'];
        if (isset($_POST['status']) && $_POST['status'] != "") {
            if ($_POST['status'] == 'New') {
                $where .= "mp.fstatus='approved'";
            } else {
                $where .= "mp.fstatus LIKE '%" . $_POST['status'] . "%'";
            }
            $and = true;
        }
        if (($_POST['fromdate'] != "") && ($_POST['todate'] != "")) {
            if ($and == true) {
                $where .= "and mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
            } else {
                $where .= "mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
            }
            $and = true;
        }
        if (isset($_POST['plotno']) && $_POST['plotno'] != "") {
            $plotno = $_POST['plotno'];
            if ($and == true) {
                $where .= " and p.plot_detail_address ='" . $_POST['plotno'] . "'";
            } else {
                $where .= " p.plot_detail_address ='" . $_POST['plotno'] . "'";
            }
            $and = true;
        }
        if (isset($_POST['project_id']) && $_POST['project_id'] != "") {
            if ($and == true) {
                $where .= " and p.project_id ='" . $_POST['project_id'] . "'";
            } else {
                $where .= " p.project_id = '" . $_POST['project_id'] . "'";
            }
            $and = true;
        }
        $connection = Yii::app()->db;
        echo $sql_payment = "SELECT mp.plot_id as plotid,floors.name as floor_name,buildings.name as building_name,mp.member_id,mp.plotno,mp.create_date,p.id,p.is_property,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.app_no,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,j.id,j.project_name,size_cat.size FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join size_cat size_cat on size_cat.id=p.size2
left join projects j on p.project_id=j.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id)
where $where and mp.status='New' and p.is_property=1  and fcomment !=''";
        $result_payments = $connection->createCommand($sql_payment)->queryAll();
        $sql_project = "SELECT * from projects";
        $result_project = $connection->createCommand($sql_project)->query();
        $sql_categories = "SELECT * from categories";
        $categories = $connection->createCommand($sql_categories)->query();
        $sql_sector = "SELECT DISTINCT sector FROM plots";
        $result_sector = $connection->createCommand($sql_sector)->query();
        $sql_payments = $connection->createCommand($sql_payment)->query();
        $sql_size = "SELECT * from size_cat";
        $sizes = $connection->createCommand($sql_size)->query();
        $count = 0;
        if ($sql_payments != '') {
            $home = Yii::app()->request->baseUrl;
            $res = array();
//$i=0;
            foreach ($sql_payments as $key) {
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
                ///$ID=$key['mp_id'];
                //$due=$due+$row['amount'];
                //$paid=$paid+$row['paidamount'];
                echo '<tr><td>' . $key['plotno'] . '</td><td>' . $key['name'] . '</td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td>' . $key['plot_detail_address'] . '<td>' . $key['plot_size'] . '</td><td>' . $key['building_name'] . '</td><td>' . $key['floor_name'] . '</td><td>' . $key['project_name'] . '</td><td><a target="_blank" href="prop_req_detail?plot_id=' . $key['plotid'] . '">Detail</a>
  </td></tr>';
            }
        } else {
            echo exit;
        }
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

    public function actionProp_req_detail() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $connection = Yii::app()->db;
            $sql_details = "SELECT buildings.name as building_name,floors.name as floor_name,mp.member_id,sec.sector_name, u.firstname,u.middelname,u.lastname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.fcomment,mp.create_date,mp.fstatus,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.atype,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
	left join members m on mp.member_id=m.id
	left join plots p on mp.plot_id=p.id
	left join streets s on p.street_id=s.id
	left join size_cat c on p.size2=c.id
	left join sectors sec on p.sector=sec.id
	left join user u on mp.user_name=u.id
	left join projects j on p.project_id=j.id 
	Left JOIN floors  ON (p.floor_id = floors.id)
	Left JOIN buildings  ON (buildings.id = floors.building_id)
	where mp.plot_id=" . $_REQUEST['plot_id'];
            $result_details = $connection->createCommand($sql_details)->query();

            $sql_payment = "SELECT * from plotpayment where plot_id='" . $_REQUEST['plot_id'] . "'";
            $result_payments = $connection->createCommand($sql_payment)->queryRow();
            $this->render('prop_req_detail', array('plotdetails' => $result_details, 'plotpayments' => $result_payments));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionProp_payment_details() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $land = "SELECT * FROM installpayment	where plot_id='" . $_REQUEST['id'] . "' ";
            $land_cost = $connection->createCommand($land)->queryAll();

            $member = "SELECT * FROM memberplot mp where plot_id='" . $_REQUEST['id'] . "'";
            $members = $connection->createCommand($member)->queryRow();
            $sql_payment = "Select * from plotpayment where plot_id='" . $_REQUEST['id'] . "' and (mem_id='" . $members['member_id'] . "' or pobm !='' or payment_type NOT IN ('MS Fee','Transfer Fee')) ";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
left join members m on mp.member_id=m.id
where plot_id = '" . $_REQUEST['id'] . "'";
            $result_members = $connection->createCommand($sql_member)->queryAll();
            $sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc
left join charges c on pc.charges_id=c.id
where plot_id='" . $_REQUEST['id'] . "'";
            $res = $connection->createCommand($sql)->queryAll();

            $sql_plotinfo = "SELECT buildings.name as building_name,floors.name as floor_name,mp.mstatus as stst,p.*,proj.project_name,s.size FROM plots p
left join projects proj on p.project_id=proj.id
left join memberplot mp on mp.plot_id=p.id
left join size_cat s on p.size2=s.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (buildings.id = floors.building_id)
where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('prop_payment_details', array('payments' => $result_payments, 'primeloc' => $result_prime, 'landcost' => $land_cost, 'info' => $result_plotinfo, 'receivable' => $res, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionInstallmenttttt_details() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_payment = "SELECT * FROM installpayment where plot_id='" . $_REQUEST['id'] . "' ";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();
            $sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	left join members m on mp.member_id=m.id
	where plot_id='" . $_REQUEST['id'] . "'";
            $result_members = $connection->createCommand($sql_member)->queryAll();
            $sql_charges = "SELECT * FROM plotcharges where plot_id='" . $_REQUEST['id'] . "'";
            $result_charges = $connection->createCommand($sql_charges)->queryAll();
            //	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
            $sql_plotinfo = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

            $sql_minfo = "SELECT * FROM memberplot where plot_id='" . $_REQUEST['id'] . "'";
            $result_minfo = $connection->createCommand($sql_minfo)->queryAll();
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('installment_details', array('payments' => $result_payments, 'primeloc' => $result_prime, 'charges' => $result_charges, 'info' => $result_plotinfo, 'minfo' => $result_minfo, 'members' => $result_members));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionProp_submitstatus() {
        $connection = Yii::app()->db;
        //$memberid=$_POST['member_id'];
        $plotid = $_POST['plot_id'];
        if ($_POST['statusapp'] == 'Rejected') {
            echo 'Rejected';
            exit;
            $sqlup = "Update property SET status='',member_id='',plotno='' where id='" . $plotid . "'";
            $command = $connection->createCommand($sqlup);
            $command->execute();
            $sql2 = "DELETE FROM  proinstallpayment where id='" . $plotid . "'";
            $command = $connection->createCommand($sql2);
            $command->execute();
            $this->redirect(array("finance/prop_alotment_lis"));
        }
        if ($_POST['statusapp'] == 'approved') {

            $sql = "Update property SET fstatus='" . $_POST['statusapp'] . "',status='approved', fcomment='" . $_POST['cmnt'] . "' where id='" . $plotid . "'";
            //$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";
            $command = $connection->createCommand($sql);
            $command->execute();
            $this->redirect(array("finance/prop_alotment_lis"));
        }
        if ($_POST['statusapp'] == 'Pending') {
            echo 'Pending';
            exit;
            $sql = "Update property SET fstatus='" . $_POST['statusapp'] . "', fcomment='" . $_POST['cmnt'] . "' where id='" . $plotid . "'";
            //$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";
            $command = $connection->createCommand($sql);
            $command->execute();
            $this->redirect(array("memberplot/prop_alotment_lis"));
        }
    }

    //////////////////////////END: PROPERTY MODULE////////////////////////////
    /////********Start:Function For De allocate****////
    public function actionDeallocate() {
        if (Yii::app()->session['user_array']['per1'] == '1') {
            $connection = Yii::app()->db;
            $sql_plots = "SELECT
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
,memberplot.id as msid
, projects.project_name
, categories.name
, streets.street
, plots.project_id
, sectors.sector_name
, size_cat.size
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
Left JOIN projects  ON (plots.project_id = projects.id)
Left JOIN sectors  ON (plots.sector = sectors.id)
Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
Left JOIN categories  ON (plots.category_id = categories.id)
Left JOIN size_cat  ON (plots.size2 = size_cat.id)
where plots.id='" . $_REQUEST['id'] . "'";
            $result_plots = $connection->createCommand($sql_plots)->query();
            $sql = "SELECT * from projects";
            $result = $connection->createCommand($sql)->query();
            $this->render('deallocate', array('plots' => $result_plots, 'projects' => $result));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionDeallocation() {
        $error = '';
        $connection = Yii::app()->db;
        if (isset($_POST['street_id']) && empty($_POST['street_id'])) {
            $error .= 'Please Select Plot Details<br>';
        }
        if (empty($error)) {
            //echo $_POST['plot_detail_address'];exit;  
            $no1 = 0;
            $no2 = 0;
            $connection = Yii::app()->db;
            $sql_plot = "SELECT max(plot_detail_address) as max from plots where street_id='" . $_POST['street_id1'] . "' and project_id='" . $_POST['project_id'] . "' and size2='" . $_POST['size'] . "' and 
		sector='" . $_POST['sector1'] . "' and type='file'";
            $result_plots = $connection->createCommand($sql_plot)->queryRow();

            if ($result_plots['max'] == '') {
                $pn = '001';
            } else {
                $no1 = substr($result_plots['max'], 2);
                $no2 = substr($no1, 0, 3);
                $pn = ($no2 + 1);
            } $pid = "SELECT * from plots where id='" . $_POST['plot_detail_address'] . "'";
            $respid = $connection->createCommand($pid)->queryRow();

            $projectq = "SELECT * from projects where id='" . $_POST['project_id'] . "'";
            $projectr = $connection->createCommand($projectq)->queryRow();
            $sizeq = "SELECT * from size_cat where id='" . $_POST['size'] . "'";
            $sizer = $connection->createCommand($sizeq)->queryRow();
            $typecode = '';
            if ($_POST['com_res'] == 'Commercial') {
                $typecode = 'C';
            } else {
                $typecode = 'R';
            }
            $pn1 = 'F' . '-' . $pn . '-' . $typecode . $sizer['code'];

            $sql_plot1 = "SELECT * from plots where id='" . $_POST['plot_id'] . "'";
            $result_plots1 = $connection->createCommand($sql_plot1)->queryRow();

            $sql = 'INSERT INTO plots
						(type,project_id,street_id, plot_detail_address, plot_size, size2,price,create_date, com_res,sector,cstatus,bstatus)
							VALUES ( "' . $result_plots1['type'] . '","' . $result_plots1['project_id'] . '", "' . $result_plots1['street_id'] . '", "' . $result_plots1['plot_detail_address'] . '", "' . $result_plots1['plot_size'] . '", "' . $result_plots1['size2'] . '", "' . $result_plots1['price'] . '", "' . $result_plots1['create_date'] . '" ,"' . $result_plots1['com_res'] . '","' . $result_plots1['sector'] . '"
						,"' . $result_plots1['cstatus'] . '","open")';
            $command = $connection->createCommand($sql);
            $command->execute();

            echo $insert_id = Yii::app()->db->getLastInsertID();
            $sqp = "Update plots SET type='file',plot_detail_address='" . $respid['plot_detail_address'] . "',sector='" . $_POST['sector'] . "',street_id='" . $_POST['street_id'] . "' where id=" . $_POST['plot_id'] . "";
            $command = $connection->createCommand($sqp);
            $command->execute();
            $sqd = "DELETE FROM `plots` where id=" . $respid['id'] . "";
            $command = $connection->createCommand($sqd);
            $command->execute();

            echo "Plot Deallocated Successfully";
            ;
        } else {
            echo $error;
        }
    }

/////*********END: Function for De Alocate ****//// 
//////////////////////START: CANCELLATION MODULE////////////////////
    public function actionPayment_detailsc() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $land = "SELECT * FROM installpayment	where (fstatus in ('Cancelled')) and plot_id='" . $_REQUEST['id'] . "' ";
            $land_cost = $connection->createCommand($land)->queryAll();
            $member = "SELECT * FROM memberplot mp where plot_id='" . $_REQUEST['id'] . "'";
            $members = $connection->createCommand($member)->queryRow();
            $sql_payment = "SELECT * FROM plotpayment where plot_id='" . $_REQUEST['id'] . "' and (mem_id='" . $members['member_id'] . "' or payment_type NOT IN ('MS Fee','Transfer Fee'))";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $sql_member = "SELECT cp.plot_id, cph.msno, cp.member_id,m.cnic,m.image,m.name FROM cancelplot cp
			 		   left join members m on cp.member_id=m.id
			 LEFT JOIN cancelplothistory cph ON cp.plot_id = cph.plot_id
			 WHERE cp.plot_id='" . $_REQUEST['id'] . "'";

            $result_members = $connection->createCommand($sql_member)->queryAll();

            $sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='" . $_REQUEST['id'] . "'";

            $res = $connection->createCommand($sql)->queryAll();

            //$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
            //$result_charges = $connection->createCommand($sql_charges)->queryAll();



            $sql_plotinfo = "SELECT mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join memberplot mp on mp.plot_id=p.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
			LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
			WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('payment_detailsc', array('payments' => $result_payments, 'primeloc' => $result_prime, 'landcost' => $land_cost, 'info' => $result_plotinfo, 'receivable' => $res, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionInstallment_detailsc() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_payment = "SELECT * FROM installpayment where plot_id='" . $_REQUEST['id'] . "' and fstatus in ('Cancelled')";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();
            $sql_member = "
			 SELECT cp.plot_id, cph.msno, cp.member_id,m.cnic,m.image,m.name FROM cancelplot cp
			 		   left join members m on cp.member_id=m.id
			 LEFT JOIN cancelplothistory cph ON cp.plot_id = cph.plot_id
			 WHERE cp.plot_id='" . $_REQUEST['id'] . "'";
            $result_members = $connection->createCommand($sql_member)->queryAll();
            $sql_charges = "SELECT * FROM plotcharges where plot_id='" . $_REQUEST['id'] . "'";
            $result_charges = $connection->createCommand($sql_charges)->queryAll();
            //	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
            $sql_plotinfo = "SELECT mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join memberplot mp on mp.plot_id=p.id
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

            $sql_minfo = "SELECT * FROM memberplot where plot_id='" . $_REQUEST['id'] . "'";

            $result_minfo = $connection->createCommand($sql_minfo)->queryAll();
            $sql_primeloc = "SELECT *  FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('installment_detailsc', array('payments' => $result_payments, 'primeloc' => $result_prime, 'charges' => $result_charges, 'info' => $result_plotinfo, 'minfo' => $result_minfo, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    ////////START:cancelled files list
    public function actionCancelled_files() {
        if ((Yii::app()->session['user_array']['per2'] == '1') && isset(Yii::app()->session['user_array']['username'])) {
            $name = '';
            $sodowo = '';
            $cnic = '';
            $plotno = '';
            $project_name = '';
            $plot_detail_address = '';
            $where = '';
            $and = false;
            if (!empty($_POST['name'])) {
                $where .= " m.name =" . $_POST['name'] . "";
                $and = true;
            }
            if (!empty($_POST['sodowo'])) {
                if ($and == true) {
                    $where .= " and m.sodowo =" . $_POST['sodowo'] . "";
                } else {

                    $where .= " m.sodowo =" . $_POST['sodowo'] . "";
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
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id  '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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
                    $where .= " and mp.plotno ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= "mp.plotno='" . $_POST['plotno'] . "'";
                }
                $and == true;
            }
            $sql2 = '';
            $members = "";
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
            $error = "";
            $and = false;
            $where = '';
            if (!empty($_POST['name'])) {
                $where .= " m.name LIKE '%" . $_POST['name'] . "%'";
                $and = true;
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
                    $where .= " and m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                } else {
                    $where .= " m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                }
                $and = true;
            }
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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

//if($and ==true){echo 0;}else{echo 1;}exit;



            if (!empty($_POST['plot_detail_address'])) {

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

            $sql_com_res = "SELECT DISTINCT com_res FROM plots";
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
            $sql1 = "select * from projects where";
            $num_of_projects_counter--;
            while ($num_of_projects_counter > -1) {
                $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                $num_of_projects_counter--;
            }

            $sql_project = $sql1;
            $sql_project = $sql_project . implode(' or', $sql2);
            $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

            if (isset($_POST['search'])) {

                $res = array();

                foreach ($members as $key) {

                    echo '<tr><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['create_date'] . '</td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'] . '</a><td>' . $key['plot_size'] . '</td><td>' . $key['street'] . '</td><td>' . $key['project_name'] . '</td><td><a target="_blank" href="payment?id=' . $key['plot_id'] . ' & pid=' . $key['project_id'] . '">Add Payment</a></br><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a>
  </br><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a>

</br>';
                    if ($key['status'] == 'New Request') {
                        echo'Cancel Request';
                    } else {
                        echo'<a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '">Transfer asdsaasdPlot</a>';
                    }

                    echo'  </td></tr>';
                }
            }

            $this->render('cancelled_files', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects, 'com_res' => $result_com_res));
        } else {
            $this->redirect(array("user/dashboard"));
        }
    }

    public function actionSearchcanf() {

        $where = "";
        $and = '';
        if (!empty($_POST['type'])) {
            $where .= "p.type LIKE '%" . $_POST['type'] . "%'";
            $and = true;
        } else {
            $where .= "p.type ='file'";
            $and = true;
        }
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
                $where .= " and cph.app_no =" . $_POST['app_no'] . "";
            } else {
                $where .= " cph.app_no =" . $_POST['app_no'] . "";
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
            if ($_POST['allotmentstatus'] == 4) {
                if ($and == true) {
                    $where .= " and mp.mstatus=2";
                } else {
                    $where .= " mp.mstatus=0";
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

                $where .= " and cph.msno LIKE '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "cph.msno LIKE '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
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
        echo $sql_memberas = "SELECT * FROM cancelplothistory cph

left join members m on cph.member_id=m.id


left join plots p on cph.plot_id=p.id
left join cancelplot cp on cp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where and p.type='file'";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		
        $connection = Yii::app()->db;
        $sql_member = "SELECT cph.msno,cp.status as cpstatus,cph.member_id,cph.app_no,p.com_res,p.id,p.type,p.project_id,m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,cph.plot_id,cph.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,cph.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM cancelplothistory cph

left join members m on cph.member_id=m.id


left join plots p on cph.plot_id=p.id
left join cancelplot cp on cp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where and p.type='file' limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;

        if ($result_members != '') {

            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();

            foreach ($result_members as $key) {

                $count++;
                echo $count . ' result found';
                $msco = '';

                echo '<tr><td style=" font-weight:bold;color:' . $msco . ';">';
                if (empty($key['msno'])) {
                    echo 'App-' . $key['app_no'];
                } else {
                    echo $key['msno'];
                } echo'</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td>
			 <td>';
                echo $key['size'] . '&nbsp;(' . $key['plot_size'] . ')';
                echo'</td>
			 <td><strong>';
                echo '<a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'];
                echo'</strong></a></td>
				  <td>';
                echo $key['street'];
                echo '</td>
				  <td>';
                echo $key['sector_name'];
                echo'</td>
				  <td>' . $key['project_name'] . '</td><td>
			  <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			';

                if (Yii::app()->session['user_array']['per33'] == '1') {
                    echo'<li role="presentation">Cancellation Detail</li>';
                    echo'<li role="presentation"><a target="_blank" href="payment_detailsc?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a></li>
		
';
                }

                $sqltest = "SELECT * FROM  plots where id='" . $key['plot_id'] . "'  ";

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
                foreach ($resulttest as $test) {
                    
                }
                echo'
  </ul></div>
  </td>';
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
        } else {
            echo '';
        }

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

    /////END:cancelled files list
    //cancelled plots list
    public function actionCancelled_plots() {
        if ((Yii::app()->session['user_array']['per2'] == '1') && isset(Yii::app()->session['user_array']['username'])) {
            $name = '';
            $sodowo = '';
            $cnic = '';
            $plotno = '';
            $project_name = '';
            $plot_detail_address = '';
            $where = '';
            $and = false;
            if (!empty($_POST['name'])) {
                $where .= " m.name =" . $_POST['name'] . "";
                $and = true;
            }
            if (!empty($_POST['sodowo'])) {
                if ($and == true) {
                    $where .= " and m.sodowo =" . $_POST['sodowo'] . "";
                } else {

                    $where .= " m.sodowo =" . $_POST['sodowo'] . "";
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
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id  '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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
                    $where .= " and mp.plotno ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= "mp.plotno='" . $_POST['plotno'] . "'";
                }
                $and == true;
            }
            $sql2 = '';
            $members = "";
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
            $error = "";
            $and = false;
            $where = '';
            if (!empty($_POST['name'])) {
                $where .= " m.name LIKE '%" . $_POST['name'] . "%'";
                $and = true;
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
                    $where .= " and m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                } else {
                    $where .= " m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                }
                $and = true;
            }
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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

//if($and ==true){echo 0;}else{echo 1;}exit;



            if (!empty($_POST['plot_detail_address'])) {

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

            $sql_com_res = "SELECT DISTINCT com_res FROM plots";
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
            $sql1 = "select * from projects where";
            $num_of_projects_counter--;
            while ($num_of_projects_counter > -1) {
                $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                $num_of_projects_counter--;
            }

            $sql_project = $sql1;
            $sql_project = $sql_project . implode(' or', $sql2);
            $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

            if (isset($_POST['search'])) {

                $res = array();

                foreach ($members as $key) {

                    echo '<tr><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['create_date'] . '</td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'] . '</a><td>' . $key['plot_size'] . '</td><td>' . $key['street'] . '</td><td>' . $key['project_name'] . '</td><td><a target="_blank" href="payment?id=' . $key['plot_id'] . ' & pid=' . $key['project_id'] . '">Add Payment</a></br><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a>
  </br><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a>

</br>';
                    if ($key['status'] == 'New Request') {
                        echo'Cancel Request';
                    } else {
                        echo'<a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '">Transfer asdsaasdPlot</a>';
                    }

                    echo'  </td></tr>';
                }
            }

            $this->render('cancelled_plots', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects, 'com_res' => $result_com_res));
        } else {
            $this->redirect(array("user/dashboard"));
        }
    }

    public function actionSearchcan() {

        $where = "";
        $and = '';
        if (!empty($_POST['type'])) {
            $where .= "p.type LIKE '%" . $_POST['type'] . "%'";
            $and = true;
        } else {
            $where .= "p.type !='file'";
            $and = true;
        }
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
                $where .= " and cph.app_no =" . $_POST['app_no'] . "";
            } else {
                $where .= " cph.app_no =" . $_POST['app_no'] . "";
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
            if ($_POST['allotmentstatus'] == 4) {
                if ($and == true) {
                    $where .= " and mp.mstatus=2";
                } else {
                    $where .= " mp.mstatus=0";
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

                $where .= " and cph.msno LIKE '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "cph.msno LIKE '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
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
        echo $sql_memberas = "SELECT * FROM cancelplothistory cph

left join members m on cph.member_id=m.id


left join plots p on cph.plot_id=p.id
left join cancelplot cp on cp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where and p.type='plot'";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		
        $connection = Yii::app()->db;
        $sql_member = "SELECT cp.status as cpstatus,cph.member_id,cph.app_no,p.com_res,p.id,p.type,p.project_id,m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,cph.plot_id,cph.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,cph.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM cancelplothistory cph

left join members m on cph.member_id=m.id


left join plots p on cph.plot_id=p.id
left join cancelplot cp on cp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where and p.type='plot' limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;

        if ($result_members != '') {

            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();

            foreach ($result_members as $key) {

                $count++;
                echo $count . ' result found';
                $msco = '';

                echo '<tr><td style=" font-weight:bold;color:' . $msco . ';">';
                if (empty($key['plotno'])) {
                    echo 'App-' . $key['app_no'];
                } else {
                    echo $key['plotno'];
                } echo'</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td>
			 <td>';
                echo $key['size'] . '&nbsp;(' . $key['plot_size'] . ')';
                echo'</td>
			 <td><strong>';
                echo '<a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'];
                echo'</strong></a>
				  <td>';
                echo $key['street'];
                echo '</td>
				  <td>';
                echo $key['sector_name'];
                echo'</td>
				  <td>' . $key['project_name'] . '</td><td>
			  <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a></li>';
                if (Yii::app()->session['user_array']['per32'] == '1') {
                    echo'<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/member/ms_status?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Update Status</a></li>';
                }
                if (Yii::app()->session['user_array']['per33'] == '1') {
                    if ($key['cpstatus'] == 'New') {
                        echo'<li role="presentation"><span style="color:red">Cancellation Requested</span></li>';
                    } else {
                        echo'<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/memberplot/cancelplot?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Cancellation</a></li>';
                    }
                }
                echo'<li role="presentation"><a target="_blank" href="payment_detailsc?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a></li>
			<li role="presentation"><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a></li>
			<li role="presentation"><a target="_blank" href="reallocate?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Reallocation</a></li>
';

                $sqltest = "SELECT * FROM  plots where id='" . $key['plot_id'] . "'  ";

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
                foreach ($resulttest as $test) {


                    if ($test['status'] == 'Requested(T)') {
                        echo '<li role="presentation"><a  href="' . $home . '/index.php/memberplot/treq_detail?id=' . $key['plot_id'] . '">Transfer Details</a></li>';
                    }
                    if ($test['status'] != 'Requested(T)' && $key['status'] == 'Approved') {
                        echo '<li role="presentation"><a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '"> Transfer Plot</a></li>';
                    }
                }
                echo'
 
<li role="presentation"><a href="amembers?mid=' . $key['msid'] . '">Associates Member</a></li>

<li role="presentation"><a href="updatemember_plot?id=' . $key['plot_id'] . '">Update Membership</a></li>
  </ul></div>
  </td>';
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
        } else {
            echo '';
        }

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

    /////END:cancelled plots list

    public function actionCancelplot() {





        if (Yii::app()->session['user_array']['per33'] == '1') {


            $this->layout = '//layouts/back';
            $this->render('cancelplot');
        }
    }

    public function actionCancellation_list() {
        if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) &&(empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
				$connection = Yii::app()->db;
                                $error="";
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
				$this->render('cancellation_list', array('error' => $error, 'projects' => $result_projects, 'com_res' => $result_com_res));
				exit;
			}
        
        
        if (isset(Yii::app()->session['user_array']['username'])) {
            $name = '';
            $sodowo = '';
            $cnic = '';
            $plotno = '';
            $project_name = '';
            $plot_detail_address = '';
            $where = '';
            $and = false;
            if (!empty($_POST['name'])) {
                $where .= " m.name =" . $_POST['name'] . "";
                $and = true;
            }
            if (!empty($_POST['sodowo'])) {
                if ($and == true) {
                    $where .= " and m.sodowo =" . $_POST['sodowo'] . "";
                } else {

                    $where .= " m.sodowo =" . $_POST['sodowo'] . "";
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
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id  '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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
                    $where .= " and mp.plotno ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= "mp.plotno='" . $_POST['plotno'] . "'";
                }
                $and == true;
            }
            $sql2 = '';
            $members = "";
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
            $error = "";
            $and = false;
            $where = '';
            if (!empty($_POST['name'])) {
                $where .= " m.name LIKE '%" . $_POST['name'] . "%'";
                $and = true;
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
                    $where .= " and m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                } else {
                    $where .= " m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                }
                $and = true;
            }
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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

//if($and ==true){echo 0;}else{echo 1;}exit;



            if (!empty($_POST['plot_detail_address'])) {

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
            $sql1 = "select * from projects where";
            $num_of_projects_counter--;
            while ($num_of_projects_counter > -1) {
                $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                $num_of_projects_counter--;
            }

            $sql_project = $sql1;
            $sql_project = $sql_project . implode(' or', $sql2);
            $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

            if (isset($_POST['search'])) {

                $res = array();

                foreach ($members as $key) {

                    echo '<tr><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['create_date'] . '</td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'] . '</a><td>' . $key['plot_size'] . '</td><td>' . $key['street'] . '</td><td>' . $key['project_name'] . '</td><td><a target="_blank" href="payment?id=' . $key['plot_id'] . ' & pid=' . $key['project_id'] . '">Add Payment</a></br><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a>
  </br><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a>

</br>';
                    if ($key['status'] == 'New Request') {
                        echo'Cancel Request';
                    } else {
                        echo'<a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '">Transfer asdsaasdPlot</a>';
                    }

                    echo'  </td></tr>';
                }
            }

            $this->render('cancellation_list', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionCancellationreqq() {
        $where = '';
        $and = false;
        $and = false;
        if (!empty($_POST['name1'])) {
            $where .= " m.name LIKE '%" . $_POST['name1'] . "%'";
            $and = true;
        }


        if (!empty($_POST['cnic'])) {

            if ($and == true) {
                $where .= " and m_from.cnic =" . $_POST['cnic'] . "";
            } else {
                $where .= " m_from.cnic =" . $_POST['cnic'] . "";
            }
            $and = true;
        }if (!empty($_POST['allotmentstatus'])) {
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

            $and = true;
        }
        if (!empty($_POST['project_name'])) {
            if ($and == true) {
                $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            } else {
                $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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
        /* if (!empty($_POST['stat'])){
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
          } */
        if (!empty($_POST['plotno'])) {

            if ($and == true) {

                $where .= " and mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
        }

        /* if(Yii::app()->session['user_array']['per12']==1 && Yii::app()->session['user_array']['per20']==0){
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
          } */
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
        $sql_memberas = "SELECT cp.status as cpstatus,mp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name, cp.status as cpstatus, mp.plotno,m.name from memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where $where and cp.status='approved' and cp.fstatus='Approved'";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		
        $connection = Yii::app()->db;
        $sql_member = "SELECT cp.status as cpstatus,mp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name, cp.status as cpstatus, mp.plotno,m.name from memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where $where and cp.status='approved' and cp.fstatus='Approved' limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;

        if ($result_members != '') {

            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();

            foreach ($result_members as $key) {

                echo '<tr><td>';
                if (empty($key['plotno'])) {
                    echo 'App-' . $key['app_no'];
                } else {
                    echo $key['plotno'];
                }echo'</td>
				<td>' . $key['name'] . '</td>
				
				<td>' . $key['size'] . '</td>
				<td>' . $key['plot_detail_address'] . '</td>
				<td>' . $key['street'] . '</td>
				<td>' . $key['sector_name'] . '</td>
				<td>' . $key['project_name'] . '</td>
				<td>';
                if ($key['cpstatus'] == 'New') {
                    echo 'Requested (M)';
                } else {
                    echo'Requested (F)';
                }echo'</td>
				
				<td>';
                echo '<a href="creq_detaill?plot_id=' . $key['plot_id'] . '">Request Detail</a>';

                if (Yii::app()->session['user_array']['per12'] == 1) {
                    if ($key['cpstatus'] == 'New') {
                        //echo '<a href="treq_detail?id='.$key['tid'].'">Cancel Transfer Request</a>';
                    }
                }
                echo '</td></tr>';
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
            echo '<tr  ><td colspan="9"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;' . $rows . '</b></td></tr>';
            echo '<tr><td colspan="9">' . $pagination . '</td></tr>';
            exit;
            // for pagination END 
        } else {
            echo '';
        }

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

    public function actionCancel() {
        $error = '';
        $connection = Yii::app()->db;
        if ((isset($_POST['type']) && empty($_POST['type']))) {
            $error = 'Please Select Cancellation Type </br>';
        }
        if ((isset($_POST['detail']) && empty($_POST['detail']))) {
            $error .= 'Please Enter Detail';
        }

        if (empty($error)) {
            $sql_memberas = "SELECT mp.* 
			   FROM memberplot mp
			Left JOIN plots p ON p.id=mp.plot_id
			where p.id='" . $_POST['plot_id'] . "' ";
            $member_id = $connection->createCommand($sql_memberas)->queryRow();
            $sql = "INSERT INTO cancelplot SET `plot_id`='" . $_POST['plot_id'] . "',`member_id`='" . $member_id['member_id'] . "',uid='" . Yii::app()->session['user_array']['id'] . "'
									 ,status='New',type='" . $_POST['type'] . "',cancel_date='" . date('Y-m-d') . "',detail='" . $_POST['detail'] . "'";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql1 = "UPDATE plots set status='Requested(C)' WHERE id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();

            echo'Cancel Request Sent Successfully.';
        } if (!empty($error)) {
            echo $error;
        }
    }

    public function actionCancellation_lis() {
         if ((empty($_POST['name'])) && (empty($_POST['sodowo'])) && (empty($_POST['cnic'])) &&(empty($_POST['plotno'])) && (empty($_POST['project_name'])) && (empty($_POST['plot_detail_address']))) {
				$connection = Yii::app()->db;
                                $error="";
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
				$this->render('cancellation_lis', array('error' => $error, 'projects' => $result_projects, 'com_res' => $result_com_res));
				exit;
			}
        if (isset(Yii::app()->session['user_array']['username'])) {
            $name = '';
            $sodowo = '';
            $cnic = '';
            $plotno = '';
            $project_name = '';
            $plot_detail_address = '';
            $where = '';
            $and = false;
            if (!empty($_POST['name'])) {
                $where .= " m.name =" . $_POST['name'] . "";
                $and = true;
            }
            if (!empty($_POST['sodowo'])) {
                if ($and == true) {
                    $where .= " and m.sodowo =" . $_POST['sodowo'] . "";
                } else {

                    $where .= " m.sodowo =" . $_POST['sodowo'] . "";
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
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id  '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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
                    $where .= " and mp.plotno ='" . $_POST['plotno'] . "'";
                } else {
                    $where .= "mp.plotno='" . $_POST['plotno'] . "'";
                }
                $and == true;
            }
            $sql2 = '';
            $members = "";
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
            $error = "";
            $and = false;
            $where = '';
            if (!empty($_POST['name'])) {
                $where .= " m.name LIKE '%" . $_POST['name'] . "%'";
                $and = true;
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
                    $where .= " and m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                } else {
                    $where .= " m.cnic LIKE '%" . $_POST['cnic'] . "%'";
                }
                $and = true;
            }
            if (!empty($_POST['project_name'])) {
                if ($and == true) {
                    $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
                } else {
                    $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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

//if($and ==true){echo 0;}else{echo 1;}exit;



            if (!empty($_POST['plot_detail_address'])) {

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
            $sql1 = "select * from projects where";
            $num_of_projects_counter--;
            while ($num_of_projects_counter > -1) {
                $sql2[$num_of_projects_counter] = " id=" . Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
                $num_of_projects_counter--;
            }

            $sql_project = $sql1;
            $sql_project = $sql_project . implode(' or', $sql2);
            $result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

            if (isset($_POST['search'])) {

                $res = array();

                foreach ($members as $key) {

                    echo '<tr><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['create_date'] . '</td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'] . '</a><td>' . $key['plot_size'] . '</td><td>' . $key['street'] . '</td><td>' . $key['project_name'] . '</td><td><a target="_blank" href="payment?id=' . $key['plot_id'] . ' & pid=' . $key['project_id'] . '">Add Payment</a></br><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a>
  </br><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a>

</br>';
                    if ($key['status'] == 'New Request') {
                        echo'Cancel Request';
                    } else {
                        echo'<a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '">Transfer asdsaasdPlot</a>';
                    }

                    echo'  </td></tr>';
                }
            }

            $this->render('cancellation_lis', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionCancellationreq() {
        $where = '';
        $and = false;
        $and = false;
        if (!empty($_POST['name1'])) {
            $where .= " m.name LIKE '%" . $_POST['name1'] . "%'";
            $and = true;
        }
        /* if (!empty($_POST['sodowo'])){				
          if ($and==true)
          {
          $where.=" and m_to.name LIKE '%".$_POST['sodowo']."%'";

          }
          else
          {

          $where.=" m_to.name LIKE '%".$_POST['sodowo']."%'";

          }
          $and=true;

          } */

        if (!empty($_POST['cnic'])) {

            if ($and == true) {
                $where .= " and m_from.cnic =" . $_POST['cnic'] . "";
            } else {
                $where .= " m_from.cnic =" . $_POST['cnic'] . "";
            }
            $and = true;
        }if (!empty($_POST['allotmentstatus'])) {
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

            $and = true;
        }
        if (!empty($_POST['project_name'])) {
            if ($and == true) {
                $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            } else {
                $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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
        /* if (!empty($_POST['stat'])){
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
          } */
        if (!empty($_POST['plotno'])) {

            if ($and == true) {

                $where .= " and mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "mp.plotnoLIKE '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
        }

        /* if(Yii::app()->session['user_array']['per12']==1 && Yii::app()->session['user_array']['per20']==0){
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
          } */
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
        $sql_memberas = "SELECT mp.*,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name,mp.plotno,m.name to_name FROM memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN projects pro ON pro.id=p.project_id
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			 where $where and cp.status='New'   ";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		
        $connection = Yii::app()->db;
        $sql_member = "SELECT cp.status as cpstatus,mp.*,sec.sector_name,s.street,siz.size,p.price,mp.comment,p.com_res,p.plot_detail_address,p.plot_size,pro.project_name, mp.plotno,m.name from memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where $where and cp.status='New' limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;

        if ($result_members != '') {

            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();

            foreach ($result_members as $key) {

                echo '<tr><td>';
                if (empty($key['plotno'])) {
                    echo 'App-' . $key['app_no'];
                } else {
                    echo $key['plotno'];
                }echo'</td>
				<td>' . $key['name'] . '</td>
				
				<td>' . $key['size'] . '</td>
				<td>' . $key['plot_detail_address'] . '</td>
				<td>' . $key['street'] . '</td>
				<td>' . $key['sector_name'] . '</td>
				<td>' . $key['project_name'] . '</td>
				<td>';
                if ($key['cpstatus'] == 'New') {
                    echo 'Requested (M)';
                } else {
                    echo'Requested (F)';
                }echo'</td>
				
				<td>';
                echo '<a href="creq_detail?plot_id=' . $key['plot_id'] . '">Request Detail</a>';

                if (Yii::app()->session['user_array']['per12'] == 1) {
                    if ($key['cpstatus'] == 'New') {
                        //echo '<a href="treq_detail?id='.$key['tid'].'">Cancel Transfer Request</a>';
                    }
                }
                echo '</td></tr>';
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
            echo '<tr  ><td colspan="9"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;' . $rows . '</b></td></tr>';
            echo '<tr><td colspan="9">' . $pagination . '</td></tr>';
            exit;
            // for pagination END 
        } else {
            echo '';
        }

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

    public function actionCreq_detail() {
        if ((Yii::app()->session['user_array']['per12'] == '1') && isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_details = "SELECT cp.detail,cp.type,cp.cancel_date,cp.fstatus,mp.*,mp.id as mpid,cp.status as cpstatus,s.street,p.plot_detail_address,p.plot_size,pro.code,sc.code as scode,mp.plotno,mp.tempms,sc.size,mp.comment,se.sector_name,pro.project_name,m.id as mid,m.name,ss.name as ssname,p.com_res,u.email,u.firstname,u.middelname,u.lastname,p.project_id FROM memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN cancelplot cp ON p.id=cp.plot_id
			left join user u on cp.uid=u.id
			left join sales_center ss on u.sc_id=ss.id
			Left JOIN projects pro ON pro.id=p.project_id where cp.plot_id=" . $_REQUEST['plot_id'] . " ";
            $result_details = $connection->createCommand($sql_details)->queryRow();
            $this->render('creq_detail', array('plotdetails' => $result_details));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionCreq_detaill() {
        if ((Yii::app()->session['user_array']['per12'] == '1') && isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_details = "SELECT cp.damount,cp.detail,cp.type,cp.status as cpstatus,cp.cancel_date,cp.fstatus as cpfstatus,cp.fcomment as cpfcomment,cp.sucomment as sucomment,mp.*,mp.id as mpid,mp.member_id as mid,cp.status as cpstatus,s.street,p.plot_detail_address,p.plot_size,pro.code,sc.code as scode,mp.plotno,mp.tempms,sc.size,mp.comment,se.sector_name,pro.project_name,m.id as mid,m.name,ss.name as ssname,p.com_res,u.email,u.firstname,u.middelname,u.lastname,p.project_id FROM memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN cancelplot cp ON p.id=cp.plot_id
			left join user u on cp.uid=u.id
			left join sales_center ss on u.sc_id=ss.id
			Left JOIN projects pro ON pro.id=p.project_id where cp.plot_id=" . $_REQUEST['plot_id'] . "";
            $result_details = $connection->createCommand($sql_details)->queryRow();
            $this->render('creq_detaill', array('plotdetails' => $result_details));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionsubfinance() {
        $connection = Yii::app()->db;
        $error = '';
        if (isset($_POST['damount']) && $_POST['damount'] == '') {
            $error .= 'Please Enter Deduction Amount <br> ';
        }
        if (isset($_POST['sucomment']) && $_POST['sucomment'] == '') {
            $error .= 'Please Enter Comments';
        }
        if (empty($error)) {
            $update = "UPDATE cancelplot set fstatus='New',status='approved',sucomment='" . $_POST['sucomment'] . "',damount='" . $_POST['damount'] . "' WHERE plot_id='" . $_REQUEST['plot_id'] . "'";
            $command = $connection->createCommand($update);
            $command->execute();

            echo '<script>location.href="cancellation_lis";</script>';
            exit;
        } else {
            echo $error;
        }
    }

    public function actionCancelled() {
        $connection = Yii::app()->db;
        $error = '';
          $plotno = '';
          $app_no='';
        if (isset($_POST['status']) && $_POST['status'] == '') {
            $error .= 'Please Select Status<br>';
        }
        if (isset($_POST['fcomment']) && $_POST['fcomment'] == '') {
            $error .= 'Please Enter Comments';
        }
        if (!empty($_POST['app_no'])) {
            $app_no = $_POST['app_no'];
        }
        if (!empty($_POST['plotno'])) {
            $plotno = $_POST['plotno'];
        } else {
            $plotno = '';
        }
        if (empty($error)) {
            if ($_POST['status'] == 'approved') {
                $sqlrecid = "Select r_id  from installpayment where plot_id='" . $_REQUEST['plot_id'] . "'";
                $resrecid = $connection->createCommand($sqlrecid)->queryAll();
                if (!empty($resrecid)) {
                    foreach ($resrecid as $rid) {
                        //	echo $rid['r_id'].'<br>';
                        $sqlrec = "UPDATE receipt set fstatus='Cancelled',comm='Cancelled' WHERE id='" . $rid['r_id'] . "'";
                        $ressqlrec = $connection->createCommand($sqlrec);
                        $ressqlrec->execute();
                    }
                }
                $sqlcplot = "UPDATE cancelplot set fstatus='Cancelled',status='Cancelled' WHERE plot_id='" . $_REQUEST['plot_id'] . "'";
                $ressqlcplot = $connection->createCommand($sqlcplot);
                $ressqlcplot->execute();
                $updateplot = "UPDATE plots set status='' WHERE id='" . $_REQUEST['plot_id'] . "'";
                $resupdateplot = $connection->createCommand($updateplot);
                $resupdateplot->execute();
                $sqlcplothistory = "INSERT INTO cancelplothistory SET member_id='" . $_POST['member_id'] . "',plot_id='" . $_REQUEST['plot_id'] . "',status='Cancelled',comment='" . $_POST['comment'] . "',msno='" . $plotno . "',app_no
				='" . $app_no . "',cancel_date='" . date('Y-m-d') . "'";
                $rescphistory = $connection->createCommand($sqlcplothistory);
                $rescphistory->execute();
                $sqlcins = "UPDATE installpayment set fstatus='Cancelled',others='Cancelled' WHERE plot_id='" . $_REQUEST['plot_id'] . "'";
                $resssqlcins = $connection->createCommand($sqlcins);
                $resssqlcins->execute();

                /* 	$sqlrecid="Select * from installpayment where plot_id='".$_REQUEST['plot_id']."'";
                  $resrecid = $connection->createCommand($sqlrecid)->queryAll();
                  for ($counter = 1; $counter <= $resrecid; $counter++)
                  {

                  $sqlrec  = "UPDATE receipt set fstatus='Cancelled',comm='rejected' WHERE id='".$resrecid['r_id']."'";
                  $ressqlrec = $connection -> createCommand($sqlrec);
                  $ressqlrec -> execute();

                  } */
                $sqldeletems = "DELETE from memberplot WHERE plot_id='" . $_REQUEST['plot_id'] . "'";
                $ressqldeletems = $connection->createCommand($sqldeletems);
                $ressqldeletems->execute();

                echo '<script>location.href="cancellation_list";</script>';
                exit;
            }
        } else {
            echo $error;
        }
    }

//////////////////////////END: CANCELLATION MODULE////////////////////
    public function actionAjaxRequestlo($val1) {
        $connection = Yii::app()->db;
        $sql_city = "SELECT lo.name,lo.id as lid FROM `tbl_landowner` lo
			LEFT JOIN project_perm_lo perm ON lo.id=perm.lo_id
				WHERE perm.project_id= '" . $val1 . "'";
        $result_city = $connection->createCommand($sql_city)->query();
        $city = array();
        foreach ($result_city as $cit) {
            $city[] = $cit;
        }
        echo json_encode($city);
        exit();
    }

    public function actionAjaxRequest123($val1) {
        $connection = Yii::app()->db;
        $sql_city = "SELECT * from size_cat where typee='" . $val1 . "'";
        $result_city = $connection->createCommand($sql_city)->query();
        $city = array();
        foreach ($result_city as $cit) {
            $city[] = $cit;
        }
        echo json_encode($city);
        exit();
    }

    public function actionSearchposs() {
        $where = '';
        $and = false;

        if (!empty($_POST['name1'])) {
            $where .= " m.name LIKE '%" . $_POST['name1'] . "%'";
            $and = true;
        }



        if (!empty($_POST['project_name'])) {
            if ($and == true) {
                $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            } else {
                $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            }
            $and = true;
        }

        if (!empty($_POST['plotno'])) {

            if ($and == true) {

                $where .= " and mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "mp.plotno LIKE '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
        }
        //for Pagination 
        if (isset($_POST['limit']) && $_POST['limit'] !== '') {
            $limit = $_POST['limit'];
        } else {
            $limit = 25;
        }
        $adjacent = 25;
        $page = $_REQUEST['page'];
        if ($page == 1) {
            $start = 0;
        } else {
            $start = ($page - 1) * $limit;
        }
        $connection = Yii::app()->db;
        $sql_memberas = "SELECT mp.*,pp.payment_type,pp.paidamount,s.street,sec.sector_name,sc.size,p.plot_detail_address,mp.plotno,p.plot_size,pro.project_name,m.name 
			   FROM memberplot mp
			
			Left JOIN plots p ON p.id=mp.plot_id
			Left JOIN members m ON m.id=mp.member_id
			Left JOIN sectors sec ON p.sector=sec.id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN plotpayment pp ON p.id=pp.plot_id 
			Left JOIN size_cat sc ON sc.id=p.size2 where $where and pp.payment_type='Possession Fee' AND pp.paidamount !=''  ";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		
        $connection = Yii::app()->db;
        $sql_member = "SELECT mp.*,pp.payment_type,pp.paidamount,s.street,sec.sector_name,sc.size,p.plot_detail_address,mp.plotno,p.plot_size,pro.project_name,m.name 
			   FROM memberplot mp
			
			Left JOIN plots p ON p.id=mp.plot_id
			Left JOIN members m ON m.id=mp.member_id
			Left JOIN sectors sec ON p.sector=sec.id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN plotpayment pp ON p.id=pp.plot_id 
			Left JOIN size_cat sc ON sc.id=p.size2 where $where and pp.payment_type='Possession Fee' AND pp.paidamount !=''   limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $home = Yii::app()->request->baseUrl;

        $count = 0;

        if ($result_members != '') {
            $i = 0;
            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();

            foreach ($result_members as $key) {

                $i++;
                echo $count . ' result found';
                echo '<tr><td>' . $i . '</td><td>' . $key['plotno'] . '</td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['size'] . '</td>
			   <td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'] . '</a></td><td>' . $key['street'] . '</td><td>' . $key['sector_name'] . '</td><td>' . $key['project_name'] . '</td><td>' . $key['paidamount'] . '</td><td><a href="#">View Request</a></td></tr>';
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
            echo '<tr  ><td colspan="10"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;' . $rows . '</b></td></tr>';
            echo '<tr><td colspan="10">' . $pagination . '</td></tr>';
            exit;
            // for pagination END 
        } else {
            echo '';
        }

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

    public function actionPosspay_list() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
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

            $connection = Yii::app()->db;
            $sql_details = "SELECT mp.*,pp.payment_type,pp.paidamount,s.street,sec.sector_name,sc.size,p.plot_detail_address,mp.plotno,p.plot_size,pro.project_name,m.name 
			   FROM memberplot mp
			
			Left JOIN plots p ON p.id=mp.plot_id
			Left JOIN members m ON m.id=mp.member_id
			Left JOIN sectors sec ON p.sector=sec.id
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN plotpayment pp ON p.id=pp.plot_id 
			Left JOIN size_cat sc ON sc.id=p.size2
		
			where pp.payment_type='Possession Fee' AND pp.paidamount !='' ";
            $result_details = $connection->createCommand($sql_details)->query();
            $this->render('posspay_list', array('plotdetails' => $result_details, 'projects' => $result_projects));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionSurchargedef() {
        $error = array();
        $error = '';
        if (!empty($_REQUEST['datee'])) {
            $datee = $_REQUEST['datee'];
        } else {
            $datee = date('Y-m-d');
        }
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['duedate']) && empty($_POST['duedate'])) || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment'])) || (isset($_POST['total']) && empty($_POST['total']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;
            $sqlchrgesdetail = 'Select * from charges where id="' . $_POST['charges_id'] . '"';
            $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
            $sql = 'INSERT INTO plotpayment  (plot_id,payment_type,amount, remarks,due_date_temp) VALUES ("' . $_POST['plot_id'] . '","' . $resultcharges['name'] . '", "' . $_POST['total'] . '","' . $_POST['comment'] . '","' . $_POST['duedate'] . '")';
            $command = $connection->createCommand($sql);
            $command->execute();

            $plot_id = $_POST['plot_id'];
            $sql_charges = "SELECT * from installpayment where plot_id='" . $_POST['plot_id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
            $result_charges = $connection->createCommand($sql_charges)->queryAll();

            $totalssss = 0;
            foreach ($result_charges as $key) {
                if ($key['paid_date_temp'] == '') {
                    $curdate = $_POST['cdate'];
                } else {
                    $curdate = $key['paid_date_temp'];
                }
                $surchargeratio = $key['dueamount'] / 100 * 0.05;
                $duedate = $key['due_date_temp'];
                if ($key['paid_date_temp'] == '') {
                    $paiddate = $_POST['cdate'];
                } else {
                    $paiddate = $key['paid_date_temp'];
                }
                $datetime1 = new DateTime($duedate);
                $datetime2 = new DateTime($paiddate);
                $interval = $datetime1->diff($datetime2);
                $surchargedur = $interval->format('%R%a ');
                $datetime3 = new DateTime($datee);
                if ($datetime1 < $datetime3) {

                    $interval = $datetime1->diff($datetime2);
                    $surchargedur = $interval->format('%R%a ');
                    if ($surchargedur > 1) {

                        $sql = 'UPDATE installpayment SET surcharge_re=1 where id="' . $key['id'] . '"';
                        $command = $connection->createCommand($sql);
                        $command->execute();
                    }
                }
                $sql_charges1 = "SELECT * from installpayment where ref='" . $key['id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
                $result_charges1 = $connection->createCommand($sql_charges1)->queryAll();
///$ddamount=$key['dueamount']-$key['paidamount'];
                foreach ($result_charges1 as $key1) {
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
                    $sql1 = 'UPDATE installpayment SET surcharge_re=1 where id="' . $key1['id'] . '"';
                    $command = $connection->createCommand($sql1);
                    $command->execute();

//}
//	}
//	}
                }
            }

            echo "Charges Added Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    public function actionSurchargedef111() {
        $error = array();
        $error = '';
        if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['duedate']) && empty($_POST['duedate'])) || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment'])) || (isset($_POST['total']) && empty($_POST['total']))) {
            $error = 'Please complete all required fields <br />';
        }
        if (empty($error)) {
            $connection = Yii::app()->db;
            $sqlchrgesdetail = 'Select * from charges where id="' . $_POST['charges_id'] . '"';
            $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
            $sql = 'INSERT INTO plotpayment  (plot_id,payment_type,amount, remarks,duedate) VALUES ("' . $_POST['plot_id'] . '","' . $resultcharges['name'] . '", "' . $_POST['total'] . '","' . $_POST['comment'] . '","' . $_POST['duedate'] . '")';
            $command = $connection->createCommand($sql);
            $command->execute();

            $plot_id = $_POST['plot_id'];
            $sql_charges = "SELECT * from installpayment where plot_id='" . $_POST['plot_id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
            $result_charges = $connection->createCommand($sql_charges)->queryAll();
            $totalssss = 0;
            foreach ($result_charges as $key) {
                if ($key['paid_date'] == '') {
                    $curdate = $_POST['cdate'];
                } else {
                    $curdate = $key['paid_date'];
                }
                $surchargeratio = $key['dueamount'] / 100 * 0.05;
                $duedate = $key['due_date'];
                if ($key['paid_date'] == '') {
                    $paiddate = $_POST['cdate'];
                } else {
                    $paiddate = $key['paid_date'];
                }
                $datetime1 = new DateTime($duedate);
                $datetime2 = new DateTime($paiddate);
                $interval = $datetime1->diff($datetime2);
                $surchargedur = $interval->format('%R%a ');
                $datetime3 = new DateTime($_REQUEST['datee']);
                if ($datetime1 < $datetime3) {
                    //
                    $interval = $datetime1->diff($datetime2);
                    $surchargedur = $interval->format('%R%a ');
                    if ($surchargedur > 1) {
                        $sql = 'UPDATE installpayment SET surcharge_re=1 where id="' . $key['id'] . '"';
                        $command = $connection->createCommand($sql);
                        $command->execute();
                    }
                }
                $sql_charges1 = "SELECT * from installpayment where ref='" . $key['id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
                $result_charges1 = $connection->createCommand($sql_charges1)->queryAll();
                ///$ddamount=$key['dueamount']-$key['paidamount'];
                foreach ($result_charges1 as $key1) {
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
                    $sql1 = 'UPDATE installpayment SET surcharge_re=1 where id="' . $key1['id'] . '"';
                    $command = $connection->createCommand($sql1);
                    $command->execute();

                    //}	
                    //	}
                    //	}
                }
            }

            echo "Charges Added Successfully";
        }
        if (!empty($error)) {
            echo $error;
        }
    }

    public function actionCalsur() {
        $surchargedur = 0;
        $connection = Yii::app()->db;
        $plot_id = $_REQUEST['id'];
        $sql_charges = "SELECT * from installpayment where plot_id='" . $_REQUEST['id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
        $result_charges = $connection->createCommand($sql_charges)->queryAll();
        $totalssss = 0;
        foreach ($result_charges as $key) {

            $ddamount = 0;
            $sql_charges1 = "SELECT * from installpayment where ref='" . $key['id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
            $result_charges1 = $connection->createCommand($sql_charges1)->queryAll();
            $ddamount = floatval($key['dueamount']) - floatval($key['paidamount']);
            foreach ($result_charges1 as $key1) {
                if ($key1['paid_date_temp'] !== $key['paid_date']) {
                    if ($key1['paid_date_temp'] == '') {
                        $curdate = $_REQUEST['cdate'];
                    } else {
                        $curdate = $key1['paid_date_temp'];
                    }
                    $surchargeratio = ($key1['paidamount']) / 100 * 0.05;
                    $duedate = $key['paid_date_temp'];
                    if ($key1['paid_date_temp'] == '') {
                        $paiddate = $_REQUEST['cdate'];
                    } else {
                        $paiddate = $key1['paid_date_temp'];
                    }
                    $datetime1 = new DateTime($duedate);
                    $datetime2 = new DateTime($paiddate);
                    $datetime3 = new DateTime($_REQUEST['cdate']);
                    if ($datetime2 < $datetime3) {
                        $interval = $datetime1->diff($datetime2);
                        $surchargedur = $interval->format('%R%a ');
                        if ($surchargedur > 1) {
                            $totalduesur = $surchargedur * $surchargeratio;
                        } else {
                            $totalduesur = 0;
                        }
                        $totalssss = $totalssss + $totalduesur;
                        $ddamount = $ddamount + $key1['paidamount'];
                    }
                }
            }
            if ($key['paid_date_temp'] == '') {
                $curdate = $_REQUEST['cdate'];
            } else {
                $curdate = $key['paid_date_temp'];
            }
            $surchargeratio = $key['dueamount'] / 100 * 0.05;
            $duedate = $key['due_date'];
            if ($key['paid_date_temp'] == '') {
                $paiddate = $_REQUEST['cdate'];
            } else {
                $paiddate = $key['paid_date_temp'];
            }
            $datetime1 = new DateTime($duedate);
            $datetime2 = new DateTime($paiddate);
            $datetime3 = new DateTime($_REQUEST['cdate']);
            if ($datetime1 < $datetime3) {
                $interval = $datetime1->diff($datetime2);
                $surchargedur = $interval->format('%R%a ');
                if ($surchargedur > 1) {
                    $totalduesur = $surchargedur * $surchargeratio;
                } else {
                    $totalduesur = 0;
                }
                $totalssss = $totalssss + $totalduesur;
            }
        }
        echo round($totalssss);
        exit;
    }

    public function actionCalsur111() {
        $surchargedur = 0;
        $connection = Yii::app()->db;
        $plot_id = $_REQUEST['id'];
        $sql_charges = "SELECT * from installpayment where plot_id='" . $_REQUEST['id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
        $result_charges = $connection->createCommand($sql_charges)->queryAll();
        $totalssss = 0;
        foreach ($result_charges as $key) {

            $ddamount = 0;
            $sql_charges1 = "SELECT * from installpayment where ref='" . $key['id'] . "' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
            $result_charges1 = $connection->createCommand($sql_charges1)->queryAll();
            $ddamount = $key['dueamount'] - $key['paidamount'];
            foreach ($result_charges1 as $key1) {
                if ($key1['paid_date'] !== $key['paid_date']) {
                    if ($key1['paid_date'] == '') {
                        $curdate = $_REQUEST['cdate'];
                    } else {
                        $curdate = $key1['paid_date'];
                    }
                    $surchargeratio = ($key1['paidamount']) / 100 * 0.05;
                    $duedate = $key['paid_date'];
                    if ($key1['paid_date'] == '') {
                        $paiddate = $_REQUEST['cdate'];
                    } else {
                        $paiddate = $key1['paid_date'];
                    }
                    $datetime1 = new DateTime($duedate);
                    $datetime2 = new DateTime($paiddate);
                    $datetime3 = new DateTime($_REQUEST['cdate']);
                    if ($datetime2 < $datetime3) {
                        $interval = $datetime1->diff($datetime2);
                        $surchargedur = $interval->format('%R%a ');
                        if ($surchargedur > 1) {
                            $totalduesur = $surchargedur * $surchargeratio;
                        } else {
                            $totalduesur = 0;
                        }
                        $totalssss = $totalssss + $totalduesur;
                        $ddamount = $ddamount + $key1['paidamount'];
                    }
                }
            }
            if ($key['paid_date'] == '') {
                $curdate = $_REQUEST['cdate'];
            } else {
                $curdate = $key['paid_date'];
            }
            $surchargeratio = $key['dueamount'] / 100 * 0.05;
            $duedate = $key['due_date'];
            if ($key['paid_date'] == '') {
                $paiddate = $_REQUEST['cdate'];
            } else {
                $paiddate = $key['paid_date'];
            }
            $datetime1 = new DateTime($duedate);
            $datetime2 = new DateTime($paiddate);
            $datetime3 = new DateTime($_REQUEST['cdate']);
            if ($datetime1 < $datetime3) {
                $interval = $datetime1->diff($datetime2);
                $surchargedur = $interval->format('%R%a ');
                if ($surchargedur > 1) {
                    $totalduesur = $surchargedur * $surchargeratio;
                } else {
                    $totalduesur = 0;
                }
                $totalssss = $totalssss + $totalduesur;
            }
        }
        echo round($totalssss);
        exit;
    }

    /*
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
      $sql_charges1  = "SELECT * from installpayment where ref='".$key['id']."' and surcharge_re=0 and(paidsurcharge='' or paidsurcharge < 1)";
      $result_charges1 = $connection->createCommand($sql_charges1)->queryAll();
      $ddamount=$key['dueamount']-$key['paidamount'];
      foreach($result_charges1 as $key1){
      if($key1['paid_date']!==$key['paid_date']){
      if($key1['paid_date']==''){$curdate=$_REQUEST['datee'];}else{$curdate=$key1['paid_date'];}
      $surchargeratio=($ddamount/100)*0.05;
      $duedate=$key['paid_date'];
      if($key1['paid_date']==''){$paiddate=$_REQUEST['datee'];}else{$paiddate=$key1['paid_date'];}
      $datetime1 = new DateTime($duedate);
      $datetime2 = new DateTime($paiddate);
      $datetime3 = new DateTime($_REQUEST['datee']);
      if($datetime2 < $datetime3){
      $interval = $datetime1->diff($datetime2);
      $surchargedur= $interval->format('%R%a ');
      if($surchargedur > 1){
      $totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}
      $totalssss=$totalssss+$totalduesur;
      $ddamount=$ddamount+$key1['paidamount'];
      }}}
      if($key['paid_date']==''){$curdate=$_REQUEST['datee'];}else{$curdate=$key['paid_date'];}
      $surchargeratio=$key['dueamount']/100*0.05;
      $duedate=$key['due_date'];
      if($key['paid_date']==''){$paiddate=$_REQUEST['datee'];}else{$paiddate=$key['paid_date'];}
      $datetime1 = new DateTime($duedate);
      $datetime2 = new DateTime($paiddate);
      $datetime3 = new DateTime($_REQUEST['datee']);
      if($datetime1 < $datetime3){
      $interval = $datetime1->diff($datetime2);
      $surchargedur= $interval->format('%R%a ');
      if($surchargedur > 1){
      $totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}
      $totalssss=$totalssss+$totalduesur;
      ///	echo $totalssss.'</br>';
      }}
      echo round($totalssss);exit;
      }
     */

    public function actionPlotsurcharge() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $plot_id = $_REQUEST['id'];
            $sql_charges = "SELECT * from charges where project_id='" . $_REQUEST['pid'] . "' and name like '%Surcharge%'";
            $result_charges = $connection->createCommand($sql_charges)->query();
            $sql_plots = "SELECT * from plots where id='" . $plot_id . "'";
            $result_plots = $connection->createCommand($sql_plots)->query();
            $this->render('plotsurcharge', array('plots' => $result_plots, 'charges' => $result_charges));
        } else {
            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionSearchreqmap() {
        $this->layout = '//layouts/back';
        $where = '';
        $and = true;
        $where .= "p.type='plot'";
        if (!empty($_REQUEST['name1'])) {
            $where .= "and m.cnic='" . $_REQUEST['name1'] . "'";
        }

        if (!empty($_REQUEST['plotno'])) {

            if ($and == true) {
                $where .= " and mp.plotno ='" . $_REQUEST['plotno'] . "'";
            } else {
                $where .= "mp.plotno='" . $_REQUEST['plotno'] . "'";
            }
            $and == true;
        }
        if (!empty($_REQUEST['street'])) {

            if ($and == true) {
                $where .= " and p.street_id ='" . $_REQUEST['street'] . "'";
            } else {
                $where .= "p.street_id='" . $_REQUEST['street'] . "'";
            }
            $and == true;
        }
        if (!empty($_REQUEST['sector'])) {

            if ($and == true) {
                $where .= " and p.sector ='" . $_REQUEST['sector'] . "'";
            } else {
                $where .= "p.sector='" . $_REQUEST['sector'] . "'";
            }
            $and == true;
        }

        $connection = Yii::app()->db;
        $sql_memberas = "SELECT * FROM plots p
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id
left join transferplot tp on p.id=tp.id
left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where  $where  and p.type='plot' ";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		
        $connection = Yii::app()->db;
        $sql_member = "SELECT p.ctag,p.status as pstatus,mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name,sec.sector_name FROM plots p
left join memberplot mp on (p.id=mp.plot_id)
left join members m on mp.member_id=m.id
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
left join sectors sec on p.sector=sec.id

where $where ORDER BY sec.sector_name ASC,s.street ASC,p.plot_detail_address ASC";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;

        if ($result_members != '') {

            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();
            echo '<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap.min.css" media="screen, projection" />';
            echo '<table class="table table-striped table-new table-bordered">
			<thead>
			<th>MS #.</th>
			<th>Name</th>
			<th>CNIC</th>
			<th>Plot No.</th>
			<th>Plot Address</th>
			<th>Tag</th>
			<th>Status</th>
			</thead>
			<tbody>';
            foreach ($result_members as $key) {

                $count++;

                echo '<tr><td>' . $key['plotno'] . '</td><td>' . $key['name'] . '
			 </td><td>' . $key['cnic'] . '</td><td>' . $key['plot_detail_address'] . '
			 <td>' . $key['street'] . '/' . $key['sector_name'] . '</td><td>' . $key['ctag'] . '</td><td>' . $key['pstatus'] . '</td>';
                $sqltest = "SELECT * FROM  plots where id='" . $key['plot_id'] . "'  ";
                $resulttest = $connection->createCommand($sqltest)->query();
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '';
        }

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

    public function actionDownload4() {
        if (isset(Yii::app()->session['user_array']['username'])) {
//	$plot_id = $_GET['id'];
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_member = "SELECT
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
		Limit 100
		";

            $member_result = $connection->createCommand($sql_member)->queryAll();

            $this->render('pdf4', array('member' => $member_result));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionDownload1() {
        if (isset(Yii::app()->session['user_array']['username'])) {
//	$plot_id = $_GET['id'];
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_member = "SELECT
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
		Limit 100
		";

            $member_result = $connection->createCommand($sql_member)->queryAll();

            $this->render('pdf1', array('member' => $member_result));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionDownload2() {
        if (isset(Yii::app()->session['user_array']['username'])) {
//	$plot_id = $_GET['id'];
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_member = "SELECT
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
		Limit 100
		";

            $member_result = $connection->createCommand($sql_member)->queryAll();

            $this->render('pdf2', array('member' => $member_result));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionDownload3() {
        if (isset(Yii::app()->session['user_array']['username'])) {
//	$plot_id = $_GET['id'];
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_member = "SELECT
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
		Limit 100
		";

            $member_result = $connection->createCommand($sql_member)->queryAll();

            $this->render('pdf3', array('member' => $member_result));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionSplitinstallment() {

        $connection = Yii::app()->db;
        $sql_payment = "SELECT * FROM installpayment where id='" . $_REQUEST['id'] . "'";
        $result_payments = $connection->createCommand($sql_payment)->queryRow();
        //print_r($result_payments);
        $sql = "INSERT INTO installpayment SET dueamount='00',
			 lab='" . $result_payments['lab'] . "',
			 ref='" . $_GET['id'] . "',  
			 plot_id='" . $result_payments['plot_id'] . "', 
			  mem_id='" . $result_payments['mem_id'] . "'
			  
		";
        $command = $connection->createCommand($sql);
        $command->execute();
        $this->redirect(Yii::app()->baseUrl . "/index.php/memberplot/installment_details?id=" . $result_payments['plot_id'] . "&pid=");
    }

    public function actionInstallment_edit() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_payment = "SELECT * FROM installpayment where (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='') and plot_id='" . $_REQUEST['id'] . "' ";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();
            $sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='" . $_REQUEST['id'] . "'";
            $result_members = $connection->createCommand($sql_member)->queryAll();
            $sql_charges = "SELECT * FROM plotcharges where plot_id='" . $_REQUEST['id'] . "'";
            $result_charges = $connection->createCommand($sql_charges)->queryAll();
            //	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
            $sql_plotinfo = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

            $sql_minfo = "SELECT * FROM memberplot where plot_id='" . $_REQUEST['id'] . "'";

            $result_minfo = $connection->createCommand($sql_minfo)->queryAll();

            $this->render('installment_edit', array('payments' => $result_payments, 'charges' => $result_charges, 'info' => $result_plotinfo, 'minfo' => $result_minfo, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionPo() {
        $i = 0;
        $count = count($_POST['dueamount']);
        do {
            $connection = Yii::app()->db;
            $sql1 = "UPDATE installpayment SET paidamount='" . $_POST['paidamount'][$i] . "',dueamount='" . $_POST['dueamount'][$i] . "', lab='" . $_POST['lab'][$i] . "',due_date_temp='" . $_POST['due_date'][$i] . "',paid_date_temp='" . $_POST['paid_date'][$i] . "' WHERE id='" . $_POST['ppid'][$i] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();
            $i++;
        } while ($i < $count);
        $this->redirect(array("installment_edit?id=" . $_POST['ploid'] . ""));
    }

    public function actionUpdatemem_plot() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $error = '';

            $error = array();

            $connection = Yii::app()->db;

            if ((isset($_POST['plotno']) && empty($_POST['plotno']))) {

                $error = "Plot Membership No required. <br>";
            }

            $pn = $_POST['plotno'];
            if (!empty($pn)) {
                $q = "SELECT * from memberplot where plotno='" . $pn . "'";

                $result_q = $connection->createCommand($q)->queryRow();
                if ($result_q['plotno'] == $pn) {
                    $error = "Membership # Already Added Try Another. <br>";
                }
            }
            if (empty($error)) {


                $sql = "Update memberplot set plotno='" . $pn . "' where plot_id='" . $_POST['plot_id'] . "'";

                $command = $connection->createCommand($sql);
                $command->execute();

                echo'Membership No. Updated Successfully';
            } else {

                echo $error;
            }
        }
    }

    public function actionUpdatemember_plot() {
        if (Yii::app()->session['user_array']['per2'] == '1') {
            $connection = Yii::app()->db;
            $sql_country = "SELECT * from tbl_country";
            $result_country = $connection->createCommand($sql_country)->query();
            $sql_plan = "SELECT * from installment_plan";
            $result_plan = $connection->createCommand($sql_plan)->query();
            $sql_project = "SELECT * from projects";
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
	Left JOIN categories  ON (plots.category_id = categories.id) where  plots.id='" . $_REQUEST['id'] . "'";
            //	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";
            $result = $connection->createCommand($sql)->query();
            $this->render('updatemember_plot', array('plot' => $result, 'projects' => $result_projects, 'country' => $result_country, 'plan' => $result_plan));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    function actionGenpdf() {
        if (!empty($_POST['submit'])) {

            //require_once();
            include Yii::app()->baseUrl . "/dompdf/dompdf_config.inc.php";
            $stream = TRUE;
            $dompdf = new DOMPDF();
            $html = $_POST['html'];
            //echo $html;exit;
            $filename = 'PDF File';
            $dompdf->set_paper('letter', 'landscape');
            $dompdf->load_html($html);
            $dompdf->render();
            $dompdf->set_base_path(realpath(APPLICATION_PATH . 'styles.css'));
            if ($stream) {
                $dompdf->stream($filename . ".pdf");
            } else {
                return $dompdf->output();
            }
        }
    }
   
    public function actionReallocate() {
        if (Yii::app()->session['user_array']['per1'] == '1') {
            $connection = Yii::app()->db;
            $sql_plots = "SELECT
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
	,memberplot.id as msid
    , projects.project_name
	, categories.name
	, streets.street
		, plots.project_id
		, sectors.sector_name
, size_cat.size

FROM
    plots
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN categories  ON (plots.category_id = categories.id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)
where plots.id='" . $_REQUEST['id'] . "'";
            $result_plots = $connection->createCommand($sql_plots)->query();
            $sql = "SELECT * from projects";
            $result = $connection->createCommand($sql)->query();
            $this->render('reallocate', array('plots' => $result_plots, 'projects' => $result));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionReallocation() {
        $error = '';
        $connection = Yii::app()->db;
        if (isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address'])) {
            $error .= 'Please Select Plot Details<br>';
        }
        if (empty($error)) {
            $sq = "Update memberplot SET plot_id='" . $_POST['plot_detail_address'] . "' where id='" . $_POST['id'] . "' ";
            $command = $connection->createCommand($sq);
            $command->execute();
            echo "Plot Reallocated Successfully";
        } else {
            echo $error;
        }
    }

    public function actionInstallment_up() {

        if (Yii::app()->session['user_array']['per3'] == '1' && Yii::app()->session['user_array']['per2'] == '1' && isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = '//layouts/back';

            $connection = Yii::app()->db;
            $sql_payment = "SELECT * FROM installpayment where id='" . $_GET['id'] . "'";

            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $this->render('installment_up', array('payments' => $result_payments));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionAddins() {
        if ($_REQUEST['id'] !== '' && $_REQUEST['mid'] !== '') {
            $connection = Yii::app()->db;
            $sql = "INSERT INTO installpayment SET plot_id= '" . $_REQUEST['id'] . "',mem_id='" . $_REQUEST['mid'] . "'";
            $command = $connection->createCommand($sql);

            $command->execute();
            //echo 123;exit;
            $this->redirect(Yii::app()->baseUrl . "/index.php/memberplot/installment_edit?id=" . $_REQUEST['id'] . "&pid=" . $_REQUEST['pid']);
        }
    }

    public function actionCapture_image() {





        $connection = Yii::app()->db;
        $this->render('index');
    }

    public function actionDiscount() {
        $this->render('discount');
    }

    public function actionDiscount1() {
        $error = '';
        if ((isset($_POST['total']) && empty($_POST['total'])) && (isset($_POST['details']) && empty($_POST['details']))) {
            $error = 'Please complete all required fields <br />';
        }
        if ($error == '') {//echo 123;exit;
            $connection = Yii::app()->db;
            $sql_payment = "SELECT * FROM discnt where ms_id='" . $_POST['pid'] . "'";
            $result_payments = $connection->createCommand($sql_payment)->queryRow();

            if ($result_payments == '') {
                $sql = "INSERT INTO discnt SET ms_id= '" . $_POST['pid'] . "',discount='" . $_POST['total'] . "',details='" . $_POST['details'] . "'";
                $command = $connection->createCommand($sql);
                $command->execute();
            } else {
                $sql1 = "UPDATE discnt SET discount='" . $_POST['total'] . "',details='" . $_POST['details'] . "' where ms_id= '" . $_POST['pid'] . "'";
                $command = $connection->createCommand($sql1);
                $command->execute();
            }
            //echo 123;exit;
            echo 'Discount Applied';
            exit;
        }
    }

    public function actionInstallment_update() {

        if (Yii::app()->session['user_array']['per2'] == '1' && Yii::app()->session['user_array']['per2'] == '1' && isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = '//layouts/back';

            $connection = Yii::app()->db;
            $sql_payment = "SELECT * FROM installpayment where id='" . $_GET['id'] . "'";

            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $this->render('installment_update', array('payments' => $result_payments));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionPhotofortransfer() {

        echo 123;
        exit;
        $name = $_REQUEST['id'];

        $newname = "images/imagetransfer/" . $name . ".jpg";
        $file = file_put_contents($newname, file_get_contents('php://input'));
        $connection = Yii::app()->db;
        $sql3 = "UPDATE transferplot SET image='" . $_REQUEST['id'] . "' WHERE id = '" . $_REQUEST['id'] . "'";

        $command = $connection->createCommand($sql3);
        $command->execute();

        $url = 'http://rdlpk.com/' . $newname;
        print "$url\n";
    }

    public function actionCreate() {

        if (Yii::app()->session['user_array']['per2'] == '1') {



            $model = new memberplot;

            $error = '';

            if ((isset($_POST['project_id']) && empty($_POST['project_id'])) || (isset($_POST['street_id']) && empty($_POST['street_id'])) || (isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['plot_size']) && empty($_POST['plot_size'])) || (isset($_POST['cnic']) && empty($_POST['cnic']))) {

                $error = 'Please complete all required fields <br />';
            }





            if (empty($error)) {

                $model->project_id = mysql_real_escape_string($_POST['project_id']);

                $model->street_id = mysql_real_escape_string($_POST['street_id']);

                $model->plot_id = mysql_real_escape_string($_POST['plot_id']);

                $model->plot_size = mysql_real_escape_string($_POST['plot_size']);

                $model->cnic = mysql_real_escape_string($_POST['cnic']);

                $model->create_date = date('Y-m-d h:i:s');

                try {

                    $model->save();
                } catch (Exception $e) {

                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
            } else {

                echo json_encode(array($error, $_POST));
            }

            exit;
        }
    }

    function actionEdit() {

        if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = 'column3';

            $this->render('edit_register');
        }
    }

    public function actionDownload() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $plot_id = $_GET['id'];
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_member = "SELECT
members.id
,memberplot.allotment_letter_al
,memberplot.ms_letter
,memberplot.allotment_letter
,memberplot.allotment_certificate
,memberplot.transfer_letter
,memberplot.ndc_letter
,memberplot.transfer_slip
,memberplot.balloting_detail
,memberplot.id as mpid
,memberplot.plotno
,memberplot.status as mpstatus
, members.name
,members.sodowo
, members.cnic
,members.title
, members.address
, members.dob
, members.email
, members.phone
, members.image
, members.nomineename
,members.city_id
,plots.street_id
,plots.id as plot_id
,plots.type
,plots.atype
,plots.plot_size
,plots.com_res
,plots.sector
,plots.size2
,plots.ctag
,projects.project_name
,size_cat.size
,plots.plot_detail_address
,tbl_landowner.name as landowner
,memberplot.create_date
,memberplot.app_no
,streets.street
,sectors.sector_name
 ,blocks.block_name
 ,dealer.name as dealername
 ,assoc.name as assocname
,assoc.sodowo as assocsodowo
,assoc.title as assoctitle
FROM
memberplot
LEFT JOIN members
ON (memberplot.member_id = members.id )
left join plots on memberplot.plot_id=plots.id
left join projects on plots.project_id=projects.id
left join sectors on plots.sector=sectors.id
left join size_cat on plots.size2=size_cat.id
left join streets on plots.street_id=streets.id
left join tbl_landowner on tbl_landowner.id=memberplot.lo_id
left join blocks on plots.block_id=blocks.id
Left JOIN members dealer ON dealer.id=memberplot.dealer_id
Left JOIN  associates ON associates.msid=memberplot.id
Left JOIN  members assoc ON assoc.id=associates.mid

where memberplot.status='Approved' and memberplot.plot_id=" . $plot_id;
            $member_result = $connection->createCommand($sql_member)->queryAll();
            $this->render('pdf', array('member' => $member_result));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionDownload111() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $plot_id = $_GET['id'];
            $this->layout = '//layouts/back';
            $connection = Yii::app()->db;
            $sql_member = "SELECT
        members.id
        ,memberplot.id as mpid
        ,memberplot.plotno
	    ,members.name
        ,members.sodowo
        ,members.cnic
        ,members.title
        ,members.address
        ,members.dob
        ,members.email
        ,members.phone
        ,members.image
        ,members.nomineename
    	,members.city_id
	    ,plots.street_id
	    ,plots.id as plot_id
	,plots.type
	,plots.atype
	,plots.plot_size
	,plots.com_res
	,plots.sector

	,plots.size2
         ,projects.project_name
	,size_cat.size
       
	,plots.plot_detail_address
    ,tbl_landowner.name as landowner
	,memberplot.create_date
	,streets.street
	,sectors.sector_name

	FROM

    memberplot

    LEFT JOIN members 

        ON (memberplot.member_id = members.id ) 

		left join plots on memberplot.plot_id=plots.id
                left join projects on plots.project_id=projects.id
		left join sectors on plots.sector=sectors.id
		left join size_cat on plots.size2=size_cat.id
		left join streets on plots.street_id=streets.id
        left join tbl_landowner on tbl_landowner.id=memberplot.lo_id
		where memberplot.plot_id=" . $plot_id;

            $member_result = $connection->createCommand($sql_member)->queryAll();

            $this->render('pdf', array('member' => $member_result));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    } 
    public function actionApi($id) {
        $connection = Yii::app()->db;
        $sql_plot = "SELECT * from members where id='".$id."'";

        $result_plots = $connection->createCommand($sql_plot)->query();

        $plot = array();

        foreach ($result_plots as $plo) {

            $plot[] = $plo;
            print_r($plo) ;
     }
    }
    public function actionAjaxRequest7($val1, $pro) {

        $connection = Yii::app()->db;

        $sql_plot = "SELECT * from installment_plan where category_id='" . $val1 . "' and project_id='" . $pro . "' ";

        $result_plots = $connection->createCommand($sql_plot)->query();

        $plot = array();

        foreach ($result_plots as $plo) {

            $plot[] = $plo;
        }



        echo json_encode($plot);
        exit();
    }

    public function actionProjectcode($val1) {

        $connection = Yii::app()->db;

        $sql_plot = "SELECT * from projects where id='" . $val1 . "' ";

        $result_plots = $connection->createCommand($sql_plot)->query();

        $plot = array();

        foreach ($result_plots as $plo) {

            $plot[] = $plo;
        }



        echo json_encode($plot);
        exit();
    }

    public function actionSizecode($size) {

        $connection = Yii::app()->db;

        $sql_plot = "SELECT * from size_cat where id='" . $size . "' ";

        $result_plots = $connection->createCommand($sql_plot)->query();

        $plot = array();

        foreach ($result_plots as $plo) {

            $plot[] = $plo;
        }



        echo json_encode($plot);
        exit();
    }

    public function actionTransferplot() {
        if (isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = '//layouts/back';
            $plotid = $_GET['plot_id'];
            $connection = Yii::app()->db;
            $sql_plotedtails = "SELECT j.code
	,siz.code as scode,mp.member_id,mp.plotno,mp.create_date,mp.mmtype, m.name,m.name,m.sodowo,m.cnic,p.id   plot_id,p.plot_detail_address,p.plot_size,p.com_res,s.street, j.project_name 
FROM memberplot mp 
left join members m on mp.member_id=m.id left
 join plots p on mp.plot_id=p.id
 join size_cat siz on p.size2=siz.id 
 left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id 
   WHERE p.id ='" . $plotid . "' ";
            $plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
            $this->render('transferplot', array('plotdetails' => $plotdetails));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionCrequest() {

        $error = '';

        $connection = Yii::app()->db;

        $sql1 = "UPDATE plots set status='Alotted' WHERE id='" . $_REQUEST['plot_id'] . "' ";
        $command = $connection->createCommand($sql1);
        $command->execute();
        $sql = "DELETE FROM transferplot WHERE plot_id='" . $_REQUEST['plot_id'] . "'  ";

        $command = $connection->createCommand($sql);
        $command->execute();

        $this->redirect(array('memberplot/member_lis'));
    }

    public function actionRequestTransfer() {

        $error = '';

        $connection = Yii::app()->db;
        $base = $_POST['cnic'];
        $uid = Yii::app()->session['user_array']['id'];
        $sql = "SELECT * from members where cnic='" . $base . "'";
        $result_data = $connection->createCommand($sql)->queryRow();

        $sql1 = "SELECT * from transferplot where plot_id='" . $_POST['plot_id'] . "' and status='New Request'";
        $result_data1 = $connection->createCommand($sql1)->queryRow();
        if (!empty($result_data1) && ($result_data1['status'] != 'Rejected')) {

            $error = "Already Requested. <br>";
        }

        if ((isset($base) && empty($base))) {
            $error = "CNIC required. <br>";
        } elseif (empty($result_data)) {
            $error .= 'Applicant Containing ' . $base . ' CNIC is Not Register Member <br>';
        } elseif ($result_data['status'] != 1) {
            $error .= 'Applicant Containing ' . $base . ' CNIC is Not Active Register Member.<br>';
        }

        if ((isset($_POST['tempms']) && strlen(trim($_POST['tempms'])) < 1)) {
            $error .= "Enter Membership No. <br>";
        }
        if (!isset($_POST['procode'])) {
            $_POST['procode'] = '';
            $_POST['sizecode'] = '';
        }
        $pn = $_POST['procode'] . '-' . $_POST['tempms'] . '-' . $_POST['sizecode'];
        if (!empty($pn)) {

            $q = "SELECT * from memberplot where plotno='" . $pn . "'";
            $result_q = $connection->createCommand($q)->queryRow();
            if ($result_q['plotno'] == $pn) {

                $error .= "Membership # Already Added Try Another. <br>";
            }
        }
        if (!empty($error)) {
            echo $error;
            exit;
        } else {
            $transferto_memberid = $result_data['id'];

            $sql = "INSERT INTO transferplot SET plot_id='" . $_POST['plot_id'] . "',uid='" . $uid . "',transferfrom_id='" . $_POST['transfer_from_memberid'] . "',transferto_id='" . $transferto_memberid . "',status='New Request',cmnt='New Request',create_date='" . date('Y-m-d H:i:s') . "' ";
            $command = $connection->createCommand($sql);
            $command->execute();

            $sql1 = "UPDATE plots set status='Requested(T)' WHERE id='" . $_POST['plot_id'] . "' ";
            $command = $connection->createCommand($sql1);
            $command->execute();
            echo "Plot transfer request has been sent successfully ";
            echo '<form action="timage"  enctype="multipart/form-data" method="post"  >';
            echo'<input type="hidden" name="plot_id" value="' . $_POST['plot_id'] . '" />';
            echo '<input type="file" name="image">
										<input type="submit" name="upload" value="Upload">
										</form>';
        }
    }

    public function actionTimage() {

        $connection = Yii::app()->db;
//echo $_FILES['image1']['name'];
        //echo $_POST['plot_id'];exit;
        $path = "images/imagetransfer/";
        $image = $_POST['plot_id'] . $_FILES['image1']["name"];
        $newfilename = $_POST['plot_id'] . $_FILES['image1']["name"];
        $sql = "UPDATE transferplot SET `image`='" . $newfilename . "' WHERE plot_id=" . $_POST['plot_id'];
        $command = $connection->createCommand($sql);
        $command->execute();
        move_uploaded_file($_FILES['image1']["tmp_name"],
                $path . $image);

        $this->redirect('member_flis');
    }

    public function actionAlotaplot() {


        if (Yii::app()->session['user_array']['per2'] == '1') {
            $error = '';

            //$error =array();

            $connection = Yii::app()->db;

            $base = $_POST['cnic'];
            $sql = "SELECT * from members where cnic='" . $base . "'";
            $result_data = $connection->createCommand($sql)->queryRow();
            $dealer = '';

            if (isset($_POST['mtype'])) {
                if ($result_data['mtype'] !== 'Dealer') {
                    $error .= 'Applicant Containing ' . $base . ' CNIC is Not a Dealer and not authorized to purchase plot For Resale  <br>';
                }
                $dealer = $_POST['mtype'];
            }

            if ((isset($base) && empty($base))) {
                $error = "CNIC required. <br>";
            } elseif (empty($result_data)) {
                $error .= 'Applicant Containing ' . $base . ' CNIC is Not Register Member <br>';
            } elseif ($result_data['status'] != 1) {
                $error .= 'Applicant Containing ' . $base . ' CNIC is Not Active Register Member.<br>';
            }

            if ((isset($_POST['plot_id']) && empty($_POST['plot_id']))) {
                $error .= "Plot No Required. <br>";
            }

            if ((isset($_POST['project']) && empty($_POST['project']))) {
                $error .= "Please Select Project. <br>";
            }
            if ((isset($_POST['street_id']) && empty($_POST['street_id']))) {
                $error .= "Please Select Street <br>";
            }
            if ((isset($_POST['appnoo']) && empty($_POST['appnoo']))) {

                $error .= "Application # Required. <br>";
            }
            if ((isset($_POST['noi']) && empty($_POST['noi']))) {

                $error .= "No.Of Installment required. <br>";
            }
            if (!empty($_POST['noi'])) {
                $noi = '';
                $noi = $_POST['noi'];
                if ($noi <= 0) {
                    $error .= "No.Of Installment Must be 1 or More . <br>";
                }
            }
            if ((isset($_POST['insplan']) && empty($_POST['insplan']))) {

                $error .= "Installment Plan required. <br>";
            }


            if ((isset($_POST['plotno']) && empty($_POST['plotno']))) {

                $error .= "Plot Membership No required. <br>";
            }

            $pn = $_POST['procode'] . '-' . $_POST['plotno'] . '-' . $_POST['sizecode'];
            if (!empty($pn)) {
                $q = "SELECT * from memberplot where plotno='" . $pn . "'";
                $result_q = $connection->createCommand($q)->queryRow();
                if ($result_q['plotno'] == $pn) {
                    $error .= "Membership # Already Added Try Another. <br>";
                }
            }
            $q = "SELECT * from memberplot left join plots on plots.id=memberplot.plot_id where memberplot.app_no='" . $_POST['appnoo'] . "' and plots.project_id='" . $_POST['project'] . "'";
            $result_q = $connection->createCommand($q)->queryRow();
            if (!empty($result_q)) {
                $error .= "Application # Already Added Try Another. <br>";
            }
            if (empty($error)) {


                $uid = Yii::app()->session['user_array']['id'];

                $sql = "INSERT INTO memberplot (app_no,plot_id,user_name,member_id,lo_id,create_date,mmtype,noi,insplan,status,plotno,uid) 

	VALUES ('" . $_POST['appnoo'] . "','" . $_POST['plot_id'] . "','" . $uid . "','" . $result_data['id'] . "','" . $_POST['landowner'] . "','" . date('Y-m-d H:i:s') . "','" . $dealer . "','" . $_POST['noi'] . "','" . $_POST['insplan'] . "','New','" . $pn . "','" . Yii::app()->session['user_array']['id'] . "')";

                $command = $connection->createCommand($sql);
                $command->execute();
                $insert_id = Yii::app()->db->getLastInsertID();

                $discount = "INSERT INTO discnt (ms_id,status,details,discount)VALUES ('" . $insert_id . "','New','" . $_POST['discd'] . "','" . $_POST['disc'] . "')";
                $command = $connection->createCommand($discount);
                $command->execute();

                $sql_cat = "SELECT * from cat_plot where plot_id='" . $_POST['plot_id'] . "'";
                $result_cat = $connection->createCommand($sql_cat)->queryAll();
                foreach ($result_cat as $new) {
                    $sql1 = "SELECT * from charges where type='" . $new['cat_id'] . "'";
                    $result1 = $connection->createCommand($sql1)->queryRow();
                    $plot = "SELECT * from plots where id='" . $_POST['plot_id'] . "'";
                    $plots = $connection->createCommand($plot)->queryRow();
                    $chargess = $plots['price'] / 100 * $result1['total'];
                    /// $sqlcharges="INSERT INTO plotpayment SET payment_type='".$result1['name']."',amount='".$chargess."', duedate='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";							
                    $sqlcharges = "INSERT INTO plotpayment SET payment_type='" . $result1['name'] . "',amount='" . $chargess . "', due_date_temp='" . $_POST['date'] . "', plot_id='" . $_POST['plot_id'] . "',mem_id='" . $result_data['id'] . "'";

                    $command = $connection->createCommand($sqlcharges);
                    $command->execute();
                }
                $sql_cat12 = "SELECT * from charges where name LIKE '%MS Fee%'";
                $result_cat12 = $connection->createCommand($sql_cat12)->queryRow();
                if ($result_cat12 !== '') {
                    ///$sqlchargesm="INSERT INTO plotpayment SET payment_type='MS Fee',amount='".$result_cat12['total']."', duedate='".$_POST['date']."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'";							
                    $sqlchargesm = "INSERT INTO plotpayment SET payment_type='MS Fee',amount='" . $result_cat12['total'] . "', due_date_temp='" . $_POST['date'] . "', plot_id='" . $_POST['plot_id'] . "',mem_id='" . $result_data['id'] . "'";
                    $command = $connection->createCommand($sqlchargesm);
                    $command->execute();
                }

                $update = "UPDATE plots set status='Requested', atype='" . $_POST['atype'] . "' WHERE id='" . $_REQUEST['plot_id'] . "'";

                $command = $connection->createCommand($update);
                $command->execute();
                $sqlinstalplan = "SELECT * from installment_plan where id='" . $_POST['insplan'] . "'";
                $dataplan = $connection->createCommand($sqlinstalplan)->queryRow();

                $tno = $_POST['noi'];
                $insplan = $dataplan['tno'];
                $insert = 0;
                $create = $_POST['date'];
                $instalno = 0;
                $lab = 0;

                do {
                    $lab++;
                    $instalno++;

                    $tno = $_POST['noi'];

                    //if($instalno==1){$tno=$tno+1;}
                    ///	 $sqlinstall="INSERT INTO installpayment SET lab='".$dataplan['lab'.$lab.'']."',dueamount='".$dataplan[''.$instalno.'']."', due_date='".$create."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'"; 
                    ///	$next_due_date = strtotime($create.' + '.$tno.' Months');

                    $sqlinstall = "INSERT INTO installpayment SET lab='" . $dataplan['lab' . $lab . ''] . "',dueamount='" . $dataplan['' . $instalno . ''] . "', due_date_temp='" . $create . "', plot_id='" . $_POST['plot_id'] . "',mem_id='" . $result_data['id'] . "'";
                    $next_due_date = strtotime($create . ' + ' . $tno . ' Months');
                    $create = date('Y-m-d', $next_due_date);
                    $command = $connection->createCommand($sqlinstall);
                    $command->execute();
                    $insert++;
                } while ($insert < $insplan);

                echo 'Plot Allotment Request Sent For Verification';
                exit;
            } else if (!empty($error)) {

                echo $error;
            }
        }
    }

    public function actionInstalment() {

        if (Yii::app()->session['user_array']['per2'] == '1') {


            $error = array();
            $error = '';

            if ((isset($_POST['payment-type']) && empty($_POST['payment-type'])) || (isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['member_id']) && empty($_POST['member_id'])) || (isset($_POST['amount']) && empty($_POST['amount'])) || (isset($_POST['paid-as']) && empty($_POST['paid-as'])) || (isset($_POST['detail']) && empty($_POST['detail'])) || (isset($_POST['date']) && empty($_POST['date']))) {

                $error = 'Please complete all required fields <br />';
            }

            if (empty($error)) {

                // Insert in to member a new member

                $connection = Yii::app()->db;

                $sql = 'INSERT INTO plotpayment  (payment_type, plot_id, mem_id, amount,discount, paidas, detail, surcharge, date, create_date ) VALUES ("' . $_POST['payment_type'] . '","' . $_POST['plot_id'] . '", "' . $_POST['member_id'] . '", "' . $_POST['amount'] . '", "' . $_POST['discount'] . '",  "' . $_POST['paid-as'] . '", "' . $_POST['detail'] . '", "' . $_POST['surcharge'] . '", "' . $_POST['date'] . '", "' . date('Y-m-d h:i:s') . '")';
                $command = $connection->createCommand($sql);

                $command->execute();
                echo $note = "Payment Added Successfully";
            }
            if (!empty($error)) {
                echo $error;
            }
        }
    }

    ////////////////////////////////////////PLOT CHARGES FUNCTION////////////////////

    public function actioncharge() {

        if (Yii::app()->session['user_array']['per2'] == '1') {



            $error = array();
            $error = '';

            if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['duedate']) && empty($_POST['duedate'])) || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment'])) || (isset($_POST['total']) && empty($_POST['total']))) {

                $error = 'Please complete all required fields <br />';
            }

            if (empty($error)) {
                $connection = Yii::app()->db;
                $sqlchrgesdetail = 'Select * from charges where id="' . $_POST['charges_id'] . '"';
                $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
                /// $sql  = 'INSERT INTO plotpayment  (plot_id,mem_id,payment_type,amount, remarks,duedate) VALUES ("'.$_POST['plot_id'].'","'.$_POST['mems'].'","'.$resultcharges['name'].'", "'.$_POST['total'].'","'.$_POST['comment'].'","'.$_POST['duedate'].'")';                      
                $sql = 'INSERT INTO plotpayment  (plot_id,mem_id,payment_type,amount, remarks,due_date_temp) VALUES ("' . $_POST['plot_id'] . '","' . $_POST['mems'] . '","' . $resultcharges['name'] . '", "' . $_POST['total'] . '","' . $_POST['comment'] . '","' . $_POST['duedate'] . '")';
                $command = $connection->createCommand($sql);
                $command->execute();
                echo "Charges Added Successfully";
            }

            if (!empty($error)) {
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

      } */

    public function actionDelete($id) {

        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionDelete_Ins() {
        if (Yii::app()->session['user_array']['per3'] == '1') {
            if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

                $connection = Yii::app()->db;
                $sql_del = "DELETE from installpayment where id=" . $_GET['did'];
                $command = $connection->createCommand($sql_del);
                $command->execute();
                $this->redirect(array('memberplot/installment_details?id=' . $_GET['id'] . ''));
            } else {

                $this->redirect(array('user/user'));
            }
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionDelete_Charges() {
        if (Yii::app()->session['user_array']['per3'] == '1') {
            if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

                $connection = Yii::app()->db;
                $sql_del = "DELETE from plotpayment where id=" . $_GET['id'];
                $command = $connection->createCommand($sql_del);
                $command->execute();
                $this->redirect(array('memberplot/payment_details?id=' . $_GET['pid'] . ''));
            } else {

                $this->redirect(array('user/user'));
            }
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionIndex() {



        if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

            $this->redirect(array('datasource'));
        } else {

            $error = '';

            $layout = '//layouts/column1';

            $this->render('index');
        }
    }

    public function actionSearch_memberplot() {



        if (Yii::app()->session['user_array']['per2'] == '1') {



            $connection = Yii::app()->db;

            $sql_project = "SELECT * from projects";

            $result_projects = $connection->createCommand($sql_project)->query();

            $this->render('search_memberplot', array('projects' => $result_projects));
        } else {

            $this->redirect('dashboard');
        }
    }

    public function actionAjaxRequest3($val1) {

        $connection = Yii::app()->db;

        $sql_city = "SELECT * from tbl_city where country_id='" . $val1 . "'";

        $result_city = $connection->createCommand($sql_city)->query();

        $city = array();

        foreach ($result_city as $cit) {

            $city[] = $cit;
        }



        echo json_encode($city);
        exit();
    }

    public function actionAjaxRequest12($val1) {

        $connection = Yii::app()->db;

        $sql_city = "SELECT * from sectors where project_id='" . $val1 . "'";

        $result_city = $connection->createCommand($sql_city)->query();

        $city = array();

        foreach ($result_city as $cit) {

            $city[] = $cit;
        }



        echo json_encode($city);
        exit();
    }

    public function actionPayment() {

        if (Yii::app()->session['user_array']['per2'] == '1') {



            $this->layout = '//layouts/back';

            $connection = Yii::app()->db;

            $sql_projects = "SELECT * from plothistory where transferfrom_id='" . $_REQUEST['id'] . "'";

            $result_projects = $connection->createCommand($sql_projects)->query();

            $sql_page = "SELECT mp.member_id,mp.create_date, m.name,m.username,m.sodowo,m.cnic, m.address,p.id   ,mp.plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 

FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id 

WHERE plot_id ='" . $_REQUEST['id'] . "'";

            $result_pages = $connection->createCommand($sql_page)->query();

            $sql_charges = "SELECT * from charges where project_id='" . $_REQUEST['pid'] . "'";

            $result_charges = $connection->createCommand($sql_charges)->query();

            $this->render('payment', array('projects' => $result_projects, 'pages' => $result_pages, 'charges' => $result_charges));
        }
    }

    ///////////////////////////PLOT CHARGES////////////////////



    public function actionPlotcharges() {
        if ((Yii::app()->session['user_array']['per3'] == '1') && isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = '//layouts/back';

            $connection = Yii::app()->db;

            $plot_id = $_REQUEST['id'];

            $sql_charges = "SELECT * from charges where project_id='" . $_REQUEST['pid'] . "'";
            $result_charges = $connection->createCommand($sql_charges)->query();

            $sql_plots = "SELECT * from plots where id='" . $plot_id . "'";
            $result_plots = $connection->createCommand($sql_plots)->query();
            $mem = "SELECT * from memberplot where plot_id='" . $plot_id . "'";
            $mems = $connection->createCommand($mem)->queryRow();

            $this->render('plotcharges', array('plots' => $result_plots, 'charges' => $result_charges, 'mem' => $mems));
        } else {
            $this->redirect(array('user/dashboard'));
        }
    }

    //////////////////////////////////////////////////////////////



    public function actionMemberplot() {

        if (Yii::app()->session['user_array']['per2'] == '1') {



            $connection = Yii::app()->db;
            $sqllo = "Select * from tbl_landowner where status=1";
            $reslo = $connection->CreateCommand($sqllo)->query();
            $sql_country = "SELECT * from tbl_country";
            $result_country = $connection->createCommand($sql_country)->query();

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

            $sql_plan = "SELECT ip.*,p.project_name from installment_plan ip
		left join projects p on ip.project_id=p.id
		
		 ";
            $result_plan = $connection->createCommand($sql_plan)->query();

            $this->render('memberplot', array('projects' => $result_projects, 'country' => $result_country, 'plan' => $result_plan, 'landowner' => $reslo));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionAllotplot() {

        if (Yii::app()->session['user_array']['per2'] == '1') {



            $connection = Yii::app()->db;

            $sql_country = "SELECT * from tbl_country";

            $result_country = $connection->createCommand($sql_country)->query();

            $sql_project = "SELECT * from projects";

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
	Left JOIN categories  ON (plots.category_id = categories.id) where type='plot' and plots.id='" . $_REQUEST['id'] . "'";

            //	  $sql = "SELECT * from plots where type='plot' and id='".$_REQUEST['id']."'";

            $result = $connection->createCommand($sql)->query();
            $sql_plotss = "SELECT * from plots where id='" . $_REQUEST['id'] . "'";
            $result_plotss = $connection->createCommand($sql_plotss)->queryRow();
            $sql_plan = "SELECT * from installment_plan where project_id='" . $_REQUEST['pro'] . "' and category_id='" . $result_plotss['size2'] . "'";
            $result_plan = $connection->createCommand($sql_plan)->query();
            $this->render('allotplot', array('plot' => $result, 'projects' => $result_projects, 'country' => $result_country, 'plan' => $result_plan));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionMember_list() {

        if (Yii::app()->session['user_array']['per2'] == '1') {



            $connection = Yii::app()->db;

            $sql_member = "SELECT mp.member_id,mp.create_date, m.name,m.sodowo,m.cnic,p.plot_detail_address,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id where p.type='plot' and mp.status='Approved'";

            $result_members = $connection->createCommand($sql_member)->query();

            $this->render('member_list', array('members' => $result_members));
        } else {

            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionSearchreq() {
        $where='is_property=0';
        $and='And ';
        if (isset($_POST['type']) && $_POST['type'] != "") {
            $type = $_POST['type'];
            if($type=="Plot" || $type!="file"|| $type=="Villa" )
                {
                    $where .= "p.type ='" . $_POST['type'] . "'";
                    $and = true;
                }
            
        }
        /*if (!empty($_POST['type'])) {
            $where .= "p.type LIKE '%" . $_POST['type'] . "%'";
            $and = true;
        } else {
            $where .= "p.type !='file'";
            $and = true;
        }*/
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
    p.atype,
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
	,cp.status as cpstatus
FROM
    memberplot mp

LEFT JOIN members m ON mp.member_id = m.id
LEFT JOIN plots p ON mp.plot_id = p.id
LEFT JOIN transferplot tp ON p.id = tp.id
LEFT JOIN streets s ON p.street_id = s.id
LEFT JOIN projects j ON p.project_id = j.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join cancelplot cp on cp.plot_id=p.id
where $where";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		
        $connection = Yii::app()->db;
        $sql_member = "SELECT mp.dealer_id,mp.lo_id,cp.status as cpstatus,mortg.status as mortgstatus,mp.status as mpstatus,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.atype,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
left join mortgaged_plots mortg on p.id=mortg.plot_id
left join cancelplot cp on cp.plot_id=p.id

where  $where  ORDER BY mp.plotno ASC limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;

        if ($result_members != '') {

            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();

            foreach ($result_members as $key) {

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

                if (!empty($key['cpstatus']) && ($key['cpstatus'] == 'New')) {
                    echo'<tr style=" font-weight:bold;color:red;"><td style=" font-weight:bold;color:red;">';

                    if (empty($key['plotno'])) {
                        echo 'App-' . $key['app_no'];
                    } else {
                        echo $key['plotno'];
                    }

                    echo'</td>
			 <td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['name'] . '</td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td>' . $key['size'] . '&nbsp;(' . $key['plot_size'] . ')</td><td><strong>' . $key['plot_detail_address'] . '</strong><td>' . $key['street'] . '</td><td>' . $key['sector_name'] . '</td><td>' . $key['project_name'] . '</td><td>Requested for cancellation</td>';
                } else {
                    echo '<tr>
			 <td style=" font-weight:bold;color:' . $msco . ';">';
                    if (empty($key['plotno'])) {
                        echo 'App-' . $key['app_no'];
                    } else {
                        echo $key['plotno'];
                    }
                    if (!empty($key['mortgstatus'])) {
                        echo'<img src="/images/mortgage.png" width="100" height="130" />';
                    }
                    echo'</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td>
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
                        echo $key['street'];
                    } echo '</td>
				  <td>';
                    if ($key['stst'] == 2) {
                        echo'<span style="color:red">Blocked</span>';
                    } else {
                        echo $key['sector_name'];
                    }echo'</td>
				  <td>' . $key['project_name'] . '</td><td>
			  <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a></li>';
                    if($key['type'] =='Plot') {
                        echo'<li role="presentation"><a target="_blank" href="change_plot_type?id=' . $key['plot_id'] . '&& msid=' . $key['msid'] . '">Plot Type</a></li>';
                    }
                    if (Yii::app()->session['user_array']['per32'] == '1') {
                        echo'<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/member/ms_status?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Update Status</a></li>';
                    }
                    if (Yii::app()->session['user_array']['per33'] == '1') {
                        if ($key['cpstatus'] == 'New') {
                            echo'<li role="presentation"><span style="color:red">Cancellation Requested</span></li>';
                        } else {
                            echo'<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/memberplot/cancelplot?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Cancellation</a></li>';
                        }
                    }
                    echo'<li role="presentation"><a target="_blank" href="payment_details?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a></li>';
                    if ($key['mpstatus'] == 'Approved') {
                        echo'<li role="presentation"><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a></li>';
                    }

                    echo'<li role="presentation"><a target="_blank" href="reallocate?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Reallocation</a></li>';
                    echo '<li role="presentation"><a target="_blank" href="mortgage?plot_id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Mortgage Plot</a></li>';
                    if (Yii::app()->session['user_array']['id'] == '1') {
                        echo '<li role="presentation"><a target="_blank" href="deallocate?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Deallocation</a></li>';
                    }
                    if($key['atype'] == 'Against Land') {
                        echo'<li role="presentation"><a target="_blank" href="landowner?id=' . $key['plot_id'] . '&& msid=' . $key['msid'] . '">Landowner</a></li>';
                    }
                    if($key['dealer_id'] == '0') {
                        echo'<li role="presentation"><a target="_blank" href="dealer?id=' . $key['plot_id'] . '&& msid=' . $key['msid'] . '">Add Dealer</a></li>';
                    }
                  
                        
                   
                    $sqltest = "SELECT * FROM  plots where id='" . $key['plot_id'] . "'  ";
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
                    if (empty($key['mortgstatus'])) {
                        foreach ($resulttest as $test) {
                            if ($test['status'] == 'Requested(T)') {
                                echo '<li role="presentation"><a  href="' . $home . '/index.php/memberplot/treq_detail?id=' . $key['plot_id'] . '">Transfer Details</a></li>';
                            }
                            if ($test['status'] == 'Alotted') {
                                echo '<li role="presentation"><a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '"> Transfer Plot</a></li>';
                            }
                        }
                    }
                    echo'
 
<li role="presentation"><a href="amembers?mid=' . $key['msid'] . '">Associates Member</a></li>

<li role="presentation"><a href="updatemember_plot?id=' . $key['plot_id'] . '">Update Membership</a></li>
  </ul></div>
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
        } else {
            echo '';
        }
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

    ////////////////////TRANSFER DETAIL//////////////
   
    public function actionAjaxRequest32($val1) {
        $connection = Yii::app()->db;
        $sql_city = "SELECT * from installpayment where id='" . $val1 . "' ";
        $result_city = $connection->createCommand($sql_city)->query();
        $city = array();

        foreach ($result_city as $cit) {
            $city[] = $cit;
        }
        echo json_encode($city);
        exit();
    }

    public function actioncharget() {

        if (isset(Yii::app()->session['user_array']['username'])) {



            $error = array();
            $error = '';

            if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['date']) && empty($_POST['date'])) || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['total']) && empty($_POST['total'])) || (isset($_POST['paidamount']) && empty($_POST['paidamount'])) || (isset($_POST['paidas']) && empty($_POST['paidas'])) || (isset($_POST['detail']) && empty($_POST['detail']))) {

                $error = 'Please complete all required fields <br />';
            }

            if (empty($error)) {
                $connection = Yii::app()->db;
                $sqlchrgesdetail = 'Select * from charges where id="' . $_POST['charges_id'] . '"';
                $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
                $sql = 'INSERT INTO plotpayment  (
					  plot_id,payment_type,amount,paidamount,mem_id,detail,paidas, remarks,date) VALUES ("' . $_POST['plot_id'] . '","' . $resultcharges['name'] . '","' . $_POST['total'] . '","' . $_POST['paidamount'] . '","' . $_POST['mem'] . '","' . $_POST['detail'] . '", "' . $_POST['paidas'] . '", "' . $_POST['remarks'] . '","' . $_POST['date'] . '")';
                $command = $connection->createCommand($sql);
                $command->execute();
                echo "Charges Added Successfully";
            }

            if (!empty($error)) {
                echo $error;
            }
        }
    }

    public function actionInstallt() {

        if (Yii::app()->session['user_array']['per12'] == '1') {



            $error = array();
            $error = '';

            if ((isset($_POST['plot_id']) && empty($_POST['plot_id'])) || (isset($_POST['date']) && empty($_POST['date'])) || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['remarks']) && empty($_POST['remarks'])) || (isset($_POST['paidamount']) && empty($_POST['paidamount'])) || (isset($_POST['paidas']) && empty($_POST['paidas'])) || (isset($_POST['detail']) && empty($_POST['detail']))) {

                $error = 'Please complete all required fields <br />';
            }

            if (empty($error)) {
                $connection = Yii::app()->db;
                $sql = 'UPDATE installpayment SET 
					  paidamount= "' . $_POST['paidamount'] . '",
					  mem_id="' . $_POST['mem'] . '",
					  detail="' . $_POST['detail'] . '",
					  paidas="' . $_POST['paidas'] . '", 
					  remarks="' . $_POST['remarks'] . '",
					  paid_date="' . $_POST['date'] . '" where id="' . $_POST['charges_id'] . '"';
                $command = $connection->createCommand($sql);
                $command->execute();
                echo "Installment Updated Successfully";
            }

            if (!empty($error)) {
                echo $error;
            }
        }
    }

    public function actionPlotchargest() {

        $this->layout = '//layouts/back';

        $connection = Yii::app()->db;

        $plot_id = $_REQUEST['id'];

        $sql_charges = "SELECT * from charges where project_id='" . $_REQUEST['pid'] . "'";
        $result_charges = $connection->createCommand($sql_charges)->query();

        $sql_plots = "SELECT * from plots where id='" . $plot_id . "'";
        $result_plots = $connection->createCommand($sql_plots)->query();

        $this->render('plotchargest', array('plots' => $result_plots, 'charges' => $result_charges));
    }

    public function actionPlotinstallt() {

        $this->layout = '//layouts/back';

        $connection = Yii::app()->db;

        $plot_id = $_REQUEST['id'];

        $sql_charges = "SELECT * from installpayment where plot_id='" . $plot_id . "'";
        $result_charges = $connection->createCommand($sql_charges)->queryAll();

        $sql_plots = "SELECT * from plots where id='" . $plot_id . "'";
        $result_plots = $connection->createCommand($sql_plots)->query();

        $this->render('plotinstallt', array('plots' => $result_plots, 'charges' => $result_charges));
    }

    ////////////////////TRANSFER DETAIL//////////////
    public function actionTreq_detail() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_details = "SELECT tp.*,tp.id as tpid,mp.tempms,mp.plot_id,mp.plotno,s.street,p.plot_detail_address,p.plot_size,sc.size,mp.comment,se.sector_name,pro.project_name,m_from.name from_name,m_to.name to_name 
			,m_to.cnic,m_to.address,m_to.sodowo,u.email,u.firstname,m_to.state,p.project_id,m_to.phone as m_to_phone,m_from.phone as m_from_phone
			FROM transferplot tp
Left JOIN members m_from ON m_from.id=tp.transferfrom_id
			Left JOIN members m_to ON m_to.id=tp.transferto_id
			Left JOIN plots p ON p.id=tp.plot_id
			Left JOIN sectors se ON se.id=p.sector
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat sc ON sc.id=p.size2
			Left JOIN memberplot mp ON p.id=mp.plot_id
			left join user u on tp.uid=u.id
			Left JOIN projects pro ON pro.id=p.project_id where tp.plot_id=" . $_REQUEST['id'] . " and tp.status!='Approved'";
            $result_details = $connection->createCommand($sql_details)->query();
            $this->render('treq_detail', array('plotdetails' => $result_details));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionCrequest11() {

        $error = '';

        $connection = Yii::app()->db;

        $sql1 = "UPDATE plots set status='Alotted' WHERE id='" . $_REQUEST['pid'] . "' ";
        $command = $connection->createCommand($sql1);
        $command->execute();
        $sql = "DELETE FROM transferplot WHERE plot_id='" . $_REQUEST['pid'] . "'  ";

        $command = $connection->createCommand($sql);
        $command->execute();

        $this->redirect(Yii::app()->baseUrl . '/index.php/memberplot/member_flis');
    }

    public function actionSearchreqf() {
        $where = '';

        $and = false;
        if (!empty($_POST['name1'])) {
            $where .= " m.name LIKE '%" . $_POST['name1'] . "%'";
            $and = true;
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

            if ($_POST['allotmentstatus'] == 4) {
                if ($and == true) {
                    $where .= " and mp.mstatus=2";
                } else {
                    $where .= " mp.mstatus=0";
                }
            }
            $and = true;
        }
        if (!empty($_POST['project_name'])) {
            if ($and == true) {
                $where .= " AND p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            } else {
                $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
            }
            $and = true;
        }
        if (isset($_POST['com_res']) && $_POST['com_res'] != "") {

            $where .= "and p.com_res LIKE '%" . $_POST['com_res'] . "%'";

            $and = true;

            $com_res = $_POST['com_res'];
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
                $where .= " and mp.plotno Like '%" . $_POST['plotno'] . "%'";
            } else {
                $where .= "mp.plotno Like '%" . $_POST['plotno'] . "%'";
            }
            $and == true;
        }
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
left join streets s on p.street_id=s.id
left join projects j on p.project_id=j.id
where  $where  and p.type='file'";
        $co = $connection->createCommand($sql_memberas)->query();
        $rows = count($co);
        //for Pagination end 		

        $connection = Yii::app()->db;
        $sql_member = "SELECT mp.dealer_id,cp.status as cpstatus,p.atype,mp.app_no,mp.member_id,mp.mstatus as stst,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,p.com_res,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size  FROM memberplot mp
left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join sectors sec on sec.id=p.sector
left join size_cat size_cat on size_cat.id=p.size2
left join cancelplot cp on cp.plot_id=p.id
left join projects j on p.project_id=j.id
where $where and p.type='file' ORDER BY mp.plotno ASC limit $start,$limit";

        $result_members = $connection->createCommand($sql_member)->query();

        $count = 0;

        if ($result_members != '') {

            $home = Yii::app()->request->baseUrl;
            $check = 1;
            $res = array();

            foreach ($result_members as $key) {
                $count++;
                $sql1t = "SELECT * from transferplot where plot_id=" . $key['plot_id'] . " and (status='New Request' or status='Sales')";

                $result_datat = $connection->createCommand($sql1t)->queryRow();
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
                if ((!empty($key['cpstatus'])) && ($key['cpstatus'] == 'New')) {
                    echo'<tr style=" font-weight:bold;color:red;"><td style=" font-weight:bold;color:red;">';

                    if (empty($key['plotno'])) {
                        echo 'App-' . $key['app_no'];
                    } else {
                        echo $key['plotno'];
                    } echo'</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['name'] . '</td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td>' . $key['size'] . '&nbsp;(' . $key['plot_size'] . ')</td><td><strong>' . $key['plot_detail_address'] . '</strong><td>' . $key['street'] . '</td><td>' . $key['sector_name'] . '</td><td>' . $key['project_name'] . '</td><td>Requested for cancellation</td>';
                } else {
                    echo '<tr><td style=" font-weight:bold;color:' . $msco . ';">';

                    if (empty($key['plotno'])) {
                        echo 'App-' . $key['app_no'];
                    } else {
                        echo $key['plotno'];
                    } echo'</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td>' . $key['size'] . '&nbsp;(' . $key['plot_size'] . ')</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '"><strong>' . $key['plot_detail_address'] . '</strong></a><td>' . $key['street'] . '</td><td>' . $key['sector_name'] . '</td><td>' . $key['project_name'] . '</td><td>';
                    if (Yii::app()->session['user_array']['per34'] == '1') {
                        echo'<a target="_blank" href="payment_details?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a>';
                    } else {
                        echo'<div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			 
			<li role="presentation"> <a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a></li>
			<li role="presentation"><a target="_blank" href="payment_details?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a></li>
			<li role="presentation"><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a></li>
			
            <li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/member/ms_status?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Update Status</a></li>
            ';
                        if ($key['cpstatus'] == 'New') {
                            echo'<li role="presentation"><span style="color:red">Cancellation Requested</span></li>';
                        } else {
                            echo'<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/memberplot/cancelplot?msid=' . $key['msid'] . '&& plot_id=' . $key['plot_id'] . '">Cancellation</a></li>';
                        }

                        echo '<li role="presentation">';
                        if ((!empty($result_datat['status'])) && ($result_datat['status'] == 'New Request')) {
                            echo '<a  href="' . $home . '/index.php/memberplot/treq_detail?id=' . $key['plot_id'] . '">Transfer Details</a>';
                        } else {
                            if ($key['status'] == 'Approved') {
                                echo'<a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '"> Transfer File</a>';
                            }
                        }
                        if ($key['atype'] == 'Against Land') {
                            echo'<li role="presentation"><a target="_blank" href="landowner?id=' . $key['plot_id'] . '&& msid=' . $key['msid'] . '">Landowner</a></li>';
                        }
                        if($key['dealer_id'] == '0') {
                            echo'<li role="presentation"><a target="_blank" href="dealer?id=' . $key['plot_id'] . '&& msid=' . $key['msid'] . '">Add Dealer</a></li>';
                        }
                        echo'</li><li role="presentation"><a href="updatemember_plot?id=' . $key['plot_id'] . '">Update Membership</a></li>
	   <li role="presentation"><a href="amembers?mid=' . $key['msid'] . '">Associates Member</a></li>
<li role="presentation"><a href="' . Yii::app()->baseUrl . '/index.php/allotments/edit_app?mid=' . $key['msid'] . '">Application Information</a></li>
                          </ul></div>';
                    }
                    echo'</td></tr>';
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
        } else {
            echo '';
        }

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

    public function actionLandowner() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_lo = "SELECT * from	tbl_landowner";
            $res_lo = $connection->createCommand($sql_lo)->query();
            $sql_details = "SELECT * from	tbl_landowner 
			 Left JOIN memberplot ON memberplot.lo_id=tbl_landowner.id
			 where memberplot.id=" . $_REQUEST['msid'] . "";
            $result_details = $connection->createCommand($sql_details)->query();
            $this->render('landowner', array('amemdetails' => $result_details,'lo' => $res_lo));
        } else {
            $this->redirect(array("dashboard"));
        }
    }
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
    public function actionAmembers() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            $sql_details = "SELECT * from	associates 
			 Left JOIN members ON members.id=associates.mid
			 where msid=" . $_REQUEST['mid'] . "";
            $result_details = $connection->createCommand($sql_details)->query();
            $this->render('amemdetails', array('amemdetails' => $result_details));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    public function actionAddlo() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $error = '';
            $lo='';
            $msid='';
            //$error =array();
            $connection = Yii::app()->db;
            if(isset($_POST['lo'])){$lo = $_POST['lo'];}
            if(isset($_POST['msid'])){$msid = $_POST['msid'];}

            if ((isset($lo) && empty($lo))) {
                $error = "Select Land Owner. <br>";
            } 
            if (empty($error)) {
                $uid = Yii::app()->session['user_array']['id'];
                $sql = "UPDATE memberplot set lo_id='" . $lo . "' where id='".$msid."'";
            $command = $connection->createCommand($sql);
            $command->execute();
            echo 'Land Owner Added Successfully';
                exit;
            } else if (!empty($error)) {

                echo $error;
            }
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
    public function actionAddamem() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $error = '';
            //$error =array();
            $connection = Yii::app()->db;
            $base = $_POST['cnic'];
            $sql = "SELECT * from members where cnic='" . $base . "'";
            $result_data = $connection->createCommand($sql)->queryRow();
            if ((isset($base) && empty($base))) {
                $error = "CNIC required. <br>";
            } elseif (empty($result_data)) {
                $error .= 'Applicant Containing ' . $base . ' CNIC is Not Register Member <br>';
            } elseif ($result_data['status'] != 1) {
                $error .= 'Applicant Containing ' . $base . ' CNIC is Not Active Register Member.<br>';
            }
            if (empty($error)) {
                $uid = Yii::app()->session['user_array']['id'];
                $sql = "INSERT INTO associates (msid,mid,uid,cdate) 
				VALUES ('" . $_POST['msid'] . "','" . $result_data['id'] . "','" . $uid . "','" . date('Y-m-d H:i:s') . "')";
                $command = $connection->createCommand($sql);
                $command->execute();
                echo 'New Associates Inserted';
                exit;
            } else if (!empty($error)) {

                echo $error;
            }
        }
    }

    public function actionMember_lis() {
        if ((Yii::app()->session['user_array']['per2'] == '1') && isset(Yii::app()->session['user_array']['username'])) {
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

    public function actionMember_lisf() {
        $name = '';
        $sodowo = '';
        $cnic = '';
        $plotno = '';
        $project_name = '';
        $plot_detail_address = '';
        $where = '';
        $and = false;
        if (!empty($_POST['name1'])) {
            $where .= " m.name " . $_POST['name1'] . "%'";
            $and = true;
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
                $where .= " and m.cnic LIKE '%" . $_POST['cnic'] . "%'";
            } else {
                $where .= " m.cnic LIKE '%" . $_POST['cnic'] . "%'";
            }
            $and = true;
        }
        if (!empty($_POST['project_name'])) {
            if ($and == true) {
                $where .= " AND p.project_id  '%" . $_POST['project_name'] . "%'";
            } else {
                $where .= "  p.project_id LIKE '%" . $_POST['project_name'] . "%'";
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
                $where .= " and mp.plotno ='" . $_POST['plotno'] . "'";
            } else {
                $where .= "mp.plotno='" . $_POST['plotno'] . "'";
            }
            $and == true;
        }

        $members = "";
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
        $error = "";

//if($and ==true){echo 0;}else{echo 1;}exit;



        if (!empty($_POST['plot_detail_address'])) {

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

        $sql_member = "SELECT mp.member_id,mp.plotno,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where p.type='file' and mp.status='Approved' ";
        $result_members = $connection->createCommand($sql_member)->query();
        $sql_com_res = "SELECT DISTINCT com_res FROM plots";
        $result_com_res = $connection->createCommand($sql_com_res)->query();

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

        if (isset($_POST['search'])) {

            $res = array();

            foreach ($members as $key) {

                echo '<tr><td>' . $key['plotno'] . '</td><td><img src="/upload_pic/' . $key['image'] . '" width="100" height="130" /></td><td>' . $key['create_date'] . '</td><td><a href="' . $home . '/index.php/user/memhistory?id=' . $key['member_id'] . '">' . $key['name'] . '</a></td><td>' . $key['sodowo'] . '</td><td>' . $key['cnic'] . '</td><td><a href="' . $home . '/index.php/user/plothistory?id=' . $key['plot_id'] . '">' . $key['plot_detail_address'] . '</a><td>' . $key['plot_size'] . '</td><td>' . $key['street'] . '</td><td>' . $key['project_name'] . '</td><td><a target="_blank" href="payment?id=' . $key['plot_id'] . ' & pid=' . $key['project_id'] . '">Add Payment</a></br><a target="_blank" href="plotcharges?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Plot Charges</a></br><a target="_blank" href="payment_details?id=' . $key['plot_id'] . '&& pid=' . $key['project_id'] . '">Payment Details</a>

  </br><a target="_blank" href="download?id=' . $key['plot_id'] . '">Document</a>

  </br><a target="_blank" href="transferplot?plot_id=' . $key['plot_id'] . '">Transfer Plot</a>

  </td></tr>';
            }
        }

        $this->render('member_lisf', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects, 'com_res' => $result_com_res));
    }

    public function actionMember_flist() {

        if (Yii::app()->session['user_array']['per2'] == '1') {



            $connection = Yii::app()->db;

            $sql_member = "SELECT mp.member_id,mp.create_date, m.name,m.sodowo,m.cnic,p.plot_detail_address,mp.status, 					p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id where p.type='file'  and mp.status='Approved'";

            $result_members = $connection->createCommand($sql_member)->query();

            $this->render('member_flist', array('members' => $result_members));
        }
    }

    public function actionMember_flis() {

        if ((Yii::app()->session['user_array']['per2'] == '1') && isset(Yii::app()->session['user_array']['username'])) {



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

                $this->render('member_flis', array('error' => $error, 'members' => $members, 'projects' => $result_projects, 'com_res' => $result_com_res));

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

            $this->render('member_flis', array('members' => $result_members, 'error' => $error, 'projects' => $result_projects));
        } else {
            $this->redirect(array("user/dashboard"));
        }
    }

    public function actionPayment_details() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;

            $land = "SELECT * FROM installpayment	where (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='') and others !='Cancelled' and plot_id='" . $_REQUEST['id'] . "' ";
            $land_cost = $connection->createCommand($land)->queryAll();
           
            $member = "SELECT * FROM memberplot mp where plot_id='" . $_REQUEST['id'] . "'";
            $members = $connection->createCommand($member)->queryRow();

            $sql_payment = "Select * from plotpayment where plot_id='" . $_REQUEST['id'] . "' and (mem_id='" . $members['member_id'] . "' or pobm>0 or payment_type NOT IN ('MS Fee','Transfer Fee'))";

            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.image,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='" . $_REQUEST['id'] . "'";

            $result_members = $connection->createCommand($sql_member)->queryAll();

            $sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='" . $_REQUEST['id'] . "'";

            $res = $connection->createCommand($sql)->queryAll();

         


            $sql_plotinfo = "SELECT mp.mstatus as stst,p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		left join memberplot mp on mp.plot_id=p.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();
            $connection = Yii::app()->db;
            $sql_primeloc = "SELECT *  FROM cat_plot
			LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
			WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('payment_details', array('payments' => $result_payments, 'primeloc' => $result_prime, 'landcost' => $land_cost, 'info' => $result_plotinfo, 'receivable' => $res, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionInstallment_details() {
        if (isset(Yii::app()->session['user_array']['username'])) {
            $connection = Yii::app()->db;
            
            
            $sql_payment = "SELECT * FROM installpayment where plot_id='" . $_REQUEST['id'] . "' and (fstatus not in ( 'Cancelled','Rejected') OR fstatus is null or fstatus='') and others !='Cancelled' ";
            $result_payments = $connection->createCommand($sql_payment)->queryAll();
            $sql_member = "SELECT mp.id,mp.plot_id,mp.plotno,mp.member_id,m.cnic,m.name FROM memberplot mp
	   left join members m on mp.member_id=m.id
	    where plot_id='" . $_REQUEST['id'] . "'";
            $result_members = $connection->createCommand($sql_member)->queryAll();
            $sql_charges = "SELECT * FROM plotcharges where plot_id='" . $_REQUEST['id'] . "'";
            $result_charges = $connection->createCommand($sql_charges)->queryAll();
            //	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
            $sql_plotinfo = "SELECT mp.mstatus as stst,p.*,p.price,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join memberplot mp on mp.plot_id=p.id
		left join projects proj on p.project_id=proj.id
		left join sectors sec on p.sector=sec.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		 where p.id='" . $_REQUEST['id'] . "'";
            $result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

            $sql_minfo = "SELECT * FROM memberplot where plot_id='" . $_REQUEST['id'] . "'";
            $result_minfo = $connection->createCommand($sql_minfo)->queryAll();
            $sql_primeloc = "SELECT *  FROM cat_plot
        LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
        WHERE cat_plot.plot_id ='" . $_REQUEST['id'] . "'";
            $result_prime = $connection->createCommand($sql_primeloc)->queryAll();

            $this->render('installment_details', array('charges' => $result_charges, 'payments' => $result_payments, 'primeloc' => $result_prime, 'info' => $result_plotinfo, 'minfo' => $result_minfo, 'members' => $result_members));
        } else {

            $this->redirect(array('user/dashboard'));
        }
    }

    public function actionUpdate() {

        if (Yii::app()->session['user_array']['per3'] == '1' && isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = '//layouts/back';

            $connection = Yii::app()->db;
            /* ?>$sql= "SELECT
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
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionUpdate_charges() {

        if (Yii::app()->session['user_array']['per3'] == '1' && Yii::app()->session['user_array']['per2'] == '1' && isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = '//layouts/back';

            $connection = Yii::app()->db;

            $sql_payment = "SELECT * FROM plotpayment where id='" . $_GET['id'] . "'";

            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $sql_charges = "SELECT * from charges where project_id='" . $_REQUEST['pid'] . "'";

            $result_charges = $connection->createCommand($sql_charges)->query();

            $this->render('update_charges', array('charges' => $result_charges, 'payments' => $result_payments));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionUp_charges() {

        if (Yii::app()->session['user_array']['per3'] == '1' && Yii::app()->session['user_array']['per2'] == '1' && isset(Yii::app()->session['user_array']['username'])) {

            $this->layout = '//layouts/back';

            $connection = Yii::app()->db;

            $sql_payment = "SELECT * FROM plotpayment where id='" . $_GET['id'] . "'";

            $result_payments = $connection->createCommand($sql_payment)->queryAll();

            $sql_charges = "SELECT * from charges where project_id='" . $_REQUEST['pid'] . "'";

            $result_charges = $connection->createCommand($sql_charges)->query();

            $this->render('up_charges', array('charges' => $result_charges, 'payments' => $result_payments));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    public function actionPaymentupdate() {
        $error = '';
        if ((isset($_POST['dueamount']) && empty($_POST['dueamount']))) {
            $error .= "Enter Due Amount. <br>";
        }
        if ((isset($_POST['lab']) && empty($_POST['lab']))) {
            $error .= "Enter Label. <br>";
        }
        if ((isset($_POST['paidamount']) && empty($_POST['paidamount']))) {
            $error .= "Enter Paid Amount. <br>";
        }
        if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))) {
            $error .= "Please Select Payment Type <br>";
        }
        if ((isset($_POST['detail']) && empty($_POST['detail']))) {
            $error .= "Enter Voucher NO. <br>";
        }
        if ((isset($_POST['remarks']) && empty($_POST['remarks']))) {
            $error .= "Enter Remarks. <br>";
        }

        if ((isset($_POST['paid_date_temp']) && empty($_POST['paid_date_temp']))) {
            $error .= "Enter Paid Date. <br>";
        }
        if ($_POST['paid_date_temp'] == 00 or $_POST['paid_date_temp'] == 0 or $_POST['paid_date_temp'] == '-') {
            $_POST['paid_date_temp'] = '';
        }
        $connection = Yii::app()->db;
        if (empty($error)) {
            $sql = "UPDATE installpayment set 
			 dueamount='" . $_POST['dueamount'] . "',
			 lab='" . $_POST['lab'] . "',  
			 paidsurcharge='" . $_POST['paidsurcharge'] . "',
			 paidamount='" . $_POST['paidamount'] . "',
			 payment_type='" . $_POST['payment_type'] . "',
			 detail='" . $_POST['detail'] . "',
			 surcharge='" . $_POST['surcharge'] . "',
			 remarks='" . $_POST['remarks'] . "',
			 paid_date_temp='" . $_POST['paid_date_temp'] . "',
		 	due_date_temp='" . $_POST['due_date_temp'] . "'
			  where id=" . $_POST['id'] . "";
            $command = $connection->createCommand($sql);
            $command->execute();
            echo 'Installment Updated Successfully';
        } else {
            echo $error;
        }
    }

    public function actionInstallmentup() {
        $error = '';
        if ((isset($_POST['dueamount']) && empty($_POST['dueamount']))) {
            $error .= "Enter Due Amount. <br>";
        }
        if ((isset($_POST['lab']) && empty($_POST['lab']))) {
            $error .= "Enter Label. <br>";
        }

        if ((isset($_POST['remarks']) && empty($_POST['remarks']))) {
            $error .= "Enter Remarks. <br>";
        }

        if ((isset($_POST['due_date']) && empty($_POST['due_date']))) {
            $error .= "Enter Due Date. <br>";
        }
        $connection = Yii::app()->db;
        if (empty($error)) {
            $sql = "UPDATE installpayment set 
			 dueamount='" . $_POST['dueamount'] . "',
			 lab='" . $_POST['lab'] . "',  
			surcharge='" . $_POST['surcharge'] . "',
			 remarks='" . $_POST['remarks'] . "',
			 due_date='" . $_POST['due_date'] . "'
			  where id=" . $_POST['id'] . "";
            $command = $connection->createCommand($sql);
            $command->execute();
            echo 'Installment Updated Successfully';
        } else {
            echo $error;
        }
    }

    public function actionChargupdate() {
        $error = '';
        if ((isset($_POST['amount']) && empty($_POST['amount']))) {
            $error .= "Enter Due Amount. <br>";
        }
        if ((isset($_POST['paidamount']) && empty($_POST['amount']))) {
            $error .= "Enter Paid Amount. <br>";
        }
        if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))) {
            $error .= "Please Select Payment Type <br>";
        }
        if ((isset($_POST['detail']) && empty($_POST['detail']))) {
            $error .= "Enter Voucher NO. <br>";
        }
        if ((isset($_POST['remarks']) && empty($_POST['remarks']))) {
            $error .= "Enter Remarks. <br>";
        }

        if ((isset($_POST['date']) && empty($_POST['date']))) {
            $error .= "Enter Paid Date. <br>";
        }


        $connection = Yii::app()->db;

        if (empty($error)) {
            $sql = "UPDATE plotpayment set 
			 amount='" . $_POST['amount'] . "',
			  paidas='" . $_POST['paidas'] . "',
			 paidsurcharge='" . $_POST['paidsurcharge'] . "',
			 paidamount='" . $_POST['paidamount'] . "',
			 payment_type='" . $_POST['payment_type'] . "',
			 detail='" . $_POST['detail'] . "',
			 surcharge='" . $_POST['surcharge'] . "',
			 remarks='" . $_POST['remarks'] . "',

			 date='" . $_POST['date'] . "',
			 duedate='" . $_POST['duedate'] . "',
			  mem_id='" . $_POST['mem_id'] . "'
			  where id=" . $_POST['id'] . "";
            $command = $connection->createCommand($sql);
            $command->execute();
            echo 'Payments Updated Successfully';
        } else {
            echo $error;
        }
    }

    public function actionChargup() {


        $error = '';
        if ((isset($_POST['amount']) && empty($_POST['amount']))) {
            $error .= "Enter Due Amount. <br>";
        }

        if ((isset($_POST['payment_type']) && empty($_POST['payment_type']))) {
            $error .= "Please Select Payment Type <br>";
        }
        if (empty($_POST['duedate'])) {
            $error .= "Please Enter Due Date";
        }



        $connection = Yii::app()->db;

        if (empty($error)) {
            $sql = "UPDATE plotpayment set 
			 amount='" . $_POST['amount'] . "',
			 remarks='" . $_POST['remarks'] . "',
 discount='" . $_POST['discount'] . "',
			 disdetails='" . $_POST['disdetails'] . "',
			 due_date_temp='" . $_POST['duedate'] . "',
			  mem_id='" . $_POST['mem_id'] . "'
			  where id=" . $_POST['id'] . "";
            $command = $connection->createCommand($sql);
            $command->execute();
            echo 'Payments Updated Successfully';
        } else {
            echo $error;
        }
    }

    public function actionMemberplot_list() {

        if (isset(Yii::app()->session['user_array']['username']) && Yii::app()->session['user_array']['per6'] == '1') {

            $connection = Yii::app()->db;

            $sql_member = "SELECT sec.sector_name as sector_name , mp.member_id,mp.id,mp.plot_id,mp.create_date,mp.fstatus,mp.plotno,p.status,p.type, p.size2,siz.size,m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on m.id=mp.member_id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id
left join size_cat siz on p.size2=siz.id
left join sectors sec on p.sector=sec.id

left join projects j on s.project_id=j.id where p.type='plot' and mp.status='new'and mp.fstatus='approved' ";

            $memberplot_list = $connection->createCommand($sql_member)->query();

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

            $this->render('memberplot_list', array('memberplot_list' => $memberplot_list, 'projects' => $result_projects));
        } else {
            $this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
        }
    }

    /////////////////////////////SEARCH MEMBERPLOT BY APP NO, BY MEM ID, BY STATUS, BY DATE//////////////////







    public function actionMemberplot_search_lis() {

        if (Yii::app()->session['user_array']['per2'] == '1') {
            $connection = Yii::app()->db;

            $and = false;

            $where = '';
            // echo   $qry="Select * from memberplot where create_date BETWEEN '".$_POST['fromdate']."'  AND  '".$_POST['todate']."'  ";
            //exit;		

            $from = $_POST['fromdate'];

            $to = $_POST['todate'];

            if (($_POST['fromdate'] != "") && ($_POST['todate'] != "")) {

                if ($and == true) {

                    $where .= "and mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
                } else {
                    $where .= "mp.create_date BETWEEN '" . $from . "' AND '" . $to . "' ";
                }

                $and = true;
            }



            if ($_POST['username'] != "") {

                if ($and == true) {

                    $where .= "and m.name LIKE '%" . $_POST['username'] . "%'";
                } else {

                    $where .= " m.name  LIKE '%" . $_POST['username'] . "%'";
                }

                $and = true;
            }





            if ($_POST['plot_detail_address'] != "") {

                if ($and == true) {

                    $where .= " and p.plot_detail_address LIKE '%" . $_POST['plot_detail_address'] . "%'";
                } else {

                    $where .= " p.plot_detail_address LIKE '%" . $_POST['plot_detail_address'] . "%'";
                }

                $and = true;
            }

            if (isset($_POST['project_id']) && $_POST['project_id'] != "") {

                $pro = $_POST['project_id'];

                if ($and == true) {

                    $where .= " and p.project_id LIKE '%" . $_POST['project_id'] . "%'";
                } else {

                    $where .= " p.project_id LIKE '%" . $_POST['project_id'] . "%'";
                }
            }
            $and = true;

            $sql_member = "SELECT sec.sector_name,mp.id,mp.fstatus,mp.member_id,mp.status,mp.fstatus,mp.plot_id,mp.plotno,mp.create_date,p.id,m.username, m.name,siz.size,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id 
left join size_cat siz on p.size2=siz.id
left join sectors sec on p.sector=sec.id

where " . $where . " AND (p.type='Plot' || p.type='Villa') and mp.status='new'and mp.fstatus='approved' ";

            $result_members = $connection->createCommand($sql_member)->query();

            $sql_projects = "SELECT * from projects ";

            $result_projects = $connection->createCommand($sql_projects)->query();

            $this->render('memberplot_list', array('memberplot_list' => $result_members, 'projects' => $result_projects));
        }
    }

    public function actionRequested_detail() {

        if (Yii::app()->session['user_array']['per2'] == '1') {

            $connection = Yii::app()->db;

            $sql_details = "SELECT mp.member_id, u.firstname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.create_date,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat c on p.size2=c.id
left join user u on mp.user_name=u.id

left join projects j on s.project_id=j.id where mp.status!='Approved' And mp.plot_id=" . $_REQUEST['id'];

            $result_details = $connection->createCommand($sql_details)->query();

            $sql_payment = "SELECT * from plotpayment where plot_id='" . $_REQUEST['id'] . "'";

            $result_payments = $connection->createCommand($sql_payment)->queryRow();

            $this->render('requested_detail', array('plotdetails' => $result_details, 'plotpayments' => $result_payments));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////REQUEST DETAIL///////////////







    public function actionReq_detail() {

        if (Yii::app()->session['user_array']['per2'] == '1') {

            $connection = Yii::app()->db;

            $sql_details = "SELECT mp.member_id,sec.sector_name, u.firstname,u.middelname,u.lastname,u.cnic,u.email,c.size,mp.noi,mp.id,mp.fcomment,mp.create_date,mp.fstatus,mp.member_id,mp.user_name,mp.plotno,m.id,m.image, p.size2,m.name,m.sodowo,m.cnic,p.price,p.com_res,p.atype,p.status,p.plot_detail_address,p.id,p.plot_size,s.street, j.project_name FROM  memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat c on p.size2=c.id
left join sectors sec on p.sector=sec.id
left join user u on mp.user_name=u.id

left join projects j on s.project_id=j.id where mp.plot_id=" . $_REQUEST['plot_id'];

            $result_details = $connection->createCommand($sql_details)->query();

            $sql_payment = "SELECT * from plotpayment where plot_id='" . $_REQUEST['plot_id'] . "'";

            $result_payments = $connection->createCommand($sql_payment)->queryRow();

            $this->render('req_detail', array('plotdetails' => $result_details, 'plotpayments' => $result_payments));
        } else {
            $this->redirect(array("dashboard"));
        }
    }

    //////////////////////////////////////////

    public function actionCancelreq111() {

        $connection = Yii::app()->db;

        $plotid = $_POST['pid'];

        $sql = "Update plots SET status='' where id='" . $plotid . "'";
        $command = $connection->createCommand($sql);
        $command->execute();
        $sql1 = "DELETE FROM  memberplot where plot_id='" . $plotid . "'";
        //$sql="Update plots SET status='Alloted' where plot_id='".$plotid."'";	
        $command = $connection->createCommand($sql1);
        $command->execute();
        $sql2 = "DELETE FROM  installpayment where plot_id='" . $plotid . "'";
        $command = $connection->createCommand($sql2);
        $command->execute();
        $this->redirect(array("plots/plots_lis"));
    }

    ////////////////////SUBMIT STATUS///////



    public function actionSubmitstatus() {
        if ($_POST['statusapp'] == 'Approved') {
            $connection = Yii::app()->db;
            $memberid = $_POST['member_id'];
            $plotid = $_POST['plot_id'];
            $status = $_POST['status'];
            $sql = "Update plots SET status='Alotted' where id='" . $plotid . "'";
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql = "Update memberplot SET status='Approved',comment='" . $_POST['cmnt'] . "' where plot_id='" . $plotid . "'";
            $command = $connection->createCommand($sql);
            $command->execute();

            $this->redirect(array("memberplot/memberplot_list"));
        }
        if ($_POST['statusapp'] == 'pending') {

            $connection = Yii::app()->db;
            $plotid = $_POST['plot_id'];

            $sql = "Update memberplot SET fstatus='" . $_POST['statusapp'] . "', fcomment='" . $_POST['cmnt'] . "' where plot_id='" . $plotid . "'";

            $command = $connection->createCommand($sql);
            $command->execute();
            $this->redirect(array("memberplot/memberplot_list"));
        }


        /* 	
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

          } */
    }

    //////////////////////////////////////////





    public function actionAjaxRequest($pro, $sec) {

        $connection = Yii::app()->db;

        $sql_street = "SELECT * from streets where project_id='" . $pro . "' and sector_id='" . $sec . "'";

        $result_streets = $connection->createCommand($sql_street)->query();

        $street = array();

        foreach ($result_streets as $str) {

            $street[] = $str;
        }



        echo json_encode($street);
        exit();
    }

    public function actionAjaxRequest1($pro, $sector, $street, $size) {
        $connection = Yii::app()->db;
        $sql_plot = "SELECT * from plots where street_id='" . $street . "' and project_id='" . $pro . "' and size2='" . $size . "' and 
		sector='" . $sector . "' and status=''";
        $result_plots = $connection->createCommand($sql_plot)->query();

        $plot = array();
        foreach ($result_plots as $plo) {
            $plot[] = $plo;
        }

        echo json_encode($plot);
        exit();
    }

    /*
      public function actionAjaxRequest1()

      {

      $connection = Yii::app()->db;

      $sql_plot  = "SELECT * from plots where street_id='".$_POST['street']."' and project_id='".$_POST['pro']."' and size2='".$_POST['size']."' and sector='".$_POST['sector']."' and type='Plot' and status=''";
      $result_plots = $connection->createCommand($sql_plot)->query();



      $plot=array();

      foreach($result_plots as $plo){

      $plot[]=$plo;

      }



      echo json_encode($plot); exit();

      } */

    public function actionAjaxRequest31($val1) {
        $connection = Yii::app()->db;
        $sql_city = "SELECT * from charges where id='" . $val1 . "' ";
        $result_city = $connection->createCommand($sql_city)->query();
        $city = array();

        foreach ($result_city as $cit) {
            $city[] = $cit;
        }
        echo json_encode($city);
        exit();
    }

    ////////////////////////

    protected function renderJSON($data) {
        header('Content-type: application/json');
        echo CJSON::encode($data);

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }

    public function actionGetMs() {



        $ms = $_POST['plotno'];
        $connection = Yii::app()->db;

        $sql_ms = "SELECT 
		                     j.project_name,
		                     mp.app_no,
		                     mp.plotno,
		                     sec.sector_name,
		                     s.street,
		                     p.plot_size,
		                     mp.create_date,
		                     p.com_res,
		                     m.name,
		                     mp.plotno,
		                     p.plot_detail_address,
		                     mp.status,
		                     size_cat.size,
		                     poss.possession
		                     FROM memberplot mp
                            left join members m on mp.member_id=m.id
                            left join associates assoc on mp.id=assoc.msid
                            left join plots p on mp.plot_id=p.id
                            left join sectors sec on sec.id=p.sector
                            left join size_cat size_cat on size_cat.id=p.size2
                            left join streets s on p.street_id=s.id
                            left join projects j on p.project_id=j.id
                            left join bcd poss on p.id=poss.plot_id
                            where mp.plotno='$ms'";
        $result_ms = $connection->createCommand($sql_ms)->query();
        $ms = array();
        foreach ($result_ms as $mss) {
            $ms[] = $mss;
        }
        return $this->renderJSON($ms);
    }

    public function actionGetCnic() {
        $cnic = $_POST['cnic'];
        $connection = Yii::app()->db;

        $sql_cnic = "SELECT members.id,
							members.name,
							members.username,
							members.title,
							members.sodowo,
							members.cnic,
							members.image,
							members.address,
							members.phone,
							members.email,
							members.nomineename,
							c.country,
							p.city
						    from members
		Left JOIN tbl_country c ON c.id=members.country_id
			Left JOIN tbl_city p ON p.id=members.city_id 
		 where cnic=" . $cnic . " AND members.status=1";
        $result_cnic = $connection->createCommand($sql_cnic)->query();
        $cnic = array();
        foreach ($result_cnic as $cnc) {
            $cnic[] = $cnc;
        }
        /// return	$this->renderJSON($cnic);
        $cnic1 = $_POST['cnic'];
        $sql_ms = "SELECT mp.plotno as MsNo FROM memberplot mp
                            left join members m on mp.member_id=m.id
                            
                            WHERE m.cnic =" . $cnic1 . " ";
        $result_ms = $connection->createCommand($sql_ms)->query();
        ///return	$this->renderJSON($cnic,$result_ms);
        $data = [$cnic, $result_ms];

        return $this->renderJSON($data);
    }

    public function actionAjaxRequest5($val1) {

        $connection = Yii::app()->db;

        $sql_city = "SELECT * from members where cnic=" . $val1 . " AND status=1";

        $result_city = $connection->createCommand($sql_city)->query();

        $city = array();

        foreach ($result_city as $cit) {

            $city[] = $cit;
        }



        echo json_encode($city);
        exit();
    }

    public function actionAjaxRequest6($val1) {

        $connection = Yii::app()->db;

        $sql_city = "SELECT * from memberplot where plotno='" . $val1 . "'";

        $result_city = $connection->createCommand($sql_city)->query();

        $city = array();

        foreach ($result_city as $cit) {

            $city[] = $cit;
        }



        echo json_encode($city);
        exit();
    }

    public function loadModel($id) {

        $model = User::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    /**

     * Performs the AJAX validation.

     * @param User $model the model to be validated

     */
    protected function performAjaxValidation($model) {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}
