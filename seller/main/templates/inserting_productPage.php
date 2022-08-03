<?php
	


	session_start();
    if(!isset($_SESSION['username'])){
        header('location:seller_signin_form.php');
    }
    $user = $_SESSION['username'];
    include "../../include/conn.php";
    $items = array();
    $sq = "select menuNumber, menu from seller_details where sellerId='$user'";
    $result = mysqli_query($con, $sq);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $menuNumber = $row['menuNumber'];
    $menu = $row['menu'];
  }
}
$ts="";
for($i=0; $i<strlen($menu); $i++){
	if($menu[$i]=='.'){
		array_push($items,$ts);
		$ts="";
		continue;
	}else{
		$ts = $ts.$menu[$i];
	}
	if($i==strlen($menu)-1){
		array_push($items,$ts);
		$ts="";
	}
}


?>




<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#ff4500">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../../others/jquery-3.6.0.js"></script>
	<style type="text/css">
	#box{
	width: 92%;
	position: fixed;
	bottom: 0;
	background: #fdfdfd;
	padding: 4%;
	border-top: 1px solid gray;	
	height: 90%;
	text-align: center;
	border-radius: 15px;
	transition: 1s;	
	display: none;
	}
	#imgForm{
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
	</style>
</head>
<body>
	<div id="page">
		<?php
			for($q=0; $q<$menuNumber; $q++){
				?>
				<button id="<?php echo "menu".$q; ?>" name="<?php echo $items[$q]; ?>" onclick="add(this)"><?php echo $items[$q]; ?></button><br>
				<?php
			}
		?>
	</div>
	<div id="box">
		<div id = "name"></div>
	<form id="login" class="input-group" action="../processes/insert_product.php" method="post">
			<input type="text" id="pname" class="input-field" placeholder="name of product" name="namep"  required><br><br>
			<input type="text" id="about" class="input-field" placeholder="about product" name="about" required><br><br>
			<input type="text" id="genre" class="input-field" placeholder="genre" name="genre" required><br><br>
			<input type="text" id="q1" class="input-field" placeholder=" first quantity name" name="q1" required>
			<input type="number" id="q1p" class="input-field" placeholder="first quantity price" name="q1p" required><br><br>
			<input type="text" id="q2" class="input-field" placeholder="second quantity name" name="q2" required>
			<input type="number"  id="q2p" class="input-field" placeholder="second quantity price" name="q2p" required><br><br>
			<input type="text" id="q3" class="input-field" placeholder="third quantity name" name="q3" required>
			<input type="text" id="q3p" class="input-field" placeholder="third quantity price" name="q3p" required><br><br>
			<input type="text" id="q4" class="input-field" placeholder="fourth quantity name" name="q4" required>
			<input type="text" id="q4p" class="input-field" placeholder="fourth quantity price" name="q4p" required><br><br>
			
			<input  id="image" class="input-field" placeholder="image" name="image" value="@@" type="hidden" required><br><br>
			
			
			
		</form>
		<button id="btns" onclick ="submit()" class="submit-btn">Insert Product</button>
	</div>
	<div id="imgForm">
		<form action="image_upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="text" id = "imgname" name="name" hidden required>
  <input type="submit" value="Upload Image" name="submit">
</form>
	</div>



<script type="text/javascript">
	var namebuttonClicked;
	function add(quantityId) {
    	    var passed;
    	 var buttonClicked=quantityId.id;
    	 console.log(buttonClicked);
    	 var idOfClicked = buttonClicked.substring(4,5);
    	 console.log(idOfClicked);
    	 namebuttonClicked=quantityId.name;
    	 document.getElementById('name').innerHTML="Add in "+namebuttonClicked;
    	 document.getElementById('box').style.display="block";
    	}

    	 function submit(){
    	 var namep= document.getElementById('pname').value;
    	 var about= document.getElementById('about').value;
    	 var genre= document.getElementById('genre').value;
    	 var q1= document.getElementById('q1').value;
    	 var q2= document.getElementById('q2').value;
    	 var q3= document.getElementById('q3').value;
    	 var q4= document.getElementById('q4').value;
    	 var q1p= document.getElementById('q1p').value;
    	 var q2p= document.getElementById('q2p').value;
    	 var q3p= document.getElementById('q3p').value;
    	 var q4p= document.getElementById('q4p').value;
    	 var image= document.getElementById('image').value;
    	 $.ajax({
					url:"../processes/insert_product.php",
					method:"post",
					data:{menu:namebuttonClicked,namep:namep,about:about,genre:genre,q1:q1,q2:q2,q3:q3,q4:q4,q1p:q1p,q2p:q2p,q3p:q3p,q4p:q4p,image:image},
					success: function getdatar(result){
					    console.log(result);
					    var res = result.substring(25,26);
					    console.log(res);
						if (res==1){
							var imgid = result.substring(0,25);
							console.log(imgid);
							document.getElementById('imgname').value=imgid;
						   document.getElementById('box').style.display="none";
						   document.getElementById('imgForm').style.display="block";
						}
					} 
				})
    	}
</script>



</body>
</html>