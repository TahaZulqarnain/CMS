<?php
session_start();
include '../db.php';
if (isset($_SESSION['user']) && isset($_SESSION['password'])  == true) {
	$sql="SELECT * FROM registration where email_address='$_SESSION[user]' AND password='$_SESSION[password]'";
	if($result=mysqli_query($conn,$sql)){
	if(mysqli_num_rows($result) == 1 ){
   
	}
else
{
	 header('location:../index.php');
}
}

}else{
header('location:../index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    
  <title>Admin Panel</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
       <style>
    #email_fetch_template {
    padding: 8px;
    border: 1px solid;
    border-color: green;
    border-radius: 6px;
    outline:none;
    }
    </style>
    </head>
    <body>
 
            
          <form class="form-horizontal" method="post">

                  
                
                <?php

               // if(isset($_POST['email_fetch_template']))
                if(!empty($_POST['alltemplate']))
                {
                
                $sql= "SELECT * FROM email_template where email_type = '$_POST[alltemplate]'";
                $run_sql= mysqli_query($conn,$sql);
                while($rows = mysqli_fetch_array($run_sql))
                {
                	$email_type = $rows['email_type'];
                    $email_title = $rows['email_title'];
                    $email_content = $rows['email_content'];
                	
                	  
                
                
                
                ?>
           


                <div class="form-group">
                <label for="type" class="control-label col-sm-2">Email Type</label>
                <div class="col-sm-8">
                <input type="text" name="set_email_type" value="<?php echo $email_type; ?>" class="form-control">
                </div>
                </div>
                <div class="form-group">
                <label for="type" class="control-label col-sm-2">Email Title</label>
                <div class="col-sm-8">
                <input type="text" name="set_email_title" value="<?php echo $email_title; ?>" class="form-control">
                </div>
                </div>
                <div class="form-group">
                <label for="content" class="control-label col-sm-2">Email Content</label>
                <div class="col-sm-8">
                <textarea name="set_email_content" class="form-control"><?php echo $email_content; ?></textarea>
                </div>
                </div>
                
                 <div class="form-group">
                <label for="content" class="control-label col-sm-2"></label>
                        <div class="col-sm-8">
                            <input type="submit" name="set_is_submit" value="Send template" class="btn btn-success">
                        </div>
                    </div>
                     <?php
                }
                 }?>
                </form>
                </body>
                </html>
 