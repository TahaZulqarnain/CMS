<?php
// Created By: TZ
// Created On: 2018-10-24
// File Description: 
include ('header.php');
include 'db.php'
?>
<script src="assets/js/bootstrap-timepicker.min.js"></script>

<style>
    .input_field {
        margin-bottom: 10px;
    }
    
    textarea {
        resize: none;
    }
    
    .template_option {
        border: 1px solid #D8D8D8;
        padding: 6px 12px;
        font-size: 12px;
        width: 100%;
    }
    
    .fl-right {
        float: right;
    }
    
    .md-20 {
        margin-bottom: 20px;
    }
    
    .sp-20 {
        padding-top: 20px;
    }
    
    .line-sep {
        border: 1px solid #e1e1e1;
        margin: 20px 0;
    }
    .col-cs{
        display:inline-block;
        margin: 0 6px;
    }
    .col-btn{
        margin-left: 15px;
    }
    input[type=radio].with-font,
		input[type=checkbox].with-font {
		    border: 0;
		    clip: rect(0 0 0 0);
		    height: 1px;
		    margin: -1px;
		    overflow: hidden;
		    padding: 0;
		    position: absolute;
		    width: 1px;
		}
		    
		input[type=radio].with-font ~ label:before,
		input[type=checkbox].with-font ~ label:before {
		    font-family: FontAwesome;
		    display: inline-block;
		    content: "\f1db";
		    letter-spacing: 10px;
		    font-size: 1.2em;
		    color: #535353;
		    width: 1.4em;
		}

		input[type=radio].with-font:checked ~ label:before,
		input[type=checkbox].with-font:checked ~ label:before  {
		    content: "\f00c";
		    font-size: 1.2em;
		    color: #333333;
		    letter-spacing: 5px;
		}
		input[type=checkbox].with-font ~ label:before {        
		    content: "\f096";
		}
		input[type=checkbox].with-font:checked ~ label:before {
		    content: "\f046";        
		    color: #333333;
		}
		input[type=radio].with-font:focus ~ label:before,
		input[type=checkbox].with-font:focus ~ label:before,
		input[type=radio].with-font:focus ~ label,
		input[type=checkbox].with-font:focus ~ label
		{                
		    color: #333333;
		}
	
	.lbl_FAcheckbox {
	    font-size: 16px !important;
	    font-weight: 400 !important;
	    font-family: 'Open Sans' !important;
	    color: #656565;
	    outline: none !important;
	    -webkit-touch-callout: none;
	    -webkit-user-select: none;
	    -khtml-user-select: none;
	    -moz-user-select: none;
	    -ms-user-select: none;
	    user-select: none;
	    outline-style: none;
	}
    .border_red{
        border-color: red;
    }
    .border_gray{
        border-color: #e1e1e1;
    }
</style>

    <div class="row cs-order-title-bar">
        <!-- TZ - .container - start -->
        <div class="container">
            <div class="cs-order-title-text">
                Create New Email Template
                <div class="cls-title-search-box">
                    <input type="hidden" name="Search">
                    <input type="text" class="form-control search_bar search_keyword" id="Keyword_Search" name="Keyword_Search" maxlength="30" value="" placeholder="Search" autocomplete="off" />
                    <div id="SearchSuggestion"></div>
                </div>
            </div>
        </div>
        <!-- TZ - .container - end -->
    </div>

    <div class="main-content" style="margin-top:0px;">
        <!-- TZ - .container - start -->
        <div class="container">
            <!-- TZ - MAIN ROW START -->
            <div class="row">
                <!-- TZ -  - Main Column Start For Manage Order -->

                <div class="col-md-3">
                    <?php 
				include ('admin-sidebar.php');
			?>
                </div>

                <div class="col-md-9">
                    <!-- TZ - Panel Start -->
                    <div class="panel panel-gradient no-border" data-collapsed="0">

                        <div class="panel-body cs-bg-lgrey no-padding">
                            <!-- TZ -  - Row Start-->
                            <div class="row">
                                <!-- TZ - Form Open -->
                                <form action="" method="post" onsubmit="showSpinner();">

                                    <!-- TZ -  - Column Start For Manage automated emailers -->
                                    <div class="col-md-12">

                                        <div class="alert alert-warning" style="text-align: center;display: none;" id="error_warning"><span class="glyphicon glyphicon-warning-sign"></span> Please fill all required filed</div>

                                        <?php
								if(isset($_GET['updated']) && $_GET['updated']=="true") {

									echo '<div class="alert alert-success" style="text-align: center;font-weight: 600;" id="success_alert" >Emailer Updated Sucessfully</div>';

								}

								?>

                                            <!-- TZ -  - Panel Start For Manage automated emailers -->
                                            <div class="panel panel-gradient" data-collapsed="0">

                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <i class="entypo-tag cs-icon-circle-shape"></i> Manage Automated Emailer
                                                    </div>

                                                </div>

                                                <div class="panel-body">
                                                    <div id="result"></div>

                                                    <!-- TZ - ROW START -->

                                                    <!-- Reterive data from database Starts -->
                                                    <?php 
                                                    $Select_Query = "SELECT * FROM tbl_Automated_Email_Alerts";
                                                    $result = mysqli_query($con,$Select_Query);
                                                    
                                                        while($row = mysqli_fetch_array($result)){
                                                    
                                                          $Automated_Email_Alert_ID   = $row['Automated_Email_Alert_ID'];
                                                          $Alert_Name                 = $row['Alert_Name'];
                                                          $Alert_Description          = $row['Alert_Description'];
                                                        //   $Alert_Days                 = $row['Alert_Days'];
                                                        //   $Alert_Time_From            = date("g:i a",strtotime($row['Alert_Time_From'])); 
                                                        //   $Alert_Time_To              = date("g:i a",strtotime($row['Alert_Time_To'])); //$row['Alert_Time_To'];
                                                        //   $Alert_Starts_From          = $row['Alert_Starts_From'];
                                                        //   $Alert_Starts_To            = $row['Alert_Starts_To'];
                                                        
                                                        

                                                         
                                                      
                                                    ?>

                                                    
                                                    <!-- Reterive data from database End -->

                                                    <!-- Collapse buttons -->
                                                    <div class="row">
                                                        <!-- <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a> -->
                                                    <!-- <input type="hidden" name="<?php //echo "AEAID_".$Automated_Email_Alert_ID; ?>" id="<?php //echo "AEAID_".$Automated_Email_Alert_ID; ?>" value="<?php echo $Automated_Email_Alert_ID;?>">
                                                        --><div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9"> 
                                                            <h3><?php echo $Alert_Name; ?></h3>
                                                            <p><?php echo $Alert_Description; ?></p>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 sp-20">
                                                            <button class="btn btn-primary fl-right" id="<?php echo "AEAID_".$Automated_Email_Alert_ID; ?>" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                Manage
                                                            </button>

                                                        </div>

                                                    </div>
                                                    <!-- / Collapse buttons -->
                                                    <?php } ?>
                                                    <!-- Collapsible element -->
                                                    <div class="md-20"></div>
                                                    <div class="collapse" id="collapseExample">
                                                        <div class="mt-3">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label">Time From</label>

                                                                        <div class="col-md-8">
                                                                            <div class="input-group input_field">
                                                                                <input type="text" id="Alert_Time_From" name="Alert_Time_From" value="" class="form-control timepicker" data-template="dropdown"  />

                                                                                <div class="input-group-addon">
                                                                                    <a href="#"><i class="entypo-clock"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label">Time To</label>

                                                                        <div class="col-md-8">
                                                                            <div class="input-group input_field">
                                                                                <input type="text" id="Alert_Time_To" name="Alert_Time_To" value="" class="form-control timepicker" data-template="dropdown"  />

                                                                                <div class="input-group-addon">
                                                                                    <a href="#"><i class="entypo-clock"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label">Date From</label>

                                                                        <div class="col-md-8">
                                                                            <div class="input-group input_field">
                                                                                <input type="text" id="Alert_Starts_From" name="Alert_Starts_From"  value="" class="form-control datepicker" data-format="yyyy-mm-dd">
                                                                                <div class="input-group-addon"> <a href="#"><i class="entypo-calendar"></i></a> </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label">Date To</label>

                                                                        <div class="col-md-8">
                                                                            <div class="input-group input_field">
                                                                                <input type="text" id="Alert_Starts_To" name="Alert_Starts_To" value="" class="form-control datepicker" data-format="yyyy-mm-dd">
                                                                                <div class="input-group-addon"> <a href="#"><i class="entypo-calendar"></i></a> </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row input_field">
                                                                <div class="col-lg-12">
                                                                   <div class="form-group">
                                                                      <label class="col-sm-2 control-label">Days</label>
                                                                <div id="day_check"></div>
					                                                </div>
                                                                </div>
					                                        </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group input_field">
                                                                        <label class="col-md-4 control-label ">Select Template</label>

                                                                        <div class="col-md-8">
                                                            
                                                                        <div id="select_template_div"></div>

                                                                            <!-- <select name="select_template" id="select_template" class="template_option input_field">
                                                                            <?php 
                                                                                // $select_sql = "SELECT * FROM tbl_Automated_Email_Alert_Templates WHERE Automated_Email_Alert_ID = $Automated_Email_Alert_ID";
                                                                                // $run_sql = mysqli_query($con,$select_sql);
                                                                                // ?>
                                                                                // <option selected="true" disabled="disabled">Select Template</option> 
                                                                                // <?php
                                                                                // while( $rows = mysqli_fetch_assoc($run_sql))
                                                                                // {
                                                                                //     echo '<option value="'.$rows['Automated_Email_Alert_Template_ID'].'">'.ucfirst($rows['Template_Name']).'</option>';
                                                                                    

                                                                                // }
                                                                                
                                                                                ?>
                                                                            </select> -->

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-12 col-btn fl-right">
                                                                  <button type="button" class="btn btn-success" id="update_automated_email_template">Save</button>
                                                                  <button type="button" class="btn btn-default" id="cancel">Cancel</button>
                                                                </div>
                                                            </div>
                                                                
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="line-sep"></div>
                                                    <div id="ResultJson"></div>
                                                    
                                                    <!-- / Collapsible element -->
                                                        
                                                </div>
                                            </div>
                                            <!-- TZ - Panel Start -->
                                    </div>
                                    <!-- TZ -  - Main Column End For Manage Customer -->
                                </form>
                            </div>
                            <!-- TZ - MAIN ROW START -->
                        </div>
                        <!-- TZ - .container - end -->

                    </div>
                </div>
            </div>
        </div>
        <?php		
include ('footer.php');		
?>
</div>

<!-- TZ SCRIPT STARTS -->
<script type="text/javascript">


// FUNCTION: $(document).ready(function()
$(document).ready(function(){
    $('#manage_automated_emailers').click(function() {	
        
        //var aea_id = $("#AEA_ID").val();

        var id = this.id;   // Getting full Button id
        var split_id = id.split("_"); // split the id

        var text = split_id[0]; // _ get before underscore text
        var aea_id = split_id[1];
        
        var formData = {
			'method' 									:'Get_Manage_Automated_Emailers',
			'aea_id'								    : aea_id,
		}

	    $.ajax({  
	    type: "POST",  
	    url: 'includes/ajax/manage-automated-emailer-ajax.php',
	    data: formData, 
	    dataType: 'json', // what type of data do we expect back from the server
	    encode: true
	    }) 
		// using the done promise callback
	    .done(function (data) {
			
			console.log(data);

	        if(data.Status == "Success") {

                //$("#ResultJson").html(data.Alert_Time_To);
                var Alert_Time_From = data.Alert_Time_From;
                var Alert_Time_To = data.Alert_Time_To;
                var Alert_Starts_From = data.Alert_Starts_From;
                var Alert_Starts_To = data.Alert_Starts_To;
                var day_check = data.day_check;
                var select_template_div = data.select_template_div;
                $("#Alert_Time_From").val(Alert_Time_From);
                $("#Alert_Time_To").val(Alert_Time_To);
                $("#Alert_Starts_From").val(Alert_Starts_From);
                $("#Alert_Starts_To").val(Alert_Starts_To);
                $("#select_template_div").html(select_template_div);
                $("#day_check").html(day_check);	
			}
			else
			{

			}

		}); // END .done(function (data) {

    }); //END $('#manage_automated_emailers').click(function() {	

    $('#update_automated_email_template').click(function() {	
      
      var AEA_ID                           = $("#AEA_ID").val();
      var Alert_Time_From       		   = $("#Alert_Time_From").val();
      var Alert_Time_To  			       = $("#Alert_Time_To").val();
      var Alert_Starts_From                = $("#Alert_Starts_From").val();
      var Alert_Starts_To                  = $("#Alert_Starts_To").val();
      var Is_Field_Error 				   = false;

      var chkArray = [];
	     
      /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
      $(".chk:checked").each(function() {
          chkArray.push($(this).val());
      });

      /* we join the array separated by the comma */
      var Selected_Days;
      Selected_Days = chkArray.join(',') ;
      var Selected_Template = $("#select_template :selected").val();   

        if($("#Alert_Time_From").val() === '') {
	        Is_Field_Error = true;
	       	var ID = 'Alert_Time_From';
        	SuccessMessage(ID);
      	}
      	else{
      		var ID = 'Alert_Time_From';
			ErrorMessage(ID);
      	}

        if($("#Alert_Time_To").val() == '') {
	        Is_Field_Error = true;
	       	var ID = 'Alert_Time_To';
        	SuccessMessage(ID);
      	}
      	else{
      		var ID = 'Alert_Time_To';
			ErrorMessage(ID);
      	}  

        if($("#Alert_Starts_From").val() == '') {
	        Is_Field_Error = true;
	       	var ID = 'Alert_Starts_From';
        	SuccessMessage(ID);
      	}
      	else{
      		var ID = 'Alert_Starts_From';
			ErrorMessage(ID);
      	}   

        if($("#Alert_Starts_To").val() == '') {
	        Is_Field_Error = true;
	       	var ID = 'Alert_Starts_To';
        	SuccessMessage(ID);
      	}
      	else{
      		var ID = 'Alert_Starts_To';
			ErrorMessage(ID);
      	}   

        if($("#select_template").val() == null) {
	        Is_Field_Error = true;
	       	var ID = 'select_template';
        	SuccessMessage(ID);
      	}
      	else{
      		var ID = 'select_template';
			ErrorMessage(ID);
      	}   

        if(Is_Field_Error != true) {

            $("#update_automated_email_template").attr("disabled", "disabled");
		    $("#update_automated_email_template").html("<i class='fa fa-circle-o-notch fa-spin'></i> Please wait..");

            var formData = {
                'method' 									:'Update_Automated_Email_Template',
                'AEA_ID'                                    : AEA_ID,
                'Alert_Time_From'							: Alert_Time_From,
                'Alert_Time_To'							    : Alert_Time_To,
                'Alert_Starts_From'							: Alert_Starts_From,
                'Alert_Starts_To'							: Alert_Starts_To,
                'Selected_Days'                             : Selected_Days,
                'Selected_Template'							: Selected_Template
            };
        
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'includes/ajax/manage-automated-emailer-ajax.php', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })

        .done(function (data) {

            console.log(data);

            if(data.Status == "Error") {

                //Scroll To Top Of Page
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;	

                /*if(data.StatusMessage['Promo_Code']) {
                    var ID = 'Promo_Code';
                    SuccessMessage(ID);
                }
                else{
                    var ID = 'Promo_Code';
                    ErrorMessage(ID);
                }*/
                
                }
                if(data.Status == "Success") {

                    
                    $("#update_automated_email_template").removeAttr("disabled");
					$("#update_automated_email_template").html("Save");
                    
                   //window.location.href= '?updated=true';
                    $("#error_warning").css("display","block");
                    $("#error_warning").removeClass("alert-warning");
                    $("#error_warning").addClass("alert-success");
                    $("#error_warning").html("<span class='glyphicon glyphicon-warning-sign'></span> Emailer Updated successfully");                	
                    setTimeout(function(){  $("#error_warning").fadeOut(); }, 3000);
                } 

        }); // END: .done(function (data)    



        }

    }); // END  $('#update_automated_email_template').click(function() {

}); 

function SuccessMessage(ID){
		//Scroll To Top Of Page
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;	
    	$("#error_warning").css("display","block");
		$("#error_warning").html("<span class='glyphicon glyphicon-warning-sign'></span> You must enter a value for all required fields");
    	$("#"+ID+"").removeClass("border_gray");              	
		$("#"+ID+"").addClass("border_red");
} // END: function SuccessMessage() {

function ErrorMessage(ID){
		$("#error_warning").css("display","none");
		$("#"+ID+"").removeClass("border_red");
		$("#"+ID+"").addClass("border_gray");
} // END: function ErrorMessage() {

</script>
<!-- TZ SCRIPT END -->