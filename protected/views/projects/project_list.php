
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



<?php

if (isset($_GET['error']) and $_GET['error']==1)

{

	echo "<script>window.alert('You Cannot Delete this Project');</script>";

}

?> 

<div class="my-content">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">



<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/projects/projects"  class="btn-info button">Add New Project</a></span>

</div>

  <h3>Project List</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<?php

$user_data = Yii::app()->session['user_array'];

 ?>

 







<form action="member_lis" method="post"> 

  

<div class="">

    <p class="reg-right-field-area margin-left-5">

     <table class="table-striped table-bordered table span12"><thead>

     	

        	<td style="width:5%;"><b>Id</b></td>

            <td style="width:10%;"><b>Project Name</b></td>

            <td style="width:20%;"><b>Teaser</b></td>
<td style="width:20%;"><b>URL</b></td>

          

             <td style="width:20%;"><b>Create Date</b></td>

            <td style="width:20%;"><b>Action</b></td>

       </thead>

    <?php	

            $res=array();

            foreach($projects as $key){

            echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['teaser'].'</td><td>'.$key['url'].'</td><td>'.$key['create_date'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/projects/detail_project?id='.$key['id'].'">Detail</a><a href="'.Yii::app()->request->baseUrl.'/index.php/projects/update_project?id='.$key['id'].'">/Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/projects/Delete_project?id='.$key['id'].'">/Delete</a></td></tr>'; 

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

 