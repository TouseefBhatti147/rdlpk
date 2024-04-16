
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script>
<?php
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
   $('#loading').hide();
   $('#loading1').hide(); 
	  
    
});
</script>

<div style="margin-top:35px;">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Received Payments</a></li>
   
  </ul>
  <span style="float:right;"><a href="plots_payment_insert">Update Report</a></span>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <h3>Percentage Wise Payment</h3>
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
<div id="search" style="background-color:aliceblue;float:left; border:1px solid; padding-top:5px;">
<span>Project:</span>
<select name="project" id="project" style="width:180px;">
<option value="">Select Project</option>
<?php

            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>';
            }?>
</select>
<select name="block" id="block" style="width:180px;">
    <option value="">Block</option>
  </select>
<select name="com_res" id="com_res" style="width:180px;">

<option value="Residential">Residential</option>
<option value="Commercial">Commercial</option>
</select>
Cut Date: <input type="date" value="" name="create_date" id="create_date" class="new-input" style="width:140px;" placeholder="Date From " />      
</div>
    
<div id="received"  style="margin-left:5px;margin-right:5px; background-color:moccasin;border:1px solid; float:left;">
<h6 style="float:left;margin-right:15px;">All:   <input id="cat" checked="checked()" name="atype" type="radio" value="All" /></h6>        
<h6 style="float:left;margin-right:15px;">Not Against Land Plots:   <input id="cat" name="atype" type="radio" value="AL" /></h6>        
<h6 style="float:left;margin-right:15px;">Not FOC Plots:  <input id="cat" name="atype" type="radio" value="FOC" /></h6>

</div>

<img id="loading1"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">

<?php echo CHtml::ajaxSubmitButton(

                                'Search Paid',
 
     array('/plots/searchpayment/?page=1'),
                                array(

                'beforeSend' => 'function(){

                                             $("#login").attr("disabled",true);
                                                $("#loading1").show()

            }',

                                        'complete' => 'function(){

                                             $("#user_login_form").each(function(){});

                                             $("#login").attr("disabled",false);
                                              $("#loading1").hide();

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

<!--  </form>-->

<?php $this->endWidget(); ?>
<div class="clearfix"></div>
<div class="">
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<th rowspan="2" width="5%" style="text-align:center">S.No</th>
<th rowspan="2" width="15%" style="text-align:center">Plot Categories</th>
<th rowspan="2" style="text-align:center">Total</th>
<th colspan="8" style="text-align:center">Booking by Paid %age </th>


</tr>
<tr>
<th style="text-align:center">(91-100%)</th>
<th style="text-align:center">(81-90%)</th>
<th style="text-align:center">(71-80%)</th>
<th style="text-align:center">(61-70%)</th>
<th style="text-align:center">(50-60%)</th>
<th style="text-align:center">(21-49%)</th>
<th style="text-align:center">(20%)</th>
<th style="text-align:center">(Less 20%)</th>
</tr>
</thead>
<tbody id="error-div">
</tbody>
</table>
</div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Due Payment Percentage Wise</h3>
     
      <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form1',

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
<div id="search" style="background-color:aliceblue;float:left; border:1px solid; padding-top:5px;">
<span>Project:</span>
<select name="project" id="project1" style="width:180px;">
<option value="">Select Project</option>
<?php

            $res=array();
			foreach($projects as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>';
            }?>
</select>
<select name="block" id="block1" style="width:180px;">
    <option value="">Block</option>
  </select>
<select name="com_res" id="com_res" style="width:180px;">

<option value="Residential">Residential</option>
<option value="Commercial">Commercial</option>
</select>
Cut Date: <input type="date" value="" name="create_date" id="create_date" class="new-input" style="width:140px;" placeholder="Date From " />      
</div>
    


<img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">

<?php echo CHtml::ajaxSubmitButton(

                                'Search Due',
     array('/plots/searchpaymentdue/?page=1'),
                                array(
                'beforeSend' => 'function(){

                                             $("#login1").attr("disabled",true);
                                                $("#loading").show()

            }',

                                        'complete' => 'function(){

                                             $("#user_login_form1").each(function(){});

                                             $("#login1").attr("disabled",false);
                                              $("#loading").hide();

                                        }',

                   'success'=>'function(data){

                                           //  var obj = jQuery.parseJSON(data);

                                            // View login errors!



                                             if(data == 1){

												// alert("we are here");

                                         location.href = "http://rdlpk.com/index.php/user/dashboard";

                                      }

          else{

                                                $("#error-div1").show();

                                                $("#error-div1").html(data);$("#error-div1").append("");

												return false;

                                             }



                                        }'

    ),

                         array("id"=>"login1","class" => "btn btn-info")

                ); ?>

<!--  </form>-->

<?php $this->endWidget(); ?>
<div class="clearfix"></div>
<div class="">
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<th rowspan="2" width="5%" style="text-align:center">S.No</th>
<th rowspan="2" width="15%" style="text-align:center">Plot Categories</th>
<th rowspan="2" style="text-align:center">Total</th>
<th colspan="8" style="text-align:center">Booking by Paid %age </th>


</tr>
<tr>
<th style="text-align:center">(91-100%)</th>
<th style="text-align:center">(81-90%)</th>
<th style="text-align:center">(71-80%)</th>
<th style="text-align:center">(61-70%)</th>
<th style="text-align:center">(50-60%)</th>
<th style="text-align:center">(21-49%)</th>
<th style="text-align:center">(20%)</th>
<th style="text-align:center">(Less 20%)</th>
</tr>
</thead>
<tbody id="error-div1">
</tbody>
</table>
</div>

    </div>
   
   
  </div>
</div>
<script>



  $(document).ready(function()
     {
       $("#project").change(function()
           {
            select_block($(this).val());
		   });

       $("#project1").change(function()
           {
            select_block1($(this).val());
		   });

		     	 $("#com_res").change(function()

           {
         //  select_plan($(this).val());

         	var pro=$("#project").val();
			var street=$("#street_id").val();
			var size=$("#size_id").val();
			var sector=$("#sector").val();
			var pptype=$('#pptype').val();
	select_size(this.value);

		    });

     });

var sid=$("#com_res").val();
			function select_size(id)
{
			$.ajax({
      type: "POST",
      url:    "ajaxRequest123?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
		var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.size +" </option>";
    });listItems+="";
	$("#size").html(listItems);
          }
});}
function select_block(id) {
    $.ajax({
      type: "POST",
      url: "ajaxBlock?val1=" + id,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var listItems = '';
        listItems += "<option value=''>Select Block</option>";
        $(json).each(function(i, val) {

          listItems += "<option value='" + val.id + "'>" + val.block_name + "</option>";
        });
        listItems += "";
        $("#block").html(listItems);
      }
    });
  }
  function select_block1(id) {
    $.ajax({
      type: "POST",
      url: "ajaxBlock1?val1=" + id,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var listItems = '';
        listItems += "<option value=''>Select Block</option>";
        $(json).each(function(i, val) {

          listItems += "<option value='" + val.id + "'>" + val.block_name + "</option>";
        });
        listItems += "";
        $("#block1").html(listItems);
      }
    });
  }
function select_sector(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Sector</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector").html(listItems);
          }
    });
}

 $(document).ready(function()
     {
       $("#sector").change(function()
           {
         	select_street($(this).val());
		   });
     });


function select_street(id)
{
	var pro=$("#project").val();
	var sec=$("#sector").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest2?pro="+pro+"&&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='<option value="">Select Street</option>';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street_id").html(listItems);
          }
    });
}


</script>