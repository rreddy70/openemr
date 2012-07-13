<!DOCTYPE html>
<?php
  // Copyright (C) 2012 Ensoftek 
 //
 // This program is free software; you can redistribute it and/or
 // modify it under the terms of the GNU General Public License
 // as published by the Free Software Foundation; either version 2
 // of the License, or (at your option) any later version.

 // This program is a part of InterFax implementation
 
  require_once("../globals.php");
  require_once($GLOBALS['fileroot'] . "/controllers/C_Prescription.class.php");
  require_once("$srcdir/common_interfax_functions.php");

  $document_id="";
  if($_GET["document_id"]!="")
  {
  	$document_id=$_GET["document_id"];
	$docs_res=sqlQuery("select url from documents where id=$document_id");
	$doc_name=basename($docs_res[url]);
  }
?>

<html>
<head>
<?php html_header_show();?>
<link rel="stylesheet" href="../themes/style_dr_cloud.css" type="text/css" />


<style>

td, input, select, textarea {
 font-family: Arial, Helvetica, sans-serif;
 font-size: 10pt;
}

</style>



<script language="JavaScript">
//Java script function for closing the popup
function closeme() {
  if (window.opener != null)
    window.close();
  else if ( parent.$ ) {
    if ( parent.$.fancybox ) {
      parent.$.fancybox.close();
    } else {
      parent.$.fn.fancybox.close();
    }
  }
  return false;
}

 function CheckValidations()
 {
	 if(document.getElementById("fax_number").value=="")
	 {
		 alert("Please enter Fax Number");
		 return false;
	 }
	 if(document.getElementById("to").value=="")
	 {
		 alert("Please enter Contact");
		 return false;
	 }
	 if(document.getElementById("subject").value=="")
	 {
		 alert("Please enter Subject");
		 return false;
	 } 
	 if(document.getElementById("reply_to_email").value=="")
	 {
		 alert("Please enter Reply to email");
		 return false;
	 }
	 else if(document.getElementById("reply_to_email").value!="")
	 {
		 var email = document.getElementById('reply_to_email');
		 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		 if (!filter.test(email.value)) {
		 	alert('Please enter a valid email address');
		 	return false;
		 }
	 }
	 
	return true;
 }
 
 function ismaxlength(obj){
	 var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
	 if (obj.getAttribute && obj.value.length>mlength)
	 obj.value=obj.value.substring(0,mlength)
}
	 
	  
// This is to confirm delete action.
 function confirmDeleteSelected() {
     if(confirm("<?php echo htmlspecialchars( xl('Do you really want to delete the selection?'), ENT_QUOTES); ?>")) {
         document.wikiList.submit();
     }
 }
 
 // This is to allow selection of all items in Messages table for deletion.
 function selectAll() {
     if(document.getElementById("checkAll").checked==true) {
         document.getElementById("checkAll").checked=true;<?php
         for($i = 1; $i <= $count; $i++) {
             echo "document.getElementById(\"check$i\").checked=true; document.getElementById(\"row$i\").style.background='#E7E7E7';  ";
         } ?>
     }
     else {
         document.getElementById("checkAll").checked=false;<?php
         for($i = 1; $i <= $count; $i++) {
             echo "document.getElementById(\"check$i\").checked=false; document.getElementById(\"row$i\").style.background='#F7F7F7';  ";
         } ?>
     }
 }
 
 // Go to fax center
 function faxcenter()
 {
  window.location.href="../../interface/inter_fax/inter_faxq.php";
 }
 
</script>
</head>
<body class="body_top" style="padding-right:0.5em;">
<h4>Send Fax</h4>
<?php


 if ($_POST['form_submit']) {
 	 
		$date_time = date("YmdHis");
		$dir = $GLOBALS['fileroot'].'/sites/'.strtolower($_SESSION{"authProvider"}).'/documents/fax_docs';
 		
		//save the file
		if (!file_exists($dir)){
		mkdir ($dir,0777);
		}
		$dir = $GLOBALS['fileroot'].'/sites/'.strtolower($_SESSION{"authProvider"}).'/documents/fax_docs/outgoing';
 		if (!file_exists($dir)){
			mkdir ($dir,0777);
		}
		
		if($_POST['document_id'])
		{
			$doc_id=$_POST['document_id'];
			$docs_res=sqlQuery("select url from documents where id=$doc_id");
			$current_file=$docs_res[url];
			$file1 = $date_time."_".basename($current_file);
			$str1 =  $dir.'/'.$file1;
			copy($current_file,$str1);
			$autosavefile=$str1;
		}	
		else if($_FILES["fax_file"]["name"] != '')
				{
					$file1 = $date_time."_".$_FILES['fax_file']['name'];
					$str1 =  $dir.'/'.$file1;
					$temp1 = $_FILES['fax_file']['tmp_name'];
					move_uploaded_file($temp1,$str1);
					$autosavefile=$str1;
					unlink($_POST['pdfpath']);
				}
				
		    //check file type
			$faxfiletext=explode(".", $autosavefile);
			$key = md5('password');
			
			$decrypted_value = $GLOBALS['interfax_user_pwd'];
			$username = $GLOBALS['interfax_user_id']; // Enter your Interfax username here
			$password = $decrypted_value; // Enter your Interfax password here
			$faxnumbers = $_POST['fax_number'];  // Enter your designated fax number here in the format +[country code][area code][fax number], for example: +12125554874
			$filename = $autosavefile; // A file in your filesystem
			$filetype = array_pop($faxfiletext); // File format; supported types are listed at 
			                   // http://www.interfax.net/en/help/supported_file_types 
			$contacts = $_POST['to'];
			$subject  = $_POST['subject'];
			$replyemail = $_POST['reply_to_email'];
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
				$faxfilename=explode("/", $autosavefile);
			
				  $insert_id=sqlInsert("INSERT INTO fax_details SET " .
				  "transaction_id = '"   . trim($TransactionID) . "', " .
				  "fax_number = '"       . trim($faxnumbers) . "', " .
				  "receiver  = '"        . addslashes(trim($contacts)) . "', " .
				  "subject = '"          . addslashes(trim($subject)) . "', " .
				  "reply_address = '"    . addslashes(trim($replyemail)) . "', " .
				  "attachment = '"       . trim(array_pop($faxfilename)) . "', " .
				  "status = '"           . trim($Status) . "', " .
				  "patient_id = '"       . $_SESSION{"pid"} . "', " .
				  "facility_id = '"      . $_SESSION{"pc_facility"} . "', " .
				  "sender_id = '"        . $_SESSION{"authId"} . "', " .
				  "send_date = now()");
				  if($_POST['document_id'])
					{
						echo "<script language='JavaScript'>\n";
						echo "closeme();\n";
						echo "</script></body>\n";
					}
					else{
						  header("Location: ../../interface/inter_fax/inter_faxq.php?tab_name=faxout");
		  				  exit;
					}
				  
			 }
										  		  
 }
 
  
 
 
?>
<form method="post" action="send_to_fax_form.php" enctype="multipart/form-data">
          <table>
        	<tr>
        		<td class='label' style="width:150px;vertical-align: top;"><?php echo htmlspecialchars(xl('Fax number(s)'),ENT_NOQUOTES); ?><span style="color:red;">*</span>: </td>
        		<td><input type="text" name="fax_number" id="fax_number"  value="" style="width:350px;">&nbsp;eg:+12323454567;+12323454568</td>
        	</tr>  
        	<tr>
        		<td class='label'><?php echo htmlspecialchars(xl('Contact'),ENT_NOQUOTES); ?><span style="color:red;">*</span>: </td>
        		<td><textarea rows='2' cols='50' name="to" id="to" onkeyup="return ismaxlength(this);" onkeydown="return ismaxlength(this);" maxlength="250" ></textarea></td>
        	</tr>
        	<tr>
        		<td class='label'><?php echo htmlspecialchars(xl('Subject'),ENT_NOQUOTES); ?><span style="color:red;">*</span>: </td>
        		<td><textarea rows='3' cols='50' name="subject" id="subject" ></textarea></td>
        	</tr>
        	<tr>
        		<td class='label'><?php echo htmlspecialchars(xl('Reply to email'),ENT_NOQUOTES); ?><span style="color:red;">*</span>: </td>
        		<td><input type="text" name="reply_to_email" id="reply_to_email"  value="" style="width:350px;"></td>
        	</tr>
        	
        	<tr>
        		<td class='label'><?php echo htmlspecialchars(xl('Attach File'),ENT_NOQUOTES); ?>: </td>
        		<?php if($document_id==""){?>
        		<td><input type="file" name="fax_file" id="fax_file" size="55" ></td>
        		<?php }else{?>
        		<td><b><?php echo $doc_name; ?></b></td>
        		<?php }?>
        	</tr>
        	
        	<tr><td>&nbsp;<td class='label'><br> <button type="submit" name="bn_sendfax" onclick="return CheckValidations();"><?php echo htmlspecialchars(xl('Send'),ENT_NOQUOTES); ?></button>&nbsp;
        	<!--<a href="../../interface/inter_fax/inter_faxq.php" onclick='closeme();' ></a>-->
        	<?php if($document_id==""){?>
        	<input type="button" value="Cancel" onclick="faxcenter()" >
        	<?php }else{?>
        		<input type="button" value="Cancel" onclick="closeme();" >
        		<?php }?>
             </td></tr>
       </table>
       
          <input type="hidden" name="process" value="true" />
          <input type="hidden" name="document_id" value="<?php echo $document_id; ?>" />
          
         <input type='hidden' name='form_submit' value="sendfax" />
          
  </form>

</body>
</html>
