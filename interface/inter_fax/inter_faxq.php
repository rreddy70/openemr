<?php
  // Copyright (C) 2012 Ensoftek 
 //
 // This program is free software; you can redistribute it and/or
 // modify it under the terms of the GNU General Public License
 // as published by the Free Software Foundation; either version 2
 // of the License, or (at your option) any later version.

 // This program is a part of InterFax implementation

 require_once("../globals.php");
 require_once("$srcdir/acl.inc");
 require_once("$srcdir/common_interfax_functions.php");
 require_once("$srcdir/patient.inc");

 $mlines = array();
 $dlines = array();
 $slines = array();

 ?>
<html>

<head>
<?php html_header_show();?>

<link rel="stylesheet" href='<?php echo $css_header ?>' type='text/css'>
<title><?php xl('F','e'); ?></title>

<style>
td {
 font-family: Arial, Helvetica, sans-serif;
 padding-left: 4px;
 padding-right: 4px;
}
a, a:visited, a:hover {
 color:#0000cc;
}
tr.head {
 font-size:10pt;
 background-color:#cccccc;
 font-weight: bold;
}
tr.detail {
 font-size:10pt;
}
td.tabhead {
  font-size: 11pt;
  font-weight: bold;
  height: 20pt;
  text-align: center;
}
</style>

<script type="text/javascript" src="../../library/dialog.js"></script>

<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/common.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/fancybox-1.3.4/jquery.fancybox-1.3.4.patched.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['webroot'] ?>/library/js/fancybox-1.3.4/jquery.fancybox-1.3.4.css" media="screen" />
<script language="JavaScript">

$(document).ready(function(){
// special size for
$(".find_patient_modal").fancybox( {
	'titleShow' : false,
	'showCloseButton' : true,
	'opacity' : true,
      	'overlayShow' : true,
	'showCloseButton' : true,
	'transitionOut' : 'none',
	'transitionIn' : 'none',
		'overlayOpacity' : 0.0,
	'width' : 675,
	'height' : 300,
            'centerOnScroll' : false
	});
});
// Process click on a tab.
function tabclick(tabname) {
 var tabs = new Array('faxin', 'faxout');
 var visdisp = document.getElementById('bigtable').style.display;

 for (var i in tabs) {
  var thistd    = document.getElementById('td_tab_' + tabs[i]);
  var thistable = document.getElementById('table_' + tabs[i]);
  if (tabs[i] == tabname) {
   // thistd.style.borderBottom = '0px solid #000000';
   thistd.style.borderBottom = '2px solid transparent';
   thistd.style.color = '#cc0000';
   thistd.style.cursor = 'default';
   thistable.style.display = visdisp;
  } else {
   thistd.style.borderBottom = '2px solid #000000';
   thistd.style.color = '#777777';
   thistd.style.cursor = 'pointer';
   thistable.style.display = 'none';
  }
 }
}

// Callback from popups to refresh this display.
function refreshme() {
 location.reload();
}

//surya
//Process fax document filename to view.
function dovfdclick(ffile) {
 cascwin('inter_fax_view.php?faxdoc=' + ffile, '_blank', 600, 475,
  "resizable=1,scrollbars=1");
 return false;
}
function incdovfdclick(ffile) {
	 cascwin('inter_fax_view.php?incomingfaxdoc=' + ffile, '_blank', 600, 475,
	  "resizable=1,scrollbars=1");
	 return false;
	}

//send fax
function sendfax()
{
 window.location.href="../../interface/usergroup/send_to_fax_form.php";
}

<?php require($GLOBALS['srcdir'] . "/restoreSession.php"); ?>

// This is for callback by the find-patient popup.
function setpatient(pid, lname, fname, dob) {
 var f = document.forms['faxList'];
 f.form_patient.value = lname + ', ' + fname;
 f.form_pid.value = pid; 
}

//This invokes the find-patient popup.
function sel_patient() {
 $('#fFindPatient').trigger('click');	 

 return false;

}

</script>

</head>
<div id="addressbook_list">
<body class="body_top">
<!-- fancybox -->
<div "display:none">
 <a href="../main/calendar/find_patient_popup.php" id="fFindPatient" class="link_submit find_patient_modal iframe"></a>
 <a href="#" id="fFindAppt" class="link_submit find_patient_modal iframe"></a>
</div>
<?php 
// checking mark as read/unread faxes 
if (isset($_GET['task'])) $task=$_GET['task'];
if (isset($_POST['task'])) $task=$_POST['task'];
$patientname = xl('Select patient');

if($task=='markasread')
{
	
	$read_id = $_POST['mark_id'];
	
	for($i = 0; $i < count($read_id); $i++) {
           sqlStatement("UPDATE receive_fax SET read_fax=1 WHERE message_id = {$read_id[$i]};");
        }
}
else if($task=='markasunread')
{
	$unread_id = $_POST['mark_id'];
        for($i = 0; $i < count($unread_id); $i++) {
           sqlStatement("UPDATE receive_fax SET read_fax=0 WHERE message_id = {$unread_id[$i]};");
        }
}
else if($task=='move')
{
	$move_id = $_POST['mark_id'];
	if($_POST['form_pid']!="")
	{
        for($i = 0; $i < count($move_id); $i++) {
           sqlStatement("UPDATE receive_fax SET pid=".$_POST['form_pid']." WHERE message_id = {$move_id[$i]};");
        }
	}
	else 
	{
		echo "<script language='JavaScript'>\n";
				echo "alert('Please select patient');";
				echo "</script>\n";
	}
}
else if($task=='remove')
{
	$remove_id = $_POST['mark_id'];
        for($i = 0; $i < count($remove_id); $i++) {
           sqlStatement("UPDATE receive_fax SET pid=NULL WHERE message_id = {$remove_id[$i]};");
        }
}

if($_GET['tab_name'])
{
echo "<script language='JavaScript'>\n";
				echo "tabclick('faxout');";
				echo "</script>\n";
}

$key = md5('password');
//$decrypted_value = Decrypt($GLOBALS['interfax_user_pwd'],$key);
$decrypted_value = $GLOBALS['interfax_user_pwd'];

// update the fax status
if ($_GET['transaction_id']) {
	
	$client = new SoapClient("http://ws.interfax.net/dfs.asmx?WSDL");
	
	$TransactionID=$_GET['transaction_id'];
	$params->Username          = $GLOBALS['interfax_user_id'];
	$params->Password          = $decrypted_value;
	$params->Verb       = 'EQ';
	$params->VerbData   = $TransactionID;
	$params->MaxItems   = 10;
	$params->ResultCode = '';
	

	$queryResult = $client->FaxQuery($params);
	
	if($queryResult->ResultCode == 0)
	{
		$status='Success';
	}
	else if($queryResult->ResultCode>0)
	{
		$status='In Process';
	}
	elseif($queryResult->ResultCode<0)
	{
		$status='Failure';	
	}
	sqlStatement("UPDATE `fax_details` SET `status`=? WHERE `transaction_id`=? ", array($status,$TransactionID) );

}
else if ($_GET['fax_id']) {
	$dir = $GLOBALS['fileroot'].'/sites/'.$_SESSION{"authProvider"}.'/documents/fax_docs/outgoing';
	$faxrow=sqlQuery("select fax_number, receiver, subject, reply_address, attachment, patient_id, facility_id, sender_id from fax_details where id=".$_GET['fax_id']);
	$faxfileext=explode(".", $faxrow['attachment']);
			$username = $GLOBALS['interfax_user_id']; // Enter your Interfax username here
			$password = $decrypted_value; // Enter your Interfax password here
			$faxnumbers = $faxrow['fax_number'];  // Enter your designated fax number here in the format +[country code][area code][fax number], for example: +12125554874
			$filename = $dir."/".$faxrow['attachment']; // A file in your filesystem
			$filetype = array_pop($faxfileext); // File format; supported types are listed at 
			                   // http://www.interfax.net/en/help/supported_file_types 
			$contacts = $faxrow['receiver'];
			$subject  = $faxrow['subject'];
			$replyemail = $faxrow['reply_address'];
			$pageheader = 'To: {To} From: {From} Pages: {TotalPages}';
			
			// Open File
			if( !($fp = fopen($filename, "r"))){
			    // Error opening file
			    echo "Error opening file";
			    exit;
			}
			 
			// Read data from the file into $data
			$data = "";
			while (!feof($fp)) $data .= fread($fp,1024);
			fclose($fp);
			 
			 
			$client = new SoapClient("http://ws.interfax.net/dfs.asmx?WSDL");
			 
			$params->Username  = $username;
			$params->Password  = $password;
			$params->FaxNumber = $faxnumbers;
			$params->Contacts  =  $contacts;
			$params->FileData  = $data;
			$params->FileType  = $filetype;
			$params->Subject           =  $subject;
			$params->ReplyAddress      =  $replyemail;
			$params->PageHeader        =  $pageheader;
			 
			$result = $client->Sendfax($params);

			$TransactionID = '';
			$Status = '';
			if($result->SendfaxResult<0)
			{
				$Status = 'Failure';	
				echo "<script language='JavaScript'>\n";
				echo "alert('Inputs are invalid');\n";
				echo "</script></body>\n";
			}
			else 
			{
				$Status = 'In Process';
				$TransactionID = $result->SendfaxResult;
				echo "<script language='JavaScript'>\n";
				echo "alert('Fax Sent Successfully');\n";
				echo "</script></body>\n";
			}
			
			$faxfilename=explode("/", $filename);
			
		  $insert_id=sqlInsert("INSERT INTO fax_details SET " .
		  "transaction_id = '"   .$TransactionID. "', " .
		  "fax_number = '"       . trim($faxnumbers) . "', " .
		  "receiver  = '"        . trim($contacts) . "', " .
		  "subject = '"          . trim($subject) . "', " .
		  "reply_address = '"    . trim($replyemail) . "', " .
		  "attachment = '"       . trim(array_pop($faxfilename)) . "', " .
		  "status = '"           . trim($Status) . "', " .
		  "patient_id = '"       . $faxrow['patient_id'] . "', " .
		  "facility_id = '"      . $faxrow['facility_id'] . "', " .
		  "sender_id = '"        . $faxrow['sender_id'] . "', " .
		  "send_date = now()");
	

	
}//get latest messages for click on refresh 
else if($_GET['list_type']) {

updatedFaxes($_GET['list_type']);

}// delete the incoming faxes
else if($_GET['action']=='delete')
{
	$message_id=$_GET['message_id'];
	sqlQuery("DELETE FROM receive_fax WHERE message_id='$message_id' ");
}

//get latest messages from inter fax and save to database
function updatedFaxes($listtype)
{
$username = $GLOBALS['interfax_user_id']; // Enter your Interfax username here
$password = $decrypted_value; // Enter your Interfax password here
$maxitems  = '10'; // Maximum number of inbound faxes to return in list

$client = new SoapClient("http://ws.interfax.net/inbound.asmx?wsdl");


 
$params->Username  = $username;  
$params->Password  = $password;
$params->LType	   = $listtype;
$params->MaxItems  = $maxitems;
 

$result = $client->GetList($params);
 
if (!$result->GetListResult){ // WS call successful

	if (count($result->objMessageItem->MessageItem) > 0) { 
		
		
	if(count($result->objMessageItem->MessageItem) == 1){
	// there are two or more items returned in the list
			foreach ($result->objMessageItem AS $inboundfax){
		
				try{
					//save the output file
				
				$messageid = $inboundfax->MessageID; // Transaction ID of the inbound message to be read
				$message_size = $inboundfax->MessageSize;  // Size in bytes of the inbound message. This value
				                     // is returned by method GetList, which should be run
				                     // before this one
				$markasread = TRUE; // Mark the item as 'read' after downloading? If TRUE, 
				                     // item will no longer be 'new' and will be shown upon
				                     // subsequent list retrieval via GetList
				$save_as_file = TRUE;  // If false, PDF will be shown on screen
				/**************** Settings end ****************/
				 
				$chunk_size = 100000;
				$image = '';
				 
				$client = new SoapClient("http://ws.interfax.net/inbound.asmx?WSDL");
				 
				$params->Username   = $username;
				$params->Password   = $password;
				$params->MessageID  = $messageid;
				$params->MarkAsRead = $markasread;
				$params->ChunkSize  = $chunk_size;
				 
				
				for($i=0; $i < $message_size; $i+= $chunk_size){
				 
				    $params->From = $i;
				    $result = $client->GetImageChunk($params);
				   
				    if ($result->GetImageChunkResult == 0) {
				        $image .= $result->Image;     // No need to base64_decode($result->Image); PHP5 does this for you
				 
				    } else {
				        die('Problem retrieving image chunk #' . $i . ' on error <a href="http://www.interfax.net/en/dev/webservice/reference/web-service-return-codes">' . $result->GetImageChunkResult . '</a>');
				    }
				}
				 
				// an inbound fax has been successfully retrieved
				// establish file type

				if (substr($image, 0, 3) == 'II*'){ // TIF file
				        $file_type = 'tif';
				    } else {
				        if(substr($image, 0, 4) == '%PDF'){ //PDF file
				            $file_type = 'pdf';
				        } 
				        else {
				            die('Unrecognized file type');
				        }
				    }
				 
				if ($save_as_file){ 
				 
				$output_filename = $messageid . '.' . $file_type;
			 	 $dir = $GLOBALS['fileroot'].'/sites/'.$_SESSION{"authProvider"}.'/documents/fax_docs/incoming';
				    $newfile =  $dir.'/'.$output_filename;
				    
				    if (!$handle = fopen($newfile, 'w')) {
				        echo "Cannot open file ($output_filename)";
				        exit;
				        }
				
				    if (fwrite($handle, $image) === FALSE) { 
				        echo "Cannot write to file $output_filename";
				        exit;
				        }
				    fclose($handle);
					 
				  
				 				 
				} else { 
					// output to screen
					switch($file_type){
						case 'pdf':
						header ("Content-type: application/pdf"); // Set the image type according to the fax type: image/tiff or application/pdf
						break;
				 
						case 'tif':
						header ("Content-type: image/tiff"); // Set the image type according to the fax type: image/tiff or application/pdf
						break;
					}
				 
					echo $image;
				}

					
					
				//save the record in database		
				 $insert_id=sqlInsert("INSERT INTO receive_fax SET " .
					  "message_id = '"   . $inboundfax->MessageID . "', " .
					  "phone_number = '"       . $inboundfax->PhoneNumber . "', " .
					  "status  = '"        . $inboundfax->MessageStatus . "', " .
					  "message_type = '"          . $inboundfax->MessageType . "', " .
					  "remote_csid = '"    . $inboundfax->RemoteCSID . "', " .
					  "pages = '"       . $inboundfax->Pages . "', " .
					  "message_size = '"           . $inboundfax->MessageSize . "', " .
					  "caller_id = '"       . $inboundfax->CallerID . "', " .
					  "message_recording_duration = '"      . $inboundfax->MessageRecordingDuration . "', " .
					  "receiver_id = '"        . $_SESSION{"authId"} . "', " .
				 	  "fax_file_name = '"        . $output_filename . "', " .
					  "received_time = '"      . $inboundfax->ReceiveTime . "'");
			 }
			 catch(Exception $e)
				 {
				 	continue;
				 }
				//}
			}
		
	}
	else{
		
	// there are two or more items returned in the list
			foreach ($result->objMessageItem->MessageItem AS $inboundfax){
				//if ($result->Image != ''){ 
				try{
					//save the output file
				
				$messageid = $inboundfax->MessageID; // Transaction ID of the inbound message to be read
				$message_size = $inboundfax->MessageSize;  // Size in bytes of the inbound message. This value
				                     // is returned by method GetList, which should be run
				                     // before this one
				$markasread = TRUE; // Mark the item as 'read' after downloading? If TRUE, 
				                     // item will no longer be 'new' and will be shown upon
				                     // subsequent list retrieval via GetList
				$save_as_file = TRUE;  // If false, PDF will be shown on screen
				/**************** Settings end ****************/
				 
				$chunk_size = 100000;
				$image = '';
				 
				$client = new SoapClient("http://ws.interfax.net/inbound.asmx?WSDL");
				 
				$params->Username   = $username;
				$params->Password   = $password;
				$params->MessageID  = $messageid;
				$params->MarkAsRead = $markasread;
				$params->ChunkSize  = $chunk_size;
				 
				
				for($i=0; $i < $message_size; $i+= $chunk_size){
				 
				    $params->From = $i;
				    $result = $client->GetImageChunk($params);
				    if ($result->GetImageChunkResult == 0) {
				        $image .= $result->Image;     // No need to base64_decode($result->Image); PHP5 does this for you
				 
				    } else {
				        die('Problem retrieving image chunk #' . $i . ' on error <a href="http://www.interfax.net/en/dev/webservice/reference/web-service-return-codes">' . $result->GetImageChunkResult . '</a>');
				    }
				}
				 
				// an inbound fax has been successfully retrieved
				// establish file type

				if (substr($image, 0, 3) == 'II*'){ // TIF file
				        $file_type = 'tif';
				    } else {
				        if(substr($image, 0, 4) == '%PDF'){ //PDF file
				            $file_type = 'pdf';
				        } 
				        else {
				            die('Unrecognized file type');
				        }
				    }
				 
				if ($save_as_file){ 
				 
				$output_filename = $messageid . '.' . $file_type;
			 	 $dir = $GLOBALS['fileroot'].'/sites/'.$_SESSION{"authProvider"}.'/documents/fax_docs/incoming';
				    $newfile =  $dir.'/'.$output_filename;
				    
				    if (!$handle = fopen($newfile, 'w')) {
				        echo "Cannot open file ($output_filename)";
				        exit;
				        }
				
				    if (fwrite($handle, $image) === FALSE) { 
				        echo "Cannot write to file $output_filename";
				        exit;
				        }
				    fclose($handle);
					 
				  
				 				 
				} else { 
					// output to screen
					switch($file_type){
						case 'pdf':
						header ("Content-type: application/pdf"); // Set the image type according to the fax type: image/tiff or application/pdf
						break;
				 
						case 'tif':
						header ("Content-type: image/tiff"); // Set the image type according to the fax type: image/tiff or application/pdf
						break;
					}
				 
					echo $image;
				}

					
					
				//save the record in database		
				 $insert_id=sqlInsert("INSERT INTO receive_fax SET " .
					  "message_id = '"   . $inboundfax->MessageID . "', " .
					  "phone_number = '"       . $inboundfax->PhoneNumber . "', " .
					  "status  = '"        . $inboundfax->MessageStatus . "', " .
					  "message_type = '"          . $inboundfax->MessageType . "', " .
					  "remote_csid = '"    . $inboundfax->RemoteCSID . "', " .
					  "pages = '"       . $inboundfax->Pages . "', " .
					  "message_size = '"           . $inboundfax->MessageSize . "', " .
					  "caller_id = '"       . $inboundfax->CallerID . "', " .
					  "message_recording_duration = '"      . $inboundfax->MessageRecordingDuration . "', " .
					  "receiver_id = '"        . $_SESSION{"authId"} . "', " .
				 	  "fax_file_name = '"        . $output_filename . "', " .
					  "received_time = '"      . $inboundfax->ReceiveTime . "'");
			 }
			 catch(Exception $e)
				 {
				 	continue;
				 }
				//}
			}
	}
			
			
		
	} 
	else { 
		// the returned list is empty
		//echo 'No inbound faxes in list';
		}
} else { // Bad WS call
	echo 'WS call failed';
}
}

?> 
<table cellspacing='0' cellpadding='0' style='margin: 0 0 0 0; border: 2px solid #000000;' id='bigtable' width='100%' height='100%'>
 <tr style='height: 20px;'>
  <td width='33%' id='td_tab_faxin'  class='tabhead'
   <?php if ($GLOBALS['enable_interfax']) { ?>
   style='color: #cc0000; border-right: 2px solid #000000; border-bottom: 2px solid transparent;'
   <?php } else { ?>
   style='color: #777777; border-right: 2px solid #000000; border-bottom: 2px solid #000000; cursor: pointer; display:none;'
   <?php } ?>
   onclick='tabclick("faxin")'><?php xl('Incoming Faxes','e'); ?></td>
  <td width='33%' id='td_tab_faxout' class='tabhead'
   <?php if ($GLOBALS['enable_interfax']) { ?>
   style='color: #777777; border-right: 2px solid #000000; border-bottom: 2px solid #000000; cursor: pointer;'
   <?php } else { ?>
   style='color: #777777; border-right: 2px solid #000000; border-bottom: 2px solid #000000; cursor: pointer; display:none;'
   <?php } ?>
   onclick='tabclick("faxout")'><?php xl('Outgoing Faxes','e'); ?></td>
 </tr>
 <tr>
  <td colspan='3' style='padding: 5px;' valign='top'>

<div id='table_faxin'>   
<form method='post' action='inter_faxq.php' name="faxList" >
<input type="hidden" name="task" id="task" value="">

   <table width='100%' cellpadding='1' cellspacing='2' 
    <?php if (!$GLOBALS['enable_interfax']) echo "style='display:none;'"; ?>>
     <tr>
     <td colspan="3"><!--<a href="inter_faxq.php?list_type=NewMessages" > </a>--><button type="button" onclick="refreshme()">Refresh</button>&nbsp;
     <input type='button' value="Mark as Read"  onclick="confirmMarkasReadSelected()">
             &nbsp;
     <input type='button' value="Mark as Unread" onclick="confirmMarkasUnreadSelected()">
     &nbsp;</td><!--<b><?php xl('Patient','e'); ?>:</b>&nbsp;-->
     <td colspan="3" align="center"><input type='text' size='10' name='form_patient' style='width:150px;cursor:pointer;cursor:hand' value='<?php echo htmlspecialchars($patientname, ENT_QUOTES); ?>' onclick='sel_patient()' title='<?php xl('Click to select patient','e'); ?>' readonly />
             <input type='hidden' name='form_pid' value='' />&nbsp;
             <input type='button' value="Attach" onclick="confirmPatientSelected()">
             <input type='button' value="Detach" onclick="confirmPatientRemoved()">
             </td> </tr>
    <tr  class='head'><td align="center"><input type='checkbox' id="checkAll" onclick="selectAll()"></td>
     <td><?php xl('Message ID','e'); ?></td>
     <td><?php xl('Fax Number','e'); ?></td>
     <td><?php xl('Pages','e'); ?></td>
     <td><?php xl('Received Time','e'); ?></td>
     <td><?php xl('PID','e'); ?></td>
     <td><?php xl('Patient Name','e'); ?></td>
     <td align='center'><?php xl('Action','e'); ?></td>
     
     </tr>
    <?php

//getting recieved faxes in database 
if ($GLOBALS['enable_interfax']) {

	updatedFaxes('NewMessages');
	//pagination
$incomingfax_res = sqlStatement("SELECT message_id, phone_number, pages, received_time, fax_file_name, read_fax, pid FROM receive_fax Order by received_time DESC");
  	//for pagination
  	$listnumber = 20;//page size
	
    if(sqlNumRows($incomingfax_res) != 0) {
        $total = sqlNumRows($incomingfax_res);
    }
    else {
        $total = 0;
    }
    if($begin == "" or $begin == 0) {
        $begin = 0;
    }
    $prev = $begin - $listnumber;
    $next = $begin + $listnumber;
    $start = $begin + 1;
    $end = $listnumber + $start - 1;
    if($end >= $total) {
        $end = $total;
    }
    if($end < $start) {
        $start = 0;
    }
   
    if($prev >= 0) {
        $prevlink = "<a href=\"inter_faxq.php?begin=$prev\" onclick=\"top.restoreSession()\"><<</a>";
    }
    else {
        $prevlink = "<<";
    }

    if($next < $total) {
        $nextlink = "<a href=\"inter_faxq.php?begin=$next\" onclick=\"top.restoreSession()\">>></a>";
    }
    else {
        $nextlink = ">>";
    }
 	//get the incoming fax details from 
	$current_userid=$_SESSION{"authId"};
  	$res = sqlStatement("SELECT message_id, phone_number, pages, received_time, fax_file_name, read_fax, pid FROM receive_fax Order by received_time DESC"." limit ".add_escape_custom($begin).", ".add_escape_custom($listnumber));
  	$rcount = 0;
  	while ($row = sqlFetchArray($res)) {
  		++$rcount;
  		//$bgcolor = "#" . (($rcount & 1) ? "ddddff" : "ffdddd");
  		$bgclass = (($rcount & 1) ? "evenrow" : "oddrow");
  		
  		if($row['read_fax'] == 0)
  		{
  			$messages_style="style='font-weight: bold;'";
  		}
  		else 
  		{
  			$messages_style = '';
  		}
  		$mark_status= $row['read_fax'];
  	    $p_name=getPatientData($row['pid'],'fname,lname');
  		echo " <tr id=\"row$rcount\" class='detail $bgclass' $messages_style >\n";
  		echo "<td align=\"center\" ><input type=checkbox id=\"check$rcount\" name=\"mark_id[]\" value=\"" .
          	htmlspecialchars( $row['message_id'], ENT_QUOTES) . "\" ></td>";
 		echo "  <td>" . $row['message_id']   . "</td>\n";
 		echo "  <td>" . $row['phone_number']   . "</td>\n";
 		echo "  <td>" . $row['pages']     . "</td>\n";
 		echo "  <td>" . $row['received_time']     . "</td>\n";
 		echo "  <td>" . $row['pid']     . "</td>\n";
 		echo "  <td>" . $p_name['fname']." ".$p_name['lname']     . "</td>\n";
 		$ffile = $row['fax_file_name'];
 		$messge_id= $row['message_id'];
 		$delete_fax_url="../../interface/inter_fax/inter_faxq.php?action=delete&message_id=".$messge_id;
 		echo "  <td align='center'>" .  "<a href='#' onclick='incdovfdclick(\"$ffile\")' >" .
       "<img border='0' alt='preview' src='../../images/preview.png' title='preview'></a>&nbsp;<a href=\"$delete_fax_url\" onclick='return confirm(\"Are you sure you want to delete this fax from the database?\");' >" .
       "<img border='0' alt='delete' src='../../images/delete.gif' title='delete'></a></td>\n";
 		echo " </tr>\n";
 	}
 }
 
echo "
   </table>
    <table border=0 cellpadding=5 cellspacing=0 width=95%>
        <tr>
           <td align=right class=\"text\">$prevlink &nbsp; $end of $total &nbsp; $nextlink</td>
        </tr>
    </table>"; ?>
   <script language="javascript">


// This is to confirm Mark as Read action.
function confirmMarkasReadSelected() {
    	document.getElementById("task").value="markasread";
        document.faxList.submit();
}

//This is to confirm Mark as Unread action.
function confirmMarkasUnreadSelected() {
        document.getElementById("task").value="markasunread";
        document.faxList.submit();
}

//This is to confirm Mark as Unread action.
function confirmPatientSelected() {
        document.getElementById("task").value="move";
        document.faxList.submit();
}

//This is to confirm Mark as Unread action.
function confirmPatientRemoved() {
        document.getElementById("task").value="remove";
        document.faxList.submit();
}

// This is to allow selection of all items in Messages table for deletion.
function selectAll() {

    if(document.getElementById("checkAll").checked==true) {
    	
        document.getElementById("checkAll").checked=true;
    
        <?php
        for($i = 1; $i <= $rcount; $i++) {
            echo "document.getElementById(\"check$i\").checked=true;";
        } ?>
    }
    else {
        document.getElementById("checkAll").checked=false;<?php
        for($i = 1; $i <= $rcount; $i++) {
            echo "document.getElementById(\"check$i\").checked=false;";
        } ?>
    }
}

</script>
   </form>
   </div>
<form method='post' action='faxq.php'  >
   <table width='100%' cellpadding='1' cellspacing='2' id='table_faxout'  style='display:none;'>
    <tr>
     <td colspan="5"><!--<a href="../../interface/usergroup/send_to_fax_form.php" ></a>--><input type="button" value="Send Fax" onclick="sendfax()"></td> </tr>
    <tr class='head'>
     <td><?php xl('Transaction&nbsp;ID','e'); ?></td>
     <td><?php xl('Fax Number','e'); ?></td>
     <td><?php xl('Contact','e'); ?></td>
     <td title='Click to view'><?php xl('Subject','e'); ?></td>
     <td><?php xl('Reply address','e'); ?></td>
     <td><?php xl('Send date','e'); ?></td>
     <td><?php xl('Status','e'); ?></td>
     <td><?php xl('Username','e'); ?></td>
     <td><?php xl('Action','e'); ?></td>
    </tr>
<?php


if ($GLOBALS['enable_interfax']) {

	//saved faxes directory
	$dir = $GLOBALS['webroot'].'/sites/'.$_SESSION{"authProvider"}.'/documents/fax_docs/outgoing';
 	//get the outgoing fax details from 
	$current_userid=$_SESSION{"authId"};
  	$res = sqlStatement("SELECT fd.id,fd.transaction_id, fd.fax_number, fd.receiver, fd.subject, fd.send_date, fd.reply_address, fd.status, fd.sender_id, fd.attachment, u.username FROM fax_details fd, Users u WHERE fd.sender_id=u.id and sender_id=$current_userid Order by send_date DESC");
  	$encount = 0;

  	while ($row = sqlFetchArray($res)) {
  		++$encount;
  		//$bgcolor = "#" . (($encount & 1) ? "ddddff" : "ffdddd");
  		$bgclass = (($encount & 1) ? "evenrow" : "oddrow");
  		echo " <tr class='detail $bgclass'>\n";
 		echo "  <td>" . $row['transaction_id']   . "</td>\n";
 		echo "  <td>" . $row['fax_number']   . "</td>\n";
 		echo "  <td>" . $row['receiver']     . "</td>\n";
 		
        $subject = $row['subject']; 
        $ffile = $row['attachment'];
 		//echo "  <td>" . $row['subject']      . "</td>\n";
 		echo "  <td onclick='dovfdclick(\"$ffile\")'>" .
       "<a href='inter_fax_view.php?faxdoc=$ffile' onclick='return false'>" .
       "$subject</a></td>\n";
 		
 		echo "  <td>" . $row['reply_address']. "</td>\n";
 		echo "  <td>" . $row['send_date']    . "</td>\n";
 		echo "  <td>" . $row['status']       . "</td>\n";
 		echo "  <td>" . $row['username']     . "</td>\n";
 		$id=$row['id'];
 		$transid= $row['transaction_id'];
 		echo "  <td>" .  "<a href='#' onclick='dovfdclick(\"$ffile\")' >" .
       "<img border='0' alt='preview' src='../../images/preview.png' title='preview'></a>&nbsp;"."<a href='inter_faxq.php?fax_id=$id' >" .
       "<img border='0' alt='resend' src='../../images/resend.png' title='resend' ></a>&nbsp;"."<a href='inter_faxq.php?transaction_id=$transid' >" .
       "<img border='0' alt='resend' src='../../images/refresh.png' title='refresh' ></a></td>\n";
 		echo " </tr>\n";
 	}
 }
 
?>
   </table>

   </form>

  </td>
 </tr>
</table>

</body>
</html>
