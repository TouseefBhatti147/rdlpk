  
   
  
  <!-- shadow -->
<div class="row-fluid my-wrapper">
  <section class="login-section margin-top-30" style="font-size:13px;


border-radius: 3px;

box-shadow: 2px 3px 200px 0px #CCC;"> 
     <h4 style="color:#428BCA; text-align:center; "></br>
    <span style="margin-top:15px;">Member Login</span>
    </h4>
     <h4 style="color:red;">
  
  
    </h4>
      <hr noshade="noshade" class="hr-5 float-left">
 
    <!--<form name="login-form" method="post" action="">-->
   
    <div class="row-fluid">
      <div class="span12">
        
        <div class="">
        <div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
 
   <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'member_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); 

?>
         
          <div  style="float:left; border-right:1px solid; height:auto; padding-left:25px;"   class="span8">
       </br>
              <div class="float-left">
                 <label>Login ID/Email<font color="#FF0000">*</font></label></br> 
                 <input value="" name="username" id="username" placeholder="Enter Your Login ID/Email" type="text"  style="width:300px;">
               </br></br>
                  <label>Password<font color="#FF0000">*</font></label></br>
                  <input type="password" value="" name="password" id="password" placeholder="Enter Password"  style="width:300px;">
               </div></br></br>
                <div class="span3">     
                   <a class="btn-link" href="forgot_password">Forgot my password?</a></label>
                  </div>
            <div style="margin-left:40%">
            <?php echo CHtml::ajaxSubmitButton(
                               'Sign In' ,
    array('/member/getLogin'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#member_login_form").each(function(){ this.reset();});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
        
                                             if(data == 1){
												// alert("we are here");
                                         location.href ="dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "btn btn-success","style"=>"margin-bottom:5px;") ); ?> 
    
    <!--  </form>-->
    <?php $this->endWidget(); ?></div>
   
                      <div class="span12">     
                   <a class="btn-link" href="activate_account1">Already a member? Click here to Request For Login Access</a></label>
                  </div>
          </div>
          
 
 
 
          <div  style="float:right;  height:175px;"   class="span4">
        
     
  
       
     
        <div>     
                   <a class="btn-link span12" href="#">For any assistance, please write us at support@rdlpk.com</a></label>
                  </div>
          </div>
          
              
         
        </div>
      </div>
    </div>
   
  </section>
 
  </div>
 