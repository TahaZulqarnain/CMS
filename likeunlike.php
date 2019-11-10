<?php
 session_start();
 date_default_timezone_set("Asia/Karachi");
include 'db.php';
$result1='';
$result = '';


if (isset($_SESSION['user']) && isset($_SESSION['password'])  == true) {
  $sql="SELECT * FROM registration where email_address='$_SESSION[user]' AND password='$_SESSION[password]'";
  if($result=mysqli_query($conn,$sql)){
    while ($rows = mysqli_fetch_assoc($result)) {
           $user_first_name = $rows['first_name'];
           $user_email_address = $rows['email_address'];
         }
  if(mysqli_num_rows($result) == 1 ){

   }
else
{
    $result1= '<div class="alert alert-success">You&apos;ve not Successfully connected to the database </div>';
}

$post_id = $_POST['post_id'];
$date= date('Y-m-d h:i:s');
$type= $_POST['type'];
$post_name = $_POST['post_name'];



$select_query = "SELECT * from post_like_unlike where user_email_address = '$user_email_address' AND post_id = $post_id";
$select_result = mysqli_query($conn,$select_query);




if(mysqli_num_rows($select_result) == 0 ){
    
    $ins_query = "INSERT INTO `post_like_unlike` (`id`, `user_email_address`, `post_id`, `post_name`, `type`, `date`) VALUES (NULL, '$user_email_address', '$post_id', '$post_name' , '$type', '$date')";
   mysqli_query($conn,$ins_query);
   
   if($type == 0){
       
       
         $ins_lul_notification ="INSERT INTO tbl_notifications (Notification_Type_ID,Notification,Post_ID,Notification_For,Is_Seen,Is_Read,CurrentDate) VALUES (2,'$user_first_name Unlike $post_name','$_POST[post_id]','admin',0,0,'$date')";

         //$ins_lul_notification = "INSERT INTO notifications (post_id,notification_type,is_seen,date) VALUES ('$_POST[post_id]','unlike',0,'$date')";
         mysqli_query($conn,$ins_lul_notification);
   }
   else{
        //$ins_lul_notification = "INSERT INTO notifications (post_id,notification_type,is_seen,date) VALUES ('$_POST[post_id]','like',0,'$date')";
         $ins_lul_notification ="INSERT INTO tbl_notifications (Notification_Type_ID,Notification,Post_ID,Notification_For,Is_Seen,Is_Read,CurrentDate) VALUES (2,'$user_first_name likes $post_name','$_POST[post_id]','admin',0,0,'$date')";
         mysqli_query($conn,$ins_lul_notification);
   }
 
    
}
else{
      $update_query = "UPDATE post_like_unlike SET type=$type where user_email_address = '$user_email_address' AND post_id = $post_id ";
      mysqli_query($conn,$update_query);
      
       
            
        }
      
       
      


// count numbers of like and unlike in post
$like_query = "SELECT COUNT(*) AS cntLike FROM post_like_unlike WHERE type=1 and post_id=".$post_id;
$like_result = mysqli_query($conn,$like_query);
$fetchlikes = mysqli_fetch_array($like_result);
$totalLikes = $fetchlikes['cntLike'];

$unlike_query = "SELECT COUNT(*) AS cntUnlike FROM post_like_unlike WHERE type=0 and post_id=".$post_id;
$unlike_result = mysqli_query($conn,$unlike_query);
$fetchunlikes = mysqli_fetch_array($unlike_result);
$totalUnlikes = $fetchunlikes['cntUnlike'];

// initalizing array
$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

echo json_encode($return_arr);







  }
}
else{
 $result1= '<div class="alert alert-danger">You must login to Like/Unlike on this post </div>';
 
 $return_arr = array("error"=>$result1);
 echo json_encode($return_arr);
}








?>
