<!DOCTYPE html>
<html>
<title>W3.CSS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<link rel="stylesheet" href="stylesheet.css">
<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">

  <div  class="col-lg-12 nav navbar navbar-default navbar-fixed-left"  >
<div style="width: 50px; height: 50px; " ></div>
	<ul class="nav navbar" >
	
		<li><a href="index.php"><i class="glyphicon glyphicon-dashboard "></i> Dashboard</a></li>
		<li><a href="#menu" data-toggle="collapse" ><i class="glyphicon glyphicon-plus"></i> New Items</a></li>
		<ul class="nav collapse"  id="menu" >
			<li ><a href="new_post.php"><div class="col-sm-1"></div><i class="glyphicon glyphicon-pencil"></i> New Post</a></li>
			<li ><a href="new_category.php"><div class="col-sm-1"></div><i class="glyphicon glyphicon-edit"></i> New Category</a></li>
		</ul>

		<li><a href="post-list.php"><i class="glyphicon glyphicon-list"></i> Post</a></li>
		<li><a href="category-list.php"><i class="glyphicon glyphicon-tasks"></i> Categories</a></li>
		<li><a href="comment-list.php"><i class="glyphicon glyphicon-comment"></i> Comments</a></li>
		<li><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
		<li><a href="subscriber_list.php"><i class="glyphicon glyphicon-play-circle"></i> Subscribers</a></li>
			<li><a href="visitors.php"><i class="glyphicon glyphicon-eye-open"></i> Visitors</a></li>
<li><a href="#setting" data-toggle="collapse" ><i class="glyphicon glyphicon-plus"></i> Setting</a></li>
		<ul class="nav collapse"  id="setting" >
			<form action="export.php" method="post">
			<div class="col-sm-1"></div>
<input type="submit" name="export" Value="Export" class="btn btn-success btn-xs">
      
</form>
<br>
			<form action="import.php" method="post">
			<div class="col-sm-1"></div>
<input type="submit" name="import" Value="Import" class="btn btn-primary btn-xs">
      
</form>
		</ul>
</ul>
		
	

</div>

</div>

<!-- Page Content -->

      
</body>
</html>

<!--
<div class="col-lg-3 nav navbar navbar-default navbar-fixed-left"  >
<div style="width: 50px; height: 50px; " ></div>
	<ul class="nav navbar" >
	
		<li><a href="index.php"><i class="glyphicon glyphicon-dashboard "></i> Dashboard</a></li>
		<li><a href="#menu" data-toggle="collapse" ><i class="glyphicon glyphicon-plus"></i> New Items</a></li>
		<ul class="nav collapse"  id="menu" >
			<li ><a href="new_post.php"><div class="col-sm-1"></div><i class="glyphicon glyphicon-pencil"></i> New Post</a></li>
			<li ><a href="new_category.php"><div class="col-sm-1"></div><i class="glyphicon glyphicon-edit"></i> New Category</a></li>
		</ul>

		<li><a href="post-list.php"><i class="glyphicon glyphicon-list"></i> Post</a></li>
		<li><a href="category-list.php"><i class="glyphicon glyphicon-tasks"></i> Categories</a></li>
		<li><a href="comment-list.php"><i class="glyphicon glyphicon-comment"></i> Comments</a></li>
		<li><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
<li><a href="#setting" data-toggle="collapse" ><i class="glyphicon glyphicon-plus"></i> Setting</a></li>
		<ul class="nav collapse"  id="setting" >
			<form action="export.php" method="post">
			<div class="col-sm-1"></div>
<input type="submit" name="export" Value="Export" class="btn btn-success btn-xs">
      
</form>
<br>
			<form action="import.php" method="post">
			<div class="col-sm-1"></div>
<input type="submit" name="import" Value="Import" class="btn btn-primary btn-xs">
      
</form>
		</ul>
</ul>
		
	

</div>

<style >
	/* make sidebar nav vertical */ 


</style>

-->