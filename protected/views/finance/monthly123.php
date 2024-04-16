<script>	
 $(function(){
   $('#loading').hide();

});
</script>

<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">



												
<div>
  <h2>Payments Receipts Status Summary</h2>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>

					 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

   </head>
  <body>   
  <ul class="nav nav-tabs">
    <li ><a  href="financial_reports">Sales Summary</a></li>
    <li><a  href="sales_centers">Sales Center</a></li>
    <li><a href="daily">Daily</a></li>
    <li class="active"><a href="monthly">Monthly</a></li>
     <li><a href="yearly">Yearly</a></li>
  </ul>
  <div class="tab-content">
  <!----Start:Slaes Sumary----->
  <style>
  th {background:#666; border-color:#ccc; color:#fff;}
  table{ font-size: 17px;}
  </style>
    
      <!----End:Slaes Summary----->
       <!----Start:Slaes centers Summary----->
    
     <!----End:Slaes Summary----->
      <!----Start:Daily Summary----->
    
      <h3>Monthly Receipt Summary</h3>
      <p>
         <span>Project:</span>
         <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form2',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>

    	<select name="project_id" id="project_id" style="width:180px;"><?php	
		
            $res=array();
            foreach($pro as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>'; 
            }?></select> 
          
            <select name="year" id="year" style="width:180px;">
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
                                             $("#login2").attr("disabled",true);
                                               $("#loading").show()
            }',

                                        'complete' => 'function(){ 
                                             $("#user_login_form2").each(function(){});
                                             $("#login2").attr("disabled",false);
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
                                                $("#error-div2").show();
                                                $("#error-div2").html(data);$("#error-div2").append("");
												return false;
                                            }
                                        }' 
    ),                         array("id"=>"login2","class" => "btn-info")      

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
                                            <tbody id="error-div2"></tbody>
                         
                                            
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
