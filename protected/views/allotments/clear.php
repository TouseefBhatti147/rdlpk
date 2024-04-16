<?php 
require_once('db.php'); 
$plotsize = $_POST['plot_size'];
$sql = "delete from member_plot where plot_size='".$plot_size."'";
mysql_query($sql);

?>

