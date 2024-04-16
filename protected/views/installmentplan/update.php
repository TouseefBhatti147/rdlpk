<div class="shadow">
  <h3>Update Installment Plan</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>
  <?php	
            $res=array();
            foreach($pla as $key){	
?>
  <div class="float-left">

    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">   
  <select name="project_id" id="project">
   <option value="<?php echo $key['project_id']; ?>"><?php echo $key['project_name']; ?></option>
 			 
            <?php $res=array();

            foreach($projects as $key1){
				

            echo '
			
			
			<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>'; 

            }?>

  </select>

    </p>

  </div>
   <div class="float-left">

    <p class="reg-left-text">Size<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
    
  <select name="category_id" id="category_id">
   <option value="<?php echo $key['category_id']; ?>"><?php echo $key['size']; ?></option>
 			 
			 
			

            <?php $res=array();

            foreach($size as $key2){
				

            echo '
			
			
			<option value="'.$key2['id'].'">'.$key2['size'].'</option>'; 

            }?>

  </select>

    </p>

  </div>
     <div class="float-left">
    <p class="reg-left-text">Property Type <font color="#FF0000">*</font></p>
    <select name="p_type" id="p_type">
      <option value="<?php echo $key['p_type']?>"><?php if($key['p_type']=='R') echo 'Residential' ; elseif ($key['p_type']=='C'){ echo'Commercial';}?></option>
      <option value="R">Residential</option>
      <option value="C">Commercial</option>
    </select>

    </div>
 <div class="float-left">
    <p class="reg-left-text">Plan Description.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['description'];?>" name="description" id="description" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">

    <p class="reg-left-text">Total No. <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php echo $key['tno'];?>" name="tno" id="tno" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Total Amount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="tamount"  type="text" value="<?php echo $key['tamount'];?>" class="new-input" id="tamount">
    </p>

  </div><div class="clearfix"></div>
    <div class="float-left">

    <p class="reg-right-field-area margin-left-5">

1.      <input type="text" value="<?php echo $key['lab1']; ?>" name="lab1" id="lab1" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="<?php echo $key['1']; ?>" name="1"  placeholder="Amount" id="1" class="reg-login-text-field" />
    </p>
  </div>
<div class="clearfix"></div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
2.      <input type="text" value="<?php echo $key['lab2']; ?>" name="lab2" id="lab2" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="<?php echo $key['2']; ?>" name="2" id="2"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
3. <input type="text" value="<?php echo $key['lab3']; ?>" name="lab3" id="lab3" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['3']; ?>" name="3" id="3"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
4.      <input type="text" value="<?php echo $key['lab4']; ?>" name="lab4" id="lab4" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="<?php echo $key['4']; ?>" name="4" id="4"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
5.      <input type="text" value="<?php echo $key['lab5']; ?>" name="lab5" id="lab5" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="<?php echo $key['5']; ?>" name="5" id="5"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
6.      <input type="text" value="<?php echo $key['lab6']; ?>" name="lab6" id="lab6" placeholder="Label" class="reg-login-text-field" />
      <input type="text" value="<?php echo $key['6']; ?>" name="6" id="6" placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
7. <input type="text" value="<?php echo $key['lab7']; ?>" name="lab7" id="lab7" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['7']; ?>" name="7" id="7"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
    <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
8. <input type="text" value="<?php echo $key['lab8']; ?>" name="lab8" id="lab8" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['8']; ?>" name="8" id="8"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
<div class="float-left">
    <p class="reg-right-field-area margin-left-5">
9. <input type="text" value="<?php echo $key['lab9']; ?>" name="lab9" id="lab9" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['9']; ?>" name="9" id="9"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
10. <input type="text" value="<?php echo $key['lab10']; ?>" name="lab10" id="lab10" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['10']; ?>" name="10" id="10"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
11. <input type="text" value="<?php echo $key['lab11']; ?>" name="lab11" id="lab11" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['11']; ?>" name="11" id="11"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
12. <input type="text" value="<?php echo $key['lab12']; ?>" name="lab12" id="lab12" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['12']; ?>" name="12" id="12"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
13. <input type="text" value="<?php echo $key['lab13']; ?>" name="lab13" id="lab13" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['13']; ?>" name="13" id="13"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
14. <input type="text" value="<?php echo $key['lab14']; ?>" name="lab14" id="lab14" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['14']; ?>" name="14" id="14"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
15. <input type="text" value="<?php echo $key['lab15']; ?>" name="lab15" id="lab15" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['15']; ?>" name="15" id="15"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
16. <input type="text" value="<?php echo $key['lab16']; ?>" name="lab16" id="lab16" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['16']; ?>" name="16" id="16"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
17. <input type="text" value="<?php echo $key['lab17']; ?>" name="lab17" id="lab17" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['17']; ?>" name="17" id="17"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
18. <input type="text" value="<?php echo $key['lab18']; ?>" name="lab18" id="lab18" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['18']; ?>" name="18" id="18"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
19. <input type="text" value="<?php echo $key['lab19']; ?>" name="lab19" id="lab19" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['19']; ?>" name="19" id="19"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
20. <input type="text" value="<?php echo $key['lab20']; ?>" name="lab20" id="lab20" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['20']; ?>" name="20" id="20"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
21. <input type="text" value="<?php echo $key['lab21']; ?>" name="lab21" id="lab21" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['21']; ?>" name="21" id="21"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
22. <input type="text" value="<?php echo $key['lab22']; ?>" name="lab22" id="lab22" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['22']; ?>" name="22" id="22"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
23. <input type="text" value="<?php echo $key['lab23']; ?>" name="lab23" id="lab23" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['23']; ?>" name="23" id="23"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
24. <input type="text" value="<?php echo $key['lab24']; ?>" name="lab24" id="lab24" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['24']; ?>" name="24" id="24"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
25. <input type="text" value="<?php echo $key['lab25']; ?>" name="lab25" id="lab25" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['25']; ?>" name="25" id="25"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
26. <input type="text" value="<?php echo $key['lab26']; ?>" name="lab26" id="lab26" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['26']; ?>" name="26" id="26"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
27. <input type="text" value="<?php echo $key['lab27']; ?>" name="lab27" id="lab27" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['27']; ?>" name="27" id="27"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
28. <input type="text" value="<?php echo $key['lab28']; ?>" name="lab28" id="lab28" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['28']; ?>" name="28" id="28"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
29. <input type="text" value="<?php echo $key['lab29']; ?>" name="lab29" id="lab29" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['29']; ?>" name="29" id="29"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
30. <input type="text" value="<?php echo $key['lab30']; ?>" name="lab30" id="lab30" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['30']; ?>" name="30" id="30"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
31. <input type="text" value="<?php echo $key['lab31']; ?>" name="lab31" id="lab31" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['31']; ?>" name="31" id="31"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
32. <input type="text" value="<?php echo $key['lab32']; ?>" name="lab32" id="lab32" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['32']; ?>" name="32" id="32"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
33. <input type="text" value="<?php echo $key['lab33']; ?>" name="lab33" id="lab33" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['33']; ?>" name="33" id="33"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
34. <input type="text" value="<?php echo $key['lab34']; ?>" name="lab34" id="lab34" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['34']; ?>" name="34" id="34"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
35. <input type="text" value="<?php echo $key['lab35']; ?>" name="lab35" id="lab35" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['35']; ?>" name="35" id="35"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
36. <input type="text" value="<?php echo $key['lab36']; ?>" name="lab36" id="lab36" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['36']; ?>" name="36" id="36"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
37. <input type="text" value="<?php echo $key['lab37']; ?>" name="lab37" id="lab37" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['37']; ?>" name="37" id="37"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
38. <input type="text" value="<?php echo $key['lab38']; ?>" name="lab38" id="lab38" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['38']; ?>" name="38" id="38"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
39. <input type="text" value="<?php echo $key['lab39']; ?>" name="lab39" id="lab39" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['39']; ?>" name="39" id="39"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
40. <input type="text" value="<?php echo $key['lab40']; ?>" name="lab40" id="lab40" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['40']; ?>" name="40" id="40"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
41. <input type="text" value="<?php echo $key['lab41']; ?>" name="lab41" id="lab41" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['41']; ?>" name="41" id="41"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
42. <input type="text" value="<?php echo $key['lab42']; ?>" name="lab42" id="lab42" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['42']; ?>" name="42" id="42"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
43. <input type="text" value="<?php echo $key['lab43']; ?>" name="lab43" id="lab43" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['43']; ?>" name="43" id="43"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
44. <input type="text" value="<?php echo $key['lab44']; ?>" name="lab44" id="lab44" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['44']; ?>" name="44" id="44"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
45. <input type="text" value="<?php echo $key['lab45']; ?>" name="lab45" id="lab45" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['45']; ?>" name="45" id="45"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
46. <input type="text" value="<?php echo $key['lab46']; ?>" name="lab46" id="lab46" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['46']; ?>" name="46" id="46"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
47. <input type="text" value="<?php echo $key['lab47']; ?>" name="lab47" id="lab47" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['47']; ?>" name="47" id="47"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
48. <input type="text" value="<?php echo $key['lab48']; ?>" name="lab48" id="lab48" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['48']; ?>" name="48" id="48"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
49. <input type="text" value="<?php echo $key['lab49']; ?>" name="lab49" id="lab49" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['49']; ?>" name="49" id="49"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
50. <input type="text" value="<?php echo $key['lab50']; ?>" name="lab50" id="lab50" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['50']; ?>" name="50" id="50"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
51. <input type="text" value="<?php echo $key['lab51']; ?>" name="lab51" id="lab51" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['51']; ?>" name="51" id="51"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
52. <input type="text" value="<?php echo $key['lab52']; ?>" name="lab52" id="lab52" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['52']; ?>" name="52" id="52"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
53. <input type="text" value="<?php echo $key['lab53']; ?>" name="lab53" id="lab53" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['53']; ?>" name="53" id="53"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
54. <input type="text" value="<?php echo $key['lab54']; ?>" name="lab54" id="lab54" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['54']; ?>" name="54" id="54"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
55. <input type="text" value="<?php echo $key['lab55']; ?>" name="lab55" id="lab55" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['55']; ?>" name="55" id="55"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
56. <input type="text" value="<?php echo $key['lab56']; ?>" name="lab56" id="lab56" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['56']; ?>" name="56" id="56"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
57. <input type="text" value="<?php echo $key['lab57']; ?>" name="lab57" id="lab57" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['57']; ?>" name="57" id="57"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
58. <input type="text" value="<?php echo $key['lab58']; ?>" name="lab58" id="lab58" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['58']; ?>" name="58" id="58"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
59. <input type="text" value="<?php echo $key['lab59']; ?>" name="lab59" id="lab59" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['59']; ?>" name="59" id="59"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
60. <input type="text" value="<?php echo $key['lab60']; ?>" name="lab60" id="lab60" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['60']; ?>" name="60" id="60"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
61. <input type="text" value="<?php echo $key['lab61']; ?>" name="lab61" id="lab61" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['61']; ?>" name="61" id="61"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div><div class="float-left">
    <p class="reg-right-field-area margin-left-5">
62. <input type="text" value="<?php echo $key['lab62']; ?>" name="lab62" id="lab62" placeholder="Label" class="reg-login-text-field" />
   <input type="text" value="<?php echo $key['62']; ?>" name="62" id="62"  placeholder="Amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
<input type="hidden" id="ide" name="ide" value="'<?php echo $key['id']; ?>'"/>
</div>
<?php
	 }?>

  

 

   	

	
 <?php echo CHtml::ajaxSubmitButton(

                                'Update',

    array('planupdate'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#submit").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){ });

                                             $("#submit").attr("disabled",false);

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

                         array("id"=>"login","class" => "btn-info pull-right")      

                ); ?>

  <?php $this->endWidget(); ?>			

	

 

 </section>

<!-- section 3 --> 

