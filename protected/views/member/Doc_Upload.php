<?php

error_reporting(0);

function compress_image($src, $dest , $quality)
{
    $info = getimagesize($src);
  
    if ($info['mime'] == 'image/jpeg')
    {
        $image = imagecreatefromjpeg($src);
    }
    elseif ($info['mime'] == 'image/gif')
    {
        $image = imagecreatefromgif($src);
    }
    elseif ($info['mime'] == 'image/png')
    {
        $image = imagecreatefrompng($src);
    }
    else
    {
        die('Unknown image file format');
    }
  
    //compress and save file to jpg
    imagejpeg($image, $dest, $quality);
  
    //return destination file
    return $dest;
}

if( $_FILES['file']['name'] != "" )
{



$id=Yii::app()->session['user_array']['id'];

$dir_name = $id;
$dir_path = "gallery/".$dir_name;

mkdir($dir_path);
$number_of_files = count($_FILES['file']['name']);
$number_of_files = $number_of_files - 1;

while ($number_of_files>-1){
$filename  =  $_FILES['file']['name'][$number_of_files];
$source = $_FILES['file']['tmp_name'][$number_of_files];
$destination	=	'./gallery/'.$dir_name."/".$filename;	

copy( $source,$destination ) or 
           die( "Could not copy file!");
		   
$compressed = compress_image($source, $destination, 60); 
$number_of_files --;

}
	

echo "file uploaded successfully";
}
else
{
    die("No file specified!");
}

?>
