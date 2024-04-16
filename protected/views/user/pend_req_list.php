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

    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="3%">id</th><th width="10%">Project Name</th><th  width="9%">MS No.</th><th width="6%">Type</th><th width="4%">Plot No</th><th width="7%">Plot Size</th><th  width="7%">Street/Lane</th><th  width="5%">Block</th>
<th width="10%">Transfer Date</th><th width="10%">Transfer From</th><th width="10%">Transfer To</th><th width="6%">Action</th><tr></thead>



			

			<?php	

            $res=array();

            foreach($plotdetails as $key){

       echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['plotno'].'</td><td>'.$key['com_res'].'</td><td><a href="plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'('.$key['size'].')</td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['create_date'].'</td><td>'.$key['from_name'].'</td><td>'.$key['to_name'].'</td><td><a href="req_detail?id='.$key['id'].'">View Request</a></td></tr>'; 

            }?>

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

      

		

   // $.each(val,function(k,v){

     //     console.log(k+" : "+ v);     

//});

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

