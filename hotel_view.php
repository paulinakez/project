<?php
require_once 'connect.php';

$flights_id = $_POST['flights_id'];
$hotels_id = $_POST['hotels_id'];

$hotel_name = $_POST['hotel_name'];
$destination = $_POST['destination'];
$passengers = $_POST['passengers'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];
$departure_date = explode(" ",$departure_date)[0];
$return_date = explode(" ",$return_date)[0];
$stars = $_POST['stars'];
$meals = $_POST['meals'];
$price = $_POST['price'];
$description = $_POST['description'];
			
$sql1 = "SELECT * FROM images WHERE hotels_id = '$hotels_id '";
$images = $conn->query($sql1);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Hotel Information</title>
	
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">

  </head>
  <body>
    
<div class="container mt-3">     <!-- menu-->
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-4 fst-italic text-center text-sm-center text-md-center text-lg-start">
			<a href="" class="text-decoration-none text-dark"><h3>-- Dive In Exploring --</h3></a>
		</div>
		
		<div class="col-12 col-sm-12 col-md-12 col-lg-8 d-flex justify-content-end">
			<div class="row d-flex justify-content-end" style="width:100%">
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 align-self-center d-flex justify-content-center">
					<a class="" href="mailto:info@diveinexploring.com">info@diveinexploring.com</a>
				</div>
<style>
        body {
            background-image: url('images/fonas.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
</style>
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3 d-flex justify-content-center">
				  <?php
				  if(!isset($_SESSION['vartid'])){
					  echo "<a class='btn btn-outline-primary' href='login.php'>LOGIN</a>";}
					else{
					  echo "<a href='user.php' class='text-decoration-none link-secondary'>USER</a>";}
				  ?>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="container mt-3"> <!-- hotel info -->
	<div class="row">
		<div class="col">
			<div class="container">

			<?php
			echo'
				<div class="row">
					<div class="col-auto fst-italic">
						<h3>'.$hotel_name.'</h3>
					</div>
					<div class="col-auto fst-italic">
						<h3>'.$stars.'⭐</h3>
					</div>
					<div class="col-auto fst-italic align-self-center">
						<span>'.$destination.'</span>
					</div>
					<div class="col-auto fst-italic align-self-center">
						<span> Days '.$arrival_date.' to '.$return_date.'</span>
					</div>
				</div>
			';
			?>
			</div>
		</div>
		<div class="col-auto">
			<div class="container">
				<?php
				echo'
				<form action="extras.php" method="post">
					<input type="hidden" name="flights_id" value="'.$flights_id.'">
					<input type="hidden" name="hotels_id" value="'.$hotels_id.'">
					<input type="hidden" name="passengers" value="'.$passengers.'">
					<div class="row">
						<div class="col-auto align-self-center">
							<span> Hotel Price: '.$price*$passengers.'€ / '.$passengers.'asm.</span>
						</div>
						<div class="col-auto d-flex justify-content-end">
							<button class="btn btn-secondary"type="submit">Choose</button>
						</div>
					</div>
				</form>
				';
				?>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3"> <!-- images  -->
		<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
	  <div class="carousel-inner">
		<?php
            if ($images->num_rows ==1){
				while ($row = $images->fetch_assoc()) {
                
					echo '<div class="carousel-item active">';
					echo '<img src="/uploads/'.$row['images$images_url'].'" class="d-block w-100" alt="..."> </div>';
				}
			}
            if ($images->num_rows >= 2){
                for($i = 0; $i<$images->num_rows; $i++){
                    if($i == 0){
                        $row = $images->fetch_assoc();
                        echo '<div class="carousel-item active">';
                        echo '<img src="/uploads/'.$row['images$images_url'].'" class="d-block w-100" alt="..."> </div>';
                    }
                    else{
                        $row = $images->fetch_assoc();
                        echo '<div class="carousel-item">';
                        echo '<img src="/uploads/'.$row['images$images_url'].'" class="d-block w-100" alt="..."> </div>';
                    }
                }
            }
        ?>
	
	  </div>
	  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	  </button>
	  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
	  </button>
	</div>
</div>

<div class="container mt-3 mb-3">    <!-- hotel description -->
	
	<div class="row">
		<div class="col"><hr></div>
			<h4 class="col-auto fw-bold fst-italic align-self-center"> Hotel's Description</h4>
		<div class="col"><hr></div>
	</div>
	<?php
		echo'
			<span class="fw-light">'.$description.'</span>
		';
	?>
</div>

							
	<button onclick="topFunction()" id="myBtn" title="Grįžti į pradžią">▲</button> 
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