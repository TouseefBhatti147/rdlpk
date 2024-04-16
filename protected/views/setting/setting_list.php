
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


<div class="shadow">  <h3>Setting List</h3>
</div>

<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">


<section class="reg-section margin-top-30">


<?php
$user_data = Yii::app()->session['user_array'];
 ?>
 



<form action="" method="post"> 
  

    <p class="reg-right-field-area margin-left-5">
     <table class="table-striped table-bordered table span12"><thead>
     	<tr>
        <td style="width:5%;"><b>Id</b></td>
        	<td style="width:5%;"><b>Ownername</b></td>
            <td style="width:5%;"><b>mobile</b></td>
            <td style="width:5%;"><b>Phone</b></td>
            <td style="width:5%;"><b>Email</b></td>
           <td style="width:5%;"><b>Message</b></td>
            <td style="width:5%;"><b>Subcription Text</b></td>
            <td style="width:7%;"><b>Address</b></td>
            
          <td style="width:7%;"><b>Action</b></td>
        </tr>
        </thead>
    <?php	
            $res=array();
            foreach($setting as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['ownername'].'</td><td>'.$key['mobile'].'</td><td>'.$key['phone'].'</td><td>'.$key['email'].'</td><td>'.$key['message'].'</td><td>'.$key['subcriptiontext'].'</td><td>'.$key['address'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/setting/update_setting?id='.$key['id'].'">Edit</a></td></tr>'; 
            }?>
</table> 			
  	
    </p>
    <div class="clearfix"></div>


 
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