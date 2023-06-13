</html><?php
require_once 'connect.php';

$hotels__id = $_GET['hotels_id'];

$sql = "SELECT * FROM hotels WHERE hotels_id = '".$hotels__id."'";
$ats = $conn->query($sql);
$rez = $ats->fetch_assoc();

if(($_SESSION['tipas']) == 'admin'){
	
	$sql2 = "DELETE FROM hotels WHERE hotels_id = '".$hotels__id."'";
	$conn->query($sql2);
	header("location: admin_hotels.php");
	}
else{
	header("location: index.php");
}
	
$conn->close();
?>