<head>
 
    <!-- This will refresh page in every 5 seconds, change content= x to refresh page after x seconds -->
</head>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {

$( "#uptodate1" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});


</script>
<style>
.td {
	text-align:right;
}
</style>

<hr noshade="noshade" class="hr-5">
<div style="

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-status"></span>
   <span style="color:#FF0000; display:block;" id="error-comments"></span>
     <span style="color:#FF0000; display:block;" id="error-moc"></span>
   </div>
<span style="float:right;">
<h4>Member Details</h4>
<?php 

 //$mp_id

// $res=array();
$msid=0; 
    foreach($result as $mem){             
	echo '<b>Name:</b>' .$mem['name'].'<br/>';
    echo '<b>CNIC :</b>' .$mem['cnic'].'<br/>';
	  echo '<b>Membership # :</b>' .$mem['plotno'].'<br/>';
	  $msid=$mem['id'];
	} ?>
</span>
<?php  $numbers=0;?>
<h4>Plot Details</h4>
<?php $res=array();
$pro='';
    foreach($info as $row){
		 echo '<b>Project     :</b>&nbsp;&nbsp;&nbsp;' .$row['project_name'].'</br>';
$pro=$row['project_id'];
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
if($row['type']=='file'){echo '<b>File Size  :</b>';}else {echo '<b>Plot Size:</b>';}
    echo '&nbsp;&nbsp;' .$row['size'].'&nbsp;('.$row['plot_size'].')'.'</br>';

	if($row['type']=='file'){
		echo '<b>File No:</b>';
		} 
		else{
			echo '<b>Plot No: &nbsp;&nbsp;&nbsp;&nbsp;</b>';
			}
	echo $row['plot_detail_address'].'</br>';		
			echo '<b>Location     :</b>&nbsp;' .$row['street'].'/'.$row['sector_name'].'</br>';
   
	$price=$row['price'];
	} 
	if(empty($_GET['mp_id'])){
		  echo $mp_id;
		  }else{ 
		  $mp_id= $_GET['mp_id'];
		  }
		  if(empty($_GET['plotid'])){
		  echo $plotid;
		  }else{ 
		  $plotid= $_GET['plotid'];
		  }
	 ?>
    <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

<hr noshade="noshade" class="hr-5">
 <div id="content">
<table  class="table table-striped table-new table-bordered" style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="3%">S.No.</th>
						<th width="4%">Username</th>
                       <th width="8%">Comment</th>
                       <th width="5%">Contact Date</th>
                        <th width="5%">Reminder Date</th>
                       <th width="5%">Mode Of Contact</th>
                         <th width="5%">Contact Status</th>
                       </tr>
                </thead>
               <tbody>
			   <?php $connection = Yii::app()->db; 
 $sql="SELECT user.firstname,user.middelname,user.lastname,memberplot.plotno,memberplot.id,memberplot.member_id,members.name,members.cnic,recovery_comments.followup_status,recovery_comments.date as rdate,recovery_comments.comments,recovery_comments.user_id,recovery_comments.moc,recovery_comments.next_reminder from recovery_comments  
 left join memberplot on memberplot.id=recovery_comments.mp_id
 left join members on memberplot.member_id=members.id
 left join user on recovery_comments.user_id=user.id
  where recovery_comments.mp_id='".$mp_id."'";
	
	   $result=$connection->createCommand($sql)->query();

				$i=1;
				foreach($result as $key){
					echo'<tr><td>'.$i.'</td>';
					echo'<td>'.$key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp'.$key['lastname'].'</td>';
					echo'<td>'.$key['comments'].'</td>';
					echo'<td>'.$key['rdate'].'</td>';
					echo'<td>'.$key['next_reminder'].'</td>';
					echo'<td>'.$key['moc'].'</td>';
					echo'<td>';if($key['followup_status']==0){echo'<span style="color:red;"> Not Contacted</span>';}if($key['followup_status']==1){ echo'<span style="color:green;">Contacted</span>';}echo'</td>';
					echo'</tr>';
					$i++;
					}?>
</tbody>
</table>

</div>

<section class="reg-section margin-top-30">
<form method="post" action="Addcomments" ajax="true" onsubmit="return validateForm()"> 
 <div class="float-left">
    <p class="reg-left-text">Contact Status:<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
 <select id="status" name="status" onchange="getVal()">
 <option value="">Select Status</option>
 <option value="1">Contacted</option><option value="2">Not Contacted</option>
 </select>    </p>
  </div>
  
  <div class="float-left">
    <p class="reg-left-text"><font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="hidden" value="<?php if(empty($_GET['mp_id'])){
		  echo $mp_id;
		  }else{ 
		  echo $_GET['mp_id'];
		  }?>" name="mp_id" id="mp_id" class="reg-login-text-field" />       
              <input type="hidden" value="<?php if(empty($_GET['plotid'])){
		  echo $plotid;
		  }else{ 
		  echo $_GET['plotid'];
		  }?>" name="plotid" id="plotid" class="reg-login-text-field" />
    </p>
  </div><div style="display:none;" id="msgarea">
  <div class="float-left">
    <p class="reg-left-text">Mode of Contact:<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
 <select id="moc" name="moc">
 <option value="">Select Contact Mode</option>
 <option value="email">Email</option><option value="call">Call</option><option value="message">Message</option></select>    </p>
  </div>

  <div class="float-left">
    <p class="reg-left-text">Comments:<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
    <textarea name="comments" id="comments"></textarea>
    </p>
  </div>
  
  <div class="float-left">
    <p class="reg-left-text">Next Followup Date:<font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
    
 <input name="uptodate1" placeholder="Enter Upto Date" type="text" class="new-input" id="uptodate1">
    </p>
  </div></div>
 <div class="float-left">
    <p class="reg-left-text"><font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5"><br /><br /><br />
     <input type="submit" value="Submit" />
     </form>


    </p>
  </div>
  
  
  <!--<input name="submit" id="submit" value="Add File" type="submit" class="btn-info pull-right" style="position: fixed; padding:5px;" />--> 
  

</section>
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">

<script type="text/javascript">
function validateForm(){

	$("#error-status").hide();
	$("#error-commments").hide();
	$("#error-moc").hide();

	var a = $("#status").val();
	var b = $("#comments").val();
	var c = $("#moc").val();

	
var counter=0;
if (a==null || a=="")
  {
  $("#error-status").html("Please Select Status");
  $("#error-status").show();
  counter =1;
  }else if(a==1){
	  if(b==null || b==""){
		  $("#error-comments").html("Please Enter Comments");
			  $("#error-comments").show();
			  counter =1;
		  }
		  if(c==null || c==""){
		  $("#error-moc").html("Please Select Mode of Contact");
			  $("#error-moc").show();
			  counter =1;
		  }
	  }
  
 if(counter==1)
{
  	return false;
}
}

function getVal(){

var status=document.getElementById("status").value;
if(status==1){
document.getElementById("msgarea").style.display='block';
			}else if(status==0){
				document.getElementById("msgarea").style.display='none';
				}

}

//if(status=="")
/*setInterval(function(){
      $('#content').load('test.php');
 },5000);*/
$(document).ready(function (e) {

   
           
    $("form[ajax=true]").submit(function (e) {

        e.preventDefault();

        var form_data = $(this).serialize();
        var form_url = $(this).attr("action");
        var form_method = $(this).attr("method").toUpperCase();

        $("#loadingimg").show();

        $.ajax({
            url: form_url,
            type: form_method,
            data: form_data,
            cache: false,
            success: function (returnhtml) {
			//	 ("#content").load("w"
				   
                $("#result-page").append(returnhtml).show();
				
              //  $('form').hide();
			  	 $('form').remove(this.comments);
                $("#loadingimg").hide();
               
            }
        });

    });

});

</script>   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>
 function autoRefresh_div()
 {
      $("#content").load("comm?mp_id=<?php echo $mp_id;?>&&plotid=<?php echo $plotid;?>");// a function which will load data from other file after x seconds
	
  }
 
  setInterval('autoRefresh_div()', 15000); // refresh div after 5 secs
            </script>