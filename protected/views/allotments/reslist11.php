
<div class="">
<div class="shadow">
  <h3>Result List</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">

<div id="id="printableArea">
<table class="table table-striped table-new table-bordered" id="printableArea">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="4%">S.No.</th>
                        <th width="4%">App. No.</th>
                        <th width="8%">App. Name</th>
                        <th width="8%">CNIC</th>
                        <th width="7%">Plot No.</th>
                        <th width="11%">Project Name</th>
                        <th width="7%">Street No.</th>
                        <th width="7%">Sector No.</th>
                        <th width="7%">Allotment</th>
                        
                        
                        </tr>
                </thead>
                <tbody>
                
		<?php foreach($list as $row8)	
			 {echo '<tr><td>'.$row8['id'].'</td><td>'.$row8['app_no'].'</td><td>'.$row8['member_name'].'</td><td>'.$row8['CNIC'].'</td><td>'.$row8['plot_detail_address'].'</td><td>'.$row8['project_name'].'</td><td>'.$row8['street'].'</td><td>'.$row8['sector'].'</td><td>'.$row8['status'].'</td>
			</tr>'; 
            }?>
                    
                </tbody>
            </table>
            
            
            <input type="button" onclick="printDiv('printableArea')" value="Print Draw Result>>>" />

</div>

<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
