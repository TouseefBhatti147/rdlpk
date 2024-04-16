

<div class="shadow">
<div class="shadow">

<!--<a href="visitor_query1" class="btn pull-right" style="padding:5px; margin-left:10px; ">Previous Queries</a>-->
</div>
  <h3>Forgot Account Password Requests</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">

<?php 

$pages_data = Yii::app()->session['pages_array'];

?>



		

<form action="create" method="post"> 

  <div class="float-left">

	<table class="table table-striped table-new table-bordered">
 
    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="3%">Id</th><th width="8%">CNIC</th><th width="10%">Email</th><th width="30%">Message</th><th width="10%">Date</th><th width="7%">Status</th><th width="7%">Replied</th><th width="7%">Action</th><tr></thead>
			<?php	
      $res=array();
$count=1;
            foreach($visitorqueries as $key){

            echo '<tr><td>'.$count.'</td></td><td>'.$key['cnic'].'</td><td>'.$key['email'].'</td><td>'.$key['message'].'</td><td>'.$key['create_date'].'</td><td>';if($key['status']=='0'){
				echo'New';
				}else{echo 'Opened';}
			echo'</td><td >';if($key['replied']=='1'){
				echo'<strong style="color:green">Replied</strong>';
				}else{echo '<strong style="color:red">Not Replied</strong>';} echo'<td><a href="forgot_password_detail?id='.$key['id'].'&& mid='.$key['mid'].'">Detail</a>/<a href="forgot_password_delete?id='.$key['id'].'">Delete</a></td></tr>'; 
$count++;
            }?>

  	</table>

  </div>

  

 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->

 <?php //$this->endWidget(); ?>

 

 <script>

 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		   $("#street_id").change(function()

           {

         	select_plot($(this).val());

		   });

     });

 

 

function select_street(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

      

	

});listItems+="";



$("#street_id").html(listItems);

          }

    });

}

 

 

 



	 

function select_plot(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest1?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

	  

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";

 

});listItems+="";



$("#plot_id").html(listItems);

          }

    });

}



</script>

 

 </section>

<!-- section 3 --> 

