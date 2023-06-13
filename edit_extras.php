<?php
require_once 'connect.php';

$id = $_POST['extras_id'];
$extras = $_POST['extras'];
$price = $_POST['price'];

$sql = "UPDATE extras SET extras = '".$extras."', price = '".$price."' WHERE extras_id = '".$id."'";

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

	<a class="text-decoration-none link-secondary mb-3" href="admin_extras.php">Back</a>
	<span class="d-flex justify-content-center fw-bold mb-3">Edit</span>

	<form action="" method="POST">
		<?php echo '<input hidden name="extras_id" value="'.$id.'"/>  '; ?>
		
		<?php echo '<input value="'.$extras.'" type="text" class="form-control mb-3" placeholder="extras" name="extras"/>';  ?> 
		
		<?php echo '<input value="'.$price.'" type="number" class="form-control mb-3" min="0" step="0.01" placeholder="price" name="price"/>';  ?> 

		<div class="col d-flex justify-content-end">
			<button class="btn btn-outline-secondary" type='submit'> Save </button>
		</div>
	</form>
  </div>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>