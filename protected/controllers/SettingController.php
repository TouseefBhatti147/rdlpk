<?php



class SettingController extends Controller

{



	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	public function actionGenerate_Ms_List()
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
				$sql_types  = "SELECT * from property_types";
				$result_types = $connection->createCommand($sql_types)->query();
				$sql_categories  = "SELECT * from categories";
				$categories = $connection->createCommand($sql_categories)->query();
				$sq  = "SELECT projects.project_name,property_types.title, MIN(ms_no) as start,Max(ms_no) as end from projects INNER JOIN ms_nos on ms_nos.project_id=projects.id INNER JOIN property_types on ms_nos.property_type_id=property_types.property_type_id  GROUP BY property_types.title,MINUTE(ms_nos.created_at) order by ms_nos.id";
				$result_sq = $connection->createCommand($sq)->queryAll();


				$this->render('generate_ms_list',array('projects'=>$result_projects,'msnos'=>$result_sq,'categories'=>$categories,'size'=>$result_size,'types'=>$result_types));
			}
			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}
	public function actionCreateMsList()
	{

		$connection = Yii::app()->db;
		$error = array();
		if (isset($_POST['project_id']) && empty($_POST['project_id'])) {
			$error = 'Please Select Plot Project<br>';
		}
		//echo $_POST['startfrom'];exit;

		if (isset($_POST['startfrom']) && empty($_POST['startfrom'])) {
			$error .= 'Please Enter Start Range<br>';
		}
		if (isset($_POST['property_type']) && empty($_POST['property_type'])) {
			$error .= 'Please Select Property Type<br>';
		}

		if (isset($_POST['endto']) && empty($_POST['endto'])) {
			$error .= 'Please Enter End Range<br>';
		}

		$startfrom=$_POST['startfrom'];
		$endto=$_POST['endto'];



		/*$sq  = "SELECT * from ms_nos where project_id='" . $_POST['project_id'] . "' AND ms='" . $_POST['sector'] . "' AND street_id='" . $_POST['street_id'] . "' AND com_res='" . $_POST['com_res'] . "' AND plot_detail_address='" . $_POST['plot_detail_address'] . "' and type='plot'";
		$result_sq = $connection->createCommand($sq)->queryAll();
		$count = 0;
		$re = array();
		foreach ($result_sq as $key1) {
			$count = $count + 1;
		}
		if ($count != 0) {
			$error = "A Plot Is Already Added On This Address Please Enter Another Plot Address  ";
		}*/
		$last_ms=0;
		if (empty($error)) {

			 $sq  = "SELECT max(ms_no) as last_ms_no from ms_nos where project_id='".$_POST['project_id'] ."'";
			 $result_sq = $connection->createCommand($sq)->queryRow();
			 $last_ms=$result_sq['last_ms_no']+1;
			// echo str_pad($last_ms, 05, 0, STR_PAD_LEFT) ;
			if($startfrom==$last_ms)
			{
						for ($x = $startfrom; $x <= $endto; $x++)
						{


							 $sql  = 'INSERT INTO ms_nos (project_id,property_type_id,ms, ms_no, uniq_ms,status)
								VALUES ( "'.$_POST['project_id'].'","'.$_POST['property_type'].'","'.$last_ms.'", "' .str_pad($last_ms, 04, 0, STR_PAD_LEFT). '", "' . $_POST['project_id'].str_pad($last_ms, 04, 0, STR_PAD_LEFT). '","0")';
						$command = $connection->createCommand($sql);
						$command->execute();
							$last_ms++;
						}
			}else
			{
				for ($x = $startfrom; $x <= $endto; $x++)
				{


					  $sql  = 'INSERT INTO ms_nos (project_id,property_type_id,ms, ms_no, uniq_ms,status)
						VALUES ( "'.$_POST['project_id'].'","'.$_POST['property_type'].'","'.$x.'", "' .str_pad($x, 04, 0, STR_PAD_LEFT). '", "' . $_POST['project_id'].str_pad($x, 04, 0, STR_PAD_LEFT). '","0")';
			$command = $connection->createCommand($sql);
				$command->execute();

				}
			}
			echo 'Record Inserted Successfully';
			//$last_insert_id = Yii::app()->db->getLastInsertID();


		} else {
			echo $error;exit;
		}
	}
	public function actionCreate()
	{
		if (Yii::app()->session['user_array']['per1'] == '1') {
			$error = '';
			$connection = Yii::app()->db;
			if ((isset($_POST['ownername']) && empty($_POST['ownername'])) || (isset($_POST['mobile']) && empty($_POST['mobile'])) || (isset($_POST['phone']) && empty($_POST['phone'])) || (isset($_POST['email']) && empty($_POST['email'])) || (isset($_POST['message']) && empty($_POST['message'])) || (isset($_POST['address']) && empty($_POST['address'])) || (isset($_POST['facebook']) && empty($_POST['facebook'])) || (isset($_POST['twitter']) && empty($_POST['twitter'])) || (isset($_POST['flicker']) && empty($_POST['flicker'])) || (isset($_POST['googleplus']) && empty($_POST['googleplus']))) {

				$error = 'Please complete all required fields <br />';
			}
			if (empty($error)) {
				$ownername = mysql_real_escape_string($_POST['ownername']);
				$mobile = mysql_real_escape_string($_POST['mobile']);
				$phone = mysql_real_escape_string($_POST['phone']);
				$email = mysql_real_escape_string($_POST['email']);
				$message = mysql_real_escape_string($_POST['message']);
				$address = mysql_real_escape_string($_POST['address']);
				$facebook = mysql_real_escape_string($_POST['facebook']);
				$twitter = mysql_real_escape_string($_POST['twitter']);
				$flicker = mysql_real_escape_string($_POST['flicker']);
				$googleplus = mysql_real_escape_string($_POST['googleplus']);
				$sql  = "INSERT INTO setting(ownername,mobile,phone,email,message,address,facebook,twitter,flicker,googleplus) VALUES('" . $ownername . "','" . $mobile . "','" . $phone . "','" . $email . "','" . $message . "','" . $address . "','" . $facebook . "','" . $twitter . "','" . $flicker . "','" . $googleplus . "')";
				$command = $connection->createCommand($sql);
				$command->execute();
				$this->redirect(array('setting/setting_list'));
			}
		}

		exit;
	}

	public function actionMsno_list()
	{
		if ((Yii::app()->session['user_array']['per2'] == '1') && isset(Yii::app()->session['user_array']['username'])) {

			$connection = Yii::app()->db;
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

			$sql_categories  = "SELECT * from categories";
			$categories = $connection->createCommand($sql_categories)->query();
			$sql_size  = "SELECT * from size_cat";
			$sizes = $connection->createCommand($sql_size)->query();
			$sql_sector = "SELECT * FROM sectors";
			$result_sector = $connection->createCommand($sql_sector)->query();

			$sql_com_res = "SELECT DISTINCT com_res FROM plots";
			$result_com_res = $connection->createCommand($sql_com_res)->query();

			$home = Yii::app()->request->baseUrl;

			$this->render('msno_list', array('projects' => $result_projects, 'sectors' => $result_sector, 'sector' => $result_sector, 'categories' => $categories, 'sizes' => $sizes, 'com_res' => $result_com_res));
		} else {
			$this->redirect(array('user/dashboard'));
		}
	}
	public function actionSearchreq()
	{


		if ((Yii::app()->session['user_array']['per3'] == '1')  || (Yii::app()->session['user_array']['per34'] == '1')) {
			$where = "ms_nos.id !=''";
			$and = true;
			if (!empty($_POST['project'])) {
				if ($and == true) {
					$where .= " AND ms_nos.project_id =" . $_POST['project'] . "";
				} else {
					$where .= "  ms_nos.project_id=" . $_POST['project'] . "";
				}
				$and = true;
			}

			if (isset($_POST['com_res']) && $_POST['com_res'] != "") {


				$where .= " and ms_nos.property_type_id=" .$_POST['com_res']. "";
				$and = true;

			}
			if (!empty($_POST['ms_no'])) {
				if ($and == true) {
					$where .= " and ms_nos.ms_no Like'%".$_POST['ms_no']. "%'";
				} else {
					$where .= "ms_nos.ms_no Like '%".$_POST['ms_no']."%'";
				}
				$and == true;
			}
			if (!empty($_POST['ms'])) {
				if ($and == true) {
					$where .= " and ms_nos.ms Like'%".$_POST['ms']. "%'";
				} else {
					$where .= "ms_nos.ms Like '%".$_POST['ms']."%'";
				}
				$and == true;
			}
			if (!empty($_POST['uniq_ms'])) {
				if ($and == true) {
					$where .=" and ms_nos.uniq_ms Like'%".$_POST['uniq_ms']."%'";
				} else {
					$where .="ms_nos.uniq_ms Like '%".$_POST['uniq_ms']."%'";
				}
				$and == true;
			}
			if (!empty($_POST['status'])) {
				if ($_POST['status'] == 0) {
					$where =" ms_nos.status LIKE '0'";
				}
				if ($_POST['status'] == 1) {
					$where .=" and ms_nos.status LIKE '1'";
				}
				if ($_POST['status'] == 2) {
					$where .=" and ms_nos.status LIKE '2'";
				}
				if ($_POST['status'] == 3) {
					$where .= " and ms_nos.statusLIKE '3'";
				}
			}


			//for Pagination
			if (isset($_POST['limit']) && $_POST['limit'] !== '') {
				$limit = $_POST['limit'];
			} else {
				$limit = 50;
			}
			$adjacent = 50;
			$page = $_REQUEST['page'];
			if ($page == 1) {
				$start = 0;
			} else {
				$start = ($page - 1) * $limit;
			}
			$connection = Yii::app()->db;
			 $sql_memberas = "SELECT ms_nos.property_type_id,ms_nos.ms,ms_nos.ms_no,ms_nos.comp_ms_no,ms_nos.uniq_ms,ms_nos.status, projects.project_name FROM ms_nos inner JOIN projects  ON (ms_nos.project_id = projects.id)
			where $where ";
			$co = $connection->createCommand($sql_memberas)->queryAll();
			$rows = count($co);
			//for Pagination end
			$connection = Yii::app()->db;
			 $sql_member = "SELECT ms_nos.property_type_id,ms_nos.ms,ms_nos.ms_no,ms_nos.comp_ms_no,ms_nos.uniq_ms,ms_nos.status,ms_nos.created_at, projects.project_name FROM ms_nos
     inner JOIN projects  ON (ms_nos.project_id = projects.id)
where $where limit $start,$limit";
			$result_members = $connection->createCommand($sql_member)->queryAll();
			$sql_project = "SELECT * from projects";
			$result_project = $connection->createCommand($sql_project)->query();



			$count = 0;
			if ($result_members != '') {
				$home = Yii::app()->request->baseUrl;
				$check = 1;
				$res = array();
				foreach ($result_members as $key) {
					$count++;

					echo $count . ' result found';
					$home = "";
					$home = Yii::app()->request->baseUrl;
					$F = '';
					$M = '';
					echo '<tr><td>'.$key['project_name'] . '</td>
					<td>';
					if($key['property_type_id']==1)
					{
						echo'Residential';
					}elseif($key['property_type_id']==2)
					{
						echo'Villa';
					}
					elseif($key['property_type_id']==3)
					{
						echo'Commercial';
					}

					echo'</td>
					<td>' . $key['ms'] . '</td>
					<td>' . $key['ms_no'] . '</td>
					<td>' . $key['comp_ms_no'] . '</td>
					<td>' . $key['uniq_ms'] . '</td>
					<td>';if($key['status']==0){echo 'Open';}
					if($key['status']==1){echo 'Active';}
					if($key['status']==2){echo 'Reserve';}
					echo'</td>
					<td>' . $key['created_at'] . '</td>';
					'</tr>';
				}
			}
			echo '<tr><td>'; ?>
			<?php echo '</td></tr>';


			?>

			<script>
				function deletethis(id, idd) {
					var x = confirm("Are you sure you want to delete?");

					if (x == true) {
						window.location = "deleteplot?id=" + id + "&&did=" + idd + "";
					}
					if (x == false) {
						return false;
					}
				}
			</script>
<?php
			// for pagination
			$pagination = '';
			if ($page == 0) $page = 1;					//if no page var is given, default to 1.
			$prev = $page - 1;							//previous page is page - 1
			$next = $page + 1;							//next page is page + 1
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
				if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
				{
					$first = '';
					for ($counter = 1; $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
							$pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
					}
					$last = '';
				} elseif ($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
				{
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
			exit;
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
	}
	public function actionSetting_list()

	{

		if (Yii::app()->session['user_array']['per1'] == '1') {

			if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

				$this->layout = '//layouts/back';

				$connection = Yii::app()->db;

				$sql = "SELECT * FROM setting";

				$result_setting = $connection->createCommand($sql)->query();

				$this->render('setting_list', array('setting' => $result_setting));
			} else {

				$this->redirect(array('user/user'));
			}
		} else {
			$this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
		}
	}



	public function actionUpdate_setting()

	{

		if (Yii::app()->session['user_array']['per1'] == '1') {

			if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

				$this->layout = '//layouts/back';

				$connection = Yii::app()->db;

				$sql = "SELECT * FROM setting where id=" . $_GET['id'];

				$result = $connection->createCommand($sql)->query();

				$this->render('update_setting', array('update_setting' => $result));
			} else {

				$this->redirect(array('user/user'));
			}
		} else {
			$this->redirect(Yii::app()->baseUrl . "/index.php/user/dashboard");
		}
	}













	/////////////////////////// function for update project





	public function actionUpdate_set()

	{

		if (Yii::app()->session['user_array']['per1'] == '1') {



			$connection = Yii::app()->db;



			$id = $_POST['id'];





			$ownername = $_POST['ownername'];

			$mobile = $_POST['mobile'];

			$phone = $_POST['phone'];

			$email = $_POST['email'];

			$message = $_POST['message'];

			$subcriptiontext = $_POST['subcriptiontext'];

			$address = $_POST['address'];

			$facebook = $_POST['facebook'];



			$twitter = $_POST['twitter'];

			$flicker = $_POST['flicker'];

			$googleplus = $_POST['googleplus'];



			$sql_update = "UPDATE setting SET ownername ='$ownername',mobile ='$mobile',phone ='$phone',email ='$email',message ='$message',subcriptiontext ='$subcriptiontext',address ='$address',facebook ='$facebook',twitter ='$twitter',flicker ='$flicker',googleplus ='$googleplus' WHERE id =" . $id;



			$command = $connection->createCommand($sql_update);

			$command->execute();

			$this->redirect(array("setting_list"));
		}
	}

	/**

	 * Updates a particular model.

	 * If update is successful, the browser will be redirected to the 'view' page.

	 * @param integer $id the ID of the model to be updated

	 */

	function actionEdit()

	{

		if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

			$this->layout = 'column3';

			$this->render('edit_register');
		}
	}

	public function actionUpdate($id)

	{

		$model = $this->loadModel($id);



		// Uncomment the following line if AJAX validation is needed





		if (isset($_POST['User'])) {

			$model->attributes = $_POST['User'];

			if ($model->save())

				$this->redirect(array('view', 'id' => $model->user_id));
		}



		$this->render('update', array(

			'model' => $model,

		));
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

		if (!isset($_GET['ajax']))

			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}



	public function actionIndex()

	{



		if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

			$this->redirect(array('datasource'));
		} else {

			$error = '';

			$layout = '//layouts/column1';

			$this->render('index');
		}
	}











	public function actionSetting()

	{

		if (Yii::app()->session['user_array']['per1'] == '1') {





			if (isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username'])) {

				$this->render('setting');
			} else {

				$this->redirect(array('user/user'));
			}
		}
	}













	public function loadModel($id)

	{

		$model = User::model()->findByPk($id);

		if ($model === null)

			throw new CHttpException(404, 'The requested page does not exist.');

		return $model;
	}



	/**

	 * Performs the AJAX validation.

	 * @param User $model the model to be validated

	 */

	protected function performAjaxValidation($model)

	{

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {

			echo CActiveForm::validate($model);

			Yii::app()->end();
		}
	}
}
