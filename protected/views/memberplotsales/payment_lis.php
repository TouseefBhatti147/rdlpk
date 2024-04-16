<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>

<script>	
 $(function(){
	  var project_name=$("#status").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/memberplotsales/searchreq11",
                  type:"POST",
                  data:"actionfunction=showData&page=1&status="+project_name,
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
	     url:"http://<?php echo $address ?>/index.php/memberplotsales/searchreq11",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
				  data:$("#user_login_form").serialize()+"&&page="+$page,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>








<style>.alert{  background: none repeat scroll 0 0 #f00;
    border: medium none #000;
    border-radius: 25px;
    color: #fff;
    position: fixed;
    width: 0;
	float: right;
    position: absolute;
	} </style>
<div class="shadow">

  <h3>Payment List</h3>
<div style="float:right;"><a href="Installment_lis"><h5>Installment List</h5> </a><div class="alert"><?php echo  $installment; ?></div></div>
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

   
<select name="project_id" id="project_id" style="width:180px;"><?php	
	
            $res=array();
            foreach($pro as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

  
    <select name="status" id="status"  style="width:180px;">
   
    <option value="new">New Payment</option>
    <option value="pending">Pending Payment</option>
    <option value="approved">Approved Payment</option>
   
	</select> 

<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Enter MS No" />
<input type="text" value="" name="vno" id="nno" class="new-input" placeholder="Voucher No" />
	 <?php 

?>

 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('/memberplotsales/searchreq11/?page=1'),

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

                         array("id"=>"login","class" => "btn-info button")      

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



  

            <table class="table table-striped table-new table-bordered" style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                        <th width="2%"><b>S# </b></th>
			<th width="10%"><b>MS # </b></th>
          
            <th><b>Plot No</b></th>
			<th><b>Account Head </b></th>

            <th><b>Due Rs</b></th>
			 <th><b>Paid Rs</b></th>
			<th><b>Due Date</b></th>

			<th><b>Payment Mode</b></th>

			<th><b> Voucher No</b></th>

			

			
            <th><b>Paid Date</b></th>
            <th width="12%"><b>Action</b></th>

                        

                        </tr>



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