<?php

//starting the session
session_start();
if(!isset($_SESSION['username'])){
	header('location:customers_signin_form.php');
}

//making connection with database
$con = mysqli_connect('localhost','id15991512_kundan5602','Adnan@123456');
mysqli_select_db($con, 'id15991512_parag_canteen');

//connecting with table products_detail and finding total number of rows in that
$num = mysqli_query($con,"SELECT * FROM products_detail" );
     $num_rows = mysqli_num_rows($num);

?>
<!DOCTYPE html>
<html>
<head>
	<title>home</title>
<meta charset="UTF-8" /> 

<meta

  name="viewport"

  content="width=device-width, initial-scale=1, maximum-scale=1"/> 

	<meta name="theme-color" content="#ff4500">
	<script src="jquery-3.6.0.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	 <!-- styling the page -->
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			background-color: #fff;
			
		}
		.navbar{
		    position:fixed;
		    bottom:0;
			padding-left: 1%;
			padding-right:1%;
			width: 98%;
			margin-bottom: 0px;
			background-color:#fefefe;
			z-index:4;
				box-shadow: 1px 2px 7px #ff4500;
		}
		.navbar ul{
			padding-top: 0px;
			padding-bottom:5px;
			background-color:#fefefe;

		}
		.navbar ul li{
			color: #908888;
			display: inline-block;
			width: 22%;
			text-align: center;
			cursor: pointer;
			border: 1px solid #fefefe;
			padding-top: 2px;
			padding-bottom: 1px;
			font-size: 24px;
			background-color: #fefefe;
			font-weight:bold;

		}
		.navbar ul .active{
            border-top:5px solid #ff4500;
            color:#ff4500;
            font-size:28px;

		}
		.navbar ul li:hover{
			background-color: red;
		}
		.head{
			color: white;
			width: 94%;
			display: inline-block;
			padding: 3%;
			background-color: #ff4500;
			font-size:30px;
		}
		a{
			text-decoration: none;
			background-color: transparent;
			color: #fff;
		}
		.product{
			box-shadow: 1px 2px 5px #ffcc99;
			border-radius: 3px;
			margin-left: auto;
			margin-right:auto;
			margin-top: 10px;
			width: 94%;
			border-top: 1px solid #ffb380;
			border-left:0px solid red;
			border-bottom:1px solid #ffb380;
			padding: 2%;
			background-color:#fffafa;
		}
		.detail h2{
			color: black;
			font-size:18px;
			padding:2px 5px 0px 0px;
		}
		.detail p{
		    color:gray;
		    font-size:12px;
		    padding:0px 0px 7px 5px;
		}
		#veg{
		    float:right;
		    color:#008000;
		    border:2px solid #008000;
		    text-align:center;
		    padding:0px 5px;
		    border-radius:7px;
		}
		#veg i{
		   
		}
		.photo{
			float: left ;
			width: 50%;
			height: auto;
		}
		.product_image{
			width: 90%;
			height: auto;
			border:0px solid #aaaaaa;
			box-shadow: 1px 2px 5px #aaaaaa;
		}
		.price{
			
			width: 98%;
		    background:;
			padding: 2%;
			color: darkred;
			font-size:10px;
		}
		.price span{
		    font-size:15px;
		    font-weight:bold;
		    	padding: 3px;
		    	line-height:1.6;
		}
		.about{
			padding: 1%;
			font-weight: ;
			font-style: italic;
			color: #505050;
			font-size: 12px;
			text-align:justify;
		}
		#add{
			text-align: right;
			padding-right: 3%;
			padding-bottom: 0%;
			margin-top:1%;
		}
		.addbutton{
			color: #000060;
			background:#eeeeee;
			width:45%;
			height:;
			border:none;
			border-radius:5px;
			padding:4px;
			font-size:18px;
		
		}
		.addbutton:hover{
			color:white;
			background-color: green;
		}
		#inform{
 		    margin-left:10%;
 		    margin-right: 10%;
 		    margin-top: 30px;
 		    border-radius: 7px;
 		    padding: 0;
 		    position: top;
  			overflow: hidden;
 			background-color: #333;
 			position: fixed;
 			top: 0;
 			width: 80%;
 			display: block;
            color: white;
            text-align: center;
            padding: 24px 28px;
            text-decoration: none;
            display: none;
            font-size:50px;
		}
		.price span{
		    background-color:;
		    padding:0px;
		}
		hr{
		    width:100%;
		    color:red;
		    opacity:0;
		    z-index:-1;
		}
		#logout{
		    padding:10px;
		    color:black;
		    background-color:#d3d3d3;
		}
		#popularity strong{
		    background:;
		    color:darkgreen;
		    padding:0px;
		    font-size:14px;
		}
		#search{
		    text-align:center;
		}
		#searchbtn{
		    width:95%;
		    margin-top:8px;
		    margin-bottom:8px;
		    margin-left:auto;
		    margin-right:auto;
		    padding:12px;
		    border:1px solid gray;
		    font-size:18px;
		    color:gray;
		    border-radius:10px;
		    text-align:left;
		    box-shadow:1px 1px 3px gray;
		}
		#sorting{
		    width:100%;
		    overflow-x:auto;
		    overflow-y:hidden;
		    white-space:nowrap;
		    padding-bottom:3px;
		    border-bottom:0px solid #ff4500;
		    box-shadow:1px 2px 4px #aaaaaa;
		}
		#sorting::-webkit-scrollbar{
		    display:none;
		}
		.sorted{
		    border:1px solid #ff4500;
		    padding:2px;
		    color:#ff4500;
		    border-radius:4px;
		    margin:0px 2px 0px 0px ;
		}
		.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 300px;
}
#st{
    height:90px;
    display:none;
}
	</style>
	<!-- //styling ends here -->
</head>
<body>

	<!-- //heading of the top -->
	<h1 class="head">
		Parag Canteen
	</h1>
	<div id="search-bar">
        <input id="input-box" type="text" placeholder="search dish name or products" >
    </div>
    
    
    
 
	<div id ="search">
	    <a href="search.php">
	    <button id="searchbtn"> <i class="fa fa-search"></i> Search dish, restaurant and more</button>
	    </a>
	    <div id="sorting">
	       <a href=""><button class="sorted">Paneer</button></a>
	       <a href=""><button class="sorted">Pizza</button></a>
	       <a href=""><button class="sorted">Dosa</button></a>
	       <a href=""><button class="sorted">Samosa</button></a>
	       <a href=""><button class="sorted">Palak paneer</button></a>
	       <a href=""><button class="sorted">Poha</button></a>
	       <a href=""><button class="sorted">deserts</button></a>
	       <a href=""><button class="sorted">Paneer</button></a>
	       <a href=""><button class="sorted">Paneer</button></a>
	       <a href=""><button class="sorted">Samosa</button></a>
	       <a href=""><button class="sorted">Palak paneer</button></a>
	       <a href=""><button class="sorted">Poha</button></a>
	       <a href=""><button class="sorted">deserts</button></a>
	       <a href=""><button class="sorted">Paneer</button></a>
	       <a href=""><button class="sorted">Paneer</button></a>
	    </div>
	</div>
	
	
<!--	<form  class="input-group" action="customers_logout_process.php" method="post">
		<button type="submit" id ="logout">
			logout
		</button>
	</form> -->

	<!-- //navigation bar  -->
	<div class="navbar">
		<ul>
			<li  class="active">  <i class="fa fa-home" style="background:transparent;"></i> </a></li>
			<a href="cart_page.php"><li><i class="fa fa-shopping-cart" style="background:transparent;"></i></li></a>
			<a href="see-result.php"><li>  <i class="fa fa-th" style="background:transparent;"></i> </li></a>
			<a href="see-result.php"><li>  <i class="fa fa-user" style="background:transparent;"></i> </li></a>
			
		</ul>
	</div>
	<div id="st">
	    
	</div>

    <!-- //printing the available products one by one -->
	<?php
     for($i=1 ; $i <= $num_rows ; $i++){

     	 $q = "select * from products_detail where keyOfProduct = $i";
         $query = mysqli_query($con, $q);
         while ($rows = mysqli_fetch_array($query)) {
     	?>
    <div class="content">
	<div class="product" id="product">
		<div class="detail" id="detail">
		    	<div id="veg"><i class="fa fa-leaf" style="font-size:10px;background:transparent;"></i></div>
			<h2><?php echo $rows['nameOfProduct']; ?></h2>
			<p>parag canteen</p>
		
			<div class="box" id="box">
				<div class="photo" id="photo"><img src="product_images/<?php echo $rows['imageName']; ?>" class="product_image"></div>
				<div class="about" id="about"><?php echo $rows['aboutProduct'];?><br>
				 <div class="price" id="price">
		      <span>
		          
		 		 <?php 
				if($rows['quantity1'] != "null"){
		 		//	echo $rows['quantity1']; 
		 			echo " <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>";
		 			echo $rows['priceOfQuantity1'];
		 		//	echo " | ";
		 		}
		 	/*	if($rows['quantity2'] != "null"){
		 			echo $rows['quantity2'] ;
		 			echo " - <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>"; 
		 			echo $rows['priceOfQuantity2'];
		 			echo " | ";
				}
				if($rows['quantity3'] != "null"){
		 			echo $rows['quantity3'] ; 
		 			echo " - <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>";
		 			echo $rows['priceOfQuantity3'];
		 			echo " | ";
		 		}
			   if($rows['quantity4'] != "null"){
		 			echo $rows['quantity4'] ; 
		 			echo " - <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>";
		 			echo $rows['priceOfQuantity4'];
		 		}*/
				 ?> 
			  </span>
			</div>
			<div id="popularity">
			    <strong> 4.2 <i class="fa fa-star" style="font-size:12px;background:transparent;"></i>  </strong>  
			    (2,789)
			</div><br>
				<div class="add" id="add">
			<button class="addbutton" id="<?php echo $rows['idOfProduct'] ?>" onclick="find(this.id)" style=""> <i class="fa fa-cart-plus" style="font-size:22px;background:transparent;"></i> add to cart</button>
		</div>
				</div>
		    </div>
		    
		    <hr>
		</div>

		<!-- //button to add the item in the cart -->
		

	</div>
 <?php
    }
     }
    ?>
    	</div>
		<form  class="input-group" action="customers_logout_process.php" method="post">
		<button type="submit" id ="logout">
			logout
		</button>
	</form>
	<div id="ghf" style="height:60px;"></div>
    <!-- //printing the product detail end here -->

    <!-- //Logout button which post data to customers_logout_process.php  -->
	

	<!-- //informing user if any item is added to the cart -->

	<div id="inform">
		One item added to Cart...
	</div>
     
     <!-- //getting session username name for testing -->


    	<!-- //script for sending the selected product id to the testing.php file -->
		<script type="text/javascript">
			function find(productId) {
				$.ajax({
					url:"addToCart.php",
					method:"post",
					data:{idp:productId},
					success: startfunction () 
				})
				}
				function startfunction(){
					var x = document.getElementById("inform");
							x.style.display="block";
							hide();
				}
				function hide(){
					setTimeout(function(){
						var x = document.getElementById("inform");
							x.style.display="none";},1500);
				}
		</script>
		<script>
		   
window.onscroll = function() {myFunction()};
	var y = document.getElementById("st");
var navbar = document.getElementById("search");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky");
    y.style.display="block";
  } else {
    navbar.classList.remove("sticky");
    y.style.display="none";
  }
}
</script>

   
    <script>
        document.getElementById("input-box").addEventListener("change", searching);
        function searching(){
           var string = document.getElementById("input-box").value;
           
        }
    </script>
		
</body>
</html>
