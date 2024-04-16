<div class="shadow">
  <h3>Plots</h3>
</div>
<style>

.float-left {
    float: left;
    height: 80px;
    margin: 2px 3px;
    width: 274px;
}
select{ width:255px;}
input, textarea, .uneditable-input {
width: 244px;
}
</style>
<!-- shadow -->
<div style="float:right;">Total Plots =<?php echo $total; ?><br />Total Reserve Plots =<?php echo $totalr;?></div>
<hr noshade="noshade" class="hr-5">
<?php foreach($plot as $list1)
			{?>
<section class="login-section margin-top-30" style="height:120px;">

<!--<form name="login-form" method="post" action="">-->

  <b>Project:</b><?php echo $list1['project_name']; ?><br />
  <b>Description::</b><?php echo $list1['desc1']; ?><br />
  <b>Status::</b><?php echo $list1['status']; ?><br />
 
  
  <?php 
  if($list1['status']=='Open'){?>
            
<a href="addplots?bid=<?php echo $_REQUEST['bid']; ?>&pid=<?php echo $_REQUEST['pid']; ?>&size=<?php echo $_REQUEST['size']; ?>" class="btn btn-success">Add Plots</a><?php }
  ?>
</section>
<?php }?>
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var bid=<?php echo $_REQUEST['bid']; ?>;
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/allotments/searchreqnew",
                  type:"POST",
                data:"actionfunction=showData&page=1&bid="+bid,
        cache: false,
        success: function(response){
		   
		  $('#error-div').html(response);
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"http://<?php echo $address ?>/index.php/allotments/searchreqnew",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
          data:$("#user_login_form").serialize()+"&&page="+$page,
		cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>


<section class="login-section margin-top-30">



<!--<form name="login-form" method="post" action="">-->
<?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'user_login_form',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',

                'clientOptions'=>array(

                     'validateOnSubmit'=>true,

                     'validateOnChange'=>true,

                     'validateOnType'=>false,

  ),

)); ?>









<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<input type="hidden" name="bid" value="<?php echo $_REQUEST['bid']?>" />
    <span>Project:</span>

    	<select name="project" id="project" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 


            <span>Size:</span>
    <select name="size" id="size"  style="width:180px;"><?php 
			if(!empty($size)){echo '<option value="'.$size.'">'.$size.'</option>'; }else{
				echo '<option value="">Select Size</option>';
				}
			$res=array();
            foreach($sizes as $siz){
            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 
            }?></select> 
             <span>Status:</span>
             <select name="status11" id="status11">
             <option value="Open">Open</option>
             <option value="reserved">Reserved</option>
             
             </select>
			 
<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Enter Plot No" />

	 <?php 



	




	$res=array();



	$i = 1;



	foreach($categories as $key1)
	{
	echo'<div class="">
    <input style="float:left; margin-right:10px; margin-left:10px;"   id="cat[]" name="cat[]" type="checkbox"	value="'.$key1['id'].'" />
	<label for="checkbox" style="float:left;">'.$key1['name'].'</label>
	</div>';
	$i++;
	}
	?>

 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('/allotments/searchreqnew/?page=1'),
                                array(  

                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});

                                             $("#login").attr("disabled",false);

                                        }',

                   'success'=>'function(data){  

                                           //  var obj = jQuery.parseJSON(data); 

                                            // View login errors!

        

                                             if(data == 1){

												// alert("we are here");

                                         location.href = "http://rdlpk.com/index.php/user/dashboard";

                                      }

          else{

                                                $("#error-div").show();

                                                $("#error-div").html(data);$("#error-div").append("");

												return false;

                                             }

 

                                        }' 

    ),

                         array("id"=>"login","class" => "btn btn-info")      

                ); ?>

  



<!--  </form>-->

<?php $this->endWidget(); ?>



</section>

</div>

<!-- section 3 --> 









 

  



  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />

    -->





  </form>

<div class="clearfix"></div>

  <div class="">



            

            



            <table class="table table-striped table-new table-bordered">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">



                    <tr>
						
                      

                        <th width="8%">Project</th>

                       

                        <th width="4%">Plot No</th>

                        <th width="5%">Plot Size</th>

                        <th width="5%">Dimension</th>

                         <th width="4%">Street</th>

                        <th width="4%">Sector</th>

                    	 <th width="5%">B.Status</th> 
                        
				<th width="7%">Action</th>

                        </tr>



                </thead>



                <tbody id="error-div">



              



                    



                </tbody>



            </table>



 			



  	



  </div>

<hr noshade="noshade" class="hr-5 float-left">



  



  



 



 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

 

 <script>

 

 

 



  $(document).ready(function()



     {  	



		



       $("#project").change(function()



           {



         	select_street($(this).val());



		   });



		   



		  



     });



 



 



function select_street(id)



{



$.ajax({




      type: "POST",



      url:    "ajaxRequest?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



var listItems='';

	listItems+="<option value=''>Select Street</option>";



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";



      







});listItems+="";







$("#street_id").html(listItems);



          }



    });



}



</script>
<!-- section 3 --> 