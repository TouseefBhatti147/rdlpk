<div class="my-content">
    	
        <div class="row-fluid my-wrapper">
<div class="shadow">
  <h3>Plots List</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<?php 
$user_data = Yii::app()->session['user_array'];
 ?>
 
<div>
<form action="member_lis" method="post"> 
  
 <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
     <table class="table-striped table-bordered table span12"><thead>
     	<th>
        	<td><b>Create Date</b></td>
            <td><b>Name</b></td>
            <td><b>S/O,W/O</b></td>
            <td><b>CNIC</b></td>
            <td><b>Plot #</b></td>
            <td><b>Size</b></td>
            <td><b>Street #</b></td>
            <td><b>Project</b></td>
            <td><b>Details</b></td>
            <td><b>Action</b></td>
        </th>
     </thead><?php	
            $res=array();
            foreach($members as $key){
            echo '<tr><td>'.$key['member_id'].'</td><td>'.$key['create_date'].'</td><td>'.$key['firstname'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['plot_size'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/plothistory?id='.$key['member_id'].'">history</a></td><td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/transferplot?plot_id='.$key['plot_id'].'">Transfer</a></td></tr>'; 
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#plot_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
    });
}

</script>
 