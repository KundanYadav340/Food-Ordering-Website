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
	$inserting_number = intval($row["numberOfProducts"])-1;
    }
    if(strlen($products)<9){
        $del = "delete from customers_cart where idOfCustomer='$userId'";
        $delr = mysqli_query($con,$del);
        if($delr){
            echo "success";
        }
    }else{
	//find the selected id position
	$given = substr($idqr,0,6);
	//echo $given."-----";
	$idPosition = strpos($products, $given);
	//echo $idPosition."===";
	$order1= substr($products, 0,$idPosition);
	$order2 = substr($products,$idPosition+8);
	//echo ",,,".$order1;
	//echo $order2;
	$edited = $order1.$order2;
	
	
	



//inserting new quantity
$qrt = "update customers_cart set idOfProducts='$edited',numberOfProducts='$inserting_number' where idOfCustomer='$userId'";
$resultr = mysqli_query($con,$qrt);
if($resultr){
    echo "success";
}
}
?>