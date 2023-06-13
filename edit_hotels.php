<?php
require_once 'connect.php';

$id = $_POST['hotels_id'];
$hotels_id = $_POST['hotels_id'];
$travel_from = $_POST['travel_from'];
$travel_to = $_POST['travel_to'];
$departure_date_nepakeista = $_POST['departure_date'];
$return_date_nepakeista = $_POST['return_date'];
$departure_date = explode(" ",$departure_date_nepakeista)[0];
$return_date = explode(" ",$return_date_nepakeista)[0];
$stars = $_POST['stars'];
$board = $_POST['board'];
$location = $_POST['location'];
$theme = $_POST['theme'];
$price = $_POST['price'];
$description = $_POST['description'];

$sql = "UPDATE hotels SET hotels_id = '".$hotels_id."', travel_to = '".$travel_to."', departure_date = '".$departure_date."', return_date = '".$return_date."', stars = '".$stars."' ,board = '".$board."',location ='".$location."',theme ='".$theme."',price ='".$price."' ,description = '".$description."'
WHERE hotels_id = '".$id."'";

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

	<a class="text-decoration-none link-secondary mb-3" href="admin_hotels.php">Back</a>
	<span class="d-flex justify-content-center fw-bold mb-3">Edit Hotel: </span>

	<form action="" method="POST">
		<?php echo '<input hidden name="hotels_id" value="'.$id.'"/>  '; ?>
		
		<?php echo '<input value="'.$hotels_id.'" type="text" class="form-control mb-3" placeholder="hotels_id" name="hotels_id"/>';  ?> 
		
		<?php echo '<input value="'.$travel_to.'" type="text" class="form-control mb-3" placeholder="Kryptis į" name="travel_to"/>'; ?>
		
		<?php echo '<input value="'.$departure_date.'" type="date" class="form-control mb-3" placeholder="departure_date" name="departure_date"/>'; ?>
		
		<?php echo '<input value="'.$return_date.'" type="date" class="form-control mb-3" placeholder="Išvykimo_data" name="return_date"/>'; ?>
		
		<?php echo '<input value="'.$stars.'" type="number" class="form-control mb-3" placeholder="Žvaigždutės" min="1" max="5" name="stars"/>'; ?>
		
		<?php echo '<input value="'.$board.'" type="text" class="form-control mb-3" placeholder="board" name="board"/>'; ?>
		
		<?php echo '<input value="'.$location.'" type="text" class="form-control mb-3" placeholder="Viešbučio location" name="location"/>'; ?>
		
		<?php echo '<input value="'.$theme.'" type="text" class="form-control mb-3" placeholder="Viešbučio theme" name="theme"/>'; ?>
		
		<?php echo '<input value="'.$price.'" type="number" class="form-control mb-3" placeholder="price" min="0" step="0.01" name="price"/>'; ?>
		
		<?php echo '<textarea type="text" wrap="hard" cols="20" rows="5" class="form-control mb-3 ivedimoDydis" placeholder="Aprašymas" name="description"> '.$description.'</textarea>'; ?>

		<div class="col d-flex justify-content-end">
			<button class="btn btn-outline-secondary" type='submit'> Save </button>
		</div>
	</form>
  </div>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>