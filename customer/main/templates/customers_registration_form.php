<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8" /> 

<meta

  name="viewport"

  content="width=device-width, initial-scale=1, maximum-scale=1"/> 

	<meta name="theme-color" content="#ff4500">
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		    font-size:20px;
		}
		h1{
			background-color: #ff4500;
			color: white;
			text-align: center;
			padding: 10px;
			font-size:32px;
		}
		.login-box{
		    padding-top:15px;
			margin-top: 18%;
			box-shadow: 1px 2px 7px #ff4500;
			width: 84%;
			height: auto;
			padding-left: 15px;
			padding-bottom: 15px;
			padding-right: 15px;
			line-height:1.2;
		}
		.login-box strong{
            
		}
		.input-field{
			padding: 12px;
			width: 90%;
			border:none;
			background:#eeeeee;
			border-radius:10px;
			color:;
			font-weight:;
			margin-bottom:7px;
		}
		h2{

			background-color:;
			width: 100%;
			margin-bottom: 0px;
			padding: 7px;
			color: #222222;
			font-size:25px;
		}
		.submit-btn{
			padding: 12px;
			border-radius: 8px;
			color: white;
			border:none;
			width: 100%;
			font-family: sans-serif;
			cursor: pointer;
			font-size:14px;
			background:#ff4500;

		}
		.submit-btn:hover{
			box-shadow: 2px 3px 5px #ff4500;

		}
		a{
			text-decoration: none;
			color: blue;
			font-size:18px;
		}label{
		    font-size:25px;
		}
		input{
		    font-size:18px;
		}
	</style>
</head>
<body>
	<h1>Parag canteen</h1>
	<center>
		
	<div class="login-box">
		
        <h2>Create Account</h2><br>
		<form id="login" class="input-group" action="otp_verification.php" method="post">

			<!--<label><span><strong>Username:</strong></span></label><br>-->
			<input type="text" class="input-field" placeholder="Username" name="username" required autocomplete="off" minlength="5"><br>
			
		<!--	<label><span><strong>E-mail:</strong></span></label><br>-->
			<input type="email" class="input-field" placeholder="e-mail" name="e-mail" required autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter valid email"><br>
			
		<!--	<label><span><strong>Phone number:</strong></span></label><br>-->
			<input type="tel" class="input-field" placeholder="phone number" name="phonenum" required autocomplete="off" pattern="([0-9]).{9}" title="only numbers of 10 digit"><br>

		<!--	<label><span><strong>Password:</strong></span></label><br>-->
			<input type="password" class="input-field" placeholder="Password" name="password"  required autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br><br>
			
			
		  <!-- <label><span><strong>Confirm Password:</strong></span></label><br>-->
			<input  class="input-field" placeholder="confirm password" name="confirm-password" required autocomplete="off" type="hidden" value="@">
			
		<!--	<label><span><strong>Address:</strong></span></label><br>-->
			<input  class="input-field" placeholder="address" name="address"  required autocomplete="off" value="asdf" type="hidden">
			
			
			
			<button type="submit" class="submit-btn"><b>Create Account</b></button>
			<br>
			<br>
			 have an account? <a href="customers_signin_form.php">Login</a>
			
			
		</form>
	</div>
    </center>
    <br>

</body>
</html>