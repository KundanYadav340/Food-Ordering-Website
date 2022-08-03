<?php

	session_start();
    if(!isset($_SESSION['username'])){
        header('location:seller_signin_form.php');
    }
    $orders=0;
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="../../style/seller_home"> -->
	<title>Home page</title>
	<style type="text/css">
		*{
			margin: 0px;
			padding: 0px;
		}
		#heading{
			color: white;
			background: #ff4500;
			padding: 3%;
			width: 94%;
		}
		#empty{
			width: 92%;
			align-self: center;
			text-align: center;
			color: #ff4500;
			background: #f5ebe9;
			border: 1px solid #ff4500;
			padding: 30px 2%;
			margin-top: 40px;
			margin-left: auto;
			margin-right: auto;

		}
		#refresh{
			background: #ff4500;
			color: white;
			padding: 2%;
			width: 30%;
			border: none;
			border-radius: 10px;
		}
		.navbar {
  overflow: hidden;
  background-color: #fff;
  position: fixed;
  bottom: 0;
  width: 100%;
  border-top: 1px solid #ddeedd;
}

.navbar a {
	width: 33.33%;
  float: left;
  display: block;
  color: #908080;
  text-align: center;
  padding: 14px 0px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  border-top: 3px solid #ff4500;
  color: #ff4500;
}

.navbar a.active {
	border-top:3px solid #ff4500 ;
  color: #ff4500;
}

.main {
  padding: 16px;
  margin-bottom: 30px;
}
	</style>
</head>
<body>
	<h2 id="heading">Live orders</h2>

	<div class="navbar">
 		<a href="#home" class="active">Orders</a>
	 	<a href="seller_activity.php">Add</a>
  		<a href="#contact">Account</a>
	</div>


		<?php
	if($orders==0){ ?>
		<div id="empty">
			No live orders are available for now.<br>
			Refresh the page to see new orders.<br><br><br>
			<button id = "refresh" onclick="refresh()">refresh</button>
		</div>
	<?php
	}
	?>



</body>
</html>