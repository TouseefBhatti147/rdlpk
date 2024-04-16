<?php include 'sprt.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" media="print" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/my-style.css" />
<link rel="stylesheet" type="text/css" href="css/custom.css" />
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="js/jquery.fileupload.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="jquery.imagemapster.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body style="background-color:#FFf;" >

<style>
#selections{  clear: both;
  background-image:url(images/info1.jpg) !important;
 line-height: 18px !important;
  }
</style>

<?php
include "../new.php";
$connection = Yii::app()->db;
//echo $_GET['project_id'];exit;
//if(!isset($_POST['street'])){$_POST['street']=1;}
if(!isset($_GET['project_id'])){ $_GET['project_id']=1;}


$sql  = "SELECT * FROM dmap where project_id='".$_GET['project_id']."'";
$result = $connection->createCommand($sql)->queryAll();

$sql12  = "SELECT * FROM projects where id='".$_REQUEST['id']."'";
$res = $connection->createCommand($sql12)->queryRow();
 ?>





<div class="span12" style=" background-color: #0C9A01;
    width: 100%;
    margin-left: 0 !important;
    color: #fff;
    margin-bottom: 10px; ">
<h3>Geographical Interaction </h3>
</div>
<div class="span12">
<div class="span3" id="new" style="background-color: #fff;
    padding: 14px;
    border-radius: 10px; width:270px; border: 1px solid #DADADA;
    box-shadow: 0px 8px 30px -8px; right:30px;">

<div style="margin-bottom:65px;">
<div>

<form method="post" action="gmap.php">
<input type="hidden" value="<?php echo $_GET['project_id']; ?>" id="project_id" name="project_id" />
<select  name="project" id="project" style="height:36px; width:200px;">
 <h3>Town Planning</h3>
<?php


if($_GET['project_id']==''){
	echo'<option value="">Select Project</option>';}
else{
	
	

 $sqlproooo  = "SELECT * FROM projects ";
$resproooo = $connection->createCommand($sqlproooo)->queryAll();


foreach($resproooo as $respr1ooooo)
{
echo'<option value="'.$respr1ooooo['id'].'">'.$respr1ooooo['project_name'].'</option>';

}}
?>

</select ><br />

 

 <?php   	

 $sql_size  = "SELECT * FROM size_cat ";
$result_size = $connection->createCommand($sql_size)->queryAll();

foreach($result_size as $result_size11)
{

echo '<a class="btn" onClick="hello'.$result_size11['id'].'();">'.$result_size11['size'].'</a>';
}?>
<br />
<br />
<input type="submit" name="submit" style="margin-top:-19px;"  value="Search" class="btn" />
  <h3>Members Layer</h3>
  <input type="text" name="cnic" placeholder="Enter CNIC" style=" width:200px;"  /> 
  <br /><br />
<input type="submit" name="submit" style="margin-top:-19px;"  value="Search" class="btn" />
 <h3>Members Villas</h3>
  <input type="text" name="memno" placeholder="Enter Membership No." style=" width:200px;"  /> 
  <br /><br />
<input type="submit" name="submit" style="margin-top:-19px;"  value="Search" class="btn" /></div>



</form>
<div style="float:left">
<a class="btn btn-primary dropdown-toggle"onClick="Res();">Res</a>
<a class="btn btn-primary dropdown-toggle"onClick="Com();">Com</a>
<a class="btn" onClick="hello2();">Map</a>
<a class="btn btn-success" onClick="hello();" >Available</a>
<a class="btn btn-warning dropdown-toggle" onClick="hello1();">Sold</a>


</div>

<?php 
	 $sqlplot  = "SELECT * FROM dmap where project_id='".$_GET['project_id']."' ";
$resplot = $connection->createCommand($sqlplot)->queryAll();
	
	?>
  



</div>
<div id="selections" style="clear:both; display:none;" > </div>
</div></div>
<div class="span12">
<div style="margin::0px 0px 10px 0px; position:absolute; z-index:1000;">
 <button class="btn" style="font-weight:800; background-color:#0C9;" OnClick="return ZoomIn();" >+</button>
<button class="btn" style="font-weight:800; background-color:#0C9;"  OnClick="return ZoomOut();" >-</button>
</div>
<div style="height:636px; width:1700px; overflow:hidden; float:left; background-color:#FFF; ">
<div id="veg_demo" style="zoom: 150%;margin:0 auto; text-align:center; margin-left:-100px;  ">
	<div class="span12" >
    <div class="span8">
	<div>
	<img id="veg" src="<?php echo 'http://rdlpk.com/images/projects/'.$res['project_map']; ?>" usemap="#veg" width="852px;" >
	</div>
    <div style="clear:both; height:8px;"></div>
   </div>
   <div class="span3">
   
    <div style="position:absolute; margin: 389px 0px 20px 50px;
  opacity: 19;">

</div>
    
</div></div>
</div> 
</div>


</div>
<script type="text/javascript">

	
	document.querySelector("#selections").style.display = "block";	
$(document).ready(function () {
	   var image = $('img');
	   var xref = {
		   <?php $sohaib=1;
		  
foreach($result as $row)
{
		 $sql3  = "SELECT * FROM dmap
		 left join plots p on(dmap.id=p.shap_id)
		 left join memberplot mp on(mp.plot_id=p.id)
		 left join members m on(mp.member_id=m.id)
		 left join streets s on(p.street_id=s.id)
		  left join sectors se on(p.sector=se.id)
		 left join projects pro on(p.project_id=pro.id)
	     where dmap.id='".$row['id']."' ";
$res3 = $connection->createCommand($sql3)->queryRow();

	if($sohaib!==1){echo ',';}
$sohaib++;
echo $row['type'].$row['id'].':"<br>'.$res3['plotno'].'<br>'.$res3['name'].'<br>'.$res3['plot_detail_address'].'/'.$res3['street'].'/'.$res3['sector_name'].'<br>'.$res3['project_name'].'<br><br><br>'.'<p><a href='.'images/update.php?id='.$row['id'].'&&pid='.$row['project_id'].'>Update</a><br><a href='.'../index.php/plots/plots?id='.$row['id'].'>Assign Plot </a><br><a href='.'delete.php?id='.$row['id'].'>Delete</a></p>"
' ;
}
/*?>	if($sohaib!==1){echo ',';}
$sohaib++;
echo $row['type'].$row['id'].':"<br>'.$res3['name'].'<br>'.$res3['plotno'].'<br>'.$res3['cnic'].'<br>'.$res3['email'].'<br>'.$row['plot_detail_address'].'<br>'.$row['sector'].'/'.$row['street_id'].'<br>'.$res3['project_name'].'<br>'.'<p><a href='.'images/update.php?id='.$row['id'].'&&pid='.$row['project_id'].'>Update Location</a><br><a href='.'../index.php/plots/plots?id='.$row['id'].'>Update Plot Information</a></p>"
 ;
}<?php */


?>
	   		
	   };
	   var defaultDipTooltip = 'I know you want the dip. But it\'s loaded with saturated fat, just skip it and enjoy as many delicious, crisp vegetables as you can eat.';

	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
			selected : true,
            onClick: function (e) {
                var newToolTip = defaultDipTooltip;
                $('#selections').html(xref[e.key]);
                if (e.key==='asparagus') {
                	newToolTip = "OK. I know I have come down on the dip before, but let's be real. Raw asparagus without any of that " +
                			"delicious ranch and onion dressing slathered all over it is not so good.";
                }
                image.mapster('set_options',{areas: [{
                	key: "dip",
                	toolTip: newToolTip
                	}]
                });
            },
            showToolTip: true,
            toolTipClose: ["tooltip-click", "area-click"],
            areas: [
    {
                	
					key: "1q1",
                	fillColor: "000"
                },
	            
                ]
        });
      });
      </script>
      <?php
//	print_r($_GET);
	  ?>
<map id="veg_map" name="veg">
	<?php
 $sql1  = "SELECT * FROM dmap where project_id='".$_GET['project_id']."' ";
$result1 = $connection->createCommand($sql1)->queryAll();
	
foreach($result1 as $row1)
{if($row1['map']!==''){$tag='';$tagres='';$size='';
	if($row1['status']=='Alotted'){$tag='red';}else{$tag='green';}
	if($row1['com_res']=='Residential'){$tagres='yellow';}else{$tagres='blue';}
	
//echo '<area shape="poly" name="'.$row1['type'].$row1['id'].','.$tag.'" coords='.$row1['map'].' href="#"/>';
echo '<area shape="poly" name="'.$row1['type'].$row1['id'].','.$tagres.','.$tag.','.$row1['size2'].'" coords='.$row1['map'].' href="#"/>';
}}?>

</map>



<script type="text/javascript">  
     


	    function ZoomIn() {  
            var ZoomInValue = parseInt(document.getElementById("veg_demo").style.zoom) + 10 + '%'  
            document.getElementById("veg_demo").style.zoom = ZoomInValue;  
            return false;  
        }  
  
        function ZoomOut() {  
            var ZoomOutValue = parseInt(document.getElementById("veg_demo").style.zoom) - 10 + '%'  
            document.getElementById("veg_demo").style.zoom = ZoomOutValue;  
            return false;  
        } 
         function Zoomorg() {  
            var ZoomOutValue = parseInt(100) + '%'  
            document.getElementById("veg_demo").style.zoom = ZoomOutValue;  
            return false;  
        }  

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
      url:    "ajaxRequest.php?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	//  success: function(data){alert(JSON.stringify(data));
var listItems='';
	listItems+= "<option value=''>Select Street</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street").html(listItems);
          }
    });
}

    </script>
    
<?php
if(isset($_GET['project_id'])){
	echo'<script>
	var id ='.$_GET['project_id'].';
     
	
$.ajax({
	 
	  type: "POST",
      url:    "ajaxRequest.php?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	//  success: function(data){alert(JSON.stringify(data));
var listItems="";
	
	$(json).each(function(i,val){
	listItems+= "<option value=" + val.id + ">" + val.street + "</option>";
});listItems+="";
$("#street").html(listItems);
          }
    });

</script>';
}
	

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#veg_demo" ).draggable();
	 $( "#selections" ).draggable();
	  $( "#new" ).draggable();
  });
  </script>
</body></html>