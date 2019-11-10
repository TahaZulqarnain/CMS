<?php
$server = 'Localhost';
$username = 'tahazulq_taha';
$password = 'Zulqarnain1';
$db = 'tahazulq_cms_system';



##### Google App Configuration ##### 
$googleappid = "258096001341-rdfaaipu8jg151bu3m0m8ktdugb5e7va.apps.googleusercontent.com"; 
$googleappsecret = "lE1KvKnT0z83OQlCT5zsVvuY"; 
//$redirectURL = "http://localhost:81/LoginwithGoogle/authenticate.php"; 
$redirectURL = "https://www.cms.tahazulqarnain.com/google_api_authenticate.php";


include_once 'google_api/src/Google/Client.php';
include_once 'google_api/src/Google/contrib/Google_Oauth2Service.php';
//include_once 'google_api/src/Google/autoload.php';
 
$googleClient = new Google_Client();
$googleClient->setApplicationName('CMS Login Application');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURL);

 
//$google_oauthV2 = new Google_Oauth2Service($googleClient);
 //$google_oauthV2 = new Google_Service_Oauth2($googleClient);

?>