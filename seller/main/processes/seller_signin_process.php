<?php

session_start();


include "../../include/conn.php";

	$phone = $_POST['phone'];
	$password = $_POST['password'];

	$email_search = " select * from seller_details where mobile='$phone'";
	$query = mysqli_query($con,$email_search);
	$email_count = mysqli_num_rows($query);
	if ($email_count) {
		while($email_pass = mysqli_fetch_assoc($query)){

        $_SESSION['username'] = $email_pass['sellerId'];
		$db_pass = $email_pass['password'];

	}
		if (password_verify($password,$db_pass)) {
			header('location:../templates/seller_home_page.php');
		}else{
			?>
<script>
	alert("Password is incorrect");
</script>
<?php
      header('location:seller_signin_form.php');
		}
	}else{
		?>
<script>
	alert("Mobile number is not registered");
</script>
<?php
header('location:../templates/seller_signin_form.php'); 
	}
?>