
<div class="shadow">
  <h3>Dealers </h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php 
$connection = Yii::app()->db;  
$sql  = "SELECT * FROM members where mtype ='Dealer' and id='".$_REQUEST['id']."'" ;
$result_dealer = $connection->createCommand($sql)->queryRow();
echo '</br>';
echo '<b>Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result_dealer['name'].'</br>';
echo '<b>CNIC:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result_dealer['cnic'].'</br>';
echo '<b>phone:</b>&nbsp;&nbsp;&nbsp;'.$result_dealer['phone'].'</br>';
echo '<b>Address:</b>'.$result_dealer['address'].'</br>';
echo '<b>SODOWO:</b>'.$result_dealer['sodowo'].'</br>';
?>




  
  <div class="float-left">
   
    <p class="reg-right-field-area margin-left-5">
     <table class="table table-striped table-new table-bordered">
     <thead style="color:#FFF">
     <th>Plot Size</th>
     <th>Total</th>
     <th>Sale</th>
     <th>Remaining</th>
     
     </thead>
     <tbody>
     <?php 
		$sqls  = "SELECT * FROM size_cat" ;
		$result_dealers = $connection->createCommand($sqls)->queryAll();	
foreach($result_dealers as $row){
		$sqlp  = "SELECT * FROM memberplot 
		Left Join plots on(memberplot.plot_id=plots.id)
		where mmtype ='Dealer' and memberplot.member_id='".$_REQUEST['id']."' and plots.size2=".$row['id'];
		$result_dealerp = $connection->createCommand($sqlp)->queryAll(); 
		
		$sqlh  = "SELECT * FROM plothistory 
		Left Join plots on(plothistory.plot_id=plots.id)
		where mmtype ='Dealer' and plothistory.transferfrom_id='".$_REQUEST['id']."' and plots.size2=".$row['id'];
		$result_dealerh = $connection->createCommand($sqlh)->queryAll(); 
echo '<tr>
<td>'.$row['size'].'</td>
<td>'.(count($result_dealerp)+count($result_dealerh)).'</td>
<td>'.count($result_dealerh).'</td>
<td>'.((count($result_dealerp)+count($result_dealerh)-count($result_dealerh))).'</td>
</tr>';


}
	 ?>
     
     </tbody>
     </table> 			
  	
    </p>
  </div>
<?php //$this->endWidget(); ?>
 
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#street_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#plot_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
    });
}

</script>
 
 </section>
<?php 
$pages_data = Yii::app()->session['pages_array'];
?>