<?php

session_start();
    if(!isset($_SESSION['username'])){
        header('location:seller_signin_form.php');
    }
    /*header('location:formpage.php');*/
    //$con = mysqli_connect('localhost','root');
    include "../../include/conn.php";

$sellerId = $_SESSION['username'];
$menu = $_POST['menu'];
$namep = $_POST['namep'];
$about = $_POST['about'];
$genre = $_POST['genre'];
$image = $_POST['image'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$q1p = $_POST['q1p'];
$q2p = $_POST['q2p'];
$q3p = $_POST['q3p'];
$q4p = $_POST['q4p'];
$f=1;

function random_strings($length_of_string){
	        	$str_result = '0123456789abdefghiklmnoqrtuvxzABDEGHIJKNOPQTUWXYZ';
	        	return substr(str_shuffle($str_result), 0, $length_of_string);
        	}
	        $ids = random_strings(5);
	        $idoc = $sellerId.$ids;
	        echo $idoc;
 $sq = "select * from products_detail where nameOfProduct='$namep' and sellerId='$sellerId'";
 $resul = mysqli_query($con, $sq);
 if(mysqli_num_rows($resul)>0){
 	$f=0;
 }
 if($f==1){
 $sql = "select * from products_detail where menuName='$menu'";
    $result = mysqli_query($con, $sql);
    $position = mysqli_num_rows($result)+1;


$qy= " insert into products_detail(idOfProduct, nameOfProduct, aboutProduct, genreOfProduct, imageName, quantity1, quantity2, quantity3, quantity4, priceOfQuantity1, priceOfQuantity2, priceOfQuantity3, priceOfQuantity4, sellerId,position,menuName ) values ('$idoc' , '$namep' , '$about' , '$genre' , '$image' , '$q1' , '$q2' , '$q3' , '$q4' , '$q1p' , '$q2p' , '$q3p' , '$q4p' , '$sellerId' , '$position' , '$menu') ";
	$m=mysqli_query($con,$qy);
	if(isset($m)){
		
		echo "1";
	
	}else{
		echo "message not sent";
	}

}else{
	echo "2";
}

?>