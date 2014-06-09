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
			
			$bookid = $_SESSION['bookid']; //taking bookid
			$bookdata = mysql_query("SELECT * FROM books WHERE bookid = '$bookid'");
				if ($bookdata)
				{
					$bookarray = mysql_fetch_assoc($bookdata);
					$bookname = $bookarray['bookname'];
					$author = $bookarray['author'];
					$price = $bookarray['price'];
					$type = $bookarray['type'];
				}
				else
				{
					echo "<script>alert('Database error!')</script>";
				}
			
			$bookadd = $_POST['bookadd']; //number of books filled in the textbox
			$bookadd_int = (int) $bookadd;
			
			$querystock = "SELECT quantity FROM books WHERE bookid = '$bookid'";
			$checkstock = mysql_query($querystock);
			$quantity = mysql_fetch_assoc($checkstock);
			$number = $quantity['quantity'];
			
			$now = $number - $bookadd_int; //if book stock after adding is < 0, alert Book Stock is not enough!
			if ($now >= 0) {
				$basket = sprintf("SELECT quantity,totalprice FROM userbaskets WHERE username='%s' AND bookid='$bookid'",mysql_real_escape_string($username));
				$basketquery = mysql_query($basket);
				$basketqueryrow = mysql_num_rows($basketquery); //if rows = 0, update it with the book data added, if rows != 0, do addition to the previous book quantity
				
				if ($basketqueryrow == 0)
				{
					$total = $bookadd_int * $price;
					$update1 = "INSERT INTO userbaskets (buyid,username,bookid,bookname,author,type,quantity,totalprice) VALUES ('','$username','$bookid','$bookname','$author','$type','$bookadd_int','$total')";
					$update1query = mysql_query($update1);
					
					if ($update1query) 
					{
						$stocknow = mysql_query("UPDATE books SET quantity=$now WHERE bookid = '$bookid'"); //update the number of book stock
						header("refresh:0; url=$bookid.php");
						echo "<script>alert('Done!')</script>";
					}
					else
					{
						header("refresh:0; url=$bookid.php");
						echo "<script>alert('Error! Please try again!')</script>";
					}
				}
				
				else
				{
					$basketarray = mysql_fetch_array($basketquery);
					$basketno = $basketarray['quantity'];
					$basketnow = $basketno + $bookadd_int;
					
					$baskettotal = $basketarray['totalprice'];
					$total = $bookadd_int * $price;
					$baskettotalnow = $baskettotal + $total;
					$update2 = sprintf("UPDATE userbaskets SET quantity=$basketnow,totalprice=$baskettotalnow WHERE username='%s'",mysql_real_escape_string($username));
					$update2query =mysql_query($update2);
					
					if ($update2query) 
					{
						$stocknow = mysql_query("UPDATE books SET quantity=$now WHERE bookid = '$bookid'"); //update the number of book stock
						header("refresh:0; url=$bookid.php");
						echo "<script>alert('Done!')</script>";
					}
					
					else
					{
						header("refresh:0; url=$bookid.php");
						echo "<script>alert('Error! Please try again!')</script>";
					}
				}
			}
			
			else {
			header("refresh:0; url=$bookid.php"); 
			echo "<script>alert('Book is out of stock!')</script>";
			}
		}
	}
	
	else {
		session_destroy();
		header("refresh:0; url=home.php");
		echo "<script>alert('Please login first!')</script>";
	}
?>