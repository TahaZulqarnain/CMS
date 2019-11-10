<?php
########## Google Settings.Client ID, Client Secret from https://console.developers.google.com #############

require_once 'google-api-php-client-2.0.0/vendor/autoload.php';


$client_id = '837903946499-ca13amderko921r178budtl1t1se5l04.apps.googleusercontent.com'; 
$client_secret = 'lQqWiXKo2i8A9SKOuU-UPqzL';
$redirect_uri = 'http://cms.tahazulqarnain.com/subscriber/profile.php';

########## MySql details  #############
$db_username = "tahazulq_taha"; //Database Username
$db_password = "Zulqarnain1"; //Database Password
$host_name = "localhost"; //Mysql Hostname
$db_name = 'tahazulq_cms_system'; //Database Name
###################################################################

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);

//If $_GET['code'] is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

//if we have access_token continue, or else get login URL for user
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

//Display user info or display login url as per the info we have.
echo '<div style="margin:20px">';
if (isset($authUrl)){ 
	//show login url
	echo '<div align="center">';
	echo '<h3>Login with Google -- Demo</h3>';
	echo '<div>Please click login button to connect to Google.</div>';
	echo '<a class="login" href="' . $authUrl . '"><img src="images/google-login-button.png" /></a>';
	echo '</div>';
	$user = $service->userinfo->get(); //get user info 
	
	
	$gpUserData = array();
	$gpUserData['oauth_provider']       = 'Google'; 
    $gpUserData['oauth_id']             = !empty($user['id'])?$user['id']:'';
    $gpUserData['first_name']           = !empty($user['given_name'])?$user['given_name']:'';
    $gpUserData['last_name']            = !empty($user['family_name'])?$user['family_name']:'';
    $gpUserData['email_address']        = !empty($user['email'])?$user['email']:'';
    $gpUserData['gender']               = !empty($user['gender'])?$user['gender']:'';
    $gpUserData['locale']               = !empty($user['locale'])?$user['locale']:'';
    $gpUserData['picture']              = !empty($user['picture'])?$user['picture']:'';
    $gpUserData['link']                 = !empty($user['link'])?$user['link']:'';
    $created_on                         ='';
	$last_modified                      ='';
} else {
	
	$user = $service->userinfo->get(); //get user info 
	
	
	$gpUserData = array();
	$gpUserData['oauth_provider']       = 'Google'; 
    $gpUserData['oauth_id']             = !empty($user['id'])?$user['id']:'';
    $gpUserData['first_name']           = !empty($user['given_name'])?$user['given_name']:'';
    $gpUserData['last_name']            = !empty($user['family_name'])?$user['family_name']:'';
    $gpUserData['email_address']        = !empty($user['email'])?$user['email']:'';
    $gpUserData['gender']               = !empty($user['gender'])?$user['gender']:'';
    $gpUserData['locale']               = !empty($user['locale'])?$user['locale']:'';
    $gpUserData['picture']              = !empty($user['picture'])?$user['picture']:'';
    $gpUserData['link']                 = !empty($user['link'])?$user['link']:'';
    $created_on                         ='';
	$last_modified                      ='';
	
	
	
	
	// connect to database
	$mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
	
	//check if user exist in database using COUNT
	$result = $mysqli->query("SELECT COUNT(user_id) as usercount FROM tbl_users WHERE oauth_uid=$user->id");
	$user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist
	
	//show user picture
	echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
	
	if($user_count) //if user already exist change greeting text to "Welcome Back"
    {
        echo 'Welcome back '.$user->name.'! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    }
	else //else greeting text "Thanks for registering"
	{ 
	    
	    echo 'Hi '.$user->name.', Thanks for Registering! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
		$statement = $mysqli->prepare("Insert Into tbl_users (oauth_provider,oauth_uid,first_name,last_name,email_address,gender,role,locale,picture,link,created,last_modified) 
        Values (
        '.$gpUserData[oauth_provider].',
        '.$gpUserData[oauth_id].',
        '.$gpUserData[first_name].',
        '.$gpUserData[last_name].',
        '.$gpUserData[email_address].',
        '.$gpUserData[gender].',
        '.$gpUserData[locale].',
        '.$gpUserData[picture].',
        '.$gpUserData[link].',
        '$created_on',
        '$last_modified',
        )" );
		$statement->bind_param('issss', $user->oauth_provider,  $user->oauth_uid, $user->first_name, $user->last_name, $user->email_address);
		$statement->execute();
		echo $mysqli->error;
		/*
		$insert_query = "Insert Into tbl_users (oauth_provider,oauth_uid,first_name,last_name,email_address,gender,role,locale,picture,link,created,last_modified) 
        Values (
        '.$gpUserData[oauth_provider].',
        '.$gpUserData[oauth_id].',
        '.$gpUserData[first_name].',
        '.$gpUserData[last_name].',
        '.$gpUserData[email_address].',
        '.$gpUserData[gender].',
        '.$gpUserData[locale].',
        '.$gpUserData[picture].',
        '.$gpUserData[link].',
        '$created_on',
        '$last_modified',
        )";
        mysqli_query($mysqli,$insert_query);
        */
    }
	
	//print user details
	echo '<pre>';
	print_r($user);
	echo '</pre>';
}
echo '</div>';


?>