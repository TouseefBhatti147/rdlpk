<div class="shadow">
  <h3>Advance Search</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php 
$pages_data = Yii::app()->session['pages_array'];
?>

<div>
<form action="member_lis" method="post"> 
  <div class="clear-fix"></div>
  
    <input type="text" value="" name="name" id="name" class="new-input" placeholder="Enter Name" />
    <input type="text" value="" name="sodowo" id="sodowo" class="new-input" placeholder="SO/DO/WO" />
    <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />
    <input type="text" value="" name="file_size" id="file_size" class="new-input" placeholder="Plot Size" />
    <input type="text" value="" name="project_name" id="project_name" class="new-input" placeholder="Project Name" />
    <input type="text" value="" name="file_detail_address" id="file_detail_address" class="new-input" placeholder="Plot Address" />
   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
 </div>
  <div class="">
            
            
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                         <th width="7%">File Membership #</th>

                        <th width="8%">Project</th>



                        <th width="3%">Street</th>



                        <th width="5%">File No</th>



                        <th width="5%">Diemension</th>



                        <th width="4%">Size</th>



                        <th width="5%">Type</th>



                        <th width="4%">Sector</th>



                        <th width="4%">Convert</th>



                        
 


                        <th width="6%">Status</th>



						 <th width="4%">B.Status</th>                        

						  <th width="3%">Merge</th>
					
                         <th width="4%">Action</th>
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                 
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
