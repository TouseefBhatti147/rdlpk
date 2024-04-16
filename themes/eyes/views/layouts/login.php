<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Royal Developers & Builders</title>
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/rd-icon.png" type="image/x-icon"/>
	

	<meta name="language" content="en" />



	<!-- blueprint CSS framework -->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" media="screen, projection" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" media="print" />

	<!--[if lt IE 8]>

	

	<![endif]-->



	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/my-style.css" />

	

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/ckeditor/ckeditor.js"></script>



	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>



<body>

<div class="container-fluid">



    



<!--================= Header Start ========================-->

	

    <div class="my-header">



<div class="row-fluid my-wrapper">



<div class="span3 pull-left">



<a href="<?php echo $this->createAbsoluteUrl('user/dashboard');?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo1.jpg" /></a>



</div>



<div class="span5 pull-right wc-text">



<div class="span7">







</div>







</div>







</div>



</div>

    

<!--================= Header End ========================-->





<div class="my-footer">

    

    	<div class="row-fluid my-wrapper">

        

        

        

        	

        

        </div>

    

    </div>

<!--================= Navigation Start ========================-->

	

    

    

<!--================= Navigation End ========================-->







<!--================= Content Start ========================-->

	

    <div class="my-content">

    

    	<div class="row-fluid my-wrapper">

        

        	

            

            	<div class="span12">

                

                

                    

           <?php $this->widget('zii.widgets.CBreadcrumbs', array(

		'links'=>$this->breadcrumbs,

	)); ?><!-- breadcrumbs -->



	<?php echo $content; ?>

                    

                    

                

                </div>

            

          

            

            

        

        </div>

    

    </div>

    

<!--================= Content End ========================-->





<!--================= Footer Start ========================-->

	

    <div class="my-footer">

    

    	<div class="row-fluid my-wrapper">

        

        

        

        	<div class="cg">

            <a href="http://creativegarage.org">

            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cg-icon.png" class="cg-logo" />

            Designed by Creative Garage</a>

            </div>

        

        </div>

    

    </div>

    

    

<!--================= Footer End ========================-->



</div>





<script src="http://code.jquery.com/jquery.js"></script>




</body>

</html>