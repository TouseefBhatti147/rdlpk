<div class="shadow">



  <h3>Advance Search:Files</h3>



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



    	<select name="project_id" id="project" style="width:180px;"><?php	







			if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{





				}







            $res=array();





			

           echo '<option value="se">Select Project</option>';

            foreach($projects as $key){







            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 







            }?></select> 

<span>Sector:</span>



    <select name="sector" id="sector"  style="width:180px;">
    <option value="">Sector</option>
    </select> 


    <span >Street:</span>



   <select style="width:180px;" name="street_id" id="street_id" >



	<?php



			if($st!=''){echo '<option value="'.$st.'">'.$st.'</option>'; }



  	?>







   <option value="">Select Street</option>



  <option value="street">street</option>











    



    </select> 
             <span>Type:</span>

     			<select name="com_res" id="com_res"  style="width:180px;"><?php 

	         	echo '<option value="">Select Property Type</option>';

			

			$res=array();

            foreach($com_res as $res){

            echo '<option value="'.$res['com_res'].'">'.$res['com_res'].'</option>'; 

            }?></select>

 <span>Size:</span>



    <select name="size" id="size"  style="width:180px;"><?php 



			



			if(!empty($size)){echo '<option value="'.$size.'">'.$size.'</option>'; }else{



				echo '<option value="">Select Size</option>';



				}



			$res=array();



            foreach($sizes as $siz){







            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 







            }?></select> 

  

<span >File #:</span>



<input type="text" value="<?php if($plotno!=''){echo $plotno; }?>" name="plotno" id="plotno" class="new-input" placeholder="Enter File No" />

  <span>Filter:</span>

   <select name="stat" id="stat" style="width:180px;">

    <option value="">Select filter</option>

  <!--  <option value="1">Re-allocated</option>-->

    <option value="2">Alloted</option>

    <option value="3">Not Alloted</option>

    <option value="4">Reserved</option>

       

    </select>

 <?php echo CHtml::ajaxSubmitButton(



                                'Search',



    array('/filessales/searchreq'),



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



                         array("id"=>"login","class" => "btn-info pull-right")      



                ); ?>



  







<!--  </form>-->



<?php $this->endWidget(); ?>







</section>



</div>



<!-- section 3 --> 



















 



  <div class="clear-fix"></div>







  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />



    -->











  </form>







  <div class="float-left">







            



            







            <table class="table table-striped table-new table-bordered">







            	<thead style="background:#666; border-color:#ccc; color:#fff;">







                    <tr>

						 <th width="6%">File Membership #</th>

                        <th width="8%">Project</th>



                       



                        <th width="5%">File No</th>



                        <th width="6%">Diemension</th>



                        <th width="5%">Size</th>



                        <th width="6%">Type</th>



                        <th width="5%">Sector</th>

 <th width="4%">Street</th>

                       

                        <th width="5%">Status</th>




                      
						


                        



                        </tr>







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
         	select_sector($(this).val());
		   });
     });


function select_sector(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Sector</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector").html(listItems);
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