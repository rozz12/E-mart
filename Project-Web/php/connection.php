<?php $conn = oci_connect('ASHIM', 'ASHIM', '//localhost/xe'); 
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit(); 
	} 
 else {
 		;
	}	 
?>