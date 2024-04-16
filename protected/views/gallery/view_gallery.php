
<?php 
$base=Yii::app()->request->baseUrl;

//Can Change Directory from where it picks Images to Show in the Gallery
$id=Yii::app()->session['user_array']['id'];

$connection = Yii::app()->db;  
$title=$_GET['title'];
$dirname ="gallery/".$title.$id."/";

$images = glob($dirname."*.{jpg,png,gif}", GLOB_BRACE);
//$images = glob($dirname."*.jpg");

$number_of_images = count($images);
$number_of_images = $number_of_images - 1;

?>

<div class="span8">
<?php while($number_of_images>-1) {
echo '
<div class="span4 main-icons">
<img src="'.$base."/".$images[$number_of_images].'"  id="'.$number_of_images.'"   />
<h6>'.$title.'</h6>

</div>';
$number_of_images --;
}?>
</div>

