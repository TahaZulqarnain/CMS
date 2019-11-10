

<?php
//https://stackoverflow.com/questions/39277032/mysql-sql-queries-for-counter-web-visits-per-day-month-year-and-totals
//http://talkerscode.com/webtricks/load-results-from-database-on-page-scroll-using-jquery-ajax-and-php.php
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- for flag -->
    <link href="css/flags.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    
  
    
    <style>
    .visitors_scroll{
     overflow-x:scroll;   
    }
    .rows{
     font-size:70px;   
    }
    </style>
    
    <script>
  $(window).scroll(function ()
    {
	  if($(document).height() <= $(window).scrollTop() + $(window).height())
	  {
		loadmore();
	  }
    });

    
    function loadmore()
    {
      var val = document.getElementById("row_no").value;
      $.ajax({
      type: 'post',
      url: 'visitors_result.php',
      data: {
       getresult:val
      },
      beforeSend:function(){
      $('.load-more').css("display","block").fadeIn(5000);
      },
      success: function (response) {
      $('.load-more').css("display","none").fadeOut( 5000 );
	  var content = document.getElementById("all_rows");
      content.innerHTML = content.innerHTML+response;

      // We increase the value by 10 because we limit the results by 10
      document.getElementById("row_no").value = Number(val)+10;
      }
      });
    }
    </script>
    
</head>

<?php include "includes/header.php" ?>
<div style="width: 50px; height: 50px; " ></div>
<?php include "includes/sidebar.php" ?>
<!-- Top Section Start -->
<div style="width: 50px; height: 50px; " ></div>

<div id="abc"></div>
<!-- User Section Start-->
<div style="margin-left:25%">

<div class="col-lg-12">

<?php




//$v_sel_sql = "SELECT visitor_ip_address FROM visitors WHERE date=";
//$v_run_sel_sql = mysqli_query($conn,$v_sel_sql);
//$total_visitor = mysqli_num_rows($v_run_sel_sql);
//1 week query SELECT * FROM visitors WHERE date > DATE_SUB(curdate(),INTERVAL 1 WEEK) ORDER BY date DESC
$v_sel_sql = "SELECT SUM(totalCOunt) as Visitors FROM (SELECT DATE(date) Date, COUNT(DISTINCT visitor_ip_address) totalCOunt FROM visitors GROUP BY DATE(date) ) visitors ";
$v_run_sel_sql = mysqli_query($conn,$v_sel_sql);
$total_visitor = mysqli_fetch_assoc($v_run_sel_sql);

?>


<div class="col-sm-3">
<div class="panel panel-primary">
<div class="panel-body bg-primary">
	<h2>Total Visitor</h2>
	<h3><?php echo $total_visitor['Visitors'] ?></h3>
</div>
</div>    
</div>

<?php
//both queries are right
$today_sql= "SELECT  COUNT(DISTINCT visitor_ip_address) as Daily_Visitors from visitors WHERE DATE(date) = DATE(CURRENT_DATE()) ";
//$today_sql = "SELECT SUM(totalCOunt) as Daily_Visitors FROM (SELECT DATE(date) Date, COUNT(DISTINCT visitor_ip_address) totalCOunt FROM visitors WHERE DATE(date) = DATE(CURRENT_DATE()) GROUP BY DATE(date) ) visitors";

$run_today_sql = mysqli_query($conn,$today_sql);
$daily_visitor = mysqli_fetch_assoc($run_today_sql);
?>
<div class="col-sm-3">
<div class="panel panel-success">
<div class="panel-body bg-success">
	<h2>Today Visitor</h2>
	<h3><?php echo $daily_visitor['Daily_Visitors'] ?></h3>
</div>
</div>    
</div>

<?php




$monthly_sql = "SELECT SUM(totalCOunt) as Monthly_Visitors FROM (SELECT DATE(date) Date, COUNT(DISTINCT visitor_ip_address) totalCOunt FROM visitors WHERE MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY DATE(date) ) visitors";
$run_monthly_sql =mysqli_query($conn,$monthly_sql);
$monthly_visitor = mysqli_fetch_assoc($run_monthly_sql);
?>
<div class="col-sm-3">
<div class="panel panel-warning">
<div class="panel-body bg-warning">
	<h2>This Month Visitor</h2>
		<h3><?php echo $monthly_visitor['Monthly_Visitors'] ?></h3>
</div>
</div>    
</div>

<?php




$yearly_sel_sql = "SELECT SUM(totalCOunt) as Yearly_Visitors FROM (SELECT DATE(date) Date, COUNT(DISTINCT visitor_ip_address) totalCOunt FROM visitors WHERE YEAR(date) = YEAR(CURDATE()) GROUP BY DATE(date)) visitors ";
$run_yearly_sql = mysqli_query($conn,$yearly_sel_sql );
$yearly_visitor = mysqli_fetch_assoc($run_yearly_sql);

?>



<div class="col-sm-3">
<div class="panel panel-info">
<div class="panel-body bg-info">
	<h2>This Year Visitor</h2>
	<h3><?php echo $yearly_visitor['Yearly_Visitors'] ?></h3>
</div>
</div>    
</div>

</div>
<!-- Latest User Section End-->


<div class="col-lg-12">
    <div style="width:50px;height:50px;"></div>
<div class="container-fluid">

	
	<div class="row">
    <div class="col-sm-1">Ip Address</div>
    <div class="col-sm-1">Country</div>
    <div class="col-sm-1">City</div>
    <div class="col-sm-3">Visited Url</div>
    <div class="col-sm-2">Referer</div>
    <div class="col-sm-2">Browser</div>
     <div class="col-sm-2">Date</div>
  </div>
 
 
<div>
    <?php

      $select_sql = "SELECT * FROM visitors ORDER BY visitor_id DESC limit 0,10";

$run_select_sql = mysqli_query($conn,$select_sql);
	    while($rows = mysqli_fetch_assoc($run_select_sql)){
        $country    = $rows['country'];
	    $str = strtolower($country);
	    $visitorID = $rows['visitor_id'];
	    
	    echo '
<div class="row">
    <div class="col-sm-1" style="background-color:lavender;">'.$rows[visitor_ip_address].'</div>
    <div class="col-sm-1" style="background-color:lavenderblush;"><span><div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-'.$str.'" title="'.$str.'" id="'.$str.'"></div></div></div></span>
	    '.$str.'</div>
    <div class="col-sm-1" style="background-color:lavender;">'.$rows[city].'</div>
    <div class="col-sm-3" style="background-color:lavender;">'.$rows[request_url].'</div>
    <div class="col-sm-2" style="background-color:lavenderblush;">'.$rows[referer].'</div>
    <div class="col-sm-2" style="background-color:lavender;">'.$rows[browser].'</div>
     <div class="col-sm-2" style="background-color:lavender;">'.$rows[date].'</div>
  </div>



';
	    
	    
//echo "<p class='rows'>".$rows['visitor_ip_address']."</p>";
}
    ?>
  </div>
 
  <div id="all_rows"></div>
   <div class="load-more" style="display:none;text-align:center;">
      <img src="../images/visitor_loading.png">
  </div>
  <input type="hidden" id="row_no" value="10">
  
  
  
  

</div>

</div>

    







<body>

 


</body>
<footer></footer>
</html>