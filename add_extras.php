<?php
require_once 'connect.php';

$title = $_POST['title'];
$price = $_POST['price'];

$sql = "INSERT INTO extras (title, price) VALUES ('$title','$price')";

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

	<a class="text-decoration-none link-secondary mb-3" href="Admin_paslaugos.php">BACK</a>
	<span class="d-flex justify-content-center fw-bold mb-3">ADD</span>

	<form action="" method="POST">
	
		<input type="text" class="form-control mb-3" placeholder="title" name="title"/>
		
		<input type="number" step="0.01" class="form-control mb-3" placeholder="price" min="0" name="price"/>
		
		<div class="col d-flex justify-content-end">
			<button class="btn btn-outline-secondary" type='submit'> ADD </button>
		</div>
	</form>
  </div>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>