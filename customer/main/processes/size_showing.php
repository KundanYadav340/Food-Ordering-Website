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
$printi = $_SESSION['username'];
//echo $printi;
$idpr = $_POST['idp'];
//echo $idpr."<br>";
echo "<h3>Select size <h3>";

$q = "select * from products_detail where idOfProduct ='$idpr'";
$result= mysqli_query($con,$q);
while ($rows = mysqli_fetch_array($result)) {
	if($rows['quantity1']!="null"){
		echo "<input type=\"radio\" id=\"q1\" name=\"size\" value=\"1\" checked>".$rows['quantity1'];
	}
	if($rows['quantity2']!="null"){
		echo "<br><input type=\"radio\" id=\"q2\" name=\"size\" value=\"".$rows['quantity2']."\">".$rows['quantity2'];
	}if($rows['quantity3']!="null"){
		echo "<br><input id=\"q3\" type=\"radio\" name=\"size\" value=\"".$rows['quantity3']."\">".$rows['quantity3'];
	}if($rows['quantity4']!="null"){
		echo "<br><input id=\"q4\" type=\"radio\" name=\"size\" value=\"".$rows['quantity4']."\">".$rows['quantity4'];
	}
}


?>
