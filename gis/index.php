<?php 
include "../new.php";
$connection = Yii::app()->db;
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;

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
<link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.css" media="print" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../imagere/examples/css/my-style.css" />
<link rel="stylesheet" type="text/css" href="../imagere/examples/css/custom.css" />
<script src="images/javascripts/jquery-1.3.2.min797c.js?1263880791" type="text/javascript"></script>
<script src="images/javascripts/jquery.browser.min208b.js?1263880792" type="text/javascript"></script>
<script src="images/javascripts/jquery.draw64d2.js?1263880888" type="text/javascript"></script>
<script src="images/javascripts/image_mapper1c27.js?1263880789" type="text/javascript"></script>
<script src="images/javascripts/application99ed.js?1266991124" type="text/javascript"></script>

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
	  .span3{ float:left;
	  width:250px;
	  padding:20px;
	  border:1px solid #999;
	  border-radius:7px;
	  margin:10px;
	  
	  }
	  .btn{ font-size:12px; font-weight:bold; text-decoration:none;}
	  select{ height:40px; width:180px;}
</STYLE>
<body>
<div class="header">
<h2 style="margin:5px; padding:20px; color:#FFF;">Mapping</h2>
</div>
	<div id="page_wrap">
    
<div class="span12">
<?php 
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

foreach($result_projects as $row1){?>
<div class="span3">
	<img alt="Missing" height="200px"  src="http://rdlpk.com/images/projects/<?php echo $row1['project_map'] ?>" />
	<p style="font-size:14px; font-weight:bold; text-align:center;"><?php echo $row1['project_name'] ?></p>
    <?php if(Yii::app()->session['user_array']['per23']=='1'){?>
    <a href="images/index.php?id=<?php echo $row1['id'] ?>" class="btn">Create Map</a> 
    | <a href="developer.php?id=<?php echo $row1['id'] ?>"  class="btn">Developer View</a><?php } ?> 
    <?php if(Yii::app()->session['user_array']['per22']=='1'){?>| <a href="Townp.php?id=<?php echo $row1['id'] ?>"  class="btn">View Map</a><?php }?>
</div>
<?php }?>
</div>  
</div>	<!--footer-->
	
    
</body>
</html>