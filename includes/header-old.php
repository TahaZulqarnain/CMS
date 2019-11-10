<header class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
		<a class="navbar-brand" href="#">CMS SYSTEM</a>
	</div>
			<ul class="nav navbar-nav navbar-right">
			<li class="active"><a href="index.php">Home</a></li>
		    <?php 
              $sql= "SELECT * FROM category";
              $run_sql = mysqli_query($conn,$sql);
              while($rows=mysqli_fetch_array($run_sql))
              { 
              	echo '
              	<li><a href="menu.php?cat_name='.$rows['category_name'].'">'.ucfirst($rows['category_name']).'</a></li>
                  ';
              } 
		    ?>

		    
			<li><a href="contact.php">Contact Us</a></li>
			<li><a href="registration.php">Registration</a></li>	
			</ul>
		
	</div>	
	</header>