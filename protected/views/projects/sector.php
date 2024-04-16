
<div class="shadow">

  <h3>Add Sector</h3>

</div>


<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'sectors',
'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>


 
  <div class="float-left">
    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="project" id="project">
      <option value="">Please Select Project </option>
      <?php	
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
    </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Block Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="block_name" id="block_name">
      <option value="">Please Select Block </option>
      <?php	
            $res=array();
            foreach($blocks as $k){
            echo '<option value="'.$k['id'].'">'.$k['block_name'].'</option>'; 
            }?>
    </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Sector Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="sectorname" id="sectorname"  class="form-control" placeholder="Enter Project Code" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Discription<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <textarea type="text" value="" name="disc" id="disc" /></textarea>
     </p>
  </div>
   

<?php echo CHtml::ajaxSubmitButton(
                                'Add New Sector',
    array('projects/addsector'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#sectors").each(function(){ this.reset();});
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
                                        }' 
    ),
                         array("id"=>"login","class" => "btn-info pull-right")      
                ); ?>
  <?php $this->endWidget(); ?>
  <div class="clearfix"></div>
   <span style="color:#FF0000; display:block;" id="error-div"></span>
  <div class="">

    <p class="reg-right-field-area margin-left-5">

     <table class="table-striped table-bordered table span12"><thead>
        	<td style="width:5%;"><b>Id</b></td>
            <td style="width:20%;"><b>Project Name</b></td>
            <td style="width:20%;"><b>Block Name</b></td>
            <td style="width:25%;"><b>Sector Name</b></td>
			 <td style="width:20%;"><b>Details</b></td>
            <td style="width:10%;"><b>Action</b></td>

       </thead>

    <?php	

            $res=array();
                $i=1;
              foreach($sectors as $key){

            echo '<tr><td>'.$i.'</td><td>'.$key['project_name'].'</td><td>'.$key['block_name'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['create_date'].'</td>
            <td><a href="'.Yii::app()->request->baseUrl.'/index.php/projects/update_sector?id='.$key['id'].'">/Edit</a><a href="#" type="button" data-toggle="modal" data-target="#myModal">/Delete</a></td></tr>'; 
            $i++;
            }?>

</table> 			

  	

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">  
   <h5>Do you want to <b style=" color:#F00;">delete</b> Sector....?</h5>
  
    </div>
        <div class="modal-body">
          
          <a class="btn" href="<?php echo Yii::app()->request->baseUrl.'/index.php/projects/delete_sector?id='.$key['id']?>" >Yes</a>
          <button  type="button" class="btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">No</span></button>
        </div>
    
</div>

    </p>

    <div class="clearfix"></div>

  </div>