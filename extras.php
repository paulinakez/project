<?php
require_once 'connect.php';

$flights_id = $_POST['flights_id'];
$hotels_id = $_POST['hotels_id'];
$passengers = $_POST['passengers'];

$sql = "SELECT * FROM extras";
$extras = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Extras</title>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">
	
  </head>
  <body>
    
<div class="container mt-3">    
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
					  echo "<a class='btn btn-outline-primary' href='prisijungimas.php'>Prisijungti</a>";}
					else{
					  echo "<a href='user.php' class='text-decoration-none link-secondary'>Narys</a>";}
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
			EXTRAS
			</h1>
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
													<!-- extras -->
<div class="container border border-3 rounded mt-3 col-md-4 col-10">
		<h4 class="row fst-italic d-flex justify-content-center pt-3">Extras List:</h4>
		<span class="row fst-italic d-flex justify-content-center pb-3" style="font-size:11px"> Press Continue</span>
		<form action="chosen_trip.php" method="post">
			
			<?php	
				echo'
				<input type="hidden" name="flights_id" value="'.$flights_id.'">
				<input type="hidden" name="hotels_id" value="'.$hotels_id.'">
				<input type="hidden" name="passengers" value="'.$passengers.'">';
				if($extras->num_rows > 0){
					while ($row = $extras->fetch_assoc()) {
						echo'
					
						<div class="row">
							<div class="col d-inline float-start">
								<label class="form-check-label" for="flexCheckDefault ">'.$row['title'].'</label>

							</div>
							<div class="col d-inline float-end" >
								<input class="form-check-input float-end ms-3" value="'.$row['extras_id'].'" name="extras[]" type="checkbox" id="flexCheckDefault">
								<label class="form-check-label float-end" for="flexCheckDefault">Price: '.$row['price']*$passengers.'€ / '.$passengers.'pp.</label>
							</div>
						</div>
						';
					}
				}		

			?>	
			<div class="col-auto d-flex justify-content-center pt-3 pb-3">
				<button class="btn btn-secondary" type="submit">Buy</button>
			</div>
		
		</form>
		
		
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