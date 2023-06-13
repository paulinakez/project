<?php
require_once 'connect.php';

$hotel_name = $_POST['hotel_name'];
$travel_to = $_POST['travel_to'];
$departure_date_nepakeista = $_POST['departure_date'];
$return_date_nepakeista = $_POST['return_date'];
$departure_date = explode(" ",$departure_date_nepakeista)[0];
$return_date = explode(" ",$return_date_nepakeista)[0];
$stars = $_POST['stars'];
$board = $_POST['board'];
$location= $_POST['location'];
$theme= $_POST['theme'];
$price = $_POST['price'];
$description = $_POST['description'];
$images = $_POST['files'];
 

	$sql = "INSERT INTO hotels (hotel_name, travel_to, departure_date, return_date, stars, board, location , theme, price, description)
VALUES ('$hotel_name','$travel_to','$departure_date','$return_date','$stars','$board','$location','$theme','$price','$description')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
} 

///images
if(isset($_FILES['files'])) 
   
    $Failu_aplankalas = "./uploads/"; 
    $duomenu_tipai = array('.jpg','.png','.jpeg','.gif'); 
     
    $klaidos = $pranesimas = $reiksmiu_sql = $ikelimo_klaida = $tipo_klaida = ''; 
    $failu_pavadinimai = array_filter($_FILES['files']['name']); 
	
    if(!empty($failu_pavadinimai)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // failo ikelimo kelias
            $failo_pavadinimas = basename($_FILES['files']['name'][$key]); 
            $failo_kelias = $Failu_aplankalas . $failo_pavadinimas; 
             
            // failo tipo atitikimas
            $failo_tipas = pathinfo($failo_kelias, PATHINFO_EXTENSION); 
            if(in_array($failo_tipas, $duomenu_tipai)){ 
                // issaugoti faila aplankale
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $failo_kelias)){ 
				
                    // papildyti reiksmiu sql viesbucio id ir failo pavadinimu
                    $reiksmiu_sql .= "(  $last_id,'".$failo_pavadinimas."'),"; 
                    
                }else{ 
                    $ikelimo_klaida .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $tipo_klaida .= $_FILES['files']['name'][$key].' | '; 
            } 
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

	<a class="text-decoration-none link-secondary mb-3" href=admin_hotels.php">Back</a>
	<span class="d-flex justify-content-center fw-bold mb-3">Add Hotels</span>

	<form action="" method="POST" enctype="multipart/form-data">
	
		
		<input type="text" class="form-control mb-3" placeholder="Hotel name" name="hotel_name"/>
		
		<input type="text" class="form-control mb-3" placeholder="Travel From" name="travel_from"/>
		
		<input type="date" class="form-control mb-3" placeholder="Departure Date" name="departure_date"/>
		
		<input type="date" class="form-control mb-3" placeholder="Return Date" name="return_date"/>
		
		<input type="number" class="form-control mb-3" placeholder="Stars" min="1" max="5" name="stars"/>
		
		<input type="text" class="form-control mb-3" placeholder="Board" name="board"/>
		
		<input type="text" class="form-control mb-3" placeholder="Hotel Location" name="location"/>
		
		<input type="text" class="form-control mb-3" placeholder="Hotel Theme" name="theme"/>
		
		<input type="number" step="0.01" class="form-control mb-3" placeholder="Price" min="0" name="price"/>
		
		<input type="text" class="form-control mb-3 inpt-lg" placeholder="Description" name="description"/>
		
        <input type="file"  class="form-control mb-3" placeholder="Images" name="files[]" multiple>

		<div class="col d-flex justify-content-end">
			<button class="btn btn-outline-secondary" type='submit'> Add </button>
		</div>
	</form>
  </div>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>