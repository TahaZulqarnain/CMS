<?php
// include your composer dependencies
require_once 'google-api-php-client-2.0.0/vendor/autoload.php';
require_once 'google-api-php-client-2.0.0/src/Google/Client.php';
//require_once 'google-api-php-client-2.0.0/contrib/Google_Oauth2Service.php';

$client = new Google_Client();
$client->setApplicationName("CMS Web api");
$client->setClientId("837903946499-ca13amderko921r178budtl1t1se5l04.apps.googleusercontent.com");
$client->setClientSecret("lQqWiXKo2i8A9SKOuU-UPqzL");
//$client->setDeveloperKey("AIzaSyB_yZ0CfGBhpG1L1kwBaerTRK6iBx4lWEI");

$service = new Google_Service_Books($client);
$optParams = array('filter' => 'free-ebooks');
$results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

foreach ($results as $item) {
  echo $item['volumeInfo']['title'], "<br /> \n";
}

?>