<h3>Add Top Menu</h3>
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">

<style>td { height:30px; padding:7px 0px 0px 17px;}</style>		

  <div class="">
        <table class="table table-striped table-new table-bordered">
        <thead style="background:#666; border-color:#ccc; color:#fff;">
            <th width="3%">#Sr</th>
            <th width="4%">Active/Deactive</th>
            <th width="4%">Navigation Level</th>
            <th width="8%">Content Type</th>
            <th width="8%">Menu Name</th>
            <th width="8%">Update</th>           
        </thead>
        <tbody>
			
             <?php	
			 
			 if (!isset($_GET['page_num'])){
				 
				 $_GET['page_num']=1;
				 }
            $res=array();
			$count = 0;
			//$input_count = 1;
            foreach($pages as $key)
			{
				?>
				<input type="hidden" name="count" value="<?php echo $count = $count +1; ?>" />
				<?php
				if ($key['status']==0){
					?>
                    <!-- <input type="hidden" name="status" value="0" /> -->
                    <?php
					$checkbox_status = "";
					}
				elseif($key['status']==1) {
					?>
					<!-- <input type="hidden" name="status" value="1" /> -->
					<?php
                    $checkbox_status = "checked";
					}
				echo '<form action="add_member_menu?page_num='.$_GET['page_num'].'" method="post"><tr>
				<td>'.$key['id'].'</td>
				<td><input type="checkbox" name="status" value="'.$key['status'].'"'.$checkbox_status.'  /></td>
				<td><input style="width: 50px; height: 15px;" type="text" name="sub_level" value="'.$key['sub_level'].'" /></td>
				<td>'.$key['content_type'].'</td>
				<td><input type="text" name="menu_title" style="width: 200px; height: 15px;" value="'.$key['menu_title'].'" /></td>
				<td><input type="submit" name="update_submit" value="Update" /><input type="submit" name="delete_submit" value="Delete" /></td>
				</tr>
				<input type="hidden" name="menu_id" value="'.$key['id'].'" />
				<input type="hidden" name="page_id" value="1" />
				</form>'; 
				 
				
			}
			
			?>
            <form action="add_member_menu?page_num=<?php echo $_GET['page_num'] ?>" method="post">
            <tr>
				<td></td>
				<td><input type="checkbox" name="status" /></td>
				<td><input style="width: 50px;" type="text" name="sub_level" value="" /></td>
				<td>
                <select style="width: 200px;" name="content_type">
				<?php 
				
				foreach($pages1 as $key)
				{
				echo '<option value="'.$key['id'].'">'.$key['content_type'].'</option>';  
				}
			?>
  				</select>
                </td>
				<td><input type="text" name="menu_title" style="width: 250px;" value="" /></td>
                <td><input type="submit" name="insert_submit" value="Add New Menu Item" /></td>
				
                </tr>
				<input type="hidden" name="menu_id" value="" />
				<input type="hidden" name="page_id" value="1" />
            
            </form>
		
        </tbody>
  	</table>
    
  </div>
 
 
 <div id="pages" style="background-color:#FFF; width:800px; height:70px;">
 
  <?php 
 
  foreach($num_of_rows as $key)
{
	$total = $key['total'];
} 
	
	
   $num_of_pages = $total/10;
   
   $temp_dec = floor($num_of_pages);
   $temp_point = $num_of_pages - $temp_dec;

if ($temp_point>0)
{
	$num_of_pages = $temp_dec + 1;
}
else
{
	$num_of_pages = $temp_dec;
}   
   

if ($num_of_pages==1){
	
	}
else
{



$i = 1;
$j = 0;
 while ($j<$num_of_pages){
 	
	if (isset($_GET['page_num'])){
		if ($_GET['page_num']==$i){
		
		echo '<a href="'.Yii::app()->baseUrl.'/index.php/user/add_member_menu?page_num='.$i.'" style="color:red;">Page '.$i.'</a>  |  ';
		}
		else 
		{
			echo '<a href="'.Yii::app()->baseUrl.'/index.php/user/add_member_menu?page_num='.$i.'">Page '.$i.'</a>  |  ';
		}
	}
	else 
	{
		
		echo '<a href="'.Yii::app()->baseUrl.'/index.php/user/add_member_menu?page_num='.$i.'">Page '.$i.'</a>  |  ';
		
	}

		
 $i++;
 $j ++;

 }
}
?> 
 </div>

 
 </section>
<!-- section 3 --> 
