<div class="shadow">
  <h3>Splash screen</h3>
  <span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/pages/addsplashscreen"  class="btn-info button">Add</a></span>

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
    <thead style="background:#666; border-color:#ccc; color:#fff;">
    
    	<tr>
        
        	<td width="5%">ID</td>
            
            <td>Heading</td>
            
            <td>Description</td>
            
            <td>Image</td>
            <td>From Date</td>
            <td>To Date</td>
            <td width="5%">Action</td>
        
        </tr>
    
    </thead>
    <tbody>
 			 <?php	
            $res=array();
            foreach($splash as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['heading'].'</td><td>'.$key['details'].'</td><td>'.$key['images'].'</td>
            <td>'.date("d-m-Y ", strtotime($key['from'])).'</td>
             <td>'.date("d-m-Y ", strtotime($key['to'])).'</td>
            <td><a href="edit_splash?id='.$key['id'].'">Update</a>/<a href="delete_splash?id='.$key['id'].'">Delete</a></td></tr>'; 
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
