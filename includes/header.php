<!DOCTYPE html>
<html>
<head>
    <meta name="google-site-verification" content="RSVWohyPtxBeLm5woiMwzvTxor5t_OUed2V_nNRJ1Qo" />
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="stylesheet.css">
 <style>
 .navbar{
margin-bottom: 0px !important;
}
 .wrap {
 width: 100%;
 margin: 0 auto;
}
#head h1
{
 float:left;
}
#head a
{
 float:right;
}
/*input,select
{
 width:300px;
 height:35px;
}
*/
 /* nav menu */
#nav {
 margin: 0;
 padding: 0;
 list-style: none;
 /*border-left: 1px solid #d5dce8;
 border-right: 1px solid #d5dce8;
 border-bottom: 1px solid #d5dce8;
 border-bottom-left-radius: 4px;
 -moz-border-radius-bottomleft: 4px;
 -webkit-border-bottom-left-radius: 4px;
 border-bottom-right-radius: 4px;
 -moz-border-radius-bottomright: 4px;
 -webkit-border-bottom-right-radius: 4px;
 */
 height: 50px;
 padding-left: 15px;
 padding-right: 15px;
 background: #222;
}
#nav li {
 float: left;
 display: block;
 background: none;
 position: relative;
 z-index: 999;
 margin: 0 1px;
}
#nav li a {
 display: block;
 padding: 0;
 font-weight: 700;
 line-height: 50px;
 text-decoration: none;
 color: #fff;
 zoom: 1;
 border-left: 1px solid transparent;
 border-right: 1px solid transparent;
 padding: 0px 12px;
}
#nav li a:hover, #nav li a.hov {
 background-color: #fff;
 border-left: 1px solid #d5dce8;
 border-right: 1px solid #d5dce8;
 color: #576482;
}
/* subnav */
#nav ul {
 position: absolute;
 left: 1px;
 display: none;
 margin: 0;
 padding: 0;
 list-style: none;
 -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
 -o-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
 box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
 -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
 padding-bottom: : 1px;
}
#nav ul li {
 width: 160px;
 height:100%;
 float: left;
 border-top: 0px solid #fff;
 text-align: left;
 padding:0px;

}
#nav ul li:hover {
 border-left: 0px solid transparent;
 border-right: 0px solid transparent;
}
#nav ul a {
 display: block;
 height: 30px;
 line-height: 20px;
 padding: 8px 5px;
 color: #666;
 border-bottom: 1px solid transparent;

 background:#000;
 color:#fff !important;
 font-weight: normal;
}
#nav ul a:hover {
 text-decoration: none;
 border-right-color: transparent;
 border-left-color: transparent;
 background: transparent;
 
 background:#fff;
 color:#000 !important;
 display:block;
}
 </style>
</head>


<body>

	
		
	        
		   
			
			
			<header class="navbar navbar-inverse navbar-static-top">
<div class="container-fluid">
		<div class="navbar-header">
		<a class="navbar-brand" href="#">CMS SYSTEM</a>
	</div>
<div class="wrap">
<ul id="nav" class="nav navbar-nav navbar-right">
<li><a href="index.php">Home</a></li>
<?php
$sql= "SELECT * FROM category";
 $run_sql= mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($run_sql))

{
	$cat_id = $row['c_id'];
 echo '
<li><a href="menu.php?cat_name='.$row['category_name'].'">'.ucfirst($row['category_name']).'</a>
 
 ';
 
$sql1= "SELECT sub_category_name FROM sub_categories WHERE c_id = $cat_id";
 
 ?>
        <ul>    
  <?php  
 $run_sql1= mysqli_query($conn,$sql1);
while($sub_row=mysqli_fetch_array($run_sql1))

  {
  	echo '
<li><a href="sub-menu.php?sub_cat_name='.$sub_row['sub_category_name'].'">'.ucfirst($sub_row['sub_category_name']).'</a></li>
  	' ;
   ?>
   <?php
  }
  ?>
 </ul>
 </li> 
 
    <?php
}
?>
<li><a href="contact.php">Contact Us</a></li>
			<li><a href="registration.php">Registration</a></li>	
			
</ul> 

</div>
	
	</header>		
			
  
		<script type="text/javascript">
$(document).ready(function() 
{
 $('#nav li').hover(function() 
 {
  $('ul', this).slideDown('fast');
 }, function() 
 {
  $('ul', this).slideUp('fast');
 });
});
</script>	
			
</body>

	</html>
	

