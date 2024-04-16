<div class="shadow">
  <h3>Detail Report</h3>
</div>
           <?php
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id='".$_POST['project']."'"; 
$result = $connection->createCommand($sql)->query();
foreach($result as $ro)
{
echo '<b>Project Name:</b>'.$ro['project_name']; 

}

?> 

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<style>

.bgd { background-color:#999; }

.float-left{ height:auto;}



</style>

<section class="reg-section margin-top-30">





<div>

 

 </div>

  <div class="float-left">

   

            

            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                        <th width="10%">Plot Categories</th>

                        

                        <th width="6%">Total Plots</th>

                        <th width="7%">File Alloted</th>

                        <th width="7%">Plot Alloted</th>

                        <th width="7%">Villas</th>
                        <th width="7%">Reserved</th>

                        <th width="8%">Under Process</th>
                        <th width="8%">Balance (Open)</th>

                        

                        </tr>

                        <tr><b>::  Residential</b></tr>

                </thead>

                <tbody>

                

           <?php

$total_no_plots=0;

$t_f_alloted=0;

$t_p_alloted=0;

$to_rem=0;
$to_req=0;

$connection = Yii::app()->db;  

$sql_street  = "SELECT * from plots where com_res='Residential' and project_id='".$_POST['project']."'";

$result_streets = $connection->createCommand($sql_street)->query();


	//echo $total_no_plots;exit;
$sql_plots  = "SELECT DISTINCT size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
";
$result_plots = $connection->createCommand($sql_plots)->query();	

foreach($result_plots as $row1)
{
$sqlpd  = "SELECT * from plots_def where project_id='".$_POST['project']."' and type='Res' and size_id='".$row1['size2']."'"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$size2_ftnumber=0;
$size2_ptnumber=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
echo '<tr><td>'.$row1['size'].'</td>';
	$sql_plots1  = "SELECT * from plots
	 where size2='".$row1['size2']."' AND com_res='Residential' and project_id='".$_POST['project']."'";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	if($row3['type']=='file' && $row3['status']=='Alotted'){$size2_ftnumber++;$t_f_alloted++;}
	if($row3['type']=='Plot' && $row3['status']=='Alotted'){$size2_ptnumber++;$t_p_alloted++;}
	if($row3['status']=='Requested'){$req++;}
	if($row3['type']=='file'){$size2_ftnumbers++;}
	if($row3['type']=='Plot'){$size2_ptnumbers++;}
	$total++;
	}
$to_req=$to_req+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;
$totals3=$size2_ftnumber+$size2_ptnumber;	
$rem=$resultpd['total']-$totals3;
$to_rem=$to_rem+($rem-$req);

echo '<td style="text-align:right;">'.number_format($resultpd['total']).'</td>';
echo '<td style="text-align:right;">'.number_format($size2_ftnumber).'</td>';
echo '<td style="text-align:right;">'.number_format($size2_ptnumber).'</td>';
echo '<td></td>';
echo '<td></td>';
echo '<td style="text-align:right;">'.number_format($req).'</td>';	
echo '<td style="text-align:right;">'.number_format(($rem-$req)).'</td></tr>';	
$total_no_plots=$total_no_plots+$resultpd['total'];
}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" style="text-align:right;" ><b style="float:right;">Total</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($total_no_plots).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_f_alloted).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_p_alloted).'</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($to_req).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($to_rem).'</b></td></tr>';	
$t_f_allotedn=$t_f_alloted/$total_no_plots*100;
$t_p_allotedn=$t_p_alloted/$total_no_plots*100;
$to_remn=$to_rem/$total_no_plots*100;
echo '<tr><td class="bgd"><b style="float:right;">%age</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_f_allotedn).'%</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_p_allotedn).'%</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd"><b></b></td>';	
echo '<td class="bgd"></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($to_remn).'%</b></td></tr>';	

 ?>                 </tbody>
            </table>
<hr noshade="noshade" class="hr-5 float-left">


<hr noshade="noshade" class="hr-5 float-left">
  <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">
 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="landscape">
<textarea style="visibility:hidden;" name="html" id="html">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
td{ padding:0px; border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}
</style>
</head>
<body>

           <?php
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id='".$_POST['project']."'"; 
$result = $connection->createCommand($sql)->query();
foreach($result as $ro)
{
echo  '<h3>Detail Report</h3>';
echo '<b>Project Name:</b>'.$ro['project_name']; 

}

?> 



   

            

            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                        <th width="220">Plot Categories</th>

                        

                        <th width="100px">Total Plots</th>

                        <th width="100px">File Alloted</th>

                        <th width="100px">Plot Alloted</th>

                        <th width="100px">Villas</th>
                        <th width="100px">Reserved</th>

                        <th width="100px">Under Process</th>
                        <th width="100px">Balance (Open)</th>

                        

                        </tr>

                     
                </thead>

                <tbody>

                

           <?php

$total_no_plots=0;

$t_f_alloted=0;

$t_p_alloted=0;

$to_rem=0;
$to_req=0;

$connection = Yii::app()->db;  

$sql_street  = "SELECT * from plots where com_res='Residential' and project_id='".$_POST['project']."'";

$result_streets = $connection->createCommand($sql_street)->query();


	//echo $total_no_plots;exit;
$sql_plots  = "SELECT DISTINCT size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
";
$result_plots = $connection->createCommand($sql_plots)->query();	

foreach($result_plots as $row1)
{
$sqlpd  = "SELECT * from plots_def where project_id='".$_POST['project']."' and type='Res' and size_id='".$row1['size2']."'"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$size2_ftnumber=0;
$size2_ptnumber=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
echo '<tr><td>'.$row1['size'].'</td>';
	$sql_plots1  = "SELECT * from plots
	 where size2='".$row1['size2']."' AND com_res='Residential' and project_id='".$_POST['project']."'";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	if($row3['type']=='file' && $row3['status']=='Alotted'){$size2_ftnumber++;$t_f_alloted++;}
	if($row3['type']=='Plot' && $row3['status']=='Alotted'){$size2_ptnumber++;$t_p_alloted++;}
	if($row3['status']=='Requested'){$req++;}
	if($row3['type']=='file'){$size2_ftnumbers++;}
	if($row3['type']=='Plot'){$size2_ptnumbers++;}
	$total++;
	}
$to_req=$to_req+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;
$totals3=$size2_ftnumber+$size2_ptnumber;	
$rem=$resultpd['total']-$totals3;
$to_rem=$to_rem+($rem-$req);

echo '<td style="text-align:right;">'.number_format($resultpd['total']).'</td>';
echo '<td style="text-align:right;">'.number_format($size2_ftnumber).'</td>';
echo '<td style="text-align:right;">'.number_format($size2_ptnumber).'</td>';
echo '<td></td>';
echo '<td></td>';
echo '<td style="text-align:right;">'.number_format($req).'</td>';	
echo '<td style="text-align:right;">'.number_format(($rem-$req)).'</td></tr>';	
$total_no_plots=$total_no_plots+$resultpd['total'];
}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" style="text-align:right;" ><b style="float:right;">Total</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($total_no_plots).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_f_alloted).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_p_alloted).'</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($to_req).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($to_rem).'</b></td></tr>';	
$t_f_allotedn=$t_f_alloted/$total_no_plots*100;
$t_p_allotedn=$t_p_alloted/$total_no_plots*100;
$to_remn=$to_rem/$total_no_plots*100;
echo '<tr><td class="bgd"><b style="float:right;">%age</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_f_allotedn).'%</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_p_allotedn).'%</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd"><b></b></td>';	
echo '<td class="bgd"></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($to_remn).'%</b></td></tr>';	

 ?>                 </tbody>
            </table>
</body>

</html>

</textarea>

<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>

</form> 