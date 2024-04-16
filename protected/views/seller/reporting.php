<div class="shadow">
  <h3>Reporting</h3>
  
</div>

<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<style>
.bgd { background-color:#999; }
.float-left{ height:auto;}
.main-icons{ height:auto;}
.main-icons {
background: none repeat scroll 0 0 #A9FCFF;
border-radius: 10px;
box-shadow: 0 0 45px -24px inset;
margin: 7px;
padding: 10px 0;
text-align: center;

}

</style>
<section class="reg-section margin-top-30">
<div class="span12"><a href=""></a>
<form action="reportmain" method="post">
<div class="modal-body" style="text-align:center;"> <h4>Select Project</h4>
	
       <select name="project" id="project">
<?php 

        $connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 =   "select * from projects where";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
		$sql_project = $sql1;
		$sql_project = $sql_project.implode(' or',$sql2);
		
		
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();

foreach($result_projects as $row)
{
echo '<option value='.$row['id'].'>'.$row['project_name'].'</option>';

}
?>
</select>
      </div>
         
<input type="submit" name="report" value="Overall Summary Sheet" class="span4 main-icons" class="btn btn-primary btn-lg" />
<input type="submit" name="dreportr" value="Detail Report(Residentail)" class="span4 main-icons" class="btn btn-primary btn-lg" />
<input type="submit" name="dreportc" value="Detail Report(Commercial)" class="span4 main-icons" class="btn btn-primary btn-lg" />
<input type="submit" name="dreporta" value="Allotment Summary" class="span4 main-icons" class="btn btn-primary btn-lg" />
<input type="submit" name="dreportt" value="Transfer Summary" class="span4 main-icons" class="btn btn-primary btn-lg" />
<input type="submit" name="dreportre" value="Reallocation Summary" class="span4 main-icons" class="btn btn-primary btn-lg" />
<input type="submit" name="dreportre" value="Allotted Plot Summary" class="span4 main-icons" class="btn btn-primary btn-lg" />
</form>



</div>

<div>
 
 </div>
  
  
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
 
 <script>
 
 
 

  $(document).ready(function()

     {  	

		

       $("#asd").change(function()

           {
			
			sohaib+=123;
         	$("#sohaib").html(sohaib);

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

</script>