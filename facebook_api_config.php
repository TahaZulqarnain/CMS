<?php
if(!session_id()){
    session_start();
}
$server = 'Localhost';
$username = 'tahazulq_taha';
$password = 'Zulqarnain1';
$db = 'tahazulq_cms_system';
$token="";
##### FB App Configuration #####
$fbPermissions = ['email']; 
$fbappid = "367638633970989"; 
$fbappsecret = "a748ad7973395a558d5c3e590643a110"; 
//$redirectURL = "http://localhost:81/LoginwithFb/authenticate.php"; 
$redirectURL = "https://www.cms.tahazulqarnain.com/facebook_api_authenticate.php"; 
include "db.php";
/*
$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

##### Required Library #####
require_once __DIR__ . '/facebook_api/src/Facebook/autoload.php';
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

 
$fb = new Facebook(array('app_id' => $fbappid, 'app_secret' => $fbappsecret , 'default_graph_version' => 'v2.6','cookie' => true));


$helper = $fb->getRedirectLoginHelper();
##### Check facebook token stored or get new access token #####
try {
    if(isset($_SESSION['fb_token'])){
        $accessToken = $_SESSION['fb_token'];
    }else{
        $accessToken = $helper->getAccessToken();
    }
} catch(FacebookResponseException $e) {
    echo 'Facebook Responser error: ' . $e->getMessage();
    exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK error: ' . $e->getMessage();
    exit;
}
?>