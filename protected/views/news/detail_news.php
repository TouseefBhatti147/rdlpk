
<style>

.wc-text .btn-info {
	padding:10px 15px;
	border-radius:5px;
	color:#fff;
	text-decoration:none;
	}
	
.wc-text .btn-info:hover {
	background:#09F;
	}

</style>


<div class="my-content">
    	
        <div class="row-fluid my-wrapper">
<div class="shadow">
 <div class="span5 pull-right wc-text">

<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/news/news_list"  class="btn-info button">News List</a></span>
</div>
  <h3>News Detail</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<?php
$user_data = Yii::app()->session['user_array'];
 ?>
 



<form action="" method="post"> 
  
<div class="">
    <p class="reg-right-field-area margin-left-5">
     <table class="table-striped table-bordered table span12"><thead>
     	<th>
        	<td style="width:5%;"><b>Id</b></td>
            <td style="width:20%;"><b>Teaser</b></td>
            <td style="width:40%;"><b>Details</b></td>
             <td style="width:40%;"><b>Status</b></td>
             <td style="width:20%;"><b>Create Date</b></td>
            <td style="width:20%;"><b>Action</b></td>
        </th></thead>
    <?php	
            $res=array();
            foreach($detail_news as $key){
            echo '<tr><td></td><td>'.$key['id'].'</td><td>'.$key['teaser'].'</td><td>'.$key['details'].'</td><td>'.$key['status'].'</td><td>'.$key['create_date'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/news/update_news?id='.$key['id'].'">Edit</a></td></tr>'; 
            }?>
</table> 			
  	
    </p>
    <div class="clearfix"></div>
  </div>
  
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
 