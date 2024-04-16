<div class="row-fluid my-wrapper">



        	<div class="span9">

				

				

				<?php

                foreach($content as $key) {

                $contnt=$key['detail_content'];

                

                    

                echo stripslashes($contnt);}

                ?>

                
			

            	<?php /*?><div class="span4">

				<h3>Projects</h3>

                <?php foreach($projects as $key) {



	

	



                echo '

					 <div id="box">

 

                  <div class="img1">

                  <img src="'.Yii::app()->baseUrl.'/images/'.$key['project_image'].'">

                  

                  </div>

                  <h4> '.$key['project_name'].' </h4>

                  <p> '.$key['teaser'].'</p>

                  <p>

                  <a role="button" class="btn btn-primary btn-md pull-left">Read More</a>

                  </p>

                  </div>';}?>

                  <p>&nbsp; </p>

                     

      



                </div><?php */?>

			</div>

            

            <div class="span3 sidebar">

      <h5><span class="np030iu" id="np030iu_1">Latest News</span></h5>

  <div class="span12">

  <div id="page">

<?php

foreach($news as $key)

{

	

 echo' <ul class="ticker" id="ticker_02">

  <li style="height: 20px; overflow: hidden;">

 <a href="#">'.$key['teaser'].'</a>

</li>

<p style="height: 50px; overflow: hidden;">'.$key['details'].'</p>

 </ul>';

}

 ?>



</div>

</div>

            </div>

</div>





























