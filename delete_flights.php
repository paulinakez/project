<?php
require_once 'connect.php';

$flights_id = $_GET['flights_id'];

$sql = "SELECT * FROM flights WHERE flights_id = '".$flights_id."'";
$ats = $conn->query($sql);
$rez = $ats->fetch_assoc();

if(($_SESSION['tipas']) == 'admin'){
	
	$sql2 = "DELETE FROM flights WHERE flights_id = '".$flights_id."'";
	$conn->query($sql2);
	header("location: admin_flights.php");
	}
else{
	header("location: index.php");
}
	
$conn->close();
?>