<?php
	session_start();
	
	if(!empty($_SESSION['username']) && !empty($_SESSION['password']))
	{
		session_destroy();
	}
?>

<html>
<head>
	<title>The Book Shelf</title>
	<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
	
	<script>
			function validatelogin()
				{
					var user = document.forms["login"]["username"].value;
					var pass = document.forms["login"]["password"].value;
					
					if ((user == null || user == "") && (pass == null || pass == ""))
					{
						alert("Please enter your username and password!");
						return false;
					}
					else if ((user == null || user == "") && (pass != null || pass != ""))
					{
						alert("Please enter your username!");
						return false;
					}
					else if ((user != null || user != "") && (pass == null || pass == ""))
					{
						alert("Please enter your password!");
						return false;
					}
				}
		</script>
		
</head>

<body>

<div id="templatemo_container">
<div id="menu_unlogin">
    	<ul>
            <li><a href="home.php" class="current">Home</a></li>
			<li><a href="registration.html">Register</a></li>
            <li><a href="about1.html">About Us</a></li> 
            <li><a href="contact1.php">Contact</a></li>
    	</ul>
</div>
    
<div id="templatemo_header">
  
  <div id="templatemo_login">
  <img src="images/loginsym.png" width="100px" height="30px">
    <a id="login"></a><form name="login" action="login.php" onsubmit="return validatelogin()" method="post">
		<table>
					<tr>
						<td><p><strong>Username</strong></p></td>
						<td width="5%"><p><strong>:</strong></p></td>
						<td><p><strong>
					    <input type="username" name="username" style="width:130px" class="btn btn-default">
						</strong></p></td>
						<td><p style="margin-left:40px"><strong>
					    <input type="submit" class="btn btn-default" name="submit" value="LOGIN" style="width:75px; height:20px;font-family:arial;">
						</strong></p></td>
					</tr>
					<tr>
						<td><p><strong>Password</strong></p></td>
						<td width="5%"><p><strong>:</strong></p></td>
						<td><p><strong>
					    <input type="password" name="password" style="width:130px" class="btn btn-default">
						</strong></p></td>
						<td><p style="margin-left:40px"><strong>
					    <input type="reset" name="reset" class="btn btn-default" value="RESET" style="width:75px; height:20px;font-family:arial">
						</strong></p></td>
					</tr>
		</table>
	 </form>
      
     </div>
</div>
		<div id="welcome">
			<p align="center"><img src="images/welcome.png" width="550px" height="20px"style="margin-top:20px;"><p>
			<br>
			<br>
			<div id="wowslider-container1">
				<div class="ws_images">
					<ul>
						<li><a href="3.php"><img src="data1/images/ss1.jpg" title="ss1" id="wows1_0"/></a></li>
						<li><a href="8.php"><img src="data1/images/ss2.jpg" title="ss2" id="wows1_1"/></a></li>
						<li><a href="4.php"><img src="data1/images/ss3.jpg" title="ss3" id="wows1_2"/></a></li>
						<li><a href="5.php"><img src="data1/images/ss4.jpg" title="ss4" id="wows1_3"/></a></li>
					</ul>
				</div>
		
				<div class="ws_bullets">
					<div>
						<a title="ss1"><img src="data1/tooltips/ss1.jpg"/>1</a>
						<a title="ss2"><img src="data1/tooltips/ss2.jpg"/>2</a>
						<a title="ss3"><img src="data1/tooltips/ss3.jpg"/>3</a>
						<a title="ss4"><img src="data1/tooltips/ss4.jpg"/>4</a>
					</div>
				</div>
	
			<div class="ws_shadow"></div>
		</div>
		<script type="text/javascript" src="engine1/wowslider.js"></script>
		<script type="text/javascript" src="engine1/script.js"></script>
		
			<br>
			<br>
			<div id="greet"><p>
			Greetings to you by Edwin Candinegara, Hu Siyu, and Jayakumar Sanjana!! The Book Shelf is the biggest online book shop. We have a big list of books inside this website and you can order books too! If you are not registered yet, please <a href="registration.html">register</a> first before you can start browsing our list of books and ordering books.
			If you have had a username already, you can login using the form on the top of this page or simply by clicking <a href="#login">here</a>. We hope you can find the books you are looking for!
			</p>
			</div>
			
		</div>
	  
		<div id="templatemo_footer">
				   <a href="home1.php">Home</a> | <a href="registration.html">Register</a> | <a href="book.php">Books</a> | <a href="new.php">New Releases</a> | <a href="about1.html">About Us</a> | <a href="contact1.php">Contact Us</a><br />
				Copyright &copy; 2013 <b><strong><font color="#fff">The Book Shelf</font></strong></b></div> 

</div>	
</body>
</html>