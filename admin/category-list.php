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
$result='';

if(isset($_GET['del_id']))
{
$del_id = "DELETE FROM category WHERE c_id='$_GET[del_id]'";
if(mysqli_query($conn,$del_id))
{
$result ='<div class="alert alert-success">Category is deleted Successfully</div>';
}
else
{
$result ='<div class="alert alert-danger">Category is not deleted Successfully</div>';
}
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

    <script src="js/admin.js"></script>
</head>
<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->
<div style="width: 50px; height: 50px; " ></div>


<!-- User Section Start-->
<div style="margin-left:25%">
<div class="col-lg-12">

<?php echo $result; ?>
<div class="panel panel-primary">
<div class="panel-heading">
	<h3 style="display: inline-block;">Category List</h3>
</div>
<div class="panel-body">
	<table class="table table-striped ">
	<thead>
		<tr>
			<th>S.NO</th>
			<th>Cayegory Name</th>
			<th>Edit</th>
			<th>Delete</th>
			
	
		
		</tr>
	</thead>
	<tbody>
       <?php 
       $sql= "SELECT * FROM category";
       $run = mysqli_query($conn,$sql);
       while ($rows=mysqli_fetch_assoc($run)) {
       	echo '
         <tr>
		    <td>'.$rows['c_id'].'</td>
			<td>'.$rows['category_name'].'</td>
			<td><a href="edit_category.php?edit_id='.$rows['c_id'].'" class="btn btn-warning btn-xs">Edit</a></td>
			<td><a onclick="return confirmDelete()" href="category-list.php?del_id='.$rows['c_id'].'" class="btn btn-danger btn-xs">Delete</a></td>
		
		</tr>
       	';
       }
       ?>
		

		
	</tbody>	
	</table>
</div>
</div>
</div>
<!-- Latest User Section End-->

<body>

</body>
<footer></footer>
</html>