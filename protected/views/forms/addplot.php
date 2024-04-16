<div class="">
<div class="shadow">
  <h3>Add Plots</h3>
</div>
<!-- shadow -->

<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots',
 'enableAjaxValidation'=>false,
'htmlOptions' => array('enctype' => 'multipart/form-data'),
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
				'stateful'=>true, 
	            'validateOnType'=>false,),
)); ?>

  
  
  
 
       <div class="float-left">
    <p class="reg-left-text">Total Plot <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5"> 
	<input  value="" type="text"  name="tno" id="tno" class="reg-login-text-field" />
	 </p>
  </div> 
   
 <input  value="<?php $_REQUEST['bid'] ?>" type="hidden" name="bid" id="bid" class="reg-login-text-field" />

   <div class="float-left">
    <p class="reg-left-text">Size<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="size_id" id="size"><?php	
	
            $res=array();
			foreach($size as $key){
            echo '<option value="'.$key['id'].'">'.$key['size'].'</option>'; 
            }?></select>
     </p>
  </div>
    
  <?php echo CHtml::ajaxSubmitButton(
                         'Add Plots',
    array('forms/addplots'),
	                        array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',

                                        'complete' => 'function(){ 
                                             $("#plots").each(function(){ });
                                             $("#submit").attr("disabled",false);
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
                                        }' ),
									 array("id"=>"login","class" => "btn-info pull-right")      ); ?>
  <?php $this->endWidget(); ?>
 </div>
 </section>
 
 <hr />
 <div class="clearfix"></div>
 <table class="table table-striped table-new table-bordered " style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                        <th width="7%"> ID#</th>
                        <th width="8%">Size</th>
                        <th width="10%">Total Plot</th>
                        <th width="7%">Balloting Title</th>
                        <th width="8%">Project </th>
                      
                        
						<th width="11%">Action</th>
                        </tr>
                </thead>
        <tbody>
        
		<?php 
		foreach($balloting as $row){
		echo '<tr>';
		echo '<td>'.$row['id'].'</td>
				<td>'.$row['size'].'</td>
				<td>'.$row['tno'].'</td>
				<td>'.$row['title'].'</td>
				<td>'.$row['project_name'].'</td>
				
				<td><a href="">Edit</a>/<a href="">Delete</a></td>';
		echo '</tr>';	
			}
		?>
        
        
                </tbody>
            </table>
<!-- section 3 -->
<!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>




