

<style>



.wc-text .btn-info {

	padding:10px 15px;

	border-radius:5px;

	color:#fff;

	text-decoration:none;

	}

	

.wc-text .btn-info:hover {

	background:#09F;

	}



</style>





<div class="my-content">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">



<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/hordings/hordings"  class="btn-info button">Add New Hordings</a></span>

</div>

  <h3>Hordings List</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5" >

<?php

$user_data = Yii::app()->session['user_array'];

 ?>

 







<form action="" method="post"> 

  

<div class="">

    <p class="reg-right-field-area margin-left-5">

     <table class="table-striped table-bordered table span12"><thead>
     	<td style="width:5%;"><b>Id</b></td>

        	<td style="width:15%;"><b>Title</b></td>

            <td style="width:15%;"><b>Detail</b></td>

            <td style="width:20%;"><b>Image</b></td>
             <td style="width:10%;"><b>Status</b></td>
            <td style="width:20%;"><b>Action</b></td>

        </thead>

    <?php	

            $res=array();

            foreach($hordings as $key){

            echo '<tr><td>'.$key['id'].'</td><td>'.$key['title'].'</td><td>'.$key['detail'].'</td><td><img  style="width:200px;" src="'.Yii::app()->request->baseUrl.'/images/hordings/'.$key['image'].'"></td><td>';if($key['status']==1){echo'Active';}else{ echo'In-active';}echo'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/hordings/update_hordings?id='.$key['id'].'">Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/hordings/delete_hordings?id='.$key['id'].'">/Delete</a></td></tr>'; 

            }?>

</table> 			

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

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

 