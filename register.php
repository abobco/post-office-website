<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="employee_fname" value="<?php echo $employee_fname; ?>">
		</div>
		<div class="input-group">
			<label>Last Name</label>
			<input type="text" name="employee_lname" value="<?php echo $employee_lname; ?>">
		</div>
		<div class="input-group">
			<label>Street Address</label>
			<input type="text" name="street_address" value="<?php echo $street_address; ?>">
		</div>
		<div class="input-group">
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city; ?>">
		</div>
		<div class="input-group">
			<label>State</label>
			<input type="text" name="state" value="<?php echo $state; ?>">
		</div>
		<div class="input-group">
			<label>Zip Code</label>
			<input type="text" name="zipcode" value="<?php echo $zipcode; ?>">
		</div>
		<div class="input-group">
			<label>Department Number</label>
			<input type="text" name="dept_number" value="<?php echo $dept_number; ?>">
		</div>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
		 <a href="login.php">Return to log in</a>
		</p>
	</form>
</body>
</html>