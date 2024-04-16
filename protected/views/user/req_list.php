<div class="shadow">

  <h3>Plot Transfer Request</h3>

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

    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="3%">id</th><th width="8%">Project Name</th><th width="7%">MS No.</th><th width="10%">Transfer From</th><th width="10%">Transfer To</th><th width="6%">Plot Size</th><th width="6%">Plot Address</th><th  width="6%">Street/Lane</th><th  width=5%">Block</th><th width="7%">Status</th><th width="6%">Action</th><tr></thead>

			

			<?php

				

            $res=array();

            foreach($plotdetails as $key){

				

            echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['plotno'].'</td><td><a href="memhistory?id='.$key['transferfrom_id'].'">'.$key['from_name'].'</a></td><td>'.$key['to_name'].'</td>
<td>'.$key['size'].'&nbsp('.$key['plot_size'].')</td>
<td><a href="plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['street'].'</td>
<td>'.$key['sector_name'].'</td>
<td>'.$key['status'].'</td><td><a href="req_detail?id='.$key['id'].'">View Request</a></td></tr>'; 

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

