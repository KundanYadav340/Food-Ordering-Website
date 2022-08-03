<?php

//starting the session
session_start();
if(!isset($_SESSION['username'])){
	header('location:customers_signin_form.php');
}

//making connection with database
include "../../include/conn.php";

//connecting with table products_detail and finding total number of rows in that
$num = mysqli_query($con,"SELECT * FROM products_detail" );
     $num_rows = mysqli_num_rows($num);

?>
<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<meta lang="en">
	<meta charset="UTF-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> 
	<meta name="theme-color" content="#ff4500">
	<script src="../../others/jquery-3.6.0.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- styling the page -->
	<link rel="stylesheet" type="text/css" href="../../style/index.css">
	<!-- //styling ends here -->
</head>
<body>

	<!-- //heading of the top -->
	<h1 class="head">
		Parag Canteen
	</h1>
	<div id ="search">
	    <a href="search.php">
	    <button id="searchbtn"> <i class="fa fa-search"></i> Search dish, restaurant and more</button>
	    </a>
	  <!--  <div id="sorting">
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
	    </div>-->
	</div>
		<div id="st">
	    
	</div>
	<div id = "offers">
	    <img src="../../img/offers/offerp.png" class="offerImage" alt="image">
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
		    	<div id="veg"><i class="fa fa-leaf" style="font-size:8px;background:transparent;"></i></div>
			<h2><?php echo $rows['nameOfProduct']; ?></h2>
			<p>parag canteen</p>
		
			<div class="box" id="box">
				<div class="photo" id="photo"><img src="../../img/product_images/<?php echo $rows['imageName']; ?>" class="product_image" alt="image"></div>
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
		<form  class="input-group" action="../processes/customers_logout_process.php" method="post">
		<button type="submit" id ="logout">
			logout
		</button>
	</form>
	<div id="ghf" style="height:60px;"></div>
    <!-- //printing the product detail end here -->

    <!-- //Logout button which post data to customers_logout_process.php  -->
	

	<!-- //informing user if any item is added to the cart -->

	<div id="inform">
		
	</div>
	
	
	
	<div id="sizeshow">	
    		<form id="options">
    			
    			<div id="fbox"></div>
    			
    			
    		</form>
    		<table id="outside">
    		    <tr>
    		        <td>
    		<table id="inside">
    			<tr>
    				<td><button id="btn-decrease" onclick="decrease()">-</button></td>
    				<td><input  type="number" name="show" id="show" min="1" value="1"></td>
    				<td><button id="btn-increase" onclick="increase()">+</button></td>
    			</tr>
    		</table>
    		</td>
    		<td>
    		<input type="button" id="insert-btn" value="add" onclick="myFunction()">
    		</td>
    		</tr>
    		</table>
    		<div id="dt"></div>
    		<div id="status"></div>
    	</div>
     
     <!-- //getting session username name for testing -->


    	<!-- //script for sending the selected product id to the testing.php file -->
		<script type="text/javascript">
		var idqi = "";
			function openNav() {
			     document.getElementById("sizeshow").style.height = "300px";
		document.getElementById("sizeshow").style.display = "block";	    
 
  
}
			function find(productId) {
				openNav();
				idqi = productId;
				$.ajax({
					url:"../processes/size_showing.php",
					method:"post",
					data:{idp:productId},
					success: function startfunction(result){
						document.getElementById("fbox").innerHTML = result;
					}
				})
				}
			
		</script>
		<script>
		   
window.onscroll = function() {myFunctionsc()};
	var y = document.getElementById("st");
var navbar = document.getElementById("search");
var sticky = navbar.offsetTop;

function myFunctionsc() {
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
    	var quantity=1;
	function decrease(){
		if(quantity>1){
		quantity--;
		document.getElementById('show').value=quantity;
	}
	}
	function increase(){
		quantity ++;
		document.getElementById('show').value=quantity;
	
	}
		function myFunction() {

			var size=0;
			if(document.getElementById('q1')!=null){
				if(document.getElementById('q1').checked){
				size=1;
				}
			}
			if(document.getElementById('q2')!=null){
				if(document.getElementById('q2').checked){
				size=2;
				}
			}
			if(document.getElementById('q3')!=null){
				if(document.getElementById('q3').checked){
				size=3;
				}
			}
			if(document.getElementById('q4')!=null){
				if(document.getElementById('q4').checked){
				size=4;
				}
			}

		//document.getElementById('dt').innerHTML=size;
		console.log(size);
		var inserting_quantity="";
		if(quantity<10){
			inserting_quantity = "0"+quantity.toString();
		}else{
			inserting_quantity = quantity.toString();
		}
		var idq_insert = idqi + size + inserting_quantity;
		console.log(idq_insert);

		$.ajax({
					url:"../processes/inserting_in_cart.php",
					method:"post",
					data:{value:idq_insert},
					success:function startfunctions(result){
					   document.getElementById("inform").style.display="block";
					    if(result == 1){
						document.getElementById("inform").innerHTML="item already exist in cart<br>go to cart if you want to change quantity";
					    }else{
					        if(result==2){
					            	document.getElementById("inform").innerHTML="item added to cart";
					        }else{
					            	document.getElementById("inform").innerHTML="there is some error in adding to cart";
					        }
					    }
					    
					     const mytimeout = setTimeout(informing, 2000);
					    function informing(){
					        document.getElementById("inform").style.display="none";
					    }
					   
					}
					
				})
				document.getElementById("sizeshow").style.height = "0px";
				document.getElementById("sizeshow").style.display = "none";	
				quantity=1;

		}

</script>
		
</body>
</html>
