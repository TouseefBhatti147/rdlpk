



<div class="shadow">



  <h3>Allotment File Requests List</h3>



</div>



<!-- shadow -->



<hr noshade="noshade" class="hr-5 float-left">



<section class="reg-section margin-top-30">



<?php



$pages_data = Yii::app()->session['pages_array'];



?>



<div>



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



<form action="Memberfile_search_lis" method="post"> 



  <div class="clear-fix"></div>



   <select name="project_id" id="project" style="width:180px;">	



   

<?php



            $res=array();







            foreach($projects as $key1){







            echo '<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>'; 







            }?></select> 



  



    <input type="text" value="" name="username" id="username" class="new-input" placeholder="Enter Member Name" />



    <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="new-input" placeholder="Enter File No" />



   From: <input name="fromdate" placeholder="Enter From Date" type="text" class="new-input" id="fromdatepicker"> To: <input name="todate"  type="text" placeholder="Enter To Date" class="new-input" id="todatepicker">



   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>



 </div>



	</form>	



<form action="create" method="post"> 



  <div class="float-left">



	<table class="table table-striped table-new table-bordered">



    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="7%">Membership #</th><th width="10%">Member Name</th><th width="8%">Size Category</th><th width="8%">File No</th><th width="10%">Street</th><th width="10%">Project</th><th width="7%">Action</th><tr></thead>



			



		



			<?php	



			



		 



		  



            $res=array();



            foreach($memberfile_list as $key){



            echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td></td><td>'.$key['size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'</td><td>'.$key['project_name'].'</td><td><a target="_blank" href="req_detail?plot_id='.$key['plot_id'].'">View Request</a></td></tr>'; 



            }?>



  	</table>



  </div>



  



 



 <script>



 



  $(document).ready(function()



     {  	



		



       $("#project").change(function()



           {



         	select_street($(this).val());



		   });



		   



		   $("#street_id").change(function()



           {



         	select_plot($(this).val());



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



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";



  



});listItems+="";







$("#street_id").html(listItems);



          }



    });



}



 



 



 







	 



function select_plot(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest1?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



	  



var listItems='';



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";



    



});listItems+="";







$("#plot_id").html(listItems);



          }



    });



}







</script>



 



 </section>



<!-- section 3 --> 



