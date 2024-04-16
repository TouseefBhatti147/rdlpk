<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/reciept/binreq",
                  type:"POST",
                 data:"actionfunction=showData&page=1&project_name="+project_name,
        cache: false,
        success: function(response){
		   
		  $('#error-div').html(response);
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"http://<?php echo $address ?>/index.php/reciept/binreq",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page,
				//  data:"actionfunction=showData&page="+$page,
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


  <h3>Instrument List(Bin)</h3>
</div>


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

  <input type="text" value="" name="name" id="name" style="width:160px;" class="new-input" placeholder="Name" />
   <input type="text" value="" name="cnic" id="cnic" style="width:160px;" class="new-input" placeholder="CNIC" />
   <input type="text" value="" name="ref_no" id="ref" class="new-input" style="width:140px;" placeholder="Ref" />
 <input type="text" value="" name="inid" id="inid" class="new-input" style="width:140px;" placeholder="Instrument ID" />
   <input type="text" value="" name="datefrom" id="fromdatepicker" class="new-input" style="width:140px;" placeholder="Date From " />
 <input type="text" value="" name="dateto" id="todatepicker" class="new-input" style="width:140px;" placeholder="Date To" />
 
   <?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('/reciept/binreq?page=1'),
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

                         array("id"=>"login","class" => "btn")      

                ); ?> 
  
  <!--  </form>-->
  
<?php $this->endWidget(); ?>
</section>
</div>

<!-- section 3 -->

<div class="clear-fix"></div>

<!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />

    -->

</form>
<table class="table table-striped table-new table-bordered">
  <thead style="background:#666; border-color:#ccc; color:#fff;">
   <th width="4%">ID</th>
   <th width="8%">Entry Date</th>
   <th width="15%">Name</th>
    <th width="8%">CNIC</th>
    <th width="7%">Amount</th>
    <th width="6%">Ref</th>
   
    <th width="6%">Type</th>
<th width="6%">Status</th>
    
    <th width="10%">Verification</th>
    <th width="8%">Total Receipt</th>
      </thead>
  <tbody id="error-div">
  </tbody>
</table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
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