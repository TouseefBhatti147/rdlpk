<div  class="row-fluid my-wrapper">

    <div class="span12" style="font-size: 14px;">

<div class="shadow">

  <h3>Search Plot Allocation :</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">

<style>.login-btn{ margin-left:10px; background-color:#096; color:#FFF;}</style>

<!--<form name="login-form" method="post" action="">-->

<?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'user_login_form',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',

                'clientOptions'=>array(

                     'validateOnSubmit'=>true,

                     'validateOnChange'=>true,

                     'validateOnType'=>false,

  ),

)); ?>









<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

   

   
<input type="text" onBlur="testPhone(this)" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />
  

<input type="text" name="appno" id="appno" class="new-input" placeholder="Membership No" /> 

                                <p style="color:red;"  id="rsp1"></p>


<script type="text/javascript">
function testPhone(objNpt){
 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits
 if (n.length!=13) {
  document.getElementById('rsp1').innerHTML="Please Enter 13 Digit CNIC Number without spaces/Slashes !";
  return;}
  document.getElementById('rsp1').innerHTML=""; 
 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number
}
</script>

	



	



	

 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('/web/searchreq1'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});

                                             $("#login").attr("disabled",false);

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

                         array("id"=>"login","class" => "login-btn")      

                ); ?>

  



<!--  </form>-->

<?php $this->endWidget(); ?>



</section>
<br />
<br />
  </div>

<!-- section 3 --> 









 

  <div class="clear-fix"></div>



  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />

    -->





  </form>

            <table class="table table-striped table-new table-bordered" style="font-size: 13px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>

                        <th width="8%">Membership No.</th>

                        <th width="10%">Member Name</th>

                        <th width="7%">CNIC No.</th>
                        <th width="7%">Plot Size</th>
                        <th width="5%">Plot No.</th>
						

                        <th width="12%">Street/Lane</th>

                        <th width="7%">Block</th>
                         <th width="7%">Map</th>
                        

                        

                        

                        

                        </tr>



                </thead>



                <tbody id="error-div">



              



                    



                </tbody>



            </table>
			<p style="color:red;">
           <b> Note: </b><br />
            1. Please Enter CNIC # without dashes.<br />
            2. Enter CNIC to view all property results. <br />
            3. Enter only Membership Serial Number + CNIC for single allotment result.<br />
            
            </p>
            
  </div>

<hr noshade="noshade" class="hr-5 float-left">



  



  



 



 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

 

 <script>

 

 

 



  $(document).ready(function()



     {  	



		



       $("#project").change(function()



           {



         	select_street($(this).val());



		   });



		   



		  



     });



 



 



function select_street(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



var listItems='';

	listItems+="<option value=''>Select Street</option>";



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";



      







});listItems+="";







$("#street_id").html(listItems);



          }



    });



}



</script></div></div>