<?php

session_start();


include "../../include/conn.php";

	$email = $_POST['user'];
	$password = $_POST['password'];

	$email_search = " select * from customers_details where emailOfCustomer='$email'";
	$query = mysqli_query($con,$email_search);
	$email_count = mysqli_num_rows($query);
	if ($email_count) {
		while($email_pass = mysqli_fetch_assoc($query)){

        $_SESSION['username'] = $email_pass['idOfCustomer'];
		$db_pass = $email_pass['passwordOfCustomer'];

	}
		if (password_verify($password,$db_pass)) {
			header('location:../templates/index.php');
		}else{
			?>
<script>
	alert("Password is incorrect");
</script>
<?php
      header('location:customers_signin_form.php');
		}
	}else{
		?>
<script>
	alert("Mobile number is not registered");
</script>
<?php
header('location:../templates/customers_signin_form.php'); 
	}
?>