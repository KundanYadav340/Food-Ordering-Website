<?php

//session_start();

//making connections
//$con = mysqli_connect('localhost','root');
//mysqli_select_db($con, 'parag_canteen');

session_start();
if(!isset($_SESSION['username'])){
	header('location:../templates/customers_signin_form.php');
}

//making connection with database
include "../../include/conn.php";

//getting the inserting values
$user = $_SESSION['username'];
$idpr = $_POST['value'];

//checking if cart exist already
$nq = "SELECT idOfProducts FROM customers_cart WHERE idOfCustomer='$user'";
$nr = mysqli_query($con,$nq);
$nums = mysqli_num_rows($nr);

//inserting elements when no cart database is found
if($nums==0){
$q = "INSERT INTO customers_cart(idOfCustomer,numberOfProducts,idOfProducts,products_quantity	) VALUES ('$user','1','$idpr','#01')";
$result= mysqli_query($con,$q);
}else{

	//if cart already exist
	$ner = "SELECT numberOfProducts,idOfProducts,products_quantity FROM customers_cart WHERE idOfCustomer='$user'";
	$nerr = mysqli_query($con,$ner);
	while ($row=mysqli_fetch_assoc($nerr)) {
		$nid = $row['idOfProducts'];

		//check if item is already in cart
		if(gettype(strpos($nid,substr($idpr,0,6)))== "integer"){
			echo "1";

		}else{

			//update the product id and product number
			$inserting_id = $nid.$idpr;
			$inserting_number = intval($row["numberOfProducts"])+1;
			//echo "/n".$inserting_number."---".$inserting_id;
			$new_quantity = $row['products_quantity']."#01";

			//insert updated product id and product number
			$sql = "UPDATE customers_cart SET  idOfProducts='$inserting_id', numberOfProducts='$inserting_number',products_quantity='$new_quantity' WHERE idOfCustomer='$user'";
			$rsql = mysqli_query($con,$sql);
			if($rsql){
				echo "2";
			}else{
			    echo "3";
			}
		}
	}
}
?>