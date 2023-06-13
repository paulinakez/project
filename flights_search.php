<?php
require_once 'connect.php';


$travel_to = $_POST['travel_to'];
$passengers = $_POST['passengers'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];  


    $sql = "SELECT * FROM flights WHERE travel_to = '$travel_to' ORDER BY departure_date ASC"; //parinkti visus tomis kryptimis
	$flights = $conn->query($sql);
	$flights_copy = $conn->query($sql);
    

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Flights </title>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">
    <script>

window.onload = function() {		//  https://canvasjs.com/jquery-charts/json-data-api-ajax-chart/

var dataPoints = [];
CanvasJS.addColorSet("color",
                [
                "#9EC8F2 ",
                ]);
var options =  {
	animationEnabled: true,
    colorSet: "color",
	axisX: {
		valueFormatString: "DD MM YYYY",
	},
	axisY: {
		title: "Price",
		titleFontSize: 12
	},
	data: [{
		type: "column", 
		yValueFormatString: "#,###.##€",
		dataPoints: dataPoints
	}]
};

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			x: new Date(data[i].date),
			y: data[i].units
		});
	}
	$("#chartContainer").CanvasJSChart(options);

}
var data = []
<?php


if($flights_copy->num_rows > 0){
    while ($row = $flights_copy->fetch_assoc()) {
        $date = new DateTime($row['departure_date']);
        $timestamp = $date->getTimestamp();
        
        echo "data.push(
            {'date': ".$timestamp."000, 'units': ".$row['final_price']."});";
    }
}

?>


addData(data)

}
</script>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  </head>
  <body>

<div class="container mt-3" style="padding:0px">     
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-4 fst-italic text-center text-sm-center text-md-center text-lg-start">
			<a href="" class="text-decoration-none text-dark"><h3>Dive In Exploring </h3></a>
		</div>
		
		<div class="col-12 col-sm-12 col-md-12 col-lg-8 d-flex justify-content-end">
			<div class="row d-flex justify-content-end" style="width:100%">
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 align-self-center d-flex justify-content-center">
					<a class="" href="mailto:info@diveinexploring.com">info@diveinexploring.com</a>
				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 d-flex justify-content-center">
				  <?php
				  if(!isset($_SESSION['vartid'])){
					  echo "<a class='btn btn-outline-primary' href='login.php'>LOGIN</a>";}
					else{
					  echo "<a href='user.php' class='text-decoration-none link-secondary'>Narys</a>";}
				  ?>
				</div>
				
			</div>
		</div>
	</div>
</div>
<style>
        body {
            background-image: url('images/fonas.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
</style>

		<div class="col text-white fst-italic d-flex justify-content-center">
			<h1>
			-- Flights --
			</h1>
		</div>
	</div>
	
	<div class="container bg-transparent mt-3">  <!-- search  -->
		
		<div class="row">
			<div class="col text-white fst-italic d-flex justify-content-center mb-3 mt-3">
				<h5>Search Your Holiday</h5>
			</div>
		</div>
		
		<form  action="" method="post">
		
			<div class="row justify-content-center">
			
				
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3">
					<select name="travel_to" class="form-select">
						<?php
						 $sql = "SELECT DISTINCT travel_to FROM flights";
						
						 $rez = $conn->query($sql);
					  
						 if($rez->num_rows > 0){
							while ($row = $rez->fetch_assoc()) {
								if( $travel_to!= $row['travel_to']){
									echo "<option value=".$row['travel_to'].">".$row['travel_to']."</option>";
								}
								else{
									echo "<option selected value=".$row['travel_to'].">".$row['travel_to']."</option>";

								}
							}
						}
						?>
					</select>
				</div>
				
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3">
					<select name="passengers" class="form-select">
							<?php
							  
							  try {
								for ($x = 1; $x <= 10; $x++) {
									if($x != $passengers){
										
										echo "<option value=".$x.">".$x."</option>";
									}
									else{
										echo "<option selected value=".$x.">".$x."</option>";

									}
								 }
							} catch (Exception $e) {
								echo 'Caught exception: ',  $e->getMessage(), "\n";
							}

							?>
					</select>
				</div>
				
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 d-flex justify-content-center">
					<button class="btn btn-primary" type="submit">Search</button>
				</div>
			</div>
		</form>
	</div>
</div>
									<!-- Diagrama -->

<div class="container bg-secondary mt-3 pb-3">
	<span class="d-flex justify-content-center">Flight Prices</span>
    <div id="chartContainer" style="height: 200px; width: 100%;"></div>
</div>

									<!--flights -->
<?php 
 
	if($flights->num_rows > 0){
		while ($row = $flights->fetch_assoc()) {
	
			echo '
			<form action="hotels_search.php" method="POST">
			
				<div class="container d-flex px-0 justify-content-center mt-3">
						<input type="hidden" name="flights_id" value="'.$row['flights_id'].'">
						<input type="hidden" name="travel_to" value="'.$row['travel_to'].'">
						<input type="hidden" name="passengers" value="'.$passengers.'">
						<input type="hidden" name="departure_date" value="'.$row['departure_date'].'">
						<input type="hidden" name="return_date" value="'.$row['return_date'].'">

						<div class="card mb-3 col-12 p-0">
						  <div class="row g-0">
							<div class="col-md-2">
							  <img src="/uploads/'.$row["image_url"].'" class="img-fluid rounded-start" alt="...">
							</div>
							<div class="col-md-4">
							  <div class="card-body">
								<h5 class="card-title">Destination: '.$row['travel_from'].'  - '.$row['travel_to'].'</h5>
								<p class="card-text">'.$row['company'].'</p>
								<p class="card-text">'.$row['departure_date'].'</p>
							  </div>
							</div>
							<div class="col-md-4">
							  <div class="card-body">
							  <h5 class="card-title">Destination: '.$row['travel_to'].' - '.$row['travel_from'].'</h5>
								<p class="card-text">'.$row['company'].'</p>
								<p class="card-text">'.$row['return_date'].'</p>
							  </div>
							</div>
							<div class="col-md-2">
							  <div class="card-body fixPaddings">
								<p class="card-text">Flights Final Price: '.number_format(($row['final_price'] * $passengers), 2, ',', ' ').' £ / '.$passengers.'pp. </p>
								<button class="btn btn-secondary" type="submit">Buy</button>
							  </div>
							</div>
						  </div>
						</div>
						
					
				</div>
			</form>
			';
		}
	}
	else{
		echo'
		<div class="row mt-3">
			<span class="text-center text-danger"> There is no available flights to your chosen destination</span>
		</div>
		';
	}
?>
									
	<button onclick="topFunction()" id="myBtn" title="Go Back">▲</button> 
	
	<script>
		//Get the button:
		mybutton = document.getElementById("myBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
		  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			mybutton.style.display = "block";
		  } else {
			mybutton.style.display = "none";
		  }
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
		  document.body.scrollTop = 0; // For Safari
		  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
		} 
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	
  </body>
</html>