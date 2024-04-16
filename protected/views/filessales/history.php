<h3>Owner</h3>
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                        <th width="2%">#</th>
                        
                        <th width="11%">Date/Time</th>
                        
                        <th>Name</th>
                        
                        <th>S/o W/o D/o</th>
                        
                        <th>CNIC</th>
                        
                        <th width="4%">Plot</th>
                        
                        <th width="5%">Plot Size</th>
                        
                        <th width="5%">Street</th>
                        
                        <th width="10%">Project</th>
                        
                        <th width="5%">Action</th>
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                    <?php	
            $res=array();
            foreach($pages as $key){
            echo '<tr><td width="1%">'.$key['member_id'].'</td><td>'.$key['create_date'].'</td></tr>'; 
            }?>
                </tbody>
            </table>

<h3>History</h3>
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                        <th width="2%">#</th>
                        
                        <th width="11%">Date/Time</th>
                        
                        <th>Name</th>
                        
                        <th>S/o W/o D/o</th>
                        
                        <th>CNIC</th>
                        
                        <th width="4%">Plot</th>
                        
                        <th width="5%">Plot Size</th>
                        
                        <th width="5%">Street</th>
                        
                        <th width="10%">Project</th>
                        
                        <th width="5%">Action</th>
                        
                    
                    </tr>
                </thead>
                
                <tbody>
                    <?php	
            $res=array();
            foreach($projects as $key){
            echo '<tr><td width="1%">'.$key['transferto_id'].'</td><td>'.$key['transferfrom_id'].'</td><td>'.$key['status'].'</td><td>'.$key['cmnt'].'</td><td>'.$key['transfer_date'].'</td></tr>'; 
            }?>
                </tbody>
            </table>