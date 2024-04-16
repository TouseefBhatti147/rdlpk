<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/member/Searchactive",
                  type:"POST",
                 data:"actionfunction=showData&page=1",
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
	     url:"http://<?php echo $address ?>/index.php/member/Searchactive",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page,
				//  data:"actionfunction=showData&page="+$page,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>
<?php header('Cache-Control: max-age=900'); ?>

<div class="shadow">

  <h4>Active Members Directory</h4>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">



  <div class="">

    <p class="reg-left-textResult For"></p>

     

            <table class="table table-striped table-new table-bordered" style="font-size:12px;">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                       
                       

                        <th width="2%">S.No</th>  
                        <th width="5%">Name</th>
						  <th width="3%">Title</th>
                        <th width="5%">Father/Spouse</th>

                        <th width="4%">CNIC</th>
  						 <th width="4%">Phone</th>
                        <th width="6%">Email.</th>

                        <th width="9%">Adress</th>
						
                        <th width="7%">Last Login</th>
                         <th width="4%">Login Detail</th>
					
                        
 

                    </tr>

                </thead>

              
                <tbody id="error-div">



              


</tbody>

</table>

  </div>
  

 

 

  <script>
  $(document).ready(function()
     {  	

       $("#project").change(function()
  {        	select_street($(this).val());

		   });
		   $("#street_id").change(function()

        {
      	select_plot($(this).val());



		   });
       $("#country").change(function()
          {
        	select_city($(this).val());

		   });

     });

function select_city(id)
{

$.ajax({
      type: "POST",
      url:    "ajaxRequest3?val1="+id,
	  contenetType:"json",
     success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.city +" </option>";

}
);
listItems+= "<option value='' data-toggle=modal data-target=.bs-example-modal-sm  >Other</option>";

$("#city_id").html(listItems);

          }
});
}



</script> 
 

 </section>

<!-- section 3 --> 

