
<aside class="col-md-4">

           <div class="panel-group">
            <div class="panel panel-default">
            <div class="panel-heading">
               <h4>Search Something</h4>
            </div>
            <div class="panel-body">
               <form action="search.php" method="get" >
               <div class="input-group">
                  <input class="form-control" type="Search" name="search" placeholder="Search...">
                  <div class="input-group-btn">
                  <button class="btn btn-default" name="submit_search" type="submit"><i class="glyphicon glyphicon-search "></i></button>
                  </div>
               </div>
                  
               </form>
            </div>
               
            </div>
         <div class="panel panel-default">
         <div class="panel-heading">
            <h4>Login Area</h4>
            </div>
            <div class="panel-body">
               <form class="form-horizontal" role="form" method="post" action="accounts/login.php">
                    <div class="form-group">
                        <label for="email" class="control-label col-sm-4">Username:</label>  
                        <div class="col-sm-8">
                  <input type="email" id="email" name="username" placeholder="Email Address" class="form-control">
                  </div>
                  </div>
                         <div class="form-group">
                           <label for="pwd" class="control-label col-sm-4">Password:</label>
                           <div class="col-sm-8">
                           <input type="Password" name="password" placeholder="Password" id="pwd" class="form-control">
                         </div>
                         </div>
                         <div class="form-group">
                         <label class="col-sm-4"></label>
                         <div class="col-sm-8">
                         <button type="submit" name="login_submit" class="btn btn-success">Login</button>
                         
                           </div>
                         </div>
               </form>
            
                     <div class="col-sm-4"></div>
                         <div class="col-sm-8">
                     <a href="http://www.cms.tahazulqarnain.com/accounts/forget_password.php">Forget Your Password?</a>
                          </div>

                     <p class="text-center"> Don't have an account? <a href="https://www.cms.tahazulqarnain.com/registration.php"> Sign Up</a></p>



                    </div>

               </div>


                    </div>
                  


                  <div class="list-group">
               <?php 
                     $sql= "SELECT * FROM post where status='published' ORDER BY id DESC limit 2";
                     $run_sql_post= mysqli_query($conn,$sql);
                     while ($rows_post_sidebar=mysqli_fetch_assoc($run_sql_post)) {
                         $description = strip_tags(htmlspecialchars_decode($rows_post_sidebar['description'])); 
                        if(isset($_GET['post_id']))
                        {
                           if ($_GET['post_id'] == $rows_post_sidebar['id']) {
                             $class = 'active';
                           }
                           else
                           {
                              $class = '';
                           }

                        }
                        else{

                           $class="";
                        }

                        echo '
                        <a class="list-group-item '.$class.' " href="post.php?post_id='.$rows_post_sidebar['id'].'"  >
                     <div class="col-sm-4">
                     
                     '.($rows_post_sidebar['image'] == '' ? '<img src="images/placeholder.png" width="100%;">' : '<img src="../'.$rows_post_sidebar['image'].'" width="100%;">').'
                     </div>
                     <div class="col-sm-8">
                     <h4 class="list-group-item-heading">'.$rows_post_sidebar['title'].'</h4>
                     <p class="list-group-item-text">'.substr($description,0,50).'</p>
                     </div>
                     <div style="clear:both;"></div>

                  </a>
                  
                  
                        ';
                        
                     }
                ?>
                  
               </div>

        </aside>