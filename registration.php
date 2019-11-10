<?php include 'db.php';
date_default_timezone_set("Asia/Karachi");
$date= date("Y-m-d H:i:s");
$match="";
if(isset($_POST['reg_submit']))
{
	if($_POST['password']== $_POST['con_password'])
	{
$first_name= strip_tags($_POST['first_name']);
$last_name= strip_tags($_POST['last_name']);
$email= strip_tags($_POST['email']);
$password= strip_tags($_POST['password']);
$con_password= strip_tags($_POST['con_password']);
$gender= strip_tags($_POST['gender']);

/*$month= strip_tags($_POST['month']);
$day= strip_tags($_POST['day']);
$year= strip_tags($_POST['year']);
$phone_no= strip_tags($_POST['phone_no']);
$address= strip_tags($_POST['address']);
$official_website= strip_tags($_POST['official_website']);*/


//$ins_sql="INSERT INTO registration (role,first_name, last_name, email_address, password, month, day, year, gender, phone_no, address, official_website) VALUES ('subscriber',, '$month', '$day', '$year', '$gender', '$phone_no', '$address', '$official_website')";
$ins_sql="INSERT INTO tbl_users (oauth_provider,oauth_uid,first_name,last_name,email_address,password,gender,role,locale,picture,link,created,last_modified) VALUES ('','','$first_name','$last_name','$email','$password','$gender','subscriber','','','','$date','admin')";

$run_sql=mysqli_query($conn,$ins_sql);

$ins_newsub_notification ="INSERT INTO tbl_notifications (Notification_Type_ID,Notification,Post_ID,Notification_For,Is_Seen,Is_Read,CurrentDate) VALUES (3,'New Subscriber $first_name has signup','','admin',0,0,'$date')";
$run_newsub_sql=mysqli_query($conn,$ins_newsub_notification);


$match= '<div class="alert alert-success">You have Successfully register to this website</div>';
}
else{

	$match= '<div class="alert alert-danger">Password doesnot match! </div>';
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
<body>
<?php include 'includes/header.php'; ?>
    <div style="width:50px; height:50px;"></div>
<div class="container">
	<article class="row">
		<section class="col-md-8">


	<div class="jumbotron">
		<h2>Registration form</h2>
		
	</div>
	<?php echo $match; ?> 
	<form class="form-horizontal" role="form" method="post" action="registration.php">
		<div class="form-group">
			<label for="first_name" class="control-label col-sm-2">First Name</label>
			<div class="col-sm-8">
			<input class="form-control" type="text" name="first_name" id="first_name" required>
		</div>
        </div>
        <div class="form-group">
			<label for="last_name" class="control-label col-sm-2">Last Name</label>
			<div class="col-sm-8">
			<input class="form-control" type="text" name="last_name" id="last_name" required>
		</div>
        </div>
        <div class="form-group">
			<label for="email" class="control-label col-sm-2">Email Address</label>
			<div class="col-sm-8">
			<input class="form-control" type="email" name="email" id="email" required>
		</div>
        </div>
        <div class="form-group">
			<label for="password" class="control-label col-sm-2">Create a Password</label>
			<div class="col-sm-8">
			<input class="form-control" type="password" name="password" id="password" required>
		</div>
        </div>
        <div class="form-group">
			<label for="con_password" class="control-label col-sm-2">Confirm Your Password</label>
			<div class="col-sm-8">
			<input class="form-control" type="password" name="con_password" id="con_password" required>
		</div>
        </div>
        <div class="form-group">
        <label for="gender" class="control-label col-sm-2">Gender</label>
        <div class="col-sm-8">
        <select class="form-control" name="gender" id="gender">
        	<option value="">Select Your Gender</option>
        	<option value="male">Male</option>
        	<option value="female">Female</option>
        	<option value="other">Other</option>
        </select>
        </div>
        </div>
        <!-- 
        <div class="form-group">
        <label for="month" class="control-label col-sm-2">Date of Birth</label>    
        <div class="col-sm-4">
           <select class="form-control" name="month" id="month">
           <option value="">Select A Month</option>
        	<option value="january">January</option>
        	<option value="febuary">Febuary</option>
        	<option value="march">March</option>
        	<option value="april">April</option>
        	<option value="may">May</option>
        	<option value="june">June</option>
        	<option value="july">July</option>
        	<option value="august">August</option>
        	<option value="september">September</option>
        	<option value="october">October</option>
        	<option value="november">November</option>
        	<option value="december">December</option>
        </select>
        </div>
       
        <label for="day" class="control-label"></label> 
			<div class="col-sm-2">
			<input class="form-control" type="text" name="day" id="day" placeholder="Day">
		</div>
		
        <label for="year" class="control-label"></label> 
			
			<div class="col-sm-2">
			<input class="form-control" type="text" name="year" id="year" placeholder="Year">
		</div>
        </div>

 <div class="form-group">
			<label for="phone_no" class="control-label col-sm-2">Phone No.</label>
			<div class="col-sm-8">
			<input class="form-control" type="text" name="phone_no" id="phone_no">
		</div>
        </div>

        <div class="form-group">
			<label for="address" class="control-label col-sm-2">Address</label>
			<div class="col-sm-8">
			<input class="form-control" type="text" name="address" id="address">
		</div>
        </div>
 
 <div class="form-group">
			<label for="official_website" class="control-label col-sm-2">Official Webiste</label>
			<div class="col-sm-8">
			<input class="form-control" type="text" name="official_website" id="official_website">
		</div>
        </div>
        -->
         <div class="form-group">
			<label class="control-label col-sm-2"></label>
			<div class="col-sm-8">
			<button class="btn btn-success" type="submit" name="reg_submit">Sign up</button>
			
		</div>
        </div>


	</form>



</section>

<?php include 'includes/sidebar.php'; ?>

</article>
	</div>
<div style="width: 50px; height: 50px;"></div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>