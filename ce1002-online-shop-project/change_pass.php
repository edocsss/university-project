<?php
	session_start();
	
	$is_login = false;
	
	if(!empty($_SESSION['username']) && !empty($_SESSION['password']))
	{
		include 'config.php';
		mysql_connect('localhost',$db_username,$db_pass) or die (mysql_error());
		mysql_select_db('project1') or die (mysql_error());
	
		$username=$_SESSION['username'];
		$password=$_SESSION['password'];
		
		$query = sprintf("SELECT * FROM userdetails WHERE username='%s' AND password='%s'", mysql_real_escape_string($username),mysql_real_escape_string($password));
		$checklogin = mysql_query($query);
		$loginok = mysql_num_rows($checklogin);
		
		$type = mysql_fetch_array($checklogin)['type'];
	
		if ($loginok == 1) {
			$is_login = true;
			
			$lasttime = $_SESSION['lasttime'];
			
			$order = sprintf("SELECT * FROM userbaskets where username = '%s'", mysql_real_escape_string($username));
			$order_query = mysql_query($order);
			$order_no = mysql_num_rows($order_query);
		}
	}
	
	else {
		session_destroy();
		header("refresh:0;url=home.php");
		echo "<script>alert('Please login first!')</script>";
	}
?>	
<html>
	<head>
		<title>The Book Shelf</title>
		<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
		<script>
			function validateform()
			{
				var old=document.forms["changepassword"]["old"].value;
				var newpass=document.forms["changepassword"]["new"].value;
				var confirm=document.forms["changepassword"]["confirm"].value;
				
				var rules = /^[0-9A-Za-z]+$/;

				if (old == null || old == "" || newpass == null || newpass == "" || confirm == null || confirm == "")
				{
					alert("Please fill in the blank!");
					return false;
				}
				
				if (newpass != confirm)
				{
					alert("Please recheck your new password confirmation!");
					return false;
				}
				
				if (!old.match(rules))
					{
						alert('Old password consists of alphabet and numeric only!');
						return false;
					}
					
				if (!new.match(rules))
					{
						alert('New password consists of alphabet and numeric only!');
						return false;
					}
					
				if (new.length < 8)
					{
						alert('New password must be at least 8 characters!');
						return false;
					}
			}
		</script>
	</head>
	<body>
		<div id="templatemo_container">
			<div id="templatemo_menu">
    	<ul>
			<li><a href="book1.php">Books</a></li>            
			<li><a href="new.php">New Releases</a></li>  
			<li><?php if ($type == "normal") {echo "<a href=basket.php>Your Basket</a>";} else {echo "<a href=adminusers.php>Admin Page</a>";} ?></li>
			<li><a href="about2.php">About Us</a></li> 
			<li><a href="contact2.php">Contact</a></li>
		</ul>
</div> 
			
			<div id="templatemo_header">
				<div id="userinfo">
					<p class="status_head">Welcome <b><?php echo "$username" ?></b>!!</p><br>
					<ul>
					<li class="status"><p><strong>Your last session : </strong><?php if ($lasttime != '0') {echo "$lasttime";} else {echo "This is your first login";}?></p><br></li>
					<li class="status"><p><?php if ($type==="normal") {if ($order_no == 0) {echo "You do not have any order in your basket";} else {echo "You have $order_no orders in your basket";}} else {echo "Check <a href=adminusers.php> Admin Page</a>";} ?></p><br></li>
					<li class="status"><p>Do you want to <a href="change_pass.php">change password</a>?</p></li>
					</ul>
				<form action="logout.php" name="logout">
					<p align="center"><input type="submit" name="logout" value="Logout" class="btn btn-default"></p>
				</form></div>
			</div>
			
			<div id="templatemo_content">
				
				<div id="templatemo_content_left">
					<div class="templatemo_content_left_section">
						<h1>Categories</h1>
						<ul>
							<li><a href="autobiography.php">Autobiography</a></li>
							<li><a href="fantasy.php">Fantasy</a></li>
							<li><a href="fiction1s.php">Fiction</a></li>
							<li><a href="romance.php">Romance</a></li>
							<li><a href="satire.php">Satire</a></li>
							<li><a href="sciencefiction.php">Science Fiction</a></li>
							<li><a href="youngadult.php">Young Adult</a></li>
						</ul>
					</div>
					<div class="templatemo_content_left_section">
						<h1>Bestsellers</h1>
						<ul>
							<li><a href="6.php">City of Lost Souls (The Mortal Instruments #5)</a></li>
							<li><a href="13.php">Kane and Abel</a></li>
							<li><a href="7.php">Pandemonium (Delirium #3)</a></li>
							<li><a href="14.php">Only Time Will Tell</a></li>
							<li><a href="15.php">The Hunger Games</a></li>
							<li><a href="2.php">Shades of Earth</a></li>
						</ul>
					</div>
				</div>
				
				<div id="templatemo_content_right">
					
					<p class="pass_header">CHANGE YOUR PASSWORD</p>
					<br><br><br>
					<form action="changepassword.php" name="changepassword" onsubmit="return validateform()" method="post">
						<table>
							<tr>
								<td>Old Password</td>
								<td>:</td>
								<td><input type="password" name="old" maxlength="30" class="btn btn-default" ></td>
							</tr>
							<tr>
								<td>New Password</td>
								<td width="2%">:</td>
								<td><input type="password" name="new" maxlength="30" class="btn btn-default" ></td>
								<td><font color="ff3f3f" size="2">*at least 8 characters and must be alphabet or numeric only</font></td>
							</tr>
							<tr>
								<td width="26%">Confirm New Password</td>
								<td>:</td>
								<td><input type="password" name="confirm" maxlength="30" class="btn btn-default" ></td>
							</tr>
						</table>
						<br>
						<input type="submit" class="btn btn-default" name="change" value="Change Password" style="margin-left : 60px;width:130px;font-family:arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
						<input type="reset" class="btn btn-default" value="Clear" style="width:75px;font-family:arial">
					</form>
					
				<div class="cleaner_with_height">&nbsp;</div>
				</div>
			
				<div class="cleaner_with_height">&nbsp;</div>
			</div>
			
			<div id="templatemo_footer">
				   <a href="book1.php">Books</a> | <a href="new.php">New Releases</a> | <?php if ($type == "normal") {echo "<a href=basket.php>Your Basket</a>";} else {echo "<a href=adminusers.php>Admin Page</a>";} ?> | <a href="about2.php">About Us</a> | <a href="contact2.php">Contact Us</a><br />
				Copyright &copy; 2013 <b><strong><font color="#fff">The Book Shelf</font></strong></b></div>
		</div>

	</body>
</html>