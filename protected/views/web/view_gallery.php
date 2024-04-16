
<div class="row-fluid" id="section1">
  <div class="span12">

</h3>    <div class="container-fluid">
<h3><?php echo $_GET['title'];?><hr>
<style>



.main-icons {

    background: none repeat scroll 0 0 rgb(255, 255, 255);

    border: 1px solid rgb(113, 113, 113);

    border-radius: 10px;

    box-shadow: 1px 1px 3px 0;

    margin: 7px;

    padding: 10px 0;

    text-align: center;

	width:320px;

	height:223px;

}





</style>

<?php 

$base=Yii::app()->request->baseUrl;



//Can Change Directory from where it picks Images to Show in the Gallery





$connection = Yii::app()->db;  

$title=$_GET['title'];

$dirname ="gallery/".$title."/";



$images = glob($dirname."*.*", GLOB_BRACE);

//$images = glob($dirname."*.jpg");



$number_of_images = count($images);

$number_of_images = $number_of_images - 1;



?>



<div class="">

<?php while($number_of_images>-1) {

echo '

<div style="float:left;" class=" main-icons" ">

<a href="'.$base."/".$images[$number_of_images].'"><img style="width:300px;"   src="'.$base."/".$images[$number_of_images].'"  id="'.$number_of_images.'"   /></a>





</div>';

$number_of_images --;

}?>

</div>


</div></div></div>
