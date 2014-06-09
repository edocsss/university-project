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
	
		if ($loginok == 1) {
			$is_login = true;
			$userdetails = mysql_query("SELECT * FROM userdetails");
			$userbaskets = mysql_query("SELECT * FROM userbaskets");
			$books = mysql_query("SELECT * FROM books");
			
			$login_array = mysql_fetch_array($checklogin);
			$user_type = $login_array['type'];
			
			$userdetails_no = mysql_num_rows($userdetails);
			$userbaskets_no = mysql_num_rows($userbaskets);
			$books_no = mysql_num_rows($books);
			
			$lasttime = $_SESSION['lasttime'];
			
			$order = sprintf("SELECT * FROM userbaskets where username = '%s'", mysql_real_escape_string($username));
			$order_query = mysql_query($order);
			$order_no = mysql_num_rows($order_query);
			
			
			if ($user_type === "admin")
			{
			
				if (!($userdetails && $userbaskets && $books))
				{
					echo "<script>alert('The tables are not loaded. Something error!')</script>";
				}
			}
			else
			{
				echo "<script>alert('You are not an administrator. You do not have permission to this page!')</script>";
				header("refresh:0; url=home.php");
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
</head>

<body>

<div id="templatemo_container">
	<div id="templatemo_menu">
    	<ul>
            <li><a href="book1.php">Books</a></li>            
            <li><a href="new.php">New Releases</a></li>  
            <li><a href="adminusers.php" class="current">Admin Page</a></li>
			<li><a href="about2.php">About Us</a></li> 
            <li><a href="contact2.php">Contact</a></li>
    	</ul>
	</div> 
    
		<div id="templatemo_header">
			<div id="userinfo">
					<p class="status_head">Welcome <b><?php echo "$username" ?></b>!!</p><br>
					<ul>
					<li class="status"><p><strong>Your last session : </strong><?php if ($lasttime != '0') {echo "$lasttime";} else {echo "This is your first login";}?></p><br></li>
					<li class="status"><p><?php echo "Check <a href=adminusers.php> Admin Page</a>"; ?></p><br></li>
					<li class="status"><p>Do you want to <a href="change_pass.php">change password</a>?</p></li>
					</ul>
				<form action="logout.php" name="logout">
					<p align="center"><input type="submit" name="logout" value="Logout" class="btn btn-default"></p>
				</form>
			</div>
		</div> 
 
    
	
    <div id="templatemo_content">
        <div id="adminbooks">
			<p>Admin Page</p>
			<br>
			<br>
			<span style="font-size : 14px;">Which table do you want to see? </span>
			<form style="margin-top:5px;">
				<input type="radio" name="data" value="userdetails" onclick="document.location='adminusers.php';"><span style="font-size : 12px;">User Details</span>&nbsp;&nbsp;
				<input type="radio" name="data" value="userbaskets" onclick="document.location='adminbaskets.php';"><span style="font-size : 12px;">User Baskets</span>&nbsp;&nbsp;
				<input type="radio" name="data" value="books" onclick="document.location='adminbooks.php';" checked><span style="font-size : 12px;">Books Details</span>
			<br><br>
			</form>
			<div id="tes">
				<?php
					if ($userdetails_no != 0) 
					{
						echo "<table border=1 cellpadding=5 style=margin:0px; width=100%>";
						echo "<tr><th>Book ID</th><th>Type</th><th>Book Name</th><th>Author</th><th>Quantity</th><th>Price</th>";
						
						while ($books_array = mysql_fetch_array($books))
						{
							echo "<tr align=center><td><font size = 2>{$books_array['bookid']}</font></td><td><font size = 2>{$books_array['type']}</font></td><td><font size = 2>{$books_array['bookname']}</font></td><td><font size = 2>{$books_array['author']}</font></td><td><font size = 2>{$books_array['quantity']}</font></td><td><font size = 2>{$books_array['price']}</font></td>";
						}
						echo "</table>";
					}
				?>
			</div>
			
        </div>
			<div id="record_footer">
				<a href="book1.php">Books</a> | <a href="new.php">New Releases</a> | <a href="adminusers.php">Admin Page</a> | <a href="about2.php">About Us</a> | <a href="contact2.php">Contact Us</a><br />
				Copyright &copy; 2013 <b><strong><font color="#fff">The Book Shelf</font></strong></b>
			</div>

	</div> 
</div>
</body>
</html>