<?php
	session_start();
	
	include 'config.php';
	mysql_connect('localhost',$db_username,$db_pass) or die (mysql_error());
	mysql_select_db('project1') or die (mysql_error());
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$date = mysql_query(sprintf("SELECT lasttime FROM userdetails where username = '%s'", mysql_real_escape_string($username)));
	$array = mysql_fetch_array($date);
	$last = $array['lasttime'];
	
	$query = sprintf("SELECT * FROM userdetails WHERE username='%s' AND password='%s'", mysql_real_escape_string($username),mysql_real_escape_string($password));
	$checklogin = mysql_query($query);
	$loginok = mysql_num_rows($checklogin);
	
	$checkuser = mysql_query(sprintf("SELECT * FROM userdetails WHERE username='%s'", mysql_real_escape_string($username)));
	$checkuserno = mysql_num_rows($checkuser);
	$array = mysql_fetch_array($checkuser);
	$pass = $array['password'];
	
	if ($loginok == 1)
	{
		$querytype = sprintf("SELECT type FROM userdetails WHERE username = '%s'", mysql_real_escape_string($username));
		$checktype = mysql_query($querytype);
		$type = mysql_fetch_assoc($checktype); 
		
		date_default_timezone_set('Asia/Singapore');
		$lasttime = date('d/m/Y H:i:s');
		$lastlogin = sprintf("UPDATE userdetails SET lasttime='$lasttime' WHERE username='%s'",mysql_real_escape_string($username));
		$update = mysql_query($lastlogin);
		
		if ($type['type'] === "admin")
		{
			header("refresh:0; url=adminusers.php");
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			$_SESSION['lasttime']=$lasttime;
		}
		
		if ($type['type'] === "normal")
		{
			header("refresh:0;url=basket.php");
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			$_SESSION['lasttime']=$last;
		}
	}

	else if ($checkuserno == 1 and $password != $pass )
	{
		header("refresh:0; url=home.php");
		echo "<script>alert('Wrong password!')</script>";
	}
	
	else if ($loginok == 0)
	{
		header("refresh:0; url=registration.html");
		echo "<script>alert('You are not registered. Please register first!')</script>";
	}
	
	else 
	{
		header("refresh:0; url=home.php");
		echo "<script>alert('Wrong Username or Password! Please try again!')</script>";
	}
?>