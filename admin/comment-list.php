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
$result = '';
if(isset($_GET['status']))
{
$new_status=$_GET['status'];
$update_query= "UPDATE post_comments SET status='$new_status' where post_comment_id='$_GET[id]'";
if($run=mysqli_query($conn,$update_query))
{
$result ='<div class="alert alert-success">Comments is Successfully '.$new_status.' for post </div>';
}
else
{
$result ='<div class="alert alert-danger">Comments is not updated successfully</div>';
}

}

if(isset($_GET['del_id']))
{
	$del_id = "DELETE FROM post_comments where post_comment_id ='$_GET[del_id]'";
	$run_del_id = mysqli_query($conn,$del_id);
	if(($run_del_id == 1)){
	    $result ='<div class="alert alert-danger">Comments has been deleted successfully</div>';
	}
	else{
	    $result ='<div class="alert alert-danger">Query is not working</div>';
	}
}

/*
if($_POST['postcomment_id']){

$comment_action = $_POST['comment_action'];
$postcomment_id = $_POST['postcomment_id'];
$ca_update_query= "UPDATE post_comments SET status='$comment_action' where post_comment_id='$postcomment_id'";
mysqli_query($conn,$ca_update_query);    


$select_sql = "SELECT * FROM post_comments where post_comment_id = '$postcomment_id'";
$result_query = mysqli_query($conn, $select_sql);
while($rows = mysqli_fetch_assoc($result_query))
{

$status = $rows['status'];
}
//$status = mysqli_num_rows($result_query);

 $data = array(
   'comment_action' => $comment_action,
   'status'  => $status,
    'postcomment_id' => $postcomment_id
);
//$return_arr = array("notification"=>$output,"unseen_notification"=>$count);
 
echo json_encode($data);
    
}
*/
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
 <!--  <script src="js/admin.js"></script> -->
</head>
<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->
<div style="width: 50px; height: 50px; " ></div>
<!-- Latest comments Section Start-->
<div style="margin-left:25%">
<div class="col-lg-12">
<?php echo $result; ?>
<div class="col-md-12">
<div class="panel panel-default">
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
			<th>Status</th>
			<th>Action</th>
			<th>Delete</th>
		
		</tr>
	</thead>
	<tbody>
	<?php
     $sql = "SELECT * FROM post_comments";
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
            <td>'.$rows['status'].'</td>
			<td>'.($rows['status'] == 'disapproved' ? '<a href="comment-list.php?status=approved&id='.$rows['post_comment_id'].'" class="btn btn-success btn-xs">Approved</a>' : '<a href="comment-list.php?status=disapproved&id='.$rows['post_comment_id'].'" class="btn btn-info btn-xs">Disapproved</a>' ).'  </td>
			<td><a onclick="return confirmDelete()" href="comment-list.php?del_id='.$rows['post_comment_id'].'"  class="btn btn-danger btn-xs">Delete</a></td>
		</tr>
		

';
$count++;
        }
	?>
		
	</tbody>	
	</table>
</div>
</div>
</div>
</div>
</div>
<!-- Latest comments Section End-->

<body>

</body>
<footer></footer>
</html>
