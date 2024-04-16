<div class="shadow">
 	<h3>Upload Docs</h3>
</div>
<div class="span12">

<form action="updocs?id=<?php echo $_REQUEST['id'] ?>" method="POST" enctype="multipart/form-data">
	<input class="btn" type="file" name="files[]" multiple="" />
	<input type="submit" class="btn btn-info"/>
</form>
</div>
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
}
}
 ?>

</div>
