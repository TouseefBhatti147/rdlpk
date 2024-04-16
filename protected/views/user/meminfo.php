<h3>Personal Information</h3>
<table class="table table-striped table-new table-bordered" style="width:40%;">
<tbody>
<?php	
            $res=array();
            foreach($member as $key){
            echo '<tr><td>Name:</td><td>'.$key['name'].'</td></tr><tr><td> User Name:</td><td>'.$key['username'].'</td></tr><tr><td>SODOWO:</td><td>'.$key['sodowo'].'</td></tr><tr><td>CNIC:</td><td>'.$key['cnic'].'</td></tr><tr><td>Address</td><td>'.$key['address'].'</td></tr><tr><td>Email:</td><td>'.$key['email'].'</td></tr><tr><td>Phone No.:</td><td>'.$key['phone'].'</td></tr><tr><td>Create Date:</td><td>'.$key['create_date'].'</td></tr>
			<tr><td><strong>Login Name/Username:</strong></td><td><strong style="color:#FF0000">'.$key['username'].'</strong></td></tr>
			<tr><td><strong>Password:</strong></td><td><strong style="color:#060">'.$key['password'].'</strong></td></tr>
			'; 
            }?></tbody></table>

