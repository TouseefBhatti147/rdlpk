<div class="shadow">
  <h3>Add Dealer</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),

)); ?>

<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
      
    <select name="dealer" id="dealer">
     <option value="">Select Dealer</option>
     <?php
     foreach($dealer as $dealer)
	 {
	echo'<option value="'.$dealer['id'].'">'.$dealer['name'].'&nbsp;'.'--'.'('.$dealer['business_title'].')</option>';	 	 
	 }
	 ?>
     </select>
<input type="hidden" name="msid" id="msid" value="<?php echo $_REQUEST['msid'] ?>"
    </p>
  </div>
  <?php echo CHtml::ajaxSubmitButton(
                                'Add Dealer',
    array('adddealer'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#plots").each(function(){this.reset(); });
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
                         array("id"=>"submit","class" => "btn-info pull-right")      
                ); ?>
  <?php $this->endWidget(); ?>
<div>
  <div class="float-left">
                   
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                
                        <th width="8%">#</th>
                        <th width="11%">Name</th>
                        <th width="11%">Title</th>
                        <th width="11%">Phone</th>
                        <th width="10%">Action</th>
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                   <?php
				   $sno=0;
					
            $res=array();
            foreach($amemdetails as $key){
				$sno++;
            echo '<tr><td width="1%">'.$sno.'</td><td>'.$key['name'].'</td><td>'.$key['title'].'</td><td>'.$key['phone'].'</td><td>
			<a href="" class="btn">Delete</a><a href="#" class="btn">Details</a>
			
			</td></tr>'; 
            }?>
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#street_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
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
