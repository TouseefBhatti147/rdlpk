<style>
.alert {
	background: none repeat scroll 0 0 #f00;
	border: medium none #000;
	border-radius: 25px;
	color: #fff;
	position: fixed;
	width: 0;
	float: right;
	padding:8px 86px 8px 14px;
	position: unset;
}
td {
	height:30px;
	vertical-align:middle !important
}
th {
	text-align:center !important;
	height:30px;
	vertical-align:middle !important
}
.new {
	text-align:center;
	border: 3px solid #eeeeee;
	border-radius: 24px;
	float: left;
	height: 155px;
	margin: 50px;
	padding: 5px;
	width: 146px;
}
</style>

<div class="dropdown" style="width:15px;" ></div>
<?php 

$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;

?>
<script>	

 $(function(){

	 var center_id=$("#center_id").val();	

 $.ajax({

	     url:"http://<?php echo $address ?>/index.php/visitors/searchcenter",

                  type:"POST",

                data:"actionfunction=showData&page=1&center_id="+center_id,

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

	     url:"http://<?php echo $address ?>/index.php/visitors/searchreq",

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
  <h3>Daily Sales & Marketing Report</h3>
</div>
<span style="float:right; font-size:14px;">Date:<?php echo date('d-m-Y');?></span> 
<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<input type="hidden" id="center_id" name="center_id" value="<?php  echo $_GET['center_id'];?>" />
<section class="login-section margin-top-30">
<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<div class="clearfix"></div>
<div class="">
  <table class="table-new table-bordered" style="font-size:12px;">
    <thead style="background:#666; border-color:#ccc; color:#fff;">
      <tr>
        <th width="4%">Serial #</th>
        <th   width="6%">Image</th>
        <th width="20%">Sales & Marketing Executive</th>
        <th width="15%"><img  width="25px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/visitors.png"> Visitors</th>
        <th width="15%" ><img width="33px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/caller.png"> Callers</th>
        <th width="15%"><img  width="25px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/booking.png">Booking</th>
      </tr>
    </thead>
    <tbody id="error-div">
    </tbody>
  </table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
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