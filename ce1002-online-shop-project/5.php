<?php
	session_start();
	
	$is_login = false;
	$bookid = 5;
	
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
			
			$_SESSION['bookid'] = $bookid;
			$querystock = "SELECT quantity FROM books WHERE bookid = '$bookid'";
			$checkstock = mysql_query($querystock);
			
			$lasttime = $_SESSION['lasttime'];
			
			$order = sprintf("SELECT * FROM userbaskets where username = '%s'", mysql_real_escape_string($username));
			$order_query = mysql_query($order);
			$order_no = mysql_num_rows($order_query);
			
			if ($checkstock) 
			{
			$quantity = mysql_fetch_assoc($checkstock);
			$number = $quantity['quantity'];
			}
			else
			{
			echo "<script>alert('error')</script>";
			}
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
			function validateForm()
			{
				var bookadd=document.forms["addbook"]["bookadd"].value;

				if (bookadd == null | bookadd == "")
				{
				alert("Please fill in the blank!");
				document.addbook.bookadd.focus();
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
				
				<div id="templatemo_content_right">
					
					<h1>Insurgent (Divergent #2) <span>(by Veronica Roth)</span></h1>
					<div class="image_panel"><img src="images/5.jpg" alt="CSS Template" width="120" height="200" /></div>
					<ul>
						<li><b>By Veronica Roth</b></li>
						<li>Publication Date : 1 May 2013</li>
						<li>Pages: 525</li>
						<li>Price : $35</li>
					</ul>
					
					<p>One choice can transform you-or it can destroy you. But every choice has consequences, and as unrest surges in the factions all around her, Tris Prior must continue trying to save those she loves-and herself-while grappling with haunting questions of grief and forgiveness, identity and loyalty, politics and love.</p>
					<p>Tris's initiation day should have been marked by celebration and victory with her chosen faction; instead, the day ended with unspeakable horrors. War now looms as conflict between the factions and their ideologies grows. And in times of war, sides must be chosen, secrets will emerge, and choices will become even more irrevocable-and even more powerful.</p>
					<p>Transformed by her own decisions but also by haunting grief and guilt, radical new discoveries, and shifting relationships, Tris must fully embrace her Divergence, even if she does not know what she may lose by doing so.</p>
					<div id = "add">
						<form name = "addbook" action="bookadd.php" onsubmit="return validateForm()" method="post" >
							<table>
								<tr>
									<td>Stock</td>
									<td>:</td>
									<td><?php if ($is_login) {echo "$number";} ?></td>
								</tr>
								<tr>
									<td>Buy</td>
									<td>:</td>
									<td><input type="text" name="bookadd" maxlength="2" size="2" class="btn btn-default"></td>
									<td><input type="submit" name="add" value="Add" class="btn btn-default"></td>
								</tr>
							</table>
						</form>
					</div>
					
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