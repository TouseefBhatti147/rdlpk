<?php header('Cache-Control: max-age=900'); ?>

<div class="shadow">

  <h3>Member Plots</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">

<?php 

$pages_data = Yii::app()->session['pages_array'];

?>



<form action="member_lis" method="post"> 

 <input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />

 <input type="text" value="" name="name1" id="name" class="new-input" placeholder="Enter Name" />

    <input type="text" value="" name="sodowo" id="sodowo" class="new-input" placeholder="SO/DO/WO" />

    <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />

    
	    	<select name="project_name" id="project_name" style="width:180px;"><?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

    <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="new-input" placeholder="Plot No" />

   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>

<?php 

  if(!empty($error)){

				    echo '<tr>'.$error.'</tr>';

				

				}?>

  <div class="">

    <p class="reg-left-text"Result For"></p>

     

            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                         <th width="8%">Plot Mem#</th>

                       

                         <th width="8%">Image</th>

                       

                        <th width="12%">Date/Time</th>

                        <th width="8%">Name</th>

                        <th width="8%">S/o W/o D/o</th>

                        <th width="10%">CNIC</th>

                        <th width="3%">Plot No</th>

                        <th width="6%">Plot Size</th>

                        <th width="4%">Street</th>

                        <th width="6%">Project</th>

                        

                        <th width="8%">Action</th>

                        

                    

                    </tr>

                </thead>

                <tbody>

			<?php

			  

				 if($members!=""){

		    $home=Yii::app()->request->baseUrl; 	

            $res=array();

            foreach($members as $key){

  echo '<tr><td>'.$key['plotno'].'</td><td><img src="/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="payment?id='.$key['plot_id'].' & pid='.$key['project_id'].'">Add Payment</a></br><a target="_blank" href="plotcharges?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Plot Charges</a></br><a target="_blank" href="payment_details?id='.$key['plot_id'].'&& pid='.$key['project_id'].'">Payment Details</a>

  </br><a target="_blank" href="download?id='.$key['plot_id'].'">Document</a>

  </br><a target="_blank" href="transferplot?plot_id='.$key['plot_id'].'">Transfer Plot</a>

  </td></tr>'; 

            }}?>

</tbody>

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

