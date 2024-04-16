	
<div class="row-fluid my-wrapper">
<?php
foreach($content as $key) {
$contnt=$key['detail_content'];

	
echo '
	<div class="span9">
	'.stripslashes($contnt).'

    </div>
';}
?>
    <div class="span3 sidebar" style="border-left: 1px solid #eaeaea;">
      <h3 class="blue">News & Events</h3>
  <div class="span12">
  <div id="page">
<ul id="ticker_01" class="ticker">
        <?php
	   foreach($news as $Key)
	   {
		   
	  
       echo'
       		<li>
        	<p>'.$Key['teaser'].' 
       	    <br>
        	<a href="'.$this->CreateAbsoluteUrl("web/news_details?id=".$Key['id']."").'" class="pull-right">
        	read more
        	</a></p><hr>
        	</li>
			
      
	  ';
   }   
	    ?>
     </ul>?>

</div>
</div>
            </div>

</div>
