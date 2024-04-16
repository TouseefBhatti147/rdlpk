<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>
$(function() {
$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>

<div class="">
<div class="shadow">
  <h3>Create Posession Request</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
<?php $projects_data = Yii::app()->session['projects_array']; ?>


    
    <?php 
$pages_data = Yii::app()->session['pages_array'];
?>
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
 <input type="text" value="" style="width:140px" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
 <input type="text" value="" style="width:130px" name="app_no" id="app_no" class="new-input" placeholder="Form #" />
 <input type="text" value="" style="width:160px" name="name1" id="name" class="new-input" placeholder="Enter Name" />
    <input type="text" value="" style="width:140px" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />
	    	<select name="project_name" id="project_name" style="width:180px;"><?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
             
       <?php echo CHtml::ajaxSubmitButton(
                                'Search',
     array('bcd/searchreq1/?page=1'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);

            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
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
                         array("id"=>"login","class" => "login-btn")      
                ); ?>
                 <input type="reset"  name="Reset" value="Reset" id="reset" />
<?php $this->endWidget(); ?>
                 <table class="table table-striped table-new table-bordered" style="font-size:11px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                       <th width="2%">SR No.</th>
                       <th width="5%">MS No.</th>
                        <th width="5%">Name</th>
                        <th width="4%">CNIC</th>
  						 <th width="4%">Plot Size</th>
                        <th width="2%">Plot No.</th>
                        <th width="5%">Street/Lane , Sector</th>
                        <th width="6%">Project</th>                           
		                <th width="5%">Action</th>
                    </tr>
                </thead>
              <tbody id="error-div">
				</tbody>
                  
</table>
<!------END Possession LIST---->

<!--VALIDATION START--> 

<script>
$(document).ready(function()
     {  	
	
           $("#plotno").change(function()
           { 
         	select_plot($(this).val());
		   });
		  
		    });
	
	var plot_id=$("#plot_id").val();
function select_plot(id,plot_id)
{
$.ajax({
      type: "POST",
     /// url:    "SelectPlot?val1="+id,
	  url:    "SelectPlot?val1="+id+"&&plot_id="+plot_id,
   contenetType:"json",
      success: function(jsonList){
	
		  var json = $.parseJSON(jsonList);
var listItems='';
var listname='';
var listcnic='';
var listaddress='';
var listproject='';
var listcom_res='';
var listplot_detail_address='';
var listsize='';
var liststreet='';
var listplotid='';
var possession='';
var building_type='';
var remarks='';
var msg1='';
var possession_status='';
 $(json).each(function(i,val){
 listItems+= '<img src="/rdlpk/upload_pic/' + val.image +'"/>';
 listname+= "" + val.name + "";
 listcnic+= "" + val.cnic + "";
 listaddress+= "" + val.address + "";
 listproject+= "" + val.project_name + "";
 listcom_res+= "" + val.com_res + "";
 listplot_detail_address+= "" + val.plot_detail_address + "";
 listsize+= "" + val.size + "";
 liststreet+= "" + val.street + "";
 listplotid+= "" + val.plot_id + ""; 
 possession+= "" + val.possession + "";
 remarks+= "" + val.remarks + ""; 
 building_type+= "<option value='" + val.building_type + "'>" + val.building_type + "</option>";
 possession_status+= "" + val.possession_status + "";
   
});listItems+="";
$("#image").html(listItems);
$("#name").val(listname);
$("#cnic").val(listcnic);
$("#address").val(listaddress);
$("#project").val(listproject);
$("#plot_detail_address").val(listplot_detail_address);
$("#com_res").val(listcom_res);
$("#size").val(listsize);
$("#street").val(liststreet);
$("#plot_id").val(listplotid);
 /* if(remarks !=''){
	$("#remarks").val(remarks);
	  }
  else{
	$("#remarks").val("");
	 // $("#remarks").val('');
	 remarks+="";
	  }
  if(building_type !='')
  {
	$("#building_type").html(building_type);
  }else{
	  $("#building_type").val('');
	  }*/
///alert(possession_status);	
if(possession_status=='1')
{
	$("#button").hide();
	$("#requested").show();
	$("#remarks1").hide();
	$("#building_type1").hide();
	document.getElementById("requested").style.visibility= "visible";
	
	}
	if(possession_status=='0')
{
	$("#button").show();
	$("#requested").hide();
	$("#remarks1").show();
	$("#building_type1").show();
	
	document.getElementById("requested").style.visibility= "hidden";
	
	}

if(json==''){ 	
	$("h5").html("No Record Found Agaisnt This Ms No.")
	$("#plotno").val('');
	
	 }else{
		 $("h5").html("")
		 }	  
 }	
 
});
}
 
</script>