<?php

include '../db.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
</head>

<body>
<div class="container">
<div class="col-md-8">
<h1>Forget Password</h1>

<?php

include '../db.php';
$msg ='';
echo $msg; 

if(isset($_POST['forget_password']))
{
	$email = $_POST['f_email'];
	$sql="SELECT * FROM registration where email_address = '$email'";
	$run_sql= mysqli_query($conn,$sql);
  while ($rows = mysqli_fetch_assoc($run_sql)) {
	if(mysqli_num_rows($run_sql) == 1 )
	{
     $id = $rows['reg_id'];
    $code = md5(uniqid(rand()));
	 
	 //$update_query = "UPDATE registration SET password = $code where email_address = $email";	 
    $update_query = "UPDATE registration SET password = '$code' where reg_id = '$id'";   
      $run_update_query = mysqli_query($conn,$update_query);
	 


	$message= "
       Hello , $email
       <br /><br />
       We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,
       <br /><br />
       Click Following Link To Reset Your Password 
       <br /><br />
       <a href='http://www.cms.tahazulqarnain.com/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
       <br /><br />
       thank you :)
       ";
  $subject = "Password Reset";
  
  
  
 mail($to,$message,$subject);
  
  $msg = "<div class='alert alert-success'>
     <button class='close' data-dismiss='alert'>&times;</button>
     We've sent an email to $email.
     Please click on the password reset link in the email to generate new password. 
      </div>";
     

	
	}
	
}
}
else{
	
	
}



?>



<form action="" method="post" class="form-horizontal" >
<div class="form-group">
<div class="col-sm-8">
<input type="text" name="f_email" id="f_email" class="form-control" placeholder="Enter your Email Address">
</div>
</div>
<div class="form-group">
<div class="col-sm-8">
 <button class="btn btn-large btn-success" type="submit" name="forget_password">Forget Password</button>

</div>
</div>

</form>


</div>
</div>
</body>
</html>












