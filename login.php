<?php
##############################################################################################
##Please go through the script prior to use as multiple customizations are required.
##The HTML for the form can be completely modified please feel free to chnage them.
##If you require additional support or would like new features then please E-mail me webmaster@spiders-design.co.uk
##############################################################################################

session_start();
if(isset($_REQUEST['password'])){
$password = $_REQUEST['password'];
//change password value
if($password == "<yourpassword>") {//---------------------------------------------edit required
$_SESSION['authenticated'] = "yes";
$do = "redirect";
}
else {
$do = "incorrect";
}
}
else{
$do = "showform";
}
//done processing
if($do == "showform"){
$formhtml = <<<EOT
<html> 

<head> 
<title>Your Site | Login</title>
<style type="text/css">
body {
/* background: url(http://yoursite.com/images/1.jpg) no-repeat; */
background-size: 100%;
font-family:Verdana, Geneva, sans-serif;
}
#form {
opacity: 0.5;filter:alpha(opacity=50);zoom:1;
}
#form:hover {
opacity: 0.8;filter:alpha(opacity=80);zoom:1;
}
</style>
</head>

<body>

<img src="http://coccoon.flyingoctopus.net/flyingoctopus_little.png" style="float:right; position:absolute; right:10%;" alt="Coming Soon">
<div class="form" style="position:absolute; width:450px; height:430px; margin: -215px 0 0 -397.5px; left: 50%; top: 50%;">
	<img src="http://coccoon.flyingoctopus.net/mind_blown.gif" alt="Coming Soon">


	<div style="position:absolute;width:300px; height: 300px; margin:-150px 0 0 -150px; left:50%; top: 90%; font-size: 8px;">
		<form method="post" action="http://coccoon.flyingoctopus.net/login.php">
		    <br /><input type="password" title="Enter your password" name="password" /></p>
		    <p><input type="submit" name="submit"  /></p>
		</form>
	</div>

</div>


</body>

</html>
EOT;
echo($formhtml);
}
else if($do == "incorrect") {
$formhtml = <<<formhtml
<html> 

<head> 
<title>Your Site | Login</title>
<style type="text/css">
body {
background: url(http://coccoon.flyingoctopus.net/images/1.jpg) no-repeat;
background-size: 100%;
font-family:Verdana, Geneva, sans-serif;
}
#form {
opacity: 0.5;filter:alpha(opacity=50);zoom:1;
}
#form:hover {
opacity: 0.8;filter:alpha(opacity=80);zoom:1;
}
</style>
</head>

<body>

<img src="http://coccoon.flyingoctopus.net/flyingoctopus_little.png" style="float:right; position:absolute; right:10%;" alt="Coming Soon">

<div align="center" id="form" class="form"style="margin-top:400px; margin-left:40%; margin-right:40%;; background-color:#000; color:#FFF"><h2>Your Site Login</h2>
  <form action="login.php" method="post">
  <div style="color:#F00" >Incorrect password</div>
    Password: <input type="password" name="password"></input><br></br>
<input type="submit"></input></form></div>



</body>

</html>

formhtml;
echo($formhtml);
}
elseif($do == "redirect") {
echo <<<redirect
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Redirecting</title>
<meta http-equiv="REFRESH" content="0;url=http://coccoon.flyingoctopus.net"></HEAD>
<BODY>
<a href="http://coccoon.flyingoctopus.net">Authenticated - redirecting...</a>
</BODY>
</HTML>
redirect;
}
?>
