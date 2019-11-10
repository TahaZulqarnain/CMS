<?php
include 'db.php';

 $visitor_ip=$_SERVER['REMOTE_ADDR'];
 $request_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 $date = date("Y-m-d H:i:s");
$http_referer = isset( $_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "no referer" ;
$http_user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "no User-agent" ;

function ip_details($visitor_ip) 
{
    $json       = file_get_contents("http://ipinfo.io/{$visitor_ip}");
    $details    = json_decode($json);
    return $details;
}

$details    =   ip_details("$visitor_ip");

//echo $details->state;

//echo $details->city;   

//echo $details->org;      
//echo $details->hostname; 




 $v_check_ip = "SELECT * FROM visitors where visitor_ip_address = '$visitor_ip' AND request_url='$request_url' AND DAY(date) = DAY(CURRENT_DATE())";
 
 $run_v_check_ip = mysqli_query($conn,$v_check_ip);
 	if(mysqli_num_rows($run_v_check_ip) < 1 )
 {
	 $v_ins_sql = "INSERT INTO `visitors` (visitor_ip_address,country,city,request_url,referer,browser,date) VALUES ('$visitor_ip','$details->country','$details->city','$request_url','$http_referer','$http_user_agent','$date')";
 	  $run_v_ins_sql = mysqli_query($conn,$v_ins_sql);
 }
 else{
 
 }

?>



<footer class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
		 <p class="navbar-text pull-left"> © Copyright 2017</p>
		 <a href="#" class="btn btn-success pull-right navbar-btn">By Taha Zulqarnain</a>	
		</div> <?php //echo $details->state;   ?>
	</footer>