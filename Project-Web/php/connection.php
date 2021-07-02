<?php $conn = oci_connect('Rojan', 'or@cle', '//localhost/xe'); 
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit(); 
	} 
 else {
 		;
	}	 
?>