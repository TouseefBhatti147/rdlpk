<style>
.btn-info { font-size:14px;}
</style>

<div class="row-fluid my-wrapper">
  <div class="shadow">
    <h3>
    Downloads
    </h1>
  </div>

<?php

$path ="pdf_upload/*.*";


$files=glob($path);

 

foreach ($files as $value){
	$basevalue = str_replace(".pdf","",basename($value));
	echo "<h4>Download ".$basevalue."</h4>";
	echo '<a href="'.Yii::app()->request->baseUrl."/".$value.'" class="btn-info">Download</a><br>';
	}




?></div>