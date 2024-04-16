<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();
	  var stat=2;	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/memberplot/cancellationreqq",
                  type:"POST",
                 data:"actionfunction=showData&page=1&project_name="+project_name+"&stat="+stat,
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
	     url:"http://<?php echo $address ?>/index.php/memberplot/cancellationreqq",
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


<div class="shadow">



  <h3>Cancellation List</h3>



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



 <input type="text" value="" name="name1" id="name" class="new-input" placeholder="Seller Name" />



    <input type="text" value="" name="sodowo" id="sodowo" class="new-input" placeholder="Purchaser Name" />



<!--    <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />
-->
 



    <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="new-input" placeholder="Plot No" />


<select id="stat" name="stat" style="width:180px;">
<option value="2">Awaited Submission</option>
<option value="1">Submitted</option>

<option value="3" >Approved</option>
</select>
                  

 <?php echo CHtml::ajaxSubmitButton('Search',array('cancellationreqq?page=1'), array( 'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
       										     }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                        }',
					                   'success'=>'function(data){  
                                             if(data == 1){
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          									else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }}'     ),
                         array("id"=>"login","class" => "btn")      
                ); ?>
<?php $this->endWidget(); ?>



  <div class="">



    <p class="reg-left-textResult For"></p>



     



            <table class="table table-striped table-new table-bordered">



            	<thead style="background:#666; border-color:#ccc; color:#fff; font-size:12px;">



                    <tr>
						<th width="8%">MS #</th>
                        <th width="10%" >Seller</th>
                       
                        <th width="6%">Plot Size</th>
                        <th width="5%">Plot No.</th>
                        <th width="6%">Street/Lane</th>
                        <th width="6%">Bolck/Sector</th>
                        <th width="10%">Project Name</th>
                        <th width="5%">Status</th>
                        <th width="7%">Action</th>
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



