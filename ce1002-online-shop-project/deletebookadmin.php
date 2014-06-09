<?php
	session_start();
	
	include 'config.php';
		mysql_connect('localhost',$db_username,$db_pass) or die (mysql_error());
		mysql_select_db('project1') or die (mysql_error());
	
	$buyid = $_POST['delete_with_bookid'];
	$data = "SELECT * FROM userbaskets WHERE buyid='$buyid'";
	
	$data_query = mysql_query($data);
	$data_array = mysql_fetch_array($data_query);
	$quantity_deleted = $data_array['quantity'];
	
	$row = mysql_num_rows($data_query);
	
	$bookid_deleted = $data_array['bookid'];
	
	//take the data first before deleting the order!!
	
	
	$delete = "DELETE FROM userbaskets WHERE buyid='$buyid'";
	$query = mysql_query($delete);
	
	if ($row == 1)
	{
		if ($query)
		{
			$bookdata = mysql_query("SELECT * FROM books WHERE bookid='$bookid_deleted'");
			$bookdata_array = mysql_fetch_array($bookdata);
			$quantity_before = $bookdata_array['quantity']; //take the quantity before adding with the quantity from the deleted order
			
			$quantity_now = $quantity_before + $quantity_deleted;
			
			$quantity_updated = mysql_query("UPDATE books SET quantity='$quantity_now' WHERE bookid='$bookid_deleted'");
			
			if ($quantity_updated)
			{
				echo "<script>alert('Done!')</script>";
				header("refresh:0; url=adminbaskets.php");
			}
			else
			{
				echo "<script>alert('Error! Please try again!')</script>";
				header("refresh:0; url=adminbaskets.php");
			}
		}
		else
		{
			echo "<script>alert('Error! Please try again!')</script>";
			header("refresh:0; url=adminbaskets.php");
		}
	}
	
	else
	{
		echo "<script>alert('Buy ID does not exist! Please check the buy ID!')</script>";
		header("refresh:0; url=adminbaskets.php");
	}
?>