<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../others/PHPMailer/src/Exception.php';
    require '../../others/PHPMailer/src/PHPMailer.php';
    require '../../others/PHPMailer/src/SMTP.php';

    session_start();
    /*header('location:formpage.php');*/
    include "../../include/conn.php";
    //getting the form data
    $firstname = $_POST['username'];
    $password= $_POST['password'];
    $confirmpassword= $_POST['confirm-password'];
    $email= $_POST['e-mail'];
    $phon= $_POST['phonenum'];
    $address= $_POST['address'];

    //checking whether the email is already registered or not
    $q = " select * from seller_details where mobile='$phon'";
    $result = mysqli_query($con,$q);
    $num = mysqli_num_rows($result);
    if($num==1){        //if email exist
    	echo "This phone number is already registered";
    }else{          //if email does not exist

        //generating otp
        $address= $_POST['address'];
        $otp=rand(100000,999999);
        $process="signup";
        $st=0;      //this is for status of otp
        //deleting if any previous otp exist
        $sql="delete from otp_verification where email='$email'";
    	mysqli_query($con,$sql);
        //temporarily inserting otp in datatbase
        $qy="insert into otp_verification(email, useFor, otp, status) values ('$email','$process','$otp','$st')";
        $insert=mysqli_query($con,$qy);
        if($insert){	
            //mailing
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
             //Server settings
             //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
             $mail->isSMTP();                                            //Send using SMTP
             $mail->Host       = 'smtp-relay.sendinblue.com';                     //Set the SMTP server to send through
             $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
             $mail->Username   = 'ky4154247@gmail.com';    // 'kundan.yadav.5602@gmail.com';                SMTP username
             $mail->Password   = 'QvfFwJbt4UID07CE';     // 'FhxKbLD8QgrJ3U1v';                         //SMTP password
             $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
             $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
             //Recipients
             $mail->setFrom('ky4154247@gmail.com', 'Mailer');
             $mail->addAddress($email, $firstname);     //Add a recipient
             $mail->addAddress('noreply@parag.com');               //Name is optional
             $mail->addReplyTo('noreply@parag.com', 'Information');
             $mail->addCC('noreply@reply.com');
             $mail->addBCC('noreply@replye.com');
             //Attachments
             // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
             // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
             //Content
             $mail->isHTML(true);                                  //Set email format to HTML
             $mail->Subject = 'OTP for account creation';
             $mail->Body    = 'Your one time password for registering on Parag Canteen is:<br><b style="color:red;">'. $otp.'</b><br>If this is not you <a href="kundanacademy.000webhostapp.com/otp_reporting.php">report us</a>';
             $mail->AltBody = 'your one time password for registering on parag canteen is :'.$otp;
             $mail->send();
                 echo '<h3 id="head">An OTP has been sent to your email:<h3>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
             }
        }
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8" /> 

<meta

  name="viewport"

  content="width=device-width, initial-scale=1, maximum-scale=1"/> 

                <meta name="theme-color" content="#ff4500">
	            <title>
	            </title>
            	<style type="text/css">
	            	#box{
		            	margin: auto;
		               	padding: 2%;
		            	border-radius: 1px solid gray;
		            	text-align:center;
	            	}
	            	#iotp{
		            	font-size: 25px;
		               	color: blue;
		               	border:4px solid blue;
		            	border-radius: 8px;
		            	width: 70%;
		            	margin:auto;
		            	padding:10px;
		            	font-weight:bold;
		            }
		            #vbtn{
		                width:70%;
		                font-size:20px;
		                padding:12px;
		                background:#ff4500;
		                color:white;
		                font-weight:bold;
		                border-radius:8px;
		                border:none;
		            }
		            #head{
		                margin-top:30px;
		                text-align:center;
		                font-size:35px;
		                color:green;
		            }
		            #lb{
		                font-size:25px;
		                
		            }
		            #resend{
		                font-size:20px;
		                color:#aaaaaa;
		            }
		            #place{
		                font-size:20px;
		                color:red;
		            }
		            .rbtn{
		                color:blue;
		            }
		            #redirect{
		                display:none;
		                text-align:center;
		                margin-top:70px;
		                padding:10px;
		                color:#ff4500;
		                
		            }
		            #redirect p{
		                font-size:20px;
		                color:#ff4500;
		                text-align:justify;
		            }
		            #redirect a{
		                color:darkblue;
		            }
		            #home{
		                font-size:20px;
		                width:75%;
		                padding:10px;
		                background:#ff4500;
		                color:white;
		                border-radius:5px;
		                border:none;
		            }
        	    </style>
        	    <script src="../../others/jquery-3.6.0.js"></script>
            </head>
            <body>
                <div id ="redirect">
                    Great........<br>
                    <p>
                    Your account is created now you can register your restaurant. We are eagerly waiting to help you...
                    </p>
                    <a href="second_registration_page.php">Let's register</a><br><br><br>
                   
                </div>
                	<div id="place">
	            	    
	            	</div>
            	<div id="box">
	            	<label id="lb">Enter OTP:</label><br><br>
	            	<input id="iotp" type="number" name="iotp" required><br><br>
	            	<button id="vbtn" name="verify" >Verify</button><br><br><br>
	            	<span id="resend">Did not get any otp?  <b class="rbtn">resend otp</b></span><br><br><br><br>
	            	<div id="error">
	            	if the otp is not sent to your gmail then insert this otp : <?php echo $otp; ?>
	            	</div>
            	</div>
                 <!--javascript code goes here-->
            	<script type="text/javascript">
		            document.getElementById('vbtn').onclick=function(){verift()};
	            	function verift(){
		            	var iotp = document.getElementById('iotp').value;
			            console.log(iotp);
		            	console.log("<?php echo $email; ?>" );
		            	$.ajax({
				        	url:"../processes/seller_first_registration_process.php",
				        	method:"post",
				        	data:{otp:iotp,email:"<?php echo $email;?>",user:"<?php echo $firstname;?>",pass:"<?php echo $password;?>",cpass:"<?php echo $confirmpassword;?>",ph:"<?php echo $phon;?>",ad:"<?php echo $address;?>"},
				        	success: function (result){
					                                	if(result=="1"){
					                                	      <?php
					                                	        
					                                	      ?>
					                                	      document.getElementById("redirect").style.display="block";
							                                 document.getElementById("box").style.display="none";
							                                 document.getElementById("head").style.display="none";
							                                 document.getElementById("place").style.display="none";
					                                	}else{
						                                	if(result=="2"){
							                                   	window.alert("already registered");
						                                 	}else{
							                                	document.getElementById("place").innerHTML="The OTP is invalid or expired";
						                                	}
					                                	}
				                                	} 
			        	})
	            	}
	            </script>
            </body>
        </html>
<?php
    } 
?>