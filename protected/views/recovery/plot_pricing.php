<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/recovery/search_plot_pricing",
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
	     url:"http://<?php echo $address ?>/index.php/recovery/search_plot_pricing",
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
  <h3>Plot Pricing</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
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
  <select name="project_name" id="project_name" style="width:180px;">
    <?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  
     			<select name="com_res" id="com_res"  style="width:180px;">
	         	<option value="">Select Property Type</option>
	         <option value="Commercial">Commercial</option>
          <option value="Residential">Residential</option>
          </select>
  <input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
  <input type="text" value="" name="cut_date" id="cut_date" class="new-input" placeholder="Enter Cut Date" />
  <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('recovery/search_plot_pricing/?page=1'),

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
    <table class="table table-striped table-new table-bordered" style="font-size:12px;">
      <thead style="background:#666; border-color:#ccc; color:#fff;">
        <tr>
          <th width="5%">MS No.</th>
          <th width="7%">Name</th>
          <th width="5%">CNIC</th>
          <th width="5%">Plot Size</th>
          <th width="5%">Phone</th>
          
          <th width="4%">Plot Price</th>
           <th width="5%">PL Price</th>
          <th width="4%">Discount</th>
          <th width="4%">Due Amount</th>
          <th width="5%">Difference</th>
         <!-- <th width="4%">Balance Due</th> 
          <th width="4%">Net Balance</th>
       
           <th width="4%">Balance %</th>-->
        </tr>
      </thead>
      <tbody id="error-div">
      </tbody>
    </table>
  </div>
  <script>

 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		   $("#street_id").change(function()

           {

         	select_plot($(this).val());

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

