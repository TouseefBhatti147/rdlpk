

<h3>Documents</h3>
<div class="span12">
<?php

$dirname = "images/imagetransfer/".$_REQUEST['id']."/";
if(is_dir($dirname)){
$images = scandir($dirname);
$ignore = Array(".", "..");
foreach($images as $curimg){
if(!in_array($curimg, $ignore)) {
echo "<a style='margin:20px 20px;' href='/rdlpklive/$dirname$curimg'><img src='/rdlpklive/$dirname$curimg' width='200' /></a>
";
};
}}
 ?>

</div>
