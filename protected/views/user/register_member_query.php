
<div class="shadow">
<a href="register_member_query1" class="btn pull-right" style="padding:5px; margin-left:10px; ">Previous Queries</a>
  <h3>Query Box</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php
$pages_data = Yii::app()->session['pages_array'];
?>

		
<form action="create" method="post"> 
  <div class="float-left">
	<table class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr>
    <th width="3%">id</th>
    <th width="12%">Member Name</th>
    <th width="20%">Subject</th>
    <th width="30%">Message</th><th width="6%">Date</th><th width="5%">Status</th><th width="7%">Replied</th><th width="7%">Action</th><tr></thead>
			
		
			<?php	
			
		 
		  
            $res=array();
            foreach($register_member_query as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['name'].'</td></td><td>'.$key['subject'].'</td><td>'.$key['message'].'</td><td>'.$key['create_date'].'</td><td>';if($key['status']=='0'){
				echo'New';
				}else{echo 'Opened';}
				echo'</td>
				<td>';if($key['replied']=='1'){
				echo'<strong style="color:green">Replied</strong>';
				}else{echo '<strong style="color:red">Not Replied</strong>';}
				
			echo'</td><td><a href="register_member_query_detail?id='.$key['id'].'">Detail</a>/<a href="delete_query?id='.$key['id'].'">Delete</a></td></tr>'; 
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
