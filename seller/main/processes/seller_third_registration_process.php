<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:seller_signin_form.php');
    }
    /*header('location:formpage.php');*/
    //$con = mysqli_connect('localhost','root');
    include "../../include/conn.php";
    //users information for account creation sent through ajax
    $name = $_POST['name'];
    $description= $_POST['description'];
    $location= $_POST['location'];
    $user = $_SESSION['username'];


    $sql = "UPDATE seller_details SET opens='$name', closes='$description', approx='$location' WHERE sellerId='$user'";
//     include "../../include/conn.php";
// $sql = "UPDATE seller_details SET hotelName='ddffd', description='ffdfdf', location='dfggfgf' WHERE sellerId='UY9BgemIi41234512345'";

    $vc =mysqli_query($con,$sql);
            if($vc){
                echo "1";
            }else{
                echo "2";
            }

//     //searching if email exist in otp verificatiob database
//     $email_search = " select * from otp_verification where email='$email'";
// 	$query = mysqli_query($con,$email_search);
// 	$email_count = mysqli_num_rows($query);
// 	if ($email_count==1) {      //if email exist 
// 		while($email_pass = mysqli_fetch_assoc($query)){
//         	$rotp= $email_pass['otp'];      //fetching the otp associated with the given email
//         }
//     }
//     //checking if the entered otp and sent otp are same
//     if($iotp==$rotp){
//         //deleting the given otp from database
//     	$sql="delete from otp_verification where email='$email'";
//     	mysqli_query($con,$sql);
//     	//checking if email already exist
//         $q = " select * from seller_details where mobile='$email'";
//         $result = mysqli_query($con,$q);
//         $num = mysqli_num_rows($result);
//         if($num==1){
//         	echo "2";
//         }else{
//             //function for id generation
//         	function random_strings($length_of_string){
// 	        	$str_result = '0123456789abdefghiklmnoqrtuvxzABDEGHIJKNOPQTUWXYZ';
// 	        	return substr(str_shuffle($str_result), 0, $length_of_string);
//         	}
// 	        $id = random_strings(10);
// 	        $addno = strval($phon);
// 	        $idoc = $id.$addno;
// 	        //now inserting the required data into the database
// 	        $qy= " insert into seller_details(sellerId, sellerName, mobile,mail, password) values ('$idoc','$firstname','$phon','$email','$password') ";
//         	$vc =mysqli_query($con,$qy);
//         	if($vc){
//         	    $_SESSION['username'] = $idoc;
// 		        echo "1";
//         	}
//         }
//     }else{
// 	    echo "3";
//     }
?>