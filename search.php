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
</head>
<body>

	<?php include 'includes/header.php'; ?>
<div style="width: 50px; height: 50px;"></div>
	<div class="container">
	<article class="row">
		<section class="col-md-8">

            <?php

             if (isset($_GET['submit_search'])) {
              echo'
             	<div class="panel panel-default">
              	<div class="panel-heading">
              		<h4>You Have Searched for: </h4>
              	</div>
              	<div class="panel-body">
              	<h4>"'.$_GET['search'].'"</h4>
              	</div>
              </div>';
             $search_sql= "SELECT * FROM post WHERE title LIKE '%$_GET[search]%' OR description LIKE '%$_GET[search]%'";
              $run_sql= mysqli_query($conn,$search_sql);
              if (mysqli_num_rows($run_sql) > 0) {
              while ($rows=mysqli_fetch_assoc($run_sql)) {
             echo'
            <div class="panel panel-success">
			<div class="panel-heading"><h4><a href="post.php?post_id='.$rows['id'].'">'.$rows['title'].'</a></h4></div>
			 <div class="panel-body">
                <div class="col-md-6"><img style="width: 100%;" src="'.$rows['image'].'">
				</div>
                <div class="col-md-6">
                <p>'.substr($rows['description'],0,300).'</p>
				</div>
				<a class="btn btn-primary" href="post.php?post_id='.$rows['id'].'">Read More</a>
				</div>
			</div>';
             }             	
          
            }
         else{
         echo '<div class="alert alert-danger"
         <p> NO RECORD FOUND IN DATABASE</p>
            </div> ';
         
           
       }
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