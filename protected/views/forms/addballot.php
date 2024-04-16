<div class="">
<div class="shadow">
  <h3>Add Balloting </h3>
</div>
<!-- shadow -->
<style>
.float-left{margin:5px 5px !important;}
.btn{ padding:0px 7px !important;}
</style>
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
    <p class="reg-left-text">Title <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5"> 
	<input  value="" type="text"  name="title" id="title" class="reg-login-text-field" />
	 </p>
  </div> 
   <div class="float-left">
    <p class="reg-left-text">Details <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5"> 
	<input  value="" type="text"  name="details" id="details" class="reg-login-text-field" />
	 </p>
  </div> 
 <div class="float-left">
    <p class="reg-left-text">Total Plot <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5"> 
	<input style="    width: 100px;"  value="" type="text"  name="tplot" id="tplot" class="reg-login-text-field" />
	 </p>
  </div> 
 

   <div class="float-left">
    <p class="reg-left-text">Projects<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="project_id" id="project"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select>
     </p>
  </div>
    
  <?php echo CHtml::ajaxSubmitButton(
                         'Add Balloting',
    array('forms/addballots'),
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
 <div class="clearfix"></div>
 <div class="shadow">
  <h5>List of All balloting  </h5>
</div>
 <hr />
 <div class="clearfix"></div>
 <table class="table table-striped table-new table-bordered " style="font-size:12px;">
<thead style="background:#666; border-color:#ccc; color:#fff;">
 <tr>
 <th width="3%"> ID#</th>
                        <th width="8%">Title</th>
                        <th width="10%">Project</th>
                        <th width="15%">Details</th>
                        <th width="8%">Create Date </th>
                         <th width="6%">Draw Date </th>
                        <th width="4%">Status</th>
                        
						<th width="20%">Action</th>
                        </tr>
                </thead>
        <tbody>
        
		<?php 
		foreach($balloting as $row){
		echo '<tr>';
		echo '<td>'.$row['id'].'</td>
				<td>'.$row['title'].'</td>
				<td>'.$row['project_name'].'</td>
				<td>'.$row['details'].'</td>
				<td>'.$row['cdate'].'</td>
				<td>'.$row['ddate'].'</td><td>';
				
				if($row['status']=='1'){echo 'Closed';}else{echo 'Open';}
				echo '</td><td>';
				if($row['status']==1){
				echo '<a class="btn btn-info" href="bal_res?id='.$row['id'].'&pid='.$row['pid'].'">Search</a>-';}else{
				echo '<a class="btn btn-info" href="drawmain?bid='.$row['id'].'&pid='.$row['pid'].'">Draw</a>-';}
				if($row['status']=='0'){echo '<a class="btn btn-warning" href="addplot?bid='.$row['id'].'">Add Plots</a>-';
				echo '<a class="btn btn-danger" href="?bid='.$row['id'].'&pid='.$row['pid'].'">Delete</a>-';}
				echo '<a class="btn btn" href="balreport?id='.$row['id'].'">Details</a></td>';
		echo '</tr>';	
			}
		?>
        
        
                </tbody>
            </table>
<!-- section 3 -->
<!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



