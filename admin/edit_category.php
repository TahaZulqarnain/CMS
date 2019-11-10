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
if(isset($_POST['update_category']))
{
$category_name=strip_tags($_POST['category']);

$update_sql = "UPDATE category SET category_name ='$category_name' WHERE c_id= '$_GET[edit_id]'";
if($run_update_sql = mysqli_query($conn,$update_sql))
{
  $result = '<div class="alert alert-success">You&apos;ve successfully updated category name </div>';
}

}



?>

<!-- <textarea class="form-control" id="description" name="description" rows="8"></textarea> -->

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
</head>
<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->
<body>
<div style="margin-left:25%">
<div class="col-lg-12">
<div style="width: 50px; height: 50px; " ></div>
   <?php echo $result; ?>
	
	<?php 
  if(isset($_GET['edit_id']))
  {
   $sql ="SELECT * FROM category where c_id = '$_GET[edit_id]'";
   $run = mysqli_query($conn,$sql);
   while($rows=mysqli_fetch_assoc($run)){?>
<div class="page-header"><h1>Edit Category</h1></div>
  <div class="container-fluid">
	<div class="col-sm-10">
    <form class="form-horizontal" action="" method="post">

    	<div class="form-group">
      <!--<input type="hidden" name="cat_id" value="<?php // echo $_GET['cat_id'] ?>"> -->
            <label for="category" class="control-label">Title</label>
            <input id="category" type="text" name="category" class="form-control" value="<?php echo $rows['category_name'] ?>">
        </div>
        <div class="form-group">
    	<input type="submit" name="update_category" class="btn btn-primary" >	
        </div>
    </form>
    </div>

<?php }
}
else{

  echo '<div class="alert alert-danger">You&apos;ve not select any category click <a href="category-list.php">here</a> to select </div>';
}
?>
</div>
</div>
</div>
</body>
<footer></footer>
</html>