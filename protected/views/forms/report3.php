<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 0px 12px;}
	td{ text-align:center !important}
</style>
<div class="shadow">
<a href="bookingreport" class="btn pull-right" style="padding:5px; margin-left:10px; ">Booking Status</a>
<a href="report" class="btn pull-right" style="padding:5px; margin-left:10px;">Mode Wise</a>
<a href="report4" class="btn pull-right" style="padding:5px; margin-left:10px;">City Wise</a>
<a href="report5" class="btn pull-right" style="padding:5px; margin-left:10px;">Prime Locations</a>
  <h3>Booking Status : Plot Size Wise</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">



<!--<form name="login-form" method="post" action="">-->



			

			<div class="clearfix"></div>
	
  			<div class="">
            <table class="table table-striped table-new table-bordered "  style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                   
                        <th width="4%"> Sr.NO.</th>
                          <th width="5%">Logo</th>
                          <th width="10%">Distributor Name</th>
                        <th width="6%">Total Forms</th>
                       <th width="5%">Total Booking</th>
                       <?php 
					   $connection = Yii::app()->db; 
$sql_size  ="SELECT * from size_cat";
$res_size = $connection->createCommand($sql_size)->query();
					   foreach($res_size as $size){
						   echo '<th width="5%">'.$size['size'].'</th>';
						  
						   
						   }
					   ?>
                        <th width="8%">Remarks</th>
                       
						
                       
                </thead>
                <tbody id="error-div">
<?php

$sql_count  ="SELECT * from seller";
$res_count = $connection->createCommand($sql_count)->queryAll();

$i=0;

        foreach($res_count as $key){
			$i++;
			$sql_saller='';
                       $res_saller='';
			$sql_saller  ="SELECT * from forms where seller_id='".$key['id']."'";
			$res_saller = $connection->createCommand($sql_saller)->query();
			$sco=count($res_saller);
			$sql_saller='';
                       $res_saller='';
			$sql_saller  ="SELECT * from forms where seller_id='".$key['id']."'";
			$res_saller = $connection->createCommand($sql_saller)->query();
			$tb=0;
			foreach($res_saller as $ress){
				if($ress['tm']=='1'){$tb++;}
				}
			echo '<tr>
			<td >'.$i.'</td>
			<td><img src="'.Yii::app()->request->baseUrl.'/images/seller/'.$key['logo'].'" width="40"/></td>
			<td style="text-align:left !important">'.$key['name'].'</td>';
			
			echo '<td><b>'.$sco.'</b></td>
			<td><b>'.$tb.'</b></td>';
			$sql='';
            $res='';

            $db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
            $conn=mysql_connect($db['host'],$db['username'],$db['password']) or die(mysql_error());;

				       //$conn = mysql_connect('localhost','rdlpk_admin','creative123admin') or die(mysql_error());
$select_db = mysql_select_db($db['db_name'],$conn) or die(mysql_error());
				$sql = "SELECT * from `forms` where seller_id='".$key['id']."'";
				$result = mysql_query($sql) or die(mysql_error());
				
			
			
			$sql_size1  ='';
			$res_size1 = '';
			$sql_size1  ="SELECT * from size_cat";
			$res_size1 = $connection->createCommand($sql_size1)->queryAll();
			foreach($res_size1 as $finfo){
			$sql = "SELECT * from `forms` where seller_id='".$key['id']."'";
				$result = mysql_query($sql) or die(mysql_error());
			$cod=''	;
			while($siz = mysql_fetch_array($result)){
				if($finfo['id']==$siz['size']){$cod++;}
				
				}
					echo '<td>'.$cod.'</td>'; 
				
			}
			echo '<td></td></tr>'; 
			
}	echo '<tr><td colspan="3" style="text-align:right;"><b>Total Booking</b></td>';

  $connection = Yii::app()->db;
  $tis=0;
 $tmem=0;
foreach($res_count as $rows){
                $sql = "SELECT * from `forms` where seller_id='".$rows['id']."'";
				$result = mysql_query($sql) or die(mysql_error());	
while($row = mysql_fetch_array($result)){
						$tis++;
					if($row['tm']==1){$tmem++;}
					}
}

				
				
				echo '<td><b>'.$tis.'</b></td><td><b>'.$tmem.'</b></td>';
			
			
			foreach($res_size1 as $finfo){
				$cod=''	;
			$sql = "SELECT * from `forms`";
				$result = mysql_query($sql) or die(mysql_error());
			while($siz = mysql_fetch_array($result)){
				if($finfo['id']==$siz['size']){$cod++;}
				}
					echo '<td><b>'.$cod.'</b></td>'; 
				
			}
echo '<td></td>';
echo '<tr>';		?>
            
                </tbody>



            </table>


 			



  	



  </div>

<hr noshade="noshade" class="hr-5 float-left">




</section>

</div>
  



  



 



 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

 