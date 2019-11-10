<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['password']);
session_destroy();
header('location: ../index.php');
exit();

//if(session_destroy())
//{
// 	header('location: ../index.php');
//}



unset($_SESSION['fb_token']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);
unset($_SESSION['email_address']);
unset($_SESSION['oauth_uid']);
session_destroy();
header('location: ../index.php');
exit();



?>

