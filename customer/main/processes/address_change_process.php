<?php
//starting the session 
session_start();
if(!isset($_SESSION['username'])){
	header('location:../templates/customers_signin_form.php');
}
//connecting to database
// $con = mysqli_connect('localhost','id15991512_kundan5602','Adnan@123456');
// if ($con) {
// }else{
// 	echo" no connection";
// }
// mysqli_select_db($con, 'id15991512_parag_canteen');
include "../../include/conn.php";

//receiving the useful variables
$userId = $_SESSION['username'];
$idqr = $_POST['idq'];



$qrt = "update customers_details set addressOfCustomer='$idqr' where idOfCustomer='$userId'";
$resultr = mysqli_query($con,$qrt);
if($resultr){
    echo "success";
}

?>