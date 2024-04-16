
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<style>
  th {background:#666; border-color:#ccc; color:#fff;}
  table{ font-size: 17px;}
  </style>										
<div>
<script>	
$(function(){
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"https://<?php echo $address ?>/index.php/finance/",
                  type:"POST",
                data:$("#user_login_form").serialize() + "&&page=1",
        cache: false,
       success: function(response){
		     $('#loading').hide();
		  $('#error-div').html(response);
		}
	   });
     $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"https://<?php echo $address ?>/index.php/finance/",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
          data:$("#user_login_form").serialize()+"&&page="+$page,
		cache: false,
        success: function(response){
			  $('#loading').hide();
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
}); 
</script>


<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">											
<div>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>
					 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
 <style>
  th {background:#666; border-color:#ccc; color:#fff;}
  table{ font-size: 17px;}
  </style>

 
<div class="shadow">
<ul class="nav nav-tabs">
    <li ><a  href="financial_reports">Sales Summary</a></li>
    <li><a  href="sales_centers">Sales Center</a></li>
    <li class="active"><a href="daily">Daily</a></li>
    <li ><a href="monthly">Monthly</a></li>
     <li><a href="yearly">Yearly</a></li>
  </ul>
  <h3>Daily Payment Summary</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
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

	<select name="project_id" id="project_id" style="width:180px;"><?php	
		
            $res=array();
            foreach($pro as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>'; 
            }?></select> 
 From: <input name="fromdate" placeholder="Enter From Date" type="text" class="new-input" id="fromdatepicker"> To: <input name="todate"  type="text" placeholder="Enter To Date" class="new-input" id="todatepicker">
 <img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">

 <?php echo CHtml::ajaxSubmitButton(
                                'Search',
 array('/finance/dailysummary/?page=1'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
                                               $("#loading").show()
            }',

                                        'complete' => 'function(){ 
                                             $("#user_login_form2").each(function(){});
                                             $("#login").attr("disabled",false);
                                               $("#loading").hide();
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                            }
                                        }' 
    ),                         array("id"=>"login","class" => "btn-info")      

                ); ?>
<?php $this->endWidget(); ?>

    <div class="col-sm-12">
                <div class="tabbable">                 
                  
                    <div class="tab-content no-padding">
                        <div class="tab-pane fade in active">

                            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table  id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr> 
                                                    <th class=" bg-blue white text-center" rowspan="2">Date</th> 
                                                    <th colspan="6" class="bg-blue white text-center"><?php echo date('F, Y');
?> Amount (PKR ) Payment Mode Wise</th>
                                                </tr>
                                                <tr>
                                                    <th class="amount-width bg-blue white text-center" >Cash</th>                                                    
                                                    <th class="amount-width bg-blue white  text-center">Cheque </th>
                                                    <th class="amount-width bg-blue white  text-center">PO </th>
                                                    <th class="amount-width bg-blue white  text-center">Online</th>
                                                    <th class="amount-width bg-blue white  text-center">JV</th>
                                                    <th class="amount-width bg-blue white  text-center bold">Total      </th>
                                                </tr>
                                            </thead>
                                            <tbody id="error-div"></tbody>
                         
                                            
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div><!-- /.col -->
                </div><!-- /.tabable -->

            </div>
      
</p>
   
     <!----End:Daily Sumary----->

  </div>
</div>


