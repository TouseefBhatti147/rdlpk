<style>
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 12px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 12px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
.typeahead tt-query p{ display:none;}
p, div {
 font-family: Arial, Helvetica, Sans Serif;
 font-size: 12px;
 font-weight: normal;
}
#new{  clear: both;
  position:absolute;
  z-index:1000;
  
 
 
  }
 
	
#selections{      background-image: url(images/info.jpg);
    background-repeat: no-repeat;
    border: 1px solid;
    border-radius: 3px;
    box-shadow: 1px 1px 29px -8px;
    clear: both;
    font-size: 13px;
    height: 419px !important;
    background-color: fff;
    line-height: 20px;
    left: -320px;
    margin-top: 11px;
    opacity: 1;
    padding-left: 13;
    padding-top: 24px;
    position: absolute;
    right: 0;
    text-align: left;
    top: 0 !important;
    width: 288px !important;
    z-index: 1000;
}
  .header{
	  height:70px;
	  background:#999;
	  border:1px soled #000;
	  top:0;
	  
	  
	  }
	  select{ height:40px; width:180px;}
	  .btn1{
		  height:20px; width:20px;
		  margin:13px 25px 0px;
		  background: none;
  border: none;
  visibility:0;
		  }
		   .btn2{
			   background: none;
  border: none;
		  height:20px; width:20px;
		    margin: -3px 11px 0px;
  float: left;
		  }
		   .btn3{
			   background: none;
  border: none;
		  height:20px; width:20px;
		    float: left;
  margin: -3px 0px 0px;
		  }
		   .btn4{
			   background: none;
  border: none;
		  height:20px; width:20px;
		  margin: 0px 23px -1px;
		  }
		   .btn5{
			   background: none;
  border: none;
		  height:20px; width:20px;
		  margin:21px 24px 69px;
		  }
		   .btn6{
			   background: none;
  border: none;
		  height:20px; width:20px;
		  margin:100px 24px 2px;
		  }
		  
</style>


<script type="text/javascript">  
       
function notalloted(){
	document.querySelector("#selections").style.display = "none";	
	image = $('img');
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            
            areas: [

{key : "notalloted", selected : true,
	fillColor: "FF0404",
	strokeColor: "FF0404"

},
    
                ]
				
        });
    


	}
	function Reserved(){
	document.querySelector("#selections").style.display = "none";	
	image = $('img');
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            
            areas: [

{key : "reserved", selected : true,
	fillColor: "FF0404",
	strokeColor: "FF0404"

},
    
                ]
				
        });
    


	}
function Res(){
	document.querySelector("#selections").style.display = "none";	
	image = $('img');
	   image.mapster(
       {
       		fillOpacity: 0.9,
       		fillColor: "fff568",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
           
            areas: [
  

   {key : "yellow", selected : true,
	fillColor: "fff568",
	strokeColor: "3320FF"

},      
                ]
				
        });
   
	  


	}
function Com(){
		document.querySelector("#selections").style.display = "none";	
	image = $('img');
	   image.mapster(
       {
       		fillOpacity: 0.9,
       		fillColor: "1803fe",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
           
            areas: [
  

   {key : "blue", selected : true,
	fillColor: "1803fe",
	strokeColor: "3320FF"

},      
                ]
				
        });
   
	  


	}
function Villas(){
	document.querySelector("#selections").style.display = "none";	
	image = $('img');
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "d42e16",
       		strokeColor: "3320FF",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            
            areas: [

{key : "Villas", selected : true,
	fillColor: "FF0404",
	strokeColor: "FF0404"

},
    
                ]
				
        });
    


	}
function alloted(){
	document.querySelector("#selections").style.display = "none";	
	image = $('img');
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "Green",
       		strokeColor: "Green",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            areas: [
  

   {key : "alloted", selected : true,
	fillColor: "red",
	strokeColor: "32FF00"

},      
                ]
				
        });
   
	  


	}
    </script>
    <?php
    $db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
    $con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

//    $con=mysqli_connect("localhost","rdlpk_admin","creative123admin","rdlpk_db1");
	//$con=mysqli_connect("localhost","root","","rdlpkr");
$sql1="SELECT * FROM size_cat ";			
$result1 = mysqli_query($con,$sql1); 	
while($row1 = mysqli_fetch_array($result1))
  {?>
 <script>  function hello<?php echo $row1['id']; ?>(){
	
	image = $('img');
	   image.mapster(
       {
       		fillOpacity: 0.4,
       		fillColor: "Green",
       		strokeColor: "Green",
       		strokeOpacity: 0,
       		strokeWidth: 4,
       		stroke: true,
            isSelectable: true,
			singleSelect: true,
            mapKey: 'name',
            listKey: 'name',
            areas: [
  

   {key : "SI<?php echo $row1['id'];?>", selected : true,
	fillColor: "red",
	strokeColor: "32FF00"

},      
                ]
				
        });
   
	  


	}</script>
	<?php
  }
	?>