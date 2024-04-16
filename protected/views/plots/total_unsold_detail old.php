<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
<h3>Total Unsold Plots Detail</h3>

</section>
</div>
<div class="clearfix"></div>
  <div class="">
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>					
                        <th width="3%"> Sr No.</th>
                        <th width="6%"> Membership #</th>
                        <th width="6%">Project</th> <th width="3%">Sector</th> <th width="4%">Street</th>
                        <th width="4%">Plot Size</th>
                        <th width="4%">Plot No</th>
                       
                       
                        <th width="3%">Corner</th>
                         <th width="4%">Facing Park</th>
                         <th width="3%">Main Blvd</th>
                         <th width="3%">80' Road</th>
                         <th width="3%">60' Road</th>
                          <th width="3%">Normal</th>                                             
         				
                     </tr>
                </thead>
                <tbody id="error-div">
                <?php
				
				$connection = Yii::app()->db;
				$i=0;
				$com_res='';
				$_GET['com_res'];
				if($_GET['com_res']=='R')
				{
				$com_res="Residential";	
				}
				if($_GET['com_res']=='C')
				{
				$com_res="Commercial";	
				}
                 $opensql  = "SELECT
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
								, plots.ctag
								, memberplot.fstatus
								, plots.bstatus
								, plots.plot_detail_address
								, memberplot.plotno
								, projects.project_name
								, streets.street
								,streets.streets_sorting
								, size_cat.size
								, size_cat.typee
								,sector_name
								FROM
								plots
								Left JOIN streets  ON (plots.street_id = streets.id)
								Left JOIN projects  ON (plots.project_id = projects.id)
								Left JOIN sectors  ON (plots.sector = sectors.id)
								Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
								Left JOIN size_cat  ON (size_cat.id = plots.size2)
where size2='".$_GET['size']."' AND com_res='".$com_res."' and plots.project_id='".$_GET['project_id']."' and plots.status='' and type='Plot' 
order by sectors.sectors_sorting ASC,streets.streets_sorting, plots.plot_detail_address ASC";
	 			 $openres = $connection->createCommand($opensql)->query();
				 foreach($openres as $unsold){
					 $i++;
					$sqlcat="SELECT categories.id,(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 6 and cat_plot.plot_id='".$unsold['id']."'
) AS corner,(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 7 and cat_plot.plot_id='".$unsold['id']."') AS fp,
(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 8 and cat_plot.plot_id='".$unsold['id']."') AS blvd,
(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 9 and cat_plot.plot_id='".$unsold['id']."') AS 80feet,
(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 10 and cat_plot.plot_id='".$unsold['id']."') AS 60feet
from categories
LEFT JOIN cat_plot ON cat_plot.cat_id=categories.id
 where cat_plot.plot_id='".$unsold['id']."'";
	$rescat = $connection->createCommand($sqlcat)->queryRow();
				?>
                <tr>
                  <td><?php echo $i;?></td>
                <td><?php echo $unsold['plotno'];?></td>
                <td><?php echo $unsold['project_name'];?></td>
                <td><?php echo $unsold['sector_name'];?></td>
                  <td><?php echo $unsold['street'];?></td>
                <td><?php echo $unsold['size'];?></td>
                <td><?php echo $unsold['plot_detail_address'];?></td>
              
                <td><?php if($rescat['corner']=='Corner'){ echo'<img src="/images/tickmark.png" />';}else {echo'';}?></td>
                <td><?php if($rescat['fp']=='Facing Park'){ echo '<img src="/images/tickmark.png" />';}else {echo'';}?></td>
                <td><?php if($rescat['blvd']=='Boulevard'){ echo '<img src="/images/tickmark.png" />';}else {echo'';} ?></td>
                <td><?php if($rescat['80feet']=='Boulevard (80 Feet)'){ echo '<img src="/images/tickmark.png" />';}else { echo'';}?></td>
                 <td><?php if($rescat['60feet']=='Road (60 Feet)'){ echo '<img src="/images/tickmark.png" />';}else {echo'';}?></td>
                 <td><?php if(empty($rescat['corner'])&&empty($rescat['fp'])&&empty($rescat['blvd'])&&empty($rescat['80feet'])&&empty($rescat['60feet']))
{
	echo 'Normal';
}?></td>
                
                
                </tr>
                <?php }?>
                </tbody>



            </table>
  </div>

<hr noshade="noshade" class="hr-5 float-left">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

 

 