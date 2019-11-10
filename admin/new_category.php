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
if (isset($_POST['submit_category'])) {
	if($_POST['parent_category'] == '')
	{
  $category = strip_tags($_POST['category']);
    $ins_sql= "INSERT INTO category (category_name) VALUES ('$category') ";
    if(mysqli_query($conn,$ins_sql))
    {
      $result= '<div class="alert alert-success">You&apos;ve created a new category named &apos;'.$category.'&apos;</div>';
    }
    }
    else{
    	$sub_category = strip_tags($_POST['category']);
    	$c_id = $_POST['parent_category'];
    	//$sql = "SELECT c_id FROM category LEFT JOIN sub_categories AS sc ON category.category_name = '$parent_category'";
//$first_result=mysqli_query($conn,$sql);

   //$sub_category = "INSERT INTO sub_categories (c_id,sub_category_name) VALUES ('$first_result','$category')";
    
    $query = "INSERT INTO sub_categories (c_id,sub_category_name) VALUES ('$c_id','$sub_category') ";


   if( mysqli_query($conn,$query))
   {
     $result= '<div class="alert alert-success">You&apos;ve created a new subcategory category named &apos;'.$sub_category.'&apos;</div>';
   }

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
   <?php echo "$result"; ?>
	<div class="page-header"><h1>New Category</h1></div>
	<div class="container-fluid">
	<div class="col-sm-10">
    <form class="form-horizontal" action="new_category.php" method="post">
    	<div class="form-group">
            <label for="category" class="control-label">Title</label>
            <input id="category" type="text" name="category" class="form-control">
        </div>
        <div class="form-group">
            <label for="parent_category" class="control-label">Parent</label>
            
            <select name="parent_category" class="form-control" >
            	<option value="" >Select Parent Category</option>
            
            	<?php
            	$parent_category = "SELECT * FROM category";
            	$result = mysqli_query($conn,$parent_category);
            	while ($rows = mysqli_fetch_assoc($result)) {
            
            	 echo '<option value="'.$rows['c_id'].'">'.$rows['category_name'].'</option>';	

            	}

                ?>
            </select>
            
        </div>
        <div class="form-group">
    	<input type="submit" name="submit_category" class="btn btn-primary" >	
        </div>
    </form>
    </div>
</div>

</div>
</div>
</body>
<footer></footer>
</html>