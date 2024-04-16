

<html ng-app="myApp" ng-app lang="en">


<div ng-controller="customersCrtl">

<br/>

<br/>
    <div class="row">
        <div class="col-md-2">PageSize:
            <select ng-model="entryLimit" class="form-control">
                <option>5</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-md-3">Filter:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
        </div>
        <div class="col-md-4">
            <h5>Filtered {{ filtered.length }} of {{ totalItems}} total customers</h5>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12" ng-show="filteredItems > 0">
            <table class="table table-striped table-bordered">
            <thead>
            <th>Customer Name&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Address&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>City&nbsp;<a ng-click="sort_by('city');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>State&nbsp;<a ng-click="sort_by('state');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Postal Code&nbsp;<a ng-click="sort_by('postalCode');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Country&nbsp;<a ng-click="sort_by('country');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Credit Limit&nbsp;<a ng-click="sort_by('creditLimit');"><i class="glyphicon glyphicon-sort"></i></a></th>
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{data.name}}</td>
                    <td>{{data.name}}</td>
                    <td>{{data.name}}</td>
                    <td>{{data.name}}</td>
                    <td>{{data.cnic}}</td>
                    <td>{{data.cnic}}</td>
                    <td>{{data.id}}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No customers found</h4>
            </div>
        </div>
        <div class="col-md-12" ng-show="filteredItems > 0">    
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
            
            
        </div>
    </div>

</div>
   
<script src="http://localhost/hb - Copy/js/asd/js/angular.min.js"></script>
<script src="http://localhost/hb - Copy/js/asd/js/ui-bootstrap-tpls-0.10.0.min.js"></script>
<script src="http://localhost/hb - Copy/js/asd/app/app.js"></script>       
</html>







<?php 
$num_rec_per_page=10;
mysql_connect('localhost','root','');
mysql_select_db('schs_db');
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $num_rec_per_page; 
$sql = "SELECT * FROM members LIMIT $start_from, $num_rec_per_page"; 
$rs_result = mysql_query ($sql); //run the query
?> 
<table>
<tr><td>Name</td><td>Phone</td></tr>
<?php 
while ($row = mysql_fetch_assoc($rs_result)) { 
?> 
            <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['id']; ?></td>            
            </tr>
<?php 
}; 
?> 
</table>
<?php 
$sql = "SELECT * FROM members"; 
$rs_result = mysql_query($sql); //run the query
$total_records = mysql_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 

echo "<a href='pagination.php?page=1'>".'|<'."</a> "; // Goto 1st page  

for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?page=".$i."'>".$i."</a> "; 
}; 
echo "<a href='?page=$total_pages'>".'>|'."</a> "; // Goto last page
?>