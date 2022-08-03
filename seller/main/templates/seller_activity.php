<?php

	session_start();
    if(!isset($_SESSION['username'])){
        header('location:seller_signin_form.php');
    }
    

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#ff4500">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../../others/jquery-3.6.0.js"></script>
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
.box{
	width: 94%;
	border: 1px solid gray;
	margin-left: auto;
	margin-right: auto;
	margin-top: 20px;
	border-radius: 5px;
}
.subhead{
	width: 96%;
	padding: 2% 2%;
	color: #303030;
	border-bottom: 3px solid #ff4500;

}
.what{
	padding: 2%;
	padding-left: 4%;
	color: #505050;
	border-bottom: 1px solid #eeeeee;
}
#newmenu{
	width: 92%;
	position: fixed;
	bottom: 0;
	background: #fdfdfd;
	padding: 4%;
	border-top: 1px solid gray;	
	height: 50%;
	text-align: center;
	border-radius: 15px;
	transition: 1s;
	display: none;
}
#menuName{
	margin-top: 50px;
	width: 80%;
	padding: 8px;
	border: 1px solid gray;
	border-radius: 10px;
}
#addMenu{
	padding: 8px;
	width: 60%;
	color: white;
	background: #ff4500;
	border-radius: 10px;
}
#close{
	float: right;
	float: top;
	margin-top: 10px;
	margin-right: 10px;
	color: red;
}
#status{
	margin-top: 40px;
	display: none;
}
	</style>
</head>
<body>
	<h2 id="heading">Add and edit</h2>

	<div class="navbar">
 		<a href="seller_home_page.php">Orders</a>
	 	<a href="seller_activity.php" class="active">Add</a>
  	<a href="#contact">Account</a>
	</div>

		<div id="add" class="box">
		<h3 class="subhead">Adding</h3>
		<div onclick="Open()" class="what">Add a new menu item</div>
		<div class="what"><a href="inserting_productPage.php">Add a new product</a></div>
	</div>
	<div id="edit" class="box">
		<h3 class="subhead">Editing and deleting</h3>
		<div class="what">Edit a menu item</div>
		<div class="what">Edit a listed product</div>
		<div class="what">delete a menu item</div>
		<div class="what">delete a listed product</div>
	</div>


	<div id="newmenu">
		<div id="close" onclick="Close()">close</div>
		<div id="status"></div>
		<input id="menuName" type="text" autocomplete="off" required minlength="5" placeholder="enter menu name"><br><br><br>
		<button id="addMenu" onclick="add()">Add menu</button>
	</div>




	<script type="text/javascript">
		function Open() {
			document.getElementById('newmenu').style.display="block";
		}
		function Close() {
			document.getElementById('newmenu').style.display="none";
		}
		function add(){
			var menuName = document.getElementById('menuName').value;
			if(menuName.length>=5){
				$.ajax({
				        	url:"../processes/adding_menu_item.php",
				        	method:"post",
				        	data:{name:menuName,},
				        	success: function (result){
					                                	if(result=="1"){
					                                	     document.getElementById('status').innerHTML="Your menu have been updated";
																								document.getElementById('status').style.display="block";
																								document.getElementById('menuName').value=""; 
					                                	}else if(result==3){
						                                	document.getElementById('status').innerHTML="This item is already in your menu";
																								document.getElementById('status').style.display="block";
							                                	
						                                	
					                                	}else{
					                                		alert("some error occured");
					                                	}
				                                	} 
			        	})

			}else{
				document.getElementById('status').innerHTML="The length of the name should be greater than 5";
				document.getElementById('status').style.display="block";
			}
		}
	</script>
</body>
</html>