<?php







class PlotssalesController extends Controller



{


	public function actionUnsold_Residential(){
		if(isset(Yii::app()->session['user_array']['username']))
{

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


//$sql_project = "SELECT * from projects";
//$result_project = $connection->createCommand($sql_project)->query();


$sql_categories  = "SELECT * from categories";
$categories = $connection->createCommand($sql_categories)->query();
$sql_size  = "SELECT * from size_cat";
$sizes = $connection->createCommand($sql_size)->query();
$sql_sector ="SELECT * FROM sectors";
$result_sector = $connection->createCommand($sql_sector)->query();

$sql_com_res ="SELECT DISTINCT com_res FROM plots";
$result_com_res = $connection->createCommand($sql_com_res)->query();

$home=Yii::app()->request->baseUrl;

$this->render('unsold_residential',array('projects'=>$result_projects,'sectors'=>$result_sector,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
}else{
$this->redirect(array('user/dashboard'));
}
	
	}

	public function actionSearchunsoldr()
		{
			

			
			
			
			
			
			//for Pagination end
			$connection = Yii::app()->db;

$sql_project = "SELECT * from projects";
		$result_project = $connection->createCommand($sql_project)->query();
		
		
	
	$count=0;

		$home=Yii::app()->request->baseUrl;
$check=1;
$res=array();

$count++;
echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl;
$F='';
$M='';
$inc=0;
$open=0;
$hrlreserved=0;
$againstland=0;
$topen=0;
$thrlreserved=0;
$tagainstland=0;
$tvillas=0;
$total=0;
$gtotal=0;
$op=0;
  $com_res='';
if($_POST['com_res']=='Residential'){ $com_res='R';}
if($_POST['com_res']=='Commercial'){  $com_res='C';}
  $sql_plots  = "SELECT * from size_cat where typee='".$com_res."' Order by size_cat.id";
$result_plots = $connection->createCommand($sql_plots)->queryAll();	
foreach($result_plots as $row1)
{
	 

	$inc++;
echo '<tr><td>'.$inc.'</td><td>'.$row1['size'];
if($_POST['com_res']=='Residential'){ echo'&nbsp; (Residential)';}
if($_POST['com_res']=='Commercial'){ echo'&nbsp; (Commercial)';}
echo'</td>';
 $opensql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and status='' and ctag=''";
	 	$openres = $connection->createCommand($opensql)->query();
echo'<td style="text-align:right">'.count($openres).'</td>';
 $resvsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and ctag='HRL Reserved' and status=''";
	 	$resvres = $connection->createCommand($resvsql)->query();
echo'<td style="text-align:right">'.count($resvres).' </td>';
$alsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Against Land%' and status=''";
	 	$alres = $connection->createCommand($alsql)->query();
echo '<td style="text-align:right">'.count($alres).' </td>';
$villassql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Villas%' and status=''";
	 	$villasres = $connection->createCommand($villassql)->query();
echo '<td style="text-align:right">'.count($villasres).' </td>';
$total=count($openres)+count($resvres)+count($alres)+count($villasres);
echo'<td style="text-align:right">'.$total.'</td><td></td></tr>';
	$topen=$topen+count($openres);
	$thrlreserved=$thrlreserved+count($resvres);
	$tagainstland=$tagainstland+count($alres);
	$tvillas=$tvillas+count($villasres);
	$gtotal=$gtotal+$total;
}	
echo'<tr><td>Total</td><td></td><td style="text-align:right"><strong>'.$topen.'</srong></td><td style="text-align:right"><strong>'.$thrlreserved.'</srong></td><td style="text-align:right"><strong>'.$tagainstland.'</srong></td><td style="text-align:right"><strong>'.$tvillas.'</srong></td><td style="text-align:right"><strong>'.$gtotal.'</srong></td><td></td></tr><tr><td colspan="8">';
 ?>
 	<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="landscape">
</p>
<textarea name="html1" style="display:none;" cols="80" rows="20">

<title></title>
<style>
td{ padding:0px;  border-top:1px solid #000; border-left:1px solid #000;}


</style>
<h2 style="text-align:center">Unsold Plots Summary</h2>
  	<table width="100%" class="table table-striped table-new table-bordered">
<tr>
   <td style="border-bottom:thin solid #000"><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>"  width="270px">
   </td></tr>
  <br />
<tr>
<td width="5%" style="text-align:center">S.No</td>
<td width="15%" style="text-align:center">Plot Categories</td>
<td style="text-align:center">Open Plots</td>
<td colspan="3" style="text-align:center">Reserved 
</td>

<td style="text-align:center">Total Unsold</td>
<td width="20%" style="text-align:center; border:1px solid;">Remarks</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>

<td style="text-align:center">HRL Reserved Plots</td>
<td style="text-align:center">Against Land Plots</td>
<td style="text-align:center">Villas</td>
<td></td>
<td style="border-right:1px solid;"></td>
</tr>
<?php
$inc1=0;
foreach($result_plots as $row1)
{
	 

	$inc1++;
echo '<tr><td>'.$inc1.'</td><td>'.$row1['size'];
if($_POST['com_res']=='Residential'){ echo'&nbsp; (Residential)';}
if($_POST['com_res']=='Commercial'){ echo'&nbsp; (Commercial)';}
echo'</td>';
 $opensql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."' and status='' and ctag=''";
	 	$openres = $connection->createCommand($opensql)->query();
echo'<td style="text-align:right">'.count($openres).'</td>';
 $resvsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and ctag='HRL Reserved' and status=''";
	 	$resvres = $connection->createCommand($resvsql)->query();
echo'<td style="text-align:right">'.count($resvres).' </td>';
$alsql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Against Land%' and status=''";
	 	$alres = $connection->createCommand($alsql)->query();
echo '<td style="text-align:right">'.count($alres).' </td>';
$villassql  = "SELECT * from plots
	 where size2='".$row1['id']."' AND com_res='".$_POST['com_res']."' and project_id='".$_POST['project']."'  and  `ctag` LIKE '%Villas%' and status=''";
	 	$villasres = $connection->createCommand($villassql)->query();
echo '<td style="text-align:right">'.count($villasres).' </td>';
$total=count($openres)+count($resvres)+count($alres)+count($villasres);
echo'<td style="text-align:right">'.$total.'</td><td style="border-right:1px solid;"></td></tr>';
	$topen1=$topen+count($openres);
	$thrlreserved1=$thrlreserved+count($resvres);
	$tagainstland1=$tagainstland+count($alres);
	$tvillas1=$tvillas+count($villasres);
	$gtotal1=$gtotal+$total;
}
echo'<tr><td>Total</td><td></td><td style="text-align:right"><strong>'.$topen1.'</srong></td><td style="text-align:right"><strong>'.$thrlreserved1.'</srong></td><td style="text-align:right"><strong>'.$tagainstland1.'</srong></td><td style="text-align:right"><strong>'.$tvillas1.'</srong></td><td style="text-align:right"><strong>'.$gtotal1.'</srong></td><td style="border:1px solid;"></td></tr><tr><td colspan="8">';



?>
 
</table>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Print Report</button>
</div>
</form>
			<?php  echo'</td></tr>';}
	
	
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

	

	/**



	 * Creates a new model.



	 * If creation is successful, the browser will be redirected to the 'view' page.



	 */

public function actionSearchreq()

	 	{
			
			if (Yii::app()->session['user_array']['per3'] == '1')
			{
		$where='';
		$and=false;
			if ( isset($_POST['project']) &&  $_POST['project']!=""){				
				if ($and==true)
				{
					$where.=" and plots.project_id LIKE '%".$_POST['project']."%'";
				}
				else
				{
					$where.=" plots.project_id LIKE '%".$_POST['project']."%'";
				}
				$and=true;
			}
		 if (isset($_POST['sector']) && $_POST['sector']!=""){
			
                $where.=" and plots.sector ='".$_POST['sector']."'";
				$and = true;
				$sector=$_POST['sector'];
			}
			if (isset($_POST['com_res']) && $_POST['com_res']!=""){
				$plot_detail_address=$_POST['com_res'];
				if ($and==true)
				{
					  $where.=" and size_cat.typee ='".$_POST['com_res']."'";
				}
				else
				{

					$where.=" size_cat.typee ='".$_POST['com_res']."'";
				}
				$and=true;
			}
			if ($and==true)
				{
					$where.="  and type='plot' ";
				}
				else
				{
					$where.="type='plot' ";
				}
				//$and=true;

			if (isset($_POST['plotno']) && $_POST['plotno']!=""){
				$plotno=$_POST['plotno'];
				if ($and==true)
				{
					  $where.=" and plots.plot_detail_address ='".$_POST['plotno']."'";
				}
				else
				{
					$where.=" plots.plot_detail_address ='".$_POST['plotno']."'";
				}
				$and=true;
			}
if (isset($_POST['plotno1']) && $_POST['plotno1']!=""){
				$plotno=$_POST['plotno1'];
				if ($and==true)
				{
					  $where.=" and memberplot.plotno  Like '%".$_POST['plotno1']."%'";
				}
				else
				{
					$where.=" memberplot.plotno Like '%".$_POST['plotno1']."%'";
				}
				$and=true;
			}
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
if (isset($_POST['ctag']) && $_POST['ctag']!=""){
				if ($and==true)
				{
					  $where.=" and plots.ctag LIKE '%".$_POST['ctag']."%'";
				}
				else
				{
					$where.=" plots.ctag LIKE '%".$_POST['ctag']."%'";
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
			if (!empty($_POST['stat'])){
			if($_POST['stat']==1){$where.="and plots.rstatus ='reallocated'";}
			if($_POST['stat']==2){$where.="and plots.status ='Alotted'";}
			if($_POST['stat']==3){$where.="and plots.status =''";}
			if($_POST['stat']==4){$where.="and plots.bstatus ='reserved'";}
				if($_POST['stat']==5){$where.=" and plots.status ='' and plots.ctag !='HRL Reserved'";}
						$and = true;	
			 } 
			if (isset($_POST['street_id']) && $_POST['street_id']!=""){
				$st=$_POST['street_id'];
				if ($and==true)
				{
					$where.=" and plots.street_id='".$_POST['street_id']."'";
				}
				else
				{
					$where.=" plots.street_id='".$_POST['street_id']."'";
				}
				$and=true;
			}
			$connection = Yii::app()->db; 

 $sql_member = "SELECT

    plots.id

    , plots.street_id

    , plots.plot_size
, plots.project_id
    , plots.com_res

	 , plots.size2

    , plots.rstatus

	, plots.sector

	, plots.category_id

	, plots.status

	, memberplot.fstatus

	, plots.bstatus

	, plots.plot_detail_address

	, memberplot.plotno

    , projects.project_name

	, streets.street

	, size_cat.size
	,sector_name

FROM

   plots

    Left JOIN streets  ON (plots.street_id = streets.id)

	".$extra1."

	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)

	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)

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

		

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_size  = "SELECT * from size_cat";



		$sizes = $connection->createCommand($sql_size)->query();

		

 

	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 

$check=1;

    $res=array();



            foreach($result_members as $key){



            $count++;

			/*?>$catplot=array();

			$sql_categories1  = "SELECT * from cat_plot where plot_id='".$key['id']."'";

			$categories1 = $connection->createCommand($sql_categories1)->query();

			foreach($categories1 as $wr1){$catplot[]= $wr1['cat_id'];};

			if(isset($_POST['cat']) && $_POST['cat']!=''){

			$check=0;	

			//print_r($catplot);exit;

			//print_r($_POST['cat']);exit;

			

			if (count(array_diff($_POST['cat'], array_keys($catplot))) == 0) {

			

			$check=1;	

			}

			}<?php */

		

			

			echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl; 
			$F='';

			$M='';

			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['com_res'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['rstatus'].'</td>';
			echo '<td>';


			if($key['status']==''){ 

			echo 'Allot';

			}elseif($key['status']=='Requested'){if(!empty($key['fstatus'])){$M='M';}else{$F='F'; } echo'<a href="'.$home.'/index.php/memberplot/requested_detail?id='.$key['id'].'">' ."Requested".'('.$M.$F.')'.'</a>';

			}else{ echo $key['status'];}echo '</td>

			<td>'.$key['bstatus'].'</td>';

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









	public function actionCreate()



	{ 



	      $connection = Yii::app()->db;  



	 



	         $error =array();

			if(isset($_POST['project_id']) && empty($_POST['project_id']))

			{

         	$error = 'Please Select Plot Project<br>';

			}



			if(isset($_POST['street_id']) && empty($_POST['street_id']))







			{







				$error .= 'Please Select Plot Street<br>';







			}



			if(isset($_POST['price']) && empty($_POST['price']))







			{







				$error .= 'Please Enter Plot Price<br>';







			}

             if(isset($_POST['size2']) && empty($_POST['size2']))







			{







				$error .= 'Please Enter Plot Size<br>';







			}

			



			if(isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address']))







			{







				$error .= 'Please Enter Plot No<br>';







			}



			



			if(isset($_POST['com_res']) && empty($_POST['com_res']))







			{







				$error .= 'Please Select Type<br>';







			}



				if(isset($_POST['sector']) && empty($_POST['sector']))







			{







				$error .= 'Please Select Sector<br>';







			}



				if(isset($_POST['noi']) && empty($_POST['noi']))







			{







				$error .= 'Please Enter No.Of Installment<br>';







			}



				if(isset($_POST['plot_size']) && empty($_POST['plot_size']))







			{







				$error .= 'Please Enter Plot Diemension<br>';







			}



				if(isset($_POST['cstatus']) && empty($_POST['cstatus']))







			{







				$error .= 'Please Select Status<br>';







			}



			 



			 $sq  = "SELECT * from plots where project_id='".$_POST['project_id']."' AND sector='".$_POST['sector']."' AND street_id='".$_POST['street_id']."' AND plot_detail_address='".$_POST['plot_detail_address']."' and type='plot'";

			 $result_sq = $connection->createCommand($sq)->queryAll();

			 $count=0;

			 $re=array();

			 foreach($result_sq as $key1){$count=$count+1;}

			if($count!=0)

			 {

				  $error="A Plot Is Already Added On This Address Please Enter Another Plot Address  ";



			}	

			 



			  if(empty($error))







			{



            $sql  = 'INSERT INTO plots 



                	      (type,project_id,street_id, plot_detail_address, plot_size, size2,price,create_date, com_res,sector,cstatus,bstatus )



               	    	  VALUES ( "'.$_POST['type'].'","'.$_POST['project_id'].'", "'.$_POST['street_id'].'", "'.$_POST['plot_detail_address'].'", "'.$_POST['plot_size'].'", "'.$_POST['size2'].'", "'.$_POST['price'].'", "'.date('Y-m-d h:i:s').'" ,"'.$_POST['com_res'].'","'.$_POST['sector'].'"



						 ,"'.$_POST['cstatus'].'","open")';	



               $command = $connection -> createCommand($sql);

			   $command -> execute();

			   $last_insert_id = Yii::app()->db->getLastInsertID();

			   //Adding  to Database

		 $num_of_category = 'SELECT count(id) as num_of_category from categories';

		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();

		$res=array();

		foreach($num_of_category as $num_of_category)

		{

			$num_of_category = 	$num_of_category['num_of_category'];

		}

		while ($num_of_category>0)

		{

			if (isset($_POST[$num_of_category]))

				{			 

					$cat_id = $_POST[$num_of_category]; 

					$connection = Yii::app()->db;

					$add_project_per_query = "insert into cat_plot 

												set plot_id='".$last_insert_id."',cat_id='".$cat_id."' ";

					$command = $connection -> createCommand($add_project_per_query);

					$command -> execute();

				}

			$num_of_category--;

		}



	          	echo $note="New Record Inserted Successfully";

				echo '<a target="_blank" href="upload_image?id='.$last_insert_id.'"><input type="button" class="btn-info" value="Add Image">';



			



	}



	else{



		echo $error;



		}



		



		}

		public function actionUpload_image()



	{



		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))



		{ 



		$this->layout='//layouts/back';



		$this->render('upload_image');



		}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/user"); }

	}

public function actionPlotimage()



{		$connection = Yii::app()->db;  

		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

				{ 

				 $id= $_POST['id'];

				

           

				$time_rand = time();



				$target_path="images/plots/";



				$target_path = $target_path.$time_rand.$_FILES['image']['name'];



				$ad=explode('.',$_FILES['image']['name']); 



				$rnd=sizeof($ad);



				$ads=$rnd-1;



			     move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

				 $sql="UPDATE plots SET image='".$time_rand.$_FILES['image']['name']."' WHERE id=$id ";

				$command = $connection -> createCommand($sql);

			    $command -> execute();



			    $this->redirect('plots_lis'); 

 		}	



	



}





public function actionUpdateplot()



	



	{



		if(Yii::app()->session['user_array']['per3']=='1')



			{



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



	, plots.project_id



	, plots.street_id



	, plots.plot_detail_address



	, memberplot.plotno



    , projects.project_name



		, streets.street

			, size_cat.size



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)



	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)

   Left JOIN size_cat  ON (plots.size2 = size_cat.id)



	



where plots.id='".$_REQUEST['id']."'"; 



			$result_plots = $connection->createCommand($sql_plots)->query();



		//	$sql_plots  = "SELECT * from plots where id='".$_REQUEST['id']."'";



			//$result_plots = $connection->createCommand($sql_plots)->query();

			 Yii::app()->session['projects_array'];

			

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



			$num_of_category = 'SELECT count(id) as num_of_category from categories';



		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();



		



	        $sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();	



			$sql_size  = "SELECT * from size_cat";



		    $result_size = $connection->createCommand($sql_size)->query();



			$sql12  = "SELECT categories.name,cat_plot.id from cat_plot



			Left JOIN categories  ON (cat_plot.cat_id = categories.id)



			 where plot_id='".$_REQUEST['id']."'";



		    $result12 = $connection->createCommand($sql12)->queryAll();



		



			$this->render('updateplot',array('plots'=>$result_plots,'projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'cat'=>$result12));



			   



			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	public function actionUpdate()



	{       

	             $connection = Yii::app()->db;  

				 $s = "SELECT * FROM plots where id=".$_POST['id'];

			     $res = $connection->createCommand($s)->queryRow();

				 if ($_FILES['image']["name"]==''){

				 $image=$res['image'];

					}else{ 

                $image=$_FILES['image']["name"];			

				$newfilename = $_FILES["image"]["name"];

				move_uploaded_file($_FILES["image"]["tmp_name"],

				'images/plots/'.$newfilename);

				}



			 $sql="UPDATE plots set project_id='".$_POST['project_id']."',street_id='".$_POST['street_id']."',plot_detail_address='".$_POST['plot_detail_address']."',plot_size='".$_POST['plot_size']."',size2='".$_POST['size2']."',price='".$_POST['price']."',create_date='".date('Y-m-d h:i:s')."',com_res='".$_POST['com_res']."',sector='".$_POST['sector']."',image='".$image."',cstatus='".$_POST['cstatus']."' where id='".$_POST['id']."' ";  



               $command = $connection -> createCommand($sql);



               $command -> execute();



			   $last_insert_id = Yii::app()->db->getLastInsertID();

			   //Adding  to Database

		$num_of_category = 'SELECT count(id) as num_of_category from categories';

		 $num_of_category = $connection->createCommand($num_of_category)->queryAll();

		$res=array();

		foreach($num_of_category as $num_of_category)



		{

			$num_of_category = 	$num_of_category['num_of_category'];

		}

		if($num_of_category>0)

		{$query  = 'DELETE from  cat_plot 



			   where plot_id='.$_REQUEST['id'].' ';



		        $command = $connection -> createCommand($query);



               $command -> execute();}



		while ($num_of_category>0)



		{

			if (isset($_POST[$num_of_category]))



				{

					$cat_id = $_POST[$num_of_category]; 

					$connection = Yii::app()->db;

					//$add_project_per_query = "insert into cat_plot	set plot_id='".$last_insert_id."',cat_id='".$cat_id."' ";

					$add_project_per_query = "INSERT into cat_plot	set cat_id='".$cat_id."', plot_id='".$_REQUEST['id']."' ";

					$command = $connection -> createCommand($add_project_per_query);

					$command -> execute();

				}

			$num_of_category--;

		}

			  // $this->redirect('plots/plots_list');



			   $this->redirect(Yii::app()->baseUrl."/index.php/plots/plots_lis"); 

	}



	public function actionDeleteplot()

	{          

			   $connection = Yii::app()->db;  
			  echo $query  = "DELETE from  plots where id='".$_REQUEST['id']."' AND status='' ";
		        $command = $connection -> createCommand($query);
                $command -> execute();

			   $this->redirect(Yii::app()->baseUrl."/index.php/plots/plots_lis");



	} 	



		







	/**



	 * Updates a particular model.



	 * If update is successful, the browser will be redirected to the 'view' page.



	 * @param integer $id the ID of the model to be updated



	 */



	 



	 



	public function actionReallocate()



	



	{



		if(Yii::app()->session['user_array']['per1']=='1')



			{



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



    , projects.project_name



	, categories.name



	, streets.street

	, plots.project_id

	, size_cat.size



	



	



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)



	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)



	Left JOIN categories  ON (plots.category_id = categories.id)

	Left JOIN size_cat  ON (plots.size2 = size_cat.id)



where plots.id='".$_REQUEST['id']."'";



		//	$sql_plots  = "SELECT * from plots where id='".$_REQUEST['id']."'";



			$result_plots = $connection->createCommand($sql_plots)->query();



			$sql  = "SELECT * from projects";



			$result = $connection->createCommand($sql)->query();



	



			$this->render('reallocate',array('plots'=>$result_plots,'projects'=>$result));



			   



			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	



	 



	 ///////////////////REALLOCATE THE PLOT////////////////



	  



		public function actionReallocation()

	{          $error='';
			    $connection = Yii::app()->db;  
			if(isset($_POST['street_id']) && empty($_POST['street_id']))
			{
				$error .= 'Please Select Plot Street<br>';
			}
			if(isset($_POST['price']) && empty($_POST['price']))
			{
				$error .= 'Please Enter Plot Price<br>';
			}
          
			if(isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address']))
			{
				$error .= 'Please Enter Plot No<br>';
			}
		
				if(isset($_POST['sector']) && empty($_POST['sector']))
			{
				$error .= 'Please Select Sector<br>';
			}

				if(isset($_POST['plot_size']) && empty($_POST['plot_size']))

			{
				$error .= 'Please Enter Plot Diemension<br>';
			}

				
		 

			 $sq  = "SELECT * from plots where project_id='".$_POST['project_id']."' AND street_id='".$_POST['street_id']."' AND plot_detail_address='".$_POST['plot_detail_address']."' ";
			 $result_sq = $connection->createCommand($sq)->queryAll();
			 $count=0;
			 $re=array();
			 foreach($result_sq as $key1){$count=$count+1;}
			if($count!=0)
			 {
				  $error.="A Plot Is Already Added On This Address Please Enter Another Plot Address  ";

			}	
			 

			  if(empty($error))



			{  
			   $plots="SELECT * FROM plots where id=".$_POST['id']."";
			   $plo = $connection->createCommand($plots)->query();
			   foreach($plo as $key){
			   $sql  = 'INSERT INTO reallocation_history (type,plot_id,project_id,street_id, plot_detail_address, plot_size, size2,price,create_date, com_res,sector,cstatus )
               VALUES ( "'.$key['type'].'","'.$_POST['id'].'","'.$key['project_id'].'", "'.$key['street_id'].'", "'.$key['plot_detail_address'].'",
			   "'.$key['plot_size'].'", "'.$key['size2'].'", "'.$key['price'].'", "'.$key['create_date'].'" ,"'.$key['com_res'].'","'.$key['sector'].'","'.$key['cstatus'].'")';
			   $command = $connection -> createCommand($sql);
        	   $command -> execute();
			   }
			   
			  
	   $update  = "UPDATE  plots set type='Plot',plot_detail_address='".$_POST['plot_detail_address']."',street_id='".$_POST['street_id']."',plot_size='".$_POST['plot_size']."',price='".$_POST['price']."',create_date='".date('Y-m-d h:i:s')."',sector='".$_POST['sector']."', rstatus='reallocated' 
			   where id='".$_POST['id']."'"; 
		      $command = $connection -> createCommand($update);
              $command -> execute();
			  $sql_email  = "SELECT
    plots.id
    , plots.street_id
    , plots.plot_size
    , plots.com_res
	 , plots.size2
    , plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
	, memberplot.fstatus
	, plots.bstatus
	, plots.price
	, plots.plot_detail_address
	, memberplot.plotno
    , projects.project_name
	, streets.street
	, size_cat.size
	, members.name
	, members.email
FROM
   plots
    Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN members  ON (members.id = memberplot.member_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)

where  plots.id ='".$_POST['id']."'";
$result_email = $connection->createCommand($sql_email)->queryRow();
//print_r($result_email);exit;
#####################################
# Include PHP Mailer Class
#####################################
require("email/class.phpmailer.php");
#####################################
# Function to send email
#####################################
function sendEmail ($fromName, $fromEmail, $toEmail, $subject, $emailBody) {
	$mail = new PHPMailer();
	$mail->FromName = $fromName;
	$mail->From = $fromEmail;
	$mail->AddAddress("$toEmail");
		
	$mail->Subject = $subject;
	$mail->Body = $emailBody;
	$mail->isHTML(true);
	$mail->WordWrap = 150;
		
	if(!$mail->Send()) {
		return false;
	} else {
		return true;
	}
}

#####################################
# Function to Read a file 
# and store all data into a variable
#####################################
function readTemplateFile($FileName) {
		$fp = fopen($FileName,"r") or exit("Unable to open File ".$FileName);
		$str = "";
		while(!feof($fp)) {
			$str .= fread($fp,1024);
		}	
		return $str;
}
#####################################
# Finally send email
#####################################

	//Data to be sent (Ideally fetched from Database)
	$name = $result_email['name'];
	$plot_detail_address = $result_email['plot_detail_address'];
	$street = $result_email['street'];
	$project_name = $result_email['project_name'];
	$plot_size = $result_email['plot_size'];
	$size = $result_email['size'];
	$com_res = $result_email['com_res'];
	$price = $result_email['price'];
	
	//Send email to user containing username and password
	//Read Template File 
	$emailBody = readTemplateFile("email/reallocatedmail.html");
		$UserEmail=$result_email['email'];	
	//Replace all the variables in template file
	$emailBody = str_replace("#name#",$name,$emailBody);
	$emailBody = str_replace("#plot_detail_address#",$plot_detail_address,$emailBody);
	$emailBody = str_replace("#street#",$street,$emailBody);
	$emailBody = str_replace("#plot_size#",$plot_size,$emailBody);
	$emailBody = str_replace("#size#",$size,$emailBody);
	$emailBody = str_replace("#com_res#",$com_res,$emailBody);
	$emailBody = str_replace("#price#",$price,$emailBody);
				
	//Send email
	$emailStatus = sendEmail ("RDLPK", "admin@rdlpk.com", $UserEmail, "Re-allocated Plot", $emailBody);
	echo"Plot Reallocated Successfully";
	//If email function return false
		   
			}
			 else{
				 
				 echo $error;
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



	public function actionReallocated()



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



where type='plot' AND plots.rstatus='reallocated' ";



		$result_members = $connection->createCommand($sql_member)->query();



	



	    $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();



	   



	    $sql_sector ="SELECT DISTINCT sector FROM plots";



		$result_sector = $connection->createCommand($sql_sector)->query();



	



	 



	



			$this->render('plots_list',array('members'=>$result_members,'projects'=>$result_project,'sectors'=>$result_sector));



			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	



	public function actionHistory()



	{	



	if(Yii::app()->session['user_array']['per2']=='1')



			{



	$connection = Yii::app()->db;



			$sql_projects  = "SELECT * from plothistory where plot_id='".$_REQUEST['id']."'";



			$result_projects = $connection->createCommand($sql_projects)->query();



			



			$sql_page  = "SELECT * from memberplot where plot_id='".$_REQUEST['id']."'";



			$result_pages = $connection->createCommand($sql_page)->query();



			



			$this->render('history',array('projects'=>$result_projects,'pages'=>$result_pages));



			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	

public function actionPlots_lis()



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

		

		

		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

		

		

		//$sql_project = "SELECT * from projects";



		//$result_project = $connection->createCommand($sql_project)->query();



	



		



		$sql_categories  = "SELECT * from categories";



		$categories = $connection->createCommand($sql_categories)->query();



		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();



	    $sql_sector ="SELECT * FROM sectors";



		$result_sector = $connection->createCommand($sql_sector)->query();

		

	    $sql_com_res ="SELECT DISTINCT com_res FROM plots";



		$result_com_res = $connection->createCommand($sql_com_res)->query();



		

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

			else {echo '<td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td>';}

			'</tr>'; 



            }}



			$this->render('plots_lis',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));



			



	   



	}



	



	



	



	



	



	public function actionPlotsli()



{	



		



	   



	   		$plotno='';



			$st='';



			$pro='';



			$sector='';



			$cat='';



			$where='';



			$and = false;



			$where='';



			



				



			



			



			



		



		if (isset($_POST['search'])){ 



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



	public function actionAjaxRequest6($val1)

	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from plots where plot_detail_address='".$val1."'";

		$result_city = $connection->createCommand($sql_city)->query();

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

	echo json_encode($city); exit();

	}



	public function actionAjaxRequest7($val1, $val2)

	{	

		$connection = Yii::app()->db;  

		$sql_city  = "SELECT * from plots where project_id='".$val2."' AND plot_detail_address='".$val1."' ";

		$result_city = $connection->createCommand($sql_city)->query();

		$city=array();

		foreach($result_city as $cit){

			$city[]=$cit;

			} 

	echo json_encode($city); exit();

	}





	public function actionAjaxRequest($val1)



	{



			$connection = Yii::app()->db;  



		$sql_street  = "SELECT * from sectors where project_id='".$val1."'";



		$result_streets = $connection->createCommand($sql_street)->query();



			



		$street=array();



		foreach($result_streets as $str){



			$street[]=$str;



			} 



		



	echo json_encode($street); exit();



	}

public function actionAjaxRequest2($pro,$sec)
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



	







	



	



	public function actionPlots()



	



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

			$sql_categories  = "SELECT * from categories";

		    $categories = $connection->createCommand($sql_categories)->query();

			$this->render('plots',array('projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size));

			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



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

//new fuctions for plots reporting 

public function actionReporting()

	{

			$this->render('reporting');

	} 

public function actionReportmain()

	{

		if(isset($_POST['reporting'])){

			$this->render('reporting');

		}

	if(isset($_POST['dreportr'])){

			$this->render('dreportr');

	

	}

	if(isset($_POST['dreportc'])){

			$this->render('dreportc');

	}



	if(isset($_POST['dreporta'])){

		

			$this->render('dreporta');

	}



	if(isset($_POST['dreportt'])){

			$this->render('dreportt');

	}



	if(isset($_POST['dreportre'])){

			$this->render('dreportre');

	}



	if(isset($_POST['report'])){	

			$this->render('report');

	}

	}	

}



