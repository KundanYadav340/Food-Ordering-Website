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
    $user = $_SESSION['username'];
    $menuNumber;
    $menu="";

    $sq = "select menuNumber, menu from seller_details where sellerId='$user'";
    $result = mysqli_query($con, $sq);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $menuNumber = $row['menuNumber'];
    $menu = $row['menu'];
  }
}

    if(strpos($menu, $name) == false){
        $menuNumber++;
        $menu = $menu.".".$menuNumber.$name;
    $sql = "UPDATE seller_details SET menuNumber='$menuNumber', menu='$menu' WHERE sellerId='$user'";


    $vc =mysqli_query($con,$sql);
            if($vc){
                echo "1";
            }else{
                echo "2";
            }
    }else{
        echo "3";
    }
?>