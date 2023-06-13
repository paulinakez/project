<?php
require_once 'connect.php';

$flights_id = $_POST['flights_id'];

$travel_to = $_POST['travel_to'];
$passengers = $_POST['passengers'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];
$departure_date = explode(" ",$departure_date)[0];
$return_date = explode(" ",$return_date)[0];

    $sql = "SELECT * FROM hotels WHERE travel_to = '$travel_to' AND arrival_date between '$departure_date 00:00:00' and '$departure_date 23:59:59' AND departure_date between '$return_date 00:00:00' and '$return_date 23:59:59' "; //nuo kada iki kada
	       
											
    if(!empty($_POST['price_from']) && !empty($_POST['price_to'])){
        $sql = $sql." AND (price between " .$_POST['price_from']." and " .$_POST['price_to'].")";
    }

    if(!empty($_POST['price_from'])){
		$sql = $sql." AND (price between " .$_POST['price_from']." and 10000000)";
    }
	
    if(!empty($_POST['price_to'])){
		$sql = $sql." AND (price between 0 and " .$_POST['price_to'].")";
    }
	
	$start1 = false;
	$start2 = false;
	$start3 = false;
	$start4 = false;
	$start5 = false;
	
    if(!empty($_POST['starts'])){
        $sql = $sql." AND (starts = 6";
        foreach ($_POST['starts'] as &$value) {
			$sql = $sql." OR starts = ".$value;
			if($value == 1){
				$start1 = true;
			}
			elseif($value == 2){
				$start2 = true;
			}
			elseif($value == 3){
				$start3 = true;
			}
			elseif($value == 4){
				$start4 = true;
			}
			elseif($value == 5){
				$start5 = true;
			}
			
        }
        $sql = $sql.")";
    }
	
	
	$meals1 = false;
	$meals2 = false;
	$meals3 = false;
	$meals4 = false;
	
    if(!empty($_POST['meals'])){

        $sql = $sql." AND (meals = 'temp'";
        foreach ($_POST['meals'] as &$value) {
			$val = "'".$value."'";
			$sql = $sql." OR meals = ".$val;
			if($value == 'Not Included'){
				$meals1 = true;
			}
			elseif($value == 'Bed & Breakfast'){
				$meals2 = true;
			}
			elseif($value == 'Half Board'){
				$meals3 = true;
			}
			elseif($value == 'All Inclusive'){
				$meals4 = true;
			}
        }
        $sql = $sql.")";
    }


	$location1 = false;
	$location2 = false;
	
    if(!empty($_POST['location'])){
        $sql = $sql." AND (location = 'temp'";
        foreach ($_POST['location'] as &$value) {
            $val = "'".$value."'";
			$sql = $sql." OR location = ".$val;
			if($value == 'Beach Side'){
				$location1 = true;
			}
			elseif($value == 'City Centre'){
				$location2 = true;
			}
        }
        $sql = $sql.")";
    }
	
	
	$theme1 = false;
	$theme2 = false;
	$theme3 = false;
	
    if(!empty($_POST['theme'])){
        $sql = $sql." AND (theme = 'temp'";
        foreach ($_POST['theme'] as &$value) {
            $val = "'".$value."'";
			$sql = $sql." OR theme = ".$val;
			if($value == 'Family'){
				$theme1 = true;
			}
			elseif($value == 'Couples'){
				$theme2 = true;
			}
			elseif($value == 'Business'){
				$theme3 = true;
			}
        }
        $sql = $sql.")";
    }
	$sql = $sql." ORDER BY price ASC";
    
	$hotels = $conn->query($sql);
   

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Hotels</title>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">
	
  </head>
  <body>
  
<div class="container mt-3" style="padding:0px">     <!-- Meniu juosta -->
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
				  if(!isset($_SESSION['vartid'])){
					  echo "<a class='btn btn-outline-primary' href='login.php'>LOGIN</a>";}
					else{
					  echo "<a href='user.php' class='text-decoration-none link-secondary'>User</a>";}
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
<div class="container-fluid fonas mt-2 pb-5 pt-5"> 
	<div class="row ">
		<div class="col text-white fst-italic d-flex justify-content-center">
			<h1>
			-- Hotels --
			</h1>
		</div>
	</div>
		
	<div class="container bg-transparent mt-3">  <!--search ything -->
		
		<div class="row">
			<div class="col text-white fst-italic d-flex justify-content-center mb-3 mt-3">
				<h5>Holiday Search</h5>
			</div>
		</div>
		<form  action="flights_search.php" method="post">
            
			<div class="row justify-content-center">
					
				<div class="col-12 col-sm-12 col-md-12 col-lg-auto mb-3">
					<select name="travel_to" class="form-select">
						<?php
						 $sql = "SELECT DISTINCT travel_to FROM flights";
						
						 $rez = $conn->query($sql);
					  
						 if($rez->num_rows > 0){
							while ($row = $rez->fetch_assoc()) {
								if($travel_to != $row['travel_to']){
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

<div class="container">
									<!-- filter -->
	<div class="row mt-3">
	
		<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 border rounded mb-3 p-2" style="height:100%">
            <form action = "" method="POST">
                <?php
                    echo'
						<input type="hidden" name="flights_id" value="'.$flights_id.'">
                        <input type="hidden" name="travel_to" value="'.$travel_to.'">
                        <input type="hidden" name="passengers" value="'.$passengers.'">
                        <input type="hidden" name="departure_date" value="'.$departure_date.'">
                        <input type="hidden" name="return_date" value="'.$return_date.'">
						';
                 ?>

				<h4 class="text-center">Filter</h4>
				<div class="">
                    <label>price:</label>

                    <div class="priceFiltras mt-2"> 
                        <div>
                            <label>From </label>
                            <?php echo' <input value="'.$_POST['price_from'].'" name="price_from" type="number" min="0" max="10000"/> ';?>
                        </div>
                        <div>
                            <label>To </label>
                            <?php echo' <input value="'.$_POST['price_to'].'" name="price_to" type="number" min="0" max="10000"/> ';?>
                        </div>
                    </div>
					
				</div>
				<div class="mt-3">
					<label>Hotel Category</label>
					
					<?php
					if($start1 == 'true'){
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="1" name="starts[]"  id="flexCheckDefault" checked>
								<label class="form-check-label" for="flexCheckDefault">
									⭐
								</label>
							</div>
					';}
					else{
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="1" name="starts[]"  id="flexCheckDefault">
								<label class="form-check-label" for="flexCheckDefault">
									⭐
								</label>
							</div>
					';
					}
					?>

					<?php
					if($start2 == 'true'){
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="2" name="starts[]"  id="flexCheckDefault" checked>
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐
								</label>
							</div>
					';}
					else{
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="2" name="starts[]"  id="flexCheckDefault">
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐
								</label>
							</div>
					';
					}
					?>
					<?php
					if($start3 == 'true'){
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="3" name="starts[]"  id="flexCheckDefault" checked>
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐⭐
								</label>
							</div>
					';}
					else{
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="3" name="starts[]"  id="flexCheckDefault">
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐⭐
								</label>
							</div>
					';
					}
					?>
					<?php
					if($start4 == 'true'){
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="4" name="starts[]"  id="flexCheckDefault" checked>
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐⭐⭐
								</label>
							</div>
					';}
					else{
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="4" name="starts[]"  id="flexCheckDefault">
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐⭐⭐
								</label>
							</div>
					';
					}
					?>
					<?php
					if($start5 == 'true'){
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="5" name="starts[]"  id="flexCheckDefault" checked>
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐⭐⭐⭐
								</label>
							</div>
					';}
					else{
						echo '
							<div class="col">
								<input class="form-check-input" type="checkbox" value="5" name="starts[]"  id="flexCheckDefault">
								<label class="form-check-label" for="flexCheckDefault">
									⭐⭐⭐⭐⭐
								</label>
							</div>
					';
					}
					?>

				</div>
				<div class="mt-3">
					<label>Meals:</label>
					<?php
					if($meals1 == 'true'){
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Not Included" name="meals[]"  id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								Not Included
							</label>
						</div>
						';
					}
					else{
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Not Included" name="meals[]"  id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								Not Included
							</label>
						</div>
						';
					}
					?>
					<?php
					if($meals2 == 'true'){
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Bed & Breakfast" name="meals[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								Bed & Breakfast
							</label>
						</div>
					';}
					else{
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Bed & Breakfast" name="meals[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								Bed & Breakfast
							</label>
						</div>
					';						
					}
					?>
					<?php
					if($meals3 == 'true'){
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Half Board" name="meals[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
                            Half Board
							</label>
						</div>
						';
					}
					else{
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Half Board" name="meals[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
                            Half Board
							</label>
						</div>
						';
					}?>
					<?php
					if($meals4 == 'true'){
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="All Inclusive" name="meals[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								All Inclusive
							</label>
						</div>
						';
					}
					else{
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="All Inclusive" name="meals[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								All Inclusive
							</label>
						</div>
						';
					}
					?>
				</div>
				
				<div class="mt-3">
					<label>Hotel location:</label>
					<?php
					if($location1 == 'true'){
						echo '
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Beach" name="location[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								Beach
							</label>
						</div>
						';
					}
					else{
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Beach" name="location[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								Beach
							</label>
						</div>
						';
					}
					?>
					<?php
					if($location2 == 'true'){
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="City Centre" name="location[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								City Centre
							</label>
						</div>
						';
					}
					else{
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="City Centre" name="location[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								City Centre
							</label>
						</div>
						';
					}
					?>
				</div>
				
				<div class="mt-3">
					<label>Hotel theme:</label>
					<?php
					if($theme1 == 'true'){
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Family friendly" name="theme[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								Family friendly
							</label>
						</div>
						';
					}
					else{
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Family friendly" name="theme[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								Family friendly
							</label>
						</div>
						';
					}
					?>
					<?php
					if($theme2 == 'true'){	
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Couples" name="theme[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								Couples
							</label>
						</div>
						';
					}
					else{
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Couples" name="theme[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								Couples
							</label>
						</div>
						';
					}
					?>
					<?php
					if($theme3 == 'true'){	
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Business" name="theme[]" id="flexCheckDefault" checked>
							<label class="form-check-label" for="flexCheckDefault">
								Business
							</label>
						</div>
						';
					}
					else{
						echo'
						<div class="col">
							<input class="form-check-input" type="checkbox" value="Business" name="theme[]" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								Business
							</label>
						</div>
						';
					}
					?>
				</div>
				<div class="col-auto d-flex justify-content-center mt-3 pb-3">
					<button class="btn btn-primary" type="submit">Filter</button>
				</div>
            </form>
		</div>
		
											<!-- hotels-->
       

        <div class = "col">
			<?php

			if($hotels->num_rows > 0){
				while ($row = $hotels->fetch_assoc()) {
					
					echo'
					<form  action="hotel_view.php" method="post">
						<input type="hidden" name="flights_id" value="'.$flights_id.'">
						<input type="hidden" name="hotels_id" value="'.$row['hotels_id'].'">
						<input type="hidden" name="hotel_name" value="'.$row['hotel_name'].'">
						<input type="hidden" name="location" value="'.$row['travel_to'].'">
						<input type="hidden" name="passengers" value="'.$passengers.'">
						<input type="hidden" name="arrival_date" value="'.$row['arrival_date'].'">
						<input type="hidden" name="departure_date" value="'.$row['departure_date'].'">
						<input type="hidden" name="stars" value="'.$row['stars'].'">
						<input type="hidden" name="board" value="'.$row['board'].'">
						<input type="hidden" name="price" value="'.$row['price'].'">
						<input type="hidden" name="description" value="'.$row['description'].'">
						
						<div class="row ps-0 pe-0 fixPadding" >
							<div class="container px-0">
								<div class="card mb-4">
								  <div class="row g-0">
								  ';
								  
									$sql1 = "SELECT * FROM images WHERE hotels_id = ".$row['hotels_id']." LIMIT 1";
									$images = $conn->query($sql1);
									
									if ($images->$num_rows >= 1){
										while ($eil = $images->fetch_assoc()) {
											
											echo'
											<div class="col-md-2">
												<img src="/uploads/'.$eil['image_url'].'" style="height:100%; width:100%" class="img-fluid rounded-start" alt="...">
											</div>
											';
										}
									}
									
									echo'
									<div class="col-md-8">
									  <div class="card-body">
										<h5 class="card-title">'.$row['hotel_name'].'</h5>
										<p class="card-text">'.$row['stars'].'</p>
										<p class="card-text">'.$row['board'].'</p>
									  </div>
									</div>				
									<div class="col-md-2">
									  <div class="card-body">
										<p class="card-text">Hotel final price: '.$row['price']*$passengers.' £ / '.$passengers.'pp. </p>
										<button type="submit" class="btn btn-secondary">Search</button>
									  </div>
									</div>
								  </div>
								</div>
							</div>

						</div>
					</form>
					';
				}
			}
			else {
				echo "<h5 class='text-center text-danger'></h5>";
			}
			
			?>
        </div>
	</div>																		
</div>	
	
								
									
	<button onclick="topFunction()" id="myBtn" title="Return">▲</button> 
	
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