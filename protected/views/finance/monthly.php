

<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">

<style>
  th {background:#666; border-color:#ccc; color:#fff;}
  table{ font-size: 17px;}
  </style>										
<div>
  <h2>Payments Receipts Status Summary</h2>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>

					 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
$(function(){
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/finance/monthlysummary",
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
	     url:"http://<?php echo $address ?>/index.php/finance/monthlysummary",
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
<div class="shadow">

 <ul class="nav nav-tabs">
    <li ><a  href="financial_reports">Sales Summary</a></li>
    <li><a  href="sales_centers">Sales Center</a></li>
    <li><a href="daily">Daily</a></li>
    <li class="active"><a href="monthly">Monthly</a></li>
     <li><a href="yearly">Yearly</a></li>
  </ul>
</div>
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

    <span>Project:</span>

    	<select name="project_id" id="project_id" style="width:180px;"><?php	
	if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
 <span>Year:</span>
 
 <select name="year1" id="year1" style="width:180px;">
 			<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>

  </select>

	
<img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">
 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('/finance/monthlysummary/?page=1'),
                                array(  

                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);
											  $("#loading").show();

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});
												 
                                             $("#login").attr("disabled",false);
											 $("#loading").hide();

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

                         array("id"=>"login","class" => "btn btn-info")      

                ); ?>

  



<!--  </form>-->

<?php $this->endWidget(); ?>



</section>

</div>

<div class="clearfix"></div>

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
                                                    <th class=" bg-blue white text-center" rowspan="2">Month</th> 
                                                    <th colspan="6" class="bg-blue white text-center"><?php //echo date('F, Y');
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


 

 













