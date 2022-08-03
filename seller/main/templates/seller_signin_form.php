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
		
		}
		h1{
			background-color: #ff4500;
			color: white;
			text-align: center;
			padding: 2%;
			font-size:35px;
			width:96%;
		}
		.login-box{
			box-shadow: 1px 2px 7px #ff4500;
			width: 84%;
			height: auto;
			padding-left: 20px;
			padding-top:25px;
			padding-bottom: 20px;
			padding-right: 20px;
			text-align:center;
			margin-top:38%;
			margin-bottom:;
		
		}
		label{
            font-size:20px;
            margin-top:0px;
		}
		.input-field{
			padding: 13px;
			width: 90%;
		}
		h2{

			background-color: ;
			width: 100%;
			margin-bottom: 0px;
			margin-left:auto;
			margin-right:auto;
			padding: 8px;
			color: #ff4500;
			font-size:32px;
			text-align:center;
		}
		.submit-btn{
			padding: 10px;
			border-radius: 8px;
			color: white;
			border:1px solid red;
			width: 100%;
			font-family: sans-serif;
			cursor: pointer;
			font-size:18px;
			background:#ff4500;

		}
		.submit-btn:hover{
            box-shadow: 1px 2px 5px #ff4500;
		}
		a{
			text-decoration: none;
			color: blue;
			font-size:16px;
		}
		input{
		    font-style:sans-serif;
		    font-size:18px;
		    color:;
		    font-weight:;
		    border:none;
		    border-radius:10px;
		    background:#eeeeee;
		}
		hr{
		    margin:10px 0px;
		}
	</style>
</head>
<body>
<!--	<h1>Parag canteen</h1>-->
	<center>
		
	<div class="login-box">
		
        <h2>Parag Canteen seller</h2><br>
		<form id="login" class="input-group" action="../processes/seller_signin_process.php" method="post">
			<!--<label><span><strong>Email:</strong></span></label>--><br>
			<input type="phonenum" class="input-field" placeholder="mobile number" name="phone" required autocomplete="off"><br><br>
		<!--	<label><span><strong>Password:</strong></span></label>-->
			<input type="password" class="input-field" placeholder="Password" name="password"  required autocomplete="off"><br><br>
			
			<button type="submit" class="submit-btn"><b>Log in</b></button>
			<br>
			<br>
	
			
			
		</form>
		forgotten login details? <a href="">get help</a><br><hr>
		not registered yet? <a href="first_registration_page.php">register now</a><br><br>
	</div>
    </center>
</body>
</html>