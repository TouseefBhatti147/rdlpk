<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/finance/searchrec",
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
	     url:"http://<?php echo $address ?>/index.php/finance/searchrec",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page,
				//  data:"actionfunction=showData&page="+$page,
		timeout:100000000,
				
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>
<?php //header('Cache-Control: max-age=900'); ?>

<div class="shadow">
  <h3>Recievable Sheet</h3>
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
 
	    	<select name="project_name" id="project_name" style="width:180px;"><?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
  <input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
  <input type="text" value="" name="name1" id="name" class="new-input" placeholder="Enter Name" />
  <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />
  <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('finance/searchrec/?page=1'),

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
    <h4 style="float:right;"><a href="testcsv">Export To Excel</a></h4>
    <table class="table table-striped  table-bordered" style="font-size:12px;">
      <thead style="background:#666; border-color:#ccc; color:#fff;">
        <tr>
          <th ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/spacer.gif" style="width:50px;"   /> MS No.</th>
          <th>Name</th>
          
          <th>CNIC</th>
          <th>Plot Size</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Code</th>
          <th>Discount</th>
          <th>Due Amount</th>
          <th>Received Amount</th>
          <?php  foreach($model as $model1){
					   echo'<th width="5%">'.$model1['value'].'</th>';
					   }?>
        </tr>
      </thead>
      <tbody id="error-div">
      </tbody>
      <?php /*    foreach($cmdrow1 as $key){
			 $rowtotal = floatval($key['Due_Amount']);
			 
			 foreach($model as $modelt){
				 $rowtotal += floatval($key["due".$modelt['id'].$modelt['secid']]); 
			 }

		 	if($rowtotal>0)
			{
			 echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td>'.$key['email'].'</td><td>'.$key['code'].'</td><td>'.$key['discount'].'</td><td>'.$key['Due_Amount'].'</td><td>'.$key['Received_Amount'].'</td>
			 '; 
			 $count=count($key);
			 
			 foreach($model as $model2){
				 echo'<td>'.$key["due".$model2['id'].$model2['secid']].'</td>'; 
			 }
			}
			 
			}
			*/
			?>
    </table>
  </div>
</section>

<!-- section 3 --> 

