<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
<h3>HRL Reserved Plots Detail</h3>
</section>
</div>
<div class="clearfix"></div>
  <div class="">
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>					
                        <th width="3%"> Sr No.</th>
                        <th width="6%"> Membership #</th>
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
where size2='".$_GET['size']."' AND com_res='".$com_res."' and plots.project_id='".$_GET['project_id']."' and plots.ctag='HRL Reserved' and plots.status='' and plots.type='Plot' order by sectors.sectors_sorting ASC,streets.streets_sorting, plots.plot_detail_address";
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
                <td><?php echo $unsold['size'];?></td>
                <td><?php echo $unsold['plot_detail_address'];?></td>
                <td><?php echo $unsold['street'];?></td>
                <td><?php echo $unsold['sector_name'];?></td>
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
            <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="landscape">
</p>
<textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../views/recovery/report.css">
<style>
.table-bordered{ border:1px solid #000; border-bottom:1px solid #000;}
table{ border:0px solid;}

</style>

  	<table  width="100%" border="0" cellspacing="0px" cellpadding="0px">
    <tr>
      <td style="padding:0 0 0 0;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid">
                  <?php   echo'<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo1.png"/>';?>
                  </td>
                  <td colspan="10" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:14px;  font-weight:bold"><span class="style6">HRL Reserved Plots</span></td>
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
                <!----error start--->
                  <td height="20"  colspan="12" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin;  font-size:12px; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:&nbsp;  <strong style="font-size:13px;"><?php //  echo $result_project['project_name'];  ?></strong></span></td>
                </tr>
                <tr>
                  <td height="20" width="2%"   valign="middle" class="BoledText" style="color:#FFF; background-color:#666;text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Sr No.
                </td><!----error start--->
                 <td height="20"  class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
             Membership #	
                </td>
                 <td height="20"  class="style6"  valign="middle" class="BoledText" style=" color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Plot Size	
                </td>
                 <td  height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Plot No	
                </td>
                <td height="20"  class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
Street	
                </td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="color:#FFF; background-color:#666; text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;">
               Sector
                </td>
               <!--error end-->
               
               
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
        Normal	
                </td>
                 
                </tr>
                
                
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
                 $opensql1  = "SELECT
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
where size2='".$_GET['size']."' AND com_res='".$com_res."' and plots.project_id='".$_GET['project_id']."' and plots.ctag='HRL Reserved' and plots.status=''";
	 			 $openres1 = $connection->createCommand($opensql1)->query();
				 foreach($openres1 as $unsold){
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
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $i;?></td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['plotno'];?></td>
               
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['size'];?></td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['plot_detail_address'];?></td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['street'];?></td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php echo $unsold['sector_name'];?></td>
               <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if($rescat['corner']=='Corner'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else {echo'';}?></td>
               <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if($rescat['fp']=='Facing Park'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else {echo'';}?></td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if($rescat['blvd']=='Boulevard'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else {echo'';} ?></td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if($rescat['80feet']=='Boulevard (80 Feet)'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php }else { echo'';}?></td>
                <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if($rescat['60feet']=='Road (60 Feet)'){?><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/tickmark.png";?>"> <?php } else {echo'';}?></td>
                 <td height="20" class="style6"  valign="middle" class="BoledText" style="text-align:center; border-left:thin; border-left-style:solid; border-top:1px solid ; border-top-style:solid; border-right:1px solid; border-right-style:solid;border-bottom:1px solid; border-bottom-style:solid; font-size:12px;"><?php if(empty($rescat['corner'])&&empty($rescat['fp'])&&empty($rescat['blvd'])&&empty($rescat['80feet'])&&empty($rescat['60feet']))
{
	echo 'Normal';
}?></td>
                
                
                </tr>
                <?php 
	
	//$gtotal=($topen)-($thrlreserved)-($tagainstland)-($tvillas);

}?>

    
   
  </table>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Print Report</button>
</div>
</form>
  </div>

<hr noshade="noshade" class="hr-5 float-left">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

 

 