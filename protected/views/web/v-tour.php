

<div  class="row-fluid my-wrapper">

    <div class="span12">
<h3>Virtual Tour</h3>
  
<style>



.style{ margin:5px; float:left;  padding:6px;}

.style2{ width:200px; height:117px;}

.style3{ text-align:center; background-color:#000; color:#FFF;}



</style>

<div class="style">



<div class="span12">

<?php $path ="video/upload/*.*";
$path1 ="video/video_thumbnails/*.*";

$files1=glob($path1);
$files=glob($path);

 

foreach ($files as $value){
	echo '<div class="span4">';
	$basevalue = str_replace(".pdf","",basename($value));
	$img=0;
	foreach ($files1 as $value1){if(basename($value1)==basename($value)){$img=$value1;}}
	
	echo '<a style="margin-left:10px;  "target="new"  href="'.Yii::app()->request->baseUrl."/".$value.'" class="btn-info"><img src="'.Yii::app()->request->baseUrl."/".$img.'"/></a><br>';
	echo "<span style=font-size:18px;> ".$basevalue."</span><br>";
	echo '</div>';
	}




?>
</div>
 			</div>

  	

    </div>

</div>

