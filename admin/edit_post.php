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

       $title = mysqli_real_escape_string($conn,$_POST['title']); //sql injection function
       $description = htmlspecialchars($_POST['description']); // submit post with
       $description  = mysqli_real_escape_string($conn,$description); //sql injection function
       $category=strip_tags($_POST['category']);
       $status=$_POST['status'];
       $date= date('Y-m-d h:i:s');
       $author=$_SESSION['user'];
       $noimage='';
       

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
      

        $update_sql="UPDATE post SET title='$title',
       description='$description',
       image='$image_db_path',
       category='$category',
       status='$status',
       date='$date',
       author='$author'
        WHERE id ='$_GET[edit_id]'";

       if ($run_sql=mysqli_query($conn,$update_sql))
       {
          // header('post-list.php');
         $error= '<div class="alert alert-success">Post has been edited successfully</div>';
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


$update_sql= "UPDATE post SET title='$title',
    description='$description',
    image='$noimage',
    category='$category',
    status='$status',
    date='$date',
    author='$author'
    WHERE id ='$_GET[edit_id]'";
     if ($run_sql=mysqli_query($conn,$update_sql))
       {
          // header('post-list.php');
         $error= '<div class="alert alert-success">Post has been edited successfully</div>';
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
 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</head>
<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->
<body>
<div style="margin-left:25%">
<div class="col-lg-12">

<?php echo $error; ?>
	

    <?php
    if (isset($_GET['edit_id'])) {
        $edit_sql="SELECT * FROM post where id='$_GET[edit_id]'";
    $run_edit_sql = mysqli_query($conn,$edit_sql);
    while($rows= mysqli_fetch_assoc($run_edit_sql)){
       $c_category = $rows['category'];
       $sub_category = $rows['sub_category'];
       $status = $rows['status'];
      ?>
    
    <div class="page-header"><h1><?php echo $rows['title']; ?></h1></div>
    <div class="container-fluid">
    <div class="col-sm-10">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">

        <img src="../<?php echo $rows['image'] ?>" style="width:100px;">
       
        <div class="form-group">
       
            <label for="image-upload" class="control-label">Image Upload</label>
            <input id="image-upload" type="file" name="image-upload">
        </div>
        <div class="form-group">
        
            <label for="title" class="control-label">Title</label> 
            <input id="title" type="text" name="title" class="form-control" value="<?php echo $rows['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="category" class="control-label">Category</label>
            <?php 

                 $sql = "SELECT * FROM category";
                 $run_sql = mysqli_query($conn,$sql);
                 ?>
            <select id="category" name="category" class="form-control" >
            
                 <option value="">Select a category</option>
<!--<select id="category" name="category" class="form-control" value="<?php //echo $category; ?>" required> -->
<?php
                 while( $c_rows = mysqli_fetch_assoc($run_sql))
                 {
                   $category_name = $c_rows['category_name'];
                
                    
?>
                    <option value=" <?php echo $c_rows['category_name']; ?>" <?php if($c_category == $category_name){ echo 'selected';} ?> > <?php echo $c_rows['category_name']; ?></option>;


              <?php      
                 }
                 
                ?>
            </select>
        </div>




        <div class="form-group">
            <label for="sub_category" class="control-label">Sub Category</label>
            <?php 

                 $sql = "SELECT * FROM sub_categories";
                 $run_sql = mysqli_query($conn,$sql);
                 ?>
            <select id="sub_category" name="sub_category" class="form-control" >
            
                 <option value="">Select a sub category</option>
<!--<select id="category" name="category" class="form-control" value="<?php //echo $category; ?>" required> -->
<?php
                 while( $c_rows = mysqli_fetch_assoc($run_sql))
                 {
                   $sub_category_name = $c_rows['sub_category_name'];
                
                    
?>
                    <option value=" <?php echo $c_rows['sub_category_name']; ?>" <?php if($sub_category == $sub_category_name){ echo 'selected';} ?> > <?php echo $c_rows['sub_category_name']; ?></option>;


              <?php      
                 }
                 
                ?>
            </select>
        </div>



        

        <div class="form-group">
            <label for="description" class="control-label" required>Description</label>
        <textarea id="description" name="description" rows="8" > <?php echo $rows['description']; ?></textarea> 
        </div>
         <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select  id="status" name="status" class="form-control" value="<?php echo $status; ?>" >
            <option value="draft" <?php if($status == 'draft'){echo("selected");}?>>Draft</option>
  <option value="published" <?php if($status == 'published'){echo("selected");}?>>Publish</option>




               <!-- <option value="draft">Draft</option>
                <option value="published">Publish</option>
                -->
            </select>
        </div>
        <div class="form-group">
        
        <input type="submit" name="submit_post" class="btn btn-primary" >   
        </div>
    </form>
    </div>
    

<?php
    }
  }
else{
    echo '<div class="alert alert-danger">You havent select any post to edit</div>';
}
     ?>
    
    </div>
    </div>
</div>
</body>

</html>



