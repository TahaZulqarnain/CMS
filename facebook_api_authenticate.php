<?php 
date_default_timezone_set("Asia/Karachi");
$date= date("Y-m-d H:i:s");
require_once 'facebook_api_config.php';
include 'db.php';
if(isset($_REQUEST['code'])){
    header('Location: facebook_api_authenticate.php');
}
############ Set Fb access token ############
if(isset($_SESSION['fb_token'])){
        $fb->setDefaultAccessToken($_SESSION['fb_token']);
}
else{
    $_SESSION['fb_token'] = (string) $accessToken;
    $oAuth2Client = $fb->getOAuth2Client();
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_token']);
    $_SESSION['fb_token'] = (string) $longLivedAccessToken;
    $fb->setDefaultAccessToken($_SESSION['fb_token']);
}
############ Fetch data from graph api  ############
try {
    $profileRequest = $fb->get('/me?fields=id,name,email,first_name,last_name,link,gender,locale');
    $fbUserProfile = $profileRequest->getGraphUser()->asArray();
    // $fbUserProfile = $profileRequest->getGraphNode()->asArray();
} catch(FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    header("Location: ./");
    exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    session_destroy();
    header("Location: ./");
    exit;
}

/*echo "<pre>";
var_dump($fbUserProfile);*/
############ Store data in database  ############
/*$userData = array(
        'oauth_provider'=> 'facebook',
        'oauth_uid'     => $fbUserProfile['id'],
        'first_name'    => $fbUserProfile['first_name'],
        'last_name'     => $fbUserProfile['last_name'],
        'email'         => $fbUserProfile['email'],
        'gender'        => $fbUserProfile['gender'],
        'locale'        => $fbUserProfile['locale'],
        'cover'         => $fbUserProfile['cover']['source'],
        'picture'       => $fbUserProfile['picture']['url'],
        'link'          => $fbUserProfile['link']
    );
   
    $userData = $fbUserData;
    // Put user data into session
    $_SESSION['userData'] = $userData;
    
    header("Location: subscriber/profile.php");
*/



$oauth_provider = "facebook";
$oauth_uid = $fbUserProfile['id'];
$first_name = $fbUserProfile['first_name'];
$last_name = $fbUserProfile['last_name'];
$email_address = $fbUserProfile['email'];
$password = "";
$gender = $fbUserProfile['gender'];
$role = "subscriber";
$locale = $fbUserProfile['locale'];
$cover = $fbUserProfile['cover']['source'];
$picture = $fbUserProfile['picture']['url'];
$link = $fbUserProfile['link'];
$created = $date;
$last_modified = "admin";

//ECHOING ALL DATA 
/*echo $oauth_provider ?><br><?php;
echo $oauth_uid ?><br><?php;
echo $first_name ?><br><?php;
echo $last_name ?><br><?php;
echo $email_address ?><br><?php;
echo $password ?><br><?php;
echo $gender ?><br><?php;
echo $role?><br><?php;
echo $locale?><br><?php;
echo $cover?><br><?php;
echo $picture?><br><?php;
echo $link?><br><?php;
echo $created?><br><?php;
echo $last_modified?><br><?php;*/

//Storing all result to session variables
$_SESSION['oauth_provider']             = "facebook";
$_SESSION['oauth_uid']                  =  $oauth_uid;
$_SESSION['first_name']                 =  $first_name;           
$_SESSION['last_name']                  =  $last_name;
$_SESSION['email_address']              =  $email_address;
$_SESSION['password']                   =  $password;
$_SESSION['gender']                     =  $gender;
$_SESSION['role']                       =  $role;
$_SESSION['locale']                     =  $locale;
$_SESSION['cover']                      =  $cover;
$_SESSION['picture']             =  $picture;
$_SESSION['link']                       =  $link;
$_SESSION['created']                    =  $created;
$_SESSION['last_modified']              =  $last_modified;


$sql = "SELECT * FROM tbl_users WHERE oauth_uid= $oauth_uid ";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0 ){
   
$inssql_updsql = "update tbl_users set first_name='$first_name', last_name='$last_name', email_address='$email_address', password='$password', gender='$gender', role='$role', locale='$locale', picture ='$picture', link='$link' where oauth_uid='$oauth_uid' ";
} else {
    
$inssql_updsql ="INSERT INTO `tbl_users` (`user_id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email_address`, `password`, `gender`, `role`, `locale`, `picture`, `link`, `created`, `last_modified`) VALUES 
(NULL, '$oauth_provider', '$oauth_uid', '$first_name', '$last_name', '$email_address', '$password', '$gender', '$role', '$locale', '$picture', '$link', '$created', '$created');";

}
$result = mysqli_query($conn,$inssql_updsql);


header("Location: subscriber/profile.php");

/*
$sql = "SELECT * FROM `tbl_users` WHERE oauth_uid= $oauth_uid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   
 $conn->query("update `tbl_users` set first_name='".$first_name."', last_name='".$last_name."', email_address='".$email_address."', password='".$password."', gender='".$gender."', role='".$role."', locale='".$locale."', picture
='".$picture."', link='".$link."' where oauth_uid='".$oauth_uid."' ");
} else {
  
$conn->query("INSERT INTO tbl_users (oauth_provider, oauth_uid, first_name, last_name, email_address, password, gender, role, locale, picture, link, created, last_modified) VALUES 
                                         ('".$oauth_provider."','".$oauth_uid."','".$first_name."','".$last_name."','".$email_address."','".$password."','".$gender."','".$role."','".$locale."','".$picture."','".$link."','".$created."','".$last_modified."')");
    
}
$res = $conn->query($sql);
$userData = $res->fetch_assoc();
 
$_SESSION['userData'] = $userData;
*/


/*
$sql = "SELECT * FROM tbl_users WHERE oauth_uid= $oauth_uid ";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0 ){
   
 $result1 = "update tbl_users set first_name='$first_name', last_name='$last_name', email_address='$email_address', password='$password', gender='$gender', role='$role', locale='$locale', picture ='$picture', link='$link' where oauth_uid='$oauth_uid' ";
} else {
  
 $result1 = "INSERT INTO tbl_users (oauth_provider, oauth_uid, first_name, last_name, email_address, password, gender, role, locale, picture, link, created, last_modified) VALUES ('$oauth_provider','$oauth_uid','$first_name','$last_name','$email_address','$password','$gender','$role','$locale','$picture','$link','$created','$last_modified')";
    
}
$result1 = mysqli_query($conn,$result1);
$userData = mysqli_fetch_assoc($result1);
 
//$_SESSION['userData'] = $userData;



//header("Location: subscriber/profile.php");*/
?>