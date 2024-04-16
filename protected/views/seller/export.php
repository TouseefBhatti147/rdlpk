<div class="shadow">

  <h3>Export Plots Data Into Spraed Sheet</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">



<form action="csv" method="post">







<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

   

    	<select name="project_id" id="project" style="width:180px;"><?php	
	if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

   

   <select style="width:180px;" name="street_id" id="street_id" >

	<?php

			if($st!=''){echo '<option value="'.$st.'">'.$st.'</option>'; }

  	?>



   <option value="">Select Street</option>

  <option value="street">street</option>





    

    </select> 
   
    <select name="sector" id="sector"  style="width:180px;"><?php 
	if($sector!=''){echo '<option value="'.$sector.'">'.$sector.'</option>'; }else{
				echo '<option value="">Select Sector</option>';
				}
			$res=array();
            foreach($sectors as $sec){
            echo '<option value="'.$sec['sector'].'">'.$sec['sector'].'</option>'; 
            }?></select> 
			   
     			<select name="com_res" id="com_res"  style="width:180px;"><?php 
	         	echo '<option value="">Select Property Type</option>';
			
			$res=array();
            foreach($com_res as $res){
            echo '<option value="'.$res['com_res'].'">'.$res['com_res'].'</option>'; 
            }?></select>
           
    <select name="size" id="size"  style="width:180px;"><?php 
			if(!empty($size)){echo '<option value="'.$size.'">'.$size.'</option>'; }else{
				echo '<option value="">Select Size</option>';
				}
			$res=array();
            foreach($sizes as $siz){
            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 
            }?></select> 
			 
<input type="text" value="<?php if($plotno!=''){echo $plotno; }?>" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />
    
    <select name="stat" id="stat" style="width:180px;">
    <option value="">Select filter</option>
    <option value="1">Re-allocated</option>
    <option value="2">Alloted</option>
    <option value="3">Not Alloted</option>
    <option value="4">Reserved</option>
       
    </select>
    
    <select name="stat" id="stat" style="width:180px;">
    <option value="">Select filter</option>
    <option value="1">Re-allocated</option>
    <option value="2">Alloted</option>
    <option value="3">Not Alloted</option>
    <option value="4">Reserved</option>
       
    </select>
 
	 <?php 



	



	$res=array();



	$i = 1;



	foreach($categories as $key1)
	{
	echo'<div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="cat[]" name="cat[]" type="checkbox"	value="'.$key1['id'].'" />
	<label for="checkbox" style="float:left;">'.$key1['name'].'</label>
	</div>';
	$i++;
	}
	?>
<hr noshade="noshade" class="hr-5">

<div >
<h4 style="margin-right:534px;">
Select Column For Export
</h4>
 </div>
<div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="detail_address1" name="detail_address1" checked="checked" type="checkbox"	value="1"  />
	<label for="checkbox" style="float:left;">Plot No.</label>
	</div>
<div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="project_id1" name="project_id1" type="checkbox"	value="1"  />
	<label for="checkbox" style="float:left;">Project Name</label>
	</div>
    <div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"    id="street_id1" name="street_id1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Street</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="sector1" name="sector1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Sector</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="size21" name="size21" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Size</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="price1" name="price1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Price</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="name1" name="name1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Name</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="cnic1" name="cnic1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">CNIC</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="plotno1" name="plotno1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Membership No.</label>
	</div>
    <div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="com_res1" name="com_res1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Property Type.</label>
	</div>
        <div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="status1" name="status1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Status.</label> 
    </div>
    <input class="btn" value="Export" type="submit" name="submit" />
</section>
</form>
</div>
<div class="shadow">

  <h3>Export Plots Data(Payment Wise) Into Spraed Sheet</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">



<form action="csv1" method="post">







<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

   

    	<select name="project_id" id="project" style="width:180px;"><?php	
	if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

   

   <select style="width:180px;" name="street_id" id="street_id" >

	<?php

			if($st!=''){echo '<option value="'.$st.'">'.$st.'</option>'; }

  	?>



   <option value="">Select Street</option>

  <option value="street">street</option>





    

    </select> 
   
    <select name="sector" id="sector"  style="width:180px;"><?php 
	if($sector!=''){echo '<option value="'.$sector.'">'.$sector.'</option>'; }else{
				echo '<option value="">Select Sector</option>';
				}
			$res=array();
            foreach($sectors as $sec){
            echo '<option value="'.$sec['sector'].'">'.$sec['sector'].'</option>'; 
            }?></select> 
			   
     			<select name="com_res" id="com_res"  style="width:180px;"><?php 
	         	echo '<option value="">Select Property Type</option>';
			
			$res=array();
            foreach($com_res as $res){
            echo '<option value="'.$res['com_res'].'">'.$res['com_res'].'</option>'; 
            }?></select>
           
    <select name="size" id="size"  style="width:180px;"><?php 
			if(!empty($size)){echo '<option value="'.$size.'">'.$size.'</option>'; }else{
				echo '<option value="">Select Size</option>';
				}
			$res=array();
            foreach($sizes as $siz){
            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 
            }?></select> 
			 
<input type="text" value="<?php if($plotno!=''){echo $plotno; }?>" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />
    
    <select name="stat" id="stat" style="width:180px;">
    <option value="">Select filter</option>
    <option value="1">Re-allocated</option>
    <option value="2">Alloted</option>
    <option value="3">Not Alloted</option>
    <option value="4">Reserved</option>
       
    </select>
    
    <select name="stat" id="stat" style="width:180px;">
    <option value="">Select filter</option>
    <option value="1">Re-allocated</option>
    <option value="2">Alloted</option>
    <option value="3">Not Alloted</option>
    <option value="4">Reserved</option>
       
    </select>
   
   <select name="payment_mode" style="width:180px;" id="payment_mode">
	<option value="">Select Mode</option>
    <option>Cash</option>
    <option>Cheque/PO</option>
    <option>Other</option>
    </select>
    
   
    <select name="specify" style="width:180px;" id="specify">
	<option value="">Specify</option>
    <option value="2">No Receipt</option>
    <option value="3">JV</option>
    <option value="4">Against Land</option>
    <option value="5">Sui Gas</option>
    </select>
    
    </p>
	 <?php 



	



	$res=array();



	$i = 1;



	foreach($categories as $key1)
	{
	echo'<div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="cat[]" name="cat[]" type="checkbox"	value="'.$key1['id'].'" />
	<label for="checkbox" style="float:left;">'.$key1['name'].'</label>
	</div>';
	$i++;
	}
	?>
<hr noshade="noshade" class="hr-5">

<div >
<h4 style="margin-right:534px;">
Select Column For Export
</h4>
 </div>
<div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="detail_address1" name="detail_address1" checked="checked" type="checkbox"	value="1"  />
	<label for="checkbox" style="float:left;">Plot No.</label>
	</div>
<div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="project_id1" name="project_id1" type="checkbox"	value="1"  />
	<label for="checkbox" style="float:left;">Project Name</label>
	</div>
    <div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"    id="street_id1" name="street_id1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Street</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="sector1" name="sector1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Sector</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="size21" name="size21" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Size</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="price1" name="price1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Price</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="name1" name="name1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Name</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="cnic1" name="cnic1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">CNIC</label>
	</div><div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="plotno1" name="plotno1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Membership No.</label>
	</div>
    <div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="com_res1" name="com_res1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Property Type.</label>
	</div>
        <div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="status1" name="status1" type="checkbox"	value="1" />
	<label for="checkbox" style="float:left;">Status.</label> 
    </div>
    <input class="btn" value="Export" type="submit" name="submit" />
</section>
</form>
</div>
<!-- section 3 --> 






<div class="clearfix"></div>


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

	listItems+="<option value=''>Select Street</option>";



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";



      







});listItems+="";







$("#street_id").html(listItems);



          }



    });



}



</script>