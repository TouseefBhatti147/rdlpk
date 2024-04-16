
<div class="shadow">
  <h3>Alotment Plot Requests List</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php
$pages_data = Yii::app()->session['pages_array'];
?>
<div>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<script>
$(function() {
$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
$(function() {
$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
<form action="Memberplot_search_lis" method="post"> 
  <div class="clear-fix"></div>
  
    <input type="text" value="" name="appno" id="appno" class="new-input" placeholder="Enter App No" />
    <input type="text" value="" name="mid" id="mid" class="new-input" placeholder="Member id" />
    <input type="text" value="" name="status" id="status" class="new-input" placeholder="Enter Status" />
    From: <input name="fromdate" placeholder="Enter From Date" type="text" class="new-input" id="fromdatepicker"> To: <input name="todate"  type="text" placeholder="Enter To Date" class="new-input" id="todatepicker">
   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
 </div>
	</form>	
<form action="create" method="post"> 
  <div class="float-left">
	<table class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="3%">id</th><th width="12%">Membername</th><th width="10%">Plot Size</th><th width="10%">Plot Address</th><th width="10%">Street</th><th width="10%">Project</th><th width="7%">Action</th><tr></thead>
			
		
			<?php	
			
		 
		  
            $res=array();
            foreach($memberplot_list as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['name'].'</td></td><td>'.$key['plot_size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a href="req_detail?id='.$key['id'].'">Edit</a>/<a href="req_detail?id='.$key['id'].'">Detail</a></td></tr>'; 
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
