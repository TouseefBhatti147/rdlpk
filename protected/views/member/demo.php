<?php

$image1 = '/images/logo.jpg'; 
require_once("dompdf/dompdf_config.inc.php");
spl_autoload_unregister(array('YiiBase','autoload')); 
spl_autoload_register(array('YiiBase','autoload')); 

// We check wether the user is accessing the demo locally
$local = array("::1", "127.0.0.1");
$is_local = in_array($_SERVER['REMOTE_ADDR'], $local);

if ( isset( $_POST["html"] ) && $is_local ) {

  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($_POST["html"]);
  $dompdf->set_paper($_POST["paper"], $_POST["orientation"]);
  $dompdf->render();

  $dompdf->stream("form.pdf", array("Attachment" => false));

  exit(0);
}

 if ($is_local) { 
 ?>
<div class="row-fluid my-wrapper">
<div style="float:right; width:300px;">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

<select name="paper" style="display:none">
<?php
foreach ( array_keys(CPDF_Adapter::$PAPER_SIZES) as $size )
  echo "<option ". ($size == "legal" ? "selected " : "" ) . "value=\"$size\">$size</option>\n";
?>
</select>
<select name="orientation" style="display:none">
  <option selected value="portrait">portrait</option>
  <option value="landscape">landscape</option>
</select>
<input type="hidden" value="<?php echo $_REQUEST['plot_id'] ?>" id="plot_id" name="plot_id" >
<textarea name="html"  style="display:none;">

<!DOCTYPE>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form</title>
<style>

body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	line-height:19px;
	}
.main-wrapper {
	max-width:660px;
	margin:0 auto;
	}
.my-logo {
	width:0px;
	height:120px;
	float:left;
	}
.top-bar {
	width:350px;
	height:50px;
	
	
	}
.top-bar .left {
	text-align:left;	
	
	float:left;
	}
.top-bar .right {
	text-align:right;	
	
	float:right;
	}
.hd-top-area {
	width:400px;
	float:left;
	text-align:center;
	height:auto;
	margin-bottom:30px;
	}
.my-content {
	}
.my-content .center {
	text-align:center;
	}
.my-content .left {
	text-align:left;
	}
.my-content .justify {
	text-align:justify;
	}
.clear {
	clear:both;
	}
	
.input-01 {
	background:none;
	border-top:none;
	border-left:none;
	border-right:none;
	border-bottom:1px solid #333;
	width:150px;
	padding:5px 10px;
	}
.justify div { float:left;}	
</style>
</head>

<body>

	<div class="main-wrapper">
    	<div class="header">
        
        	<div class="my-logo">
            <img src="C:\wamp\www\hb\images\logo1.jpg" />

            </div>
            <div class="top-bar" style="margin-left:120px;">
            
            	<div class="left">Price Rs. 50/-</div>
                
                <div class="right">Serial No.______________</div>
            
            </div>
            
            <div class="hd-top-area" style=" margin-left:120px;">
            
            	Valid if rendered on or before __________________<br />
            
            	<b>APPLICATION FOR THE TRANSFER OF ALLOTMENT OF PILOT</b>
            
            </div>
        
        </div>
        
        <div class="clear"></div>
        
        <div class="my-content">
        
        	<div class="left" style=" margin-left:80px;">
            
            	<b>The President,<br />
                Federal Employees Co-operative Housing Society,<br />
                Muzaffar Chambers, 82 West, Blue Area, G-7 F-7, Islamabad.</b>
            
            </div>
            <br />
            <div class="justify">
            
            	<b>Subject:       TRANSFER OF ALLOTMENT OF PLOT NO. <option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option><br />
                AT KORANG TOWN, JINNAH GARDEN-I, JINNAH GARDEN-II, ISLAMABAD.<br /><br />
            
            	Dear Sir,<br />
                I was alloted/transferred, by HRL, plot No.<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option> Street No.<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['street'];  ?></option>At Korang Town,Jinnah Garden-I,Jinnah Garden-II islamabad measuring <option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_size'];  ?></option> Square yards vide allotment Letter/transfer letter No.<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>Dated<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>(attached in orignal).I have now declined to transfer the said plot to Mr./Mrs./Miss<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option> son/ daughter/ wife of<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>Age about<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>years,resident of<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>.<br /></b>
            
            from whom I have recieved the entire amount  paid by me to the society on account of price of the plot etc.,and who has agreed to abide by all the terms and cositions of the society and to pay transfer fee as prescribed by the spciety and other dues payable by me in respect of the said plot.<br /><br />
            <b>It is, therefore, requested that the allotment of the plot may kindly br transfered in the name of Mr./Mrs./Miss<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>.</b>
            
            <br /><br />
            
            with all my rights except my membership & shares of the society, liabilities and deposits with the society. I enclose herewith the following documents:<br /><br />
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>i.&nbsp;&nbsp;&nbsp;Orignal Ailotment/ Transfer Letter.</b><br />
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ii.&nbsp;&nbsp;&nbsp;Photostat copy of identity Card of the Purchaser(s) and seller(s) (attested)</b><br />
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>iii.&nbsp;&nbsp;&nbsp;Photostat copy of National identity Card of the Officer Attesting The Signature of Allotee and Transferee.</b><br />
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>iv.&nbsp;&nbsp;&nbsp;Photograph of Purchaser And Seller</b><br />
            
            </div>
            
            <div class="justify">
            
            	<div class="left">
                
                	<b>Dated<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option></b><option style="padding:0 0 0 40px;"></option><b> Your Faithfully</b><br />
                    
                    <b>Specimen Signature of allotee / transferor</b><br />
                    
                    1.<input class="input-01"><br />
                    
                    2.<input class="input-01"><br />
                    
                    3.<input class="input-01"><br /><br />
                    
                    <b>Attested</b><br /><br />
                    
                    Signature<input class="input-01"><br />
                    
                    Name & Designation<input class="input-01"><br />
                    
                    NIC No.<input class="input-01"><br />
                    
                    (Seal of Officer)<br />
                    
                    <hr />
                    
                    <div style="text-align:center;"><h2>CERTIFICATE</h2></div>
                    
                    <b>Certified that Mr./Mrs./Miss<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>(Allotee/transferor) Son/daughter/wife<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>resident of<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>Who is known to me personally has signed tis application in my presence this<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>day of<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>20<option class="input-01" style=" padding:0 50px;"> <?php echo $plotdetails['plot_detail_address'];  ?></option>.</b><br /><br />
                    <div class="right" style="width:400px; float:right;">
                    
                    	Signature<input  class="input-01"><br />
                        
                        Name & Designation<input  class="input-01"><br />
                        
                        NIC No.<input  class="input-01"><br />
                        
                        <div class="center"><b>Seal of Officer</b></div>
                    
                    </div>
                
                </div>
            
            </div>
        
        </div>
        
        <div class="clear"></div>
        <br />
        
        
        <div class="footer" style="text-align:center;"><b>82-West, Muzaffar Chambers, Blue Area, G-7/F-7, Islamabad</b></div>
    
    </div>
    <hr />
    <div class="main-wrapper">
        
        <div class="my-content">
            
            <div class="justify">
            
            	<div style="text-align:center;"><b>APPLICATION / DECLARATION OF TRANSFEREE</b></div>
                
                I<input  class="input-01">son/daughter/wife of<input  class="input-01"> age about<input  class="input-01">years resident of <input  class="input-01">hereby admit the contents of the Dated<input  class="input-01"> issued by<input  class="input-01">For Rs.<input  class="input-01">(Rupees)<input  class="input-01">Drawn on<input  class="input-01"> in favour of HRL Islamabad on account of transfer fee and or balance cost of you of plot.<br /><br />
                
                In case the allotment is transferred in my name. I hereby undertake:-<br /><br />
                
                i)&nbsp;&nbsp;&nbsp;To abide by the By laws of the Society.<br />
                
                ii)&nbsp;&nbsp;&nbsp;To abide by all the terms and conditions of allotment of the plot and to comply with all the orders, directions, instructions etc., Issued from time to time by the society.<br />
                
                iii)&nbsp;&nbsp;&nbsp;To pay all the dues, fee, changes etc., Payable by the allotee to the society or any other Government Deptt. Etc., In respect of the said plot and the house constructed tereson.<br />
                
                iv)&nbsp;&nbsp;&nbsp;To use the plot for the same purpose for which it was alloted and to construct the building complying with all the relevent Rules/Regulations, direction, instruction etc., In force or issued from time to time by the society.<br /><br /><br />
                
                <div style="width:400px; float:left;">
                
                	Date<input  class="input-01"><br />
                    
                    Specimen Signature of transferee<br />
                    
                    1.<input  class="input-01"><br />
                    
                    2.<input  class="input-01"><br />
                    
                    3.<input  class="input-01"><br /><br />
                    
                    <b>Attested</b><br /><br />
                    
                    Signature<input  class="input-01"><br />
                    
                    Name & Designation<input  class="input-01"><br />
                    
                    NIC No.<input  class="input-01"><br />
                    
                    (Seal of Officer)
                
                </div>
                
                <div style="width:500px; float:right;">
                
                	Signature of transferee<input  class="input-01"><br />
                    
                    Name<input  class="input-01"><br />
                    
                    Son/daughter/wife<input  class="input-01"><br />
                    
                    Address<input  class="input-01"><br />
                    
                    NIC No.<input  class="input-01"><br />
                
                </div>
            
            </div>
        
        </div>
    
    </div>

</body>
</html>
</textarea>

<div style="text-align: center; margin-top: 1em;">
  <button type="submit" class="srch-btn">Dwonload Transfer From</button>
</div>

</form>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

<select name="paper" style="display:none">
<?php
foreach ( array_keys(CPDF_Adapter::$PAPER_SIZES) as $size )
  echo "<option ". ($size == "legal" ? "selected " : "" ) . "value=\"$size\">$size</option>\n";
?>
</select>
<select name="orientation" style="display:none">
  <option selected value="portrait">portrait</option>
  <option value="landscape">landscape</option>
</select>
<input type="hidden" value="<?php echo $_REQUEST['plot_id'] ?>" id="plot_id" name="plot_id" >
<textarea name="html"  style="display:none;">
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<title>Challan Form</title>

<style>
.challan-wrapper { 
background-image:url(../logo.jpg);
	width:660px;
	height:auto;
	margin:0 auto;
	border:1px solid #000;
	padding:10px;
	min-height:780px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:9px;
	}
	
.challan-header{
	width:100%;
	height:110px;
	float:left;
	}
	
.logo {
	float:left;
	}
	
.header-right {
	width: 220px;
	height: auto;
	float: right;
	margin-top: 18px;
	}
	
.header-right-box {
	width:110px;
	height:auto;
	float:left;
	line-height:50px;
	}
	
.box-01 {
	width:110px;
	height:20px;
	float:left;
	border:1px solid #000;
	margin-bottom:4px;
	}
	
.hdr-center {
	width: 200px;
	height: auto;
	font-weight: bold;
	text-align: center;
	margin: 22px 52px;
	font-size: 17px;
	float: left;
	}

.strip-01 {
	width:100%;
	height:25px;
	float:left;
	clear:both;
	}
	
.no-brdr {
	border:none !important;
	}
	
.mrgn {
	margin:3px 0 !important;
	}
	
.colum-left {
	width: 19.5%;
	height: 10px;
	float: left;
	border: 1px solid #000;
	padding: 5px;
	margin-left: -1px;
	}
	
.colum-left-02 {
	width: 15.5%;
	height: 10px;
	float: left;
	border: 1px solid #000;
	padding: 5px;
	margin-left: -1px;
	}
	
.colum-left-03 {
	width: 10%;
	height: 10px;
	float: left;
	border: 1px solid #000;
	padding: 5px;
	margin-left: -1px;
	}
	
.colum-left-04 {
	width: 21.9%;
	height: 10px;
	float: left;
	border: 1px solid #000;
	padding: 5px;
	margin-left: -1px;
	}
	
.colum-cntr {
	width:55.8%;
	height:10px;
	float:left;
	border:1px solid #000;
	padding: 5px;
	margin-left: -1px;
	}
	
.colum-cntr-inverse {
	width:55.8%;
	height:10px;
	float:left;
	background:#000;
	border:1px solid #000;
	padding: 5px;
	margin-left: -1px;
	color:#fff;
	}
	
.colum-cntr-02 {
	width:39.6%;
	height:10px;
	float:left;
	border:1px solid #000;
	padding: 5px;
	margin-left: -1px;
	}
	
.colum-half {
	width:48%;
	height:54px;
	float:left;
	border:1px solid #000;
	padding: 5px;
	margin-left: -1px;
	}
.clear {
	clear:both;
	}	
	

</style>

</head>

<body>

    <table class="challan-wrapper">
    
	    	<tr class="challan-header">
        
        	<td class="logo"><img src="C:\wamp\www\hb\images\logo1.jpg" alt="" /></td>
            
            <td class="hdr-center">HRL </td>
            
            <td class="header-right">
            
            <table width="100%" border="1">
            <tr>
            	<td class="no-brdr"><b>HRL Challan #</b></td>
            	<td width="100">E-203-171320</td>
            </tr>
            <tr>
            	<td class="no-brdr"></td>
                <td width="100">01</td>
            </tr>
            
            </table>
            
            </td>
        
        </tr>
        
        <tr class="strip-01">
        	<td colspan="3">
            <table width="100%">
            <tr>
        	<td class="colum-left">Bank Branch</td>
            
            <td class="colum-cntr-02">ISLAMABAD, MCB - Main Civic Center [0613]</td>
            
            <td class="colum-left-02">Date</td>
            
            <td class="colum-left-02">09/09/2013</td>
        </tr>
        
       <tr class="strip-01 mrgn">
        
        	<td class="colum-left no-brdr">Account Title</td>
            
            <td class="colum-cntr-02 no-brdr"><b>Security and Exchange Commision of Pakistan</b></td>
            
            <td class="colum-left-03 no-brdr">Account No</td>
            
            <td class="colum-left-04">0578359181417</td>
        
        </tr>
        
        <tr class="strip-01 mrgn">
        
        	<td class="colum-left">Name of Company</td>
            
            <td class="colum-cntr-02">CREATIVE GARAGE (PVT) LIMITED</td>
            
            <td class="colum-left-02">Registration No</td>
            
            <td class="colum-left-02">0578359181417</td>
        
        </tr>
        <tr class="strip-01 mrgn">
        
        	<td class="colum-left"><b>Code No.</b></td>
            
            <td class="colum-cntr"><b>Head Of Accounts</b></td>
            

            <td class="colum-left"><b>Amount (Rs)</b></td>
            
        </tr>
        
        </table>
        </td>
        </tr>
        
        
        <tr class="strip-01 mrgn">
        
        	<td class="colum-left no-brdr"></td>
            
            <td class="colum-cntr-inverse" colspan="2">Reciept under Companies Ordinance, 1984</td>
            
            
        </tr>
        <tr class="strip-01">
        
        	<td class="colum-left">61056</td>
            
            <td class="colum-cntr">Availability of Name Fee</td>
            
            <td class="colum-left">200.00</td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left"></td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left"></td>
            
        </tr>
        
        
        <tr class="strip-01">
        
        	<td class="colum-left no-brdr"></td>
            
            <td class="colum-cntr no-brdr"></td>
            
            <td class="colum-left no-brdr"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left">6-05</td>
            
            <td class="colum-cntr">Other fees(Please specify)</td>
            
            <td class="colum-left"></td>
            
        </tr>
        <tr class="strip-01">
        
        	<td class="colum-left no-brdr"></td>
            
            <td class="colum-cntr no-brdr">Total</td>
            
            <td class="colum-left">200.00</td>
            
        </tr>
        
        
        <tr class="strip-01">
        
        	<td class="colum-left">Payment Details</td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left  no-brdr">ORIGNAL</td>
            
        </tr>
        
        
        <tr class="strip-01">
        
        	<td class="colum-left">Cheque No.</td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left  no-brdr"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left">Drawn On</td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left  no-brdr"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left">Rupees (in words)</td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left  no-brdr"></td>
            
        </tr>
        
        <tr class="strip-01">
        
        	<td class="colum-left">Name of Depositor</td>
            
            <td class="colum-cntr"></td>
            
            <td class="colum-left  no-brdr"></td>
            
        </tr>
        
        
        <tr class="strip-01 mrgn">
        
        	<td class="colum-half" width="100%">Depositor Sig.</td>
            
            <td class="colum-half" align="center" colspan="2">Teller Sig. & Bank Stamp</td>
            
        </tr>
        
    </table>
    </div>
</body>
</html>


</textarea>

<div style="text-align: center; margin-top: 1em;">
  <button type="submit" class="srch-btn">Dwonload Challan From</button>
</div>

</form>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

<select name="paper" style="display:none">
<?php
foreach ( array_keys(CPDF_Adapter::$PAPER_SIZES) as $size )
  echo "<option ". ($size == "legal" ? "selected " : "" ) . "value=\"$size\">$size</option>\n";
?>
</select>
<select name="orientation" style="display:none">
  <option selected value="portrait">portrait</option>
  <option value="landscape">landscape</option>
</select>
<input type="hidden" value="<?php echo $_REQUEST['plot_id'] ?>" id="plot_id" name="plot_id" >
<textarea name="html"  style="display:none;">
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Challan Form</title>

<style>
.token-wrapper {
	width:400px;
	height:400px;
	margin:0 auto;
	border:1px solid #000;
	padding:10px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	padding:20px;
	}
	
.token-hdr {
	width:100%;
	height:17px;
	padding:10px 0;
	float:left;
	border-bottom:2px solid #000;
	font-size:16px;
	}
	
.token-hdr-01 {
	width:48%;
	height:17px;
	float:left;
	}
	
.txt-lft {
	text-align:left;
	}
	
.txt-rht{
	text-align:right;
	}
	
.token-num {
	width:100%;
	height:auto;
	float:left;
	font-size: 245px;
	}
	
.token-ftr {
	width:100%;
	height:17px;
	padding:10px 0;
	float:left;
	}
	
.token-ftr h3 {
	margin:0;
	 	}
	
.brdr-btm {
	border-bottom:2px solid #000;
	}
	
.token-ftr-01 {
	width:48%;
	height:auto;
	padding:10px 0;
	float:left;
	}
	

</style>

</head>

<body>

	<div class="token-wrapper">
    
    	<div class="token-hdr brdr-btm">
        
        	<div class="token-hdr-01"><b>HRL</b></div>
            
            <div class="token-hdr-01 txt-rht" style=" margin:-30px 0 0 130px;"><b></b></div>
        
        </div>
        
        <div class="token-num brdr-btm">002</div>
        
        <div class="token-ftr" style="float:left;">
        
        	<div class="token-ftr-01">
            
            	<h3>Transfer Of Plot</h3><br />
                
                <b>Plot Number :</b>_______________<br />
                
            
            </div>
            
            <div class="token-ftr-01 txt-rht" style="margin:-200px 0 0 200px;">
            
            	<h3>Appointment Time</h3><br />
                
                <b>Date :</b>23 Dec 2013<br />
                
                <b>Time :</b>06:00 PM
                
            
            </div>
        
        </div>
    
    </div>
    
</body>
</html>



</textarea>

<div style="text-align: center; margin-top: 1em;">
  <button type="submit" class="srch-btn">Dwonload Token</button>
</div>

</form>
</div>
<div><h3>Download Documents</h3>
<p>Download all Requiered Documents in PDF Format For Plot Trandfer </p>
</div>
</div>
<?php } else { } ?>

