<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script>
<button type="button" id="newsd" class="btn btn-primary btn-lg" style="display:none;" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>
<script>
$(document).ready(function() {
   $("#newsd").trigger('click');
});
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Project Wise Allotment Status:</h4>
      </div>
      <div class="modal-body">
       
       <?php
	   $connection = Yii::app()->db;
       $sql_payment  = "SELECT * FROM projects";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
		$sql_payment1  = "SELECT memberplot.*,projects.id as pid FROM memberplot
		left join plots on memberplot.plot_id=plots.id
		left join projects on plots.project_id=projects.id
		where memberplot.status='new' and memberplot.fstatus=''";
		$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
	   foreach($result_payments as $row){
		   $count=0;
		   echo '<p style="float:left;">'.$row['project_name'].'----</p>';
		   foreach($result_payments1 as $row1){
			   if($row1['pid']==$row['id']){$count++;}
			   }
		   echo '<p style="color:red;"><b>'.$count.'</b><p><br>';
		   }
	   
	   ?>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<div class="shadow">

  <h3>Allotment Property Request List</h3>

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
   
    <option value="new">New allotment</option>
 
    <option value="approved">Approved Request</option>
    <option value="pending">Pending Request</option>
	</select> 
     From: <input name="fromdate" placeholder="Enter From Date" type="text" class="new-input" id="fromdatepicker"> To: <input name="todate"  type="text" placeholder="Enter To Date" class="new-input" id="todatepicker">

<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />

	 <?php 

?>

 
 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('/Property/alotmentreq'),

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



</section>

</div>

<!-- section 3 --> 









 

  <div class="clear-fix"></div>



  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />

    -->





  </form>



  



            

            



            <table class="table table-striped table-new table-bordered">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <th width="6%">Plot Mem#</th>         
<th width="8%">Name</th> 
<th width="8%">S/o W/o D/o</th>
<th width="8%">CNIC</th>
<th width="5%">Property Name</th>
<th width="6%">Covered Area</th>
<th width="11%">Project</th>
<th width="6%">Action</th>



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