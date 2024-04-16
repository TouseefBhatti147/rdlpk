<?php require_once "phpfileuploader/phpuploader/include_phpuploader.php" ?>



<div class="">

  <div class="shadow">

    <h3>Installment Plan</h3>

  </div>

  <!-- shadow -->

  <hr noshade="noshade" class="hr-5">

  <section class="reg-section margin-top-30">

 

  <div class="float-left">

   <div>

	

	

		</div>

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



<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>


     <div class="float-left">
 
    <p class="reg-left-text">Project <font color="#FF0000">*</font></p>

 
    <select name="project" id="project">

      <option value="">Please Select Project </option>

      <?php	

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?>

    </select>

    </div>
     <div class="float-left">
    <p class="reg-left-text">Size <font color="#FF0000">*</font></p>
    <select name="category_id" id="category_id">
      <option value="">Please Select Size </option>
      <?php	
            $res=array();

            foreach($size as $key1){

            echo '<option value="'.$key1['id'].'">'.$key1['size'].'</option>'; 

            }?>

    </select>

    </div>
      <div class="float-left">
    <p class="reg-left-text">Property Type <font color="#FF0000">*</font></p>
    <select name="p_type" id="p_type">
      <option value="">Select Property Type  </option>
      <option value="R">Residential</option>
      <option value="C">Commercial</option>
    </select>

    </div>
    <div class="float-left">
    <p class="reg-left-text">Plan Description.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="" name="description" id="description" class="reg-login-text-field" />
    </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Total No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="" name="tno" id="tno" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Total Amount.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="" name="tamount" id="tamount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">

    <p class="reg-right-field-area margin-left-5">

1.      <input type="text" value="" name="lab1" id="lab1" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="" name="1"  placeholder="Amount" id="1" class="reg-login-text-field" />

     
    </p>

  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
2.      <input type="text" value="" name="lab2" id="lab2" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="" name="2" id="2"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
3. <input type="text" value="" name="lab3" id="lab3" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="3" id="3"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
4.      <input type="text" value="" name="lab4" id="lab4" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="" name="4" id="4"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
5.      <input type="text" value="" name="lab5" id="lab5" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="" name="5" id="5"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
6.      <input type="text" value="" name="lab6" id="lab6" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="" name="6" id="6" placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
7. <input type="text" value="" name="lab7" id="lab7" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="7" id="7"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
    <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
8. <input type="text" value="" name="lab8" id="lab8" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="8" id="8"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
<div class="float-left">
    <p class="reg-right-field-area margin-left-5">
9. <input type="text" value="" name="lab9" id="lab9" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="9" id="9"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
10. <input type="text" value="" name="lab10" id="lab10" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="10" id="10"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
11. <input type="text" value="" name="lab11" id="lab11" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="11" id="11"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
12. <input type="text" value="" name="lab12" id="lab12" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="12" id="12"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
13. <input type="text" value="" name="lab13" id="lab13" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="13" id="13"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
14. <input type="text" value="" name="lab14" id="lab14" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="14" id="14"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
15. <input type="text" value="" name="lab15" id="lab15" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="15" id="15"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
16. <input type="text" value="" name="lab16" id="lab16" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="16" id="16"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
17. <input type="text" value="" name="lab17" id="lab17" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="17" id="17"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
18. <input type="text" value="" name="lab18" id="lab18" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="18" id="18"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
19. <input type="text" value="" name="lab19" id="lab19" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="19" id="19"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
20. <input type="text" value="" name="lab20" id="lab20" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="20" id="20"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
21. <input type="text" value="" name="lab21" id="lab21" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="21" id="21"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
22. <input type="text" value="" name="lab22" id="lab22" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="22" id="22"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
23. <input type="text" value="" name="lab23" id="lab23" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="23" id="23"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
24. <input type="text" value="" name="lab24" id="lab24" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="24" id="24"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
25. <input type="text" value="" name="lab25" id="lab25" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="25" id="25"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
26. <input type="text" value="" name="lab26" id="lab26" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="26" id="26"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
27. <input type="text" value="" name="lab27" id="lab27" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="27" id="27"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
28. <input type="text" value="" name="lab28" id="lab28" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="28" id="28"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
29. <input type="text" value="" name="lab29" id="lab29" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="29" id="29"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
30. <input type="text" value="" name="lab30" id="lab30" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="30" id="30"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
31. <input type="text" value="" name="lab31" id="lab31" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="31" id="31"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
32. <input type="text" value="" name="lab32" id="lab32" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="32" id="32"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
33. <input type="text" value="" name="lab33" id="lab33" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="33" id="33"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
34. <input type="text" value="" name="lab34" id="lab34" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="34" id="34"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
35. <input type="text" value="" name="lab35" id="lab35" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="35" id="35"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
36. <input type="text" value="" name="lab36" id="lab36" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="36" id="36"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
37. <input type="text" value="" name="lab37" id="lab37" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="37" id="37"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
38. <input type="text" value="" name="lab38" id="lab38" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="38" id="38"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
39. <input type="text" value="" name="lab39" id="lab39" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="39" id="39"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
40. <input type="text" value="" name="lab40" id="lab40" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="40" id="40"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
41. <input type="text" value="" name="lab41" id="lab41" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="41" id="41"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
42. <input type="text" value="" name="lab42" id="lab42" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="42" id="42"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
43. <input type="text" value="" name="lab43" id="lab43" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="43" id="43"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
44. <input type="text" value="" name="lab44" id="lab44" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="44" id="44"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
45. <input type="text" value="" name="lab45" id="lab45" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="45" id="45"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
46. <input type="text" value="" name="lab46" id="lab46" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="46" id="46"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
47. <input type="text" value="" name="lab47" id="lab47" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="47" id="47"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
48. <input type="text" value="" name="lab48" id="lab48" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="48" id="48"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
49. <input type="text" value="" name="lab49" id="lab49" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="49" id="49"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
50. <input type="text" value="" name="lab50" id="lab50" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="50" id="50"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
51. <input type="text" value="" name="lab51" id="lab51" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="51" id="51"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
52. <input type="text" value="" name="lab52" id="lab52" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="52" id="52"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
53. <input type="text" value="" name="lab53" id="lab53" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="53" id="53"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
54. <input type="text" value="" name="lab54" id="lab54" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="54" id="54"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
55. <input type="text" value="" name="lab55" id="lab55" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="55" id="55"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
56. <input type="text" value="" name="lab56" id="lab56" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="56" id="56"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
57. <input type="text" value="" name="lab57" id="lab57" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="57" id="57"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
58. <input type="text" value="" name="lab58" id="lab58" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="58" id="58"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
59. <input type="text" value="" name="lab59" id="lab59" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="59" id="59"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
60. <input type="text" value="" name="lab60" id="lab60" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="60" id="60"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
61. <input type="text" value="" name="lab61" id="lab61" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="61" id="61"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
62. <input type="text" value="" name="lab62" id="lab62" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="" name="62" id="62"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
   

  <?php echo CHtml::ajaxSubmitButton(
                                'Add Installment Plan',
    array('add'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#plots").each(function(){this.reset();});
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

   <span style="color:#FF0000; display:block;" id="error-project"></span>

  <span style="color:#FF0000; display:block;" id="error-street_id"></span>

  <span style="color:#FF0000; display:block;" id="error-plot_id"></span>

 <span style="color:#FF0000;display:block;" id="error-cnic"></span>

  <span style="color:#FF0000;display:block;" id="error-downpayment"></span>   

  <span style="color:#FF0000;display:block;" id="error-discount"></span>   

  <span style="color:#FF0000;display:block;" id="error-noi"></span>   

 <span style="color:#FF0000;display:block;" id="error-payment_type"></span>   

 <span style="color:#FF0000;display:block;" id="error-plotno"></span>   

 

   </div>

 

  

  <!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	$("#error-project").hide();

	$("#error-street_id").hide();

	$("#error-plot_detail_address").hide();

	$("#error-cnic").hide();

	$("#error-plotno").hide();

	$("#error-downpayment").hide();

	$("#error-discount").hide();

	$("#error-noi").hide();

	$("#error-payment_type").hide();

	//	var x=document.forms["form"]["firstname"].value;

	var w = $("#project").val();

	var x = $("#street_id").val();

	var y = $("#plot_detail_address").val();

	var no = $("#plotno").val();

	var c = $("#cnic").val();

	var i = $("#downpayment").val();

	var j = $("#discount").val();

	var k = $("#noi").val();

	var l = $("#payment_type").val();



var counter=0;

if (w==null || w=="")

  {

  $("#error-project").html("Enter Project");

  $("#error-project").show();

  counter =1;

  }

if (no==null || no=="")

  {

  $("#error-plotno").html("Enter Plot Membership No");

  $("#error-plotno").show();

  counter =1;

  }



if (x==null || x=="")

  {

  $("#error-street_id").html("Enter Street");

  $("#error-street_id").show();

  counter =1;

  }

  if (y==null || y=="")

  {

  $("#error-plot_detail_address").html("Enter Plot No");

  $("#error-plot_detail_address").show();

  counter =1;

  }





 

  if (c==null || c=="")

  {

  $("#error-cnic").html("Enter CNIC");

  $("#error-cnic").show();

  counter =1;

  }

    if (i==null || i=="")

  {

  $("#error-downpayment").html("Enter Down Payment");

  $("#error-downpayment").show();

  counter =1;

  }  

    if (j==null || j=="")

  {

  $("#error-discount").html("Enter Discount");

  $("#error-discount").show();

  counter =1;

  }     

    if (k==null || k=="")

  {

  $("#error-noi").html("Enter No Of Installment");

  $("#error-noi").show();

  counter =1;

  }     

      

 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>
  <script>

 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		   $("#street_id").change(function()

           {

         	select_plot($(this).val());

		   });

		   

		    $("#cnic").change(function()

           {

         	select_cnic($(this).val());

		   });

		   $("#plotno").change(function()

           {

         	select_mem($(this).val());

		   });

		    });



 function select_mem(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest6?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

	  

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>Membership number Already in DB</option>";

      

});listItems+="";



$("#memerror").html(listItems);

          }

});

}

function select_street(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';



	listItems+= "<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

});listItems+="";



$("#street_id").html(listItems);

          }

    });

}

function select_plot(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest1?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

	  

var listItems='';

	$(json).each(function(i,val){
	 listItems+= "<option value=''>Select Plot</option>";
	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";

      

});listItems+="";



$("#plot_id").html(listItems);

          }

});

}






</script> 

</div>

</section>

<!-- section 3 --> 

