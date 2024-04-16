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
      <div class="span3 pull-left"> <a href="<?php echo $this->createAbsoluteUrl('dealer/dashboard');?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo1.jpg" /></a> </div>
      <div class="span5 pull-right wc-text">
        <div class="span7"> <span>Welcome <?php echo Yii::app()->session['dealer_array']['name']?>!</span> </div>
        <div class="span5 pull-right"> <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/user-icon.png" /><?php echo Yii::app()->session['dealer_array']['name']?> |</a> <a href="<?php echo $this->createAbsoluteUrl('dealer/logout')?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/log-icon.png" />Logout</a> </div>
      </div>
      
      <div class="span5 pull-right wc-text">
        <ul>
          <li><a href="<?php echo $this->CreateAbsoluteUrl('dealer/user_detail');?>">My Account</a></li>
          |
          <li><a href=" <?php echo $this->createAbsoluteUrl('dealer')?>" class="" title="">Dashboard</a></li>
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