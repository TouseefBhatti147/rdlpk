

<?php 



//echo Yii::getPathOfAlias('webroot')."/video/upload/";

//exit;

$res=array();

foreach($filename as $filename)

{ 

					   

	$flvName = $filename;

					

					

	$this->widget('ext.Yiippod.Yiippod', array(

    	'video'=>Yii::app()->baseUrl."/video/upload/".$flvName."", //if you don't use playlist

    	//'video'=>"http://www.youtube.com/watch?v=qD2olIdUGd8", //if you use playlist

    	'id' => 'yiippodplayer',

    	'autoplay'=>true,

    	'width'=>1150,

    	'view'=>6, 

    	'height'=>620,

    	'bgcolor'=>'#000'

    ));

   



   } ?>