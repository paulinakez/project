<?php
require_once 'connect.php';

$id = $_POST['flights_id'];
$travel_from = $_POST['travel_from'];
$travel_to = $_POST['travel_to'];
$company = $_POST['company'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];
$final_price = $_POST['final_price'];


$sql = "UPDATE flights SET travel_from = '".$travel_from."', travel_to = '".$travel_to."', departure_date = '".$departure_date."', return_date = '".$return_date."', departure_date = '".$departure_date."', return_date = '".$return_date."', final_price = '".$final_price."'
WHERE flights_id = '".$id."'";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">
	
  </head>
  <body>
  
  <div class="container border rounded mt-3">

	<a class="text-decoration-none link-secondary mb-3" href="admin_flights.php">Back</a>
	<span class="d-flex justify-content-center fw-bold mb-3">Edit Flights</span>

	<form action="" method="POST">
		<?php echo '<input hidden name="flights_id" value="'.$id.'"/>  '; ?>
				
		<?php echo '<input value="'.$travel_from.'" type="text" class="form-control mb-3" placeholder="Kryptis iš" name="travel_from"/>';  ?> 
		
		<?php echo '<input value="'.$travel_to.'" type="text" class="form-control mb-3" placeholder="Kryptis į" name="travel_to"/>'; ?>
		
		<?php echo '<input value="'.$company.'" type="text" class="form-control mb-3" placeholder="company" name="company"/>';  ?> 
		
		<?php echo '<input value="'.$departure_date.'" type="datetime-local" class="form-control mb-3" placeholder="Išvykimo data" name="departure_date"/>'; ?>
		
		<?php echo '<input value="'.$return_date.'" type="datetime-local" class="form-control mb-3" placeholder="Grįžimo data" name="return_date"/>'; ?>
		
		<?php echo '<input value="'.$departure_date.'" type="number" min="0" step="0.01" class="form-control mb-3" placeholder="Išvykimo kaina" name="departure_date"/>'; ?>
		
		<?php echo '<input value="'.$return_date.'" type="number" min="0" step="0.01" class="form-control mb-3" placeholder="Grįžimo kaina" name="return_date"/>'; ?>

		<?php echo '<input value="'.$final_price.'" type="number" min="0" step="0.01" class="form-control mb-3" placeholder="Galutinė kaina" name="final_price"/>'; ?>
		
		<div class="col d-flex justify-content-end">
			<button class="btn btn-outline-secondary" type='submit'> Save </button>
		</div>
	</form>
  </div>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>