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
  </head>
  </html>
  
<?php 
if (!empty($_POST['admin_search'])){
    
   $search_text = $_POST['admin_search'];
    
   $search_sql= "select * from post where title LIKE '%{$search_text}%' LIMIT 5";

   
   $run_search_sql = mysqli_query($conn,$search_sql);

   
   if(mysqli_num_rows($run_search_sql) > 0){
           while ($rows = mysqli_fetch_array($run_search_sql)) {
            
            $id = $rows['id'];
            $title = $rows['title'];
            $author = $rows['author'];
            
           ?>
           
           <div class="show cls-srch-sugg">
           
           <span class="search_title">Title: <?php echo $title ;?></span><br>
           <!-- <span class="search_id">Post ID:  <?php //echo $id ;?></span><br> -->
           <span class="search_author">Author: <?php echo $author ;?></span><br>
           <a class="search_link" target="_blank" href="http://cms.tahazulqarnain.com/post.php?post_id=<?php echo $id ;?> ">View</a>
           <a class="search_link" target="_blank" href="http://cms.tahazulqarnain.com/admin/edit_post.php?edit_id=<?php echo $id ;?> ">Edit</a>
           </div> 
        
        
           
        <?php 
          }    
    }
    else{
      echo 'No Suggestion found';
        }
}
else{
    echo 'Please Enter Keyword to Search';
}        
?>