<html>
<head>
	<title>The Book Shelf</title>
	<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
	
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
				
			function validateform()
				{
					var name=document.forms["contact"]["name"].value;
					var username=document.forms["contact"]["username"].value;
					var email=document.forms["contact"]["email"].value;
					var subject=document.forms["contact"]["subject"].value;
					var message=document.forms["contact"]["message"].value;
					
					var letters = /^[A-Za-z]+$/;  
					var rules = /^[0-9A-Za-z]+$/;
					
					if (subject == "" || subject == null || name == "" || name == null || username == "" || username == null || email == null || email == "" || message == "" || message == null)
					{
						alert("Please fill in the required data!");
						return false;
					}
					
					if (!name.match(letters))
					{
						alert("Name must be alphabets only!");
						return false;
					}
					
					if (!username.match(rules))
					{
						alert('Username consists of alphabet and numeric only!');
						return false;
					}
						
					if (username.length > 20 || username.length < 5)
					{
						alert("Username must be at least 5 characters but not more than 20 characters!");
						return false;
					}
				}
		</script>
		
</head>

<body>

<div id="templatemo_container">
<div id="menu_unlogin">
    	<ul>
            <li><a href="home.php">Home</a></li>
			<li><a href="registration.html">Register</a></li>
            <li><a href="about1.html">About Us</a></li> 
            <li><a href="contact1.php" class="current">Contact</a></li>
    	</ul>
</div>
    
<div id="templatemo_header">
  
  <div id="templatemo_login">
  <img src="images/loginsym.png" width="100px" height="30px">
    <form name="login" action="login.php" onsubmit="return validatelogin()" method="post">
		<table>
					<tr>
						<td><p><strong>Username</strong></p></td>
						<td width="5%"><p><strong>:</strong></p></td>
						<td><p><strong>
					    <input type="username" name="username" style="width:130px" class="btn btn-default">
						</strong></p></td>
						<td><p style="margin-left:40px"><strong>
					    <input type="submit" class="btn btn-default" name="submit" value="LOGIN" style="width:75px;font-family:arial">
						</strong></p></td>
					</tr>
					<tr>
						<td><p><strong>Password</strong></p></td>
						<td width="5%"><p><strong>:</strong></p></td>
						<td><p><strong>
					    <input type="password" name="password" style="width:130px" class="btn btn-default">
						</strong></p></td>
						<td><p style="margin-left:40px"><strong>
					    <input type="reset" name="reset" class="btn btn-default" value="RESET" style="width:75px; font-family:arial">
						</strong></p></td>
					</tr>
		</table>
	 </form>
      
     </div>
</div>
		<div id="templatemo_content">
			<p class="genre">CONTACT US</p>
			<br>
			<br>
			<form name = "contact" action="emailsend1.php" method="post" onsubmit= "return validateform()">
				<table>
					<tr>
						<td>Name <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 5px;"><input type="text" maxlength="30" name="name" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Username <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 5px;"><input type="text" maxlength="30" name="username" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Email <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 5px;"><input type="email" maxlength="30" name="email" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Subject <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td><span style="margin-left : 7px;"><input type="text" maxlength="30" name="subject" style="width : 421px;" class="btn btn-default"></span></td>
					</tr>
					<tr>
						<td>Message <font color="ff3f3f">*</font></td>
						<td>:</td>
						<td rowspan = "4" colspan="3"><span style="margin-left : 5px;"><textarea name="message" maxlength="1000" cols="50" rows="10" class="btn btn-default"></textarea></span></td>
					</tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
				</table>
				<br>
				<p style="float : left; margin-left : 170px; font-face : arial;"><input type="submit" value="Send Message" class="btn btn-default"></p>
				<p style="float : right; margin-right : 530px; font-face : arial;"><input type="reset" value="Clear Form" class="btn btn-default"></p>
        	
        </div> <!-- end of content right -->
		
		<div class="cleaner_with_height">&nbsp;</div>
	  
		<div id="templatemo_footer">
				   <a href="home1.php">Home</a> | <a href="registration.html">Register</a> | <a href="book.php">Books</a> | <a href="new.php">New Releases</a> | <a href="about1.html">About Us</a> | <a href="contact1.php">Contact Us</a><br />
				Copyright &copy; 2013 <b><strong><font color="#fff">The Book Shelf</font></strong></b></div> 

</div>	
</body>
</html>