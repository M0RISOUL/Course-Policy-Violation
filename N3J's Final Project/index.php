<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="index.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Student ID</label>
  		<input type="text" name="studentid" maxlength="10">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p><center>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>

	<?php
	
	?>
</body>
</html>