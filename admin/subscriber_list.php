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

$error_message= '';

if(isset($_POST['submit_template']))
{
    
  if(!empty($_POST['email_type']) && !empty($_POST['email_title']) && !empty($_POST['email_content']))
  {
    $type = $_POST['email_type'];
    $title =  strip_tags($_POST['email_title']);
    $content = mysqli_real_escape_string($conn,$_POST['email_content']);
    $new_content = strip_tags($content);
    $date = date("Y-m-d H:i:s");
    
    $ins_sql = "INSERT INTO `email_template` (`email_type`,`email_title`,`email_content`,`email_created`,`email_status`) values ('$type','$title','$new_content','$date','1')";
  
       if(mysqli_query($conn,$ins_sql))
     {
       $error_message = '<div class="alert alert-success">Template for email is created succesfully</div>';
       
     }
     else{
       
       $error_message = '<div class="alert alert-dangerous">Template for email is not created succesfully</div>';
     }
  }
  
}
else{
  
    //  echo 'please submit form to create email template'; 
    
  }
?>

<?php

if(isset($_POST['set_is_submit'])){
    $subject        = $_POST['set_email_title'];
    $message        = $_POST['set_email_content'];
    
    

    
    $select_subscriber ="SELECT email_address FROM `subscribe-list` ";
    $run_select_subscriber = mysqli_query($conn,$select_subscriber);
    while($rows = mysqli_fetch_assoc($run_select_subscriber)){
        $email = $rows['email_address']; 
    
    $from = "info@tahazulqarnain.com";    
    $mailheader = "From: ".$from."\r\n"; 
	$mailheader .= "Reply-To: ".$from."\r\n"; 
	$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$MESSAGE_BODY = "Name: ".$subject."<br>"; 
	$MESSAGE_BODY .= "Email: ".$from."<br>";

    $to = "$email";
    $subject_email = "$subject";
    $txt = "$message";
    
    $headers = "From: ".$from . "\r\n";
    $headers .= "Reply-To: ".$from."\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        
        
        
        @mail($to,$subject_email,$txt,$headers,'-finfo@tahazulqarnain.com');
     }
     
    if(@mail) {
     $email_send= '<div class="alert alert-success">Admin email template send to all subscriber</div>';
    } else {
       $email_send= '<div class="alert alert-danger">Admin email template not send to all subscriber.</div>';
    }   

    
 
  
  
    
     
}

if(isset($_GET['sub_status']))
{
$new_status=$_GET['sub_status'];
//$update_query= "UPDATE subscribe-list SET sub_status= b'$new_status' where id='$_GET[id]'";
$update_query= "UPDATE `subscribe-list` SET `sub_status` = b'$new_status' WHERE `subscribe-list`.`id` = '$_GET[id]'";

if($run=mysqli_query($conn,$update_query))
{
$result ='<div class="alert alert-success">Status is updated Successfully</div>';
}
else
{
$result ='<div class="alert alert-danger">Status is not updated</div>';
}

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

 
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<script>
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#email_fetch_template").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
      var alltemplate = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
      var dataString = "alltemplate="+alltemplate; /* STORE THAT TO A DATA STRING */

      $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "subscriber_list_fetch.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: dataString, /* THE DATA WE WILL BE PASSING */
       // data: { email_fetch_template : dataString },
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#show").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
    
// open action button dropdown    
$("#sub_action_btn").click(function(){
var class_anchor = $("#subscriber").attr('class');
if (class_anchor === "dropdown open")
{
$("#subscriber").removeClass("open");
}
else{
$("#subscriber").addClass("open");
}
});
    
  });
</script>
<style>
.open > .dropdown-menu {
    display: block;
}
button#sub_action_btn {
    color: #fff;
    background: #222222;
    border: #222;
}
.actions_link {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
    padding: 3px 8px !important;
}
#subscriber {
    display: inline-block;
    float: right;
    padding-top: 16px;
}
ul#subscriber_action {
    left: -77px !important;
}
</style>
</head>
<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->
<div style="width: 50px; height: 50px; " ></div>
<!-- User Section Start-->
<div style="margin-left:25%">
<div class="col-lg-12">
<body>
   <!-- <div class="panel panel-default">
        <div class="panel-heading">
             <i class="glyphicon glyphicon-play-circle" style="display: inline-block;font-size: 21px;"></i>
                 <h3 class="text-left" style="display:inline-block;">Add Template</h3> -->
                
                 
                 <!-- <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#email_Modal">Add Template</button> -->

        <!-- Modal -->
        <div id="email_Modal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Subscriber Email Template</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="subscriber_list.php" method="post" >
                <div class="form-group">
                <label for="type" class="control-label col-sm-2">Email Type</label>
                <div class="col-sm-8">
                <input type="text" name="email_type" class="form-control">
                </div>
                </div>
                <div class="form-group">
                <label for="type" class="control-label col-sm-2">Email Title</label>
                <div class="col-sm-8">
                <input type="text" name="email_title" class="form-control">
                </div>
                </div>
                <div class="form-group">
                <label for="content" class="control-label col-sm-2">Email Content</label>
                <div class="col-sm-8">
                <textarea name="email_content" class="form-control"></textarea>
                </div>
                </div>
                
                 <div class="form-group">
                <label for="content" class="control-label col-sm-2"></label>
                        <div class="col-sm-8">
                            <input type="submit" name="submit_template" value="Add template" class="btn btn-success">
                        </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        
          </div>
        </div>
      <!--  </div>
        
        
    </div> -->
    <?php echo $error_message; ?>
    <div class="panel panel-default">
        <div class="panel-heading">
             <i class="glyphicon glyphicon-play-circle" style="display: inline-block;font-size: 21px;"></i>
                 <h3 style="display:inline-block;">Subcriber List</h3>
       
      <div class="dropdown" id="subscriber">
        <button type="button" id="sub_action_btn" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" data-target="#subscriber_action" aria-expanded="false">Actions <span class="caret"></span></button>
        <ul class="dropdown-menu" id="subscriber_action" >
            <li><a class="actions_link" href="javascript:void(0)" data-toggle="modal" data-target="#email_Modal"><span class="glyphicon glyphicon-plus"></span> Add Template</a></li>
            <li><a class="actions_link" href="javascript:void(0)" data-toggle="modal" data-target="#email_send_Modal"><span class="glyphicon glyphicon-envelope"></span> Send Email To list</a></li>
            
        </ul>
        </div>
       
       
        
                  <!-- <button type="button" class="btn btn-success btn-lg pull-right" data-toggle="modal" data-target="#email_send_Modal">Send Email To list</button> -->
                 
                
        </div>
        <div class="panel-body">
           
             <!-- Modal -->
        <div id="email_send_Modal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send Email Template</h4>
                <div><?php echo $email_send;?></div>
              </div>
              
              <div class="modal-body">
                
                <div class="form-group col-sm-12">
                <label for="type" class="control-label col-sm-2">Type</label>
                <div class="col-sm-8">
                  <?php 

                 $sql = "SELECT * FROM email_template";
                 $run_sql = mysqli_query($conn,$sql);
                 ?>
                <select name="email_fetch_template" id="email_fetch_template" >
                
                <option value="">Select a option</option>
               <?php
                 while( $temp_rows = mysqli_fetch_assoc($run_sql))
                 {
                   $email_template = $temp_rows['email_type'];
                
                    
            ?>
                    <option value="<?php echo $email_template;?>"><?php echo $email_template;?></option>


              <?php      
                 }
                 
                ?>
                
                </select>
                
                </div>
                </div>
                
            
                <div id="show"></div>
                  
                  
      
               
              </div>
              <div class="modal-footer" style="border:none;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        
          </div>
        </div>
            
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Subsciber Email</th>
                        <th>Subsciber Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sel_sql = "SELECT * FROM `subscribe-list` ";
                    $run_sel_sql = mysqli_query($conn,$sel_sql);
                    while( $rows= mysqli_fetch_assoc($run_sel_sql))
                    {
                        echo '
                        <tr>
                        <td>'.$rows['id'].'</td>
                        <td>'.$rows['email_address'].'</td>
                        <td>'.($rows['sub_status'] ? 'Active' : 'Inactive' ).'</td>
                        <td>'.($rows['sub_status'] == 1 ? '<a href="subscriber_list.php?sub_status=0&id='.$rows['id'].'" class="btn btn-primary btn-xs ">Inactive</a> ': '<a href="subscriber_list.php?sub_status=1&id='.$rows['id'].'" class="btn btn-info btn-xs ">Active</a>' ).'</td>
        			
                        </tr>
                        
                        ';
                    }
                    
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
   
    
</body>
</html>
