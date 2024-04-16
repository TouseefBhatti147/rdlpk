<div class="row-fluid my-wrapper">
  <div class="shadow">
    <h3>
    Member Login Form
    </h1>
  </div>
  <!-- shadow -->
  <hr noshade="noshade" class="hr-5 float-left">
  <section class="login-section margin-top-30" style="font-size:13px;width: 400px;
height: auto;
margin: 20px auto;
border: 1px solid #ccc;
border-radius: 10px;
padding: 20px 50px;
width: 520px;
box-shadow: 2px 2px 2px #CCC;"> 
    
    <!--<form name="login-form" method="post" action="">-->
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
    <div class="row-fluid">
      <div class="span12">
        
        <div class="">
        <div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

          <div class="area">
        
             <div class="float-left">
                 <label>Username<font color="#FF0000">*</font></label></br> 
                 <input value="" name="username" id="username" placeholder="Enter Your Email" type="text"  class="span9"></br></br></br>
               </div>
             <div class="float-left">
                  <label>Password<font color="#FF0000">*</font></label></br>
                  <input type="password" value="" name="password" id="password" placeholder="**********"  class="span9">
               </div></br></br>
            <div class="float-left">     
                   <a class="btn btn-link" href="#">Forgot my password</a></label>
                 
                  </div>
                
             
           
          </div>
        </div>
      </div>
    </div>
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
                         array("id"=>"login","class" => "btn btn-success") ); ?> 
    
    <!--  </form>-->
    <?php $this->endWidget(); ?>
  </section>
  <!-- section 3 --> 
</div>
