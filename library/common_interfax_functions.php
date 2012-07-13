<?php
  // Copyright (C) 2012 Ensoftek 
 //
 // This program is free software; you can redistribute it and/or
 // modify it under the terms of the GNU General Public License
 // as published by the Free Software Foundation; either version 2
 // of the License, or (at your option) any later version.

 // This program is a part of InterFax implementation

function QuotedOrNull($fld) {
	if ($fld) return "'$fld'";
	return "NULL";
}

// Encrypt function
function Encrypt($plaintext,$key)
	{
		$iv_size = mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypt = mcrypt_encrypt(MCRYPT_TRIPLEDES, $key, $plaintext, MCRYPT_MODE_ECB, $iv);
		$crypt = base64_encode($crypt);
		return $crypt;
	}
	
function Decrypt($Enctext,$key)
	{
		
		$Enctext = base64_decode($Enctext);
		$iv_size = mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypt = mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $Enctext, MCRYPT_MODE_ECB, $iv);
		$decrypt = rtrim($decrypt, "\0");
		return $decrypt;
	}	
?>