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

$error="";
if(isset($_POST['submit_post']))
{
$title = strip_tags(trim($_POST['title']));    
$title = mysqli_real_escape_string($conn,$title); //sql injection function
$date= date('Y-m-d h:i:s');

//$description = strip_tags(trim($_POST['description']));
$description = htmlspecialchars($_POST['description']); 
$description = mysqli_real_escape_string($conn,$description); //sql injection function
$category = $_POST['category'];
$sub_category =$_POST['sub_category'];
$status   = $_POST['status'];


  if($_FILES['image-upload']['name'] != '')
  {
    $image_name=$_FILES['image-upload']['name'];
    $image_temp=$_FILES['image-upload']['tmp_name'];
    $image_size=$_FILES['image-upload']['size'];
    $image_ext=pathinfo($image_name,PATHINFO_EXTENSION);
    $image_path= '../images/'.$image_name;
    $image_db_path='images/'.$image_name;
 
 if($image_size < 1000000)
 {
    if($image_ext=='jpg' || $image_ext=='jpeg' || $image_ext=='png' || $image_ext=='gif')
    {
     if(move_uploaded_file($image_temp,$image_path))
     {
     
        $ins_sql="INSERT INTO `post` (`title`, `description`, `image`, `category`, `sub_category`, `status`, `date`, `author`) VALUES ('$title','$description','$image_db_path','$category','$sub_category','$status','$date','$_SESSION[user]')";

 

    if(mysqli_query($conn,$ins_sql)){
     $error= '<div class="alert alert-success">Post hass been added successfully</div>';
           
      }
       
    
     
       else{
            $error= '<div class="alert alert-danger">Query is not working</div>';
       }

     }
     else{
        $error='<div class="alert alert-danger">Sorry ,Unfortunetly image has not been uploaded</div>';
     }
    }
    else{
      $error='<div class="alert alert-danger">Image format is incorrect</div>';
    }
 }
 else{
     $error='<div class="alert alert-danger">Image size is larger than required</div>';
 }

  }
else{

   
 $ins_sql="INSERT INTO `post` (`title`, `description` ,`category`, `sub_category`, `status`, `date`, `author`) VALUES ('$title','$description','$category','$sub_category','$status','$date','$_SESSION[user]')";
   if(mysqli_query($conn,$ins_sql)){
     $error= '<div class="alert alert-success">Post has been added successfully</div>';
           
      }
   
     
       else{
            $error= '<div class="alert alert-danger">Query is not working</div>';
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
<div style="width: 10px; height: 10px; " ></div>
<?php echo $error; ?>
	<div class="page-header"><h1>New Post</h1></div>
	<div class="container-fluid">
	<div class="col-sm-10">
    <form class="form-horizontal" action="new_post.php" method="post" enctype="multipart/form-data">
    	<div class="form-group">
    		<label for="image-upload" class="control-label">Image Upload</label>
    		<input id="image-upload" type="file" name="image-upload">
    	</div>
    	<div class="form-group">
    		<label for="title" class="control-label">Title</label>
    		<input id="title" type="text" name="title" class="form-control" required>
    	</div>
    	<div class="form-group">
    		<label for="category" class="control-label">Category</label>
    		<select id="category" name="category" class="form-control" required>
                 <option>Select a category</option>
    			<?php 
                 $sql = "SELECT * FROM category";
                 $run_sql = mysqli_query($conn,$sql);
                 while( $c_rows = mysqli_fetch_assoc($run_sql))
                 {
                    echo '<option value="'.$c_rows['category_name'].'">'.ucfirst($c_rows['category_name']).'</option>';
                    

                 }
                 
                ?>
    		</select>
    	</div>
    	
            <div class="form-group">
            <label for="sub_category" class="control-label">Category</label>
            <select id="sub_category" name="sub_category" class="form-control" required>
                 <option>Select a Sub Category</option>
                <?php 
                 $sub_sql = "SELECT * FROM sub_categories";
                 $sub_run_sql = mysqli_query($conn,$sub_sql);
                 while( $sub_c_rows = mysqli_fetch_assoc($sub_run_sql))
                 {
                    echo '<option value="'.$sub_c_rows['sub_category_name'].'">'.ucfirst($sub_c_rows['sub_category_name']).'</option>';
                    

                 }
                 
                ?>
            </select>
        </div>

        <div class="form-group">
    		<label for="description" class="control-label" required>Description</label>
    	<textarea id="description" name="description" rows="8" ></textarea>	
        </div>
         <div class="form-group">
    		<label for="status" class="control-label">Status</label>
    		<select id="status" name="status" class="form-control">
    			<option value="draft">Draft</option>
                <option value="published">Publish</option>
    			
    		</select>
    	</div>
        <div class="form-group">
    	
    	<input type="submit" name="submit_post" class="btn btn-primary" >	
        </div>
    </form>
    </div>
</div>

</div>
</div>


<?php
if(isset($_POST['submit_post']))
{
  $ins_sql="INSERT INTO `post` (`title`, `description`, `image`, `category`, `sub_category`, `status`, `date`, `author`) VALUES ('$title','$description','$image_db_path','$category','$sub_category','$status','$date','$_SESSION[user]')";
echo "<h1>".$ins_sql."</h1>";
}
?>

</body>
</html>
