<div class="">
<style>
input{ margin-bottom:3px !important}
p{ margin:0px !important}
</style>


<section class="reg-section margin-top-30">

  <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots',
 'enableAjaxValidation'=>false,
'htmlOptions' => array('enctype' => 'multipart/form-data'),
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
				'stateful'=>true, 
	            'validateOnType'=>false,),
)); ?>
  <?php $res=array();
            foreach($plots as $plo){?>
		
	<?php 
		if(isset($_REQUEST['type']) && $_REQUEST['type']!=='' ){
			echo '  <input value="'.$_REQUEST['type'].'" name="ftype" id="ftype" type="hidden" />';
			}
	
	?>	
  <div class="shadow">

  <h3>Applicant Information</h3>

</div>

<!-- shadow -->


  
    <div class="clearfix"></div>
      Project : <b><?php echo $plo['project_name'];?></b>
   
   
   <div style=" float:right; background-color:#000; color:#FFF; font-weight:bold; padding:5px; border:1px solid #000; "> <?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div><div style="float:right; background:#FFF; border:1px solid #000; color:#000; padding:5px;">Form No.:</div>
  <hr noshade="noshade" class="hr-5 ">
 <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['name'];?>" name="name" id="name" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Father/Spouse Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['sodowo'];?>" name="sodowo" id="sodowo" type="text" />
</p>
 </div>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script> 
 <script type="text/javascript">



function testPhone(objNpt){



 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits



 if (n.length!=13) {



  document.getElementById('rsp').innerHTML="Please Enter 13 Digit CNIC Number without spaces/Slashes !";



  return;}



  document.getElementById('rsp').innerHTML=""; 



 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number



}



</script> 
 <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input onBlur="testPhone(this)" value="<?php echo $plo['cnic'];?>" name="cnic" id="cnic" type="text" />
</p> <p id="rsp" style="color:#F00;"></p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Phone(Office)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['phone'];?>" name="phone" id="phone" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Phone(Residence)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['phoneres'];?>" name="phoneres" id="phoneres" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Mobile<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['mobile'];?>" name="mobile" id="mobile" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['email'];?>" name="email" id="email" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Country<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="country" id="country">
      <?php if(empty($plo['country'])){ ?>
        <option value="">Select Country </option>
        <?php	}else{echo ' <option value="'.$plo['cuid'].'">'.$plo['country'].'</option>'; }



            $res=array();



            foreach($country as $key){



            echo '<option value="'.$key['id'].'">'.$key['country'].'</option>'; 



            }?>
      </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">City<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="city_id" id="city_id">
      
        <?php if(empty($plo['city'])){ ?>
        <option value="">Select Country </option>
        <?php	}else{echo ' <option value="'.$plo['cid'].'">'.$plo['city'].'</option>'; }?>
      </select>
    </p>
  </div>
 <div class="float-left">
    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['address'];?>" name="address" id="address" type="text" />
</p>
 </div>
 
 <div class="float-left">
    <p class="reg-left-text">Profession<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <select name="profession" id="profession">
   <?php if(!empty($plo['profession'])){ echo'<option value="'.$plo['profession'].'">'.$plo['profession'].'</option>';}?> 
    <option>---N/A---</option>
<option>Businessman</option>
<option>Army Servant</option>
<option>Govt. Employee</option>
<option>Private Employee </option>
<option>Engineer </option>
<option>Doctor</option>
<option>Teacher /  Professor</option> 
<option>Lawyer /  Advocate     </option>
<option>Journalist</option>
<option>Politician </option>
<option>Artist</option>
<option>Farmer / Landlord</option>
<option>Others</option> 
      
    </select>
</p>
 </div>

 
  <div class="clearfix"></div>
 
	<h3>Payment Information</h3>
	
				
 <?php    echo '
      <input type="hidden" value="'.$plo['id'].'" name="form_id" id="form_id" class="reg-login-text-field" />
	  <input  value="'.$plo['project_id'].'" type="hidden" name="project_id" id="project_id" />
	  ';

   
  
            ?>
   
      <input value="<?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'];?>"  name="formno" id="formno" type="hidden" />
   <div class="float-left">
    <p class="reg-left-text">Paid Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
<script>  function testAmount(objNpt){



 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits



 



  



  document.getElementById('rsp').innerHTML=""; 



 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number



}</script>
    <?php echo   ' <input onBlur="testAmount(this)"  value="'.$formpayment['amount'].'" name="paidamount" id="paidamount" type="text" />';
	 $connection = Yii::app()->db; 
	if($plo['mscharges']!=='0'){
	$sql_pay = "SELECT * from installform where form_id='".$plo['id']."' and type='membership'";
	 $result_pay = $connection->createCommand($sql_pay)->queryRow();
	 }else{$result_pay['paidas']='';
	 $result_pay['detail']='';
	 $result_pay['remarks']='';
	  $result_pay['sdid']='';
	   $result_pay['ststatus']='';
	   $result_pay['date']=date('d-m-Y');
	 }
	?>
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Paid As<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="paidas" id="paidas">
     <?php if($plo['mscharges']=='1'){ ?> 
     <option value="<?php echo $result_pay['paidas']?>"><?php echo $result_pay['paidas']?></option>   
     <?php }else{?>
      <option value="">Select Payment Mode</option> <?php }?>
    <option value="cash">Cash</option>
    <option value="cheque">Cheque</option>
    <option value="po">Pay Order</option>
     <option value="online">Online</option>
    </select>
</p>
 </div> <div class="float-left">
 <p class="reg-left-text">Mode<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="typer" >
     <option value="<?php echo $result_pay['ststatus']; ?>"><?php echo $result_pay['ststatus']; ?></option>
     <option value="Dealer">Dealer</option>
     <option value="Walk-in">Walk-in</option>
     </select>
 </p>
 </div><div class="float-left">
 <p class="reg-left-text">Sub Dealer<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php
   
	$cond='';
	//if($plo['seller_id']!==''){$cond="where mdealer='".$plo['seller_id']."'";}
    $sql_member1= "SELECT * FROM sdealer";
		$result_members1 = $connection->createCommand($sql_member1)->query();
	$sql_membern= "SELECT * FROM installform where form_id='".$plo['id']."' and type='membership'";
		$result_membern = $connection->createCommand($sql_membern)->queryRow();
	
    $sql_memberss= "SELECT * FROM sdealer where id='".$result_membern['sdid']."'";
		$result_membersss = $connection->createCommand($sql_memberss)->queryRow();
	?>
     <select name="sdealer" >
     <option value="<?php echo $result_membersss['id']; ?>"><?php echo $result_membersss['name']; ?></option>
     <?php foreach($result_members1 as $row1){echo '<option value="'.$row1['id'].'">'.$row1['name'].'</option>';} ?>
     </select>
 </p>
 </div>

 <div class="float-left">
    <p class="reg-left-text">Reference(PO/DD/Cheque)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input name="detail"  type="text" placeholder="Enter detail" id="detail" value="<?php echo $result_pay['detail']?>">
    </p>
  </div>
  <div class="float-left">
      <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input name="date" type="text" class="hasDatepicker" id="todatepicker" value="<?php echo $result_pay['date'] ?>">
      </p>
    </div>
 <div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="remarks" id="remarks" type="text" value="<?php echo $result_pay['remarks']?>" />
</p>
 </div>
  
 
   <?php }?>
    <?php echo CHtml::ajaxSubmitButton(
                         'Save Membership',
    array('forms/updatemembership'),
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
                                        }' ),
									 array("id"=>"login","class" => "btn-info pull-right")      ); ?>
  <?php $this->endWidget(); ?>
 </div>
 </section>
 
   
 
   

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

 <script>

  $(document).ready(function()
   {  	
       $("#cnic").keyup(function()
      {
      	select_street($(this).val());
	   });
    });
function select_street(id)
{
$.ajax({
   type: "POST",
   url:    "check?cnic="+id,
	  contenetType:"json",
 success: function(jsonList){var json = $.parseJSON(jsonList);
var st='';
var name='';
var listItems='';
var sodowo= '';
	var phone= ''; 
	var phoneres= ''; 
	var mobile= ''; 
	var email= ''; 
	var address= ''; 
	$(json).each(function(i,val){
		if(val!==''){
			st=1;
	name= val.name;
	sodowo= val.sodowo;
	phone= val.phone; 
	phoneres= val.phoneres; 
	mobile= val.mobile; 
	email= val.email; 
	address= val.address; 
	listItems+= "<option value='" + val.profession + "'>" + val.profession + "</option>";}
});
if(st!==''){$("#profession").html(listItems);
var elem = document.getElementById("name");
elem.value = name;
var elem = document.getElementById("sodowo");
elem.value = sodowo;
var elem = document.getElementById("phone");
elem.value = phone;
var elem = document.getElementById("phoneres");
elem.value = phoneres;
var elem = document.getElementById("mobile");
elem.value = mobile;
var elem = document.getElementById("email");
elem.value = email;
var elem = document.getElementById("address");
elem.value = address;
}

          }
		  
    });
	

}
 $("#country").change(function()
 		{
         	select_city($(this).val());
		   });
function select_city(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest3?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.city +" </option>";
});listItems+="";
$("#city_id").html(listItems);
          }
});
}
		   
</script> 