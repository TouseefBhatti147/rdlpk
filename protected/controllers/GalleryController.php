<?php

class GalleryController extends Controller
{
	
	public function actionDetail_gallery()
	{
		if(Yii::app()->session['user_array']['per5']=='1')
		{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM gallery where id=".$_GET['id'];
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('detail_gallery',array('detail_gallery'=>$result_projects));
		}
	  else{
	$this->redirect (array('user/user'));
	  }
	  }else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	
	 function actionView_gallery()
	 {
	
		if(Yii::app()->session['user_array']['per5']=='1')
	{
		$this->layout='//layouts/back';
	    $this->render('view_gallery');
			}else{
				$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	 
	}
	
	public function actionGallery()
	{
	 if(Yii::app()->session['user_array']['per5']=='1')
	{
		if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
		{	
				$this->render('gallery');
			
		}
		else{
			$this->redirect(array('user/user'));
		
			}
	}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	function actionDoc_Upload()
	 {
		
		$this->layout='//layouts/front';
			$this->render('Doc_Upload');
		 
	}
	
	function actionDoc_Upload_Form()
	 {
		
		if(Yii::app()->session['user_array']['per5']=='1')
			{
		
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
$connection = Yii::app()->db; 
$id=Yii::app()->session['user_array']['id'];
$title=$_POST['title'];
$description=$_POST['description'];
$dir_name = $title.$id;
$dir_path = "gallery/".$dir_name;
mkdir($dir_path);
$number_of_files = count($_FILES['file']['name']);
$number_of_files = $number_of_files - 1;
while ($number_of_files>-1){
$filename  =  $_FILES['file']['name'][$number_of_files];
$source = $_FILES['file']['tmp_name'][$number_of_files];
$destination	=	'./gallery/'.$dir_name."/".$filename;
copy( $source,$destination ) or die( "Could not copy file!");
		   
$compressed = compress_image($source, $destination, 60); 
$number_of_files --;

}
////////////////sql query	
$sql="INSERT INTO gallery(title,description) Values('".$title."','".$description."')";
$command = $connection -> createCommand($sql);
$command -> execute();
$this->redirect(array('gallery/gallery_list'));	

echo "file uploaded successfully";
}
else
{
    die("No file specified!");
}
		 
			}
}
	
public function actionGallery_list()
	{	
	if(Yii::app()->session['user_array']['per5']=='1')
	  {
	 if(isset(Yii::app()->session['user_array']) && isset(Yii::app()->session['user_array']['username']))
	   {
	$this->layout='//layouts/back';
    $connection = Yii::app()->db; 
	$sql_projects = "SELECT * FROM gallery";
	$result_projects = $connection->createCommand($sql_projects)->query();
	$this->render('gallery_list',array('gallery'=>$result_projects));
	   }
	  	else{
			$this->redirect (array('user/user'));
	  		}
	  }else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}	 
	  
	
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
function actionDelete_gallery()
	 {     
	 			if(Yii::app()->session['user_array']['per5']=='1')
			{
	 
	 		  $uid=Yii::app()->session['user_array']['id'];
			  $uid;
			  $title=$_REQUEST['title'];
			  $dir_name = $title.$uid;
			  $dir_path = "gallery/".$dir_name;
		      
			   $connection = Yii::app()->db;
	  		   $sql  = "Delete from gallery where id='".$_REQUEST['id']."'";
               $command = $connection -> createCommand($sql);
              $command -> execute();
			  $files = glob('gallery/'.$dir_name.'/*'); 
			  foreach($files as $file){ if(is_file($file)) unlink($file); }
			  rmdir($dir_path);
			

		 	   $this->redirect(array("gallery/gallery_list"));		
			   
			}else{$this->redirect(Yii::app()->baseUrl."/index.php/user/dashboard"); }
	}
	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
