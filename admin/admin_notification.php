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


if(isset($_POST['is_seen'])){
    
if($_POST['is_seen'] != ''){
    
   $update_query = "UPDATE tbl_notifications SET Is_Seen = 1 WHERE Is_Seen=0";
   mysqli_query($conn, $update_query);
    
}


/*$select_query = "
SELECT N.post_id,PC.name as name ,PC.post_name as post_name, PLU.user_email_address as plu_user_email_address,
PC.email as pc_user_email_address,PLU.type as lu_type, N.notification_type as notification_type
FROM notifications AS N
LEFT JOIN post_comments AS PC
ON N.post_id = PC.id
LEFT JOIN post_like_unlike AS PLU
ON N.post_id = PLU.post_id
WHERE N.is_seen = 0
GROUP BY N.notification_id 
ORDER BY N.notification_id DESC";*/

$select_query = "select N.Notification,N.CurrentDate,N.Post_ID,NT.Notification_Type_Name from tbl_notifications as N left join tbl_notification_types as NT ON N.Notification_Type_ID = NT.Notification_Type_ID ORDER BY `Notification_ID` DESC LIMIT 5";

$run_select_query = mysqli_query($conn,$select_query);
$output = '';
if(mysqli_num_rows($run_select_query) > 0){
while( $rows = mysqli_fetch_array($run_select_query)){
    
$Notification_Type_ID    =              $rows["Notification_Type_ID"];
$Notification            =              $rows["Notification"]; 
$Notification_Type_Name  =              $rows["Notification_Type_Name"];
$Post_ID                 =              $rows["Post_ID"];
$Notification_For        =              $rows["Notification_For"]; 
$Is_Seen                 =              $rows["Is_Seen"];
$Is_Read                 =              $rows["Is_Read"];
$CurrentDate             =              $rows["CurrentDate"];
date_default_timezone_set("Asia/Karachi");
$timestamp = strtotime($CurrentDate);
$currentTime = time();

$Result_Time_Ago = TimeAgo($timestamp);

    
    if($Notification_Type_Name == 'comment'){
          $output .= '<li><a href="comment-list.php">'.$Notification.' <br> '.$diff.'  '.$Result_Time_Ago.' </a></li> 
  '; 
        
    }
     else if ($Notification_Type_Name == 'likeunlike'){
        
        if($lu_type == 1){
            $lu_type = 'likes';
        }
        else{
            $lu_type = 'unlike';
        }
        
       $output .= '<li><a target="_blank" href="https://www.cms.tahazulqarnain.com/post.php?post_id='.$Post_ID.'">'.$Notification.' <br> '.$diff.'  '.$Result_Time_Ago.'</a></li> 
  '; 
    }
     else if ($Notification_Type_Name == 'new_subscriber'){
         
        $output .= '<li><a href="#">'.$Notification.' <br> '.$diff.'  '.$Result_Time_Ago.'</a></li> 
  '; 
    
    }   
    else if ($Notification_Type_Name == 'contact_form'){
        
        $output .= '<li><a href="#">'.$Notification.'  <br> '.$diff.'  '.$Result_Time_Ago.'</a></li> 
  '; 
    
    }    
    
    
  
    
}
}
else{
    
$select_query = "
select N.Notification,N.CurrentDate,NT.Notification_Type_Name,N.Post_ID from tbl_notifications as N left join tbl_notification_types as NT ON N.Notification_Type_ID = NT.Notification_Type_ID ORDER BY `Notification_ID` DESC LIMIT 5";
$run_select_query = mysqli_query($conn,$select_query);
 
$output = '';
if(mysqli_num_rows($run_select_query) > 0){
while( $rows = mysqli_fetch_array($run_select_query)){
    
    
$Notification_Type_ID    =              $rows["Notification_Type_ID"];
$Notification            =              $rows["Notification"]; 
$Notification_Type_Name  =              $rows["Notification_Type_Name"];
$Post_ID                 =              $rows["Post_ID"];
$Notification_For        =              $rows["Notification_For"]; 
$Is_Seen                 =              $rows["Is_Seen"];
$Is_Read                 =              $rows["Is_Read"];
$CurrentDate             =              $rows["CurrentDate"];
date_default_timezone_set("Asia/Karachi");
$timestamp = strtotime($CurrentDate);
$currentTime = time();
 

$Result_Time_Ago = TimeAgo($timestamp);

    
    if($Notification_Type_Name == 'comment'){
          $output .= '<li><a href="comment-list.php"> '.$Notification.' <br> '.$diff.'  '.$Result_Time_Ago.'</a></li>
          
  ';
        
    }
    else if ($Notification_Type_Name == 'likeunlike'){
        
        if($lu_type == 1){
            $lu_type = 'likes';
        }
        else{
            $lu_type = 'unlike';
        }
        
        $output .= '<li><a target="_blank" href="https://www.cms.tahazulqarnain.com/post.php?post_id='.$Post_ID.'">'.$Notification.' <br> '.$diff.'  '.$Result_Time_Ago.'</a></li>'
  ; 
    }
    else if ($Notification_Type_Name == 'new_subscriber'){
         
        $output .= '<li><a href="#">'.$Notification.' <br> '.$diff.'  '.$Result_Time_Ago.'</a></li> 
  '; 
    
    }    
    else if ($Notification_Type_Name == 'contact_form'){
         
        $output .= '<li><a href="#">'.$Notification.' <br> '.$diff.'  '.$Result_Time_Ago.'</a></li> 
  '; 
    
    }    
    
    
  
    
} 
 
    
    
}
}

/*$status_query = "SELECT COUNT(*) AS notification FROM post_comments WHERE is_seen=1";
$result_query = mysqli_query($conn, $status_query);
$notification_label_count = mysqli_fetch_array($result_query);
$notification_count = $notification_label_count['notification'];*/

$status_query = "SELECT * FROM tbl_notifications WHERE Is_Seen=0";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);


$data = array(
   'notification' => $output,
   'notification_count'  => $count
);
//$return_arr = array("notification"=>$output,"unseen_notification"=>$count);
 
echo json_encode($data);
}

function TimeAgo($timestamp){
    $strTime = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
$length = array("60","60","24","7","4.35","12","10");
//$length = array("1","60","3600","86400","604800","2600640","31207680");
	  $currentTime = time();
	   
	   if($currentTime >= $timestamp) {
			$diff     =  time() - $timestamp  ;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

	     	$diff = round($diff);
		return "about " . $diff . " " . $strTime[$i] ."".($diff > 1 ? 's' : '')." ago ";
	   }   
    
    
}

?>
