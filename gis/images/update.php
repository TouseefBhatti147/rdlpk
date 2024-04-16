<?php 
include "../../new.php";
$connection = Yii::app()->db;
if(isset($_POST['submit1'])){
	$str = str_replace(' ','',$_POST['code']);
$sql_insert_member = "Update dmap SET map='".$str."' where id='".$_REQUEST['id']."'";
$command = $connection -> createCommand($sql_insert_member);
$command -> execute();}
 $sql_payment  = "SELECT * FROM projects where id='".$_REQUEST['pid']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryRow();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<!-- Mirrored from www.image-mapper.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jun 2015 07:23:22 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
	<head profile="http://www.w3.org/2005/10/profile">
    
    <link rel="icon" type="image/png" href="images/favicon.png" />
	<title>Image Mapper</title>
    <link rel="stylesheet" type="text/css" href="../imagere/examples/css/bootstrap.min.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="../imagere/examples/css/bootstrap-responsive.css" media="print" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../imagere/examples/css/my-style.css" />
<link rel="stylesheet" type="text/css" href="../imagere/examples/css/custom.css" />
	<script src="javascripts/jquery-1.3.2.min797c.js?1263880791" type="text/javascript"></script>
<script src="javascripts/jquery.browser.min208b.js?1263880792" type="text/javascript"></script>
<script src="javascripts/jquery.draw64d2.js?1263880888" type="text/javascript"></script>
<script src="javascripts/image_mapper1c27.js?1263880789" type="text/javascript"></script>
<script src="javascripts/application99ed.js?1266991124" type="text/javascript"></script>
	<link href="stylesheets/styleed5c.css?1266991128" media="screen" rel="stylesheet" type="text/css" />
	
    
</head>
<STYLE TYPE="text/css">

p, div {
 font-family: Arial, Helvetica, Sans Serif;
 font-size: 12px;
 font-weight: normal;
}
#selections{  clear: both;
  height: 450px;
  width: 300px;
  background-image:url(images/info.jpg);
  background-repeat:no-repeat;
 
  text-align:center;
  
  font-size:13px;
  line-height:8px;
  position: absolute;
  opacity:0.78;
  
  }
  .header{
	  height:70px;
	  background:#999;
	  border:1px soled #000;
	  top:0;
	  
	  
	  }
	  select{ height:40px; width:180px;}
</STYLE>
<body>
<div class="header">
<h2 style="margin:5px; padding:20px; color:#FFF;">Floor Mapper </h2>
</div>
	<div id="page_wrap">
  
<h3>Select Area In project Map.</h3>
<div id="output_code">
	<form method="post" action="update.php?id=<?php echo $_REQUEST['id']?>">
    <textarea cols="2" id="code" name="code" rows="2"></textarea>
    <input class="btn" type="submit" name="submit1" />
	</form>
</div>
   
    <div id="toolbar">
	<p id="new_hotspot">
		<a href="#" class="button"><img alt="Hotspot_btn" src="images/hotspot_btn0fdc.png?1263880776" /></a>
	</p>
	<p id="edit_links">
		<a href="#" id="undo">Undo</a> |
		<a href="#" id="redo">Redo</a>
	</p>
</div><!-- toolbar -->

<div class="clear"></div>

<div id="user_image">
	
		<img alt="Missing"  src="/rdlpklive/images/projects/<?php echo $result_payments['project_map'] ?>" />
	
	<div id="myCanvas"></div>
</div>

<div class="clear"></div>


		
	</div><!-- page_wrap -->
</div>	<!--footer-->
	
	<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
    var pageTracker = _gat._getTracker("UA-12559156-2");
    pageTracker._trackPageview();
    } catch(err) {}</script>
    
</body>

<!-- Mirrored from www.image-mapper.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jun 2015 07:23:36 GMT -->
</html>