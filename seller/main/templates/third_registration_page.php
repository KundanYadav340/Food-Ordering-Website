<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8" /> 

<meta

  name="viewport"

  content="width=device-width, initial-scale=1, maximum-scale=1"/> 

	<meta name="theme-color" content="#ff4500">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../../others/jquery-3.6.0.js"></script>
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
			width: 50%;
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
		#error{
			display: none;
		}
	</style>
</head>
<body>
	<h1>Parag canteen</h1>
	<center>
		
	<div class="login-box">
		
        <h2>Register your restaurant</h2><br>
		<form id="login" class="input-group" action="seller_otp_verification.php" method="post">

			<!--<label><span><strong>User:</strong></span></label><br>-->
			<input id="open" type="time" class="input-field" placeholder="opens at" name="open" required autocomplete="off" ><br>
			
		<!--	<label><span><strong>E-mail:</strong></span></label><br>-->
			<input id="closes" type="time" class="input-field" placeholder="closes at" name="closes"  autocomplete="off"  ><br>
			
		<!--	<label><span><strong>Phone number:</strong></span></label><br>-->
			<input id="shop" type="int" class="input-field" placeholder="per person approx" name="shop" required autocomplete="off"><br>
			
			
		  <!-- <label><span><strong>Confirm Password:</strong></span></label><br>-->
			<input id="cpass"  class="input-field" placeholder="confirm password" name="confirm-password" required autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="hidden">
			<div id="error">password does not match</div><br><br>
		<!--	<label><span><strong>Address:</strong></span></label><br>-->
			<input  class="input-field" placeholder="address" name="address"  required autocomplete="off" value="asdf" type="hidden">
			
			
			
			<div onclick="getOtp()" class="submit-btn"><b>save and next</b></div>
			<br>
			<br>
			 registration completed ? <a href="seller_signin_form.php">Login</a>
			
			
		</form>
	</div>
    </center>
    <br>

    <script type="text/javascript">
    	function getOtp(){
    	var name = document.getElementById('open').value;
    	var description = document.getElementById('closes').value;
    	var location = document.getElementById('shop').value;
    	console.log(name);
    	console.log(description);
    	$.ajax({
				        	url:"../processes/seller_third_registration_process.php",
				        	method:"post",
				        	data:{name:name,description:description,location:location},
				        	success: function (result){
					                                	if(result=="1"){
					                                	      window.location.assign("seller_home_page.php");
					                                	}else{
						                                	
							                                	alert("some error occured");
						                                	
					                                	}
				                                	} 
			        	})
    }
    </script>

</body>
</html>