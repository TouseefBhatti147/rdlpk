<?php 
 
?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>
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

  <h3>Due Payment List</h3>
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
<select name="project_id" id="project_id" class="new-input">
<?php
            $connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 =   "select * from projects where";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
		$sql_project = $sql1;
		$sql_project = $sql_project.implode(' or',$sql2);
		
		
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

foreach($result_projects as $row)
{
echo '<option value='.$row['id'].'>'.$row['project_name'].'</option>';

}
?>
</select>

<input type="text" value="" name="ms" id="ms" class="new-input" placeholder="MS No" />
<input type="text" value="" name="mname" id="mname" class="new-input" placeholder="Member Name" />
<input type="text" value="" name="mcnic" id="mcnic" class="new-input" placeholder="Member CNIC" />

<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />
<input type="text" value="<?php echo date('d-m-Y'); ?>" name="dat" id="fromdatepicker" placeholder="Enter Date" class="new-input"/>
	 <?php 

?>

 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('searchpay'),

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



  



            

            



            <table class="table table-striped table-new table-bordered"  style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                        <th width="3%"><b>S# </b></th>
			<th width="7%"><b>P-Code</b></th>
            <th width="8%"><b>File/Plot No.</b></th>
            <th width="7%"><b>Plot Size</b></th>
			<th width="7%"><b>Street/Lane</b></th>

            <th width="7%"><b>Sector</b></th>
			 <th width="10%"><b>MS #</b></th>
			<th width="10%"><b>Member's Name</b></th>

			<th width="9%"><b>Member's CNIC</b></th>

			<th width="10%"><b>Details</b></th>

			<th width="8%" style="text-align:center;"><b>Due Date</b></th>

			
            <th width="8%" style="text-align:right;"><b>Due Amount</b></th>
            <th width="6%"><b>Delay</b></th>
            <th width="6%"><b>Remarks</b></th>

                        

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