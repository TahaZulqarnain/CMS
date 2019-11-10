<?php
session_start();
include '../db.php';
if (isset($_SESSION['user']) && isset($_SESSION['password'])  == true) {
	$sql="SELECT * FROM registration where email_address='$_SESSION[user]' AND password='$_SESSION[password]'";
	if($result=mysqli_query($conn,$sql)){
	if(mysqli_num_rows($result) == 1 ){
   
	}
else
{
	 header('location:../index.php');
}
}

}else{
header('location:../index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" id="font-awesome-style-css" href="https://www.phpflow.com/code/css/bootstrap3.min.css" type="text/css" media="all">

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<title>Ajax pagination</title>


<script>
jQuery(document).ready(function() {
jQuery("#target-content").load("pagination.php?page=1");
    jQuery("#pagination li").live('click',function(e){
	e.preventDefault();
		jQuery("#target-content").html('loading...');
		jQuery("#pagination li").removeClass('active');
		jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("pagination.php?page=" + pageNum);
    });
    });
</script>
</head>
<body>
<div><h3>Ajax pagination</h1></div>
<div>
<div id="target-content" >loading...</div>

<?php

$limit = 5;
$sql = "SELECT COUNT(id) FROM post";  
$rs_result = mysqli_query($conn,$sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 
?>
<div align="center">
<ul class='pagination text-center' id="pagination">
<?php /*if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
			if($i == 1):?>
            <li class='active'  id="<?php echo $i;?>"><a href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li> 
			<?php else:?>
			<li id="<?php echo $i;?>"><a href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
		<?php endif;?>			
<?php endfor;endif;*/?> 
<?php if(!empty($total_pages))
{
	for($i=1; $i<=$total_pages; $i++)  {
		if($i == 1){?>
            <li class='active'  id="<?php echo $i;?>"><a href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li> 
			<?php }else{?>
			<li id="<?php echo $i;?>"><a href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
		<?php }
	}
}
?>
</div>
</div>
</body>



