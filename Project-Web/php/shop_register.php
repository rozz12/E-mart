<?php
	include('connection.php');
	$user = $_GET['username'];
	$qry = 'SELECT user_id FROM users WHERE username = :user';
	$compile1 = ociparse($conn,$qry);
	ocibindbyname($compile1,':user',$user);
	ociexecute($compile1);
	$qry1 = 'INSERT INTO Shop(Shop_name,established_date,user_id) VALUES ()'

?>