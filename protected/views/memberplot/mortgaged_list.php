<?php
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>
 $(function(){
	  var project_name=$("#project_name").val();
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/memberplot/searchreqmortg",
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
	     url:"http://<?php echo $address ?>/index.php/memberplot/searchreqmortg",
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

  <h3>Mortgaged Property</h3>

<hr noshade="noshade" class="hr-5">
</div>
<!-- shadow -->
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
 <input type="text" value="" style="width:140px" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
 <input type="text" value="" style="width:130px" name="app_no" id="app_no" class="new-input" placeholder="Form #" />
 <input type="text" value="" style="width:160px" name="name1" id="name" class="new-input" placeholder="Enter Name" />
    <input type="text" value="" style="width:140px" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />
	    	<select name="project_name" id="project_name" style="width:180px;"><?php
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>';
            }?></select>

             <select name="status" id="status" style="width:200px;">
                    <option value="">Select Status</option>
                    <option value="1">Mortgaged</option>
                    <option value="2">Under Process</option>

                      </select>
               <select name="noc_nec" id="noc_nec" style="width:180px;">
                    <option value="">Select NOC-NEC</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
 			 </select>
       <?php echo CHtml::ajaxSubmitButton(
                                'Search',
     array('memberplot/searchreqmortg/?page=1'),
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
<?php $this->endWidget(); ?>
  <div class="">
    <p class="reg-left-textResult For"></p>
                 <table class="table table-striped table-new table-bordered" style="font-size:11px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                       <th width="5%">MS No.</th>
                   <!--   <th width="6%">Image</th>-->
                        <th width="5%">Name</th>
                        <th width="4%">CNIC</th>
  						 <th width="4%">Plot Size</th>
                        <th width="2%">Plot No.</th>
                        <th width="5%">Street/Lane , Sector</th>
                        <th width="6%">Project</th>
                         <th width="4%">Status</th>
                          <th width="3%">NOC-NEC</th>
                           <th width="9%">Remarks</th>
		                <th width="5%">Action</th>
                    </tr>
                </thead>
               <tbody id="error-div">
				</tbody>
</table>
  </div>


   </section>

<!-- section 3 -->

