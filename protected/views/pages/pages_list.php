
<div class="shadow">
  <h3>Web Pages</h3>
  <span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/pages/pages"  class="btn-info button">Add Page</a></span>

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
        
        	<td width="5%">Serial No</td>
            
            <td>Page Type</td>
            
            <td>Description</td>
            
            <td>Content Type</td>
            
            <td width="5%">Action</td>
        
        </tr>
    
    </thead>
    <tbody>
 			 <?php	
            $res=array();
            foreach($pages as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['page_type'].'</td><td>'.$key['description'].'</td><td>'.$key['content_type'].'</td><td><a href="edit_page?id='.$key['id'].'">Update</a>/<a href="delete_page?id='.$key['id'].'">Delete</a></td></tr>'; 
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
