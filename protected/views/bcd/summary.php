<div class="shadow">
  <h3>Summary of Possession,Construction and Family Shifted</h3>
</div>
           <?php
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id=".$project_id.""; 
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
                        <th style="width:100px;">Sr.No</th>
                        <th style="width:150px;">Block</th>
                        <th style="width:150px;">Possession Requested</th>
                        <th style="width:150px;">Possession Granted</th>
                        <th style="width:150px;">Construction Started </th>
                        <th style="width:150px;">Construction Completed</th>
                        <th style="width:150px;">Families Shifted</th>
                        </tr> <tr><b>::  Residential</b></tr>
                </thead>
                <tbody>                
           <?php
$count=0;		  
$connection = Yii::app()->db;  
 $possgntd=0;
 $tcstarted=0;
 $tfamily_shifted=0;
 $tcomp=0;
 $trequested=0;
$sql_plots  = "SELECT DISTINCT sector_name,plots.sector FROM plots
	
	Left JOIN sectors ON (plots.sector = sectors.id)
	Left JOIN bcd ON (plots.id = bcd.plot_id)
	
	 where sectors.project_id=".$project_id." order by sectors_sorting ";
$result_plots = $connection->createCommand($sql_plots)->queryAll();	
foreach($result_plots as $row1)
{ 
	$count++;
 	$possession=0;
	$cstarted=0;
 	$family_shifted=0;
 	$comp=0;
    $sqlpd  = "SELECT COUNT(bcd.plot_id) as total from bcd LEFT JOIN plots on plots.id = bcd.plot_id where project_id=".$project_id." and plots.sector='".$row1['sector']."'  GROUP BY plots.id"; 
    $resultpd = $connection->createCommand($sqlpd)->queryRow();
    $tpossession=COUNT($resultpd);

echo '<tr>
<td>'.$count.'</td>
<td>'.$row1['sector_name'].'</td>';
$req=0;
 $sql_requested = "SELECT * FROM plots p
left join memberplot mp on mp.plot_id=p.id
left join plotpayment pp on pp.plot_id=p.id
where pp.payment_type='Possession Fee' and p.possession_status =0 and p.project_id=".$project_id." and p.sector='".$row1['sector']."'"; 
	
		$result_requested = $connection->createCommand($sql_requested)->query();
 foreach($result_requested as $requested)
			{
		$req++;
	///	$req=($req)+($requested);
		
		}
		
 echo '<td style="text-align:center;">'; if($req==0){ echo'--';}else {echo $req;}
 echo'</td>';
	
     $sqlposs= "SELECT * FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
	 where plots.sector='".$row1['sector']."' AND bcd.possession='Given' and plots.project_id=".$project_id." GROUP BY plots.id";
	 
	$tpossession = $connection->createCommand($sqlposs)->query();
		 foreach($tpossession as $poss)
			{
		$possession++;
		}
	
 echo '<td style="text-align:center;">';if($possession==0){ echo'--';}else {echo $possession;}echo'</td>';
 
 
     $sqlposs= "SELECT COUNT(bcd.plot_id) as consstarted FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
	 where plots.sector='".$row1['sector']."' AND bcd.construction_status !='' and bcd.construction_status !='Completed' and plots.project_id=".$project_id." GROUP BY plots.id";
	 
	$construction = $connection->createCommand($sqlposs)->query();
 foreach($construction as $cons)
	{
		$cstarted++;
		}
		$tcstarted=$tcstarted+$cstarted;
		echo '<td style="text-align:center;">';if($cstarted==0){ echo'--';}else {echo $cstarted;}echo'</td>';
 			$sqlcmplt= "SELECT COUNT(bcd.plot_id) as consstarted FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
			 where plots.sector='".$row1['sector']."'  and bcd.construction_status ='Completed' and plots.project_id=".$project_id." GROUP BY plots.id";
	 
		$cmpleted = $connection->createCommand($sqlcmplt)->query();
 			foreach($cmpleted as $cmplete)
				{
					$comp++;
				}

echo '<td style="text-align:center;">';if($comp==0){ echo'--';}else {echo $comp;}echo'</td>';
$sqlfmy= "SELECT * FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
	 where plots.sector='".$row1['sector']."'  and bcd.family_shifted ='1' and plots.project_id=".$project_id." GROUP BY plots.id";
	$shifted = $connection->createCommand($sqlfmy)->query();
		 foreach($shifted as $family)
			{
			$family_shifted++;
			
			}
echo '<td style="text-align:center;">';if($family_shifted==0){ echo'--';}else {echo $family_shifted;}echo'</td>
</tr>';	

$possgntd=$possession+$possgntd;
$tfamily_shifted=$family_shifted+$tfamily_shifted;
$tcomp=$comp+$tcomp;
$trequested=$trequested+$req;

}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" style="text-align:right;" ><b style="float:left;">Total</b></td>';

echo '<td></td><td class="bgd" style="text-align:center;"><b>'.$trequested.'</b></td><td class="bgd" style="text-align:center;"><b>'.$possgntd.'</b></td>';
echo '<td class="bgd" style="text-align:center;"><b>'.$tcstarted.'</b></td>';
echo '<td class="bgd" style="text-align:center;"><strong>'.$tcomp.'</strong></td>';
echo '<td class="bgd" style="text-align:center;"><b>'.$tfamily_shifted.'</b></td></tr>';
 ?>                 </tbody>
 
 
            </table>
          
            
         </div>   
         
        <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
<script>
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Graph Report'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'in : <b>{point.y:.1f} </b>'
    },
    series: [{
        name: 'Population',
        data: [
            ['Possession Requested',<?php echo $trequested;?>],
            ['Possession Granted', <?php echo $possgntd;?>],
            ['Construction Started', <?php echo $tcstarted;?>],
            ['Construction Completed', <?php echo $tcomp;?>],
			['Family Shifted',<?php echo $tfamily_shifted;?>],
       
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script>
<hr noshade="noshade" class="hr-5 float-left">
  
<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">
 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="landscape">
<textarea style="display:none;" name="html" id="html">
<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
td{  }
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:0px solid;}

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
                  <?php   echo'<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo1.png"/>';?>
                  </td>
                  <td colspan="5" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Possession,Construction and Family Shifted</span></td>
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
                <tr>
                  <td height="20" colspan="7" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php  echo $ro['project_name']; ?></strong></span></td>
                </tr>
                <tr>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Sr No.
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Block
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                Possession Requested	
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                Possession Granted	
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             Construction Started	
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Construction Completed	
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Families Shifted

                </td>
                   
                                 </tr>
                                 


		

                
                
            <?php 
            $sql_plots1  = "SELECT DISTINCT sector_name,plots.sector FROM plots
	
	Left JOIN sectors ON (plots.sector = sectors.id)
	Left JOIN bcd ON (plots.id = bcd.plot_id)
	
	 where sectors.project_id=".$project_id." order by sectors_sorting ";
$result_plots1 = $connection->createCommand($sql_plots1)->queryAll();
			$count=0;
		 foreach($result_plots1 as $row2)
				{
				$count++;
 	$possession=0;
	$cstarted=0;
 	$family_shifted=0;
 	$comp=0;
    $sqlpd  = "SELECT COUNT(bcd.plot_id) as total from bcd LEFT JOIN plots on plots.id = bcd.plot_id where project_id=".$project_id." and plots.sector='".$row2['sector']."'  GROUP BY plots.id"; 
    $resultpd = $connection->createCommand($sqlpd)->queryRow();
    $tpossession=COUNT($resultpd);
	
				?>
                <tr>
                  <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
            <?php echo $count;?>
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             <?php echo $row2['sector_name'];?>
                </td>
                <?php $req=0;
 $sql_requested = "SELECT * FROM plots p
left join memberplot mp on mp.plot_id=p.id
left join plotpayment pp on pp.plot_id=p.id
where pp.payment_type='Possession Fee' and p.possession_status =0 and p.project_id=".$project_id." and p.sector='".$row2['sector']."'"; 
	
		$result_requested = $connection->createCommand($sql_requested)->query();
 foreach($result_requested as $requested)
			{
		$req++;
	
		
		}?>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                <?php if($req==0){ echo'--';}else {echo $req;}?>
                </td>
                
               <?php $sqlposs= "SELECT * FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
	 where plots.sector='".$row2['sector']."' AND bcd.possession='Given' and plots.project_id=".$project_id." GROUP BY plots.id";
	 
	$tpossession = $connection->createCommand($sqlposs)->query();
		 foreach($tpossession as $poss)
			{
		$possession++;
		}
	 ?>
        	
 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php
 if($possession==0){ echo'--';}else {echo $possession;}?></td>
 
                </td>
                <?php $sqlposs= "SELECT COUNT(bcd.plot_id) as consstarted FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
	 where plots.sector='".$row2['sector']."' AND bcd.construction_status !='' and bcd.construction_status !='Started' and plots.project_id=".$project_id." GROUP BY plots.id";
	 
	$construction = $connection->createCommand($sqlposs)->query();
 foreach($construction as $cons)
	{
		$cstarted++;
		}
		$tcstarted1=$tcstarted1+$cstarted;?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php if($cstarted==0){ echo'--';}else {echo $cstarted;}?>
                </td>
                 <?php $sqlcmplt= "SELECT COUNT(bcd.plot_id) as consstarted FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
			 where plots.sector='".$row2['sector']."'  and bcd.construction_status ='Completed' and plots.project_id=".$project_id." GROUP BY plots.id";
	 
		$cmpleted = $connection->createCommand($sqlcmplt)->query();
 			foreach($cmpleted as $cmplete)
				{
					$comp++;
				}?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php if($comp==0){ echo'--';}else {echo $comp;}?>
                </td>
                 <?php $$sqlfmy= "SELECT * FROM bcd LEFT JOIN plots on plots.id = bcd.plot_id 
	 where plots.sector='".$row2['sector']."'  and bcd.family_shifted ='1' and plots.project_id=".$project_id." GROUP BY plots.id";
	$shifted = $connection->createCommand($sqlfmy)->query();
		 foreach($shifted as $family)
			{
			$family_shifted++;
			
			}?>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                  <?php if($family_shifted==0){ echo'--';}else {echo $family_shifted;}?>
                </td>
                   
                
                  </tr>
                  <?php 
                  $trequested1=$trequested1+$req;
                  $possgntd1=$possession+$possgntd;
                    $tfamily_shifted1=$family_shifted+$tfamily_shifted;
                    $tcomp1=$comp+$tcomp;

                  }?>
                  <tr>
                   <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           Total </td>
            <td  height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"></td>
                  <td  height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
                      <?php echo $trequested1;?>
                  </td>
                 
            
              <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             <?php echo $possgntd1;?></td>
              <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           <?php echo $tcstarted1;?>  </td> <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           <?php echo $tcomp1 ?>  </td>
              <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           <?php echo $tfamily_shifted1;?>  </td>
            </tr>
                
               
                
                
                
                
            </table></td>
          </tr>
      </table></td>
      </tr>
    
   
  </table>
  </textarea>
<input style="float:left;" type="submit" name="submit" value="Print Report" /></form>
</form> 