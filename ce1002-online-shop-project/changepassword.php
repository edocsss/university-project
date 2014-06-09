<?php
	session_start();
	
	include 'config.php';
		mysql_connect('localhost',$db_username,$db_pass) or die (mysql_error());
		mysql_select_db('project1') or die (mysql_error());
	
	$username=$_SESSION['username'];
	$password=$_SESSION['password'];
	
	$old = $_POST['old'];
	$new = $_POST['new'];
	$confirm = $_POST['confirm'];
	
	$oldpass_call = sprintf("SELECT * FROM userdetails WHERE username='%s' AND password='%s'",mysql_real_escape_string($username),mysql_real_escape_string($password));
	$oldpass_query = mysql_query($oldpass_call);
	$oldpass = mysql_fetch_array($oldpass_query)['password'];
	
	if ($password === $old and $old === $oldpass)
	{
		$update = "UPDATE userdetails SET password='$new' WHERE username='$username'";
		$query = mysql_query($update);
		
		if ($query)
		{
			echo "<script>alert('Your password has been changed! Please login again!')</script>";
			header("refresh:0;url=home.php");
		}
		
		else
		{
			echo "<script>alert('An error occurs! Please try again!')</script>";
			header("refresh:0;url=change_pass.php");
		}
	}
	else 
	{
		echo "<script>alert('What you fill in the old password box is not the same as your current password!')</script>";
		header("refresh:0;url=change_pass.php");
	}
?>