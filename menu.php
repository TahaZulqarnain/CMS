<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>CMS System</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
a.title_link {
    color: #082148;
    text-decoration: none !important;
}
</style>
</head>
<body>

	<?php include 'includes/header.php'; ?>
	<div style="width:50px; height:50px;"></div>
	<div class="container">
	<article class="row">
		<section class="col-md-8">
            <?php 
             $sql = "SELECT * FROM post where category = '$_GET[cat_name]' AND status= 'published' AND active = 0 ORDER BY id DESC";
             $run_sql = mysqli_query($conn,$sql);
             while($rows=mysqli_fetch_array($run_sql))
             {
                 $description = htmlspecialchars_decode($rows['description']);
             	echo'
            <div class="panel panel-success">
			<div class="panel-heading"><h3><a class="title_link" href="post.php?post_id='.$rows['id'].'">'.$rows['title'].'</a></h3></div>
			 <div class="panel-body">
                <div class="col-md-6">
                 '.($rows['image'] == '' ? '<img src="images/placeholder.png" width="100%;">' : '<img src="../'.$rows['image'].'" width="100%;">').'
				</div>
                <div class="col-md-6">
                <p>'.substr($description,0,250).'</p>
                <a class="btn btn-primary" href="post.php?post_id='.$rows['id'].'">Read More</a>
				</div>
				
				</div>
			</div>';
             }
?>


					</section>
	<?php include 'includes/sidebar.php'; ?>

</article>
	</div>
<div style="width: 50px; height: 50px;"></div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>