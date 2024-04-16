<div class="shadow">
  <h3>Summary of Possession,Constructionand Family Shifted</h3>
</div>
           <?php
		 /// echo  $project_id;exit;
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id=".$project_id.""; 
$result = $connection->createCommand($sql)->query();
foreach($result as $ro)
{
echo '<b>Project Name:</b>&nbsp;'.$ro['project_name']; 

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
                        <th style="width:60px;">Sr.No</th>
                        <th style="width:150px;">Block</th>
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
$sql_plots  = "SELECT DISTINCT sector_name,plots.sector FROM plots
	
	Left JOIN sectors ON (plots.sector = sectors.id)
	Left JOIN bcd ON (plots.id = bcd.plot_id)
	
	 where sectors.project_id=1 order by sectors_sorting ";
$result_plots = $connection->createCommand($sql_plots)->query();	
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
<td>'.$row1['sector_name'].'</td>
';
	
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

}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" style="text-align:right;" ><b style="float:right;">Total</b></td>';

echo '<td></td><td class="bgd" style="text-align:center;"><b>'.$possgntd.'</b></td>';
echo '<td class="bgd" style="text-align:center;"><b>'.$tcstarted.'</b></td>';
echo '<td class="bgd" style="text-align:center;"><strong>'.$tcomp.'</strong></td>';
echo '<td class="bgd" style="text-align:center;"><b>'.$tfamily_shifted.'</b></td>';
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
        pointFormat: 'in : <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Population',
        data: [
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
  

