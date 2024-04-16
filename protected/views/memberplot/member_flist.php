<?php header('Cache-Control: max-age=900'); ?>
<div class="shadow">
  <h3>Advance Search</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php 
$pages_data = Yii::app()->session['pages_array'];
?>

<div>
<form action="member_flis" method="post"> 
  <div class="clear-fix"></div>
  
    <input type="text" value="" name="name" id="name" class="new-input" placeholder="Enter Name" />
    <input type="text" value="" name="sodowo" id="sodowo" class="new-input" placeholder="SO/DO/WO" />
    <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />
    <input type="text" value="" name="plot_size" id="plot_size" class="new-input" placeholder="File Size" />
    <input type="text" value="" name="project_name" id="project_name" class="new-input" placeholder="Project Name" />
    <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="new-input" placeholder="File Address" />
   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
 </div>
  <div class="float-left">
            
            
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                        <th width="8%">#</th>
                        <th width="12%">Date/Time</th>
                        <th width="11%">Name</th>
                        <th width="11%">S/o W/o D/o</th>
                        <th width="11%">CNIC</th>
                        <th width="4%">Plot</th>
                        <th width="7%">Plot Size</th>
                        <th width="5%">Street</th>
                        <th width="10%">Project</th>
                        
                        <th width="10%">Action</th>
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                   <?php
				   
				 /*?> <?php	
            $res=array();
            foreach($members as $key){
            echo '<tr><td width="1%">'.$key['member_id'].'</td><td>'.$key['create_date'].'</td><td>'.$key['firstname'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a href="payment?id='.$key['member_id'].'">Update</a></td><td><a href="payment?id='.$key['member_id'].'">Add Instalment</a></td></tr>'; 
            }?><?php */?>
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#street_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
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
