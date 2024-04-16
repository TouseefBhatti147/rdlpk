<?php
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
<h3>Against Land Plots Detail</h3>

</section>
</div>
<div class="clearfix"></div>
  <div class="">
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="3%"> Sr No.</th>
                        <th width="6%">Project</th>
                        <th width="4%">Plot Size</th>
                        <th width="4%">Plot No</th>
                        <th width="4%">Street</th>
                        <th width="3%">Sector</th>
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
where size2='".$_GET['size']."' AND com_res='".$com_res."' and plots.project_id='".$_GET['project_id']."' and  `ctag` LIKE '%Against Land%' and plots.status='' and plots.type !='file'";
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
                <td><?php echo $unsold['project_name'];?></td>
                <td><?php echo $unsold['size'];?></td>
                <td><?php echo $unsold['plot_detail_address'];?></td>
                <td><?php echo $unsold['street'];?></td>
                <td><?php echo $unsold['sector_name'];?></td>
				<td><?php if(!empty($rescat['corner']) && ($rescat['corner']=='Corner')){ echo'<img src="/images/tickmark.png" />';}else {echo'';}?></td>
			        	<td><?php if(!empty($rescat['fp']) && ($rescat['fp']=='Facing Park')){ echo'<img src="/images/tickmark.png" />';}else {echo'';}?></td>
                <td><?php if(!empty($rescat['blvd']) && ($rescat['fp']=='Boulevard')){ echo'<img src="/images/tickmark.png" />';}else {echo'';}?></td>
		        		<td><?php if(!empty($rescat['80feet']) && ($rescat['80feet']=='Boulevard (80 Feet)')){ echo'<img src="/images/tickmark.png" />';}else {echo'';}?></td>
	        			<td><?php if(!empty($rescat['60feet']) && ($rescat['60feet']=='Road (60 Feet)')){ echo'<img src="/images/tickmark.png" />';}else {echo'';}?></td>
                 <td><?php if(empty($rescat['corner'])&&empty($rescat['fp'])&&empty($rescat['blvd'])&&empty($rescat['80feet'])&&empty($rescat['60feet']))
{
	echo 'Normal';
}?></td>


                </tr>
                <?php }?>
                <tr><td><form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
					<input type="hidden" name="paper" value="a4">
					<input type="hidden" name="orientation" value="landscape">
				
	<textarea name="html1" style="display:none;" cols="80" rows="20">
	      <style>
	    thead {display: table-header-group;}

	    .page_break {
                     page-break-before: always;
                    }
</style>
<meta charset="utf-8">
<title></title>
  	<table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
    <tr>
      <td style="padding:0px 0px 0px 0px; ">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php echo '<img style="height:40px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/logo1.png"/>'; ?>
                  </td>
                  <td colspan="10" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">Against Land Plots</span></td>
                  <td width="80" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="10" style="border-bottom:1px solid; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/</span></td>
                    </tr>
                    <tr>
                      <td height="10" style="border-bottom:1px solid; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                    </tr>
                  </table></td>
                </tr></table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                	<thead>
                <tr>
 <td height="20" colspan="11" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php echo $unsold['project_name'];  ?>
                  </strong></span></td>
                </tr>
                <tr>
                  <td height="20"  class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Sr No.
                </td>
                 
                 <td height="20"  class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
					Plot Size                </td>
                 <td  height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Plot No
                </td>
                <td height="20"  class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
              Street
                </td>
                <td height="20"  class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Sector
                </td>
               
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           Corner
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           Facing Park	
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           Main Blvd	
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           80' Road		
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
           60' Road		
                </td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
Normal                </td>
                </tr></thead>
                	 <?php
                	 
                	 $connection = Yii::app()->db;
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
where size2='".$_GET['size']."' AND com_res='".$com_res."' and plots.project_id='".$_GET['project_id']."' and  `ctag` LIKE '%Against Land%' and plots.status='' and plots.type !='file'";
	 			 $openres = $connection->createCommand($opensql)->queryAll();
			         $i=0;
                	 foreach($openres as $unsold){
                	     	$sqlcat="SELECT categories.id,
(SELECT NAME FROM categories LEFT JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 6 and cat_plot.plot_id='".$unsold['id']."') AS corner,
(SELECT NAME FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 7 and cat_plot.plot_id='".$unsold['id']."') AS fp,
(SELECT NAME FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 8 and cat_plot.plot_id='".$unsold['id']."') AS blvd,
(SELECT NAME FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 9 and cat_plot.plot_id='".$unsold['id']."') AS 80feet,
(SELECT NAME FROM categories inner JOIN cat_plot ON cat_plot.cat_id = categories.id WHERE cat_id = 10 and cat_plot.plot_id='".$unsold['id']."') AS 60feet
from categories
inner JOIN cat_plot ON cat_plot.cat_id=categories.id
 where cat_plot.plot_id='".$unsold['id']."'";
	$rescat = $connection->createCommand($sqlcat)->queryRow();
					 $i++;?>
                <tr>
                 <td style="padding-left:2px; text-align:left; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $i;?></td>
               
                <td style="padding-left:2px; text-align:left; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['size'];?></td>
                <td style="padding-left:2px; text-align:left; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['plot_detail_address'];?></td>
                <td style="padding-left:2px; text-align:left; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['street'];?></td>
                <td style="padding-left:2px; text-align:left; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['sector_name'];?></td>
                <td style="padding-left:2px; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if(!empty($rescat['corner']) && ($rescat['corner']=='Corner')){ echo'<img style="height:15px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/tickmark.png"/>';}else {echo'';}?></td>
				<td style="padding-left:2px; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if(!empty($rescat['fp']) && ($rescat['fp']=='Facing Park')){ echo'<img style="height:15px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/tickmark.png"/>';}else {echo'';}?></td>
                <td style="padding-left:2px; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if(!empty($rescat['blvd']) && ($rescat['blvd']=='Boulevard')){ echo'<img style="height:15px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/tickmark.png"/>';}else {echo'';}?></td>
				<td style="padding-left:2px; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if(!empty($rescat['80feet']) && ($rescat['80feet']=='Boulevard (80 Feet)')){ echo'<img style="height:15px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/tickmark.png"/>';}else {echo'';}?></td>
				<td style="padding-left:2px; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if(!empty($rescat['60feet']) && ($rescat['60feet']=='Road (60 Feet)')){ echo'<img style="height:15px;"  src="' . Yii::getPathOfAlias('webroot') . '/images/tickmark.png"/>';}else {echo'';}?></td>
                 <td style="padding-left:2px; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if(empty($rescat['corner'])&&empty($rescat['fp'])&&empty($rescat['blvd'])&&empty($rescat['80feet'])&&empty($rescat['60feet']))
                    {
                    	echo 'Normal';
                    }
                     if($i % 40 == 0)
             echo'<div style="page-break-before: always;"></div>';
        
                    }?></td></tr>

         </table></td>
          </tr>

  </table>
</textarea>
					<div style="text-align: left; margin-top: 1em;">
						<button type="submit">Print Report</button>
					</div>
				</form></td></tr>
                </tbody>



            </table>
  </div>

<hr noshade="noshade" class="hr-5 float-left">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



