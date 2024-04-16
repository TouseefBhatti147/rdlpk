

<div class="shadow">

  <h3>Verification Requests List</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<section class="reg-section margin-top-30">

<?php 

$pages_data = Yii::app()->session['pages_array'];

?>



		

<form action="create" method="post"> 

  <div class="float-left">

	<table class="table table-striped table-new table-bordered">

    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="3%">id</th><th width="12%">Transfer From</th><th width="12%">Transfer To</th><th width="7%">Plot Address</th><th width="6%">Plot Size</th><th  width="4%">Street</th><th width="12%">Project Name</th><tr></thead>

			

			<?php

				

            $res=array();

            foreach($plotdetails as $key){

				

            echo '<tr><td>'.$key['id'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/uareuapplet/Login/tverification.php?id='.$key['transferfrom_id'].' && tid='.$key['id'].'">'.$key['from_name'].'</a></td><td>'.$key['to_name'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td></tr>'; 

            } ?>

            

  	</table>

  </div>

 

 

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

