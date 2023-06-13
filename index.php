<?php
require_once 'connect.php';
 
$sql = "SELECT * FROM flights GROUP BY travel_to ORDER BY flights_id DESC LIMIT 3 ";

$flights = $conn->query($sql);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Dive In Exploring </title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">

  </head>
  <body>

<style>
        body {
            background-image: url('images/fonass.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
</style>

<div class="container mt-3">     
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-4 fst-italic text-center text-sm-center text-md-center text-lg-start">
			<h3>Dive In Exploring</h3>
		</div>
		

		<div class="col-12 col-sm-12 col-md-12 col-lg-8 d-flex justify-content-end">
			<div class="row d-flex justify-content-end" style="width:100%">
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 align-self-center d-flex justify-content-center">
					<a class="" href="mailto:info@diveinexploring.com">info@diveinexploring.com</a>
				</div>
				
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 d-flex justify-content-center">
				  <?php
				  if(!isset($_SESSION['user_id'])){
					  echo "<a class='btn btn-outline-primary' href='login.php'>LOGIN</a>";}
					else{
					  echo "<a href='user.php' class='text-decoration-none link-secondary'>user</a>";}
				  ?>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="container-fluid fonas mt-2 pb-5 pt-5"> 
	<div class="row pt-3 pb-3">
		<div class="col text-white fst-italic d-flex justify-content-center">
			<h1>
			Dive In Exploring
			</h1>
		</div>
	</div>
        
	<div class="container bg-transparent mt-3 pb-4 pt-4">  
		<div class="row">
			<div class="col text-white fst-italic d-flex justify-content-center mb-3 mt-3">
				<h5>Search Your Holiday</h5>
			</div>
		</div>
        <form  action="flights_search.php" method="post">

			<div class="row justify-content-center">

			  
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3">
					<select required name="travel_to" class="form-select" aria-label="Default select example">
						
						<option  value="" disabled selected hidden>Flights To</option>
				  
						<?php
						 
						 $sql = "SELECT DISTINCT travel_to FROM flights";
						
						 $rez = $conn->query($sql);
					  
						 if($rez->num_rows > 0){
							while ($row = $rez->fetch_assoc()) {
						 
								echo "<option value=".$row['travel_to'].">".$row['travel_to']."</option>";
							}
						}
						?>   
				   
					</select>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3">
					<select required name="passengers"  class="form-select" aria-label="Default select example">
						
						<option value="" disabled selected hidden>Passengers</option>

						   <?php
							  
							  try {
								for ($x = 1; $x <= 10; $x++) {
									echo "<option value=".$x.">".$x."</option>";

								 }
							} catch (Exception $e) {
								echo 'Caught exception: ',  $e->getMessage(), "\n";
							}

							?>

			
					</select>
				</div>
				
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 d-flex justify-content-center">
					<button  class="btn btn-primary" type="submit" >Search</button>
				</div>
		   
			</div>
		</form>
	</div>
</div>


<div class="container mt-3">   <!--new -->
	<div class="row">
		<div class="col fst-italic">
			<h5>Newest Destinations ✈️</h5>
		</div>
	</div>
	
	<div class="row mb-3">

        <?php
         if($flights->num_rows > 0){
            while ($row = $flights->fetch_assoc()) {
              
                echo '
				<div class="krptis d-flex justify-content-center centrasParent col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<img src="/uploads/'.$row["image_url"].'" class="img-fluid" alt="...">
					<form action = "flights_search.php" method="POST">
						<input hidden value= "'.$row["travel_to"].'" name="travel_to"/>
						<input hidden value="1" name="passengers"/>
						<a class="btn btn-secondary centruoti" href="flights_search.php">'.$row["travel_to"].'</a>
					</form>
				</div>';
            }
        }
        
        ?>

	</div>

</div>
								
                       
	<button onclick="topFunction()" id="myBtn" title="Go Up">▲</button> 
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