<?php

  	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

    //starting the session
    session_start();
    if(!isset($_SESSION['username'])){
	    header('location:customers_signin_form.php');
    }

    //connecting to the database
    include "../../include/conn.php";

    //getting the value of user id
    $userId = $_SESSION['username'];
    
    //fetching users ohter details
    $searching_for_details = " select * from customers_details where idOfCustomer='$userId'";
	    $user = mysqli_query($con,$searching_for_details);
	    while ($row = mysqli_fetch_assoc($user)) {
	        //	echo $row['idOfProducts'].$row['numberOfProducts'];
		    $name = $row['nameOfCustomer'];
		    $address = $row['addressOfCustomer'];
	    }
    

    //fetching the cart items from customers_cart
    $searching_for_cart = " select * from customers_cart where idOfCustomer='$userId'";
    $query = mysqli_query($con,$searching_for_cart);
    $search_count = mysqli_num_rows($query);

    //if no item is found in cart
    if($search_count==0){
	    //echo "No item is in your cart";
    }

    //if there are some items in the cart
    else{
	    //get the id of the products from customers_cart
	    $searching_for_user = " select * from customers_cart where idOfCustomer='$userId'";
	    $query_user = mysqli_query($con,$searching_for_user);
	    while ($row = mysqli_fetch_assoc($query_user)) {
	        //	echo $row['idOfProducts'].$row['numberOfProducts'];
		    $length = strlen($row['idOfProducts']);
		    $string = $row['idOfProducts'];
		    $num_product = $row['numberOfProducts'];
		    $quantity = $row['products_quantity'];
	    }
	    // final price initialization
	    $finalPrice=0;

	    //splitting the products in arrays
	    $items = array();
	    $sizeof = array();
		$amount = array();
	    for($i=0; $i<=$length; $i+=8){
		    array_push($items, substr($string, $i,5));
		    array_push($sizeof, substr($string, $i+5,1));
		    array_push($amount, substr($string, $i+6, 2)) ;
	    }
    }
?>


<!-- html tag goes from here -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title></title>
	<meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> 
	<meta name="theme-color" content="#ff4500">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../../others/jquery-3.6.0.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/cart_page.css">
</head>
<body>
    <script>
        const items=[];
        const amount=[];
        const price=[];
        var finalPrice=0;
        var address = "<?php echo $address; ?>";
        <?php
        for ($i=0; $i<sizeof($items);$i++){?>
            items[<?php echo $i; ?>]="<?php echo $items[$i];?>"+"<?php echo $sizeof[$i]; ?>";
            amount[<?php echo $i; ?>] = "<?php echo $amount[$i]; ?>";
            <?php
        }
        ?>
        console.log(items[0]);
        console.log(amount[0]);
    </script>
	<h2 id="headin"><a href = "index.php"><i class="fa fa-long-arrow-left" aria-hidden="true" style="background:transparent;margin-right:10px"></i></a>Your orders</h2>
	<!-- //navigation bar  -->
	<div class="navbar">
		<ul>
			<a href="index.php"><li>  <i class="fa fa-home" style="background:transparent;"></i> </li></a>
			<a href="cart_page.php"><li class="active"><i class="fa fa-shopping-cart" style="background:transparent;"></i></li></a>
			<a href="see-result.php"><li>  <i class="fa fa-th" style="background:transparent;"></i> </li></a>
			<a href="see-result.php"><li>  <i class="fa fa-user" style="background:transparent;"></i> </li></a>	
		</ul>
	</div>
<?php 
    if($search_count==0){ ?>
	    <div id="empty">
	        <i class="fa fa-shopping-bag" aria-hidden="true" style="font-size:80px;background:transparent;color:#999999;"></i><br>
	        your cart is empty..<br>
	        add some items to place your order.
	    </div>
<?php 
    } 
    ?>
	
	
	<?php
	if ($search_count!=0){
     for($i=0 ; $i < $num_product ; $i++){

     	 $q = "select * from products_detail where idOfProduct = '$items[$i]'";
         $query = mysqli_query($con, $q);
         while ($rows = mysqli_fetch_array($query)) {
     	?>

	<div class="product" id="product">
		<div class="detail" id="detail">
			<div class="box" id="box">
				<div class="photo" id="photo"><img src="../../img/product_images/<?php echo $rows['imageName']; ?>" class="product_image"></div>
				<div class="about" id="about">
					<p class ="pname"><?php echo $rows['nameOfProduct']; ?></p>
					<i class="fa fa-trash delete"  id ="<?php echo $items[$i].$sizeof[$i]."d"; ?>" onclick ="deletei(this)"></i>
					<div id="priceChange">
					    
						 <?php 
				        if($rows['quantity1'] != "null"){
				            if($sizeof[$i] =="1"){
		 					echo $rows['quantity1'];
		 						echo " @ <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>";
		 		               	echo $rows['priceOfQuantity1'];
		 	                    	
		 					echo "<br>";
		 					?>
		 					<script>
		 					    price[<?php echo $i ?>]="<?php echo $rows['priceOfQuantity1']; ?>";
		 					</script>
		 					<div class = "changebox">
		 					    <div class = "decrement"  id="<?php echo $items[$i]."10"; ?>" onclick = "myfunction(this)">
		 					        -
		 					    </div>
		 					    <div class = "showAmount" id = "<?php echo $items[$i].$sizeof[$i]; ?>">
		 					        <?php
		 					            echo intval($amount[$i]);
		 					        ?>
		 					    </div>
		 					    <div class="increment" id="<?php echo $items[$i]."11"; ?>" onclick = "myfunctioni(this)">
		 					        +
		 					    </div>
		 					</div>
		 					
		 					
		 				<!--	<input class="quantity_change" type="number" name="input11" value="<?php echo $amount[$i*4]; ?>" id="<?php echo "1".$rows['idOfProduct']; ?>" onfocus="getFunction(this)" onblur="change(this)">-->
		 					<?php 
		 						
		 				}}
		 				?>
		 			  <?php 
				        if($rows['quantity2'] != "null"){
				            if($sizeof[$i] =="2"){
		 					echo $rows['quantity2'];
		 						echo " @ <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>";
		 		               	echo $rows['priceOfQuantity2'];
		 	                    	
		 					echo "<br>";
		 					?>
		 					<script>
		 					    price[<?php echo $i ?>]="<?php echo $rows['priceOfQuantity2']; ?>";
		 					</script>
		 					<div class = "changebox">
		 					    
		 					    <div class = "decrement" id="<?php echo $items[$i]."20"; ?>" onclick = "myfunction(this)">
		 					        -
		 					    </div>
		 					    <div class = "showAmount" id = "<?php echo $items[$i].$sizeof[$i]; ?>">
		 					        <?php
		 					            echo intval($amount[$i]);
		 					        ?>
		 					    </div>
		 					    <div class="increment" id="<?php echo $items[$i]."21"; ?>" onclick = "myfunctioni(this)">
		 					        +
		 					    </div>
		 					</div>
		 					
		 					
		 				<!--	<input class="quantity_change" type="number" name="input11" value="<?php echo $amount[$i*4]; ?>" id="<?php echo "1".$rows['idOfProduct']; ?>" onfocus="getFunction(this)" onblur="change(this)">-->
		 					<?php 
		 						
		 				}}
		 				?><?php 
				        if($rows['quantity3'] != "null"){
				            if($sizeof[$i] =="3"){
		 					echo $rows['quantity3'];
		 						echo " @ <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>";
		 		               	echo $rows['priceOfQuantity3'];
		 	                    	
		 					echo "<br>";
		 					?>
		 					<script>
		 					    price[<?php echo $i ?>]="<?php echo $rows['priceOfQuantity3']; ?>";
		 					</script>
		 					<div class = "changebox">
		 					    <div class = "decrement" id="<?php echo $items[$i]."30"; ?>" onclick = "myfunction(this)">
		 					        -
		 					    </div>
		 					    <div class = "showAmount" id = "<?php echo $items[$i].$sizeof[$i]; ?>">
		 					        <?php
		 					            echo intval($amount[$i]);
		 					        ?>
		 					    </div>
		 					    <div class="increment" id="<?php echo $items[$i]."31"; ?>" onclick = "myfunctioni(this)">
		 					        +
		 					    </div>
		 					</div>
		 					
		 					
		 				<!--	<input class="quantity_change" type="number" name="input11" value="<?php echo $amount[$i*4]; ?>" id="<?php echo "1".$rows['idOfProduct']; ?>" onfocus="getFunction(this)" onblur="change(this)">-->
		 					<?php 
		 						
		 				}}
		 				?>
		 				 <?php 
				        if($rows['quantity4'] != "null"){
				            if($sizeof[$i] =="4"){
		 					echo $rows['quantity4'];
		 						echo " @ <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>";
		 		               	echo $rows['priceOfQuantity4'];
		 	                    	
		 					echo "<br>";
		 					?>
		 					<script>
		 					    price[<?php echo $i ?>]="<?php echo $rows['priceOfQuantity4']; ?>";
		 					</script>
		 					<div class = "changebox">
		 					    <div class = "decrement" id="<?php echo $items[$i]."40"; ?>" onclick = "myfunction(this)">
		 					        -
		 					    </div>
		 					    <div class = "showAmount" id = "<?php echo $items[$i].$sizeof[$i]; ?>">
		 					        <?php
		 					            echo intval($amount[$i]);
		 					        ?>
		 					    </div>
		 					    <div class="increment" id="<?php echo $items[$i]."41"; ?>" onclick = "myfunctioni(this)">
		 					        +
		 					    </div>
		 					</div>
		 					
		 					
		 				<!--	<input class="quantity_change" type="number" name="input11" value="<?php echo $amount[$i*4]; ?>" id="<?php echo "1".$rows['idOfProduct']; ?>" onfocus="getFunction(this)" onblur="change(this)">-->
		 					<?php 
		 						
		 				}}
		 				?>
		 				
		 				
		 				
		 				
		 				
					</div>
					
						<?php 
		$d= "priceOfQuantity".$sizeof[$i];
		#echo $d;
		$lowPrice = $rows[$d]*$amount[$i];
				$finalPrice+=$lowPrice;
		 ?>
		 <div class ="productam" id="<?php echo $items[$i].$sizeof[$i]."m"; ?>"><!--<i class= "fa fa-inr"></i><?php echo $lowPrice; ?>--></div>
		 <script>
		     document.getElementById("<?php echo $items[$i].$sizeof[$i]."m"; ?>").innerHTML=parseInt(amount[<?php echo $i; ?>])*parseInt(price[<?php echo $i; ?>]);
		     finalPrice+=parseInt(amount[<?php echo $i; ?>])*parseInt(price[<?php echo $i; ?>]);
		 </script>
		
					<hr>
				</div>
		    </div>
		   
		</div>

		
	
	</div>
 <?php
    }
     }
    ?>
  <div id="addressbox">
      <strong>Details of new address</strong><strong id = "cancel"><i class="fa fa-times" aria-hidden="true" onclick="closebox()"></i></strong><br><br>
      <input type="text" class="addressinput" id="building" placeholder="Building/flat name *"  required autocomplete="off"><br>
      <input type="text" class="addressinput" id="street" placeholder="street and district name *" autocomplete="off" required ><br>
      <input type="text" class="addressinput" id="landmark" placeholder="landmark if any" autocomplete="off" ><br>
      <input type="checkbox" name="isdefault"  id="makedefault" >Make this as default address<br>
      <button onclick="changed()">Save address</button>
      
  </div>
  <div id="hide"></div>
    <!-- place order menu -->
    <div id="orderPlacing">
        <div class = "deleivery">
           <strong color ="darkbrown"><i class="fa fa-map-marker" aria-hidden="true"></i> Deliver at:</strong> <i style="float:right;margin-right:20px;color:darkred;" onclick="changebox()">change</i><br>
           <div id = "useraddress"></div>
           To:<?php echo $name;?>
        </div>
        <div class = "specs">
    	<div class="totalAmount" id ="finale">
    	Pay: <i class="fa fa-inr" style="background:transparent;"> </i><?php echo $finalPrice;?></strong>
    	</div>
    	<div class="placingButton">
    			<button id="go" onclick="placeOrder()">Place Order</button>
    	</div>
    	</div>
    </div>
    <script>
        document.getElementById("finale").innerHTML=finalPrice;
    </script>
 <?php } ?>
 
 
 <form method="post" id="paytmform" action="../../others/PaytmKit/pgRedirect.php">


					<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "ORDS" . rand(10000,9999999999999999999999)?>">
				
					
					
					<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $userId; ?>">
				
			
					
					<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
			
					<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
				<div id = "bbox">
				<div id="fprice">
				Total Amount: <i class="fa fa-inr" style="background:transparent;"></i>
					<input type="hidden" title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="789" id ="inputPrice">
					
					
		  </div>
		  </div>
	</form>
 
    <!-- script goes here -->
    <script type="text/javascript">

    	function myfunction(quantityId) {
    	    var passed;
    	 var buttonClicked=quantityId.id;
    	 console.log(buttonClicked);
    	 var idOfClicked = buttonClicked.substring(0,6);
    	 console.log(idOfClicked);
    	 var valueClick = document.getElementById(idOfClicked).innerText;
    	 console.log(valueClick);
    		var pass = parseInt(valueClick);
    		if(pass<=99 && pass>=2){
    		console.log(pass);
    		if (pass<=10) {
    			console.log(pass);
    			var passed = idOfClicked+"0"+(pass-1);
    		    
    		}else{
    		    passed=idOfClicked+(pass-1);
    		}
    		let index = items.indexOf(idOfClicked);
    		amount[index]=pass-1;
    		document.getElementById(idOfClicked+"m").innerHTML=parseInt(amount[index])*parseInt(price[index]);
    		finalPrice-=parseInt(price[index]);
    		document.getElementById("finale").innerHTML=finalPrice;
    		console.log(passed);
				$.ajax({
					url:"../processes/quantity_change_process.php",
					method:"post",
					data:{idq:passed},
					success: function getdata(result){
						if (result=="success"){
						    document.getElementById(idOfClicked).innerHTML=pass-1;
						}
					} 
				})
			}else{
				console.log("quantity is greater than 99 0r smaller than 0");
			}
			}
			function myfunctioni(quantityId) {
    	    var passed;
    	 var buttonClicked=quantityId.id;
    	 console.log(buttonClicked);
    	 var idOfClicked = buttonClicked.substring(0,6);
    	 console.log(idOfClicked);
    	 var valueClick = document.getElementById(idOfClicked).innerText;
    	 console.log(valueClick);
    		var pass = parseInt(valueClick);
    		if(pass<=98 && pass>=1){
    		console.log(pass);
    		if (pass<=8) {
    			console.log(pass);
    			var passed = idOfClicked+"0"+(pass+1);
    		    
    		}else{
    		    passed=idOfClicked+(pass+1);
    		}
    		let index = items.indexOf(idOfClicked);
    		amount[index]=pass+1;
    		document.getElementById(idOfClicked+"m").innerHTML=parseInt(amount[index])*parseInt(price[index]);
    		finalPrice+=parseInt(price[index]);
    		document.getElementById("finale").innerHTML=finalPrice;
    		console.log(passed);
				$.ajax({
					url:"../processes/quantity_change_process.php",
					method:"post",
					data:{idq:passed},
					success: function getdatar(result){
						if (result=="success"){
						    document.getElementById(idOfClicked).innerHTML=pass+1;
						}
					} 
				})
			}else{
				console.log("quantity is greater than 99 0r smaller than 0");
			}
			}
			function deletei(quantityId) {
    	    var passed;
    	 var buttonClicked=quantityId.id;
    	 console.log(buttonClicked);
    	 var idOfClicked = buttonClicked.substring(0,6);
    	 $.ajax({
					url:"../processes/quantity_delete_process.php",
					method:"post",
					data:{idq:idOfClicked},
					success: function getdatar(result){
					    console.log(result);
						if (result=="success"){
						   location.reload();
						}
					} 
				})
    	}
    	function changebox(){
    	    document.getElementById("addressbox").style.display="block";
    	}
    	function closebox(){
    	    document.getElementById("addressbox").style.display="none";
    	}
    	document.getElementById("useraddress").innerHTML=address;
    	console.log(address);
    	function changed(){
    	     var building = document.getElementById("building").value;
    	     var street = document.getElementById("street").value;
    	     var landmark= document.getElementById("landmark").value;
    	     address = building+", "+street+" , "+landmark;
    	     document.getElementById("useraddress").innerHTML=address;
    	     $.ajax({
					url:"../processes/address_change_process.php",
					method:"post",
					data:{idq:address},
					success: function getdatar(result){
						if (result=="success"){
						    document.getElementById("addressbox").style.display="none";
						}
					} 
				})
    	}
    	function placeOrder(){
    	    document.getElementById("inputPrice").value = finalPrice;
    	    document.getElementById("paytmform").submit();
    	}

    </script>
</body>
</html>