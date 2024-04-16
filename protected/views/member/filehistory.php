<div class="container-fluid" style="font-size:12px; background:#FFF;">
<h3>File Information</h3>

<?php	
            $res=array();
            foreach($pages as $key){
            echo '<ul><li> File No:'.$key['file_detail_address'].'</li><li>Street No:'.$key['street'].'</li><li>Project Name:'.$key['project_name'].'</li><li>Project Name:'.$key['file_size'].'</li><li> Create Date:'.$key['create_date'].'</li></ul>
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
                        <th width="4%">Name</th>
                        <th width="5%">SO/DO/WO</th>
                        <th width="5%">CNIC</th>
                        <th width="10%">Address</th>
                        </tr>
                </thead>
<?php	
            $res=array();
            foreach($history as $key){
            echo 
			'

                <tbody>
                <tr><td width="1%">'.$key['transferfrom_id'].'</td><td>'.$key['transfer_date'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['address'].'</td></tr>';
            }?>
                </tbody>
            </table>
           
           
           
           
           <!-- <h3>Payment History</h3>
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                    
                        <th width="2%">Installment No</th>
                        <th width="11%">Amount</th>
                        <th width="2%">Payment Mode</th>
                        <th width="11%">Detail</th>
                        <th width="4%">Date</th>
                        <th width="5%">Status</th>
                        
                     </tr>
                   </thead>     
                     <tbody>    -->
                     <?php /*?> <?php
					  
$i = 0;
foreach ($num_of_installments as $key){						
    do{
$i++; 
echo "
  <tr>
  <td>";
	echo "Installment No ".$i."</td>
	<td>Rs-12000/-</td>
	<td>PO</td>
	<td>plot installment</td>
	<td>15-2-2-14</td>
	<td>Paid</td>
	</tr>
  ";



$key['installment'] --;}

while($key['installment']>0) ?><?php */?>                    
                      
                        
                    
                 
              
                   
          <?php /*?>      </tbody>
            </table>
            
            
             
            
<?php 

	}
		
?>
            
            </div><?php */?>