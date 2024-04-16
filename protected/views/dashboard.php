<div class="span8">
<?php if(Yii::app()->session['user_array']['per1']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('user/user_list')?>">

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-01.png" />
<h4>User</h4>
<p>Add / Remove / Edit Users</p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per3']=='1'){ ?>
<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('streets/streets_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.jpg" />
<h4>Streets</h4>
<p>Veiw / Edit Streets</p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>
<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('projects/project_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_projects.png" />
<h4>Projects</h4>
<p>Veiw / Edit Projects</p>
</a>
</div>
<?php } ?>

<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>
<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('uprojects/uproject_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/coming_soon_icon.jpg" />
<h4>Upcoming Projects</h4>
<p>Veiw / Edit Projects</p>
</a>
</div>
<?php } ?>


<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('user/virtual_tour_video_gallery')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/magnifier.png" />
<h4>Virtual Tour</h4>
<p>Veiw / Edit </p>
</a>
</div>

<?php } ?>
<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->CreateAbsoluteUrl('slider/slider_list');?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/s1.jpg" />
<h4>Slider</h4>
<p>Veiw / Edit </p>
</a>
</div>

<?php } ?>
<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->CreateABsoluteurl('centers/centers_list');?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/office_building.png" />
<h4>Sales Center</h4>
<p>Add Remove or Edit Content</p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/filemanager/index.php">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/File-Manager-Icon.png" />
<h4>File Manager</h4>
</a></div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->CreateABsoluteurl('news/news_list');?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news-icon.png" />
<h4>News</h4>
<p>Add Remove or Edit News</p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per1']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->CreateABsoluteurl('setting/setting_list');?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/toolbars-icon.png" />
<h4>Setting</h4>
<p>Add Remove or Edit Setting</p>
</a>
</div>
<?php } ?>

<?php if(Yii::app()->session['user_array']['per2']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->CreateABsoluteurl('user/membershiprequest');?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/add-membership.jpg" />
<h4>Member's Directory</h4>
<p>Add Remove or Edit</p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per4']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->CreateAbsoluteUrl('pages/pages_list');?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-05.png" />
<h4>Pages</h4>
<p>Add Remove or Edit Pages</p>
</a>
</div>
<?php } ?>


<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('gallery/gallery_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery-icon.png" />
<h4>Image Gallery</h4>
<p>Image Gallery/ Edit </p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per5']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('country/country_list')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/country.jpg" />
<h4>Manage Country</h4>
<p>Country/City </p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per7']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('allotments/ballotting')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw.png" />
<h4>Balloting </h4>
<p>Add Applicant/Generate Memberplot </p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per11']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('plots/reporting')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/draw1.png" />
<h4>Reporting</h4>
<p>Detail Of All Plots </p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per10']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('user/fpreader')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fingerprint.jpg" />
<h4>Security</h4>
<p>Fingerprint Verification</p>
</a>
</div>
<?php } ?>
<?php if(Yii::app()->session['user_array']['per9']=='1'){ ?>

<div class="span4 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('finance/finance')?>">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/finance.jpg" />
<h4>Finance System</h4>
<p>All About Finance</p>
</a>
</div>
<?php } ?>

<?php if(Yii::app()->session['user_array']['username']){ ?>

<div class="span4 main-icons">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/capture/demos/hd.html">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Image capture.png" />
<h4>Image Capture</h4>
<p>Capture Any Image </p>
</a>
</div> 
<?php } ?>
</div>


<div class="span4">

<div class="side-bar">

<div class="s-head">

<h3>Notifications</h3>

</div>

<div class="inner">
<div class="span12">
<?php if(Yii::app()->session['user_array']['per3']=='1')
 {
	echo '<div class="span4" style="padding:5px 25px;"><img src="'. Yii::app()->request->baseUrl.'/images/category-icon.png" />
<h6 style=" text-align:center;"><a href="'.$this->createAbsoluteUrl("category/category_list").'">Categories List</h6></a></div>'; }?>

<?php if(Yii::app()->session['user_array']['per3']=='1')
 {
	echo '<div class="span4" style="padding:5px 25px;"><img src="'. Yii::app()->request->baseUrl.'/images/charges-icon.png"" />
<h6 style=" text-align:center;"><a href="'.$this->createAbsoluteUrl("charges/charges_list").'">Charges List</h6></a></div>'; }?>


<?php if(Yii::app()->session['user_array']['per8']=='1'){
$connection = Yii::app()->db;
$sql_projects  = "SELECT * from query where status='0' ";
$result_projects = $connection->createCommand($sql_projects)->query();

$count=0;
$res=array();
foreach($result_projects as $key){
$count++;

} ?>

<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/register_member_query')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/E-mail-icon.png" />
<h6 style=" text-align:center;">Member Message</h6></a></div> <?php }?>
<?php if(Yii::app()->session['user_array']['per6']=='1'){
$connection = Yii::app()->db;
$sqlmember  = "SELECT * from transferplot where RFM='RFM' ";
$resulrmem = $connection->createCommand($sqlmember)->query();

$count1=0;
$res=array();
foreach($resulrmem as $mem){
$count1++;

} ?>

<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/RFM')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count1; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/member-request.png" />
<h6 style=" text-align:center;">Member Transfer Request</h6></a></div> <?php }?>
<!--Allot plot request start-->
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

<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/request-icon.png" />
<h6 style=" text-align:center;">Allot a Plot Request </h6></a></div> <?php }?>
<!--Allot plot request end-->
<!--Allot File request start-->
<?php if(Yii::app()->session['user_array']['per6']=='1'){
$connection = Yii::app()->db;
$sql_plot  = "SELECT mp.member_id,mp.id,mp.create_date,p.type,p.status, m.name,m.sodowo,m.cnic,p.plot_detail_address,p.plot_size,s.street, j.project_name FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join projects j on s.project_id=j.id where p.type='file' and mp.status='new' and mp.fstatus='Approved' ";
$result_plot = $connection->createCommand($sql_plot)->query();

$count=0;
$res=array();
foreach($result_plot as $key){
$count++;

} ?>

<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('memberfile/memberfile_list')?>" ><span style=" color:#FFFFFF; background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/plotrequest.jpg" />
<h6 style=" text-align:center;">Allot a File Request </h6></a></div> <?php }?>
<!--Allot file request end-->

<?php if(Yii::app()->session['user_array']['per8']=='1'){
$connection = Yii::app()->db;
$sql_projects  = "SELECT * from unregister_user_query where status='0' ";
$result_projects = $connection->createCommand($sql_projects)->query();

$count=0;
$res=array();
foreach($result_projects as $key){
$count++;

} ?>

<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/visitor_query')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/dialog_question.png" />
<h6 style=" text-align:center;">Visitor's Message</h6></a></div> <?php }?>

<?php if(Yii::app()->session['user_array']['per8']=='1'){
$connection = Yii::app()->db;
$sql_projects  = "SELECT * from mailto_member ";
$result_projects = $connection->createCommand($sql_projects)->query();

$count=0;
$res=array();
foreach($result_projects as $key){
$count++;

} ?>

<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('member/maillist')?>" ><span style=" background-color: #FF0000; color:#FFFFFF;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/email-icon.jpg" />
<h6 style=" text-align:center;">Email To Member</h6></a></div> <?php }?>
<?php if(Yii::app()->session['user_array']['per3']=='1'){?>
<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('size/size_list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/landsize.png" />
<h6 style=" text-align:center;">Plot Size Categories</h6></a></div> 
<?php }?>
<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('user/subcriber_list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/subcriber.gif" />
<h6 style=" text-align:center;">Subcriber List</h6></a></div>
<?php if(Yii::app()->session['user_array']['per3']=='1'){?>
<div class="span4" style="padding:5px 25px;"><a href="<?php echo $this->createAbsoluteUrl('installmentplan/list')?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/i-scheduled-payment.png" />
<h6 style=" text-align:center;">Installment Plan</h6></a></div> 
<?php }?>

</div><!--end of span 12-->

<div class="span12" style="margin-top:-50px">


</div>

</div>


<div class="clearfix"></div>

</div>

</div>
<hr noshade="noshade" class="hr-5 float-left">

<!-- section 3 -->
