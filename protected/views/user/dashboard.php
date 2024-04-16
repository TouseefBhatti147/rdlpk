<style>

.row-fluid [class*="span"]{ margin-left:0px; margin:2px;}

.main-icons{ margin:0px; height:118px;}

.main-icons p{ font-size:12px; line-height:1px;}





</style>

<div class="span8">

<div role="tabpanel">
 <!--BCD Management Start: -->


<?php
 $uid=Yii::app()->session['user_array']['id'];
if($uid==1 ||$uid==68 ||$uid==85)
			{?>

  <h5>Overall Plots Reports</a></h5>
   <hr noshade="noshade">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="span12" id="demo">

<?php if($uid==1 ||$uid==68)
			{?>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/plots/unsold_residential"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/unsold.jpg">
<br />Unsold Plots</a>
</span>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/plots/plots_allocation_summary"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/allocattion-icon.png">
<br />Plots Allocation </a>
</span>


<?php }?>

<?php
	if((Yii::app()->session['user_array']['id']=='1')&& isset(Yii::app()->session['user_array']['username'])||(Yii::app()->session['user_array']['id']=='68'))
if($uid==1 ||$uid==68)
			{?>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/finance/financial_reports"  ><img style="width:50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/money.png">
<br />Live Receipts</a>
</span><?php }
if($uid==1 ||$uid==85 ||$uid==68){ 
?>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/plots/percentage_payment"  ><img style="width:50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/money.png">
<br />Percentage Wise  (Received Payment)</a>
</span>
<?php }?>
</div>
</div>

<?php }?>
<br /><br />
  <h5>Royal Orchard Building Control Management</a></h5>
   <hr noshade="noshade">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="span12" id="demo">

<?php if(Yii::app()->session['user_array']['per_bcd_mgm']=='1' )
			{?>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/bcd/possesion_req"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon4.png">
<br />Create Possession Request</a>
</span>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/bcd/possession_list"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bcd-possession.png">
<br />Possession List</a>
</span>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/bcd/bcd_reports"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bcd-reports-icon.png">
<br />Reports</a>
</span>
<?php }?>
</div></div>
  <!-- BCD Management End -->


<br />
  <h5>Mortgaged Plots</a></h5>
   <hr noshade="noshade">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="span12" id="demo">

<?php //if(Yii::app()->session['user_array']['per_bcd_mgm']=='1' )
		//	{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/memberplot/mortgaged_list"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bcd-possession.png">
<br />Mortgaged List</a>
</span>

<?php //}?>
</div></div>
  <!-- BCD Management End -->

 





 

  <h5>Forms Management</a></h5>

   <hr noshade="noshade">

    <div role="tabpanel" class="tab-pane active" id="home"><div class="span12" id="demo">

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per16']=='1')

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/forms_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/listf.png"><br />Forms List</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' )

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/selectpr"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon4.png"><br />Add New Form</a>



</span><span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/schema_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon5.png"><br />Schema</a></span>



<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/formpayment_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon7.png"><br />Charges Management</a></span>



<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/allot"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/distribution.png"><br />Distributor forms Allocation </a></span>

<?php }?>













<?php if(Yii::app()->session['user_array']['per13']=='1' )

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/authorize" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ch2.png"><br />User form Allocation</a></span>



<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/finance"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/financem.png"><br />Finance form Allocation</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per14']=='1')

			{?>

<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/mainreport"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon1.png"><br />Reporting</a></span>

<?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per15']=='1')

			{?>

<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/financedb"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/adminfa.png"><br />Finance Administration</a></span>

<?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' )

			{?>

            <span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/seller/seller_lis" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ch2.png"><br />Manage Distributor</a></span>

<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/seller/sdealer_lis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/subd.png"><br />Sub Dealers</a></span>

<?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per15']=='1' or Yii::app()->session['user_array']['per14']=='1' or Yii::app()->session['user_array']['per16']=='1')

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/formssearch"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon6.png"><br />Search Forms</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']!=='1' and Yii::app()->session['user_array']['per17']=='1')

			{?>

<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/editorlis"  ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon6.png"><br />Search Forms</a></span><?php }?>

<?php if(Yii::app()->session['user_array']['per13']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('forms/addbal')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw.png" />

<h6>Form Balloting </h6>

</a>

</div>

<?php } ?>

</div>

  <!-- Tab panes -->



   <h5>Add New</h5>

 <hr noshade="noshade">

    <div role="tabpanel" class="tab-pane active" id="home"><div class="span12" id="demo">

<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('streets/streets_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Streets</h6>



</a>

</div>

<?php } ?>
<?php if(Yii::app()->session['user_array']['per1']=='1'){ ?>
<div class="span2 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('setting/msno_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/auto-icon.png" />
<h6>MS Generation</h6>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>

<div class="span2 main-icons">
<?php 
$connection=yii::app()->db;
$sql_pro  = "SELECT count(*) as id FROM projects where status='1' ";
			$repro = $connection->createCommand($sql_pro)->queryRow();
		?>
<a href="<?php echo $this->createAbsoluteUrl('projects/project_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_projects.png" />

<h6>Projects</h6>



</a>
<span style="color:#093; font-weight:bold";>(<?php echo $repro['id'];?>)</span>
</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('uprojects/uproject_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/coming_soon_icon.png" />

<h6>Upcoming Projects</h6>



</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('banks/bank_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/charges-icon4.png" />

<h6>Banks</h6>



</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('memberplot/broadcast')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/broadcast.jpg" />

<h6>Broadcast</h6>



</a>

</div>

<?php } ?>



<?php if(Yii::app()->session['user_array']['per3']=='1'){

	echo '<div class="span2 main-icons" style="padding:5px 25px;"><img src="'. Yii::app()->request->baseUrl.'/images/category-icon.png" />

<h6 style=" text-align:center;"><a href="'.$this->createAbsoluteUrl("category/category_list").'">Categories List</h6></a></div>'; }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){

	echo '<div class="span2 main-icons" style="padding:5px 25px;"><img src="'. Yii::app()->request->baseUrl.'/images/charges-icon.png"" />

<h6 style=" text-align:center;"><a href="'.$this->createAbsoluteUrl("charges/charges_list").'">Charges List</h6></a></div>'; }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){?>

<div class="span2 main-icons" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('size/size_list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/landsize.png" />

<h6 style=" text-align:center;">Plot Size Categories</h6></a></div> 

<?php }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){?>

<div class="span2 main-icons" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('installmentplan/list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/i-scheduled-payment.png" />

<h6 style=" text-align:center;">Installment Plan</h6></a></div> 

<?php }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>

<div class="span2 main-icons" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('projects/sector')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/i-scheduled-payment.png" />

<h6>Sectors</h6>

</a></div> 

<?php }?>

<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>

<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('ptype/ptype_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Property Type</h6>



</a>

</div>

<?php } ?>
<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>
<div class="span2 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('reciept/target_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/target-icon.png" />
<h6>Monthly Target</h6>

</a>
</div>
<?php } ?>
</div></div>



 <h5>Media & website</a></h5>

    <hr noshade="noshade" >

    <div role="tabpanel" class="tab-pane" id="profile"><div class="span12">

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('user/virtual_tour_video_gallery')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/magnifier.png" />

<h6>Virtual Tour</h6>



</a>

</div>



<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('pages/splashscreen')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/hoarding.png" />

<h6>Splash Screen</h6>



</a>

</div>



<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateAbsoluteUrl('slider/slider_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/s1.png" />

<h6>Slider</h6>



</a>

</div>



<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('centers/centers_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/office_building.png" />

<h6>Sales Center</h6>

<p></p>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/filemanager/index.php">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/File-Manager-Icon.png" />

<h6>File Manager</h6>

</a></div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('news/news_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news-icon.png" />

<h6>News</h6>



</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per1']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('setting/setting_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/toolbars-icon.png" />

<h6>Setting</h6>



</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per4']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateAbsoluteUrl('pages/pages_list');?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-05.png" />

<h6>Pages</h6>



</a>

</div>

<?php } ?>



<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('gallery/gallery_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery-icon.png" />

<h6>Image Gallery</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('country/country_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/country.png" />

<h6>Manage Country</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('hordings/hordings_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/hoarding.png" />

<h6>Hoardings</h6>

</a>

</div> 

<?php } ?>

<?php if(Yii::app()->session['user_array']['per4']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('downloads/downloads_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/downloads.png" />

<h6>Downloads</h6>

</a>

</div> 

<?php } ?>

</div></div>

<h5>Users/members</a></h5>

    <hr noshade="noshade" >

    <div role="tabpanel" class="tab-pane" id="messages"><div class="span12">
<?php if(Yii::app()->session['user_array']['per2']=='1'){ ?>
<div class="span2 main-icons">
<a href="<?php echo $this->CreateABsoluteurl('member/landownerlist');?>">
<?php 
$connection=yii::app()->db;
$sql_mem  = "SELECT count(*) as id FROM tbl_landowner where status='1' ";
			$resmem = $connection->createCommand($sql_mem)->queryRow();
		?>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/landowner.png" />
<h6>Land Owner Directory</h6>
</a>
<span style="color:#093; font-weight:bold";>(<?php echo $resmem['id'];?>)</span>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per2']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateABsoluteurl('user/membershiprequest');?>">
<?php 
$connection=yii::app()->db;
$sql_mem  = "SELECT count(*) as id FROM members where status='1' ";
			$resmem = $connection->createCommand($sql_mem)->queryRow();
		?>

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/add-membership.png" />

<h6>Member's Directory</h6>
<span style="color:#093; font-weight:bold";>(<?php echo $resmem['id'];?>)</span>
</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per1']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('user/user_list')?>">

<?php 
$connection=yii::app()->db;
$sql_usr  = "SELECT  count(*) as id FROM user where status='1' ";
			$resusr = $connection->createCommand($sql_usr)->queryRow();
			?>

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-01.png" />

<h6>User</h6>

</a>
<span style="color:#093; font-weight:bold";>(<?php echo $resusr['id'];?>)</span>
</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per12']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('visitors/visitors_dashboard')?>">



<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-visitor.png" />

<h6>Daily Visitors Report</h6>

</a>

</div>

<?php } ?>

</div></div>

<h5>Security, Reporting, Balloting,Recovery </a></h5>

    <hr noshade="noshade" >

    <div role="tabpanel" class="tab-pane" id="settings"><div class="span12">

<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('allotments/ballotting1')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw.png" />

<h6>Balloting </h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per11']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('plots/reporting')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw1.png" />

<h6>Reporting</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per10']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('user/fpreader')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fingerprint.png" />

<h6>Security</h6>

</a>

</div>

<?php } ?>

<?php if(Yii::app()->session['user_array']['per9']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('finance/finance')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/finance.png" />

<h6>Finance System</h6>

</a>

</div>

<?php } ?>



<?php if(Yii::app()->session['user_array']['per31']=='1'){ ?>



<div class="span2 main-icons">

<a href="<?php echo $this->CreateAbsoluteUrl('recovery/recovery');?>">

<img style="height:50px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/recovery-icon.png" />

<h6>Recovery System</h6>



</a>

</div>



<?php } ?>

</div></div>

<?php if(Yii::app()->session['user_array']['per22']=='1' or Yii::app()->session['user_array']['per23']=='1'){?>

<h5>Land and Socity Map Managment</a></h5>

<hr noshade="noshade" >

<div role="tabpanel" class="tab-pane" id="settings"><div class="span12">

<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/gis/Townp.php?id=1">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mapp.png" />

<h6>View Map</h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/gis/developer.php?id=1">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mapde.png" />

<h6>Developer View </h6>

</a>

</div>

<div class="span2 main-icons">

<a href="<?php echo Yii::app()->request->baseUrl; ?>/gis/images/index.php?id=1">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/map.png" />

<h6>Create Map</h6>

</a>

</div>



</div></div>

<?php }?>



<?php if(Yii::app()->session['user_array']['per1']=='1' )

			{?>
<h5>Property</a></h5>
<hr noshade="noshade" >
<div role="tabpanel" class="tab-pane" id="settings">
<div class="span12">
<div class="span2 main-icons"> <a href="<?php echo $this->createAbsoluteUrl('property/buildings_list')?>"> <img width="50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/building-icon.png" />
<h6>Buildings</h6>
</a> </div>
<div class="span2 main-icons"> <a href="<?php echo $this->createAbsoluteUrl('property/floors_list')?>"> <img width="50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/floor-icon.png" />
<h6>Floors</h6>
</a> </div>
<div class="span2 main-icons"> <a href="<?php echo $this->createAbsoluteUrl('property/assignproperty')?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/property.png" />
<h6>Assign Property</h6>
</a> </div>
<?php if(Yii::app()->session['user_array']['per3']=='1'){

	echo '<div class="span2 main-icons" style="padding:5px 25px;"><img src="'. Yii::app()->request->baseUrl.'/images/charges-icon.png"" />

<h6 style=" text-align:center;"><a href="'.$this->createAbsoluteUrl("charges/charges_list").'">Charges List</h6></a></div>'; }?>
<?php if(Yii::app()->session['user_array']['per3']=='1'){?>
<div class="span2 main-icons" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('size/size_list_property')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/landsize.png" />
<h6 style=" text-align:center;">Property Size Categories</h6>
</a></div>
<?php }?>

<!--<div class="span2 main-icons">

<a href="<?php echo $this->createAbsoluteUrl('property/addnew')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />

<h6>Add New Property</h6>

</a>

</div>-->



<div class="span2 main-icons"> <a href="<?php echo $this->createAbsoluteUrl('property/insplanlist')?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />
<h6>Instalment Plan</h6>
</a> </div>
<div class="span2 main-icons"> <a href="<?php echo $this->createAbsoluteUrl('property/adminrequest')?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />
<h6>Admin Request</h6>
</a> </div>
<div class="span2 main-icons"> <a href="<?php echo $this->createAbsoluteUrl('property/financerequest')?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />
<h6>Finance Request</h6>
</a> </div>
</div>
</div>
<?php } ?>





</div>

</div>

</div>





<div class="span4">





<div role="tabpanel" style="background:#E6FFF1;">



  <!-- Nav tabs -->

  <ul class="nav nav-tabs" role="tablist">

    <li role="presentation" class="active"><a href="#home1" aria-controls="home1" role="tab" data-toggle="tab">Notifications</a></li>

    

    

  </ul>



  <!-- Tab panes -->

  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="home1">

<?php if(Yii::app()->session['user_array']['per33']=='1'){
            $connection = Yii::app()->db;
            $sql_cplot  = "SELECT count(*) as id  from reprint_requests 
			where status='0'";
            $result_cplot = $connection->createCommand($sql_cplot)->queryRow();
           ?>
<div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/reprint_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $result_cplot['id']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/reprint-icon.png" />
<h6 style=" text-align:center;">Reprint Docs Request </h6>
</a></div>
<?php }?>

			<?php if(Yii::app()->session['user_array']['per6']=='1'){

            $connection = Yii::app()->db;

            $sql_plot  = "SELECT mp.member_id,mp.id,mp.create_date,p.type,p.status, m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp

            left join members m on mp.member_id=m.id

            left join plots p on mp.plot_id=p.id

            left join streets s on p.street_id=s.id

            left join projects j on s.project_id=j.id where p.type='plot' and mp.status='new' and mp.fstatus='Approved'   ";

            $result_plot = $connection->createCommand($sql_plot)->query();

            

            $count=0;

            $res=array();

            foreach($result_plot as $key){

            $count++;

            

            } ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/request-icon.png" />

            <h6 style=" text-align:center;">Allot a Plot Request </h6></a></div> <?php }?>

            <?php if(Yii::app()->session['user_array']['per6']=='1'){

            $connection = Yii::app()->db;

            $sql_plot  = "SELECT count(mp.member_id) as count FROM memberplot mp

            left join members m on mp.member_id=m.id

            left join plots p on mp.plot_id=p.id

            left join streets s on p.street_id=s.id

            left join projects j on s.project_id=j.id where p.type='file' and mp.status='new' and mp.fstatus='Approved' ";

            $result_plot = $connection->createCommand($sql_plot)->queryRow();

            
 ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberfile/memberfile_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $result_plot['count']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/plotrequest.jpg" />

            <h6 style=" text-align:center;">Allot a File Request </h6></a></div> <?php }?>
	<?php if(Yii::app()->session['user_array']['per33']=='1'){
            $connection = Yii::app()->db;
            $sql_cplot  = "SELECT cp.fstatus,cp.status,count(mp.member_id) as count from memberplot mp
			Left JOIN members m ON m.id=mp.member_id		
			Left JOIN plots p ON p.id=mp.plot_id			
			
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where cp.status='approved' and cp.fstatus='Approved'";
            $result_cplot = $connection->createCommand($sql_cplot)->queryRow();
            ?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/cancellation_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $result_cplot['count']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cancel-icon.png" />

            <h6 style=" text-align:center;">Cancel a Plot Request </h6></a></div> <?php }?>
            <?php if(Yii::app()->session['user_array']['per6']=='1'){

$connection = Yii::app()->db;

$sql_plot  = "SELECT count(mp.member_id) as propertycount  FROM property mp

left join members m on mp.member_id=m.id

left join plots p on mp.plot_id=p.id

left join streets s on p.street_id=s.id

left join projects j on s.project_id=j.id where mp.status='New' and mp.fstatus='Approved'   ";

$result_plot = $connection->createCommand($sql_plot)->queryRow();

 ?>



<div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/prop_alotment_lis')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $result_plot['propertycount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/request-icon.png" />

<h6 style=" text-align:center;">Allot a Property Request </h6></a></div> <?php }?>

   

		<?php if(Yii::app()->session['user_array']['per6']=='1'){

$connection = Yii::app()->db;

$sqlmember  = "SELECT  count(*) as tpcount from transferplot where RFM='RFM' ";

$resulrmem = $connection->createCommand($sqlmember)->queryRow();





 ?>


	<?php if(Yii::app()->session['user_array']['per1']=='1'){?>
<div class="span3" style="padding:12px 20px;"><a href="<?php echo $this->createAbsoluteUrl('member/RFM')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $resulrmem['tpcount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/member-request.png" />

<h6 style=" text-align:center;">Member Transfer Request</h6></a></div> 


<?php }}?>

	

			<?php if(Yii::app()->session['user_array']['per8']=='1'){

            $connection = Yii::app()->db;

            $sql_projects  = "SELECT count(*) as querycount from query where replied=0 or replied='' ";

            $querycount = $connection->createCommand($sql_projects)->queryRow();

            

            ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/register_member_query')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $querycount['querycount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/E-mail-icon.png" />

            <h6 style=" text-align:center;">Member Message</h6></a></div> <?php }?>
			  <?php if(Yii::app()->session['user_array']['per8']=='1'){
            $connection = Yii::app()->db;
            $sql_projects  = "SELECT count(*) as fpcount from forgot_password_requests where status=0 and replied=0 or replied='' ";
            $fpcount = $connection->createCommand($sql_projects)->queryRow();
            
            ?>
            
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/forgot_password_requests')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $fpcount['fpcount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/forgot_password.png" />
            <h6 style=" text-align:center;">Forgot Password Request</h6></a></div> <?php }?>
              <?php if(Yii::app()->session['user_array']['per8']=='1'){
            $connection = Yii::app()->db;
            $sql_projects  = "SELECT  count(*) as uacount  from ua_activate_requests where status=0 and replied=0 or replied='' ";
            $uacount = $connection->createCommand($sql_projects)->queryRow();
            
          ?>
                  <?php if(Yii::app()->session['user_array']['per2']=='1'){?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/posspay_list')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php // echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/possession-icon.png" />
            <h6 style=" text-align:center;">Possession Payment</h6></a></div> <?php }?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/ua_activate_requests')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $uacount['uacount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/account-activate.png" />
            <h6 style=" text-align:center;">Account Activation Request</h6></a></div> <?php }?>
            <?php if(Yii::app()->session['user_array']['per8']=='1'){

            $connection = Yii::app()->db;

            $sql_projects  = "SELECT count(*) as uquerycount from unregister_user_query where status=0 and replied=0 or replied='' ";

            $uquerycount = $connection->createCommand($sql_projects)->queryRow();

         ?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/visitor_query')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $uquerycount['uquerycount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/dialog_question.png" />

            <h6 style=" text-align:center;">Visitor's Message</h6></a></div> <?php }?>

            <?php if(Yii::app()->session['user_array']['per8']=='1'){

            $connection = Yii::app()->db;

            $sql_projects  = "SELECT count(*) as mtmcount from mailto_member ";

            $mtmcount = $connection->createCommand($sql_projects)->queryRow();?>

            

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/maillist')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $mtmcount['mtmcount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/email-icon.jpg" />

            <h6 style=" text-align:center;">Email To Member</h6></a></div> <?php }?>

                       <?php if(Yii::app()->session['user_array']['per8']=='1'){?>

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/subcriber_list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/subcriber.gif" />

            <h6 style=" text-align:center;">Subscriber List</h6></a></div><?php }?>
<?php if(Yii::app()->session['user_array']['per12']=='1'){
            $connection = Yii::app()->db;
            $sql_booking  = "SELECT count(*) as publicplotcount FROM `plots` WHERE `public`=2";
            $publicplotcount = $connection->createCommand($sql_booking)->queryRow();
            ?>
<div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('web/booking_list')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $publicplotcount['publicplotcount']; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/plot_booking.png" />
<h6 style=" text-align:center;">Plot Booking</h6>
</a></div>
<?php }?>
<div class="span12">
   <?php if(Yii::app()->session['user_array']['per33']=='1'){ ?>
            <?php  $sql_noc = "SELECT count(*) as noccount from memberplot mp
			Left JOIN members m ON m.id=mp.member_id
			
			Left JOIN plots p ON p.id=mp.plot_id
			
			Left JOIN streets s ON s.id=p.street_id
			Left JOIN size_cat siz  ON p.size2 = siz.id
			Left JOIN sectors sec  ON p.sector = sec.id
			Left JOIN projects pro ON pro.id=p.project_id 
			Left JOIN cancelplot cp ON cp.plot_id=p.id
			where cp.status='New'"; 
	
		$result_noc = $connection->createCommand($sql_noc)->queryRow();
		?>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/cancellation_lis')?>" >

           <span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;">

            <?php  echo $result_noc['noccount'];?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cancel.png" />

            <h6 style=" text-align:center;">Cancellation</h6></a></div>
            <?php }?>
            
            
           

            <?php 

			$connection = Yii::app()->db; 

      $temp_projects_array = Yii::app()->session['projects_array'];

		$num_of_projects_counter = count($temp_projects_array);	

		$num_of_projects_counter2 = $num_of_projects_counter;

		$sql1 =   "select * from projects where";

		$num_of_projects_counter--;

		while($num_of_projects_counter>-1)

		{

			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];

			$num_of_projects_counter--;

		}

		

		$sql_project = $sql1;

		$sql_project = $sql_project.implode(' or',$sql2);

		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

$prooo='';$pos=0;

foreach($result_projects as $pro){

if($pos==0){$prooo .=$pro['id'];}else{

$prooo .=','.$pro['id'];}

$pos=$pos+1;

}

			

			$sql_transfer  = "SELECT * from transferplot

			left join plots on(plots.id=transferplot.plot_id)

			 where transferplot.status='sales' and plots.project_id in (".$prooo.") ";

            $result_transfer = $connection->createCommand($sql_transfer)->query();

			

			$sql_allotment  = "SELECT * from memberplot 			

			left join plots on(plots.id=memberplot.plot_id)

			 where memberplot.status='sales' and plots.project_id in (".$prooo.") ";

            $result_allotment = $connection->createCommand($sql_allotment)->query();

			

			if(Yii::app()->session['user_array']['per20']=='1'){ ?>

            <h5>Request from Sale Center</h5>

            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplotsales/transfer_lis')?>" >

            <span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;">

            <?php echo count($result_transfer);?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/transferIcon.png
" />

            <h6 style=" text-align:center;">Transfer</h6></a></div>

			<div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplotsales/allotments_lis')?>" >

                        <span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;">

            <?php echo count($result_allotment);?></span>

                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/subcriber.gif" />

            <h6 style=" text-align:center;">Allotments</h6></a></div>
            <div class="span3" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplotsales/allotmentsprop_lis')?>" > <span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;">
<?php 
			$sqlsales="SELECT count(*) as propertycount FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join size_cat size_cat on size_cat.id=p.size2
left join projects j on p.project_id=j.id
Left JOIN floors  ON (p.floor_id = floors.id)
Left JOIN buildings  ON (floors.building_id = buildings.id)
where mp.fstatus='Sales' and p.is_property='1'";
		 $result_sales = $connection->createCommand($sqlsales)->queryRow();	
			 echo ($result_sales['propertycount']);?>
</span> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/property-allot-icon.png" />
<h6 style=" text-align:center;">Property Allotments</h6>
</a></div>

			

			<?php }?>
            
            
            
            
            
            
            </div>

	</div>	

</div>



   

  </div>



</div>

</div>

<hr noshade="noshade" class="hr-5 float-left">



<!-- section 3 -->