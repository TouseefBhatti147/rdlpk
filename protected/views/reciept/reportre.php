<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script>
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/reciept/reportrereq",
                  type:"POST",
                 data:$("#user_login_form").serialize(),
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
	     url:"http://<?php echo $address ?>/index.php/reciept/reportrereq",
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

  <h3>Payment Receiving Report</h3>
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
<input type="text" name="datefrom" id="fromdatepicker" style="width:160px;" placeholder="From Date" value="<?php echo date('Y-m-d');?>"/>
<input type="text" name="dateto" id="todatepicker" style="width:160px;" placeholder="Till Date" value="<?php echo date('Y-m-d');?>" />
   <select name="project_id" id="project_id" style="width:160px;">
   <?php	
	
            $res=array();
			
            foreach($pro as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
    <select name="status" id="status" style="width:160px;">
    
    <option value="1">My Sale Center</option>
    <?php if(Yii::app()->session['user_array']['per9']=='1'){?>
    <option value="2">For All Sale Center</option>
    <?php  }?>
    </select>
   <?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('/reciept/reportrereq'),
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
<style>th { vertical-align:middle !important; text-align:center !important;}</style>
<table class="table table-striped table-new table-bordered">
  <thead style=" vertical-align:middle !important;background:#666; border-color:#ccc; font-size:10px; color:#fff;">
 
    <th width="2%">Sr. No.</th>
    <th width="4%">Receiving Date</th>
    <th width="8%">Members Name</th>
    <th width="4%">Receipt No.</th>
    <th width="8%">M.S No.</th>
    <th width="4%">Installment	</th> 
    <th width="4%">Fees/Charges 	</th>	
    <th width="4%">Instrument No.</th>
    <th width="4%">Instrument Date</th>
    <th width="4%">Bank</th>
    <th width="4%">Deposit Slip No.</th>
    <th width="4%">Deposit Date</th>
    <th width="4%">Cleared On</th>
    <th width="4%">Remarks</th>
							

      </thead>
  <tbody id="error-div" style="font-size:10px;">
  
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