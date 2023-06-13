<?php
require_once 'connect.php';

$travel_from = $_POST['travel_from'];
$travel_to = $_POST['travel_to'];
$company = $_POST['company'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];
$departure_price = $_POST['departure_price'];
$return_price = $_POST['return_price'];
$final_price = $departure_price + $return_price;
$image = $_POST['files'];

 $sql = "INSERT INTO flights (travel_from, travel_to, company, departure_date, return_date, departure_price, return_price, final_price)
VALUES ('$travel_from','$travel_to', '$company', '$departure_date','$return_date','$departure_price','$return_price','$final_price')";


if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
}

//images
$targetDir = "./uploads/"; 
$target_filename = basename($_FILES["files"]["name"]);

$target_file = $targetDir.$target_filename ;

if(isset($_FILES['files'])){ 
    
    if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
        $sql = "UPDATE flights SET image_url = '$target_filename' WHERE flights_id = $last_id";
       
        $insert = $conn->query($sql); 
    } else {

    }
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

	<a class="text-decoration-none link-secondary mb-3" href="Admin_skrydziai.php">Back</a>
	<span class="d-flex justify-content-center fw-bold mb-3">Add Flights</span>

	<form action="" method="POST" enctype="multipart/form-data">
		
		<input type="text" class="form-control mb-3" placeholder="Travel From" name="travel_from"/>
		
		<input type="text" class="form-control mb-3" placeholder="Travel To" name="travel_to"/>
		
		<input type="text" class="form-control mb-3" placeholder="Company" name="company"/>
		
		<input type="datetime-local" class="form-control mb-3" placeholder="Departure date" name="departure_date"/>
		
		<input type="datetime-local" class="form-control mb-3" placeholder="Return date" name="return_date"/>
		
		<input type="number" step="0.01" class="form-control mb-3" placeholder="Departure Price" min="0" name="departure_price"/>

		<input type="number" step="0.01" class="form-control mb-3" placeholder="Return Price" min="0" name="return_price"/>
       
		<input type="file"  class="form-control mb-3" placeholder="Images" id="files" name="files">
		
		<div class="col d-flex justify-content-end">
			<button class="btn btn-outline-secondary" type='submit'> Add </button>
		</div>
	</form>
  </div>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>