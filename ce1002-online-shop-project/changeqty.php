<?php
	session_start();
	
	include 'config.php';
	mysql_connect('localhost',$db_username,$db_pass) or die (mysql_error());
	mysql_select_db('project1') or die (mysql_error());
	
	$buyid = $_POST['buyid'];
	$changeqty = $_POST['changeqty'];
	$difference = $changeqty - mysql_fetch_array(mysql_query("SELECT * FROM userbaskets WHERE buyid='$buyid'"))['quantity'];
	
	$bookid_query = mysql_query("SELECT * FROM userbaskets WHERE buyid='$buyid'");
	$row = mysql_num_rows($bookid_query);
	
	if ($row == 1)
	{
		if ($bookid_query)
		{
				$bookid_array = mysql_fetch_array($bookid_query);
				$bookid = $bookid_array['bookid'];
				
				$bookquantity = mysql_query("SELECT * FROM books WHERE bookid='$bookid'");
				
				if ($bookquantity)
				{
					$quantity_array = mysql_fetch_array($bookquantity);
					$quantity_before = $quantity_array['quantity'];
					$price = $quantity_array['price'];
					
					$quantity_now = $quantity_before - $difference;
					$price_now = $price * $changeqty;
					
					if ($quantity_now >= 0)
					{
						
						$query = mysql_query("UPDATE books SET quantity='$quantity_now' WHERE bookid='$bookid'");
						$change_data = mysql_query("UPDATE userbaskets SET quantity='$changeqty' , totalprice='$price_now' WHERE buyid='$buyid'");
						
						header("refresh:0; url=basket.php");
						echo "<script>alert('Order has been updated!')</script>";
					}
					else
					{
						header("refresh:0; url=basket.php");
						echo "<script>alert('The number of stock is not enough!')</script>";
					}
				}
				else
				{
					header("refresh:0; url=basket.php");
					echo "<script>alert('Error! Please try again!')</script>";
				}
		}
		else
		{
			header("refresh:0; url=basket.php");
			echo "<script>alert('Error! Please try again!')</script>";
		}
	}
		
	else 
	{
		echo "<script>alert('Buy ID does not exist! Please check your buy ID!')</script>";
		header("refresh:0; url=basket.php");
	}
					
