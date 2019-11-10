

<?php
  session_start();
include 'db.php';
$result1='';
$result = '';


?>


<!DOCTYPE html>
<html>
<head>
	<title>CMS System</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
      $(".like , .unlike").click(function(){
      
     
        var id = this.id;   // Getting full Button id
        var split_id = id.split("_"); // split the id

        var text = split_id[0]; // _ get before underscore text
        var post_id = split_id[1];  // _ get after underscore text
        var post_name = $('#post_name').val();
     
     
     /* var post_action_like = $('#like').val() ;
      var post_action_unlike = $('#unlike').val() ;*/
           
           if(text == 'like')
           {
               type = 1;
           }
           else if(text == 'unlike'){
               type = 0;
           }
           
           
           
           $.ajax({
            url: 'likeunlike.php',
            type: 'POST',
            data: {
            'type': type,
			'post_id': post_id,
			'post_name': post_name
            },
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];
                var error = data['error'];
                
                
                $('#likes_'+post_id).text(likes);
                $('#unlikes_'+post_id).text(unlikes);
                $('#error').html(error);
                
                
            }   
           
               
           });
                
           
      });
      
      // comment jquery

$(".addcomment").click(function(){
    

        var id = this.id;   // Getting full Button id
        var split_id = id.split("_"); // split the id

        var comments = split_id[0]; // _ get before underscore text but we dont need it 
        
        var post_id = split_id[1];  // _ get after underscore text
        var post_name = $('#post_name').val();
        var comments = $('#comments').val();

    $.ajax({
            url: 'comments.php',
            type: 'POST',
            data: {
            'post_id': post_id,
            'post_name': post_name,
            'comments': comments
            },
            dataType: 'json',
            success: function(data){
               
                $('#contactform')[0].reset();
                var comment_error = data['comment_error'];
                $('#comment_error').html(comment_error);
               
                
                
                
            }   
           
               
           });
    
});
 
      
  }); 
  </script>
  
</head>
<style>
    textarea#comments {
        height: 150px !important;
    }
    .post-action {
    padding: 20px 20px 40px 0;
}
#error{
    padding-top:10px;
    
}
</style>
<body>

	<?php  include 'includes/header.php'; ?>
  <div style="width: 50px; height: 50px;"></div>
	<div class="container">
		<section class="col-md-8">
		<?php echo $result1; ?>
		<div id="result1"></div>
    <?php
          if(isset($_GET['post_id']))
          {
             $post_id =  $_GET['post_id'];
             $sql= "SELECT * FROM post where id='$_GET[post_id]'";
             $run_sql= mysqli_query($conn,$sql);
             while($rows=mysqli_fetch_array($run_sql))
             { 
                 
              $description = htmlspecialchars_decode($rows['description']);   
              $post_name = $rows['title'];
             	echo ' <div class="panel panel-default">
			<div class="panel-heading"><h1>'.$rows['title'].'</h1></div>
				<div class="panel-body">
                <img style="width: 100%;" src="'.$rows['image'].'">
                <div style="width:50px;height:50px;"></div>
				<p>'.$description.'</p></div>
			</div>

             	';
             }
          }
          else{
           echo '<div class="alert alert-danger">No Post You have Selected to show  <a href="index.php">Click here to select a post</a></div>';

          }
?>


<div class="post-action">
    <?php
    
    $postid = $_GET['post_id'];
    
    // Count post total likes and unlikes
    $like_query = "SELECT COUNT(*) AS cntLikes FROM post_like_unlike WHERE type=1 and post_id=".$postid;
    $like_result = mysqli_query($conn,$like_query);
    $like_row = mysqli_fetch_array($like_result);
    $total_likes = $like_row['cntLikes'];

    $unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM post_like_unlike WHERE type=0 and post_id=".$postid;
    $unlike_result = mysqli_query($conn,$unlike_query);
    $unlike_row = mysqli_fetch_array($unlike_result);
    $total_unlikes = $unlike_row['cntUnlikes'];

    
    ?>
    
    
    <i style="font-size:24px;" class="fa fa-thumbs-o-up">&nbsp;<input type="hidden" name="post_name" id="post_name" value="<?php echo $post_name; ?>"><input type="button" name="type"  value=" like" id="like_<?php echo $postid; ?> " class="like btn btn-primary" style="<?php if($type == 1){ echo "color: blue;"; } ?>" />&nbsp;(<span id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>)</span></i>
    
    <i style="font-size:24px;" class="fa fa-thumbs-o-down">&nbsp;<input type="hidden" name="post_name" id="post_name" value="<?php echo $post_name; ?>"><input type="button" name="type" value=" unlike" id="unlike_<?php echo $postid; ?> " class="unlike btn btn-danger"  />&nbsp;(<span id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>)</i>
    
      <br>
      <div id="error"></div>
     </div>


 <?php include 'sharing.php'; ?>

<?php
$sql= "SELECT * FROM post_comments  where status='approved' && id ='$_GET[post_id]'";
$run_sql = mysqli_query($conn,$sql);
if(mysqli_num_rows($run_sql) > 0) { ?>


 <div class="panel-group">
            <div class="panel panel-default">
            <div class="panel-body">
                
<?php            
while($rows = mysqli_fetch_assoc($run_sql))
{
  echo '
  

           
              <div class="col-sm-12" style="padding:20px;">
              <div class="col-sm-3"><img src="images/comment.jpg" style="width:80%;"></div>
            <div class="col-sm-9"><p>'.$rows['comments'].'</p>
            <hr>
            <p><b>Posted by: </b>'.ucfirst($rows['name']).' <b>Date and Time: </b> '.$rows['date'].'</p>
           
            </div>
            </div>
            
           
           

  ';
  
}
?>

         </div>
         
            </div>
            </div>  


<?php }
else{

}

?>








<form method="post" class="form-horizontal" id="contactform"> 
<div class="form-group">
<div class="col-sm-12">
<input type="hidden" name="post_name" id="post_name" value="<?php echo $post_name; ?>">
<textarea name="comments" id="comments" class="form-control" cols="50" rows="8" placeholder="Login to post your Comments"></textarea>
</div>
</div>
<div class="form-group">
<div class="col-sm-8">
<input type="button" value="submit" name="addcomment" id="addcomment_<?php echo $post_id; ?>" class="btn btn-success addcomment">
</div>
</div>
</form>
<div id="comment_error"></div>
     </section>
 <?php include 'includes/sidebar.php'; ?>
			</div>

    </div>

	</div>

<div style="width: 50px; height: 50px; " ></div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>