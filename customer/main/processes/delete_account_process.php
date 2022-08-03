<?php
    session_start();
    include "../../include/conn.php";
    $mail="ky4154247@gmail.com";
    $sql="delete from customers_details where emailOfCustomer='$mail'";
    $s=	mysqli_query($con,$sql);
    if($s){
        echo "deleted";
    }
    
    ?>