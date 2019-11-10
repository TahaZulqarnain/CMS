<?php
session_start();
include '../db.php';
if (isset($_SESSION['user']) && isset($_SESSION['password'])  == true ) {
	
	$sql="SELECT * FROM registration where email_address='$_SESSION[user]' AND password='$_SESSION[password]'";
	if($result=mysqli_query($conn,$sql)){
while ($rows = mysqli_fetch_assoc($result)) {
	
$name = $rows['first_name'] .' '. $rows['last_name'];
$role= $rows['role'];
$email = $_SESSION['user'];
$phone = $rows['phone_no'];
$official_website = $rows['official_website'];
	if(mysqli_num_rows($result) == 1 ){
   
	}
else
{
	 header('location:../index.php');
}
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
    <link rel="stylesheet" href="/stylesheet.css">


  
  
</head>

<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->


<div style="margin-left:25%">


   
    
<div class="col-lg-12">
<div style="width: 50px; height: 50px; " ></div>

<?php 
 $post_sql= "SELECT * FROM post where status = 'published' ";
 $run_sql= mysqli_query($conn,$post_sql);
 $total_post = mysqli_num_rows($run_sql);

 	?>
<div class="col-md-3">
	<div class="panel panel-danger">
	<div class="panel-heading">
	<div class="row">
				<div class="col-xs-3" style="font-size: 4.5em;"><i class="glyphicon glyphicon-signal"></i></div>
	    <div class="col-xs-9 text-right">
	    	<div style="font-size: 2.5em;"><?php echo $total_post ;?></div>
	    	<div >Posts</div>
	    </div>
	</div>
	</div>
<a href="post-list.php">
<div class="panel-footer">	
     <div class="pull-left">View Post</div>
	<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
	<div class="clearfix"></div>
</div>
	</a>

	</div>
	</div>

	<?php 
 $post_sql= "SELECT * FROM category ";
 $run_sql= mysqli_query($conn,$post_sql);
 $total_category = mysqli_num_rows($run_sql);

 	?>
<div class="col-md-3">
	<div class="panel panel-success">
	<div class="panel-heading">
		<div class="row">
		<div class="col-xs-3" style="font-size: 4.5em;"><i class="glyphicon glyphicon-th-list"></i></div>
	    <div class="col-xs-9 text-right">
	    	<div style="font-size: 2.5em;"><?php echo $total_category ;?></div>
	    	<div >Categories</div>
	    </div>
	</div>
	</div>
<a href="category-list.php">
<div class="panel-footer">	
     <div class="pull-left">View Catergories</div>
	<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
	<div class="clearfix"></div>
</div>
	</a>

	</div>
</div>


<?php 
 $post_sql= "SELECT * FROM registration ";
 $run_sql= mysqli_query($conn,$post_sql);
 $total_users = mysqli_num_rows($run_sql);

 	?>
<div class="col-md-3">
	<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="row">
		<div class="col-xs-3" style="font-size: 4.5em;"><i class="glyphicon glyphicon-user"></i></div>
	    <div class="col-xs-9 text-right">
	    	<div style="font-size: 2.5em;"><?php echo $total_users ;?></div>
	    	<div >Users</div>
	    </div>
	</div>
	</div>
<a href="#">
<div class="panel-footer">	
     <div class="pull-left">View Users</div>
	<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
	<div class="clearfix"></div>
</div>
	</a>

	</div>
</div>

<?php
$comment_sql="SELECT * FROM post_comments";
$run_sql=mysqli_query($conn,$comment_sql);
$total_comments= mysqli_num_rows($run_sql);
?>
<div class="col-md-3">
	<div class="panel panel-info">
	<div class="panel-heading">
		<div class="row">
		<div class="col-xs-3" style="font-size: 4.5em;"><i class="glyphicon glyphicon-comment"></i></div>
	    <div class="col-xs-9 text-right">
	    	<div style="font-size: 2.5em;"><?php echo $total_comments ?></div>
	    	<div >Comments</div>
	    </div>
	</div>
	</div>
<a href="comment-list.php">
<div class="panel-footer">	
     <div class="pull-left">View Comments</div>
	<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
	<div class="clearfix"></div>
</div>
	</a>

	</div>
</div>
</div>
<!-- Top Section End-->

<!-- User Section Start-->


<div class="col-lg-12">
<div class="col-lg-6">
<div class="panel panel-default xs_scroll">
<div class="panel-heading">
<i class="glyphicon glyphicon-user" style="display: inline-block;font-size: 21px;"></i>
	<h3 style="display: inline-block;">User</h3>
</div>
<div class="panel-body">
	<table class="table table-striped ">
	<thead>
		<tr>
			<th>S.NO</th>
			<th>Name</th>
			<th>Role</th>
	
		
		</tr>
	</thead>
	<tbody>
		<?php 
$user_sql = "SELECT * FROM registration ORDER BY reg_id DESC LIMIT 5 ";
$run_sql = mysqli_query($conn,$user_sql);
while($rows = mysqli_fetch_assoc($run_sql))

{
	echo '
	
		<tr>
			<td>'.$rows['reg_id'].'</td>
			<td>'.$rows['first_name'].'</td>
			<td>'.$rows['role'].'</td>
		
		</tr>

		
	     

	' ;
}

?>
</tbody>
	</table>
</div>
</div>
</div>
<!-- Latest User Section End-->
<!-- Profile Section Starts-->

<div class="col-lg-6 xs_scroll">

<div class="panel panel-primary">
<div class="panel-heading">
	
	<div class="col-md-7">
<div class="page-header">
<h4>Profile</h4>
</div>
</div>
<div class="col-md-5">
	<img src="../images/img3.jpg" class="img-circle" width="60%";>
</div>
<div class="panel-body">
	<table class="table table-condensed">
	

	<tbody>
    <tr>
    	<th>Name</th>
    	<td><?php echo $name; ?></td>
    </tr>
    <tr>
    	<th>Role</th>
    	<td><?php echo $role; ?></td>
    </tr>
    <tr>
    	<th>Email</th>
    	<td><?php echo $email; ?></td>
    </tr>
    <tr>
    	<th>Contact</th>
    	<td><?php echo $phone; ?></td>
    </tr>
    <tr>
    	<th>Official Website</th>
    	<td><?php echo $official_website; ?></td>
    </tr>
    </tbody>
	</table>
</div>
</div>

</div>
</div>

</div>




<!-- Profile Section End-->
<!-- Latest Post Section Start-->
<div class="col-lg-12">
<div class="col-md-12">
<div class="panel panel-default xs_scroll">
<div class="panel-heading">
<i class="glyphicon glyphicon-list" style="display: inline-block;font-size: 21px;"></i>
	<h3 style="display: inline-block;">Latest Post</h3>
</div>
<div class="panel-body">
	<table class="table table-striped ">
	<thead>
		<tr>
			<th>S.NO</th>
			<th>Title</th>
			<th>Description</th>
			<th>Image</th>
			<th>Category</th>
			<th>Date</th>
			<th>Author</th>
		</tr>
	</thead>
    <tbody>
	<?php
 $post_sql= "SELECT * FROM post where status = 'published' LIMIT 6 ";
 $run_sql= mysqli_query($conn,$post_sql);
 $count = 1;
 while ( $rows = mysqli_fetch_assoc($run_sql)){
 	echo '
	
		<tr>
			<td>'.$count.'</td>
			<td>'.$rows['title'].'</td>
			<td>'.substr($rows['description'],0,50).'</td>
			<td>'.($rows['image'] == '' ? 'No Image' : '<img src="../'.$rows['image'].'" width="50px;">').' </td>
			<td>'.$rows['category'].'</td>
			<td>'.$rows['date'].'</td>
			<td>'.$rows['author'].'</td>
		</tr>

	

 	' ;
 	 $count++;
 }
?>
</tbody>
	</table>
</div>
</div>
</div>
</div>
<!-- Latest posts Section End-->

<!-- Latest comments Section Start-->
<div class="col-lg-12">
<div class="col-md-12">
<div class="panel panel-default xs_scroll">
<div class="panel-heading">
<i class="glyphicon glyphicon-comment" style="display: inline-block;font-size: 21px;"></i>
	<h3 style="display: inline-block;">Latest Comments</h3>
</div>
<div class="panel-body">
	<table class="table table-striped ">
	<thead>
		<tr>
			<th>S.NO</th>
			<th>Date</th>
			<th>Post by</th>
			<th>Email</th>
			<th>Post id</th>
			<th>Post Name</th>
			<th>Comments</th>
		</tr>
	</thead>
	<tbody>
		<?php
     $sql = "SELECT * FROM post_comments WHERE status ='approved' ORDER BY post_comment_id DESC LIMIT 6 ";
      $run_sql = mysqli_query($conn,$sql) ;
         $count = 1;
         while($rows = mysqli_fetch_assoc($run_sql))
        {
echo '
<tr>
			<td>'.$count.'</td>
			<td>'.$rows['date'].'</td>
			<td>'.$rows['name'].'</td>
			<td>'.$rows['email'].'</td>
			<td>'.$rows['id'].'</td>
			<td>'.$rows['post_name'].'</td>
			<td>'.$rows['comments'].'</td>
    
		</tr> ';
		$count++;
	}
	?>
	</tbody>	
	</table>
</div>
</div>
</div>
</div>

<!-- Latest comments Section End-->
</div>
</div>

<body>

</body>
<footer></footer>
</html>

