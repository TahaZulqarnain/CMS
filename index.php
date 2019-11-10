<?php 
session_start();
require_once 'facebook_api_config.php';
//require_once 'google_api_config.php'; 
include "db.php";
if(isset($_SESSION['fb_token'])){
    header('location: subscriber/profile.php');
}
$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
    
/*For Google Api

if(isset($_SESSION['userData'])){
    header('location: subscriber/profile.php');
}
$loginURL_Google ="";
$authUrl = $googleClient->createAuthUrl();
$loginURL_Google = filter_var($authUrl, FILTER_SANITIZE_URL);

/*Google Api End*/
 

$login_err='';
if(isset($_GET['login_error']))
{
	if($_GET['login_error'] == 'empty')
{
	$login_err= '<div class="alert alert-danger">The Username and Password is Empty!!</div>';
}
elseif($_GET['login_error'] == 'query_error'){
$login_err= '<div class="alert alert-danger">D
atabase Connection Error !!</div>';
}
elseif($_GET['login_error'] == 'wrong'){
$login_err='<div class="alert alert-danger">The Username or Password is incorrect !!!</div>';
}
}
else{}

$per_page=4;
if(isset($_GET['page']))
{
$page=$_GET['page'];
}	
else{
$page=1;
}
$start_from = ($page - 1) * $per_page;


/* Subcribe LIST */
$message='';


	if(isset($_POST['subscribe_submit']))
{
    if(empty($_POST['sub_email_address']))
{
	$message='<div class="alert alert-danger">Enter Your Email Address for subscribing to our newsletter</div>';
}
else{
    
	$email = $_POST['sub_email_address'];

    $sel_sql= "SELECT email_address FROM `subscribe-list` where email_address =  '".$email."' ";
    $run_sel_sql = mysqli_query($conn,$sel_sql);
    if(mysqli_num_rows($run_sel_sql) < 1)
    {
        $ins_sql="INSERT INTO `subscribe-list` (email_address,sub_status) VALUES ('$email','1')";
    $run_ins_sql = mysqli_query($conn,$ins_sql);



$to = $email;
$subject_email = "Welcome to cms.tahazulqarnain.com website";
$txt = '<html><body>';
$txt .= '<h1 style="color:#222222;">Hi There!</h1>';
$txt .= '<p style="color:#000000;font-size:18px;"> Welcome to our website. Update and new features are released daily. Please help us, create a simple,beautiful and ad free social network.</p>';
$txt .='<a href="www.cms.tahazulqarnain.com/unsub.php?unsub='.$email.'">Unsubscribe</a>';
$txt .= '</body></html>';



$headers = "From: tahazulqarnain44@gmail.com\r\n";
$headers .= "Reply-To: tahazulqarnain44@gmail.com\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

@mail($to,$subject_email,$txt,$headers,'-ftahazulqarnain44@gmail.com');

  
  
  if(@mail) {
 
$message='<div class="alert alert-success">Email has been send...Thanks For subscribing to our Newsletter</div>';
} else {
   
$message='<div class="alert alert-success">Thanks For subscribing to our Newsletter</div>';
}  

       
    }
    else{
       
     
    	$message='<div class="alert alert-danger">You are already subscribe to our newsletter</div>';
} 
        
}






}


if(isset($_POST['unsubscribe_submit']))
{
	$del_sql= "DELETE FROM `subscribe-list` WHERE email_address = $email ";
	$run_del_sql = mysqli_query($conn,$del_sql);
}

/* Subcribe LIST End */


?>
<!DOCTYPE html>
<html>
<head>
	<title>CMS System</title>
<meta name="google-site-verification" content="RSVWohyPtxBeLm5woiMwzvTxor5t_OUed2V_nNRJ1Qo" />


   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
 


   <style>
    .caption {
        width:100%;
        bottom: -0.7rem;
        padding: 20px;
        position: absolute;
        background:#000;
        background: -webkit-linear-gradient(bottom, #000 40%, rgba(0, 0, 0, 0) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        background: -moz-linear-gradient(bottom, #000 40%, rgba(0, 0, 0, 0) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        background: -o-linear-gradient(bottom, #000 40%, rgba(0, 0, 0, 0) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        background: linear-gradient(to top, #000 40%, rgba(0, 0, 0, 0) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    }

    .thumbnail {
        border: 0 none;
        box-shadow: none;
        margin:0;
        padding:0;
		position: absolute ;
    }

    .caption h4 {
        color: #fff;
        -webkit-font-smoothing: antialiased;
		font-size:25px;
    }
	.caption p {
        color: #fff;
        -webkit-font-smoothing: antialiased;
		font-size:16px;
    }
@media screen and (min-width: 320px) and (max-width:767px) {
	.thumbnail {
       
		position:relative !important;
    }
	
}

.modal-header .close {
    margin-top: -12px;
    color: green;
    opacity: 1;
}
.modal.in .modal-dialog {
    -webkit-transform: translate(0,0);
    -ms-transform: translate(0,0);
    -o-transform: translate(0,0);
    transform: translate(0,13vw) !important;
    /* left: 50%; */
}
a.title_link {
    color: #082148;
    text-decoration: none !important;
}

    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js">
 
</script>


    
    <script type="text/javascript">
setTimeout(function() {
    $('#myModal').modal();
}, 5000);
    </script>
    


</head>
<body>

	<?php include 'includes/header.php'; ?> 

	 <?php include 'includes/slider.php';?>
	
	<div class="container">

    <!-- POP up for Subscriber -->
    
      <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title text-center ">Weekly insider tech news</h2>
          <p class="text-center">Join thousands of techies, geeks, startup founders, entrepreneurs, and investors here.</p>
        </div>
        <div class="modal-body">
            <form method="post">
                  <div class="form-group">
        <label for="sub_email">Subcriber Email:</label>
          <input type="email" class="form-control" name="sub_email_address" Placeholder="Enter your Email Address"/>
      </div>
       
          <button type="submit" class="btn btn-success btn-block" name="subscribe_submit">Subcribe to our Newsletter</button>
            </form>
      
          <div style="width:20px;height:20px;"></div>
         <?php echo $message;?>
        </div>
        
      </div>
      
    </div>
  </div>
    
	  <!--End POP up for Subscriber -->	
	<article class="row">

		<section class="col-md-8">

               	<div style="width:50px; height:50px;"></div>
               			<?php echo $login_err; ?>
            <?php 
             $sql = "SELECT * FROM post where status= 'published' AND active = 0 ORDER BY id DESC LIMIT $start_from,$per_page";
             $run_sql = mysqli_query($conn,$sql);
             while($rows=mysqli_fetch_array($run_sql))
             {
                 $description = htmlspecialchars_decode($rows['description']);  
             	echo'
            <div class="panel panel-success">
			<div class="panel-heading"><h3><a class="title_link" href="post.php?post_id='.$rows['id'].'">'.$rows['title'].'</a></h3></div>
			 <div class="panel-body">
                <div class="col-md-6">
               '.($rows['image'] == '' ? '<img src="images/placeholder.png" width="100%;">' : '<img src="../'.$rows['image'].'" width="100%;">').'

				</div>
                <div class="col-md-6">
                <p>'.substr($description,0,250).'</p>
                <a class="btn btn-primary" href="post.php?post_id='.$rows['id'].'">Read More</a>
				</div>
				
				</div>
			</div>';
             }



		    ?>

	<div class="text-center">
<ul class="pagination">
<?php
$sql_pagination= "SELECT * FROM post where status = 'published' AND active = 0";
$run_pagination = mysqli_query($conn,$sql_pagination);
$count =  mysqli_num_rows($run_pagination);

$total_pages= ceil($count / $per_page);

for ($i=1; $i<=$total_pages ; $i++) { 
echo'

<li><a href="index.php?page='.$i.'">'.$i.'</a></li>	 

';


}

	?>	
	</ul>
</div>

					</section>
 

	
<aside class="col-md-4">
	<div style="width:50px; height:50px;"></div>
           <div class="panel-group">
            <div class="panel panel-default">
            <div class="panel-heading">
               <h4>Search Something</h4>
            </div>
            <div class="panel-body">
               <form action="search.php" method="get" >
               <div class="input-group">
                  <input class="form-control" type="Search" name="search" placeholder="Search...">
                  <div class="input-group-btn">
                  <button class="btn btn-default" name="submit_search" type="submit"><i class="glyphicon glyphicon-search "></i></button>
                  </div>
               </div>
                  
               </form>
            </div>
               
            </div>
         <div class="panel panel-default">
         <div class="panel-heading">
            <h4>Login Area</h4>
            </div>
            <div class="panel-body">
               <form class="form-horizontal" role="form" method="post" action="accounts/login.php">
                    <div class="form-group">
                        <label for="email" class="control-label col-sm-4">Username:</label>  
                        <div class="col-sm-8">
                  <input type="email" id="email" name="username" placeholder="Email Address" class="form-control">
                  </div>
                  </div>
                         <div class="form-group">
                           <label for="pwd" class="control-label col-sm-4">Password:</label>
                           <div class="col-sm-8">
                           <input type="Password" name="password" placeholder="Password" id="pwd" class="form-control">
                         </div>
                         </div>
                         <div class="form-group">
                         <label class="col-sm-4"></label>
                         <div class="col-sm-8">
                         <button type="submit" name="login_submit" class="btn btn-success">Login</button>
                         
                           </div>
                         </div>
               </form>
                     <div class="col-sm-4"> </div>
                         <div class="col-sm-8">
                     <a href="http://www.cms.tahazulqarnain.com/accounts/forget_password.php">Forget Your Password?</a>
                          </div>

                     <p class="text-center"> Don't have an account? <a href="https://www.cms.tahazulqarnain.com/registration.php"> Sign Up</a></p>

                    <br>
                    <a href="<?= htmlspecialchars( $loginURL ); ?>"><img style="width:300px;" src="images/loginfacebook.png" class="fbbutton" alt="Login With Facebook"></a>
                    <br><br>
                    <a href="<?= htmlspecialchars( $loginURL_Google ); ?>"><img style="width:300px;" src="images/logingoogle.png" class="fbbutton" alt="Login With Google"></a>
                    </div>

               </div>


                    </div>
                  


                  <div class="list-group">
               <?php 
                     $sql= "SELECT * FROM post where status='published' AND active = 0 ORDER BY id DESC limit 2";
                     $run_sql_post= mysqli_query($conn,$sql);
                     while ($rows_post_sidebar=mysqli_fetch_assoc($run_sql_post)) {
                         $description = strip_tags(htmlspecialchars_decode($rows_post_sidebar['description']));
                        if(isset($_GET['post_id']))
                        {
                           if ($_GET['post_id'] == $rows_post_sidebar['id']) {
                             $class = 'active';
                           }
                           else
                           {
                              $class = '';
                           }

                        }
                        else{

                           $class="";
                        }

                        echo '
                        <a class="list-group-item '.$class.' " href="post.php?post_id='.$rows_post_sidebar['id'].'"  >
                     <div class="col-sm-4">
                    
                     '.($rows_post_sidebar['image'] == '' ? '<img src="images/placeholder.png" width="100%;">' : '<img src="../'.$rows_post_sidebar['image'].'" width="100%;">').'
                     
                     </div>
                     <div class="col-sm-8">
                     <h4 class="list-group-item-heading">'.$rows_post_sidebar['title'].'</h4>
                     <p class="list-group-item-text">'.substr($description,0,50).'</p>
                     </div>
                     <div style="clear:both;"></div>

                  </a>
                  
                  
                        ';
                        
                     }
                ?>
                  
               </div>

        </aside>

</article>


	</div>
	<div style="width:50px; height:50px;"></div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>