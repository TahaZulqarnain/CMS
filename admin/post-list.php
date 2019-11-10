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
if(isset($_GET['new_status']))
{
$new_status=$_GET['new_status'];
$update_query= "UPDATE post SET status='$new_status' where id='$_GET[id]'";
if($run=mysqli_query($conn,$update_query))
{
$result ='<div class="alert alert-success">Status is updated Successfully</div>';
}
else
{
$result ='<div class="alert alert-danger">Status is not updated</div>';
}

}

if(isset($_GET['del_id']))
{
	$del_id = "DELETE FROM post where id ='$_GET[del_id]'";
	$run_del_id = mysqli_query($conn,$del_id);
	if(($run_del_id == 1)){
	$result ='<div class="alert alert-danger">Comments has been deleted successfully</div>';
	}
	else{
	    $result ='<div class="alert alert-danger">Query is not working</div>';
	}
}

if(isset($_GET['trash_id']))
{
	$del_id = "UPDATE post SET active = 1 where id ='$_GET[trash_id]'";
	$run_del_id = mysqli_query($conn,$del_id);
	if(($run_del_id == 1)){
	$result ='<div class="alert alert-success">Comments has been moved to trash successfully</div>';
	}
	else{
	    $result ='<div class="alert alert-danger">Query is not working</div>';
	}
}

if(isset($_GET['untrash_id']))
{
	$del_id = "UPDATE post SET active = 0 where id ='$_GET[untrash_id]'";
	$run_del_id = mysqli_query($conn,$del_id);
	if(($run_del_id == 1)){
	$result ='<div class="alert alert-success">Comments has been moved to untrash successfully</div>';
	}
	else{
	    $result ='<div class="alert alert-danger">Query is not working</div>';
	}
}

if(isset($_POST['submitbulkactions']))
{
    
    if($_POST['bulkactions'] == 'movetotrash'){
        
         $cnt=array();
         $cnt=count($_POST['post_ids']);
         for($i=0;$i<$cnt;$i++)
          {
             $t_update_id=$_POST['post_ids'][$i];
            // $query="delete from post where id=".$del_id;
            $query= "UPDATE post SET active = 1 where id=".$t_update_id;
             mysqli_query($conn,$query);
          }

    }
    elseif($_POST['bulkactions'] == 'draft'){
        $cnt=array();
         $cnt=count($_POST['post_ids']);
         for($i=0;$i<$cnt;$i++)
          {
            $d_update_id=$_POST['post_ids'][$i];
            $query= "UPDATE post SET status = 'draft' where id=".$d_update_id;
             mysqli_query($conn,$query);
          }
        
    }
     elseif($_POST['bulkactions'] == 'published'){
        $cnt=array();
         $cnt=count($_POST['post_ids']);
         for($i=0;$i<$cnt;$i++)
          {
             $p_update_id=$_POST['post_ids'][$i];
            $query= "UPDATE post SET status = 'published' where id=".$p_update_id;
             mysqli_query($conn,$query);
          }
        
    }
    elseif($_POST['bulkactions'] == 'movetountrash'){
         $cnt=array();
         $cnt=count($_POST['post_ids']);
         for($i=0;$i<$cnt;$i++)
          {
             $ut_update_id=$_POST['post_ids'][$i];
            $query= "UPDATE post SET active = 0 where id=".$ut_update_id;
             mysqli_query($conn,$query);
          }
    }
   
    
    
}

$per_page=6;
if(isset($_GET['page']))
{
$page=$_GET['page'];
}	
else{
$page=1;
}
$start_from = ($page - 1) * $per_page;
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
   <!-- <script src="js/admin.js"></script> -->
</head>
<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->
<div style="width: 50px; height: 50px; " ></div>


<!-- Latest Post Section Start-->
<div style="margin-left:25%">
<div class="col-lg-12">
<?php echo $result; ?>
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<i class="glyphicon glyphicon-list" style="display: inline-block;font-size: 21px;"></i>
	<h3 style="display: inline-block;">Latest Post</h3><br>

    <!-- Links -->
    
    <?php
    $count_sql= "SELECT  COUNT(DISTINCT id) as post_id from post ";
    $run_count_sql = mysqli_query($conn,$count_sql);
    $total_count_post = mysqli_fetch_assoc($run_count_sql);
    
    $published_count_sql= "SELECT  COUNT(DISTINCT id) as post_id from post where status = 'published' ";
    $run_published_count_sql = mysqli_query($conn,$published_count_sql);
    $total_published_count_post = mysqli_fetch_assoc($run_published_count_sql);
    
    $draft_count_sql= "SELECT  * from post where status = 'draft' ";
    $run_draft_count_sql = mysqli_query($conn,$draft_count_sql);
    $total_draft_count= mysqli_num_rows($run_draft_count_sql);
  
    
    $trash_count_sql= "SELECT  * from post where active = 1 ";
    $run_trash_count_sql = mysqli_query($conn,$trash_count_sql);
    $total_trash_count= mysqli_num_rows($run_trash_count_sql);
    
    ?>
    
	<a style="color:#000;" href="post-list.php">All (<?php echo $total_count_post['post_id'] ;?>)</a>
	<a style="color:#000;" href="post-list.php?post_status=published">Published (<?php echo $total_published_count_post['post_id'] ;?>)</a>
	<?php    if($total_draft_count > 0 )
	{
	    echo '
	    <a style="color:#000;" href="post-list.php?post_status=draft">Draft ('.$total_draft_count.' )</a>';
	}

    if($total_trash_count > 0 )
	{
	    echo '
	    <a style="color:#000;" href="post-list.php?active_status=trash">Trash ('.$total_trash_count.')</a>';
	 }
	?>
	
    
  
	<!-- Bulk Actions -->
	
    <div class="row">
        <div class="container-fluid">
            <!-- <form method="post">
	<select name="bulkactions">
	    <option>Select An Action</option>
	    <option value="movetotrash">Move to trash</option>
	    <option value="draft">Draft</option>
	    <option value="published">Published</option>
	</select>    
	<input type="submit"  name="submitbulkactions" class="btn btn-primary">
    </form> -->
    
	</div>
	</div>
</div>
<div class="panel-body">
    
    <form action="" method="post">
   	<select name="bulkactions" style="padding:8px;">
	    <option>Select An Action</option>
	    <?php if (isset($_GET['active_status']) == 'trash'){?>
	    <option value="movetountrash">Move to Untrash</option>
	    <?php } elseif ($_GET['post_status'] == 'published'){?>
	    <option value="movetotrash">Move to trash</option>
	    <option value="draft">Draft</option>
	    <?php } elseif ($_GET['post_status'] == 'draft'){?>
	    <option value="movetotrash">Move to trash</option>
	    <option value="published">Published</option>
	    <?php } else { ?>
	    <option value="movetotrash">Move to trash</option>
	    <option value="draft">Draft</option>
	    <option value="published">Published</option>
	    <?php } ?>
	</select>    
	<input type="submit"  name="submitbulkactions" class="btn btn-primary">
   
       <!-- <input type="submit" name="submitbulkactions" value="Update"> -->
        
        
	<table class="table table-striped ">
	<thead>
		<tr>
		    <th><input type="checkbox" id="select_all" ></th>
			<th>S.NO</th>
			<th>Title</th>
			<th>Description</th>
			<th>Image</th>
			<th>Category</th>
			<th>Date</th>
			<th>Author</th>
			<th>Status</th>
			<th>Action</th>
			<th>Edit Post</th>
			<th>View Post</th>
			<?php if (isset($_GET['active_status']) == 'trash'){ echo '<th>Untrash post</th>'; } else { echo '<th>Trash post</th>';}?>
			<?php if (isset($_GET['active_status']) == 'trash'){ echo '<th>Delete Post</th>'; }?>
		   <th>View in pdf</th>
		</tr>
	</thead>
	<tbody >
	<?php
	
	 
        
       if($_GET['post_status'] == 'published'){
           
           $sql= "SELECT * from post p JOIN registration r ON p.author = r.email_address WHERE status = 'published' ORDER BY id DESC LIMIT $start_from,$per_page";
   
             $run_sql=mysqli_query($conn,$sql);
             while($rows = mysqli_fetch_assoc($run_sql))
             {
                 $description = strip_tags(htmlspecialchars_decode($rows['description'])); 
                echo '
              <tr>
                    <td><input type="checkbox" name="post_ids[]" id="post_ids[]" value="'.$rows['id'].'"></td>
        			<td>'.$rows['id'].'</td>
        			<td>'.$rows['title'].'</td>
        			<td>'.substr($description,0,50).'</td>
        			<td>'.($rows['image'] == '' ? 'No Image' : '<img src="../'.$rows['image'].'" width="50px;">').' </td>
        			<td>'.$rows['category'].'</td>
        			<td>'.$rows['date'].'</td>
        			<td>'.$rows['first_name'].' '.$rows['last_name'].'</td>
        			<td>'.$rows['status'].'</td>
        			<td>'.($rows['status'] == 'draft' ? '<a href="post-list.php?new_status=published&id='.$rows['id'].'" class="btn btn-primary btn-xs ">Publish</a> ': '<a href="post-list.php?new_status=draft&id='.$rows['id'].'" class="btn btn-info btn-xs ">Draft</a>' ).'</td>
        			<td><a href="edit_post.php?edit_id='.$rows['id'].'" class="btn btn-warning btn-xs ">Edit</a></td>
        			<td><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-success btn-xs ">View</a></td>
        			<td><a href="post-list.php?active_status=trash&trash_id='.$rows['id'].'" class="btn btn-default btn-xs">Trash</a></td>
        			<td><a href="fpdf.php?view_id='.$rows['id'].'" class="btn btn-primary btn-xs">View in PDF</a></td>
        		</tr>
        
                ';
             }
           
           
           
       }
       
      elseif ($_GET['post_status'] == 'draft'){
           
           $sql= "SELECT * from post p JOIN registration r ON p.author = r.email_address WHERE status = 'draft' ORDER BY id DESC LIMIT $start_from,$per_page";
   
             $run_sql=mysqli_query($conn,$sql);
             while($rows = mysqli_fetch_assoc($run_sql))
             {
           $description = strip_tags(htmlspecialchars_decode($rows['description'])); 
           echo '
            <tr>
                    <td><input type="checkbox" name="post_ids[]" id="post_ids[]" value="'.$rows['id'].'"></td>
        			<td>'.$rows['id'].'</td>
        			<td>'.$rows['title'].'</td>
        			<td>'.substr($description,0,50).'</td>
        			<td>'.($rows['image'] == '' ? 'No Image' : '<img src="../'.$rows['image'].'" width="50px;">').' </td>
        			<td>'.$rows['category'].'</td>
        			<td>'.$rows['date'].'</td>
        			<td>'.$rows['first_name'].' '.$rows['last_name'].'</td>
        			<td>'.$rows['status'].'</td>
        			<td>'.($rows['status'] == 'draft' ? '<a href="post-list.php?new_status=published&id='.$rows['id'].'" class="btn btn-primary btn-xs ">Publish</a> ': '<a href="post-list.php?new_status=draft&id='.$rows['id'].'" class="btn btn-info btn-xs ">Draft</a>' ).'</td>
        			<td><a href="edit_post.php?edit_id='.$rows['id'].'" class="btn btn-warning btn-xs ">Edit</a></td>
        			<td><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-success btn-xs ">View</a></td>
        			<td><a href="post-list.php?active_status=trash&trash_id='.$rows['id'].'" class="btn btn-default btn-xs">Trash</a></td>
        			<td><a href="fpdf.php?view_id='.$rows['id'].'" class="btn btn-primary btn-xs">View in PDF</a></td>
        		</tr>
        
           ';
             }
       }   
       
	  elseif (isset($_GET['active_status']) == 'trash'){
           
             $sql= "SELECT * from post p JOIN registration r ON p.author = r.email_address WHERE active = 1 ORDER BY id DESC LIMIT $start_from,$per_page";
   
             $run_sql=mysqli_query($conn,$sql);
             while($rows = mysqli_fetch_assoc($run_sql))
             {
                  $description = strip_tags(htmlspecialchars_decode($rows['description']));
                echo '
              <tr>
                    <td><input type="checkbox" name="post_ids[]" id="post_ids[]" value="'.$rows['id'].'"></td>    
        			<td>'.$rows['id'].'</td>
        			<td>'.$rows['title'].'</td>
        			<td>'.substr($description,0,50).'</td>
        			<td>'.($rows['image'] == '' ? 'No Image' : '<img src="../'.$rows['image'].'" width="50px;">').' </td>
        			<td>'.$rows['category'].'</td>
        			<td>'.$rows['date'].'</td>
        			<td>'.$rows['first_name'].' '.$rows['last_name'].'</td>
        			<td>'.$rows['status'].'</td>
        			<td>'.($rows['status'] == 'draft' ? '<a href="post-list.php?new_status=published&id='.$rows['id'].'" class="btn btn-primary btn-xs ">Publish</a> ': '<a href="post-list.php?new_status=draft&id='.$rows['id'].'" class="btn btn-info btn-xs ">Draft</a>' ).'</td>
        			<td><a href="edit_post.php?edit_id='.$rows['id'].'" class="btn btn-warning btn-xs ">Edit</a></td>
        			<td><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-success btn-xs ">View</a></td>
        		    <td><a href="post-list.php?untrash_id='.$rows['id'].'" class="btn btn-default btn-xs">Untrash</a></td>
        			<td><a onclick="return confirmDelete()" href="post-list.php?del_id='.$rows['id'].'" class="btn btn-danger btn-xs">Delete</a></td>
        			<td><a href="fpdf.php?view_id='.$rows['id'].'" class="btn btn-primary btn-xs">View in PDF</a></td>
        		</tr>
        
                ';
             }
           
       }
      
       else{
           
            $sql= "SELECT * from post p JOIN registration r ON p.author = r.email_address AND p.active = 0 ORDER BY id DESC LIMIT $start_from,$per_page";
   
             $run_sql=mysqli_query($conn,$sql);
             while($rows = mysqli_fetch_assoc($run_sql))
             {
                 $description = strip_tags(htmlspecialchars_decode($rows['description']));
                echo '
              <tr>
                    <td><input type="checkbox" name="post_ids[]" id="post_ids[]" value="'.$rows['id'].'"></td>
        			<td>'.$rows['id'].'</td>
        			<td>'.$rows['title'].'</td>
        			<td>'.substr($description,0,50).'</td>
        			<td>'.($rows['image'] == '' ? 'No Image' : '<img src="../'.$rows['image'].'" width="50px;">').' </td>
        			<td>'.$rows['category'].'</td>
        			<td>'.$rows['date'].'</td>
        			<td>'.$rows['first_name'].' '.$rows['last_name'].'</td>
        			<td>'.$rows['status'].'</td>
        			<td>'.($rows['status'] == 'draft' ? '<a href="post-list.php?new_status=published&id='.$rows['id'].'" class="btn btn-primary btn-xs ">Publish</a> ': '<a href="post-list.php?new_status=draft&id='.$rows['id'].'" class="btn btn-info btn-xs ">Draft</a>' ).'</td>
        			<td><a href="edit_post.php?edit_id='.$rows['id'].'" class="btn btn-warning btn-xs ">Edit</a></td>
        			<td><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-success btn-xs ">View</a></td>
        			<td><a href="post-list.php?active_status=trash&trash_id='.$rows['id'].'" class="btn btn-default btn-xs">Trash</a></td>
        			<td><a href="fpdf.php?view_id='.$rows['id'].'" class="btn btn-primary btn-xs">View in PDF</a></td>
        		</tr>
        
                ';
             }
           
       }
    
     

    

	?>
		
	</tbody>	
	</table>
	</form>
</div>
</div>
<div class="text-center" >
	
	<ul class="pagination">
	<?php
	
	if($_GET['post_status'] == 'published'){
	$sql_pagination= "SELECT * FROM post where status = 'published' ";
    $run_pagination = mysqli_query($conn,$sql_pagination);
    $count =  mysqli_num_rows($run_pagination);
    
    $total_pages= ceil($count / $per_page);
    
    
    for($i=1; $i<=$total_pages; $i++) { 
                    echo'
    
    <li><a href="post-list.php?post_status=published&page='.$i.'">'.$i.'</a></li>	 
    
    ';    
	     
	 }
	 }
	elseif($_GET['post_status'] == 'draft'){
	$sql_pagination= "SELECT * FROM post where status = 'draft' ";
    $run_pagination = mysqli_query($conn,$sql_pagination);
    $count =  mysqli_num_rows($run_pagination);
    
    $total_pages= ceil($count / $per_page);
    
    
    for($i=1; $i<=$total_pages; $i++) { 
                    echo'
    
    <li><a href="post-list.php?post_status=draft&page='.$i.'">'.$i.'</a></li>	 
    
    ';    
	     
	 }
	 }
	 else if(isset($_GET['active_status']) == 'trash'){
	 
	$sql_pagination= "SELECT * FROM post where active = 1 ";
    $run_pagination = mysqli_query($conn,$sql_pagination);
    $count =  mysqli_num_rows($run_pagination);
    
    $total_pages= ceil($count / $per_page);
    
    
    for($i=1; $i<=$total_pages; $i++) { 
                    echo'
    
    <li><a href="post-list.php?active_status=trash&page='.$i.'">'.$i.'</a></li>	 
    
    ';    
	     
	 }
	 }
	
    else{
    $sql_pagination= "SELECT * FROM post";
    $run_pagination = mysqli_query($conn,$sql_pagination);
    $count =  mysqli_num_rows($run_pagination);
    
    $total_pages= ceil($count / $per_page);
    
    
    for($i=1; $i<=$total_pages; $i++) { 
                    echo'
    
    <li><a href="post-list.php?page='.$i.'">'.$i.'</a></li>	 
    
    ';    
       }
    
}
?>

</ul>
</div>


</div>
</div>
</div>
<!-- Latest posts Section End-->
<body>

</body>
<footer></footer>
</html>