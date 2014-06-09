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
		
		date_default_timezone_set('Asia/Singapore');
		$lasttime = date('H:i:s d/m/Y');
		$_SESSION['lasttime'] = $lasttime; 
		
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
</head>

<body>

<div id="templatemo_container">
<div id="templatemo_menu">
    	<ul>
			<li><a href="book1.php" class="current">Books</a></li>            
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
			<p class="genre">BOOKS</p>
			<br>
			<br>
        	<div class="templatemo_product_box">
            	<h1>Requiem (Delirium #3) <span>(by Lauren Oliver)</span></h1>
				<img src="images/8.jpg" width="100" height="150"/>
                <div class="product_info">
                	<p class="bookdetails">They have tried to squeeze us out, to stamp us into the past. But we are still here. And there are more of us every day. Now...</p>
                    <h3>$30</h3>
                    <div class="detail_button"><a href="8.php">Read More...</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_width">&nbsp;</div>
            
            <div class="templatemo_product_box">
            	<h1>Wuthering Heights <span>(by Emily Bronte)</span></h1>
				<img src="images/11.jpg" width="100" height="150">
                <div class="product_info">
                	<p class="bookdetails">Wuthering Heights is a novel by Emily Bronte, written between October 1845 and June 1846,and published in 1847 under the pseudonym...</p>
					<h3>$30</h3>
                    <div class="detail_button"><a href="11.php">Read more...</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_height">&nbsp;</div>
            
            <div class="templatemo_product_box">
            	<h1>Allegiant (Divergent#3) <span>(by Veronica Roth)</span></h1>
				<img src="images/1.jpg" width="100" height="150">
                <div class="product_info">
                	<p class="bookdetails">The faction-based society that Tris Prior once believed in is shattered—fractured by violence and power struggles and scarred by...</p>
					<h3>$25</h3>
                    <div class="detail_button"><a href="1.php">Read more...</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_width">&nbsp;</div>
            
            <div class="templatemo_product_box">
            	<h1>Shades of Earth (Across the Universe #3) <span>(by Beth Revis)</span></h1>
				<img src="images/2.jpg" width="100" height="150"/>
                <div class="product_info">
                	<p class="bookdetails">Amy and Elder have finally left the oppressive walls of the spaceship Godspeed behind. They're ready to start life afresh--to build a home--on Centauri-Earth...</p>
                    <h3>$28</h3>
                    <div class="detail_button"><a href="2.php">Read More...</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
			<span style="float : left; margin-top:10px; font-size : 14px; font-weight : bold;"><a href="book2.php">Previous</a></span>
			<span style="float : right; margin-top:10px; font-size : 14px; font-weight : bold;"><a href="book4.php">Next</a></span></p>
            
            <div class="cleaner_with_height">&nbsp;</div>
        </div> <!-- end of content right -->
		
		<div class="cleaner_with_height">&nbsp;</div>
	  
		<div id="templatemo_footer">
				   <a href="book1.php">Books</a> | <a href="new.php">New Releases</a> | <?php if ($type == "normal") {echo "<a href=basket.php>Your Basket</a>";} else {echo "<a href=adminusers.php>Admin Page</a>";} ?> | <a href="about2.php">About Us</a> | <a href="contact2.php">Contact Us</a><br />
				Copyright &copy; 2013 <b><strong><font color="#fff">The Book Shelf</font></strong></b></div>

		</div> 
</body>
</html>