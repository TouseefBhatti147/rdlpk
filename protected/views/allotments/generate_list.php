
<div class="">
<div class="shadow">
  <h3>List</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">


<?php 
$connection = Yii::app()->db; 

// All Membership(Files) With Status Open
 $sql_size  = "SELECT * FROM size_cat";
$result_size = $connection->createCommand($sql_size)->queryAll();
foreach($result_size as $size){
 $sql_payment  = "SELECT memberplot.*,plots.size2 FROM memberplot 
Left join plots on (memberplot.plot_id=plots.id)
where memberplot.bstatus='open' and plots.size2='".$size['id']."' and plots.project_id='1'";
$result_payments = $connection->createCommand($sql_payment)->queryAll();

foreach($result_payments as $row){
	//Required Plot Prime Location
 $sql_payment0  = "SELECT * from cat_app where ms_id='".$row['id']."'";
$result_payments0 = $connection->createCommand($sql_payment0)->queryAll();
$aa=0;
$catt='';

if($result_payments0 !==''){
	
foreach($result_payments0 as $ass){if($aa==1){$catt.=',';} $catt.= ' '.$ass['cat_id'];$aa++; };
if($catt==''){$catt='0';}
//Prime Location 100% match 
//echo $catt;exit;
   $sql_payment1  = "SELECT * From plots 
Left JOIN cat_plot ON (plots.id = cat_plot.plot_id)
where plots.type='Plot' and plots.project_id='1' and bstatus='Open' and size2='".$size['id']."' and cat_plot.cat_id IN (".$catt.") GROUP by plots.id HAVING count(*) = ".$aa."" ;
$result_payments1 = $connection->createCommand($sql_payment1)->queryRow();
if(count($result_payments1)==1)
//if(count((is_countable($result_payments1)?$result_payments1:[])))

{
	
$sql_payment1  = "SELECT * From plots 
Left JOIN cat_plot ON (plots.id = cat_plot.plot_id)
where plots.type='Plot' and plots.project_id='1' and size2='".$size['id']."' and bstatus='Open' and cat_plot.cat_id IN (".$catt.")";
$result_payments1 = $connection->createCommand($sql_payment1)->queryRow();

}
}
if($result_payments1>1){
$sql="INSERT INTO member_plot SET plot_id='".$result_payments1['plot_id']."',ms_id='".$row['id']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();
$sql11="Update plots SET bstatus='done' where id='".$result_payments1['plot_id']."' ";	 
$command = $connection -> createCommand($sql11);
$command -> execute();
$sql="Update memberplot SET bstatus='done' where id='".$row['id']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();
}

}



$sql_paymentn2  = "SELECT memberplot.*,plots.size2 FROM memberplot 
Left join plots on (memberplot.plot_id=plots.id)
where memberplot.bstatus='open' and plots.size2='".$size['id']."' and plots.project_id='1'";
$result_paymentsn2 = $connection->createCommand($sql_paymentn2)->queryAll();
foreach($result_paymentsn2 as $rown2){
$sector  = "SELECT * from app where msid='".$rown2['id']."' and sector_id!=0";
$result_sector = $connection->createCommand($sector)->queryRow();
if($result_sector>1){
$sql_plo  = "SELECT * From plots where type='Plot' and plots.project_id='1' and size2='".$size['id']."' and sector='".$result_sector['sector_id']."' and bstatus='Open'" ;
$result_plo = $connection->createCommand($sql_plo)->queryRow();
if($result_plo>1){
$sql="INSERT INTO member_plot SET plot_id='".$result_plo['id']."',ms_id='".$rown2['id']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();
$sql11="Update plots SET bstatus='done' where id='".$result_plo['id']."' ";	 
$command = $connection -> createCommand($sql11);
$command -> execute();
$sql="Update memberplot SET bstatus='done' where id='".$rown2['id']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();
}
}
}
$sql_paymentn3  = "SELECT memberplot.*,plots.size2 FROM memberplot 
Left join plots on (memberplot.plot_id=plots.id)
where memberplot.bstatus='open' and plots.size2='".$size['id']."' and plots.project_id='1'";
$result_paymentsn3 = $connection->createCommand($sql_paymentn3)->queryAll();
foreach($result_paymentsn3 as $rown3){
$sql_plo  = "SELECT * From plots where type='Plot' and plots.project_id='1' and size2='".$size['id']."' and bstatus='Open'" ;
$result_plo = $connection->createCommand($sql_plo)->queryRow();
if($result_plo>1){
$sql="INSERT INTO member_plot SET plot_id='".$result_plo['id']."',ms_id='".$rown3['id']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();
$sql11="Update plots SET bstatus='done' where id='".$result_plo['id']."' ";	 
$command = $connection -> createCommand($sql11);
$command -> execute();
$sql="Update memberplot SET bstatus='done' where id='".$rown3['id']."' ";	 
$command = $connection -> createCommand($sql);
$command -> execute();
}
}


}
?>




