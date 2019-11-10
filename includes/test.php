<?php
$visitor_ip=$_SERVER['REMOTE_ADDR'];
function ip_details($visitor_ip) 
{
    $json       = file_get_contents("http://ipinfo.io/{$visitor_ip}");
    $details    = json_decode($json);
    return $details;
}

$details    =   ip_details("$visitor_ip");

print_r($details);

//echo $details->city;   

//echo $details->org;      
//echo $details->hostname; 

?>