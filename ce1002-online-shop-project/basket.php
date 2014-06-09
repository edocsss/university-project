<?php
	session_start();
	
	$is_login = false;
	$bookid = 1;
	
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
			$data = sprintf("SELECT * FROM userbaskets WHERE username='%s'",mysql_real_escape_string($username));
			$data_query = mysql_query($data);
			$data_no = mysql_num_rows($data_query);
			
			$lasttime = $_SESSION['lasttime'];
			
			$order = sprintf("SELECT * FROM userbaskets where username = '%s'", mysql_real_escape_string($username));
			$order_query = mysql_query($order);
			$order_no = mysql_num_rows($order_query);
			
			$price = sprintf("SELECT totalprice FROM userbaskets WHERE username='%s'",mysql_real_escape_string($username));
			$price_query = mysql_query($price);
			$total = 0;
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
	
	<script language="JavaScript" type="text/javascript">
		function change(rad)
		{
			var val=rad.value;
			var choice1 = "delete";
			var choice2 = "changeqty";
			
			if (val == choice1)
			{
				document.getElementById('change').innerHTML = '<form name="delete" action="deletebook.php" method="post" onsubmit = "return validatedelete()" style="margin-top:-20px;"><table><tr><td>Buy ID&nbsp;</td><td>:&nbsp;</td><td><input type="text" name="delete_with_bookid" class="btn btn-default" style="width : 30px;" maxlength="4"></td><td width="10px"></td><td><input type="submit" value="Delete" class="btn btn-default"></td></tr></table></form>';
			}
			else if (val == choice2)
			{
				document.getElementById('change').innerHTML = '<form name="changeqty" action="changeqty.php" method="post" style="margin-top:-20px;" onsubmit = "return validatechangeqty()"><table><tr><td>Buy ID&nbsp;</td><td>:&nbsp;</td><td><input type="text" name="buyid" class="btn btn-default" style="width : 30px;" maxlength="4">&nbsp;</td><td>Quantity&nbsp;</td><td>:&nbsp;</td><td><input type="text" name="changeqty" class="btn btn-default" style="width:30px;" maxlength="3"></td><td width="10px"></td><td><input type="submit" value="Change" class="btn btn-default"></td></tr></table></form>';
			}
		}
		
		function validatedelete()
		{
			var del = document.forms["delete"]["delete_with_bookid"].value;
			
			if (del == "" || del == null)
			{
				alert("Please fill in the textbox!");
				return false;
			}
			
			if (isNaN(del))
			{
				alert("Please fill in the textbox with a valid Buy ID!");
				return false;
			}
		}
		
		function validatechangeqty()
		{
			var id = document.forms["changeqty"]["buyid"].value;
			var change = document.forms["changeqty"]["changeqty"].value;
			
			if (id == "" || id == null || change==null || change=="")
			{
				alert("Please fill in the textbox!");
				return false;
			}
			
			if (isNaN(id))
			{
				alert("Please fill in the textbox with a valid Buy ID!");
				return false;
			}
			
			if (isNaN(change))
			{
				alert("Please fill in the textbox with a valid number of quantity!");
				return false;
			}
			
			if (isNaN(change) && isNaN(id))
			{
				alert("Please fill in the textbox with a valid Buy ID and a valid number of quantity!");
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
            <li><a href="basket.php" class="current">Your Basket</a></li>
			<li><a href="about2.php">About Us</a></li> 
            <li><a href="contact2.php">Contact</a></li>
    	</ul>
	</div> 
    
		<div id="templatemo_header">
			<div id="userinfo">
					<p class="status_head">Welcome <b><?php echo "$username" ?></b>!!</p><br>
					<ul>
					<li class="status"><p><strong>Your last session : </strong><?php if ($lasttime != '0') {echo "$lasttime";} else {echo "This is your first login";}?></p><br></li>
					<li class="status"><p><?php if ($order_no == 0) {echo "You do not have any order in your basket";} else {echo "You have $order_no orders in your basket";} ?></p><br></li>
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
        <div id="record">
			<p>Purchase Records</p>
			<br>
			<br>
			<span style="font-size : 14px;">What do you want to do? </span>
			<form style="margin-top:5px;">
				<input type="radio" name="check" value="delete" onclick='change(this)' checked><span style="font-size : 12px;">Delete</span>&nbsp;&nbsp;
				<input type="radio" name="check" value="changeqty" onclick='change(this)'><span style="font-size : 12px;">Change Quantity</span>
			<br><br>
			</form>
			<div id="change">
				<form name="delete" action="deletebook.php" method="post" style="margin-top:-20px;" onsubmit = "return validatedelete()">
					<table>
						<tr>
							<td>Buy ID&nbsp;</td>
							<td>:&nbsp;</td>
							<td><input type="text" name="delete_with_bookid" style="width : 30px;" maxlength="4" class="btn btn-default"></td>
							<td width="10px"></td>
							<td><input type="submit" value="Delete" class="btn btn-default"></td>
						</tr>
					</table>
				</form>
			</div>
			
			<?php 
				if ($data_no != 0) 
				{
					echo "<table border=1 cellpadding=5 style=margin:0px; width=100%>";
					echo "<tr><th>Buy ID</th><th>Book Name</th><th>Author</th><th>Type</th><th>Quantity</th><th>Total Price</th ></tr>";
					while ($data_array = mysql_fetch_array($data_query))
					{
						echo "<tr align=center><td><font size = 2>{$data_array['buyid']}</font></td><td><font size = 2>{$data_array['bookname']}</font></td><td><font size = 2>{$data_array['author']}</font></td><td><font size = 2>{$data_array['type']}</font></td><td><font size = 2>{$data_array['quantity']}</font></td><td><font size = 2>{$data_array['totalprice']}</font></td></tr>";
					}
					
					while ($price_array = mysql_fetch_array($price_query))
					{
						$total = $total + $price_array['totalprice'];
					}
					echo "<tr><th colspan=5 align=right>Total :&nbsp;&nbsp;</th><td align=center>{$total}</td></tr>";
					echo "</table>";
				}
				else
				{
					echo "<table border=1 cellpadding=4 style=margin:0px; width=100%>";
					echo "<tr><th>Buy ID</th><th>Book Name</th><th>Author</th><th>Type</th><th>Quantity</th><th>Total Price</th></tr>";
					echo "<tr align=center><td colspan=6>You do not have any purchase record!</td></tr>";
					echo "</table>";
				}
			?>
        </div>
			<div id="record_footer">
				<a href="book1.php">Books</a> | <a href="new.php">New Releases</a> | <a href="basket.php">Your Basket</a> | <a href="about2.php">About Us</a> | <a href="contact2.php">Contact Us</a><br />
				Copyright &copy; 2013 <b><strong><font color="#fff">The Book Shelf</font></strong></b>
			</div>

	</div> 
</div>
</body>
</html>