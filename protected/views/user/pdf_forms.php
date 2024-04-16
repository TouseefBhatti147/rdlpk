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
	echo "<span style=font-size:18px;>Download ".$basevalue."</span>";
	echo '<a style="margin-left:10px;  "target="new"  href="'.Yii::app()->request->baseUrl."/".$value.'" class="btn-info">Download</a><br>';
	}




?></div>
<hr  />
<hr />
<hr />