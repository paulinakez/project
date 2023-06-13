<?php
require_once 'connect.php';

$name = $_POST['Name'];
$surname = $_POST['LastName'];
$birth_date = $_POST['BirthDate'];
$email = $_POST['Email'];
$username = $_POST['Username'];
$password = $_POST['Password'];

if(!empty($_POST['Name']) && !empty($_POST['LastName']) && !empty($_POST['BirthDate']) && !empty($_POST['Email']) && !empty($_POST['Username']) && !empty($_POST['Password'])){
    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT user_name FROM users WHERE user_name = '".$username."'";
    $rez = $conn->query($sql);
    if($rez->num_rows == 0){
        $sql2 = "INSERT INTO users (name, surname, birth_date, email, username, password) VALUES ('".$name."','".$surname."','".$birth_date."','".$email."','".$username."','".$pass."')";
        $conn->query($sql2);
        header("location: login.php");
    }
    else{
        header("location: register.php?klaida=egzistuoja");
    }
}
else{
    header("location: register.php?klaida=neivesta");
}


$conn->close();
?>