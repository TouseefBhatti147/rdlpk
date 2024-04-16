<div class="">

<div class="shadow">
<h3>
 <span style="font-size:20px; float:left; font-weight:bold; margin-top:25px;">Edit Plot</span>

</h3>
</div>

<!-- shadow -->
<div class="clearfix"></div>
<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">

  <div style="

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-project"></span>

  <span style="color:#FF0000; display:block;" id="error-street_id"></span>

  <span style="color:#FF0000; display:block;" id="error-plot_detail_address"></span>

  <span style="color:#FF0000;display:block;" id="error-plot_size"></span>

  <span style="color:#FF0000;display:block;" id="error-size2"></span>   

  <span style="color:#FF0000;display:block;" id="error-com_res"></span>   

  <span style="color:#FF0000;display:block;" id="error-sector"></span>   

 <span style="color:#FF0000;display:block;" id="error-price"></span>   
<span style="color:#FF0000;display:block;" id="error-cstatus"></span>   

 

   </div>


<form method="post" action="update" enctype="multipart/form-data" onsubmit="return validateForm()">

<input value="Plot" name="type" id="type" type="hidden" />
  <?php $res=array();
            foreach($plots as $plo){
				
     echo '
<div id="error-div" class="errorMessage" style="display: none;"></div>

	

 

      <input type="hidden" value="'.$plo['id'].'" name="id" id="id" class="reg-login-text-field" />

 
   <div class="float-left">

  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>

  <select name="project_id" id="project">
   <option value="'.$plo['project_id'].'">'.$plo['project_name'].'</option>';
 			 
			 
			

            $res=array();

            foreach($projects as $key){
				

            echo '
			
			
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?>

  </select>

 

  </div>
<div class="float-left" >

  <p class="reg-left-text">Sector<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
<?php 
	$connection = Yii::app()->db;

$sql_size  = "SELECT * from sectors";
$result_size = $connection->createCommand($sql_size)->query();
?>
<select name="sector" id="sector">
<option value="<?php echo $plo['sector']?>"><?php echo $plo['sector_name']?><option>
<?php
foreach($result_size as $sec){
echo '<option value="'.$sec['id'].'">'.$sec['sector_name'].'</option>';
}
 ?>
</select>
   

  

</p>

  </div>
  <div class="float-left">

  <p class="reg-left-text">Street # <font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5">
  <select name="street_id" id="street_id">

  
<option value="<?php echo $plo['street_id'];?>"><?php echo $plo['street'];?></option>

  
  <option value="">street</option>

  

  </select>
 </p>
  

  </div>
  <div class="float-left" >
  <p class="reg-left-text">Shap Id<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="<?php echo $plo['shap_id']; ?>" name="map" id="map" class="reg-login-text-field" /> </p>
  </div>
<?php 
if($plo['status']=='Alotted'){?>
	<div class="float-left">

    <p class="reg-left-text">Plot No <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php echo $plo['plot_detail_address'];?>" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field"  />

   



    </p>

  </div> 

<?php }else{?>
  <div class="float-left">

    <p class="reg-left-text">Plot No <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text"  value="<?php echo $plo['plot_detail_address'];?>" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />

   



    </p>

  </div> 
  <div id="plotno" name="plotno">
  </div>

<?php }?>

  <div class="float-left">

    <p class="reg-left-text">Plot Diemension<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php echo $plo['plot_size'];?>" name="plot_size" id="plot_size" class="reg-login-text-field" />

	



    </p>

  </div>

   <div class="float-left">

    <p class="reg-left-text">Plot Size(Unit)<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
  

          
				
 
 
         <select name="size2" id="size2">
  <option value="<?php echo $plo['size2'];?>"><?php echo $plo['size'];?></option>

        	 <?php	
 		
			$res=array();

            foreach($size as $k){

            echo '
			
			
			<option value="'.$k['id'].'">'.$k['size'].'</option>'; 

            }?>

  </select>
      

    </p>

    



  </div>

   <div class="float-left" >

  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">

  <select name="com_res" id="com_res">
			
 			<option value="<?php echo $plo['com_res']?>"><?php echo $plo['com_res']?></option>
 			<option value="Commercial">Commercial</option>

            <option value="Residential">Residential</option>

  </select>
</p>
 



  </div> 

  

   <div class="float-left" >

  <p class="reg-left-text">Price<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">

   <input type="text" value="<?php echo $plo['price']?>" name="price" id="price" class="reg-login-text-field" />

</p>  

  </div>

   <div class="float-left" >

  <p class="reg-left-text">Own<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">

   <input type="text" value="<?php echo $plo['own']?>" name="own" id="own" class="reg-login-text-field" />

</p>  

  </div>

   <div class="float-left" >

  <p class="reg-left-text">Prime location Charges<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">

   <input type="text" value="<?php echo $plo['PLcharges']?>" name="PLcharges" id="PLcharges" class="reg-login-text-field" />

</p>  

  </div>

 <div class="float-left" >

  <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">

   <input type="text" value="<?php echo $plo['remarks']?>" name="remarks" id="remarks" class="reg-login-text-field" />

</p>  

  </div>
<div class="float-left" >

  <p class="reg-left-text">Develop/Undevelop<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">

  <select name="cstatus" id="cstatus">
				<option value="<?php echo $plo['cstatus']?>"><?php echo $plo['cstatus']?></option>
 			<option value="Developed">Developed</option>

            <option value="Undeveloped">Undeveloped</option>

  </select>
</p> 



  </div>
<div class="float-left" >

  <p class="reg-left-text">Reserver for<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
 <select name="ctag" id="ctag">
				<option value="<?php echo $plo['ctag']?>"><?php echo $plo['ctag']?></option>
<option value="">None</option> 			
<option value="HRL Reserved">HRL Reserved</option>
<option value="Against Land">Against Land</option>
<option value="Villas">Villas</option>
  </select>
</p> 



  </div>
<?php if($plo['com_res']=='Residential'){?>
  <div class="float-left" >

  <p class="reg-left-text">Is Villa:<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php // if($plo('isvilla')==0) {?>
 <!--<input type="checkbox" name="isvilla" value="0" />-->
<input type="checkbox" name="isvilla" id="isvilla" value="1" <?php echo ($plo['isvilla']==1 ? 'checked' : '');?>>

<?php // }?></p> 
  </div>
<?php }?>
<div class="float-left" >
<p class="reg-left-text">Make it Public:<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5">

<input type="checkbox" name="public" id="public" value="1"  >

</p>
</div>
   <div class="float-left" >

  

 <?php }
 

 ?>  

  <p class="reg-left-text">Category<font color="#FF0000">*</font></p>


  <div class="float-left" >
<?php $plotcat=array(); 
//$plotcat='new';
?>
<span style="font-weight:bold;"><?php foreach($cat as $row5){ $plotcat[]= $row5['name']; }
//echo $plotcat;exit;

?></span> 
   <!--<input type="text" value="" name="category" id="category" class="reg-login-text-field" />-->




  </div>


 <?php 
 
	

	$res=array();

	$i = 1;

	foreach($categories as $key1)

	{

	if(in_array($key1['name'],$plotcat)){

	echo'<div class="cat">

    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].' " checked/>

	<label for="checkbox">'.$key1['name'].'</label>

	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>

	



	</div>';
	}else{
		
	echo'<div class="cat">

    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].' " />

	<label for="checkbox">'.$key1['name'].'</label>

	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>

	



	</div>';
		}
	

	$i++;

	}

	?>

 

  </div>

   

   
<div class="float-left" >
<p class="reg-left-text">Image<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5"> <?php echo' <img style="height:100px;" src="'.Yii::app()->request->baseUrl.'/images/plots/'.$plo['image'].'">';?>
<input id="image" type="file" name="image" accept="image/*">
</p>
</div>
<div class="float-left" >
<p class="reg-left-text">Plot Location<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5"> <?php echo' <img style="height:100px;" src="'.Yii::app()->request->baseUrl.'/images/plots/'.$plo['location'].'">';?>
<input id="image" type="file" name="location">
</p>
</div>
<div class="float-left" >
<p class="reg-left-text">Sketch<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5"> <?php echo' <img style="height:100px;" src="'.Yii::app()->request->baseUrl.'/images/plots/'.$plo['sketch'].'">';?>
<input id="image" type="file" name="sketch" >
</p>
</div>
  

    <input name="submit" value="Edit Plot" type="submit" class="btn-info pull-right" />

   
    </form>

 

 </div>

 </section>

<!-- section 3 -->

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



 <!--VALIDATION END-->



 

  $(document).ready(function()

     {  	

		

   
 $("#project").change(function()

           {

         	select_sector($(this).val());

		   });

		   

		  
    });

 

 
function select_plotno(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest6?val1="+id,
   contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
 $(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.plotno + "</option>";

});listItems+="";
$("#plotno").html(listItems);
          }

});

}

 $(document).ready(function()
     {  	
       $("#sector").change(function()
           {
         	select_street($(this).val());
		   });
     });


function select_street(id)
{
	var pro=$("#project").val();
	var sec=$("#sector").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest2?pro="+pro+"&&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='<option value="">Select Street</option>';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street_id").html(listItems);
          }
    });
}
function select_sector(id)

{

$.ajax({

      type: "POST",

      url:    "AjaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';
var listItems='<option value="">Select Sector</option>';
	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";

      



});listItems+="";



$("#sector").html(listItems);

          }

    });

}

</script>


<script>



function validateForm(){

	$("#error-project").hide();

	$("#error-street_id").hide();

	$("#error-plot_size").hide();

	$("#error-size2").hide();

	$("#error-plot_detail_address").hide();

	$("#error-com_res").hide();

	$("#error-cstatus").hide();

	$("#error-sector").hide();
    $("#error-price").hide();
	

	//	var x=document.forms["form"]["firstname"].value;

	var a = $("#project").val();

	var b = $("#street_id").val();

	var c = $("#plot_size").val();

	var d = $("#size2").val();

	var e = $("#plot_detail_address").val();

	var f = $("#com_res").val();

	var g = $("#cstatus").val();

	var h = $("#sector").val();

    var i = $("#price").val();
var counter=0;
if (a==null || a=="")
  {
  $("#error-project").html("Enter Project");
  $("#error-project").show();
  counter =1;
  }
if (b==null || b=="")
  {
  $("#error-street_id").html("Enter Street");
  $("#error-street_id").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-plot_size").html("Enter Plot Diemension");
  $("#error-plot_size").show();
  counter =1;
  }
  if (d==null || d=="")

  {

  $("#error-size2").html("Enter Plot Size");

  $("#error-size2").show();

  counter =1;

  }

    if (e==null || e=="")
  {
  $("#error-plot_detail_address").html("Enter Plot Number");
  $("#error-plot_detail_address").show();
  counter =1;

  }  

    if (f==null || f=="")

  {

  $("#error-com_res").html("Enter Plot Type");

  $("#error-com_res").show();

  counter =1;

  }     

    if (g==null || g=="")

  {

  $("#error-cstatus").html("Select Plot Status");

  $("#error-cstatus").show();

  counter =1;

  }     

     if (h==null || h=="")

  {

  $("#error-sector").html("Enter Plot Sector");

  $("#error-sector").show();

  counter =1;

  }
     if (i==null || i=="")

  {

  $("#error-price").html("Enter Plot Price");

  $("#error-price").show();

  counter =1;

  }     

 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>