<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />

<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" media="print" />
<script type="text/javascript" src="/js/bootstrap.min.js"></script>

<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/front.css" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>


<div class="container-fluid"> 
  
  <!--================= Header Start ========================-->
  <div class="row-fluid top-line">
    <div class="my-wrapper">
      <ul class="pull-left">
        <li><a href="#">Sitemap</a></li>
        |
        <li><a href="#">FAQs</a></li>
        |
        <li><a href="#">Signin</a></li>
      </ul>
      <ul class="pull-right">
        <!--<li><a href="#"><img src="images/rss.jpg" /></a></li>
        <li><a href="#"><img src="images/fb.jpg" /></a></li>
        <li><a href="#"><img src="images/twt.jpg" /></a></li>
        <li><a href="#"><img src="images/yt.jpg" /></a></li>
        <li><a href="#"><img src="images/pin.jpg" /></a></li>
      --></ul>
    </div>
  </div>
  <div class="row-fluid my-wrapper">
    <div class="cntct-num">
      <div class="crn-l"></div>
      <div class="cntct-num-cntr"> Call Us : 555-00-555-8 <br>
        Toll Free : 555-00-555-8 </div>
      <div class="crn-r"></div>
    </div>
    <div class="clearfix"></div>
    <div class="span2 my-logo pull-left"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" /> </div>
    <div class="span5 hdr-left pull-right">
      <div class="login"> Welcome Guest! <a href="<?php echo $this->createAbsoluteUrl('member/member')?>" class="btn-success">Login</a> or <a href="<?php echo $this->createAbsoluteUrl('member/register')?>" class="btn-inverse">Register</a> </div>
      <div class="srch">
        <form>
          <a href="#" class="btn-success">Search</a>
          <input class="srch-bar" type="text" placeholder="Search Here...">
        </form>
      </div>
    </div>
    
    <!--================= menu Start ========================-->
    
    <div class="my-menu pull-right">
      <ul>
      <li><a href="<?php echo $this->createAbsoluteUrl('web/index')?>" class="link-2" title="Register">Home</a></li>
      <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>" class="link-2" title="Plots">About</a>
          <ul class="sub-menu">
          <li><a href="<?php echo $this->createAbsoluteUrl('streets/streets')?>" class="link-2" title="Streets">Streets</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('projects/projects')?>" class="link-2" title="Projects">Projects</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot')?>" class="link-2" title="Projects">Plot member</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/search_memberplot')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages_list')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/edit_page')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('transferplot/transferplot')?>" class="link-2" title="Projects">transferplot</a></li>
          </ul>
      </li>
      <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>" class="link-2" title="Plots">Media Center</a>
          <ul class="sub-menu">
          <li><a href="<?php echo $this->createAbsoluteUrl('streets/streets')?>" class="link-2" title="Streets">Streets</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('projects/projects')?>" class="link-2" title="Projects">Projects</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot')?>" class="link-2" title="Projects">Plot member</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/search_memberplot')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages_list')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/edit_page')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('transferplot/transferplot')?>" class="link-2" title="Projects">transferplot</a></li>
          </ul>
      </li>
      <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>" class="link-2" title="Plots">Projects</a>
          <ul class="sub-menu">
          <li><a href="<?php echo $this->createAbsoluteUrl('streets/streets')?>" class="link-2" title="Streets">Streets</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('projects/projects')?>" class="link-2" title="Projects">Projects</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot')?>" class="link-2" title="Projects">Plot member</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/search_memberplot')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages_list')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/edit_page')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('transferplot/transferplot')?>" class="link-2" title="Projects">transferplot</a></li>
          </ul>
      </li>
      <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>" class="link-2" title="Plots">Infra Stucture</a>
          <ul class="sub-menu">
          <li><a href="<?php echo $this->createAbsoluteUrl('streets/streets')?>" class="link-2" title="Streets">Streets</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('projects/projects')?>" class="link-2" title="Projects">Projects</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot')?>" class="link-2" title="Projects">Plot member</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/search_memberplot')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages_list')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/edit_page')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('transferplot/transferplot')?>" class="link-2" title="Projects">transferplot</a></li>
          </ul>
      </li>
      <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>" class="link-2" title="Plots">Site Location Plan</a>
          <ul class="sub-menu">
          <li><a href="<?php echo $this->createAbsoluteUrl('streets/streets')?>" class="link-2" title="Streets">Streets</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('projects/projects')?>" class="link-2" title="Projects">Projects</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot')?>" class="link-2" title="Projects">Plot member</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/search_memberplot')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages_list')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/edit_page')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('transferplot/transferplot')?>" class="link-2" title="Projects">transferplot</a></li>
          </ul>
      </li>
      <li><a href="<?php echo $this->createAbsoluteUrl('plots/plots')?>" class="link-2" title="Plots">Members Portal</a>
          <ul class="sub-menu">
          <li><a href="<?php echo $this->createAbsoluteUrl('streets/streets')?>" class="link-2" title="Streets">Streets</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('projects/projects')?>" class="link-2" title="Projects">Projects</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/memberplot')?>" class="link-2" title="Projects">Plot member</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('memberplot/search_memberplot')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/pages_list')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('pages/edit_page')?>" class="link-2" title="Projects">Search plot</a></li>
          <li><a href="<?php echo $this->createAbsoluteUrl('transferplot/transferplot')?>" class="link-2" title="Projects">transferplot</a></li>
          </ul>
      </li>
      
        
    
    		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'User', 'url'=>array('/user/create')),
				array('label'=>'About', 'url'=>array('/pages/about')),
				array('label'=>'Pages', 'url'=>array('/site/contact')),
				array('label'=>'Transfer a Plot', 'url'=>array('/site/contact')),
				array('label'=>'Members', 'url'=>array('/site/contact')),
				
				
				array('label'=>'Login', 'url'=>array( 'user/user'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); */?>
      </ul>
    </div>
    
    <!--================= menu End ========================--> 
    
  </div>

  
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>
                    
         </div>           

  <!--================= Footer Start ========================-->
  
  <div class="my-footer">
    
    	<div class="row-fluid my-wrapper">
        
        	<div class="span12 top-footer">
            
            	<div class="span4">
                
                	<h4>Contact Us</h4>
                
                	<form>
                    
                    	<label>Name</label>
                    
                    	<input type="text" placeholder="Enter Your Name">
                        
                        <label>Email</label>
                    
                    	<input type="text" placeholder="Enter Your Email">
                        
                        <label>Message</label>
                    
                    	<textarea></textarea>
                        
                        <label></label>
                    
                    	<button type="submit" class="btn-success">Send</button>
                    
                    </form>
                
                </div>
                
                <div class="span4 testim">
                
                	<h4>Testimonial</h4>
                
                	<p><span>"</span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.<span>"</span></p>
                    
                    <p><span>"</span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.<span>"</span></p>
                   
                </div>
                
                <div class="span4">
                
                	<h4>Browse Project</h4>
                
                	<ul>
                    
                    	<li><a href="#">G-10/1</a></li>
                        
                        <li><a href="#">G-10/4</a></li>
                        
                        <br><br>
                        
                        <li><a href="#">Korang Town</a></li>
                        
                        <li><a href="#">Korang Town (Extn.)I</a></li>
                        
                        <li><a href="#">Korang Town (Extn.)II</a></li>
                        
                        <br><br>
                        
                        <li><a href="#">Jinnah Garden Phase I</a></li>
                        
                        <li><a href="#">Jinnah Garden Phase II</a></li>
                    
                    </ul>
                
                </div>
            
            </div>
            
            <div class="span12 btm-ftr">
            
            	<p class="span4 pull-left">&copy; Copyright 2013 - HRL.com</p>
            
            	<div class="cg">
                    <a href="http://creativegarage.org">
                        <img src="images/cg-icon.png" class="cg-logo" />
                        Designed by Creative Garage
                    </a>
                </div>
            
            </div>
        
        </div>
    
    </div>
  
  <!--================= Footer End ========================--> 
  
</div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>