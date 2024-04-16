<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
   $('#loading').hide();
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"https://<?php echo $address ?>/index.php/plots/searchreq121",
                  type:"POST",
                data:$("#user_login_form").serialize() + "&&page=1",
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
	     url:"https://<?php echo $address ?>/index.php/plots/searchreq",
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
<div class="shadow">

  <h3>Files Balloting Data<?php if((Yii::app()->session['user_array']['per2']=='1')&& isset(Yii::app()->session['user_array']['username']))
{?>
<?php }?></h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">
<ul class="nav nav-tabs hide-on-print" id="myTab">

       <li class="active">
        <a class="ajaxlink" href="#">
            <i class="red ace-icon fa fa-cog fa-spin bigger-120 shake"></i>
           Manage File Ballot Data
        </a>
    </li>
    <li class="hover blue" >
        <a class="ajaxlink" href="paid_perc_files_count">
            <i class="red ace-icon fa fa-cog fa-spin bigger-120 shake"></i>
           Paid % Wise Files Count
        </a>
    </li>

</ul>

<div id="received" style="margin-left:5px;margin-right:5px; background-color:moccasin;border:1px solid; float:right;">
<form name="filterform" method="post" action="FilterData" id="filterform" ajax="true"> 
<h6 style="float:left;margin-right:15px;">Balloting Criteria <input placeholder="Min Paid amount%" style="width:120px;" id="min" name="min" type="text" value=""></h6>        
<!--<h6 style="float:left;margin-right:15px;">Max:    <input placeholder="Max Paid amount%" style="width:120px;" id="max" name="max" type="text" value=""></h6>---> 
<input type ="submit" name="filter" value="Filter Record" style="float:left;margin-right:15px;margin-top:15px;">      

</form>
<div id="result-page" style="display:none"></div>

</div>
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
    	<select name="project_id" id="project_id" style="width:180px;">
      <?php	
	if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select>  
 
 <select name="sector" id="sector" style="width:180px;">
  <option value="">Select Sector</option>
  </select>
  
<img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">
 <?php echo CHtml::ajaxSubmitButton(
                                'Create Files Balloting',
     array('/allotments/filesdata/?page=1'),
                                array(  
                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);
                                              $("#loading").show()

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});

                                             $("#login").attr("disabled",false);
                                             $("#loading").hide();
                                        }',

                   'success'=>'function(data){  

                                           //  var obj = jQuery.parseJSON(data); 

                                            // View login errors!

        
                                           ;
                                             if(data == 1){

												// alert("we are here");

                                         location.href = "httpss://rdlpk.com/index.php/user/dashboard";

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

</section>
</div>
<div class="clearfix"></div>
  <div class="">
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="2%">Sr# </th>
                        <th width="5%">MS# </th>
                        <th width="3%">Type</th>
                        <th width="3%">Plot No</th>
                        <th width="7%">Project</th>
                        <th width="5%">Plot Size</th>
                        <th width="5%">Dimension</th>
                       
                       
                         <th width="4%">Street</th>
                        <th width="4%">Sector</th>
                        <th width="5%">Due Amount</th>
                    	 <th width="5%">Paid Amount</th> 
                       <th width="4%">Paid Percentage</th>
                       <th width="4%">Merge</th>                
                        </tr>
                </thead>
                <tbody>
                <?php 
                $count='';
                  foreach($plotsdata as $key){
                    $count++;        
                    $home="";
                    $home=Yii::app()->request->baseUrl;
                    echo '<tr><td>'.$count.'</td><td>';if(!empty($key['plotno'])){ echo $key['plotno'];}else{ echo $key['app_no'];}  echo'</td>  <td>'.$key['type'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['plot_size'].'</td>
                  
                    <td>'.$key['street'].'</a></td><td>'.$key['sector_name'].'</td><td>'.$key['due_amount'].'</td>
                    <td>'.$key['paid_amount'].'</td><td>';
                     echo round($key['paid_perc']).'%';
                    echo' </td>
                    <td>';if($key['bid']==1){ echo 'Balloted';}else{ echo'<a href="Merge?plot_id?'.$key['plot_id'].'">Merge</a>';}echo'</td>
                    ';
                  }
                  ?>

                </tbody>
            </table>
  </div>
<script>
$(document).ready(function (e) {
  $("#project_id").change(function()
           {
            select_sector($(this).val());
		   });
    
       function select_sector(id)
{
	var pro=$("#project_id").val();
	
$.ajax({
      type: "POST",
	   url:    "ajaxSector?pro="+pro,
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


$("form[ajax=true]").submit(function (e) {

    e.preventDefault();

    var form_data = $(this).serialize();
    var form_url = $(this).attr("action");
    var form_method = $(this).attr("method").toUpperCase();

    $("#loadingimg").show();

    $.ajax({
        url: "FilterData",
        type: "POST",
        data: $(this).serialize(),
        cache: false,
        success: function (returnhtml) {
            $("#result-page").append(returnhtml).show();
            $('filterform').hide();
            $("#loadingimg").hide();
          
        }
    });

});

});

</script>