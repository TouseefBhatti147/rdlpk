<style>

.wc-text .btn-info {
	padding:10px 15px;
	border-radius:5px;
	color:#fff;
	text-decoration:none;
	}
	
.wc-text .btn-info:hover {
	background:#09F;
	}

</style>


<script>



function showimage(img_id){
	

	//BigImage = document.getElementById("BigImage");
	thumb = document.getElementById(img_id);
	
	//alert(thumb);
	source = thumb.src;
	
	BigImage.innerHTML="<img src='"+source+"' id='pic' />";
	//document.write(thumb);
	
	
	}

//window.onload = function(){zoom(1)}




</script>

<div class="my-content">
    	
        <div class="row-fluid my-wrapper">

 <div class="span5 pull-right wc-text">

<?php 
$base=Yii::app()->request->baseUrl;

//Can Change Directory from where it picks Images to Show in the Gallery
$id=Yii::app()->session['user_array']['id'];

$connection = Yii::app()->db;  
$title=$_GET['title'];
// echo $title;
//echo $id;
//exit;
//$sql = "SELECT * FROM gallery where id ='".$id."' and title='".$title."'"  ;

//$result_data = $connection->createCommand($sql)->queryRow();
//$title=$result_data['title'];
 $dirname ="gallery/".$title.$id."/";

$images = glob($dirname."*.{jpg,png,gif}", GLOB_BRACE);
//$images = glob($dirname."*.jpg");

$number_of_images = count($images);
$number_of_images = $number_of_images - 1;
//$number_of_imagess = 100;
//$num = $number_of_imagess / 6;
//$num = ceil($num);
//echo $num;
//exit;
while($number_of_images>-1) {


echo '<div style=" float:right; border:solid 2px #90C; border-radius:5px; padding:5px;margin:5px;"><img src="'.$base."/".$images[$number_of_images].'" height="100" width="100" id="'.$number_of_images.'" onclick="showimage('.$number_of_images.');"  /></div>';

$number_of_images --;
}


?>
</div>
</div>
</div>
</body>
