<?php
$server = 'Localhost';
$username = 'tahazulq_taha';
$password = 'Zulqarnain1';
$db = 'tahazulq_cms_system';

$conn = mysqli_connect($server,$username,$password,$db);

if(!$conn)
{
	die("Connection Failed".mysqli_connect_error());
}

?>