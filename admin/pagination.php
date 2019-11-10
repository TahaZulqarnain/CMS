
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


<?php

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
//$sql = "SELECT * FROM posts ORDER BY title ASC LIMIT $start_from, $limit";  
 $sql= "SELECT * from post p JOIN registration r ON p.author = r.email_address ORDER BY id DESC LIMIT $start_from, $limit";

$rs_result = mysqli_query ($conn,$sql);  
?>
<table class="table table-bordered table-striped">  
	<thead>
		<tr>
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
			<th>Delete Post</th>
		   <th>View in pdf</th>
		</tr>
	</thead> 
<tbody>  
<?php 
     while($rows = mysqli_fetch_assoc($rs_result))
     {
echo '
      <tr>
			<td>'.$rows['id'].'</td>
			<td>'.$rows['title'].'</td>
			<td>'.substr($rows['description'],0,50).'</td>
			<td>'.($rows['image'] == '' ? 'No Image' : '<img src="../'.$rows['image'].'" width="50px;">').' </td>
			<td>'.$rows['category'].'</td>
			<td>'.$rows['date'].'</td>
			<td>'.$rows['first_name'].' '.$rows['last_name'].'</td>
			<td>'.$rows['status'].'</td>
			<td>'.($rows['status'] == 'draft' ? '<a href="post-list.php?new_status=published&id='.$rows['id'].'" class="btn btn-primary btn-xs ">Publish</a> ': '<a href="post-list.php?new_status=draft&id='.$rows['id'].'" class="btn btn-info btn-xs ">Draft</a>' ).'</td>
			<td><a href="edit_post.php?edit_id='.$rows['id'].'" class="btn btn-warning btn-xs ">Edit</a></td>
			<td><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-success btn-xs ">View</a></td>
			<td><a onclick="return confirmDelete()" href="post-list.php?del_id='.$rows['id'].'" class="btn btn-danger btn-xs">Delete</a></td>
			<td><a href="fpdf.php?view_id='.$rows['id'].'" class="btn btn-primary btn-xs">View in PDF</a></td>
		</tr>

';
     }


     

    

	?>
</tbody>  
</table>    