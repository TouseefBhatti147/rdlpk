<?php

class FilesController extends Controller
{
public function actionMerge()
	{     
	   $connection = Yii::app()->db;  
		if(Yii::app()->session['user_array']['per4']=='1')
			{
				
			$error='';
		  $error =array();
		
			
	  	 	if(isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address']))
			{
				$error = 'Please Enter Plot No.<br>';
			}
			if(!empty($_POST['plot_detail_address'])){
			$sq  = "SELECT * from plots where project_id='".$_POST['project_id']."' AND plot_detail_address='".$_POST['plot_detail_address']."' and type='Plot'"; 
			 $result_sq = $connection->createCommand($sq)->queryRow();
			if(empty($result_sq )){
				$error='Plot Not found';}
				}	
			if(empty($error)){
				
			$sql="UPDATE plots set type='Plot',street_id='".$result_sq['street_id']."',plot_detail_address='".$result_sq['plot_detail_address']."',plot_size='".$result_sq['plot_size']."',size2='".$result_sq['size2']."',sector='".$result_sq['sector']."',image='".$result_sq['image']."' where id='".$_POST['id']."' ";  
               $command = $connection -> createCommand($sql);
               $command -> execute();	
				
				$cat_plot="select * from cat_plot where plot_id='".$result_sq['id']."'";
				$result_cat = $connection->createCommand($cat_plot)->queryAll();
				foreach($result_cat as $row){
				$updatecat="UPDATE cat_plot SET plot_id='".$_POST['id']."' where plot_id='".$row['plot_id']."'";
				$command = $connection -> createCommand($updatecat);
               $command -> execute();
			  	}
				 $query  = 'DELETE from  plots 
			   where id='.$result_sq['id'].'';
		        $command = $connection -> createCommand($query);

               $command -> execute();

				echo 'Successfully Convert';
				
				}else{
					
					echo $error;
					
					}
	    
				
		
				 
			}


	}
	public function actionMergeplot()

	

	{

		if(Yii::app()->session['user_array']['per4']=='1')

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

		

			$this->render('mergeplot',array('plots'=>$result_plots,'projects'=>$result_projects,'categories'=>$categories,'size'=>$result_size,'cat'=>$result12));

			   

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	}


	public function actionCreate()

	{ 

		if(Yii::app()->session['user_array']['per4']=='1')

			{

				$connection = Yii::app()->db;





			$error ='';

			if(isset($_POST['project_id']) && empty($_POST['project_id']))

			{

				$error = 'Please Select File Project<br>';

			}

			

			if(isset($_POST['street_id']) && empty($_POST['street_id']))

			{



				$error .= 'Please Select File Street<br>';



			}



			if(isset($_POST['price']) && empty($_POST['price']))

			{

				$error .= 'Please Enter File Price<br>';

			}

			if(isset($_POST['file_detail_address']) && empty($_POST['file_detail_address']))

			{

				$error .= 'Please Enter File No<br>';

			}



			if(isset($_POST['size2']) && empty($_POST['size2']))

			{

				$error .= 'Please Enter File Size<br>';

			}

	

			if(isset($_POST['com_res']) && empty($_POST['com_res']))

			{

				$error .= 'Please Select Type<br>';

			}



				if(isset($_POST['sector']) && empty($_POST['sector']))

			{

				$error .= 'Please Select Sector<br>';

			}



			
				if(isset($_POST['file_size']) && empty($_POST['file_size']))

			{

				$error .= 'Please Select File Diemension<br>';

			}

			

				 $sq  = "SELECT * from plots where project_id='".$_POST['project_id']."' AND sector='".$_POST['sector']."' AND street_id='".$_POST['street_id']."' AND plot_detail_address='".$_POST['file_detail_address']."'";

			$result_sq = $connection->createCommand($sq)->queryAll();

			 $count=0;

			 $re=array();

			 foreach($result_sq as $key1){$count=$count+1;}

			if($count!==0)

			 {

				  $error .="A File Is Already Added On This Address Please Enter Another Plot Address  ";



		 	}	

  



				

        if(empty($error))

			{

              $sql  = 'INSERT INTO plots 

 (type,project_id,street_id, plot_detail_address, plot_size, size2, com_res,price,sector,create_date )

               	    	  VALUES ( "file","'.$_POST['project_id'].'", "'.$_POST['street_id'].'", "'.$_POST['file_detail_address'].'", "'.$_POST['file_size'].'", "'.$_POST['size2'].'", "'.$_POST['com_res'].'", "'.$_POST['price'].'", "'.$_POST['sector'].'","'.date('Y-m-d h:i:s').'" )';		

               $command = $connection -> createCommand($sql);

               $command -> execute();



			    echo $note="New Record Inserted Successfully";



			//  $this->redirect('files/files_list');

		} 

			if(!empty($error)){

			echo $error;



			}



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







	 function actionMultiplefile()







	 { 







	 if(Yii::app()->session['user_array']['per4']=='1')







			{







		







			$connection = Yii::app()->db;  







			$sql_project  = "SELECT * from projects";







			$result_projects = $connection->createCommand($sql_project)->query();







			$this->render('multiplefile',array('projects'=>$result_projects));







			$error = '';







		







		







			}







			else{







				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }







	 }







	 







	 public function actionCreatemultifile()







	{







		 







		if(Yii::app()->session['user_array']['per4']=='1')







			{







		







		if ((isset($_POST['project_id']) && empty($_POST['project_id'])) || (isset($_POST['street_id']) && empty($_POST['street_id'])) || (isset($_POST['file_detail_address']) && 	empty($_POST['file_detail_address'])) || (isset($_POST['file_size']) && empty($_POST['file_size']))|| (isset($_POST['type']) && empty($_POST['price']))|| (isset($_POST['noi']) && empty($_POST['type'])))







			{







				$error = 'Please complete all required fields <br />';







			}







						







			$i=0;







			do {







			$i++;







			







			   $connection = Yii::app()->db;  







               $sql  = 'INSERT INTO plots (type,project_id,street_id, plot_detail_address, plot_size, com_res,price,installment,create_date )







               	    	  VALUES ( "'.$_POST['type'].'","'.$_POST['project_id'].'", "'.$_POST['street_id'].'", "'.$_POST['file_detail_address'].'", "'.$_POST['file_size'].'", "'.$_POST['com_res'].'", "'.$_POST['price'].'","'.$_POST['noi'].'","'.date('Y-m-d h:i:s').'" )';  







			 $command = $connection -> createCommand($sql);







			 $command -> execute();







			} while ($i < $_POST['nof']);







			  $this->redirect('files/multiplefile'); 







			







	}	







	}







	 public function actionFiles_list()







	{	







	if(Yii::app()->session['user_array']['per4']=='1')







			{







	$connection = Yii::app()->db; 







	$sql_member = "SELECT * from plots where type='file'";







		$result_members = $connection->createCommand($sql_member)->query();







			$this->render('files_list',array('members'=>$result_members));







			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }







	}







	







	//////////////////////////PLOT LIST///////////







	public function actionPlots_list()







	{	







			if(Yii::app()->session['user_array']['per3']=='1')







			{







	$connection = Yii::app()->db; 







	$sql_member = "SELECT * from plots";







		$result_members = $connection->createCommand($sql_member)->query();







			$this->render('plots_list',array('members'=>$result_members));







			}







	}







	///////////////////////////////////////////CONVERT2 PLOT view/////////////







	







		 







	public function actionConvert2plot()







	     {







		 







		 if(Yii::app()->session['user_array']['per3']=='1')







			{







			$connection = Yii::app()->db;



			 $sql_details = "SELECT 



			 



    plots.*



    , plots.plot_size



    , plots.com_res



	 , plots.size2



    , plots.create_date



	, plots.sector



	, plots.category_id



	, plots.status



	, plots.plot_detail_address



    , projects.project_name



	, streets.street



	



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)



	Left JOIN projects  ON (plots.project_id = projects.id)



	



where plots.id='".$_REQUEST['id']."' and type ='file'"; 	







		//	$sql_details  = "SELECT * from plots where id='".$_REQUEST['id']."' and type ='file'";







			$result_details = $connection->createCommand($sql_details)->query();







		 	







			$sql = "SELECT * from plotpayment where plot_id='".$_REQUEST['id']."' and payment_type='Installment'";







			$result = $connection->createCommand($sql)->queryAll();



		  $sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();



			



			







			







			$this->render('convert2plot',array('convert2plot'=>$result_details,'result'=>$result,'categories'=>$categories));







	







			}else{$this->redirect(array("dashboard"));}















	   }







	







	







	







//////////////////////////Convert to  file to plot code







	 public function actionC2p()

	{

		if(Yii::app()->session['user_array']['per3']=='1')
			{
	   $connection = Yii::app()->db; 
			  $sql = "UPDATE plots SET type ='".$_POST['type']."',street_id ='".$_POST['street_id']."',sector ='".$_POST['sector']."',plot_detail_address ='".$_POST['plot_detail_address']."',price ='".$_POST['price']."',modify_date ='".date('Y-m-d h:i:s')."' where id='". $_REQUEST['pid']."' ";

			  $command = $connection -> createCommand($sql);
			 $command -> execute();
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



												set plot_id='".$_REQUEST['pid']."',cat_id='".$cat_id."' 



												";



					$command = $connection -> createCommand($add_project_per_query);



				



					$command -> execute();



					



				}



			$num_of_category--;



		}







			}







			 $this->redirect('files_lis'); 







	}







////////////////////////history/////////







	







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







	}







	}







	public function actionMember_lis()







	{	







		if(Yii::app()->session['user_array']['per2']=='1')







			{







		







			$where='';







			if ($_POST['firstname']!=""){







				$where.="WHERE m.firstname LIKE '%".$_POST['firstname']."%'";







			}







			if ($_POST['sodowo']!=""){







				$where.="WHERE m.sodowo LIKE '%".$_POST['sodowo']."%'";







			}







			if ($_POST['cnic']!=""){







				$where.="WHERE m.cnic LIKE '%".$_POST['cnic']."%'";







			}







			if ($_POST['plot_size']!=""){







				$where.="WHERE p.plot_size LIKE '%".$_POST['plot_size']."%'";







			}







			if ($_POST['project_name']!=""){







				$where.="WHERE j.project_name LIKE '%".$_POST['project_name']."%'";







			}







			if ($_POST['plot_detail_address']!=""){







				if($where!='')







					$where.=" AND ";







				else $where.=' WHERE ';







				$where.="p.plot_detail_address LIKE '%".$_POST['plot_detail_address']."%'";







			}







			







			$connection = Yii::app()->db; 







			$sql_member = "SELECT mp.member_id,mp.create_date, m.firstname,m.sodowo,m.cnic,p.plot_detail_address, 					p.plot_size,s.street, j.project_name FROM 		             memberplot mp left join members m on mp.member_id=m.id left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id left join projects j on        		s.project_id=j.id    $where "; $result_members = $connection->createCommand($sql_member)->query();







			$this->render('member_lis',array('members'=>$result_members));







	}







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



 public function actionSearchreq()

	 	{
			
		if(Yii::app()->session['user_array']['per2']=='1')
			{
			

			$com_res='';

			$size='';



		$where='';



		$and=false;

		 

				 if (isset($_POST['com_res']) && $_POST['com_res']!=""){

				$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";

				$and = true;

				$com_res=$_POST['com_res'];

			}

		 if (isset($_POST['sector']) && $_POST['sector']!=""){



				$where.="plots.sector LIKE '%".$_POST['sector']."%'";



				$and = true;



				$sector=$_POST['sector'];



			}



			



			if ($and==true)



				{



					$where.="  and type='file' ";



				}



				else



				{



					$where.="type='file' ";



				}



				$and=true;



			



			



			



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



				if (isset($_POST['size']) && !empty($_POST['size'])){



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





			



			if (isset($_POST['cat']) && $_POST['cat']!=""){



				$plotno=$_POST['cat'];



				if ($and==true)



				{



					  $where.=" and plots.cat LIKE '%".$_POST['cat']."%'";



				}



				else



				{



					$where.=" plots.cat LIKE '%".$_POST['cat']."%'";



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



			

		 if (!empty($_POST['stat'])){

			//if($_POST['stat']==1){$where.="and plots.rstatus ='reallocated'";}

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
$sql_memberas = "SELECT * FROM plots
    Left JOIN streets  ON (plots.street_id = streets.id)
Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)
where $where and plots.type='file'"; 
 $co = $connection->createCommand($sql_memberas)->queryAll();
		$rows =count($co);
		//for Pagination end


    $sql_member = "SELECT



    plots.id



    , plots.street_id

, plots.project_id

    , plots.plot_size



    , plots.com_res



	 , plots.size2



    , plots.create_date



	, plots.sector



	, plots.category_id



	, plots.status

	, plots.bstatus



	, plots.plot_detail_address
	, memberplot.plotno
	, memberplot.fstatus
    , projects.project_name
	, streets.street
    , size_cat.size
	, sectors.sector_name



	



FROM



    plots



    Left JOIN streets  ON (plots.street_id = streets.id)

Left JOIN sectors  ON (plots.sector = sectors.id)

	Left JOIN projects  ON (plots.project_id = projects.id)



	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)

	Left JOIN size_cat  ON (plots.size2 = size_cat.id)



where $where and plots.type='file' limit $start,$limit";  



        $sql_project = "SELECT * from projects";



		$result_project = $connection->createCommand($sql_project)->query();



		$sql_categories  = "SELECT * from categories";



		$categories = $connection->createCommand($sql_categories)->query();

		

		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();



	    $sql_sector ="SELECT DISTINCT sector FROM plots";



		$result_sector = $connection->createCommand($sql_sector)->query();



		$result_members = $connection->createCommand($sql_member)->query();



	



	$count=0;



	if ($result_members!=''){



		$home=Yii::app()->request->baseUrl; 



    $res=array();



            foreach($result_members as $key){



            $count++;



			echo $count.' result found';



			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/filehistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector_name'].'</td><td><a href="convert2plot?id='.$key['id'].'">Convert</a></td>';
				if(Yii::app()->session['user_array']['per1']=='1')
			{echo '<td>';

$M='';
$F='';
if($key['status']==''){ 

			echo'<a href="'.$home.'/index.php/memberfile/alotfile?id='.$key['id'].'&&pro='.$key['project_id'].'">' ."Allot".'</a>';

			}elseif($key['status']=='Requested'){if($key['fstatus']==''){$M='F';}else{$M='M'; } echo'<a href="'.$home.'/index.php/memberfile/requested_detail?id='.$key['id'].'">' ."Requested".'('.$M.')'.'</a>';
			}elseif($key['status']=='Requested(T)'){echo'<a  href="'.$home.'/index.php/memberfile/treq_detail?id='.$key['id'].'">'.$key['status'].'</a>';}else{ echo $key['status'];}
			echo '</td><td>'.$key['bstatus'].'</td>';
				echo '<td><a target="_blank" href="mergeplot?id='.$key['id'].'">Merge</a></td>';

			if($key['status']=='Alotted')

			{ 

			echo '<td></td>';

			}
			elseif($key['status']=='Requested'){
			echo'<td><a href="updatefile?id='.$key['id'].'">Edit</a></td></tr>';}else{echo '<td><a href="updatefile?id='.$key['id'].'">Edit</a>/<a href="deletefile?id='.$key['id'].'">Delete</a></td>';}}



			



			} 



			}else{echo '';}
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
   echo '<tr  ><td colspan="13"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="13">'.$pagination.'</td></tr>'; exit; 
	// for pagination END 
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
	
	}


		public function actionFiles_lis()
{
if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username']))

			

	{	



		



	   



	   		$plotno='';



			$st='';

			$size='';

			$pro='';



			$sector='';



			$cat='';



			$where='';



			$and = false;



			$where='';



			

					if (isset($_POST['com_res']) && $_POST['com_res']!=""){

				$where.="plots.com_res LIKE '%".$_POST['com_res']."%'";

				$and = true;

				$sector=$_POST['com_res'];

			}

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



			



			if (isset($_POST['cat']) && $_POST['cat']!=""){



				$cat=$_POST['cat'];



			



				



				if ($and==true)



				{



					  $where.=" and plots.category_id LIKE '%".$_POST['cat']."%'";



				}



				else



				{



					$where.=" plots.category_id LIKE '%".$_POST['cat']."%'";



				}



				$and=true;



			}



			if (isset($_POST['size']) && !empty($_POST['size'])){



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



    , plots.create_date



	, plots.sector



	, plots.category_id



	, plots.status



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



		$sql_categories  = "SELECT * from categories";



		    $categories = $connection->createCommand($sql_categories)->query();



		$sql_size  = "SELECT * from size_cat";

		$sizes = $connection->createCommand($sql_size)->query();

		 $sql_com_res ="SELECT DISTINCT com_res FROM plots";



		$result_com_res = $connection->createCommand($sql_com_res)->query();





	    $sql_sector ="SELECT * FROM sectors";



		$result_sector = $connection->createCommand($sql_sector)->query();



		 



		    $home=Yii::app()->request->baseUrl; 



			if(isset($_POST['search'])){



            $res=array();

            foreach($result_members as $key){



          echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/filehistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td><a href="convert2plot?id='.$key['plots.id'].'">Convert</a></td><td>';



			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberfile/allotfile?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>



			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deletefile?id='.$key['id'].'">Delete</a></td></tr>'; 



            }}



			$this->render('files_lis',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));



			



	   

	}else{
			$this->redirect(array('user/dashboard'));
		}

	}



	



	public function actionUpdatefile()



	



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
	, plots.project_id
	, plots.street_id
	, plots.cstatus
	, plots.size2
	, plots.create_date
	, plots.sector
	, plots.category_id
	, plots.status
	, plots.image
	, sectors.sector_name
	, plots.plot_detail_address
	, memberplot.plotno
	, projects.project_name
	, streets.street
	, size_cat.size
FROM
    plots
	Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (plots.size2 = size_cat.id)
where plots.id='".$_REQUEST['id']."' AND type='file'"; 
			$result_files = $connection->createCommand($sql_plots)->query();



		//	$sql_plots  = "SELECT * from plots where id='".$_REQUEST['id']."'";



			//$result_plots = $connection->createCommand($sql_plots)->query();

		

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



			$sql12  = "SELECT categories.name,cat_plot.id from cat_plot



			Left JOIN categories  ON (cat_plot.cat_id = categories.id)



			 where plot_id='".$_REQUEST['id']."'";



		    $result12 = $connection->createCommand($sql12)->queryAll();



		



			$this->render('updatefile',array('files'=>$result_files,'projects'=>$result_projects,'size'=>$result_size,'cat'=>$result12));



			   



			}



			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }



	}



	public function actionUpdate()



	{      $connection = Yii::app()->db;  

			

		if(Yii::app()->session['user_array']['per3']=='1')

			{

				$error='';

		  //$error =array();

			

			if(isset($_POST['project_id']) && empty($_POST['project_id']))

			{

				$error = 'Please Select File Project<br>';

			}

			

			if(isset($_POST['street_id']) && empty($_POST['street_id']))

			{



				$error .= 'Please Select File Street<br>';



			}



			if(isset($_POST['price']) && empty($_POST['price']))

			{

				$error .= 'Please Enter File Price<br>';

			}

			if(isset($_POST['plot_detail_address']) && empty($_POST['plot_detail_address']))

			{

				$error .= 'Please Enter File No<br>';

			}



			if(isset($_POST['plot_size']) && empty($_POST['plot_size']))

			{

				$error .= 'Please Enter File Size<br>';

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

				if(isset($_POST['file_size']) && empty($_POST['file_size']))

			{

				$error .= 'Please Select File Diemension<br>';

			}

			

				  $sq  = "SELECT * from plots where project_id='".$_POST['project_id']."' AND street_id='".$_POST['street_id']."' AND plot_detail_address='".$_POST['plot_detail_address']."' and type='file'"; 

			 $result_sq = $connection->createCommand($sq)->queryAll();

			 $count=0;

			 $add=0;

			 $sq1  = "SELECT * from plots where id='".$_POST['id']."'"; 

			 $result_sq1 = $connection->createCommand($sq1)->queryAll();

			 foreach($result_sq1 as $row2){$add=$row2['plot_detail_address'];}

			 

			 $re=array();

			 foreach($result_sq as $key1){$count=$count+1;}

			if($add==$_POST['plot_detail_address']){$count=0;}

			if($count!=0)

			 {

				  $error="A File Is Already Added On This Address Please Enter Another File Address  ";



		 	}	

  	

        if(empty($error))

			{

			 $sql="UPDATE plots set project_id='".$_POST['project_id']."',street_id='".$_POST['street_id']."',plot_detail_address='".$_POST['plot_detail_address']."',plot_size='".$_POST['plot_size']."',size2='".$_POST['size2']."',price='".$_POST['price']."',create_date='".date('Y-m-d h:i:s')."',com_res='".$_POST['com_res']."',sector='".$_POST['sector']."',cstatus='".$_POST['cstatus']."' where id='".$_POST['id']."' ";  



               $command = $connection -> createCommand($sql);



               $command -> execute();



			 echo "Record Updated Successfully";



			

		} 

			if(!empty($error)){

			echo $error;



			}

			   



			}else{

				

				

				 

				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 

				

				}





	}



  



		public function actionDeletefile()



	{          



			



			   $connection = Yii::app()->db;  



			



			  $query  = 'DELETE from  plots 



			   where id='.$_REQUEST['id'].' ';



		        $command = $connection -> createCommand($query);



               $command -> execute();



		     



						  $this->redirect(Yii::app()->baseUrl."/index.php/files/files_lis");



	} 	



		







	/*



	public function actionDelete($id)







	{







		$this->loadModel($id)->delete();















		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser







		if(!isset($_GET['ajax']))







			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));







	}







*/







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






	public function actionFiles()







	{	



	if(Yii::app()->session['user_array']['per3']=='1')







			{







	$connection = Yii::app()->db;  



	



			$sql_size  = "SELECT * from size_cat";



		    $result_size = $connection->createCommand($sql_size)->query();



			



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

	





	$this->render('files',array('projects'=>$result_projects,'size'=>$result_size));







			}







			else{







				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }







			







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






