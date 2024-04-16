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
<form action="plots_lis" method="post"> 
  <div class="clear-fix"></div>
 	<select name="project_id" id="project" style="width:180px;"><option> </option> <?php	

			

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?></select> 
   
   <select style="width:180px;" name="street_id" id="street_id">

   <option></option>
  <option value="street">street</option>

  


    
    </select> 
    <select name="sector" id="sector"  style="width:180px;"><option></option><?php $res=array();

            foreach($sectors as $sec){

            echo '<option value="'.$sec['sector'].'">'.$sec['sector'].'</option>'; 

            }?></select> 
    
<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />
  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
    -->
   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button></form> 
 </div>
 <?php 
if($_REQUEST['note']!=''){echo '<div><p style="color: white;
background: rgb(94, 94, 255);
padding: 13px;
border-radius: 10px;
width: 387px;
opacity: 0.7;
font-weight: bold;">New Record Inserted Successfully</p></div>';}

?>
  <div class="float-left">
            
            
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="10%">Project</th>
                        <th width="5%">Street</th>
                        <th width="6%">Plot No</th>
                        <th width="7%">Plot Size</th>
                        <th width="7%">Dimension</th>
                        <th width="7%">Type</th>
                        <th width="5%">Sector</th>
                        <th width="7%">Create Date</th>
                        
                        <th width="5%">Status</th>
                        
                         <th width="8%">Reallocation</th>
                        
                         <th width="7%">Action</th>
                        
                        </tr>
                </thead>
                <tbody>
                <?php
		    $home=Yii::app()->request->baseUrl; 
            $res=array();
            foreach($members as $key){
			
			
            echo '<tr><td>'.$key['project_name'].'</td><td>'.$key['street'].'</td><td><a href="'.$home.'/index.php/user/plothistory?id='.$key['id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['plot_size'].'</td><td>'.$key['size2'].'</td><td>'.$key['com_res'].'</td><td>'.$key['sector'].'</td><td>'.$key['create_date'].'</td><td>';
			if($key['status']==''){ echo'<a href="'.$home.'/index.php/memberplot/allotplot?id='.$key['id'].'">' ."Allot".'</a>';}else{ echo $key['status'];}echo '</td>
			<td><a href="reallocate?id='.$key['id'].'">Reallocate</a></td><td><a href="updateplot?id='.$key['id'].'">Edit</a>/<a href="deleteplot?id='.$key['id'].'">Delete</a></td></tr>'; 
            }?>
                    
                </tbody>
            </table>
<hr noshade="noshade" class="hr-5 float-left">
 			
  	
  </div>
  
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
 
 <script>
 
 
 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

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

</script>