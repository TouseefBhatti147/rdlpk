<head>
    <script type="text/javascript">
        function PrintDiv(id) {
            var data=document.getElementById(id).innerHTML;
            var myWindow = window.open('', '', 'height=400,width=600');
            myWindow.document.write('<html><head>');
            myWindow.document.write('</head><body >');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10
            myWindow.onload=function(){ // necessary if the div contain images
                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
                myWindow.close();
            };
        }
    </script>
</head>
<div class="container-fluid" style="font-size:12px; background:#FFF;">
<div class="row-fluid">
<div class="shadow">
  <h3>Plot Transfer Documents</h3>
</div>
<!-- shadow --> 
<div class="span12 pull-left">
 <table class="table table-bordered" style="font-size:16px;" >
  <thead >
  <tr>
      <th style="color:white; text-align: center;" scope="col" colspan="4">Plot Detail</th>
      
    </tr>  </thead>
    <tr>
      <td scope="col">Project Name</td>
     <td scope="col"><?php  echo $plotdetails['project_name']?></td>
    </tr>
    <tr>
      <td scope="col">Plot No</td>
     <td scope="col"><?php echo $plotdetails['plot_detail_address']?></td>
    </tr>
  <tbody>
    <tr>
    <td scope="col">Street/Lane</td>
      <td><?php echo $plotdetails['street']?></td>
    </tr>
    <tr>
    <td scope="col">Block/Sector</td>
      <td scope="col"><?php echo $plotdetails['sector_name']?></td>
    </tr>
    <tr>
      <td scope="col">Size</td>
      <td colspan="2"><?php echo  $plotdetails['size'].'&nbsp('.$plotdetails['plot_size'].')';?></td>
    </tr>
  </tbody>
</table>
</div>

<div class="span6 pull-left">
 <table class="table table-bordered" style="font-size:16px;" >
  <thead >
  <tr>
      <th style="color:white; text-align: center;" scope="col" colspan="4">Seller Detail</th>
      
    </tr>  </thead>
    <tr>
      <td scope="col">Buyer Name</td>
     <td scope="col"><?php echo $plotdetails['fromname'];?></td>
    </tr>
    <tr>
      <td scope="col">CNIC</td>
     <td scope="col"><?php echo $plotdetails['fromcnic'];?></td>
    </tr>
  <tbody>
    <tr>
    <td scope="col">Father/Spouse</td>
      <td><?php echo $plotdetails['fromsodowo'];?></td>
    </tr>
    <tr>
    <td scope="col">Phone</td>
      <td scope="col"><?php echo $plotdetails['fromphone'];?></td>
    </tr>
    <tr>
      <td scope="col">Address</td>
      <td colspan="2"><?php echo $plotdetails['fromaddress'];?></td>
    </tr>
  </tbody>
</table>
</div>
<div class="span5 pull-left">
 <table class="table table-bordered" style="font-size:16px;" >
  <thead >
  <tr>
      <th style="color:white; text-align: center;" scope="col" colspan="4">Buyer Detail</th>
      
    </tr>  </thead>
    <tr>
      <td scope="col">Buyer Name</td>
     <td scope="col"><?php echo $plotdetails['toname'];?></td>
    </tr>
    <tr>
      <td scope="col">CNIC</td>
     <td scope="col"><?php echo $plotdetails['tocnic'];?></td>
    </tr>
  <tbody>
    <tr>
    <td scope="col">Father/Spouse</td>
      <td><?php echo $plotdetails['tosodowo'];?></td>
    </tr>
    <tr>
    <td scope="col">Phone</td>
      <td scope="col"><?php echo $plotdetails['tophone'];?></td>
    </tr>
    <tr>
      <td scope="col">Address</td>
      <td colspan="2"><?php echo $plotdetails['toaddress'];?></td>
    </tr>
  </tbody>
</table>
</div>
<div class="span12 pull-center">
 <table class="table table-bordered" style="font-size:14px;" >
  <thead >
  <tr>
      <th style="color:white; text-align: center;" scope="col" colspan="4">Property Documents</th>
      
    </tr>  </thead>
    <tr>
      <td scope="col">
      <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
				 <input type="hidden" name="paper" value="a4">
				 <input type="hidden" name="orientation" value="portrait">
				 </p>
				 <textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">

<style>
table{ border:1px solid;border-collapse: collapse;}
.td{border:1px solid;}
</style>
<?php
$connection = Yii::app()->db;
$sql_member = "SELECT
members.id
,memberplot.id as mpid
,memberplot.plotno
,memberplot.status as mpstatus
, members.name
,members.city_id
,plots.street_id
,plots.id as plot_id
,plots.type
,plots.atype
,plots.plot_size
,plots.com_res
,plots.sector
,plots.size2
,plots.ctag
,projects.project_name
,size_cat.size
,plots.plot_detail_address
,tbl_landowner.name as landowner
,memberplot.create_date
,memberplot.app_no
,streets.street
,sectors.sector_name
,blocks.block_name
,dealer.name as dealername
FROM
memberplot
LEFT JOIN members
ON (memberplot.member_id = members.id )
left join plots on memberplot.plot_id=plots.id
left join projects on plots.project_id=projects.id
left join sectors on plots.sector=sectors.id
left join size_cat on plots.size2=size_cat.id
left join streets on plots.street_id=streets.id
left join tbl_landowner on tbl_landowner.id=memberplot.lo_id
left join blocks on plots.block_id=blocks.id
Left JOIN members dealer ON dealer.id=memberplot.dealer_id
where memberplot.status='Approved' and memberplot.plot_id=" . $_GET['plot_id'];
$member_result = $connection->createCommand($sql_member)->queryAll();
$sql="Select 
          transferplot.create_date,
           m_from.name from_name,
				   m_from.sodowo from_sodowo,
				    m_from.title from_title,
				   m_to.sodowo to_sodowo,
				   m_to.title to_title,
				   m_to.name to_name,
				   m_to.address to_address,
				   m_to.phone to_phone,
				   transferplot.app_no
					   from transferplot
			Left JOIN members m_from ON m_from.id=transferplot.transferfrom_id
			Left JOIN members m_to ON m_to.id=transferplot.transferto_id where plot_id='".$_GET['plot_id']."' ORDER BY transferplot.create_date DESC LIMIT 1";
			$result_details = $connection->createCommand($sql)->query();
     foreach($member_result as $key){
			?>
      <div style="height:500px"></div>
<table width="100%" height="700px" class="table">
     <tr style="height:150px">
       <td class="td" width="20%"  align="left"><?php echo '<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/ro.png"/>'; ?>
       </td>
        <td class="td" width="60%"   align="center"><?php echo $key['project_name'];?>
       </td>
        <td class="td" width="20%"  align="right"><?php echo '<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo.png"/>'; ?>
       </td>
     </tr>
     <?php foreach($result_details as $mdetail){?>
     <tr style="height:150px">
     <td  colspan="1" class="td">Membership No</td>
      <td colspan="2" class="td"><?php echo $key['plotno'];?></td>
     </tr>
      <tr style="height:180px;">
     <td  colspan="1" class="td">Transfer From</td>
      <td colspan="2" class="td"><?php echo $mdetail['from_name'];?></td>
     </tr>
      <tr style="height:180px;">
     <td  colspan="1" class="td">Transfer To</td>
      <td colspan="2" class="td"><?php echo $mdetail['to_name'];?></td>
     </tr>
      <tr style="height:180px;">
     <td  colspan="1" class="td">Date</td>
      <td colspan="2" class="td"></td>
     </tr>   
     <tr  style="height:180px;">
     <td  colspan="1" class=""><?php echo Yii::app()->session['user_array']['username']; ?></td>
      <td colspan="2" class=""><?php echo date('d-m-Y');?></td>
     </tr> <?php }?>  
</table>
<?php }?>

</textarea>
				 <div style="text-align: left; margin-top: 1em;">
					 <button type="submit">Print Main Page</button>
				 </div>
			 </form>
    </td>
     <td scope="col">
     <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
				 <input type="hidden" name="paper" value="a4">
				 <input type="hidden" name="orientation" value="portrait">
				 </p>
         <textarea name="html1" style="display:none;" cols="80" rows="20">
<meta charset="utf-8">

<style>
table{ border:1px solid;border-collapse: collapse;}
.td{border:1px solid;}
</style>
<?php
$connection = Yii::app()->db;
$sql_member = "SELECT
members.id
,memberplot.id as mpid
,memberplot.plotno
,memberplot.status as mpstatus
, members.name
,members.city_id
,plots.street_id
,plots.id as plot_id
,plots.type
,plots.atype
,plots.plot_size
,plots.com_res
,plots.sector
,plots.size2
,plots.ctag
,projects.project_name
,size_cat.size
,plots.plot_detail_address
,tbl_landowner.name as landowner
,memberplot.create_date
,memberplot.app_no
,streets.street
,sectors.sector_name
,blocks.block_name
,dealer.name as dealername
FROM
memberplot
LEFT JOIN members
ON (memberplot.member_id = members.id )
left join plots on memberplot.plot_id=plots.id
left join projects on plots.project_id=projects.id
left join sectors on plots.sector=sectors.id
left join size_cat on plots.size2=size_cat.id
left join streets on plots.street_id=streets.id
left join tbl_landowner on tbl_landowner.id=memberplot.lo_id
left join blocks on plots.block_id=blocks.id
Left JOIN members dealer ON dealer.id=memberplot.dealer_id
where memberplot.status='Approved' and memberplot.plot_id=" . $_GET['plot_id'];
$member_result = $connection->createCommand($sql_member)->queryAll();
$sql="Select 
          transferplot.create_date,
           m_from.name from_name,
				   m_from.sodowo from_sodowo,
				    m_from.title from_title,
				   m_to.sodowo to_sodowo,
				   m_to.title to_title,
				   m_to.name to_name,
				   m_to.address to_address,
				   m_to.phone to_phone,
				   transferplot.app_no
					   from transferplot
			Left JOIN members m_from ON m_from.id=transferplot.transferfrom_id
			Left JOIN members m_to ON m_to.id=transferplot.transferto_id where plot_id='".$_GET['plot_id']."' ORDER BY transferplot.create_date DESC LIMIT 1";
			$result_details = $connection->createCommand($sql)->query();
     foreach($member_result as $key){
			?>
     
<table width="100%" height="700px" class="table">
     <tr style="height:150px">
       <td class="td" width="20%"  align="left"><?php echo '<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/ro.png"/>'; ?>
       </td>
        <td class="td" width="60%"   align="center">Flow Chart
       </td>
        <td class="td" width="20%"  align="right"><?php echo '<img style="height:40px;"  src="'.Yii::getPathOfAlias('webroot').'/images/logo.png"/>'; ?>
       </td>
     </tr>
     <?php foreach($result_details as $mdetail){?>
     <tr style="height:150px">
     <td  colspan="1" class="td">Membership No</td>
      <td colspan="2" class="td"><?php echo $key['plotno'];?></td>
     </tr>
      <tr style="height:180px;">
     <td  colspan="1" class="td">Transfer From</td>
      <td colspan="2" class="td"><?php echo $mdetail['from_name'];?></td>
     </tr>
      <tr style="height:180px;">
     <td  colspan="1" class="td">Transfer To</td>
      <td colspan="2" class="td"><?php echo $mdetail['to_name'];?></td>
     </tr>
       
     <?php }?>  
</table>
<table width="100%" height="700px" class="table">

<tr style="height:150px">
     <td class="td">No.</td>
      <td class="td">Date</td>
      <td class="td">Time</td>
      <td class="td" width="40%">Detail</td>
      <td class="td">Signature</td>
     </tr>
     <tr style="height:150px">
     <td class="td">1</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td">Received From <?php echo $key['project_name'];?></td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">2</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td">Handed Over to Yasir</td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">3</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td">Received From Yasir</td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">4</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td">Handed Over to Finance</td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">5</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td">Received From Finance</td> 
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">6</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td">Query(________________________)</td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">7</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td">Put Up to Secretary Royal Orchard </td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">8</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">9</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td"></td>
     </tr>
     <tr style="height:150px">
     <td class="td">10</td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td"></td>
      <td class="td"></td>
     </tr>
     
     
     
     <tr  style="height:180px;">
     <td  colspan="2" class=""><?php echo Yii::app()->session['user_array']['username']; ?></td>
      <td colspan="1" class=""><?php echo date('d-m-Y');?></td>
      <td colspan="2" align="right">Allotment, T&R Department</td>
     </tr>
     </table>
<?php }?>
<table width="100%" height="700px" class="table">

</textarea>
				 <div style="text-align: left; margin-top: 1em;">
					 <button type="submit">Print Flow Chart</button>
				 </div>
			 </form>
    
    </td>
     <td scope="col">
     <?php $connection = Yii::app()->db;?>
  <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator11.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="plot_id" value="<?php echo $_GET['plot_id']; ?>">
<input type="hidden" name="transfer_letter" value="1">
<input type="hidden" name="orientation" value="portrait">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<meta charset="UTF-8">
<title></title>
<style>
	@page { margin: 0px; }
	body {
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
font-family: Arial Narrow;
	}
</style>
<?php
$connection = Yii::app()->db;
$sql_member = "SELECT
members.id
,memberplot.allotment_letter_al
,memberplot.ms_letter
,memberplot.allotment_letter
,memberplot.allotment_certificate
,memberplot.transfer_letter
,memberplot.ndc_letter
,memberplot.transfer_slip
,memberplot.balloting_detail
,memberplot.id as mpid
,memberplot.plotno
,memberplot.status as mpstatus
, members.name
,members.sodowo
, members.cnic
,members.title
, members.address
, members.dob
, members.email
, members.phone
, members.image
, members.nomineename
,members.city_id
,plots.street_id
,plots.id as plot_id
,plots.type
,plots.atype
,plots.plot_size
,plots.com_res
,plots.sector
,plots.size2
,plots.ctag
,projects.project_name
,size_cat.size
,plots.plot_detail_address
,tbl_landowner.name as landowner
,memberplot.create_date
,memberplot.app_no
,streets.street
,sectors.sector_name
,blocks.block_name
,dealer.name as dealername
FROM
memberplot
LEFT JOIN members
ON (memberplot.member_id = members.id )
left join plots on memberplot.plot_id=plots.id
left join projects on plots.project_id=projects.id
left join sectors on plots.sector=sectors.id
left join size_cat on plots.size2=size_cat.id
left join streets on plots.street_id=streets.id
left join tbl_landowner on tbl_landowner.id=memberplot.lo_id
left join blocks on plots.block_id=blocks.id
Left JOIN members dealer ON dealer.id=memberplot.dealer_id
where memberplot.status='Approved' and memberplot.plot_id=" . $_GET['plot_id'];
$member_result = $connection->createCommand($sql_member)->queryAll();
foreach($member_result as $member){
$sql="Select 
          transferplot.create_date,
           m_from.name from_name,
				   m_from.sodowo from_sodowo,
				    m_from.title from_title,
				   m_to.sodowo to_sodowo,
				   m_to.title to_title,
				   m_to.name to_name,
				   m_to.address to_address,
				   m_to.phone to_phone,
				   transferplot.app_no
					   from transferplot
			Left JOIN members m_from ON m_from.id=transferplot.transferfrom_id
			Left JOIN members m_to ON m_to.id=transferplot.transferto_id where plot_id='".$_GET['plot_id']."' ORDER BY transferplot.create_date DESC LIMIT 1";
			$result_details = $connection->createCommand($sql)->query();
     
			?>
            <?php foreach($result_details as $mdetail){
               $create_date = strtotime($mdetail['create_date']); 
               $create_date = date('d-m-Y', $create_date);
              ?>
<div style="margin:60px 50 0 80px; position:absolute; font-family: Arial Narrow,Arial,sans-serif; font-size:16px;">
<div style="margin:60px 0 0 300px; position:absolute;">
<strong>NFC<?php // echo  date('M d,Y'); ?>
</strong></div>     
       	<div style=" margin:135px 0px 0 0px; position:absolute;"><strong>Subject:&nbsp;&nbsp;&nbsp;&nbsp;     <u>Transfer Of <?php echo $member['com_res'].'&nbsp'.$member['type'];?></u></strong></div><br/>
        <div style=" margin:160px 10 0 0px; position:absolute;">Transfer Application Dated <strong><?php echo $create_date; ?></strong> refers</div> 
  
     
        <p  style=" margin:200px 10 0px 0px; position:absolute;">1.&nbsp;&nbsp; <strong><?php echo $mdetail['from_name'].'&nbsp;'.$mdetail['from_title'].'&nbsp;'.$mdetail['from_sodowo'];?></strong> has requested  for the transfer of his <?php echo $member['type']?> along with membership allotted vide (<strong>MS No <?php echo $member['plotno'];?></strong>), in the name of  <strong><?php echo $mdetail['to_name'].'&nbsp;'.$mdetail['to_title'].'&nbsp;'.$mdetail['to_sodowo'];?> </strong> w.e.f <u>___________</u> As per SOD he has paid all updated dues and nothing is outstanding against him. Accordingly NDC has been issued. Detail of the plot as under:</strong><br /><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   a. Project &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $member['project_name'];?><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   b. Plot Size &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php  echo $member['plot_size'];?><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   c. Plot No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if($member['type']=='file'){ echo'--';}else{ echo $member['plot_detail_address'];}?><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   d. Street/Lane No &nbsp;&nbsp;&nbsp;      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; <?php echo $member['street'];?><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   e. Block No &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $member['sector_name'];?><br />
        </p><br /><br />
	<p  style="margin:420px 10px 0 0px; position:absolute;">2.&nbsp;&nbsp; Approval for the transfer of above, mentioned plot along with MS No in the favour of purchaser may be granted.</p><br/><br/><br/> 
  <br /><p  style=" margin:410px 10 0 0px; position:absolute;">3. Submitted for the consideration please</p> 
    <br /><p  style=" margin:550px 10 0 430px; position:absolute;"><strong>Maryam Javed </strong><br />(Deputy Assistant Manager)</p> 
    <br /><p  style=" margin:550px 10 0 0px; position:absolute;"> <br /><br /><br /> <br /><br /><strong>Secretary <br />Royal Orchard</strong></p> 
    
    <br />
    
    </div><?php }}?>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Print NFC</button>
</div>
</form>
    </td>
    </tr>
      </td>




<!-- section 3 --> 

 <div class="clearfix"></div>

 

 

 

 </div> 

 </div>