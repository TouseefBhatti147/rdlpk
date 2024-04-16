<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>
 $(function(){
var proj=$("#project_id").val();	
 
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"http://<?php echo $address ?>/index.php/forms/searchreqnew",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page+"&project_id="+proj,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>
<div class="shadow">

  <h3>Advance Search:Forms</h3>
  
</div>
<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 3px 12px;}
	.float-left{ margin:3px;}
</style>
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









<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<div class="float-left">
    <label>Project:</label>

    	<select name="project_id" id="project_id" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
</div>
<div class="float-left">
    <label>Main Dealer:</label>

    	<select name="seller" id="seller" style="width:180px;">
		<option value="">Select</option>
		<?php	
            $res=array();
			foreach($sellers as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['name'].'</option>'; 
            }?></select> 
</div>
<div class="float-left">
    <label>Sub Dealer:</label>

    	<select name="sseller" id="sseller" style="width:180px;">
		<option value="">Select</option>
		<?php	
            $res=array();
			foreach($dealers as $key2){
            echo '<option value="'.$key2['id'].'">'.$key2['name'].'</option>'; 
            }?></select> 
</div>
<div class="float-left">
    <label>Mode:</label>

    	<select name="mode" id="mode" style="width:180px;">
                      <option value="">Select Mode</option>
           <option value="Dealer">Dealer</option>
                      <option value="Walk-in">Walk-in</option>
            </select> 
</div>
<div class="float-left">
    <label>Type:</label>

    	<select name="type" id="type" style="width:180px;">
                    
           				<option value="membership">Membership</option><option value="certificate">Certificate</option>
                      <option value="booking">Booking</option>
            </select> 
</div>
<div class="float-left">
    
                <label>CNIC:</label>
     <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter CNIC No." />

    </div>
<div class="float-left">           <label>Form No.:</label> 			 
<input type="text" value="" name="formno" id="formno" class="new-input" placeholder="Enter Form No" />
 
</div>
<div class="float-left" >
    <label>Confirmation :</label>
    	<select name="con" id="con" style="width:180px;" disabled="disabled">
<option value="">All</option>           			
<option value="Yes">Yes</option>
                    <option value="No">No</option>
            </select> 
</div> 
<div class="float-left" style="float:right; " >
   Active User Only:
    <input type="checkbox" name="active" />
</div> 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('/forms/searchreqnew?page=1'),

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


			<div class="clearfix"></div>
	
  			<div class="">



            

            



            <table class="table table-striped table-new table-bordered " style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						 <th width="4%"> S NO. </th>
                        <th width="8%"> Form/Reg #</th>
                      
                        <th width="8%">Applicant Name</th>
                        <th width="10%">Father/Spouse Name</th>
                        <th width="8%">CNIC</th>
                       
                        <th width="8%">Phone</th>
                     
                        
                       
						<th width="9%">Action</th>
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
 <script>

  $(document).ready(function()
   {  	
       $("#type").change(function()

      {
		  if($(this).val()=='booking'){ document.getElementById('con').disabled = false;}else{ document.getElementById('con').disabled = true;}
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



</script>
