<?php
	echo 123;exit;
		$name = $_REQUEST['id'];
		
		$newname="images/imagetransfer/".$name.".jpg";
		$file = file_put_contents( $newname, file_get_contents('php://input') );
		$connection = Yii::app()->db;  
	    $sql3 = "UPDATE transferplot SET image='".$_REQUEST['id']."' WHERE id = '".$_REQUEST['id']."'"; 	
    
		$command = $connection -> createCommand($sql3);
		$command -> execute();
		

	  	$url = 'http://rdlpk.com/' . $newname;
		print "$url\n";


?>

