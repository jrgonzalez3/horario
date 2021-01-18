<?php 
function get_row($table,$row, $id, $equal){
	global $con;
	$query=mysqli_query($con,"SELECT $row FROM $table WHERE $id='$equal'");
	$rw=mysqli_fetch_array($query);
	$value=$rw[$row];
	return $value;
}
?>