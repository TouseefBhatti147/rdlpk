<div class="row-fluid my-wrapper">
  <section class="login-section margin-top-30" style="font-size:13px;

border: 1px solid #ccc;
border-radius: 10px;

box-shadow: 2px 3px 27px #CCC;"> 
     <h4 style="color:#428BCA; text-align:center; ">
    Forgot Password
    </h4>
     <h4 style="color:red;">
  
  
    </h4>
      <hr noshade="noshade" class="hr-5 float-left">
 

  
    <!--<form name="login-form" method="post" action="">-->
    <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'member_login_form1',
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
    <div class="row-fluid" style="margin-left:10px;" >
      <div style="float:left;"   class="span12">
        
        <div class="">
        <div id="error-div1" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

          <div class="area">
        
             <strong><u></u></strong>
          <ul><li>If you have forgotten your password and would like to reset please fill following form.an email will be sent to your email address:</li>
       
          </ul>  
                 
             <div class="float-left">
          
                  <label>CNIC<font color="#FF0000">*</font></label><br />
                  <input  type="text" value="" style="width:300px;" name="cnic" id="cnic" placeholder="Enter your CNIC" >
               </div>  <br />  <br />
                    
             <div class="float-left">
          
                  <label>Choose User name<font color="#FF0000">*</font></label><br />
                  <input  type="text" value=""  style="width:300px;" name="username" id="username" placeholder="Enter your User Name" >
               </div>  <br />  <br />
                           
             <div class="float-left">
          
                  <label>Email<font color="#FF0000">*</font></label><br />
                  <input  type="email" value=""  style="width:300px;" name="email" id="email" placeholder="Enter your Email" >
               </div>  <br />  <br />
             <div class="float-left">
          
                  <label>Choose Password<font color="#FF0000">*</font></label><br />
                  <input  type="text" value=""  style="width:300px;" name="password" id="password" placeholder="Choose your Password" >
               </div>  <br />  <br />
                    
             <div class="float-left">
          
                  <label>Enter Message<font color="#FF0000">*</font></label><br />
                  <textarea name="message" style="width:300px;" id="message"  ></textarea>
               </div>  
          
              
            
              
          </div> 

        </div>&nbsp;
           
      </div> <div class="span6">    <div style="margin-left:35%">         <?php echo CHtml::ajaxSubmitButton(
                               'Send Request' ,
    array('/member/forgot_password_add'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#activate").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#member_login_form1").each(function(){});
                                             $("#activate").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
        
                                             if(data == 1){
												// alert("we are here");
                                         location.href ="dashboard";
                                      }
          else{
                                                $("#error-div1").show();
                                                $("#error-div1").html(data);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"activate","class" => "btn btn-success") ); ?> 
    
    <!--  </form>-->
    <?php $this->endWidget(); ?>
    </div> </div></div><div class="span6"></div> <br />

   </section>
 
  </div>
