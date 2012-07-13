<?php
 // Copyright (C) 2012 Ensoftek 
 //
 // This program is free software; you can redistribute it and/or
 // modify it under the terms of the GNU General Public License
 // as published by the Free Software Foundation; either version 2
 // of the License, or (at your option) any later version.

 // This program is a part of InterFax implementation

	require_once("../globals.php");
	
	//saved faxes directory
	$dir = $GLOBALS['fileroot'].'/sites/'.$_SESSION{"authProvider"}.'/documents/fax_docs/outgoing';
	$ffname = '';
	if ($_GET['faxdoc']) { // for open outgoing faxes
		
		$ffname = $dir . '/' . $_GET['faxdoc'];
	}
	else if ($_GET['incomingfaxdoc']) { // for open incoming faxes
		$dir = $GLOBALS['fileroot'].'/sites/'.$_SESSION{"authProvider"}.'/documents/fax_docs/incoming';
		$ffname = $dir . '/' . $_GET['incomingfaxdoc'];
	}

	if (!file_exists($ffname)) {
		die(xl("Cannot find ") . $ffname);
	}

	if (!is_readable($ffname)) {
		die(xl("I do not have permission to read ") . $ffname);
	}

	ob_start();
	
	$ext = substr($ffname, strrpos($ffname, '.'));
	
	if ($ext == '.ps')
		passthru("TMPDIR=/tmp ps2pdf '$ffname' -");
	else if ($ext == '.pdf' || $ext == '.PDF' || $ext == '.tif'|| $ext == '.tiff'|| $ext == '.txt'|| $ext == '.doc')
		readfile($ffname);
	else
	{
		//images display
		switch($ext)
		{
			case ".jpg":header ('content-type: image/jpg');break;
			case ".jpeg":header ('content-type: image/jpeg');break;
			case ".gif":header ('content-type: image/gif');break;
			case ".png":header ('content-type: image/png');break;
		}
			
		readfile($ffname); 
		exit;
	}

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Disposition: attachment; filename=" . basename($ffname, $ext) . $ext);
	if ($ext == '.pdf')
		header("Content-Type: application/pdf");
	else 
		header("Content-Type: application/octet-stream");
	
	header("Content-Length: " . ob_get_length());
	

	ob_end_flush();

	exit;
?>