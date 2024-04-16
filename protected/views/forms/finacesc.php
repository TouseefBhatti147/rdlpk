<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
$type=$_REQUEST['type'];
?>
<script>	
 $(function(){
	  var status=$("#status").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/forms/financereq",
                  type:"POST",
                  data:"actionfunction=showData&page=1&&type=<?php echo $type?>&&status="+status,
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
	     url:"http://<?php echo $address ?>/index.php/forms/financereq",
                  type:"POST",
                   data:$("#user_login_form").serialize()+"&&page="+$page+"&&type=<?php echo $type?>",
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

  <h3>Payments <span style="font-size:12px;">(<?php echo $_REQUEST['type']; ?>)</span></h3>

<div class="span12" >
  	<div class="clearfix"></div>
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

    <div class="float-left">
<label>Project:</label>
    	<select name="project_id" id="project" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
          
 </div> 	
<div class="float-left">
<label>Status:</label>
<select name="status" style="width:180px;">
<option value="0">New</option>
<option value="1">Approved</option>
<option value="2">On Hold</option>
<option value="3">Rejected</option>
<option value="4">Select All</option>
</select></div>
    <div class="float-left">
               <label>CNIC:</label>
     <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter CNIC No." />
</div> <div class="float-left">
             <label>Form No.:</label>
<input type="text" value="" name="formno" id="formno" class="new-input" placeholder="Enter Form No" />
<input type="hidden" value="<?php echo $_REQUEST['type'] ?>" name="type" id="type" class="new-input"  />
    
</div> 
 
<div class="float-left">
<label>Area:</label>
<?php 
 $connection = Yii::app()->db; 
$sql_seller  = "SELECT * from tbl_city";
$sellers = $connection->createCommand($sql_seller)->query();	
?>
<select name="city" style="width:180px;">
<option value="">Select Area</option>
<?php 
foreach($sellers as $row1){
	echo '<option value="'.$row1['city'].'">'.$row1['city'].'</option>';
	}
?>
</select></div>
 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

    array('/forms/financereq?type='.$type.'&&page=1'),

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

                         array("id"=>"login","class" => "btn btn-info")      

                ); ?>
			<?php $this->endWidget(); ?>
  			<div class="clearfix"></div>
            <div class="">



            

            



            <table class="table table-striped table-new table-bordered " style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						  <th width="3%"> S.No.</th>
                        <th width="6%"> Form #</th>
                        <th width="10%">App's Name </th>
                         <th width="6%">CNIC</th>
                        <th width="7%" >Paid Amount</th>
                        <th width="7%">Payment Mode</th>
                         <th width="7%">Reference</th>
 <th width="6%">Remarks/S-No:</th>
                        <th width="6%">Paid Date</th>
                       
						<th width="9%">View</th>
                        </tr>
                </thead>
        <tbody id="error-div">
                </tbody>
            </table>
  </div>
  </div>
</div>
<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 3px 12px;
	}
	.main-icons{ height:120px;}
	.float-left{ margin:0 5px;}
	.alert {
    background: none repeat scroll 0 0 #f00;
    border: medium none #000;
    border-radius: 25px;
    color: #fff;
    position: fixed;
    width: 0;
    float: right;
    position: absolute;
}
</style>
<!-- shadow -->


