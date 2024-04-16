
<!-- The above comment forces the page to run in Internet Zone regardless of where it is launched (IE only?)-->

<html>
<head>
<title>UareU Multi-Function Applet</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<script type="text/javascript">
    function onLoad() {
        document.loginForm.radioANSI.checked = "true";
    }
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>
</head>
<body onLoad="onLoad();"> 
<div id="wrapper">
<!--SLIDE-IN ICONS-->
   
<script type="text/javascript">

//Get browser info
    
    var _app = navigator.appName;

    var pressCount = 0;

    //Events section
   
    //Fired during internal error
    function onErrorHandler(code) {
        alert("Error:" + code);
    }

    function onLoadHandler() 
	{
		//do nothing
	}

    function onDisconnectedHandler() {
        setTimeout('document.getElementById("divInstruction").innerHTML="<b>Reader disconnected.</br>  Please connect reader. </b>"');
    }

    function onConnectedHandler() {
        setTimeout("document.loginForm.appletImage.src=\"../images/fingerprintImageSmallNoPrint.jpg\";", 500);
        setTimeout("document.getElementById('divInstruction').innerHTML=\"<b>Press finger " + (4 - pressCount) + " more times</b>\";");
    }

    function onCaptureHandler() {
        pressCount += 1;
        document.loginForm.appletImage.src = "../images/fingerprintImageSmall.jpg";
        setTimeout("document.loginForm.appletImage.src=\"../images/fingerprintImageSmallNoPrint.jpg\";", 500);
        setTimeout("document.getElementById('divInstruction').innerHTML=\"<b>Press finger " + (4 -pressCount) + " more times</b>\";");
    }

    function onEnrollmentFailureHandler() {
        alert("Enrollment failed.  Please be sure to use the same finger for each of the 4 presses or try to register a different finger.");
        pressCount = 0;
        document.getElementById('divInstruction').innerHTML = "<b>Press your finger 4 times to the sensor.</b>";
    }


    function onFMDHandler( hexFMD ) {
        document.loginForm.htbFMD.value = hexFMD;
        pressCount = 0;
        document.getElementById('divInstruction').innerHTML = "<b>FMD successfully created.</b>";
     }

     function setFormat(radioObj) {
         if (radioObj.id == "radioDP")
             document.UareUApplet.SelectFormatDP();
         else if (radioObj.id == "radioISO")
             document.UareUApplet.SelectFormatISO();
         else if (radioObj.id == "radioANSI")
             document.UareUApplet.SelectFormatANSI(); 
     }
</script>

<form action="reg.php" method="post" name="loginForm" id="loginForm" class="login-form" onSubmit="return this.validateForm()">
   <div class="header">
    <div style="float:left">
    <h1>Fingerprint Registration</h1>
    <span>Fill out the form below to Register your fingerprint for verification.</span>
    </div>
    <?php // echo?>
    <div style="float:right"> </div>
    </div>
   
   
   <div class="content">
 
    <input id="radioDP" style="margin-left: 1em"  name="FMDFormat" checked="checked" type="hidden" value="DP" onClick="setFormat(this)" /> 
    <input id="radioISO" style="margin-left: 1em" name="FMDFormat" type="hidden" value="ISO" onClick="setFormat(this)"/>
    <input id="radioANSI" style="margin-left: 1em" name="FMDFormat" type="hidden" value="ANSI" onClick="setFormat(this)"/>
</span>
</br>
<input name="username" type="text" class="input username" placeholder="CNIC Number"/>

<script type="text/javascript">  
            if (_app == "Netscape") 
            {
                document.write('<object classid="java:UareUApplet.class"',
                   'type="application/x-java-applet"',
                   'name="UareUApplet"',
                   'width="1"',  //apparently need to have dimension > 0 for foreground window to be associated with jvm process.
                   'height="0"', //otherwise, if w&h=0, must use exlusive priority
                   'type="application/x-java-applet"',
                   'pluginspage="http://java.sun.com/javase/downloads"',
                   'archive="UareUApplet.jar, dpuareu.jar"',
                   'onFMDAcquiredScript="onFMDHandler"',
                   'onEnrollmentFailureScript="onEnrollmentFailureHandler"',
                   'onImageCapturedScript="onCaptureHandler"',
                   'onDisconnectedScript="onDisconnectedHandler"',
		           'onConnectedScript="onConnectedHandler"',
                   'onErrorScript="onErrorHandler"',
                   'onLoadScript="onLoadHandler"',
                   'bRegistrationMode="true"',
                   'bDebug="true"',
                   'bExclusivePriority="true"',
                   'scriptable="true"',
                   'mayscript="true"',
                   'separate_jvm="true"> </object>'); 
   }
    
   else if(_app=="Microsoft Internet Explorer") //we assume IE (use activeX jre plugin)
   {
   document.write( '<object classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93"',
    'codebase="http://java.sun.com/update/1.6.0/jinstall-1_6-windows-i586.cab#Version=1,6,0,32"',
    'height="0" width="0" name="UareUApplet">',
             '<param name="type" value="application/x-java-applet;version=1.6" />',
             '<param name="code" value="UareUApplet"/>',
             '<param name="scriptable" value="true" />',
             '<param name="archive" value="UareUApplet.jar, dpuareu.jar"/>',
             '<param name="onFMDAcquiredScript" value="onFMDHandler" />',
             '<param name="onImageCapturedScript" value="onCaptureHandler" />',
             '<param name="onEnrollmentFailureScript" value="onEnrollmentFailureHandler"/>',
             '<param name="onDisconnectedScript" value="onDisconnectedHandler"/>',
	         '<param name="onConnectedScript" value="onConnectedHandler"/>',
             '<param name="onLoadScript" value="onLoadHandler"/>',
             '<param name="bDebug" value="true" />',
             '<param name="bRegistrationMode" value="true" />',
             '<param name="onErrorScript" value="onErrorHandler" />',
             '<param name="bExclusivePriority" value="false"/>',
             '<param name="separate_jvm" value="true" />',
             '</object>');
    }
	UareUApplet.SelectFormatANSI();
    
</script>

 
<center><div id="divInstruction"><b> Loading biometric applet.</b></div>
<img  name="appletImage" id="appletImage" border="4" src="../images/fingerprintImageSmallNoPrint.jpg" alt="Sensor ready"/> </center><br />

<textarea type="hidden" style="visibility:hidden"; name="htbFMD" id="htbFMD" readonly></textarea>

<div id="simple-msg"></div>
</div>

<div class="footer">
<input type="submit" id="submit" name="submit" value="Register" class="button" />
</div>
</form>
<img src="/uareuapplet/images/logo1.jpg"  />
<span style="font-size:9px"><b>Developed by <a href="http://creativegarage.com.pk/">Creative Garage</a></b></span>
  </div>
  
  <script>
$(document).ready(function()
{

	
$("#submit").click(function()
{
	$("#loginForm").submit(function(e)
	{
		$("#simple-msg").html("<img src='loading.gif'/>");
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				$("#simple-msg").html('<pre><code class="prettyprint">'+data+'</code></pre>');

			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				$("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
	    e.preventDefault();	//STOP default action
	    e.unbind();
	});
		
	$("#loginForm").submit(); //SUBMIT FORM
});

});
</script>
</body>
</html>
