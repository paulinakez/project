<?php
require_once 'connect.php';

$sql = "SELECT * FROM flights";
                    
$flights = $conn->query($sql);

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

	<div class="row mb-3">	
	
		<ul class="nav nav-tabs justify-content-center">
		  <li class="nav-item">
			<a class="nav-link active" aria-current="page">Flights</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="admin_hotels.php">Hotels</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="admin_extras.php">Extras</a>
		  </li>

		</ul>
	</div>	
		
	<span class="d-flex justify-content-center fw-bold">Flight Offers</span>
	<div class="d-flex justify-content-center mb-3 mt-3">
		<form action='add_flights.php'>

			<button class="btn btn-secondary" type='submit'>Add a new one</button>
		</form>
	</div>
														<!-- flights -->
	<div class="d-flex justify-content-center mb-3 mt-3">
		<?php

		if($flights->num_rows > 0){
			echo '
			<table>
			<tr>
				<th>Travel From </th>
				<th>Travel To</th>
				<th>Company</th> 
				<th>Departure date</th>
				<th>Return Date</th>
				<th>Departure Price</th>
				<th>Return Price</th>
				<th>Final Price</th>
				<th>Extras</th>
			</tr>
		  ';
			while ($row = $flights->fetch_assoc()) {
		 
				echo "  <tr>
				
				<td>".$row['travel_from']."</td>
				<td>".$row['travel_to']."</td>
				<td>".$row['company']."</td>
				<td>".$row['departure_date']."</td>
				<td>".$row['return_date']."</td>
				<td>".$row['departure_price']."</td>
				<td>".$row['return_price']."</td>
				<td>".$row['final_price']."</td>
				<td> 
					<form action='edit_flights.php' method='post'> 
						<input hidden name='travel_from' value='".$row['travel_from']."'/>
						<input hidden name='travel_to' value='".$row['travel_to']."'/>
						<input hidden name='company' value='".$row['company']."'/>
						<input hidden name='departure_date' value='".$row['departure_date']."'/>
						<input hidden name='return_date' value='".$row['return_date']."'/>
						<input hidden name='departure_price' value='".$row['departure_price']."'/>
						<input hidden name='return_price' value='".$row['return_price']."'/>
						<input hidden name='final_price' value='".$row['final_price']."'/>

					
						<input hidden name='flights_id' value='".$row['fights_id']."'/> 
						<button class='btn btn-primary' type='submit'>Edit </button> 
					</form>
					</br> 
					<form action='delete_flights.php'> 
						<input hidden name='fights_id' value='".$row['fights_id']."'/> 
						<button class='btn btn-danger' type='submit'>Delete</button> 
					</form>
				</td>
		
			  </tr>";
			}
		 }
		 echo '</table>';
		?>	
	</div>
</div>
								
                       
	<button onclick="topFunction()" id="myBtn" title="Go Back">▲</button> 
	<script>
		mybutton = document.getElementById("myBtn");

		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
		  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			mybutton.style.display = "block";
		  } else {
			mybutton.style.display = "none";
		  }
		}

		function topFunction() {
		  document.body.scrollTop = 0; // For Safari
		  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
		} 
	</script>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>