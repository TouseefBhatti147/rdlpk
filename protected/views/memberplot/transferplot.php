<div class="container-fluid" style="font-size:12px; background:#FFF;">

<style> .float-left1 {

	 width: 400px;

    float: left;

    margin-left: 20px;

}
input{width: 200px;
padding: 3px;}</style>

<div class="row-fluid">

<div class="shadow">
<?php
 if($plotdetails['com_res']=='Commercial'){$type='C'; }else{$type='R';}

if($plotdetails['mmtype']=='Dealer'){echo ' <h3>Change Owner</h3>
';}else{echo ' <h3>Plot Transfer Form</h3>
';}
?>
 
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

<section class="reg-section margin-top-30">


  <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>

<div class="span12">
  <div class="span6">
<h4 style="text-align:left;">Plot Details</h4> 
  	<b>Plot No:</b> <?php echo $plotdetails['plot_detail_address']?>
    <input type="hidden" value="<?php echo $plotdetails['plot_id']?>" name="plot_id" id="plot_id" class="f-left span4 clearfix" /><br />
  	<b>Street:</b>
    <?php echo $plotdetails['street']?><br>
  	<b>Plot Size:</b>
    <?php echo $plotdetails['plot_size']?><br>
  	<b>Project Name:</b>
    <?php echo $plotdetails['project_name']?><br>
  </div>
<div class="span6" style="font-size:14px;">
<?php 
if($plotdetails['mmtype']=='Dealer'){echo ' <h4 style="text-align:left;">Dealer Info </h4>

';}else{echo ' <h4 style="text-align:left;">Transfer From </h4>

';}
?>
  <div class="float-left">
    <input type="hidden" value="<?php echo $plotdetails['member_id']?>" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />
      <b>Name:</b> <?php echo $plotdetails['name'].' <br><b>S/o D/O W/O:</b> '.$plotdetails['sodowo'];?>
  </div>
</div>
<div class="span6 pull-right">
<hr noshade="noshade" class="hr-5">
  
  
</div>
 <table class="table table-striped table-new table-bordered" style="font-size:16px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                         <th width="8%">Transfer To</th>
                        <th width="8%"></th>
                        
                    </tr>
                </thead>
               <tr><td>Transfer To</td><td><input style="width:300px;" type="text" value="" name="cnic" id="cnic" class="text" /></td></tr>
   <tr><td>Membership Number</td>
   <td>
     <?php $va='';if($plotdetails['mmtype']=='Dealer'){$va=$plotdetails['plotno'];}
	 if($va==''){
	 ?>
   <input type="hidden" value="<?php //echo $plotdetails['code'] ?>" name="procode" id="procode" class="reg-login-text-field" style="width:60px;"  readonly/> 
   <input type="text" value="<?php echo $plotdetails['plotno'];?>" name="tempms" id="tempms" class="reg-login-text-field" style="width:140px;" />
   <input type="hidden" value="<?php //echo $type.$plotdetails['scode']; ?>" name="sizecode" id="sizecode" class="reg-login-text-field" style="width:60px;" readonly/><?php }else{ echo ' <input type="text" value="'.$va.'" name="tempms" id="tempms" class="reg-login-text-field"  readonly/>';}?>
   
   </td></tr>
</tbody>
</table>

<div class="clearfix"></div>
   <?php echo CHtml::ajaxSubmitButton(
                                'Transfer Plot',
    array('RequestTransfer'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#plots").each(function(){ });
                                             $("#submit").attr("disabled",false);
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
                         array("id"=>"submit","class" => "btn-info pull-right")      
                ); ?>
  <?php $this->endWidget(); ?>

 

  

 <div class="clearfix"></div>

 

<script>



function validateForm(){

	$("#error-name").hide();

	
	$("#error-sodowo").hide();

	$("#error-cnic").hide();

	$("#error-cnic1").hide();

	$("#error-email").hide();

	$("#error-email1").hide();

	

//	var x=document.forms["form"]["firstname"].value;

var x = $("#name").val();



var z = $("#sodowo").val();

var a = $("#cnic").val();

var b = $("#email").val();



var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

var phoneno = /^\d{13}$/;



var counter=0;



if (x==null || x=="")

  {

  $("#error-name").html("Name must be filled out");

  $("#error-name").show();

  counter =1;

  }



if (z==null || z=="")

  {

  $("#error-sodowo").html("SODOWO must be filled out");

  $("#error-sodowo").show();

  counter =1;

  }

 if (!a.match(phoneno))

  {  

  $("#error-cnic").html("Invalid CNIC");

  $("#error-cnic").show();

  counter =1;

  }

if (a==null || a=="")

  {  

  $("#error-cnic").html("CNIC must be filled out");

  $("#error-cnic").show();

  counter =1;

  }

 if (!filter.test(b))

  {  

  $("#error-email").html("Invalid Email");

  $("#error-email").show();
  counter =1;
  } 
if (b==null || b=="")
  {  
  $("#error-email").html("Email must be filled out");
  $("#error-email").show();
  counter =1;
  }  
  if(counter==1)
  	return false;
}
</script> 
 </section>
<!-- section 3 --> 
 <div class="clearfix"></div>
 </div> 
 </div>