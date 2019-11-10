<?php
//include (dirname(dirname( dirname(__FILE__) ))."/config/connection.php");

//include (dirname(dirname( dirname(__FILE__) ))."/includes/functions/handler-functions.php");
include 'db.php'
?>

<?php
// Get method name
session_start();


if(isset($_REQUEST['method'])) {
  
  $Method_Name = $_REQUEST['method'];
  // error_reporting(0);
  $errors = array(); // array to hold validation errors

  if($Method_Name=="Get_Manage_Automated_Emailers") {

	if(isset($_POST['aea_id']) && !empty($_POST['aea_id'])) {
		$aea_id = $_POST['aea_id'];
	} else {
	$errors['aea_id'] = 'Required Automated email alerts id';
	}

	// RMI - If Empty Errors
    if(empty($errors)) {

		$aea_id = $_POST['aea_id'];
  
		$query = mysqli_query($con,"SELECT * FROM tbl_Automated_Email_Alerts AS AEA LEFT JOIN tbl_Automated_Email_Alert_Templates AS AEAT ON AEA.Automated_Email_Alert_ID = AEAT.Automated_Email_Alert_ID WHERE AEA.Automated_Email_Alert_ID = '".$aea_id."'") or die(mysqli_error());  
  
		if (mysqli_num_rows($query) > 0) {
		 // RMI - Send a response using Json
		 while($row = mysqli_fetch_array($query)){
                                                    
			$Automated_Email_Alert_ID   			= $row['Automated_Email_Alert_ID'];
			$Alert_Days                 			= $row['Alert_Days'];
			$Alert_Time_From            			= date("g:i a",strtotime($row['Alert_Time_From'])); 
			$Alert_Time_To              			= date("g:i a",strtotime($row['Alert_Time_To'])); //$row['Alert_Time_To'];
			$Alert_Starts_From          			= $row['Alert_Starts_From'];
			$Alert_Starts_To            			= $row['Alert_Starts_To'];
			$Template_Email_Body        			= $row['Template_Email_Body']; // html to json
			$Automated_Email_Alert_Template_ID 		= $row['Automated_Email_Alert_Template_ID'];
			$Template_Name 							= $row['Template_Name'];

			$select_template_div = ' <select name="select_template" id="select_template" class="template_option input_field">
		
				<option selected="true" disabled="disabled">Select Template</option> 
				<option value="'.$Automated_Email_Alert_Template_ID.'">'.$Template_Name.'</option>
				
			
			</select>';

		}
		
		$mon = ''; $tue = ''; $wed =''; $thu =''; $fri= ''; $sat = ''; $sun ='';
		if (in_array("Monday", explode(",",$Alert_Days))){ 		$mon  =   'checked';}
		if (in_array("Tuesday", explode(",",$Alert_Days))){ 	$tue  =   'checked';}
		if (in_array("Wednesday", explode(",",$Alert_Days))){ 	$wed  =   'checked';}
		if (in_array("Thursday", explode(",",$Alert_Days))){ 	$thu  =   'checked';}
		if (in_array("Friday", explode(",",$Alert_Days))){ 		$fri  =   'checked';}
		if (in_array("Saturday", explode(",",$Alert_Days))){ 	$sat  =   'checked';}
		if (in_array("Sunday", explode(",",$Alert_Days))){ 		$sun  =   'checked';}

		$day_check = '<div class="col-sm-10">
			<div class="col-cs">
				<div class="form-group">	
					<div><input type="checkbox" id="Mon" name="days" value="Monday" class="with-font chk" '.$mon.'/>
					<label for="Mon" class="lbl_FAcheckbox">Mon</label></div>										
				</div>
			</div>
			<div class="col-cs">
				<div class="form-group">	
					<div><input type="checkbox" id="Tues" name="days" value="Tuesday" class="with-font chk" '.$tue.'/>
					<label for="Tues" class="lbl_FAcheckbox">Tues</label></div>													
				</div>
			</div>
			<div class="col-cs">
				<div class="form-group">	
					<div><input type="checkbox" id="Wed" name="days" value="Wednesday" class="with-font chk" '.$wed.'/>
					<label for="Wed" class="lbl_FAcheckbox">Wed</label></div>													
				</div>
			</div>	
			<div class="col-cs">
				<div class="form-group">	
					<div><input type="checkbox" id="Thur" name="days" value="Thursday" class="with-font chk" '.$thu.'/>
					<label for="Thur" class="lbl_FAcheckbox">Thur</label></div>													
				</div>
			</div>	
			<div class="col-cs">
				<div class="form-group">	
					<div><input type="checkbox" id="Fri" name="days" value="Friday" class="with-font chk" '.$fri.'/>
					<label for="Fri" class="lbl_FAcheckbox">Fri</label></div>													
				</div>
			</div>	
			<div class="col-cs">
				<div class="form-group">	
					<div><input type="checkbox" id="Sat" name="days" value="Saturday" class="with-font chk" '.$sat.'/>
					<label for="Sat" class="lbl_FAcheckbox">Sat</label></div>													
				</div>
			</div>
			<div class="col-cs">
				<div class="form-group">	
					<div><input type="checkbox" id="Sun" name="days" value="Sunday" class="with-font chk" '.$sun.'/>
					<label for="Sun" class="lbl_FAcheckbox">Sun</label></div>													
				</div>
			</div>												
		</div> ';

		   // TZ - Send a response using Json
		   $status = "Success";
		   $status_message = "All data against the Automated_Email_Alert_ID is fetched";
		   
		   $json = array("Status" =>$status,  "StatusMessage" =>$status_message,"Automated_Email_Alert_ID" =>$Automated_Email_Alert_ID,"Alert_Days" =>$Alert_Days,"Alert_Time_From" => $Alert_Time_From,"Alert_Time_To" => $Alert_Time_To,  "Alert_Starts_From" =>$Alert_Starts_From,  "Alert_Starts_To" =>$Alert_Starts_To, "select_template_div" => $select_template_div, "day_check" => $day_check);
		   echo json_encode($json); 
	
		}
		else
		{
		  $status = "Error";
		  $status_message = "No data against the Automated_Email_Alert_ID is fetched";
		  $json = array("Status" =>$status,  "StatusMessage" =>$status_message,"Automated_Email_Alert_ID" =>$Automated_Email_Alert_ID,  "Alert_Days" =>$Alert_Days,  "Alert_Time_From" =>$Alert_Time_From,  "Alert_Time_To" =>$Alert_Time_To,  "Alert_Starts_From" =>$Alert_Starts_From,  "Alert_Starts_To" =>$Alert_Starts_To);
		  echo json_encode($json); 
		}
  
	  }    

  
  } // END: if($Method_Name=="Get_Manage_Automated_Emailers") {

  if($Method_Name=="Update_Automated_Email_Template") {

	
	if(isset($_POST['AEA_ID']) && !empty($_POST['AEA_ID'])) {
		$AEA_ID = $_POST['AEA_ID'];
	}
	else {
	$errors['AEA_ID'] = 'Required AEA_ID';
	}
	  
	if(isset($_POST['Alert_Time_From']) && !empty($_POST['Alert_Time_From'])) {
	$Alert_Time_From = $_POST['Alert_Time_From'];
	$Alert_Time_From = date("H:i",strtotime($Alert_Time_From));
	} else {
	$errors['Alert_Time_From'] = 'Required Alert_Time_From';
	}

	if(isset($_POST['Alert_Time_To']) && !empty($_POST['Alert_Time_To'])) {
	$Alert_Time_To = $_POST['Alert_Time_To'];
	$Alert_Time_To = date("H:i",strtotime($Alert_Time_To));
	} else {
	$errors['Alert_Time_To'] = 'Required Alert_Time_To';
	}

	if(isset($_POST['Alert_Starts_From']) && !empty($_POST['Alert_Starts_From'])) {
	$Alert_Starts_From = $_POST['Alert_Starts_From'];
	} else {
	$errors['Alert_Starts_From'] = 'Required Alert_Starts_From';
	}

	if(isset($_POST['Alert_Starts_To']) && !empty($_POST['Alert_Starts_To'])) {
	$Alert_Starts_To = $_POST['Alert_Starts_To'];
	} else {
	$errors['Alert_Starts_To'] = 'Required Alert_Starts_To';
	}

	if(isset($_POST['Selected_Days']) && !empty($_POST['Selected_Days'])) {
	$Selected_Days = $_POST['Selected_Days'];
	} else {
	$errors['Selected_Days'] = 'Required Selected_Days';
	}

	if(isset($_POST['Selected_Template']) && !empty($_POST['Selected_Template'])) {
	$Selected_Template = $_POST['Selected_Template'];
	} else {
	$errors['Selected_Template'] = 'Required Selected_Template';
	}

	$Last_Modified_On     = getAppDateTime($_SESSION['Timezone']);
	$Last_Modified_By     = "admin";

	if(empty($errors)) {


        $Is_Automated_Email_Updated 	     = Update_Automated_Email_Alert($AEA_ID,$Selected_Days,$Alert_Time_From, $Alert_Time_To, $Alert_Starts_From, $Alert_Starts_To,$Last_Modified_On,$Last_Modified_By);
        //$Is_Automated_Email_Template_Updated = Update_Automated_Email_Template($AEA_ID,$Selected_Template); && $Is_Automated_Email_Template_Updated!="ERROR"
        

        if($Is_Automated_Email_Updated!="ERROR" ) {
          
          $status = "Success";
          $status_message = "Automated Email Template Updated Successfully";          
          $json = array("Status" => $status, "StatusMessage" => $status_message, "AEA_ID" => $AEA_ID
		  , "Selected_Days" => $Selected_Days, "Alert_Time_From" => $Alert_Time_From, "Alert_Time_To" => $Alert_Time_To, "Alert_Starts_From" => $Alert_Starts_From,
		   "Alert_Starts_To" => $Alert_Starts_To,"Last_Modified_On" => $Last_Modified_On,"Last_Modified_By" => $Last_Modified_By);
          echo json_encode($json);

        }
        else
        {
          // RMI - Send a response using Json
          $status = "Error";
          $status_message = "Automated Email Template Updated Failed";
		  $json = array("Status" => $status, "StatusMessage" => $status_message, "AEA_ID" => $AEA_ID
		  , "Selected_Days" => $Selected_Days, "Alert_Time_From" => $Alert_Time_From, "Alert_Time_To" => $Alert_Time_To, "Alert_Starts_From" => $Alert_Starts_From,
		   "Alert_Starts_To" => $Alert_Starts_To,"Last_Modified_On" => $Last_Modified_On,"Last_Modified_By" => $Last_Modified_By
		);
          echo json_encode($json);
        }
    }
    else
    {
      // RMI - Send a response using Json
      $status = "Error";
      $status_message = "Automated Email Template Updated Failed: ".$errors;
      $json = array("Status" => $status, "StatusMessage" => $status_message);
      echo json_encode($json);
    }     
  
  } // END: if($Method_Name=="Update_Automated_Email_Template") {

  } // END: if(isset($_REQUEST['method'])) { 

function Update_Automated_Email_Alert($AEA_ID,$Selected_Days,$Alert_Time_From, $Alert_Time_To, $Alert_Starts_From, $Alert_Starts_To,$Last_Modified_On,$Last_Modified_By){
	
	global $con;

	$query = "UPDATE tbl_Automated_Email_Alerts
	SET
	   Alert_Days = '$Selected_Days' -- varchar(100)
	  ,Alert_Time_From = '$Alert_Time_From' -- time
	  ,Alert_Time_To = '$Alert_Time_To' -- time
	  ,Alert_Starts_From = '$Alert_Starts_From' -- date
	  ,Alert_Starts_To = '$Alert_Starts_To' -- date
	  ,Active = 1 -- bit(1)
	  ,Last_Modified_On = '$Last_Modified_On' -- datetime
	  ,Last_Modified_By = '$Last_Modified_By' -- varchar(50)
	WHERE Automated_Email_Alert_ID = $AEA_ID -- int(11)";
  
	
	// RMI - If connection or query is failed
	if (!mysqli_query($con,$query))
		{
		  $Source            =  "OMS";
		  $Request_URL       =  (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		  $Method            =  "Update_Automated_Email_Alert";
		  $Method_Type       =  "POST";
		  $Exception_Title   =  "Update Automated Email Alert Failed";
		  $Exception_Message =  mysqli_error($con);
		  $Other_Details     =  "Alert ID: $AEA_ID";
		  
		  addLog($Source, $Request_URL, $Method, $Method_Type, $Exception_Title, $Exception_Message, $Other_Details);
		  $result= '<div class="alert alert-success">Update Automated Email Alert Failed</div>';
		  return "ERROR";        
		}
	else
		{             
		  return "SUCCESS";
		}  

}

/*function Update_Automated_Email_Template($AEA_ID,$Selected_Template){
	
	global $con;

	$query = "UPDATE tbl_Automated_Email_Alert_Templates
	SET
	  Automated_Email_Alert_ID = NULL -- int(11)
	  WHERE Automated_Email_Alert_Template_ID = NULL -- int(11)";
  
	
	// RMI - If connection or query is failed
	if (!mysqli_query($con,$query))
		{
		  $Source            =  "OMS";
		  $Request_URL       =  (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		  $Method            =  "Update_Automated_Email_Alert";
		  $Method_Type       =  "POST";
		  $Exception_Title   =  "Update Automated Email Alert Failed";
		  $Exception_Message =  mysqli_error($con);
		  $Other_Details     =  "Alert ID: $AEA_ID";
		  
		  addLog($Source, $Request_URL, $Method, $Method_Type, $Exception_Title, $Exception_Message, $Other_Details);
		  $result= '<div class="alert alert-success">Update Automated Email Alert Failed</div>';
		  return "ERROR";        
		}
	else
		{             
		  return "SUCCESS";
		}  

}*/

function getAppDateTime($Timezone)
  {
    date_default_timezone_set($Timezone);
    $DateTime = date("Y/m/d H:i:s");
    return $DateTime;
  }