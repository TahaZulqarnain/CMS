<?php
session_start();
include '../db.php';



if (isset($_SESSION['user']) && isset($_SESSION['password'])  == true) {
		if(isset($_SESSION['role']) == 'subscriber'){
	$sql="SELECT * FROM registration where email_address='$_SESSION[user]' AND password='$_SESSION[password]' AND role = 'subscriber' ";
	if($result=mysqli_query($conn,$sql)){
		while ($rows = mysqli_fetch_assoc($result)) {
           $user_first_name = $rows['first_name'];
           $user_last_name = $rows['last_name'];
           $user_email_address = $rows['email_address'];
           $user_month = $rows['month'];
           $user_day = $rows['day'];
           $user_year = $rows['year'];
           $user_gender = $rows['gender'];
           $user_phone = $rows['phone_no'];
           $user_address = $rows['address'];
           $user_off_website = $rows['official_website'];
           $profile_pic =  "../images/img3.jpg";



			

		}
	if(mysqli_num_rows($result) == 1 ){
   
	}
else
{
	 header('location:../index.php');
}
}

}
}
/*
else{
header('location:../index.php');
}
*/

/*session_start();
if(!isset($_SESSION['userData'])){
    header('location: index.php');
*/

if( isset($_SESSION['fb_token'])){
$user_first_name = $_SESSION['first_name'];
       $user_last_name = $_SESSION['last_name'];
       $user_email_address = $_SESSION['email_address'];
       $profile_pic = "https://graph.facebook.com/$_SESSION[oauth_uid]/picture?type=large";

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
  <link rel="stylesheet" href="stylesheet-subscriber.css">
</head>
<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>

<div style="margin-left:25%">
<div class="col-lg-12">
<div style="width: 50px; height: 50px; " ></div>
<!-- Profile Section Starts-->
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<div class="col-md-3"><img src="<?php echo $profile_pic; ?>" class="img-thumbnail" width="90%";></div>
<div class="col-md-7">
<h4><u><?php echo $user_first_name.' '.$user_last_name ?></u></h4>
<p><i class="glyphicon glyphicon-road"></i> <?php echo $user_address; ?> </p>
<p><i class="glyphicon glyphicon-phone"></i> <?php echo $user_phone; ?></p>
<p><i class="glyphicon glyphicon-envelope"></i> <?php echo $user_email_address; ?></p>

</div>
<div class="clearfix"></div>
</div>
</div>
</div>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
		<table class="table table-condensed">

			<tbody>
				<tr>
					<th>Gender</th>
					<td><?php echo $user_gender; ?></td>
				</tr>
				<tr>
					<th>Date of Birth</th>
					<td><?php echo $user_day.' '.$user_month.' '.$user_year; ?></td>
				</tr>
				<tr>
					<th>Officail Website</th>
					<td><?php echo $user_off_website; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
		<table class="table table-condensed">

		<?php
         $sql= "SELECT * FROM post where author = '$_SESSION[user]' ";
         $run_sql = mysqli_query($conn,$sql) ;
         $count = 1;
         while($rows = mysqli_fetch_assoc($run_sql))
         {
         	

         	echo '
            <tbody>
			<tr>
					<td>'.$count.' </td>
					<td><a href="../post.php?post_id='.$rows['id'].'">'.$rows['title'].'</a></td>
				</tr>
					
			</tbody>

         	';
        $count++;
         }

		?>
			

		</table>
	</div>
</div>
</div>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>About me</h4>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient</p>
		</div>
	</div>
</div>


</div>


</div>
<!-- Profile Section End-->

<body>
</body>
<footer></footer>
</html>