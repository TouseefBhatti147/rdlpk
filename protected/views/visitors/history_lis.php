

<div class="dropdown" style="width:15px;" ></div>
<?php 

$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;

?>
<script>	

 $(function(){

	  var project_name=$("#project").val();	

 $.ajax({

	     url:"http://<?php echo $address ?>/index.php/visitors/searchhis",

                  type:"POST",

                data:"actionfunction=showData&page=1&project_name="+project_name,

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

	     url:"http://<?php echo $address ?>/index.php/visitors/searchmain1",

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
  <h3>Visit History</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<span style="float:left;">
	<h4>Visitor Details</h4>
<?php $res=array();
$msid=0; 
    foreach($visitors as $vis){             
	echo '<b>Name:</b>' .$vis['vname'].'</br>';
    echo '<b>Contact No :</b>' .$vis['contactno'].'</br>';
	  echo '<b>Email:</b>' .$vis['email'].'</br>';
	  //$msid=$mem['id'];
	} ?> 
	</span>
<section class="login-section margin-top-30">
<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<div class="clearfix"></div>
<div class="">
  <!-- Table -->
  <table class="table">
  <tr><td>Visit #</td><td>Visit Date</td></tr>
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