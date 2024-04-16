<div class="container-fluid">

<div class="shadow">

  <h3>Search: Membership Balloting</h3>
  
</div>
<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 3px 12px;}
</style>
<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30" style="    font-size: 16px;">



<!--<form name="login-form" method="post" action="">-->
<form method="post" action="searchreqbal1?id=<?php echo $_REQUEST['id']; ?>">









<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<?php if(Yii::app()->session['user_array']['per13']=='1'){ ?>
    

    	<select name="project_id" id="project_id" style="width:180px;" hidden="true"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

   <?php }?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script> 
    <script type="text/javascript">



function testPhone(objNpt){



 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits



 if (n.length!=13) {



  document.getElementById('rsp').innerHTML="Please Enter 13 Digit CNIC Number without spaces/Slashes !";



  return;}



  document.getElementById('rsp').innerHTML=""; 



 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number



}



</script><p id="rsp" style="float:left;color:#F00;"></p><div class="clearfix"></div>
                <span>CNIC:</span>
     <input type="text" value="" onBlur="testPhone(this)" name="cnic" id="cnic" class="new-input" placeholder="Enter CNIC No." />
<span>  ----OR----&nbsp;&nbsp;</span>

               <span>Form No.:</span> 			 
<input type="text" value="" name="formno" id="formno" class="new-input" placeholder="Enter Form No" />
<?php if(isset($co)){?>
<input type="hidden" value="<?php echo $_POST['bbid']?>" name="bbid" id="bbid" class="new-input" placeholder="Enter Form No" />
    <?php }else{?>
<input type="hidden" value="<?php echo $_REQUEST['id']?>" name="bbid" id="bbid" class="new-input" placeholder="Enter Form No" />
<?php }?>
 
<input type="submit" value="Search" class="btn" style="    background: burlywood;
    height: 33px;
    width: 111px;
    margin-left: 12px;" />

			</form>
            </section>
<br />

			<div class="clearfix"></div>
	
  			<div class="">



            

            
<?php if(isset($co)){?>
<table id="prnt" class="table table-striped table-new table-bordered " style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="7%"> Form/Reg #</th>
                        <th width="8%">Applicant Name</th>
                        <th width="10%">Father/Spouse Name</th>
                        <th width="7%">CNIC</th>
                        <th width="8%">Phone</th>
                        
                         <th width="6%">Status</th>
                         
                       
                       
						
                        </tr>
                </thead>
        <tbody id="error-div">
        <?php 
		$count=0;
		   foreach($members as $key){
            $count++;
			 
			
$home="";
$home=Yii::app()->request->baseUrl; 
			

			 echo '<tr><td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td>
			<td>';
			 if($key['bstatus']==0){echo 'Unsuccessful';}else{echo 'Successful';}
			 echo '</td>
			 
			';

			}
			$count=0;
			foreach($co as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td>
			
			 <td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td>
			 <td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td>
			 <td>'.$key['mobile'].'</a>
			 <td></td> 
			 <td></td>
			</tr>'; 

			}
		?>
                </tbody>
            </table>

<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">







<input type="hidden" name="paper" value="a4">

<input type="hidden" name="orientation" value="portrait">

 

</select>

</p>



<textarea name="html1" style="display:none;" cols="60" rows="20">

<!doctype html>

<html>

<head>





<meta charset="utf-8">

<title></title>

<style>

	

	

	@page { margin: 50px 10px 0px 10px; }

	

	body {

		

	

margin: 0px;



background-size: cover;

background-repeat:no-repeat;

	}

td{text-align:left; margin:0px; }


</style>

</head>

<body>
 
   <img  src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>" height="50px">
 
<h5 style="margin:-13px 75px;">Membership Balloting: Royal Orchard Multan </h5>
  <hr>
</br>
<table id="prnt" class=" " style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                        <th width="100px"> Form/Reg #</th>
                      
                        <th width="150px">Applicant Name</th>
                        <th width="150px">Father/Spouse Name</th>
                        <th width="100px">CNIC</th>
                       
                        <th width="80px">Phone</th>
                     
                        
                         <th width="150px">Status</th>
                        
                       
                       
						
                        </tr>
                </thead>
        <tbody id="error-div">
        <?php 
		$count=0;
		   foreach($members as $key){
            $count++;
			 
			
$home="";
$home=Yii::app()->request->baseUrl; 
			

			 echo '<tr><td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['mobile'].'</td>
			<td>';
			 if($key['bstatus']==0){echo 'Unsuccessful';}else{echo 'Successful';}
			 echo '</td>
			 
			';

			}
			$count=0;
			foreach($co as $key){

            $count++;
			echo $count.' result found';
			 echo '<tr><td>'.$key['plotno'].'</td>
			
			 <td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td>
			 <td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td>
			 <td>'.$key['phone'].'</a><td>'.$key['plot_size'].'</td>
			 <td></td> 
			 <td></td>
			</tr>'; 

			}
		?>
                </tbody>
            </table>
<br>
<hr>
<b>Notes:</b>
<p style="font-size:10;">
1. &nbsp;&nbsp;Members are requested to proceed the successful memberships by submitting their booking for desired plot size.<br>
2. &nbsp;&nbsp;Any unsuccessful membership will be accommodated in upcoming launching of Royal Orchard Housing Projects on priority basis.<br>
3. &nbsp;&nbsp;For any query, please contact to sale centers. <br>     

</p>
</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button style="font-size:16px" type="submit" formtarget="_blank">Print</button>

</div>

</form>

<?php }?>
<hr>
<h4 style="color:red;">Instructions :</h4>
<p>Enter CNIC Number (without dashes) to view entire membership status.<br>
--OR-- <br>
Enter 13 Digit number to view form membership status.
</p>
<br>
<br>
  </div>

</div>