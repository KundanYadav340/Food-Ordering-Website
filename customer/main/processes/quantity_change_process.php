<?php
//starting the session 
session_start();
if(!isset($_SESSION['username'])){
	header('location:../templates/customers_signin_form.php');
}
//connecting to database
include "../../include/conn.php";

//receiving the useful variables
$userId = $_SESSION['username'];
$idqr = $_POST['idq'];
//echo $idqr;
$given ="";
$quantity="";
$products="";

//retreiving the row whose id is username
$q="select * from customers_cart where idOfCustomer='$userId'";
$result = mysqli_query($con, $q);
while($row=mysqli_fetch_assoc($result)){
	$products = $row['idOfProducts'];
	$quantity = $row['products_quantity'];
    }
	//find the selected id position
	$given = substr($idqr,0,6);
	//echo $given."-----";
	$idPosition = strpos($products, $given);
	//echo $idPosition."===";
	$order1= $idqr[6];
	$order2 = $idqr[7];
	//echo ",,,".$order1;
	//echo $order2;
	
	
	$products[$idPosition+6]=$order1;
	$products[$idPosition+7]=$order2;
    //echo "<<<<<".$products;


	//inserting the first and second value




//inserting new quantity
$qrt = "update customers_cart set idOfProducts='$products' where idOfCustomer='$userId'";
$resultr = mysqli_query($con,$qrt);
if($resultr){
    echo "success";
}

?>