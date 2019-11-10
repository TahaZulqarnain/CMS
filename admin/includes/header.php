<script src="js/admin.js"></script>
<header class="navbar navbar-default navbar-fixed-top">
	  
	<div class="container-fluid">
		<div class="navbar-header">
			
				<a class="navbar-brand" href="#">CMS Admin</a>
                
               
			</div>
		
			   
                 
			    
          
		      
   
              
			<ul class="nav navbar-nav navbar-right">
     		<li><a target="_blank" href="../index.php">Home</a></li>
     		<li><a href="../accounts/logout.php">Log Out</a></li>
     		<li>
            <div class="dropdown notification" id="notification">
                <span class="label label-pill label-danger" id="count" style="border-radius:10px;"></span>
            <a style="color:#666;" href="javascript:void(0)" id="notification_btn" class="dropdown-toggle" data-toggle="dropdown" data-target="#notification_list" aria-expanded="false"><span class="glyphicon glyphicon-bell"></span></a>
             
            
            <ul class="dropdown-menu cs-drp-menu notification_list" >
            <div class="notification_header">NOTFICATIONS</div>  
            <div class="notification_body" id="notification_list"></div>
            </ul>
            </div>
            </li>
     		
     	 
     	    
     	    <form method="post" style="display:inline-block;">
	           <div class="searchbox">
               <div class="input-group">
                  <input class="form-control search_bar search_keyword" type="text" name="admin_search" id="admin_search" placeholder="Search..." autocomplete="off">
                  <div id="show1"></div>
               </div>
              </div>
              </form>
     	    </div>
		

     
     	
     


</header>
<style>
.searchbox {
    display: inline-block;
    float: right;
    padding: 6px;
}
.searchbox .search_bar {
    height: 36px;
    width: 357px !important;
    font-size: 14px;
    margin-top: 0px;
    background: #FFF url(https://orders.snapweb.com/assets/images/search-icon.png) no-repeat 330px center !important;
}

  .cls-srch-sugg  {
        padding: 10px;
    border-bottom: 1px #CDCDCD dashed;}
    .show {
    display: block !important;
}
div#show1 {
    background: #fff;
    border: 1px solid #e1e1e1;
    padding: 2px 6px;
    margin:32px 0;
    width:357px !important;
    position: absolute;
}
.search_link{
text-decoration: none !important;
    color: #337ab7;
    font-size: 14px;
    
}

.cs-drp-menu:before {
    border-bottom: 10px solid rgba(0, 0, 0, 0.2);
    border-left: 10px solid rgba(0, 0, 0, 0);
    border-right: 10px solid rgba(0, 0, 0, 0);
    content: "";
    display: inline-block;
    left: 93.2%;
    position: absolute;
    top: -10px;
}
.cs-drp-menu:after {
    border-bottom: 9px solid #FFFFFF;
    border-left: 9px solid rgba(0, 0, 0, 0);
    border-right: 9px solid rgba(0, 0, 0, 0);
    content: "";
    display: inline-block;
    left: 93.5%;
    position: absolute;
    top: -9px;
}
.open > .dropdown-menu {
    display: block;
}
div#notification {
    top: 15px;
}

.notification_list {
    padding: 0;
    margin-top: 13px !important;
    background: #ffffff;
    width: 350px;
    /*min-height: 330px;*/
    height: auto;
    box-shadow: 1px 1px 10px #9e9e9e;
    /*overflow-y: scroll;*/
}
#notification_list li {
     background: #fff;
    border-bottom: 1px #282a2b;
    padding: 10px 5px;

  
}
#notification_list >li>a{
      text-decoration:none;
    white-space: inherit !important;
        color:#414141 !important;
}
#notification_list >li:hover{
   background:#f9f9f9;
   cursor:pointer;
}
.notification_header {
    background: #f9f9f9;
    padding: 10px;
    color: #414141 !important;
}
.notification_body > li {
    padding: 10px !important;
}
</style>
