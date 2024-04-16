<style>.alert{  background: none repeat scroll 0 0 #f00;
    border: medium none #000;
    border-radius: 25px;
    color: #fff;
    position: fixed;
    width: 0;
	float: right;
	padding:8px 86px 8px 14px;
    position: unset;
	} td{ width:200px;}
    .new {
text-align:center;
    border: 3px solid #eeeeee;
    border-radius: 24px;
    float: left;
    height: 155px;
    margin: 50px;
    padding: 5px;
    width: 146px;
}</style>

<div class="dropdown" style="width:15px;" ></div>
<?php 

$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;

?>
<script>	

 $(function(){

	  var project_name=$("#project").val();	

 $.ajax({

	     url:"http://<?php echo $address ?>/index.php/visitors/searchreq",

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
  <h3>Advance Search:My List</h3>
</div>
<div style="float:right"><a href="visitors_lis"><div class="alert"><?php echo $result.'&nbsp;FollowUp';?></div></a></div>
<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30"> 
  
   <div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<div class="clearfix"></div>
<div class="">
  <table class="table table-striped table-new table-bordered" style="font-size:12px;">
    <thead style="background:#666; border-color:#ccc; color:#fff;">
      <tr>
        <th width="4%">Serial #</th>
         <th width="5%">Visit Date</th>
        <th width="8%">Name</th>
        <th width="5%">Profession</th>
        <th width="5%">Contact#</th>
        <th width="5%">Email</th>
        <th width="5%">City</th>
        <th width="4%">Refered By </th>
 		<th width="4%">Reference </th>
       
		<?php

		if(Yii::app()->session['user_array']['per1']=='1')

			{



             echo'              

						<th width="5%">Action</th>';}



                        else{ 

						echo'';}?>
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