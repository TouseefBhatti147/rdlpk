<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {

$( "#uptodate1" ).datepicker({ dateFormat: 'dd-mm-yy' });

});


</script>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/recovery/contlist",
                  type:"POST",
             //    data:"actionfunction=showData&page=1&project_name="+project_name,
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
	     url:"http://<?php echo $address ?>/index.php/recovery/contlist",
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
</script><div class="shadow">
  <h3>Contacted List</h3>
</div>
<hr noshade="noshade" class="hr-5">


<?php header('Cache-Control: max-age=900'); ?>
<?php 

$pages_data = Yii::app()->session['pages_array'];

?>
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

 <input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />

 	    	<select name="project_name" id="project_name" style="width:180px;"><?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
         
        <!-- <input type="checkbox" name="today" value="1" />Today &nbsp;
         
         Status: <input type="radio" name="followup_status" value="1">Contacted
            <input type="radio" name="followup_status"value="2">Pending
            <input type="radio" name="followup_status"value="0">All-->
           
        <!-- <input type="radio" name="followup_status" value="0" />Pending/Not Contacted &nbsp;
         <input type="radio" name="followup_status" value="2" />Contacted
-->          <!-- <select style="width:180px;" name="status" id="status">
           <option value="">Select Status</option>
           <option value="1">New</option>
           <option value="0">Pending</option>
           </select>
       -->
 <?php echo CHtml::ajaxSubmitButton(
                                'Search',

     array('recovery/contlist/?page=1'),
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


<!-- shadow -->

<section class="reg-section margin-top-30">
  <?php 

$pages_data = Yii::app()->session['pages_array'];

?>
  <div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
  
  <!--  </form>-->
  
  <div class="">
    <p class="reg-left-textResult For"></p>
    <h4 style="float:right;"><!--<a href="testcsv">Export To Excel</a>--></h4>
    <form method="post" action="addforcont">
      <table class="table table-striped table-new table-bordered" style="font-size:12px;">
        <thead style="background:#666; border-color:#ccc; color:#fff;">
          <tr>
            <th width="4%">MS No.</th>
            <th width="6%">Name</th>
            <th width="6%">Father/Spouse</th>
            <th width="3%">CNIC</th>
            <th width="3%">Plot Size</th>
            <th width="4%">Phone</th>
          
          
          
          </tr>
        </thead>
        <tbody id="error-div">
        </tbody>
      </table>
    </form>
  </div>
  <script>
  function func1(){
	
	alert('function aclled');
	}
 

  $(document).ready(function()

     {  	
       $("#project").change(function()
           {
         	
			select_cdate($(this).val());
		   });
			select_street($(this).val());
		   });
		   $("#street_id").change(function()
           {
         	select_plot($(this).val());
		   });

     });
function select_cdate(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequestdate?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<input type=text value='" + val.id + "'>";

});listItems+="";
$("#street_id").html(listItems);
          }
    });

}

function select_street(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

});listItems+="";
$("#street_id").html(listItems);
          }
    });

}
function select_plot(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest1?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";
});listItems+="";
$("#plot_id").html(listItems);
          }
    });
}

</script> 
</section>

<!-- section 3 --> 

