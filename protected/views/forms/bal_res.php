<div class="container-fluid">
<a id="dlink"  style="display:none;"></a>

<script>
var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();

        }
    })()
</script>
<div class="shadow">

  <h3>Search: balloting</h3>
  
</div>
<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 3px 12px;}
</style>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">
<form action="searchreqbal?id=<?php echo $_REQUEST['id']; ?>" method="post">

<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<?php if(Yii::app()->session['user_array']['per13']=='1'){ ?>
    <span>Project:</span>

    	<select name="project_id" id="project_id" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

   <?php }?>

    
                <span>CNIC:</span>
     <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter CNIC No." />

               <span>Form No.:</span> 			 
<input type="text" value="" name="formno" id="formno" class="new-input" placeholder="Enter Form No" />
<input type="hidden" value="<?php echo $_POST['bbid']?>" name="bbid" id="bbid" class="new-input" placeholder="Enter Form No" />
    

 <input class="btn" type="submit" value="Search" />

			</form>


            

            


<table id="prnt" name="prnt" class="table table-striped table-new table-bordered " style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                        <th width="7%"> Form/Reg #</th>
                      
                        <th width="8%">Applicant Name</th>
                        <th width="10%">Father/Spouse Name</th>
                        <th width="7%">CNIC</th>
                       
                        <th width="8%">Phone</th>
                     
                         <th width="6%">Size</th>
                         <th width="6%">Status</th>
                         <th width="6%">Action</th>
                       
                       
						
                        </tr>
                </thead>
        <tbody id="error-div">
        <?php 
		$count=0;
		   foreach($members as $key){
            $count++;
			 
			
$home="";
$home=Yii::app()->request->baseUrl; 
			

			 echo '<tr><td><b>'.$key['scode'].$key['formno'].$key['scode1'].$key['Gserial'].'</b></td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['phone'].'</td><td>'.$key['size'].'</td>
			 <td>';
			 if($key['bstatus']==0){echo 'Unsuccessful';}else{echo 'Successful';}
			 echo '</td>
			 <td>Allotment</td>
			';

			}
			$count=0;
			foreach($co as $key){

            $count++;
			
			 echo '<tr><td>'.$key['plotno'].'</td>
			
			 <td><a href="'.$home.'/index.php/user/memhistory?id='.$key['member_id'].'">'.$key['name'].'</a></td>
			 <td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td>
			 <td>'.$key['mobile'].'</a><td>'.$key['plot_size'].'</td>
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

</style>

</head>

<body>
 <img  src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>" height="50px">
 
<h5 style="margin:-13px 75px;">Membership Balloting: Royal Orchard Multan </h5>
  <hr>
</br>
<table id="prnt" class="table table-striped table-new table-bordered " style="font-size:12px;">



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
			 <td>'.$key['phone'].'</a>
			 <td></td> 
		
			</tr>'; 

			}
		?>
                </tbody>
            </table>
<br>
<hr>
<p style="font-size:10;">
Members are requested to proceed the successful memberships by submitting their booking for desired plot size.<br>
Any unsuccessful membership will be accommodated in upcoming launching of Royal Orchard Housing Projects on priority basis.<br>
For any query, please contact to sale centers. <br>     

</p>
</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">
<input type="button" onclick="tableToExcel('prnt', 'name', 'myfile.xls')" class="btn" value="Export to Excel">
  <button type="submit" class="btn">Print</button>

</div>

</form>
 <h5>Instaructions :</h5>
<p>Enter CNIC Number (without dashes) to view entire membership status.<br>
--OR-- <br>
Enter 13 Digit number to view form membership status.
</p>
  </div>
 