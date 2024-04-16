<?php
class PropertyController extends Controller
{
   
   
   public function actionInstallmentplan()
		{
			

	 if(Yii::app()->session['user_array']['per3']=='1')

			{

	

		$connection = Yii::app()->db;  

		$sql_country  = "SELECT * from ptype";

		$result_size = $connection->createCommand($sql_country)->query();

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
	
		

		$this->render('installmentplan',array('projects'=>$result_projects,'size'=>$result_size));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

		}


   public function actionAdd()

	 	{
			 
	
         
			if(Yii::app()->session['user_array']['per3']=='1')

			{   
			$error='';
			 $error =array();

			$connection = Yii::app()->db;
			if(!empty($_POST['tno'])){ 
				if(!(ctype_digit($_POST['tno']))){
					$error="Please Enter Only Digit In Total No.";
					}					 
			}
              if(empty($error))
								{		 
				 $sql  = "INSERT INTO installment_planp (project_id,description,category_id,tamount,tno,
				 lab1,lab2,lab3,lab4,lab5,lab6,lab7,lab8,lab9,lab10,
				 lab11,lab12,lab13,lab14,lab15,lab16,lab17,lab18,lab19,lab20,
				 lab21,lab22,lab23,lab24,lab25,lab26,lab27,lab28,lab29,lab30,
				 lab31,lab32,lab33,lab34,lab35,lab36,lab37,lab38,lab39,lab40,
				 lab41,lab42,lab43,lab44,lab45,lab46,lab47,lab48,lab49,lab50,
				 lab51,lab52,lab53,lab54,lab55,lab56,lab57,lab58,lab59,lab60,
				 lab61,lab62,
				 `1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`11`,`12`,`13`,`14`,`15`,`16`,`17`,`18`,`19`,`20`,`21`,`22`,`23`,`24`,`25`,`26`,`27`,`28`,`29`,`30`,`31`,`32`,`33`,`34`,`35`,`36`, `37`,`38`,`39`,`40`,`41`,`42`,`43`,`44`,`45`,`46`,`47`,`48`,`49`,`50`,`51`,`52`,`53`,`54`,`55`,`56`,`57`,`58`,`59`,`60`,`61`,`62`)
				  VALUES ('".$_POST['project']."','".$_POST['description']."','".$_POST['category_id']."','".$_POST['tamount']."','".$_POST['tno']."',
				  
				  '".$_POST['lab1']."','".$_POST['lab2']."','".$_POST['lab3']."','".$_POST['lab4']."','".$_POST['lab5']."','".$_POST['lab6']."','".$_POST['lab7']."','".$_POST['lab8']."','".$_POST['lab9']."','".$_POST['lab10']."','".$_POST['lab11']."','".$_POST['lab12']."','".$_POST['lab13']."','".$_POST['lab14']."','".$_POST['lab15']."','".$_POST['lab16']."','".$_POST['lab17']."','".$_POST['lab18']."','".$_POST['lab19']."','".$_POST['lab20']."','".$_POST['lab21']."','".$_POST['lab22']."','".$_POST['lab23']."','".$_POST['lab24']."','".$_POST['lab25']."','".$_POST['lab26']."','".$_POST['lab27']."','".$_POST['lab28']."','".$_POST['lab29']."','".$_POST['lab30']."','".$_POST['lab31']."','".$_POST['lab32']."','".$_POST['lab33']."','".$_POST['lab34']."','".$_POST['lab35']."','".$_POST['lab36']."','".$_POST['lab37']."','".$_POST['lab38']."','".$_POST['lab39']."','".$_POST['lab40']."','".$_POST['lab41']."','".$_POST['lab42']."','".$_POST['lab43']."','".$_POST['lab44']."','".$_POST['lab45']."','".$_POST['lab46']."','".$_POST['lab47']."','".$_POST['lab48']."','".$_POST['lab49']."','".$_POST['lab50']."','".$_POST['lab51']."','".$_POST['lab52']."','".$_POST['lab53']."','".$_POST['lab54']."','".$_POST['lab55']."','".$_POST['lab56']."','".$_POST['lab57']."','".$_POST['lab58']."','".$_POST['lab59']."','".$_POST['lab60']."','".$_POST['lab61']."','".$_POST['lab62']."'				  
				  
,'".$_POST['1']."','".$_POST['2']."','".$_POST['3']."','".$_POST['4']."','".$_POST['5']."','".$_POST['6']."','".$_POST['7']."','".$_POST['8']."','".$_POST['9']."','".$_POST['10']."','".$_POST['11']."','".$_POST['12']."','".$_POST['13']."','".$_POST['14']."','".$_POST['15']."','".$_POST['16']."','".$_POST['17']."','".$_POST['18']."','".$_POST['19']."','".$_POST['20']."','".$_POST['21']."','".$_POST['22']."','".$_POST['23']."','".$_POST['24']."','".$_POST['25']."','".$_POST['26']."','".$_POST['27']."','".$_POST['28']."','".$_POST['29']."','".$_POST['30']."','".$_POST['31']."','".$_POST['32']."','".$_POST['33']."','".$_POST['34']."','".$_POST['35']."','".$_POST['36']."','".$_POST['37']."','".$_POST['38']."','".$_POST['39']."','".$_POST['40']."','".$_POST['41']."','".$_POST['42']."','".$_POST['43']."','".$_POST['44']."','".$_POST['45']."','".$_POST['46']."','".$_POST['47']."','".$_POST['48']."','".$_POST['49']."','".$_POST['50']."','".$_POST['51']."','".$_POST['52']."','".$_POST['53']."','".$_POST['54']."','".$_POST['55']."','".$_POST['56']."','".$_POST['57']."','".$_POST['58']."','".$_POST['59']."','".$_POST['60']."','".$_POST['61']."','".$_POST['62']."')";	
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
                        //$command -> execute();
					echo 'Installment Plan Added Successfully';
                    exit;
						

				}
				else{
					echo $error;
					}

		}

		

	
	    }

	
    public function actionlist()

		{
			
			  $connection = Yii::app()->db; 
		

	if(Yii::app()->session['user_array']['per3']=='1')

			{

	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))

	   {
		$this->layout='//layouts/back';
		
       	$and = false;
			$where='';
		//echo $_POST['project_id']; exit;
		if (!empty($_POST['project_id'])){				
				if ($and==true)
				{
					$where.="where ins.project_id LIKE '%".$_POST['project_id']."%'";
				}
				else
				{
					$where.="where ins.project_id LIKE '%".$_POST['project_id']."%'";
				}
				$and=true;
			}
	

	//$sql = "SELECT * FROM streets";
 $sql="SELECT
    ins.id
    , ins.project_id
    , ins.category_id
	, ins.tno
	, ins.description
	, ins.tamount
    , projects.project_name
	
	,size_cat.size
FROM
    installment_planp ins
	Left JOIN projects  ON (ins.project_id = projects.id) 
    Left JOIN size_cat  ON (ins.category_id = size_cat.id) 

	 $where "; 
	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
     

	$this->render('list',array('streets'=>$result,'projects'=>$result_project));

	   }

	  	else{

			$this->redirect (array('user/user'));

	  		}}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	
		}

 	public function actionUpdateinstall()

     	{
			

		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	 $sql= "SELECT
    projects.project_name
	,size_cat.size
	,ins.*
    FROM
    installment_planp ins
	Left JOIN projects  ON (ins.project_id = projects.id)
	  Left JOIN size_cat  ON (ins.category_id = size_cat.id)  

	  WHERE ins.id='".$_GET['id']."'";

	$result = $connection->createCommand($sql)->query();
	$sql_project = "SELECT * from projects";
	$result_project = $connection->createCommand($sql_project)->query();
   $sql_size = "SELECT * from size_cat";
	$result_size = $connection->createCommand($sql_size)->query();
	
	$sql_type = "SELECT * from ptype";
	$result_type = $connection->createCommand($sql_type)->query();

	$this->render('updateinstall',array('pla'=>$result,'projects'=>$result_project,'size'=>$result_size,'type'=>$result_type));

	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    
		}
		
public function actionSelectplot()
		{
				

		$connection = Yii::app()->db;  

		$sql_plot  = "SELECT * from plots
		where street_id='".$_POST['street']."' and type='Plot' and status='' ";
		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
	public function actionPlanupdate()

		{
			       
	
		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

			   $connection = Yii::app()->db;  
				

			   $sql="UPDATE installment_planp set 
			 project_id='".$_POST['project_id']."',
			  description='".$_POST['description']."',
			 category_id='".$_POST['category_id']."',
			 tno='".$_POST['tno']."',
			 tamount='".$_POST['tamount']."',
			 lab1='".$_POST['lab1']."',
			 lab2='".$_POST['lab2']."',
			 lab3='".$_POST['lab3']."',
			 lab4='".$_POST['lab4']."',
			 lab5='".$_POST['lab5']."',
			 lab6='".$_POST['lab6']."',
			 lab7='".$_POST['lab7']."',
			 lab8='".$_POST['lab8']."',
			 lab9='".$_POST['lab9']."',
			 lab10='".$_POST['lab10']."',
			 lab11='".$_POST['lab11']."',
			 lab12='".$_POST['lab12']."',
			 lab13='".$_POST['lab13']."',
			 lab14='".$_POST['lab14']."',
			 lab15='".$_POST['lab15']."',
			 lab16='".$_POST['lab16']."',
			 lab17='".$_POST['lab17']."',
			 lab18='".$_POST['lab18']."',
			 lab19='".$_POST['lab19']."',
			 lab20='".$_POST['lab20']."',
			 lab21='".$_POST['lab21']."',
			 lab22='".$_POST['lab22']."',
			 lab23='".$_POST['lab23']."',
			 lab24='".$_POST['lab24']."',
			 lab25='".$_POST['lab25']."',
			 lab26='".$_POST['lab26']."',
			 lab27='".$_POST['lab27']."',
			 lab28='".$_POST['lab28']."',
			 lab29='".$_POST['lab29']."',
			 lab30='".$_POST['lab30']."',
             lab31='".$_POST['lab31']."',
			 lab32='".$_POST['lab32']."',
			 lab33='".$_POST['lab33']."',
			 lab34='".$_POST['lab34']."',
			 lab35='".$_POST['lab35']."',
			 lab36='".$_POST['lab36']."',
			 lab37='".$_POST['lab37']."',
			 lab38='".$_POST['lab38']."',
			 lab39='".$_POST['lab39']."',
			 lab40='".$_POST['lab40']."',
			 lab41='".$_POST['lab41']."',
			 lab42='".$_POST['lab42']."',
			 lab43='".$_POST['lab43']."',
			 lab44='".$_POST['lab44']."',
			 lab45='".$_POST['lab45']."',
			 lab46='".$_POST['lab46']."',
			 lab47='".$_POST['lab47']."',
			 lab48='".$_POST['lab48']."',
			 lab49='".$_POST['lab49']."',
			 lab50='".$_POST['lab50']."',
			  lab51='".$_POST['lab51']."',
			 lab52='".$_POST['lab52']."',
			 lab53='".$_POST['lab53']."',
			 lab54='".$_POST['lab54']."',
			 lab55='".$_POST['lab55']."',
			 lab56='".$_POST['lab56']."',
			 lab57='".$_POST['lab57']."',
			 lab58='".$_POST['lab58']."',
			 lab59='".$_POST['lab59']."',
			 lab60='".$_POST['lab60']."',
			 lab61='".$_POST['lab61']."',
			 lab62='".$_POST['lab62']."',
			 `1`='".$_POST['1']."',
			 `2`='".$_POST['2']."',
			 `3`='".$_POST['3']."',
			 `4`='".$_POST['4']."',
			 `5`='".$_POST['5']."', 
			 `6`='".$_POST['6']."',
			 `7`='".$_POST['7']."',
			 `8`='".$_POST['8']."', 
			 `9`='".$_POST['9']."',
			 `10`='".$_POST['10']."',
			 `11`='".$_POST['11']."',
			 `12`='".$_POST['12']."',
			 `13`='".$_POST['13']."',
			 `14`='".$_POST['14']."',
			 `15`='".$_POST['15']."', 
			 `16`='".$_POST['16']."',
			 `17`='".$_POST['17']."',
			 `18`='".$_POST['18']."', 
			 `19`='".$_POST['19']."',
			 `20`='".$_POST['20']."',
			 `21`='".$_POST['21']."',
			 `22`='".$_POST['22']."',
			 `23`='".$_POST['23']."',
			 `24`='".$_POST['24']."',
			 `25`='".$_POST['25']."', 
			 `26`='".$_POST['26']."',
			 `27`='".$_POST['27']."',
			 `28`='".$_POST['28']."', 
			 `29`='".$_POST['29']."',
			 `30`='".$_POST['30']."',
			 `31`='".$_POST['31']."',
			 `32`='".$_POST['32']."',
			 `33`='".$_POST['33']."',
			 `34`='".$_POST['34']."',
			 `35`='".$_POST['35']."', 
			 `36`='".$_POST['36']."',
			 `37`='".$_POST['37']."',
			 `38`='".$_POST['38']."', 
			 `39`='".$_POST['39']."',
			 `40`='".$_POST['40']."',
			 `41`='".$_POST['41']."',
			 `42`='".$_POST['42']."',
			 `43`='".$_POST['43']."',
			 `44`='".$_POST['44']."',
			 `45`='".$_POST['45']."', 
			 `46`='".$_POST['46']."',
			 `47`='".$_POST['47']."',
			 `48`='".$_POST['48']."', 
			 `49`='".$_POST['49']."',
			 `50`='".$_POST['50']."',
			 `51`='".$_POST['51']."',
			 `52`='".$_POST['52']."',
			 `53`='".$_POST['53']."',
			 `54`='".$_POST['54']."',
			 `55`='".$_POST['55']."', 
			 `56`='".$_POST['56']."',
			 `57`='".$_POST['57']."',
			 `58`='".$_POST['58']."', 
			 `59`='".$_POST['59']."',
			 `60`='".$_POST['60']."',
			 `61`='".$_POST['61']."',
			 `62`='".$_POST['62']."' where id=".$_POST['ide']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Plan Updated Successfully';
			}
			else
		{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
			  
	
		}

/////////////////////////DELETE //////////////

	public function actionDelete()
		{	
			
		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))
			{

			 $connection = Yii::app()->db; 
			 $sql_del = "DELETE from installment_planp where id=".$_GET['id'];
			 $command = $connection -> createCommand($sql_del);

             $command -> execute();
             echo'Deleted Succesfully';
			 $this->redirect(array('property/list'));
		}
		
	  else{
		  $this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); 
		  }
	  
	    }
   
	public function actionProperty_list()
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
	
	
	
				$this->render('property_list',array('members'=>$result_members,'projects'=>$result_projects,'sectors'=>$result_sector,'pro'=>$pro,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes,'com_res'=>$result_com_res));
	
	
	
				
	
	
	
		   
	
	
	
		
		}
	public function actionAddnew()
		{
				

	 if(Yii::app()->session['user_array']['per2']=='1')

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
	
		$sql_ptype = "SELECT * from ptype";
		$result_ptype= $connection->createCommand($sql_ptype)->query();

		$this->render('addnew',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan, 'ptype'=>$result_ptype));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
	
	public function actionAdminrequest()

		{
				

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per6']=='1')

			{

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.id,mp.plot_id,mp.pname,mp.carea,mp.create_date,mp.fstatus,mp.plotno,p.status,p.type, p.size2,siz.size,m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM property mp

left join members m on m.id=mp.member_id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id
left join size_cat siz on p.size2=siz.id

left join projects j on s.project_id=j.id where mp.member_id!=''";// p.type='plot' and mp.status='new'and mp.fstatus='approved' ";

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

		

		$this->render('adminrequest',array('memberplot_list'=>$memberplot_list,'projects'=>$result_projects));

		}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
	public function actionFinancerequest()

		{
				

	if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per6']=='1')

			{

	$connection = Yii::app()->db; 

	$sql_member = "SELECT mp.member_id,mp.id,mp.plot_id,mp.pname,mp.carea,mp.create_date,mp.fstatus,mp.plotno,p.status,p.type, p.size2,siz.size,m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM property mp

left join members m on m.id=mp.member_id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id
left join size_cat siz on p.size2=siz.id

left join projects j on s.project_id=j.id where mp.member_id!=''";// p.type='plot' and mp.status='new'and mp.fstatus='approved' ";

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

		

		$this->render('financerequest',array('memberplot_list'=>$memberplot_list,'projects'=>$result_projects));

		}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
	public function actionAlotment_lis()

		{
			
		if((Yii::app()->session['user_array']['per9']=='1')&& isset(Yii::app()->session['user_array']['username']))

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

					  $where.=" and property.pname LIKE '%".$_POST['plotno']."%'";

				}

				else

				{

					$where.=" property.pname LIKE '%".$_POST['plotno']."%'";

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
	, memberplot.create_date
	, memberplot.id as mp_id

    , projects.project_name

	, streets.street
,property.pname

	

FROM

    plots

    Left JOIN streets  ON (plots.street_id = streets.id)


	Left JOIN projects  ON (plots.project_id = projects.id)

	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	
	Left JOIN property  ON (plots.id = property.pname)

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

		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
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

			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['mp_id'].'">Delete</a></td></tr>'; 

            }}

			$this->render('alotment_lis',array('members'=>$result_members,'sectors'=>$result_sector,'pro'=>$result_projects,'st'=>$st,'sector'=>$sector,'plotno'=>$plotno,'categories'=>$categories,'sizes'=>$sizes));

			}else{
				$this->redirect(array('user/dashboard'));
				
				}

	   

	
		}	
	public function actionAlotmentreq()
		{
			 
		$where='';

		$and=false;
			$from=$_POST['fromdate'];

			$to=$_POST['todate'];
   
		 if (isset($_POST['status']) && $_POST['status']!=""){

				if($_POST['status']=='new'){$where.="mp.fstatus=''";}else{
				$where.="mp.fstatus LIKE '%".$_POST['status']."%'";
				}
				$and = true;
			}
				if (($_POST['fromdate']!="") && ($_POST['todate']!="")) {
				

				if ($and==true)

				{

				$where.="and mp.create_date BETWEEN '".$from."' AND '".$to."' ";

				}else{$where.="mp.create_date BETWEEN '".$from."' AND '".$to."' ";}

			$and=true;

			}

		if (isset($_POST['plotno']) && $_POST['plotno']!=""){

				$plotno=$_POST['plotno'];

				if ($and==true)

				{

					  $where.=" and mp.pname ='".$_POST['plotno']."'";

				}

				else

				{

					$where.=" mp.pname ='".$_POST['plotno']."'";

				}

				$and=true;

			}
			if ( isset($_POST['project_id']) &&  $_POST['project_id']!=""){				
				if ($and==true)
				{
					$where.=" and p.project_id ='".$_POST['project_id']."'";
				}
				else
				{
					$where.=" p.project_id = '".$_POST['project_id']."'";
				}
				$and=true;
			}
		$connection = Yii::app()->db; 

		$sql_payment  = "SELECT  mp.member_id,mp.plotno,mp.pname,mp.carea,mp.create_date,mp.id as mp_id,p.type,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,s.street,j.project_name FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id


left join ptype j on mp.ptype=j.id

where $where ";

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
//$i=0;
            foreach($sql_payments as $key){

          
//$old_date = $row['create_date'];            
//$middle = strtotime($old_date);             
//$new_date = date('d-m-Y', $middle);
		
		$ID=$key['mp_id'];
		
		//$due=$due+$row['amount'];
		//$paid=$paid+$row['paidamount'];
  echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['pname'].'<td>'.$key['carea'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="req_detail?id='.$ID.'">Detail</a>

 

  </td></tr>';

		 

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

	public function actionMemberproperty_lis()
		{
				
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

			$this->render('memberproperty_lis',array('members'=>$result_members,'error'=>$error,'projects'=>$result_projects));

	
		}
	public function actionSearchreq()
		{
			
		$where='';
		
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
					$where.=" and mp.plotno Like '%".$_POST['plotno']."%'";
				}
				else
				{
					$where.="mp.plotno Like '%".$_POST['plotno']."%'";
				}
				$and==true;
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
 $sql_memberas = "SELECT mp.id as mid,mp.member_id,mp.plotno,mp.pname,mp.ptype,mp.carea ,mp.create_date,ss.sector_name,p.sector,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,pt.project_name FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join ptype pt on mp.ptype=pt.id

left join sectors ss on p.sector=ss.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id

where $where  and  mp.member_id!='' ";
 $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);
		//for Pagination end 		

	$connection = Yii::app()->db; 
    $sql_member = "SELECT mp.id as mid,mp.member_id,mp.plotno,mp.pname,mp.ptype,mp.carea ,mp.create_date,ss.sector_name,p.sector,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,pt.project_name FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join ptype pt on mp.ptype=pt.id

left join sectors ss on p.sector=ss.id

left join streets s on p.street_id=s.id

left join projects j on p.project_id=j.id

where $where and  mp.member_id!='' limit $start,$limit"; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){
            $count++; 
$sql1t ="SELECT * from transferplot where plot_id=".$key['plot_id']." and status='New Request'";
		$result_datat = $connection->createCommand($sql1t)->queryRow();
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['mid'].'">'.$key['pname'].'</a></td><td><strong>'.$key['carea'].'</strong></a></td><td>'.$key['project_name'].'</td><td>
			 
			 <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			 
			<li role="presentation"> <a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a></li>
			<li role="presentation"><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a></li>
			<li role="presentation"><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a></li>
			<li role="presentation">';if($result_datat['status']=='New Request'){ echo '<a  href="'.$home.'/index.php/memberplot/treq_detail?id='.$key['plot_id'].'">Transfer Details</a>';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer File</a>';}

  echo'</li><li role="presentation"><a href="updatemember_plot?id='.$key['plot_id'].'">Update Membership</a></li>
	   <li role="presentation"><a href="amembers?mid=">Associates Member</a></li>
<li role="presentation"><a href="'.Yii::app()->baseUrl.'/index.php/allotments/edit_app?mid=">Application Information</a></li>
</ul></div>
</td></tr>'; 

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
 echo '<tr  ><td colspan="9"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="9">'.$pagination.'</td></tr>'; exit; 
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
	public function actionAddnewproperty()
		{
			 
			if(Yii::app()->session['user_array']['per4']=='1')
			{   
					$error='';
                                    //$error =array();
									$connection = Yii::app()->db;  
									
									if ((isset($_POST['plot_id']) && empty($_POST['plot_id']))){
									 $error.="Please Select Plot. <br>";}								  
								  	
									if ((isset($_POST['p_type']) && empty($_POST['p_type']))){
									 $error.="Please Select Property Type. <br>";
									 }
									 if ((isset($_POST['number']) && empty($_POST['number']))){
									 $error.="Please Enter Unique No. <br>";
									 }
									 if ((isset($_POST['details']) && empty($_POST['details']))){
									 $error.="Please add Detail. <br>";
									 }
									 if ((isset($_POST['floor']) && empty($_POST['floor']))){
									 $error.="Please Enter NO. of Floor. <br>";
									 }
									 if ((isset($_POST['cov_a']) && empty($_POST['cov_a']))){
									 $error.="Please Enter Covered Area. <br>";
									 }
									 if ((isset($_POST['status']) && empty($_POST['status']))){
									 $error.="Select Status. <br>";
									 }
								
								 	$pn=$_POST['number'];
									if(!empty($pn)){
									$q ="SELECT * from property where plot_id='".$_POST['plot_id']."' and pname='".$pn."' "; 
									  $result_q = $connection->createCommand($q)->queryRow();
									if(!empty($result_q)){
									 $error .="Property # Already Added Try Another. <br>";
									}}
										 if(empty($error)){
										 $uid=Yii::app()->session['user_array']['id']; 
				 $sql  = "INSERT INTO property (plot_id,ptype,pname,pdetails,floors,carea,user_name,create_date,pstatus) 
	VALUES ('".$_POST['plot_id']."','".$_POST['p_type']."','".$_POST['number']."','".$_POST['details']."','".$_POST['floor']."','".$_POST['cov_a']."','".$uid."','".date('Y-m-d H:i:s')."','".$_POST['status']."')";	
					 
					   $command = $connection -> createCommand($sql);
                        $command -> execute();
						echo 'Property Inserted';
						exit;
						}
						else if(!empty($error)){ 
 						echo $error;

             } 
			}
	
		}
	public function actionMemberproperty()
		{
				

	 if(Yii::app()->session['user_array']['per2']=='1')

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
	
		

		$this->render('memberproperty',array('projects'=>$result_projects,'country'=>$result_country,'plan'=>$result_plan));

		

			}

			else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

				

	
		}
	public function actionAjaxRequest1()
		{
				

		$connection = Yii::app()->db;  

		$sql_plot  = "SELECT *,property.id as pidd from property 
		left join plots on (property.plot_id=plots.id)
		where plots.street_id='".$_POST['street']."' and plots.project_id='".$_POST['pro']."' and property.ptype='".$_POST['size']."' ";
		$result_plots = $connection->createCommand($sql_plot)->query();

			

		$plot=array();

		foreach($result_plots as $plo){

			$plot[]=$plo;

			} 

		

	echo json_encode($plot); exit();

	
		}
	public function actionAlotaproperty()
 		{
			 
		
          
			if(Yii::app()->session['user_array']['per2']=='1')

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
									  if (!empty($_POST['noi']) ){
										  $noi='';
										  $noi=$_POST['noi'];
										if($noi<=0){
									 $error.="No.Of Installment Must be 1 or More . <br>";
									 }}
							  if ((isset($_POST['insplan']) && empty($_POST['insplan']))){

									 $error.="Installment Plan required. <br>";
								  }
								

								  if ((isset($_POST['plotno']) && empty($_POST['plotno']))){

								 $error.="Plot Membership No required. <br>";

								 }
								
								 	$pn=$_POST['procode'].'-'.$_POST['plotno'].'-'.$_POST['sizecode'];
									if(!empty($pn)){
									$q ="SELECT * from property where plotno='".$pn."'"; 
									  $result_q = $connection->createCommand($q)->queryRow();
									if ($result_q['plotno']==$pn){
									 $error.="Membership # Already Added Try Another. <br>";
									}
									}
										 if(empty($error)){
											 	
	
										 $uid=Yii::app()->session['user_array']['id'];
										 
				 $sql  = "Update property SET
				 member_id='".$uid."',
				 create_date='".date('Y-m-d H:i:s')."',
				 noi='".$_POST['noi']."',
				 insplan='".$_POST['insplan']."',
				 status='New',
				 plotno='".$pn."' where id='".$_POST['plot_id']."' ";	
				 $command = $connection -> createCommand($sql);
                 $command -> execute();		
				 
						$sqlinstalplan ="SELECT * from installment_plan where tno='".$_POST['insplan']."'"; 
						$dataplan = $connection->createCommand($sqlinstalplan)->queryRow();
							
						$tno=$_POST['noi'];
						$insplan=$_POST['insplan'];
						$insert=0;
						$create=$_POST['date'];
						$instalno=0;
						$lab=0;
						
						do{
						$lab++;
						$instalno++;	
						
						$tno=$_POST['noi'];
						
						if($instalno==1){$tno=$tno+1;}
						 $sqlinstall="INSERT INTO proinstallpayment SET lab='".$dataplan['lab'.$lab.'']."',dueamount='".$dataplan[''.$instalno.'']."', due_date='".$create."', plot_id='".$_POST['plot_id']."',mem_id='".$result_data['id']."'"; 
						$next_due_date = strtotime($create.' + '.$tno.' Months');
						$create=date('d-m-Y', $next_due_date);			
   		               $command = $connection -> createCommand($sqlinstall);
                        $command -> execute();
						$insert++;
						
						}while($insert<$insplan);
						
					echo 'Property Allotment Request Sent For Verification';
exit;
						}

						  else if(!empty($error)){ 
 
						    echo $error;



             } 

		

					

		
			}
		

	
		}

	public function actionMemberplot_search_lis()
		{
				

	if(Yii::app()->session['user_array']['per2']=='1')

			{
					$connection = Yii::app()->db; 

			$and = false;

			$where='';
	    // echo   $qry="Select * from memberplot where create_date BETWEEN '".$_POST['fromdate']."'  AND  '".$_POST['todate']."'  ";

			//exit;		

			

			

			if (($_POST['fromdate']!="") && ($_POST['todate']!="")) {
			$from=$_POST['fromdate'];
			
						$to=$_POST['todate'];
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

  $sql_member = "SELECT mp.id,mp.fstatus,mp.member_id,mp.status,mp.fstatus,mp.plot_id,mp.plotno,mp.create_date,p.id,m.username, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,mp.carea,mp.floors,pt.project_name,j.project_name as prname,mp.pname, j.project_name FROM property mp

left join members m on mp.member_id=m.id
left join ptype pt on mp.ptype=pt.id
left join plots p on mp.plot_id=p.id
left join projects j on p.project_id=j.id
where ".$where." and mp.status='new'and mp.fstatus='approved' ";

		$result_members = $connection->createCommand($sql_member)->query();

		

		$sql_projects = "SELECT * from projects ";





		$result_projects = $connection->createCommand($sql_projects)->query();



			$this->render('adminrequest',array('memberplot_list'=>$result_members,'projects'=>$result_projects));

	}

	

	

	
		}
	public function actionReq_detail()
		{
			
	if(Yii::app()->session['user_array']['per2']=='1')
	{
		$connection = Yii::app()->db; 	
		$sql_details  = "SELECT mp.id,mp.fstatus,mp.member_id,mp.status,mp.fstatus,mp.plot_id,mp.price,mp.plotno,mp.insplan,mp.create_date,m.username, m.name,m.image,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,mp.carea,mp.floors,pt.project_name,j.project_name as prname, mp.pname,mp.noi FROM property mp
left join members m on mp.member_id=m.id
left join ptype pt on mp.ptype=pt.id
left join plots p on mp.plot_id=p.id
left join projects j on p.project_id=j.id
 where mp.id=".$_REQUEST['plot_id'];

			$result_details = $connection->createCommand($sql_details)->query();

			

			$sql_payment  = "SELECT * from plotpayment where plot_id='".$_REQUEST['plot_id']."'";

			$result_payments = $connection->createCommand($sql_payment)->queryRow();

			$this->render('req_detail',array('plotdetails'=>$result_details, 'plotpayments'=>$result_payments)); 

			}else{$this->redirect(array("dashboard"));}

	
		}
	public function actionPlotcharges()
		{
				

			$this->layout='//layouts/back';

			$connection = Yii::app()->db;

			$plot_id =$_REQUEST['id'];
				//exit;		
			$sql_charges  = "SELECT * from charges where project_id='".$_REQUEST['pid']."'";
			$result_charges = $connection->createCommand($sql_charges)->query();

			$sql_plots  = "SELECT * from property where id='".$plot_id."'";
			$result_plots = $connection->createCommand($sql_plots)->query();
			

			$this->render('plotcharges',array('plots'=>$result_plots,'charges'=>$result_charges));

	
		}
	public function actioncharge()
		{
			

		if(Yii::app()->session['user_array']['per2']=='1')

			{

		

		$error =array();
		$error = '';

		if((isset($_POST['plot_id']) && empty($_POST['plot_id']))  ||(isset($_POST['duedate']) && empty($_POST['duedate']))  || (isset($_POST['charges_id']) && empty($_POST['charges_id'])) || (isset($_POST['comment']) && empty($_POST['comment']))|| (isset($_POST['total']) && empty($_POST['total'])))

		{

			$error = 'Please complete all required fields <br />';

		}

			if(empty($error)){
				    $connection = Yii::app()->db;
					$sqlchrgesdetail='Select * from charges where id="'.$_POST['charges_id'].'"';
					 $resultcharges = $connection->createCommand($sqlchrgesdetail)->queryRow();
                      $sql  = 'INSERT INTO propertypayment  (plot_id,payment_type,amount, remarks,duedate) VALUES ("'.$_POST['plot_id'].'","'.$resultcharges['name'].'", "'.$_POST['total'].'","'.$_POST['comment'].'","'.$_POST['duedate'].'")';                      
					    $command = $connection -> createCommand($sql);
			            $command -> execute();
						echo "Charges Added Successfully";
			        }

					if(!empty($error)){
					echo $error;
				}

	}

	
		}
	public function actionPayment_details()
		{
			

		$connection = Yii::app()->db;

	$land  = "SELECT * FROM proinstallpayment where plot_id='".$_REQUEST['id']."' ";

		$land_cost = $connection->createCommand($land)->queryAll();
		

		$sql_payment  = "SELECT * FROM propertypayment where plot_id='".$_REQUEST['id']."'";

		$result_payments = $connection->createCommand($sql_payment)->queryAll();

		

	   $sql_member= "SELECT mp.id,mp.plot_id,mp.pname,mp.floors,pt.project_name as proname,mp.plotno,mp.member_id,m.cnic,m.name FROM property mp
	   left join members m on mp.member_id=m.id
	   left join ptype pt on mp.ptype=pt.id
	    where mp.id='".$_REQUEST['id']."'";

		$result_members = $connection->createCommand($sql_member)->queryAll();
		

		

		$sql = "SELECT pc.plot_id,pc.charges_id,c.name,c.total FROM plotcharges pc

left join charges c on pc.charges_id=c.id 

where plot_id='".$_REQUEST['id']."'";

		$res=$connection->createCommand($sql)->queryAll();

		

		//$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";

		//$result_charges = $connection->createCommand($sql_charges)->queryAll();

		

		$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		left join sectors sec on p.sector=sec.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		

	

		$this->render('payment_details',array('payments'=>$result_payments,'landcost'=>$land_cost,'info'=>$result_plotinfo,'receivable'=>$res,'members'=>$result_members));

		

	
		}
	public function actionInstallment_details()
		{
			
		$connection = Yii::app()->db;
		$sql_payment  = "SELECT * FROM proinstallpayment where plot_id='".$_REQUEST['id']."' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
			   $sql_member= "SELECT mp.id,mp.plot_id,mp.pname,mp.floors,pt.project_name as proname,mp.plotno,mp.member_id,m.cnic,m.name FROM property mp
	   left join members m on mp.member_id=m.id
	   left join ptype pt on mp.ptype=pt.id
	    where mp.id='".$_REQUEST['id']."'";
		$result_members = $connection->createCommand($sql_member)->queryAll();
		$sql_charges  = "SELECT * FROM plotcharges where plot_id='".$_REQUEST['id']."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
	//	$sql_plotinfo  = "SELECT * FROM plots where id='".$_REQUEST['id']."'";
		$sql_plotinfo  = "SELECT p.*,proj.project_name,sec.sector_name,st.street,s.size FROM plots p
		left join projects proj on p.project_id=proj.id
		 left join streets st on p.street_id=st.id
		left join size_cat s on p.size2=s.id
		left join sectors sec on p.sector=sec.id
		 where p.id='".$_REQUEST['id']."'";
		$result_plotinfo = $connection->createCommand($sql_plotinfo)->queryAll();

		
		$sql_minfo  = "SELECT * FROM property where id='".$_REQUEST['id']."'";

		$result_minfo = $connection->createCommand($sql_minfo)->queryAll();

		

		$this->render('installment_details',array('payments'=>$result_payments,'charges'=>$result_charges,'info'=>$result_plotinfo,'minfo'=>$result_minfo,'members'=>$result_members));

		

	
		}
	public function actionSubmitstatus()
		{
			
	if($_POST['statusapp']=='Approved')
		{
		$connection = Yii::app()->db;
	 	$memberid=$_POST['member_id'];
		 $plotid=$_POST['plot_id'];
   	     $status=$_POST['status'];
		
		$sql="Update property SET status='Approved',comment='".$_POST['cmnt']."' where id='".$plotid."'";	
        $command = $connection -> createCommand($sql);
        $command -> execute();
		
		$this->redirect(array("property/adminrequest"));
		} 
		
		if($_POST['statusapp']=='Rejected')
		{
			
		$connection = Yii::app()->db;
		$plotid=$_POST['plot_id'];
		//echo $sqlup="Update plots SET status='' where id='".$plotid."'";	
          $sqlup="UPDATE property set status='' WHERE id='".$plotid."'"; 
		$command = $connection -> createCommand($sqlup);
        $command -> execute();
		
$sql2="DELETE FROM  proinstallpayment where plot_id='".$plotid."'";		
        $command = $connection -> createCommand($sql2);
        $command -> execute();



			$this->redirect(array("property/adminrequest"));

		}

		
		}
	public function actionUpdatemem_plot()
		{
			 
			if(Yii::app()->session['user_array']['per2']=='1')
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
				

	 if(Yii::app()->session['user_array']['per2']=='1')

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
		{ if (!empty($_POST['submit']))
		{
			

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
			

		if(Yii::app()->session['user_array']['per3']=='1'&& Yii::app()->session['user_array']['per2']=='1' && isset(Yii::app()->session['user_array']['username']))

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
			

		if(Yii::app()->session['user_array']['per2']=='1'&& Yii::app()->session['user_array']['per2']=='1' && isset(Yii::app()->session['user_array']['username']))

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
			

		if(Yii::app()->session['user_array']['per2']=='1')

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

	FROM

    memberplot

    LEFT JOIN members 

        ON (memberplot.member_id = members.id ) 

		left join plots on memberplot.plot_id=plots.id
		left join size_cat on plots.size2=size_cat.id
		left join streets on plots.street_id=streets.id

		where memberplot.plot_id=".$plot_id;

		

		$member_result = $connection->createCommand($sql_member)->queryAll();

	 	$this->render('pdf',array('member'=>$member_result)); 
		}
	public function actionAjaxRequest7($val1)
		{
				

		$connection = Yii::app()->db;  

		$sql_plot  = "SELECT * from installment_planp where project_id='".$val1."' ";

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
	public function actionTransferplot()
		{
				

	 
	$this->layout='//layouts/back';
	$plotid = $_GET['plot_id'];		 
	$connection = Yii::app()->db;  
	$sql_plotedtails = "SELECT mp.member_id,mp.create_date, m.name,m.name,m.sodowo,m.cnic,p.id   plot_id,p.plot_detail_address,p.plot_size,s.street, j.project_name 
FROM memberplot mp left join members m on mp.member_id=m.id left join plots p on mp.plot_id=p.id left join streets s on p.street_id=s.id left join projects j on s.project_id=j.id 
   WHERE p.id ='".$plotid."' ";
	$plotdetails = $connection->createCommand($sql_plotedtails)->queryRow();
	$this->render('transferplot',array('plotdetails'=>$plotdetails));
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
	public function actionRequestTransfer()
		{
			
			
		    $error ='';
	   
									  $connection = Yii::app()->db;  
									 $base=$_POST['cnic']; 
									 $uid=Yii::app()->session['user_array']['id'];
									 $sql ="SELECT * from members where cnic='".$base."'"; 
									  $result_data = $connection->createCommand($sql)->queryRow();
									  
									  $sql1 ="SELECT * from transferplot where plot_id='".$_POST['plot_id']."'"; 
									  $result_data1 = $connection->createCommand($sql1)->queryRow();
									  if(!empty($result_data1)&& ($result_data1['status']!='Rejected')){
										
										  $error="Already Requested. <br>";
										
										  }
										  
									if ((isset($base) && empty($base))){
									 $error="CNIC required. <br>";
									}elseif(empty($result_data)){
									 $error.='Applicant Containing '.$base.' CNIC is Not Register Member <br>';
									 }elseif($result_data['status']!=1){
									 $error.='Applicant Containing '.$base.' CNIC is Not Active Register Member.<br>';
									}
									
										if(!empty($error)){
											echo $error;exit;
											}else{
                                        $transferto_memberid = $result_data['id'];
				  		                
	            					   $sql="INSERT INTO transferplot SET plot_id='".$_POST['plot_id']."',uid='".$uid."',transferfrom_id='".$_POST['transfer_from_memberid']."',transferto_id='".                                     $transferto_memberid."',status='New Request',cmnt='New Request',create_date='".date('Y-m-d H:i:s')."' ";	 
        		   					 $command = $connection -> createCommand($sql);
                      				 $command -> execute();
									 	
									 $sql1="UPDATE plots set status='Requested(T)' WHERE id='".$_POST['plot_id']."' ";	 
        		   					 $command = $connection -> createCommand($sql1);
                      				 $command -> execute();
									 	echo "Plot transfer request has been sent successfully ";
										echo '<form action="timage"  enctype="multipart/form-data" method="post"  >';
										echo'<input type="hidden" name="plot_id" value="'.$_POST['plot_id'].'" />';
										echo '<input type="file" name="image">
										<input type="submit" name="upload" value="Upload">
										</form>';
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
				echo $sql="UPDATE transferplot SET image='".$newfilename."' WHERE id='".$_POST['plot_id']."'";exit;
					$command = $connection -> createCommand($sql);
	               $command -> execute();
					$this->redirect('memberplot/member_lis'); 
		
		
		}	
	public function actionSearchreq1()
		{
			
			
		if(Yii::app()->session['user_array']['per3']=='1')
			{
			
			
			

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

    $sql_memberas = "SELECT *
FROM
   property
    Left JOIN plots  ON (property.plot_id = plots.id)
	Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN ptype  ON (property.ptype = ptype.id)
	".$extra1."
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where $where"; 
        $co = $connection->createCommand($sql_memberas)->query();
		$rows =count($co);


    $sql_member = "SELECT

    plots.id

    , plots.street_id

    , plots.plot_size
, plots.project_id
    , plots.com_res
	 , plots.size2
	 , property.ptype
	 , property.pname
	 , property.ptype
	 , property.pdetails
	 , property.carea
	 , property.pstatus
     , property.plotno
	, plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
	, plots.bstatus

	, plots.plot_detail_address


    , projects.project_name

	, streets.street

	, size_cat.size
	, property.floors
	,sector_name
	,ptype.project_name as ptypen

FROM

   property

    Left JOIN plots  ON (property.plot_id = plots.id)
	Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN ptype  ON (property.ptype = ptype.id)

	".$extra1."

	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)

	Left JOIN size_cat  ON (size_cat.id = plots.size2)



where $where limit $start,$limit"; 



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

			

		

			

			echo $count.' result found';
$home="";
$home=Yii::app()->request->baseUrl; 
			$F='';

			$M='';

			echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['project_name'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['pname'].'</a></td><td>'.$key['carea'].'</td><td>'.$key['floors'].'</td><td>'.$key['ptypen'].'</td><td>'.$key['rstatus'].'</td>';
			echo '<td>';


			if($key['status']==''){ 

			echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'&&pro='.$key['project_id'].'">' ."Allot".'</a>';

			}elseif($key['status']=='Requested'){if(!empty($key['fstatus'])){$M='M';}else{$F='F'; } echo'<a href="'.$home.'/index.php/memberplot/requested_detail?id='.$key['id'].'">' ."Requested".'('.$M.$F.')'.'</a>';

			}else{ echo $key['status'];}echo '</td>';

		if(Yii::app()->session['user_array']['per1']=='1')
			{
echo '<td><div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<li role="presentation"><a href="updateplot?id='.$key['id'].'">Edit</a></li>
		<li role="presentation"><a href="reallocate?id='.$key['id'].'">Reallocate</a></li>';
		if($key['status']=='')

			{ 
		echo '<li role="presentation"><a href="deleteplot?id='.$key['id'].'">Delete</a></li>';}
			echo '<li role="presentation"><a target="_blank" href="'.$home.'/fileupload/index.php?id='.$key['id'].'">Upload Docs</a></li>
			</td>';}

			'</tr>';

			}

			 

		

			

			}

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
	
 echo '<tr  ><td colspan="9"><b style="color:#08c">Total Records Found :&nbsp;&nbsp;'.$rows.'</b></td></tr>';
	echo '<tr><td colspan="9">'.$pagination.'</td></tr>'; exit; 
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
	
		}
	public function actionInstalment()
		{
			

		if(Yii::app()->session['user_array']['per2']=='1')

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

	public function actionDelete_Ins()
		{
			
		if(Yii::app()->session['user_array']['per3']=='1')
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

	  }}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

	
		}
	public function actionDelete_Charges()
		{
			
		if(Yii::app()->session['user_array']['per3']=='1')
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
				

	  

		 if(Yii::app()->session['user_array']['per2']=='1')

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
				

	if(Yii::app()->session['user_array']['per2']=='1')

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
	public function actionAllotplot()
		{
				

	 if(Yii::app()->session['user_array']['per2']=='1')

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
	 , plots.project_id

	, categories.name

	, streets.street

	

	

FROM

    plots

    Left JOIN streets  ON (plots.street_id = streets.id)

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
				

			if(Yii::app()->session['user_array']['per2']=='1')

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
	public function actionSearchreqf()
		{
			
		$where='';
		
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
					$where.=" and mp.plotno ='".$_POST['plotno']."'";
				}
				else
				{
					$where.="mp.plotno='".$_POST['plotno']."'";
				}
				$and==true;
			}
	$connection = Yii::app()->db; 
     $sql_member = "SELECT mp.member_id,mp.plotno,tp.status,mp.create_date,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,mp.status,p.plot_size,p.project_id,p.street_id,s.street,s.id,j.id,j.project_name FROM memberplot mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id
left join transferplot tp on p.id=tp.id

left join streets s on p.street_id=s.id


left join projects j on p.project_id=j.id

where $where and p.type='file' and mp.status='Approved' "; 
	
		$result_members = $connection->createCommand($sql_member)->query();
	
	    
 
	$count=0;

	if ($result_members!=''){

		$home=Yii::app()->request->baseUrl; 
$check=1;
    $res=array();

            foreach($result_members as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a></br><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a>

  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

  </br>';if($key['tp.status']=='New Request'){ echo'Cancel Request';}else {echo'<a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'"> Transfer File</a>';}

  echo'</br><a href="updatemember_plot?id='.$key['plot_id'].'">Update Membership</a></td></tr>'; 

			}
			 
			
			
			
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
				

	if(Yii::app()->session['user_array']['per2']=='1')

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
				

	if(Yii::app()->session['user_array']['per2']=='1')

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
	
	public function actionUpdate()
  		{
			

		if(Yii::app()->session['user_array']['per3']=='1' && isset(Yii::app()->session['user_array']['username']))

			{

	$this->layout='//layouts/back';

    $connection = Yii::app()->db; 
	  /*?>
$sql= "SELECT
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
	$result_size = $connection->createCommand($sql_size)->query();
    <?php */

//	$this->render('update',array('pla'=>$result,'projects'=>$result_project,'size'=>$result_size));
$this->render('update');
	
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }

    
		}
	public function actionUpdate_charges()
 		{
			

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per2']=='1'&& isset(Yii::app()->session['user_array']['username']))

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
			

		if(Yii::app()->session['user_array']['per3']=='1' &&Yii::app()->session['user_array']['per2']=='1'&& isset(Yii::app()->session['user_array']['username']))

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
			
			if ((isset($_POST['paid_date']) && empty($_POST['paid_date']))){
			$error.="Enter Paid Date. <br>";
			 }	
			   $connection = Yii::app()->db;  
				  if(empty($error))

			{
			   $sql="UPDATE installpayment set 
			 dueamount='".$_POST['dueamount']."',
			 lab='".$_POST['lab']."',  
			 paidsurcharge='".$_POST['paidsurcharge']."',
			 paidamount='".$_POST['paidamount']."',
			 payment_type='".$_POST['payment_type']."',
			 detail='".$_POST['detail']."',
			 surcharge='".$_POST['surcharge']."',
			 remarks='".$_POST['remarks']."',
			 paid_date='".$_POST['paid_date']."',
			 due_date='".$_POST['due_date']."'
			  where id=".$_POST['id']."";
               $command = $connection -> createCommand($sql);
               $command -> execute();
			   	echo 'Installment Updated Successfully';}
				else{
					echo $error;
					}
			  
	
		}
	public function actionInstallmentup()
		{
			       $error='';
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
		{
			        $error='';
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
			 date='".$_POST['date']."',
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
	public function actionRequested_detail()
		{
			

	if(Yii::app()->session['user_array']['per2']=='1')

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
	protected function performAjaxValidation($model)
		{
			

		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')

		{

			echo CActiveForm::validate($model);

			Yii::app()->end();

		}

	
		}

}


