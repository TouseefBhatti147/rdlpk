<div class="shadow">
  <h3>Files Transferred Report</h3>
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

  <div class="float-left">
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="10%">Plot Categories</th>
                   
                        <th width="7%">Transferred</th>
                        <th width="7%">Retransferred </th>
                        <th width="8%">Under Process</th>
                        <th width="6%">Total Transferred</th>
                        </tr> <tr><b>::  Residential</b></tr>
                </thead>
                <tbody>                
           <?php
$total_no_plotsr=0;
$t_transferredr=0;
$t_retransferredr=0;
$to_rem=0;
$to_reqr=0;
$connection = Yii::app()->db;  
$sql_street  = "SELECT * from plots where com_res='Residential' and project_id='".$_POST['project']."'";
$result_streets = $connection->createCommand($sql_street)->query();
	//echo $total_no_plots;exit
$sql_plots  = "SELECT DISTINCT size_cat.size_sorting,size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id) where size_cat.typee='R' order by size_cat.size_sorting ASC ";
$result_plots = $connection->createCommand($sql_plots)->query();	
foreach($result_plots as $row1)
{
 $sqlpd  = "SELECT COUNT(transferplot.plot_id) as total from transferplot LEFT JOIN plots on plots.id = transferplot.plot_id where project_id='".$_POST['project']."' and plots.com_res='Residential' and plots.size2='".$row1['size2']."'  GROUP BY plots.id"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$total=COUNT($resultpd);
$transfer=0;
$retransfer=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
$subt=0;
echo '<tr><td>'.$row1['size'].'<a href="trans_det_rpt?project='.$_POST['project'].'&&sizeid='.$row1['size2'].'" target="_blank" style="float:right; color:black;">View Detail</a></td>';
	 $sql_plots1  = "
	 SELECT transferplot.status,COUNT(transferplot.plot_id) as transfer FROM `transferplot` LEFT JOIN plots on plots.id = transferplot.plot_id 
	 where plots.size2='".$row1['size2']."' AND plots.com_res='Residential' and plots.project_id='".$_POST['project']."' GROUP BY plots.id";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	$transfer++;
	if($row3['transfer']>1)
	{
		$retransfer++;
	}
	if($row3['status']!='Approved'){$req++;}
	$total++;
	
	
	}
	$subt=$transfer+$retransfer+$req;
$to_reqr=$to_reqr+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;

$total_no_plotsr=$subt+$total_no_plotsr;

	
echo '<td style="text-align:right;">'.number_format($transfer).'</td>';
echo '<td style="text-align:right;">'.number_format($retransfer).'</td>';

echo '<td style="text-align:right;">'.number_format($req).'</td>';
echo '<td style="text-align:right;">'.number_format($subt).'</td>
</tr>';	

$t_transferredr=$t_transferredr+$transfer;
$t_retransferredr=$t_retransferredr+$retransfer;
}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" style="text-align:right;" ><b style="float:right;">Total</b></td>';

echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_transferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_retransferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><strong>'.number_format($to_reqr).'</strong></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($total_no_plotsr).'</b></td>';
 ?>                 </tbody>
            </table>
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="10%">Plot Categories</th>
                   
                        <th width="7%">Transferred</th>
                        <th width="7%">Retransferred </th>
                        <th width="8%">Under Process</th>
                        <th width="6%">Total Transferred</th>
                        </tr> <tr><b>::  Comercial</b></tr>
                </thead>
                <tbody>                
           <?php
$total_no_plotsc=0;
$t_transferredc=0;
$t_retransferredc=0;
$to_rem=0;
$to_reqc=0;
$connection = Yii::app()->db;  
$sql_street  = "SELECT * from plots where com_res='Commercial' and project_id='".$_POST['project']."'";
$result_streets = $connection->createCommand($sql_street)->query();
	//echo $total_no_plots;exit
$sql_plots  = "SELECT DISTINCT size_cat.size_sorting,size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id) where size_cat.typee='C' order by size_cat.size_sorting ASC ";
$result_plots = $connection->createCommand($sql_plots)->query();	
foreach($result_plots as $row1)
{
 $sqlpd  = "SELECT COUNT(transferplot.plot_id) as total from transferplot LEFT JOIN plots on plots.id = transferplot.plot_id where project_id='".$_POST['project']."' and plots.com_res='Commercial' and plots.size2='".$row1['size2']."'  GROUP BY plots.id"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$total=COUNT($resultpd);
$transfer=0;
$retransfer=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
$subt=0;
echo '<tr><td>'.$row1['size'].'<a href="trans_det_rptc?project='.$_POST['project'].'&&sizeid='.$row1['size2'].'" target="_blank" style="float:right; color:black;">View Detail</a></td>';
	 $sql_plots1  = "
	 SELECT transferplot.status,COUNT(transferplot.plot_id) as transfer FROM `transferplot` LEFT JOIN plots on plots.id = transferplot.plot_id 
	 where plots.size2='".$row1['size2']."' AND plots.com_res='Commercial' and plots.project_id='".$_POST['project']."' GROUP BY plots.id";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	$transfer++;
	if($row3['transfer']>1)
	{
		$retransfer++;
	}
	if($row3['status']!='Approved'){$req++;}
	$total++;
	
	
	}
	$subt=$transfer+$retransfer+$req;
$to_reqc=$to_reqc+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;

$total_no_plotsc=$subt+$total_no_plotsc;

	
echo '<td style="text-align:right;">'.number_format($transfer).'</td>';
echo '<td style="text-align:right;">'.number_format($retransfer).'</td>';

echo '<td style="text-align:right;">'.number_format($req).'</td>';
echo '<td style="text-align:right;">'.number_format($subt).'</td>
</tr>';	

$t_transferredc=$t_transferredc+$transfer;
$t_retransferredc=$t_retransferredc+$retransfer;
}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" style="text-align:right;" ><b style="float:right;">Total</b></td>';

echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_transferredc).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_retransferredc).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><strong>'.number_format($to_reqc).'</strong></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($total_no_plotsc).'</b></td>';
 ?>                 </tbody>
            </table>
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                     
                   		<th width="10%"></th>
                        <th width="7%">Transferred</th>
                        <th width="7%">Retransferred </th>
                        <th width="8%">Under Process</th>
                        <th width="6%">Total Transferred</th>
                        </tr> <tr><b>::  Grand Total (Residential+Commercial)</b></tr>
                </thead>
                <tbody>                
           <?php
$total_no_plots=0;
$t_transferred=0;
$t_retransferred=0;
$to_rem=0;
$to_req=0;
$connection = Yii::app()->db;  
$sql_street  = "SELECT * from plots where com_res='Commercial' and project_id='".$_POST['project']."'";
$result_streets = $connection->createCommand($sql_street)->query();
	//echo $total_no_plots;exit
$sql_plots  = "SELECT DISTINCT size_cat.size_sorting,size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id) where size_cat.typee='C' order by size_cat.size_sorting ASC ";
$result_plots = $connection->createCommand($sql_plots)->query();	
foreach($result_plots as $row1)
{
 $sqlpd  = "SELECT COUNT(transferplot.plot_id) as total from transferplot LEFT JOIN plots on plots.id = transferplot.plot_id where project_id='".$_POST['project']."' and plots.com_res='Commercial' and plots.size2='".$row1['size2']."'  GROUP BY plots.id"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$total=COUNT($resultpd);
$transfer=0;
$retransfer=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
$subt=0;
echo '<tr>';
	 $sql_plots1  = "
	 SELECT transferplot.status,COUNT(transferplot.plot_id) as transfer FROM `transferplot` LEFT JOIN plots on plots.id = transferplot.plot_id 
	 where plots.size2='".$row1['size2']."' AND plots.com_res='Commercial' and plots.project_id='".$_POST['project']."' GROUP BY plots.id";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	$transfer++;
	if($row3['transfer']>1)
	{
		$retransfer++;
	}
	if($row3['status']!='Approved'){$req++;}
	$total++;
	
	
	}
	$subt=$transfer+$retransfer+$req;
$to_req=$to_req+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;

$total_no_plots=$subt+$total_no_plots;

	

echo'</tr>';	

$t_transferred=$t_transferred+$transfer;
$t_retransferred=$t_retransferred+$retransfer;
}
//echo '<td class="bgd"><b></b></td>';

echo '<td class="bgd" style="text-align:right;"><b>Total</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_transferredc+$t_transferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_retransferredc+$t_retransferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><strong>'.number_format($to_reqc+$to_reqr).'</strong></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($total_no_plotsc+$total_no_plotsr).'</b></td>';
 ?>                 </tbody>
            </table>
         </div>   
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
echo '<b>Project Name:</b>'.$ro['project_name'].'<br>';
 
}?> 
            <br>Residential
             <table class="table table-striped table-new table-bordered" width="100%">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="10%">Plot Categories</th>
                   
                        <th width="10%">Transferred</th>
                        <th width="10%">Retransferred </th>
                        <th width="10%">Under Process</th>
                        <th width="10%">Total Transferred</th>
                        </tr>
                </thead>
                <tbody>                
           <?php
$total_no_plotsr=0;
$t_transferredr=0;
$t_retransferredr=0;
$to_rem=0;
$to_reqr=0;
$connection = Yii::app()->db;  
$sql_street  = "SELECT * from plots where com_res='Residential' and project_id='".$_POST['project']."'";
$result_streets = $connection->createCommand($sql_street)->query();
	//echo $total_no_plots;exit
$sql_plots  = "SELECT DISTINCT size_cat.size_sorting,size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id) where size_cat.typee='R' order by size_cat.size_sorting ASC ";
$result_plots = $connection->createCommand($sql_plots)->query();	
foreach($result_plots as $row1)
{
 $sqlpd  = "SELECT COUNT(transferplot.plot_id) as total from transferplot LEFT JOIN plots on plots.id = transferplot.plot_id where project_id='".$_POST['project']."' and plots.com_res='Residential' and plots.size2='".$row1['size2']."'  GROUP BY plots.id"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$total=COUNT($resultpd);
$transfer=0;
$retransfer=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
$subt=0;
echo '<tr><td>'.$row1['size'].'</td>';
	 $sql_plots1  = "
	 SELECT transferplot.status,COUNT(transferplot.plot_id) as transfer FROM `transferplot` LEFT JOIN plots on plots.id = transferplot.plot_id 
	 where plots.size2='".$row1['size2']."' AND plots.com_res='Residential' and plots.project_id='".$_POST['project']."' GROUP BY plots.id";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	$transfer++;
	if($row3['transfer']>1)
	{
		$retransfer++;
	}
	if($row3['status']!='Approved'){$req++;}
	$total++;
	
	
	}
	$subt=$transfer+$retransfer+$req;
$to_reqr=$to_reqr+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;

$total_no_plotsr=$subt+$total_no_plotsr;

	
echo '<td style="text-align:right;">'.number_format($transfer).'</td>';
echo '<td style="text-align:right;">'.number_format($retransfer).'</td>';

echo '<td style="text-align:right;">'.number_format($req).'</td>';
echo '<td style="text-align:right;">'.number_format($subt).'</td>
</tr>';	

$t_transferredr=$t_transferredr+$transfer;
$t_retransferredr=$t_retransferredr+$retransfer;
}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" style="text-align:right;" ><b style="float:right;">Total</b></td>';

echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_transferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_retransferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><strong>'.number_format($to_reqr).'</strong></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($total_no_plotsr).'</b></td>';
 ?>                 </tbody>
            </table>  <br>Commercial
              <table class="table table-striped table-new table-bordered" width="100%">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="10%">Plot Categories</th>
                   
                        <th width="10%">Transferred</th>
                        <th width="10%">Retransferred </th>
                        <th width="10%">Under Process</th>
                        <th width="10%">Total Transferred</th>
                        </tr> 
                </thead>
                <tbody>                
           <?php
$total_no_plotsc=0;
$t_transferredc=0;
$t_retransferredc=0;
$to_rem=0;
$to_reqc=0;
$connection = Yii::app()->db;  
$sql_street  = "SELECT * from plots where com_res='Commercial' and project_id='".$_POST['project']."'";
$result_streets = $connection->createCommand($sql_street)->query();
	//echo $total_no_plots;exit
$sql_plots  = "SELECT DISTINCT size_cat.size_sorting,size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id) where size_cat.typee='C' order by size_cat.size_sorting ASC ";
$result_plots = $connection->createCommand($sql_plots)->query();	
foreach($result_plots as $row1)
{
 $sqlpd  = "SELECT COUNT(transferplot.plot_id) as total from transferplot LEFT JOIN plots on plots.id = transferplot.plot_id where project_id='".$_POST['project']."' and plots.com_res='Commercial' and plots.size2='".$row1['size2']."'  GROUP BY plots.id"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$total=COUNT($resultpd);
$transfer=0;
$retransfer=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
$subt=0;
echo '<tr><td>'.$row1['size'].'</td>';
	 $sql_plots1  = "
	 SELECT transferplot.status,COUNT(transferplot.plot_id) as transfer FROM `transferplot` LEFT JOIN plots on plots.id = transferplot.plot_id 
	 where plots.size2='".$row1['size2']."' AND plots.com_res='Commercial' and plots.project_id='".$_POST['project']."' GROUP BY plots.id";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	$transfer++;
	if($row3['transfer']>1)
	{
		$retransfer++;
	}
	if($row3['status']!='Approved'){$req++;}
	$total++;
	
	
	}
	$subt=$transfer+$retransfer+$req;
$to_reqc=$to_reqc+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;

$total_no_plotsc=$subt+$total_no_plotsc;

	
echo '<td style="text-align:right;">'.number_format($transfer).'</td>';
echo '<td style="text-align:right;">'.number_format($retransfer).'</td>';

echo '<td style="text-align:right;">'.number_format($req).'</td>';
echo '<td style="text-align:right;">'.number_format($subt).'</td>
</tr>';	

$t_transferredc=$t_transferredc+$transfer;
$t_retransferredc=$t_retransferredc+$retransfer;
}
//echo '<td class="bgd"><b></b></td>';

 ?>                </tbody>
            </table>
            <br />Grand Total:(Residential+Commercial)
                 <table class="table table-striped table-new table-bordered" width="100%">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                      <th width="7%"></th>
                        <th width="7%">Transferred</th>
                        <th width="7%">Retransferred </th>
                        <th width="8%">Under Process</th>
                        <th width="6%">Total Transferred</th>
                </thead>
                <tbody>                
                      <?php
                      $total_no_plots=0;
$t_transferred=0;
$t_retransferred=0;
$to_rem=0;
$to_req=0;
$connection = Yii::app()->db;  
$sql_street  = "SELECT * from plots where com_res='Commercial' and project_id='".$_POST['project']."'";
$result_streets = $connection->createCommand($sql_street)->query();
	//echo $total_no_plots;exit
$sql_plots  = "SELECT DISTINCT size_cat.size_sorting,size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id) where size_cat.typee='C' order by size_cat.size_sorting ASC ";
$result_plots = $connection->createCommand($sql_plots)->query();	
foreach($result_plots as $row1)
{
 $sqlpd  = "SELECT COUNT(transferplot.plot_id) as total from transferplot LEFT JOIN plots on plots.id = transferplot.plot_id where project_id='".$_POST['project']."' and plots.com_res='Commercial' and plots.size2='".$row1['size2']."'  GROUP BY plots.id"; 
$resultpd = $connection->createCommand($sqlpd)->queryRow();
$total=COUNT($resultpd);
$transfer=0;
$retransfer=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$req=0;
$total=0;
$subt=0;
	 $sql_plots1  = "
	 SELECT transferplot.status,COUNT(transferplot.plot_id) as transfer FROM `transferplot` LEFT JOIN plots on plots.id = transferplot.plot_id 
	 where plots.size2='".$row1['size2']."' AND plots.com_res='Commercial' and plots.project_id='".$_POST['project']."' GROUP BY plots.id";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	$transfer++;
	if($row3['transfer']>1)
	{
		$retransfer++;
	}
	if($row3['status']!='Approved'){$req++;}
	$total++;
	
	
	}
	$subt=$transfer+$retransfer+$req;
$to_req=$to_req+$req;
$totals2=$size2_ftnumbers+$size2_ptnumbers;

$total_no_plots=$subt+$total_no_plots;

	

	

$t_transferred=$t_transferred+$transfer;
$t_retransferred=$t_retransferred+$retransfer;
}
echo '<tr><td class="bgd" style="text-align:right;"><b>Total</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_transferredc+$t_transferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($t_retransferredc+$t_retransferredr).'</b></td>';
echo '<td class="bgd" style="text-align:right;"><strong>'.number_format($to_reqc+$to_reqr).'</strong></td>';
echo '<td class="bgd" style="text-align:right;"><b>'.number_format($total_no_plotsc+$total_no_plotsr).'</b></td></tr>';
					  ?>  
                 </tbody>
            </table>
</body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Print Report" /></form>
</form> 