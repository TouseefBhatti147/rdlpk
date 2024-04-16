<div class="my-content">
    	
        <div class="row-fluid my-wrapper">
        
        	<h2>Sales Centers</h2>
            <hr noshade="noshade" class="hr-5 ">
            <div class="span12">
            
            	
            <?php  foreach($center as $Key)
	   {
		   
	  
       echo'
            	<div class="span4">
        
                    <h3>'.$Key['name'].'</h3>
                    
                    
                    
                    <div class="span12">
                
                	<img src="'.Yii::app()->request->baseUrl.'/images/centers/'.$Key['image'].'" /> </br></br></br>                   
                    <div class="span8">
                    
                       <p>'.$Key['detail'].'</p>
                    
                    	
                    
                    </div>
            
            	</div></div>';}?>
                
            
            
        </div>
            
    </div>
<!--================= Content End ========================-->


<!--================= Content Start ========================-->
	
<!--================= Content End ========================-->

</div>







