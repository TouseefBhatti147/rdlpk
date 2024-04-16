<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
   $('#loading').hide();
	  var project_name=$("#project_id").val();	
 $.ajax({
	     url:"https://<?php echo $address ?>/index.php/plots/Searchballotablef",
                  type:"POST",
                data:$("#user_login_form").serialize() + "&&page=1",
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
	     url:"https://<?php echo $address ?>/index.php/plots/Searchballotablef",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
          data:$("#user_login_form").serialize()+"&&page="+$page,
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

  <h3>Files Balloting Data<?php if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username']))
{?>
<?php }?></h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">
<span style="float:right"><!--<a href="filesdata?project_id=<?php // echo $_GET['pid'];?>&sector=<?php //echo $_GET['sector'];?>">--->Generate Files<!--</a>---></span>


<div id="received" style="margin-left:5px;margin-right:5px; background-color:moccasin;border:1px solid; float:right;">
<!--<form name="filterform" method="post" action="FilterData" id="filterform" ajax="true"> 
<h6 style="float:left;margin-right:15px;">Balloting Criteria <input placeholder="Min Paid amount%" style="width:120px;" id="min" name="min" type="text" value=""></h6>        
<h6 style="float:left;margin-right:15px;">Max:    <input placeholder="Max Paid amount%" style="width:120px;" id="max" name="max" type="text" value=""></h6> 
<input type ="submit" name="filter" value="Filter Record" style="float:left;margin-right:15px;margin-top:15px;">      
</form>-->
<div id="result-page" style="display:none"></div>

</div>
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
<input type="hidden"  name="project_id" id="project_id" value="<?php echo $_GET['pid'];?>">
    
    Sector:
<select id="sector" name="sector" class="new-input">
  <option value="">Select Sector</option>
<?php 
$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from sectors where project_id='".$_GET['pid']."' and id='".$_GET['sector']."'";
		$result_city = $connection->createCommand($sql_city)->query();
foreach($result_city as $row){
	echo '<option value="'.$row['id'].'">'.$row['sector_name'].'</option>';
	}
?>
</select>

<select name="balloting_id" id="balloting_id" style="width:180px;">
  <option value="">Select Balloting</option>
  </select>
Street No.:<select id="street" name="street" class="new-input">
</select>
MS No.<input type="text"  name="plotno" id="plotno" style="width:180px;" value="">
<select id="zone" name="zone" class="new-input">
  <option value="">Select Zone</option>
  <option value="1">Zone A</option>
  <option value="0">Zone B</option>
</select>
<select id="balloting_status" name="balloting_status" class="new-input">
  <option value="">Select Status</option>
  <option value="Plot">Balloted</option>
  <option value="file">Not Balloted</option>
</select>
<select id="allotment_type" name="allotment_type" class="new-input">
  <option value="">Allotment Type</option>
  <option value="On Payment">On Payment</option>
  <option value="Against Land">Against Land</option>
</select>
Status:<select id="mstatus" name="mstatus" class="new-input">
  <option value="">Allotment Status</option>
  <option value="0">Normal</option>
  <option value="2">Blocked</option>
</select>
  <img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">
 <?php echo CHtml::ajaxSubmitButton(
                                'Search',
     array('/allotments/searchballotablef/?page=1'),
                                array(  
                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);
                                              $("#loading").show()

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});

                                             $("#login").attr("disabled",false);
                                             $("#loading").hide();
                                        }',

                   'success'=>'function(data){  

                                           //  var obj = jQuery.parseJSON(data); 

                                            // View login errors!

        
                                           ;
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "httpss://rdlpk.com/index.php/user/dashboard";
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
<?php $this->endWidget(); ?>
</section>
</div>
<div class="clearfix"></div>
  <div class="">
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="2%">Sr# </th>
                        <th width="5%">MS# </th>
                        <th width="3%">Type</th>
                        <th width="3%">Plot No</th>
                        <th width="7%">Project</th>
                        <th width="5%">Plot Size</th>
                        <th width="5%">Dimension</th>
                       
                       
                         <th width="4%">Street</th>
                        <th width="4%">Sector</th>
                        <th width="4%">Allotment Type</th>
                        <th width="5%">Due Amount</th>
                    	 <th width="5%">Paid Amount</th> 
                       <th width="4%">Paid Percentage</th>
                       <th width="3%">Zone</th>
                       <th width="4%">Merge</th>                
                        </tr>
                </thead>
                <tbody>
                <tbody id="error-div">
             
            </table>
  </div>
<script>
$(document).ready(function()
     {  	
	 $("#sector").change(function()
           {
         	select_street($(this).val());
		   });
		   });
		   function select_street(id)

{
	var sec=$("#sector").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest12?sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street").html(listItems);
          }

    });}
//select plot

$(document).ready(function()
     {  	

      $("#sector").change(function()
           {
            select_balloting($(this).val());
		   });
      $("#street").change(function()
           {
         	select_plot($(this).val());
		   });
		   });
	   function select_plot(id)

{
	var street=$("#street").val();
	var size2=$("#size2").val();
	var ptype=$("#ptype").val();
  var sec=$("#sector").val();
$.ajax({
      type: "POST",
    //  url:    "ajaxplot?sec="+sec,
	  url:"ajaxplot?street="+street+"&size2="+size2+"&ptype="+ptype+"&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Plot</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address + "</option>";
});listItems+="";
$("#plot_detail_address").html(listItems);
          }

    });}
    function select_balloting()
{
   var sec=$("#sector").val()
   var pro=$("#project_id").val()
   $.ajax({
      type: "POST",
      url:    "AjaxBalloting1?pro="+pro+"&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.desc1 + "</option>";
});listItems+="";
$("#balloting_id").html(listItems);
          }

    });
}
$("form[ajax=true]").submit(function (e) {

    e.preventDefault();

    var form_data = $(this).serialize();
    var form_url = $(this).attr("action");
    var form_method = $(this).attr("method").toUpperCase();

    $("#loadingimg").show();

    $.ajax({
        url: "FilterData",
        type: "POST",
        data: $(this).serialize(),
        cache: false,
        success: function (returnhtml) {
            $("#result-page").append(returnhtml).show();
            $('filterform').hide();
            $("#loadingimg").hide();
          
        }
    });

});



</script>