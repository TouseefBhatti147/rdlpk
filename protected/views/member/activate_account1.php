<div class="row-fluid my-wrapper"> 
  <section class="login-section margin-top-30" style="font-size:13px;


border-radius: 3px;

box-shadow: 2px 3px 200px 0px #CCC;"> </br>
   <h4 style="color:#428BCA; text-align:center;">
    Activate Login Account
    </h4>  </br>
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
          <ul><li>To activate login account for member portal (<span style="color:red;">Registered Members only</span>) fill down below information:</li>
       
          </ul>  
               </br>  
             <div class="float-left">
          
                  <label>CNIC<font color="#FF0000">*</font> &nbsp;&nbsp;&nbsp; (Without Dashes)</label><br />
                  <input style="width:300px;" type="text" value="" class="span9" name="cnic" id="cnic" placeholder="Enter your CNIC" >
               </div>  <br />  <br />
                    
             <div class="float-left">
          
                  <label>Choose User name<font color="#FF0000">*</font></label><br />
                  <input style="width:300px;" type="text" value="" class="span9" name="username" id="username" placeholder="Enter your User Name" >
               </div>  <br />  <br />
                    
             <div class="float-left">
          
                  <label>Email<font color="#FF0000">*</font></label><br />
                  <input style="width:300px;" type="email" value="" class="span9" name="email" id="email" placeholder="Enter your Email" >
               </div>  <br />  <br />
                         
             <div class="float-left">
          
                  <label>Choose Password<font color="#FF0000">*</font></label><br />
                  <input style="width:300px;" type="text" value="" class="span9" name="password" id="password" placeholder="Choose your Password" >
               </div>  <br />  <br />
                    
             <div class="float-left">
          
                  <label>Enter Message<font color="#FF0000">*</font></label><br />
                  <textarea name="message" style="width:300px;" id="message" class="span9" ></textarea>
               </div>  
          
              
            
              
          </div> 

        </div>&nbsp;
        
        
        
           
      </div>                <div class="span6">    <div style="margin-left:50%">       <?php echo CHtml::ajaxSubmitButton(
                               'Send Request' ,
    array('/member/activate_account'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#activate").attr("disabled",false);
            }',
                                         'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){ });

                                             $("#submit").attr("disabled",false);

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
    
         
    </div> </div></div><div class="span6"></div>
    </div>  <br />

  </section>
  
  <!-- section 3 --> 
</div>
