<?php
include '../db.php';

if(isset($_POST["export"])){
             
      header('Content-Type: text/csv; charset=utf-8');  // for user to download file
      header('Content-Disposition: attachment; filename=data.csv');  //for user to download file
      $output = fopen("php://output", "w");  //php://output is a write-only stream that allows you to write to the output buffer mechanism in the same way as print and echo.
      fputcsv($output, array('id','title', 'description', 'image', 'category','sub_category' ,'date', 'author')); //file,fields 
      $query = "SELECT * from post ORDER BY id DESC";  
      $result = mysqli_query($conn, $query);  
      while($rows = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $rows);  
      }  
      fclose($output);  
 }  


?>
