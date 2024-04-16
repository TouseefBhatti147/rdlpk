<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>
$(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/recovery/searchsheet",
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
	     url:"http://<?php echo $address ?>/index.php/recovery/searchsheet",
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
<?php header('Cache-Control: max-age=900'); ?>

<div class="shadow">
  <h3>Defaulter List</h3>
 
</div>
 
<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
  <?php 

$pages_data = Yii::app()->session['pages_array'];

?>

  <script>
s = 1;
   function check(){
       o = document.getElementById('opt');
       if(o.value=='Y'){
           s++;
           if(s%2==0){
           $('#txt').prop('disabled',false);
		 //  $('#btn').prop('disabled',false);
		 //  document.getElementById('btn').style.display='block';
		   }
		   else{
           $('#txt').prop('disabled',true);
		     // document.getElementById('btn').style.display='none';
		   }
	   }
       
   }
</script>
  <div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <div><!--<form method="post" action="update_cut_date">
  
  
    <input type="checkbox" name="opt" id="opt" value="Y" onclick="check()">
    <input  type="submit" id="btn" name="btn" class="btn-input" value="Change" />
  -->
   
  </div>
  </br>  <?php $form=$this->beginWidget('CActiveForm', array(

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
  <input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
  <select name="project_id" id="project_id" style="width:180px;">
	   <option value="">Please Select Project </option>
    <?php	

            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  Cut Date:<select name="cut_date" id="cut_date" style="width:180px;">
      <option value="">Select Cut Date</option>
    </select>
    New Defaulters:<input type="checkbox" name="new" value="1"/>
  <span  style="float:right;"><a  id="link"  href="updatecdate?pid=">Update Cut Date</a>
  
  </span>
   <!-- <input type="date"  disabled="disabled" class="new-input" name="cut_date"  id="cut_date">
  Upto:
  <input name="uptodate1" placeholder="Enter Upto Date" type="text" class="new-input" id="uptodate1">-->
  <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('recovery/searchsheet/?page=1'),

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
  <div class="">
    <p class="reg-left-textResult For"></p>
    <h4 style="float:right;"><!--<a href="testcsv">Export To Excel</a>--></h4>
     <form method="post" action="test">
     
    <table class="table table-striped table-new table-bordered" style="font-size:12px;">
      <thead style="background:#666; border-color:#ccc; color:#fff;">
        <tr>
          <th width="5%">MS No.</th>
          <th width="6%">Name</th>
          <th width="5%">Father/Spouse</th>
          <th width="4%">CNIC</th>
          <th width="4%">Plot Size</th>
          <th width="4%">Plot Price</th>
          <th width="3%">Discount</th>
          <th width="3%">Due Amount</th>
          <th width="5%">Received Amount</th>
          <th width="4%">Over Due</th>
          <th width="5%">Due Installments</th>
          <th width="5%">Paid Installments</th>
          <th width="4%">Action</th>
           <th width="3%">Watch List</th>
        </tr>
      </thead>
      <tbody id="error-div">
      </tbody>
    </table></form>
  </div>
  <script>
//  $(document).ready(function()
  //   {  	
       $("#project_id").change(function()
           {
		   	select_cdate($(this).val());

		   });
		//});
		
function select_cdate(id)
{
	var project_id=$("#project_id").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequestdate?project_id="+project_id,
	  
	   // url:    "ajaxRequest2?pro="+pro+"&&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	var listItems='';
	  var date ='';
	//listItems+= "<option value=''>Select Cut Date</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.cut_date + "'>" + val.cut_date + "</option>";

  var date =val.cut_date;
	
	//$(json).each(function(i,val){
	//alert(JSON.stringify(val));
//	$('#cut_date').val(val.cut_date);

	//listItems+= "<option value='" + val.id + "'>" + val.id + "</option>";
});listItems+="";

//var userDate = '04.11.2014';
   // var date_string = moment($("#cut_date"), "YYYY.MM.DD").format("DD-MM-YYYY");
  //
//	
//	var abc =Date.parse(date, "yyyy-MM-dd");
//	$("#cut_date").val(abc);

$("#cut_date").html(listItems);
$("#cdate").val(project_id);
var link = 'updatecdate?id=' + project_id;

$("#link").attr("href", link);
          }
    });

}


</script> 
</section>

<!-- section 3 --> 

