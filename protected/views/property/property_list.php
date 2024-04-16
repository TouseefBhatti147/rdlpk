<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
$(function(){
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/property/searchreq1",
                  type:"POST",
                data:$("#user_login_form").serialize() + "&&page=1",
        cache: false,
        success: function(response){
		     $('#loading').hide();
		  $('#error-div').html(response);
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"http://<?php echo $address ?>/index.php/property/searchreq1",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
          data:$("#user_login_form").serialize()+"&&page="+$page,
		cache: false,
        success: function(response){
			  $('#loading').hide();
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
}); 
</script>
<div class="shadow">

  <h3>Advance Search:Property</h3>
  
</div>
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
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
     			<select name="com_res" id="com_res"  style="width:180px;"><option value="">Select Property Type</option><option value="Res">Residential</option><option value="Com">Commercial</option></select>
            <span>Size:</span>
    <select name="size" id="size"  style="width:180px;"><?php 
			if(!empty($size)){echo '<option value="'.$size.'">'.$size.'</option>'; }else{
				echo '<option value="">Select Size</option>';
				}
			$res=array();
            foreach($sizes as $siz){
            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 
            }?></select> 
			 
<input type="text" value="<?php if($plotno!=''){echo $plotno; }?>" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />
     <span>Status:</span>
    <select name="stat" id="stat" style="width:180px;">
    <option value="">Select Status</option>
    <option value="1">Re-allocated</option>
    <option value="2">Alloted</option>
    <option value="3">Not Allotted(Open)</option>
    <option value="4">Reserved</option>
       
    </select>


 <span>Reserver for:</span>
 
 <select name="ctag" id="ctag" style="width:180px;">
				<option value="">Please Select </option>
 			<option value="HRL Reserved">HRL Reserved</option>
<option value="Against Land">Against Land</option>
<option value="Villas">Villas</option>
  </select>
<span>Membership #</span>
<input type="text" placeholder="Membeship #" class="new-input" id="plotno1" name="plotno1" value="">
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
     array('/property/searchreq1/?page=1'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
											  $("#loading").show();
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
											$("#login").attr("disabled",false);
											 $("#loading").hide();
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
        								    if(data == 1){
												// alert("we are here");
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
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
                        <th width="4%">Unit No</th>
                         <th width="4%">Building</th>
                        <th width="4%">Floor</th>
                        <th width="6%">P Status</th>
                        <th width="5%">Status</th>
                    	 <th width="5%">B.Status</th>                        
         				<th width="7%">Action</th>
                         </tr>
                </thead>
                <tbody id="error-div">
                </tbody>
            </table>
  </div>
<hr noshade="noshade" class="hr-5 float-left">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
