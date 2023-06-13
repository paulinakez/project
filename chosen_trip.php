<?php
require_once 'connect.php';

$flights_id = $_POST['flights_id'];
$hotels_id = $_POST['hotels_id'];
$extras_id = $_POST['extras'];

$passengers = $_POST['passengers'];

$sql = "SELECT * FROM flights WHERE flights_id = '$flights_id '";
$rez = $conn->query($sql);
$flight = $rez->fetch_assoc();

$sql1 = "SELECT * FROM hotels WHERE hotels_id = '$hotels_id '";
$rez1 = $conn->query($sql1);
$hotels = $rez1->fetch_assoc();


if(!empty($_POST['extras'])){

		$sql2 = "SELECT * FROM extras WHERE ";
		$i = 0;
        foreach ($_POST['extras'] as &$value) {
			$value = "'".$value."'";
			$sql2 = $sql2."extrasid = ".$value;
			if($i+1 != count($_POST['extras'])){
				$sql2 = $sql2." OR ";
			}
			$i++;
        }
    $extras = $conn->query($sql2);

    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Trip Itinerary </title>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">
	
  </head>
  <body>
    
<div class="container mt-3">     <!-- Meniu juosta -->
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-4 fst-italic text-center text-sm-center text-md-center text-lg-start">
			<a href="" class="text-decoration-none text-dark"><h3>-- Dive In Exploring --</h3></a>
		</div>
		
		<div class="col-12 col-sm-12 col-md-12 col-lg-8 d-flex justify-content-end">
			<div class="row d-flex justify-content-end" style="width:100%">
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 align-self-center d-flex justify-content-center">
					<a class="" href="mailto:info@diveinexploring.com">info@diveinexploring.com</a>
				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 d-flex justify-content-center">
				  <?php
				  if(!isset($_SESSION['user_id'])){
					  echo "<a class='btn btn-outline-primary' href='prisijungimas.php'>LOGIN</a>";}
					else{
					  echo "<a href='nario_paskyra.php' class='text-decoration-none link-secondary'>Narys</a>";}
				  ?>
				</div>
				
			</div>
		</div>
	</div>
</div>

															<!-- Pasirinkta kelione -->
<div class="container border border-3 rounded mt-3 mb-3">
	<h4 class="row d-flex justify-content-center fst-italic pt-3">Chosen Trip</h4>
	<div class="row border rounded mt-3 mb-3 me-3 ms-3">
		<span class="fw-bold">Chosen Flight</span>
		<?php
		echo'
		<div class="row ">
			<span class="col">'.$flights['travel_from'].' - '.$flights['travel_to'].'</span>
			<span class="col">'.$flights['departure_date'].' - '.$flights['return_date'].'</span>
			<span class="col text-end"> Flights Price: '.$flights['final_price']*$passengers.'€ /'.$passengers.'pp.</span>
		</div>
		';
		$final_flights_price = $flights['flights']*$passengers;
		?>
	</div>
	<div class="row border rounded mt-3 mb-3 me-3 ms-3">
		<span class="fw-bold">Chosen Hotels: </span>
		<?php
		echo'
		<div class="row ">
			<span class="col">'.$hotels['hotel_name'].'</span>
			<span class="col">'.$hotels['stars'].'⭐</span>
			<span class="col">'.$hotels['board'].'</span>
			<span class="col text-end">Hotels: '.$hotels['price']*$passengers.'€ /'.$passengers.'pp.</span>
		</div>
		';
		$final_hotel_price = $hotels['price']*$passengers;
		?>
	</div>	
	<div class="row border rounded mt-3 mb-3 me-3 ms-3">
		<span class="fw-bold">Chosen extras: </span>
		<?php
		$final_all_price = 0;
		if($extras->num_rows > 0){
			while ($row = $extras->fetch_assoc()) {
				$final_all_price += $row['price']*$passengers;
				
				echo'
				<div class="row ">
					<span class="col">'.$row['hotel_name'].'</span>
					<span class="col text-end">extras price: '.$row['price']*$passengers.'€ /'.$passengers.'pp.</span>
					
				</div>
				';
			}
		}
		
		?>
	</div>
	<div class="row text-end mt-3 mb-3 me-3 ms-3">
		<?php
		echo'
		<div class="row ">
			<span class=" col fw-bold"> Final Price: '.$final_flights_price+$final_hotel_price+$final_all_price.'€ /'.$passengers.'asm.</span>
			 
		</div>
		';
		?>
	</div>
</div>
															
<div class="container border border-3 rounded mt-3 mb-3">
	<h4 class="row d-flex justify-content-center fst-italic pt-3"> Booking Info: </h4>
	<span class="row d-flex justify-content-center fst-italic">Fill it out the require information: </span>
	<form action="payment.php" method="post">
		<?php
			
			if($passengers >= 1){
                foreach ($_POST['extras'] as &$value) {
					echo '<input type="hidden" name="extras[]" value="'.$value.'">';

                }
				echo'
					<input type="hidden" name="flights_id" value="'.$flights_id.'">
					<input type="hidden" name="hotels_id" value="'.$hotels_id.'">
					<input type="hidden" name="passengers" value="'.$passengers.'">
					
					<span class=" col fw-bold">1 Passenger </span>
					<div class="row g-2 pt-3 pb-3">
					  <div class="col-md">
						<div class="form-floating">
						  <input required type="text" class="form-control" id="floatingInputGrid" name="passenger_details" placeholder="" value="'.$_SESSION['vardas'].'">
						  <label for="floatingInputGrid">Name</label>
						</div>
					  </div>
					  <div class="col-md">
						<div class="form-floating">
						  <input required type="text" class="form-control" id="floatingInputGrid" placeholder="" value="'.$_SESSION['surname'].'">
						  <label for="floatingInputGrid">Surname</label>
						</div>
					  </div>
					</div>
					
					<div class="row g-2 pt-3 pb-3">
					  <div class="col-md">
						<div class="form-floating">
						  <input required type="email" class="form-control" id="floatingInputGrid" placeholder="" value="'.$_SESSION['email'].'">
						  <label for="floatingInputGrid">Email: </label>
						</div>
					  </div>
					  <div class="col-md">
						<div class="form-floating">
						  <input required type="number" min="0" class="form-control" id="floatingInputGrid" placeholder="">
						  <label for="floatingInputGrid"> Phone number: </label>
						</div>
					  </div>
					</div>
					
					<div class="row g-2 pt-3 pb-3">
					  <div class="col-md">
						<div class="form-floating">
							<input required type="date" class="form-control" id="floatingInputGrid" placeholder="" value="'.$_SESSION['birth_date'].'">
							<label for="floatingInputGrid"> Date of birth</label>
						</div>
					  </div>
					  <div class="col-md">
						<div class="form-floating">
						  <input required type="text" class="form-control" id="floatingInputGrid" placeholder="">
						  <label for="floatingInputGrid">Nationality</label>
						</div>
					  </div>
					</div>
					
					<div class="row g-2 pt-3 pb-3">
					  <div class="col-md">
						<div class="form-floating">
						  <input required type="number" min="0" class="form-control" id="floatingInputGrid" placeholder="">
						  <label for="floatingInputGrid">Passport Number</label>
						</div>
					  </div>
					  <div class="col-md">
						<div class="form-floating">
						  <input required type="date" class="form-control" id="floatingInputGrid" placeholder="">
						  <label for="floatingInputGrid">Passport issue date </label>
						</div>
					  </div>
					</div>
				';
				
				for ($x = 2; $x <= $passengers; $x++) {
					
					echo'
					
					<span class=" col fw-bold">'.$x.' passenger</span>
						<div class="row g-2 pt-3 pb-3">
						  <div class="col-md">
							<div class="form-floating">
							  <input required type="text" class="form-control" name="name[]" id="floatingInputGrid" placeholder="">
							  <label for="floatingInputGrid">Name</label>
							</div>
						  </div>
						  <div class="col-md">
							<div class="form-floating">
							  <input required type="text" class="form-control" id="floatingInputGrid" placeholder="">
							  <label for="floatingInputGrid">Surname</label>
							</div>
						  </div>
						</div>
						
						<div class="row g-2 pt-3 pb-3">
						  <div class="col-md">
							<div class="form-floating">
							  <input required type="email" class="form-control" id="floatingInputGrid" placeholder="">
							  <label for="floatingInputGrid">Email address</label>
							</div>
						  </div>
						  <div class="col-md">
							<div class="form-floating">
							  <input required type="number" min="0" class="form-control" id="floatingInputGrid" placeholder="">
							  <label for="floatingInputGrid">Phone number</label>
							</div>
						  </div>
						</div>
						
						<div class="row g-2 pt-3 pb-3">
						  <div class="col-md">
							<div class="form-floating">
								<input required type="date" class="form-control" id="floatingInputGrid" placeholder="">
								<label for="floatingInputGrid">Date of Birth</label>
							</div>
						  </div>
						  <div class="col-md">
							<div class="form-floating">
							  <input required type="text" class="form-control" id="floatingInputGrid" placeholder="">
							  <label for="floatingInputGrid">Nationality</label>
							</div>
						  </div>
						</div>
						
						<div class="row g-2 pt-3 pb-3">
						  <div class="col-md">
							<div class="form-floating">
							  <input required type="number" min="0" class="form-control" id="floatingInputGrid" placeholder="">
							  <label for="floatingInputGrid">Passport Number</label>
							</div>
						  </div>
						  <div class="col-md">
							<div class="form-floating">
							  <input required type="date" class="form-control" id="floatingInputGrid" placeholder="">
							  <label for="floatingInputGrid">Passport issue date</label>
							</div>
						  </div>
						</div>
						';
				}
			}

		?>

		
		<div class="col-auto d-flex justify-content-end pb-3">
			<button class="btn btn-secondary" type="submit">Payment Page</button>
		</div>
	</form>
</div>

								<!-- Mygtukas i virsu -->

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
