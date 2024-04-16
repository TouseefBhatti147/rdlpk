<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
?>
<script>	
 $(function(){
       $('#loading').hide();
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/plots/searchallocsumf",
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
	     url:"http://<?php echo $address ?>/index.php/plots/searchallocsumf",
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
<h3>Residential Plots Allocation Summary</h3>
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
<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
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
<img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">

<?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('/plots/searchallocsumf/?page=1'),
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
</section>
</div>

<!-- section 3 --> 

<!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />

    -->
<style>
	th{
	font-size:12px
}
</style>
</form>
<div class="clearfix"></div>
<div class="">
<table class="table table-striped table-new table-bordered" style="font-size:12px;">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<th rowspan="2" width="5%" style="text-align:center">S.No</th>
<th rowspan="2" width="10%" style="text-align:center">Plot Categories</th>
<th rowspan="2" style="text-align:center">Total Plots</th>
<th colspan="3" style="text-align:center">Villas (Homes) </th>
<th colspan="3" style="text-align:center">Plots Allocated </th>
<th colspan="3" style="text-align:center">Reserved/Hold </th>
<th colspan="2" style="text-align:center">Balance(Open)</th>
<th rowspan="2" style="text-align:center">Pending Files</th>
<th colspan="2" style="text-align:center">Final Net Balance</th>
<th rowspan="2" style="text-align:center">Remarks</th>

</tr>
<tr>
<th style="text-align:center">Sold (Allotted)</th>
<th style="text-align:center">Reserved (Unsold)</th>
<th style="text-align:center">Total Villas</th>
<th style="text-align:center">Selected+Balloted</th>
<th style="text-align:center">Against Land</th>
<th style="text-align:center">Total Sold</th>
<th style="text-align:center">Against Land Rsvd</th>
<th style="text-align:center">HRL Rsvd</th>
<th style="text-align:center">Total Rsvd</th>
<th style="text-align:center">Nos</th>
<th style="text-align:center">% age</th>
<th style="text-align:center">Nos</th>
<th style="text-align:center">% age</th>
</tr>
<!---<tr>
<th style="text-align:center">Selected+Balloted</th>
<th style="text-align:center">Against Land</th>
<th style="text-align:center">Total Sold</th>
</tr>--->
</thead>
<tbody id="error-div">
</tbody>
</table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script>

  $(document).ready(function()
     {  	
       $("#project").change(function()
           {
         	select_block($(this).val());
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