<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif; font-size:16px;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 10%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}
h2{ color:#428BCA; }
img.avatar {
  width: 20%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw1 {
  float: left;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    padding-top: 16px;
     float: right;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2 align="center">Member Login </h2>

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
  <div class="imgcontainer">
    <img src="<?php echo Yii::app()->request->baseUrl.'/images/loginpage.jpg';?>" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Login ID/Email*</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
   
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
    <?php $this->endWidget(); ?>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn"><a style="color:#FFF;" href="activate_account1">Request For Login Access(Already Member)</a></button>
    <span class="psw">Forgot <a href="forgot_password">password?</a></span>
  </div>
  <div class="container" style="background-color:#f1f1f1">
    <span class="psw1">For any assistance, please write us at <a href="#">support@rdlpk.com?</a></span>
  </div>


</body>
</html>
