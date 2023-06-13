<?php
require_once 'connect.php';

$flights_id = $_POST['flights_id'];
$hotels_id = $_POST['hotels_id'];
$extras_id = $_POST['extras'];


$passengers = $_POST['passengers'];

$sql = "SELECT * FROM flights WHERE flights_id = '$flights_id '";
$rez = $conn->query($sql);
$flight = $rez->fetch_assoc();
$final_flights_price = $flight['final_price']*$passengers;

$sql1 = "SELECT * FROM hotels WHERE hotels_id = '$hotels_id '";
$rez1 = $conn->query($sql1);
$hotel = $rez1->fetch_assoc();
$final_hotels_price = $viesbutis['price']*$passengers;

if(!empty($_POST['extras'])){

		$sql2 = "SELECT * FROM extras WHERE ";
		$i = 0;
        foreach ($_POST['extras'] as &$value) {
			$value = "".$value."";
			$sql2 = $sql2."extras_id = ".$value;
			if($i+1 != count($_POST['extras'])){
				$sql2 = $sql2." OR ";
			}
			$i++;

        }
   
    $extras = $conn->query($sql2);
      
    }

$final_extras_price = 0;
$extras_masyvas =[];
if($extras->num_rows > 0){
	while ($row = $extras->fetch_assoc()) {
        array_push($extras_masyvas, $row['extras_id']);
		$final_extras_price += $row['price']*$passengers;
	}
    $extras_masyvas = json_encode($extras_masyvas);
    $_SESSION['extras'] = $extras_masyvas;
}

$final_price=$final_flights_price+$final_hotels_price+$final_extras_price;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Payment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
	
  </head>
  <body>
 
  <div class="container-fluid fonas mb-2 pb-5 pt-5">   
	<div class="row pt-5 pb-5 mt-2 mb-2">
		<div class="col text-white fst-italic d-flex justify-content-center">
			<a href="" class="text-decoration-none text-white"><h1>-- Payment --</h1></a>
		</div>
	</div>
  </div>
  
  
	<main class="container border border-3 rounded mt-3 col-md-4 col-10">
		
		<img src="https://www.watchstation.com/on/demandware.static/-/Library-Sites-WatchStationSharedLibrary/default/dwd759a869/customer_care/payment/Mobile_Card_View@2x.png" class="img-fluid" alt="Responsive image">
		<?php echo'<h3 class="row fst-italic d-flex justify-content-center pt-3">Price: '.$final_price.'</h3> ';?>
		<form action="payment_process.php" method="post">
            <?php
				echo '
				<input type="hidden" name="flights_id" value="'.$flights_id.'">
				<input type="hidden" name="hotles_id" value="'.$hotles_id.'">
				<input type="hidden" name="extras" value="'.$extras_masyvas.'">
				';

            ?> 
			<div class="col-auto d-flex justify-content-center mt-3 pb-3">
				<button class="btn btn-secondary" type="submit">BUY</button>
			</div>
		</form>
	</main>
   
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
 </html>