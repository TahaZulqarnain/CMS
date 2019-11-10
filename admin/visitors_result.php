
<?php
//https://stackoverflow.com/questions/39277032/mysql-sql-queries-for-counter-web-visits-per-day-month-year-and-totals
session_start();
include '../db.php';
if (isset($_SESSION['user']) && isset($_SESSION['password'])  == true ) {
	
	$sql="SELECT * FROM registration where email_address='$_SESSION[user]' AND password='$_SESSION[password]'";
	if($result=mysqli_query($conn,$sql)){
while ($rows = mysqli_fetch_assoc($result)) {
	
$name = $rows['first_name'] .' '. $rows['last_name'];
$role= $rows['role'];
$email = $_SESSION['user'];
$phone = $rows['phone_no'];
$official_website = $rows['official_website'];
	if(mysqli_num_rows($result) == 1 ){
   
	}
else
{
	 header('location:../index.php');
}
}
}


}else{
header('location:../index.php');
}




  if(!empty($_POST['getresult']))
  {
  

    $no = $_POST['getresult'];
    $select_sql = "SELECT * FROM visitors ORDER BY visitor_id DESC limit $no,10";

    $run_select_sql = mysqli_query($conn,$select_sql);
	    while($rows = mysqli_fetch_assoc($run_select_sql)){
	        $country    = $rows['country'];
	    $str = strtolower($country);
	    $visitorID = $rows['visitor_id'];
	     echo "
	     <div class='row'>
    <div class='col-sm-1' style='background-color:lavender;'>".$rows['visitor_id']." ".$rows['visitor_ip_address']."</div>
     <div class='col-sm-1' style='background-color:lavenderblush;'><span><div class='col-md-1 col-sm-2 col-xs-3'><div class='flag-wrapper'><div class='img-thumbnail flag flag-icon-background flag-icon-$str title='.$str.'' id=''.$str.''></div></div></div></span>
	    $str</div>
    <div class='col-sm-1' style='background-color:lavender;'>".$rows[city]."</div>
    <div class='col-sm-3' style='background-color:lavender;'>".$rows[request_url]."</div>
    <div class='col-sm-2' style='background-color:lavenderblush;'>".$rows[referer]."</div>
    <div class='col-sm-2' style='background-color:lavender;'>".$rows[browser]."</div>
     <div class='col-sm-2' style='background-color:lavender;'>".$rows[date]."</div>
  </div>

	     
	     
	     
	     ";




	       //  echo "<p class='rows'>".$row['visitor_ip_address']."</p>";
	    }     
	        
    
    
  }
  
?>
    