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
					var name=document.forms["contact"]["name"].value;
					var username=document.forms["contact"]["username"].value;
					var email=document.forms["contact"]["email"].value;
					var subject=document.forms["contact"]["subject"].value;
					var message=document.forms["contact"]["message"].value;
					
					var letters = /^[A-Za-z]+$/;  
					var rules = /^[0-9A-Za-z]+$/;
					
					if (subject == "" || subject == null || name == "" || name == null || username == "" || username == null || email == null || email == "" || message == "" || message == null)
					{
						alert("Please fill in the required data!");
						return false;
					}
					
					if (!name.match(letters))
					{
						alert("Name must be alphabets only!");
						return false;
					}
					
					if (!username.match(rules))
					{
						alert('Username consists of alphabet and numeric only!');
						return false;
					}
						
					if (username.length > 20 || username.length < 5)
					{
						alert("Username must be at least 5 characters but not more than 20 characters!");
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
			<li><a href="contact2.php" class="current">Contact</a></li>
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
				</form>
			</div>
		</div> 
 
    
	
    <div id="templatemo_content">
		<div id="templatemo_content_left">
					<div class="templatemo_content_left_section">
						<h1>Categories</h1>
						<ul>
							<li><a href="autobiography.php">Autobiography</a></li>
							<li><a href="fantasy.php">Fantasy</a></li>
							<li><a href="fiction1.php">Fiction</a></li>
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
        <div id="bookdetails">
			<p class="genre">CONTACT US</p>
			<br>
			<br>
			<form name = "contact" action="emailsend2.php" method="post" onsubmit= "return validateform()">
				<table>
					<tr>
						<td>Name <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 5px;"><input type="text" maxlength="30" name="name" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Username <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 5px;"><input type="text" maxlength="30" name="username" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Email <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 5px;"><input type="email" maxlength="30" name="email" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Subject <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 7px;"><input type="text" maxlength="30" name="subject" style="width : 421px;" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Message <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td rowspan = "4" colspan="3"><span style="margin-left : 5px;"><textarea name="message" maxlength="1000" cols="50" rows="10" class="btn btn-default"></textarea></span></td>
					</tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
				</table>
				<br>
				<p style="float : left; margin-left : 180px; font-face : arial;"><input type="submit" value="Send Message" class="btn btn-default"></p>
				<p style="float : right; margin-right : 250px; font-face : arial;"><input type="reset" value="Clear Form" class="btn btn-default"></p>
        	
        </div> <!-- end of content right -->
		
		<div class="cleaner_with_height">&nbsp;</div>
	  
		<div id="record_footer">
				   <a href="book1.php">Books</a> | <a href="new.php">New Releases</a> | <?php if ($type == "normal") {echo "<a href=basket.php>Your Basket</a>";} else {echo "<a href=adminusers.php>Admin Page</a>";} ?> | <a href="about2.php">About Us</a> | <a href="contact2.php">Contact Us</a><br />
				Copyright &copy; 2013 <b><strong><font color="#fff">The Book Shelf</font></strong></b></div>

		</div> 
</body>
</html>