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
	     url:"http://<?php echo $address ?>/index.php/reciept/bouncereq",
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
	     url:"http://<?php echo $address ?>/index.php/reciept/bouncereq",
                  type:"POST",
                  data:"page="+$page,
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


 
 
   

  <h3>Bounce Receipt List</h3>
   

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

   <select name="project_id" id="project_id" style="width:160px;">
<option value="">Select Project</option>
    <?php	
	
            $res=array();
			
            foreach($pro as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
   <select name="typed" id="typed"  style="width:160px;">
    <option value="">Instrument type</option>
    <option value="0">Normal</option>
    <option value="1">Dealers</option>
    </select>
   <select name="status1" id="status1"  style="width:160px;">
    <option value="">Submission Status</option>
    <option value="1">Submitted</option>
    <option value="2">Awaited Submission</option>
    <option value="5">With Remining Amount</option>
  </select>
  <select name="status" id="status" style="width:160px;">
<option value="">Verification Status</option>
<option value="Verified">Verified</option>
<option value="Pending">Pending</option>
<option value="Rejected">Rejected</option>
</select>
<?php if(Yii::app()->session['user_array']['per9']==1 or Yii::app()->session['user_array']['per21']==1){?>
<select name="scf" id="scf" style="width:160px;">
<option value=""> Select Sale Center</option>
<?php 
$connection = Yii::app()->db; 
$sql_bank  = "SELECT * from sales_center";
$result_bank = $connection->createCommand($sql_bank)->queryAll();
foreach($result_bank as $ch){
	echo '<option value="'.$ch['id'].'">'.$ch['name'].'</option>';
	}
?>
</select>
<?php }?>
  <select name="bank" id="bank" style="width:160px;">
  <option value=""> Select Bank</option>
<?php 
$connection = Yii::app()->db; 
$sql_bank  = "SELECT *,bank.id as bid from bank
left join projects on projects.id=bank.project_id
";
$result_bank = $connection->createCommand($sql_bank)->queryAll();
foreach($result_bank as $ch){
	echo '<option value="'.$ch['bid'].'">'.$ch['name'].' ('.$ch['project_name'].')</option>';
	}
?>
</select>
   <select name="type" id="type"  style="width:160px;">
    <option value="">Select Payment Type</option>
   
    <option value="Cash">Cash</option>
    <option value="Cheque">Cheque</option>
    <option value="Pay Order">Pay Order</option>
        <option value="Online">Online</option>
  </select>
  <select name="filed" id="filed"  style="width:160px;">
    <option value="">Select Filed Status</option>
   
    <option value="0">New</option>
    <option value="1">Filed</option>
    <option value="2">Hold</option>
  </select>
<input type="text" value="" name="slipno" id="slipno" style="width:160px;" class="new-input" placeholder="Deposit Slip #" />
<input type="text" value="" name="reno" id="reno" style="width:160px;" class="new-input" placeholder="Receipt #" />   
<input type="text" value="" name="name" id="name" style="width:160px;" class="new-input" placeholder="Name" />
   <input type="text" value="" name="cnic" id="cnic" style="width:160px;" class="new-input" placeholder="CNIC" />
   <input type="text" value="" name="ref_no" id="ref" class="new-input" style="width:140px;" placeholder="Ref" />
 <input type="text" value="" name="inid" id="inid" class="new-input" style="width:140px;" placeholder="Instrument ID" />
   <input type="text" value="" name="datefrom" id="fromdatepicker" class="new-input" style="width:140px;" placeholder="Date From " />
 <input type="text" value="" name="dateto" id="todatepicker" class="new-input" style="width:140px;" placeholder="Date To" />


    <?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('/reciept/bouncereq?page=1'),
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
   <th width="3%">ID</th>
   <th width="6%">Entry Date</th>
   <th width="15%">Name</th>
    <th width="8%">CNIC</th>
    <th width="7%">Amount</th>
    <th width="6%">Ref</th>
   
    <th width="6%">Type</th>
<th width="6%">Status</th>
    
    <th width="8%">Verification</th>
    <th width="7%">Total Receipt</th>
     <th width="8%">Action</th>
   
      </thead>
  <tbody id="error-div">
  </tbody>
</table>
</div>

<hr noshade="noshade" class="hr-5 float-left">
