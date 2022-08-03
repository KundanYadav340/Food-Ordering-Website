<?php

session_start();
session_destroy();
header('location:../templates/customers_signin_form.php');


?>