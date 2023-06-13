<?php
require_once 'connect.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
	
  </head>
  <body>
 
  <div class="container-fluid fonas mb-2 pb-5 pt-5">   
	<div class="row pt-5 pb-5 mt-2 mb-2">
		<div class="col text-white fst-italic d-flex justify-content-center">
			<a href="" class="text-decoration-none text-dark"><h1>-- Dive In Exploring --</h1></a>
		</div>
	</div>
  </div>
  
  
<main class="container">

    <section class="container border border-3 rounded col-md-6 col-10 mb-3 mt-3 py-4">
														
	   <div class="row">
		<div class="col-12 p-4 text-center">
		  <h3 class="mb-0">User Info</h3>
		</div>
	   </div>
													 
	   <div class="container">
		<div class="row row-cols-1 text-center">
		<?php
			if(!isset($_SESSION['user_id'])){
			  header("location: login.php");
			}
			  else{
			  $vid = $_SESSION['user_id'];
			  $sql = "SELECT user_id, name, surname, birth_date, email, username FROM users WHERE user_id = '".$vid."'";
			  $rez = $conn->query($sql);
			  $eil = $rez->fetch_assoc();
			  echo "<div class='col'>Name:<p>" .$eil["name"]. "</p></div>";
			  echo "<div class='col'>Surname:<p>" .$eil["surname"]. "</p></div>";
			  echo "<div class='col'>Date of Birth:<p>" .$eil["birth_date"]. "</p></div>";
			  echo "<div class='col'>Email:<p>" .$eil["email"]. "</p></div>";
			  echo "<div class='col'>Username:<p>" .$eil["username"]. "</p></div>";}

		  ?>
		</div>
	   </div>
	  
	  </div>

    </section>

	<div class="container border border-3 rounded col-md-6 col-10 mb-3 mt-3 py-4">
		<h3 class="mb-2 text-center">Order History</h3>
			<?php
			if(!isset($_SESSION['user_id'])){
				header("location: login.php");

			}
			  else{
				$vid = $_SESSION['user_id'];
				$sql = "SELECT * FROM orders WHERE user_id = '".$vid."'";
				$rez = $conn->query($sql);
				$eil = $rez->fetch_assoc();
				if($rez->num_rows > 0){
				  
					$sql1 = "SELECT * FROM flights WHERE flights_id = '".$eil["flights_id"]."'";
					$rez1 = $conn->query($sql1);
					$eil1 = $rez1->fetch_assoc();
					
					echo "
					
					<div class='container border border-3 rounded py-3 px-3'>
						<div class='row mt-3'>
							
							<span class='col fw-bold'>Flight: </span>
							<span class='col'>".$eil1['travel_from']." - ".$eil1['travel_to']."</span>
							<span class='col'>".$eil1['departure_date']." - ".$eil1['return_date']."</span>
							
						</div>
					  ";
					  
					$sql2 = "SELECT * FROM hotels WHERE hotels_id = '".$eil["hotels_id"]."'";
					$rez2 = $conn->query($sql2);
					$eil2 = $rez2->fetch_assoc();
					  
					echo "
					
						<div class='row mt-3'>
							
							<span class='col fw-bold'>Hotel: </span>
							<span class='col'>".$eil2['hotel_name']." ".$eil2['stars']."⭐</span>
							
							<span class='col'>".$eil2['board']."</span>
							
						</div>
					  ";
					 
					$sql3 = "SELECT * FROM extras WHERE ";
					$i = 0;
					
					$psl = json_decode($eil["extras"]);
					
					foreach ($psl as &$value) {
						
						
						$sql3 = $sql3."extras_id = ".$value;
					
						if($i+1 != count($psl)){
							
							$sql3 = $sql3." OR ";
						}
						$i++;
					}
					
					$extras = $conn->query($sql3);
					
					  
					echo "
					
						<div class='row mt-3'>
							
							<span class='col fw-bold'>extras: </span>";
							if($extras->num_rows > 0){
								while ($row = $extras->fetch_assoc()) {
									echo "
									<span class='col'>".$row['hotel_name']."</span> 
									";
								}
							}
							echo"
						</div>
					</div> 
					 ";
				}
				else{
					echo " <p class='text-center'>No Orders</p>";
				}
				
			  }

		  ?>
	</div>
</main>
   
									
                       
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