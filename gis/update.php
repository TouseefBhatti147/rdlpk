<?php include 'sprt.php';
include "../new.php";
?>

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
<style>
</style>
<body style="background-color:#FFf;" >

<div style="background-color: #fff;
    padding: 14px;
    border-radius: 10px; width:300px; border: 1px solid #DADADA;
    box-shadow: 0px 8px 30px -8px; right:30px;">
<h3>Update Information</h3>   
<?php 
$connection = Yii::app()->db;




$sql3  = "SELECT * from plot_reserved where plot_id='".$_REQUEST['id']."' ";
$res3 = $connection->createCommand($sql3)->queryRow();	
if(count($res3)>1){?>
<form method="post" id="user_login_form" action="update.php?id=<?php echo $_REQUEST['id']?>" id="newf">
 <label>Name</label>
<input type="hidden" id="type1" name="type1"  value="1122"/>
<input type="hidden" id="plot_id" name="plot_id"  value="<?php echo $_REQUEST['id']?>"/>
<input type="text" name="name" id="name" value="<?php echo $res3['name']?>"  />
 <label>For</label>
<input type="text" name="for" id="for" value="<?php echo $res3['for']?>" />
 <label>Comment</label>
<textarea name="comm" id="comm"><?php echo $res3['comm']?></textarea>
 <label>Allotment Type</label>
<select name="type" id="type">
<option><?php echo $res3['type']?></option>
<option>Against land</option>
<option>On Payment</option>
</select> 
<input type="button" id="submit" class="btn" value="Submit"/>
</form>
<?php }else{?> 
 <form method="post" id="user_login_form" action="update.php?id=<?php echo $_REQUEST['id']?>" id="newf">
 <label>Name</label>

<input type="hidden" id="plot_id" name="plot_id"  value="<?php echo $_REQUEST['id']?>"/>
<input type="text" name="name" id="name"  />
 <label>For</label>
<input type="text" name="for" id="for" />
 <label>Comment</label>
<textarea name="comm" id="comm"></textarea>
 <label>Allotment Type</label>
<select name="type" id="type">
<option>Against land</option>
<option>On Payment</option>
</select> 
<input type="button" id="submit" class="btn" value="Submit"/>
</form>
<?php }?>
<div id="error-div" style="color:red; font-size:15; font-weight:bold;"></div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
     $("#submit").click(function(){
       
	   $.ajax({
	     url:"updatere.php",
                  type:"POST",
                  data:$("#user_login_form").serialize(),
				//  data:"actionfunction=showData&page="+$page,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
</script>
</body>

</body></html>