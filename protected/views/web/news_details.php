<div  class="row-fluid my-wrapper">
    <div class="span12">
  
      <?php
                foreach($news as $key) {
                $contnt=$key['details'];
                
                    
                echo stripslashes($contnt);}
                ?>
   
    </div>
</div>
