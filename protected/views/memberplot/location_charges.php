<div class="shadow">
  <h3>Plot Pricing</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>
			<?php 
      $basic_price=0;
      $extra_land_price=0;
			$connection=yii::app()->db;
           $query="SELECT * FROM plots WHERE id='".$_GET['id']."'";
		   $result=$connection->CreateCommand($query)->queryRow();
		   
            ?>

  <div class="float-left">
    <p class="reg-left-text">Basic PLot Price<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="number" value="<?php echo $result['basic_price'];?>" name="basic_price" id="basic_price" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Extra land Price<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="number" value="<?php echo $result['extra_land_price'];?>" name="extra_land_price" id="extra_land_price" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Plot Price(Basic + Extra Land)<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="number" value="<?php echo $result['price'];?>" name="price" id="price" class="reg-login-text-field" />
    </p>
  </div>
          <div class="float-left">
    <p class="reg-left-text">Prime Location Charges<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $result['PLcharges'];?>" name="PLcharges" id="PLcharges" class="reg-login-text-field" />
    </p>
  </div><?php if($result['extra_land_price']=='')
       {
        $extra_land_price=0;
       }else{
        $extra_land_price=['extra_land_price'];
       }
       if($result['basic_price']=='')
       {
        $basic_price=0;
       }else{
        $basic_price=$result['basic_price'];
       }

      // $actualprice=($extra_land_price+$price);?>
<div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
    <input name="actual_price" id="actual_price" value="<?php  echo $result['basic_price']+$result['extra_land_price'] ; ?>"  type="hidden" placeholder="" class="reg-login-text-field" >   
   <input name="remarks" id="remarks" value="<?php echo $result['remarks'];?>"  type="text" placeholder="" class="reg-login-text-field" >
    </p>
  </div>
  <?php ?>
     <input type="hidden" name="id" id="id" value="<?php   echo $_GET['id'];?>" />
  <?php echo CHtml::ajaxSubmitButton(
                                'Update Pricing',
    array('locationch'),
                   array( 
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ this.reset();});
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
                         array("id"=>"login","class" => "btn-info pull-right")); ?>

  <?php $this->endWidget(); ?>
 
  		
          