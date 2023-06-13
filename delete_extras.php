<?php
require_once 'connect.php';

$extras_id = $_GET['extras_id'];

$sql = "SELECT * FROM extras WHERE extras_id = '".$extras_id."'";
$ats = $conn->query($sql);
$rez = $ats->fetch_assoc();

if(($_SESSION['tipas']) == 'admin'){
	
	$sql2 = "DELETE FROM extras WHERE extras_id = '".$extras_id."'";
	$conn->query($sql2);
	header("location: admin_extras.php");
	}
else{
	header("location: index.php");
}
	
$conn->close();
?>