<?php

include '../db.php'; 

//if(empty($_GET['id']) && empty($_GET['code']))
//{
//	header('index.php');
	
//}	

//if(isset ($_GET['id']) && isset ($_GET['code']))

//{
	
	 //$id = $_GET['id'];
   // $code = $_GET['code'];
	 $id =' 4 ';
   $code = '1162ed7af49f70acc2e77e8c5f77e577';

   $run_query = "SELECT * FROM registration WHERE reg_id= '$id'";
	 $run_sql = mysqli_query($conn,$run_query);
     while ($rows = mysqli_fetch_assoc($run_sql)) {
      $first_name = $rows['first_name'];
       $id = $rows['reg_id'];
  if(mysqli_num_rows($run_sql) == 1 )
	 {
		 if(isset($_POST['btn-reset-pass']))
		 {
			  $pass = $_POST['pass'];
              $cpass = $_POST['confirm-pass'];
   
               if($cpass!==$pass)
               {
                 $msg = "<div class='alert alert-block'>
				 <button class='close' data-dismiss='alert'>&times;</button>
				 <strong>Sorry!</strong>  Password Doesn't match. 
				 </div>";
				}
				else
			   {
				   $update_password = "UPDATE registration SET password = '$pass' where reg_id= '$id'" ;
				   $run_update_password = mysqli_query($conn,$update_password);
				   
				
				//$msg = "<div class='alert alert-success'>
				//  <button class='close' data-dismiss='alert'>&times;</button>
				//  Password Changed.
				 // </div>";
				//header("refresh:5;index.php");
			   }
			 
		 }
	 }
 
}
	
//}
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>
    <!-- Bootstrap -->
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
    <div class="container">
     <div class='alert alert-success'>
   <strong>Hello !</strong>  <?php echo $first_name ?> you are here to reset your forgetton password.
  </div>
        <form class="form-horizontal" method="post">
        <h3 class="form-signin-heading">Password Reset.</h3><hr />
        <div class="form-group">
<div class="col-sm-8">
 <input type="password" class="form-control" placeholder="New Password" name="pass" required />
</div>
</div>
       <div class="form-group">
<div class="col-sm-8">
<input type="password" class="form-control" placeholder="Confirm New Password" name="confirm-pass" required />
</div>
</div>
        
      <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>
        
      </form>

    </div> <!-- /container -->
   
  </body>
</html>