function confirmDelete()
{
   return confirm("Are you sure you want to delete this?");
}

$(document).ready(function(){
    
   $("#admin_search").keyup(function(){
// $("#admin_search").on('keyup',function () {
    var search_text = $("#admin_search").val();
     //var dataString = "search_text="+search_text; /* STORE THAT TO A DATA STRING */
 
 
       $.ajax({ /* THEN THE AJAX CALL */
        type:'POST', /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url:'admin_search.php', /* PAGE WHERE WE WILL PASS THE DATA */
       //data: dataString, /* THE DATA WE WILL BE PASSING */
       // data: { email_fetch_template : dataString },
        data: { admin_search : search_text },
        success: function(data){ /* GET THE TO BE RETURNED DATA */
          $("#show1").html(data); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
          
        }
      });

  });
  
  
  
  $("#select_all").click(function(){
     
     if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
     }
     else{
         $(':checkbox').each(function() {
            this.checked = false;                        
        });
         
     }
  });
  
    
// open notification dropdown    
$("#notification_btn").click(function(){
var class_anchor_link = $("#notification").attr('class');
if (class_anchor_link === "dropdown notification open")
{
$("#notification").removeClass("open");
}
else{
$("#notification").addClass("open");
$('#count').text('');
load_unseen_notification('yes');
}
});


function load_unseen_notification( is_seen = ''){

      //var is_seen = 0;
      $.ajax({ /* THEN THE AJAX CALL */
        type:'POST', /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url:'admin_notification.php', /* PAGE WHERE WE WILL PASS THE DATA */
       //data: dataString, /* THE DATA WE WILL BE PASSING */
       // data: { email_fetch_template : dataString },
        data: { is_seen : is_seen },
        dataType: 'json',
       success:function(data){
          var notification = data['notification'];
          var notification_count = data['notification_count'];
          
          
           $('#notification_list').html(notification);
           if(notification_count > 0){
                $('#count').html(notification_count);
           }
          
     
      }
      
      
  });
  
      }       
       
// $(window).bind(‘load’, function(){}) will run after page has loaded.        
   $(window).bind("load", function() {
   load_unseen_notification();
});  

setInterval(function(){
 
 load_unseen_notification();
 
}, 5000);
 


    $(".comment_action").click(function(){
 
        var id = this.id;   // Getting full Button id
        var split_id = id.split("_"); // split the id

        var text = split_id[0]; // _ get before underscore text
        var postcomment_id = split_id[1];  // _ get after underscore text
        
       var comment_action = $('#commentaction_'+postcomment_id).val();
 
 $.ajax({ /* THEN THE AJAX CALL */
        type:'POST', /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url:'admin_notification.php', /* PAGE WHERE WE WILL PASS THE DATA */
        data: { postcomment_id : postcomment_id,comment_action : comment_action
        },
        dataType: 'json',
      success:function(data){
           var action = data['action'];
           var status = data['status'];
           var color = data['color'];
           var postcomment_id = data['postcomment_id'];
          
           $('#commentaction_'+postcomment_id).val(action);
           if(action == "approved"){
               $('#commentaction_'+postcomment_id).removeClass("btn-danger").addClass("btn-success");
           }
           else{
                $('#commentaction_'+postcomment_id).removeClass("btn-success").addClass("btn-danger");
           }
           
           if(status == "Approved"){
                $('#status_'+postcomment_id).removeClass("text-danger").addClass("text-success");
           }
           else{
               $('#status_'+postcomment_id).removeClass("text-success").addClass("text-danger");
           }
          
           $('#status_'+postcomment_id).html(status);
           
           }
      
      
  });

});
});


/*
function getresult(url) {
	$.ajax({
		url: "post-list.php",
		type: "POST",
		
		beforeSend: function(){$("#overlay").show();},
		success: function(data){
		$("#pagination-result").html(data);
		setInterval(function() {$("#overlay").hide(); },500);
		},
		error: function() 
		{} 	        
   });
}
function changePagination(option) {
	if(option!== "") {
		getresult("post-list.php");
	}
}*/



