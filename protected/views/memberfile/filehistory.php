<h3>File Information</h3>
<table class="table table-striped table-new table-bordered" style="width:40%;">
<tbody>
<?php	
            $res=array();
            foreach($pages as $key){
            echo '<tr><td> File Address:</td><td>'.$key['file_detail_address'].'</td></tr><tr><td>Street No:</td><td>'.$key['street'].'</td></tr><tr><td>Project Name</td><td>'.$key['project_name'].'</td></tr><tr><td> Create Date:</td><td>'.$key['create_date'].'</td></tr>
</tbody>
</table>			
			
<h3>Owner</h3>
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                          <th width="2%">#</th>
                        
                        <th width="11%">Date/Time</th>
                        
                        
                        
                        <th width="4%">Name</th>
                        
                        <th width="5%">SO/DO/WO</th>
                        
                        <th width="5%">CNIC</th>
                        
                        <th width="10%">Address</th>
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                    	
            
             <tr><td width="1%">'.$key['member_id'].'</td><td>'.$key['create_date'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['address'].'</td></tr>';
            }?>
                </tbody>
            </table>
            <h3>History</h3>
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                        <th width="2%">#</th>
                        
                        <th width="11%">Date/Time</th>
                        
                        
                        
                        <th width="4%">File</th>
                        
                        <th width="5%">File Size</th>
                        
                        <th width="5%">Street</th>
                        
                        <th width="10%">Project</th>
                        
                      
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                   
                </tbody>
            </table>
            <h3>Payment History</h3>
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                        <th width="2%">Status</th>
                        
                        <th width="11%">Date/Time</th>
                        
                        
                        
                        <th width="4%">Payment Type</th>
                        
                        <th width="5%">Amount</th>
                        
                        <th width="5%">Balance</th>
                        
                        <th width="10%">Advance</th>
                        
                      
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                   
                </tbody>
            </table>