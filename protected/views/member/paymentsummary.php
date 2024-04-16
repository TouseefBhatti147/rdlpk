<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<style>
    @media (max-width:450px) {
        .show-on-mobile {
            display: table-row;
        }
		
		

    }
	body
		{
			overflow:scroll;
			height:100px;
		}
</style>
<div class="page-content">
	<div class="page-header">
		<h1>Payment Summary</h1>
	</div><!-- /.page-header -->
	<div class="space-6"></div>
	<div class="">
<div class="">
<table id="table_bug_report" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Sr N0</th>
						<th> Property Type</th>
						<th>Size </th>
						<th>Total Price</th>
						<th>Total Amount Paid</th>
                        <th>Payable Amount</th>
                        <th>Project Name</th>
                        <th>App/Ms No Amount</th>
						
					</tr>
				</thead>
<tbody id="data">
 
</tbody>
</table>
 

</div>
<div class="span4">
</div>
<div class="span4">
<img style="float:center" id="loading" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading1.gif">
</div>

<!--/span--> 
</div>
<!--/row-->

<!-- PAGE CONTENT ENDS HERE --> 
</div>
<!--/row--> 

</div>

<script>
$(document).ready(function () 
{
$.ajax({    
        type: "GET",
        url: "MyPaymentsummary",             
        dataType: "html",                  
        success: function(data){ 
		                   
            $("#data").html(data); 
			$('#loading').hide();
           
        }
    });	
});
</script>