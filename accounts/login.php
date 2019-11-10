<?php

include '../db.php' ; 
session_start();
if(isset($_POST['login_submit']))
{
if(!empty($_POST['username']) && !empty($_POST['password']))
{
$username = mysqli_real_escape_string($conn,$_POST['username']);// sql injection function
$password= mysqli_real_escape_string($conn,$_POST['password']);
$sql="SELECT * FROM registration where email_address='$username' && password='$password'";
if($result=mysqli_query($conn,$sql)){
	while ($rows = mysqli_fetch_assoc($result)) {
		
	$count=mysqli_num_rows($result);
	
$_SESSION['role'] = $rows['role'];

}
	if($count==1)
{
$_SESSION['user'] =$username;  // create session
$_SESSION['password']= $password;


if($_SESSION['role'] == 'admin')
//if ($rows['role']=="admin")
			{ 
 
                               	header('location:../admin/index.php');
                             
			}

			if ($_SESSION['role'] == 'subscriber')
			{ 
                              // $_SESSION['role']=$rows['role'];
 
                          	header('location:../subscriber/profile.php');
 
			}
			else{}


}


else{
header('location:../index.php?login_error=wrong');

}
}
else
{
header('location:../index.php?login_error=query_error');
}
}
else{
	header('location: ../index.php?login_error=empty');
}
}
else{


}

?>