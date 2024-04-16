<style>
.reg-login-text-field{
	
	width:180px;}
	select{
		
		width:180px;}
		.reg-login-text-field11{
			width:50px;}
			
.black-bg {
	background:#333;
	color:#fff;
	width:20%;
	float:left;
	padding:5px 10px;
	margin:2px 0px;
}
.grey-bg {
	background:#CCC;
	color:#000;
	width:71%;
	height:20px;
	padding:5px 10px;
	float:left;
	margin:2px 0px;
}
.left-box {
	float:left;
	border:1px solid #ccc;
	padding:0 5px;
	margin:0 5px;
}
.bot-box {
	background: none repeat scroll 0 0 #6699FF;
	border-radius: 10px;
	clear: both;
	color: #FFFFFF;
	height: 164px;
	margin: 30px auto;
	padding: 20px;
	position: relative;
	top: 30px;
	width: 55%;
}
.new-box-01 {
	float: left;
	width: 50%;
	margin-bottom:40px;
}

</style>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {
$( "#next_visit" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

</script>
<script>
function show(){
	
//	document.getElementById("");
	if(parseInt($("#followup_status").val())==1)
	{
		$("#vdate").show();
	}
	else
	{
		$("#vdate").hide();
	}
	
	}
</script>
<div class="">
<div class="shadow">
  <h3> Add Follow Up</h3>
</div>
<!-- shadow --> <div class="clearfix"></div>
   
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
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

<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  <?php foreach($visitors as $vis){
	  
	  
	  ?>
     <input type="hidden" value="<?php echo $vis['vdid'];?>" name="id" id="id" class="reg-login-text-field" />
 
    <div class="span5">
    <span style="font-size:14px; float:left">Personal Detail</span> <br />
      <div class="black-bg">Name:</div>
      <div class="grey-bg"> <?php echo $vis['vname'];?></div>
      <br>
      <div class="black-bg">Profession:</div>
      <div class="grey-bg"><?php echo $vis['profession'];?></div>
      <br>
      <div class="black-bg">Email:</div>
      <div class="grey-bg"><?php echo $vis['email'];?></div>
      <br>
       <div class="black-bg">Contact No:</div>
      <div class="grey-bg"><?php echo $vis['contactno'];?></div>
      <br>
     <div class="black-bg">City:</div>
      <div class="grey-bg"><?php echo $vis['city'];?></div>
      <br>
     <div class="black-bg">Reffered By:</div>
      <div class="grey-bg"><?php echo $vis['refered_by'];?></div>
      <br>
     <div class="black-bg">Reference:</div>
      <div class="grey-bg"><?php echo $vis['reference'];?></div>
      <br>
     <div class="black-bg">Contact No:</div>
      <div class="grey-bg"><?php echo $vis['contactno'];?></div>
      <br>
    </div><span style="font-size:14px; float:inherit;">Property Detail</span><br />
     <div class="span5">
      <div class="black-bg">Visit Date:</div>
      <div class="grey-bg"> <?php echo $vis['visit_date'];?></div>
      <br>
      <div class="black-bg">Visit Type:</div>
      <div class="grey-bg"><?php echo $vis['visit_type'];?></div>
      <br />
    </div>
<?php $connection = Yii::app()->db;
		$booking  = "SELECT interest_booking.*,size_cat.size FROM interest_booking 
		Left JOIN size_cat ON (size_cat.size = interest_booking.size2)
		where visitors_id='".$vis['visitors_id']."' ";
		$bookingres = $connection->createCommand($booking)->queryRow();
		?>
          <div class="span5">
      <div class="black-bg">Property Type:</div>
      <div class="grey-bg"> <?php echo $bookingres['com_res'];?></div>
      <br>
      <div class="black-bg">Interest :</div>
      <div class="grey-bg"><?php echo $bookingres['type'];?></div>
      <br />
     
    </div>
  <div class="float-left" >
  <p class="reg-left-text">Status<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <select id="followup_status" name="followup_status" onchange="show()">
   <option value="">Select Status</option>
    <option value="2">Approved</option>
   <option value="1">Next Visit</option>
   <option value="0">Rejected</option>
   </select>
     </div>
   <div id="vdate" class="float-left" >
  <p class="reg-left-text">Next Visit<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="" name="next_visit" id="next_visit" class="reg-login-text-field" /> </p>
  </div>
   
 
  
  <!--Visitors Detail End-->
 
  <div class="clearfix"></div>
 
 
   <?php }?>
  
  <?php echo CHtml::ajaxSubmitButton(
                         'Add Follow Up',
    array('visitors/add_follow'),
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

 </section>
<!-- section 3 -->
<!--VALIDATION START-->
<script>
$(document).ready(function(e) {
	$("#vdate").hide();
});
</script>
