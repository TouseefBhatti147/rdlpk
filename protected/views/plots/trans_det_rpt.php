<div class="shadow">
  <h3>Transferred Detail Report (Residential)</h3>
</div>
           <?php
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id='".$_GET['project']."'"; 
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
                         <th width="3%">S.No.</th>
                   
                        <th width="10%">Transfer From</th>
                        <th width="10%">Transfer To</th>
                        <th width="4%">Transfer Date</th>
                        <th width="5%">Plot No.</th>
                         <th width="4%">Street/Lane</th>
                          <th width="4%">Block.</th>
                          <th width="4%">Price.</th>
                          <th width="8%">Project.</th>
                        </tr> <tr><b>::  Residential</b></tr>
                </thead>
                <tbody>                
           <?php
		   	   $connection = Yii::app()->db;  
	$count=0;
	$sql_plots1  = "SELECT * FROM transferplot
	Left JOIN plots ON (transferplot.plot_id = plots.id)
	Left JOIN projects ON (plots.project_id = projects.id)
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
	Left JOIN sectors ON (sectors.id = plots.sector)
	Left JOIN memberplot ON (transferplot.plot_id = memberplot.plot_id)
	 where plots.project_id='".$_GET['project']."' and plots.size2='".$_GET['sizeid']."' and plots.com_res='Residential'";
$result_plots1 = $connection->createCommand($sql_plots1)->queryAll();	
foreach($result_plots1 as $row2){
	$count++;
	
$sql_from  = "SELECT * from members where id='".$row2['transferfrom_id']."'";
$result_froms = $connection->createCommand($sql_from)->queryRow();

$sql_to  = "SELECT * from members where id='".$row2['transferto_id']."'";
$result_tos = $connection->createCommand($sql_to)->queryRow();
	
$old_date = $row2['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	
	echo '<tr><td>'.$count.'</td>
	<td>'.$result_froms['name'].'</td>
	<td>'.$result_tos['name'].'</td>
	
	<td>'.$new_date.'</td>
	<td>'.$row2['size'].'('.$row2['plot_size'].')'.'</td>
	<td>'.$row2['plot_detail_address'].'</td>
	<td>'.$row2['sector_name'].'</td>
	<td>'.$row2['price'].'</td>
	<td>'.$row2['project_name'].'</td>

	</tr>';
	
	}
		   
		   
		   


//echo '<td class="bgd"><b></b></td>';
 ?>                 </tbody>
            </table>
          
         </div>   
<hr noshade="noshade" class="hr-5 float-left">
  
