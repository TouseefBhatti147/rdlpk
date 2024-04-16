
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
     <td scope="col"><?php   echo $plotdetails['project_name']?></td>
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
  
   
     <td scope="col" colspan="3">
     <?php $connection = Yii::app()->db;?>
  <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator11.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="plot_id" value="<?php // echo $_GET['plot_id']; ?>">
<input type="hidden" name="transfer_letter" value="1">
<input type="hidden" name="orientation" value="portrait">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<meta charset="UTF-8">
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}


</style>
</head>
<body>
<h3 align="center">Royal Orchard</h3>
<h4 align="center">Transfer Request</h4>
<h5 align="right">Date:_____________</h5>
<hr>
<div>
To:&nbsp;&nbsp;The Secretary<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $plotdetails['project_name'];?><br><br>
<strong>Subject:&nbsp;&nbsp;Transfer Request<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></strong>
I desire to Sell my Plot to the person as mentioned below.You are requested to please transfer my plot at earliest.Details are as Under:-
</div>
<br/>
<table>
  <tr>
    <th colspan="2"><u>Seller's Detail</u></th>
   
    <th colspan="1"><u>Buyer's Details</u> </th>
  </tr>
  <tr>
    <td>R/P/MS No </td>
    <td><?php echo $plotdetails['plotno'];?></td>
    <td><?php echo $plotdetails['plotno'];?></td>
 
  </tr>
   <tr>
    <td>Name </td>
    <td><?php echo $plotdetails['fromname'];?></td>
    <td><?php echo $plotdetails['toname'];?></td>
 
  </tr>
   <tr>
    <td>CNIC No: </td>
    <td><?php echo $plotdetails['fromcnic'];?></td>
    <td><?php echo $plotdetails['tocnic'];?></td>
 
  </tr>
   <tr>
    <td>Plot Size </td>
    <td><?php echo $plotdetails['size']."(".$plotdetails['plot_size'].")";?></td>
    <td><?php echo $plotdetails['size']."(".$plotdetails['plot_size'].")";?></td>
 
  </tr>
   
  <tr>
    <td>Sector/Block</td>
    <td><?php echo $plotdetails['sector_name'];?></td>
    <td><?php echo $plotdetails['sector_name'];?></td>
  
  </tr>
  <tr>
    <td>Street/Lane</td>
    <td><?php echo $plotdetails['street'];?></td>
    <td><?php echo $plotdetails['street'];?></td>
  
  </tr>
  <tr>
    <td>Plot No </td>
    <td><?php echo $plotdetails['plot_detail_address'];?></td>
    <td><?php echo $plotdetails['plot_detail_address'];?></td>
 
  </tr>
   <tr>
    <td>Tell/Cell No </td>
    <td><?php echo $plotdetails['fromphone'];?></td>
    <td><?php echo $plotdetails['tophone'];?></td>
  </tr>
</table>
<br/>
<p>A Sum of Rs________________ has been deposited vide DD/PO/CH No _____________ dated___________banker__________ as transfer fee (copy attached)</br>
we have read and understood all the terms and conditions of <?php echo $plotdetails['project_name'];?> and we will abide by these.</p>
<br/>
<table>
  <tr>
    <th colspan="2">Seller</th>
   
    <th colspan="2">Buyer</th>
  </tr>
  <tr>
    <td>Seller's Signature</td>
    <td>___________________</td>
    <td>Buyer's Signature</td>
     <td>___________________</td> 
  </tr>
  <tr>
    <td>Thumb Impression </td>
    <td>___________________</td>
    <td>Thumb Impression </td>
     <td>___________________</td> 
  </tr>
  <tr>
    <td>Dealer's Name </td>
    <td>___________________</td>
    <td>Dealer's Name </td>
     <td>___________________</td> 
  </tr>
  <tr>
    
    <td>Transfer Officer</td>
     <td colspan="4">___________________</td> 
  </tr>

</table>
<hr>
Allotment,Transfer & Record Procedure <?php echo $plotdetails['project_name'];?> 
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Print Request Form</button>
</div>

</form>
    </td>
    </tr>
      </td>




<!-- section 3 --> 

 <div class="clearfix"></div>

 

 

 

 </div> 

 </div>