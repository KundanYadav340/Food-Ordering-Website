<?php
	// header("Pragma: no-cache");
	// header("Cache-Control: no-cache");
	// header("Expires: 0");
	
	
	// $custid=$_REQUEST['custid'];
	// $am=$_REQUEST['am'];
	$custid = "wer3456";
	$am=50;
	
	//change code below this
	
	//starting the session
// session_start();
// if(!isset($_SESSION['username'])){
// 	header('location:customers_signin_form.php');
// }

//connecting to the database
// $con = mysqli_connect('localhost','id15991512_kundan5602','Adnan@123456');
// if ($con) {
// }else{
// 	echo" no connection";
// }
// mysqli_select_db($con, 'id15991512_parag_canteen');
include "../../include/conn.php";

//getting the value of user id
//$userId = $_SESSION['username'];
$userId = "absw21345";

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
	for($i=0; $i<=$length; $i+=5){
		array_push($items, substr($string, $i,5));
	}
	//echo "...".$items[2];

	//splitting the quantity in arrays
	$amount = array();
	for($i=0; $i<strlen($quantity); $i+=9){
		$instring = substr($quantity, $i,$i+9);
		//echo $instring;
		for ($j=1; $j <=8 ; $j+=2) { 
			array_push($amount, substr($instring, $j, 2)) ;
		}
	}
	//echo $amount[4];
	
}

	
	
	
	
//PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"
?>
<!DOCTYPE html >
<html>
<head>
<title>Check Out Page</title>
<meta charset="utf-8">;
    <style>
    h1{
        background:#ff4500;
        font-size:30px;
        color:white;
        padding:10px;
    }
    *{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			background-color: #efefef;
			font-size:10px;
		}
		
		
		
	
	

		a{
			text-decoration: none;
			background-color: transparent;
			color: #fff;
		}
		
		
		
		
		
	
		.product{
			box-shadow: 5px 10px 8px #ffcc99;
			border-radius: 3px;
			margin: 1%;
			margin-top: 15px;
			margin-left:auto;
			margin-right:auto;
			width: 90%;
			border: 2px solid #ff4500;
			padding: 1%;
		}
		.detail h2{
			color: black;
			font-size:22px;
		}


		.about{
			padding: 1%;
			font-weight: ;
			font-style: italic;
			color: gray;
			font-size: 16px;
		}
		.add{
			text-align: right;
			padding-right: 3%;
			padding-bottom: 2%;
		}
	

		.add{
			text-align: left;
		}
		.about{
			font-family: #aaaaaa;
			color: blue;
			padding-top: 0px;
			font-size:16px;
		}
		 #priceChange{
            font-size:18px;
            line-height:1.4;
            font-style:none;
        }

	
		

 
        hr{
            width:100%;
            color:red;
            opacity:.4;
        }
        .about h4{
            font-size:20px;
        }
   
        #hide{
            height:120px;
        }
        #productam{
            display:block;
        	color: darkred;
        	background-color: #bbbbbb;
        	padding: 5px;
        	text-align: center;
        	width: 60%;
        	font-size:18px;
        	font-weight:bold;
        	margin-left:35%;
        }
        #location{
            margin:auto;
            width:90%;
            padding:3%;
            border:3px solid gray;
            text-align:center;
            flex:flex;
        }
        #bbox{
           width:100%;
           position:fixed;
           bottom:0;
        }
        #fprice{
            width:96%;
            font-size:22px;
            background:#101010;
            color:white;
            text-align:center;
            padding:10px;
        }
        #plbtn{
            float:right;
            background:darkgreen;
            width:30%;
            font-size:28px;
            padding:4px;
            text-align:center;
            color:white;
            padding-right:20px;
            

        }
 
</style>
</head>
<body>
	<h1>Check Out details</h1>
	
	<!-- change code between this -->
	
	
	<?php
	for($i=0 ; $i < $num_product ; $i++){

     	 $q = "select * from products_detail where idOfProduct = '$items[$i]'";
         $query = mysqli_query($con, $q);
         while ($rows = mysqli_fetch_array($query)) {
     	?>

	<div class="product" id="product">
		<div class="detail" id="detail">
			<h2><?php echo $rows['nameOfProduct']; ?></h2><hr>
			<div class="box" id="box">
				<div class="about" id="about">
					<h4>Quantity</h4>
					<div id="priceChange">
						 <?php 
				        if($rows['quantity1'] != "null"){
				            if($amount[$i*4]!=0){
		 					echo $rows['quantity1']."  X  ".$amount[$i*4]." = ".$amount[$i*4]." X ".$rows['priceOfQuantity1']." = <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>".$rows['priceOfQuantity1']*$amount[$i*4];
		 				

		 					echo "<br>";
				            }
		 				}
		 				if($rows['quantity2'] != "null"){
		 				    if($amount[$i*4+1]!=0){
		 					echo $rows['quantity2']."  X  ".$amount[$i*4+1]." = ".$amount[$i*4+1]." X ".$rows['priceOfQuantity2']." = <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>".$rows['priceOfQuantity2']*$amount[$i*4+1];
		 				
		 				
		 					echo "<br>"; 
		 				    }
		 				}
		 				if($rows['quantity3'] != "null"){
		 				    if($amount[$i*4+2]!=0){
		 					echo $rows['quantity3']."  X  ".$amount[$i*4+2]." = ".$amount[$i*4+2]." X ".$rows['priceOfQuantity3']." = <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>".$rows['priceOfQuantity3']*$amount[$i*4+2];
		 				
		 					
		 					echo "<br>"; 
		 				    }
		 				}
		 				if($rows['quantity4'] != "null"){
		 				    if($amount[$i*4+3]!=0){
		 					echo $rows['quantity4']."  X  ".$amount[$i*4+3]." = ".$amount[$i*4+3]." X ".$rows['priceOfQuantity4']." = <i class=\"fa fa-inr\" style=\"background:transparent;\"></i>".$rows['priceOfQuantity4']*$amount[$i*4+3];
		 				
		 				
		 					echo "<br>";
		 				    }
		 				}
		 				?>
		 				
					</div>
				</div>
		    </div>
		   
		</div>

		<!-- //button to delete the item from the cart -->
	
		<?php $lowPrice = $rows['priceOfQuantity1']*$amount[$i*4]+$rows['priceOfQuantity2']*$amount[$i*4+1]+$rows['priceOfQuantity3']*$amount[$i*4+2]+$rows['priceOfQuantity4']*$amount[$i*4+3]; 
				$finalPrice+=$lowPrice;
		 ?>
		<div id="productam"><?php echo "Rs. ".$lowPrice; ?></div>
	</div>
 <?php
    }
     }
    ?>
  
  <div id="hide"></div>
    <!-- place order menu -->
   
	<div id="location">
	    <div id="address">
	        deleiver at:
	    </div>
	    <div id="change_address">
	        <button>change address</button>
	    </div>
	</div>
	
	
	
	
	
	<!-- sensitive information -->
	<pre>
	</pre>
	<form method="post" action="pgRedirect.php" id="paytmform">


					<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "ORDS" . rand(10000,99999999)?>">
				
					
					
					<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $custid; ?>">
				
			
					
					<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
			
					<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
				<div id = "bbox">
				<div id="fprice">
				Total Amount: <i class="fa fa-inr" style="background:transparent;"></i>
					<input type="hidden" title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="<?php echo $am; ?>">
						<?php echo $am ?>
					
			
			
					<!-- <input id="plbtn" value="Proceed" type="submit"	onclick=""> -->
		  </div>
		  </div>
	</form>
	<input id="plbtn" value="proceed" onclick="placeOrder()">
	<script type="text/javascript">
		function placeOrder(){
    	    
    	    document.getElementById("paytmform").submit();
    	}
	</script>
</body>
</html>