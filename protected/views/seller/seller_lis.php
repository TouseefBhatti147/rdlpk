

<div class="shadow">

  <h3>Advance Search:Seller</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">



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









<span>Enter Seller Name:</span><div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

    		 
<input type="text" value="" name="name" id="name" class="new-input" placeholder="Enter Seller Name" />
    

 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('/seller/searchreq'),

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

                         array("id"=>"login","class" => "btn btn-info")      

                ); ?>
			</form>
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/seller/seller"  class="btn-info button">Add New Seller</a></span>

			<div class="clearfix"></div>
	
  			<div class="">



            

            



            <table class="table table-striped table-new table-bordered ">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                        <th width="5%"> ID</th>
                        <th width="10%">Name</th>
                          <th width="10%">Logo</th>
                        <th width="10%">Proprietor</th>
                         <th width="10%">Issued Form</th>
                          <th width="10%">Price</th>
                       
                       <th width="10%">Action</th>
                        </tr>
                </thead>
                <tbody id="error-div">
                </tbody>
            </table>

  </div>
<hr noshade="noshade" class="hr-5 float-left">
<?php $this->endWidget(); ?>
</section>
</div>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
 
