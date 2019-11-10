<?php
  session_start();
  date_default_timezone_set("Asia/Karachi");
include 'db.php';
$comment_result='';
$result = '';
/*if(isset($_POST['comments'])) 
{*/

if (isset($_SESSION['user']) && isset($_SESSION['password'])  == true) {
  $sql="SELECT * FROM registration where email_address='$_SESSION[user]' AND password='$_SESSION[password]'";
  if($result=mysqli_query($conn,$sql)){
    while ($rows = mysqli_fetch_assoc($result)) {
           $user_first_name = $rows['first_name'];
           $user_last_name = $rows['last_name'];
           $user_email_address = $rows['email_address'];
         }
  if(mysqli_num_rows($result) == 1 ){

   }
else
{
    $comment_result= '<div class="alert alert-success">You&apos;ve not Successfully connected to the database </div>';
}



$Notification_Type_ID = 1;
$post_name = $_POST['post_name'];
$Notification = $user_first_name ." commented on ". $post_name;
$Post_ID = $_POST['post_id'];
$Notification_For = "admin";
$Is_Seen = 0;
$Is_Read = 0;

$date= date('Y-m-d h:i:s') ;
$ins_comment = "INSERT INTO post_comments (id,post_name,name,email,comments,status,date) VALUES ('$_POST[post_id]','$_POST[post_name]','$user_first_name','$user_email_address','$_POST[comments]','disapproved','$date')";

CreateNotification($Notification_Type_ID,$Notification,$Post_ID,$Notification_For,$Is_Seen,$Is_Read,$date);

if( mysqli_query($conn,$ins_comment))
   {
     $comment_result= '<div class="alert alert-success">You&apos;ve Successfully added comment on this post </div>';
   }


      else{
           $comment_result= '<div class="alert alert-danger">You are not connected to database</div>';
      }

// initalizing array
$return_arr = array("comment_error"=>$comment_result);
echo json_encode($return_arr);



  }
}

else{
 $comment_result= '<div class="alert alert-danger">You must login to comment on this post </div>';
 
 // initalizing array
$return_arr = array("comment_error"=>$comment_result);

echo json_encode($return_arr);


}


function CreateNotification($Notification_Type_ID,$Notification,$Post_ID,$Notification_For,$Is_Seen,$Is_Read,$date){
      global $conn;
$ins_comment_notification = "INSERT INTO tbl_notifications (Notification_Type_ID,Notification,Post_ID,Notification_For,Is_Seen,Is_Read,CurrentDate) VALUES ($Notification_Type_ID,'$Notification','$Post_ID','$Notification_For',$Is_Seen,$Is_Read,'$date')";
mysqli_query($conn,$ins_comment_notification);
    
}







?>