<?php
	include 'config.php';
	mysql_connect('localhost',$db_username,$db_pass) or die (mysql_error());
	mysql_select_db('project1') or die (mysql_error());
	
	$username = $_POST['deleteusername'];
	
	$bookorder_query = mysql_query("SELECT * FROM userbaskets WHERE username='$username'"); //basket
	
	$check_existence = mysql_query("SELECT * FROM userdetails WHERE username='$username'"); //check whether the username exists or not
	$check_row = mysql_num_rows($check_existence);
	
	if ($check_row == 1)
	{
		if ($bookorder_query)
		{
			while ($bookorder_array = mysql_fetch_array($bookorder_query))
			{
				$bookid = $bookorder_array['bookid']; //from basket
				$buyid = $bookorder_array['buyid']; //from basket
				$orderqty = $bookorder_array['quantity']; //from basket
				
				$bookdata = mysql_query("SELECT * FROM books WHERE bookid='$bookid'");
				$stock = mysql_fetch_array($bookdata)['quantity'];
				
				$stocknow = $orderqty + $stock;
			
				$deleteorder = mysql_query("DELETE FROM userbaskets WHERE buyid='$buyid'"); //delete order 
				$updatestock = mysql_query("UPDATE books SET quantity='$stocknow' WHERE bookid='$bookid'"); //update the now stock
			}
			
			$deleteuser = mysql_query("DELETE FROM userdetails WHERE username='$username'");
			
			if ($deleteuser)
			{
				echo "<script>alert('Username is deleted!')</script>";
				header("refresh:0;url=adminusers.php");
			}
			else
			{
				echo "<script>alert('Error! Username is not deleted!')</script>";
				header("refresh:0;url=adminusers.php");
			}
		}
		
		else 
		{
			echo "<script>alert('Error! Please try again!')</script>";
			header("refresh:0;url=adminusers.php");
		}
	}
	
	else 
		{
			echo "<script>alert('Username does not exist!')</script>";
			header("refresh:0;url=adminusers.php");
		}
?>