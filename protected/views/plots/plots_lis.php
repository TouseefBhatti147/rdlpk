<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
   $('#loading').hide();
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"https://<?php echo $address ?>/index.php/plots/searchreq121",
                  type:"POST",
                data:$("#user_login_form").serialize() + "&&page=1",
        cache: false,
        success: function(response){
		   
		  $('#error-div').html(response);
		  
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"https://<?php echo $address ?>/index.php/plots/searchreq",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
          data:$("#user_login_form").serialize()+"&&page="+$page,
		cache: false,
        success: function(response){
            
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>
<div class="shadow">

  <h3>Advance Search:Plots <?php if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username']))
{?>
<span style="float:right;"><a href="plots_allocation_summary"><input type="button" class="btn btn-info" name="" value="Plots Allocation Summary"></a></span>
<span style="float:right; margin-left:10px;"><a href="unsold_residential"><input type="button" class="btn btn-info" name="" value="Unsold Plots"></a></span> 
<span style="float:right;"><a href="plots_status"><input type="button" class="btn btn-info" name="" value="Plots Status"></a></span>
<?php }?></h3>
<h4 style="float:right;"><a href="plots_report">Plots Report</a></h4>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">



<!--<form name="login-form" method="post" action="">-->
<?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'user_login_form',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',

                'clientOptions'=>array(

                     'validateOnSubmit'=>true,

                     'validateOnChange'=>true,

                     'validateOnType'=>false,

  ),

)); ?>









<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

    <span>Project:</span>

    	<select name="project" id="project" style="width:180px;"><?php	
	if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
          
 <select name="type" id="type" style="width:180px;">
    <option value="">Select Type(Plot/Villa)</option>
    <option value="Plot">Plot</option>
    <option value="Villa">Villa</option>
  </select>

<span>Sector:</span>
    <select name="sector" id="sector"  style="width:180px;"><?php 
	if($sector!=''){echo '<option value="'.$sector.'">'.$sector.'</option>'; }else{
				echo '<option value="">Select Sector</option>';
				}
			$res=array();
            foreach($sectors as $sec){
            echo '<option value="'.$sec['id'].'">'.$sec['sector_name'].'</option>'; 
            }?></select> 
			    
    <span >Street:</span>

   <select style="width:180px;" name="street_id" id="street_id" >

	<?php
			if($st!=''){echo '<option value="'.$st.'">'.$st.'</option>'; }
  	?>
   <option value="">Select Street</option>
  <option value="street">street</option>
    </select> 
    <span>Type:</span>
     			<select name="com_res" id="com_res"  style="width:180px;"><option value="">Select Property Type</option><option value="R">Residential</option><option value="C">Commercial</option></select>
            <span>Size:</span>
    <select name="size" id="size"  style="width:180px;"><?php 
			if(!empty($size)){echo '<option value="'.$size.'">'.$size.'</option>'; }else{
				echo '<option value="">Select Size</option>';
				}
			$res=array();
            foreach($sizes as $siz){
            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 
            }?></select> 
			 
<input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="new-input" placeholder="Enter Plot No" />

     <span>Status:</span>
    <select name="stat" id="stat" style="width:180px;">
    <option value="">Select Status</option>
    <option value="1">Re-allocated</option>
    <option value="2">Alloted</option>
    <option value="3">Not Allotted</option>
    <option value="4">Reserved</option>
    <option value="5">Open</option>
    <option value="6">Under Transfer</option>
    <option value="7">Under Allotment</option>
       
    </select>


 <span>Reserver for:</span>
 
 <select name="ctag" id="ctag" style="width:180px;">
				<option value="">Please Select </option>
 			<option value="HRL Reserved">HRL Reserved</option>
<option value="Against Land">Against Land</option>
<option value="Villas">Villas</option>

  </select> 
  <!--<span>Against Land: </span><input name="atype"  type="checkbox"  class="new-input" id="atype">---->
<span>Membership #: </span>
<input type="hidden" value="" name="procode" id="procode" class="reg-login-text-field" style="width:60px;"  readonly/>
<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
<div style="float:right; background-color:#cbc2c4;margin-right:600px;margin-top:10px;">
<input style="float:left; margin-right:10px; margin-left:10px;"   id="onpayments" name="onpayments" type="checkbox"	value="" />	<label for="checkbox" style="float:left;">On Payments</label>
<input style="float:left; margin-right:10px; margin-left:10px;"   id="al" name="al" type="checkbox"	value="" /><label for="checkbox" style="float:left;">Against Land</label>
<input style="float:left; margin-right:10px; margin-left:10px;"   id="foc" name="foc" type="checkbox"	value="" /><label for="checkbox" style="float:left;">FOC</label>
          </div>
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
<img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">
 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('/plots/searchreq/?page=1'),
                                array(  

                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);
                                              $("#loading").show()

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});

                                             $("#login").attr("disabled",false);
                                             $("#loading").hide();
                                        }',

                   'success'=>'function(data){  

                                           //  var obj = jQuery.parseJSON(data); 

                                            // View login errors!

        
                                           ;
                                             if(data == 1){

												// alert("we are here");

                                         location.href = "httpss://rdlpk.com/index.php/user/dashboard";

                                      }

          else{

                                                $("#error-div").show();

                                                $("#error-div").html(data);$("#error-div").append("");

												return false;

                                             }

 

                                        }' 

    ),

                         array("id"=>"login","class" => "btn btn-info")      

                ); ?>

  



<!--  </form>-->

<?php $this->endWidget(); ?>



</section>

</div>

<!-- section 3 --> 









 

  



  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />

    -->





  </form>

<div class="clearfix"></div>

  <div class="">
           <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                        <th width="7%"> Membership #</th>

                        <th width="8%">Project</th>

                       

                        

                        <th width="5%">Plot Size</th>

                        <th width="5%">Dimension</th>

                        <th width="6%">Type</th>
                        <th width="4%">Plot No</th>
                         <th width="4%">Street</th>

                        <th width="4%">Sector</th>

                        <th width="6%">P Status</th>
                        <th width="5%">Status</th>
                    	 <th width="5%">B.Status</th> 
                        <th width="5%">Allotment Type</th> 
           
						<th width="7%">Action</th>

                    

                        </tr>



                </thead>



                <tbody id="error-div">
                </tbody>



            </table>



 			



  	



  </div>

<hr noshade="noshade" class="hr-5 float-left">



  



  



 



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

 

 <script>

 

 

 



  $(document).ready(function()
     {  	
       $("#project").change(function()
           {
         	select_sector($(this).val());
		   });
		   
		     	 $("#com_res").change(function()

           {
         //  select_plan($(this).val());

         	var pro=$("#project").val();
			var street=$("#street_id").val();
			var size=$("#size_id").val();
			var sector=$("#sector").val();
			var pptype=$('#pptype').val();
	select_size(this.value);
		  
		    }); 
		   
     });

var sid=$("#com_res").val();
			function select_size(id)
{
			$.ajax({
      type: "POST",
      url:    "ajaxRequest123?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
		var listItems='';
		listItems+= "<option value=''>Select Size</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.size +" </option>";
    });listItems+="";
	$("#size").html(listItems);
          }
});}
function select_sector(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Sector</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector").html(listItems);
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


</script>