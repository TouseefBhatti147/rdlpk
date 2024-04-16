<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>
<?php if(Yii::app()->session['user_array']['per17']=='1'){ ?>
 $(function(){
var proj=$("#project_id").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/forms/searchedit?project_id="+proj,
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page=1&project_id="+proj,
        cache: false,
        success: function(response){
		   
		  $('#error-div').html(response);
		}
	   });
	   <?php  }?>
	   <?php if(Yii::app()->session['user_array']['per16']=='1' && Yii::app()->session['user_array']['per17']=='0'){ ?>
 $(function(){
var proj=$("#project_id").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/forms/searchedit",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page=1",
        cache: false,
        success: function(response){
		   
		  $('#error-div').html(response);
		}
	   });
	   <?php  }?>
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"http://<?php echo $address ?>/index.php/forms/searchreq",
                  type:"POST",
                  data:"actionfunction=showData&page="+$page+"&project_id="+proj,
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
<?php if(Yii::app()->session['user_array']['per17']=='1'){ ?>
    <span>Project:</span>

    	<select name="project_id" id="project_id" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

   <?php }?>

    
                <span>CNIC:</span>
     <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter CNIC No." />

               <span>Form No.:</span> 			 
<input type="text" value="" name="formno" id="formno" class="new-input" placeholder="Enter Form No" />
    

 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('/forms/searchedit?page=1'),

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
						
                        <th width="8%"> Form/Reg #</th>
                      
                        <th width="8%">Applicant Name</th>
                        <th width="10%">Father/Spouse Name</th>
                        <th width="8%">CNIC</th>
                       
                        <th width="8%">Phone</th>
                     
                         <th width="6%">Membership</th>
                        <th width="10%">Open Certificate</th>
                        <th width="9%">Booking</th>
                       
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



</script>
<script type="text/javascript">
function delete_id(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='deleteinfo?id='+id;
     }
}
function delete_id0(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='deleteinfo1?id='+id;
     }
}
function delete_id1(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='deleteinfo2?id='+id;
     }
}
</script>