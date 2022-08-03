<?php

//for starting the session

session_start();
if(!isset($_SESSION['username'])){
	header('location:customers_signin_form.php');
}


//making connection with database

$con = mysqli_connect('localhost','id15991512_kundan5602','Adnan@123456');
if ($con) {
}else{
	echo" no connection";
}
mysqli_select_db($con, 'id15991512_parag_canteen');


//getting the variables which have to be inserted

//$idpr = $_POST['idp'];
//$printi = $_SESSION['username'];
   //  echo $printi;
 $idpr = "#0009";
$printi = $_SESSION['username'];
     echo $printi;
$numprd = 1;
// checking the existence of the cart

$qry = " select * from customers_cart where idOfCustomer= '$printi'";
$results = mysqli_query($con,$qry);
$nums = mysqli_num_rows($results);
echo $nums;

//if the cart don't exist make new cart

//if(strval($nums)=="0"){
	$newq ="INSERT INTO customers_cart(idOfCustomer, numberOfProducts, idOfProducts) VALUES ('$printi', '1' , $idpr)";
	$newresult = mysqli_query($con,$newq);
//}

	$qq="INSERT INTO `customers_cart`(`keyOfCart`, `idOfCustomer`, `numberOfProducts`, `idOfProducts`) VALUES ([1],[2],[va1],[2])";
    $nqq= mysqli_query($con,$qq);

/*if($num==1){
	while($row = mysqli_fetch_assoc($result)){
		$cartString = $row["idOfProducts"];
		$newString = $cartString.$q;
		$number = $row["numberOfProducts"] + 1;
	}
	$q2 = " UPDATE customers_cart SET idOfProducts='$newString' and numberOfProducts='$number' WHERE idOfCustomer='$_SESSION['username']'";
    $result2 = mysqli_query($con,$q2);
}else{
	$num ="1";
	$qy= " insert into customers_cart(idOfCustomer, numberOfProducts, idOfProducts) values ('$user,'$num' , '$q') ";
	mysqli_query($con,$qy);
}*/
?>