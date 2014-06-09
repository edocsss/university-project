<?php
	include 'config.php';
		mysql_connect('localhost',$db_username,$db_pass) or die (mysql_error());
		mysql_select_db('project1') or die (mysql_error());

	if(isset($_POST['submit'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
	  
		 //Checking existence of username on PHP
		 $checkusername=mysql_query("select * from userdetails where username = '$username'");
		 $usernameok=mysql_num_rows($checkusername);
	  
		if ($usernameok == 0) {
			$query = mysql_query("insert into userdetails (username,password,type,firstname,lastname,phone,email,address,lasttime) 
								values ('$username','$password','normal','$fname','$lname','$phone','$email','$address','No last session! This user is a new user.')");
		
			if ($query) 
				{
				header("refresh:2; url=home.php");
				echo "<script>alert('Please login to start looking at the catalog!')</script>";
				}
		
			else {
				header("refresh:2; url=registration.html");
				echo "<script>alert('Registration Failed! Please try again!')</script>";
				}
		}
		
		else {
			echo "<script>alert('Username exists!')</script>";
			header("refresh:2; url=registration.html");	
		}
	}
?>