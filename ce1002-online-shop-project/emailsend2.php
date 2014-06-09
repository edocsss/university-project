<?php
	
	$to = "edocsss@gmail.com";
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$email = $_POST['email'];
	$from = $_POST['email'];
	$username = $_POST['username'];
	
	
	$send = mail($to, $subject, $message, "From:".$username);
	
	if ($send)
	{
	echo "<script>alert('Thank you for using our mail form!')</script>";
	header("refresh:0; url=contact2.php");
	}
?>
	