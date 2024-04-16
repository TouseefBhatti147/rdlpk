
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

<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/charges/charges"  class="btn-info button">Add New Charges</a></span>
</div>
  <h3>Charges List</h3>
</div> 

<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<?php
$user_data = Yii::app()->session['user_array'];
 ?>
 
<form action="charges_list" method="post"> 
  <div class="clear-fix"></div>
 	<select name="project_id" id="project" style="width:180px;"><option> </option> <?php	

			

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?></select> 
   
  
   
  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
    -->
   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button></form>


<form action="" method="post"> 
  
<div class="float-left">
    <p class="reg-right-field-area margin-left-5">
     <table class="table-striped table-bordered table span12"><thead>
     	<td style="width:5%;"><b>Id</b></td>
        	<td style="width:20%;"><b>Name</b></td>
            <td style="width:20%;"><b>Note</b></td>
            <td style="width:10%;"><b>Monthly</b></td>
            <td style="width:10%;"><b>Total(Once)</b></td>
           <td style="width:10%;"><b>Project Name</b></td>
          
             <td style="width:8%;"><b>Action</b></td>
        </thead>
    <?php	
            $res=array();
            foreach($charges as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['name'].'</td><td>'.$key['note'].'</td><td>'.$key['monthly'].'</td><td>'.$key['total'].'</td><td>'.$key['project_name'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/charges/update_charges?id='.$key['id'].'">Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/charges/delete_charges?id='.$key['id'].'">/Delete</a></td></tr>'; 
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
 