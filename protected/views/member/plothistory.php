<div class="container-fluid" style="font-size:12px; background:#FFF;">

<h3>Plot Information</h3>



<?php	

            $res=array();
			$co=1;
            foreach($pages as $key){

            echo '<strong><ul>
				<li>Plot Size:'.$key['size'].'('.$key['plot_size'].')</li>
			<li> Plot Address:'.$key['plot_detail_address'].'</li>
			<li>Street/Lane:'.$key['street'].'</li>
			<li>Project Name:'.$key['project_name'].'</li>
		
			<li> Create Date:'.$key['create_date'].'</li></ul></strong>
			

<h3>Owner</h3>

<table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                    

                          <th width="2%">S No.</th>

                        

                        

                        

                        

                        

                        <th width="8%">Name</th>

                        

                        <th width="5%">Father/Spouse</th>

                        

                        <th width="5%">CNIC</th>

                        

                        <th width="10%">Address</th>
                         <th width="3%">Date/Time</th>
                        

                    

                    </tr>

                </thead>

                

                <tbody>

                    	

            

             <tr><td width="1%">'.$co.'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['address'].'</td><td>'.$key['create_date'].'</td></tr>';
$co++;
            }?>

                </tbody>

            </table>

            <h3>History</h3>

            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                          <th width="2%">S No.</th>

                     
                        <th width="4%">Name</th>

                        <th width="5%">SO/DO/WO</th>

                        <th width="5%">CNIC</th>

                        <th width="10%">Address</th>
 						  <th width="11%">Transfer Date</th>

                        </tr>

                </thead>

<?php	
$co1=1;
            $res=array();

            foreach($history as $key){

            echo 

			'



                <tbody>

                <tr><td width="1%">'.$co1.'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['address'].'</td><td>'.$key['transfer_date'].'</td></tr>';
$co1++;
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

     </div>