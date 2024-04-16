<?php







class SellerController extends Controller



{
	public function actionCreate()
	{ 
	      
	         $connection = Yii::app()->db;  
				 	
			 
			  $name=$_POST['name'];
			
			 $remarks=$_POST['remarks'];
			  $abbreviation=$_POST['abbreviation'];
			  $proprietor=$_POST['proprietor'];
			
			 $newfilename = $_FILES["logo"]["name"];
			 move_uploaded_file($_FILES["logo"]["tmp_name"],'images/seller/'.$newfilename);
			 $sql  = "INSERT INTO seller (name,logo,remarks,abbreviation,proprietor) VALUES ('".$name."','".$newfilename."','".$remarks."','".$abbreviation."','".$proprietor."')";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $this->redirect(Yii::app()->baseUrl."/index.php/seller/seller_lis"); 
			
	}
	
	public function actionCreatesd()
	{ 
	      
	         $connection = Yii::app()->db;  
				 	
			 
			  $name=$_POST['name'];
			
			 $remarks=$_POST['remarks'];
			  $abbreviation=$_POST['abbreviation'];
			  $proprietor=$_POST['proprietor'];
			
			
			
			 $sql  = "INSERT INTO sdealer (name,remarks,abbreviation,proprietor,mdealer) VALUES ('".$name."','".$remarks."','".$abbreviation."','".$proprietor."','".$_POST['dealer']."')";	
               $command = $connection -> createCommand($sql);
			   $command -> execute();
			   $this->redirect(Yii::app()->baseUrl."/index.php/seller/sdealer_lis"); 
			
	}
	
	
	public function actionExport()

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

                if (!empty($_POST['status'])){

					if($_POST['status']=='Alloted'){

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

		

		

		$result_projects = $connection->createCommand($sql_project)->queryAll() or mysql_error();

		

		

		//$sql_project = "SELECT * from projects";



		//$result_project = $connection->createCommand($sql_project)->query();



	



		



		$sql_categories  = "SELECT * from categories";



		$categories = $connection->createCommand($sql_categories)->queryAll();



		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->queryAll();



	    $sql_sector ="SELECT DISTINCT sector FROM plots";



		$result_sector = $connection->createCommand($sql_sector)->queryAll();

		

	    $sql_com_res ="SELECT DISTINCT com_res FROM plots";



		$result_com_res = $connection->createCommand($sql_com_res)->queryAll();



		

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

			else {echo '<td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a  href="deleteplot?id='.$key['id'].'">Delete</a></td>';}

			'</tr>
			
					'; 



            }}



			$this->render('export',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
			



	   



	}
public function actioncsv(){
		
		
		$project_id1=0;
		$street_id1=0;	
		$sector1=0;
		$size21=0;
		$price1=0;
		$name1=0;
		$cnic1=0;
		$plotno1=0;
		$com_res1=0;
		$status1=0;
		$detail_address1=0;
	    if(isset($_POST['project_id1'])){ $project_id1= $_POST['project_id1'];}
		 if(isset($_POST['detail_address1'])){ $detail_address1= $_POST['detail_address1'];}
		if(isset($_POST['street_id1'])){ $street_id1= $_POST['street_id1'];}
		if(isset($_POST['sector1'])){ $sector1= $_POST['sector1'];}
		if(isset($_POST['size21'])){ $size21= $_POST['size21'];}
		if(isset($_POST['price1'])){ $price1= $_POST['price1'];}
		if(isset($_POST['name1'])){ $name1= $_POST['name1'];}
		if(isset($_POST['cnic1'])){ $cnic1= $_POST['cnic1'];}
		if(isset($_POST['plotno1'])){ $plotno1= $_POST['plotno1'];}
		if(isset($_POST['com_res1'])){ $com_res1= $_POST['com_res1'];}
		if(isset($_POST['status1'])){ $status1= $_POST['status1'];}
		
		
		
		$connection = Yii::app()->db;
		$where='';
		$and=false;
		 if (isset($_POST['sector']) && $_POST['sector']!=""){
				$where.="plots.sector LIKE '%".$_POST['sector']."%'";
				$and = true;
				$sector=$_POST['sector'];
			}
			 if (isset($_POST['com_res']) && $_POST['com_res']!=""){
				$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";
				$and = true;
				$com_res=$_POST['com_res'];
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
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				

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
					$where.=" and plots.street_id LIKE '%".$_POST['street_id']."%'";
				}
				else
				{
					$where.=" plots.street_id LIKE '%".$_POST['street_id']."%'";
				}
				$and=true;
			}
            $street=$_POST['street_id'];
			$connection = Yii::app()->db; 
    $field='';
	
	if($detail_address1==1){
    $field.='plots.plot_detail_address';
	}
	
	if($project_id1==1){
    $field.=',projects.project_name';
	}
		if($street_id1==1){
    $field .=',streets.street';
	}
		if($sector1==1){
    $field .=',plots.sector';
	}
		if($price1==1){
    $field .=',plots.price';
	}
	if($size21==1){
    $field .=',size_cat.size';
	}
	if($plotno1==1){
    $field .=',memberplot.plotno';
	}
	if($com_res1==1){
    $field .=',plots.com_res';
	}
	if($cnic1==1){
    $field .=',members.cnic';
	}
	if($name1==1){
    $field .=',members.name';
	}
	if($status1==1){
    $field .=',plots.status';
	}
	   $sql_member = "SELECT
   ".$field."
  
FROM

   plots

    Left JOIN streets  ON (plots.street_id = streets.id)

	".$extra1."

	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN plotpayment  ON (plots.project_id = projects.id)

	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN members  ON (memberplot.member_id = members.id)

	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where";
        $sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
	   $sql_com ="SELECT DISTINCT com_res FROM plots";
		$result_com = $connection->createCommand($sql_com)->query();
		$result_members = $connection->createCommand($sql_member)->queryAll();
		//print_r($result_members);exit;
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();	
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
 $Plot  = "SELECT * FROM plots  ";
 $Plot_result = $connection->createCommand($Plot)->queryAll();
  $colnames = array(
    'plot_detail_address' => "Plot No.",
    'project_name' => "Project Name",
    'plotno' => "Membership #",
	
	 'sector' => "Sector.",
    'price' => "Price",
    'status' => "Status",
	
	 'name' => "Name.",
    'cnic' => "CNIC",
    'com_res' => "Type",
	
	 'cat_size.size' => "Size.",);
// print_r($colnames);exit;
  function map_colnames($input)
  { 
    global $colnames;
    return isset($colnames[$input]) ? $colnames[$input] : $input;
  }
  function cleanData(&$str)
  {
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "CSV Report" . date('Ymd') . ".csv";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv");
  $out = fopen("php://output", 'w');
  $flag = false;
  foreach($result_members as $row) {
    if(!$flag) {
      // display field/column names as first row
	 
      $firstline = array_map("map_colnames", array_keys($row));
      fputcsv($out, $firstline, ',', '"');
      $flag = true;
    }
    array_walk($row, 'cleanData');
    fputcsv($out, array_values($row), ',', '"');
  }
  fclose($out);
  exit;

		
		}

public function actioncsv1(){
		
		
		$project_id1=0;
		$street_id1=0;	
		$sector1=0;
		$size21=0;
		$price1=0;
		$name1=0;
		$cnic1=0;
		$plotno1=0;
		$com_res1=0;
		$status1=0;
		$detail_address1=0;
	    if(isset($_POST['project_id1'])){ $project_id1= $_POST['project_id1'];}
		 if(isset($_POST['detail_address1'])){ $detail_address1= $_POST['detail_address1'];}
		if(isset($_POST['street_id1'])){ $street_id1= $_POST['street_id1'];}
		if(isset($_POST['sector1'])){ $sector1= $_POST['sector1'];}
		if(isset($_POST['size21'])){ $size21= $_POST['size21'];}
		if(isset($_POST['price1'])){ $price1= $_POST['price1'];}
		if(isset($_POST['name1'])){ $name1= $_POST['name1'];}
		if(isset($_POST['cnic1'])){ $cnic1= $_POST['cnic1'];}
		if(isset($_POST['plotno1'])){ $plotno1= $_POST['plotno1'];}
		if(isset($_POST['com_res1'])){ $com_res1= $_POST['com_res1'];}
		if(isset($_POST['status1'])){ $status1= $_POST['status1'];}
		
		
		
		$connection = Yii::app()->db;
		$where='';
		$and=false;
		 if (isset($_POST['sector']) && $_POST['sector']!=""){
				$where.="plots.sector LIKE '%".$_POST['sector']."%'";
				$and = true;
				$sector=$_POST['sector'];
			}
			 if (isset($_POST['com_res']) && $_POST['com_res']!=""){
				$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";
				$and = true;
				$com_res=$_POST['com_res'];
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
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				

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
			if (!empty($_POST['stat'])){
			if($_POST['stat']==1){$where.="and plots.rstatus ='reallocated'";}
			if($_POST['stat']==2){$where.="and plots.status ='Alotted'";}
			if($_POST['stat']==3){$where.="and plots.status =''";}
			if($_POST['stat']==4){$where.="and plots.bstatus ='reserved'";}
						$and = true;	
			 } 
			 if (!empty($_POST['payment_mode'])){
			if($_POST['payment_mode']!==''){$where.=" and pp.paidas =''";}
			
						$and = true;	
			 } 
			 if (!empty($_POST['specify'])){
				 
			if($_POST['specify']==2){$where.=" and pp.detail like '%No Receipt%'";}
			if($_POST['specify']==3){$where.=" and pp.detail like '%JV%'";}
			if($_POST['specify']==4){$where.=" and pp.detail like '%Against Land%'";}
			if($_POST['specify']==5){$where.=" and pp.detail like '%Sui Gas%'";}
						$and = true;	
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
            $street=$_POST['street_id'];
			$connection = Yii::app()->db; 
    $field='';
	
	if($detail_address1==1){
    $field.='plots.plot_detail_address';
	}
	
	if($project_id1==1){
    $field.=',projects.project_name';
	}
		if($street_id1==1){
    $field .=',streets.street';
	}
		if($sector1==1){
    $field .=',plots.sector';
	}
		if($price1==1){
    $field .=',plots.price';
	}
	if($size21==1){
    $field .=',size_cat.size';
	}
	if($plotno1==1){
    $field .=',memberplot.plotno';
	}
	if($com_res1==1){
    $field .=',plots.com_res';
	}
	if($cnic1==1){
    $field .=',members.cnic';
	}
	if($name1==1){
    $field .=',members.name';
	}
	if($status1==1){
    $field .=',plots.status';
	}
	$sql_member = "SELECT
   ".$field."
  
FROM

   plotpayment pp

    Left JOIN plots  ON (pp.plot_id = plots.id)
	Left JOIN streets  ON (plots.street_id = streets.id)
	".$extra1."
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN members  ON (memberplot.member_id = members.id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where";
        $sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		$sql_categories  = "SELECT * from categories";
		    $categories = $connection->createCommand($sql_categories)->query();
	    $sql_sector ="SELECT DISTINCT sector FROM plots";
		$result_sector = $connection->createCommand($sql_sector)->query();
	   $sql_com ="SELECT DISTINCT com_res FROM plots";
		$result_com = $connection->createCommand($sql_com)->query();
		$result_members = $connection->createCommand($sql_member)->queryAll();
		//print_r($result_members);exit;
		$sql_size  = "SELECT * from size_cat";
		$sizes = $connection->createCommand($sql_size)->query();	
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
 $Plot  = "SELECT * FROM plots  ";
 $Plot_result = $connection->createCommand($Plot)->queryAll();
  $colnames = array(
    'plot_detail_address' => "Plot No.",
    'project_name' => "Project Name",
    'plotno' => "Membership #",
	
	 'sector' => "Sector.",
    'price' => "Price",
    'status' => "Status",
	
	 'name' => "Name.",
    'cnic' => "CNIC",
    'com_res' => "Type",
	
	 'cat_size.size' => "Size.",);
// print_r($colnames);exit;
  function map_colnames($input)
  { 
    global $colnames;
    return isset($colnames[$input]) ? $colnames[$input] : $input;
  }
  function cleanData(&$str)
  {
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "CSV Report" . date('Ymd') . ".csv";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv");
  $out = fopen("php://output", 'w');
  $flag = false;
  foreach($result_members as $row) {
    if(!$flag) {
      // display field/column names as first row
	 
      $firstline = array_map("map_colnames", array_keys($row));
      fputcsv($out, $firstline, ',', '"');
      $flag = true;
    }
    array_walk($row, 'cleanData');
    fputcsv($out, array_values($row), ',', '"');
  }
  fclose($out);
  exit;

		
		}
		
	function actionGenpdf()

	{ if (!empty($_POST['submit'])){

exit;

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


	
public function actionUpdateseller()
	{
		
			$connection = Yii::app()->db;
			 $sql_seller = "SELECT * FROM seller where id='".$_REQUEST['id']."'"; 
			$result_seller = $connection->createCommand($sql_seller)->query();
			$this->render('updateseller',array('seller'=>$result_seller));



			   



			



	}
	public function actionUpdatesseller()
	{
		
			$connection = Yii::app()->db;
			 $sql_seller1 = "SELECT * FROM seller"; 
			$result_seller1 = $connection->createCommand($sql_seller1)->query();
			 $sql_seller = "SELECT * FROM sdealer where id='".$_REQUEST['id']."'"; 
			$result_seller = $connection->createCommand($sql_seller)->query();
			$this->render('updatesseller',array('mdealer'=>$result_seller1,'seller'=>$result_seller));
}
	public function actionUpdate()
	{       
               $connection = Yii::app()->db;  
					
				 $s = "SELECT * FROM seller where id=".$_POST['id'];
			     $res = $connection->createCommand($s)->queryRow();
				 if ($_FILES['logo']["name"]==''){
				 $logo=$res['logo'];
					}else{
                $newfilename='';
				 $logo=$_FILES['logo']["name"];
				 $newfilename = $_FILES["logo"]["name"];
			 move_uploaded_file($_FILES["logo"]["tmp_name"],'images/seller/'.$newfilename);
				}
			 $sql="UPDATE seller set name='".$_POST['name']."',abbreviation='".$_POST['abbreviation']."',proprietor='".$_POST['proprietor']."',remarks='".$_POST['remarks']."',issued='".$_POST['issued']."',price='".$_POST['price']."',logo='".$logo."' where id='".$_POST['id']."' ";  
               $command = $connection -> createCommand($sql);
               $command -> execute();

	
			   $this->redirect(Yii::app()->baseUrl."/index.php/seller/seller_lis"); 

	}
	
	public function actionUpdatess()
	{       
               $connection = Yii::app()->db;  
					
				 $s = "SELECT * FROM sdealer where id=".$_POST['id'];
			     $res = $connection->createCommand($s)->queryRow();
				
			 $sql="UPDATE sdealer set name='".$_POST['name']."',abbreviation='".$_POST['abbreviation']."',proprietor='".$_POST['proprietor']."',remarks='".$_POST['remarks']."',mdealer='".$_POST['dealer']."' where id='".$_POST['id']."' ";  
               $command = $connection -> createCommand($sql);
               $command -> execute();

	
			   $this->redirect(Yii::app()->baseUrl."/index.php/seller/sdealer_lis"); 

	}
	public function actionDeleteplot()

	{          

			   $connection = Yii::app()->db;  
			  echo $query  = "DELETE from  plots where id='".$_REQUEST['id']."' AND status='' ";
		        $command = $connection -> createCommand($query);
                $command -> execute();

			   $this->redirect(Yii::app()->baseUrl."/index.php/plots/plots_lis");



	} 	

	 function actionEdit()
	 {



		 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{



			$this->layout='column3';



			$this->render('edit_register');



		}



		 



	}

public function actionPlots_list()
	{	



	if(Yii::app()->session['user_array']['per2']=='1')



			{



	$connection = Yii::app()->db; 



	



//	$sql_member = "SELECT * from plots where type='plot'";



	$sql_member = "SELECT



    plots.id



    , plots.street_id



    , plots.plot_size



	, plots.size2



    , plots.com_res



    , plots.create_date



	, plots.sector



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



where type='plot' ";



		$result_members = $connection->createCommand($sql_member)->query();



	



	    $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();



	   



	    $sql_sector ="SELECT DISTINCT sector FROM plots";



		$result_sector = $connection->createCommand($sql_sector)->query();



	



	 



	



			$this->render('plots_list',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector));



			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}
	public function actionSearchreq()

	 	{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
//$num_rec_per_page=40;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 	
//$start_from = ($page-1) * $num_rec_per_page; 
			$connection = Yii::app()->db; 
	$pro='';
			$size='';		
			$where='';
			$and = false;
				
			    
			
				if (isset($_POST['name']) && $_POST['name']!=""){
				$size=$_POST['name'];
				if ($and==true)
				{
					  $where.="where and name ='".$_POST['name']."'";
				}
				else
				{

					$where.="where name= '".$_POST['name']."'";
				}
				$and=true;
			}
			
			
			
			
	$connection = Yii::app()->db; 
    $sql_member = "SELECT * FROM seller  $where "; 
 	$result_members = $connection->createCommand($sql_member)->queryAll();
	
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
			

			 echo '<tr><td>'.$key['id'].'</td><td>'.$key['name'].'</td><td><img src="'.Yii::app()->request->baseUrl.'/images/seller/'.$key['logo'].'" width="100" height="130" /></td><td>'.$key['proprietor'].'</a></td><td>'.$key['issued'].'</td><td>'.$key['price'].'</td>';
				echo '<td><a href="updateseller?id='.$key['id'].'">Edit</a>/<a href="deleteseller?id='.$key['id'].'">Delete</a></td>';
			'</tr>';

			}

			}
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
	public function actionSearchreqs()

	 	{
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
//$num_rec_per_page=40;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 	
//$start_from = ($page-1) * $num_rec_per_page; 
			$connection = Yii::app()->db; 
	$pro='';
			$size='';		
			$where='';
			$and = false;
				
			    
			
				if (isset($_POST['name']) && $_POST['name']!=""){
				$size=$_POST['name'];
				if ($and==true)
				{
					  $where.="where and sdealer.name ='".$_POST['name']."'";
				}
				else
				{

					$where.="where sdealer.name= '".$_POST['name']."'";
				}
				$and=true;
			}
			
			
			
			
	$connection = Yii::app()->db; 
    $sql_member = "SELECT seller.name as sname,sdealer.* FROM sdealer
	left Join seller on sdealer.mdealer=seller.id
	  $where "; 
 	$result_members = $connection->createCommand($sql_member)->queryAll();
	
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
			

			 echo '<tr><td>'.$key['id'].'</td><td>'.$key['name'].'</td><td>'.$key['sname'].'</td><td>'.$key['proprietor'].'</a></td><td>'.$key['issued'].'</td><td>'.$key['price'].'</td>';
				echo '<td><a href="updatesseller?id='.$key['id'].'">Edit</a>/<a href="deletesseller?id='.$key['id'].'">Delete</a></td>';
			'</tr>';

			}

			}
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
	public function actionDeleteseller()
	{          
			   $connection = Yii::app()->db;  
			  $query  = "DELETE from seller where id='".$_REQUEST['id']."'";
		      $command = $connection -> createCommand($query);
              $command -> execute();
			   $this->redirect(Yii::app()->baseUrl."/index.php/seller/seller_lis");
	} 
	public function actionDeletesseller()
	{          
			   $connection = Yii::app()->db;  
			  $query  = "DELETE from sdealer where id='".$_REQUEST['id']."'";
		      $command = $connection -> createCommand($query);
              $command -> execute();
			   $this->redirect(Yii::app()->baseUrl."/index.php/seller/sdealer_lis");
	} 	
public function actionSeller_lis()
	{	
	   		
		
	$connection = Yii::app()->db; 
    $sql_member = "SELECT * FROM seller ";

		$result_members = $connection->createCommand($sql_member)->query();
			$this->render('seller_lis',array('members'=>$result_members));

	}
	public function actionSdealer_lis()
	{	
	   		
		
	$connection = Yii::app()->db; 
    $sql_member = "SELECT * FROM sdealer ";
	$result_members = $connection->createCommand($sql_member)->query();
	$this->render('sdealer_lis',array('members'=>$result_members));

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
	
	public function actionSeller()
	{

	
            $connection = Yii::app()->db; 

        	  
		  $this->render('seller');
		  

		



	}
		public function actionSdealer()
	{

	
          
$connection = Yii::app()->db; 
    $sql_member = "SELECT * FROM seller ";

		$result_members = $connection->createCommand($sql_member)->query();
        	  
		  $this->render('sdealer',array('seller'=>$result_members));
		  

		



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



