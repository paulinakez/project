<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbproject1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['Username'];
$password = $_POST['Password'];

if(!empty($_POST['Username']) && !empty($_POST['Password'])){
    $sql = "SELECT * FROM users WHERE username = '".$username."'";
    $rez = $conn->query($sql);
    if($rez->num_rows > 0){
        $eil = $rez->fetch_assoc();
        if(password_verify($password, $eil["password"])){
            $_SESSION['user_id'] = $eil["user_id"];
            $_SESSION['name'] = $eil["name"];
            $_SESSION['type'] = $eil["type"];
			$_SESSION['surname'] = $eil["surname"];
			$_SESSION['email'] = $eil["email"];
			$_SESSION['birth_date'] = $eil["birth_date"];
			
            
            if($eil["type"] == "admin")
            {
                header("location: admin/admin_flights.php");
            }
            else{
					header("location: index.php");
				
            }
        }
        else{
            header("location: login.php?klaida=neteisingai");
        }
    }
    else{
        header("location: login.php?klaida=neegzistuoja");
    }
}
else{
    header("location: login.php?klaida=neivesta");
}


$conn->close();
?>