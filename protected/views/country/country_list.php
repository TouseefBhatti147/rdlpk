

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




<span  style="float:right; margin:0  10px; 0 0"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/country/citieslist"  class="btn-info button">Cities List</a></span>

<span  style="float:right; margin:0  10px; 0 0"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/country/city"  class="btn-info button">Add City</a></span>

<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/country/country"  class="btn-info button">Add Country</a></span><span style="float:right"></span>



</div>

  <h3>Countries List</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<?php 

$user_data = Yii::app()->session['user_array'];

 ?>

 







<form action="" method="post"> 

  

<div class="">

    <p class="reg-right-field-area margin-left-5">
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                  <tr>						
                        <th width="2%"> Id</th>
                         <th width="6%">Country Name</th>
                                           
						<th width="4%">Action</th>
                        </tr>
</thead>
 <tbody id="error-div"> <?php	

            $res=array();
			$i=1;
            foreach($country as $key){

            echo '<tr><td>'.$i.'</td><td>'.$key['country'].'</td>
			<td>
			<a href="#" onclick="deletethis('.$key['id'].','.$key['id'].')">Delete</a>
			
			
			</td></tr>'; 
$i++;
            }?>
                </tbody>


</table> 			
 <script>
    function deletethis(id,idd){
		var x = confirm("Are you sure you want to delete?");
 
if(x == true){

window.location="Delete_country?id=" + id + "&&did=" + idd + "";

}
if(x == false){return false;}
}
    
    </script>

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>



 