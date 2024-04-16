<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
?>
<script>	
 $(function(){
	  
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/reciept/dealerssearch",
                  type:"POST",
                 data:"actionfunction=showData&page=1",
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
	     url:"http://<?php echo $address ?>/index.php/reciept/dealerssearch",
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
  <h3>Dealers List</h3>
</div>


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

   <input type="text" value="" name="name" id="name" style="width:160px;" class="new-input" placeholder="Name" />
   <input type="text" value="" name="cnic" id="cnic" style="width:160px;" class="new-input" placeholder="CNIC" />
 
   <?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('/reciept/dealerssearch?page=1'),
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

                         array("id"=>"login","class" => "btn")      

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
<table class="table table-striped table-new table-bordered">
  <thead style="background:#666; border-color:#ccc; color:#fff;">
   <th width="4%">ID</th>
   <th width="10%">Image</th>
   <th width="15%">Name</th>
   <th width="8%">CNIC</th>
   <th width="8%">Account #</th>
   <th width="8%">Total Amount</th>
   <th width="8%">Paid </th>
   <th width="8%">Verified Amount</th>
   <th width="8%">Action</th>
      </thead>
  <tbody id="error-div">
  </tbody>
</table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
<script>

 

 

 



  $(document).ready(function()



     {  	



		



       $("#project").change(function()



           {



         	select_street($(this).val());



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

	listItems+="<option value=''>Select Street</option>";



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";



      







});listItems+="";







$("#street_id").html(listItems);



          }



    });



}



</script>