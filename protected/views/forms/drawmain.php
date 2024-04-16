<img src="/images/draw.jpg" />
<img onclick = "show()" src="/images/RDL M DRAW.png" style="position: absolute;
    left: 458px;
    top: 411px;
    cursor: pointer;"
     />
    
    
  
<div style="    left: 67px;
    position: absolute;
    top: 180px;
    display: none;
    background-color: rgb(255, 0, 0);"  id = "myDiv">

<img style="height: 1000px;
    width: 1200px;" id = "myImage" src = "/images/111.gif"></div>
<div style="    left: 67px;
    position: absolute;
    top: 180px;
    display: none;
    background-color: rgb(255, 0, 0);"  id = "myDiv1">

<img style="height: 1000px;
    width: 1200px;" id = "myImage" src = "/images/new.jpg"></div>
    
    
    <br>

<script type = "text/javascript">  
function show(){ 
 document.getElementById("myDiv").style.display="block";
setTimeout(function(){
   document.getElementById("myDiv").style.display="none";
   document.getElementById("myDiv1").style.display="block";
}, 10000);  
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>

 $(function(){
var bid=<?php echo $_REQUEST['bid']; ?>	
var pid=<?php echo $_REQUEST['pid']; ?>	
  $.ajax({
	     url:"http://<?php echo $address ?>/index.php/forms/draw?bid=" + bid + "&pid=" + pid,
                  type:"POST",
                  //data:"bid="+$bid+"&pid="+pid,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });

});
}

</script>