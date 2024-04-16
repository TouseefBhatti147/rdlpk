
<div class="shadow">

  <h3>Advance Search</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<section class="reg-section margin-top-30">

<?php 

$pages_data = Yii::app()->session['pages_array'];

?>



<form action="member_lis" method="post"> 

 <input type="text" value="" name="name" id="name" class="new-input" placeholder="Enter Name" />

    <input type="text" value="" name="sodowo" id="sodowo" class="new-input" placeholder="SO/DO/WO" />

    <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />

    <input type="text" value="" name="file_size" id="file_size" class="new-input" placeholder="Plot Size" />

    <input type="text" value="" name="project_name" id="project_name" class="new-input" placeholder="Project Name" />

    <input type="text" value="" name="file_detail_address" id="plot_detail_address" class="new-input" placeholder="Plot No" />

   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>



  

  <div class="float-left">

    <p class="reg-left-text"Result For</p>

     

            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                         <th width="8%">Image</th>

                         <!--<th width="8%">#</th>-->

                        <th width="12%">Date/Time</th>

                        <th width="11%">Name</th>

                        <th width="11%">S/o W/o D/o</th>

                        <th width="11%">CNIC</th>

                        <th width="4%">File</th>

                        <th width="7%">File Size</th>

                        <th width="5%">Street</th>

                        <th width="10%">Project</th>

                        <th width="8%">Action</th>

                        <th width="10%">Action</th>

                        

                    

                    </tr>

                </thead>

                

                <tbody>

				<?php

				$home=Yii::app()->request->baseUrl; 	

            $res=array();

            foreach($members as $key){

            echo '<tr><td><img src="/hb/upload_pic/'.$key['image'].'" width="100" height="130" /></td><td>'.$key['create_date'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td><a href="filehistory?id='.$key['id'].'">'.$key['file_detail_address'].'</a></td><td>'.$key['file_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a href="payment?id='.$key['member_id'].'">Update</a></td><td><a href="payment?id='.$key['member_id'].'">Add Payment</a></td></tr>'; 

            }?>

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

