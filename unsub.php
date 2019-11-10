<?php include 'db.php';
 $message = "";
if(isset($_GET['unsub']) && $_GET['unsub'] != "")
{
    $unsub_email= $_GET['unsub'];
    
  
    $select_sql = "SELECT sub_status FROM `subscribe-list` WHERE email_address = '".$unsub_email."'";
    $run_select_sql = mysqli_query($conn,$select_sql);
    while($rows= mysqli_fetch_assoc($run_select_sql)){
      $sub_status = $rows['sub_status'];   
      
    }    
    
    if($sub_status == 0)
        {
             $message = '<div class="alert alert-warning">You&apos;ve already Unsubscribe to our Newsletter</div>';
        }
        else{
             $update_sub= "UPDATE `subscribe-list` SET sub_status=0 WHERE email_address='".$unsub_email."'";
              //$run_update_sub = mysqli_query($conn,$update_sub);
               
               if ($conn->query($update_sub) === TRUE) {
                     $message = '<div class="alert alert-success">You&apos;ve successfully Unsubscribe to our Newsletter</div>';
                } else {
                    $message = '<div class="alert alert-danger">You&apos;ve  not successfully Unsubscribe to our Newsletter</div>';
                    //echo "Error updating record: " . $conn->error;
                }
   
            }
}


?>
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
        <div style="width=100px;height:100px;"></div>
        <p>Thank You, You have been successfully removed from this subscriber list.</p>
<?php echo $message; ?>
    </div>

</body>
</html>