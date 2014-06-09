<?php
	session_start();
	
	$is_login = false;
	$bookid = 16;
	
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
					
					<h1>A Prisoner of Birth <span>(by Jeffrey Archer)</span></h1>
					<div class="image_panel"><img src="images/16.jpg" width="120" height="200" /></div>
					<ul>
						<li><b>By Jeffrey Archer</b></li>
						<li>Publication Date : 6 March 2008</li>
						<li>Pages: 400</li>
						<li>Price : $30</li>
					</ul>
					
					<p>A Prisoner of Birth is a mystery novel by English author Jeffrey Archer, first published on 6 March 2008 by Macmillan. This book is a contemporary retelling of Dumas's The Count of Monte Cristo. The novel saw Archer return to the first place in the fiction best-seller list for the first time in a decade. International bestseller and master storyteller Jeffrey Archer is at the very top of his game in this story of fate and fortune, redemption and revenge.</p>
					<p>If Danny Cartwright had proposed to Beth Wilson the day before, or the day after, he would not have been arrested and charged with the murder of his best friend. But when the four prosecution witnesses are a barrister, a popular actor, an aristocrat, and the youngest partner in an established firm's history, who is going to believe his side of the story?</p>
					<p>Danny is sentenced to twenty-two years and sent to Belmarsh prison, the highest-security jail in the land, from where no inmate has ever escaped.</p>
					<p>However, Spencer Craig, Lawrence Davenport, Gerald Payne, and Toby Mortimer all underestimate Danny's determination to seek revenge, and Beth's relentless quest to pursue justice, which ends up with all four fighting for their lives.</p>
					<p>Thus begins Jeffrey Archer's most powerful novel since Kane and Abel, with a cast of characters that will remain with you long after you've turned the last page. And if that is not enough, prepare for an ending that will shock even the most ardent of Archer's fans.</p>
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