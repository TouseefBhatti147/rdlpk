<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />

<!-- blueprint CSS framework -->
<!-- <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>-->

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/d3.v3.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tinyscrollbar.min.js"></script>
<script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
<script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/popup.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/highlight.pack.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tabifier.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/js.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jPages.js"></script>
<script  type="application/javascript">
 $(function(){

    /* initiate the plugin */
    $("div.holder").jPages({
      containerID  : "itemContainer",
      perPage      : 3,
      startPage    : 1,
      startRange   : 1,
      midRange     : 5,
	   previous    : "span.arrowPrev1",
      next        : "span.arrowNext1",
      endRange     : 1
    });

		$("div.holder1").jPages({
      containerID  : "Container",
      perPage      : 10,
     first       : false,
      previous    : "span.arrowPrev",
      next        : "span.arrowNext",
	  midRange     : 0,
      last        : false
    });

  });
	
    var web_url = "http://localhost/hb/index.php";
	
	$(window).resize(function() {
	$("#window").css("width", $(window).width()-65);
	});
	$("#window").css("width", $(window).width()-65);
    </script>
<style>
  .holder {
    margin: 9px 38px;
  }

  .holder a {
    font-size: 12px;
    cursor: pointer;
	font-family: Lato,Arial;
    margin: 0 5px;
    color: #333;
	text-decoration:none;
  }

  .holder a:hover {
  /*  background-color: #222;*/
   /*color: #FF4242;*/
   color:#0035E0;
  }

  .holder a.jp-previous { margin-right: 15px; }
  .holder a.jp-next { margin-left: 15px; }

  .holder a.jp-current, a.jp-current:hover {
    /*color: #FF4242;*/
	color:#0035E0;
    font-weight: bold;
  }

  .holder a.jp-disabled, a.jp-disabled:hover {
    color: #bbb;
  }

  .holder a.jp-current, a.jp-current:hover,
  .holder a.jp-disabled, a.jp-disabled:hover {
    cursor: default;
    background: none;
  }

  .holder span { margin: 0 5px; }
   .customBtns1 { position: relative; }
  .arrowPrev1, .arrowNext1 { width:29px; height:29px; position: absolute; top: -27px; cursor: pointer; }
  .arrowPrev1 { background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/arrow-left.png') no-repeat; left: 6px; }
  .arrowNext1 { background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/arrow-right.png') no-repeat; right: 140px; }
   
  /***********Holder 1**************/
  .holder1 {
    margin: 9px 33px;
  }

  .holder1 a {
    font-size: 12px;
    cursor: pointer;
	font-family: Lato,Arial;
    margin: 0 5px;
    color: #333;
	text-decoration:none;
  }

  .holder1 a:hover {
  /*  background-color: #222;*/
   /*color: #FF4242;*/
   color:#0035E0;
  }

  .holder1 a.jp-previous { /*margin-right: 5px;*/ }
  .holder1 a.jp-next { /*margin-left: 5px;*/ }

  .holder1 a.jp-current, a.jp-current:hover {
    /*color: #FF4242;*/
	color:#0035E0;
    font-weight: bold;
  }

  .holder1 a.jp-disabled, a.jp-disabled:hover {
    color: #bbb;
  }

  .holder1 a.jp-current, a.jp-current:hover,
  .holder1 a.jp-disabled, a.jp-disabled:hover {
    cursor: default;
    background: none;
  }
  
.customBtns { position: relative; }
  .arrowPrev, .arrowNext { width:29px; height:29px; position: absolute; top: -27px; cursor: pointer; }
  .arrowPrev { background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/arrow-left.png') no-repeat; left: 6px; }
  .arrowNext { background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/arrow-right.png') no-repeat; right: 91px; }
  .holder1 span { margin: 0 5px; } 
  
.arcLabel {
	font-size: 11px;
	fill: #fff;
	font-weight: bold;
}
div.tooltip {
	position: absolute;
	text-align: center;
	width: auto;
	height: 28px;
	padding: 5px 10px;
	font-size: 12px;
	font-weight: bold;
	background: lightsteelblue;
	border: 1px;
	border-radius: 8px;
	pointer-events: none;
	color: #000;
}
</style>
</head>

<body>
<section class="main-section-1"> <?php echo $content; ?> </section>
<!-- main-section -->
</body>
</html>
