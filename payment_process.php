<?php
require_once 'connect.php';

$flights_id = $_POST['flights_id'];
$hotels_id = $_POST['hotels_id'];

$extras_masyvas = $_SESSION['extras'];



if(isset($_SESSION['user_id'])){
	$sql = "INSERT INTO orders (flights_id, hotels_id, user_id, extras) VALUES ('".$flights_id."','".$hotels_id."','".$_SESSION['user_id']."','".$extas_masyvas."')";
	$conn->query($sql);
	header("location: user.php");
}
else{
	echo '
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>-- Dive In Exploring -- completed</title>

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href="styles.css" rel="stylesheet">
	
		</head>
	<body>
	<main class="container border border-3 rounded mt-3 col-md-4 col-10">

		<div class="col-auto d-flex justify-content-center mt-3 pb-3">
			<span>Booking completed</span>
		</div>
		<div class="col-auto d-flex justify-content-center mt-3 pb-3">
			<a href="index.php" class="btn btn-secondary">Go Back</a>
		</div>
			
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	</body>
	</html>
	';
}

$conn->close();
?>
