<?php
    session_start();
    include "../include/conn.php";
    
    $email_search = " select * from otp_verification where email='ky4154247@gmail.com'";
	$query = mysqli_query($con,$email_search);
	$email_count = mysqli_num_rows($query);
	if ($email_count==1) {      //if email exist 
		while($email_pass = mysqli_fetch_assoc($query)){
        	$rotp= $email_pass['otp'];      //fetching the otp associated with the given email
        	echo $rotp;
        }
    }else {
        echo "no otp";
    }
    
    ?>