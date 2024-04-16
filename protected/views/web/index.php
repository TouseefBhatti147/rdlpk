<?php if (!isset($_COOKIE['firsttime']))
{
setcookie("firsttime", "no" ,time()+600);
?>

<script>
            $(window).load(function()
{
    $('#myModal').modal('show');
});
</script>
<?php
$co=count($hord);
if($co>1){
 ?>
 


<?php } }?>
<script type="text/javascript">
    $(document).ready(function() {
        $('nav').easyPie();
    });    
    </script>
<script type="text/javascript">
        $(document).ready(function() {
        
        $('#carouselh').jsCarousel();
        });       
    </script>
    <style>
    .row{ margin-left:0px;}
    </style>
<?php 

foreach($pages as $content){
	if($content['content_type']=='Welcome')
		$welcome_content=$content['teaser'];
	if($content['content_type']=='testimonial')
		$testimonial_content=$content['teaser'];
	if($content['content_type']=='verifyAPlot')
		$verifyAPlot_content=$content['teaser'];
	if($content['content_type']=='test1')
		$test1_content=$content['detail_content'];	
	} 

?>



<div class="clearfix"></div>


<!-- <----------slider starts here----------->
<div class="container">
  <!-- Trigger the modal with a button -->
    <?php
    
	 foreach($resss as $ke1)
	 {
	 $today = date("Y-m-d");
     $to = $ke1['to'];
     if(($today<=$to) && ($ke1['status']==1)){
	 ?> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">	 
 <!---<div class="modal fade" id="myModal" role="dialog">---->
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="background-color:#428bca;color:white;text-align:center;"><span><strong>News Flash</strong></span></h4>
          <h4 class="modal-title" style="background-color:black;color:yellow;"><?php echo $ke1['heading']; ?></h4>
        </div>
        <div class="modal-body">
          <img class="magnify" src="<?php echo Yii::app()->request->baseUrl; ?>/images/splash/<?php echo $ke1['images'];?>" style="width: 100%;"><br/>
          <br/><br/>
          <p><strong><?php echo $ke1['details']; ?></strong></p>
        </div>
        <div class="modal-footer">
            <p><strong><a class="btn btn-primary btn-md pull-left" href="<?php echo $this->CreateAbsoluteUrl("pages/newsflash");?>"> View All Public Notices</a></strong></p>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	
	<?php }
	}
	?>
</div>
<div class="row-fluid">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
<?php 
$st=0;
foreach($slider1 as $slid1){

if($st=='0'){
echo '<li data-target="#myCarousel" data-slide-to="'.$st.'" class="active"></li>';
}else{echo '<li data-target="#myCarousel" data-slide-to="'.$st.'" ></li>';
}

$st=$st+1;
 }?>
    </ol>

    <!-- Carousel items -->

   <div style="padding-left:5%;" class="carousel-inner">

      <?php 

			$j=0;

			foreach($slider as $slid){

				$j++;

				if($j==1){?>

			
  <div class="active item"> <?php if(!empty($slid['link'])){?><a target="new" href="<?php echo 'http://'. $slid['link'];?>"><img width="95%" src="<?php echo Yii::app()->request->baseUrl.'/images/slider/'.$slid['image'];?>"></a><?php }?>

            </div><?php } else{ ?>

            
            
            <div class="item"> <img  width="95%" src="<?php  echo Yii::app()->request->baseUrl.'/images/slider/'.$slid['image'];?>">

            </div>

            <?php }}?>

    </div>

    <!-- Carousel nav --> 

    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a> </div>

</div>

<!------------------------slider ends here------------------------------>

<div class="clearfix"> </div>

<!--VERIFY A PLOT-->

<div class="row-fluid" id="section1" style=" background:#2A3F55; height:20px;">

 <!-- <div class="">

    <div class="container-fluid">

      <div class="col-lg-3 pull-left">

        <h3 class="blue"  style="margin-top:8px; color:#FFF;"> Verify a Plot/File </h3>

      </div>

      <div class="col-lg-9 pull-right detail">

        <div class="">
<script>



function validateForm(){

	$("#error-plotno").hide();
	var a = $("#plotno").val();
var counter=0;
if (a==null || a=="")
  {
 window.alert("Enter Membership No.");
     counter =1;
  }
 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->


</div>



<!-- <----------section 1 starts here----------->

<div class="row-fluid" id="section1">

  <div class="span12">

    <div class="container-fluid">

      <div class="col-lg-3 pull-left">
<?php foreach($setting as $set)

	     {
			 if($set['showsearch']=='1'){
echo '<a href="http://rdlpk.com/index.php/forms/search"><img style="width:250px;" src="http://rdlpk.com/images/search-button.png"/></a>';
}
			if($set['showsearch_bal']=='1'){
echo '<a href="http://rdlpk.com/index.php/web/ballotres"><img style="width:250px;" src="http://rdlpk.com/images/search-button.png"/></a>';
}	
}
?>
        <h3 class="blue">News & Events</h3>

        

       		

        	<ul id="ticker_02" class="ticker">

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

     </ul>  
     
      </div>

      <div class="col-lg-9 pull-right detail">

        <div class="span12">

          <h3 class="blue"> Introduction to Royal Developers & Builders (Pvt.) Ltd.</h3>

          <p> <?php echo $welcome_content;?></p>

      <div class="col-md-12">

        <h3> Our Projects</h3>

      </div>

      <div class="col-md-11"> 

        <!-- Controls -->

        <div class="controls pull-right "> <a class="" href="#carousel-example"

                        data-slide="prev"></a><a class="" href="#carousel-example"

                            data-slide="next"></a> </div>

        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel"> 

          <!-- Wrapper for slides -->

          <div class="carousel-inner">

            <div class="item active">

              <div class="row" style="margin-right: -9px;">
                 
                <?php 

				$counter_project1=0;

				$total_counter1=0;
$co=count($projects);
				foreach($projects as $project){

					$counter_project1=$counter_project1+1;

					$total_counter1=$total_counter1+1;
$url='';
			?>

                <div class="col-lg-4 pull-left" id="box">
<?php if($project['url']==''){$url=$this->CreateAbsoluteUrl("web/project_details?id=".$project['id']."");}else{$url=$project['url'];} ?>
                  <div class="img1"> <a href="<?php echo $url ?>"><img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/upload/<?php echo $project['project_image'];?>" width="195px"> </div>

                 

<!-- Mobile Banner -->



                 </a> 

                </div>

                <?php 

				

				if($counter_project1==3 && $co>($total_counter1) )

						{    

							echo '</div></div><div class="item"><div class="row">';

							$counter_project1=0;

						}

						

					}

					

					?>

             

          </div>

        </div>

      </div>

      </div>

      </div>

      <div class="clearfix"></div>

      <div class="col-md-12">

   

      </div>

      <div class="col-md-11"> 

        <!-- Controls -->

        <div class="controls pull-right "> <a class="" href="#carousel-example"

                        data-slide="prev"></a><a class="" href="#carousel-example"

                            data-slide="next"></a> </div>

        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel"> 

          <!-- Wrapper for slides -->

          <div class="carousel-inner">

            <div class="item active">

              <div class="row"  style="margin-right: -9px;">
                <?php 

				$counter_project=0;

				$total_counter=0;
				$co=count($uprojects);
				foreach($uprojects as $uproject){

					$counter_project=$counter_project+1;

					$total_counter=$total_counter+1;

			?>

                <div class="col-lg-4 pull-left" id="box" style="margin-bottom:10px;">

                  <div class="img1"><a href="<?php echo $this->CreateAbsoluteUrl("web/uproject_details?id=".$uproject['id']."") ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/uprojects/<?php echo $uproject['project_image'];?>" width="195px"> </div>
				  </a> 

                </div>

                <?php 

						if($counter_project==3 && $co>($total_counter))

						{    

							echo '</div></div><div class="item"><div class="row">';

							$counter_project=0;

						}

						

					}?>

              </div>

            </div>

          </div>

        </div>

      </div>

      

      </div>

      </div>

    </div>

  </div>

</div>

<!-- <----------section1 ends here----------->

<div class="clearfix"> </div>

<!-- <----------section 2starts here----------->



<!-- <----------section2 ends  here----------->

<div class="clearfix"> </div>

<!-- <----------section4 ends  here----------->



<!-- <----------section 4 ends here----------->

<div class="clearfix"> </div>

<!-- <----------section 5 starts herehere----------->

<div id="section5">

  <div class="container-fluid">

    <div class="row-fluid">

      <div class="col-lg-3">

        <h3 class="blue"> Find us on map </h3>

      </div>

      <div class="clearfix"> </div>

      <div class="col-lg-4 pull-left maps">

       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d207.49663417430446!2d72.9888414!3d33.6844586!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbdc7f137c599%3A0xcfc85a0966290cdc!2sFDH%20-%20Capital%20Smart%20City%20(Main%20Office)!5e0!3m2!1sen!2s!4v1640584186453!5m2!1sen!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

      </div>

      <div class="col-lg-8 pull-right" id="newsletter">

        <?php

	   foreach($setting as $set)

	     {

		  

        echo ' <div class="span12" id="news-top"><h2> SUBSCRIBE FOR <span class="blue"> NEWS AND UPDATES </span></h2>

        <P>'.$set['subcriptiontext'].' </P>

        </div>';

		}?>
<?php 
$error='';

if(isset($_POST['sub1212'])){
   
	$email=$_POST['email'];	
	if(empty($email))
	{
		$error='Please Enter Email Address';
	}
	


     
///		$date=date('d-m-Y');
///	$connection = Yii::app()->db;
///$sql="INSERT INTO subcription(email,date) VALUES('".$email."','".$date."')";
///		 $command = $connection -> createCommand($sql);
     ///    $command -> execute();
///echo"<script type=text/javascript>alert('Successfully Subcribed');</script>";

	}
	else{
///		echo "<script type=text/javascript>alert('$error');</script>";
	
	}?>

        <div class="span12" id="news-bottom">

          <form method="post" name="myForm" action="#"  class="pull-left">

            <input name="email" type="email" style="font-size:14px;">

            <button type="submit" name="sub" id="sub" class="btn btn-primary btn-lg pull-left"> Subscribe</button>

          </form>
 
        </div>

      </div>

    </div>

  </div>

</div>

<!-- <----------section5 ends here----------->



<div>

  <?php //echo stripslashes($test1_content); ?>

</div>

<script type="text/javascript">

$(document).ready(function(){

$('#myCarousel').carousel({interval: 3000});

});

</script> 

<script type="text/javascript">

$(document).ready(function() {

	$('#liquid').liquidcarousel({height:160});

});

	</script> 

<!--============ Google Map ===========--> 







<script>



	function tick(){

		$('#ticker_01 li:first').slideUp( function () { $(this).appendTo($('#ticker_01')).slideDown(); });

	}

	setInterval(function(){ tick () }, 5000);





	function tick2(){

		$('#ticker_02 li:first').slideUp( function () { $(this).appendTo($('#ticker_02')).slideDown(); });

	}

	setInterval(function(){ tick2 () }, 3000);





	function tick3(){

		$('#ticker_03 li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker_03')).css('opacity', 1); });

	}

	setInterval(function(){ tick3 () }, 4000);	



	function tick4(){

		$('#ticker_04 li:first').slideUp( function () { $(this).appendTo($('#ticker_04')).slideDown(); });

	}





	/**

	 * USE TWITTER DATA

	 */



	 $.ajax ({

		 url: 'http://search.twitter.com/search.json',

		 data: 'q=%23javascript',

		 dataType: 'jsonp',

		 timeout: 10000,

		 success: function(data){

		 	if (!data.results){

		 		return false;

		 	}



		 	for( var i in data.results){

		 		var result = data.results[i];

		 		var $res = $("<li />");

		 		$res.append('<img src="' + result.profile_image_url + '" />');

		 		$res.append(result.text);



		 		console.log(data.results[i]);

		 		$res.appendTo($('#ticker_04'));

		 	}

			setInterval(function(){ tick4 () }, 4000);	



			$('#example_4').show();



		 }

	});





</script>