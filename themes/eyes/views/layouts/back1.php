<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Royal Developers & Builders</title>
<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/rd-icon.png" type="image/x-icon"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" media="print" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/my-style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/custom.css" />
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.fileupload.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container-fluid"> 
  
  <!--================= Header Start ========================-->
  
  <div class="my-header">
    <div class="row-fluid my-wrapper">
      <div class="span3 pull-left"> <a href="<?php echo $this->createAbsoluteUrl('user/dashboard');?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo1.png" /></a> </div>
      <div class="span5 pull-right wc-text">
        <div class="span7"> <span>Welcome <?php echo Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname']?>!</span> </div>
        <div class="span5 pull-right"> <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/user-icon.png" /><?php echo Yii::app()->session['user_array']['username']?> |</a> <a href="<?php echo $this->createAbsoluteUrl('user/logout')?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/log-icon.png" />Logout</a> </div>
      </div>
      
      <div class="span5 pull-right wc-text">
        <ul>
          <li><a href="<?php echo $this->CreateAbsoluteUrl('user/user_detail');?>">My Account</a></li>
          |
          <li><a href=" <?php echo $this->createAbsoluteUrl('user/dashboard')?>" class="" title="">Dashboard</a></li>
          |
          <li><a href="<?php echo $this->createAbsoluteUrl('web/index')?>" class="" title="">View Site</a></li>
        </ul>
      </div>
    </div>
  </div>
  
  <!--================= Header End ========================--> 
  
  <!--================= Navigation Start ========================-->
  
  <div class="my-nav">
    <div class="my-menu row-fluid my-wrapper">
      <ul>
       
        <li><a href="#" class="link-2" title="Add">Add</a>
          <ul class="sub-menu">
        <?php if(Yii::app()->session['user_array']['per3']=='1'){  ?>
            <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>" class="link-2" title="Plot">Plot</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('files/files')?>" class="link-2" title="File">File</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('streets/streets')?>" class="link-2" title="Streets">Streets</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('category/category')?>" class="link-2" title="category">Category</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('charges/charges')?>" class="link-2" title="Charges">Charges</a></li>
            <?php }?>
            <?php if(Yii::app()->session['user_array']['per5']=='1'){  ?>
            <li><a href="<?php echo $this->createAbsoluteUrl('centers/centers')?>" class="link-2" title="Sales Center">Sales Center</a></li>
            <?php } ?>
          </ul>
        </li>
        |
        <?php if(Yii::app()->session['user_array']['per2']=='1'){  ?>
        <li><a href="#" class="link-2" title="Allotment">Allotment </a>
          <ul class="sub-menu">
            <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot')?>" class="link-2" title="Alot a plot">Allot a plot</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('memberfile/memberfile')?>" class="link-2" title="Alot a File">Allot a File</a></li>
          </ul>
        </li>
        |
        <?php } ?>
        <?php if(Yii::app()->session['user_array']['per2']=='1'){  ?>
        <li><a href="#" class="link-2" title="Search">Search</a>
          <ul class="sub-menu">
            <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/member_flis')?>" class="link-2" title="Member File">Member File</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/member_lis')?>" class="link-2" title="Member Plot">Member Plot</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots_lis')?>" class="link-2" title="Plots">Plots</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('files/files_lis')?>" class="link-2" title="File">File</a></li>
          </ul>
        </li>
        |
        <?php } ?>
        <?php if(Yii::app()->session['user_array']['per12']=='1' && Yii::app()->session['user_array']['per2']!=='1'){  ?>
        <li><a href="#" class="link-2" title="Search">Search</a>
          <ul class="sub-menu">
            <li><a href="<?php echo $this->createAbsoluteUrl('memberplotsales/member_flis')?>" class="link-2" title="Member File">Member File</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('memberplotsales/member_lis')?>" class="link-2" title="Member Plot">Member Plot</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('plotssales/plots_lis')?>" class="link-2" title="Plots">Plots</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('filessales/files_lis')?>" class="link-2" title="File">File</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('plots/duepayment')?>" class="link-2" title="File">Due Payments</a></li>
          </ul>
        </li>
        |
        <?php } ?>
        <?php if(Yii::app()->session['user_array']['per4']=='1'){  ?>
        <li><a href="" class="link-2" title="Content">Content</a>
          <ul class="sub-menu">
            <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages')?>" class="link-2" title="Add Pages">Add Pages</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages_list')?>" class="link-2" title="Pages List">Pages List</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('user/add_member_menu')?>" class="link-2" title="Top Menu">Add Top Menu</a></li>
          </ul>
        </li>
        |
        <?php } ?>
        <?php if(Yii::app()->session['user_array']['per6']=='1'){
$connection = Yii::app()->db;
$sql_projects  = "SELECT * from transferplot where status='New Request' AND fstatus='Approved'";
$result_projects = $connection->createCommand($sql_projects)->query();
$count=0;
$res=array();
foreach($result_projects as $key){
$count++;
} ?>
      <li><a href="<?php echo $this->createAbsoluteUrl('user/req_list')?>" class="link-2" title="Transfer Plot">Transfer Plots<span style=" background-color: #FF0000;border-radius: 3px;padding: 3px 5px;vertical-align: super;"><?php echo $count; ?></span> </a>
          <ul class="sub-menu">
           <li><a href="<?php echo $this->createAbsoluteUrl('user/rej_req_list')?>" class="link-2" title="Rejected Request">Rejected Request</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('user/pend_req_list')?>" class="link-2" title="Pending Request">Pending Request</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('user/appro_req_list')?>" class="link-2" title="Approved Request">Approved Request</a></li>
          </ul>
        </li>
        
        <?php } ?>
        <?php if(Yii::app()->session['user_array']['per5']=='1'){  ?>
        <li><a href="#" class="link-2" title="Add Media">Add Media</a>
          <ul class="sub-menu">
            <li><a href="<?php echo $this->createAbsoluteUrl('news/news')?>" class="link-2" title="News/Events">News/Events</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('gallery/gallery')?>" class="link-2" title="Image Gallery">Image Gallery</a></li>
            <li><a href="<?php echo $this->createAbsoluteUrl('user/virtual_tour_upload_video')?>" class="link-2" title="Virtual Tour">Virtual Tour</a></li>
          </ul>
        </li>
        
        
        
		<?php }/* $this->widget('zii.widgets.CMenu',array(

'items'=>array(

array('label'=>'Plot', 'url'=>array('/plots/plots')),

array('label'=>'Streets', 'url'=>array('/streets/streets', 'view'=>'about')),

array('label'=>'Project', 'url'=>array('/projects/projects')),

array('label'=>'Plot Member', 'url'=>array('/memberplot/memberplot')),

array('label'=>'Search Plot', 'url'=>array('/memberplot/member_list')),

array('label'=>'Pages', 'url'=>array('/pages/pages_list')),

array('label'=>'Membership Forms', 'url'=>array('/site/contact')),





array('label'=>'Login', 'url'=>array( 'user/user'), 'visible'=>Yii::app()->user->isGuest),

array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)

),

)); */?>
      </ul>
    </div>
  </div>
  
  <!--================= Navigation End ========================--> 
  
  <!--================= Content Start ========================-->
  
  <div class="my-content">
    <div class="row-fluid my-wrapper">
      <div class="span12">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(

'links'=>$this->breadcrumbs,

)); ?>
        <!-- breadcrumbs --> 
        
        <?php echo $content; ?> </div>
    </div>
  </div>
  
  <!--================= Content End ========================--> 
  
  <!--================= Footer Start ========================-->
  
  <hr noshade="noshade" class="hr-5 ">
  <hr noshade="noshade" class="hr-5 ">
  <div class="my-footer">
    <div class="row-fluid my-wrapper">
      <div class="cg"> <a href="http://creativegarage.org"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cg-icon.png" class="cg-logo" /> Designed by Creative Garage</a> </div>
    </div>
  </div>
  
  <!--================= Footer End ========================--> 
  
</div>
</body>
</html>
