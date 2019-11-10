<?php

$per_page=3;
if(isset($_GET['page']))
{
$page=$_GET['page'];
}	
else{
$page=1;
}
$start_from = ($page - 1) * $per_page;

?>

	<?php



function pagination_link() 
{
  global $conn;
$sql_pagination= "SELECT * FROM post";
$run_pagination = mysqli_query($conn,$sql_pagination);
$count =  mysqli_num_rows($run_pagination);

$total_pages= ceil($count / $per_page);


for($i=1; $i<=$total_pages; $i++) { 
                echo'

<li><a href="post-list.php?page='.$i.'">'.$i.'</a></li>	 

';    
   }
 } 
 
 ?>