<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<head>
  <title>Confirmation of Plot</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Include Bootstrap CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
   <style>
  .box
  {
   width:800px;
   margin:0 auto;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333;
   font-weight: 600;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  .has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
  }
  </style>
</head>
<div class="my-content">
<div class="row-fluid my-wrapper">
<div class="span12"> 
<!-- breadcrumbs -->

<div class="shadow">
<h3>Confirmation of Plot</h3>
</div>
<hr noshade="noshade" class="hr-5">
<div class="float-left">
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<td colspan="3"  align="center"><h4> <strong>Plot Detail</strong></h4></td>
</tr>
</thead>
<tbody>
<?php

foreach($plot as $key)
{
	 if($key['com_res']=='Commercial'){$type='C'; }else{$type='R';}
?>
<tr>
<td>Project Name.</td>
<td><?php echo $key['project_name'];?></td>
</tr>
<tr>
<td>Plot No.</td>
<td><?php echo $key['plot_detail_address'];?></td>
</tr>
<tr>
<td>Size</td>
<td><?php echo $key['size'].'&nbsp;('.$key['plot_size'].')';?></td>
</tr>
<tr>
<td>Street</td>
<td><?php echo $key['street'];?></td>
</tr>
<tr>
<td>Sector</td>
<td><?php echo $key['sector_name'];?></td>
</tr>
<?php }?>
<tr><td><span style="background-color:#09C;">Use Your Email as Username and CNIC as Password</span></td><td><a target="_blank" href="http://rdlpk.com/index.php/member/member" class="btn btn-success btn-lg">Click Here For Member Portal Login</a></td></tr>
<tr><td colspan="2" align="center">
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<meta charset="utf-8">
<title></title>
<style>
	@page {
        margin-top: 0;
        margin-bottom: 1.00cm;
        margin-left: 2.00cm;
        margin-right: 2.00cm;
    }
	body {
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
	}
</style>
<table style="width: 100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table style="width: 100%" cellpadding="0" cellspacing="5">
                <tr>
                    <td style="width: 150px;">
                        <table style="width: 100%" cellpadding="0" cellspacing="5">
                            <tr>
                                <td>
                                      <img src="<?php echo Yii::getPathOfAlias('webroot')."/images/RO.jpg";  ?>"  style="height:80px;">
                                  
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: arialnarrow; font-size: 11px; color: blue; vertical-align: top;">
                                   www.royalorchard.pk                                 </td>
                            </tr>
                        </table>

                    </td>
                    <td>
                        <table style="width: 100%" cellpadding="0" cellspacing="5">
                            <tr>
                                <td style="font-size: 16px; color: darkblue;  text-align: center;">
                                    <strong style="font-family: candara; font-size: 16px; text-decoration: underline;"><?php  echo $key['project_name'];?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align: right;">
                        <table style="width: 100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="text-align: right;">
                                    
                                      <img src="<?php echo Yii::getPathOfAlias('webroot')."/images/logo.png";  ?>"  style="height:80px;">
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: bottom; text-align: right;">
                            <barcode code="fdh54970-6198" type="QR" border="0" class="barcode" size="0.5" error="M" />
                            <!--                            <barcode code="04210000526" type="UPCE" />-->
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</td>
</tr>
<tr>
    <td style="font-family: calibri; background-color: #1e3466; color: white; font-size: 18px; text-align: center; padding-bottom: 5px; padding-top: 5px; font-weight: bold;">Online Booking / Registration eForm</td>
</tr>
<tr>
    <td>
        <table style="width: 100%" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="4" style="color: red; text-align: center; padding-bottom: 5px; font-family: arial; font-size: 10px; padding-top: 8px;">
                    (This Form is valid for one property only)
                </td>
            </tr>
            <tr>
                <td colspan="3" style="width: 90px; font-size: 11px; font-family: arial;">
                    eForm No.
                </td>
                <td style="width: 120px; background-color: black; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; color: white; font-size: 13px; font-family: arial;">
                    <?php echo $_GET['bid'];?>               </td>
                <td  style="text-align: right; font-size: 11px; font-family: arial;">
                    Booking Date : 
                </td>
                <td style="width: 70px; font-weight: bold; font-size: 12px; text-align: right; font-family: arial;">
                    <?php echo date('d-m-Y');?>                </td>
            </tr>
            <tr>
                <td colspan="4" style="color: #0070c0; font-weight: bold; font-size: 10px; padding-top: 8px; padding-bottom: 8px; font-family: arial;">
                    PROPERTY SELECTION: <?php echo 'Plot No.'.$key['plot_detail_address'].'&nbsp;,'.$key['street'].'&nbsp;,'.$key['sector_name'];?>              </td>
                <td style="text-align: right; font-size: 10px; font-family: arial;" colspan="2">
                    * All Prices are in Pak Rupees (PKR)
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table style="width: 100%" cellpadding="0" cellspacing="0">
            <tr>
                <td style="border-bottom: thin solid black; border-top: thin solid black; padding-bottom: 3px; padding-top: 3px; background-color: #e7e6e6; font-family: arial; font-size: 10px; width: 90px;">
                    <span style="font-weight: bold;">Property Type</span>
                </td>
                <td style="border-bottom: thin solid black; border-top: thin solid black; padding-bottom: 3px; padding-top: 3px; background-color: #e7e6e6; font-family: arial; font-size: 10px; width: 90px;" >
                    <span style="font-weight: bold;">Size</span><br />
                    &nbsp;
                </td>
                <td style="border-bottom: thin solid black; border-top: thin solid black; padding-bottom: 3px; padding-top: 3px; background-color: #e7e6e6; font-family: arial; font-size: 10px;" >
                    <span style="font-weight: bold;">MS. Fee</span><br />
                    (Non Refundable)
                </td>
                <td style="border-bottom: thin solid black; border-top: thin solid black; padding-bottom: 3px; padding-top: 3px; background-color: #e7e6e6; font-family: arial; font-size: 10px;" >
                    <span style="font-weight: bold;">
                     Price</span><br />
                    (Excl. Dev. Charges)                </td>
                <td style="border-bottom: thin solid black; border-top: thin solid black; padding-bottom: 3px; padding-top: 3px; background-color: #e7e6e6; font-family: arial; font-size: 10px;" >
                    <span style="font-weight: bold;">Down Payment</span><br />
                    (10%)
                </td>
                <td style="border-bottom: thin solid black; border-top: thin solid black; padding-bottom: 3px; padding-top: 3px; background-color: #e7e6e6; font-family: arial; font-size: 10px;" >
                    <span style="font-weight: bold;">Discount</span><br />
                    
                                        
                                    </td>
                <td style="border-bottom: thin solid black; border-top: thin solid black; padding-bottom: 3px; padding-top: 3px; background-color: #e7e6e6; font-family: arial; font-size: 10px;" >
                    <span style="font-weight: bold;">Current Payable</span>                    
                </td>
            </tr>
            <tr>
                <td style="font-size: 11px; padding-top: 3px; padding-bottom: 3px; font-family: arial;" >
                      <?php echo $key['com_res'];?>                </td>
                <td style="font-size: 11px; padding-top: 3px; padding-bottom: 3px; font-family: arial;" >
                  <?php echo $key['size'].'&nbsp;('.$key['plot_size'].')';?><br />
                    
                    
                </td>
                <td  style="font-size: 11px; padding-top: 3px; padding-bottom: 3px; font-family: arial;">
                    <?php
					$connection = Yii::app()->db;
					$charges="Select * from charges where project_id='".$key['project_id']."' and name='MS Fee'";
					$charges_res=$connection->CreateCommand($charges)->queryRow(); 
					echo number_format($charges_res['total']);
					 $ms=$charges_res['total'];
					 ?>                </td>
                <td  style="font-size: 11px; padding-top: 3px; padding-bottom: 3px; font-family: arial;">
                      <?php echo number_format($key['price']);?>              </td>
                
                                <td  style="font-size: 11px; padding-top: 3px; padding-bottom: 3px; font-family: arial;">
                   <?php echo number_format(($key['price']*10)/100);?>                  </td>
                <td  style="font-size: 11px; padding-top: 3px; padding-bottom: 3px; font-family: arial;">
                    0                </td>
                <td  style="font-size: 11px; padding-top: 3px; padding-bottom: 3px; font-family: arial;">
                   <?php echo number_format($ms+(($key['price']*10)/100));?>                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td style="border-top: thin dotted black; border-bottom: thin solid black; padding-top: 5px; padding-bottom: 3px;">
        <table style="width: 100%" cellpadding="0" cellspacing="3">
            <tr>
                <td style="color: #0070c0; font-weight: bold; font-size: 10px; width: 150px; vertical-align: top; font-family: arial;">
                    PREFERED CHOICE(S) :
                </td>
                <td >
                    <table style="width: 100%" cellpadding="0" cellspacing="3">
                                                    <tr>
                                <td style="font-family: arial; font-size: 10px;" colspan="3">
                                    No prime location choice is preferred for this Booking.
                                </td>
                            </tr>
                                                </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table style="width: 100%" cellpadding="2" cellspacing="3">
            <?php 
	$connection = Yii::app()->db;
	$members="Select * from booking 
	left join members  on members.id=booking.member_id
	left join tbl_city  on tbl_city.id=members.city_id
	left join tbl_country  on tbl_country.id=members.country_id
	where members.id=".$_GET['member_id']." and plot_id=".$_GET['id']."";
	$mem_res=$connection->CreateCommand($members)->query();
	foreach($mem_res as $member){ 
	?>
            <tr>
                <td colspan="4" style="color: #0070c0; font-weight: bold; font-size: 10px; width: 150px; vertical-align: top; padding-top: 5px; padding-bottom: 3px; font-family: arial;">
                    PERSONAL INFORMATION :
                </td>
                <td rowspan="3" style="width: 150px;">
                    <span class="profile-picture">
                                                     <img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>"  style="height:60px;">
                                                </span>
                </td>
            </tr>
            <tr>
                <td style="width: 100px; font-size: 10px; font-family: arial;">
                    Name of Applicant
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;" colspan="3">
                      <?php echo $member['name'];?>                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    Father/Spouse
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;" colspan="3">
                    <?php echo $member['sodowo'];?>               </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    CNIC / NICOP No.
                </td>
                <td colspan="4">
                    <table  cellpadding="5" cellspacing="1">
                        <tr>
                                                            <td style="border: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                                    <?php echo $member['cnic'];?>                                </td>
                                
                        </tr>
                    </table>
                                    </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    Passport No.
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">&nbsp;
                    
                                    </td>
                <td style="font-size: 10px; font-family: arial;">
                    &nbsp;&nbsp;&nbsp;Date of Birth
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                     <?php echo $member['dob'];?>                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    Mailing Address
                </td>
                <td style="border-bottom: thin solid black; font-size: 11px; font-weight: bold; font-family: arial;" colspan="3">
                    <?php echo $member['address'];?>                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    City 
                </td> 
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                    <?php echo $member['city'];?>                   </td>
                <td style="width:110px; font-size: 10px; font-family: arial;">
                    Country
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;" colspan="1">
                    <?php echo $member['country'];?>                   </td>
            </tr>
            <tr>    
                <td style="font-size: 10px; font-family: arial;">
                    Cell No.
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                   <?php echo $member['phone'];?>                    </td>
                <td style="font-size: 10px; font-family: arial;">
                    eMail
                </td>
                <td style="border-bottom: thin solid black; font-size: 11px; font-weight: bold; font-family: arial;" colspan="1">
                    <?php echo $member['email'];?>                    </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    Tel (Res)
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">&nbsp;
                                    </td>
                <td style="font-size: 10px; font-family: arial;">
                    Tel (Office)
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;" colspan="1">&nbsp;
                                    </td>
            </tr>
            <tr>
                <td colspan="5" style="color: #0070c0; font-weight: bold; font-size: 10px; width: 150px; vertical-align: top; padding-top: 5px; padding-bottom: 3px; font-family: arial;">
                    NOMINEE / NEXT OF KIN INFORMATION :
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    Nominee Name
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;" colspan="3">
                          <?php echo $member['nomineename'];?>               </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    Father/Spouse
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;" colspan="3">
                                    </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    CNIC / NICOP No.
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                     <?php echo $member['nomineecnic'];?>                </td>
                <td style="font-size: 10px; font-family: arial;">
                    Relation with Applicant
                </td>
                <td colspan="1" style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                      <?php echo $member['rwa'];?>               </td>
            </tr>
             <?php }?>
        </table>
    </td>
</tr>
<tr>
    <td style="font-size:5px;">&nbsp;</td>
</tr>
<tr>
    <td style="border-top: thin dotted black;">
        <table style="width: 100%" cellpadding="2" cellspacing="3">
            <tr>
                <td colspan="2" style="color: #0070c0; font-weight: bold; font-size: 10px; width: 150px; vertical-align: top; padding-top: 5px; padding-bottom: 3px; font-family: arial;">
                    PAYMENT DETAILS :
                </td>
                                <td colspan="2">&nbsp;
                    
                </td>
                            </tr>
            <tr>
                <td style="width: 100px; font-size: 10px; font-family: arial;">
                
                 Deposit Slip No.                    
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                
                    <?php echo $member['reference_no'];?>
                                        
                    
                </td>
                <td style="width: 110px; font-size: 10px; font-family: arial;">
                    Deposit Date:                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                      <?php echo $member['transaction_date'];?>
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                    Account No.
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;" colspan="3">
                                    </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial;">
                     
                    
                    Pending Amount                     
                </td>
                <td style="border-bottom: thin solid black; font-size: 13px; font-weight: bold; font-family: arial;">
                
                                        <?php echo number_format($ms+(($key['price']*10)/100));?> 
                     
                                          
                     
                </td>
                <td colspan="2" style="font-size: 10px; font-family: arial;">
                 
                    In the favour of <strong>"Royal Orchard Holdings Pvt Ltd"</strong>
                    
                   
                    
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td style="font-size:5px;">&nbsp;</td>
</tr>
<tr>
    <td style="border-top: thin dotted black;">
        <table style="width: 100%" cellpadding="2" cellspacing="3">
            <tr>
                <td colspan="4" style="color: #0070c0; font-weight: bold; font-size: 10px; width: 150px; vertical-align: top; padding-top: 5px; padding-bottom: 3px; font-family: arial;">
                    DEALER DETAILS :
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-family: arial; width: 60px;">
                    Name
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                                  </td>
                <td style="font-size: 10px; font-family: arial; width: 100px;">
                    Business Title
                </td>
                <td style="border-bottom: thin solid black; font-size: 12px; font-weight: bold; font-family: arial;">
                                    
                               
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td style="padding-top: 5px;">
        <table style="width: 100%" cellpadding="0" cellspacing="0">
            <tr>
                <td style="text-align: center; font-size: 14px; font-weight: bold; font-family: arial; border-top: thin dotted black; padding-top: 12px; padding-bottom: 5px;">
                    D E C L A R A T I O N
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 12px; font-family: arial;">
                    I have read and understood the <strong>terms and conditions</strong> written on the back of this form and I hereby agree to<br />
                    abide by these as well as any future <strong>Royal Orchard Housing</strong> Rules and Regulations.
                </td>
            </tr>
            <tr>
                <td style="height: 30px;">&nbsp;
                    
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width: 50px; font-size: 11px; font-family: arial;">
                                Date :
                            </td>
                            <td style="border-bottom: thin solid black; width:120px; font-size: 11px; font-family: arial;">&nbsp;
                                                            </td>
                            <td style="text-align: right; font-size: 11px;  font-family: arial;">
                                Signature :
                            </td>
                            <td style="border-bottom: thin solid black; width: 150px; font-size: 11px; font-family: arial;">&nbsp;
                                                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
        <table style="width: 100%" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2" style="background-color: #ffc000; padding: 3px; text-align: center; font-weight: bold; font-size: 10px; font-family: arial;">
                    IMPORTANT NOTES
                </td>
            </tr>
            <tr>
                <td style="background-color: #525252; padding-bottom: 5px; padding-top: 5px;">
                    <table style="width: 100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color:white; font-size: 9px; font-family: arial; ">
                                &nbsp;Please dispatch signed Application along with following attachments :
                            </td>
                        </tr>
                        <tr>
                            <td style="color:white; padding-left:30px; font-size: 9px; font-family: arial;">
                                1)  Copies of CNIC/NICOP of Applicant & Nominee<br />
                                2)  2 x Passport size recent color photographs<br />
                                3)  Payment evidence (Deposit slip).<br>
                                    or email to sales@royalorchard.pk 
                            </td>
                        </tr>
                    </table>

                </td>
                <td style="background-color: #525252; padding-bottom: 5px; padding-top: 5px;">
                    <table style="width: 100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style=" font-size: 9px; font-family: arial;">
                                <strong style="color:white; text-decoration:underline;">Central Office Islamabad:</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:white; font-size: 9px; font-family: arial;">
                            Silver Square Plaza, Plot # 15, Street # 73,<br />
                                    Mehr Ali Road, F-11 Markaz Islamabad, Pakistan<br />
                                    Tel : +92 51 2224301-04 <br />
                                    Toll Free :  0800(ROYAL) 76925 | UAN : +92 51 111 444 475
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </td>
</tr>
</table>


<div style="page-break-before: always;"></div>
<table style="width: 100%;" id="terms1" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table style="width: 100%" cellpadding="0" cellspacing="5">
                <tr>
                    <td style="width: 150px;">
                        <table style="width: 100%" cellpadding="0" cellspacing="5">
                            <tr>
                                <td>
                                
                                   
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td>&nbsp;
                        
                    </td>
                    <td style="text-align: right;">
                        <table style="width: 100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="text-align: right;">
                            <barcode code="fdh54970-6198" type="QR" border="0" class="barcode" size="0.5" error="M" />
                           
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</td>
</tr>
<tr>
    <td style="background-color: #1e3466; color: white; font-size: 16px; text-align: center; padding-bottom: 8px; padding-top: 8px; font-weight: bold;">Online Booking / Registration eForm</td>
</tr>

<tr>
    <td>
    <table style="width: 100%" cellpadding="0" cellspacing="0">  
  <!------ error start---->
      
			 <tr>
                <td style="text-align: center; font-family: arial; font-size: 14px; font-weight: bold; text-decoration: underline; padding-top: 8px;" colspan="2">
                    TERMS & CONDITIONS :
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 20px;">
                                                         
                </td>
                <td style="font-family: arial; font-size: 10px; font-weight: bold; text-decoration: underline;">
                    General
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    1.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    All residents of Pakistan and Overseas Pakistanis are eligible to apply of form houses or residential/commercial plots or villa or shop.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    2.                                    
                </td>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    This Booking Form can only be used for booking in the name of the Applicant.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    3.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    The Original Form must be attached along with other required documents.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    4.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Only ONE property can be booked against ONE form.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    5.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    All columns and entries must be completed in BLOCK LETTERS. No entry is to be left blank. An incomplete Booking Form will not be processed.
                </td>
            </tr>
            <tr>
                <td>
                                                         
                </td>
                <td style="font-family: arial; font-size: 10px; font-weight: bold; text-decoration: underline; height: 25px; vertical-align: middle">
                    Balloting Details
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    6.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    To be eligible for the balloting either plot or allocation (whichever is applicable) duly filled Booking Form along with (i) accompanying documents and (ii) 1st installment & Registration/Processing/ membership fee, will be submitted, by the deadline specified. Submission and receipt of a complete Booking Form does not constitute any confirmation or representation regarding successful allotment.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    7.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Successful booking applicants will be determined through computerized balloting. The successful applicants so determined shall be obliged to comply with the terms and conditions of booking and allotment.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    8.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    For unsuccessful applicants, the Amount already paid will be refunded, within three months after the balloting without any profit, interest or markup, however, the Registration/Processing/MS Fee already paid is non-refundable. For this purpose, unsuccessful applicant will have to submit the Refund Form. Upon unsuccessful application, the applicant's relevant Registration & membership shall stand cancelled.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    9.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Balloting will only decide the allotment of a plot. Exact location of the plots for the Successful applicants will be determined through further computerized balloting in due course of time.
                </td>
            </tr>
            <tr>
                <td>
                                                         
                </td>
                <td style="font-family: arial; font-size: 10px; font-weight: bold; text-decoration: underline; height: 25px; vertical-align: middle">
                    Payment Details:
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    10.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    All payments are to be made in the shape of Pay order/Bank Draft according to the Category Size of the property, as per the schedule of payments in favor of "Royal Orchard Housing (Pvt.) Ltd. at designated offices.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    11.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Installments received after due date from the allottee/applicants will only be accepted with surcharge @ 1.5% per month (which will be taken as @ 0.05% daily). Provided that if any allottee fails to pay 2 successive installments within the prescribed period, the allotment is liable to be cancelled without notice. In the event of cancellation of the property, the submitted payment will be refunded with 25% deduction and deduction of surcharges without any profit, interest or markup; however the Registration/processing MS fee already paid is non-refundable.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    12.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    No applicant shall be entitled to claim or receive any interest/mark up against the amounts paid by him.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    13.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    The discount, if any, formally announced by the management will be made available to the relevant applicant and accordingly adjusted in the last Installment of dues against the allotted property.
                </td>
            </tr>
            <tr>
                <td>
                                                         
                </td>
                <td style="font-family: arial; font-size: 10px; font-weight: bold; text-decoration: underline; height: 25px; vertical-align: middle">
                    Property Details
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    14.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    One Booking Form can be used for seeking allotment of One farm house or Residential/Commercial Plot, Villa or Shop only.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    15.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    A property once allotted or transferred cannot be surrendered or applied for cancellation by the applicant and all amount paid on account thereof shall be NON-REFUNDABLE. However, in case the property is cancelled on details specified in Para # 11, or any reason whatsoever, then the submitted payment will be refunded with 25% deduction, without any profit, interest or markup, however the Registration/Processing/MS fee already paid is non-refundable.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    16.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    For each preferential location i.e. corner, facing park, main road (41' to 99') applicants will pay 10% premium each after the balloting. In case of multiple preferences in location, the applicant will pay in multiples of 10%, 20%, 30% and 40%. For example, main road (41' to 99') corner and park facing property will be charged 30% in addition to the total amount including development charges. For the property falling on main boulevard 15% extra is to be paid by the allotee.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    17.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    A property allotted to an applicant shall not be used by the allottee for any purpose other than that applied or meant for.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    18.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Only pre-approved elevation for a given property can be constructed on the plots. No further construction or modification to any constructions can be done without the prior approval of the management.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    19.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Notwithstanding the balloting, the exact size and location of the property will remain tentative and subject to adjustment in accordance with demarcation/measurement of the property at the time of handing over of possession.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top; width: 20px;">
                    20.                                    
                </td>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    In case of extra area (over and above the allotted area) with any property, proportionate extra amount will be charged in addition to the total amount.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    21.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Transfer of allotted property shall be allowed only after the receipt of updated <strong>No Demand Certificate</strong>. All charges shall be borne by the allottee. The seller and purchaser are required to be present in front of transfer officer.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    22.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Before transfer of property, first allottee will be bound to clear all committed dues.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    23.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    All Registration and Mutation charges shall be borne by the allottee along with any other government taxes in vogue.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    24.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    The management reserves the right to allot sell a property cancelled from the name of the allottee due to nonpayment of dues, or any reason what so ever, to any other applicant or person and the ex-allottee shall have no right to such a property. The Management decision in this regard shall be final.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    25.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Development charges include the charges of internal development for roads, footpaths, main water supply and sewerage but does not include the cost/charges of provision of electricity, sui-gas, telephone, mosque, maintenance & transport system etc. Provision of utility & service charges shall be obtained later.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    26.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    In addition to the dues and any dues payable under applicable laws, the allottee will be liable to pay escalation and other charges at the rates to be specified from time to time to accommodate escalations in the cost of raw material and provision of other amenities/services for urban development.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    27.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    In case of any dispute, will be referred to arbitration by an authorized officer of the society, whose decision shall be final and binding on the parties to the dispute.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    28.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Every applicant will abide by these Terms and Conditions in addition to the bye-laws, rules and regulations governing allotment, possession, ownership, construction and transfer of properties, enforced from time to time by the management and any other Authority Department competent to do so, in accordance with applicable laws.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    29.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    Any additional charges (if imposed) shall be payable as determined by the management from time to time.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    30.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    In case the management by virtue of any reason, fails to allot a property, the applicant shall not make any claim of damage, compensation or interest.
                </td>
            </tr>
            <tr>
                <td style="font-family: arial; font-size: 9px; vertical-align: top">
                    31.                                    
                </td>
                <td style="font-family: arial; font-size: 9px;">
                    The management can accept or reject any application without assigning any reason.
                </td>
            </tr>
            </table>
                 <!------ error end---->
        <table style="width: 100%" cellpadding="0" cellspacing="0">      
           
            <tr>
                <td colspan="2">
                    <table style="width: 100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style=" text-align: center; height: 40px;">
                                <span style="text-decoration:underline; font-family: arial; font-size: 14px; font-weight: bold;">DECLARATION</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: arial; font-size: 12px;">
                                I have read all the Rules and Regulations accompanying this form and I hereby agree to abide by these as well as all existing and future of Royal Orchard and Local Administration Rules and Regulations.
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 20px;">&nbsp;
                                
                            </td>
                        </tr>
                        <tr>
                            <td style=" font-size: 9px; font-family: arial;">
                                <table style="width: 100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="width:190px;">Signature of the Applicant: </td>
                                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                                        <td style="width:80px; text-align: right;">Dated: </td>
                                        <td style="border-bottom: 1px solid black; width: 150px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>



</table>



</textarea>
<div style="text-align: left; margin-top: 1em;">
 
</div>


 <button type="submit" class="btn btn-success btn-lg">Click Here To Download Online Booking / Registration Form</button></td></tr>
</tbody>
</table>
</div></form>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>




</div>
 
 

<!-- section 3 --> 
</div>
</div>
</div>
