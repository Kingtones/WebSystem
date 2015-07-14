<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<base href=<?php echo base_url();?>/>
<head>
<title>Login form</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--script-->

</head>
<body>
<div class="login">
<!--start-loginform-->
		<form name="login-form" class="login-form" action="log.php" method="post">
			<span class="header-top"><img src="images/topimg.png"/></span>
		    <div class="header">
		    <h1>Login Form</h1>	   	
		    </div>
		    <div class="content">
			<input type="text" class="input username" name="User" placeholder="User" required="">
		    <input type="password"   class="input password" name="Password" placeholder="Password" required="">
		    </div>
		    <div class="login_button">
		    <input type="submit" name="submit" value="Login" class="button" />
		    </div>
		</form>
<!--end login form-->
<!--side-icons-->
    <div class="user-icon"> </div>
    <div class="pass-icon"> </div>
    <!--END side-icons-->
    <!--Side-icons-->
	<script type="text/javascript">
	$(document).ready(function() {
		$(".username").focus(function() {
			$(".user-icon").css("left","-69px");
		});
		$(".username").blur(function() {
			$(".user-icon").css("left","0px");
		});
		
		$(".password").focus(function() {
			$(".pass-icon").css("left","-69px");
		});
		$(".password").blur(function() {
			$(".pass-icon").css("left","0px");
		});
	});
	</script>
	<p class="copy_right">&#169; 2014 Template by<a href="http://w3layouts.com" target="_blank">&nbsp;w3layouts</a> </p>

</div>
</body>
</html>