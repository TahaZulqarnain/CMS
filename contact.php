<?php include 'db.php';
date_default_timezone_set("Asia/Karachi");
$date= date("Y-m-d H:i:s");
if(isset($_POST['submit_comments']))
{
$name = strip_tags($_POST['username']);
$email = strip_tags($_POST['email']);
$subject = strip_tags($_POST['subject']);
$comments = strip_tags($_POST['comments']);



$ins_sql="INSERT INTO comments (name,email,subject,comments,date) values (
'$name','$email','$subject','$comments','$date')";
$run_sql= mysqli_query($conn,$ins_sql);

$ins_newsub_notification ="INSERT INTO tbl_notifications (Notification_Type_ID,Notification,Post_ID,Notification_For,Is_Seen,Is_Read,CurrentDate) VALUES (4,'New Query From $name','','admin',0,0,'$date')";
$run_newsub_sql=mysqli_query($conn,$ins_newsub_notification);


	$mailheader = "From: ".$email."\r\n"; 
	$mailheader .= "Reply-To: ".$email."\r\n"; 
	$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$MESSAGE_BODY = "Name: ".$name."<br>"; 
	$MESSAGE_BODY .= "Email: ".$email."<br>";

$to = "tahazulqarnain44@gmail.com";
$subject_email = "$subject";
$txt = "$comments";
$headers = "From: ".$email . "\r\n";
$headers .= "Reply-To: ".$email."\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

@mail($to,$subject_email,$txt,$headers,'-ftahazulqarnain44@gmail.com');

    
 
  
  
  if(@mail) {
 $email_send= '<div class="alert alert-success">Your Message has been Send Successfully. You will be reached shortly</div>';
} else {
   $email_send= '<div class="alert alert-danger">Your Message has not been send. Please try again later.</div>';
}  
    
}

//$ins_sql="INSERT INTO comments (name,email,subject,comments,date) values (
//'$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[comments]','$_POST[date]')";



?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact Form</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
    textarea#message {
    height: 120px !important;
}
</style>
<body>
<?php include 'includes/header.php'; ?>
    <div style="width:50px; height:50px;"></div>
<div class="container">
	<article class="row">
		<section class="col-md-8">


	<div class="jumbotron">
		<h2><?php echo $date; ?>Contact form</h2>
	</div>
	 <?php echo   $email_send; ?>
	<form class="form-horizontal" method="post" action="contact.php" >
		<div class="form-group">
			<label for="username" class="control-label col-sm-2">Username</label>
			 <div class="col-sm-8">
			<input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="control-label col-sm-2">Email Address</label>
			 <div class="col-sm-8">
			<input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="subject" class="control-label col-sm-2">Subject</label>
			 <div class="col-sm-8">
			<input type="text" name="subject" id="subject" placeholder="Subject" class="form-control" required>
			</div>
		</div>
        <div class="form-group">
			<label for="comments" class="control-label col-sm-2">Comments</label>
			 <div class="col-sm-8">
			 <textarea id="message" name="comments" class="form-control" rows="5" style="resize: none;" required></textarea>
			
			</div>
		</div>
<div class="form-group">
			<label class="control-label col-sm-2"></label>
			 <div class="col-sm-8">
			<input type="submit" name="submit_comments" class="btn btn-success">
			</div>
		</div>
	</form>



</section>

<?php include 'includes/sidebar.php'; ?>

</article>
	</div>

	<?php include 'includes/footer.php'; ?>
</body>
</html>